<meta name="csrf-token" content="{{ csrf_token() }}">
<h1>School Register</h1>
<p>School Name : <input type="text" name="school_name" id="school_name" placeholder="Enter The School Name" required></p>
<p>School Email : <input type="text" name="school_email" id="school_email" placeholder="Enter The School Email " required></p>
<p>Phone : <input type="text" name="phone" id="phone" placeholder="Enter The Phone " required>
<p>Address : <input type="text" name="address" id="address" placeholder="Enter the address" required></p>
<button onclick="myFuntcion()">Submit</button>
<p id="show"></p>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    function myFuntcion(event) {
        if (event) event.preventDefault();
        let school_name = document.getElementById('school_name').value;
        let school_email = document.getElementById('school_email').value;
        let phone = document.getElementById('phone').value;
        let address = document.getElementById('address').value;
        console.log(school_name);
        $.ajax({
            url: "/school-regs",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                school_name: school_name,
                school_email: school_email,
                phone: phone,
                address: address
            },
            success: function(data) {
               document.getElementById('show').innerHTML=data.message;
               school_name.value="";
               school_email.value="";
               phone.value="";
               address.value="";
            },
            error: function(xhr, status, error) {
                console.error("Error details:", xhr.responseText);
            }
        })
    }
</script>