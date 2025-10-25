@extends('layouts.app')

@section('title', 'Sristi Filling Station Route')

@section('content')
	<!-- Hero Section -->
	<div class="relative overflow-hidden bg-gradient-to-br from-orange-50 via-white to-red-50 rounded-3xl p-12 mb-12">
		<div class="absolute inset-0 bg-gradient-to-r from-orange-500/5 to-red-500/5"></div>
		<div class="relative text-center">
			<h1 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-6">Sristi Filling Station Route</h1>
			<p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">Comprehensive route analysis with risk assessment, emergency locations, and crowded spots data.</p>
		</div>
		<!-- Decorative elements -->
		<div class="absolute -top-10 -left-10 w-20 h-20 bg-orange-500/10 rounded-full blur-xl"></div>
		<div class="absolute -bottom-10 -right-10 w-32 h-32 bg-red-500/10 rounded-full blur-xl"></div>
	</div>

	@if(!empty($routeData))
		<!-- Route Overview -->
		@if(isset($routeData[0]))
			<div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100 mb-8">
				<h2 class="text-2xl font-bold text-gray-900 mb-6">Route Overview</h2>
				<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
					<div class="text-center p-4 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl">
						<div class="text-3xl font-bold text-blue-600">{{ $routeData[0]['total_distance_km'] ?? 'N/A' }}</div>
						<div class="text-sm text-gray-600">Total Distance (KM)</div>
					</div>
					<div class="text-center p-4 bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl">
						<div class="text-3xl font-bold text-green-600">{{ $routeData[0]['estimated_duration_hours'] ?? 'N/A' }}</div>
						<div class="text-sm text-gray-600">Duration (Hours)</div>
					</div>
					<div class="text-center p-4 bg-gradient-to-br from-orange-50 to-yellow-50 rounded-xl">
						<div class="text-3xl font-bold text-orange-600">{{ $routeData[0]['adjusted_duration_heavy_vehicle_hours'] ?? 'N/A' }}</div>
						<div class="text-sm text-gray-600">Heavy Vehicle Duration</div>
					</div>
					<div class="text-center p-4 bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl">
						<div class="text-lg font-bold text-purple-600">{{ $routeData[0]['start_latitude'] ?? 'N/A' }}, {{ $routeData[0]['start_longitude'] ?? 'N/A' }}</div>
						<div class="text-sm text-gray-600">Start Coordinates</div>
					</div>
				</div>
			</div>
		@endif

		<!-- Risk Points -->
		@if(isset($routeData[1]))
			<div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100 mb-8">
				<h2 class="text-2xl font-bold text-gray-900 mb-6">Risk Assessment Points</h2>
				<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
					@php
						$riskData = $routeData[1];
						$riskPoints = [];
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
					@endphp
					
					@foreach($riskPoints as $index => $point)
						<div class="border border-gray-200 rounded-xl p-4 hover:shadow-md transition-shadow">
							<div class="flex items-center justify-between mb-2">
								<span class="px-3 py-1 rounded-full text-xs font-semibold 
									@if(($point['risk_level'] ?? '') === 'High') bg-red-100 text-red-800
									@elseif(($point['risk_level'] ?? '') === 'Medium') bg-yellow-100 text-yellow-800
									@else bg-gray-100 text-gray-800 @endif">
									{{ $point['risk_level'] ?? 'Unknown' }}
								</span>
								<span class="text-sm text-gray-500">{{ $point['risk_type'] ?? 'N/A' }}</span>
							</div>
							<div class="text-sm text-gray-600 mb-2">
								<strong>Speed Limit:</strong> {{ $point['speed_limit'] ?? 'N/A' }}
							</div>
							<div class="text-xs text-gray-500">
								<strong>Coordinates:</strong> {{ $point['coordinates'] ?? 'N/A' }}
							</div>
						</div>
					@endforeach
				</div>
			</div>
		@endif

		<!-- Emergency Locations -->
		@if(isset($routeData[2]))
			<div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100 mb-8">
				<h2 class="text-2xl font-bold text-gray-900 mb-6">Emergency Locations</h2>
				<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
					@php
						$emergencyData = $routeData[2];
						$emergencyLocations = [];
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
					@endphp
					
					@foreach($emergencyLocations as $index => $location)
						<div class="border border-gray-200 rounded-xl p-6 hover:shadow-md transition-shadow">
							<div class="flex items-start space-x-4">
								<div class="w-12 h-12 bg-gradient-to-br from-red-500 to-pink-600 rounded-xl flex items-center justify-center flex-shrink-0">
									@if(($location['type'] ?? '') === 'hospital')
										<span class="text-white text-xl">🏥</span>
									@elseif(($location['type'] ?? '') === 'pharmacy')
										<span class="text-white text-xl">💊</span>
									@elseif(($location['type'] ?? '') === 'police')
										<span class="text-white text-xl">👮</span>
									@else
										<span class="text-white text-xl">📍</span>
									@endif
								</div>
								<div class="flex-1">
									<h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $location['name'] ?? 'Unknown Location' }}</h3>
									<div class="space-y-1 text-sm text-gray-600">
										<div><strong>Type:</strong> {{ ucfirst($location['type'] ?? 'N/A') }}</div>
										<div><strong>Speed Limit:</strong> {{ $location['speed_limit'] ?? 'N/A' }}</div>
										<div><strong>Risk Level:</strong> {{ $location['risk_level'] ?? 'N/A' }}</div>
										<div><strong>Coordinates:</strong> {{ $location['coordinates'] ?? 'N/A' }}</div>
									</div>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		@endif

		<!-- Crowded Spots -->
		@if(isset($routeData[3]))
			<div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100 mb-8">
				<h2 class="text-2xl font-bold text-gray-900 mb-6">Crowded Spots</h2>
				<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
					@php
						$crowdedData = $routeData[3];
						$crowdedSpots = [];
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
					@endphp
					
					@foreach($crowdedSpots as $index => $spot)
						<div class="border border-gray-200 rounded-xl p-6 hover:shadow-md transition-shadow">
							<div class="flex items-start space-x-4">
								<div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center flex-shrink-0">
									@if(($spot['type'] ?? '') === 'school')
										<span class="text-white text-xl">🏫</span>
									@elseif(($spot['type'] ?? '') === 'college')
										<span class="text-white text-xl">🎓</span>
									@else
										<span class="text-white text-xl">👥</span>
									@endif
								</div>
								<div class="flex-1">
									<h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $spot['name'] ?? 'Unknown Location' }}</h3>
									<div class="space-y-1 text-sm text-gray-600">
										<div><strong>Type:</strong> {{ ucfirst($spot['type'] ?? 'N/A') }}</div>
										<div><strong>Speed Limit:</strong> {{ $spot['speed_limit'] ?? 'N/A' }}</div>
										<div><strong>Risk Level:</strong> {{ $spot['risk_level'] ?? 'N/A' }}</div>
										<div><strong>Coordinates:</strong> {{ $spot['coordinates'] ?? 'N/A' }}</div>
									</div>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		@endif

	@else
		<div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100 text-center">
			<h2 class="text-2xl font-bold text-gray-900 mb-4">No Route Data Available</h2>
			<p class="text-gray-600">The route data file could not be loaded or is empty.</p>
		</div>
	@endif
@endsection
