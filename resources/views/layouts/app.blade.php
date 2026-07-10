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
    // Is code ko Home, Login, aur layouts files me shamil karein:
    function median_onesignal_notification_opened(data) {
        console.log("Notification Data:", data);
        if (data && data.additionalData && data.additionalData.targetUrl) {
            window.location.href = data.additionalData.targetUrl;
        }
    }
    function gonative_onesignal_notification_opened(data) {
        median_onesignal_notification_opened(data);
    }
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