<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Fee Details</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 font-sans antialiased min-h-screen flex items-center justify-center p-4">

    @if($data)
    <div class="max-w-md w-full bg-white rounded-2xl border border-slate-200 shadow-xl p-8">
        
        <!-- Back Button & Header -->
        <div class="mb-6">
            <button onclick="history.back()" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-slate-800 transition mb-4">
                ← Back
            </button>
            <h1 class="text-2xl font-bold text-slate-800">Fee Edit</h1>
        </div>

        <!-- Form Start -->
        <form action="/fee-edits" method="post" class="space-y-5">
            @csrf
            
            <!-- Hidden Input for ID -->
            <input type="hidden" value="{{ $data->id }}" name="id">

            <!-- Stop Selection Dropdown -->
            <div>
                <label for="stop_name" class="block text-sm font-medium text-slate-700 mb-1.5">Select Stop</label>
                <select 
                    id="stop_name" 
                    name="stop_name"
                    class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 bg-white"
                    required
                >
                    @foreach ($data1 as $d)
                        <option value="{{ $d->stop_name }}" {{ $data->stop_name == $d->stop_name ? 'selected' : '' }}>
                            {{ $d->stop_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Fee Amount Input -->
            <div>
                <label for="fee" class="block text-sm font-medium text-slate-700 mb-1.5">Edit Fee Amount</label>
                <div class="relative rounded-lg shadow-sm">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <span class="text-slate-400 text-sm">Rs.</span>
                    </div>
                    <input 
                        type="number" 
                        id="fee"
                        name="fee" 
                        value="{{ $data->fee }}"
                        class="w-full pl-10 pr-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                        required
                    >
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <button 
                    type="submit" 
                    class="w-full py-2.5 px-4 bg-emerald-600 hover:bg-emerald-700 text-white font-medium text-sm rounded-lg shadow-sm hover:shadow transition duration-150 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2"
                >
                    Save Changes
                </button>
            </div>

        </form>
        <!-- Form End -->

    </div>
    @endif

</body>
</html>