<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
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
        <!-- Scripts -->
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
