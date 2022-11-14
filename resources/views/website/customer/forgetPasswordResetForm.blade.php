@extends('layouts.website')
@section('website-content')

<section class="py-5">
    <h2 class="text-center text-success"> Customer Login</h2>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-12">
                
                <div class="card">
                    <div class="card-body p-3">
                      <form action="{{route('forget.password.reset.update')}}" method="post">
                          @csrf
                          <div class="form-group py-3 position-relative">
                            <input type="hidden" name="phone"  value="{{Session::get('phone')}}"  class="form-control px-3"  >
                        </div>
                        <div class="form-group py-3 position-relative">
                            <input type="text" name="password"   class="form-control px-3" placeholder="Enter New Password" >
                        </div>
                        <div class="form-group py-3 position-relative">
                            <input type="text" name="confirmed"  class="form-control px-3" placeholder="Enter Confirm Password" >
                        </div>
                        <div class="form-group py-3 d-flex">
                            <span>
                                <button type="submit" class="btn btn-success ">submit</button>
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
