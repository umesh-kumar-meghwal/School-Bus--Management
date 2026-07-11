<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 font-sans antialiased min-h-screen">

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
                <h1 class="text-xl font-bold tracking-tight text-white mb-6">Admin Dashboard</h1>
            </div>
                <div class="space-y-3">
                    <button onclick="window.location.href='/apk'" class="w-full px-4 py-3 bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-semibold rounded-xl border border-slate-700 text-left transition duration-150">
                        APK File Upload
                    </button>
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
                <button onclick="window.location.href='/maps'" class="inline-flex items-center gap-3 px-6 py-4 bg-rose-600 hover:bg-rose-700 text-white font-semibold rounded-xl shadow-lg shadow-rose-600/30 transition-all duration-200 transform hover:-translate-y-0.5">
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
                        👤 Users & Admins
                    </h3>
                    <div class="flex flex-col gap-2">
                        <a href="/adminreg" class="block w-full text-left px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-indigo-600 rounded-lg transition">
                            + Admin Registeration
                        </a>
                        <a href="/adminshow" class="block w-full text-left px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-indigo-600 rounded-lg transition">
                            → Show Admin
                        </a>
                        
                    </div>
                </div>

                <!-- Card 2: Schoool -->
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition duration-200">
                    <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center gap-2">
                        🚌 Schools Management
                    </h3>
                    <div class="flex flex-col gap-2">

                        <a href="/show-school" class="block w-full text-left px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-indigo-600 rounded-lg transition">
                            → Schools Show
                        </a>
                        <div class="h-[1px] bg-slate-100 my-1"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>

</html>