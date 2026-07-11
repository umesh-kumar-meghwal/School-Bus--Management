<h1>Apk File Upload </h1>

<input type="file" name="apk" id="apk">
<button onclick="myFunction()">Upload</button>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>

    function myFunction()
    {
        let file = document.getElementById("apk")[0].files[0];
        let data = new FormData();
        data.append("file",file);

        $.ajax({
            url:"/apk-upload",
            type:"POST",
            data:data,
            processData:false,
            contentType:false,
            headers:{
                "X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")
            },
            success:function(res){
                console.log(res);
            }
        })
    }
</script>