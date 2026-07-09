<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Register</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 font-sans antialiased min-h-screen flex items-center justify-center p-4 md:p-8">

    <div class="max-w-2xl w-full bg-white rounded-2xl border border-slate-200 shadow-xl p-6 md:p-8">
        
        <!-- Back Button & Header -->
        <div class="mb-6">
            <button onclick="history.back()" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-slate-800 transition mb-4">
                ← Back to Dashboard
            </button>
            <h1 class="text-2xl font-bold text-slate-800">Student Register</h1>
        </div>

        <!-- Form Start -->
        <form action="/students" method="post" class="space-y-6">
            @csrf
<input type="hidden" name="school_email" value="{{ $school_email }}">
            <!-- Form Grid Layout (2 Columns on large screens, 1 Column on mobile) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                
                <!-- Student Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">Student Name</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        placeholder="Enter the name"
                        class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                        required
                    >
                </div>

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Email Address</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        placeholder="Enter the email"
                        class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                        required
                    >
                </div>

                <!-- Father's Name -->
                <div>
                    <label for="father_name" class="block text-sm font-medium text-slate-700 mb-1.5">Father's Name</label>
                    <input 
                        type="text" 
                        id="father_name" 
                        name="father_name" 
                        placeholder="Enter the Father's Name"
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
                        placeholder="Enter the Mother's Name"
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
                        placeholder="Enter the Mobile Number"
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
                        placeholder="Enter the Guardians Mobile No."
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
                        <option value="" disabled selected>-Select-</option>
                        @if ($data)
                            @foreach ($data as $d)
                                <option value="{{ $d->depart_name }}">{{ $d->depart_name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="Enter the Password"
                        class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                        required
                    >
                </div>

                <!-- Address (Full Width on Grid) -->
                <div class="md:col-span-2">
                    <label for="address" class="block text-sm font-medium text-slate-700 mb-1.5">Address</label>
                    <input 
                        type="text" 
                        id="address" 
                        name="address" 
                        placeholder="Enter the Address"
                        class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                        required
                    >
                </div>

            </div>

            <!-- Submit Button -->
            <div class="pt-4 border-t border-slate-100">
                <button 
                    type="submit" 
                    class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-lg shadow-sm hover:shadow transition duration-150 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Submit Registration
                </button>
            </div>

        </form>
        <!-- Form End -->
@if(isset($msg) && !empty($msg))
    @if(stripos($msg, 'already') !== false || stripos($msg, 'exist') !== false || stripos($msg, 'fail') !== false)
        <!-- Red Alert (For Already Exists / Error Messages) -->
        <div class="mt-6 p-4 bg-rose-50 border border-rose-200 rounded-xl flex items-start gap-3">
            <!-- Warning / Error Icon -->
            <svg class="h-5 w-5 text-rose-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <div>
                <h4 class="text-sm font-semibold text-rose-800">Alert</h4>
                <p class="text-xs text-rose-700 mt-0.5">{{ $msg }}</p>
            </div>
        </div>
    @else
        <!-- Green Alert (For Successful Messages) -->
        <div class="mt-6 p-4 bg-emerald-50 border border-emerald-200 rounded-xl flex items-start gap-3">
            <!-- Success Checkmark Icon -->
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

</body>
</html>