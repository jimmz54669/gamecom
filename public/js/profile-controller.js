
//Upload ProfPic
$(document).on('change', '#prof_pic_input', function(){

    var form_action = '/gamecom/public/addprofpic';
    if(document.getElementById("prof_pic_input").files.length !== 0){
        var PostPic = document.getElementById("prof_pic_input").files[0].name;
       
        var form_data = new FormData();
        var ext = PostPic.split('.').pop().toLowerCase();
        if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1)  
        {
        swal("Opps!", "Invalid Image File!", "error");
        }

        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("prof_pic_input").files[0]);
        var f = document.getElementById("prof_pic_input").files[0];
        var fsize = f.size||f.fileSize;

        if(fsize > 50000000)
        {
        swal("Opps!", "Image File Size is very big!", "error");
        }else
        {
            form_data.append("profpic", document.getElementById('prof_pic_input').files[0]);
           
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: form_action,
                    method: 'post',
                    processData: false,
                    contentType: false,
                    cache: false,
                    data:form_data,
                    enctype: 'multipart/form-data',
                    success: function(data){
                        console.log('Success');
                        swal("Sucessful", "Uploaded a Picture!", "success");
                        location.reload();
                    },
                    error: function(data){
                        console.log('There Something Wrong With Code!');
                    }
                });
            
        }
    }
}); //End Jquery Function



$().on('click', '.edit-firstname', function(){

    
});





