<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('title', 'Site')</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="anonymous"/>
	<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css"/>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
	<style>
		body { font-family: 'Inter', system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif; }
		.nav-blur { backdrop-filter: saturate(180%) blur(20px); background: rgba(255,255,255,0.95); border-bottom: 1px solid rgba(255,255,255,0.2); }
		#map { height: 16rem; }
		@media (min-width: 640px) { #map { height: 20rem; } }
		@media (min-width: 768px) { #map { height: 24rem; } }
		@media (min-width: 1024px) { #map { height: 520px; } }
		.gradient-bg { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
		.card-hover { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
		.card-hover:hover { transform: translateY(-4px); box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); }
		img { image-rendering: -webkit-optimize-contrast; image-rendering: high-quality; }
		.logo-img { image-rendering: auto; image-rendering: crisp-edges; image-rendering: -webkit-optimize-contrast; }
	</style>
</head>
<body class="min-h-screen bg-white text-gray-900">
	<header class="sticky top-0 z-40">
		<nav class="nav-blur border-b border-gray-200">
			<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
				<div class="flex h-16 sm:h-20 lg:h-24 items-center justify-between">
					<a href="{{ url('/') }}" class="flex items-center gap-2 sm:gap-3 px-2 py-2">
						<img src="{{ asset('images/iocl.png') }}" alt="IOCL Logo" class="w-10 sm:w-12 lg:w-16 logo-img">
						<span class="text-sm sm:text-base lg:text-lg font-semibold text-gray-900">Rajbandh Terminal</span>
					</a>
					<div class="hidden md:flex items-center gap-6">
						<a href="{{ url('/') }}" class="text-sm font-medium {{ request()->is('/') || request()->is('home') ? 'text-indigo-600' : 'text-gray-600 hover:text-indigo-600' }}">Home</a>
						<a href="{{ route('ocr.index') }}" class="text-sm font-medium {{ request()->is('ocr*') ? 'text-indigo-600' : 'text-gray-600 hover:text-indigo-600' }}">OCR Tool</a>
						<a href="{{ url('/contact') }}" class="text-sm font-medium {{ request()->is('contact') ? 'text-indigo-600' : 'text-gray-600 hover:text-indigo-600' }}">Contact</a>
					</div>
					<button id="navToggle" class="md:hidden inline-flex items-center justify-center rounded-md p-2 text-gray-600 hover:text-indigo-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-200" aria-controls="mobile-menu" aria-expanded="false">
						<svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
					</button>
				</div>
			</div>
			<div id="mobile-menu" class="md:hidden hidden border-t border-gray-200">
				<div class="space-y-1 px-4 py-3">
					<a href="{{ url('/') }}" class="block rounded px-3 py-2 text-base font-medium {{ request()->is('/') || request()->is('home') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50 hover:text-indigo-600' }}">Home</a>
					<a href="{{ route('ocr.index') }}" class="block rounded px-3 py-2 text-base font-medium {{ request()->is('ocr*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50 hover:text-indigo-600' }}">OCR Tool</a>
					<a href="{{ url('/contact') }}" class="block rounded px-3 py-2 text-base font-medium {{ request()->is('contact') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50 hover:text-indigo-600' }}">Contact</a>
				</div>
			</div>
		</nav>
	</header>

	<main class="mx-auto max-w-7xl px-2 sm:px-4 lg:px-8 py-6 sm:py-8 lg:py-12">
		@yield('content')
	</main>

	<footer class="mt-auto gradient-bg">
		<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
			<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
				<div class="sm:col-span-2 lg:col-span-1">
					<div class="flex flex-col sm:flex-row items-start sm:items-center gap-2 sm:gap-3 mb-4">
						<img src="{{ asset('images/iocl.png') }}" alt="IOCL Logo" class="w-16 sm:w-20 logo-img">
						<span class="text-lg sm:text-xl font-bold text-white">Indian Oil Corporation Limited</span>
					</div>
					<p class="text-indigo-100 text-xs sm:text-sm leading-relaxed">
						Journey Risk Management platform providing comprehensive route analysis and safety insights for better transportation planning.
					</p>
				</div>
				<div>
					<h3 class="text-white font-semibold mb-3 sm:mb-4 text-sm sm:text-base">Quick Links</h3>
					<div class="space-y-2">
						<a href="{{ url('/') }}" class="block text-indigo-100 hover:text-white transition-colors text-xs sm:text-sm">Home</a>
						<a href="{{ route('routes.comparison') }}" class="block text-indigo-100 hover:text-white transition-colors text-xs sm:text-sm">Route Comparison</a>
						<a href="{{ route('ocr.index') }}" class="block text-indigo-100 hover:text-white transition-colors text-xs sm:text-sm">OCR Tool</a>
					</div>
				</div>
				<div>
					<h3 class="text-white font-semibold mb-3 sm:mb-4 text-sm sm:text-base">Route Analysis</h3>
					<div class="space-y-2">
						<a href="{{ route('routes.comparison') }}" class="block text-indigo-100 hover:text-white transition-colors text-xs sm:text-sm">Route Comparison</a>
						<a href="{{ url('/') }}" class="block text-indigo-100 hover:text-white transition-colors text-xs sm:text-sm">Risk Assessment</a>
						<a href="{{ url('/') }}" class="block text-indigo-100 hover:text-white transition-colors text-xs sm:text-sm">Emergency Locations</a>
					</div>
				</div>
			</div>
			<div class="border-t border-white/20 mt-6 sm:mt-8 pt-6 sm:pt-8 text-center">
				<p class="text-indigo-100 text-xs sm:text-sm">© {{ date('Y') }} Indian Oil Corporation Limited. All rights reserved. Built with Laravel & Tailwind CSS.</p>
			</div>
		</div>
	</footer>

	<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
	<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.min.js"></script>
	<script>
		const btn = document.getElementById('navToggle');
		const menu = document.getElementById('mobile-menu');
		if (btn && menu) {
			btn.addEventListener('click', () => {
				menu.classList.toggle('hidden');
			});
		}
	</script>
</body>
</html>


