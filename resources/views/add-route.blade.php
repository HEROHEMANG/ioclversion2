@extends('layouts.app')

@section('title', 'Add New Route')

@section('content')
<section class="relative overflow-hidden bg-gradient-to-br from-blue-50 to-indigo-100">
	<div class="absolute inset-0 -z-10 opacity-30">
		<div class="absolute -top-24 -left-24 h-72 w-72 rounded-full bg-blue-400 blur-3xl"></div>
		<div class="absolute -bottom-24 -right-24 h-72 w-72 rounded-full bg-indigo-400 blur-3xl"></div>
	</div>
	<div class="text-center py-8 sm:py-12 lg:py-16 px-4">
		<h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold tracking-tight text-gray-900">Add New Route</h1>
		<p class="mt-4 text-sm sm:text-base lg:text-lg text-gray-600 max-w-2xl mx-auto px-4">Create a new route by filling the form or pasting JSON data</p>
	</div>
</section>

<div class="mt-10 space-y-6 bg-white">
	<div class="flex justify-center">
		<div class="w-full max-w-4xl space-y-6">
			<!-- Tab Navigation -->
			<div class="bg-white rounded-xl p-1 border border-gray-200 shadow-lg flex gap-2">
				<button id="tabForm" class="flex-1 px-4 py-3 rounded-lg font-semibold text-gray-700 bg-indigo-50 border border-indigo-200 transition-all">
					Form Entry
				</button>
				<button id="tabJson" class="flex-1 px-4 py-3 rounded-lg font-semibold text-gray-700 hover:bg-gray-50 transition-all">
					JSON Paste
				</button>
			</div>

			<!-- Form Entry Tab -->
			<div id="formTab" class="bg-white rounded-xl p-4 sm:p-6 border border-gray-200 shadow-lg">
				<form id="routeForm">
					<div class="space-y-6">
						<!-- Basic Information -->
						<div class="border-b border-gray-200 pb-6">
							<h3 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h3>
							<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Route Name <span class="text-red-500">*</span></label>
									<input type="text" id="routeName" name="name" required class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
								</div>
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Source Terminal <span class="text-red-500">*</span></label>
									<input type="text" id="source" name="source" required class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
								</div>
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Destination <span class="text-red-500">*</span></label>
									<input type="text" id="destination" name="destination" required class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
								</div>
							</div>
						</div>

						<!-- Coordinates Section -->
						<div class="border-b border-gray-200 pb-6">
							<h3 class="text-lg font-semibold text-gray-900 mb-4">Coordinates</h3>
							<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
								<div class="space-y-3">
									<h4 class="text-sm font-medium text-gray-700">Start Coordinates <span class="text-red-500">*</span></h4>
									<div class="grid grid-cols-2 gap-3">
										<div>
											<label class="block text-xs text-gray-600 mb-1">Latitude</label>
											<input type="number" step="any" id="startLat" required class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
										</div>
										<div>
											<label class="block text-xs text-gray-600 mb-1">Longitude</label>
											<input type="number" step="any" id="startLng" required class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
										</div>
									</div>
								</div>
								<div class="space-y-3">
									<h4 class="text-sm font-medium text-gray-700">End Coordinates <span class="text-red-500">*</span></h4>
									<div class="grid grid-cols-2 gap-3">
										<div>
											<label class="block text-xs text-gray-600 mb-1">Latitude</label>
											<input type="number" step="any" id="endLat" required class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
										</div>
										<div>
											<label class="block text-xs text-gray-600 mb-1">Longitude</label>
											<input type="number" step="any" id="endLng" required class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Risk Points Section (Optional) -->
						<div class="border-b border-gray-200 pb-6">
							<div class="flex items-center justify-between mb-4">
								<h3 class="text-lg font-semibold text-gray-900">Risk Points <span class="text-xs font-normal text-gray-500">(Optional)</span></h3>
								<button type="button" onclick="addRiskPoint()" class="px-3 py-1 text-sm bg-indigo-100 text-indigo-700 rounded-lg hover:bg-indigo-200 transition-colors">
									+ Add Risk Point
								</button>
							</div>
							<div id="riskPointsContainer" class="space-y-3">
								<!-- Risk points will be added here dynamically -->
							</div>
						</div>

						<!-- Crowded Spots Section (Optional) -->
						<div class="border-b border-gray-200 pb-6">
							<div class="flex items-center justify-between mb-4">
								<h3 class="text-lg font-semibold text-gray-900">Crowded Spots <span class="text-xs font-normal text-gray-500">(Optional)</span></h3>
								<button type="button" onclick="addCrowdedSpot()" class="px-3 py-1 text-sm bg-indigo-100 text-indigo-700 rounded-lg hover:bg-indigo-200 transition-colors">
									+ Add Crowded Spot
								</button>
							</div>
							<div id="crowdedSpotsContainer" class="space-y-3">
								<!-- Crowded spots will be added here dynamically -->
							</div>
						</div>

						<!-- Emergency Locations Section (Optional) -->
						<div class="pb-6">
							<div class="flex items-center justify-between mb-4">
								<h3 class="text-lg font-semibold text-gray-900">Emergency Locations <span class="text-xs font-normal text-gray-500">(Optional)</span></h3>
								<button type="button" onclick="addEmergencyLocation()" class="px-3 py-1 text-sm bg-indigo-100 text-indigo-700 rounded-lg hover:bg-indigo-200 transition-colors">
									+ Add Emergency Location
								</button>
							</div>
							<div id="emergencyLocationsContainer" class="space-y-3">
								<!-- Emergency locations will be added here dynamically -->
							</div>
						</div>

						<!-- Submit Button -->
						<div class="flex justify-end gap-3 pt-4">
							<a href="{{ url('/') }}" class="px-6 py-3 text-sm font-semibold text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
								Cancel
							</a>
							<button type="submit" class="px-6 py-3 text-sm font-semibold text-white bg-gradient-to-r from-indigo-600 to-indigo-700 rounded-lg hover:from-indigo-500 hover:to-indigo-600 transition-all shadow-lg hover:shadow-xl">
								Add Route
							</button>
						</div>
					</div>
				</form>
			</div>

			<!-- JSON Paste Tab -->
			<div id="jsonTab" class="bg-white rounded-xl p-4 sm:p-6 border border-gray-200 shadow-lg hidden">
				<div class="mb-4">
					<h3 class="text-lg font-semibold text-gray-900 mb-2">Paste JSON Data</h3>
					<p class="text-sm text-gray-600 mb-4">Paste the complete route JSON data below. Make sure the JSON is properly formatted.</p>
					<div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 mb-4">
						<p class="text-xs text-yellow-800">
							<strong>Example Format:</strong><br>
							{<br>
							&nbsp;&nbsp;"name": "ROUTE NAME",<br>
							&nbsp;&nbsp;"source": "Rajbandh Terminal",<br>
							&nbsp;&nbsp;"destination": "DESTINATION NAME",<br>
							&nbsp;&nbsp;"start_coords": [23.4764, 87.3975],<br>
							&nbsp;&nbsp;"end_coords": [23.166678, 87.069098],<br>
							&nbsp;&nbsp;"risk_points": [...],<br>
							&nbsp;&nbsp;"crowded_spots": [...],<br>
							&nbsp;&nbsp;"emergency_locations": [...]<br>
							}
						</p>
					</div>
				</div>
				<form id="jsonForm">
					<textarea id="jsonData" rows="20" class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 font-mono focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Paste your JSON data here..."></textarea>
					<div class="flex justify-end gap-3 mt-4">
						<a href="{{ url('/') }}" class="px-6 py-3 text-sm font-semibold text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
							Cancel
						</a>
						<button type="submit" class="px-6 py-3 text-sm font-semibold text-white bg-gradient-to-r from-indigo-600 to-indigo-700 rounded-lg hover:from-indigo-500 hover:to-indigo-600 transition-all shadow-lg hover:shadow-xl">
							Add Route from JSON
						</button>
					</div>
				</form>
			</div>

			<!-- Success/Error Messages -->
			<div id="messageContainer" class="hidden"></div>
		</div>
	</div>
</div>

<script>
	let riskPointCount = 0;
	let crowdedSpotCount = 0;
	let emergencyLocationCount = 0;

	// Tab switching
	document.getElementById('tabForm').addEventListener('click', () => {
		document.getElementById('formTab').classList.remove('hidden');
		document.getElementById('jsonTab').classList.add('hidden');
		document.getElementById('tabForm').classList.add('bg-indigo-50', 'border', 'border-indigo-200');
		document.getElementById('tabForm').classList.remove('hover:bg-gray-50');
		document.getElementById('tabJson').classList.remove('bg-indigo-50', 'border', 'border-indigo-200');
		document.getElementById('tabJson').classList.add('hover:bg-gray-50');
	});

	document.getElementById('tabJson').addEventListener('click', () => {
		document.getElementById('jsonTab').classList.remove('hidden');
		document.getElementById('formTab').classList.add('hidden');
		document.getElementById('tabJson').classList.add('bg-indigo-50', 'border', 'border-indigo-200');
		document.getElementById('tabJson').classList.remove('hover:bg-gray-50');
		document.getElementById('tabForm').classList.remove('bg-indigo-50', 'border', 'border-indigo-200');
		document.getElementById('tabForm').classList.add('hover:bg-gray-50');
	});

	// Form submission
	document.getElementById('routeForm').addEventListener('submit', async (e) => {
		e.preventDefault();
		
		const formData = {
			name: document.getElementById('routeName').value,
			source: document.getElementById('source').value,
			destination: document.getElementById('destination').value,
			start_coords: [
				parseFloat(document.getElementById('startLat').value),
				parseFloat(document.getElementById('startLng').value)
			],
			end_coords: [
				parseFloat(document.getElementById('endLat').value),
				parseFloat(document.getElementById('endLng').value)
			],
			risk_points: getRiskPoints(),
			crowded_spots: getCrowdedSpots(),
			emergency_locations: getEmergencyLocations()
		};

		await submitRoute(formData);
	});

	// JSON form submission
	document.getElementById('jsonForm').addEventListener('submit', async (e) => {
		e.preventDefault();
		
		const jsonText = document.getElementById('jsonData').value.trim();
		
		try {
			const formData = JSON.parse(jsonText);
			await submitRoute(formData);
		} catch (error) {
			showMessage('Invalid JSON format. Please check your data.', 'error');
		}
	});

	async function submitRoute(formData) {
		try {
			const response = await fetch('/api/routes', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
					'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
					'Accept': 'application/json'
				},
				body: JSON.stringify(formData)
			});

			const data = await response.json();

			if (response.ok) {
				showMessage('Route added successfully! Redirecting to home...', 'success');
				setTimeout(() => {
					window.location.href = '/';
				}, 2000);
			} else {
				showMessage(data.message || 'Error adding route. Please try again.', 'error');
			}
		} catch (error) {
			showMessage('Network error. Please try again.', 'error');
			console.error('Error:', error);
		}
	}

	function showMessage(message, type) {
		const container = document.getElementById('messageContainer');
		container.className = type === 'success' 
			? 'bg-green-50 border border-green-200 rounded-lg p-4' 
			: 'bg-red-50 border border-red-200 rounded-lg p-4';
		container.innerHTML = `<p class="text-sm ${type === 'success' ? 'text-green-800' : 'text-red-800'}">${message}</p>`;
		container.classList.remove('hidden');
		container.scrollIntoView({ behavior: 'smooth', block: 'center' });
	}

	// Risk Point Functions
	function addRiskPoint() {
		const container = document.getElementById('riskPointsContainer');
		const div = document.createElement('div');
		div.className = 'border border-gray-200 rounded-lg p-3 bg-gray-50';
		div.innerHTML = `
			<div class="grid grid-cols-1 md:grid-cols-4 gap-3">
				<div>
					<label class="block text-xs text-gray-600 mb-1">Latitude</label>
					<input type="number" step="any" class="risk-lat w-full rounded-lg border border-gray-300 bg-white px-2 py-1 text-xs" placeholder="23.4764">
				</div>
				<div>
					<label class="block text-xs text-gray-600 mb-1">Longitude</label>
					<input type="number" step="any" class="risk-lng w-full rounded-lg border border-gray-300 bg-white px-2 py-1 text-xs" placeholder="87.3975">
				</div>
				<div>
					<label class="block text-xs text-gray-600 mb-1">Risk Level</label>
					<input type="text" class="risk-level w-full rounded-lg border border-gray-300 bg-white px-2 py-1 text-xs" placeholder="High/Medium/Low">
				</div>
				<div class="flex items-end">
					<button type="button" onclick="this.parentElement.parentElement.parentElement.remove()" class="w-full px-3 py-1 text-xs bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors">
						Remove
					</button>
				</div>
			</div>
		`;
		container.appendChild(div);
		riskPointCount++;
	}

	function getRiskPoints() {
		const points = [];
		const containers = document.querySelectorAll('#riskPointsContainer > div');
		containers.forEach(container => {
			const lat = container.querySelector('.risk-lat').value;
			const lng = container.querySelector('.risk-lng').value;
			const risk = container.querySelector('.risk-level').value;
			
			if (lat && lng && risk) {
				points.push({
					coords: [parseFloat(lat), parseFloat(lng)],
					risk: risk,
					speed: '30 KM/Hr'
				});
			}
		});
		return points;
	}

	// Crowded Spot Functions
	function addCrowdedSpot() {
		const container = document.getElementById('crowdedSpotsContainer');
		const div = document.createElement('div');
		div.className = 'border border-gray-200 rounded-lg p-3 bg-gray-50';
		div.innerHTML = `
			<div class="grid grid-cols-1 md:grid-cols-6 gap-3">
				<div>
					<label class="block text-xs text-gray-600 mb-1">Latitude</label>
					<input type="number" step="any" class="crowded-lat w-full rounded-lg border border-gray-300 bg-white px-2 py-1 text-xs" placeholder="23.4764">
				</div>
				<div>
					<label class="block text-xs text-gray-600 mb-1">Longitude</label>
					<input type="number" step="any" class="crowded-lng w-full rounded-lg border border-gray-300 bg-white px-2 py-1 text-xs" placeholder="87.3975">
				</div>
				<div>
					<label class="block text-xs text-gray-600 mb-1">Type</label>
					<input type="text" class="crowded-type w-full rounded-lg border border-gray-300 bg-white px-2 py-1 text-xs" placeholder="school">
				</div>
				<div class="md:col-span-2">
					<label class="block text-xs text-gray-600 mb-1">Name</label>
					<input type="text" class="crowded-name w-full rounded-lg border border-gray-300 bg-white px-2 py-1 text-xs" placeholder="Location name">
				</div>
				<div class="flex items-end">
					<button type="button" onclick="this.parentElement.parentElement.parentElement.remove()" class="w-full px-3 py-1 text-xs bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors">
						Remove
					</button>
				</div>
			</div>
		`;
		container.appendChild(div);
		crowdedSpotCount++;
	}

	function getCrowdedSpots() {
		const spots = [];
		const containers = document.querySelectorAll('#crowdedSpotsContainer > div');
		containers.forEach(container => {
			const lat = container.querySelector('.crowded-lat').value;
			const lng = container.querySelector('.crowded-lng').value;
			const type = container.querySelector('.crowded-type').value;
			const name = container.querySelector('.crowded-name').value;
			
			if (lat && lng && name) {
				spots.push({
					coords: [parseFloat(lat), parseFloat(lng)],
					type: type || 'school',
					name: name,
					speed: '30 km/h',
					risk: 'Medium'
				});
			}
		});
		return spots;
	}

	// Emergency Location Functions
	function addEmergencyLocation() {
		const container = document.getElementById('emergencyLocationsContainer');
		const div = document.createElement('div');
		div.className = 'border border-gray-200 rounded-lg p-3 bg-gray-50';
		div.innerHTML = `
			<div class="grid grid-cols-1 md:grid-cols-6 gap-3">
				<div>
					<label class="block text-xs text-gray-600 mb-1">Latitude</label>
					<input type="number" step="any" class="emergency-lat w-full rounded-lg border border-gray-300 bg-white px-2 py-1 text-xs" placeholder="23.4764">
				</div>
				<div>
					<label class="block text-xs text-gray-600 mb-1">Longitude</label>
					<input type="number" step="any" class="emergency-lng w-full rounded-lg border border-gray-300 bg-white px-2 py-1 text-xs" placeholder="87.3975">
				</div>
				<div>
					<label class="block text-xs text-gray-600 mb-1">Type</label>
					<input type="text" class="emergency-type w-full rounded-lg border border-gray-300 bg-white px-2 py-1 text-xs" placeholder="hospital">
				</div>
				<div class="md:col-span-2">
					<label class="block text-xs text-gray-600 mb-1">Name</label>
					<input type="text" class="emergency-name w-full rounded-lg border border-gray-300 bg-white px-2 py-1 text-xs" placeholder="Location name">
				</div>
				<div class="flex items-end">
					<button type="button" onclick="this.parentElement.parentElement.parentElement.remove()" class="w-full px-3 py-1 text-xs bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors">
						Remove
					</button>
				</div>
			</div>
		`;
		container.appendChild(div);
		emergencyLocationCount++;
	}

	function getEmergencyLocations() {
		const locations = [];
		const containers = document.querySelectorAll('#emergencyLocationsContainer > div');
		containers.forEach(container => {
			const lat = container.querySelector('.emergency-lat').value;
			const lng = container.querySelector('.emergency-lng').value;
			const type = container.querySelector('.emergency-type').value;
			const name = container.querySelector('.emergency-name').value;
			
			if (lat && lng && name) {
				locations.push({
					coords: [parseFloat(lat), parseFloat(lng)],
					type: type || 'hospital',
					name: name,
					speed: '30 km/h',
					risk: 'Medium'
				});
			}
		});
		return locations;
	}
</script>
@endsection

