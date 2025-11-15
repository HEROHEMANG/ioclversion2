<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use thiagoalessio\TesseractOCR\TesseractOCR;
use Illuminate\Support\Facades\Storage;

class OcrController extends Controller
{
    public function index()
    {
        // Check if Tesseract is available
        $tesseractAvailable = $this->checkTesseractAvailability();
        
        return view('ocr', compact('tesseractAvailable'));
    }
    
    private function checkTesseractAvailability()
    {
        try {
            // Try to run tesseract --version
            $output = shell_exec('tesseract --version 2>&1');
            return !empty($output) && strpos($output, 'tesseract') !== false;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function extractText(Request $request)
    {
        // Debug: Return debug info instead of processing
        $debugInfo = [
            'has_file' => $request->hasFile('image'),
            'file_info' => $request->file('image') ? [
                'original_name' => $request->file('image')->getClientOriginalName(),
                'size' => $request->file('image')->getSize(),
                'mime_type' => $request->file('image')->getMimeType(),
                'extension' => $request->file('image')->getClientOriginalExtension(),
            ] : null,
            'all_input' => $request->all(),
            'method' => $request->method(),
            'content_type' => $request->header('Content-Type'),
            'files' => $request->allFiles()
        ];

        // Return debug info for now - COMMENTED OUT TO ENABLE OCR PROCESSING
        /*
        return response()->json([
            'success' => false,
            'debug' => $debugInfo,
            'message' => 'Debug mode - not processing OCR yet'
        ]);
        */

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240' // 10MB max
        ]);

        try {
            // Store the uploaded image
            $imagePath = $request->file('image')->store('ocr-uploads', 'public');
            $fullImagePath = storage_path('app/public/' . $imagePath);

            // Initialize Tesseract OCR with full path
            $ocr = new TesseractOCR($fullImagePath);
            $ocr->executable('C:\Program Files\Tesseract-OCR\tesseract.exe');
            
            // Configure OCR settings
            $ocr->lang('eng') // English language
                ->psm(6) // Assume a single uniform block of text
                ->oem(3); // Default OCR Engine Mode

            // Extract text
            $text = $ocr->run();

            // Clean up the uploaded file
            Storage::disk('public')->delete($imagePath);

            // Process the extracted text
            $lines = array_filter(array_map('trim', explode("\n", $text)));
            $words = array_filter(array_map('trim', explode(' ', $text)));

            // Create JSON response
            $json = [
                'success' => true,
                'extracted_text' => $text,
                'processed_data' => [
                    'lines' => $lines,
                    'words' => $words,
                    'word_count' => count($words),
                    'line_count' => count($lines),
                    'character_count' => strlen($text)
                ],
                'metadata' => [
                    'original_filename' => $request->file('image')->getClientOriginalName(),
                    'file_size' => $request->file('image')->getSize(),
                    'processed_at' => now()->toISOString()
                ]
            ];

            return response()->json($json);

        } catch (\Exception $e) {
            // Clean up the uploaded file if it exists
            if (isset($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            
            return response()->json([
                'success' => false,
                'error' => 'OCR processing failed: ' . $e->getMessage(),
                'debug_info' => [
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => $e->getTraceAsString()
                ]
            ], 500);
        }
    }

    public function downloadJson(Request $request)
    {
        $jsonData = $request->input('json_data');
        
        if (!$jsonData) {
            return response()->json(['error' => 'No JSON data provided'], 400);
        }

        $filename = 'ocr_result_' . date('Y-m-d_H-i-s') . '.json';
        
        return response()->json(json_decode($jsonData))
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->header('Content-Type', 'application/json');
    }
}