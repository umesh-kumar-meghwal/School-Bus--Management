<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fee Structure</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 font-sans antialiased min-h-screen p-4 md:p-8">

    <div class="max-w-4xl mx-auto">
        
        <!-- Top Navigation & Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <button onclick="history.back()" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-slate-800 transition mb-2">
                    ← Back
                </button>
                <h1 class="text-2xl font-bold text-slate-800">Show Fee Structure</h1>
            </div>
        </div>

        <!-- Data Check -->
        @if($data)
            
            <!-- Table Card Container -->
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="overflow-x-auto w-full">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Stop Name</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Fee</th>
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

                                <!-- Monthly Fee (Highlighted) -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-indigo-700 font-bold bg-indigo-50/20 inline-block my-3 ml-6 rounded-lg">
                                    Rs. {{ $d->fee }}
                                </td>
                                
                                <!-- Action Buttons -->
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <div class="flex items-center justify-center gap-2">
                                        
                                        <!-- Edit Fee Action -->
                                        <form action="/fee-edit" method="post" class="inline">
                                            @csrf
                                            <input type="hidden" value="{{ $d->id }}" name="id">
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white rounded-md text-xs font-semibold transition shadow-sm">
                                                Edit
                                            </button>
                                        </form>

                                        <!-- Delete Fee Action -->
                                        <form action="/fee-delete" method="post" class="inline" onsubmit="return confirm('Are you sure you want to delete this fee structure?')">
                                            @csrf
                                            <input type="hidden" value="{{ $d->id }}" name="id">
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
            <!-- Empty State for Fee Structure -->
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-12 text-center max-w-md mx-auto mt-10">
                <div class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-slate-100 text-slate-400 mb-4">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                </div>
                <h3 class="text-base font-semibold text-slate-800">No Fee Structure</h3>
            </div>
        @endif

    </div>

</body>
</html>