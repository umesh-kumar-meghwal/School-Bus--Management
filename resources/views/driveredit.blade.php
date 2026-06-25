<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Driver Details</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 font-sans antialiased min-h-screen flex items-center justify-center p-4 md:p-8">

    @if ($data)
    <div class="max-w-xl w-full bg-white rounded-2xl border border-slate-200 shadow-xl p-6 md:p-8">
        
        <!-- Back Button & Header -->
        <div class="mb-6">
            <button onclick="history.back()" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-slate-800 transition mb-4">
                ← Back
            </button>
            <h1 class="text-2xl font-bold text-slate-800">Driver Edit</h1>
        </div>

        <!-- Form Start -->
        <form action="/driveredit1" method="post" class="space-y-5">
            @csrf
            
            <!-- Hidden Input for ID -->
            <input type="hidden" value="{{ $data->id }}" name="id">

            <!-- Name Field -->
            <div>
                <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">Driver Name</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ $data->name }}"
                    class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                    required
                >
            </div>

            <!-- Email Field -->
            <div>
                <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Email Address</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ $data->email }}"
                    class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                    required
                >
            </div>

            <!-- Phone Field -->
            <div>
                <label for="phone" class="block text-sm font-medium text-slate-700 mb-1.5">Phone Number</label>
                <input 
                    type="text" 
                    id="phone" 
                    name="phone" 
                    value="{{ $data->phone }}"
                    class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                    required
                >
            </div>

            <!-- License Field -->
            <div>
                <label for="license" class="block text-sm font-medium text-slate-700 mb-1.5">License Number</label>
                <input 
                    type="text" 
                    id="license" 
                    name="license" 
                    value="{{ $data->license_number }}"
                    class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                    required
                >
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <button 
                    type="submit" 
                    class="w-full py-2.5 px-4 bg-emerald-600 hover:bg-emerald-700 text-white font-medium text-sm rounded-lg shadow-sm hover:shadow transition duration-150 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2"
                >
                    Save & Change
                </button>
            </div>

        </form>
        <!-- Form End -->

    </div>
    @endif

</body>
</html>