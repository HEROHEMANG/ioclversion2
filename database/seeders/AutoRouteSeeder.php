<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JourneyRoute;

class AutoRouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * This seeder automatically creates routes from any folder in public directory
     * that contains a "dummy text json.txt" file.
     */
    public function run(): void
    {
        $publicPath = public_path();
        $directories = array_diff(scandir($publicPath), array('.', '..', 'images', 'css', 'js'));
        
        foreach ($directories as $directory) {
            $folderPath = $publicPath . '/' . $directory;
            
            // Check if it's a directory and contains the JSON file
            if (is_dir($folderPath)) {
                $jsonFilePath = $folderPath . '/dummy text json.txt';
                
                if (file_exists($jsonFilePath)) {
                    $this->createRouteFromFolder($directory, $jsonFilePath);
                }
            }
        }
    }
    
    private function createRouteFromFolder($folderName, $jsonFilePath)
    {
        // Check if route already exists
        $existingRoute = JourneyRoute::where('destination', $folderName)->first();
        if ($existingRoute) {
            echo "Route for '{$folderName}' already exists. Skipping...\n";
            return;
        }
        
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
        
        if (empty($routeData)) {
            echo "No valid JSON data found in {$jsonFilePath}\n";
            return;
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
            'name' => $folderName . ' Route',
            'source' => 'Rajbandh Terminal',
            'destination' => $folderName,
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
        
        echo "Successfully created route for: {$folderName}\n";
    }
}