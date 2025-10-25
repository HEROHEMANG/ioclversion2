@extends('layouts.app')

@section('title', 'Route Comparison - Coordinate Accuracy')

@section('content')
    <!-- Header -->
    <div class="text-center py-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl text-white mb-8">
        <h1 class="text-3xl sm:text-4xl font-bold mb-2">🗺️ Route Comparison</h1>
        <p class="text-indigo-100">Database Coordinate Verification & Comparison</p>
    </div>

    <!-- Statistics -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-gradient-to-br from-pink-400 to-red-500 rounded-xl p-6 text-white text-center">
            <h3 class="text-2xl font-bold mb-2">🗺️ {{ $routes->count() }}</h3>
            <p class="text-pink-100">Total Routes</p>
        </div>
        <div class="bg-gradient-to-br from-pink-400 to-red-500 rounded-xl p-6 text-white text-center">
            <h3 class="text-2xl font-bold mb-2">📍 {{ $routeStats->sum('total_coordinates') }}</h3>
            <p class="text-pink-100">Total Coordinates</p>
        </div>
        <div class="bg-gradient-to-br from-pink-400 to-red-500 rounded-xl p-6 text-white text-center">
            <h3 class="text-2xl font-bold mb-2">⚠️ {{ $routeStats->sum('risk_points_count') }}</h3>
            <p class="text-pink-100">Risk Points</p>
        </div>
        <div class="bg-gradient-to-br from-pink-400 to-red-500 rounded-xl p-6 text-white text-center">
            <h3 class="text-2xl font-bold mb-2">🏥 {{ $routeStats->sum('emergency_locations_count') }}</h3>
            <p class="text-pink-100">Emergency Locations</p>
        </div>
    </div>

    <!-- Export Button -->
    <div class="text-right mb-6">
        <a href="{{ route('routes.export') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-xl hover:from-indigo-500 hover:to-purple-500 transition-all transform hover:-translate-y-0.5 shadow-lg hover:shadow-xl">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            Export JSON Data
        </a>
    </div>

    <!-- Main Comparison Table -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">Route ID</th>
                        <th class="px-4 py-3 text-left font-semibold">Route Name</th>
                        <th class="px-4 py-3 text-left font-semibold">Source</th>
                        <th class="px-4 py-3 text-left font-semibold">Destination</th>
                        <th class="px-4 py-3 text-left font-semibold">Start Coordinates</th>
                        <th class="px-4 py-3 text-left font-semibold">End Coordinates</th>
                        <th class="px-4 py-3 text-left font-semibold">Risk Points</th>
                        <th class="px-4 py-3 text-left font-semibold">Crowded Spots</th>
                        <th class="px-4 py-3 text-left font-semibold">Emergency Locations</th>
                        <th class="px-4 py-3 text-left font-semibold">Total Coords</th>
                        <th class="px-4 py-3 text-left font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($routeStats as $route)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-semibold text-gray-900">{{ $route['id'] }}</td>
                        <td class="px-4 py-3">
                            <div class="font-semibold text-gray-900">{{ $route['name'] }}</div>
                            <div class="text-xs text-gray-500 mt-1">
                                🕒 Updated: {{ $route['updated_at']->format('M d, Y H:i') }}
                            </div>
                        </td>
                        <td class="px-4 py-3 text-gray-700">{{ $route['source'] }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $route['destination'] }}</td>
                        
                        <!-- Start Coordinates -->
                        <td class="px-4 py-3">
                            <span class="font-mono text-xs bg-gray-100 px-2 py-1 rounded text-gray-700">
                                [{{ number_format(is_array($route['start_coords']) ? (float)$route['start_coords'][0] : 0, 6) }}, {{ number_format(is_array($route['start_coords']) ? (float)$route['start_coords'][1] : 0, 6) }}]
                            </span>
                        </td>
                        
                        <!-- End Coordinates -->
                        <td class="px-4 py-3">
                            <span class="font-mono text-xs bg-gray-100 px-2 py-1 rounded text-gray-700">
                                [{{ number_format(is_array($route['end_coords']) ? (float)$route['end_coords'][0] : 0, 6) }}, {{ number_format(is_array($route['end_coords']) ? (float)$route['end_coords'][1] : 0, 6) }}]
                            </span>
                        </td>
                        
                        <!-- Risk Points -->
                        <td class="px-4 py-3">
                            @if($route['risk_points_count'] > 0)
                                <span class="inline-block bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full font-semibold mb-2">{{ $route['risk_points_count'] }} Points</span>
                                <div class="space-y-1">
                                    @foreach(array_slice(is_array($route['risk_points']) ? $route['risk_points'] : [], 0, 3) as $risk)
                                        <div class="text-xs">
                                            <span class="font-mono bg-gray-100 px-1 py-0.5 rounded text-gray-700">
                                                [{{ number_format(is_array($risk['coords']) ? (float)$risk['coords'][0] : 0, 6) }}, {{ number_format(is_array($risk['coords']) ? (float)$risk['coords'][1] : 0, 6) }}]
                                            </span>
                                            <span class="ml-1 inline-block px-2 py-0.5 text-xs rounded-full font-semibold {{ $risk['risk'] === 'High' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                {{ $risk['risk'] }} - {{ $risk['speed'] }}
                                            </span>
                                        </div>
                                    @endforeach
                                    @if(count(is_array($route['risk_points']) ? $route['risk_points'] : []) > 3)
                                        <div class="text-xs text-gray-500">+{{ count(is_array($route['risk_points']) ? $route['risk_points'] : []) - 3 }} more...</div>
                                    @endif
                                </div>
                            @else
                                <span class="text-gray-400 text-sm">No data</span>
                            @endif
                        </td>
                        
                        <!-- Crowded Spots -->
                        <td class="px-4 py-3">
                            @if($route['crowded_spots_count'] > 0)
                                <span class="inline-block bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full font-semibold mb-2">{{ $route['crowded_spots_count'] }} Spots</span>
                                <div class="space-y-1">
                                    @foreach(array_slice(is_array($route['crowded_spots']) ? $route['crowded_spots'] : [], 0, 2) as $spot)
                                        <div class="text-xs">
                                            <span class="font-mono bg-gray-100 px-1 py-0.5 rounded text-gray-700">
                                                [{{ number_format(is_array($spot['coords']) ? (float)$spot['coords'][0] : 0, 6) }}, {{ number_format(is_array($spot['coords']) ? (float)$spot['coords'][1] : 0, 6) }}]
                                            </span>
                                            <div class="text-gray-500 mt-1">{{ \Illuminate\Support\Str::limit($spot['description'] ?? $spot['name'] ?? 'N/A', 20) }}</div>
                                        </div>
                                    @endforeach
                                    @if(count(is_array($route['crowded_spots']) ? $route['crowded_spots'] : []) > 2)
                                        <div class="text-xs text-gray-500">+{{ count(is_array($route['crowded_spots']) ? $route['crowded_spots'] : []) - 2 }} more...</div>
                                    @endif
                                </div>
                            @else
                                <span class="text-gray-400 text-sm">No data</span>
                            @endif
                        </td>
                        
                        <!-- Emergency Locations -->
                        <td class="px-4 py-3">
                            @if($route['emergency_locations_count'] > 0)
                                <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full font-semibold mb-2">{{ $route['emergency_locations_count'] }} Locations</span>
                                <div class="space-y-1">
                                    @foreach(array_slice(is_array($route['emergency_locations']) ? $route['emergency_locations'] : [], 0, 2) as $emergency)
                                        <div class="text-xs">
                                            <span class="font-mono bg-gray-100 px-1 py-0.5 rounded text-gray-700">
                                                [{{ number_format(is_array($emergency['coords']) ? (float)$emergency['coords'][0] : 0, 6) }}, {{ number_format(is_array($emergency['coords']) ? (float)$emergency['coords'][1] : 0, 6) }}]
                                            </span>
                                            <div class="mt-1">
                                                <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-0.5 rounded-full font-semibold">{{ $emergency['type'] }}</span>
                                            </div>
                                            <div class="text-gray-500">{{ \Illuminate\Support\Str::limit($emergency['name'], 15) }}</div>
                                        </div>
                                    @endforeach
                                    @if(count(is_array($route['emergency_locations']) ? $route['emergency_locations'] : []) > 2)
                                        <div class="text-xs text-gray-500">+{{ count(is_array($route['emergency_locations']) ? $route['emergency_locations'] : []) - 2 }} more...</div>
                                    @endif
                                </div>
                            @else
                                <span class="text-gray-400 text-sm">No data</span>
                            @endif
                        </td>
                        
                        <!-- Total Coordinates -->
                        <td class="px-4 py-3">
                            <span class="inline-block bg-indigo-100 text-indigo-800 text-sm px-3 py-1 rounded-full font-semibold">{{ $route['total_coordinates'] }}</span>
                        </td>
                        
                        <!-- Actions -->
                        <td class="px-4 py-3">
                            <a href="{{ route('routes.show', $route['id']) }}" class="inline-flex items-center px-3 py-2 border border-indigo-300 text-indigo-700 text-sm font-medium rounded-lg hover:bg-indigo-50 hover:border-indigo-400 transition-colors">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                View Details
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Detailed Coordinate Comparison -->
    <div class="mt-12">
        <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
            <svg class="w-6 h-6 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
            Detailed Coordinate Breakdown
        </h3>
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold">Route</th>
                            <th class="px-4 py-3 text-left font-semibold">Coordinate Type</th>
                            <th class="px-4 py-3 text-left font-semibold">Count</th>
                            <th class="px-4 py-3 text-left font-semibold">Sample Coordinates</th>
                            <th class="px-4 py-3 text-left font-semibold">Accuracy Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($routeStats as $route)
                            <tr>
                                <td rowspan="4" class="px-4 py-3 align-middle font-semibold text-gray-900">{{ $route['name'] }}</td>
                                <td class="px-4 py-3">
                                    <span class="inline-block bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded-full font-semibold">Start/End</span>
                                </td>
                                <td class="px-4 py-3 text-gray-700">2</td>
                                <td class="px-4 py-3">
                                    <div class="font-mono text-xs bg-gray-100 px-2 py-1 rounded text-gray-700 mb-1">
                                        Start: [{{ number_format(is_array($route['start_coords']) ? (float)$route['start_coords'][0] : 0, 6) }}, {{ number_format(is_array($route['start_coords']) ? (float)$route['start_coords'][1] : 0, 6) }}]
                                    </div>
                                    <div class="font-mono text-xs bg-gray-100 px-2 py-1 rounded text-gray-700">
                                        End: [{{ number_format(is_array($route['end_coords']) ? (float)$route['end_coords'][0] : 0, 6) }}, {{ number_format(is_array($route['end_coords']) ? (float)$route['end_coords'][1] : 0, 6) }}]
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full font-semibold">✓ Verified</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3">
                                    <span class="inline-block bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full font-semibold">Risk Points</span>
                                </td>
                                <td class="px-4 py-3 text-gray-700">{{ $route['risk_points_count'] }}</td>
                                <td class="px-4 py-3">
                                    @if($route['risk_points_count'] > 0)
                                        @foreach(array_slice(is_array($route['risk_points']) ? $route['risk_points'] : [], 0, 2) as $risk)
                                            <div class="font-mono text-xs bg-gray-100 px-2 py-1 rounded text-gray-700 mb-1">
                                                [{{ number_format(is_array($risk['coords']) ? (float)$risk['coords'][0] : 0, 6) }}, {{ number_format(is_array($risk['coords']) ? (float)$risk['coords'][1] : 0, 6) }}] ({{ $risk['risk'] }})
                                            </div>
                                        @endforeach
                                    @else
                                        <span class="text-gray-400 text-sm">No data</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    @if($route['risk_points_count'] > 0)
                                        <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full font-semibold">✓ Complete</span>
                                    @else
                                        <span class="inline-block bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full font-semibold">⚠ Missing</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3">
                                    <span class="inline-block bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full font-semibold">Crowded Spots</span>
                                </td>
                                <td class="px-4 py-3 text-gray-700">{{ $route['crowded_spots_count'] }}</td>
                                <td class="px-4 py-3">
                                    @if($route['crowded_spots_count'] > 0)
                                        @foreach(array_slice(is_array($route['crowded_spots']) ? $route['crowded_spots'] : [], 0, 2) as $spot)
                                            <div class="font-mono text-xs bg-gray-100 px-2 py-1 rounded text-gray-700 mb-1">
                                                [{{ number_format(is_array($spot['coords']) ? (float)$spot['coords'][0] : 0, 6) }}, {{ number_format(is_array($spot['coords']) ? (float)$spot['coords'][1] : 0, 6) }}]
                                            </div>
                                        @endforeach
                                    @else
                                        <span class="text-gray-400 text-sm">No data</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    @if($route['crowded_spots_count'] > 0)
                                        <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full font-semibold">✓ Complete</span>
                                    @else
                                        <span class="inline-block bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full font-semibold">⚠ Missing</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3">
                                    <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full font-semibold">Emergency</span>
                                </td>
                                <td class="px-4 py-3 text-gray-700">{{ $route['emergency_locations_count'] }}</td>
                                <td class="px-4 py-3">
                                    @if($route['emergency_locations_count'] > 0)
                                        @foreach(array_slice(is_array($route['emergency_locations']) ? $route['emergency_locations'] : [], 0, 2) as $emergency)
                                            <div class="font-mono text-xs bg-gray-100 px-2 py-1 rounded text-gray-700 mb-1">
                                                [{{ number_format(is_array($emergency['coords']) ? (float)$emergency['coords'][0] : 0, 6) }}, {{ number_format(is_array($emergency['coords']) ? (float)$emergency['coords'][1] : 0, 6) }}] ({{ $emergency['type'] }})
                                            </div>
                                        @endforeach
                                    @else
                                        <span class="text-gray-400 text-sm">No data</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    @if($route['emergency_locations_count'] > 0)
                                        <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full font-semibold">✓ Complete</span>
                                    @else
                                        <span class="inline-block bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full font-semibold">⚠ Missing</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="text-center mt-12 text-gray-500">
        <p class="flex items-center justify-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"></path>
            </svg>
            Database Coordinate Accuracy Report - Generated on {{ now()->format('M d, Y H:i:s') }}
        </p>
    </div>
@endsection
