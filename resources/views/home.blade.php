<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Tracking & Fee Management Portal</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<!-- 1. Diagnostic Bar (इसे टेस्ट पूरा होने के बाद हटा सकते हैं) -->
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
                <a href="{{ $updateInfo['download_url'] }}" 
                   style="display: block; width: 100%; background: #D48C45; color: #ffffff; text-decoration: none; font-weight: bold; padding: 13px; border-radius: 14px; font-size: 15px; border: none; box-shadow: 0 4px 12px rgba(212,140,69,0.3); text-align: center; box-sizing: border-box; transition: background 0.2s;">
                    Update Now
                </a>
                
                <!-- Optional Later Button -->
                @if(!$updateInfo['is_force'])
                    <button onclick="document.getElementById('update-modal-overlay').style.display='none'" 
                            style="display: block; margin: 8px auto 0; background: none; border: none; color: #999; font-size: 12px; font-weight: bold; text-transform: uppercase; cursor: pointer; letter-spacing: 0.5px;">
                        Maybe Later
                    </button>
                @endif
            </div>
        </div>
    </div>
@endif
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
            
            <a href="{{ str_replace('http://', 'https://', asset('uploads/'.$file->getFilename())) }}" {{-- yaha bhi --}}
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