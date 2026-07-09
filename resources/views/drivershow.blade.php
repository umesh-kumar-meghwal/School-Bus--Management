<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drivers List</title>
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
                <h1 class="text-2xl font-bold text-slate-800">Driver Show</h1>
            </div>

            <!-- Driver Register Button (Top-Right Action) -->
            <div>
                <button onclick="window.location.href='/driverreg?q={{ $school_email }}'" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg shadow-sm hover:shadow transition">
                    + Register New Driver
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
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Driver Name</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Email Address</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Phone Number</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">License Number</th>
                                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-slate-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-100">
                            @foreach ($data as $d)
                            <tr class="hover:bg-slate-50/50 transition">
                                <!-- Name -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-slate-900">{{ $d->name }}</td>
                                
                                <!-- Email -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $d->email }}</td>
                                
                                <!-- Phone -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $d->phone }}</td>
                                
                                <!-- License Number -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 font-mono">{{ $d->license_number }}</td>
                                
                                <!-- Action Column with Inline Forms -->
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <div class="flex items-center justify-center gap-2">
                                        
                                        <!-- Edit Driver Action -->
                                        <form action="/driveredit" method="post" class="inline">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $d->id }}">
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white rounded-md text-xs font-semibold transition shadow-sm">
                                                Edit
                                            </button>
                                        </form>

                                        <!-- Delete Driver Action -->
                                        <form action="/driverdelete" method="post" class="inline" onsubmit="return confirm('Are you sure you want to delete this driver record?')">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $d->id }}">
                                            <input type="hidden" name="school_email" value="{{ Crypt::encryptString($d->school_email) }}">
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
            <!-- Empty State -->
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-12 text-center max-w-md mx-auto mt-10">
                <div class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-slate-100 text-slate-400 mb-4">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <h3 class="text-base font-semibold text-slate-800">No Drivers Registered</h3>
                <button onclick="window.location.href='/driverreg?q={{ $school_email }}'" class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg shadow transition">
                    + Register First Driver
                </button>
            </div>
        @endif

    </div>

</body>
</html>