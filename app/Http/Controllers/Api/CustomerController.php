<?php

namespace App\Http\Controllers\api;

use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Models\OrderDetails;
// use Tymon\JWTAuth\Providers\Auth\Illuminate::class;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{

    // public function __construct()
    // {
    //     $this->user = JWTAuth::parseToken()->authenticate();
    // }
    
    public function customerUpdate(Request $request, $phone)
    {
        //   $token =  JWTAuth::parseToken()->authenticate();
        //   if($token == Auth::guard('api')->access){
            $customer = Customer::where('phone', $phone)->first();
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->save();
            return response()->json(['success' => 'success']); 
        //   }
            
       
    }



    public function customerPasswordUpdate(Request $request, $phone)
    {

        $cumstomer = Customer::where('phone', $phone)->first();
        $cumstomer->password = HasH::make($request->password);
        $cumstomer->save();
        if ($cumstomer) {
            return response()->json(['success' => 'Password Update Successfully'], 200);   
        }
    }


    public function order(){
        if($this->respondWithToken($this->guard()->user())){

            return response()->json($this->guard()->user());
        }
    } 

    public function orderRecord($id){
        $order = Order::where('customer_id', $id)->latest()->get();
        return response()->json([
            'data'=>$order
         ], 200);
    }

    public function orderDetails($id){
        $orderDetails = Order::with('orderDetails')->where('id', $id)->first();
        return response()->json([
            'data'=>$orderDetails
        ], 200);
    }


    public function orderCancel($id){
        $order = Order::find($id);
        $orderDetails = OrderDetails::where('order_id',$id)->get();
        foreach($orderDetails as $item){
            $product = Product::with('inventory')->where('id',$item->product_id)->first();
            $product->inventory->purchage = $product->inventory->purchage + $item->quantity;
            $product->inventory->sales = $product->inventory->sales - $item->quantity;
            $product->inventory->save();
        }
        
        $order->status = 'c';
     
        $order->save();
      
        return response()->json(['success' => 'successfully order cancel']); 
    }



    public function forgetPasswordOtpSend(Request $request)
    {
        // $otp = rand(1000,9999);
        $exit_number = Customer::where('phone', $request->phone)->first();

        if ($exit_number) {
            $otp = rand(1000, 9999);
            $exit_number->otp = $otp;
            $exit_number->save();
            Session::put('phone', $request->phone);
            // $message = "Zenevia password reset otp is $otp";
            $message = "অনুগ্রহ করে আপনার পাসওয়ার্ড রিসেট করুন $otp. এটা কাউকে শেয়ার করবেন না";
            $this->send_sms($request->phone, $message);
            // dd($message);
           
                return response()->json(['success' => 'Send Forget Password Otp'], 200);   
          
        } else {
            return response()->json(['opps' => 'Opps Your Phone Number not match with any racord'], 200);   
        }
    }


    public function otpMatchForgetPassword(Request $request)
    {
        // dd($request->all());
        $phone = $request->phone;
        $otp = $request->otp;
        $customer = Customer::where('phone', $phone)->where('otp', $otp)->first();
       if($customer){
            return response()->json(['success' => 'Otp match'], 200);   
       }else{
        return response()->json(['opps' => 'Invalid Code'], 200);  
       }
    }



    public function forgetpasswordUpdate(Request $request)
    {
        // $request->validate([
        //     'password' => 'required|min:1|same:confirmed',
        // ]);
        $customer = Customer::where('phone', $request->phone)->first();
        if ($customer != NULL) {
            $customer->password = Hash::make($request->password);
            $customer->save();

            return response()->json(['success' => 'Successfully password change'], 200);   
        } else {
            return response()->json(['success' => 'Opps Faild to Update Password'], 200);   
        }
    }
}
