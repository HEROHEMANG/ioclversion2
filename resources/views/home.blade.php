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
					<div id="routeSummaryInfo" class="text-xs sm:text-sm text-gray-600 space-y-2 mb-4 pb-4 border-b border-gray-200 hidden">
						<div class="flex justify-between">
							<span>Total Distance:</span>
							<span id="totalDistance" class="text-gray-900 font-semibold">-</span>
						</div>
						<div class="flex justify-between">
							<span>Estimated Duration:</span>
							<span id="estimatedDuration" class="text-gray-900 font-semibold">-</span>
						</div>
						<div class="flex justify-between">
							<span>Adjusted Duration (Heavy Vehicle):</span>
							<span id="adjustedDuration" class="text-gray-900 font-semibold">-</span>
						</div>
					</div>
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
		
		<!-- 🧭 Dynamic Map Legends - Positioned just above the map -->
		<div class="w-full px-4 sm:px-0 mb-4">
			<div id="mapLegends" class="bg-white rounded-xl p-4 sm:p-6 border border-gray-200 shadow-lg hidden">
				<h3 class="text-base sm:text-lg font-semibold text-gray-900 mb-4">Key Legends On Route</h3>
				<div id="legendItems" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 sm:gap-6"></div>
			</div>
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
			let terminalChoices = null;
			let destinationChoices = null;
			let routesData = null;

		
			
			// Function to check if both dropdowns are selected
			async function checkDropdowns() {
				const terminal = terminalChoices ? terminalChoices.getValue(true) : document.getElementById('terminalSelect').value;
				const destination = destinationChoices ? destinationChoices.getValue(true) : document.getElementById('destinationSelect').value;
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
					updateRouteInfo(riskPoints, crowdedSpots, emergencyLocations, route);
				} catch (error) {
					console.error('Error loading route data:', error);
				}
			}

			// Initialize Choices.js on dropdowns
			function initializeChoices() {
				if (typeof Choices === 'undefined') {
					console.error('Choices.js library not loaded');
					return;
				}

				const terminalSelect = document.getElementById('terminalSelect');
				const destinationSelect = document.getElementById('destinationSelect');

				if (!terminalSelect || !destinationSelect) {
					console.error('Dropdown elements not found');
					return;
				}

				// Initialize Choices.js for terminal dropdown
				terminalChoices = new Choices(terminalSelect, {
					searchEnabled: true,
					searchChoices: true,
					itemSelectText: '',
					placeholder: true,
					placeholderValue: 'Select Terminal...',
					searchPlaceholderValue: 'Search terminals...',
					shouldSort: true
				});

				// Initialize Choices.js for destination dropdown
				destinationChoices = new Choices(destinationSelect, {
					searchEnabled: true,
					searchChoices: true,
					itemSelectText: '',
					placeholder: true,
					placeholderValue: 'Select Destination...',
					searchPlaceholderValue: 'Search destinations...',
					shouldSort: true
				});

				// Add event listeners to Choices.js instances
				terminalChoices.passedElement.element.addEventListener('change', function(event) {
					updateDestinationDropdown();
					checkDropdowns();
				});

				destinationChoices.passedElement.element.addEventListener('change', function(event) {
					checkDropdowns();
				});
			}

			// Update destination dropdown based on selected terminal
			function updateDestinationDropdown() {
				if (!routesData || !terminalChoices) return;
				
				const selected = terminalChoices.getValue(true);
				if (!selected) {
					destinationChoices.clearChoices();
					destinationChoices.setChoices([{ value: '', label: 'Select Destination...', disabled: false }], 'value', 'label', false);
					return;
				}

				const destinations = (routesData[selected] || []).map(r => ({
					value: r.id,
					label: r.destination || r.name
				}));

				destinationChoices.clearChoices();
				destinationChoices.setChoices(destinations, 'value', 'label', false);
				destinationChoices.setChoiceByValue('');
			}

			// Load routes from API and populate dropdowns
			async function loadRoutes() {
				const res = await fetch('{{ url("/api/routes") }}');
				const routes = await res.json();
				routesData = routes.reduce((acc, r) => {
					const key = r.source || 'Unknown';
					if (!acc[key]) acc[key] = [];
					acc[key].push(r);
					return acc;
				}, {});

				// Initialize Choices.js first
				initializeChoices();

				// Populate terminal dropdown
				const terminalOptions = Object.keys(routesData).map(src => ({
					value: src,
					label: src
				}));

				terminalChoices.setChoices(terminalOptions, 'value', 'label', false);

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
				
				const terminal = terminalChoices ? terminalChoices.getValue(true) : document.getElementById('terminalSelect').value;
				const routeId = destinationChoices ? destinationChoices.getValue(true) : document.getElementById('destinationSelect').value;
				
				if (!terminal || !routeId) {
					alert('Please select both terminal and destination');
					return;
				}

				// Load selected route details from API
				let route;
				try {
					const apiUrl = `{{ url('/api/routes') }}/${routeId}`;
					const routeRes = await fetch(apiUrl);
					if (!routeRes.ok) { 
						alert('Failed to load route details.'); 
						return; 
					}
					route = await routeRes.json();
					
					if (!route || !route.start_coords || !route.end_coords) {
						alert('Invalid route data received from server');
						return;
					}
				} catch (error) {
					alert('An error occurred while loading the route.');
					return;
				}

				const startCoords = route.start_coords || [];
				const endCoords = route.end_coords || [];
				const riskPoints = (route.risk_points || []).map(p => ({
					coords: p.coords || p,
					risk: p.risk || 'Medium',
					speed: p.speed || '30 KM/Hr'
				}));
				const crowdedSpots = (route.crowded_spots || []).map(p => ({
					coords: p.coords || p,
					type: p.type || 'school',
					name: p.name || 'Unknown',
					speed: p.speed || '30 KM/Hr',
					risk: p.risk || 'Medium'
				}));
				const emergencyLocations = (route.emergency_locations || []).map(p => ({
					coords: p.coords || p,
					type: p.type || 'hospital',
					name: p.name || 'Unknown',
					speed: p.speed || '30 KM/Hr',
					risk: p.risk || 'Medium'
				}));
				
				// Clear existing markers and route
				if (sourceMarker) { map.removeLayer(sourceMarker); }
				if (destMarker) { map.removeLayer(destMarker); }
				if (routeControl) { map.removeControl(routeControl); routeControl = null; }
				
				function createIconHTML(type, options = {}) {
				
									const size = options.size || 24;
				
									switch(type) {
				
										case 'start':
				
				                            return `<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-location-filled" width="${size}" height="${size}" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20.891 2.006l-16.891 7.994a1 1 0 0 0 .063 1.815l6.43 2.572l2.572 6.43a1 1 0 0 0 1.815 .063l7.994 -16.891a1 1 0 0 0 -1.984 -1.984z" fill="#22c55e" /></svg>`;
				
				                        case 'end':
				
				                            return `<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-flag-filled" width="${size}" height="${size}" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.234 5.234l-1.234 6.766a1 1 0 0 1 -.98 .766h-5.02v8a1 1 0 0 1 -1.993 .117l-.007 -8h-6a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1h13a1 1 0 0 1 .98 .766z" fill="#22c55e"/></svg>`;
				
				                        case 'high-risk':
				
				                            return `<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-triangle-filled" width="${size}" height="${size}" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11.99 1.992l-10.32 17.999a1.25 1.25 0 0 0 1.084 1.92l20.64 -.001a1.25 1.25 0 0 0 1.084 -1.92l-10.32 -17.999a1.25 1.25 0 0 0 -2.168 0zm.01 11.008a1 1 0 0 0 -1 1v4a1 1 0 0 0 2 0v-4a1 1 0 0 0 -1 -1zm0 -4a1 1 0 0 0 0 2a1 1 0 0 0 0 -2z" fill="#ef4444"/></svg>`;
				
				                        case 'medium-risk':
				
				                            return `<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-octagon-filled" width="${size}" height="${size}" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15.73 3.3l3.968 3.968a2.998 2.998 0 0 1 .902 2.123v5.214a2.998 2.998 0 0 1 -.902 2.123l-3.968 3.968a2.998 2.998 0 0 1 -2.123 .902h-5.214a2.998 2.998 0 0 1 -2.123 -.902l-3.968 -3.968a2.998 2.998 0 0 1 -.902 -2.123v-5.214a2.998 2.998 0 0 1 .902 -2.123l3.968 -3.968a2.998 2.998 0 0 1 2.123 -.902h5.214a2.998 2.998 0 0 1 2.123 .902zm-3.73 9.7a1 1 0 0 0 -1 1v2a1 1 0 0 0 2 0v-2a1 1 0 0 0 -1 -1zm0 -5a1 1 0 0 0 -1 1v3a1 1 0 0 0 2 0v-3a1 1 0 0 0 -1 -1z" fill="#f59e0b"/></svg>`;
				
				                        case 'low-risk':
				
				                            return `<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-shield-filled" width="${size}" height="${size}" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11.998 2.003l.144 .005a12 12 0 0 1 8.232 9.59a12 12 0 0 1 -9.59 12.232l-.144 .005a12 12 0 0 1 -8.232 -9.59a12 12 0 0 1 9.59 -12.232z" fill="#86efac"/></svg>`;
				
				                        case 'hospital':
				
				                            return `<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-hospital" width="${size}" height="${size}" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 21l18 0" /><path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16" /><path d="M9 21v-4a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v4" /><path d="M10 9l4 0" /><path d="M12 7l0 4" /></svg>`;
				
				                        case 'police':
				
				                            return `<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-shield-half-filled" width="${size}" height="${size}" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3a12 12 0 0 0 -8.5 15a12 12 0 0 0 8.5 3a12 12 0 0 0 8.5 -15a12 12 0 0 0 -8.5 -3z" fill="#3b82f6" /><path d="M12 3v18" fill="#3b82f6" /><path d="M12 3a12 12 0 0 1 8.5 15a12 12 0 0 1 -8.5 3" fill="#2563eb" /></svg>`;
				
				                        case 'school':
				
				                            return `<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-school" width="${size}" height="${size}" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M22 9l-10 -4l-10 4l10 4l10 -4v6" /><path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4" /></svg>`;
				
				                        case 'college':
				
				                            return `<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-community" width="${size}" height="${size}" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 9l5 5v7h-5v-4m0 4h-5v-7l5 -5m1 1v-6a1 1 0 0 1 1 -1h10a1 1 0 0 1 1 1v17h-8" /><path d="M13 7l0 .01" /><path d="M17 7l0 .01" /><path d="M17 11l0 .01" /><path d="M17 15l0 .01" /></svg>`;
				
				                        case 'market':
				
				                            return `<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-store" width="${size}" height="${size}" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 21l18 0" /><path d="M3 7v1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1h-18l2 -4h14l2 4" /><path d="M5 21l0 -10.15" /><path d="M19 21l0 -10.15" /><path d="M9 21v-4a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v4" /></svg>`;
				
				                        case 'petrol':
				
				                            return `<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-gas-station" width="${size}" height="${size}" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 11h1a2 2 0 0 1 2 2v3a1.5 1.5 0 0 0 3 0v-7l-3 -3" /><path d="M4 20v-14a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v14" /><path d="M4 11h10" /><path d="M10 11v-5a1 1 0 0 0 -1 -1h-4a1 1 0 0 0 -1 1v5" /><path d="M4 15h10" /></svg>`;
				
										default:
				
											return `<div style="width: ${size}px; height: ${size}px; background: #3b82f6; border-radius: 50%;"></div>`;
				
									}
				
								}				// Add start and end markers
				sourceMarker = L.marker(startCoords, { 
					icon: L.divIcon({ 
						className: 'start-marker', 
						html: createIconHTML('start', { size: 28 }), 
						iconSize: [28, 28],
						iconAnchor: [14, 28]
					}) 
				}).addTo(map).bindPopup(`Start: (${startCoords[0]}, ${startCoords[1]})`);
				
				destMarker = L.marker(endCoords, { 
					icon: L.divIcon({ 
						className: 'end-marker', 
						html: createIconHTML('end', { size: 28 }), 
						iconSize: [28, 28],
						iconAnchor: [14, 28]
					}) 
				}).addTo(map).bindPopup(`End: (${endCoords[0]}, ${endCoords[1]})`);
				
				// Add risk assessment markers
				riskPoints.forEach((point, index) => {
					const riskType = point.risk === 'High' ? 'high-risk' : (point.risk === 'Low' ? 'low-risk' : 'medium-risk');
					const icon = L.divIcon({
						className: 'risk-marker',
						html: createIconHTML(riskType, { size: 24 }),
						iconSize: [24, 24],
						iconAnchor: [12, 24]
					});
					
					L.marker(point.coords, { icon: icon })
						.addTo(map)
						.bindPopup(`<b>Risk Assessment - Turn ${index + 1}</b><br>Risk Level: ${point.risk}<br>Speed Limit: ${point.speed}<br>Coordinates: ${point.coords.join(', ')}`);
				});

				// Add crowded spots markers
				crowdedSpots.forEach((spot, index) => {
					let iconType = 'market'; // default
					const typeLower = (spot.type || '').toLowerCase();
					if (typeLower.includes('school')) iconType = 'school';
					else if (typeLower.includes('college')) iconType = 'college';
					else if (typeLower.includes('market')) iconType = 'market';
					
					const icon = L.divIcon({
						className: 'crowded-spot-marker',
						html: createIconHTML(iconType, { size: 24 }),
						iconSize: [24, 24],
						iconAnchor: [12, 24]
					});
					
					L.marker(spot.coords, { icon: icon })
						.addTo(map)
						.bindPopup(`<b>Crowded Spot ${index + 1}</b><br>Type: ${spot.type}<br>Name: ${spot.name}<br>Speed Limit: ${spot.speed}<br>Risk: ${spot.risk}<br>Coordinates: ${spot.coords.join(', ')}`);
				});

				// Add emergency locations markers
				emergencyLocations.forEach((location, index) => {
					let iconType = 'hospital'; // default
					const typeLower = (location.type || '').toLowerCase();
					if (typeLower.includes('hospital') || typeLower.includes('clinic')) iconType = 'hospital';
					else if (typeLower.includes('police')) iconType = 'police';
					else if (typeLower.includes('pharmacy')) iconType = 'hospital'; // Use hospital icon for pharmacy
					else if (typeLower.includes('petrol') || typeLower.includes('pump')) iconType = 'petrol';
					
					const icon = L.divIcon({
						className: 'emergency-location-marker',
						html: createIconHTML(iconType, { size: 24 }),
						iconSize: [24, 24],
						iconAnchor: [12, 24]
					});
					
					L.marker(location.coords, { icon: icon })
						.addTo(map)
						.bindPopup(`<b>Emergency Location ${index + 1}</b><br>Type: ${location.type}<br>Name: ${location.name}<br>Speed Limit: ${location.speed}<br>Risk: ${location.risk}<br>Coordinates: ${location.coords.join(', ')}`);
				});
				
				// Build waypoints array including all important coordinates
				// Use improved algorithm to prevent extra routes/loops
				
				// Function to calculate distance between two points
				function getDistance(coord1, coord2) {
					const R = 6371; // Earth's radius in km
					const dLat = (coord2[0] - coord1[0]) * Math.PI / 180;
					const dLon = (coord2[1] - coord1[1]) * Math.PI / 180;
					const a = Math.sin(dLat/2) * Math.sin(dLat/2) +
						Math.cos(coord1[0] * Math.PI / 180) * Math.cos(coord2[0] * Math.PI / 180) *
						Math.sin(dLon/2) * Math.sin(dLon/2);
					const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
					return R * c;
				}
				
				// Calculate bearing from start to end (direction of travel)
				function getBearing(coord1, coord2) {
					const lat1 = coord1[0] * Math.PI / 180;
					const lat2 = coord2[0] * Math.PI / 180;
					const dLon = (coord2[1] - coord1[1]) * Math.PI / 180;
					const y = Math.sin(dLon) * Math.cos(lat2);
					const x = Math.cos(lat1) * Math.sin(lat2) - Math.sin(lat1) * Math.cos(lat2) * Math.cos(dLon);
					return Math.atan2(y, x) * 180 / Math.PI;
				}
				
				// Collect all intermediate points with metadata
				const allIntermediatePoints = [];
				
				// Add all risk points
				riskPoints.forEach(point => {
					if (point.coords && point.coords.length >= 2) {
						allIntermediatePoints.push({
							coords: [point.coords[0], point.coords[1]],
							type: 'risk'
						});
					}
				});
				
				// Add all crowded spots
				crowdedSpots.forEach(spot => {
					if (spot.coords && spot.coords.length >= 2) {
						allIntermediatePoints.push({
							coords: [spot.coords[0], spot.coords[1]],
							type: 'crowded'
						});
					}
				});
				
				// Add all emergency locations
				emergencyLocations.forEach(location => {
					if (location.coords && location.coords.length >= 2) {
						allIntermediatePoints.push({
							coords: [location.coords[0], location.coords[1]],
							type: 'emergency'
						});
					}
				});
				
				// Remove duplicate points (within 100 meters)
				const uniquePoints = [];
				const threshold = 0.1; // 100 meters in km
				allIntermediatePoints.forEach(point => {
					let isDuplicate = false;
					for (let i = 0; i < uniquePoints.length; i++) {
						if (getDistance(point.coords, uniquePoints[i].coords) < threshold) {
							isDuplicate = true;
							break;
						}
					}
					if (!isDuplicate) {
						uniquePoints.push(point);
					}
				});
				
				// Calculate main route bearing (from start to end)
				const mainBearing = getBearing(startCoords, endCoords);
				const directDistance = getDistance(startCoords, endCoords);
				
				// Smart waypoint ordering to prevent extra routes/loops:
				// Order points by their position along the route from start to end
				// This uses "nearest neighbor" approach to visit points sequentially
				uniquePoints.forEach(point => {
					const distFromStart = getDistance(startCoords, point.coords);
					const distToEnd = getDistance(point.coords, endCoords);
					const totalDist = distFromStart + distToEnd;
					
					// Calculate progress: how far along the route is this point?
					// Points closer to start have lower progress values
					const progressRatio = distFromStart / totalDist;
					
					point.progress = progressRatio;
					point.totalDist = totalDist;
					point.distFromStart = distFromStart;
					point.distToEnd = distToEnd;
				});
				
				// Sort by progress along the route (visit points in order from start to end)
				// This prevents the route from doubling back and creating loops
				uniquePoints.sort((a, b) => {
					// Primary sort: by progress (how far along the route from start)
					const progressDiff = a.progress - b.progress;
					if (Math.abs(progressDiff) > 0.01) { // More than 1% difference
						return progressDiff; // Lower progress first (visit earlier points first)
					}
					// Secondary sort: if progress is similar, prefer points closer to start
					return a.distFromStart - b.distFromStart;
				});
				
				// Build waypoints array: start -> ordered intermediate points -> end
				const waypoints = [L.latLng(startCoords[0], startCoords[1])];
				uniquePoints.forEach(point => {
					waypoints.push(L.latLng(point.coords[0], point.coords[1]));
				});
				waypoints.push(L.latLng(endCoords[0], endCoords[1]));
				
				// Draw the route with all waypoints
				routeControl = L.Routing.control({
					waypoints: waypoints,
					lineOptions: { addWaypoints: false, styles: [{ color: '#4f46e5', weight: 5, opacity: 0.85 }] },
					show: false,
					routeWhileDragging: false,
					router: L.Routing.osrmv1({ serviceUrl: 'https://router.project-osrm.org/route/v1' })
				}).addTo(map);
				
				// Fit map to show all points
				const allPoints = [startCoords, endCoords, ...riskPoints.map(p => p.coords), ...crowdedSpots.map(s => s.coords), ...emergencyLocations.map(e => e.coords)];
				map.fitBounds(L.latLngBounds(allPoints), { padding: [30, 30] });
				
				// Update Route Info with dynamic values
				updateRouteInfo(riskPoints, crowdedSpots, emergencyLocations, route);
				
				updateMapLegends({
    hasStart: true,
    hasEnd: true,
    riskPoints,
    crowdedSpots,
    emergencyLocations
});

			}
			
			function updateRouteInfo(riskPoints, crowdedSpots, emergencyLocations, route = null) {
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
					
					// Update route summary details if available
					const routeSummaryInfo = document.getElementById('routeSummaryInfo');
					if (route && routeSummaryInfo) {
						if (route.total_distance_km || route.estimated_duration_hours || route.adjusted_duration_heavy_vehicle_hours) {
							routeSummaryInfo.classList.remove('hidden');
							
							const totalDistanceEl = document.getElementById('totalDistance');
							const estimatedDurationEl = document.getElementById('estimatedDuration');
							const adjustedDurationEl = document.getElementById('adjustedDuration');
							
							if (totalDistanceEl) {
								totalDistanceEl.textContent = route.total_distance_km ? route.total_distance_km + ' km' : '-';
							}
							if (estimatedDurationEl) {
								estimatedDurationEl.textContent = route.estimated_duration_hours ? route.estimated_duration_hours + ' hours' : '-';
							}
							if (adjustedDurationEl) {
								adjustedDurationEl.textContent = route.adjusted_duration_heavy_vehicle_hours ? route.adjusted_duration_heavy_vehicle_hours + ' hours' : '-';
							}
						} else {
							routeSummaryInfo.classList.add('hidden');
						}
					}
				}
			}
			
			// Helper function to add legend item
			function addLegendItem(type, iconHTML, englishText, hindiText) {
				const legendItems = document.getElementById('legendItems');
				if (!legendItems) return;

				// Create legend item element
				const legendItem = document.createElement('div');
				legendItem.className = 'flex flex-col items-center text-center';
				legendItem.innerHTML = `
					<div class="mb-2 flex items-center justify-center">
						${iconHTML}
					</div>
					<div class="font-semibold text-sm text-gray-900 mb-1">${englishText}</div>
					<div class="text-xs text-gray-600">${hindiText}</div>
				`;
				
				legendItems.appendChild(legendItem);
			}

			function updateMapLegends({ hasStart, hasEnd, riskPoints, crowdedSpots, emergencyLocations }) {
				const legendContainer = document.getElementById('mapLegends');
				const legendItems = document.getElementById('legendItems');
				if (!legendContainer || !legendItems) return;
				
				legendItems.innerHTML = ''; // clear previous items

				// Helper function to create icon HTML (same as in viewRoute)
				function createIconHTML(type, options = {}) {
					const size = options.size || 32;
					switch(type) {
						case 'start':
							return `<div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-green-500 flex items-center justify-center shadow-md">
								<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
									<path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
								</svg>
							</div>`;
						case 'end':
							return `<div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-red-500 flex items-center justify-center shadow-md">
								<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
									<path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
								</svg>
							</div>`;
						case 'high-risk':
							return `<div class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg bg-red-500 flex items-center justify-center shadow-md">
								<span class="text-white font-bold text-lg sm:text-xl">H</span>
							</div>`;
						case 'medium-risk':
							return `<div class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg bg-yellow-500 flex items-center justify-center shadow-md">
								<span class="text-white font-bold text-lg sm:text-xl">M</span>
							</div>`;
						case 'low-risk':
							return `<div class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg bg-green-500 flex items-center justify-center shadow-md">
								<span class="text-white font-bold text-lg sm:text-xl">L</span>
							</div>`;
						case 'hospital':
							return `<div class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg bg-purple-500 flex items-center justify-center shadow-md">
								<span class="text-white font-bold text-lg sm:text-xl">H</span>
							</div>`;
						case 'police':
							return `<div class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg bg-blue-600 flex items-center justify-center shadow-md">
								<span class="text-white font-bold text-lg sm:text-xl">P</span>
							</div>`;
						case 'school':
							return `<div class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg bg-blue-500 flex items-center justify-center shadow-md">
								<span class="text-white font-bold text-lg sm:text-xl">S</span>
							</div>`;
						case 'college':
							return `<div class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg bg-blue-400 flex items-center justify-center shadow-md">
								<span class="text-white font-bold text-lg sm:text-xl">C</span>
							</div>`;
						case 'market':
							return `<div class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg bg-orange-500 flex items-center justify-center shadow-md">
								<span class="text-white font-bold text-lg sm:text-xl">M</span>
							</div>`;
						case 'petrol':
							return `<div class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg bg-yellow-600 flex items-center justify-center shadow-md">
								<span class="text-white font-bold text-lg sm:text-xl">P</span>
							</div>`;
						default:
							return `<div class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg bg-gray-500 flex items-center justify-center shadow-md">
								<span class="text-white font-bold text-lg sm:text-xl">?</span>
							</div>`;
					}
				}

				// Add legend items dynamically based on route data
				if (hasStart) {
					addLegendItem('start', createIconHTML('start'), 'Start Point', 'प्रारंभ बिंदु');
				}
				if (hasEnd) {
					addLegendItem('end', createIconHTML('end'), 'End Point', 'अंत बिंदु');
				}

				// Risk points
				if (riskPoints && riskPoints.length > 0) {
					if (riskPoints.some(r => r.risk === 'High')) {
						addLegendItem('highRisk', createIconHTML('high-risk'), 'High Risk Turn', 'उच्च जोखिम वाला मोड़');
					}
					if (riskPoints.some(r => r.risk === 'Medium')) {
						addLegendItem('mediumRisk', createIconHTML('medium-risk'), 'Medium Risk Turn', 'मध्यम जोखिम मोड़');
					}
					if (riskPoints.some(r => r.risk === 'Low')) {
						addLegendItem('lowRisk', createIconHTML('low-risk'), 'Low Risk Turn', 'कम जोखिम मोड़');
					}
				}

				// Crowded spots
				if (crowdedSpots && crowdedSpots.length > 0) {
					if (crowdedSpots.some(s => (s.type || '').toLowerCase().includes('school'))) {
						addLegendItem('school', createIconHTML('school'), 'School', 'विद्यालय');
					}
					if (crowdedSpots.some(s => (s.type || '').toLowerCase().includes('college'))) {
						addLegendItem('college', createIconHTML('college'), 'College', 'कॉलेज');
					}
					if (crowdedSpots.some(s => (s.type || '').toLowerCase().includes('market'))) {
						addLegendItem('market', createIconHTML('market'), 'Market Place', 'बाज़ार स्थान');
					}
				}

				// Emergency locations
				if (emergencyLocations && emergencyLocations.length > 0) {
					if (emergencyLocations.some(l => (l.type || '').toLowerCase().includes('hospital') || (l.type || '').toLowerCase().includes('clinic'))) {
						addLegendItem('hospital', createIconHTML('hospital'), 'Hospital / Clinic', 'अस्पताल');
					}
					if (emergencyLocations.some(l => (l.type || '').toLowerCase().includes('police'))) {
						addLegendItem('police', createIconHTML('police'), 'Police', 'पुलिस');
					}
					if (emergencyLocations.some(l => (l.type || '').toLowerCase().includes('petrol') || (l.type || '').toLowerCase().includes('pump'))) {
						addLegendItem('petrol', createIconHTML('petrol'), 'Petrol Pump', 'पेट्रोल पंप');
					}
				}

				// Show or hide legend container
				if (legendItems.children.length > 0) {
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


