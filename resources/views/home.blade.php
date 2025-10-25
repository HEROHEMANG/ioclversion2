@extends('layouts.app')

@section('title', 'Home')

@section('content')
	<section class="relative overflow-hidden bg-gradient-to-br from-blue-50 to-indigo-100">
		<div class="absolute inset-0 -z-10 opacity-30">
			<div class="absolute -top-24 -left-24 h-72 w-72 rounded-full bg-blue-400 blur-3xl"></div>
			<div class="absolute -bottom-24 -right-24 h-72 w-72 rounded-full bg-indigo-400 blur-3xl"></div>
		</div>
		<div class="text-center py-8 sm:py-12 lg:py-16 px-4">
			<h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-extrabold tracking-tight text-gray-900 flex flex-col sm:flex-row items-center justify-center gap-2 sm:gap-4">
				<img src="{{ asset('images/iocl.png') }}" alt="IOCL Logo" class="w-16 sm:w-20 md:w-24 lg:w-32 xl:w-40 logo-img">
				<span class="text-center">Journey Risk Management</span>
			</h1>
			<p class="mt-4 text-sm sm:text-base lg:text-lg text-gray-600 max-w-2xl mx-auto px-4">Select a source terminal and destination, then click View Destination to draw the route.</p>
		</div>
	</section>

	<div class="mt-10 space-y-6 bg-white">
		<div class="flex justify-center">
			<div class="w-full max-w-xl space-y-6">
				<div class="bg-white rounded-xl p-4 sm:p-6 border border-gray-200 shadow-lg">
					<h3 class="text-base sm:text-lg font-semibold text-gray-900 mb-4">Route Configuration</h3>
					<div class="flex flex-col sm:flex-row gap-4">
						<div class="flex-1">
							<label class="block text-sm font-medium text-gray-700 mb-2">Select Terminal</label>
							<select id="terminalSelect" class="w-full rounded-lg border border-gray-300 bg-white px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
								<option value="" class="bg-white text-gray-900">Select Terminal...</option>
							</select>
						</div>
						<div class="flex-1">
							<label class="flex items-center gap-2 text-sm font-medium text-gray-700 mb-2">
								<span>Select Destination</span>
								<span class="text-xs text-gray-500">(Required)</span>
							</label>
							<select id="destinationSelect" class="w-full rounded-lg border border-gray-300 bg-white px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
								<option value="" class="bg-white text-gray-900">Select Destination...</option>
							</select>
						</div>
					</div>
				</div>
				
				<div id="mapControlInfo" class="bg-white rounded-xl p-4 sm:p-6 border border-gray-200 shadow-lg hidden">
					<h3 class="text-base sm:text-lg font-semibold text-gray-900 mb-4">Map Controls</h3>
					<div class="flex flex-col sm:flex-row gap-3">
						<button id="viewBtn" class="w-full inline-flex items-center justify-center rounded-lg bg-gradient-to-r from-indigo-600 to-indigo-700 px-4 sm:px-6 py-2 sm:py-3 text-sm sm:text-base text-white font-semibold shadow-lg hover:shadow-xl hover:from-indigo-500 hover:to-indigo-600 transition-all transform hover:-translate-y-0.5">
							<svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
							</svg>
							View Destination
						</button>
						<button id="clearBtn" class="w-full inline-flex items-center justify-center rounded-lg bg-gray-100 px-4 sm:px-6 py-2 sm:py-3 text-sm sm:text-base text-gray-700 font-semibold border border-gray-300 hover:bg-gray-200 hover:border-gray-400 transition-all transform hover:-translate-y-0.5">
							<svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
							</svg>
							Clear View
						</button>
					</div>
				</div>
				
				<div id="routeInfo" class="bg-white rounded-xl p-4 sm:p-6 border border-gray-200 shadow-lg hidden">
					<h3 class="text-base sm:text-lg font-semibold text-gray-900 mb-3">Route Info</h3>
					<div class="text-xs sm:text-sm text-gray-600 space-y-2">
						<div class="flex justify-between">
							<span>Total Risk Points:</span>
							<span class="text-indigo-600 font-semibold">42</span>
						</div>
						<div class="flex justify-between">
							<span>High Risk Turns:</span>
							<span class="text-red-600 font-semibold">7</span>
						</div>
						<div class="flex justify-between">
							<span>Medium Risk Turns:</span>
							<span class="text-yellow-600 font-semibold">27</span>
						</div>
						<div class="flex justify-between">
							<span>Crowded Spots:</span>
							<span class="text-blue-600 font-semibold">3</span>
						</div>
						<div class="flex justify-between">
							<span>Emergency Locations:</span>
							<span class="text-purple-600 font-semibold">5</span>
						</div>
					</div>
					<div class="mt-4 pt-4 border-t border-gray-200">
						<div class="text-xs text-gray-500">Reference: <a class="underline hover:text-indigo-600 transition-colors" href="https://jrm-rso.in/" target="_blank" rel="noreferrer">RSO - JRM</a></div>
					</div>
				</div>
			</div>
		</div>
		<!-- 🧭 Dynamic Map Legends -->
<div id="mapLegends" class="bg-white rounded-xl p-4 border border-gray-200 shadow-lg max-w-7xl mx-auto mb-6 hidden">
    <h3 class="text-base sm:text-lg font-semibold text-gray-900 mb-3">Key Legends On Route</h3>
    <div id="legendItems" class="grid grid-cols-1 xs:grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-2 sm:gap-3 text-xs sm:text-sm"></div>
</div>

		<div class="w-full px-4 sm:px-0">
			<div id="map" class="w-full h-64 sm:h-80 md:h-96 lg:h-[520px] rounded-xl overflow-hidden border border-gray-200 shadow-lg"></div>
		</div>
	</div>


	<script>
		// Defer map setup until all external scripts (Leaflet) are loaded
		window.addEventListener('load', function() {
			let map = null;
			let routeControl = null;
			let sourceMarker = null;
			let destMarker = null;

		
			
			// Function to check if both dropdowns are selected
			async function checkDropdowns() {
				const terminal = document.getElementById('terminalSelect').value;
				const destination = document.getElementById('destinationSelect').value;
				const mapControlInfo = document.getElementById('mapControlInfo');
				const routeInfo = document.getElementById('routeInfo');
				
				if (terminal && destination) {
					mapControlInfo.classList.remove('hidden');
					routeInfo.classList.remove('hidden');
					
					// Load route data and update Route Info immediately
					await loadRouteDataAndUpdateInfo(destination);
				} else {
					mapControlInfo.classList.add('hidden');
					routeInfo.classList.add('hidden');
				}
			}

			// Function to load route data and update Route Info
			async function loadRouteDataAndUpdateInfo(routeId) {
				try {
					const routeRes = await fetch(`{{ url('/api/routes') }}/${routeId}`);
					if (!routeRes.ok) {
						console.error('Failed to load route data');
						return;
					}
					const route = await routeRes.json();
					
					const riskPoints = (route.risk_points || []).map(p => ({
						coords: p.coords || p,
						risk: p.risk || 'Medium',
						speed: p.speed || '30 KM/Hr'
					}));
					const crowdedSpots = route.crowded_spots || [];
					const emergencyLocations = route.emergency_locations || [];
					
					// Update Route Info with dynamic values
					updateRouteInfo(riskPoints, crowdedSpots, emergencyLocations);
				} catch (error) {
					console.error('Error loading route data:', error);
				}
			}

			// Add event listeners to dropdowns
			document.getElementById('terminalSelect').addEventListener('change', checkDropdowns);
			document.getElementById('destinationSelect').addEventListener('change', checkDropdowns);

			// Load routes from API and populate dropdowns
			async function loadRoutes() {
				const res = await fetch('{{ url("/api/routes") }}');
				const routes = await res.json();
				const terminalSelect = document.getElementById('terminalSelect');
				const destinationSelect = document.getElementById('destinationSelect');

				const bySource = routes.reduce((acc, r) => {
					const key = r.source || 'Unknown';
					if (!acc[key]) acc[key] = [];
					acc[key].push(r);
					return acc;
				}, {});

				Object.keys(bySource).forEach(src => {
					const opt = document.createElement('option');
					opt.value = src;
					opt.textContent = src;
					terminalSelect.appendChild(opt);
				});

				terminalSelect.addEventListener('change', () => {
					destinationSelect.innerHTML = '<option value="">Select Destination...</option>';
					const selected = terminalSelect.value;
					if (!selected) return;
					(bySource[selected] || []).forEach(r => {
						const opt = document.createElement('option');
						opt.value = r.id;
						opt.textContent = r.destination || r.name;
						destinationSelect.appendChild(opt);
					});
					checkDropdowns();
				});

				checkDropdowns();
			}
			loadRoutes().catch(console.error);

			async function waitForLeafletReady(timeoutMs = 8000) {
				if (window.L) return;
				await new Promise((resolve, reject) => {
					const start = Date.now();
					const timer = setInterval(() => {
						if (window.L) { clearInterval(timer); resolve(); }
						else if (Date.now() - start > timeoutMs) { clearInterval(timer); reject(new Error('Leaflet failed to load')); }
					}, 50);
				});
			}

			async function ensureMapInitialized() {
				if (map) return;
				await waitForLeafletReady().catch(() => { alert('Map library failed to load. Check your internet connection and reload.'); });
				if (!window.L) return;
				map = L.map('map');
				const osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19, attribution: '&copy; OpenStreetMap contributors' });
				osm.addTo(map);
				map.setView([23.2735, 87.0298], 10);
			}

			async function geocode(query) {
				const res = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&limit=1` , { headers: { 'Accept-Language': 'en' }});
				const data = await res.json();
				if (!data || !data.length) return null;
				const { lat, lon, display_name } = data[0];
				return { lat: parseFloat(lat), lon: parseFloat(lon), name: display_name };
			}

			async function viewRoute() {
				await ensureMapInitialized();
				if (!window.L || !map) return;
				
				const terminal = document.getElementById('terminalSelect').value;
				const routeId = document.getElementById('destinationSelect').value;
				
				if (!terminal || !routeId) {
					alert('Please select both terminal and destination');
					return;
				}

				// Load selected route details from API
				const routeRes = await fetch(`/api/routes/${routeId}`);
				if (!routeRes.ok) { alert('Failed to load route'); return; }
				const route = await routeRes.json();

				const startCoords = route.start_coords || [];
				const endCoords = route.end_coords || [];
				const riskPoints = (route.risk_points || []).map(p => ({
					coords: p.coords || p,
					risk: p.risk || 'Medium',
					speed: p.speed || '30 KM/Hr'
				}));
				const crowdedSpots = route.crowded_spots || [];
				const emergencyLocations = route.emergency_locations || [];
				
				// Clear existing markers and route
				if (sourceMarker) { map.removeLayer(sourceMarker); }
				if (destMarker) { map.removeLayer(destMarker); }
				if (routeControl) { map.removeControl(routeControl); routeControl = null; }
				
				// Add start and end markers
				sourceMarker = L.marker(startCoords, { icon: L.divIcon({ className: 'start-marker', html: '🟢', iconSize: [20, 20] }) })
					.addTo(map).bindPopup('Start: (23.4764, 87.3975)');
				destMarker = L.marker(endCoords, { icon: L.divIcon({ className: 'end-marker', html: '🔴', iconSize: [20, 20] }) })
					.addTo(map).bindPopup('End: (23.070605, 86.662136)');
				
				// Add risk assessment markers
				riskPoints.forEach((point, index) => {
					const color = point.risk === 'High' ? '#ef4444' : '#f59e0b';
					const icon = L.divIcon({
						className: 'risk-marker',
						html: `<div style="background: ${color}; color: white; border-radius: 50%; width: 16px; height: 16px; display: flex; align-items: center; justify-content: center; font-size: 10px; font-weight: bold;">${point.risk === 'High' ? 'H' : 'M'}</div>`,
						iconSize: [16, 16]
					});
					
					L.marker(point.coords, { icon: icon })
						.addTo(map)
						.bindPopup(`<b>Risk Assessment - Turn ${index + 1}</b><br>Risk Level: ${point.risk}<br>Speed Limit: ${point.speed}<br>Coordinates: ${point.coords.join(', ')}`);
				});

				// Add crowded spots markers
				crowdedSpots.forEach((spot, index) => {
					const icon = L.divIcon({
						className: 'crowded-spot-marker',
						html: `<div style="background: #3b82f6; color: white; border-radius: 50%; width: 18px; height: 18px; display: flex; align-items: center; justify-content: center; font-size: 10px; font-weight: bold;">${spot.type === 'school' ? 'S' : 'C'}</div>`,
						iconSize: [18, 18]
					});
					
					L.marker(spot.coords, { icon: icon })
						.addTo(map)
						.bindPopup(`<b>Crowded Spot ${index + 1}</b><br>Type: ${spot.type}<br>Name: ${spot.name}<br>Speed Limit: ${spot.speed}<br>Risk: ${spot.risk}<br>Coordinates: ${spot.coords.join(', ')}`);
				});

				// Add emergency locations markers
				emergencyLocations.forEach((location, index) => {
					const icon = L.divIcon({
						className: 'emergency-location-marker',
						html: `<div style="background: #9333ea; color: white; border-radius: 50%; width: 18px; height: 18px; display: flex; align-items: center; justify-content: center; font-size: 10px; font-weight: bold;">${location.type === 'hospital' ? 'H' : 'C'}</div>`,
						iconSize: [18, 18]
					});
					
					L.marker(location.coords, { icon: icon })
						.addTo(map)
						.bindPopup(`<b>Emergency Location ${index + 1}</b><br>Type: ${location.type}<br>Name: ${location.name}<br>Speed Limit: ${location.speed}<br>Risk: ${location.risk}<br>Coordinates: ${location.coords.join(', ')}`);
				});
				
				// Draw the route
				routeControl = L.Routing.control({
					waypoints: [ L.latLng(startCoords[0], startCoords[1]), L.latLng(endCoords[0], endCoords[1]) ],
					lineOptions: { addWaypoints: false, styles: [{ color: '#4f46e5', weight: 5, opacity: 0.85 }] },
					show: false,
					routeWhileDragging: false,
					router: L.Routing.osrmv1({ serviceUrl: 'https://router.project-osrm.org/route/v1' })
				}).addTo(map);
				
				// Fit map to show all points
				const allPoints = [startCoords, endCoords, ...riskPoints.map(p => p.coords), ...crowdedSpots.map(s => s.coords), ...emergencyLocations.map(e => e.coords)];
				map.fitBounds(L.latLngBounds(allPoints), { padding: [30, 30] });
				
				// Update Route Info with dynamic values
				updateRouteInfo(riskPoints, crowdedSpots, emergencyLocations);
				
				updateMapLegends({
    hasStart: true,
    hasEnd: true,
    riskPoints,
    crowdedSpots,
    emergencyLocations
});

			}
			
			function updateRouteInfo(riskPoints, crowdedSpots, emergencyLocations) {
				// Calculate dynamic values
				const totalRiskPoints = riskPoints.length;
				const highRiskTurns = riskPoints.filter(p => p.risk === 'High').length;
				const mediumRiskTurns = riskPoints.filter(p => p.risk === 'Medium').length;
				const totalCrowdedSpots = crowdedSpots.length;
				const totalEmergencyLocations = emergencyLocations.length;
				
				// Update the Route Info section
				const routeInfoElement = document.getElementById('routeInfo');
				if (routeInfoElement) {
					// Update the values
					const indigoElement = routeInfoElement.querySelector('.text-indigo-600');
					const redElement = routeInfoElement.querySelector('.text-red-600');
					const yellowElement = routeInfoElement.querySelector('.text-yellow-600');
					const blueElement = routeInfoElement.querySelector('.text-blue-600');
					const purpleElement = routeInfoElement.querySelector('.text-purple-600');
					
					if (indigoElement) indigoElement.textContent = totalRiskPoints;
					if (redElement) redElement.textContent = highRiskTurns;
					if (yellowElement) yellowElement.textContent = mediumRiskTurns;
					if (blueElement) blueElement.textContent = totalCrowdedSpots;
					if (purpleElement) purpleElement.textContent = totalEmergencyLocations;
				}
			}
			
			function updateMapLegends({ hasStart, hasEnd, riskPoints, crowdedSpots, emergencyLocations }) {
    const legendContainer = document.getElementById('mapLegends');
    const legendItems = document.getElementById('legendItems');
    legendItems.innerHTML = ''; // clear previous items

    const addedTypes = new Set();

    function addLegendItem(type, iconHTML, title, subtitle) {
        if (addedTypes.has(type)) return;
        addedTypes.add(type);

        const item = document.createElement('div');
        item.className = 'flex items-center gap-2 bg-gray-50 p-2 rounded-lg text-xs sm:text-sm';
        item.innerHTML = `
            <div class="text-sm sm:text-lg">${iconHTML}</div>
            <div>
                <div class="font-semibold text-xs sm:text-sm">${title}</div>
                <div class="text-gray-500 text-xs">${subtitle}</div>
            </div>
        `;
        legendItems.appendChild(item);
    }

    if (hasStart) addLegendItem('start', '🟢', 'Start Point', 'प्रारंभ बिंदु');
    if (hasEnd) addLegendItem('end', '🔴', 'End Point', 'अंत बिंदु');

    // Risk points
    if (riskPoints.some(r => r.risk === 'High')) {
        addLegendItem('highRisk', `<div class="w-4 h-4 rounded-full bg-red-500 flex items-center justify-center text-white text-[10px] font-bold">H</div>`, 'High Risk Turn', 'उच्च जोखिम वाला मोड़');
    }
    if (riskPoints.some(r => r.risk === 'Medium')) {
        addLegendItem('mediumRisk', `<div class="w-4 h-4 rounded-full bg-yellow-500 flex items-center justify-center text-white text-[10px] font-bold">M</div>`, 'Medium Risk Turn', 'मध्यम जोखिम मोड़');
    }

    // Crowded spots
    if (crowdedSpots.some(s => s.type === 'school')) {
        addLegendItem('school', `<div class="w-5 h-5 rounded-full bg-blue-500 flex items-center justify-center text-white text-[10px] font-bold">S</div>`, 'School', 'विद्यालय');
    }
    if (crowdedSpots.some(s => s.type === 'college')) {
        addLegendItem('college', `<div class="w-5 h-5 rounded-full bg-blue-500 flex items-center justify-center text-white text-[10px] font-bold">C</div>`, 'College', 'कॉलेज');
    }

    // Emergency locations
    if (emergencyLocations.length > 0) {
        addLegendItem('hospital', `<div class="w-5 h-5 rounded-full bg-purple-600 flex items-center justify-center text-white text-[10px] font-bold">H</div>`, 'Hospital / Clinic', 'अस्पताल');
    }

    // Show or hide legend container
    if (addedTypes.size > 0) {
        legendContainer.classList.remove('hidden');
    } else {
        legendContainer.classList.add('hidden');
    }
}

			
			

			function clearRoute() {
				if (!map) return;
				if (routeControl) { map.removeControl(routeControl); routeControl = null; }
				if (sourceMarker) { map.removeLayer(sourceMarker); sourceMarker = null; }
				if (destMarker) { map.removeLayer(destMarker); destMarker = null; }
				
				// Clear risk markers
				map.eachLayer((layer) => {
					if (layer.options && layer.options.icon && layer.options.icon.options && layer.options.icon.options.className === 'risk-marker') {
						map.removeLayer(layer);
					}
					if (layer.options && layer.options.icon && layer.options.icon.options && layer.options.icon.options.className === 'crowded-spot-marker') {
						map.removeLayer(layer);
					}
					if (layer.options && layer.options.icon && layer.options.icon.options && layer.options.icon.options.className === 'emergency-location-marker') {
						map.removeLayer(layer);
					}
				});
				document.getElementById('mapLegends').classList.add('hidden');
				
				// Hide Route Info section
				document.getElementById('routeInfo').classList.add('hidden');

			}

			document.getElementById('viewBtn').addEventListener('click', viewRoute);
			document.getElementById('clearBtn').addEventListener('click', clearRoute);
		});
	</script>
@endsection


