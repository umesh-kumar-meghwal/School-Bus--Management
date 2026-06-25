<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Routes List</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 font-sans antialiased min-h-screen p-4 md:p-8">

    <div class="max-w-7xl mx-auto">
        
        <!-- Top Navigation & Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <button onclick="history.back()" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-slate-800 transition mb-2">
                    ← Back
                </button>
                <h1 class="text-2xl font-bold text-slate-800">Route Show</h1>
            </div>

            <!-- Add New Route Button (Top-Right Action) -->
            <div>
                <button onclick="window.location.href='/addroute'" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg shadow-sm hover:shadow transition">
                    + Add New Route
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
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Route Name</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Start Point</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">End Point</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Start Time</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">End Time</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Distance</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Estimated Time</th>
                                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-slate-500 uppercase tracking-wider">Stops</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-slate-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-100">
                            @foreach ($data as $d)
                            <tr class="hover:bg-slate-50/50 transition">
                                
                                <!-- Route Name -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-indigo-600">{{ $d->route_name }}</td>
                                
                                <!-- Start Point -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 font-medium">{{ $d->start_point }}</td>
                                
                                <!-- End Point -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 font-medium">{{ $d->end_point }}</td>
                                
                                <!-- Start Time -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">{{ $d->start_time }}</td>
                                
                                <!-- End Time -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">{{ $d->end_time }}</td>
                                
                                <!-- Distance -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 font-semibold">{{ $d->distance }}</td>
                                
                                <!-- Estimated Time -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 font-semibold">{{ $d->estimated_time }} min</td>
                                
                                <!-- Dynamic Stops Viewer Button -->
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
                                    <form action="/stop-one-show" method="post" class="inline">
                                        @csrf
                                        <input type="hidden" value="{{ $d->id }}" name="route_id">
                                        <button type="submit" class="inline-flex items-center px-2.5 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs rounded-lg border border-slate-200 transition shadow-sm">
                                            📍 All Stops
                                        </button>
                                    </form>
                                </td>

                                <!-- Status Badge -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @if(strtolower($d->status) == 'active')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            Active
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-50 text-slate-700 border border-slate-200">
                                            InActive
                                        </span>
                                    @endif
                                </td>

                                <!-- Action Buttons -->
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <div class="flex items-center justify-center gap-2">
                                        
                                        <!-- Edit Route Action -->
                                        <form action="/editroute" method="post" class="inline">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $d->id }}">
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white rounded-md text-xs font-semibold transition shadow-sm">
                                                Edit
                                            </button>
                                        </form>

                                        <!-- Delete Route Action -->
                                        <form action="/delete-route" method="post" class="inline" onsubmit="return confirm('Are you sure you want to delete this route?')">
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
            <!-- Empty State for Route Records -->
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-12 text-center max-w-md mx-auto mt-10">
                <div class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-slate-100 text-slate-400 mb-4">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                    </svg>
                </div>
                <h3 class="text-base font-semibold text-slate-800">No Routes Found</h3>
                <button onclick="window.location.href='/addroute'" class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg shadow transition">
                    + Create First Route
                </button>
            </div>
        @endif

    </div>

</body>
</html>