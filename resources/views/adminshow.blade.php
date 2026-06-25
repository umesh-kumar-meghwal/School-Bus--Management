<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Data</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 font-sans antialiased min-h-screen p-4 md:p-8">

    <div class="max-w-4xl mx-auto">
        
        <!-- Top Navigation & Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <button onclick="history.back()" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-slate-800 transition mb-2">
                    ← Back to Dashboard
                </button>
                <h2 class="text-2xl font-bold text-slate-800">Admin Data</h2>
            </div>
        </div>

        <!-- Data Check -->
        @if ($data && count($data) > 0)
            <!-- Table Container (Responsive Scroll) -->
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                                    Contact
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                                    Address
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200 divide-y divide-slate-100">
                            @foreach($data as $data)
                                <tr class="hover:bg-slate-50/80 transition duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-slate-900">
                                        {{ $data->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                        {{ $data->contact }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-600">
                                        {{ $data->address }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <!-- Empty State (Data not found) -->
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-12 text-center">
                <div class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-slate-100 text-slate-400 mb-4">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0V9a2 2 0 00-2-2H6a2 2 0 00-2 2v4h16z" />
                    </svg>
                </div>
                <h3 class="text-base font-semibold text-slate-800">No Data Found</h3>
            </div>
        @endif

    </div>

</body>
</html>