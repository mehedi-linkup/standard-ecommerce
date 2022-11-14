@extends('layouts.website')
@section('website-content')

<section class="py-3">
    <h2 class="text-center text-success"> Customer Otp Form</h2>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-12">
                
                <div class="card">
                    <div class="card-body p-2">
                      <form action="{{route('customer.verify')}}" method="post">
                          @csrf
                        @if(Auth::guard('customer')->check())
                        <p class="text-center fw-bolder mt-2"> Check your otp <i>{{Auth::guard('customer')->user()->phone}}</i>  </p>
                        <input type="hidden" name="phone" class="form-control px-2" value="{{Auth::guard('customer')->user()->phone}}">
                        @else
                             <p class="text-center fw-bolder mt-2"> Check your otp <i>{{Session::get('phone')}}</i>  </p>
                          
                            <input type="hidden" name="phone" class="form-control px-2" value="{{Session::get('phone')}}">
                     
                         @endif
                        <div class="form-group p-2">
                            <input type="text" name="otp" class="form-control px-2" placeholder="Enter otp *">
                        </div>
                        <div class="form-group p-2 d-flex">
                            <span>
                                <button type="submit" class="btn btn-success ">Submit</button>
                            </span>
                           
                        </div>
                    </form>
                    </div>
                  </div>
            </div>

        </div>
    </div>
</section>

@endsection
