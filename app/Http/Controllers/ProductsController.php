<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use DB;
use App\Product;


class ProductsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function AddProduct(Request $request){
        $prodname = $request->prodname;
        $prodprice = $request->prodprice;
        $prodcode = $request->prodcode;
        $prodqty = $request->prodqty;
        $prodimg = $request->file('prodimg');
        $prodcat = $request->prodcat;

        
        $image_name = rand(100, 999) . '.' . $prodimg->getClientOriginalExtension();

        $destinationPath = public_path('/thumbnail');

        $resize_image = Image::make($prodimg->getRealPath());

        $resize_image->resize(150, 150, function($constraint){
        $constraint->aspectRatio();
        })->save($destinationPath . '/' . $image_name);

        $destinationPath = public_path('/images');

        $prodimg->move($destinationPath, $image_name);

        $AddProduct = New Product;
        $AddProduct->prodname = $prodname;
        $AddProduct->prodprice = $prodprice;
        $AddProduct->prodcode = $prodcode;
        $AddProduct->prodqty = $prodqty;
        $AddProduct->prodimg = $image_name;
        $AddProduct->prodcat = $prodcat;
        $AddProduct->save();


        $GetCategories = DB::table('categories')->get();
        
        return redirect('shop')->with('success', 'Item Has Been Added!');
    }





    public function EditProduct($prodid){
    
        $GetProdDetails = DB::table('products')
        ->where('id', '=', $prodid)
        ->get();

        $GetCategories = DB::table('categories')->get();

        return view('editprod', compact('GetProdDetails', 'GetCategories'));
    }//End Function




    public function EditProductPost(Request $request){

        $prodid = $request->prodid;
        $prodname = $request->prodname;
        $prodprice = $request->prodprice;
        $prodcode = $request->prodcode;
        $prodqty = $request->prodqty;
        $prodimg = $request->file('prodimg');
        $prodcat = $request->prodcat;


        $UpdateProd = Product::find($prodid);
        $UpdateProd->prodname = $prodname;
        $UpdateProd->prodprice = $prodprice;
        $UpdateProd->prodcode = $prodcode;
        $UpdateProd->prodqty = $prodqty;
        $UpdateProd->prodcat = $prodcat;
        if($prodimg != NULL){

            $image_name = rand(100, 999) . '.' . $prodimg->getClientOriginalExtension();

            $destinationPath = public_path('/thumbnail');

            $resize_image = Image::make($prodimg->getRealPath());

            $resize_image->resize(150, 150, function($constraint){
            $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_name);

            $destinationPath = public_path('/images');

            $prodimg->move($destinationPath, $image_name);

            $UpdateProd->prodimg = $image_name;
        }
        $UpdateProd->save();
        

        $GetProdDetails = DB::table('products')
        ->where('id', '=', $prodid)
        ->get();


        $GetCategories = DB::table('categories')->get();
        
        return redirect('shop')->with('success', 'Item Has Been Updated!');
    }//End Function



    public function placeOrder($prodid)
    {
        $GetProducts = DB::table('products')->where('id', '=', $prodid)->get();
        $GetCategories = DB::table('categories')->get();
        return view('placeorder', compact('GetCategories', 'GetProducts'));
    }



}//End class
