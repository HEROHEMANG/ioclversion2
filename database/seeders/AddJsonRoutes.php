<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JourneyRoute;

class AddJsonRoutes extends Seeder
{
    public function run()
    {
        echo "Starting JSON route parsing...\n";
        $routes = $this->parseAllJsonFiles();
        
        $totalRoutes = count($routes);
        echo "Found {$totalRoutes} route(s) to process.\n\n";
        
        foreach ($routes as $routeData) {
            // Validate route data before saving
            $validation = $this->validateRouteData($routeData);
            
            if (!$validation['valid']) {
                echo "ERROR: Skipping route '{$routeData['name']}' - {$validation['error']}\n";
                continue;
            }
            
            // If end_coords is [0,0], use the same as start_coords
            if ($routeData['end_coords'] == [0, 0]) {
                $routeData['end_coords'] = $routeData['start_coords'];
            }
            
            $route = JourneyRoute::updateOrCreate(
                ['name' => $routeData['name']],
                $routeData
            );
            
            // Report what was saved
            echo "✓ Route '{$routeData['name']}' saved:\n";
            echo "  - Risk Points: " . count($routeData['risk_points']) . "\n";
            echo "  - Crowded Spots: " . count($routeData['crowded_spots']) . "\n";
            echo "  - Emergency Locations: " . count($routeData['emergency_locations']) . "\n";
            echo "  - Start Coords: [" . $routeData['start_coords'][0] . ", " . $routeData['start_coords'][1] . "]\n";
            echo "  - End Coords: [" . $routeData['end_coords'][0] . ", " . $routeData['end_coords'][1] . "]\n";
            if (isset($routeData['total_distance_km']) && $routeData['total_distance_km'] !== null) {
                echo "  - Total Distance: " . $routeData['total_distance_km'] . " km\n";
            }
            if (isset($routeData['estimated_duration_hours']) && $routeData['estimated_duration_hours'] !== null) {
                echo "  - Estimated Duration: " . $routeData['estimated_duration_hours'] . " hours\n";
            }
            if (isset($routeData['adjusted_duration_heavy_vehicle_hours']) && $routeData['adjusted_duration_heavy_vehicle_hours'] !== null) {
                echo "  - Adjusted Duration (Heavy Vehicle): " . $routeData['adjusted_duration_heavy_vehicle_hours'] . " hours\n";
            }
            echo "\n";
        }
        
        echo "Route parsing completed!\n";
    }
    
    private function validateRouteData($routeData)
    {
        // Check required fields
        if (empty($routeData['name'])) {
            return ['valid' => false, 'error' => 'Route name is required'];
        }
        
        if (empty($routeData['start_coords']) || !is_array($routeData['start_coords']) || count($routeData['start_coords']) != 2) {
            return ['valid' => false, 'error' => 'Invalid start coordinates'];
        }
        
        if (empty($routeData['end_coords']) || !is_array($routeData['end_coords']) || count($routeData['end_coords']) != 2) {
            return ['valid' => false, 'error' => 'Invalid end coordinates'];
        }
        
        // Validate coordinate ranges (latitude: -90 to 90, longitude: -180 to 180)
        if (!$this->isValidCoordinate($routeData['start_coords'][0], $routeData['start_coords'][1])) {
            return ['valid' => false, 'error' => 'Start coordinates out of valid range'];
        }
        
        if (!$this->isValidCoordinate($routeData['end_coords'][0], $routeData['end_coords'][1])) {
            return ['valid' => false, 'error' => 'End coordinates out of valid range'];
        }
        
        // Validate risk points coordinates
        foreach ($routeData['risk_points'] as $index => $point) {
            if (!isset($point['coords']) || !is_array($point['coords']) || count($point['coords']) != 2) {
                return ['valid' => false, 'error' => "Invalid coordinates in risk point #{$index}"];
            }
            if (!$this->isValidCoordinate($point['coords'][0], $point['coords'][1])) {
                return ['valid' => false, 'error' => "Risk point #{$index} has coordinates out of valid range"];
            }
        }
        
        // Validate crowded spots coordinates
        foreach ($routeData['crowded_spots'] as $index => $spot) {
            if (!isset($spot['coords']) || !is_array($spot['coords']) || count($spot['coords']) != 2) {
                return ['valid' => false, 'error' => "Invalid coordinates in crowded spot #{$index}"];
            }
            if (!$this->isValidCoordinate($spot['coords'][0], $spot['coords'][1])) {
                return ['valid' => false, 'error' => "Crowded spot #{$index} has coordinates out of valid range"];
            }
        }
        
        // Validate emergency locations coordinates
        foreach ($routeData['emergency_locations'] as $index => $location) {
            if (!isset($location['coords']) || !is_array($location['coords']) || count($location['coords']) != 2) {
                return ['valid' => false, 'error' => "Invalid coordinates in emergency location #{$index}"];
            }
            if (!$this->isValidCoordinate($location['coords'][0], $location['coords'][1])) {
                return ['valid' => false, 'error' => "Emergency location #{$index} has coordinates out of valid range"];
            }
        }
        
        return ['valid' => true];
    }
    
    private function isValidCoordinate($lat, $lng)
    {
        // Validate latitude: -90 to 90
        // Validate longitude: -180 to 180
        return is_numeric($lat) && is_numeric($lng) 
            && $lat >= -90 && $lat <= 90 
            && $lng >= -180 && $lng <= 180;
    }

    private function parseAllJsonFiles()
    {
        $jsonPath = public_path('json folder');
        
        if (!is_dir($jsonPath)) {
            echo "JSON folder directory not found: {$jsonPath}\n";
            return [];
        }
        
        $jsonFiles = glob($jsonPath . '/*.json', GLOB_BRACE);
        
        $routeMap = [];
        
        foreach ($jsonFiles as $file) {
            $filename = basename($file);
            
            // Extract route name by removing suffixes (Risk, CROWDED, EMERGENCY, etc.)
            // Handle patterns like "RISK 1 .json", "CROWDED .json", "ROUTE SUMMARY .json"
            // Also handle typos: EMERGAENCY, EMERGEENCY, EMEARGENCY, SEMMERY, SUMARY, SAMMARY
            // Remove .json extension first
            $routeName = preg_replace('/\.json$/i', '', $filename);
            
            // Remove common suffixes (handle multiple in sequence and typos)
            // Pattern: (ROUTE\s+)?(RISK\s*\d*|CROWDED|EMERGENCY|SUMMARY|etc.) with typos
            $suffixes = [
                // Route prefixes with suffixes
                '/\s*Route\s+(Summary|summary|summery|SUmmary|SEMMERY|SUMARY|SAMMARY|summery|sumary|sammary)\s*$/i',
                '/\s*Route\s+(Risk|risk|RISK)\s*\d*\s*$/i',
                '/\s*Route\s+(Emergency|emergency|EMERGENCY|Emergancy|Emargancy|Emarganncy|Emmargancy|Emergncy|Emargency|Emmemergency|EMERGAENCY|EMERGEENCY|EMEARGENCY|EMMERGENCY)\s*$/i',
                '/\s*Route\s+(Crowded|crowded|CROWDED|Croweded|Crawded|CRAWDED)\s*$/i',
                // Standalone suffixes
                '/\s*(Summary|summary|summery|SUmmary|SEMMERY|SUMARY|SAMMARY|summery|sumary|sammary)\s*$/i',
                '/\s*(Risk|risk|RISK)\s*\d*\s*(Emergency|emergency|EMERGENCY|Emergancy|Emargancy|Emarganncy|Emmargancy|Emergncy|Emargency|Emmemergency|EMERGAENCY|EMERGEENCY|EMEARGENCY|EMMERGENCY)?\s*$/i',
                '/\s*(Emergency|emergency|EMERGENCY|Emergancy|Emargancy|Emarganncy|Emmargancy|Emergncy|Emargency|Emmemergency|EMERGAENCY|EMERGEENCY|EMEARGENCY|EMMERGENCY)\s*$/i',
                '/\s*(Crowded|crowded|CROWDED|Croweded|Crawded|CRAWDED|Crowded spot|crowded spot)\s*$/i',
            ];
            
            // Apply all suffix patterns (may need multiple passes for compound suffixes)
            foreach ($suffixes as $pattern) {
                $routeName = preg_replace($pattern, '', $routeName);
            }
            
            // Remove standalone "ROUTE" at the end (if it wasn't part of a compound suffix)
            $routeName = preg_replace('/\s+Route\s*$/i', '', $routeName);
            
            // Remove trailing dots and spaces
            $routeName = preg_replace('/[\.\s]+$/', '', $routeName);
            $routeName = trim($routeName);
            
            // Normalize route name - remove extra spaces
            $routeName = preg_replace('/\s+/', ' ', $routeName);
            
            // Normalize case variations and handle common abbreviations
            // Convert to uppercase for consistency, but preserve the original casing for display
            $normalizedRouteName = strtoupper($routeName);
            // Handle common variations: "STN" -> "STATION", "FILLING STN" -> "FILLING STATION"
            $normalizedRouteName = preg_replace('/\bSTN\b/', 'STATION', $normalizedRouteName);
            $normalizedRouteName = preg_replace('/\s+/', ' ', $normalizedRouteName);
            
            // Use normalized name as key for merging, but keep original for display
            $routeKey = $normalizedRouteName;
            
            if (empty($routeName)) {
                continue;
            }
            
            // Use normalized key for merging routes with case variations
            // But keep the first encountered properly-cased name for display
            if (!isset($routeMap[$routeKey])) {
                $routeMap[$routeKey] = [
                    'name' => $routeName, // Keep original casing for display
                    'source' => 'Rajbandh Terminal',
                    'destination' => $routeName,
                    'start_coords' => [23.4764, 87.3975], // Default start coordinates
                    'end_coords' => [0, 0],
                    'total_distance_km' => null,
                    'estimated_duration_hours' => null,
                    'adjusted_duration_heavy_vehicle_hours' => null,
                    'risk_points' => [],
                    'crowded_spots' => [],
                    'emergency_locations' => [],
                ];
            } else {
                // If we find a better-cased version, use it (prefer mixed case over all uppercase)
                $currentName = $routeMap[$routeKey]['name'];
                if (strtoupper($currentName) === $currentName && strtoupper($routeName) !== $routeName) {
                    $routeMap[$routeKey]['name'] = $routeName;
                    $routeMap[$routeKey]['destination'] = $routeName;
                }
            }
            
            // Parse the file content
            $fileContent = file_get_contents($file);
            
            if ($fileContent === false) {
                echo "WARNING: Could not read file: {$filename}\n";
                continue;
            }
            
            // Fix trailing commas in JSON (common issue)
            $fileContent = preg_replace('/,\s*}/', '}', $fileContent);
            $fileContent = preg_replace('/,\s*]/', ']', $fileContent);
            
            $content = json_decode($fileContent, true);
            
            if ($content === null && json_last_error() !== JSON_ERROR_NONE) {
                echo "ERROR: Failed to parse JSON file: {$filename} - " . json_last_error_msg() . "\n";
                continue;
            }
            
            if (empty($content)) {
                echo "WARNING: Empty JSON content in file: {$filename}\n";
                continue;
            }
            
            // Determine file type and process accordingly
            if (stripos($filename, 'Route Summary') !== false || stripos($filename, 'summary') !== false) {
                // Parse route summary - handle both naming conventions
                if (isset($content['start_latitude']) && isset($content['start_longitude'])) {
                    $routeMap[$routeKey]['start_coords'] = [$content['start_latitude'], $content['start_longitude']];
                } elseif (isset($content['route_summary_start_latitude']) && isset($content['route_summary_start_longitude'])) {
                    $routeMap[$routeKey]['start_coords'] = [$content['route_summary_start_latitude'], $content['route_summary_start_longitude']];
                } elseif (isset($content['start_coordinates'])) {
                    $coords = $this->parseCoordinates($content['start_coordinates']);
                    if ($coords) {
                        $routeMap[$routeKey]['start_coords'] = $coords;
                    }
                }
                
                if (isset($content['end_latitude']) && isset($content['end_longitude'])) {
                    $routeMap[$routeKey]['end_coords'] = [$content['end_latitude'], $content['end_longitude']];
                } elseif (isset($content['route_summary_end_latitude']) && isset($content['route_summary_end_longitude'])) {
                    $routeMap[$routeKey]['end_coords'] = [$content['route_summary_end_latitude'], $content['route_summary_end_longitude']];
                } elseif (isset($content['end_coordinates'])) {
                    $coords = $this->parseCoordinates($content['end_coordinates']);
                    if ($coords) {
                        $routeMap[$routeKey]['end_coords'] = $coords;
                    }
                }
                
                // Parse route summary details
                // Handle both field name formats: total_distance_km or total_distance
                if (isset($content['total_distance_km'])) {
                    $routeMap[$routeKey]['total_distance_km'] = floatval($content['total_distance_km']);
                } elseif (isset($content['total_distance'])) {
                    $routeMap[$routeKey]['total_distance_km'] = floatval($content['total_distance']);
                }
                
                // Handle both field name formats: estimated_duration_hours or estimated_duration
                if (isset($content['estimated_duration_hours'])) {
                    $routeMap[$routeKey]['estimated_duration_hours'] = floatval($content['estimated_duration_hours']);
                } elseif (isset($content['estimated_duration'])) {
                    $routeMap[$routeKey]['estimated_duration_hours'] = floatval($content['estimated_duration']);
                }
                
                // Handle both field name formats: adjusted_duration_heavy_vehicle_hours or adjusted_duration_heavy_vehicle
                if (isset($content['adjusted_duration_heavy_vehicle_hours'])) {
                    $routeMap[$routeKey]['adjusted_duration_heavy_vehicle_hours'] = floatval($content['adjusted_duration_heavy_vehicle_hours']);
                } elseif (isset($content['adjusted_duration_heavy_vehicle'])) {
                    $routeMap[$routeKey]['adjusted_duration_heavy_vehicle_hours'] = floatval($content['adjusted_duration_heavy_vehicle']);
                }
            } elseif (stripos($filename, 'Risk') !== false && !preg_match('/\.png$/i', $filename) && stripos($filename, 'Emergency') === false && stripos($filename, 'EMERGENCY') === false && stripos($filename, 'EMERGAENCY') === false && stripos($filename, 'EMERGEENCY') === false && stripos($filename, 'EMEARGENCY') === false && stripos($filename, 'EMMERGENCY') === false && stripos($filename, 'Crowded') === false && stripos($filename, 'CROWDED') === false && stripos($filename, 'Croweded') === false && stripos($filename, 'Crawded') === false && stripos($filename, 'CRAWDED') === false && stripos($filename, 'crowded') === false) {
                // Parse risk points (handles "Risk", "Risk 1", "Risk 2", etc.)
                // Exclude files that are emergency files (e.g., "RISK EMERGENCY")
                $riskPoints = $this->parseRiskPoints($content);
                
                if (empty($riskPoints)) {
                    echo "WARNING: No risk points found in file: {$filename}\n";
                } else {
                    // Remove duplicates based on coordinates before merging
                    $existingCoords = array_map(function($point) {
                        return $this->formatCoordinateKey($point['coords']);
                    }, $routeMap[$routeKey]['risk_points']);
                    
                    $newRiskPoints = array_filter($riskPoints, function($point) use ($existingCoords) {
                        $coordKey = $this->formatCoordinateKey($point['coords']);
                        return !in_array($coordKey, $existingCoords);
                    });
                    
                    $duplicateCount = count($riskPoints) - count($newRiskPoints);
                    if ($duplicateCount > 0) {
                        echo "INFO: Removed {$duplicateCount} duplicate risk point(s) from {$filename}\n";
                    }
                    
                    $routeMap[$routeKey]['risk_points'] = array_merge($routeMap[$routeKey]['risk_points'], $newRiskPoints);
                }
            } elseif (stripos($filename, 'Crowded') !== false || stripos($filename, 'Croweded') !== false || stripos($filename, 'Crawded') !== false || stripos($filename, 'CRAWDED') !== false || stripos($filename, 'crowded') !== false || stripos($filename, 'CROWDED') !== false) {
                // Parse crowded spots
                $crowdedSpots = $this->parseCrowdedSpots($content);
                if (empty($crowdedSpots)) {
                    echo "WARNING: No crowded spots found in file: {$filename}\n";
                }
                $routeMap[$routeKey]['crowded_spots'] = array_merge($routeMap[$routeKey]['crowded_spots'], $crowdedSpots);
            } elseif (stripos($filename, 'Emergancy') !== false || stripos($filename, 'Emargancy') !== false || stripos($filename, 'Emarganncy') !== false || stripos($filename, 'Emergncy') !== false || stripos($filename, 'Emmargancy') !== false || stripos($filename, 'Emargency') !== false || stripos($filename, 'Emmemergency') !== false || stripos($filename, 'EMERGAENCY') !== false || stripos($filename, 'EMERGEENCY') !== false || stripos($filename, 'EMEARGENCY') !== false || stripos($filename, 'EMMERGENCY') !== false || stripos($filename, 'emergency') !== false || stripos($filename, 'EMERGENCY') !== false) {
                // Parse emergency locations (skip actual PNG files)
                if (!preg_match('/\.png$/i', $filename)) {
                    $emergencyLocations = $this->parseEmergencyLocations($content);
                    $routeMap[$routeKey]['emergency_locations'] = array_merge($routeMap[$routeKey]['emergency_locations'], $emergencyLocations);
                }
            }
        }
        
        // For routes without end_coords, use the last risk point's coordinates
        // Keep default start_coords (Rajbandh Terminal) unless Route Summary provides different coordinates
        foreach ($routeMap as $routeName => &$route) {
            if (!empty($route['risk_points'])) {
                // If no end_coords, use last risk point
                if ($route['end_coords'] == [0, 0]) {
                    $lastRiskPoint = end($route['risk_points']);
                    if (isset($lastRiskPoint['coords'])) {
                        $route['end_coords'] = $lastRiskPoint['coords'];
                    }
                }
            }
        }
        
        // Filter out routes without valid start coordinates
        return array_values(array_filter($routeMap, function($route) {
            return !empty($route['start_coords']);
        }));
    }

    private function parseRiskPoints($data)
    {
        $riskPoints = [];
        
        foreach ($data as $key => $value) {
            // Handle latitude/longitude format FIRST (Risk 2, with row_X_latitude or coordinate_latitude_X)
            // This must come before the 'coordinate' check to avoid false matches
            if (strpos($key, '_latitude') !== false) {
                $index = $this->extractIndex($key);
                
                // Get corresponding longitude
                $longitude = null;
                $riskLevel = 'Medium';
                $speed = '30 KM/Hr';
                $riskType = 'Turn';
                
                foreach ($data as $k => $v) {
                    if ($this->extractIndex($k) == $index) {
                        if (strpos($k, '_longitude') !== false) {
                            $longitude = $v;
                        } elseif (strpos($k, 'category') !== false || strpos($k, 'risk_level') !== false || strpos($k, 'level_') !== false) {
                            $riskLevel = $v;
                        } elseif (strpos($k, '_speed') !== false || strpos($k, 'speed_limit') !== false || strpos($k, 'speed_km_hr_') !== false) {
                            // Handle speed_km_hr_X format
                            if (strpos($k, 'speed_km_hr_') !== false) {
                                $speed = is_numeric($v) ? $v . ' KM/Hr' : $v;
                            } else {
                                $speedUnit = $data["row_{$index}_speed_unit"] ?? 'KM/Hr';
                                $speed = is_numeric($v) ? $v . ' ' . $speedUnit : $v;
                            }
                        } elseif (strpos($k, 'risk_type') !== false || strpos($k, 'type_') !== false) {
                            $riskType = $v;
                        }
                    }
                }
                
                if ($longitude !== null) {
                    $coords = [floatval($value), floatval($longitude)];
                    $riskPoints[] = [
                        'coords' => $coords,
                        'risk' => $riskLevel,
                        'speed' => $speed,
                        'type' => $riskType
                    ];
                }
            }
            // Handle coordinates field format (Risk 1, with item_X_coordinates)
            // Check for full word 'coordinates' to avoid matching 'coordinate_latitude'
            elseif (preg_match('/\bcoordinates\b/i', $key) || (stripos($key, 'coordinate') !== false && strpos($key, '_latitude') === false && strpos($key, '_longitude') === false)) {
                $index = $this->extractIndex($key);
                
                // Get risk level, speed, and type
                $riskLevel = 'Medium';
                $speed = '30 KM/Hr';
                $riskType = 'Turn';
                
                foreach ($data as $k => $v) {
                    if ($this->extractIndex($k) == $index) {
                        if (stripos($k, 'risk_level') !== false || stripos($k, 'risk_risk') !== false || stripos($k, 'category') !== false || stripos($k, 'risk level') !== false) {
                            $riskLevel = $v;
                        } elseif (stripos($k, 'speed_limit') !== false || stripos($k, '_speed') !== false || stripos($k, 'speed limit') !== false) {
                            $speed = is_numeric($v) ? $v . ' KM/Hr' : $v;
                        } elseif (stripos($k, 'risk_type') !== false || stripos($k, 'risk type') !== false) {
                            $riskType = $v;
                        }
                    }
                }
                
                // Parse coordinates
                $coords = $this->parseCoordinates($value);
                if ($coords) {
                    $riskPoints[] = [
                        'coords' => $coords,
                        'risk' => $riskLevel === 'Blind Spot' ? 'Blind Spot' : $riskLevel,
                        'speed' => $speed,
                        'type' => $riskType
                    ];
                }
            }
        }
        
        return $riskPoints;
    }

    private function parseCrowdedSpots($data)
    {
        $crowdedSpots = [];
        
        // Handle single object format
        if (isset($data['coordinates']) && isset($data['name'])) {
            $coords = $this->parseCoordinates($data['coordinates']);
            if ($coords) {
                $crowdedSpots[] = [
                    'coords' => $coords,
                    'type' => $data['type'] ?? 'school',
                    'name' => $data['name'],
                    'speed' => $data['speed_limit'] ?? '30 km/h',
                    'risk' => $data['risk_level'] ?? 'Medium'
                ];
            }
            return $crowdedSpots;
        }
        
        // Handle latitude/longitude format FIRST (e.g., row_X_latitude, row_X_longitude)
        foreach ($data as $key => $value) {
            if (strpos($key, '_latitude') !== false && (strpos($key, 'location_') === false)) {
                $index = $this->extractIndex($key);
                
                // Get corresponding longitude
                $longitude = null;
                $type = 'school';
                $name = '';
                $speed = '30 km/h';
                $risk = 'Medium';
                
                foreach ($data as $k => $v) {
                    if ($this->extractIndex($k) == $index) {
                        if (strpos($k, '_longitude') !== false) {
                            $longitude = $v;
                        } elseif (strpos($k, '_type') !== false) {
                            $type = $v;
                        } elseif (strpos($k, '_name') !== false) {
                            $name = $v;
                        } elseif (strpos($k, 'speed_limit') !== false || strpos($k, 'speed_') !== false) {
                            $speed = is_numeric($v) ? $v . ' km/h' : $v;
                        } elseif (strpos($k, 'risk_level') !== false || strpos($k, 'risk_') !== false) {
                            $risk = $v;
                        }
                    }
                }
                
                if ($longitude !== null && $name) {
                    $coords = [floatval($value), floatval($longitude)];
                    if ($this->isValidCoordinate($coords[0], $coords[1])) {
                        $crowdedSpots[] = [
                            'coords' => $coords,
                            'type' => $type ?: 'school',
                            'name' => $name,
                            'speed' => $speed,
                            'risk' => $risk
                        ];
                    }
                }
            }
        }
        
        // If we already found spots using latitude/longitude format, return them
        if (!empty($crowdedSpots)) {
            return $crowdedSpots;
        }
        
        // Handle array format (with item_X_ prefix and coordinates field)
        foreach ($data as $key => $value) {
            if (strpos($key, 'coordinates') !== false) {
                $index = $this->extractIndex($key);
                
                $type = '';
                $name = '';
                $speed = '30 km/h';
                $risk = 'Medium';
                
                foreach ($data as $k => $v) {
                    if ($this->extractIndex($k) == $index) {
                        // Handle both _type/type_ and _name/name_ formats
                        if (strpos($k, '_type') !== false || preg_match('/^type_\d+/', $k)) {
                            $type = $v;
                        } elseif (strpos($k, '_name') !== false || preg_match('/^name_\d+/', $k)) {
                            $name = $v;
                        } elseif (strpos($k, 'speed_limit') !== false || preg_match('/^speed_limit_\d+/', $k)) {
                            $speed = is_numeric($v) ? $v . ' km/h' : $v;
                        } elseif (strpos($k, 'risk_level') !== false || preg_match('/^risk_level_\d+/', $k)) {
                            $risk = $v;
                        }
                    }
                }
                
                $coords = $this->parseCoordinates($value);
                if ($coords && $name) {
                    $crowdedSpots[] = [
                        'coords' => $coords,
                        'type' => $type ?: 'school',
                        'name' => $name,
                        'speed' => $speed,
                        'risk' => $risk
                    ];
                }
            }
        }
        
        return $crowdedSpots;
    }

    private function parseEmergencyLocations($data)
    {
        $emergencyLocations = [];
        
        // Handle single object format
        if (isset($data['coordinates']) && isset($data['name'])) {
            $coords = $this->parseCoordinates($data['coordinates']);
            if ($coords) {
                $emergencyLocations[] = [
                    'coords' => $coords,
                    'type' => $data['type'] ?? 'hospital',
                    'name' => $data['name'],
                    'speed' => $data['speed_limit'] ?? '30 km/h',
                    'risk' => $data['risk_level'] ?? 'Medium'
                ];
            }
            return $emergencyLocations;
        }
        
        // Handle latitude/longitude format FIRST (e.g., location_X_latitude, location_X_longitude)
        foreach ($data as $key => $value) {
            if (strpos($key, '_latitude') !== false) {
                $index = $this->extractIndex($key);
                
                // Get corresponding longitude
                $longitude = null;
                $type = 'hospital';
                $name = '';
                $speed = '30 km/h';
                $risk = 'Medium';
                
                foreach ($data as $k => $v) {
                    if ($this->extractIndex($k) == $index) {
                        if (strpos($k, '_longitude') !== false) {
                            $longitude = $v;
                        } elseif (strpos($k, '_type') !== false || (strpos($k, 'type_') !== false && strpos($k, 'risk') === false)) {
                            $type = $v;
                        } elseif (strpos($k, '_name') !== false || strpos($k, 'name_') !== false) {
                            $name = $v;
                        } elseif (strpos($k, 'speed_limit') !== false || strpos($k, 'speed_') !== false) {
                            $speed = is_numeric($v) ? $v . ' km/h' : $v;
                        } elseif (strpos($k, 'risk_level') !== false || strpos($k, 'risk_') !== false) {
                            $risk = $v;
                        }
                    }
                }
                
                if ($longitude !== null && $name) {
                    $coords = [floatval($value), floatval($longitude)];
                    if ($this->isValidCoordinate($coords[0], $coords[1])) {
                        $emergencyLocations[] = [
                            'coords' => $coords,
                            'type' => $type ?: 'hospital',
                            'name' => $name,
                            'speed' => $speed,
                            'risk' => $risk
                        ];
                    }
                }
            }
        }
        
        // If we already found locations using latitude/longitude format, return them
        if (!empty($emergencyLocations)) {
            return $emergencyLocations;
        }
        
        // Handle format with row_X_ prefix and coordinates field
        // Also handle entry_X_ format (e.g., entry_0_coordinates, entry_0_name, entry_0_type)
        foreach ($data as $key => $value) {
            if (strpos($key, 'coordinates') !== false || (strpos($key, 'entry_') !== false && strpos($key, 'coordinates') !== false)) {
                $index = $this->extractIndex($key);
                
                $type = '';
                $name = '';
                $speed = '30 km/h';
                $risk = 'Medium';
                
                // Get other fields for the same index
                foreach ($data as $k => $v) {
                    if ($this->extractIndex($k) == $index) {
                        // Handle entry_X_type, entry_X_name, etc.
                        if (strpos($k, '_type') !== false || (strpos($k, 'type_') !== false && strpos($k, 'risk') === false) || (strpos($k, 'entry_') !== false && strpos($k, '_type') !== false)) {
                            $type = $v;
                        } elseif (strpos($k, '_name') !== false || strpos($k, 'name_') !== false || (strpos($k, 'entry_') !== false && strpos($k, '_name') !== false)) {
                            $name = $v;
                        } elseif (strpos($k, 'speed_limit') !== false || strpos($k, 'speed_') !== false || (strpos($k, 'entry_') !== false && strpos($k, 'speed') !== false)) {
                            $speed = is_numeric($v) ? $v . ' km/h' : $v;
                        } elseif (strpos($k, 'risk_level') !== false || strpos($k, 'risk_') !== false || (strpos($k, 'entry_') !== false && strpos($k, 'risk') !== false)) {
                            $risk = $v;
                        }
                    }
                }
                
                $coords = $this->parseCoordinates($value);
                if ($coords && $name) {
                    $emergencyLocations[] = [
                        'coords' => $coords,
                        'type' => $type ?: 'hospital',
                        'name' => $name,
                        'speed' => $speed,
                        'risk' => $risk
                    ];
                }
            }
        }
        
        return $emergencyLocations;
    }

    private function parseCoordinates($value)
    {
        if (is_array($value) && count($value) == 2) {
            $lat = floatval($value[0]);
            $lng = floatval($value[1]);
            // Validate before returning
            if ($this->isValidCoordinate($lat, $lng)) {
                return [$lat, $lng];
            }
            return null;
        } elseif (is_string($value)) {
            $value = trim($value);
            
            // Remove parentheses if present: "(23.4764, 87.3975)" -> "23.4764, 87.3975"
            $value = preg_replace('/^\(|\)$/', '', $value);
            $value = trim($value);
            
            // Handle newline-separated coordinates
            if (strpos($value, "\n") !== false) {
                $parts = explode("\n", $value);
                if (count($parts) == 2) {
                    $lat = floatval(trim($parts[0]));
                    $lng = floatval(trim($parts[1]));
                    if ($this->isValidCoordinate($lat, $lng)) {
                        return [$lat, $lng];
                    }
                }
            }
            
            // Handle "lat, lng" format (comma-separated)
            $parts = explode(',', $value);
            if (count($parts) == 2) {
                $lat = floatval(trim($parts[0]));
                $lng = floatval(trim($parts[1]));
                if ($this->isValidCoordinate($lat, $lng)) {
                    return [$lat, $lng];
                }
            }
        }
        
        return null;
    }

    private function extractIndex($key)
    {
        // Extract index from keys like "row_0_", "item_1_", "location_0_", "0_", etc.
        if (preg_match('/(\d+)/', $key, $matches)) {
            return $matches[1];
        }
        return '';
    }
    
    private function formatCoordinateKey($coords)
    {
        // Format coordinates as a key for duplicate detection (with precision)
        return number_format($coords[0], 8, '.', '') . ',' . number_format($coords[1], 8, '.', '');
    }
}

