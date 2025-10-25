<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RouteComparisonController;
use App\Http\Controllers\OcrController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return view('home');
});

Route::get('/home', function () {
	return view('home');
});

Route::get('/contact', function () {
	return view('contact');
});

Route::get('/sristi-filling-station', function () {
	$jsonFilePath = public_path('284860 SRISTI FILLING STATION/dummy text json.txt');
	$routeData = [];
	
	if (file_exists($jsonFilePath)) {
		$content = file_get_contents($jsonFilePath);
		$lines = array_filter(explode("\n", $content), function($line) {
			return !empty(trim($line));
		});
		
		foreach ($lines as $line) {
			$decoded = json_decode(trim($line), true);
			if ($decoded) {
				$routeData[] = $decoded;
			}
		}
	}
	
	return view('sristi-filling-station', compact('routeData'));
});

Route::get('/coco-pandaveswar-adhoc-shiva-vishnu', function () {
	$jsonFilePath = public_path('322734 COCO PANDAVESWAR-ADHOC SHIVA VISHNU/json file.txt');
	$routeData = [];
	
	if (file_exists($jsonFilePath)) {
		$content = file_get_contents($jsonFilePath);
		$lines = array_filter(explode("\n", $content), function($line) {
			return !empty(trim($line));
		});
		
		foreach ($lines as $line) {
			$decoded = json_decode(trim($line), true);
			if ($decoded) {
				$routeData[] = $decoded;
			}
		}
	}
	
	// Structure the data for better display
	$structuredData = [
		'route_info' => isset($routeData[0]) ? $routeData[0] : [],
		'risk_points' => isset($routeData[1]) ? $routeData[1] : [],
		'emergency_locations' => isset($routeData[2]) ? $routeData[2] : [],
		'schools' => isset($routeData[3]) ? $routeData[3] : []
	];
	
	return view('coco-pandaveswar-adhoc-shiva-vishnu', compact('routeData', 'structuredData'));
});


// Route Comparison Routes
Route::get('/routes/comparison', [RouteComparisonController::class, 'index'])->name('routes.comparison');
Route::get('/routes/{id}', [RouteComparisonController::class, 'show'])->name('routes.show');
Route::get('/routes/export/json', [RouteComparisonController::class, 'exportJson'])->name('routes.export');

// OCR Routes
Route::get('/ocr', [OcrController::class, 'index'])->name('ocr.index');
Route::post('/ocr/download', [OcrController::class, 'downloadJson'])->name('ocr.download');

// Debug route for CSRF testing
Route::get('/csrf-test', function() {
    return response()->json([
        'csrf_token' => csrf_token(),
        'session_id' => session()->getId(),
        'app_url' => config('app.url')
    ]);
});
