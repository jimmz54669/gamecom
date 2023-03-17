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
                  <button class="btn current"><a href="{{ route('cart')}}">Cart -<span class="cart-count">@if(isset($GetCartCount)) {{$GetCartCount}} @else 0 @endif</span></a></button>
                  <button class="btn not"><a href="{{ route('order')}}">Orders</a></button>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-6 col-md-12">
      @if(isset($GetCartLists)) 
      <?php 
        $Grandtotal = 0; 
        $TotalQty = 0;
      ?>
        <div class="jumbotron cart-container">   
            @foreach($GetCartLists as $GetCartList)
            <hr class="divider-cart">
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
                    <tbody id="cart-info">
                        <tr class="cart-product">
                            <th scope="row"><button class="btn btn-delete-cart" data-prodcode="{{$GetCartList->prodcode}}"><i class="bi bi-x-octagon"></i></button></th>
                            <td data-title="Name"><p>{{$GetCartList->prodname}}</p></td>
                            <td data-title="Image"><img class="product-img-profile" src="{{ url('/images/'.$GetCartList->prodimg)}}"></td>
                            <td data-title="Quantity"><button type="button" class="btn prodqty-add-cart" data-prodprice="{{$GetCartList->prodprice}}" data-prodqty="{{$GetCartList->prodqty}}" data-prodcode="{{$GetCartList->prodcode}}">+</button><span><input class="prod-count" name="prodqty" value="{{$GetCartList->qty}}" /></span><button type="button" class="btn prodqty-minus-cart" data-prodprice="{{$GetCartList->prodprice}}" data-prodqty="{{$GetCartList->prodqty}}" data-prodcode="{{$GetCartList->prodcode}}">-</button></td>
                            <td data-title="Price">₱{{$GetCartList->prodprice}}</td>
                            <td data-title="Total">₱<span class="item-total">{{number_format($GetCartList->itemamount,2)}}</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?php 
                $Grandtotal = $Grandtotal + $GetCartList->itemamount; 
                $TotalQty = $TotalQty + $GetCartList->qty;
            ?>
            @endforeach
         </div>  
         <div class="grandTotal">
            <h5>Grand Total: ₱{{number_format($Grandtotal,2)}}</h5>
            <button class="btn btn-place-order" data-subtotal="{{$Grandtotal}}" data-totalqty="{{$TotalQty}}">Place Order</button>
         </div>
      </div>
     @endif
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
</div>





<div class="modal fade" id="myOrder">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: rgba(32, 32, 32, 1);">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Payment Method</h4>
                <button type="button" class="btn" data-bs-dismiss="modal"><i class="bi bi-x-octagon"></i></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-3">
                        <p>Address:</p>
                    </div>
                    <div class="col-md-3">
                        <input type="textarea" name="orderaddress" id="orderAdd">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <p>Contact Number:</p>
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="contactnumber" id="contactNumber" value="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <p><i class="bi bi-currency-dollar"></i>Payment Option:</p>
                    </div>
                    <div class="col-md-4">
                        <form>
                            <select class="form-select" id="paymentopt" name="paymentopt">
                                <option>Cash on Delivery</option> 
                                <option>Paypal</option>
                            </select>
                        </form>
                    </div>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <p><i class="bi bi-card-list"></i>Payment details</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <p>Merchandise Subtotal:</p>
                    </div>
                    <div class="col-md-3 merch-subtotal">
                        <!-- <p>₱ 1000</p> -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <p>Shipping Subtotal</p>
                    </div>
                    <div class="col-md-3">
                        <p>₱ 150.00</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <p><b>Total Payment:</b></p>
                    </div>
                    <div class="col-md-3 total-payment">
                        <!-- <p><b>₱ 123231</b></p> -->
                    </div>
                </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                @guest
                <p class="guest-notice">Join our community by<a href="{{ route('login') }}"> Log in</a> or <a href="{{ route('register') }}"> Sign-up</a>.</>
                @else
                <button type="button" class="btn btn-for-placeorder-cart">Place Order</button>
                @endguest
            </div>

        </div>
    </div>
</div>
@endsection

