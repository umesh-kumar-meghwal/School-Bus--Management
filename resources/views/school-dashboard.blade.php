<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Dashboard</title>
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

    <div class="flex flex-col md:flex-row min-h-screen">
        
        <!-- Sidebar / User Info Panel -->
        <div class="w-full md:w-64 bg-slate-900 text-white p-6 flex flex-col justify-between">
            <div>
                <!-- Back Button -->
                <button onclick="history.back()" class="flex items-center gap-2 text-sm text-slate-400 hover:text-white transition duration-200 mb-8">
                    ← Back
                </button>

                <!-- Profile Info -->
                <div class="mb-8 border-b border-slate-700 pb-6">
                    <div class="h-12 w-12 rounded-full bg-indigo-600 flex items-center justify-center text-xl font-bold mb-3">
                        A
                    </div>
                    <h2 class="text-xs uppercase tracking-wider text-slate-400 font-semibold">User Email</h2>
                    <p class="text-sm font-medium truncate mb-3" title="{{$email}}">{{$email}}</p>
                    
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-500/10 text-indigo-400 border border-indigo-500/20">
                        {{$usertype}}
                    </span>
                </div>

                <!-- Navigation Header -->
                <h1 class="text-xl font-bold tracking-tight text-white mb-6">School Dashboard</h1>
            </div>

            <!-- Logout Button -->
            <div class="pt-6 border-t border-slate-700">
                <a href="/logout" class="flex items-center justify-center gap-2 w-full px-4 py-2 bg-red-600/20 hover:bg-red-600 text-red-200 hover:text-white rounded-lg text-sm font-medium transition duration-200">
                    Logout
                </a>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 p-6 md:p-10">
            
            <!-- Live Bus Special Callout -->
            <div class="mb-8">
                <button onclick="window.location.href='/maps?q={{ Crypt::encryptString($email) }}'" class="inline-flex items-center gap-3 px-6 py-4 bg-rose-600 hover:bg-rose-700 text-white font-semibold rounded-xl shadow-lg shadow-rose-600/30 transition-all duration-200 transform hover:-translate-y-0.5">
                    <span class="relative flex h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-white"></span>
                    </span>
                    Live Bus 🛑
                </button>
            </div>

            <!-- Dashboard Modules Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                
                <!-- Card 1: User Registration -->
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition duration-200">
                    <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center gap-2">
                        👤 Students
                    </h3>
                    <div class="flex flex-col gap-2">
                        <div class="h-[1px] bg-slate-100 my-1"></div>
                        <a href="/student?q={{ Crypt::encryptString($email) }}" class="block w-full text-left px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-indigo-600 rounded-lg transition">
                            + Student Register
                        </a>
                        <a href="/studentshow?q={{ Crypt::encryptString($email) }}" class="block w-full text-left px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-indigo-600 rounded-lg transition">
                            → Student Show
                        </a>
                        <a href="/push?q={{ Crypt::encryptString($email) }}" class="block w-full text-left px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-indigo-600 rounded-lg transition">
                            → Push Notifications
                        </a>
                    </div>
                </div>
                <script>
    document.addEventListener("DOMContentLoaded", function() {
    
        if (typeof median !== 'undefined') {
        
        
            var userEmail = "{{ $email ?? '' }}"; 
            
            if (userEmail) {
            
                median.onesignal.setExternalUserId(userEmail);
                console.log("OneSignal registered with: " + userEmail);
            }
        }
    });
</script>

                <!-- Card 2: Transport & Drivers -->
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition duration-200">
                    <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center gap-2">
                        🚌 Bus & Driver Management
                    </h3>
                    <div class="flex flex-col gap-2">
                        <a href="/addbus?q={{ Crypt::encryptString($email) }}" class="block w-full text-left px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-indigo-600 rounded-lg transition">
                            + Bus Registeration
                        </a>
                        <a href="/busshow?q={{ Crypt::encryptString($email) }}" class="block w-full text-left px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-indigo-600 rounded-lg transition">
                            → Bus Show
                        </a>
                        <div class="h-[1px] bg-slate-100 my-1"></div>
                        <a href="/driverreg?q={{ Crypt::encryptString($email) }}" class="block w-full text-left px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-indigo-600 rounded-lg transition">
                            + Driver Register
                        </a>
                        <a href="/drivershow?q={{ Crypt::encryptString($email) }}" class="block w-full text-left px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-indigo-600 rounded-lg transition">
                            → Driver Show
                        </a>
                    </div>
                </div>

                <!-- Card 3: Routes & Stops -->
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition duration-200">
                    <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center gap-2">
                        📍 Routes & Stops
                    </h3>
                    <div class="flex flex-col gap-2">
                        <a href="/addroute?q={{ Crypt::encryptString($email) }}" class="block w-full text-left px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-indigo-600 rounded-lg transition">
                            → Route Register

                        </a>

                        <a href="/showroute?q={{ Crypt::encryptString($email) }}" class="block w-full text-left px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-indigo-600 rounded-lg transition">
                            → Show Route

                        </a>
                        <a href="/add-stop?q={{ Crypt::encryptString($email) }}" class="block w-full text-left px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-indigo-600 rounded-lg transition">
                            → Add Stop
                        </a>
                        <a href="/show-stops?q={{ Crypt::encryptString($email) }}" class="block w-full text-left px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-indigo-600 rounded-lg transition">
                            → Show Stop
                        </a>
                    </div>
                </div>

                <!-- Card 4: Departments -->
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition duration-200">
                    <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center gap-2">
                        🏢 Departments
                    </h3>
                    <div class="flex flex-col gap-2">
                        <a href="/add-depart?q={{ Crypt::encryptString($email) }}" class="block w-full text-left px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-indigo-600 rounded-lg transition">
                            + Add Department
                        </a>
                        <a href="/show-depart?q={{ Crypt::encryptString($email) }}" class="block w-full text-left px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-indigo-600 rounded-lg transition">
                            → Show Department
                        </a>
                    </div>
                </div>

                <!-- Card 5: Fee Management -->
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition duration-200">
                    <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center gap-2">
                        💳 Fee Management
                    </h3>
                    <div class="flex flex-col gap-2">
                        <a href="/add-fee?q={{ Crypt::encryptString($email) }}" class="block w-full text-left px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-indigo-600 rounded-lg transition">
                            + Add Fee
                        </a>
                        <a href="/show-fee?q={{ Crypt::encryptString($email) }}" class="block w-full text-left px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-indigo-600 rounded-lg transition">
                            → Show Fee
                        </a>
                    </div>
                </div>

            </div>
        </div>

    </div>

</body>
</html>