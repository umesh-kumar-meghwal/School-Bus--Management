<h1>Apk File Upload </h1>
<meta name="csrf-token" content="{{ csrf_token() }}">
<p>Apk File Name : <input type="text" name="file_name" id="file_name"></p>
<input type="file" name="file" id="apk">
<button id="upload">Upload</button>
<p id="show"></p>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>

    $("#upload").click(function(){

    
        let file = $("#apk")[0].files[0];
        let file_name = $("#file_name").value;
    
        let data = new FormData();
        data.append("file",file);
        data.append("file_name",file_name);

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
                document.getElementById("show").innerHTML=res.success+res.filename;
            },
            error:function(xhr,status,error){
                console.log("status:",status);
                console.log("Error:",error);
                console.log("Response:",xhr.responseText);
            }
        })
    })
</script>