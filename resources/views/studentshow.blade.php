<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Records</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 font-sans antialiased min-h-screen p-4 md:p-8">

    <div class="max-w-7xl mx-auto">
        
        <!-- Top Navigation & Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <button onclick="history.back()" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-slate-800 transition mb-2">
                    ← Back to Dashboard
                </button>
                <h1 class="text-2xl font-bold text-slate-800">Student Details</h1>
            </div>

            <!-- Register Button at Top (Only if data exists) -->
            @if ($data && count($data)>0)
                <div>
                    <button onclick="window.location.href='/student'" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg shadow transition">
                        + Student Register
                    </button>
                </div>
            @endif
        </div>

        <!-- Data Check -->
        @if ($data && count($data)>0)
            
            <!-- Table Card Container -->
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="overflow-x-auto w-full">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Name</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Father's Name</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Mother's Name</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Mobile</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Guardian's Mobile</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Email</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Address</th>
                                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-slate-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-100">
                            @foreach ($data as $d)
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-slate-900">{{ $d->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $d->father_name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $d->mother_name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $d->mobile }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $d->guardians_mobile }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $d->email }}</td>
                                <td class="px-6 py-4 text-sm text-slate-600 min-w-[200px]">{{ $d->address }}</td>
                                
                                <!-- Action Buttons -->
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <div class="flex items-center justify-center gap-2">
                                        
                                        <!-- Edit Action -->
                                        <form action="/studentedit" method="post" class="inline">
                                            @csrf
                                            <input type="hidden" value="{{ $d->email }}" name="email">
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white rounded-md text-xs font-medium transition shadow-sm">
                                                Edit
                                            </button>
                                        </form>

                                        <!-- View Details Action -->
                                        <form action="/s-profileshow" method="post" class="inline">
                                            @csrf
                                            <input type="hidden" value="{{ $d->email }}" name="email">
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md text-xs font-medium transition shadow-sm">
                                                Details
                                            </button>
                                        </form>

                                        <!-- Delete Action -->
                                        <form action="/studentdelete" method="post" class="inline" onsubmit="return confirm('Are you sure you want to delete this student?')">
                                            @csrf
                                            <input type="hidden" value="{{ $d->email }}" name="email">
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-rose-600 hover:bg-rose-700 text-white rounded-md text-xs font-medium transition shadow-sm">
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
                <h3 class="text-base font-semibold text-slate-800">No Student Records</h3>
                <p class="text-sm text-slate-500 mt-1 mb-6">Database me filhal koi student registered nahi hai.</p>
                <button onclick="window.location.href='/student'" class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg shadow transition">
                    + Register First Student
                </button>
            </div>

        @endif

    </div>

</body>
</html>