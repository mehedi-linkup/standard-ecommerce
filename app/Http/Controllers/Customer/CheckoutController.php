<?php

namespace App\Http\Controllers\Customer;

use Exception;
use Carbon\Carbon;
use App\Models\Area;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Thana;
use App\Models\Country;
use App\Models\Product;
use App\Models\District;
use App\Models\Inventory;
use Darryldecode\Cart\Cart;
use Illuminate\Support\Str;
use App\Models\DeliveryTime;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use App\Models\CompanyProfile;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $today = date("D");
        if($today == 'Sat'){
            $time = DeliveryTime::where('group_id',1)->get();
        }
        elseif($today == 'Sun'){
            $time = DeliveryTime::where('group_id',2)->get();
        }
        elseif($today == 'Mon'){
            $time = DeliveryTime::where('group_id',3)->get();
        }
        elseif($today == 'Tue'){
            $time = DeliveryTime::where('group_id',4)->get();
        }
        elseif($today == 'Wed'){
            $time = DeliveryTime::where('group_id',5)->get();
        }
        elseif($today == 'Thu'){
            $time = DeliveryTime::where('group_id',6)->get();
        }
        else{
            $time = DeliveryTime::where('group_id',7)->get();
        }

        $sum = 0;
        $price = 0;
        if (Auth::guard('customer')->check()) {
                $offer_product = Product::where('is_offer','1')->get()->pluck('id')->toArray();
                
                $data = DB::table('orders')
                        ->join('order_details',function($join){
                            $join->on('orders.id','=','order_details.order_id')
                            ->where('order_details.customer_id',Auth::guard('customer')->user()->id);
                        })
                        ->get();
                $total_offer_buy = $data->sum('quantity');
                $offer_limit = (int) Offer::first()->offer_limit_qty;
                $available_qty = $offer_limit - $total_offer_buy;  


            $area = Area::latest()->get();
            $thana = Thana::latest()->get();
            $product = Product::where('is_offer','>','0')->get();
            $sum = 0;
            $offer_product = Product::where('is_offer','1')->get()->pluck('id')->toArray();
            // dd($offer_product);
            
             $exist_order_tables =OrderDetails::where('customer_id',Auth::guard('customer')->user()->id)->whereDate('created_at', Carbon::today())->get()->pluck('product_id')->toArray();
            
            // return \Cart::getContent();
            foreach (\Cart::getContent() as $value) {                                    
                        $id = $value->id;
                        $product = Product::with('inventory')->where('id',$id)->first();
                        $stock = $product->inventory->purchage;
                        if($stock >= $value->quantity){
                            if(in_array($value->id, $offer_product)){
                    
                                if(in_array($value->id,$exist_order_tables)){
                                    
                                       
                                        $price = $value->price* $value->quantity;
                                        $offer_price = '';
                                        foreach (\Cart::getContent() as $item) {
                                            
                                            if($item->id == $value->id){
                                                $id = $value->id;
                                                $product = Product::with('inventory')->where('id',$id)->first();
                                                $stock = $product->inventory->purchage;
                                                if($stock >= $value->quantity){
                                                    
                                                    $item['attributes']['sum'] = $price;
                                                    
                                                }
                                                $sum += $price;
                                            }
                                            else {
                                                $sum += '0';
                                            }
                                           }
                                    
                                   
                                       
                                    continue;
                                }
                                else{
                                    // dd('nai');
                                    if($value->quantity >1){
                                        $discount_product =  Product::where('id',$value->id)->first();
                                        $discount = $value->price/100*$discount_product->discount;
                                        $discount_price = $discount_product->price - $discount;
                                        foreach (\Cart::getContent() as $item) {
                                           if($item->id == $value->id){
                                            $id = $value->id;
                                            $product = Product::with('inventory')->where('id',$id)->first();
                                            $stock = $product->inventory->purchage;
                                            if($stock >= $value->quantity){
                                               
                                                $item['attributes']['sum'] = $discount_price;
                                                $item['attributes']['offer_price'] = $discount_price;
                                                $item['attributes']['quantity'] = '1';
            
                                            }
                                             
                                           }
                                          }
                                        $exist_qty = $value->quantity - 1;
                                        $second_price = $value->price * $exist_qty;
                                        $price = $discount_price + $second_price;
                                        $without_discount_price = $price -  $item['attributes']['offer_price'] = $discount_price;
                                        $sum += $price;
                                        foreach (\Cart::getContent() as $item) {
                                            if($item->id == $value->id){
                                                $id = $value->id;
                                                $product = Product::with('inventory')->where('id',$id)->first();
                                                $stock = $product->inventory->purchage;
                                                if($stock >= $value->quantity){
                                                    $item['attributes']['sum'] += $second_price;
                                                    $item['attributes']['exist_qty'] = $exist_qty;
                                                    $item['attributes']['price'] = $price-$second_price;
                                                    
                                                    $sum += $price;
                                                }
                                                else{
                                                    $sum += '0';
                                                }
                                               
                                            }
                                           }
                                        continue;
                                        
                                    }else{
            
                                        $discount_product = Product::where('id',$value->id)->first();
                                        $discount = $value->price/100*$discount_product->discount;
                                        $price = $discount_product->price - $discount;
                                        
                                        foreach (\Cart::getContent() as $item) {
                                            if($item->id == $value->id){
                                                $id = $value->id;
                                                $product = Product::with('inventory')->where('id',$id)->first();
                                                $stock = $product->inventory->purchage;
                                                if($stock >= $value->quantity){
                                                    $item['attributes']['sum'] = $price;
                                                    $item['attributes']['offer_price'] = $price;
                                                    $item['attributes']['quantity'] = '1';
                                                   
                                                    
                                                }
                                                $sum += $price;
                                            }
                                            else{
                                                $sum += '0';
                                            }
                                           }
                                           
                                        continue;                           
                                    
                                    }
                                }
                            
                            }
            
            
                            $price = $value->quantity * $value->price;
                            foreach (\Cart::getContent() as $item) {
                                if($item->id == $value->id){
                                    $item['attributes']['sum'] = $price;
                                    $sum += $price;
                                }
                                else{
                                    $sum += '0';
                                }
                               }
                            continue;
                        }
                
                
            } 
            $district = District::all();
            // dd($sum);
            return view('website.customer.checkout',compact('area','product','sum','price','thana','district','time'));
        } else {
            return redirect()->route('customer.login');
        }
    }

    public function orderStore(Request $request)
    {
    //    dd($request->all());
        if (Auth::guard('customer')->check()){
           
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

            
            try {
                DB::beginTransaction();
                $order = new Order();
                $order->invoice_no = $invoice_no;
                $order->customer_id = Auth::guard('customer')->user()->id;
                $order->customer_name = $request->customer_name;
                $order->customer_mobile = $request->customer_mobile;
                $order->customer_email = $request->customer_email;
                $order->area_id = $request->area_id;
                $order->shipping_address = $request->shipping_address;
                $order->billing_address = $request->billing_address;
                $order->shipping_cost = $area_amount;
                $order->total_amount = $request->total_amount + $area_amount;
                $order->order_note = $request->order_note;
                $order->delivery_date = $request->delivery_date;
                $order->thana_id = $request->thana_id;
                $order->time_id = $request->time_id;
                $order->ip_address = $request->ip();
                $order->save();

                $offer_product = Product::where('is_offer','1')->get()->pluck('id')->toArray();
                // dd($offer_product);
                $exist_order_tables =OrderDetails::where('customer_id',Auth::guard('customer')->user()->id)->whereDate('created_at', Carbon::today())->get()->pluck('product_id')->toArray();
            

                foreach (\Cart::getContent() as $value) {
                
                    if(in_array($value->id, $offer_product)){
                        
                        if(in_array($value->id,$exist_order_tables)){
                            $id = $value->id;
                            $product = Product::with('inventory')->where('id',$id)->first();
                           
                            $stock = $product->inventory->purchage;
                            if($stock >= $value->quantity){
                                $price = $value->price* $value->quantity;
                                $orderDetails                  = new OrderDetails();
                                $orderDetails->order_id        = $order->id;
                                $orderDetails->product_id      = $value->id;
                                $orderDetails->product_name    = $value->name;
                                $orderDetails->customer_id     = Auth::guard('customer')->user()->id;
                                $orderDetails->price           = $value->price;
                                $orderDetails->quantity        = $value->quantity;
                                $orderDetails->total_price     = $price;
                                $orderDetails->save();
                                $sum += $price;
    
                                $inventory           = Inventory::where('product_id',$value->id)->first();
                                $inventory->sales    = $value->quantity;
                                $inventory->purchage = $inventory->purchage - $value->quantity;
                                $inventory->sales    = $inventory->sales + $value->quantity;
                                $inventory->save();
                                continue;
                            }
                            
                           
                        }
                        else{
                            // dd('nai');
                            $id = $value->id;
                            $product = Product::with('inventory')->where('id',$id)->first();
                       
                             $stock = $product->inventory->purchage;
                            if($stock + 1 > $value->quantity){
                                if($value->quantity >1){
                                    $discount_product = Product::where('id',$value->id)->first();
                                    $discount = $value->price/100*$discount_product->discount;
                                    $discount_price               = $discount_product->price - $discount;
                                    $exist_qty                    = $value->quantity - 1;
                                    $second_price                 = $value->price * $exist_qty;
                                    $price                        = $discount_price + $second_price;
                                    $orderDetails                 = new OrderDetails();
                                    $orderDetails->order_id       = $order->id;
                                    $orderDetails->product_id     = $value->id;
                                    $orderDetails->product_name   = $value->name;
                                    $orderDetails->customer_id    = Auth::guard('customer')->user()->id;
                                    $orderDetails->price          = $value->price;
                                    $orderDetails->offer_price    = $value->attributes->offer_price;
                                    $orderDetails->offer_quantity = $value->attributes->quantity;
                                    $orderDetails->quantity       = $value->quantity;
                                    $orderDetails->total_price    = $price ;
                                    $orderDetails->save();
                                    $inventory                    = Inventory::where('product_id',$value->id)->first();
                                    $inventory->sales             = $value->quantity;
                                    $inventory->purchage          = $inventory->purchage - $value->quantity;
                                    $inventory->sales             = $inventory->sales + $value->quantity;
                                    $inventory->save();
                                    $sum += $price;
                                    continue;
                                    //  dd('offer 1 er beshi');
                            }
                            
                                
                            
                            }else{
                                // dd('1 order ache');
                                $id = $value->id;
                                $product = Product::with('inventory')->where('id',$id)->first();
                               
                                   $stock = $product->inventory->purchage;
                                if($stock >= $value->quantity){
                                    $discount_product            = Product::where('id',$value->id)->first();
                                    $discount                    = $value->price/100*$discount_product->discount;
                                    $price                       = $discount_product->price - $discount;
                                    $orderDetails                = new OrderDetails();
                                    $orderDetails->order_id      = $order->id;
                                    $orderDetails->product_id    = $value->id;
                                    $orderDetails->product_name  = $value->name;
                                    $orderDetails->customer_id   = Auth::guard('customer')->user()->id;
                                    $orderDetails->offer_price   = $value->attributes->offer_price;
                                    $orderDetails->price         = $value->price;
                                    $orderDetails->quantity      = $value->quantity;
                                    $orderDetails->offer_quantity= $value->attributes->quantity;
                                    $orderDetails->total_price   = $price;
                                    $orderDetails->save();
                                    $sum += $price;
                                    $inventory            = Inventory::where('product_id',$value->id)->first();
                                    $inventory->sales     = $value->quantity;
                                    $inventory->purchage  = $inventory->purchage - $value->quantity;
                                    $inventory->sales     = $inventory->sales + $value->quantity;
                                    $inventory->save();
    
                                    // dd('offer 1 ');
                                    continue;
                                }
                              
                                
                            
                            }
                        }
                    
                    }
                    
                            $id            = $value->id;
                            $product       = Product::with('inventory')->where('id',$id)->first();
                           
                            $stock         = $product->inventory->purchage;
                            
                            if($stock >= $value->quantity){
                                $orderDetails                = new OrderDetails();
                                $orderDetails->order_id      = $order->id;
                                $orderDetails->product_id    = $value->id;
                                $orderDetails->product_name  = $value->name;
                                $orderDetails->customer_id   = Auth::guard('customer')->user()->id;
                                $orderDetails->price         = $value->price;
                                $orderDetails->quantity      = $value->quantity;
                                $price                       = $value->quantity * $value->price;
                                $orderDetails->total_price   = $price;
                                $orderDetails->save();
                                $sum += $price;
                                $inventory                   = Inventory::where('product_id',$value->id)->first();
                                $inventory->purchage         = $inventory->purchage - $value->quantity;
                                $inventory->sales            = $inventory->sales + $value->quantity;
                                $inventory->save();
                                continue;
                                
                            }
                   
                    
                }

                $order2 = Order::where('id',$order->id)->first();
                $order2->total_amount = $sum + $area_amount;
                $order2->save();
                if($sum<1){
                  Order::where('id',$order->id)->delete();
                  $customer_phone     = Auth::guard('customer')->user()->phone;
                  $name               = Auth::guard('customer')->user()->name;
                  $customer_id        = Auth::guard('customer')->user()->code;
                  $message            = "$name .Sorry! Your order product out of stock. Your are most valuable for us. ";
                  
                  $this->send_sms($customer_phone , $message);
                  DB::commit();
                  Session::flash('error', 'order submit failed');
                  \Cart::clear();
                  return redirect()->route('home');
                }else{
                    $company            = CompanyProfile::first();
                    $admin_phone        = $company->phone_3;
                    $admin_phone_2      = $company->phone_4;
                    $admin_phone_3      = $company->phone_5;
                    $customer_phone     = Auth::guard('customer')->user()->phone;
                    $name               = Auth::guard('customer')->user()->name;
                    $customer_id        = Auth::guard('customer')->user()->code;
                    $msg                = " Order submit  $name . Invoice No. $order->invoice_no";
                    $message            = "$name .Your order submited successfully. Invoice No. $order->invoice_no";
                    $this->send_sms($admin_phone , $msg);
                    $this->send_sms($admin_phone_2 , $msg);
                    $this->send_sms($admin_phone_3 , $msg);
                    $this->send_sms($customer_phone , $message);
                    DB::commit();
                    Session::flash('message', 'order Submit successfully');
                    \Cart::clear();
                    return redirect()->route('home');
                    
                }

               
                // if($sum<1){
                //     DB::commit();
                // }
             
               

            } 
            catch (Exception $e) {
                DB::rollBack();
                Session::flash('faild', 'order Submit faild');
                return back();
            }

        }
        else{
            return redirect()->route('customer.login');
        }

    }
}
