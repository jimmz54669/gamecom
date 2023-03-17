@extends('layouts.app')

@section('content')
<!-- <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div> -->

@if(isset($GetProducts))
@foreach($GetProducts as $row)
 <div class="container" style="margin-top: 90px;">
    <div class="jumbotron">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <div class="buy-item-img">
                    <img src="{{ url('/images/'.$row->prodimg)}}" class="buy-item-pic">
                </div>
            </div>
            <div class="col-lg-6 col-md-5 col-sm-12">
                <div class="buy-item-title">
                    <h1>{{$row->prodname}}</h1>
                </div>
                <div class="buy-item-price">
                    <h2>₱{{$row->prodprice}}</h2>
                </div>
                <div class="buy-item-stock">
                    <h3>Availability:</h3>
                    <span class="stock-left">@if($row->prodqty > 0){{$row->prodqty}}@else Out of Stock! @endif</span>
                </div>
                <!-- <div class="buy-size">
                    <h4>Pick Size:</h4>
                    <select class="size-selector">
                        <option></option>
                        <option>Small</option>
                        <option>Medium</option>
                        <option>Large</option>
                    </select>
                </div> -->
                <div class="but-item-quantity">
                <button type="button" class="btn prodqty-add" data-prodprice="{{$row->prodprice}}" data-prodqty="{{$row->prodqty}}">+</button><span><input class="prod-count" name="prodqty" value="1" /></span><button type="button" class="btn prodqty-minus" data-prodprice="{{$row->prodprice}}">-</button>
                </div>
                <div class="buy-total">
                    <div class="total-buy-item">
                        <span class="total-price-added"><h3>Total: ₱{{$row->prodprice}}</h3></span>
                    </div>
                </div>
                <div class="buy-selector-btn">
                        @if($row->prodqty >= 0)
                        <button class="btn buy-now" data-prodprice="{{$row->prodprice}}" data-prodqty="{{$row->prodqty}}" >Place Order</button>
                        @endif
                    @guest
                    @else
                        @if($row->prodqty >= 0)
                            <button class="btn add-to-cart" data-prodcode="{{$row->prodcode}}" data-cartqty="1"><i class="bi bi-cart3"></i></button>
                        @endif
                    @endguest
                </div>
            </div>
        </div>
    </div>
 </div>
 

 <hr>
 <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright © 2023 <a href="#">GameCom</a> Company. All rights reserved. 
                </div>
            </div>
        </div>
    </footer>  

<!-- The Modal -->
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
                        <input type="number" name="contactnumber" id="contactNumber" value="" >
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
                <button type="button" class="btn btn-for-placeorder" data-prodid="{{$row->id}}">Place Order</button>
                @endguest
            </div>

        </div>
    </div>
</div>

@endforeach
 @endif
@endsection