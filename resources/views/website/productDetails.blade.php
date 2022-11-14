@extends('layouts.website')
@section('website-content')
<section class="details my-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-6 col-12">
                <div class="show1" href="image/arrivel-1.jpg">
                     <img src="{{asset('uploads/product/'.$product->image)}}" id="show-img"> 
                </div>
                <div class="small-img"> 
                    <img src="{{asset('website/image/online_icon_right@2x.png')}}" class="icon-left" alt="" id="prev-img">
                    <div class="small-container">
                        <div id="small-img-roll">
                            <img src="{{asset('uploads/product/'.$product->image)}}" class="show-small-img" alt="">
                            @foreach ($product->productImage as $item)
                            <img src="{{asset($item->otherImage)}}" class="show-small-img" alt="">
                            @endforeach
                           
                        </div>
                    </div> 
                      <img src="{{asset('website/image/online_icon_right@2x.png')}}" class="icon-right" alt="" id="next-img">
                    </div>
             </div>
            <div class="col-lg-7 col-md-6 col-12 py-2">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-8">
                        <p class="product-title fw-b fs-3">{{$product->name}}</p>
                        @if ($product->inventory->purchage > 0)
                        <p><span class="avilability"> Availability :</span><span class="in-stock"> In Stock </span></p>
                        @else
                        <p><span class="avilability"> Availability :</span><span class="in-stock">Stock Out </span></p>
                        @endif
                        <p><span class="product-id">Product Id : </span> <span class="product-code">{{$product->code}}</span></p>
                       @php
                           $product_discount = $product->price*$product->discount/100;
                           $discount_rate = $product->price - $product_discount;
                           
                       @endphp
                       @if ($product->inventory->purchage < 1)
                       <p>Stock Out</p>
                       @endif
                       
                       {{-- <p class="pprice">@if($product->discount != NULL)<span class="price-tk text-decoration-line-through">Tk:{{$discount_rate}}</span>@endif<span class="offer-price">Tk: {{$product->price}}</span>@if($product->discount != NULL)<span class="save-taka">You save 10 Tk</span>@endif</p> --}}
                       @if ($product->discount != NULL)
                       <p class="pprice"><span class="offer-price">Tk: {{$discount_rate}}</span> <span class="text-decoration-line-through">{{$product->price}}</span><span class="save-taka">You save {{$product_discount}} Tk</span></p>
                       @else
                             <p class="pprice">Tk: {{$product->price}}</p>
                       @endif
                       <div class="row" id="increment_decrement_part">
                        <div class="product-quantity d-flex p-2">
                          <p>Product Quantity : </p> 
                        </div>
                        <div class="qtyField addTocard-2 d-block position-relative left-5 addtocart-details" >
                            <span class="p-m qtyBtn minus add" ><i class="fas fa-minus fx-2 text-success "></i></span> 
                            <input type="hidden" value="{{$product->id}}" id="id" name="id" class="id">
                            <span><input type="text" id="Quantity" name="quantity" value="1" class="product-form__input qty"></span>
                            <span class="p-m qtyBtn plus add"><i class="fas fa-plus fx-2 text-success"></i></span>
                        </div>
                      </div>
                      @php
                      $stock = $product->inventory->purchage;
                      
                        @endphp
                        @if ($stock <1)
                            
                        @else
                        <div class="ul-button d-flex">
                            {{-- <a href="#" class="btn-buy">Buy Now</a> --}}
                            <a href="{{route('checkout.user')}}" class="btn-buy" onclick="addToCard({{$product->id}})">Buy Now</a>
                            <a href="javascript:void(0);" class="btn-cart" onclick="addToCard({{$product->id}})">Add To Cart</a>
                          </div>
                        @endif
                      
                    </div>
                    <div class="col-lg-4 col-md-4 col-4">
                            <div class="product-left ">
                                <p class="product-imge"><img src="image/cod-small.svg" alt="">
                                    <span class="cash-delivery">Cash On Delivery</span>
                                </p>
                                
                            </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>
<!-- End Product Details Page -->
<!-- Start Product details tab -->
<section class="py-3">
 <div class="container">
    <ul class="nav nav-tabs" id="myTab">
        <li class="nav-item">
          <button class="nav-link active tab-button" id="description-tab" data-bs-toggle="tab" data-bs-target="#description">Description</button>
        </li>
        <li class="nav-item">
          <button class="nav-link tab-button" id="information-tab" data-bs-toggle="tab" data-bs-target="#information">Information</button>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="description">
         <div class="container">
             <div class="row">
                 <div class="col-lg-12 col-md-12 col-12 py-4">
                     <p class="fs-6">
                         {!!$product->short_details!!}
                     </p>
                 </div>
             </div>
         </div>
        </div>
        <div class="tab-pane fade" id="information">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12 py-4">
                        {!!$product->details!!}
                    </div>
                </div>
            </div>
        </div>
      </div>
 </div>
</section>

<section class="feature-section py-4">
    <div class="container-fluid">
        <div class="feature-h3 ">
            <h3 class=""> Related Product</h3>
        </div>
        <div class="row">
            @foreach ($related as $item)
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
                    <div class="d-flex mb-3">
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
