<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Fee Transaction</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 font-sans antialiased min-h-screen flex items-center justify-center p-4 md:p-8">

    @if($data)
    <div class="max-w-xl w-full bg-white rounded-2xl border border-slate-200 shadow-xl p-6 md:p-8">
        
        <!-- Back Button & Header -->
        <div class="mb-6">
            <button onclick="history.back()" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-slate-800 transition mb-4">
                ← Back
            </button>
            <h1 class="text-2xl font-bold text-slate-800">Fees Edit</h1>
        </div>

        <!-- Form Start -->
        <form action="/fees-edits" method="post" class="space-y-5">
            @csrf
            
            <!-- Hidden Input for ID -->
            <input type="hidden" value="{{ $data->id }}" name="id">

            <!-- Stop Name Dropdown -->
            <div>
                <label for="st_name" class="block text-sm font-medium text-slate-700 mb-1.5">Stop Name</label>
                <select 
                    id="st_name" 
                    name="stop_name"
                    onload="myfunction(this.value)"
                    class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 bg-white"
                    required
                >
                    @if($data1)
                        @foreach ($data1 as $d)
                            <option value="{{ $d->stop_name }}" {{ $data->stop_name == $d->stop_name ? 'selected' : '' }}>
                                {{ $d->stop_name }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>

            <!-- Form Fields Grid (2-Columns on larger screens) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                
                <!-- Total Fee (Auto Calculated via AJAX) -->
                <div class="sm:col-span-2">
                    <label for="t_fee" class="block text-sm font-medium text-slate-500 mb-1.5">Total Fee</label>
                    <input 
                        type="text" 
                        id="t_fee" 
                        name="total_fee" 
                        value="{{ $data->total_fee }}"
                        class="w-full px-3.5 py-2 border border-slate-200 bg-slate-50 text-slate-600 font-bold rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                        required
                    >
                </div>

                <!-- Deposit Fee -->
                <div>
                    <label for="deposit_fee" class="block text-sm font-medium text-slate-700 mb-1.5">Deposit Fee</label>
                    <input 
                        type="text" 
                        id="deposit_fee"
                        name="deposit_fee" 
                        value="{{ $data->deposit_fee }}"
                        class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                        required
                    >
                </div>

                <!-- Due Fee -->
                <div>
                    <label for="due_fee" class="block text-sm font-medium text-slate-700 mb-1.5">Due Fee</label>
                    <input 
                        type="text" 
                        id="due_fee"
                        name="due_fee" 
                        value="{{ $data->due_fee }}"
                        class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                        required
                    >
                </div>

                <!-- Date Field -->
                <div>
                    <label for="date" class="block text-sm font-medium text-slate-700 mb-1.5">Date</label>
                    <input 
                        type="text" 
                        id="date" 
                        name="date" 
                        value="{{ $data->date }}"
                        class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                        required
                    >
                </div>

                <!-- Time Field -->
                <div>
                    <label for="time" class="block text-sm font-medium text-slate-700 mb-1.5">Time</label>
                    <input 
                        type="text" 
                        id="time" 
                        name="time" 
                        value="{{ $data->time }}"
                        class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                        required
                    >
                </div>

            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <button 
                    type="submit" 
                    class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm rounded-lg shadow-sm hover:shadow transition duration-150 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Save Changes
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
    @endif

    <!-- jQuery & AJAX Script Logic (Retained from original code) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        document.getElementById('st_name').onchange = function() {
            var st = this.value;
            $.ajax({
                url: '/total-fee-fetch',
                type: 'POST',
                data: {
                    _token : '{{ csrf_token() }}',
                    st_name: st
                },
                success: function(data) {
                    document.getElementById('t_fee').value = data.fee + 'rs';
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const now = new Date();

            document.getElementById('date').value = now.toLocaleDateString();
            document.getElementById('time').value = now.toLocaleTimeString();
            console.log(now.toLocaleDateString());
            console.log(now.toLocaleTimeString());

            var st = document.getElementById('st_name').value;
            $.ajax({
                url: '/total-fee-fetch',
                type: 'POST',
                data: {
                    _token : '{{ csrf_token() }}',
                    st_name: st
                },
                success: function(data) {
                    document.getElementById('t_fee').value = data.fee + 'rs';
                }
            });
        });
    </script>

</body>
</html>