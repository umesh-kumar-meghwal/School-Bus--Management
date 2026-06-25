<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Meta CSRF Token (Active) -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bus Details</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 font-sans antialiased min-h-screen p-4 md:p-8">

    <div class="max-w-4xl mx-auto">
        
        <!-- Top Navigation & Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <button onclick="history.back()" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-slate-800 transition mb-2">
                    ← Back
                </button>
                <h1 class="text-2xl font-bold text-slate-800">Bus Details</h1>
            </div>
        </div>

        @if ($data)

            @if ($data->route_name == '')
                
                <!-- State: No Bus Assigned -->
                <div class="bg-white rounded-2xl border border-slate-200 shadow-xl p-8 text-center max-w-md mx-auto mt-10">
                    <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-amber-50 text-amber-500 mb-5">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800">No Bus Assigned</h3>
                    
                    <form action="/assign-bus" method="post">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">
                        <button type="submit" class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-lg shadow transition">
                            Assign Bus Route
                        </button>
                    </form>
                </div>

            @else

                <!-- State: Bus Assigned (2-Column Dashboard Layout) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- Card 1: Route & Timing Info -->
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 flex flex-col justify-between">
                        <div>
                            <h2 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-3 mb-4">📍 Route & Timing</h2>
                            
                            <!-- Hidden Fields (Retained for JS) -->
                            <input type="hidden" id="route_name" value="{{ $data->route_name }}">
                            <input type="hidden" value="{{ $data->stop_name }}" name="st_name" id="t">
                            <input type="hidden" value="{{ $data->email }}" id="d-email" name="email">

                            <div class="space-y-4">
                                <div>
                                    <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Route Name</span>
                                    <span class="text-base font-semibold text-slate-800 mt-0.5 block">{{ $data->route_name }}</span>
                                </div>

                                <div>
                                    <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Stop Name</span>
                                    <span class="text-base font-semibold text-slate-800 mt-0.5 block">{{ $data->stop_name }}</span>
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

                        <!-- Actions (Edit & Cancel Bus) -->
                        <div class="flex items-center gap-3 mt-6 pt-6 border-t border-slate-100">
                            <!-- Edit Form -->
                            <form action="/assign-bus" method="post" class="flex-1">
                                @csrf
                                <input type="hidden" name="email" value="{{ $email }}">
                                <button type="submit" class="w-full py-2 px-4 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 font-semibold text-xs rounded-lg transition border border-indigo-200">
                                    Edit Route
                                </button>
                            </form>
                            <form action="/d-drop" method="post" class="flex-1">
                                @csrf
                                <input type="hidden" name="email" value="{{ $email }}">
                                <button type="submit" class="flex-1 py-2 px-4 bg-rose-50 hover:bg-rose-100 text-rose-700 font-semibold text-xs rounded-lg transition border border-rose-200">
                                Cancel Bus
                            </button>
                            </form>
                            <!-- Cancel Button (Targeted by original jQuery with ID: btn) -->
                            
                        </div>
                    </div>

                    <!-- Card 2: Bus & Driver Information -->
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                        <h2 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-3 mb-4">🚌 Bus & Driver Details</h2>
                        
                        <div class="space-y-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Bus Number</span>
                                    <p id="b-num" class="text-sm font-semibold text-slate-800 mt-1 min-h-[20px] bg-slate-50 px-2 py-1 rounded"></p>
                                </div>
                                <div>
                                    <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Bus Name</span>
                                    <p id="b-name" class="text-sm font-semibold text-slate-800 mt-1 min-h-[20px] bg-slate-50 px-2 py-1 rounded"></p>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Driver Name</span>
                                    <p id="d-name" class="text-sm font-semibold text-slate-800 mt-1 min-h-[20px] bg-slate-50 px-2 py-1 rounded"></p>
                                </div>
                                <div>
                                    <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Driver Phone</span>
                                    <p id="d-phone" class="text-sm font-semibold text-slate-800 mt-1 min-h-[20px] bg-slate-50 px-2 py-1 rounded"></p>
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

                </div>

            @endif

        @endif

    </div>

    <!-- jQuery & JavaScript API Logic (Original logic with no changes) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            var t = document.getElementById('t').value;
            console.log(t);
            if(t){
                $.ajax({
                    url:'/t-fetch',
                    type:'POST',
                    data:{
                        _token:'{{ csrf_token() }}',
                        t:t
                    },
                    success:function(data){
                        console.log(data);
                        document.getElementById('pt').innerHTML=data.pickup_time;
                        document.getElementById('dt').innerHTML=data.drop_time;
                    }
                })
            }

            var routeName = document.getElementById('route_name').value;
            console.log(routeName);
            
            if (routeName) {
                $.ajax({
                    url: '/bus-fetch',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        route_name: routeName
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