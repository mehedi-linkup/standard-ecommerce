@extends('layouts.website')
@section('website-content')

<section class="py-3">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
            </ol>
          </nav>
    </div>
</section>

<section class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-12 p-3">
                <div class="getInTouch">
                    <h3 class="text-success pb-3">Get In Touch</h3>
                    <form action="{{route('contact.Store')}}" method="post">
                        @csrf
                        <div class="d-flex">
                            <input type="text" name="sender_name" placeholder="Name *" required class="w-50 me-3 form-control">
                             <input type="text" name="phone" placeholder="Phone *" required class="w-50 form-control">
                        </div>
                        <div class="d-flex py-3">
                            <input type="email" name="email" placeholder="Email" class="w-50 me-3 form-control">
                             <input type="text" name="subject" placeholder="Subject" class="w-50  form-control">
                        </div>
                        <div class="d-flex">
                            <textarea  rows="5" name="message" class="form-control" placeholder="Your Message"></textarea>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-success" >Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 col-12 p-3">
                <div class="getInTouch">
                    <h3 class="text-success pb-3">Contact Us</h3>
                    {!!$content->about_description!!}
                    <ul class="fa-ul py-3">
                        <li><i class="fa-li fas fa-fax text-success"></i>{{$content->address}}</li>
                        <li><i class="fa-li fas fa-phone text-success"></i>{{$content->phone_1}}</li>
                        <li><i class="fa-li fas fa-phone text-success"></i>{{$content->phone_2}}</li>
                        <li><i class="fa-li fas fa-envelope text-success"></i>{{$content->email}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
