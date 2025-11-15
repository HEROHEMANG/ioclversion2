<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JourneyRoute;
use Illuminate\Http\Request;

class JourneyRouteController extends Controller
{
    public function index()
    {
        return JourneyRoute::select('id', 'name', 'source', 'destination')->orderBy('name')->get();
    }

    public function show(JourneyRoute $journeyRoute)
    {
        return $journeyRoute;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'source' => 'required|string',
            'destination' => 'required|string',
            'start_coords' => 'required|array|size:2',
            'start_coords.*' => 'numeric',
            'end_coords' => 'required|array|size:2',
            'end_coords.*' => 'numeric',
            'risk_points' => 'nullable|array',
            'crowded_spots' => 'nullable|array',
            'emergency_locations' => 'nullable|array',
        ]);

        // Check if route with same name already exists
        $existingRoute = JourneyRoute::where('name', $validated['name'])->first();
        
        if ($existingRoute) {
            return response()->json([
                'message' => 'Route with this name already exists',
                'error' => 'duplicate_name'
            ], 422);
        }

        $route = JourneyRoute::create($validated);

        return response()->json([
            'message' => 'Route added successfully',
            'route' => $route
        ], 201);
    }
}


