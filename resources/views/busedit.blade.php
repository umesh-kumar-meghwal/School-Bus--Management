<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Meta CSRF Token (Active) -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Bus Details</title>
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
            <h1 class="text-2xl font-bold text-slate-800">Bus Edit</h1>
        </div>

        <!-- Form Start -->
        <form action="/busedit1" method="post" class="space-y-6">
            @csrf
            
            <!-- Hidden Input for ID -->
            <input type="hidden" value="{{ $data->id }}" name="id">

            <!-- Grid Layout for Fields (2-Columns) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                
                <!-- Bus Number -->
                <div>
                    <label for="bus_number" class="block text-sm font-medium text-slate-700 mb-1.5">Bus Number</label>
                    <input 
                        type="text" 
                        id="bus_number"
                        name="bus_number" 
                        value="{{ $data->bus_number }}"
                        class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                        required
                    >
                </div>

                <!-- Bus Name -->
                <div>
                    <label for="bus_name" class="block text-sm font-medium text-slate-700 mb-1.5">Bus Name</label>
                    <input 
                        type="text" 
                        id="bus_name"
                        name="bus_name" 
                        value="{{ $data->bus_name }}"
                        class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                        required
                    >
                </div>

                <!-- Driver Name (Dropdown) -->
                <div>
                    <label for="d-name" class="block text-sm font-medium text-slate-700 mb-1.5">Driver Name</label>
                    <select 
                        id="d-name" 
                        name="driver_name"
                        class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 bg-white"
                        required
                    >
                        @foreach ($ddatas as $ds)
                            <option {{ $data->driver_name == $ds->name ? 'selected' : '' }}>{{ $ds->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Driver Phone (Read-Only auto update via JS) -->
                <div>
                    <label for="d-phone" class="block text-sm font-medium text-slate-500 mb-1.5">Driver Phone</label>
                    <input 
                        type="text" 
                        id="d-phone" 
                        name="driver_phone" 
                        value="{{ $data->driver_phone }}" 
                        class="w-full px-3.5 py-2 border border-slate-200 bg-slate-50 text-slate-600 font-medium rounded-lg text-sm cursor-not-allowed focus:outline-none"
                        readonly
                        required
                    >
                </div>

                <!-- JavaScript for Dynamic Phone Fetch (Original logic retained) -->
                <script>
                    const d_name = document.getElementById('d-name');
                    var d_phone = document.getElementById('d-phone');
                    d_name.onchange = function() {
                        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        fetch("/phone-fetch", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-CSRF-TOKEN": token
                                },
                                body: JSON.stringify({
                                    name: this.value
                                })
                            })
                            .then(res => res.json())
                            .then(data => d_phone.value = data.reply);
                    };
                </script>

                <!-- Route Name (Dropdown) -->
                <div>
                    <label for="route_name" class="block text-sm font-medium text-slate-700 mb-1.5">Route Name</label>
                    <select 
                        id="route_name"
                        name="route_name"
                        class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 bg-white"
                        required
                    >
                        @foreach ($datas as $d)
                            <option {{ $d->route_name == $data->route_name ? 'selected' : '' }}>{{ $d->route_name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Status Selector -->
                <div>
                    <label for="status" class="block text-sm font-medium text-slate-700 mb-1.5">Status</label>
                    <select 
                        id="status"
                        name="status"
                        class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 bg-white"
                        required
                    >
                        <option value="active" {{ $data->status == 'active' ? 'selected' : '' }}>Active</option>
                        <!-- Typo variables preserved exactly for database compatibility -->
                        <option value="inacative" {{ $data->status == 'inactive' ? 'selected' : '' }}>In Active</option>
                        <option value="maintenace" {{ $data->status == 'maintenace' ? 'selected' : '' }}>Maintenance</option>
                    </select>
                </div>

                <!-- Total Seats -->
                <div>
                    <label for="total_seats" class="block text-sm font-medium text-slate-700 mb-1.5">Total Seats</label>
                    <input 
                        type="text" 
                        id="total_seats"
                        name="total_seats" 
                        value="{{ $data->total_seats }}"
                        class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                        required
                    >
                </div>

                <!-- Available Seats -->
                <div>
                    <label for="available_seats" class="block text-sm font-medium text-slate-700 mb-1.5">Available Seats</label>
                    <input 
                        type="text" 
                        id="available_seats"
                        name="available_seats" 
                        value="{{ $data->available_seats }}"
                        class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                        required
                    >
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