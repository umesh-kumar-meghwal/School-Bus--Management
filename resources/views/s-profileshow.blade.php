<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 font-sans antialiased min-h-screen flex items-center justify-center p-4 md:p-8">

    @if ($data)
    <div class="max-w-3xl w-full bg-white rounded-2xl border border-slate-200 shadow-xl overflow-hidden">

        <!-- Top Cover Pattern & Back Button -->
        <div class="bg-gradient-to-r from-indigo-600 to-indigo-800 h-32 px-6 md:px-8 pt-6 relative">
            <button onclick="history.back()" class="inline-flex items-center gap-1.5 text-xs font-semibold text-indigo-100 hover:text-white transition">
                ← Back
            </button>
            <h1 class="text-white text-xl font-bold mt-2">Student Profile</h1>
        </div>

        <!-- Main Body -->
        <div class="px-6 md:px-8 pb-8 -mt-15">

            <div class="flex flex-col md:flex-row gap-6 items-start">

                <!-- Left Side: Profile Image & Actions -->
                <div class="flex flex-col items-center text-center w-full md:w-48 flex-shrink-0 bg-slate-50 p-4 rounded-xl border border-slate-200">

                    <!-- Photo Logic -->
                    @if ($data->photo == '')
                    <!-- Default Avatar Placeholder -->
                    <div class="h-40 w-full max-w-[150px] rounded-xl bg-slate-200 flex items-center justify-center border border-slate-300 shadow-sm text-slate-400 mb-4 aspect-square">
                        <svg class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                    </div>

                    <!-- Upload Button -->
                    <form action="/sphotoupload" method="post" class="w-full">
                        @csrf
                        <input type="hidden" value="{{ $data->email }}" name="email">
                        <button type="submit" class="w-full py-2 px-3 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 font-semibold text-xs rounded-lg transition border border-indigo-200 shadow-sm">
                            Upload Photo
                        </button>
                    </form>
                    @else
                    <!-- Uploaded Photo (Fits any ratio properly) -->
                    <div class="h-40 w-full max-w-[150px] rounded-xl overflow-hidden bg-white border border-slate-200 shadow-sm mb-4 p-1">
                        <img src="{{ asset('uploads/'.$data->photo) }}" class="w-full h-full object-contain rounded-lg" alt="Student Photo">
                    </div>

                    <!-- Change Photo Button -->
                    <form action="/sphotochange" method="post" class="w-full">
                        @csrf
                        <input type="hidden" value="{{ $data->email }}" name="email">
                        <input type="hidden" value="{{ $data->photo }}" name="p">
                        <button type="submit" class="w-full py-2 px-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs rounded-lg transition border border-slate-300 shadow-sm">
                            Change Photo
                        </button>
                    </form>
                    @endif

                    <!-- Quick Utilities Sub-Buttons -->
                    <div class="w-full mt-4 pt-4 border-t border-slate-200 space-y-2">
                        <form action="/bus-details" method="post" class="w-full">
                            @csrf
                            <input type="hidden" value="{{ $data->email }}" name="email">
                            <input type="hidden" value="{{ $data->school_email }}" name="school_email">
                            <button type="submit" class="w-full py-2 px-3 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs rounded-lg transition shadow-sm">
                                Bus Details
                            </button>
                        </form>
                        <form action="/fee-details" method="post" class="w-full">
                            @csrf
                            <input type="hidden" value="{{ $data->email }}" name="email">
                            <input type="hidden" value="{{ $data->school_email }}" name="school_email">

                            <button type="submit" class="w-full py-2 px-3 bg-amber-500 hover:bg-amber-600 text-white font-semibold text-xs rounded-lg transition shadow-sm">
                                Fee Details
                            </button>
                        </form>
                    </div>

                </div>

                <!-- Right Side: Details Grid -->
                <div class="flex-1 w-full">

                    <!-- Student Header Details -->
                    <div class="mb-6 mt-4 md:mt-12">
                        <h2 class="text-2xl font-bold text-slate-800">{{ $data->name }}</h2>
                        <p class="text-sm font-medium text-indigo-600 mt-0.5">{{ $data->depart_name }} Department</p>
                    </div>

                    <!-- Personal Information Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 border-t border-slate-100 pt-6">

                        <div>
                            <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Father's Name</span>
                            <span class="text-sm font-semibold text-slate-800 mt-1 block">{{ $data->father_name }}</span>
                        </div>

                        <div>
                            <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Mother's Name</span>
                            <span class="text-sm font-semibold text-slate-800 mt-1 block">{{ $data->mother_name }}</span>
                        </div>

                        <div>
                            <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Student Mobile</span>
                            <span class="text-sm font-semibold text-slate-800 mt-1 block">{{ $data->mobile }}</span>
                        </div>

                        <div>
                            <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Guardian's Mobile</span>
                            <span class="text-sm font-semibold text-slate-800 mt-1 block">{{ $data->guardians_mobile }}</span>
                        </div>

                        <div class="sm:col-span-2">
                            <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Email Address</span>
                            <span class="text-sm font-semibold text-slate-800 mt-1 block">{{ $data->email }}</span>
                        </div>

                        <div class="sm:col-span-2">
                            <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Home Address</span>
                            <span class="text-sm font-semibold text-slate-800 mt-1 block">{{ $data->address }}</span>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
    @endif

</body>

</html>