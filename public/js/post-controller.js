//Add Post
$(document).on('click', '.post-btn', function(){
    var content = $('.post-text').val();
    var form_action = '/gamecom/public/addpost';
 
    if(document.getElementById("photo_post").files.length !== 0){
        var PostPic = document.getElementById("photo_post").files[0].name;
       
        var form_data = new FormData();
        var ext = PostPic.split('.').pop().toLowerCase();
        if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1)  
        {
        swal("Opps!", "Invalid Image File!", "error");
        }

        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("photo_post").files[0]);
        var f = document.getElementById("photo_post").files[0];
        var fsize = f.size||f.fileSize;

        if(fsize > 50000000)
        {
        swal("Opps!", "Image File Size is very big!", "error");
        }else
        {
            form_data.append("photo_post", document.getElementById('photo_post').files[0]);
            form_data.append("content", content);
            // Checks if the input for Post is not Empty
            if(content !== ''){
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
                        $('.post-text').val(''); //Clears the input after clicking the Post Button
                        console.log('Success');
                       
                        swal("Sucessful", "Posted a Post!", "success")
                        .then((value) => {
                            location.reload();
                        });
                    },
                    error: function(data){
                        console.log('There Something Wrong With Code!');
                    }
                });
            }
        }
    }

    else{
        //Checks if Posttext is not empty
        if(content !== ''){
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: form_action,
                method: 'post',
                cache: false,
                data:{'content': content},
                success: function(data){
                    $('.post-text').val(''); //Clears the input after clicking the Post Button
                    console.log(data);
                    swal("Sucessful", "Posted a Post!", "success")
                    .then((value) => {
                        location.reload();
                    });
                    
                },
                error: function(data){
                    console.log('There Something Wrong With Code!');
                }
            });
        }else{
            swal("Opps!", "No Post Input Found, No Selected File!", "error");
        }
    }
});//End of AddPost Ajax



//Add Comment on Posts
$(document).on('click','.comment-btn',function(){
   
    var postid = $(this).data('postid');
    var comment_body = $('#comment-body'+postid).val();
    var form_action = '/gamecom/public/addcomment';

    if(comment_body+postid !== ''){
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: form_action,
            method: 'post',
            cache: false,
            data:{'comment_body': comment_body, 'postid': postid},
            success: function(data){
                $('.comment_body'+postid).val(''); //Clears the input after clicking the Post Button
                console.log(data);
                swal("Sucessful", "Posted a Comment!", "success")
                        .then((value) => {
                            location.reload();
                        });
            },
            error: function(data){
                console.log('There Something Wrong With Code!');
            }
        });
    }
});



//Edit Post
$(document).on('click','.edit-post',function(){
    var postid = $(this).data('postid');
    var picname = $(this).data('picname');
    var form_action = '/gamecom/public/editpost';

    $('#user-post-title'+postid).hide();
    $('#edit-title-post'+postid).removeAttr("hidden");
    $('#img-edit-post'+postid).removeAttr("hidden");
        
    $('#edit-title-post'+postid).on('keypress', function(e){
        if(e.which == 13){
            
            var editedpost = $('#edit-title-post'+postid).val();
            var oldpost = $('#old-title-post'+postid).val();
            
            if(document.getElementById('img_edit_post'+postid).files.length !== 0){
                var PostEditPic = document.getElementById('img_edit_post'+postid).files[0].name;
                var form_data = new FormData();
                var ext = PostEditPic.split('.').pop().toLowerCase();
                if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1)
                {
                swal("Opps!", "Invalid Image File!", "error");
                }

                var oFReader = new FileReader();
                oFReader.readAsDataURL(document.getElementById('img_edit_post'+postid).files[0]);
                var f = document.getElementById('img_edit_post'+postid).files[0];
                var fsize = f.size||f.fileSize;

                if(fsize > 2000000)
                {
                
                swal("Opps!", "Image File Size is very big!", "error");
                }
                else
                {
                    form_data.append("editedpic", document.getElementById('img_edit_post'+postid).files[0]);
                    form_data.append("postid", postid);
                    form_data.append("editedpost", editedpost);
                    form_data.append("picname", picname);
            
                    //alert(editedpost + ' - ' + PostEditPic +' - '+ picname);

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
                            console.log(data);
                
                            swal("Sucessful", "Updated a Post!", "success")
                            .then((value) => {
                                location.reload();
                            });
                        },
                        error: function(data){
                            console.log('There Something Wrong With Code!');
                        }
                    });

                }
                
            }else{
                alert(editedpost);
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: form_action,
                    method: 'post',
                    cache: false,
                    data:{'postid': postid, 'picname': picname, 'editedpost': editedpost},
                    success: function(data){
                        console.log(data);
                    
                        swal("Sucessful", "Updated a Post!", "success")
                        .then((value) => {
                            location.reload();
                        });
                    },
                    error: function(data){
                        console.log('There Something Wrong With Code!');
                    }
                });
            }
        }
    });


});


//Delete Post
$(document).on('click', '.delete-post', function(){
    var postid = $(this).data('postid');
    var picname = $(this).data('picname');
    var form_action = '/gamecom/public/deletepost';

    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this Post!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
        swal("Poof! Post has been deleted!", {
            icon: "success",
          }).then((value) => {
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: form_action,
                method: 'post',
                cache: false,
                data:{'postid': postid, 'picname': picname},
                success: function(data){
                    console.log(data);
                    swal("Sucessful", "Deleted a Post!", "success")
                    .then((value) => {
                        location.reload();
                    });
                },
                error: function(data){
                    console.log('There Something Wrong With Code!');
                }
            });
          });
        } else {
          swal("Your Post is safe!");
        }
      });

});


