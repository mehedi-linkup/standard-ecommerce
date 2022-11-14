@extends('layouts.website')
@section('website-content')

<section class="py-3">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{$category_list->name}}</li>
            </ol>
          </nav>
    </div>
</section>
<section class="py-4 category-section" >
    <div class="container">
        <div class="row">
            @if ($category_wise_product->count() > 0)
                @foreach ($category_wise_product as $item)
                @php
                $discount = 0;
                $discount = $item->discount;
                $stock = $item->inventory->purchage;
                $discount_price =$item->price - $item->price*$discount/100; 
                @endphp
                <div class="lg-1 col-lg-2 col-md-6 col-6 ">
                    <div class="section-item">
                        <div class="main-card-body position-relative">
                            <img src="{{ asset('uploads/product/'.$item->image)}}" alt="">
                            @if ($item->discount != NULL)
                            <span class="discount position-absolute">{{(int)$discount}}%</span>
                            @endif
                            <div class="product-price">
                                <h6 class="text-center fw-bolder mt-2 mb-0">{{$item->name}}</h6>
                                @if($item->discount >0)
                                <p class="text-center"> <span class="text-danger mx-2">{{$discount_price}} TK</span><span class=" text-decoration-line-through">{{$item->price}} TK</span></p>
                                @else 
                                <p class="text-center fw-bold mb-1">{{$item->price}} TK</p>
                                @endif
                                
                            </div>
                            <div class="overlay-1 overlay-1{{$item->id}}" id="overlay-1" >
                                @if ($stock<1)
                                <div class="add-to-cart-part">
                                    <h5>Stock Out</h5>
                                </div>
                                @else
                                <div class="add-to-cart-part add" onclick="addToCard({{$item->id}})">
                                    <h5>Add To Shopping Card</h5>
                                </div>
                                @endif
                                <div class="view-btn position-absolute bottom-0 w-100 text-center details-btn">
                                    <a href="{{route('product.details',$item->slug)}}" class="text-center text-dark ">Details</a>
                                </div>
                            </div>
                            <div class="overlay-2 overlay-2{{$item->id}}">
                            
                                <h5 class="text-center pt-3 text-white"> <span> {{$item->price}} TK</span></h5>
                              
                                <div class="qtyField addTocard-2">
                                    <span class="p-m qtyBtn minus add"><i class="fas fa-minus"></i></span> 
                                    <input type="hidden" value="{{$item->id}}" id="id" name="id" class="id">
                                    <span><input type="text" id="Quantity" name="quantity" value="1" class="product-form__input qty"></span>
                                    <span class="p-m qtyBtn plus add"> <i class="fas fa-plus"></i></span>
                                </div>
                            </div>
                        
                        </div>
                        @if ($stock<1)
                        <div class="d-flex mb-3">
                            <a  href="javascript:void(0);" class="btn-details1 w-100" >Stock Out</a>
                        </div>
                        @else
                        <div class="d-flex mb-3">
                            <a  href="javascript:void(0);" class="btn-details1 w-100 add" onclick="addToCard({{$item->id}})">Add To Cart</a>
                        </div>
                        @endif
                    
                    </div>
                    
                </div>
                @endforeach 
            @else
            <h2 class="text-danger text-center">Sorry! This category product has no available</h2>
            @endif
            
        </div>
    </div>
</section>



@endsection
