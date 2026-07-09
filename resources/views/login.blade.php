<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Panel</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 font-sans antialiased min-h-screen flex items-center justify-center p-4">

    <div class="max-w-md w-full bg-white rounded-2xl border border-slate-200 shadow-xl p-8">
        
        <!-- Back Button & Header -->
        <div class="mb-6">
            <button onclick="history.back()" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-slate-800 transition mb-4">
                ← Back
            </button>
            <h1 class="text-2xl font-bold text-slate-800">Login</h1>
        </div>

        <!-- Form Start -->
        <form action="/login" method="post" class="space-y-5">
            @csrf

            <!-- Email Address Field -->
            <div>
                <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Email Address</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="Enter your email"
                    class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                    required
                >
            </div>

            <!-- Password Field -->
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                </div>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    placeholder="Enter your password"
                    class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                    required
                >
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <button 
                    type="submit" 
                    class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm rounded-lg shadow-sm hover:shadow transition duration-150 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Login
                </button>
            </div>

            <!-- Validation Session Alerts -->
            @if (session('error') == 'error')
                <!-- Error: Email & Password Not Match -->
                <div class="p-3.5 bg-rose-50 border border-rose-200 rounded-xl flex items-start gap-2.5">
                    <svg class="h-4 w-4 text-rose-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <div>
                        <h4 class="text-xs font-bold text-rose-800">Login Failed</h4>
                        <p class="text-[11px] text-rose-700 mt-0.5">Email and Password do not match. Please try again.</p>
                    </div>
                </div>
            @elseif(session('error') == 'error-email')
                <!-- Error: Email Not Found -->
                <div class="p-3.5 bg-rose-50 border border-rose-200 rounded-xl flex items-start gap-2.5">
                    <svg class="h-4 w-4 text-rose-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <div>
                        <h4 class="text-xs font-bold text-rose-800">Account Alert</h4>
                        <p class="text-[11px] text-rose-700 mt-0.5">This Email is not registered in our system.</p>
                    </div>
                </div>
            @endif

            <!-- Switching/Navigation Link (Added Here) -->
            <div class="mt-6 text-center text-xs text-slate-500 border-t border-slate-100 pt-5">
                Don't have an account yet? 
                <!-- Replace /school-register with your actual registration routing path if needed -->
                <a href="/school-reg" class="text-indigo-600 hover:text-indigo-700 font-semibold transition">Register here</a>
            </div>

        </form>
        <!-- Form End -->

    </div>

</body>
</html>