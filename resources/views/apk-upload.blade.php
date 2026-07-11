<h1>Apk File Upload </h1>

<input type="file" name="file" id="apk">
<button id="upload">Upload</button>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>

    $("#upload").click(function(){

    
        let file = $("#apk")[0].files[0];
        let data = new FormData();
        data.append("file",file);
        console.log(file,data);

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
            },
            error:function(xhr,status,error){
                console.log("status:",status);
                console.log("Error:",error);
                console.log("Response:",xhr.responseText);
                alert("Something went wrong");
            }
        })
    })
</script>