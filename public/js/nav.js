

//search bar
let inputBox = document.querySelector(".input-box"),
    search = document.querySelector(".search"),
    closeIcon = document.querySelector(".close-icon");

search.addEventListener("click", () => inputBox.classList.add("open"));
closeIcon.addEventListener("click", () => inputBox.classList.remove("open"));

//navbar js
var settingsmenu = document.querySelector(".settings-menu");

function settingsMenuToggle() {
    settingsmenu.classList.toggle("settings-menu-height");
}


//For Site Search
$(document).on('keypress', '.site-search', function(event){
    var x = event.which || event.keyCode;

    var keysearch = $('.site-search').val();
    form_action = '/gamecom/public/search';

    if(x == 13 && keysearch != ''){
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: form_action,
            method: 'get',
            cache: false,
            data:{'keysearch':keysearch},
            success: function(data){
                console.log(data);

                var rows = '';
                var imgsearch = '';
                rows = rows + '<ul class="searchlistview" style="list-style-type: none;">';
                $.each(data, function(key, value){
                    if(value.searchimg !== null){
                        imgsearch = value.searchimg;
                    }else{
                        imgsearch = '/gamecom/public/images/logo1.png';
                    }
                    rows = rows + '<li style="background: gray; border:1px solid black; height:60px; padding:5px,5px,5px;"><a style=" text-decoration: none; color: lightgrey;" href="/gamecom/public'+value.link+'"> <img class="user-dp" src="/gamecom/public/images/'+imgsearch+'"/>'+value.stringsearch+'</a></li>';
                });
                rows = rows + '</ul>';
                $('#searchlist').html(rows);
                
            },
            error: function(data){
                console.log('There Something Wrong With Code!');
            }
        });
    }
  
});