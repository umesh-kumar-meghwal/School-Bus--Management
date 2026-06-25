<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Route Stops</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 font-sans antialiased min-h-screen p-4 md:p-8 flex items-center justify-center">

    <div class="max-w-xl w-full bg-white rounded-2xl border border-slate-200 shadow-xl p-6 md:p-8">
        
        <!-- Back Button & Header -->
        <div class="mb-6 border-b border-slate-100 pb-4">
            <button onclick="history.back()" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-slate-800 transition mb-3">
                ← Back
            </button>
            <h1 class="text-2xl font-bold text-slate-800">Route Stops Details</h1>
        </div>

        <!-- Data Check -->
        @if ($data && count($data) > 0)
            
            <!-- Stops Vertical Flow Timeline -->
            <div class="relative pl-6 border-l-2 border-indigo-100 space-y-6 my-4 ml-2">
                @foreach ($data as $d)
                    <div class="relative">
                        
                        <!-- Timeline Node Dot -->
                        <span class="absolute -left-[31px] top-1.5 flex h-4 w-4 items-center justify-center rounded-full bg-indigo-600 ring-4 ring-white">
                            <span class="h-1.5 w-1.5 rounded-full bg-white"></span>
                        </span>
                        
                        <!-- Stop Card -->
                        <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 hover:shadow-sm hover:border-slate-300 transition duration-150">
                            <h3 class="text-base font-bold text-slate-800">{{ $d->stop_name }}</h3>
                            
                            <!-- Timing Badges -->
                            <div class="flex flex-wrap gap-3 mt-3">
                                <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    PickUp: {{ $d->pickup_time }}
                                </div>
                                <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-100">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                    Drop: {{ $d->drop_time }}
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

        @else
            <!-- Empty State: No Stops Added Yet -->
            <div class="text-center py-8">
                <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-amber-50 text-amber-500 mb-5">
                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-800">No Stops Assigned</h3>
                
                <button onclick="window.location.href='/add-stop'" class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-lg shadow transition">
                    + Add New Stop
                </button>
            </div>
        @endif

    </div>

</body>
</html>