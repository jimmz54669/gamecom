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

<div class="container-fluid d-flex align-items-start" style="margin-top: 90px;">
    <div class="nav flex-column col-lg-3 col-sm-1 nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <button class="nav-link shop-nav active" id="v-pills-all-tab" data-bs-toggle="pill" data-bs-target="#v-pills-all" type="button" role="tab" aria-controls="v-pills-all" aria-selected="true">
            <span class="material-icons-outlined">dashboard</span><h6>All</h6>
        </button>
        <button class="nav-link shop-nav" id="v-pills-merchandise-tab" data-bs-toggle="pill" data-bs-target="#v-pills-merchandise" type="button" role="tab" aria-controls="v-pills-merchandise" aria-selected="false">
            <span class="material-icons-outlined">checkroom</span><h6>Merchandise</h6>
        </button>
        <button class="nav-link shop-nav" id="v-pills-gaming-keyboards-tab" data-bs-toggle="pill" data-bs-target="#v-pills-gaming-keyboards" type="button" role="tab" aria-controls="v-pills-gaming-keyboards" aria-selected="false">
            <span class="material-icons-outlined">keyboard</span><h6>Gaming Keyboards</h6>
        </button>
        <button class="nav-link shop-nav" id="v-pills-gaming-mice-tab" data-bs-toggle="pill" data-bs-target="#v-pills-gaming-mice" type="button" role="tab" aria-controls="v-pills-gaming-mice" aria-selected="false">
            <span class="material-icons-outlined">mouse</span><h6>Gaming Mice</h6>
        </button>
        <button class="nav-link shop-nav" id="v-pills-gaming-mousepad-tab" data-bs-toggle="pill" data-bs-target="#v-pills-gaming-mousepad" type="button" role="tab" aria-controls="v-pills-mousepad" aria-selected="false">
        <span class="material-icons-outlined">padding</span><h6>Gaming Mousepad</h6>
        </button>
        <button class="nav-link shop-nav" id="v-pills-gaming-chair-tab" data-bs-toggle="pill" data-bs-target="#v-pills-gaming-chair" type="button" role="tab" aria-controls="v-pills-gaming-chair" aria-selected="false">
        <span class="material-icons-outlined">event_seat</span><h6>Gaming Chair</h6>
        </button>
        <button class="nav-link shop-nav" id="v-pills-gaming-desk-tab" data-bs-toggle="pill" data-bs-target="#v-pills-gaming-desk" type="button" role="tab" aria-controls="v-pills-gaming-desk" aria-selected="false">
            <span class="material-icons-outlined">desk</span><h6>Gaming Desk</h6>
        </button>
        <button class="nav-link shop-nav" id="v-pills-gaming-bags-tab" data-bs-toggle="pill" data-bs-target="#v-pills-gaming-bags" type="button" role="tab" aria-controls="v-pills-gaming-bags" aria-selected="false">
            <span class="material-icons-outlined">backpack</span><h6>Gaming Bags</h6>
        </button>
        <button class="nav-link shop-nav" id="v-pills-gaming-headsets-tab" data-bs-toggle="pill" data-bs-target="#v-pills-gaming-headsets" type="button" role="tab" aria-controls="v-pills-gaming-headsets" aria-selected="false">
            <span class="material-icons-outlined">headset</span><h6>Gaming Headsets</h6>
        </button>
        <button class="nav-link shop-nav" id="v-pills-gaming-monitors-tab" data-bs-toggle="pill" data-bs-target="#v-pills-gaming-monitor" type="button" role="tab" aria-controls="v-pills-gaming-monitor" aria-selected="false">
            <span class="material-icons-outlined my">desktop_windows</span><h6>Gaming Monitors</h6>
        </button>
        @guest
        @else
        
        @if(Auth::user()->isadmin == '1')
            <button class="nav-link shop-nav" id="v-pills-add-product-tab" data-bs-toggle="pill" data-bs-target="#v-pills-add-product" type="button" role="tab" aria-controls="v-pills-add-product" aria-selected="false">
                <span class="material-symbols-outlined">add_box</span><h6>Add product</h6>
            </button>
        @endif

        @endguest
    </div>


    <div class="tab-content" id="v-pills-tabContent">
    {{-- messsage pop up open --}}
                @if(session()->get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session()->get('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif          
        {{-- messsage pop up close --}} 

        <div class="tab-pane fade show active" id="v-pills-all" role="tabpanel" aria-labelledby="v-pills-all-tab">
            <div class="row">
                @if(isset($GetAllProducts))
                @foreach($GetAllProducts as $GetAllProduct)
                <div class="item-container col-3">
                    <div class="item-img">
                        <img src="{{url('/images/'.$GetAllProduct->prodimg)}}" class="img-item">
                    </div>
                    <div class="item-name">
                        <h6>{{$GetAllProduct->prodname}}
                            @guest
                            @else
                            <button class="btn prod-edit" data-prodid="{{$GetAllProduct->id}}">
                                <a href="#" >
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                            </button>
                            @endguest
                        </h6>
                    </div>
                    <div class="item-price">
                        <p>₱{{$GetAllProduct->prodprice}}</p>
                    </div>
                    <div class="item-btns input-group">
                        <button type="button" class="btn buy-btn" data-prodid="{{$GetAllProduct->id}}"><a href="#">Buy Now!</a></button>
                        @guest
                        @else
                        <button type="button" class="btn add-to-cart" data-prodcode="{{$GetAllProduct->prodcode}}" data-availability="{{$GetAllProduct->prodqty}}" data-cartqty="1"><i class="bi bi-cart3"></i></button>
                        @endguest
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>

        <div class="tab-pane fade" id="v-pills-merchandise" role="tabpanel" aria-labelledby="v-pills-merchandise-tab">
            <div class="row">
                @if(isset($GetAllProducts))
                @foreach($GetAllProducts as $GetAllProduct)
                    @if($GetAllProduct->prodcat == 1)
                    <div class="item-container col-3">
                        <div class="item-img">
                            <img src="{{url('/images/'.$GetAllProduct->prodimg)}}" class="img-item">
                        </div>
                        <div class="item-name">
                            <h6>{{$GetAllProduct->prodname}}
                                @guest
                                @else
                                <button class="btn prod-edit" data-prodid="{{$GetAllProduct->id}}">
                                    <a href="#" >
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                </button>
                                @endguest
                            </h6>
                        </div>
                        <div class="item-price">
                            <p>₱{{$GetAllProduct->prodprice}}</p>
                        </div>
                        <div class="item-btns input-group">
                            <button type="button" class="btn buy-btn" data-prodid="{{$GetAllProduct->id}}"><a href="#">Buy Now!</a></button>
                            @guest
                            @else
                            <button type="button" class="btn add-to-cart" data-prodcode="{{$GetAllProduct->prodcode}}" data-availability="{{$GetAllProduct->prodqty}}" data-cartqty="1"><i class="bi bi-cart3"></i></button>
                            @endguest
                        </div>
                    </div>
                    @endif
                @endforeach
                @endif
            </div>
        </div>
        <div class="tab-pane fade" id="v-pills-gaming-keyboards" role="tabpanel" aria-labelledby="v-pills-gaming-keyboards-tab">
            <div class="row">
                @if($GetAllProducts)
                @foreach($GetAllProducts as $GetAllProduct)
                    @if($GetAllProduct->prodcat == 2)
                    <div class="item-container col-3">
                        <div class="item-img">
                            <img src="{{url('/images/'.$GetAllProduct->prodimg)}}" class="img-item">
                        </div>
                        <div class="item-name">
                            <h6>{{$GetAllProduct->prodname}}
                                @guest
                                @else
                                <button class="btn prod-edit" data-prodid="{{$GetAllProduct->id}}">
                                    <a href="#" >
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                </button>
                                @endguest
                            </h6>
                        </div>
                        <div class="item-price">
                            <p>₱{{$GetAllProduct->prodprice}}</p>
                        </div>
                        <div class="item-btns input-group">
                            <button type="button" class="btn buy-btn" data-prodid="{{$GetAllProduct->id}}"><a href="#">Buy Now!</a></button>
                            @guest
                            @else
                            <button type="button" class="btn add-to-cart" data-prodcode="{{$GetAllProduct->prodcode}}" data-availability="{{$GetAllProduct->prodqty}}" data-cartqty="1"><i class="bi bi-cart3"></i></button>
                            @endguest
                        </div>
                    </div>
                    @endif
                @endforeach
                @endif
            </div>
        </div>
        <div class="tab-pane fade" id="v-pills-gaming-mice" role="tabpanel" aria-labelledby="v-pills-gaming-mice-tab">
            <div class="row">
                @if(isset($GetAllProducts))
                @foreach($GetAllProducts as $GetAllProduct)
                    @if($GetAllProduct->prodcat == 3)
                    <div class="item-container col-3">
                        <div class="item-img">
                            <img src="{{url('/images/'.$GetAllProduct->prodimg)}}" class="img-item">
                        </div>
                        <div class="item-name">
                            <h6>{{$GetAllProduct->prodname}}
                                @guest
                                @else
                                <button class="btn prod-edit" data-prodid="{{$GetAllProduct->id}}">
                                    <a href="#" >
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                </button>
                                @endguest
                            </h6>
                        </div>
                        <div class="item-price">
                            <p>₱{{$GetAllProduct->prodprice}}</p>
                        </div>
                        <div class="item-btns input-group">
                            <button type="button" class="btn buy-btn" data-prodid="{{$GetAllProduct->id}}"><a href="#">Buy Now!</a></button>
                            @guest
                            @else
                            <button type="button" class="btn add-to-cart" data-prodcode="{{$GetAllProduct->prodcode}}" data-availability="{{$GetAllProduct->prodqty}}" data-cartqty="1"><i class="bi bi-cart3"></i></button>
                            @endguest
                        </div>
                    </div>
                    @endif
                @endforeach
                @endif
            </div>
        </div>
        <div class="tab-pane fade" id="v-pills-gaming-mousepad" role="tabpanel" aria-labelledby="v-pills-gaming-mousepad-tab">
            <div class="row">
            @if(isset($GetAllProducts))
            @foreach($GetAllProducts as $GetAllProduct)
                @if($GetAllProduct->prodcat == 4)
                <div class="item-container col-3">
                    <div class="item-img">
                        <img src="{{url('/images/'.$GetAllProduct->prodimg)}}" class="img-item">
                    </div>
                    <div class="item-name">
                        <h6>{{$GetAllProduct->prodname}}
                            @guest
                            @else
                            <button class="btn prod-edit" data-prodid="{{$GetAllProduct->id}}">
                                <a href="#" >
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                            </button>
                            @endguest
                        </h6>
                    </div>
                    <div class="item-price">
                        <p>₱{{$GetAllProduct->prodprice}}</p>
                    </div>
                    <div class="item-btns input-group">
                        <button type="button" class="btn buy-btn" data-prodid="{{$GetAllProduct->id}}"><a href="#">Buy Now!</a></button>
                        @guest
                        @else
                        <button type="button" class="btn add-to-cart" data-prodcode="{{$GetAllProduct->prodcode}}" data-availability="{{$GetAllProduct->prodqty}}" data-cartqty="1"><i class="bi bi-cart3"></i></button>
                        @endguest
                    </div>
                </div>
                @endif
            @endforeach
            @endif
            </div>
        </div>
        <div class="tab-pane fade" id="v-pills-gaming-chair" role="tabpanel" aria-labelledby="v-pills-gaming-chair-tab">
            <div class="row">
            @if(isset($GetAllProducts))
            @foreach($GetAllProducts as $GetAllProduct)
                @if($GetAllProduct->prodcat == 5)
                <div class="item-container col-3">
                    <div class="item-img">
                        <img src="{{url('/images/'.$GetAllProduct->prodimg)}}" class="img-item">
                    </div>
                    <div class="item-name">
                        <h6>{{$GetAllProduct->prodname}}
                            @guest
                            @else
                            <button class="btn prod-edit" data-prodid="{{$GetAllProduct->id}}">
                                <a href="#" >
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                            </button>
                            @endguest
                        </h6>
                    </div>
                    <div class="item-price">
                        <p>₱{{$GetAllProduct->prodprice}}</p>
                    </div>
                    <div class="item-btns input-group">
                        <button type="button" class="btn buy-btn" data-prodid="{{$GetAllProduct->id}}"><a href="#">Buy Now!</a></button>
                        @guest
                        @else
                        <button type="button" class="btn add-to-cart" data-prodcode="{{$GetAllProduct->prodcode}}" data-availability="{{$GetAllProduct->prodqty}}" data-cartqty="1"><i class="bi bi-cart3"></i></button>
                        @endguest
                    </div>
                </div>
                @endif
            @endforeach
            @endif
            </div>
        </div>
        <div class="tab-pane fade" id="v-pills-gaming-desk" role="tabpanel" aria-labelledby="v-pills-gaming-desk-tab">
            <div class="row">
            @if(isset($GetAllProducts))
            @foreach($GetAllProducts as $GetAllProduct)
                @if($GetAllProduct->prodcat == 6)
                <div class="item-container col-3">
                    <div class="item-img">
                        <img src="{{url('/images/'.$GetAllProduct->prodimg)}}" class="img-item">
                    </div>
                    <div class="item-name">
                        <h6>{{$GetAllProduct->prodname}}
                            @guest
                            @else
                            <button class="btn prod-edit" data-prodid="{{$GetAllProduct->id}}">
                                <a href="#" >
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                            </button>
                            @endguest
                        </h6>
                    </div>
                    <div class="item-price">
                        <p>₱{{$GetAllProduct->prodprice}}</p>
                    </div>
                    <div class="item-btns input-group">
                        <button type="button" class="btn buy-btn" data-prodid="{{$GetAllProduct->id}}"><a href="#">Buy Now!</a></button>
                        @guest
                        @else
                        <button type="button" class="btn add-to-cart" data-prodcode="{{$GetAllProduct->prodcode}}" data-availability="{{$GetAllProduct->prodqty}}" data-cartqty="1"><i class="bi bi-cart3"></i></button>
                        @endguest
                    </div>
                </div>
                @endif
            @endforeach
            @endif
            </div>
        </div>
        <div class="tab-pane fade" id="v-pills-gaming-bags" role="tabpanel" aria-labelledby="v-pills-gaming-bags-tab">
            <div class="row">
            @if(isset($GetAllProducts))
            @foreach($GetAllProducts as $GetAllProduct)
                @if($GetAllProduct->prodcat == 7)
                <div class="item-container col-3">
                    <div class="item-img">
                        <img src="{{url('/images/'.$GetAllProduct->prodimg)}}" class="img-item">
                    </div>
                    <div class="item-name">
                        <h6>{{$GetAllProduct->prodname}}
                            @guest
                            @else
                            <button class="btn prod-edit" data-prodid="{{$GetAllProduct->id}}">
                                <a href="#" >
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                            </button>
                            @endguest
                        </h6>
                    </div>
                    <div class="item-price">
                        <p>₱{{$GetAllProduct->prodprice}}</p>
                    </div>
                    <div class="item-btns input-group">
                        <button type="button" class="btn buy-btn" data-prodid="{{$GetAllProduct->id}}"><a href="#">Buy Now!</a></button>
                        @guest
                        @else
                        <button type="button" class="btn add-to-cart" data-prodcode="{{$GetAllProduct->prodcode}}" data-availability="{{$GetAllProduct->prodqty}}" data-cartqty="1"><i class="bi bi-cart3"></i></button>
                        @endguest
                    </div>
                </div>
                @endif
            @endforeach
            @endif
            </div>
        </div>
        <div class="tab-pane fade" id="v-pills-gaming-headsets" role="tabpanel" aria-labelledby="v-pills-gaming-headsets-tab">
            <div class="row">
            @if(isset($GetAllProducts))
            @foreach($GetAllProducts as $GetAllProduct)
                @if($GetAllProduct->prodcat == 8)
                <div class="item-container col-3">
                    <div class="item-img">
                        <img src="{{url('/images/'.$GetAllProduct->prodimg)}}" class="img-item">
                    </div>
                    <div class="item-name">
                        <h6>{{$GetAllProduct->prodname}}
                            @guest
                            @else
                            <button class="btn prod-edit" data-prodid="{{$GetAllProduct->id}}">
                                <a href="#" >
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                            </button>
                            @endguest
                        </h6>
                    </div>
                    <div class="item-price">
                        <p>₱{{$GetAllProduct->prodprice}}</p>
                    </div>
                    <div class="item-btns input-group">
                        <button type="button" class="btn buy-btn" data-prodid="{{$GetAllProduct->id}}"><a href="#">Buy Now!</a></button>
                        @guest
                        @else
                        <button type="button" class="btn add-to-cart" data-prodcode="{{$GetAllProduct->prodcode}}" data-availability="{{$GetAllProduct->prodqty}}" data-cartqty="1"><i class="bi bi-cart3"></i></button>
                        @endguest
                    </div>
                </div>
                @endif
            @endforeach
            @endif
            </div>
        </div>
        <div class="tab-pane fade" id="v-pills-gaming-monitor" role="tabpanel" aria-labelledby="v-pills-gaming-monitor-tab">
            <div class="row">
            @if(isset($GetAllProducts))
            @foreach($GetAllProducts as $GetAllProduct)
                @if($GetAllProduct->prodcat == 9)
                <div class="item-container col-3">
                    <div class="item-img">
                        <img src="{{url('/images/'.$GetAllProduct->prodimg)}}" class="img-item">
                    </div>
                    <div class="item-name">
                        <h6>{{$GetAllProduct->prodname}}
                            @guest
                            @else
                            <button class="btn prod-edit" data-prodid="{{$GetAllProduct->id}}">
                                <a href="#" >
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                            </button>
                            @endguest
                        </h6>
                    </div>
                    <div class="item-price">
                        <p>₱{{$GetAllProduct->prodprice}}</p>
                    </div>
                    <div class="item-btns input-group">
                        <button type="button" class="btn buy-btn" data-prodid="{{$GetAllProduct->id}}"><a href="#">Buy Now!</a></button>
                        @guest
                        @else
                        <button type="button" class="btn add-to-cart" data-prodcode="{{$GetAllProduct->prodcode}}" data-availability="{{$GetAllProduct->prodqty}}" data-cartqty="1"><i class="bi bi-cart3"></i></button>
                        @endguest
                    </div>
                </div>
                @endif
            @endforeach
            @endif
            </div>
        </div>

        
    

        <!-- For Adding Products -->
        <div class="tab-pane fade" id="v-pills-add-product" role="tabpanel" aria-labelledby="v-pills-add-product-tab">
            <div class="product-container">
                <form method="POST" action="{{route('addproduct')}}" enctype="multipart/form-data">
                @csrf
                    <div class="product-name form-floating">
                        <input type="text" class="form-control" id="productName" name="prodname" onfocus="this.value=''; this.style.color='violet'" placeholder="Product Name" required>
                        <label for="productname" class="form-label">Product name </label>
                    </div>
                    <div class="product-code form-floating">
                        <input type="text" class="form-control" id="productCode" name="prodcode" onfocus="this.value=''; this.style.color='violet'" placeholder="Product Code" required>
                        <label for="productcode" class="form-label">Product Code </label>
                    </div>
                    <div class="product-price form-floating mt-2">
                        <input type="text" class="form-control" id="productPrice" name="prodprice" onfocus="this.value=''; this.style.color='violet'" placeholder="Product Price" required>
                        <label for="productprice" class="form-label">Product price </label>
                    </div>
                    <div class="product-quantity mt-3">
                        <h3>Quantity:</h3>
                        <input class="prod-count" name="prodqty" value="1" /></span>
                    </div>
                    <div class="product-category">
                        <h3>Category:</h3>
                        @if(isset($GetCategories))
                            @foreach($GetCategories as $GetCategory)
                                <span><input type="radio" class="{{$GetCategory->classattribute}}" name="prodcat" value="{{$GetCategory->id}}"/> {{$GetCategory->catname}}</span>
                            @endforeach
                        @endif
                    </div>
                    <div class="product-image mt-3">
                        <h3>Product image:</h3>
                        <input type="file" class="btn prod-photo" name="prodimg" id="prod_pic_input" hidden/>
                        <label class="btn prod-user-btn" for="prod_pic_input"><i class="bi bi-camera-fill" id="prod_user_btn"></i></label>
                    </div>

                    <button type="submit" class="btn btn-product-add">Submit</button>
                </form>
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
        <!-- End of from Add products -->

    </div>
</div>
@endsection