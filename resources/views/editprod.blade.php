@extends('layouts.app')

@section('content')
<!-- 
<div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div> -->

@if(isset($GetProdDetails)) 
    @foreach($GetProdDetails as $GetProdDetail)
    <!-- The slideshow/carousel -->
    
    <div class="container" style="margin-top: 90px;">
        <div class="product-container edit-product">
            
            <form method="POST" action="{{route('editprodpost')}}" enctype="multipart/form-data">
            @csrf
                <input type="text" name="prodid" value="{{$GetProdDetail->id}}" hidden/>
                <div class="product-name form-floating">
                    <input type="text" class="form-control" id="productName" name="prodname" value="{{$GetProdDetail->prodname}}"  placeholder="Product Name" onfocus="this.value=''; this.style.color='violet'" required>
                    <label for="productname" class="form-label">Product name </label>
                </div>
                <div class="product-code form-floating">
                    <input type="text" class="form-control" id="productCode" name="prodcode" value="{{$GetProdDetail->prodcode}}"  placeholder="Product Code" onfocus="this.value=''; this.style.color='violet'" required>
                    <label for="productcode" class="form-label">Product Code </label>
                </div>
                <div class="product-price form-floating mt-2">
                    <input type="text" class="form-control" id="productPrice" name="prodprice" value="{{$GetProdDetail->prodprice}}"  placeholder="Product Price" onfocus="this.value=''; this.style.color='violet'" required>
                    <label for="productprice" class="form-label">Product price </label>
                </div>
                <div class="product-quantity mt-3">
                    <h3>Quantity:</h3>
                    <input class="prod-count" name="prodqty" value="{{$GetProdDetail->prodqty}}" />
                </div>
                <div class="product-category">
                    <h3>Category:</h3>
                            @foreach($GetCategories as $GetCategory)
                            <span><input type="radio" name="prodcat" <?php if($GetCategory->id == $GetProdDetail->prodcat){?> checked <?php }?>  value="{{$GetCategory->id}}"/>{{$GetCategory->catname}}</span>
                            @endforeach
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
    @endforeach
@endif


@endsection