<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Order;
use App\Orderdetail;
use App\Product;
use App\Cart;
use DB;

class OrdersController extends Controller
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
    //Place Order for Buy Now Direct
    public function AddOrder(Request $request){
        $subtotal = $request->subtotal;
        $totalpayment = $request->totalpayment;
        $orderaddress = $request->orderaddress;
        $ordercontactnum = $request->ordercontactnum;
        $paymentopt = $request->paymentopt;
        $prodid = $request->prodid;
        $userid = Auth::user()->id;
        $totalqty = $request->totalqty;

        if($paymentopt != 'Paypal'){//Check Payment Method
            $SaveOrder = New Order;
            $SaveOrder->userid = $userid;
            $SaveOrder->ordersubtotal = $subtotal;
            $SaveOrder->ordertotal = $totalpayment;
            $SaveOrder->orderaddress = $orderaddress;
            $SaveOrder->shippingfee = '150';
            $SaveOrder->ordertotalqty = $totalqty;
            $SaveOrder->ordertype = $paymentopt;
            $SaveOrder->orderstatus = 'In-Process';
            $SaveOrder->save();


            $GetItemDetail = DB::table('products')->where('id', '=', $prodid)->get();

            foreach($GetItemDetail as $row){
                $SaveOrderDetails = New Orderdetail;
                $SaveOrderDetails->prodname = $row->prodname;
                $SaveOrderDetails->prodcode = $row->prodcode;
                $SaveOrderDetails->qty =  $totalqty;
                $SaveOrderDetails->price = $row->prodprice;
                $SaveOrderDetails->amount = $subtotal;
                $SaveOrderDetails->orderid = $SaveOrder->id;
                $SaveOrderDetails->userid = $userid;
                $SaveOrderDetails->save();

                $UpdateQty = Product::find($prodid);
                $UpdateQty->decrement('prodqty', $totalqty);
            }
            return redirect('order')->with('success', 'Successfully Added an Order!');
        }else{
            //Paypal Data Preparation
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $paypalToken = $provider->getAccessToken();
    
            $response = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => route('processSuccess'),
                    "cancel_url" => route('processCancel'),
                ],
                "purchase_units" => [
                    0 => [
                        "amount" => [
                            "currency_code" => "PHP",
                            "value" => "100.00"
                        ]
                    ]
                ]
            ]);
    
            if (isset($response['id']) && $response['id'] != null) {
    
                // redirect to approve href
                foreach ($response['links'] as $links) {
                    if ($links['rel'] == 'approve') {
                        return redirect()->away($links['href']);
                    }
                }
    
                dd('Something went wrong.');
    
            } else {
                dd('Something went wrong.');
            }
          

        }
    }//End Function




    public function processSuccess(Request $request)
{

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            dd('Transaction complete.');
        } else {
            
                dd('Something went wrong.');
        }

}



public function processCancel(Request $request)
    {
        dd('You Have Cancel Transactions');
    }

  

    public function GetOrderLists()
    {
        $userid = Auth::user()->id;
        $GetOrderLists = DB::table('orders')->where('userid', '=', $userid)->orderBy('id', 'DESC')->get();
     
        $GetCartCount = DB::table('carts')->where('userid', '=', $userid)->count();
        return view('order', compact('GetOrderLists', 'GetCartCount'));
    }//End Function



    public function GetOrderDetails($orderid){
        $GetOrderDetails = DB::table('orderdetails')
            ->select('products.id', 'products.prodname', 'products.prodcode', 'products.prodimg', 'products.prodprice', 'orderdetails.qty', 'orderdetails.amount')
            ->leftJoin('products', 'products.prodcode', '=', 'orderdetails.prodcode')
            ->where('orderid', '=', $orderid)->get();
        
        return response()->json($GetOrderDetails);
    }




    public function AddtoCart(Request $request){
        
        $userid = Auth::user()->id;
        $prodcode = $request->prodcode;
        $cartqty = $request->cartqty;

    
        //check if exist update then add one
        $CheckifItemExist = DB::table('carts')
        ->where('prodcode', '=', $prodcode)
        ->where('userid', '=', $userid)
        ->get();

        // dd($CheckifItemExist);
      
            if($CheckifItemExist->contains('prodcode', $prodcode)){
                //Update Item Record on Cart
                $UpdateCart = DB::table('carts')
                    ->where('prodcode', '=', $prodcode)
                    ->where('userid', '=', $userid)
                    ->increment('qty', $cartqty);
            }else{
                //Add New Record on the Cart
                $GetProdDetails = DB::table('products')
                ->where('prodcode', '=', $prodcode)
                ->get();

                foreach($GetProdDetails as $row){
                    $AddtoCart = New Cart;
                    $AddtoCart->prodname = $row->prodname;
                    $AddtoCart->prodcode = $row->prodcode;
                    $AddtoCart->prodprice = $row->prodprice;
                    $AddtoCart->qty = $AddtoCart->qty + $cartqty;
                    $AddtoCart->userid = $userid;
                    $AddtoCart->save();
                }    
                
           }


           return response()->json($CheckifItemExist);

    }//end of function


    public function GetCartLists(){
        $userid = Auth::user()->id;

        $GetCartLists = DB::table('carts')
        ->select('carts.prodcode', 'carts.prodname', 'products.prodname', 'products.prodimg', 'products.prodprice', 'products.prodqty','carts.qty', DB::raw("SUM(replace(products.prodprice, ',', '') * replace(carts.qty, ',', ''))  AS itemamount"))
        ->leftJoin('products', 'products.prodcode', '=', 'carts.prodcode')
        ->where('carts.userid', '=', $userid)
        ->groupBy('carts.prodcode', 'carts.prodname', 'products.prodname', 'products.prodimg', 'products.prodprice', 'products.prodqty','carts.qty')    
        ->get();

        $GetCartCount = DB::table('carts')->where('userid', '=', $userid)->count();


        return view('cart', compact('GetCartLists', 'GetCartCount'));
    }//end of function


    public function UpdateCartQty(Request $request){
        $prodcode = $request->prodcode;
        $cartqty = $request->cartqty;
        $userid = Auth::user()->id;

        $UpdateCartQty = DB::table('carts')
            ->where('prodcode', '=', $prodcode)
            ->where('userid', '=', $userid)
            ->update(['qty' => $cartqty]);
        
    }//End of Function



    public function DeleteCartItem(Request $request){
        $userid = Auth::user()->id;
        $prodcode = $request->prodcode;

        $DeleteItemCart = DB::table('carts')
            ->where('prodcode', '=', $prodcode)
            ->where('userid', '=', $userid)
            ->delete();

    }//End of Function

  
    // Place Order on Cart Lists
    public function AddOrderCart(Request $request){
        $subtotal = $request->subtotal;
        $totalqty = $request->totalqty;
        $totalpayment = $request->totalpayment;
        $orderaddress = $request->orderaddress;
        $ordercontactnum = $request->ordercontactnum;
        $paymentopt = $request->paymentopt;
        $userid = Auth::user()->id;
        
        if($paymentopt != 'Paypal'){//Check Payment Method
            $SaveOrder = New Order;
            $SaveOrder->userid = $userid;
            $SaveOrder->ordersubtotal = $subtotal;
            $SaveOrder->ordertotal = $totalpayment;
            $SaveOrder->orderaddress = $orderaddress;
            $SaveOrder->shippingfee = '150';
            $SaveOrder->ordertotalqty = $totalqty;
            $SaveOrder->ordertype = $paymentopt;
            $SaveOrder->orderstatus = 'In-Process';
            $SaveOrder->save();


            $GetCartDetails = DB::table('carts')->where('userid', '=', $userid)->get();
        
            foreach($GetCartDetails as $row){

                $GetCartDetails = New Orderdetail;
                $GetCartDetails->prodname = $row->prodname;
                $GetCartDetails->prodcode = $row->prodcode;
                $GetCartDetails->qty =  $row->qty;
                $GetCartDetails->price = $row->prodprice;
                $GetCartDetails->amount = $row->qty*str_replace( ',', '', $row->prodprice);
                $GetCartDetails->orderid = $SaveOrder->id;
                $GetCartDetails->userid = $userid;
                $GetCartDetails->save();

                $UpdateQty = Product::where('prodcode','=',$row->prodcode);
                $UpdateQty->decrement('prodqty', $row->qty);
            }

            $EmptyCart = DB::table('carts')->where('userid', '=', $userid)->delete();

            return redirect('order')->with('success', 'Successfully Added an Order!');
        }else{
            //Paypal Data Preparations
        }
    }//End Function

}//End Class
