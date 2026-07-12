<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Meta CSRF Token (Active) -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Driver Dashboard</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 font-sans antialiased min-h-screen">
    
@php
    $updateInfo = \App\Helpers\AppVersionHelper::checkUpdate();
@endphp

@if($updateInfo['needs_update'])
    <!-- Beautiful Inline-CSS Styled Modal (Guaranteed to show up) -->
    <div id="update-modal-overlay" style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.65); display: flex; align-items: center; justify-content: center; z-index: 9999999; padding: 15px; font-family: 'Quicksand', sans-serif; backdrop-filter: blur(4px); -webkit-backdrop-filter: blur(4px);">
        <div style="background: #ffffff; border-radius: 24px; padding: 30px; max-width: 340px; width: 100%; text-align: center; box-shadow: 0 15px 35px rgba(74, 46, 43, 0.15); border: 1px solid rgba(74, 46, 43, 0.05); box-sizing: border-box;">
            
            <!-- Beautiful Round Icon Wrap -->
            <div style="width: 60px; height: 60px; background: rgba(212, 140, 69, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px;">
                <svg style="width: 28px; height: 28px; fill: none; stroke: #D48C45;" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                </svg>
            </div>

            <!-- Title -->
            <h2 style="font-size: 22px; font-weight: bold; color: #4A2E2B; margin-bottom: 10px; margin-top: 0; font-family: inherit;">
                New Update Available
            </h2>
            
            <!-- Description -->
            <p style="font-size: 13.5px; color: #665; line-height: 1.5; margin-bottom: 25px; margin-top: 0; font-family: inherit;">
                A new version of our app is available. Update now to enjoy the latest features without losing your session data.
            </p>
            
            <!-- Actions -->
            <div style="display: flex; flex-direction: column; gap: 10px;">
                <!-- Download Button -->
                <a href="{{ str_replace('http://', 'https://',$updateInfo['download_url']) }}" 
                   style="display: block; width: 100%; background: #D48C45; color: #ffffff; text-decoration: none; font-weight: bold; padding: 13px; border-radius: 14px; font-size: 15px; border: none; box-shadow: 0 4px 12px rgba(212,140,69,0.3); text-align: center; box-sizing: border-box; transition: background 0.2s;">
                    Update Now
                </a>
                
                <!-- Optional Later Button -->
                @if(!$updateInfo['is_force'])
                    
                @endif
            </div>
        </div>
    </div>
@endif

    @if ($data)
    <div class="flex flex-col lg:flex-row min-h-screen">
        
        <!-- Sidebar / Navigation Panel -->
        <div class="w-full lg:w-64 bg-slate-900 text-white p-6 flex flex-col justify-between">
            <div>
                <!-- Portal Brand -->
                <div class="mb-8 border-b border-slate-800 pb-6">
                    <div class="h-14 w-14 rounded-full bg-indigo-600 flex items-center justify-center text-2xl font-bold mb-4 shadow-lg shadow-indigo-600/30">
                        D
                    </div>
                    <h2 class="text-xs uppercase tracking-wider text-slate-400 font-bold">Driver Portal</h2>

                    <h1 class="text-lg font-bold truncate" title="{{ $data->name }}">{{ $data->name }}</h1>
                    <span class="inline-block text-xs text-indigo-400 font-semibold mt-1">License: {{ $data->license_number }}</span>
                </div>

                <!-- Driver Contact & Info details -->
                <div class="space-y-4 text-xs text-slate-400 mb-8">
                    <div>
                        <span class="block uppercase font-bold tracking-wide">School Name</span>
                        <span class="text-slate-200 font-medium break-all">{{ $school_name }}</span>
                    </div>
                    <div>
                        <span class="block uppercase font-bold tracking-wide">Driver Email</span>
                        <span class="text-slate-200 font-medium break-all">{{ $data->email }}</span>
                    </div>
                    <script>
    document.addEventListener("DOMContentLoaded", function() {
        
        if (typeof median !== 'undefined') {
            
          
            var userEmail = "{{ $data->email ?? '' }}"; 
            
            if (userEmail) {
               
                median.onesignal.setExternalUserId(userEmail);
                console.log("OneSignal registered with: " + userEmail);
            }
        }
    });
</script>
                    <div>
                        <span class="block uppercase font-bold tracking-wide">Phone Number</span>
                        <span class="text-slate-200 font-medium">{{ $data->phone }}</span>
                    </div>
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
                </div>
            </div>

            <!-- Logout Button -->
            <div class="pt-6 border-t border-slate-800">
                <button onclick="window.location.href='/logout'" class="flex items-center justify-center gap-2 w-full px-4 py-2.5 bg-red-600/10 hover:bg-red-600 text-red-400 hover:text-white rounded-xl text-xs font-bold transition duration-150">
                    Logout
                </button>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 p-6 lg:p-10 space-y-8">
            
            <!-- Hidden Phone parameter required by AJAX -->
            <input type="hidden" value="{{ $data->phone }}" name="phone" id="phone">

            <!-- Bus Allotment real-time details -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                <h2 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-3 mb-4">🚌 My Assigned Bus Details</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Bus Name</span>
                        <span id="b_name" class="text-base font-semibold text-slate-800 mt-1 block min-h-[24px]">--</span>
                    </div>
                    <div>
                        <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Bus Number</span>
                        <span id="b_number" class="text-base font-semibold text-slate-800 mt-1 block min-h-[24px]">--</span>
                    </div>
                    <div>
                        <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Assigned Route</span>
                        <span id="r_name" class="text-base font-semibold text-indigo-600 mt-1 block min-h-[24px]">--</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6 pt-6 border-t border-slate-100">
                    <div>
                        <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Bus Status</span>
                        <span id="status" class="text-base font-semibold text-slate-800 mt-1 block min-h-[24px]">--</span>
                    </div>
                    <div>
                        <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Available Seats</span>
                        <span id="a_seats" class="text-base font-semibold text-emerald-600 mt-1 block min-h-[24px]">--</span>
                    </div>
                    <div>
                        <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Total Seats</span>
                        <span id="t_seats" class="text-base font-semibold text-slate-800 mt-1 block min-h-[24px]">--</span>
                    </div>
                </div>
            </div>

            <!-- Students List Card Panel -->
            <div class="space-y-4">
                <h2 class="text-xl font-bold text-slate-800">Assigned Route Students</h2>
                
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto w-full">
                        <!-- Dynamic jQuery rendered Table -->
                        <table class="min-w-full divide-y divide-slate-200" id="table_body">
                            <!-- JS will inject the layout here dynamically -->
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
    @endif

    <!-- jQuery & Dynamic AJAX Handlers (Tailwind classes injected directly in layout templates) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var phone = document.getElementById('phone').value;
            console.log(phone);
            if (phone) {
                $.ajax({
                    url: '/fetch-b',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        phone: phone
                    },
                    success: function(data) {
                        console.log(data);
                        document.getElementById('b_name').innerHTML = data.bus_name;
                        document.getElementById('b_number').innerHTML = data.bus_number;
                        document.getElementById('r_name').innerHTML = data.route_name;
                        document.getElementById('status').innerHTML = data.status;
                        document.getElementById('a_seats').innerHTML = data.available_seats;
                        document.getElementById('t_seats').innerHTML = data.total_seats;
                        var route_name = data.route_name;
                        if (route_name) {
                            $.ajax({
                                url: '/fetch-s',
                                type: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    route_name: route_name
                                },
                                success: function(data) {
                                    if(data.length != 0){
                                        console.log(data);
                                        // Header Row with Tailwind Styles
                                        let row = `
                                            <thead class="bg-slate-50">
                                                <tr>
                                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Photo</th>
                                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Name</th>
                                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Father's Name</th>
                                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Mother's Name</th>
                                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Mobile</th>
                                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Guardian Mobile</th>
                                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Department</th>
                                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Address</th>
                                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Stop Name</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-slate-100">
                                        `;
                                        
                                        // Dynamic Rows with Tailwind Styles
                                        data.forEach(d => {
                                            row += `
                                                <tr class="hover:bg-slate-50/50 transition">
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                        <div class="h-10 w-10 rounded-lg overflow-hidden bg-white border border-slate-200 p-0.5">
                                                            <img src="uploads/${d.photo}" class="w-full h-full object-contain rounded" alt="Student Photo">
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-slate-900">${d.name}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">${d.father_name}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">${d.mother_name}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">${d.mobile}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">${d.guardians_mobile}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">${d.depart_name}</td>   
                                                    <td class="px-6 py-4 text-sm text-slate-500 min-w-[150px]">${d.address}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-indigo-600 bg-indigo-50/30">${d.stop_name}</td>
                                                </tr>
                                            `;
                                        });

                                        row += `</tbody>`;
                                        $('#table_body').html(row);
                                    }
                                }
                            })
                        }
                    }
                })
            }
        })
    </script>

</body>
</html>