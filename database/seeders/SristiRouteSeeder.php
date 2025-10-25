<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JourneyRoute;

class SristiRouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Parse the JSON data from the txt file
        $jsonFilePath = public_path('284860 SRISTI FILLING STATION/dummy text json.txt');
        
        if (file_exists($jsonFilePath)) {
            // Extract destination name from folder name
            $folderName = '284860 SRISTI FILLING STATION';
            $destinationName = $folderName; // Use full folder name as destination
            
            $content = file_get_contents($jsonFilePath);
            $lines = array_filter(explode("\n", $content), function($line) {
                return !empty(trim($line));
            });
            
            $routeData = [];
            foreach ($lines as $line) {
                $decoded = json_decode(trim($line), true);
                if ($decoded) {
                    $routeData[] = $decoded;
                }
            }
            
            // Process risk points
            $riskPoints = [];
            if (isset($routeData[1])) {
                $riskData = $routeData[1];
                foreach($riskData as $key => $value) {
                    if(strpos($key, 'record_') === 0) {
                        $parts = explode('_', $key);
                        $recordIndex = $parts[1];
                        $field = implode('_', array_slice($parts, 2));
                        
                        if(!isset($riskPoints[$recordIndex])) {
                            $riskPoints[$recordIndex] = [];
                        }
                        $riskPoints[$recordIndex][$field] = $value;
                    }
                }
            }
            
            // Process emergency locations
            $emergencyLocations = [];
            if (isset($routeData[2])) {
                $emergencyData = $routeData[2];
                foreach($emergencyData as $key => $value) {
                    if(strpos($key, 'entry_') === 0) {
                        $parts = explode('_', $key);
                        $entryIndex = $parts[1];
                        $field = implode('_', array_slice($parts, 2));
                        
                        if(!isset($emergencyLocations[$entryIndex])) {
                            $emergencyLocations[$entryIndex] = [];
                        }
                        $emergencyLocations[$entryIndex][$field] = $value;
                    }
                }
            }
            
            // Process crowded spots
            $crowdedSpots = [];
            if (isset($routeData[3])) {
                $crowdedData = $routeData[3];
                foreach($crowdedData as $key => $value) {
                    if(strpos($key, 'crowded_spots_row_') === 0) {
                        $parts = explode('_', $key);
                        $rowIndex = $parts[3];
                        $field = implode('_', array_slice($parts, 4));
                        
                        if(!isset($crowdedSpots[$rowIndex])) {
                            $crowdedSpots[$rowIndex] = [];
                        }
                        $crowdedSpots[$rowIndex][$field] = $value;
                    }
                }
            }
            
            // Create the route
            JourneyRoute::create([
                'name' => $destinationName . ' Route',
                'source' => 'Rajbandh Terminal',
                'destination' => $destinationName,
                'start_coords' => [
                    $routeData[0]['start_latitude'] ?? 23.4764,
                    $routeData[0]['start_longitude'] ?? 87.3975
                ],
                'end_coords' => [
                    $routeData[0]['end_latitude'] ?? 23.229037,
                    $routeData[0]['end_longitude'] ?? 87.8412958
                ],
                'risk_points' => array_values($riskPoints),
                'crowded_spots' => array_values($crowdedSpots),
                'emergency_locations' => array_values($emergencyLocations),
            ]);
        }
    }
}