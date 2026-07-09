<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 font-sans antialiased min-h-screen">

    @if ($data)
    <div class="flex flex-col lg:flex-row min-h-screen">
        
        <!-- Sidebar / Navigation Panel -->
        <div class="w-full lg:w-64 bg-slate-900 text-white p-6 flex flex-col justify-between">
            <div>
                <!-- Back Button -->
                <button onclick="history.back()" class="flex items-center gap-2 text-sm text-slate-400 hover:text-white transition mb-6">
                    ← Back
                </button>

                <!-- Student Quick Header -->
                <div class="mb-8 border-b border-slate-800 pb-6">
                    <!-- Photo Display Container (Aspect Ratio Safe) -->
                    <div class="h-24 w-24 rounded-xl overflow-hidden bg-white border border-slate-700 shadow-md mb-4 p-0.5">
                        <img src="{{ asset('uploads/'.$data->photo) }}" class="w-full h-full object-contain rounded-lg" alt="Profile">
                    </div>
                    
                    <h2 class="text-xs uppercase tracking-wider text-slate-400 font-bold">Student Portal</h2>
                    <h1 class="text-lg font-bold truncate" title="{{ $data->name }}">{{ $data->name }}</h1>
                    <span class="inline-block text-lrg text-yellow-400 font-semibold mt-1">{{ $school_name }} </span>

                    <span class="inline-block text-xs text-indigo-400 font-semibold mt-1">{{ $data->depart_name }} Dept</span>
                </div>

                <!-- Navigation Quick Utilities -->
                <div class="space-y-3">
                    <!-- Live Bus Button -->
                    <button onclick="window.location.href='/maps?q={{ Crypt::encryptString($school_email) }}'" class="flex items-center justify-between w-full px-4 py-3 bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold rounded-xl shadow-lg shadow-rose-600/20 transition duration-150">
                        <span>Live Bus Tracking</span>
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-white"></span>
                        </span>
                    </button>

                    <!-- Fee Details Button -->
                    <button onclick="window.location.href='/s-fee-details'" class="w-full px-4 py-3 bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-semibold rounded-xl border border-slate-700 text-left transition duration-150">
                        💳 My Fee Details
                    </button>
                </div>
            </div>

            <!-- Logout Link -->
            <div class="pt-6 border-t border-slate-800">
                <a href="logout" class="flex items-center justify-center gap-2 w-full px-4 py-2.5 bg-red-600/10 hover:bg-red-600 text-red-400 hover:text-white rounded-xl text-xs font-bold transition duration-150">
                    Logout
                </a>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 p-6 lg:p-10">
            
            <div class="grid grid-cols-1 xl:grid-cols-12 gap-8">
                
                <!-- Col 1: Personal Details Card (Span 5) -->
                <div class="xl:col-span-5 bg-white rounded-2xl border border-slate-200 shadow-sm p-6 flex flex-col justify-between">
                    <div>
                        <h2 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-3 mb-5">📋 Student Details</h2>
                        
                        <div class="space-y-4">
                            <div>
                                <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Student Name</span>
                                <span class="text-sm font-semibold text-slate-800 mt-1 block">{{ $data->name }}</span>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Father's Name</span>
                                    <span class="text-sm font-semibold text-slate-800 mt-1 block">{{ $data->father_name }}</span>
                                </div>
                                <div>
                                    <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Mother's Name</span>
                                    <span class="text-sm font-semibold text-slate-800 mt-1 block">{{ $data->mother_name }}</span>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Student Mobile</span>
                                    <span class="text-sm font-semibold text-slate-800 mt-1 block">{{ $data->mobile }}</span>
                                </div>
                                <div>
                                    <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Guardian's Mobile</span>
                                    <span class="text-sm font-semibold text-slate-800 mt-1 block">{{ $data->guardians_mobile }}</span>
                                </div>
                            </div>

                            <div>
                                <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Email Address</span>
                                <span class="text-sm font-semibold text-slate-800 mt-1 block">{{ $data->email }}</span>
                            </div><script>
    document.addEventListener("DOMContentLoaded", function() {
        
        if (typeof median !== 'undefined') {
            
            // User login email ko OneSignal ke sath connect karein (External User ID)
            // Yahan Laravel se logged-in user ka email pass karein
            var userEmail = "{{ $data->email ?? '' }}"; 
            
            if (userEmail) {
             
                median.onesignal.setExternalUserId(userEmail);
                console.log("OneSignal registered with: " + userEmail);
            }
        }
    });
</script>

                            <div>
                                <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Home Address</span>
                                <span class="text-sm font-semibold text-slate-800 mt-1 block">{{ $data->address }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Col 2: Bus Allotment & Timing Card (Span 7 - Rendered Conditionally) -->
                <div class="xl:col-span-7 space-y-6">
                    @if ($data->route_name != null)
                        
                        <!-- Header for Bus Details -->
                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                            <h2 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-3 mb-4">📍 Route & Timing Details</h2>
                            
                            <!-- Hidden Fields (Required by original AJAX/JS) -->
                            <input type="hidden" id="route_name" value="{{ $data->route_name }}">
                            <input type="hidden" value="{{ $data->stop_name }}" name="st_name" id="t">
                            <input type="hidden" value="{{ $school_email }}" id="school_email">

                            <div class="space-y-4">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Route Name</span>
                                        <span class="text-sm font-semibold text-slate-800 mt-1 block">{{ $data->route_name }}</span>
                                    </div>
                                    <div>
                                        <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Stop Name</span>
                                        <span class="text-sm font-semibold text-slate-800 mt-1 block">{{ $data->stop_name }}</span>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4 pt-2">
                                    <div class="bg-emerald-50/50 border border-emerald-100 p-3 rounded-xl">
                                        <span class="block text-xs font-bold text-emerald-600 uppercase">Pick Up</span>
                                        <span class="text-sm font-bold text-emerald-800 mt-1 block">
                                            <span id="pt">--:--</span> AM
                                        </span>
                                    </div>

                                    <div class="bg-amber-50/50 border border-amber-100 p-3 rounded-xl">
                                        <span class="block text-xs font-bold text-amber-600 uppercase">Drop Off</span>
                                        <span class="text-sm font-bold text-amber-800 mt-1 block">
                                            <span id="dt">--:--</span> PM
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card: Realtime Bus & Driver Information -->
                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                            <h2 class="text-sm font-bold text-slate-400 uppercase tracking-wider border-b border-slate-100 pb-3 mb-4">🚌 Allotted Bus Information</h2>
                            
                            <div class="space-y-4">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <span class="block text-xs font-bold text-slate-400 uppercase">Bus Number</span>
                                        <p id="b-num" class="text-sm font-semibold text-slate-800 mt-1 min-h-[20px] bg-slate-50 px-2.5 py-1 rounded-lg"></p>
                                    </div>
                                    <div>
                                        <span class="block text-xs font-bold text-slate-400 uppercase">Bus Name</span>
                                        <p id="b-name" class="text-sm font-semibold text-slate-800 mt-1 min-h-[20px] bg-slate-50 px-2.5 py-1 rounded-lg"></p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <span class="block text-xs font-bold text-slate-400 uppercase">Driver Name</span>
                                        <p id="d-name" class="text-sm font-semibold text-slate-800 mt-1 min-h-[20px] bg-slate-50 px-2.5 py-1 rounded-lg"></p>
                                    </div>
                                    <div>
                                        <span class="block text-xs font-bold text-slate-400 uppercase">Driver Phone</span>
                                        <p id="d-phone" class="text-sm font-semibold text-slate-800 mt-1 min-h-[20px] bg-slate-50 px-2.5 py-1 rounded-lg"></p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4 border-t border-slate-100 pt-4">
                                    <div class="bg-indigo-50/30 border border-indigo-100 p-3 rounded-xl text-center">
                                        <span class="block text-xs font-bold text-indigo-600 uppercase">Total Seats</span>
                                        <p id="t-s" class="text-lg font-bold text-indigo-800 mt-1"></p>
                                    </div>
                                    <div class="bg-emerald-50/30 border border-emerald-100 p-3 rounded-xl text-center">
                                        <span class="block text-xs font-bold text-emerald-600 uppercase">Available Seats</span>
                                        <p id="a-s" class="text-lg font-bold text-emerald-800 mt-1"></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @else
                        <!-- If route is not allotted -->
                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8 text-center">
                            <div class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-slate-100 text-slate-400 mb-4">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <h3 class="text-base font-bold text-slate-800">No Bus Allotted</h3>
                        </div>
                    @endif
                </div>

            </div>

        </div>

    </div>
    @endif

    <!-- jQuery & Original JavaScript API Fetch Logic -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        var school_email = document.getElementById("school_email").value;
        document.addEventListener("DOMContentLoaded", function() {

            var tElement = document.getElementById('t');
            
            var t = tElement ? tElement.value : null;
            console.log(t);
            if(t){
                $.ajax({
                    url:'/t-fetch',
                    type:'POST',
                    data:{
                        _token:'{{ csrf_token() }}',
                        t:t,
                        school_email:school_email
                    },
                    success:function(data){
                        console.log(data);
                        document.getElementById('pt').innerHTML=data.pickup_time;
                        document.getElementById('dt').innerHTML=data.drop_time;
                    }
                })
            }

            var routeNameElement = document.getElementById('route_name');
            var routeName = routeNameElement ? routeNameElement.value : null;
            console.log(routeName);
            
            if (routeName) {
                $.ajax({
                    url: '/bus-fetch',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        route_name: routeName,
                        school_email:school_email
                    },
                    success: function(data) {
                        console.log(data);
                        document.getElementById('b-num').innerHTML = data.bus_number;
                        document.getElementById('b-name').innerHTML = data.bus_name;
                        document.getElementById('d-name').innerHTML = data.driver_name;
                        document.getElementById('d-phone').innerHTML = data.driver_phone;
                        document.getElementById('t-s').innerHTML = data.total_seats;
                        document.getElementById('a-s').innerHTML = data.available_seats;
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            } else {
                $('#stopSelect').empty();
            }
        });
    </script>

</body>
</html>