//Add Comment To Game Apps
$(document).on('click','.addgameappcommentbtn', function(){

    var form_action = '/gamecom/public/addgameappcomment';
    var userid = $(this).data('userid');
    var gameappid = $(this).data('gameappid');
    var gameappcomment = $('.gameappcomment').val();

    if(gameappcomment !== ''){
        // alert(userid +' - '+gameappid +' - '+gameappcomment);

        //Ajax Function to save Gameapp User Comment
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: form_action,
            method: 'POST',
            cache: false,
            data:{'userid':userid, 'gameappid':gameappid, 'gameappcomment':gameappcomment},
            success: function(data){
                $('.gameappcomment').val(''); //Clears the input after clicking the Post Button
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

    }else{
        swal("Opps!", "Please Enter A Comment!", "error");
    }
    

});//End 


//Add to Favorate Games in Game Lists
$(document).on('click','.btn-favorite',function(){
    var gameappid = $(this).data('gameappid');
    var form_action = '/gamecom/public/addgameapptofavorites';

     //Ajax Function to save Favorite Games
     $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: form_action,
        method: 'POST',
        cache: false,
        data:{'gameappid':gameappid},
        success: function(data){
            console.log(data);
           
            swal("Sucessful", "Added to Favorites!", "success")
                .then((value) => {
                     location.reload();
                  });
        },
        error: function(data){
            console.log('There Something Wrong With Code!');
        }
    });
});



//Add To Favorite in Game Page
$(document).on('click','.btn-favorite-gamepage',function(){
    var gameappid = $(this).data('gameappid');
    var form_action = '/gamecom/public/addgameapptofavorites';
    //Ajax Function to save Favorite Games
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: form_action,
        method: 'POST',
        cache: false,
        data:{'gameappid':gameappid},
        success: function(data){
            console.log(data);
            swal("Sucessful", "Added to Favorites!", "success")
                .then((value) => {
                     location.reload();
                  });
        },
        error: function(data){
            console.log('There Something Wrong With Code!');
        }
    });

});



//Delete Favorite Game
$(document).on('click','.btn-favorite-delete',function(){
    var gameappid = $(this).data('gameappid');
    var form_action = '/gamecom/public/deletefavoritegame';


    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this Favorites!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
        swal("Poof! Post has been deleted!", {
            icon: "success",
          }).then((value) => {
            //Ajax Function to delete
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: form_action,
                    method: 'POST',
                    cache: false,
                    data:{'gameappid':gameappid},
                    success: function(data){
                        console.log(data);
                        swal("Sucessful", "Delete a Favorites!", "success")
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
          swal("Your Favorites is safe!");
        }
      });

    
});