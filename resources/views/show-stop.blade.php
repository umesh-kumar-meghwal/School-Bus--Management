<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stops List</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 font-sans antialiased min-h-screen p-4 md:p-8">

    <div class="max-w-6xl mx-auto">
        
        <!-- Top Navigation & Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <button onclick="history.back()" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-slate-800 transition mb-2">
                    ← Back
                </button>
                <h1 class="text-2xl font-bold text-slate-800">Show Stops</h1>
            </div>

            <!-- Add New Stop Button -->
            <div>
                <button onclick="window.location.href='/add-stop'" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg shadow-sm hover:shadow transition">
                    + Add New Stop
                </button>
            </div>
        </div>

        <!-- Data Check -->
        @if ($data && count($data)>0)
            
            <!-- Table Card Container -->
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="overflow-x-auto w-full">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Stop Name</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Route Name</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Pick Up Time</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Drop Time</th>
                                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-slate-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                            @foreach ($data as $d)
                            <tr class="hover:bg-slate-50/50 transition">
                                
                                <!-- Stop Name -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-slate-900">
                                    {{ $d->stop_name }}
                                </td>
                                
                                <!-- Route Name -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-indigo-600 font-semibold">
                                    {{ $d->route_name }}
                                </td>
                                
                                <!-- Pick Up Time (Fixed inside dynamic badge wrapper) -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                                        {{ $d->pickup_time }} AM
                                    </span>
                                </td>
                                
                                <!-- Drop Time (Fixed inside dynamic badge wrapper) -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mr-1.5"></span>
                                        {{ $d->drop_time }} PM
                                    </span>
                                </td>
                                
                                <!-- Action Buttons -->
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <div class="flex items-center justify-center gap-2">
                                        
                                        <!-- Edit Stop Action -->
                                        <form action="/edit-stop" method="post" class="inline">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $d->id }}">
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white rounded-md text-xs font-semibold transition shadow-sm">
                                                Edit
                                            </button>
                                        </form>

                                        <!-- Delete Stop Action -->
                                        <form action="/delete-stop" method="post" class="inline" onsubmit="return confirm('Are you sure you want to delete this stop?')">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $d->id }}">
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-rose-600 hover:bg-rose-700 text-white rounded-md text-xs font-semibold transition shadow-sm">
                                                Delete
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        @else
            <!-- Empty State for Stop Records -->
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-12 text-center max-w-md mx-auto mt-10">
                <div class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-slate-100 text-slate-400 mb-4">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <h3 class="text-base font-semibold text-slate-800">No Stops Registered</h3>
                <p class="text-sm text-slate-500 mt-1 mb-6">Database me filhal koi bus stop dastyab nahi hai.</p>
                <button onclick="window.location.href='/add-stop'" class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg shadow transition">
                    + Register First Stop
                </button>
            </div>
        @endif

    </div>

</body>
</html>