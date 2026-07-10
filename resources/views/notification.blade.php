<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification Inbox</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 font-sans antialiased min-h-screen p-4 md:p-8 flex items-center justify-center">

    <div class="max-w-2xl w-full bg-white rounded-2xl border border-slate-200 shadow-xl p-6 md:p-8">
        
        <!-- Back Button & Header -->
        <div class="mb-6 border-b border-slate-100 pb-4">
            <button onclick="history.back()" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-slate-800 transition mb-3">
                ← Back to Dashboard
            </button>
            <h1 class="text-2xl font-bold text-slate-800">Notifications</h1>
        </div>

        <!-- Data Check -->
        @if($data && count($data)>0)
            
            <!-- Notifications Feed Stack -->
            <div class="space-y-4 my-2">
                @foreach ($data as $d)
                <div class="p-5 bg-slate-50 border border-slate-200 rounded-2xl hover:bg-slate-100/50 hover:shadow-sm hover:border-slate-300 transition duration-150 flex items-start gap-4">
                    
                    <!-- Icon Indicator -->
                    <div class="h-10 w-10 rounded-xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-lg flex-shrink-0">
                        📢
                    </div>

                    <!-- Content Body -->
                    <div class="flex-1 min-w-0">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-1 mb-2">
                            <!-- Title -->
                            <h4 class="text-sm font-bold text-slate-800 truncate" title="{{ $d->title }}">{{ $d->title }}</h4>
                            
                            <!-- Date & Time Badge -->
                            <span class="inline-flex items-center gap-1 text-[10px] font-semibold text-slate-400 shrink-0">
                                📅 {{ $d->date }} | ⏰ {{ $d->time }}
                            </span>
                        </div>
                        <!-- Content Body Message -->
                        <p class="text-xs text-slate-600 leading-relaxed">{{ $d->content }}</p>
                    </div>

                </div>
                @endforeach
            </div>

        @else
            <!-- Empty State: No Notification -->
            <div class="text-center py-12">
                <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-slate-100 text-slate-400 mb-5">
                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 19v-8.93a2 2 0 01.89-1.664l8-5.333a2 2 0 012.22 0l8 5.333A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-2.25-1.5a2 2 0 00-2.5 0l-2.25 1.5" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-800">No Notifications</h3>
            </div>
        @endif

    </div>

</body>
</html>