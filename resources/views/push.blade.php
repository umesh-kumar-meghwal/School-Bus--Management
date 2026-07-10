<meta name="csrf-token" content="{{ csrf_token() }}">
<h1>All Student Push Notifications</h1>
<p>Enter the Title : <input type="text" name="title" id="title"></p>
<p>Enter the Content <textarea type="text" name="content" id="content"></textarea></p>
<input type="hidden" name="school_email" value="{{ $school_email }}" id="school_email">
<button onclick="myfunction()">Push</button>
<p id="show"></p>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    function myfunction()
    {
        var title = document.getElementById('title').value;
        var content = document.getElementById('content').value;
        var school_email = document.getElementById("school_email").value;
        $.ajax({
            url:"/pushed",
            type:"GET",
            data : {
                _token:"{{ csrf_token() }}",
                title:title,
                content:content,
                school_email :school_email
            },
            success:function(data)
            {
                document.getElementById('show').innerHTML=data.msg;
            }
        })
    }
</script>