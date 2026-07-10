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
        // Check karein ke mobile bridge aur onesignal dastyab hain ya nahi
        if (typeof median !== 'undefined' && median.onesignal) {
            
            try {
                // Official Median callback register karein
                median.onesignal.registerNotificationOpenedHandler(function(data) {
                    console.log("Notification Clicked! Payload Received:", data);
                    
                    var targetUrl = null;

                    // OneSignal v5 aur purane versions dono ke data structure ko support karne ke liye:
                    if (data) {
                        if (data.additionalData && data.additionalData.targetUrl) {
                            targetUrl = data.additionalData.targetUrl;
                        } else if (data.notification && data.notification.additionalData && data.notification.additionalData.targetUrl) {
                            targetUrl = data.notification.additionalData.targetUrl;
                        }
                    }

                    // Agar targetUrl dastyab ho toh redirect karein
                    if (targetUrl) {
                        window.location.href = targetUrl;
                    }
                });
                
                console.log("OneSignal Click Handler Registered Successfully!");
                
            } catch(e) {
                console.error("OneSignal Handler Register Error: " + e.message);
            }
            
        } else {
            // Agar bridge abhi load nahi hua, toh 500ms baad dobara koshish karein
            setTimeout(registerMedianNotificationHandler, 500);
        }
    }

    // Page load hote hi registration process start karein
    document.addEventListener("DOMContentLoaded", registerMedianNotificationHandler);
</script>
<script>
    function checkAppAndHideButton() {
        // 1. App aur standard browser User-Agents ko check karein
        var isInsideApp = navigator.userAgent.indexOf('GoNative') > -1 || 
                          navigator.userAgent.indexOf('Median') > -1 || 
                          (typeof median !== 'undefined');

        if (isInsideApp) {
            // Agar app detected ho jaye, toh button ko instantly hide kar dein
            var downloadSection = document.getElementById('download-app-section');
            if (downloadSection) {
                downloadSection.classList.add('hidden');
                console.log("App detected successfully. Download button is hidden.");
            }
        } else {
            // Agar bridge abhi load nahi hua, toh har 200ms par 5 martaba check karein (Timing mismatch dur karne ke liye)
            if (!window.checkAppRetryCount) {
                window.checkAppRetryCount = 0;
            }
            
            if (window.checkAppRetryCount < 6) {
                window.checkAppRetryCount++;
                setTimeout(checkAppAndHideButton, 200);
            }
        }
    }

    // Page load hote hi checking start karein
    document.addEventListener("DOMContentLoaded", checkAppAndHideButton);
</script>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
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
    // 1. Pinch-to-zoom block (Multi-finger zoom)
    document.addEventListener('touchstart', function(event) {
        if (event.touches.length > 1) {
            event.preventDefault();
        }
    }, {
        passive: false
    });

    // 2. Double-tap to zoom block
    let lastTouchTime = 0;
    document.addEventListener('touchend', function(event) {
        const now = (new Date()).getTime();
        if (now - lastTouchTime <= 300) {
            event.preventDefault();
        }
        lastTouchTime = now;
    }, false);

    // 3. Desktop Ctrl + Scroll zoom block (optional)
    document.addEventListener('wheel', function(event) {
        if (event.ctrlKey) {
            event.preventDefault();
        }
    }, {
        passive: false
    });
</script>

</html>