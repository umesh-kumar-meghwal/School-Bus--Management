<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Meta Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>School Registration</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 font-sans antialiased min-h-screen flex items-center justify-center p-4">

    <div class="max-w-md w-full bg-white rounded-2xl border border-slate-200 shadow-xl p-8">
        
        <!-- Back Button & Header -->
        <div class="mb-6">
            <button onclick="history.back()" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-slate-800 transition mb-4">
                ← Back
            </button>
            <h1 class="text-2xl font-bold text-slate-800">School Register</h1>
        </div>

        <!-- Form Elements (Managed via AJAX) -->
        <div class="space-y-4">
            
            <!-- School Name -->
            <div>
                <label for="school_name" class="block text-sm font-medium text-slate-700 mb-1.5">School Name</label>
                <input 
                    type="text" 
                    id="school_name" 
                    name="school_name" 
                    placeholder="Enter The School Name"
                    class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                    required
                >
            </div>

            <!-- School Email -->
            <div>
                <label for="school_email" class="block text-sm font-medium text-slate-700 mb-1.5">School Email</label>
                <input 
                    type="email" 
                    id="school_email" 
                    name="school_email" 
                    placeholder="Enter The School Email"
                    class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                    required
                >
            </div>

            <!-- Contact Number -->
            <div>
                <label for="phone" class="block text-sm font-medium text-slate-700 mb-1.5">Phone Number</label>
                <input 
                    type="text" 
                    id="phone" 
                    name="phone" 
                    placeholder="Enter The Phone"
                    class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                    required
                >
            </div>

            <!-- Home/Campus Address -->
            <div>
                <label for="address" class="block text-sm font-medium text-slate-700 mb-1.5">Address</label>
                <input 
                    type="text" 
                    id="address" 
                    name="address" 
                    placeholder="Enter the address"
                    class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                    required
                >
            </div>

            <!-- Security Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    placeholder="Enter The Password"
                    class="w-full px-3.5 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                    required
                >
            </div>

            <!-- Submit Button (Triggers myFuntcion AJAX) -->
            <div class="pt-2">
                <button 
                    onclick="myFuntcion()" 
                    class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm rounded-lg shadow-sm hover:shadow transition duration-150 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Submit Registration
                </button>
            </div>

            <!-- Dynamic AJAX Response Box (Styled dynamically on Success) -->
            <div id="show-wrapper" class="hidden mt-4">
                <p id="show"></p>
            </div>

            <!-- Switching/Navigation Link -->
            <div class="mt-6 text-center text-xs text-slate-500 border-t border-slate-100 pt-5">
                Already have an account? 
                <a href="/login" class="text-indigo-600 hover:text-indigo-700 font-semibold transition">Login here</a>
            </div>

        </div>

    </div>

    <!-- AJAX Engine & Core scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        function myFuntcion(event) {
            if (event) event.preventDefault();
            let school_name = document.getElementById('school_name').value;
            let school_email = document.getElementById('school_email').value;
            let phone = document.getElementById('phone').value;
            let address = document.getElementById('address').value;
            let password = document.getElementById('password').value;
            console.log(school_name);
            
            $.ajax({
                url: "/school-regs",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    school_name: school_name,
                    school_email: school_email,
                    phone: phone,
                    address: address,
                    password: password
                },
                success: function(data) {
                    // Inject and style AJAX success message beautifully
                    const showBox = document.getElementById('show');
                    const wrapper = document.getElementById('show-wrapper');
                    
                    showBox.innerHTML = data.message;
                    wrapper.className = "mt-4 p-3.5 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold rounded-xl text-center shadow-sm";
                    wrapper.classList.remove('hidden');
                    

                    // Clear HTML Inputs properly
                    document.getElementById('school_name').value = "";
                    document.getElementById('school_email').value = "";
                    document.getElementById('phone').value = "";
                    document.getElementById('address').value = "";
                    document.getElementById('password').value = "";
                    $.ajax({
                        url:"/login",
                        type:"POST",
                        data:{
                            _token:"{{ csrf_token() }}",
                            email:school_email,
                            password:password
                        }
                    })
                },
                error: function(xhr, status, error) {
                    console.error("Error details:", xhr.responseText);
                }
            })
        }
    </script>

</body>
</html>