<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Route</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 font-sans antialiased min-h-screen flex items-center justify-center p-4 md:p-8">

    <div class="max-w-2xl w-full bg-white rounded-2xl border border-slate-200 shadow-xl p-6 md:p-8">
        
        <!-- Back Button & Header -->
        <div class="mb-6">
            <button onclick="history.back()" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-slate-800 transition mb-4">
                ← Back
            </button>
            <h1 class="text-2xl font-bold text-slate-800">Add Route</h1>
        </div>

        <!-- Form Start -->
        <form action="/addroute" method="post" class="space-y-6">
            @csrf

            <!-- Form Grid Layout (2-Columns) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                
                <!-- Route Name (With original custom keyup event) -->
                <div class="md:col-span-2">
                    <label for="route_name" class="block text-sm font-medium text-slate-700 mb-1.5">Route Name</label>
                    <input 
                        type="text" 
                        id="route_name"
                        name="route_name" 
                        onkeyup="my(this.value)" 
                        placeholder="Enter the Route Name" 
                        class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                        required
                    >
                </div>

                <!-- Start Point -->
                <div>
                    <label for="s-t" class="block text-sm font-medium text-slate-700 mb-1.5">Start Point</label>
                    <input 
                        type="text" 
                        id="s-t" 
                        name="start_point" 
                        placeholder="Enter the Start Point"
                        class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                    >
                </div>

                <!-- Start Time -->
                <div>
                    <label for="start_time" class="block text-sm font-medium text-slate-700 mb-1.5">Start Time</label>
                    <input 
                        type="text" 
                        id="start_time"
                        name="start_time" 
                        placeholder="Enter the Start Time"
                        class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                    >
                </div>

                <!-- End Point -->
                <div>
                    <label for="e-p" class="block text-sm font-medium text-slate-700 mb-1.5">End Point</label>
                    <input 
                        type="text" 
                        id="e-p" 
                        name="end_point" 
                        placeholder="Enter the End Point"
                        class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                    >
                </div>

                <!-- End Time -->
                <div>
                    <label for="end_time" class="block text-sm font-medium text-slate-700 mb-1.5">End Time</label>
                    <input 
                        type="text" 
                        id="end_time"
                        name="end_time" 
                        placeholder="Enter the End Time"
                        class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                    >
                </div>

                <!-- Distance -->
                <div>
                    <label for="distance" class="block text-sm font-medium text-slate-700 mb-1.5">Distance (e.g. 15km)</label>
                    <input 
                        type="text" 
                        id="distance"
                        name="distance" 
                        placeholder="Enter the Distance"
                        class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                    >
                </div>

                <!-- Estimated Time -->
                <div>
                    <label for="estimated_time" class="block text-sm font-medium text-slate-700 mb-1.5">Estimated Time (e.g. 45mins)</label>
                    <input 
                        type="text" 
                        id="estimated_time"
                        name="estimated_time" 
                        placeholder="Enter the Estimated Time"
                        class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                    >
                </div>

                <!-- Route Status (Full width select) -->
                <div class="md:col-span-2">
                    <label for="status" class="block text-sm font-medium text-slate-700 mb-1.5">Status</label>
                    <select 
                        id="status" 
                        name="status"
                        class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 bg-white"
                        required
                    >
                        <option value="active">Active</option>
                        <option value="inactive">In Active</option>
                    </select>
                </div>

            </div>

            <!-- Submit Button -->
            <div class="pt-4 border-t border-slate-100">
                <button 
                    type="submit" 
                    class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-lg shadow-sm hover:shadow transition duration-150 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Submit Route Details
                </button>
            </div>

        </form>
        <!-- Form End -->

        <!-- Dynamic Success/Error Message Box -->
        @if(isset($msg) && !empty($msg))
            @if(stripos($msg, 'already') !== false || stripos($msg, 'exist') !== false || stripos($msg, 'fail') !== false || stripos($msg, 'error') !== false)
                <!-- Red Alert -->
                <div class="mt-6 p-4 bg-rose-50 border border-rose-200 rounded-xl flex items-start gap-3">
                    <svg class="h-5 w-5 text-rose-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <div>
                        <h4 class="text-sm font-semibold text-rose-800">Alert</h4>
                        <p class="text-xs text-rose-700 mt-0.5">{{ $msg }}</p>
                    </div>
                </div>
            @else
                <!-- Green Alert -->
                <div class="mt-6 p-4 bg-emerald-50 border border-emerald-200 rounded-xl flex items-start gap-3">
                    <svg class="h-5 w-5 text-emerald-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <h4 class="text-sm font-semibold text-emerald-800">Success</h4>
                        <p class="text-xs text-emerald-700 mt-0.5">{{ $msg }}</p>
                    </div>
                </div>
            @endif
        @endif

    </div>

</body>
</html>