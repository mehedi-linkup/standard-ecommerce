@extends('layouts.admin')
@section('title', 'Pending Order')
@section('admin-content')
<main>
    <div class="container">
        <div class="heading-title p-2 my-2">
            <span class="my-3 heading "><i class="fas fa-home"></i> <a class="" href="{{route('admin.index')}}">Home</a> >Delivary List</span>
        </div>
        <div class="card">
            <div class="card-header d-flex">
                <div class="table-head text-left"><i class="fas fa-table me-1"></i>Deleverd Order List</div>
                <div class="mx-5"><b>Total: {{$total}}</b></div>
            </div>
            <div class="card-body table-card-body p-3">
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="pending">
                    <table id="first_table">
                        <thead class="text-center bg-light">
                            <tr>
                                <th>Invoice No.</th>
                                <th>Order Date</th>
                                <th>Delivary Date</th>
                                <th>Customer Id</th>
                                <th>Customer Name</th>
                                <th>Username</th>
                                <th>Delivery Date & Time</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Action</th>
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
                                <td>@if(isset($order->delivery_date)){{$order->delivery_date}} @endif ,@if(isset($order->deliveryTime->time)) {{$order->deliveryTime->time}} @endif</td>
                                
                                <td>{{$order->total_amount}}</td>
                                <td>
                                    @if ($order->status == 'd')
                                    <button class="btn btn-edit" disabled>Delivered</button>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if(Auth::user()->action_view == 1)
                                        <a href="{{route('invoice.admin',$order->id)}}" class="btn btn-edit"><i class="fas fa-eye"></i></a>
                                    @endif
                                    @if(Auth::user()->action_delete == 1)
                                        <button class="btn btn-delete" disabled><i class="fa fa-trash"></i></button>
                                    @endif
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
