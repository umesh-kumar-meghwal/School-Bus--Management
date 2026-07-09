<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Live Bus Tracking</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>

    <style>
        #map {
            height: 100vh;
            width: 100%;
        }

        /* Modern Custom Bus Tooltip Label */
        .bus-label {
            background: #0f172a !important; /* slate-900 */
            color: #ffffff !important;
            border: 1px solid #334155 !important; /* slate-700 */
            padding: 4px 8px !important;
            border-radius: 6px !important;
            font-size: 11px !important;
            font-weight: 700 !important;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1) !important;
        }
        
        /* Tooltip arrow custom adjustments */
        .leaflet-tooltip-top:before {
            border-top-color: #0f172a !important;
        }
    </style>
</head>
<body class="bg-slate-100 font-sans antialiased min-h-screen relative overflow-hidden">

    <!-- Top Overlay Control Card (Dashboard Style) -->
    <div class="absolute top-4 left-4 z-[1000] max-w-sm w-full p-4 bg-white/90 backdrop-blur-md border border-slate-200/80 rounded-2xl shadow-xl flex flex-col gap-4">
        
        <!-- Back Button & Brand -->
        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
            <button onclick="history.back()" class="inline-flex items-center gap-1 text-xs font-semibold text-slate-500 hover:text-slate-800 transition">
                ← Back
            </button>
            
            <!-- Live Status Pulse Indicator -->
            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200/50">
                <span class="relative flex h-1.5 w-1.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-emerald-500"></span>
                </span>
                LIVE UPDATES
            </span>
        </div>
        <input type="hidden" name="school_email" id="school_email" value="{{ $school_email }}">

        <!-- Heading details -->
        <div>
            <h1 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                Live Bus Tracking 🛑
            </h1>
        </div>

        <!-- Map Legends Index -->
        <div class="bg-slate-50/50 border border-slate-100 rounded-xl p-3 space-y-2.5">
            <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">Map Markers Legend</span>
            
            <!-- Bus Indicator -->
            <div class="flex items-center gap-2.5 text-xs text-slate-600 font-medium">
                <div class="h-6 w-6 rounded-lg bg-indigo-50 border border-indigo-100 flex items-center justify-center p-0.5">
                    <img src="https://toppng.com/uploads/preview/bus-top-view-clip-art-bus-icon-top-view-11562896756ifkgek2ydy.png" class="h-4 w-4" alt="Bus Indicator">
                </div>
                <span>Active School/College Bus</span>
            </div>

            <!-- Stop Indicator -->
            <div class="flex items-center gap-2.5 text-xs text-slate-600 font-medium">
                <div class="h-6 w-6 rounded-lg bg-slate-100 border border-slate-200 flex items-center justify-center">
                    <div class="h-3 w-3 rounded-full bg-indigo-600 border-2 border-white shadow-sm"></div>
                </div>
                <span>Scheduled Bus Stop</span>
            </div>
        </div>

    </div>

    <!-- Main Map Container -->
    <div id="map"></div>

    <!-- Core Map & Jquery Imports -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Map Coordinate Handler Scripts -->
    <script>
        // Kota Center coordinates initialisation
        var map = L.map('map').setView([25.2138,75.8648], 13);
        var school_email = document.getElementById("school_email").value;

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '{{$school_name}}'
        }).addTo(map);

        // Custom Bus Icon specs
        var busIcon = L.icon({
            iconUrl: 'https://toppng.com/uploads/preview/bus-top-view-clip-art-bus-icon-top-view-11562896756ifkgek2ydy.png',
            iconSize: [35, 35],
            iconAnchor: [17, 35]
        });

        // All markers store here
        let markers = {};

        function loadBuses() {
            $.ajax({
                url: '/bus-location',   // Laravel Route
                type: 'GET',
                data:{
                    _token :"{{ csrf_token() }}",
                    school_email :school_email
                },
                success: function(data) {
                    data.forEach(function(bus) {
                        let lat = parseFloat(bus.latitude);
                        let lng = parseFloat(bus.longitude);

                        // Update Existing Marker
                        if(markers[bus.bus_number]) {
                            markers[bus.bus_number].setLatLng([lat, lng]);
                        } else {
                            // Create Marker
                            markers[bus.bus_number] = L.marker([lat, lng], {icon: busIcon})
                                .addTo(map)
                                .bindTooltip(bus.bus_number, {
                                    permanent: true,
                                    direction: 'top',
                                    className: 'bus-label'
                                })
                                .bindPopup(
                                    "<div class='p-1 text-slate-800 text-xs font-semibold'>" +
                                    "<b>Bus Number :</b> " + bus.bus_number + "<br>" +
                                    "<b>Route :</b> " + bus.route_name + 
                                    "</div>"
                                );
                        }
                    });
                }
            });
        }

        // First Load
        loadBuses();

        // Refresh Every 5 Seconds
        setInterval(loadBuses, 5000);

        function loadStops() {
            $.ajax({
                url: '/stop-location',
                type: 'GET',
                data:{
                    _token :"{{ csrf_token() }}",
                    school_email :school_email
                },
                success: function(data) {
                    data.forEach(function(stop) {
                        L.circleMarker([stop.latitude, stop.longitude], {
                            radius: 8,
                            fillColor: '#4f46e5', // indigo-600 color
                            color: '#ffffff',
                            weight: 2,
                            opacity: 1,
                            fillOpacity: 0.9
                        })
                        .addTo(map)
                        .bindTooltip(stop.stop_name, {
                            permanent: true,
                            direction: 'right',
                            className: 'text-[10px] font-bold text-slate-700 bg-white border border-slate-200 px-1.5 py-0.5 rounded-md shadow-sm'
                        })
                        .bindPopup(
                            "<div class='p-1 text-slate-800 text-xs font-semibold'>" +
                            "<b>Stop:</b> " + stop.stop_name + "<br>" +
                            "<b>Route:</b> " + stop.route_name +
                            "</div>"
                        );
                    });
                }
            });
        }

        // Load stop targets
        loadStops();
    </script>

</body>
</html>