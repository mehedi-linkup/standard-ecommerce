<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;

use App\Models\Area;
use App\Models\Order;
use App\Models\Thana;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Inventory;
use App\Models\SubCategory;
use Darryldecode\Cart\Cart;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use App\Models\CompanyProfile;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\Offer;
// use   App\Http\Controllers\Api\ApiController::respondWithError

class ApiController extends Controller
{
    // public function index(){
    //     $category = Category::latest()->get();
    //     return response()->json($category);
    // }

    // public function store(Request $request){
    //     $request->all();
    //     return response()->json()
    // }
// minimum order

    public function GetMinimumOffer(){
        $offerPrice = Offer::select('minimum_order_amount')->first();
        return response()->json($offerPrice);
    }
    
    
    public function hotline(){
       $hotline = CompanyProfile::select('phone_1', 'phone_2')->first();
       return response()->json(['data' => $hotline], 200);
    }

     public function product(){
       $product = Product::select('id', 'code','category_id','sub_category_id','name','price','discount','image', 'thum_image','short_details','description','is_offer')->with('inventory')->where('is_popular', 1)->whereNull('deleted_at')->inRandomOrder()->get()->makeHidden(['color_id','size_id' ]);
        return response()->json(['data' =>  $product], 200);
       
    }

   

    public function CustomerStore(Request $request){
        $rules=array(
            'name'     => 'required',
             'phone' => 'required|unique:customers|regex:/^01[13-9][\d]{8}$/|min:11',
            'password' => 'required'
        );

        $messages=array(
                'name.required'     => 'Please enter name.',
                'phone.required'    => 'Please enter phone number.',
                'password.required' => 'Please enter password.'
            );
      
    $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails())
        {
            $messages = $validator->messages();
            $errors   = $messages->all();
            return response()->json($errors); 
        }

        $otp     = rand(1000,9999);
        $message = "Zenevia Expresss Shop account register PIN is $otp . Please don't share this";
       
        $customer       = new Customer();
        $code           = 'C' . $this->generateCode('Customer');
        $customer->name = $request->name;
        // $customer->email = $request->email;
        $customer->phone      = $request->phone;
        $customer->address    = $request->address;
        $customer->username   = $request->phone;
        $customer->password   = Hash::make($request->password);
        $customer->ip_address = $request->ip();
        $customer->code       = $code;
        $customer->save_by    = 0;
        $customer->otp        = $otp;
        $customer->updated_by = 0;
        $customer->save();
        $phone = $customer->phone;
        if($customer){
            $this->send_sms($phone, $message);
            // Session::put('phone', $phone);
            return "Customer Register Successfully";  
        }
        else{
            return response()->json(["Something went Worng"], 200); 
        }
    }

    public function otpMatch(Request $request){
        $phone = $request->phone;
        $otp = $request->otp;
        $customer = Customer::where('phone',$phone)->where('otp',$otp)->first();

        if($customer){
         
            $customer->isVerified = '1';
             $customer->save();
            return "Your Account Verified Sucessfully"; 
            }
            else{
                return response()->json(["opps otp didn't match"], 200); 
            }
    }





    // category api
    public function getCategory(){
        $category = Category::with('SubCategory')->latest()->get();
        return response()->json(['data' => $category], 200);
    }

    public function getCategoryOnly(){
        $category = Category::latest()->get();
        return response()->json(['data' => $category], 200);
    }

    // slider 
    public function banner(){
        $banner = Banner::select('image')->latest()->get();
        return response()->json(['data'=>$banner], 200);
    }


    // product api 

    public function recentProduct(){
        $recent = Product::select('id','code','name','slug','category_id','sub_category_id','price','discount','image','thum_image','discount','size_id','color_id','short_details',strip_tags( 'description'),'is_popular','is_offer')->with('inventory')->latest()->take(20)->get();
        return response()->json(['data' =>$recent]); 
    }
    public function recentProductInner(){
        $recent = Product::select('id','code','name','slug','category_id','sub_category_id','price','discount','image','thum_image','discount','size_id','color_id','short_details',strip_tags('description'),'is_popular','is_offer')->with('inventory')->latest()->paginate(20);
        return response()->json($recent); 
    }
    // popular
    public function popularInner(){
        $popular = Product::select('id','code','name','slug','category_id','sub_category_id','price','discount','image','thum_image','discount','size_id','color_id','short_details',strip_tags('description'),'is_popular','is_offer')->with('inventory')->where('is_popular', '1')->latest()->paginate(20);
    //    response()->json(!$popular->short_details !);
        return response()->json($popular); 
    }
   
    public function newArrival(){
        $newarrival = Product::select('id','code','name','slug','category_id','sub_category_id','price','discount','image','thum_image','discount','size_id','color_id','short_details',strip_tags('description'),'is_popular','is_offer')->with('inventory')->where('category_id', '25')->latest()->paginate(20);
        return response()->json($newarrival); 
    }

    public function subcategoryWiseProduct($id){
        $product = Product::select('id','code','name','slug','category_id','sub_category_id','price','discount','image','thum_image','discount','size_id','color_id','short_details',strip_tags('description'),'is_popular','is_offer')->with('inventory')->where('sub_category_id', $id)->get();
          return response()->json(['data' => $product]);
        
    }
    public function categoryWiseProduct($id){
        $product = Product::select('id','code','name','slug','category_id','sub_category_id','price','discount','image','thum_image','discount','size_id','color_id','short_details',strip_tags('description'),'is_popular','is_offer')->with('inventory')->where('category_id', $id)->paginate(12);
        return response()->json( $product);
    }

    // order

    public function search($name)
    {
        $result = Product::with('inventory')->where('name', 'LIKE', '%'. $name. '%')->orderBy('name', 'asc')->get();
        if(count($result)){
         return Response()->json(['data' => $result]);
        }
        else
        { 
        return response()->json(['Result' => 'No Data not found'], 404);
      }
    }

    public function getThana(){
        $thana = Thana::all();
         return response()->json(['data' => $thana]);
    }

    public function getArea(Request $request){
        // return $request->thana_id;
        // $category = Category::find($request->id);
       $area = Area::where('thana_id', $request->thana_id)->get();
        return response()->json([
            'status' => 'success',
            'Thana'=>$area
         ], 200);
    }

   

    public function orderStore(Request $request)
    {  
        // dd($request->all());

        $rules=array(
                'customer_name' => 'required|max:100',
                'customer_mobile' => 'required|regex:/^01[13-9][\d]{8}$/|min:11',
                'customer_email' => 'max:50',
                'total_amount' => 'required',
                'area_id' => 'required',
                'billing_address' => 'required',
                // 'delivery_date' => 'required',
                'ip_address' => 'max:15',
                );
        
                $messages=array(
                     
                    );
              
            $validator = Validator::make($request->all(),$rules,$messages);
                if($validator->fails())
                {
                    $messages = $validator->messages();
                    $errors   = $messages->all();
                    return response()->json($errors); 
                }
        
            $sum = 0;
            
            $last_invoice_no =  Order::whereDate('created_at', today())->latest()->take(1)->pluck('invoice_no');
            if(count($last_invoice_no) > 0){
                $invoice_no = $last_invoice_no[0] + 1;
            } else {
                $invoice_no = date('ymd') .'000001';
            }
            $area = Area::where('id',$request->area_id)->first();
            $area_amount = $area->amount;
            // dd($area_amount);

           
            // try 
            // {
                DB::beginTransaction();
                $order = new Order();
                $order->invoice_no = $invoice_no;
                $order->customer_id = $request->customer_id;
                $order->customer_name = $request->customer_name;
                $order->customer_mobile = $request->customer_mobile;
                $order->customer_email = $request->customer_email;
                $order->area_id = $request->area_id;
                $order->shipping_address = $request->shipping_address;
                $order->billing_address = $request->billing_address;
                $order->shipping_cost = $area_amount;
                $order->total_amount = 0;
                $order->order_note = $request->order_note;
                $order->delivery_date = $request->delivery_date;
                $order->ip_address = $request->ip();
                $order->save();
        
                 $offer_product = Product::where('is_offer','1')->get()->pluck('id')->toArray();
                // dd($offer_product);
                

                $exist_order_tables =OrderDetails::where('customer_id',$request->customer_id)->whereDate('created_at', Carbon::today())->get()->pluck('product_id')->toArray();
              
                // \Cart::getContent()
                $cart = json_decode($request->cart);
                $cart = array_values((array)$cart);

                foreach ($cart as $value) {
                     $product = Product::where('id', $value->id)->first();
                    if(in_array($value->id, $offer_product)){
                        
                        if(in_array($value->id,$exist_order_tables)){
                            
                            $price = $product->price* $value->quantity;
                            $orderDetails = new OrderDetails();
                            $orderDetails->order_id = $order->id;
                            $orderDetails->customer_id = $order->customer_id;
                            $orderDetails->product_id = $value->id;
                            $orderDetails->product_name = $value->name;
                            $orderDetails->price =$product->price;
                            $orderDetails->quantity = $value->quantity;
                            $orderDetails->total_price = $price;
                            $orderDetails->save();
                                  $cart_total =  $sum += $price;
                       
                            DB::table('orders')->where('id', $order->id)->update(['total_amount' => $cart_total + $order->shipping_cost ]);
                            $inventory = Inventory::where('product_id',$value->id)->first();
                            $inventory->sales    = $value->quantity;
                            $inventory->purchage = $inventory->purchage - $value->quantity;
                            $inventory->sales = $inventory->sales + $value->quantity;
                            $inventory->save();
                            continue;
                        }
                        else{
                            
                            if($value->quantity > 1){
                              
                                $discount_product = Product::where('id',$value->id)->first();
                                // dd($discount_product->discount);
                                $discount = $discount_product->price/100*$discount_product->discount;
                                // dd($value->price/100*$discount_product->discount);
                                 $discount_price = $discount_product->price - $discount;
                                 $exist_qty = $value->quantity - 1;
                                 $second_price = $discount_product->price * $exist_qty;
                                 $price = $discount_price + $second_price;
                                 $orderDetails = new OrderDetails();
                                 $orderDetails->order_id = $order->id;
                                 $orderDetails->product_id = $value->id;
                                 $orderDetails->product_name = $value->name;
                                 $orderDetails->customer_id = $order->customer_id;
                                 $orderDetails->price =$discount_product->price;


                                 $orderDetails->offer_price = $discount;
                               
                                


                                 $orderDetails->quantity = $value->quantity;
                                 $orderDetails->total_price = $price;
                                $orderDetails->save();
                                $inventory = Inventory::where('product_id',$value->id)->first();
                                $inventory->sales = $value->quantity;
                                $inventory->purchage = $inventory->purchage - $value->quantity;
                                $inventory->sales = $inventory->sales + $value->quantity;
                                $inventory->save();
                                $cart_total =  $sum += $price;
                       

                                   DB::table('orders')->where('id', $order->id)->update(['total_amount' => $cart_total + $order->shipping_cost ]);
                                continue;
                                //  dd('offer 1 er beshi');
                                
                               
                            } else {
                              
                                $discount_product = Product::where('id',$value->id)->first();

                                $discount = $discount_product->price/100*$discount_product->discount;

                                $price = $discount_product->price - $discount;
                                $orderDetails = new OrderDetails();
                                $orderDetails->order_id = $order->id;
                                $orderDetails->product_id = $value->id;
                                $orderDetails->product_name = $value->name;
                                $orderDetails->customer_id = $order->customer_id;
                                $orderDetails->price =$discount_product->price;

                                $orderDetails->offer_price = $discount;

                                $orderDetails->quantity = $value->quantity;
                                $orderDetails->total_price = $price;
                                 $orderDetails->save();
                                   $cart_total =  $sum += $price;
                       
                                   DB::table('orders')->where('id', $order->id)->update(['total_amount' => $cart_total + $order->shipping_cost ]);
                                 $inventory = Inventory::where('product_id',$value->id)->first();
                                 $inventory->sales = $value->quantity;
                                 $inventory->purchage = $inventory->purchage - $value->quantity;
                                 $inventory->sales = $inventory->sales + $value->quantity;

                                 $inventory->save();
        
                                // dd('offer 1 ');
                                continue;
                               
                            }
                        }
                    }
                    $orderDetails = new OrderDetails();
                    $orderDetails->order_id = $order->id;
                    $orderDetails->product_id = $value->id;
                    $orderDetails->product_name = $value->name;
                    $orderDetails->customer_id = $order->customer_id;
                    $orderDetails->price =$product->price;
                    $orderDetails->quantity = $value->quantity;
                    $price = $value->quantity * $product->price;
                    $orderDetails->total_price = $price;
                    $orderDetails->save();
                     $cart_total =  $sum += $price;
                     DB::table('orders')->where('id', $order->id)->update(['total_amount' => $cart_total + $order->shipping_cost ]);
                    $inventory = Inventory::where('product_id',$value->id)->first();
                    $inventory->purchage = $inventory->purchage - $value->quantity;
                    $inventory->sales = $inventory->sales + $value->quantity;
                    $inventory->save();
                    continue;   
                    
                        
                    }
                   $company = CompanyProfile::first();
                   $admin_phone = $company->phone_3;
                   $customer_phone = $request->customer_mobile;
                   $name = $request->customer_name;
                   $msg = "নতুন একটি অর্ডার করেছেন {$name}, {$order->invoice_no}";
                   $message = "{$name}, সফল ভাবে আপনার অর্ডারটি সম্পন্ন হয়েছে, আপনার অর্ডার নাম্বার {$order->invoice_no}";
                   $this->send_sms($admin_phone , $msg);
                   $this->send_sms($customer_phone , $message);
                    DB::commit();     
                    \Cart::clear();
                    return 'success';
                // } 
                // catch (Exception $e) {
                //     DB::rollBack();
                //     return 'fail';
                //     // Session::flash('faild', 'order Submit faild');
                //     // return back();
                // }
    }
}
