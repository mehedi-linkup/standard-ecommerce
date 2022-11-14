@extends('layouts.website')
@section('website-content')

<section class="py-5">
    <h2 class="text-center text-success"> Customer Login</h2>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-12">
                
                <div class="card position-relative">
                    <div class="card-body p-3">
                      <form action="{{route('forget.password.otp.check')}}" method="post">
                          @csrf
                          <div class="form-group py-3 position-relative">
                            <input type="hidden" name="phone"  value="{{Session::get('phone')}}"  class="form-control px-3"  >
                        </div>
                        <div class="form-group py-3 position-relative">
                            <input type="text" name="otp"  class="form-control px-3" placeholder="Enter OTP" >
                        </div>
                        <div class="form-group py-3 d-flex">
                            <span>
                                <button type="submit" class="btn btn-success ">submit</button>
                            </span>
                            
                        </div>
                    </form>
                    <form action="{{route('forget.password.store')}}" method="post">
                        @csrf
                      <div class="form-group py-3">
                          <input type="hidden" name="phone"  class="form-control px-3" value="{{Session::get('phone')}}" >
                      </div>
                      <div class="form-group position-absolute resent-otp">
                          <span>
                              <button type="submit" class="btn btn-success ">Resent OTP</button>
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
@push('website-js')
    <script>
    </script>
    
@endpush
