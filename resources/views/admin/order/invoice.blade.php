@extends('layouts.admin');
@section('admin-content')   
@push('admin-css')
<style>
  #printable{
    display: none !important;
  }
 @media print
  {
      /* #non-printable { display: none; }
      #printable { display: block !important; } 
      .card-border{
        border:none !important;
      }
      p{
        font-size: 25px;
      } */
      table{
        border-collapse: collapse;
      }
      tr,td,th{
        border: 1px solid #000 !important;
      }

     
  }
</style>
@endpush     
  <div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
              <div class="heading-title p-2 my-2">
                <span class="my-3 heading "><i class="fas fa-home"></i> <a class="" href="{{route('admin.index')}}">Home</a> >Inovice Show</span>
              </div>
            </div>
        </div>
    </div>
</div>
<div class="container" >
  <div style=" margin: auto;" >
    <div class="row">
        <div class="col-xs-12">
            <div class="card mb-3 px-2" >
                <div class="card-body " id="printableArea">
                  <p style="text-align:right;font-weight:bold:padding:0;margin:0" id="copy">Office Copy</p>
                    <div>
                      <div style="display:flex">
                        <div class="logo-img" style="width: 50%">
                          <img src="{{asset($content->logo)}}" alt="logo" style="height: 100px;width:100px">
                        </div>
                        <div style="width: 50%">
                          <h3 style="text-align: right; margin:15px 0px;float:right;font-size:12px">Invoice &nbsp;&nbsp;#{{ $order->invoice_no }}</h3>
                        </div>
                      </div>
                      
                      <hr class="mt-1 mb-1">
                    </div>
                    <div style="display: flex;width:100%;font-size:12px">
                      <div style="width: 30%;">
                        <p class="mt-2 mb-2"><b>{{ $content->company_name }}</b></p>
                        <p>{{ $content->address }}</p>
                      </div>
                      <div style="width: 70%;">
                        <p style="text-align: right;"><b>Invoice to</b></p>
                        <p style="text-align: right; margin-bottom:0"><strong>Name: </strong>{{ $order->customer_name }}<br><strong>Phone:</strong> {{ $order->customer_mobile }}</p>
                       
                        <p style="text-align: right; margin-bottom:0">
                        <strong> Billing Address:</strong> {{ $order->billing_address }}</p>
                        <p style="text-align: right; margin-bottom:0">
                          @if ($order->shipping_address != Null)
                            <strong> Shipping Address:</strong>  {{ $order->shipping_address }}
                          @else
                          @endif
                      </p>
                      </div>
                    </div>
                    <div style="justify-content: space-between;">
                      <div class="col-xs-5 pl-0">
                        <p style="margin-bottom:5px">Invoice Date : {{ $order->created_at }} ; <span> <b>@if(isset($order->thana->name)){{$order->thana->name}} - {{$order->area->name}} @endif</b></span>;<span><strong> Delivery Date : </strong> 
                          @if(isset($order->delivery_date))
                            {{$order->delivery_date}}
                           @endif</span>;
                          <span><strong> Delivery Time : </strong> 
                            @if(isset($order->deliveryTime->time))
                            {{$order->deliveryTime->time}}
                            @endif</span>
                        </p>
                      </div>
                    </div>
                    <div class="">
                          <table style="border-collapse: collapse;width: 100%;font-size:13px;border:1px solid #000">
                            <thead style=" padding:10px;">
                              <tr style="boder:1px solid #000">
                                  <th style="padding:10px; ">#</th>
                                  <th style="padding:10px;text-align:left;">Product Name</th>
                                  <th style="padding:10px; text-align:center;">Quantity</th>
                                  <th style="text-align: center; padding:10px;">Per Cost</th>
                                  <th style="text-align: center; padding:10px;">Offer Price</th>
                                  <th style="text-align: right; padding:10px;">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php
                                  $offerPrice = $order->orderDetails->sum('offer_price');
                                  $totalPrice  =$order->total_amount;
                                   $percent = $offerPrice*100/ $totalPrice;
                                ?>
                              @foreach ($order->orderDetails as $key=> $item)
                              <tr style="text-align: right; ">
                                <td style="text-align: center; padding:5px; font-size:13px">{{ $key+1 }}</td>
                                <td style="text-align: left; padding:5px; font-size:13px">@if(isset( $item->offer_price)){{ $item->product_name }} (1 Product get Offer) @else {{ $item->product_name }} @endif</td>
                                <td  style="text-align:center; padding:5px; font-size:13px">{{ $item->quantity }} </td>
                                <td  style="text-align:center; padding:5px; font-size:13px"> {{ $item->price }} Tk </td>
                                <td style="text-align: center; padding:5px; font-size:13px">@if(isset( $item->offer_price)){{ $item->offer_price }} Tk @endif</td>
                                <td style="text-align: right; padding:5px; font-size:13px">{{$item->price * $item->quantity  }} Tk</td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                        
                    </div>
                    <div>
                        <span id="word" ></span>
                      <div class="d-flex mt-3">
                          <div class="">
                            @isset($order->pending_msg)
                            <p> <b>Process Message :</b> {{$order->pending_msg}}</p>
                            @endisset
                            @isset($order->process_msg)
                            <p> <b>On Process Message Message :</b> {{$order->process_msg}}</p>
                            @endisset
                            @isset($order->way_msg)
                            <p> <b>On the Way Message :</b> {{$order->way_msg}}</p>
                            @endisset
                            @isset($order->cancel_msg)
                            <p> <b>Cancel Message :</b> {{$order->cancel_msg}}</p>
                            @endisset
                           
                            
                          </div>
                          <div class="ms-auto">
                           
                            <p  style="text-align: right;margin-bottom:0; margin-top:10px"><span style="font-weight:600">Sub Total :</span>  {{ $order->orderDetails->sum('total_price') }} Tk</p>
                            <p  style="text-align: right;margin-bottom:0; margin-top:10px"><span style="font-weight:600">Offer :</span>  {{ round($percent, 2) }} %</p>
                            <p  style="text-align: right;margin-bottom:15px"><span style="font-weight:600;  ">Shipping :</span>  {{ $order->shipping_cost }} Tk</p>
                            <h4 style="text-align: right; font-weight:700"><span>Total :</span><span id="number"> {{ $order->total_amount }}  </span> Tk</h4>
                            <hr >
                          </div>
                      </div>
                        
                    </div>
                   
                    
            </div>

            <div class="container-fluid w-100 mb-3" >
              <button href="#"  onclick="printDiv('printableArea')" class="btn btn-primary btn-sm float-right ml-2"><i class="fa fa-print mr-1"></i>Print</button>
            </div>
            
        </div>
    </div>
  </div>
    
@endsection
@push('admin-js')
      <script>
          function printDiv(divName) {
          var printContents = document.getElementById(divName).innerHTML;
          var originalContents = document.body.innerHTML;
          document.body.innerHTML = printContents;
          window.print();
          document.body.innerHTML = originalContents;
          let copy = $('#copy').text('Customer Copy')
          var printContents = document.getElementById(divName).innerHTML;
          var originalContents = document.body.innerHTML;
          document.body.innerHTML = printContents;
          window.print();
          document.body.innerHTML = originalContents;
      }
      </script>

  @endpush