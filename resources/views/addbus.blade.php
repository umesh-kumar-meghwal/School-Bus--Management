<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Meta CSRF Token (Active) -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bus Registration</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 font-sans antialiased min-h-screen flex items-center justify-center p-4 md:p-8">

    <div class="max-w-2xl w-full">
        @if ($data && count($data) > 0 && $ddata && count($ddata) > 0)

        <!-- Main Card Container -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-xl p-6 md:p-8">

            <!-- Back Button & Header -->
            <div class="mb-6">
                <button onclick="history.back()" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-slate-800 transition mb-4">
                    ← Back
                </button>
                <h1 class="text-2xl font-bold text-slate-800">Bus Register</h1>
            </div>

            <!-- Form Start -->
            <form action="/addbus" method="post" class="space-y-6">
                @csrf
                <input type="hidden" name="school_email" id="school_email" value="{{ $school_email }}">
                <!-- Grid Layout for Fields (2 Columns) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <!-- Bus Number -->
                    <div>
                        <label for="bus_number" class="block text-sm font-medium text-slate-700 mb-1.5">Bus Number</label>
                        <input
                            type="text"
                            id="bus_number"
                            name="bus_number"
                            placeholder="Enter the Bus Number"
                            class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                            required>
                    </div>

                    <!-- Bus Name -->
                    <div>
                        <label for="bus_name" class="block text-sm font-medium text-slate-700 mb-1.5">Bus Name</label>
                        <input
                            type="text"
                            id="bus_name"
                            name="bus_name"
                            placeholder="Enter the Bus Name"
                            class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                            required>
                    </div>

                    <!-- Driver Name (Dropdown) -->
                    <div>
                        <label for="d-name" class="block text-sm font-medium text-slate-700 mb-1.5">Driver Name</label>
                        <select
                            id="d-name"
                            name="driver_name"
                            class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 bg-white"
                            required>
                            <option value="select" disabled selected>Select</option>
                            @foreach ($ddata as $ds)
                            <option>{{ $ds->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Driver Phone (Auto-Fetched via JS) -->
                    <div>
                        <label for="d-phone" class="block text-sm font-medium text-slate-500 mb-1.5">Driver Phone (Auto Field)</label>
                        <input
                            type="text"
                            id="d-phone"
                            name="driver_phone"
                            value=""
                            placeholder="Auto Loaded"
                            class="w-full px-3.5 py-2 border border-slate-200 bg-slate-50 text-slate-600 font-medium rounded-lg text-sm cursor-not-allowed focus:outline-none"
                            readonly
                            required>
                    </div>

                    <!-- Driver Phone Fetch JavaScript (Original Logic) -->
                    <script>
                        const d_name = document.getElementById("d-name");
                        const school_email = document.getElementById("school_email");
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
                                        name: d_name.value,
                                        school_email :school_email.value
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
                            required>
                            <option value="" disabled selected>Select</option>
                            @foreach ($data as $d)
                            <option>{{ $d->route_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Bus Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-slate-700 mb-1.5">Status</label>
                        <select
                            id="status"
                            name="status"
                            class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 bg-white"
                            required>
                            <option value="active">Active</option>
                            <option value="inactive">InActive</option>
                            <option value="maintence">Maintence</option>
                        </select>
                    </div>

                    <!-- Total Seats -->
                    <div>
                        <label for="total_seats" class="block text-sm font-medium text-slate-700 mb-1.5">Total Seats</label>
                        <input
                            type="text"
                            id="total_seats"
                            name="total_seats"
                            placeholder="Enter the Total Seats"
                            class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                            required>
                    </div>

                    <!-- Available Seats -->
                    <div>
                        <label for="available_seats" class="block text-sm font-medium text-slate-700 mb-1.5">Available Seats</label>
                        <input
                            type="text"
                            id="available_seats"
                            name="available_seats"
                            placeholder="Enter the Available Seats"
                            class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                            required>
                    </div>

                </div>

                <!-- Hidden Location Inputs (Updated via bottom script) -->
                <input type="hidden" name="latitude" id="latitude" required>
                <input type="hidden" name="longitude" id="longitude" required>

                <!-- Submit Button -->
                <div class="pt-4 border-t border-slate-100">
                    <button
                        type="submit"
                        class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-lg shadow-sm hover:shadow transition duration-150 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Submit Registration
                    </button>
                </div>

            </form>
            <!-- Form End -->

            <!-- Dynamic Message Logic -->
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

        @else
        <!-- Else Condition State: Requirements not met (No Route or Driver) -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-xl p-8 text-center max-w-md mx-auto">
            <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-amber-50 text-amber-500 mb-5">
                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <h3 class="text-lg font-bold text-slate-800">Prerequisites Required</h3>

            <button onclick="window.location.href='/addroute?q={{ $school_email }}'" class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-lg shadow transition">
                + Add New Route
            </button>
        </div>
        @endif

    </div>

    <!-- Original Hidden Location Coordinates Script -->
    <script>
        document.getElementById('latitude').value = 25.153299;
        document.getElementById('longitude').value = 75.833374;
    </script>

</body>

</html>