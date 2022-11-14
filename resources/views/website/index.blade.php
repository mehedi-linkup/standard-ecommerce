@extends('layouts.website')
@section('website-content')
<style>
    @media screen and ( max-width: 767px ){
        .single-slide {
    height: 180px;
    width: 100%;
}
    }
</style>
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="slider-area">
                    <div class="slider-active owl-carousel owl-loaded owl-drag">
                        <div class="owl-stage-outer ">
                            <div class="owl-stage">
                                @foreach ($banner as $item)

                                <div class="owl-item ">
                                    <div class=" single-slide  align-center-left animation-style-02 slider-background bg-1" style="background-image:url({{asset($item->image)}}) " loading="lazy">
                                        <div class="slider-progress"></div>
                                        <div class="slider-content position-relative">
                                            {{-- <div class="text-content">
                                                <h5 class="text-shadow">Sale Offer <span>{{$item->offer_name}}</span> This Week</h5>
                                                <h2 class="text-shadow">{!!$item->short_details!!}</h2>
                                                <h3 class="text-shadow">{{$item->title}}</h3>
                                                <div class="default-btn slide-btn"> <a class="links"
                                                        href="{{$item->offer_link}}" target="_blank">Shopping
                                                        Now</a>
                                                </div>
                                            </div> --}}
                                           
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Slider Area End Here -->
            <!-- Begin Li Banner Area -->

        </div>
    </div>
</section>

<!-- End Owl slider  -->
<!-- Start Category Section -->
<section>
    
    <div class="container-fluid">
        <div class="feature-h3 pb-2">
            <h3>Product Category</h3>
        </div>
        <div class="row">
            @foreach ($category as $item)
            @if($item->SubCategory->count() == 0)
            <div class="col-lg-3 col-md-6 col-12 px-3 mb-2">
                <a href="{{route('categoryWise.list',$item->slug)}}" class="row border">
                
                    <div class="col-lg-7 col-md-6 col-6">
                        <div class="category-title  py-3">
                            <p class=" text-center mb-0">{{$item->name}}</p>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6 col-6 text-center">
                        <div class="category-img py-2">
                            <img src="{{ asset($item->image) }}" alt="" loading="lazy">
                        </div>
                    </div>
                </a>
            </div>
            @else 
            <div class="col-lg-3 col-md-6 col-12 px-3 mb-2">
                <a href="{{route('single.subcategory.list',$item->slug)}}" class="row border">
                    <div class="col-lg-7 col-md-6 col-6">
                        <div class="category-title  py-3">
                            <p class=" text-center mb-0">{{$item->name}}</p>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6 col-6 text-center">
                        <div class="category-img py-2">
                            <img src="{{ asset($item->image) }}" alt="" loading="lazy">
                        </div>
                    </div>
                </a>
            </div>
            @endif
            
            
            @endforeach
            
        </div>
    </div>
</section>

<!-- End Category Section -->
<!-- Recent Product Section -->
<section class="py-4">
    <div class="container-fluid">
        <div class="feature-h3">
            <h3>Recent Product</h3>
        </div>
        <div class="row">
            @foreach ($recent as $item)
            @php
            $discount = 0;
            $discount = $item->discount;
            $stock = $item->inventory->purchage;  
            $discount_price =$item->price - $item->price*$discount/100;  
            @endphp
            <div class="lg-1 col-lg-2 col-md-6 col-6 ">
                    <div class="section-item">
                        <div class="main-card-body position-relative">
                             <img src="{{ asset('uploads/product/'.$item->image)}}" alt="" loading="lazy">
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
                                <h5 class="text-center pt-3 text-white">{{$item->price}} TK</h5>
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
                        <div class="d-flex mb-3" id="add-btn{{$item->id}}">
                            <a  href="javascript:void(0);" class="btn-details1 w-100 add" onclick="addToCard({{$item->id}})">Add To Cart</a>
                        </div>
                        @endif
                    
                    </div>
                    
                </div>
            @endforeach
            <div class=" text-end">
                <a href="{{route('all.product')}}" class="btn btn-warning fw-bolder" >View All</a>
            </div>
            {{-- <div class="col-lg-2 col-md-6 col-12 ">
                <div class="section-item">
                    <img src="{{ asset('website') }}/image/arrive;l-5.jpg" alt="">
                    <div class="product-price">
                        <h6 class="text-center fw-bolder mt-2 mb-0">Man,s Shirt</h6>
                        <p class="text-center fw-bold mb-1">420 TK</p>
                    </div>
                    <div class="d-flex mb-3">
                        <a href="#" class="btn-details1 w-100">Add To Cart</a>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</section>
<!-- End Product Section -->
<!-- Start Banner Section -->
<section class="banner">
    <div class="container">
        @foreach ($fullAd as $item)
        <div class="row vertical-align">
            <div class="col-lg-6 col-md-6 col-6 banner-text py-3">
                <h3 class="fs-2 fw-bold text-uppercase">{{$item->title}}</h3>
                
            </div>
            <div class="col-lg-6 col-md-6 col-6">
                <div class="banner-image text-center"> <img class="w-100" src="{{ asset($item->image)}}" alt=""> </div>
            </div>
        </div>
        @endforeach
       
    </div>
</section>
<!-- End Banner Section -->

<!-- Start Feature Product -->
<section class="feature-section py-4">
    <div class="container-fluid">
        <div class="feature-h3 ">
            <h3 class="">Popular Product</h3>
        </div>
        <div class="row">
            @foreach ($popular as $item)
            <div class="lg-1 col-lg-2 col-md-6 col-6 ">
                <div class="section-item">
                    <div class="main-card-body position-relative">
                        @php
                            $discount = 0;
                            $discount = $item->discount;

                         $stock = $item->inventory->purchage;
                         $discount_price =$item->price - $item->price*$discount/100; 
                         // if($stock <1)
                         // echo 'stock out';
                     @endphp
                        {{-- <img src="{{ asset('website') }}/image/arrive;l-5.jpg" alt=""> --}}
                       <img src="{{ asset('uploads/product/thumbnail/'.$item->thum_image)}}" alt="">
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
                            <h5 class="text-center pt-3 text-white">{{$item->price}} TK</h5>
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
                    <div class="d-flex mb-3" id="add-btn{{$item->id}}">
                        <a  href="javascript:void(0);" class="btn-details1 w-100 add" onclick="addToCard({{$item->id}})">Add To Cart</a>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- End Feature Product -->
<!-- Start Banner Section 2 -->
<!-- Start Banner Section 2 -->
<div class="banner-section-2">
    <div class="container-fluid">
        <div class="row py-5 d-flex justify-content-center">
            <div class="get-offer">
                <h1 class="mb-0">Get Offer From Your First Shopping!</h1>
                <p class="shopping-text mb-0">Happy Shopping</p>
            </div>
        </div>
    </div>
</div>
<!-- End New arrivel Section -->
<!-- End New arrivel Section -->
<section class="feature-section py-4">
    <div class="container-fluid">
        <div class="feature-h3 ">
            <h3 class=""> New Arrival</h3>
        </div>
        <div class="row">
            @foreach ($new_arrival as $item)
            <div class="lg-1 col-lg-2 col-md-6 col-6 ">
                <div class="section-item">
                    <div class="main-card-body position-relative">
                        @php
                            $discount = 0;
                            $discount = $item->discount;

                         $stock = $item->inventory->purchage;
                         $discount_price =$item->price - $item->price*$discount/100; 
                         // if($stock <1)
                         // echo 'stock out';
                     @endphp
                        {{-- <img src="{{ asset('website') }}/image/arrive;l-5.jpg" alt=""> --}}
                       <img src="{{ asset('uploads/product/'.$item->image)}}" alt="" loading="lazy">
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
                            <h5 class="text-center pt-3 text-white">{{$item->price}} TK</h5>
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
                    <div class="d-flex mb-3" id="add-btn{{$item->id}}">
                        <a  href="javascript:void(0);" class="btn-details1 w-100 add" onclick="addToCard({{$item->id}})">Add To Cart</a>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


@endsection
