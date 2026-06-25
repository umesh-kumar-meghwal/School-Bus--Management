<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Photo Upload</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 font-sans antialiased min-h-screen flex items-center justify-center p-4">

    <div class="max-w-md w-full bg-white rounded-2xl border border-slate-200 shadow-xl p-8">
        
        <!-- Back Button & Header -->
        <div class="mb-6">
            <button onclick="history.back()" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-slate-800 transition mb-4">
                ← Back
            </button>
            <h1 class="text-2xl font-bold text-slate-800">Student Photo Upload</h1>
            <p class="text-sm text-slate-500 mt-1">Apni profile picture upload karne ke liye file select karein.</p>
        </div>

        <!-- Form Start -->
        <form action="/sphotouploads" method="post" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Styled File Input Area -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-slate-700">Choose Photo</label>
                
                <div class="flex items-center justify-center w-full">
                    <label class="flex flex-col items-center justify-center w-full h-40 border-2 border-slate-300 border-dashed rounded-xl cursor-pointer bg-slate-50 hover:bg-slate-100/70 transition duration-150">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <!-- Upload SVG Icon -->
                            <svg class="w-8 h-8 text-slate-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                            <p class="text-xs font-semibold text-slate-500">Click to upload a file</p>
                            <p class="text-[10px] text-slate-400 mt-1">PNG, JPG, JPEG up to 2MB</p>
                        </div>
                        <!-- Actual Input File (Hidden visually but functional) -->
                        <input type="file" name="photo" class="hidden" required onchange="updateFileName(this)">
                    </label>
                </div>
                
                <!-- Display Selected File Name -->
                <p id="file-name" class="text-xs text-indigo-600 font-medium mt-1 text-center hidden"></p>
            </div>

            <!-- Hidden Inputs -->
            <input type="hidden" value="{{ $email }}" name="email">

            <!-- Submit Button -->
            <div>
                <button 
                    type="submit" 
                    class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm rounded-lg shadow-sm hover:shadow transition duration-150 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Submit Photo
                </button>
            </div>

        </form>
        <!-- Form End -->

        <!-- Dynamic Message Logic (Same as pichla alert design) -->
        @if(isset($msg) && !empty($msg))
            @if(stripos($msg, 'already') !== false || stripos($msg, 'exist') !== false || stripos($msg, 'fail') !== false || stripos($msg, 'error') !== false)
                <!-- Red Alert -->
                <div class="mt-6 p-4 bg-rose-50 border border-rose-200 rounded-xl flex items-start gap-3">
                    <svg class="h-5 w-5 text-rose-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <div>
                        <h4 class="text-sm font-semibold text-rose-800">Alert</h4>
                        <p class="text-xs text-rose-700 mt-0.5">{{ $msg }}</p>
                    </div>
                </div>
            @else
                <!-- Green Alert -->
                <div class="mt-6 p-4 bg-emerald-50 border border-emerald-200 rounded-xl flex items-start gap-3">
                    <svg class="h-5 w-5 text-emerald-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <h4 class="text-sm font-semibold text-emerald-800">Success</h4>
                        <p class="text-xs text-emerald-700 mt-0.5">{{ $msg }}</p>
                    </div>
                </div>
            @endif
        @endif

    </div>

    <!-- JavaScript to show selected file name -->
    <script>
        function updateFileName(input) {
            const fileNameDisplay = document.getElementById('file-name');
            if (input.files && input.files[0]) {
                fileNameDisplay.textContent = "Selected: " + input.files[0].name;
                fileNameDisplay.classList.remove('hidden');
            } else {
                fileNameDisplay.classList.add('hidden');
            }
        }
    </script>

</body>
</html>