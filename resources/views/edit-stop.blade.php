<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Stop with Map</title>
    <!-- Tailwind CSS CDN -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Leaflet Map CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
</head>

<body class="bg-slate-100 font-sans antialiased min-h-screen p-4 md:p-8 flex items-center justify-center">

    @if ($data)
    <div class="max-w-5xl w-full bg-white p-6 md:p-8 rounded-2xl border border-slate-200 shadow-xl">

        <!-- Dashboard Main Panel Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            <!-- Left Side: Edit Form (Col Span 5) -->
            <div class="lg:col-span-5 flex flex-col justify-between">
                <div>
                    <!-- Back Button & Header -->
                    <div class="mb-6">
                        <button onclick="history.back()" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-slate-800 transition mb-3">
                            ← Back
                        </button>
                        <h1 class="text-2xl font-bold text-slate-800">Edit Stop</h1>
                    </div>

                    <!-- Form Start -->
                    <form action="/edit-stops" method="post" class="space-y-4">
                        @csrf

                        <!-- Hidden Input for ID -->
                         <input type="hidden" value="{{ $data->id }}" name="id">
                        <!--Route Name --->
                        <div>
                            <label for="route_id" class="block text-sm font-medium text-slate-700 mb-1.5">Select Route</label>
                            <select
                                id="route_name"
                                name="route_name"
                                class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition bg-white"
                                required>
                                @foreach ($data1 as $d)
                                <option value="{{ $d->route_name }}" {{ $d->route_name == $data->route_name  ? 'selected':''}}>{{ $d->route_name }}</option>
                                @endforeach
                            </select>
                                <input type="hidden" id="id" value="" name="route_id">

                        </div>
                        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
                        <script>
                            document.getElementById('route_name').onchange = function() {
                                $.ajax({
                                    url: '/id-fetch',
                                    type: 'POST',
                                    data: {
                                        _token: '{{ csrf_token() }}',
                                        r_name: this.value
                                    },
                                    success: function(data) {
                                        document.getElementById('id').value = data.id;
                                    }
                                })
                            }
                        </script>

                        <!-- Stop Name -->
                        <div>
                            <label for="stop_name" class="block text-sm font-medium text-slate-700 mb-1.5">Stop Name</label>
                            <input
                                type="text"
                                id="stop_name"
                                name="stop_name"
                                value="{{ $data->stop_name }}"
                                class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                                required>
                        </div>

                        <!-- Timings (Pickup & Drop) -->
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label for="pickup_time" class="block text-sm font-medium text-slate-700 mb-1.5">Pick Up Time</label>
                                <input
                                    type="text"
                                    id="pickup_time"
                                    name="pickup_time"
                                    value="{{ $data->pickup_time }}"
                                    class="w-full px-3 py-1.5 border border-slate-300 rounded-lg text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                                    required>
                            </div>
                            <div>
                                <label for="drop_time" class="block text-sm font-medium text-slate-700 mb-1.5">Drop Time</label>
                                <input
                                    type="text"
                                    id="drop_time"
                                    name="drop_time"
                                    value="{{ $data->drop_time }}"
                                    class="w-full px-3 py-1.5 border border-slate-300 rounded-lg text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                                    required>
                            </div>
                        </div>

                        <!-- Coordinates (Auto loaded / can be changed via Map) -->
                        <div class="grid grid-cols-2 gap-3 border-t border-slate-100 pt-4">
                            <div>
                                <label for="lat" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Latitude</label>
                                <input
                                    type="text"
                                    name="lat"
                                    id="lat"
                                    value="{{ $data->latitude ?? '' }}"
                                    class="w-full px-3 py-1.5 bg-slate-50 border border-slate-200 text-slate-600 rounded-lg text-xs font-semibold focus:outline-none"
                                    readonly
                                    required>
                            </div>
                            <div>
                                <label for="long" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Longitude</label>
                                <input
                                    type="text"
                                    name="long"
                                    id="long"
                                    value="{{ $data->longitude ?? '' }}"
                                    class="w-full px-3 py-1.5 bg-slate-50 border border-slate-200 text-slate-600 rounded-lg text-xs font-semibold focus:outline-none"
                                    readonly
                                    required>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-2">
                            <button
                                type="submit"
                                class="w-full py-2.5 px-4 bg-emerald-600 hover:bg-emerald-700 text-white font-medium text-sm rounded-lg shadow-sm hover:shadow transition focus:outline-none focus:ring-2 focus:ring-emerald-500">
                                Save & Change
                            </button>
                        </div>

                    </form>
                </div>
            </div>

            <!-- Right Side: Leaflet Map Panel (Col Span 7) -->
            <div class="lg:col-span-7 flex flex-col justify-between">
                <div>
                    <span class="block text-sm font-semibold text-slate-700 mb-2">Change Stop Location on Map</span>
                    <div class="rounded-xl border border-slate-300 overflow-hidden shadow-inner">
                        <div id="map"></div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    @endif

    <!-- Leaflet Map Scripts -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var initialLat = parseFloat("{{ $data->latitude  }}");
            var initialLng = parseFloat("{{ $data->longitude  }}");

            var map = L.map('map').setView([initialLat, initialLng], 14);

            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© '
            }).addTo(map);

            // Draw initial marker at existing coordinate positions
            var currentMarker = L.marker([initialLat, initialLng]).addTo(map);

            // Click listener to update coordinates
            map.on('click', function(e) {
                var lat = e.latlng.lat;
                var lng = e.latlng.lng;

                // Set the input values
                document.getElementById('lat').value = lat;
                document.getElementById('long').value = lng;

                // Clear old marker and draw new
                if (currentMarker) {
                    map.removeLayer(currentMarker);
                }
                currentMarker = L.marker([lat, lng]).addTo(map);
            });
        });
    </script>

</body>

</html>