
//Opens user Message
$(document).on('click', '.user-to-msg', function(){
    var fromuserid = $(this).data('fromuserid');
    var touserid = $(this).data('touserid');
    var form_action = '/gamecom/public/fetchmessages/'+fromuserid+'/'+touserid;

    // alert(fromuserid +' - '+ touserid);

    // Ajax function fetchmessages
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: form_action,
        method: 'get',
        cache: false,
        data:{'fromuserid': fromuserid, 'touserid': touserid},
        success: function(data){
            //console.log(data);
            DisplayUserMessage(data, fromuserid, touserid);
        },
        error: function(data){
            console.log('There Something Wrong With Code!');
        }
    });

});



//Send Message To A User
$(document).on('click', '.chat-submit', function(){
    var fromuserid = $(this).data('fromuserid');
    var touserid = $(this).data('touserid');
    var message = $('.user-text-chat').val();
    var form_action = '/gamecom/public/sendmessage';

    if(message !== ''){
        // alert(fromuserid +' - '+touserid+' - '+message);
        //Ajax Function to send Message
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: form_action,
            method: 'post',
            cache: false,
            data:{'fromuserid':fromuserid, 'touserid':touserid, 'message':message},
            success: function(data){
    
                $('.user-text-chat').val(''); //Clears the input after clicking the Post Button
                //console.log(data);
                swal("Sucessful", "Sent a Message!", "success");
                //location.reload();
                
                var form_action = '/gamecom/public/fetchmessages/'+fromuserid+'/'+touserid;
                 // Ajax function fetchmessages
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: form_action,
                    method: 'get',
                    cache: false,
                    data:{'fromuserid': fromuserid, 'touserid': touserid},
                    success: function(data){
                        //console.log(data);
                        DisplayUserMessage(data, fromuserid, touserid);
                    },
                    error: function(data){
                        console.log('There Something Wrong With Code!');
                    }
                });
                
            },
            error: function(data){
                console.log('There Something Wrong With Code!');
            }
        });
    }else{
        swal("Opps!", "Please Enter A Message!", "error");
    }
});




function DisplayUserMessage(data, fromuserid, touserid){
           
    var rows = '';
    var rows1 = '';
    var rows2 = '';

    $.each(data.GetUserInfo, function(key, value){
        
        if(value.profpic !== null){
            rows = rows + ' <img src="/gamecom/public/images/'+value.profpic+'"class="user-dp">';
        }else{
            rows = rows + ' <img src="/gamecom/public/images/logo2.png" class="user-dp">';
        }
            rows = rows + '<p>'+value.fname+' '+value.lname+'</p>';
    
    });

        $('.chat-acc').html(rows);

            $.each(data.FetchUserMessage, function(key1, value1){

            //if(value.id == touserid){
                //console.log(value1.fromuserid +' - '+fromuserid);
                //Message from user
                if(value1.fromuserid == fromuserid){
                    rows1 = rows1 + '<div class="other-user-msg">';
                }else{
                    rows1 = rows1 + '<div class="user-profile">';
                }
                        
                    if(value1.fromuserid == fromuserid){//Send From user Msg
                        
                        if(value1.profpic !== null){
                            rows1 = rows1 + '<img src="/gamecom/public/images/'+value1.profpic+'" class="user-dp">';
                        }else{
                            rows1 = rows1 + '<img src="/gamecom/public/images/logo2.png" class="user-dp">';
                        }
                            rows1 = rows1 + '<div class="other-user-chat card">'+value1.message+'</div>';

                    }else{// Replay from User Msg

                            rows1 = rows1 + '<div class="user-chat card">'+value1.message+'</div>';
                        if(value1.profpic !== null){
                            rows1 = rows1 + '<img src="/gamecom/public/images/'+value1.profpic+'" class="user-dp">';
                        }else{
                            rows1 = rows1 + '<img src="/gamecom/public/images/logo2.png" class="user-dp">';
                        }
                        
                    }
                rows1 = rows1 + '</div>';
                
            
            });
        
        $('.chat-box-msgs').html(rows1);

        $.each(data.GetUserInfo, function(key2, value2){
            rows2 = rows2 + '<input type="textarea" class="user-text-chat" id="user-text-chat" placeholder="Write message...">';
            rows2 = rows2 + '<input type="button" class="btn chat-submit" data-fromuserid="'+fromuserid+'" data-touserid="'+touserid+'" value="Send"></input>';
        });

        $('.user-chat-box').html(rows2);

}//End Function




//Opens user Message
$(document).on('click', '.user-to-directmsg', function(){

    var fromuserid = $(this).data('fromuserid');
    var touserid = $(this).data('touserid');
    var form_action = '/gamecom/public/fetchdirectmessage/'+touserid;

    // alert(fromuserid +' - '+ touserid);

    // Ajax function fetchmessages
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: form_action,
        method: 'get',
        cache: false,
        data:{'touserid': touserid},
        success: function(data){
            console.log(data);
            
            DisplayUserMessage(data, fromuserid, touserid);
        },
        error: function(data){
            console.log('There Something Wrong With Code!');
        }
    });

});