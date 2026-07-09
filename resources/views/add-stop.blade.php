<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register New Stop</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Leaflet Map CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    
    <style>
        /* Interactive map container limits */
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
</head>
<body class="bg-slate-100 font-sans antialiased min-h-screen p-4 md:p-8 flex items-center justify-center">

    <div class="max-w-5xl w-full">
        @if (!empty($data) && count($data)>0)
            
            <!-- Dashboard Main Panel Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 bg-white p-6 md:p-8 rounded-2xl border border-slate-200 shadow-xl">
                
                <!-- Left Side: Register Form (Col Span 5) -->
                <div class="lg:col-span-5 flex flex-col justify-between">
                    <div>
                        <!-- Back Button & Header -->
                        <div class="mb-6">
                            <button onclick="history.back()" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-slate-800 transition mb-3">
                                ← Back
                            </button>
                            <h1 class="text-2xl font-bold text-slate-800">New Stop Register</h1>
                        </div>

                        <!-- Form Start -->
                        <form action="/add-stops" method="post" class="space-y-4">
                            @csrf

                            <!-- Route Selection -->
                             <input type="hidden" name="school_email" value="{{ $school_email }}">
                            <div>
                                <label for="route_id" class="block text-sm font-medium text-slate-700 mb-1.5">Select Route</label>
                                <select 
                                    id="route_id" 
                                    name="route_id"
                                    class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition bg-white"
                                    required
                                >
                                    @foreach ($data as $d)
                                        <option value="{{ $d->id }}">{{ $d->route_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Stop Name -->
                            <div>
                                <label for="stop_name" class="block text-sm font-medium text-slate-700 mb-1.5">Stop Name</label>
                                <input 
                                    type="text" 
                                    id="stop_name"
                                    name="stop_name" 
                                    placeholder="Enter the Stop Name"
                                    class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                                    required
                                >
                            </div>

                            <!-- Timings (Pickup & Drop) -->
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label for="pick_time" class="block text-sm font-medium text-slate-700 mb-1.5">PickUp Time</label>
                                    <input 
                                        type="time" 
                                        id="pick_time"
                                        name="pick_time"
                                        class="w-full px-3 py-1.5 border border-slate-300 rounded-lg text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                                        required
                                    >
                                </div>
                                <div>
                                    <label for="drop_time" class="block text-sm font-medium text-slate-700 mb-1.5">Drop Time</label>
                                    <input 
                                        type="time" 
                                        id="drop_time"
                                        name="drop_time"
                                        class="w-full px-3 py-1.5 border border-slate-300 rounded-lg text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                                        required
                                    >
                                </div>
                            </div>

                            <!-- Coordinates (Lat & Long auto loaded via map click) -->
                            <div class="grid grid-cols-2 gap-3 border-t border-slate-100 pt-4">
                                <div>
                                    <label for="lat" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Latitude</label>
                                    <input 
                                        type="text" 
                                        name="lat" 
                                        id="lat" 
                                        placeholder="0.0000"
                                        class="w-full px-3 py-1.5 bg-slate-50 border border-slate-200 text-slate-600 rounded-lg text-xs font-semibold focus:outline-none"
                                        readonly
                                        required
                                    >
                                </div>
                                <div>
                                    <label for="long" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Longitude</label>
                                    <input 
                                        type="text" 
                                        name="long" 
                                        id="long" 
                                        placeholder="0.0000"
                                        class="w-full px-3 py-1.5 bg-slate-50 border border-slate-200 text-slate-600 rounded-lg text-xs font-semibold focus:outline-none"
                                        readonly
                                        required
                                    >
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="pt-2">
                                <button 
                                    type="submit" 
                                    class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm rounded-lg shadow-sm hover:shadow transition focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                >
                                    Submit Stop
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

                <!-- Right Side: Leaflet Map Panel (Col Span 7) -->
                <div class="lg:col-span-7 flex flex-col justify-between">
                    <div>
                        <span class="block text-sm font-semibold text-slate-700 mb-2">Select Coordinates on Map</span>
                        <div class="rounded-xl border border-slate-300 overflow-hidden shadow-inner">
                            <div id="map"></div>
                        </div>
                        <span class="block text-[10px] text-slate-400 mt-2 text-right">Map par click karne se latitude aur longitude coordinates khud-ba-khud fill ho jayenge.</span>
                    </div>
                </div>

            </div>

        @else
            <!-- Requirement Error State (If no Route exists) -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-xl p-8 text-center max-w-md mx-auto">
                <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-amber-50 text-amber-500 mb-5">
                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-800">Routes Required First</h3>
                <p class="text-sm text-slate-500 mt-2 mb-6">Stop register karne se pehle system me kam-az-kam ek route ka hona lazmi hai.</p>
                
                <button onclick="window.location.href='/addroute'" class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-lg shadow transition">
                    + Add New Route
                </button>
            </div>
        @endif
    </div>

    <!-- Leaflet Map Scripts -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        // Check if map container exists before initialisation
        const mapContainer = document.getElementById('map');
        if (mapContainer) {
            var map = L.map('map').setView([25.2138, 75.8648], 13);

            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png',{
                attribution:'© OpenStreetMap'
            }).addTo(map);

            var currentMarker;

            map.on('click', function(e){
                var lat = e.latlng.lat;
                var lng = e.latlng.lng;
                
                // Populate input fields
                document.getElementById('lat').value = lat;
                document.getElementById('long').value = lng;
                
                // If marker already exists, remove it before drawing a new one
                if (currentMarker) {
                    map.removeLayer(currentMarker);
                }
                
                // Add marker
                currentMarker = L.marker([lat, lng]).addTo(map);
            });
        }
    </script>

</body>
</html>