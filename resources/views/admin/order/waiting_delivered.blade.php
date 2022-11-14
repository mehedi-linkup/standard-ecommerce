@extends('layouts.admin')
@section('title', 'Waiting Delivered')
@section('admin-content')
<main>
    <div class="container">
        <div class="heading-title p-2 my-2">
            <span class="my-3 heading "><i class="fas fa-home"></i> <a class="" href="{{route('admin.index')}}">Home</a> >Waiting Delivered List</span>
        </div>
        <div class="card">
            <div class="card-header d-flex">
                <div class="table-head text-left"><i class="fas fa-table me-1"></i>Waiting Delivered List </div>
                <div class="mx-5"><b>Total: {{$total}}</b></div>
            </div>
            <div class="card-body table-card-body p-3">
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="home-tab">
                       <table id="first_table">
                            <thead class="text-center bg-light">
                                <tr>
                                    <th>Invoice No.</th>
                                    <th>Order Date</th>
                                    <th>Process Date</th>
                                    <th>Customer Id</th>
                                    <th>Customer Name</th>
                                    <th>Username</th>
                                    <th>Delivery Date & Time</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $key=> $order)
                                <tr class="text-center">
                                    <td>{{$order->invoice_no}}</td>
                                    <td>{{date('d M Y',strtotime($order->created_at))}}</td>
                                    <td>{{date('d M Y',strtotime($order->updated_at))}}</td>
                                    <td>@if(isset($order->customer->code)){{$order->customer->code}}@endif</td>
                                    <td>@if(isset($order->customer_name)){{$order->customer_name}}@endif</td>
                                    <td>@if(isset($order->user->name)){{$order->user->name}}@endif</td>
                                  
                                    <td>@if(isset($order->delivery_date)){{ $order->delivery_date}} @endif ,@if(isset($order->deliveryTime->time)) {{$order->deliveryTime->time}} @endif</td>
                                   <td>{{$order->total_amount}}</td>
                                    <td>
                                        @if(Auth::user()->action_process == 1)
                                            @if ($order->status == 'wd')
                                            <a href="{{route('waiting.delivery',$order->id)}}" onclick="return confirm('are you sure! Order now confirm')" class="btn btn-edit">Waiting Delivery</a>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-center">
                                       
                                            <form action="{{route('product.order.delete',$order->id)}}" method="post">
                                            @csrf
                                             @if(Auth::user()->action_view == 1)
                                            <a href="{{route('invoice.admin',$order->id)}}" class="btn btn-edit"><i class="fas fa-eye"></i></a>
                                             @endif
                                             @if(Auth::user()->action_delete == 1)
                                                <button href="" type="submit" class="btn btn-delete" title="Cancel" onclick="return confirm('Are you sure you want to cancel this order?');"><i class="fas fa-window-close"></i></button>
                                            @endif
                                        </form>
                                       
                                    </td>
                                </tr>
                                @endforeach
                            
                            </tbody>
                        </table>
                  </div>
                 
            </div>
        </div>
    </div>
@endsection
