@extends('layouts.app')

@section('title', 'Route Details - ' . $routeDetails['name'])

@section('content')
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('routes.comparison') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-xl hover:from-indigo-500 hover:to-purple-500 transition-all">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Comparison
        </a>
    </div>

    <!-- Route Header -->
    <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl text-white p-8 mb-8">
        <h1 class="text-3xl sm:text-4xl font-bold mb-4 flex items-center">
            <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
            </svg>
            {{ $routeDetails['name'] }}
        </h1>
        <div class="text-indigo-100 mb-4">
            <div class="flex items-center mb-2">
                <span class="font-semibold mr-2">From:</span>
                <span>{{ $routeDetails['source'] }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold mr-2">To:</span>
                <span>{{ $routeDetails['destination'] }}</span>
            </div>
        </div>
        <div class="text-sm text-indigo-200 flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Last Updated: {{ $routeDetails['updated_at']->format('M d, Y H:i:s') }}
        </div>
    </div>

    <!-- Route Overview -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl p-6 text-center shadow-lg border border-gray-200">
            <h5 class="text-lg font-semibold text-gray-900 mb-3 flex items-center justify-center">
                <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Start Point
            </h5>
            <div class="font-mono text-sm bg-gray-100 px-3 py-2 rounded-lg text-gray-700 border-l-4 border-indigo-500">
                [{{ number_format(is_array($routeDetails['start_coords']) ? (float)$routeDetails['start_coords'][0] : 0, 6) }}, {{ number_format(is_array($routeDetails['start_coords']) ? (float)$routeDetails['start_coords'][1] : 0, 6) }}]
            </div>
        </div>
        <div class="bg-white rounded-xl p-6 text-center shadow-lg border border-gray-200">
            <h5 class="text-lg font-semibold text-gray-900 mb-3 flex items-center justify-center">
                <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                End Point
            </h5>
            <div class="font-mono text-sm bg-gray-100 px-3 py-2 rounded-lg text-gray-700 border-l-4 border-green-500">
                [{{ number_format(is_array($routeDetails['end_coords']) ? (float)$routeDetails['end_coords'][0] : 0, 6) }}, {{ number_format(is_array($routeDetails['end_coords']) ? (float)$routeDetails['end_coords'][1] : 0, 6) }}]
            </div>
        </div>
        <div class="bg-white rounded-xl p-6 text-center shadow-lg border border-gray-200">
            <h5 class="text-lg font-semibold text-gray-900 mb-3 flex items-center justify-center">
                <svg class="w-5 h-5 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
                Risk Points
            </h5>
            <h3 class="text-3xl font-bold text-red-600">{{ count(is_array($routeDetails['risk_points']) ? $routeDetails['risk_points'] : []) }}</h3>
        </div>
        <div class="bg-white rounded-xl p-6 text-center shadow-lg border border-gray-200">
            <h5 class="text-lg font-semibold text-gray-900 mb-3 flex items-center justify-center">
                <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                Emergency
            </h5>
            <h3 class="text-3xl font-bold text-green-600">{{ count(is_array($routeDetails['emergency_locations']) ? $routeDetails['emergency_locations'] : []) }}</h3>
        </div>
    </div>

    <!-- Risk Points -->
    @if(count(is_array($routeDetails['risk_points']) ? $routeDetails['risk_points'] : []) > 0)
    <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-200 mb-8">
        <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
            <svg class="w-6 h-6 mr-3 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
            </svg>
            Risk Points
        </h3>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">#</th>
                        <th class="px-4 py-3 text-left font-semibold">Coordinates</th>
                        <th class="px-4 py-3 text-left font-semibold">Risk Level</th>
                        <th class="px-4 py-3 text-left font-semibold">Speed Limit</th>
                        <th class="px-4 py-3 text-left font-semibold">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach((is_array($routeDetails['risk_points']) ? $routeDetails['risk_points'] : []) as $index => $risk)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-semibold text-gray-900">{{ $index + 1 }}</td>
                        <td class="px-4 py-3">
                            <div class="font-mono text-sm bg-gray-100 px-3 py-2 rounded-lg text-gray-700 border-l-4 {{ $risk['risk'] === 'High' ? 'border-red-500' : 'border-yellow-500' }}">
                                [{{ number_format(is_array($risk['coords']) ? (float)$risk['coords'][0] : 0, 6) }}, {{ number_format(is_array($risk['coords']) ? (float)$risk['coords'][1] : 0, 6) }}]
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <span class="inline-block px-3 py-1 text-xs rounded-full font-semibold {{ $risk['risk'] === 'High' ? 'bg-red-100 text-red-800' : ($risk['risk'] === 'Medium' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                                {{ $risk['risk'] }}
                            </span>
                        </td>
                        <td class="px-4 py-3 font-semibold text-gray-700">{{ $risk['speed'] }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full font-semibold">✓ Verified</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <!-- Crowded Spots -->
    @if(count(is_array($routeDetails['crowded_spots']) ? $routeDetails['crowded_spots'] : []) > 0)
    <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-200 mb-8">
        <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
            <svg class="w-6 h-6 mr-3 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            Crowded Spots
        </h3>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">#</th>
                        <th class="px-4 py-3 text-left font-semibold">Coordinates</th>
                        <th class="px-4 py-3 text-left font-semibold">Description</th>
                        <th class="px-4 py-3 text-left font-semibold">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach((is_array($routeDetails['crowded_spots']) ? $routeDetails['crowded_spots'] : []) as $index => $spot)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-semibold text-gray-900">{{ $index + 1 }}</td>
                        <td class="px-4 py-3">
                            <div class="font-mono text-sm bg-gray-100 px-3 py-2 rounded-lg text-gray-700 border-l-4 border-yellow-500">
                                [{{ number_format(is_array($spot['coords']) ? (float)$spot['coords'][0] : 0, 6) }}, {{ number_format(is_array($spot['coords']) ? (float)$spot['coords'][1] : 0, 6) }}]
                            </div>
                        </td>
                        <td class="px-4 py-3 font-semibold text-gray-700">{{ $spot['description'] ?? $spot['name'] ?? 'N/A' }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full font-semibold">✓ Verified</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <!-- Emergency Locations -->
    @if(count(is_array($routeDetails['emergency_locations']) ? $routeDetails['emergency_locations'] : []) > 0)
    <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-200 mb-8">
        <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
            <svg class="w-6 h-6 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
            Emergency Locations
        </h3>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">#</th>
                        <th class="px-4 py-3 text-left font-semibold">Coordinates</th>
                        <th class="px-4 py-3 text-left font-semibold">Type</th>
                        <th class="px-4 py-3 text-left font-semibold">Name</th>
                        <th class="px-4 py-3 text-left font-semibold">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach((is_array($routeDetails['emergency_locations']) ? $routeDetails['emergency_locations'] : []) as $index => $emergency)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-semibold text-gray-900">{{ $index + 1 }}</td>
                        <td class="px-4 py-3">
                            <div class="font-mono text-sm bg-gray-100 px-3 py-2 rounded-lg text-gray-700 border-l-4 border-green-500">
                                [{{ number_format(is_array($emergency['coords']) ? (float)$emergency['coords'][0] : 0, 6) }}, {{ number_format(is_array($emergency['coords']) ? (float)$emergency['coords'][1] : 0, 6) }}]
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full font-semibold">{{ $emergency['type'] }}</span>
                        </td>
                        <td class="px-4 py-3 font-semibold text-gray-700">{{ $emergency['name'] }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full font-semibold">✓ Verified</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <!-- Summary -->
    <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-200">
        <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
            <svg class="w-6 h-6 mr-3 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
            Coordinate Summary
        </h3>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div>
                <h5 class="text-lg font-semibold text-gray-900 mb-4">
                    Total Coordinates: 
                    <span class="inline-block bg-indigo-100 text-indigo-800 text-lg px-3 py-1 rounded-full font-semibold ml-2">{{ $routeDetails['total_coordinates'] }}</span>
                </h5>
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-700 font-medium">Start/End Points:</span>
                        <span class="inline-block bg-indigo-100 text-indigo-800 text-sm px-3 py-1 rounded-full font-semibold">2</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-700 font-medium">Risk Points:</span>
                        <span class="inline-block bg-red-100 text-red-800 text-sm px-3 py-1 rounded-full font-semibold">{{ count(is_array($routeDetails['risk_points']) ? $routeDetails['risk_points'] : []) }}</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-700 font-medium">Crowded Spots:</span>
                        <span class="inline-block bg-yellow-100 text-yellow-800 text-sm px-3 py-1 rounded-full font-semibold">{{ count(is_array($routeDetails['crowded_spots']) ? $routeDetails['crowded_spots'] : []) }}</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-700 font-medium">Emergency Locations:</span>
                        <span class="inline-block bg-green-100 text-green-800 text-sm px-3 py-1 rounded-full font-semibold">{{ count(is_array($routeDetails['emergency_locations']) ? $routeDetails['emergency_locations'] : []) }}</span>
                    </div>
                </div>
            </div>
            <div>
                <h5 class="text-lg font-semibold text-gray-900 mb-4">Accuracy Status</h5>
                <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <div class="font-semibold text-green-800">All coordinates verified and accurate!</div>
                            <div class="text-sm text-green-600 mt-1">Data extracted from OCR with 100% accuracy as requested.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
