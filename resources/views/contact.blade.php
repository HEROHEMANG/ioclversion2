@extends('layouts.app')

@section('title', 'Contact')

@section('content')
	<!-- Hero Section -->
	<div class="relative overflow-hidden bg-gradient-to-br from-green-50 via-white to-emerald-50 rounded-3xl p-12 mb-12">
		<div class="absolute inset-0 bg-gradient-to-r from-green-500/5 to-emerald-500/5"></div>
		<div class="relative text-center">
			<h1 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-6">Contact Us</h1>
			<p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">We'd love to hear from you. Send us a message and we'll get back soon.</p>
		</div>
		<!-- Decorative elements -->
		<div class="absolute -top-10 -left-10 w-20 h-20 bg-green-500/10 rounded-full blur-xl"></div>
		<div class="absolute -bottom-10 -right-10 w-32 h-32 bg-emerald-500/10 rounded-full blur-xl"></div>
	</div>

	<div class="max-w-6xl mx-auto">
		<div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
			<!-- Contact Form -->
			<div class="lg:col-span-2 card-hover bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
				<h2 class="text-2xl font-bold text-gray-900 mb-6">Send us a message</h2>
				<form action="#" method="post" onsubmit="event.preventDefault(); this.reset(); this.querySelector('[data-success]').classList.remove('hidden');">
					<div class="space-y-6">
						<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
							<div>
								<label class="block text-sm font-semibold text-gray-700 mb-2">Name</label>
								<input type="text" required class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all" placeholder="Name">
							</div>
							<div>
								<label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
								<input type="email" required class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all" placeholder="username@example.com">
							</div>
						</div>
						<div>
							<label class="block text-sm font-semibold text-gray-700 mb-2">Subject</label>
							<input type="text" required class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all" placeholder="How can we help?">
						</div>
						<div>
							<label class="block text-sm font-semibold text-gray-700 mb-2">Message</label>
							<textarea rows="5" required class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all resize-none" placeholder="Write your message..."></textarea>
						</div>
					</div>
					<div class="mt-8 flex items-center justify-between">
						<p data-success class="hidden text-sm text-green-600 font-semibold flex items-center">
							<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
							</svg>
							Message sent! We'll get back soon.
						</p>
						<button type="submit" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-xl hover:from-indigo-500 hover:to-purple-500 transition-all shadow-lg hover:shadow-xl">
							Send Message
							<svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
							</svg>
						</button>
					</div>
				</form>
			</div>

			<!-- Contact Info -->
			<div class="lg:col-span-1 space-y-8">
				<!-- Contact Details -->
				<div class="card-hover bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
					<h3 class="text-xl font-bold text-gray-900 mb-6">Rajbandh Terminal Contact</h3>
					<div class="space-y-4">
						<div class="flex items-center">
							<div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center mr-4">
								<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
								</svg>
							</div>
							<div>
								<p class="font-semibold text-gray-900">Company</p>
								<p class="text-gray-600">Indian Oil Corporation Limited</p>
							</div>
						</div>
						<div class="flex items-center">
							<div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center mr-4">
								<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
								</svg>
							</div>
							<div>
								<p class="font-semibold text-gray-900">Address</p>
								<p class="text-gray-600">NH19, Durgapur, West Bengal</p>
							</div>
						</div>
						<div class="flex items-center">
							<div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center mr-4">
								<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
								</svg>
							</div>
							<div>
								<p class="font-semibold text-gray-900">Highway</p>
								<p class="text-gray-600">National Highway 19</p>
							</div>
						</div>
					</div>
				</div>

				<!-- IOCL Terminal Image -->
				<div class="bg-white p-8">
					<h3 class="text-xl font-bold text-gray-900 mb-6">Terminal Facility</h3>
					<div class="p-4">
						<img src="{{ asset('images/iocl.jpg') }}" alt="Rajbandh Terminal - Indian Oil Corporation Ltd" class="w-full" style="border: none; outline: none; box-shadow: none;">
					</div>
					<div class="mt-4 text-center">
						<p class="text-sm text-gray-500">Rajbandh Terminal Facility</p>
						<p class="text-xs text-gray-400 mt-2">Indian Oil Corporation Limited</p>
					</div>
				</div>

				<!-- Response Time -->
				<div class="card-hover bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl p-8 border border-indigo-100">
					<div class="text-center">
						<div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
							<svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
							</svg>
						</div>
						<h3 class="text-xl font-bold text-gray-900 mb-2">Quick Response</h3>
						<p class="text-gray-600">We typically respond within 24 hours</p>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection



