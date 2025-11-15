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
            $routeName = preg_replace('/\s*(Route\s+(Summary|summary|summery|SUmmary)|Route\s+Risk|Route\s+Emergency|Route\s+Crowded|Route Summary|Route summary|Route summery|Route SUmmary|summary|Crowded spot|crowded spot|Crowded|Croweded|Emergancy|Emargancy|Emarganncy|Emmargancy|Emergncy|Emargency|Emergency|Risk\s+\d+|Risk|risk|EMERGANCY|CROWDED|ROUTE SUMMARY)\s*\.json$/i', '', $filename);
            $routeName = preg_replace('/\.json$/i', '', $routeName);
            $routeName = trim($routeName);
            
            // Normalize route name - remove extra spaces
            $routeName = preg_replace('/\s+/', ' ', $routeName);
            
            if (empty($routeName)) {
                continue;
            }
            
            if (!isset($routeMap[$routeName])) {
                $routeMap[$routeName] = [
                    'name' => $routeName,
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
            }
            
            // Parse the file content
            $fileContent = file_get_contents($file);
            
            if ($fileContent === false) {
                echo "WARNING: Could not read file: {$filename}\n";
                continue;
            }
            
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
                    $routeMap[$routeName]['start_coords'] = [$content['start_latitude'], $content['start_longitude']];
                } elseif (isset($content['route_summary_start_latitude']) && isset($content['route_summary_start_longitude'])) {
                    $routeMap[$routeName]['start_coords'] = [$content['route_summary_start_latitude'], $content['route_summary_start_longitude']];
                } elseif (isset($content['start_coordinates'])) {
                    $coords = $this->parseCoordinates($content['start_coordinates']);
                    if ($coords) {
                        $routeMap[$routeName]['start_coords'] = $coords;
                    }
                }
                
                if (isset($content['end_latitude']) && isset($content['end_longitude'])) {
                    $routeMap[$routeName]['end_coords'] = [$content['end_latitude'], $content['end_longitude']];
                } elseif (isset($content['route_summary_end_latitude']) && isset($content['route_summary_end_longitude'])) {
                    $routeMap[$routeName]['end_coords'] = [$content['route_summary_end_latitude'], $content['route_summary_end_longitude']];
                } elseif (isset($content['end_coordinates'])) {
                    $coords = $this->parseCoordinates($content['end_coordinates']);
                    if ($coords) {
                        $routeMap[$routeName]['end_coords'] = $coords;
                    }
                }
                
                // Parse route summary details
                if (isset($content['total_distance_km'])) {
                    $routeMap[$routeName]['total_distance_km'] = floatval($content['total_distance_km']);
                }
                
                if (isset($content['estimated_duration_hours'])) {
                    $routeMap[$routeName]['estimated_duration_hours'] = floatval($content['estimated_duration_hours']);
                }
                
                if (isset($content['adjusted_duration_heavy_vehicle_hours'])) {
                    $routeMap[$routeName]['adjusted_duration_heavy_vehicle_hours'] = floatval($content['adjusted_duration_heavy_vehicle_hours']);
                }
            } elseif (stripos($filename, 'Risk') !== false && !preg_match('/\.png$/i', $filename)) {
                // Parse risk points (handles "Risk", "Risk 1", "Risk 2", etc.)
                $riskPoints = $this->parseRiskPoints($content);
                
                if (empty($riskPoints)) {
                    echo "WARNING: No risk points found in file: {$filename}\n";
                } else {
                    // Remove duplicates based on coordinates before merging
                    $existingCoords = array_map(function($point) {
                        return $this->formatCoordinateKey($point['coords']);
                    }, $routeMap[$routeName]['risk_points']);
                    
                    $newRiskPoints = array_filter($riskPoints, function($point) use ($existingCoords) {
                        $coordKey = $this->formatCoordinateKey($point['coords']);
                        return !in_array($coordKey, $existingCoords);
                    });
                    
                    $duplicateCount = count($riskPoints) - count($newRiskPoints);
                    if ($duplicateCount > 0) {
                        echo "INFO: Removed {$duplicateCount} duplicate risk point(s) from {$filename}\n";
                    }
                    
                    $routeMap[$routeName]['risk_points'] = array_merge($routeMap[$routeName]['risk_points'], $newRiskPoints);
                }
            } elseif (stripos($filename, 'Crowded') !== false || stripos($filename, 'Croweded') !== false || stripos($filename, 'crowded') !== false || stripos($filename, 'CROWDED') !== false) {
                // Parse crowded spots
                $crowdedSpots = $this->parseCrowdedSpots($content);
                $routeMap[$routeName]['crowded_spots'] = array_merge($routeMap[$routeName]['crowded_spots'], $crowdedSpots);
            } elseif (stripos($filename, 'Emergancy') !== false || stripos($filename, 'Emargancy') !== false || stripos($filename, 'Emarganncy') !== false || stripos($filename, 'Emergncy') !== false || stripos($filename, 'Emmargancy') !== false || stripos($filename, 'Emargency') !== false || stripos($filename, 'emergency') !== false || stripos($filename, 'EMERGENCY') !== false) {
                // Parse emergency locations (skip actual PNG files)
                if (!preg_match('/\.png$/i', $filename)) {
                    $emergencyLocations = $this->parseEmergencyLocations($content);
                    $routeMap[$routeName]['emergency_locations'] = array_merge($routeMap[$routeName]['emergency_locations'], $emergencyLocations);
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
            // Handle coordinates field format (Risk 1, with item_X_coordinates)
            if (strpos($key, 'coordinates') !== false || strpos($key, 'coordinate') !== false || strpos($key, 'Coordinates') !== false) {
                $index = $this->extractIndex($key);
                
                // Get risk level, speed, and type
                $riskLevel = 'Medium';
                $speed = '30 KM/Hr';
                $riskType = 'Turn';
                
                foreach ($data as $k => $v) {
                    if ($this->extractIndex($k) == $index) {
                        if (strpos($k, 'risk_level') !== false || strpos($k, 'risk_risk') !== false || strpos($k, 'category') !== false || strpos($k, 'Risk Level') !== false) {
                            $riskLevel = $v;
                        } elseif (strpos($k, 'speed_limit') !== false || strpos($k, '_speed') !== false || strpos($k, 'Speed Limit') !== false) {
                            $speed = is_numeric($v) ? $v . ' KM/Hr' : $v;
                        } elseif (strpos($k, 'risk_type') !== false || strpos($k, 'Risk Type') !== false) {
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
            // Handle latitude/longitude format (Risk 2, with row_X_latitude)
            elseif (strpos($key, '_latitude') !== false) {
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
                        } elseif (strpos($k, 'category') !== false || strpos($k, 'risk_level') !== false) {
                            $riskLevel = $v;
                        } elseif (strpos($k, '_speed') !== false || strpos($k, 'speed_limit') !== false) {
                            $speedUnit = $data["row_{$index}_speed_unit"] ?? 'KM/Hr';
                            $speed = is_numeric($v) ? $v . ' ' . $speedUnit : $v;
                        } elseif (strpos($k, 'risk_type') !== false) {
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
        
        // Handle array format (with item_X_ prefix)
        foreach ($data as $key => $value) {
            if (strpos($key, 'coordinates') !== false) {
                $index = $this->extractIndex($key);
                
                $type = '';
                $name = '';
                $speed = '30 km/h';
                $risk = 'Medium';
                
                foreach ($data as $k => $v) {
                    if ($this->extractIndex($k) == $index) {
                        if (strpos($k, '_type') !== false) {
                            $type = $v;
                        } elseif (strpos($k, '_name') !== false) {
                            $name = $v;
                        } elseif (strpos($k, 'speed_limit') !== false) {
                            $speed = is_numeric($v) ? $v . ' km/h' : $v;
                        } elseif (strpos($k, 'risk_level') !== false) {
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
        
        // Handle format with row_X_ prefix
        foreach ($data as $key => $value) {
            if (strpos($key, 'coordinates') !== false) {
                $index = $this->extractIndex($key);
                
                $type = '';
                $name = '';
                $speed = '30 km/h';
                $risk = 'Medium';
                
                // Get other fields for the same index
                foreach ($data as $k => $v) {
                    if ($this->extractIndex($k) == $index) {
                        if (strpos($k, '_type') !== false) {
                            $type = $v;
                        } elseif (strpos($k, '_name') !== false) {
                            $name = $v;
                        } elseif (strpos($k, 'speed_limit') !== false) {
                            $speed = is_numeric($v) ? $v . ' km/h' : $v;
                        } elseif (strpos($k, 'risk_level') !== false) {
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

