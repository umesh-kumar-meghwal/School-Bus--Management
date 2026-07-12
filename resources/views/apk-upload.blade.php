<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APK File Upload</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;600;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brandCream: '#FAF5EF',
                        brandBrown: '#4A2E2B',
                        brandOrange: '#D48C45',
                        brandLightOrange: '#EADBC8',
                    },
                    fontFamily: { sans: ['Quicksand', 'sans-serif'] }
                }
            }
        }
    </script>
</head>
<body class="bg-brandCream font-sans min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-md bg-white rounded-3xl shadow-xl border border-brandBrown/5 p-8 lg:p-10">
        <!-- Icon & Header -->
         <button onclick="history.back()" class="flex items-center gap-2 text-sm text-slate-400 hover:text-white transition duration-200 mb-8">
                    ← Back
                </button>
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-brandOrange/10 rounded-full flex items-center justify-center mx-auto mb-4 text-brandOrange">
                <!-- SVG Upload Icon -->
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-brandBrown">APK File Upload</h1>
            <p class="text-sm text-gray-500 mt-1">Upload your Android package securely</p>
        </div>

        <!-- Form fields -->
        <div class="space-y-6">
            <!-- File Name Input -->
            <div>
                <label for="file_name" class="block text-sm font-semibold text-brandBrown mb-2">APK File Name</label>
                <input type="text" name="file_name" id="file_name" placeholder="Enter custom filename" 
                       class="w-full bg-brandCream/40 border border-brandBrown/10 rounded-2xl px-5 py-3.5 text-brandBrown placeholder-gray-400 focus:outline-none focus:border-brandOrange focus:ring-1 focus:ring-brandOrange transition-all duration-200">
            </div>

             <div>
                <label for="apk_version" class="block text-sm font-semibold text-brandBrown mb-2">App version</label>
                <input type="text" name="apk_version" id="apk_version" placeholder="Enter custom App Version e.g:1.0" 
                       class="w-full bg-brandCream/40 border border-brandBrown/10 rounded-2xl px-5 py-3.5 text-brandBrown placeholder-gray-400 focus:outline-none focus:border-brandOrange focus:ring-1 focus:ring-brandOrange transition-all duration-200">
            </div>


            <!-- Custom Designed File Upload Area -->
            <div>
                <label class="block text-sm font-semibold text-brandBrown mb-2">Select APK File</label>
                <label for="apk" class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-brandBrown/15 hover:border-brandOrange rounded-2xl cursor-pointer bg-brandCream/20 hover:bg-brandLightOrange/10 transition-all duration-200 p-4">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center">
                        <svg class="w-8 h-8 text-gray-400 mb-2 group-hover:text-brandOrange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <p id="file-label-text" class="text-sm text-gray-500 font-medium">Click to browse or drag file here</p>
                        <p class="text-xs text-gray-400 mt-1">Only .apk files allowed</p>
                    </div>
                    <!-- Hidden real file input -->
                    <input type="file" name="file" id="apk" class="hidden"  >
                </label>
            </div>

            <!-- Upload Button -->
            <button id="upload" class="w-full bg-brandOrange hover:bg-brandBrown disabled:bg-gray-300 disabled:cursor-not-allowed text-white font-bold py-4 rounded-2xl shadow-lg transition-all duration-300 transform active:scale-95">
                Upload File
            </button>

            <!-- Progress / Status Message Box -->
            <div id="status-box" class="hidden p-4 rounded-xl text-sm font-semibold text-center transition-all duration-200">
                <p id="show"></p>
            </div>
        </div>
    </div>

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        // Update label text when a file is selected
        $("$apk_version").keyup(function(){
            let val = this.val();
            alert("dd");

        })
        $("#apk").change(function() {
            let filename = this.files[0] ? this.files[0].name : "Click to browse or drag file here";
            $("#file-label-text").text(filename).addClass("text-brandOrange font-semibold");
        });

        $("#upload").click(function() {
            let file = $("#apk")[0].files[0];
            let file_name = $("#file_name").val();

            // validation checks before sending request
            if (!file) {
                showStatus("Please select an APK file first.", "error");
                return;
            }

            // Show Processing Status
            showStatus("Uploading and processing file...", "info");
            $("#upload").prop("disabled", true);

            let data = new FormData();
            data.append("file", file);
            data.append("file_name", file_name);

            $.ajax({
                url: "/apk-upload",
                type: "POST",
                data: data,
                processData: false,
                contentType: false,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                success: function(res) {
                    showStatus(res.success + res.filename );
                    $("#upload").prop("disabled", false);
                },
                error: function(xhr, status, error) {
                    showStatus("Upload failed. Please try again.", "error");
                    $("#upload").prop("disabled", false);
                    console.log("status:", status);
                    console.log("Error:", error);
                    console.log("Response:", xhr.responseText);
                }
            });
        });

        // Function to style and display the status box cleanly
        function showStatus(message, type) {
            let statusBox = $("#status-box");
            let showElem = $("#show");
            
            statusBox.removeClass("hidden bg-blue-50 text-blue-700 bg-green-50 text-green-700 bg-red-50 text-red-700");
            showElem.text(message);

            if (type === "info") {
                statusBox.addClass("bg-blue-50 text-blue-700");
            } else if (type === "success") {
                statusBox.addClass("bg-green-50 text-green-700");
            } else if (type === "error") {
                statusBox.addClass("bg-red-50 text-red-700");
            }
            statusBox.removeClass("hidden");
        }
    </script>
</body>
</html>