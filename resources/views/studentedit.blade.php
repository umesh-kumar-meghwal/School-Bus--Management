<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 font-sans antialiased min-h-screen flex items-center justify-center p-4 md:p-8">

    @if ($data)
    <div class="max-w-2xl w-full bg-white rounded-2xl border border-slate-200 shadow-xl p-6 md:p-8">
        
        <!-- Back Button & Header -->
        <div class="mb-6">
            <button onclick="history.back()" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-slate-800 transition mb-4">
                ← Back
            </button>
            <h1 class="text-2xl font-bold text-slate-800">Student Edit</h1>
        </div>

        <!-- Form Start -->
        <form action="/studentedit1" method="post" class="space-y-6">
            @csrf

            <!-- Form Grid Layout -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                
                <!-- Student Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">Student Name</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ $data->name }}"
                        class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                        required
                    >
                </div>

                <!-- Email Address (Read Only) -->
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-500 mb-1.5">Email Address (Read-only)</label>
                    <input 
                        type="text" 
                        id="email" 
                        name="email" 
                        value="{{ $data->email }}"
                        class="w-full px-3.5 py-2 border border-slate-200 bg-slate-100 text-slate-500 rounded-lg text-sm cursor-not-allowed focus:outline-none"
                        readonly
                    >
                </div>

                <!-- Father's Name -->
                <div>
                    <label for="father_name" class="block text-sm font-medium text-slate-700 mb-1.5">Father's Name</label>
                    <input 
                        type="text" 
                        id="father_name" 
                        name="father_name" 
                        value="{{ $data->father_name }}"
                        class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                        required
                    >
                </div>

                <!-- Mother's Name -->
                <div>
                    <label for="mother_name" class="block text-sm font-medium text-slate-700 mb-1.5">Mother's Name</label>
                    <input 
                        type="text" 
                        id="mother_name" 
                        name="mother_name" 
                        value="{{ $data->mother_name }}"
                        class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                        required
                    >
                </div>

                <!-- Student Mobile -->
                <div>
                    <label for="mobile" class="block text-sm font-medium text-slate-700 mb-1.5">Mobile No.</label>
                    <input 
                        type="text" 
                        id="mobile" 
                        name="mobile" 
                        value="{{ $data->mobile }}"
                        class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                        required
                    >
                </div>

                <!-- Guardian's Mobile -->
                <div>
                    <label for="guardians_mobile" class="block text-sm font-medium text-slate-700 mb-1.5">Guardians Mobile No.</label>
                    <input 
                        type="text" 
                        id="guardians_mobile" 
                        name="guardians_mobile" 
                        value="{{ $data->guardians_mobile }}"
                        class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                        required
                    >
                </div>

                <!-- Department Name (Dropdown) -->
                <div>
                    <label for="depart_name" class="block text-sm font-medium text-slate-700 mb-1.5">Department Name</label>
                    <select 
                        id="depart_name" 
                        name="depart_name"
                        class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 bg-white"
                        required
                    >
                        <option value="" disabled>Select</option>
                        @if ($datas)
                            @foreach ($datas as $ds)
                                <option value="{{ $ds->depart_name }}" {{ $data->depart_name == $ds->depart_name ? 'selected' : '' }}> 
                                    {{ $ds->depart_name }} 
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <!-- Address (Full Width on Grid) -->
                <div class="md:col-span-2">
                    <label for="address" class="block text-sm font-medium text-slate-700 mb-1.5">Address</label>
                    <input 
                        type="text" 
                        id="address" 
                        name="address" 
                        value="{{ $data->address }}"
                        class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                        required
                    >
                </div>

            </div>

            <!-- Submit Button -->
            <div class="pt-4 border-t border-slate-100">
                <button 
                    type="submit" 
                    class="w-full py-3 px-4 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm rounded-lg shadow-sm hover:shadow transition duration-150 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2"
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