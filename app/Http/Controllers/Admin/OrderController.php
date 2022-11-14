<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Permission;
use App\Models\Product;
use App\Models\Size;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{

    // default data pending
    public function index()
    {
         $orders = Order::where('status', 'p')->latest()->get();
         $total =  Order::where('status', 'p')->latest()->get()->sum('total_amount');
        return view('admin.order.index', compact('orders','total'));
    }
    public function orderOfferPending(){
        $total =  Order::where('status', 'op')->latest()->get()->sum('total_amount');
        $orders = Order::where('status', 'op')->orderBy('updated_at','DESC')->get();
        return view('admin.order.op', compact('orders','total'));
    }
   
    // on Process 
    public function onProcess()
    {
        $total =  Order::where('status', 'on')->latest()->get()->sum('total_amount');
        $orders = Order::where('status', 'on')->orderBy('updated_at','DESC')->get();

        return view('admin.order.onprocess', compact('orders','total'));
    }
     // on Process2 
     public function onProcess2()
     {
         $total =  Order::where('status', 'off_pro')->latest()->get()->sum('total_amount');
         $orders = Order::where('status', 'off_pro')->orderBy('updated_at','DESC')->get();
 
         return view('admin.order.off_onprocess', compact('orders','total'));
     }
    // on ontheWay 
    public function ontheWay()
    {
        $total =  Order::where('status', 'w')->latest()->get()->sum('total_amount');
        $orders = Order::where('status', 'w')->orderBy('updated_at','DESC')->get();
        return view('admin.order.way', compact('orders','total'));
    }
     // on ontheWay 
     public function ontheWay2()
     {
         $total =  Order::where('status', 'off_way')->latest()->get()->sum('total_amount');
         $orders = Order::where('status', 'off_way')->orderBy('updated_at','DESC')->get();
         return view('admin.order.off_way', compact('orders','total'));
     }

     public function waitingDelivered(){
        $total =  Order::where('status', 'wd')->latest()->get()->sum('total_amount');
        $orders = Order::where('status', 'wd')->orderBy('updated_at','DESC')->get();
        return view('admin.order.waiting_delivered', compact('orders','total'));
     }
     public function waitingDeliveredOne(){
        $total =  Order::where('status', 'wd_1')->latest()->get()->sum('total_amount');
        $orders = Order::where('status', 'wd_1')->orderBy('updated_at','DESC')->get();
        return view('admin.order.wating_delivary_one', compact('orders','total'));
     }

     public function normaldelivered()
     { 
         $total =  Order::where('status', 'd')->orWhereNull('OfferStatus')->latest()->get()->sum('total_amount');
         $orders = Order::where('status', 'd')->orWhereNull('OfferStatus')->latest()->get();
         return view('admin.order.normal_delivary', compact('orders','total'));
     }
     public function shareSaleWay(){
         $total =  Order::where('status', 'Share Sale')->latest()->get()->sum('total_amount');
         $orders = Order::where('status', 'Share Sale')->latest()->get();
         return view('admin.order.share_sale_way', compact('orders','total'));
    }
    public function offerDeliveryList(){
        $total =  Order::where('status', 'd')->where('OfferStatus','Offer Delivery')->latest()->get()->sum('total_amount');
        $orders = Order::where('status', 'd')->where('OfferStatus','Offer Delivery')->latest()->get();
        return view('admin.order.offer_delivery_list', compact('orders','total'));
   }
  

    // sales report
    public function salesReport(Request $request){
        // $orders = Order::where('status', 'd')->get();
        // dd($request->all());
        
        $request->validate([
            'end_date' =>'date|after_or_equal:start_date'
        ]);

        $type = $request->type;
        $start_date = $request->start_date.' 00:00:00';
        $end_date = $request->end_date.' 23:59:59';
        $search = Order::with('orderDetails')->whereBetween('updated_at', [$start_date, $end_date])->where('status', 'd')->get();
         $total = $search->sum('total_amount');
        return view('admin.order.sales', compact('search','type','total'));
    }

  

    // order pending function
    public function pending(Request $request,$id)
    {
        $order = Order::where('id',$id)->where('status','p')->first();
        $order->status = 'on';
        $order->updated_by = Auth::user()->id;
        $order->pending_msg = $request->message;
        $order->save();

        $customer = Order::where('customer_id',$order->customer_id)->first();
        $customer_phone = $customer->customer_mobile;
        $message = "আপনার অর্ডার এখন প্রক্রিয়াকরণ . আপনার চালান নম্বর $order->invoice_no ; $request->message  ";
        $this->send_sms($customer_phone ,$message);
        return back()->with('success', 'Order Confirm Successfully');
    }

    public function offerPending($id){
        $order = Order::where('id',$id)->first();
        $order->status = 'op';
        $order->updated_by = Auth::user()->id;
        
        $order->save();
        $customer = Order::where('customer_id',$order->customer_id)->first();
        $customer_phone = $customer->customer_mobile;
        $message = "আপনার অর্ডার এখন প্রক্রিয়াকরণ . আপনার চালান নম্বর $order->invoice_no ; ";
        $this->send_sms($customer_phone ,$message);
        return back()->with('success', 'Offer  Pending Successfully');
        
    }
    public function offerPending2(Request $request,$id){
        $order = Order::where('id',$id)->first();
        $order->status = 'off_pro';
        $order->updated_by = Auth::user()->id;
        $order->pending_msg = $request->message;
        $order->save();
        return back()->with('success', 'Offer  Pending Successfully');
        
    }

    public function shareSale($id){
        $order = Order::where('id',$id)->first();
        $order->status = 'Share Sale';
        $order->updated_by = Auth::user()->id;
        $order->save();
        return back()->with('success', 'Share Sale Successfully');
    }

   


   

    // order prodcess function
    public function process(Request $request, $id)
    {
        // dd($request->all());
        // Order::where('id', $id)->where('status', 'on')->update([
        //     'status' => 'w',
        // ]);
        $order = Order::where('id',$id)->where('status','on')->first();
        $order->status = 'w';
        $order->updated_by = Auth::user()->id;
        $order->process_msg = $request->message;
        $order->save();

        $admin_msg = $request->message;
        $customer = Order::where('customer_id',$order->customer_id)->first();
        $customer_phone = $customer->customer_mobile;
        $message = "আপনার  অর্ডারটি পথে আছে। আপনার চালান নম্বর $order->invoice_no. $admin_msg";
        $this->send_sms($customer_phone , $message);
        return back()->with('success', 'Order On the way');
    }
     // order prodcess function
     public function process2(Request $request, $id)
     {
         // dd($request->all());
         // Order::where('id', $id)->where('status', 'on')->update([
         //     'status' => 'w',
         // ]);
         $order = Order::where('id',$id)->where('status','off_pro')->first();
         $order->status = 'off_way';
         $order->updated_by = Auth::user()->id;
         $order->process_msg = $request->message;
         $order->save();
 
         $admin_msg = $request->message;
         $customer = Order::where('customer_id',$order->customer_id)->first();
         $customer_phone = $customer->customer_mobile;
         $message = "আপনার  অর্ডারটি পথে আছে। আপনার চালান নম্বর $order->invoice_no. $admin_msg";
         $this->send_sms($customer_phone , $message);
         return back()->with('success', 'Order On the way');
     }

     // order prodcess function
     public function wayProcess(Request $request,$id)
     {
       
        $order = Order::where('id',$id)->where('status','w')->first();
        $order->status = 'd';
        $order->way_msg = $request->message;
        $order->updated_by = Auth::user()->id;
        $order->save();
        $customer = Order::where('customer_id',$order->customer_id)->first();
        $customer_phone = $customer->customer_mobile;
        $message = "আপনার অর্ডারটি গ্রহণের অপেক্ষায়। আপনার চালান নম্বর। আপনার চালান নম্বর $order->invoice_no";   


        $this->send_sms($customer_phone , $message);   
         return back()->with('success', 'Order Delivery Confirm Successfully');
     }
     // order prodcess function
     public function wayProcess2(Request $request,$id)
     {
        //  Order::where('id', $id)->where('status', 'w')->update([
        //      'status' => 'd',
        //  ]);
        $order = Order::where('id',$id)->where('status','off_way')->first();
        $order->status = 'wd';
        $order->updated_by = Auth::user()->id;
        $order->way_msg = $request->message;
        $order->save();
        $customer = Order::where('customer_id',$order->customer_id)->first();
        $customer_phone = $customer->customer_mobile;
        // $message = "আপনার অর্ডারটি  গ্রহণ করেছেন । আপনার চালান নম্বর $order->invoice_no";   
        $message = "আপনার অর্ডারটি গ্রহণের অপেক্ষায়। আপনার চালান নম্বর $order->invoice_no";   


        $this->send_sms($customer_phone , $message);   
         return back()->with('success', 'Order Delivery Confirm Successfully');
     }

     public function watingDelivaryOne(Request $request,$id)
     {
       
        $order = Order::where('id',$id)->where('status','wd')->first();
        $order->status = 'dn';
        $order->way_msg = $request->message;
        $order->updated_by = Auth::user()->id;
        $order->save();
        $customer = Order::where('customer_id',$order->customer_id)->first();
        $customer_phone = $customer->customer_mobile;
        $message = "আপনার অর্ডারটি  গ্রহণ করেছেন । আপনার চালান নম্বর $order->invoice_no";   
        $this->send_sms($customer_phone , $message);   
         return back()->with('success', 'Order Delivery Confirm Successfully');
     }

     public function waitingDelivery($id){
        $order = Order::where('id',$id)->where('status','wd')->first();
        $order->status = 'd';
        $order->OfferStatus = 'Offer Delivery';
        $order->updated_by = Auth::user()->id;
        $order->save();
        $customer = Order::where('customer_id',$order->customer_id)->first();
        $customer_phone = $customer->customer_mobile;
        $message = "আপনার অর্ডারটি  গ্রহণ করেছেন । আপনার চালান নম্বর $order->invoice_no"; 
        $this->send_sms($customer_phone , $message);   
         return back()->with('success', 'Order Delivery Confirm Successfully');
     }
      // order delete function
     public function destroy($id){
        $order = Order::find($id);
        $orderDetails = OrderDetails::where('order_id',$id)->get();
        foreach($orderDetails as $item){
            $product = Product::with('inventory')->where('id',$item->product_id)->first();
            $product->inventory->purchage = $product->inventory->purchage + $item->quantity;
            $product->inventory->sales = $product->inventory->sales - $item->quantity;
            $product->inventory->save();
        }
        $order->status = 'c';
        $order->updated_by = Auth::user()->id;
        $order->save();
        $customer = Order::where('customer_id',$order->customer_id)->first();
        $customer_phone = $customer->customer_mobile;
        $message = "আপনার অর্ডারটি বাতিল করা হয়েছে, আপনার চালান নম্বর $order->invoice_no ";
        $this->send_sms($customer_phone , $message);  

        return back()->with('success', 'Order cancel successfully');
     }
      // on delivery done 
      public function delivered()
      {
         $total =  Order::where('status', 'd')->latest()->get()->sum('total_amount');
          $orders = Order::where('status', 'd')->latest()->get();
          return view('admin.order.delivered', compact('orders','total'));
      }
    // order details edit function
    public function orderDetails($id)
    {
        $colors = Color::all();
        $sizes = Size::all();
        $orderDetails = OrderDetails::where('order_id', $id)->get();
        return view('admin.order.details', compact('orderDetails', 'colors', 'sizes'));
    }

    // order cancel function
    public function cancel($id)
    {
       $order =  Order::where('id', $id)->update([
            'status' => 'p',
        ]);
        $customer = Order::where('customer_id',$order->customer_id)->first();
        $customer_phone = $customer->customer_mobile;
        $message = "আপনার অর্ডারটি বাতিল করা হয়েছে, আপনার চালান নম্বর $order->invoice_no ";
        $this->send_sms($customer_phone , $message);
        return redirect()->route('order.index')->with('success', 'Delivery Order Cancel Confirm Successfully');
    }

    // order print function
    public function orderPrint($id)
    {
        $orderDetails = OrderDetails::where('order_id', $id)->get();
        return view('admin.order.print', compact('orderDetails'));
    }

    public function orderEdit(Request $request, $id)
    {
        try {
            $order              = OrderDetails::where('id', $id)->first();
            $order->quantity    = $request->quantity;
            $order->color_id    = $request->color_id;
            $order->size_id     = $request->size_id;
            $product            = Product::where('id', $order->product_id)->first();
            $order->total_price = (int)$request->quantity * (int)$product->price;
            $order->save();

            $orderTotalPrice             = orderDetails::where('order_id', $order->order_id)->get()->sum('total_price');
            $order_balance               = Order::where('id',$order->order_id)->first();
            $order_balance->total_amount = $orderTotalPrice + $order_balance->shipping_cost;
            $order_balance->save();
           

        } catch (\Throwable $th) {
            //throw $th;
        }
        


        return back()->with('success', 'Order updated successfully');
    }
    
    public function prodcutOrderCancel($id)
    {
        OrderDetails::where('id', $id)->delete();
        return back()->with('success', 'Product Order Delete successfully');
    }

    public function orderRecord(){
        $start_date = '';
        $end_date = '';
        $product_id = '';
        $product = Product::all();
        return view('admin.order.productSales',compact('product','start_date','end_date','product_id'));
    }
    public function orderRecordSearch(Request $request){
        
        $start_date = $request->start_date.' 00:00:00';
        $end_date = $request->end_date.' 23:59:59';
        $product_id = $request->product_id;
       
        $product = Product::all();
        $orderDetails = OrderDetails::with('order')->where('product_id',$product_id)->whereBetween('created_at', [$start_date, $end_date])->get();
        
        
        return view('admin.order.productSales',compact('start_date','end_date','orderDetails','product','start_date','end_date','product_id'));
    }

    public function cancelList(){
        $total =  Order::where('status', 'c')->latest()->get()->sum('total_amount');
        $orders = Order::where('status','c')->latest()->get();
        return view('admin.order.cancel',compact('orders','total'));
    }
    public function OfferorderDelivery($id,Request $request){
        $order = Order::where('id', $id)->first();
        $order->status = 'd';
        $order->OfferStatus = 'Offer Delivery';
        $order->updated_by =  Auth::user()->id;
        $order->share_sale_msg =  $request->message;
        $order->save();
        $customer_phone = $order->customer_mobile;
        $message = " আপনার অনুরোধে আপনার অর্ডারটি অফার ডেলিভারী করা  হয়েছে, আপনার চালান নম্বর $order->invoice_no $request->message";
        $this->send_sms($customer_phone , $message);
        return back()->with('success','successfully cancel to pending list');
    }

    public function canceltoPending(Request $request,$id){
        // dd($request->all());
        $order = Order::where('id', $id)->first();
        $order->status = 'p';
        $order->updated_by =  Auth::user()->id;
        $order->cancel_msg =  $request->message;
        $order->save();
        $customer_phone = $order->customer_mobile;
        $message = " আপনার অনুরোধে আপনার অর্ডারটি পেন্ডিং এ পাঠানো হয়েছে, আপনার চালান নম্বর $order->invoice_no $request->message";
        $this->send_sms($customer_phone , $message);
        return back()->with('success','successfully cancel to pending list');
    }
    public function orderProductDelete($id){
        $orderDetails = OrderDetails::where('id',$id)->first();
        $order_id = $orderDetails->order_id;
        $orderDetails->delete();
        $orderTotalPrice  = orderDetails::where('order_id', $order_id)->get()->sum('total_price');
        $order = Order::where('id',$orderDetails->order_id)->first();
         $order->total_amount = $orderTotalPrice + $order->shipping_cost;
        $order->save();
        
        return back()->with('success','Product deleted successfully');
    }




    // customer delete invoice

    public function deleteInvoiceList()
    {
         $orders = Order::where('customerDelete', 'd')->latest()->get();
         $total =  Order::where('customerDelete', 'd')->latest()->get()->sum('total_amount');
        return view('admin.order.customerDelete', compact('orders','total'));
    }

    public function orderSoftDelete($id){
        Order::where('id',$id)->delete();
        OrderDetails::where('order_id',$id)->delete();
        return back()->with('success','Order deleted successfully');
       
    }

}
