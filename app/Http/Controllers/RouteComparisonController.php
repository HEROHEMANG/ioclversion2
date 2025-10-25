<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JourneyRoute;

class RouteComparisonController extends Controller
{
    public function index()
    {
        $routes = JourneyRoute::all();
        
        // Calculate statistics for each route
        $routeStats = $routes->map(function ($route) {
            return [
                'id' => $route->id,
                'name' => $route->name,
                'source' => $route->source,
                'destination' => $route->destination,
                'start_coords' => $route->start_coords,
                'end_coords' => $route->end_coords,
                'risk_points_count' => count(is_array($route->risk_points) ? $route->risk_points : []),
                'crowded_spots_count' => count(is_array($route->crowded_spots) ? $route->crowded_spots : []),
                'emergency_locations_count' => count(is_array($route->emergency_locations) ? $route->emergency_locations : []),
                'total_coordinates' => $this->calculateTotalCoordinates($route),
                'risk_points' => $route->risk_points,
                'crowded_spots' => $route->crowded_spots,
                'emergency_locations' => $route->emergency_locations,
                'created_at' => $route->created_at,
                'updated_at' => $route->updated_at,
            ];
        });

        return view('route-comparison', compact('routes', 'routeStats'));
    }

    public function show($id)
    {
        $route = JourneyRoute::findOrFail($id);
        
        $routeDetails = [
            'id' => $route->id,
            'name' => $route->name,
            'source' => $route->source,
            'destination' => $route->destination,
            'start_coords' => $route->start_coords,
            'end_coords' => $route->end_coords,
            'risk_points' => $route->risk_points,
            'crowded_spots' => $route->crowded_spots,
            'emergency_locations' => $route->emergency_locations,
            'total_coordinates' => $this->calculateTotalCoordinates($route),
            'created_at' => $route->created_at,
            'updated_at' => $route->updated_at,
        ];

        return view('route-details', compact('routeDetails'));
    }

    private function calculateTotalCoordinates($route)
    {
        $total = 2; // Start and end coordinates
        
        if ($route->risk_points && is_array($route->risk_points)) {
            $total += count($route->risk_points);
        }
        
        if ($route->crowded_spots && is_array($route->crowded_spots)) {
            $total += count($route->crowded_spots);
        }
        
        if ($route->emergency_locations && is_array($route->emergency_locations)) {
            $total += count($route->emergency_locations);
        }
        
        return $total;
    }

    public function exportJson()
    {
        $routes = JourneyRoute::all();
        
        $exportData = [
            'export_timestamp' => now()->toISOString(),
            'total_routes' => $routes->count(),
            'routes' => $routes->map(function ($route) {
                return [
                    'id' => $route->id,
                    'name' => $route->name,
                    'source' => $route->source,
                    'destination' => $route->destination,
                    'start_coords' => $route->start_coords,
                    'end_coords' => $route->end_coords,
                    'risk_points' => $route->risk_points,
                    'crowded_spots' => $route->crowded_spots,
                    'emergency_locations' => $route->emergency_locations,
                    'total_coordinates' => $this->calculateTotalCoordinates($route),
                    'created_at' => $route->created_at,
                    'updated_at' => $route->updated_at,
                ];
            })
        ];

        return response()->json($exportData, 200, [], JSON_PRETTY_PRINT);
    }
}
