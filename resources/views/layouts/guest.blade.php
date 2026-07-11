<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <style>
        /* inputs par click karne par auto-zoom rokne ke liye */
        input,
        select,
        textarea {
            font-size: 16px !important;
        }

        /* Double-tap zoom ko browser level par block karne ke liye */
        body {
            touch-action: manipulation;
        }
    </style>
    <script>
    function registerMedianNotificationHandler() {
        if (typeof median !== 'undefined' && median.onesignal) {
            try {
                median.onesignal.registerNotificationOpenedHandler(function(data) {
                    console.log("Notification Clicked! Payload Received:", data);
                    var targetUrl = null;
                    if (data) {
                        if (data.additionalData && data.additionalData.targetUrl) {
                            targetUrl = data.additionalData.targetUrl;
                        } else if (data.notification && data.notification.additionalData && data.notification.additionalData.targetUrl) {
                            targetUrl = data.notification.additionalData.targetUrl;
                        }
                    }
                    if (targetUrl) {
                        window.location.href = targetUrl;
                    }
                });
                console.log("OneSignal Click Handler Registered Successfully!");
            } catch(e) {
                console.error("OneSignal Handler Register Error: " + e.message);
            }
        } else {
            setTimeout(registerMedianNotificationHandler, 500);
        }
    }
    document.addEventListener("DOMContentLoaded", registerMedianNotificationHandler);
</script>
<script>
    function checkAppAndHideButton() {
        var isInsideApp = navigator.userAgent.indexOf('GoNative') > -1 || 
                          navigator.userAgent.indexOf('Median') > -1 || 
                          (typeof median !== 'undefined');

        if (isInsideApp) {
            var downloadSection = document.getElementById('download-app-section');
            if (downloadSection) {
                downloadSection.classList.add('hidden');
                console.log("App detected successfully. Download button is hidden.");
            }
        } else {
            if (!window.checkAppRetryCount) {
                window.checkAppRetryCount = 0;
            }
            if (window.checkAppRetryCount < 6) {
                window.checkAppRetryCount++;
                setTimeout(checkAppAndHideButton, 200);
            }
        }
    }
    document.addEventListener("DOMContentLoaded", checkAppAndHideButton);
</script>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">

    <!-- 1. TEMPORARY RAW RED DIAGNOSTIC BAR (For Testing Only) -->
    @php
        $updateInfo = \App\Helpers\AppVersionHelper::checkUpdate();
    @endphp
    <div style="background: red; color: white; padding: 12px; text-align: center; font-size: 11px; font-weight: bold; position: relative; z-index: 999999;">
        [DIAGNOSTIC] App Layout Loaded. <br>
        User Agent: {{ request()->header('User-Agent') }} <br>
        Needs Update Output: {{ json_encode($updateInfo) }}
    </div>

    <!-- 2. Original Update Modal -->
    @if($updateInfo['needs_update'])
        <!-- Beautiful Tailwind Modal overlay for update -->
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
            <div class="bg-white rounded-3xl p-8 max-w-sm w-full text-center shadow-2xl border border-gray-100">
                <div class="w-16 h-16 bg-[#D48C45]/10 rounded-full flex items-center justify-center mx-auto mb-4 text-[#D48C45]">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-[#4A2E2B] font-serif">New Update Available</h2>
                <p class="text-sm text-gray-500 mt-2 mb-6">A new version of our app is available. Update now to enjoy the latest features without losing your session data.</p>
                
                <div class="space-y-3">
                    <a href="{{ $updateInfo['download_url'] }}" 
                       class="block w-full bg-[#D48C45] hover:bg-[#4A2E2B] text-white font-bold py-3.5 rounded-2xl shadow-lg transition-all duration-300">
                        Update Now
                    </a>
                    
                    @if(!$updateInfo['is_force'])
                        <button onclick="this.closest('.fixed').style.display='none'" class="text-xs text-gray-400 hover:text-gray-600 font-semibold uppercase tracking-wider block mx-auto mt-2">
                            Maybe Later
                        </button>
                    @endif
                </div>
            </div>
        </div>
    @endif

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>
<script>
    document.addEventListener('touchstart', function(event) {
        if (event.touches.length > 1) {
            event.preventDefault();
        }
    }, {
        passive: false
    });

    let lastTouchTime = 0;
    document.addEventListener('touchend', function(event) {
        const now = (new Date()).getTime();
        if (now - lastTouchTime <= 300) {
            event.preventDefault();
        }
        lastTouchTime = now;
    }, false);

    document.addEventListener('wheel', function(event) {
        if (event.ctrlKey) {
            event.preventDefault();
        }
    }, {
        passive: false
    });
</script>

</html>