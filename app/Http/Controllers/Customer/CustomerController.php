<?php

namespace App\Http\Controllers\Customer;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\District;
use App\Models\OrderDetails;
use App\Models\Thana;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class CustomerController extends Controller
{
    
    public function customer()
    {
        if (Auth::guard('customer')->check()){
            Session::flash('message', 'You have already login');
            return redirect()->route('checkout.user');
        }
        else{
            return view('website.customer.login');
        }
        
    }

    public function AuthCheck(Request $request)
    {
        $request->validate([
            'userphone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11',
            'password' => 'required',
            
        ]);
        $credential = $request->only('password');
        $credential['phone'] = $request->userphone;
        if (Auth::guard('customer')->attempt($credential)) {
            session()->flash('message', 'Login Successfully !');
            // return redirect()->route('customer.panel');
             return redirect()->route('checkout.user');
            // return back();

        } else {
            Session::flash('error', 'Mobile number or password not match');
            return redirect()->back();
        }

    }
    public function signUp(){
        if (Auth::guard('customer')->check()){
            Session::flash('message', 'You have already login');
            return redirect()->route('checkout.user');
        }
        else{
            $district = District::all();
            $thana = Thana::all();
            $area = Area::all();
            return view('website.customer.signup',compact('district','thana','area'));
        }
        
    }

    public function customerStore(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => 'required|min:3|max:100',
            'phone' => 'required|unique:customers|regex:/^01[13-9][\d]{8}$/|min:11',
            'password' => 'required|string|min:1',
            'district_id' => 'required',
            'thana_id' => 'required',
            'area_id' => 'required',
            'ip_address' => 'max:15'
        ]);
        $otp = rand(1000,9999);
        $message = "জেনিভিয়া এক্সপ্রেস শপ অ্যাকাউন্ট রেজিস্টার পিন $otp .দয়া করে এটা শেয়ার করবেন না।";
        $customer = new Customer();
        $code = 'C' . $this->generateCode('Customer');
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->district_id = $request->district_id;
        $customer->thana_id = $request->thana_id;
        $customer->area_id = $request->area_id;
        $customer->username = $request->phone;
        $customer->password = Hash::make($request->password);
        $customer->ip_address = $request->ip();
        $customer->code = $code;
        $customer->save_by = 0;
        $customer->otp = $otp;
        $customer->updated_by = 0;
        $customer->save();
        $phone = $customer->phone;
        if($customer){
            $this->send_sms($phone, $message);
            Session::put('phone', $phone);
            return redirect()->route('customer.otp')->with('success','PIN sent successfully your mobile number.Don`t refresh the page');
        }
    }
    public function acccountOpenOtp(){
        return view('website.customer.register_otp');
    }
    public function acccountOpenOtpStore(Request $request){
       $phone = $request->phone;
       $otp = $request->otp;
       $customer = Customer::where('phone',$phone)->where('otp',$otp)->first();
       if($customer){
        $customer->isVerified = '1';
         $customer->save();
        session()->flash('message', ' Successfully created your account  !');
         return redirect()->route('customer.panel');
       }
       else{
        return back()->with('error','Otp or mobile number wrong');
       }
       
       
    }

    public function registerResendOtp(){
        if (Auth::guard('customer')->check()){
            $otp = rand(1000,9999);
            $phone =  Auth::guard('customer')->user()->phone;
             $customer = Customer::where('phone',$phone)->first();
             $customer->otp = $otp;
             $customer->save();
            $message = "Please, reset your password by $otp. Don't share this anyone";
            $this->send_sms($phone , $message);
            return redirect()->route('customer.otp');
        }
    }

      public function customerUpdate(Request $request)
    {
        if (Auth::guard('customer')->check()){
            $this->validate($request, [
                'name' => 'required|max:100',
                'phone' => 'required|unique:customers,id|max:11',
                'email' => 'required|unique:customers,id|max:50',
                'address' => 'required',
                'ip_address' => 'max:17'
            ]);
            $customer = Customer::where('id',Auth::guard('customer')->user()->id)->first();
            $customerImage = '';
            
            if ($request->hasFile('profile_picture')) {
                $image_path = public_path('uploads/customer/' . $customer->profile_picture);
                $image_path_thumb = public_path('uploads/customer/' . $customer->thum_picture);
                if (file_exists($image_path)) {
                    @unlink($image_path);
                    $Image = $request->file('profile_picture');
                    $newImage = rand(0000, 9999) . $Image->getClientOriginalName();
                    Image::make($Image)->save('uploads/customer/' . $newImage);
                    $customer->profile_picture = $newImage;
                }
                if (file_exists($image_path_thumb)) {
                    @unlink($image_path_thumb);
                    $Image = $request->file('profile_picture');
                    $newImage = rand(0000, 9999) . $Image->getClientOriginalName();
                    Image::make($Image)->save('uploads/customer/' . $newImage);
                    $customer->thum_picture = $newImage;
                }
            }
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            $customer->save();
            if ($customer) {
                Session::flash('message', 'Profile Update Successfully');
                return redirect()->back();
            } else {
                Session::flash('error', 'Profile Update fail');
                return back();
            }
        }
        
    }

    public function customerPasswordUpdate(Request $request)
    {
     
      
        $request->validate([
            'currentPass' => 'required',
            'password' => 'required|min:4|same:confirmed',
        ]);
        $currentPassword = Auth::guard('customer')->user()->password;
        if (Hash::check($request->currentPass, $currentPassword)) {
            if (!Hash::check($request->password, $currentPassword)) {
                $customer = Customer::find(Auth::guard('customer')->id());
                $customer->password = HasH::make($request->password);
                $customer->save();
                if ($customer) {
                    Session::flash('success', 'Password Update Successfully');
                    // Auth::guard('customer')->logout();
                    return back();
                } else {
                    Session::flash('error', 'Current password not match');
                    return back();
                }
            } else {
                Session::flash('error', 'Same as Current password');
                return back();
            }
        } else {
            Session::flash('error', '!Current password not match');
            return back();
        }
    }


    public function logout()
    {
        Auth::guard('customer')->logout();
        Session::flash('error', 'Logout Successfully');
        return redirect()->route('home');
    }

    public function customerPanel()
    {

        if (Auth::guard('customer')->check()) {
            $order = Order::with('orderDetails')->where('customer_id', Auth::guard('customer')->user()->id)->where('customerDelete', 'a')->latest()->get();
            return view('website.customer.dashboard', compact('order'));
        } else {
            return redirect()->route('home');
        }
    }


    public function invoice($id)
    {
        // return 'ok';
        if (Auth::guard('customer')->check()) {
            $total_amount = Order::where('id',$id)->first()->total_amount;
            $shipping_cost = Order::where('id',$id)->first()->shipping_cost;
            $order = OrderDetails::where('order_id', $id)->get();
            $invoice = Order::where('id',$id)->first();
            return view('website.customer.customer_invoice', compact('order','total_amount','shipping_cost','invoice'));
        } else {
            return redirect()->route('home');
        }
    }

    public function forgetPassword(){
        return view('website.customer.forgetPassword');
    }
    public function forgetPasswordStore(Request $request){
        // $otp = rand(1000,9999);
        $exit_number = Customer::where('phone',$request->phone)->first();
        
        if($exit_number){
            $otp = rand(1000,9999);
            $exit_number->otp = $otp;
            $exit_number->save();
            Session::put('phone', $request->phone);
            // $message = "Zenevia password reset otp is $otp";
            $message = "অনুগ্রহ করে আপনার পাসওয়ার্ড রিসেট করুন $otp. এটা কাউকে শেয়ার করবেন না";
            $this->send_sms($request->phone , $message);
            // dd($message);
            return redirect()->route('forget.password.form');
        }else{
            return back()->with('error',' Your Phone number or something wrong');
        }
}

  
    public function forgetResetPasswordForm(Request $request){

        return view('website.customer.forgetOtpForm');
    }
    public function forgetPasswordResetForm(){
        
        return view('website.customer.forgetPasswordResetForm');
    }
    public function forgetPassOtpCheck(Request $request){
        // dd($request->all());
        $phone = $request->phone;
        $otp = $request->otp;
        $customer = Customer::where('phone',$phone)->where('otp',$otp)->first();
        if($customer !=NULL){
            return redirect()->route('forget.password.reset.form');
        }
        else{
            return back()->with('error','your otp is wrong');
        }
     
    }

    public function forgetpasswordResetUpdate(Request $request){
        $request->validate([
            'password' => 'required|min:1|same:confirmed',
        ]);
        $customer = Customer::where('phone',$request->phone)->first();
        if($customer != NULL){
            $customer->password = Hash::make($request->password);
            $customer->save();
            
            return redirect()->route('customer.login')->with('success','Your password reset successfully');
        }
        else{
            return back()->with('error','Your password reset fail!');
        }


    }
}
