<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Meta Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Student Push Notifications</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 font-sans antialiased min-h-screen p-4 md:p-8 flex items-center justify-center">

    <div class="max-w-6xl w-full">
        
        <!-- Top Navigation & Header -->
        <div class="mb-6">
            <button onclick="history.back()" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-slate-800 transition mb-3">
                ← Back
            </button>
            <h1 class="text-2xl font-bold text-slate-800">Student Push Notifications</h1>
        </div>

        <!-- 2-Column Grid Workspace -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Left Side: Compose & Send Form (Col Span 5) -->
            <div class="lg:col-span-5 bg-white p-6 md:p-8 rounded-2xl border border-slate-200 shadow-xl">
                <h2 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-3 mb-5">
                    📣 Compose Notification
                </h2>

                <!-- Form Elements (AJAX Managed) -->
                <div class="space-y-4">
                    
                    <!-- Title Input -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-slate-700 mb-1.5">Enter the Title</label>
                        <input 
                            type="text" 
                            name="title" 
                            id="title" 
                            placeholder="e.g. Fees Overdue Alert 💳"
                            class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                            required
                        >
                    </div>

                    <!-- Content Textarea -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-slate-700 mb-1.5">Enter the Content</label>
                        <textarea 
                            name="content" 
                            id="content" 
                            rows="4"
                            placeholder="Type your notification message body here..."
                            class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                            required
                        ></textarea>
                    </div>

                    <!-- Hidden Parameters -->
                    <input type="hidden" name="school_email" value="{{ $school_email }}" id="school_email" />
                    <input type="hidden" name="st_email" value="{{ $st_email }}" id="st_email" />

                    <!-- Submit Button -->
                    <div class="pt-2">
                        <button 
                            onclick="myfunction()" 
                            class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm rounded-lg shadow-sm hover:shadow transition duration-150 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        >
                            Push Notification 🚀
                        </button>
                    </div>

                    <!-- Dynamic Response Box (Hidden by default, shown on AJAX Success) -->
                    <div id="show-wrapper" class="hidden">
                        <p id="show"></p>
                    </div>

                </div>
            </div>

            <!-- Right Side: Sent History Table (Col Span 7) -->
            <div class="lg:col-span-7 bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                <h2 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-3 mb-5">
                    📜 Sent History
                </h2>

                @if($data && count($data)>0)
                    <!-- Responsive Table -->
                    <div class="overflow-x-auto w-full rounded-xl border border-slate-200">
                        <table class="min-w-full divide-y divide-slate-200">
                            <thead class="bg-slate-50">
                                <tr>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Title</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Content</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Date & Time</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-100">
                                @foreach ($data as $d)
                                <tr class="hover:bg-slate-50/50 transition">
                                    <!-- Title -->
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-semibold text-slate-800">{{ $d->title }}</td>
                                    
                                    <!-- Content -->
                                    <td class="px-4 py-3 text-xs text-slate-600 min-w-[200px]">{{ $d->content }}</td>
                                    
                                    <!-- Date & Time -->
                                    <td class="px-4 py-3 whitespace-nowrap text-xs text-slate-400 font-medium">
                                        <div>{{ $d->date }}</div>
                                        <div class="text-[10px] mt-0.5">{{ $d->time }}</div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <!-- Empty State for History -->
                    <div class="text-center py-12">
                        <div class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-slate-100 text-slate-400 mb-3">
                            📜
                        </div>
                        <h3 class="text-sm font-semibold text-slate-800">No Notifications Sent</h3>
                    </div>
                @endif
            </div>

        </div>

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
            var st_email = document.getElementById("st_email").value;

            // Check if fields are empty
            if (!title || !content) {
                alert("Please fill both Title and Content fields.");
                return;
            }

            $.ajax({
                url: "/s-pushed",
                type: "GET",
                data: {
                    _token: "{{ csrf_token() }}",
                    title: title,
                    content: content,
                    school_email: school_email,
                    st_email: st_email,
                    date: date,
                    time: time
                },
                success: function(data) {
                    // Update and show dynamic response box
                    const showBox = document.getElementById('show');
                    const wrapper = document.getElementById('show-wrapper');
                    
                    showBox.innerHTML = data.msg;
                    wrapper.className = "mt-4 p-3.5 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold rounded-xl text-center shadow-sm";
                    wrapper.classList.remove('hidden');

                    // Reset Inputs
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