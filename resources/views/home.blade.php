<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Tracking & Fee Management Portal</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50 font-sans antialiased min-h-screen flex flex-col justify-between">

    <!-- Header Navigation -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">
            <!-- Brand Logo / Title -->
            <div class="flex items-center gap-2">
                <div class="h-9 w-9 rounded-lg bg-indigo-600 flex items-center justify-center text-white font-bold text-lg shadow-md shadow-indigo-600/20">
                    🚌
                </div>
                <span class="text-base font-bold text-slate-800 tracking-tight">TransitFlow</span>
            </div>

            <!-- Header Actions -->
            <div class="flex items-center gap-3">



                <a href="/login" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-xs font-semibold shadow-sm hover:shadow transition">
                    Login to Portal
                </a>
            </div>
        </div>
    </header>

    <!-- Main Hero Section -->
    <main class="flex-1">

        <!-- Hero Banner -->
        <section class="max-w-6xl mx-auto px-4 py-12 md:py-20 text-center">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700 border border-indigo-200/50 mb-4">
                🚀 Real-Time Transit Management System
            </span>
            <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight max-w-3xl mx-auto leading-tight">
                Bus Tracking And Fee Management Of Smart Solution
            </h1>


            <div class="mt-8 flex items-center justify-center gap-4">

                <a href="/login" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-xl shadow-lg shadow-indigo-600/20 hover:shadow-indigo-600/30 transition-all duration-150 transform hover:-translate-y-0.5">
                    Get Started Now
                </a>
                 <div class="hide-in-app my-4">
                    @foreach (File::files(public_path('uploads')) as $file)
                    @if ($file->getExtension()=='apk')
<a
                    href="https://school-bus-tracking-management.up.railway.app/{{ asset('uploads'.$file->getFilename()) }}"
                    download
                    class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm rounded-xl shadow-lg shadow-indigo-600/20 hover:shadow-indigo-600/35 transition duration-150 transform hover:-translate-y-0.5">
                    <svg class="h-5 w-5 text-white animate-bounce" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                    </svg>
                    Download Mobile App (APK)
                </a>
                    
                    @endif
                    
                    @endforeach
                
                </div>

            </div>
        </section>

        <!-- Features grid section -->
        <section class="max-w-6xl mx-auto px-4 pb-16 md:pb-24">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Feature 1: Live Tracking -->
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition">
                    <div class="h-10 w-10 rounded-xl bg-rose-50 border border-rose-100 flex items-center justify-center text-lg mb-4">
                        🛑
                    </div>
                    <h3 class="text-base font-bold text-slate-800">Live Bus Tracking</h3>

                </div>

                <!-- Feature 2: Fee Ledgers -->
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition">
                    <div class="h-10 w-10 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-lg mb-4">
                        💳
                    </div>
                    <h3 class="text-base font-bold text-slate-800">Smart Fee Management</h3>

                </div>

                <!-- Feature 3: Roles Allotment -->
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition">
                    <div class="h-10 w-10 rounded-xl bg-amber-50 border border-amber-100 flex items-center justify-center text-lg mb-4">
                        👤
                    </div>
                    <h3 class="text-base font-bold text-slate-800">Multi-Role Portals</h3>

                </div>

            </div>
        </section>

    </main>

    <!-- Footer Area -->
    <footer class="bg-slate-950 text-slate-400 py-8 border-t border-slate-900 text-center">
        <div class="max-w-6xl mx-auto px-4 text-xs space-y-2">
            <p>&copy; {{ date('Y') }} TransitFlow Management System. All Rights Reserved.</p>
            <p class="text-slate-600">Designed with modern utility systems for real-time fleet operations.</p>
        </div>
    </footer>

</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var isInsideApp = navigator.userAgent.indexOf('GoNative') > -1 || 
                          navigator.userAgent.indexOf('Median') > -1 || 
                          (typeof median !== 'undefined');

        if (isInsideApp) {
            var downloadSection = document.getElementById('download-app-section');
            if (downloadSection) {
                downloadSection.classList.add('hidden');
                console.log("App detected: Download button hidden.");
            }
        }
           $.ajax({
            url: "/ip-fetch",
            type: "GET",
            dataType: "json",
            success: function(data) {
                console.log("Succee");
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        })
    });
</script>


</html>