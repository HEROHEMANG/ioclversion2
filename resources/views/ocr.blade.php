@extends('layouts.app')

@section('title', 'OCR - Image to Text Converter')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">🖼️ OCR Image to Text Converter</h1>
            <p class="text-lg text-gray-600">Upload an image and extract text using Optical Character Recognition (OCR)</p>
            
            @if(!$tesseractAvailable)
            <div class="mt-4 bg-yellow-50 border border-yellow-200 rounded-lg p-4 max-w-2xl mx-auto">
                <div class="flex">
                    <div class="text-yellow-400 text-2xl mr-3">⚠️</div>
                    <div>
                        <h3 class="text-lg font-medium text-yellow-800">Tesseract OCR Not Found</h3>
                        <p class="text-yellow-700 mt-1">
                            Tesseract OCR is not installed on this system. Please install Tesseract OCR to use this feature.
                        </p>
                        <div class="mt-2 text-sm text-yellow-600">
                            <strong>Windows:</strong> Download from <a href="https://github.com/UB-Mannheim/tesseract/wiki" class="underline" target="_blank">GitHub</a> and add to PATH<br>
                            <strong>Linux:</strong> <code>sudo apt install tesseract-ocr</code>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Upload Form -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <form id="ocrForm" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-blue-400 transition-colors">
                    <div class="space-y-4">
                        <div class="text-6xl">📷</div>
                        <div>
                            <label for="image" class="cursor-pointer">
                                <span class="text-lg font-medium text-gray-700">Click to upload an image</span>
                                <p class="text-sm text-gray-500 mt-2">Supports JPG, PNG, GIF (Max 10MB)</p>
                            </label>
                            <input type="file" id="image" name="image" accept="image/*" class="hidden" required>
                        </div>
                    </div>
                </div>
                
                <div class="text-center">
                    <button type="submit" id="processBtn" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg transition-colors disabled:opacity-50 disabled:cursor-not-allowed" @if(!$tesseractAvailable) disabled @endif>
                        <span id="btnText">🔍 Extract Text</span>
                        <span id="btnLoading" class="hidden">⏳ Processing...</span>
                    </button>
                    @if(!$tesseractAvailable)
                    <p class="text-sm text-gray-500 mt-2">Please install Tesseract OCR to enable this feature</p>
                    @endif
                </div>
            </form>
        </div>

        <!-- Results Section -->
        <div id="resultsSection" class="hidden">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">📄 Extracted Text Results</h2>
                    <div class="space-x-2">
                        <button id="downloadJsonBtn" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors">
                            📥 Download JSON
                        </button>
                        <button id="copyTextBtn" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors">
                            📋 Copy Text
                        </button>
                    </div>
                </div>

                <!-- Metadata -->
                <div id="metadata" class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6 p-4 bg-gray-50 rounded-lg">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-blue-600" id="wordCount">-</div>
                        <div class="text-sm text-gray-600">Words</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-green-600" id="lineCount">-</div>
                        <div class="text-sm text-gray-600">Lines</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-purple-600" id="charCount">-</div>
                        <div class="text-sm text-gray-600">Characters</div>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="border-b border-gray-200 mb-4">
                    <nav class="-mb-px flex space-x-8">
                        <button class="tab-btn active border-b-2 border-blue-500 py-2 px-1 text-sm font-medium text-blue-600" data-tab="raw-text">
                            Raw Text
                        </button>
                        <button class="tab-btn border-b-2 border-transparent py-2 px-1 text-sm font-medium text-gray-500 hover:text-gray-700" data-tab="lines">
                            Lines
                        </button>
                        <button class="tab-btn border-b-2 border-transparent py-2 px-1 text-sm font-medium text-gray-500 hover:text-gray-700" data-tab="json">
                            JSON Data
                        </button>
                    </nav>
                </div>

                <!-- Tab Content -->
                <div id="raw-text" class="tab-content">
                    <textarea id="rawTextArea" class="w-full h-64 p-4 border border-gray-300 rounded-lg font-mono text-sm" readonly></textarea>
                </div>

                <div id="lines" class="tab-content hidden">
                    <div id="linesList" class="space-y-2 max-h-64 overflow-y-auto"></div>
                </div>

                <div id="json" class="tab-content hidden">
                    <pre id="jsonPreview" class="w-full h-64 p-4 border border-gray-300 rounded-lg font-mono text-sm overflow-auto bg-gray-50"></pre>
                </div>
            </div>
        </div>

        <!-- Error Section -->
        <div id="errorSection" class="hidden bg-red-50 border border-red-200 rounded-lg p-6">
            <div class="flex">
                <div class="text-red-400 text-2xl mr-3">❌</div>
                <div>
                    <h3 class="text-lg font-medium text-red-800">Error</h3>
                    <p id="errorMessage" class="text-red-600 mt-1"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('ocrForm');
    const imageInput = document.getElementById('image');
    const processBtn = document.getElementById('processBtn');
    const btnText = document.getElementById('btnText');
    const btnLoading = document.getElementById('btnLoading');
    const resultsSection = document.getElementById('resultsSection');
    const errorSection = document.getElementById('errorSection');
    const errorMessage = document.getElementById('errorMessage');
    
    let currentJsonData = null;

    // File input change handler
    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Update UI to show selected file
            const uploadArea = document.querySelector('.border-dashed');
            uploadArea.innerHTML = `
                <div class="space-y-4">
                    <div class="text-6xl">✅</div>
                    <div>
                        <span class="text-lg font-medium text-green-700">File Selected</span>
                        <p class="text-sm text-gray-500 mt-2">${file.name} (${(file.size / 1024 / 1024).toFixed(2)} MB)</p>
                    </div>
                </div>
            `;
        }
    });

    // Form submission
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        // Check if file is selected
        if (!imageInput.files || imageInput.files.length === 0) {
            showError('Please select an image file first');
            return;
        }
        
        const formData = new FormData(form);
        
        // Show loading state
        processBtn.disabled = true;
        btnText.classList.add('hidden');
        btnLoading.classList.remove('hidden');
        resultsSection.classList.add('hidden');
        errorSection.classList.add('hidden');

        try {
            // Debug: Log what we're sending
            console.log('File input files:', imageInput.files);
            console.log('FormData contents:');
            for (let [key, value] of formData.entries()) {
                console.log(key, value);
            }
            console.log('FormData has image:', formData.has('image'));
            
            const response = await fetch('{{ url("/api/ocr/extract") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            // Check if response is JSON
            const contentType = response.headers.get('content-type');
            if (!contentType || !contentType.includes('application/json')) {
                const text = await response.text();
                showError(`Server returned ${response.status}: ${response.statusText}. Response: ${text.substring(0, 200)}...`);
                return;
            }

            const data = await response.json();

            if (data.success) {
                currentJsonData = data;
                displayResults(data);
                resultsSection.classList.remove('hidden');
            } else {
                showError(data.error || 'An error occurred during OCR processing');
            }
        } catch (error) {
            showError('Network error: ' + error.message);
        } finally {
            // Reset button state
            processBtn.disabled = false;
            btnText.classList.remove('hidden');
            btnLoading.classList.add('hidden');
        }
    });

    function displayResults(data) {
        // Update metadata
        document.getElementById('wordCount').textContent = data.processed_data.word_count;
        document.getElementById('lineCount').textContent = data.processed_data.line_count;
        document.getElementById('charCount').textContent = data.processed_data.character_count;

        // Update raw text
        document.getElementById('rawTextArea').value = data.extracted_text;

        // Update lines
        const linesList = document.getElementById('linesList');
        linesList.innerHTML = '';
        data.processed_data.lines.forEach((line, index) => {
            const lineDiv = document.createElement('div');
            lineDiv.className = 'p-2 bg-gray-50 rounded border-l-4 border-blue-400';
            lineDiv.innerHTML = `<span class="text-sm text-gray-500 mr-2">${index + 1}.</span>${line}`;
            linesList.appendChild(lineDiv);
        });

        // Update JSON preview
        document.getElementById('jsonPreview').textContent = JSON.stringify(data, null, 2);
    }

    function showError(message) {
        errorMessage.textContent = message;
        errorSection.classList.remove('hidden');
    }

    // Tab switching
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const tabName = this.dataset.tab;
            
            // Update tab buttons
            document.querySelectorAll('.tab-btn').forEach(b => {
                b.classList.remove('active', 'border-blue-500', 'text-blue-600');
                b.classList.add('border-transparent', 'text-gray-500');
            });
            this.classList.add('active', 'border-blue-500', 'text-blue-600');
            this.classList.remove('border-transparent', 'text-gray-500');

            // Update tab content
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });
            document.getElementById(tabName).classList.remove('hidden');
        });
    });

    // Copy text functionality
    document.getElementById('copyTextBtn').addEventListener('click', function() {
        const textArea = document.getElementById('rawTextArea');
        textArea.select();
        document.execCommand('copy');
        
        // Show feedback
        const originalText = this.textContent;
        this.textContent = '✅ Copied!';
        setTimeout(() => {
            this.textContent = originalText;
        }, 2000);
    });

    // Download JSON functionality
    document.getElementById('downloadJsonBtn').addEventListener('click', function() {
        if (currentJsonData) {
            const blob = new Blob([JSON.stringify(currentJsonData, null, 2)], { type: 'application/json' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `ocr_result_${new Date().toISOString().slice(0, 19).replace(/:/g, '-')}.json`;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
        }
    });
});
</script>

<style>
.tab-btn.active {
    border-bottom-color: #3b82f6;
    color: #2563eb;
}

.tab-content {
    transition: all 0.3s ease;
}
</style>
@endsection
