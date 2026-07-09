<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Page | Page Not Found</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 font-sans antialiased min-h-screen flex items-center justify-center p-4">

    <!-- Error Card Container -->
    <div class="max-w-md w-full bg-white rounded-2xl border border-slate-200 shadow-xl p-8 text-center">
        
        <!-- Large Warning Icon / Visual Node -->
        <div class="inline-flex items-center justify-center h-20 w-20 rounded-full bg-rose-50 text-rose-600 border border-rose-100 mb-6 shadow-sm">
            <svg class="h-10 w-10 animate-bounce" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
        </div>

        <!-- Error Heading -->
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">404 Error</h1>
        <h2 class="text-base font-semibold text-slate-800 mt-2">Page Not Found</h2>
        
        <!-- Descriptive Error Message -->
       

        <!-- Redirect Button (Original JS Callback Targets) -->
        <div class="mt-8 pt-6 border-t border-slate-100">
            <button 
                onclick="myfunction()" 
                class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm rounded-lg shadow-sm hover:shadow transition duration-150 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
            >
                Go to Login
            </button>
        </div>

    </div>

    <!-- Original Redirection Script -->
    <script>
        function myfunction() {
            window.location.href = "/login";
        }
    </script>

</body>
</html>