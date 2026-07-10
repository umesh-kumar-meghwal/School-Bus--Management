<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Meta CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>All Student Push Notifications</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 font-sans antialiased min-h-screen flex items-center justify-center p-4">

    <!-- Compose Broadcast Card Container -->
    <div class="max-w-md w-full bg-white rounded-2xl border border-slate-200 shadow-xl p-8">
        
        <!-- Back Button & Header -->
        <div class="mb-6">
            <button onclick="history.back()" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-slate-800 transition mb-4">
                ← Back
            </button>
            <h1 class="text-2xl font-bold text-slate-800">All Student Push</h1>
        </div>

        <!-- Form Start (AJAX Controlled) -->
        <div class="space-y-5">
            @csrf

            <!-- Hidden Parameter -->
            <input type="hidden" name="school_email" value="{{ $school_email }}" id="school_email">

            <!-- Title Field -->
            <div>
                <label for="title" class="block text-sm font-medium text-slate-700 mb-1.5">Enter the Title</label>
                <input 
                    type="text" 
                    name="title" 
                    id="title" 
                    placeholder="e.g. Urgent: Bus Route Delay 🚌"
                    class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                    required
                >
            </div>

            <!-- Content Area Field -->
            <div>
                <label for="content" class="block text-sm font-medium text-slate-700 mb-1.5">Enter the Content</label>
                <textarea 
                    name="content" 
                    id="content" 
                    rows="4"
                    placeholder="Type your broadcast announcement here..."
                    class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                    required
                ></textarea>
            </div>

            <!-- Submit Broadcast Button -->
            <div class="pt-2">
                <button 
                    onclick="myfunction()" 
                    class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-lg shadow-sm hover:shadow transition duration-150 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 flex items-center justify-center gap-2"
                >
                    Broadcast Notification 📢
                </button>
            </div>

            <!-- Dynamic Response Alert Panel -->
            <div id="show-wrapper" class="hidden">
                <p id="show"></p>
            </div>

        </div>
        <!-- Form End -->

    </div>

    <!-- Core Dynamic Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        function myfunction() {
            const now = new Date();
            var date =  now.toLocaleDateString();
            var time = now.toLocaleTimeString();
            var title = document.getElementById('title').value;
            var content = document.getElementById('content').value;
            var school_email = document.getElementById("school_email").value;

            // Check if inputs are empty
            if (!title || !content) {
                alert("Please fill both Title and Content fields before pushing.");
                return;
            }

            $.ajax({
                url: "/pushed",
                type: "GET",
                data : {
                    _token: "{{ csrf_token() }}",
                    title: title,
                    content: content,
                    school_email: school_email,
                    date: date,
                    time: time
                },
                success: function(data) {
                    // Update and show dynamic response box beautifully
                    const showBox = document.getElementById('show');
                    const wrapper = document.getElementById('show-wrapper');
                    
                    showBox.innerHTML = data.msg;
                    wrapper.className = "mt-4 p-3.5 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold rounded-xl text-center shadow-sm";
                    wrapper.classList.remove('hidden');

                    // Reset Input Fields
                    document.getElementById('title').value = "";
                    document.getElementById('content').value = "";
                },
                error: function(xhr) {
                    console.error("Error details:", xhr.responseText);
                }
            })
        }
    </script>

</body>
</html>