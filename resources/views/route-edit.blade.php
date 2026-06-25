<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Route Details</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 font-sans antialiased min-h-screen flex items-center justify-center p-4 md:p-8">

    @if ($data)
    <div class="max-w-2xl w-full bg-white rounded-2xl border border-slate-200 shadow-xl p-6 md:p-8">
        
        <!-- Back Button & Header -->
        <div class="mb-6">
            <button onclick="history.back()" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-slate-800 transition mb-4">
                ← Back
            </button>
            <h1 class="text-2xl font-bold text-slate-800">Route Edit</h1>
        </div>

        <!-- Form Start -->
        <form action="/route-edits" method="post" class="space-y-6">
            @csrf
            
            <!-- Hidden Input for ID -->
            <input type="hidden" name="id" value="{{ $data->id }}">

            <!-- Grid Layout for Fields (2-Columns) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                
                <!-- Route Name (With original custom keyup event) -->
                <div class="md:col-span-2">
                    <label for="route_name" class="block text-sm font-medium text-slate-700 mb-1.5">Route Name</label>
                    <input 
                        type="text" 
                        id="route_name"
                        name="route_name" 
                        value="{{ $data->route_name }}"
                        onkeyup="my(this.value)" 
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
                        value="{{ $data->start_point }}"
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
                        value="{{ $data->start_time }}"
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
                        value="{{ $data->end_point }}"
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
                        value="{{ $data->end_time }}"
                        class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                    >
                </div>

                <!-- Distance -->
                <div>
                    <label for="distance" class="block text-sm font-medium text-slate-700 mb-1.5">Distance</label>
                    <input 
                        type="text" 
                        id="distance"
                        name="distance" 
                        value="{{ $data->distance }}"
                        class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                    >
                </div>

                <!-- Estimated Time -->
                <div>
                    <label for="estimated_time" class="block text-sm font-medium text-slate-700 mb-1.5">Estimated Time</label>
                    <input 
                        type="text" 
                        id="estimated_time"
                        name="estimated_time" 
                        value="{{ $data->estimated_time }}"
                        class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                    >
                </div>

                <!-- Route Status Selector -->
                <div class="md:col-span-2">
                    <label for="status" class="block text-sm font-medium text-slate-700 mb-1.5">Status</label>
                    <select 
                        id="status" 
                        name="status"
                        class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 bg-white"
                        required
                    >
                        <option value="active" {{ $data->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $data->status == 'inactive' ? 'selected' : '' }}>InActive</option>
                    </select>
                </div>

            </div>

            <!-- Submit Button -->
            <div class="pt-4 border-t border-slate-100">
                <button 
                    type="submit" 
                    class="w-full py-3 px-4 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm rounded-lg shadow-sm hover:shadow transition duration-150 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2"
                >
                    Save Changes
                </button>
            </div>

        </form>
        <!-- Form End -->

    </div>
    @endif

</body>
</html>