
@extends('layouts.website')
@section('website-content')

<section class="py-3">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page"></li>
            </ol>
          </nav>
    </div>
</section>
<section>
    @foreach ($Categorylist->SubCategory as $item)
       
    @endforeach
    <div class="container">
        <div class="feature-h3 ">
            <h3>{{$Categorylist->name}}</h3>
        </div>
        <div class="row py-3">
            @foreach ($Categorylist->SubCategory as $item)
                <div class="col-lg-3 col-md-6 col-12 mb-2">
                    <a href="{{route('SubCategoryWise.list',$item->slug)}}" class="row border">
                    
                        <div class="col-lg-7 col-md-6 col-6">
                            <div class="category-title  py-3">
                                <p class=" text-center mb-0">{{$item->name}}</p>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-6 col-6 text-center">
                            <div class="category-img py-2">
                                <img src="{{ asset($item->image) }}" alt="">
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
        </div>
    </div>
</section>


@endsection
