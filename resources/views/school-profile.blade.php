<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Profile </title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 font-sans antialiased min-h-screen">

    @if($data)
    <div class="flex flex-col lg:flex-row min-h-screen">
        
       <!-- Sidebar: School Metadata & Info -->
<div class="w-full lg:w-80 bg-slate-900 text-white p-6 flex flex-col justify-between flex-shrink-0">
    <div>
        
        <!-- Brand Visual Header (Sahi Alignment ke sath) -->
        <div class="mb-8 border-b border-slate-800 pb-6">
            
            <!-- Logo Aur Back Button ki Row -->
            <div class="flex items-center justify-between mb-6">
                <!-- Logo -->
                <div class="h-14 w-12 rounded-xl bg-indigo-600 flex items-center justify-center text-2xl shadow-lg shadow-indigo-600/20">
                    🏫
                </div>
                
                <!-- Back Button (Sleek Dark Theme jo Sidebar se match karta hai) -->
                <button onclick="history.back()" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-slate-800 hover:bg-slate-700 text-slate-200 hover:text-white font-semibold text-xs rounded-lg border border-slate-700/80 transition duration-150 shadow-sm">
                    <svg class="h-3.5 w-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    Back
                </button>
            </div>

            <!-- School Meta Title -->
            <span class="text-[10px] font-bold tracking-wider text-slate-400 uppercase block">Registered Institute</span>
            <h1 class="text-xl font-bold text-white mt-1.5 leading-tight">{{ $data->school_name }}</h1>
        </div>

        <!-- School Details Directory -->
        <div class="space-y-4 mb-8">
            <div>
                <span class="block text-[10px] font-bold tracking-wider text-slate-400 uppercase">School Email</span>
                <span class="text-xs text-slate-200 font-semibold break-all">{{ $data->school_email }}</span>
            </div>

            <div>
                <span class="block text-[10px] font-bold tracking-wider text-slate-400 uppercase">Contact Number</span>
                <span class="text-xs text-slate-200 font-semibold">{{ $data->phone }}</span>
            </div>

            <div>
                <span class="block text-[10px] font-bold tracking-wider text-slate-400 uppercase">Address</span>
                <span class="text-xs text-slate-300 leading-relaxed font-medium block mt-1">{{ $data->address }}</span>
            </div>
        </div>

        <!-- Live Bus Tracking Highlight (Top-tier Action Button) -->
        <div class="pt-2">
            <button 
                onclick="window.location.href='/maps?q={{ Crypt::encryptString($data->school_email) }}'" 
                class="flex items-center justify-between w-full px-4 py-3 bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold rounded-xl shadow-lg shadow-rose-600/20 transition duration-150"
            >
                <span>Live Bus Tracking🛑</span>
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-white"></span>
                </span>
            </button>
        </div>
    </div>

    <!-- Dashboard Footprint -->
    <div class="pt-6 border-t border-slate-800 text-slate-500 text-[10px] text-center">
        &copy; School Management Panel. All Rights Reserved.
    </div>
</div>

        <!-- Main Panel Workspace: Categorized Grid Panels -->
        <div class="flex-1 p-6 lg:p-10 space-y-6">
            
            <div class="mb-4">
                <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">School Profile</h2>
            </div>

            <!-- Categories Action Cards Grid (3 Columns on Large Screens) -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                <!-- Module 1: Student Operations -->
                <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition">
                    <div class="h-10 w-10 rounded-xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-lg mb-4">
                        👥
                    </div>
                    <h3 class="text-base font-bold text-slate-800 border-b border-slate-100 pb-2 mb-3">Student</h3>
                    <div class="flex flex-col gap-2">
                        <a href="/student?q={{ Crypt::encryptString($data->school_email) }}" class="block px-3.5 py-2 text-xs font-semibold text-slate-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition">
                            + Student Register
                        </a>
                        <a href="/studentshow?q={{ Crypt::encryptString($data->school_email) }}" class="block px-3.5 py-2 text-xs font-semibold text-slate-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition">
                            → Show Student Records
                        </a>
                    </div>
                </div>

                <!-- Module 2: Buses Operations -->
                <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition">
                    <div class="h-10 w-10 rounded-xl bg-sky-50 border border-indigo-100 flex items-center justify-center text-lg mb-4">
                        🚌
                    </div>
                    <h3 class="text-base font-bold text-slate-800 border-b border-slate-100 pb-2 mb-3">Buses</h3>
                    <div class="flex flex-col gap-2">
                        <a href="/addbus?q={{ Crypt::encryptString($data->school_email) }}" class="block px-3.5 py-2 text-xs font-semibold text-slate-700 hover:bg-sky-50 hover:text-indigo-600 rounded-lg transition">
                            + Bus Register
                        </a>
                        <a href="/busshow?q={{ Crypt::encryptString($data->school_email) }}" class="block px-3.5 py-2 text-xs font-semibold text-slate-700 hover:bg-sky-50 hover:text-indigo-600 rounded-lg transition">
                            → Show Bus Records
                        </a>
                    </div>
                </div>

                <!-- Module 3: Driver Operations -->
                <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition">
                    <div class="h-10 w-10 rounded-xl bg-teal-50 border border-indigo-100 flex items-center justify-center text-lg mb-4">
                        👤
                    </div>
                    <h3 class="text-base font-bold text-slate-800 border-b border-slate-100 pb-2 mb-3">Driver</h3>
                    <div class="flex flex-col gap-2">
                        <a href="/driverreg?q={{ Crypt::encryptString($data->school_email) }}" class="block px-3.5 py-2 text-xs font-semibold text-slate-700 hover:bg-teal-50 hover:text-indigo-600 rounded-lg transition">
                            + Driver Register
                        </a>
                        <a href="/drivershow?q={{ Crypt::encryptString($data->school_email) }}" class="block px-3.5 py-2 text-xs font-semibold text-slate-700 hover:bg-teal-50 hover:text-indigo-600 rounded-lg transition">
                            → Show Driver Records
                        </a>
                    </div>
                </div>

                <!-- Module 4: Route Operations -->
                <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition">
                    <div class="h-10 w-10 rounded-xl bg-rose-50 border border-rose-100 flex items-center justify-center text-lg mb-4">
                        📍
                    </div>
                    <h3 class="text-base font-bold text-slate-800 border-b border-slate-100 pb-2 mb-3">Route</h3>
                    <div class="flex flex-col gap-2">
                        <a href="/addroute?q={{ Crypt::encryptString($data->school_email) }}" class="block px-3.5 py-2 text-xs font-semibold text-slate-700 hover:bg-rose-50 hover:text-indigo-600 rounded-lg transition">
                            + Route Register
                        </a>
                        <a href="/showroute?q={{ Crypt::encryptString($data->school_email) }}" class="block px-3.5 py-2 text-xs font-semibold text-slate-700 hover:bg-rose-50 hover:text-indigo-600 rounded-lg transition">
                            → Show Route Records
                        </a>
                    </div>
                </div>

                <!-- Module 5: Stop Operations -->
                <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition">
                    <div class="h-10 w-10 rounded-xl bg-amber-50 border border-indigo-100 flex items-center justify-center text-lg mb-4">
                        🛑
                    </div>
                    <h3 class="text-base font-bold text-slate-800 border-b border-slate-100 pb-2 mb-3">Stop</h3>
                    <div class="flex flex-col gap-2">
                        <a href="/add-stop?q={{ Crypt::encryptString($data->school_email) }}" class="block px-3.5 py-2 text-xs font-semibold text-slate-700 hover:bg-amber-50 hover:text-indigo-600 rounded-lg transition">
                            + Stop Register
                        </a>
                        <a href="/show-stops?q={{ Crypt::encryptString($data->school_email) }}" class="block px-3.5 py-2 text-xs font-semibold text-slate-700 hover:bg-amber-50 hover:text-indigo-600 rounded-lg transition">
                            → Show Stop Records
                        </a>
                    </div>
                </div>

                <!-- Module 6: Department Operations -->
                <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition">
                    <div class="h-10 w-10 rounded-xl bg-purple-50 border border-indigo-100 flex items-center justify-center text-lg mb-4">
                        🏢
                    </div>
                    <h3 class="text-base font-bold text-slate-800 border-b border-slate-100 pb-2 mb-3">Department</h3>
                    <div class="flex flex-col gap-2">
                        <a href="/add-depart?q={{ Crypt::encryptString($data->school_email) }}" class="block px-3.5 py-2 text-xs font-semibold text-slate-700 hover:bg-purple-50 hover:text-indigo-600 rounded-lg transition">
                            + Add Department
                        </a>
                        <a href="/show-depart?q={{ Crypt::encryptString($data->school_email) }}" class="block px-3.5 py-2 text-xs font-semibold text-slate-700 hover:bg-purple-50 hover:text-indigo-600 rounded-lg transition">
                            → Show Department Records
                        </a>
                    </div>
                </div>

                <!-- Module 7: Fee Structure Operations -->
                <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition">
                    <div class="h-10 w-10 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-lg mb-4">
                        💳
                    </div>
                    <h3 class="text-base font-bold text-slate-800 border-b border-slate-100 pb-2 mb-3">Fee</h3>
                    <div class="flex flex-col gap-2">
                        <a href="/add-fee?q={{ Crypt::encryptString($data->school_email) }}" class="block px-3.5 py-2 text-xs font-semibold text-slate-700 hover:bg-emerald-50 hover:text-indigo-600 rounded-lg transition">
                            + Add Fee
                        </a>
                        <a href="/show-fee?q={{ Crypt::encryptString($data->school_email) }}" class="block px-3.5 py-2 text-xs font-semibold text-slate-700 hover:bg-emerald-50 hover:text-indigo-600 rounded-lg transition">
                            → Show Fee Structure
                        </a>
                    </div>
                </div>

            </div>
        </div>

    </div>
    @endif

</body>
</html>