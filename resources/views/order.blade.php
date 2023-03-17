@extends('layouts.app')

@section('content')

<div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>

<div class="container" style="margin-top: 90px;">
   <div class="row">
      <div class="col-lg-6 col-md-12">
         <div class="jumborton">
            <div class="card pro-pic-container">
               <div class="row">
                  <div class="col-lg-5 col-md-6">
                     <div class="card img-user">
                        <img src="{{url('/images/logo2.png')}}">
                     </div>
                     <div class="dp-upload-btn">
                        <input type="file" class="btn prof-photo" name="buttonProfPhoto" id="prof_pic_input" hidden/>
                        <label class="btn dp-user-btn" for="prof_pic_input"><i class="bi bi-camera-fill" id="dp_user_btn"></i></label>
                     </div>
                  </div>
                  <div class="col-lg-6 col-md-6">
                     <div class="username-users">
                        <h1 class="user-fullname">{{Auth::user()->fname}} {{Auth::user()->lname}}</h1>
                        <h3 class="user-name">@ {{Auth::user()->username}}</h3>
                     </div>
                  </div>
               </div>
               <div class="input-group mt-3 d-flex justify-content-center">
                  <button class="btn text-bold not"><a href="{{ route('profile')}}">Post</a></button>
                  <button class="btn not"><a href="{{ route('favorites')}}">Favorites</a></button>
                  <button class="btn not"><a href="{{ route('cart')}}">Cart -<span class="cart-count"> @if(isset($GetCartCount)) {{$GetCartCount}} @else 0 @endif</span></a></button>
                  <button class="btn current"><a href="{{ route('order')}}">Orders</a></button>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-6 col-md-12">
         <div class="jumbotron cart-container">
         {{-- messsage pop up open --}}
                @if(session()->get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session()->get('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif          
        {{-- messsage pop up close --}} 

        @if(isset($GetOrderLists))
            @foreach($GetOrderLists as $GetOrderList)
            <div class="cart-table">
                <table class="table">
                    <thead class="cart-header">
                        <tr class="cart-title">
                            <th scope="col"></th>
                            <th scope="col">Order ID</th>
                            <th scope="col">Order Address</th>
                            <th scope="col">Payment Method</th>
                            <th scope="col">Order Total</th>
                            <th scope="col">Status</th>
                            <th scope="col">Remarks</th>
                        </tr>
                    </thead>
                    <tbody id="cart-info">
                        <tr class="cart-product">
                            <td data-title="Order ID"><p>{{$GetOrderList->id}}</p></td>
                            <td data-title="Order Address"><p>{{$GetOrderList->orderaddress}}</p></td>
                            <td data-title="Payment Method">{{$GetOrderList->ordertype}}</td>
                            <td data-title="Order Total">₱<span class="item-total">{{$GetOrderList->ordertotal}}</span></td>
                            <td data-title="Status"><p>{{$GetOrderList->orderstatus}}</p></td>
                            <td data-title="Remarks"><button class="btn btn-order-details" data-bs-toggle="modal" data-bs-target="#orderDetails" data-orderid="{{$GetOrderList->id}}">Order Details</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <hr class="divider-cart">
            @endforeach    
        @endif
         </div>
      </div>
   </div>   
</div>

<!-- The Modal -->
<div class="modal fade" id="orderDetails">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: rgba(32, 32, 32, 1);">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Order Details</h4>
                <button type="button" class="btn" data-bs-dismiss="modal"><i class="bi bi-x-octagon"></i></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="cart-table">
                    <table class="table">
                        <thead class="cart-header">
                            <tr class="cart-title">
                                <th scope="col"></th>
                                <th scope="col">Name</th>
                                <th scope="col">Image</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody id="cart-info" class="orderdetails">
                            <tr class="cart-product">
                                <td data-title="Name"><p>asdas asd dasda a</p></td>
                                <td data-title="Image"><img class="product-img-profile" src="{{ url('/images/logo2.png')}}"></td>
                                <td data-title="Quantity"><span class="quantity-product-order">1</span></td>
                                <td data-title="Price">₱100</td>
                                <td data-title="Total">₱<span class="item-total">100</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-for-placeorder">Order recieve</button>
            </div>

        </div>
    </div>
     
</div>
<hr>
   <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright © 2023 <a href="{{ route('about')}}">GameCom</a> Company. All rights reserved. 
                </div>
            </div>
        </div>
    </footer> 
@endsection