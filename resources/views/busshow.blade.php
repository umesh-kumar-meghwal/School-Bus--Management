<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buses List</title>
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
                <h1 class="text-2xl font-bold text-slate-800">Buses Show</h1>
            </div>

            <!-- Add New Bus Button -->
            <div>
                <button onclick="window.location.href='/addbus'" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg shadow-sm hover:shadow transition">
                    + Add New Bus
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
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Bus Number</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Bus Name</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Driver Name</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Driver Phone</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Route Name</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Total Seats</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Available Seats</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-slate-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-100">
                            @foreach ($data as $d)
                            <tr class="hover:bg-slate-50/50 transition">
                                <!-- Bus Number -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-slate-900">{{ $d->bus_number }}</td>
                                
                                <!-- Bus Name -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $d->bus_name }}</td>
                                
                                <!-- Driver Name -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 font-medium">{{ $d->driver_name }}</td>
                                
                                <!-- Driver Phone -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">{{ $d->driver_phone }}</td>
                                
                                <!-- Route Name -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-indigo-600 font-semibold">{{ $d->route_name }}</td>
                                
                                <!-- Total Seats -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $d->total_seats }}</td>
                                
                                <!-- Available Seats -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $d->available_seats }}</td>
                                
                                <!-- Styled Status Badge -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @if(strtolower($d->status) == 'active')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            Active
                                        </span>
                                    @elseif(strtolower($d->status) == 'maintence' || strtolower($d->status) == 'maintenance')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-50 text-amber-700 border border-amber-200">
                                            Maintenance
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
                                        
                                        <!-- Edit Button -->
                                        <form action="/busedit" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $d->id }}">
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white rounded-md text-xs font-semibold transition shadow-sm">
                                                Edit
                                            </button>
                                        </form>

                                        <!-- Delete Button -->
                                        <form action="/busdelete" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this bus record?')">
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
            <!-- Empty State for Bus Records -->
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-12 text-center max-w-md mx-auto mt-10">
                <div class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-slate-100 text-slate-400 mb-4">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                    </svg>
                </div>
                <h3 class="text-base font-semibold text-slate-800">No Buses Registered</h3>
                <button onclick="window.location.href='/addbus'" class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg shadow transition">
                    + Register First Bus
                </button>
            </div>
        @endif

    </div>

</body>
</html>