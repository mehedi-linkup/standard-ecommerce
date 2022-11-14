@extends('layouts.admin')
@section('title', 'On Process')
@section('admin-content')
<main>
    <div class="container">
        <div class="heading-title p-2 my-2">
            <span class="my-3 heading "><i class="fas fa-home"></i> <a class="" href="{{route('admin.index')}}">Home</a> >Order List</span>
        </div>
        <div class="card">
            <div class="card-header d-flex">
                <div class="table-head text-left"><i class="fas fa-table me-1"></i>Cancel Order List </div>
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
                                    <th>Confirm Date</th>
                                    <th>Customer Id</th>
                                    <th>Customer Name</th>
                                    <th>Username</th>
                                    <th>Delivery Date & Time</th>
                                    <th>Price</th>
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
                                    <td>@if(isset($order->delivery_date)){{$order->delivery_date}}@endif</td>
                                    
                                    <td>{{$order->total_amount}}</td>
                                    
                                    <td class="text-center">
                                        @if(Auth::user()->action_process == 1)
                                            <a href="{{route('cancel.to.pending',$order->id)}}" class="btn btn-edit" onclick="canceltoPending({{$order->id}})"  data-bs-toggle="modal" data-bs-target="#myModal">Pending</a>
                                        @endif
                                        @if(Auth::user()->action_view == 1)
                                        <a href="{{route('invoice.admin',$order->id)}}" class="btn btn-edit"><i class="fas fa-eye"></i></a>
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

    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <form action="" id="modal-form" method="get">
                <!-- Modal Header -->
                <div class="modal-header">
                <h4 class="modal-title">Write Your message to customer</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
        
                <!-- Modal body -->
                <div class="modal-body">
                    <textarea name="message" id="" cols="30" rows="4" class="form-control"></textarea>
                </div>
        
                <!-- Modal footer -->
                <div class="modal-footer">
                <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Send</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    @push('admin-js')
    <script>
        function canceltoPending(id){
            var url = "/cancel-to-pending/"+id;
            $('#modal-form').attr('action',url);
        }
    </script>
@endpush
@endsection
