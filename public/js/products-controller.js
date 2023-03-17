
//Ajax Get Edit Product View
$(document).on('click', '.prod-edit', function(){
    var prodid = $(this).data('prodid');
    var form_action = "/gamecom/public/editprod/"+prodid;

    // alert(form_action);
    //Ajax function to edit view
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: form_action,
        method: 'get',
        cache: false,
        data:'',
        success: function(data){
            console.log(data);
            // alert("Successfully Posted!");
            // location.reload();
            window.location.href = "/gamecom/public/editprod/"+prodid;
        },
        error: function(data){
            console.log('There Something Wrong With Code!');
        }
    });
});


//Ajax Get Place Order Page
$(document).on('click', '.buy-btn', function(){
    var prodid = $(this).data('prodid');
    var form_action = "/gamecom/public/placeorder/"+prodid;

    //Ajax function to edit view
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: form_action,
        method: 'get',
        cache: false,
        data:'',
        success: function(data){
            console.log(data);
            // alert("Successfully Posted!");
            // location.reload();
            window.location.href = "/gamecom/public/placeorder/"+prodid;
        },
        error: function(data){
            console.log('There Something Wrong With Code!');
        }
    });
});



$(document).on('click', '.prodqty-add', function(){
    var inputqty = $('.prod-count').val();
    var prodprice = $(this).data('prodprice');
    const price = +prodprice.replace(/,/g, '');
    var availability = $(this).data('prodqty');

    
    var addqty = parseInt(inputqty) + 1;
    if(availability >= addqty){
    var totalprice = parseFloat(price)*addqty;

    $('.prod-count').val(addqty);
    $('.total-price-added').html('<h3>Total: ₱'+addCommas(totalprice)+'</h3>');
    }else{
        
        swal("Opps!", "Not Allowed to Add Above Availability!", "error");
    }
});


$(document).on('click', '.prodqty-minus', function(){
    var inputqty = $('.prod-count').val();
    var prodprice = $(this).data('prodprice');
    const price = +prodprice.replace(/,/g, '');
    if(inputqty <= '1'){
        $('.prod-count').val(1);
    }else{
        var minusqty = parseInt(inputqty) - 1;
        var totalprice = parseFloat(price)*minusqty;
        $('.prod-count').val(minusqty);
        $('.total-price-added').html('<h3>Total: ₱'+addCommas(totalprice)+'</h3>');
    }
});


$(document).on('click', '.buy-now', function(){
    var prodprice = $(this).data('prodprice');
    var inputqty = $('.prod-count').val();
    const price = +prodprice.replace(/,/g, '');
    var subtotal = parseFloat(price)*inputqty;
    var availability = $(this).data('prodqty');
    var totalpayment = parseFloat(subtotal)+150;
    
    if(availability >= inputqty){
        $('#myOrder').modal('show');

        $('.merch-subtotal').html('<p>₱ '+addCommas(subtotal.toFixed(2))+'</p> <input type="text" class="subtotal" value="'+addCommas(subtotal.toFixed(2))+'" hidden/>');
        $('.total-payment').html('<p><b>₱ '+addCommas(totalpayment.toFixed(2))+'</b></p> <input type="text" class="totalpayment" value="'+addCommas(totalpayment.toFixed(2))+'" hidden/>');

    }else{
        swal("Opps!", "Not Allowed to Add Above Availability!", "error");
    }
});


//Ajax Query to Add item in orders table
$(document).on('click','.btn-for-placeorder', function(){
    var subtotal = $('.subtotal').val();
    var totalpayment = $('.totalpayment').val();
    var orderaddress = $('#orderAdd').val();
    var ordercontactnum = $('#contactNumber').val();
    var paymentopt = $('#paymentopt').val();
    var prodid = $(this).data('prodid');
    var inputqty = $('.prod-count').val();
    var form_action= '/gamecom/public/addorder';

    var prodqty = $(this).data('prodqty');

    

        if(orderaddress !== '' && ordercontactnum !== ''){
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: form_action,
                method: 'post',
                cache: false,
                data:{'subtotal': subtotal, 'totalpayment': totalpayment, 'orderaddress': orderaddress, 'ordercontactnum': ordercontactnum, 'paymentopt':paymentopt, 'prodid': prodid, 'totalqty': inputqty},
                success: function(data){
                    console.log(data);
                    swal("Successful!", "You Placed an Order!", "success")
                    .then((value)=> {
                        window.location.href = "/gamecom/public/order";
                    }); 
                    
                },
                error: function(data){
                    console.log('There Something Wrong With Code!');
                }
            });
        }else{
            swal("Opps!", "Please Fill Empty Fields!", "error"); 
        }
    

    
});




//GetOrderDetails Ajax()
$(document).on('click', '.btn-order-details', function(){

    var orderid = $(this).data('orderid');
    var form_action= '/gamecom/public/orderdetails/'+orderid;
    
    var orderid = $(this).data('orderid');
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: form_action,
        method: 'get',
        cache: false,
        data:'',
        success: function(data){
            console.log(data);
            var rows = '';
            $.each(data, function(key,value){
                console.log(value);
                rows = rows + '<tr class="cart-product">';
                    rows = rows + '<td data-title="Name"><p>'+value.prodname+'</p></td>';
                    rows = rows + '<td data-title="Image"><img class="product-img-profile" src="/gamecom/public/images/'+value.prodimg+'"></td>';
                    rows = rows + '<td data-title="Quantity"><span class="quantity-product-order">'+value.qty+'</span></td>';
                    rows = rows + '<td data-title="Price">₱'+value.prodprice+'</td>';
                    rows = rows + '<td data-title="Total">₱<span class="item-total">'+value.amount+'</span></td>';
                rows = rows + '</tr>';

                $('.orderdetails').html(rows);
            });
        },
        error: function(data){
            console.log('There Something Wrong With Code!');
        }
    });

});



$(document).on('click', '.add-to-cart', function(){
    var prodcode = $(this).data('prodcode');
    var cartqty = $(this).data('cartqty');
    var availability = $(this).data('availability');
    var form_action = '/gamecom/public/addtocart';
    
    if(availability >= cartqty){
        //Ajax function to add cart
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: form_action,
            method: 'post',
            cache: false,
            data:{'prodcode': prodcode, 'cartqty':cartqty},
            success: function(data){
                console.log(data);
        
                swal("Sucessful", "You Added Item On Cart!", "success");
                // location.reload();
                // window.location.href = "/gamecom/public/placeorder/"+prodid;
            },
            error: function(data){
                console.log('There Something Wrong With Code!');
            }
        });
    }else{
        swal("Opps!", "Not Allowed to Add Above Availability!", "error");
    }
});


$(document).on('click', '.prodqty-add-cart', function(){
    var inputqty = $('.prod-count').val();
    var prodprice = $(this).data('prodprice');
    const price = +prodprice.replace(/,/g, '');
    var availability = $(this).data('prodqty');
    var prodcode = $(this).data('prodcode');
    var form_action = '/gamecom/public/updatecartqty';

    
    var addqty = parseInt(inputqty) + 1;
    if(availability >= addqty){
        var totalprice = parseFloat(price)*addqty;

        $('.prod-count').val(addqty);
        
        //Ajax Auto Update Qty on Cart
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: form_action,
            method: 'post',
            cache: false,
            data:{'prodcode': prodcode, 'cartqty':addqty},
            success: function(data){
                console.log(data);
        
                swal("Sucessful", "You Updated Item Qty On Cart!", "success")
                .then((value) => {
                     location.reload();
                  });
            },
            error: function(data){
                console.log('There Something Wrong With Code!');
            }
        });
    }else{
        
        swal("Opps!", "Not Allowed to Add Above Availability!", "error");
    }
});


$(document).on('click', '.prodqty-minus-cart', function(){
    var inputqty = $('.prod-count').val();
    var prodprice = $(this).data('prodprice');
    const price = +prodprice.replace(/,/g, '');
    var prodcode = $(this).data('prodcode');
    var form_action = '/gamecom/public/updatecartqty';
    if(inputqty <= '1'){
        $('.prod-count').val(1);
    }else{
        var minusqty = parseInt(inputqty) - 1;
        var totalprice = parseFloat(price)*minusqty;
        $('.prod-count').val(minusqty);


        //Ajax Auto Update Qty on Cart
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: form_action,
            method: 'post',
            cache: false,
            data:{'prodcode': prodcode, 'cartqty':minusqty},
            success: function(data){
                console.log(data);
        
                swal("Sucessful", "You Updated Item Qty On Cart!", "success")
                .then((value) => {
                     location.reload();
                  });
               
            },
            error: function(data){
                console.log('There Something Wrong With Code!');
            }
        });
    }
});//End of Jquery


$(document).on('click', '.btn-delete-cart', function(){
    var prodcode = $(this).data('prodcode');
    var form_action = '/gamecom/public/deletecartitem';
    
    //Ajax Delete item on Cart
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: form_action,
        method: 'post',
        cache: false,
        data:{'prodcode': prodcode},
        success: function(data){
            console.log(data);

              swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this item on Cart!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
              })
              .then((willDelete) => {
                if (willDelete) {
                  swal("Poof! Cart Item has been deleted!", {
                    icon: "success",
                  }).then((value) => {
                    location.reload();
                  });
                } else {
                  swal("Your Cart Item is safe!");
                }
              });
           
        },
        error: function(data){
            console.log('There Something Wrong With Code!');
        }
    });
});


//Cart list PlaceOrder Call Form Jquery
$(document).on('click', '.btn-place-order', function(){
    $('#myOrder').modal('show');
    var subtotal = $(this).data('subtotal');
    var totalqty = $(this).data('totalqty');
    var totalpayment = parseFloat(subtotal)+150;
    
    $('.merch-subtotal').html('<p>₱ '+addCommas(subtotal.toFixed(2))+'</p> <input type="text" class="subtotal" value="'+addCommas(subtotal.toFixed(2))+'" hidden/> <input type="text" class="totalqty" value="'+totalqty+'" hidden/>');
    $('.total-payment').html('<p><b>₱ '+addCommas(totalpayment.toFixed(2))+'</b></p> <input type="text" class="totalpayment" value="'+addCommas(totalpayment.toFixed(2))+'" hidden/>');
});


//Cart list Proceed PlacedOrder Jquery
$(document).on('click','.btn-for-placeorder-cart', function(){
    var subtotal = $('.subtotal').val();
    var totalqty = $('.totalqty').val();
    var totalpayment = $('.totalpayment').val();
    var orderaddress = $('#orderAdd').val();
    var ordercontactnum = $('#contactNumber').val();
    var paymentopt = $('#paymentopt').val();
    var form_action= '/gamecom/public/addordercart';

    if(orderaddress !== '' && ordercontactnum !== ''){
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: form_action,
            method: 'post',
            cache: false,
            data:{'subtotal': subtotal, 'totalpayment': totalpayment, 'orderaddress': orderaddress, 'ordercontactnum': ordercontactnum, 'paymentopt':paymentopt, 'totalqty': totalqty},
            success: function(data){
                console.log(data);
                swal("Successful!", "You Placed an Order!", "success")
                .then((value)=> {
                    window.location.href = "/gamecom/public/order";
                }); 
                
            },
            error: function(data){
                console.log('There Something Wrong With Code!');
            }
        });
    }else{
        swal("Opps!", "Please Fill Empty Fields!", "error"); 
    }

});



function addCommas(nStr)
{
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}


