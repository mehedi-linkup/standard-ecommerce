@extends('layouts.website')
@section('website-content')

<section class="py-3 middle-section">
    <h2 class="text-center text-success"> Customer Panel</h2>
     @if(Auth::guard('customer')->user()->status == 'a' && Auth::guard('customer')->user()->isVerified == '1')
    <div class="container">
        <div class="row justify-content-center">
                <ul class="nav nav-tabs " id="myTab " role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active tab-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="home" aria-selected="true">Profile</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link tab-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#setting" type="button" role="tab" aria-controls="profile" aria-selected="false">Setting</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link tab-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#order" type="button" role="tab" aria-controls="contact" aria-selected="false">Order History</button>
                    </li>
                </ul>
                  <br>
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="home-tab">
                        <form action="{{route('customerUpdate')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                        <div class="row pt-3">
                            
                            <div class="col-md-8">
                                <div class="form-group px-3 py-1 d-flex">
                                    <label for="" class="p-1 w-25" >Name<span class="text-danger ">*</span></label>
                                    <input type="text" name="name" class="form-control px-2" value="{{Auth::guard('customer')->user()->name}}" placeholder="Enter Name *" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror
                                </div>
                                <div class="form-group px-3 py-1 d-flex">
                                    <label for="" class="pb-1 w-25">Phone<span class="text-danger">*</span></label>
                                    <input type="text" name="phone" value="{{Auth::guard('customer')->user()->phone}}" class="form-control px-3" placeholder="Enter Phone Number *" required>
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                 @enderror
                                </div>
                                <div class="form-group px-3 py-1 d-flex">
                                    <label for="" class="pb-1 w-25">Email<span class="text-danger">*</span></label>
                                    <input type="email" name="email" value="{{Auth::guard('customer')->user()->email}}" class="form-control px-3" placeholder="Enter Email" >
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                 @enderror
                                </div>
                                <div class="form-group px-3 py-1 d-flex">
                                    <label for="" class="pb-1 w-25">Address<span class="text-danger">*</span></label>
                                    <input type="text" name="address" value="{{Auth::guard('customer')->user()->address}}" class="form-control" placeholder="Billing address *" required>
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                 @enderror
                                </div>
                                <div class="form-group px-3 py-1 d-flex">
                                    <label for="" class="pb-1 w-25">Picture</label></label>
                                   <input type="file" class="form-control" name="profile_picture" id="image" onchange="readURL(this);">
                           
                                </div>
                                <div class="form-group px-3 py-1 d-flex">
                                    <button type="submit" class="btn btn-success ms-auto">Update</button>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <img src="#" alt="" id="previewImage" class="customer-image">
                            </div>
                       
                        </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="setting" role="tabpanel" aria-labelledby="profile-tab">
                        <form action="{{route('customerPasswordUpdate')}}" method="post">
                            @csrf
                            @method('put')
                        <div class="row pt-3">
                            
                            <div class="col-md-6">
                                <div class="form-group px-3 py-1">
                                    <label for="" class="p-1" >Current Password<span class="text-danger ">*</span></label>
                                    <input type="password" name="currentPass" class="form-control px-2"  placeholder="Enter Current Password *">
                                </div>
                                <div class="form-group px-3 py-1">
                                    <label for="" class="p-1" >New Password<span class="text-danger ">*</span></label>
                                    <input type="password" name="password" class="form-control px-2"  placeholder="Enter New Password *">
                                </div>
                                <div class="form-group px-3 py-1">
                                    <label for="" class="pb-1">Confirm Password<span class="text-danger">*</span></label>
                                    <input type="password" name="confirmed"  class="form-control px-3" placeholder="Enter Confirm Password *">
                                </div>
                                <div class="form-group px-3 py-1 d-flex">
                                    <button type="submit" class="btn btn-success ms-auto">Update</button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="order" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="row justify-content-center">
                            <div class="col-md-11">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Invoice number</th>
                                          
                                            <th>Order Date</th>
                                            <th>Shipping Address</th>
                                            <th>Shipping Cost</th>
                                            <th>Delivery Date</th>
                                            <th>Total Cost</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        <tbody>
                                            @foreach ($order as $item)
                                                <tr>
                                                    <td>{{$item->invoice_no}}</td>
                                                 
                                                    <td>{{$item->created_at->format('d/m/y')}}</td>
                                                    <td>{{$item->shipping_address}}</td>
                                                    <td>{{$item->shipping_cost}}</td>
                                                    <td>@if(isset($item->delivery_date)){{$item->delivery_date}}@endif</td>
                                                    <td>{{$item->total_amount}}</td>
                                                    <td>
                                                        @if ($item->status == 'p')
                                                            Pending
                                                        @elseif($item->status == 'on')
                                                            On Process
                                                        @elseif($item->status == 'w')
                                                        On The Way
                                                        @elseif($item->status == 'd')
                                                        Delivered
                                                        @elseif($item->status == 'c')
                                                        Cancel
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{route('invoice.customer',$item->id)}}" class="btn btn-success btn-sm" title="view"> <i class="fas fa-eye"></i></a>
                                                        @if ($item->status == 'c' || $item->status == 'd')
                                                        @else
                                                        <a href="{{route('customer.order.cancel',$item->id)}}" class="btn btn-danger btn-sm" title="cancel" onclick="return confirm('Are you sure cancel this order')"><i class="fas fa-window-close"></i></a>
                                                        @endif

                                                        @if ($item->status == 'c' || $item->status == 'd')
                                                        <a href="javascript:void(0)" id="procesing" onclick="processing({{$item->id}})" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#myModal"><i class="fas fa-trash"></i></a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </thead>
                                </table>
                            </div>
                           
                        </div>
                    </div>
                  </div>
        </div>
    </div>
    @elseif(Auth::guard('customer')->user()->isVerified != '1' )
    <h4 class="text-center text-danger"> Your Account no verified</h4>
    <p class="text-center"><a href="{{route('customer.resend.otp')}}" class="fw-bolder">Resend otp to <i>{{Auth::guard('customer')->user()->phone}}</i> </a> </p>
    @else 
    <h4 class="text-center text-danger">Your Account Inactive. Please contact Admin</h4>
    @endif
    
{{-- delete modal --}}

    <div class="modal" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <form action="" id="modal-form" method="post">
                @csrf
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
</section>
<script> 

   

    function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload=function(e) {
                    $('#previewImage')
                        .attr('src', e.target.result)
                        .width(100);
                       
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        document.getElementById("previewImage").src="{{ asset('uploads/customer/'.Auth::guard('customer')->user()->profile_picture) }}";
        
 
 
 </script> 

<script>
    function processing(id){
        var url = "/customer-invoice-remove/"+id;
        $('#modal-form').attr('action',url);
    }
</script>
    
@endsection
