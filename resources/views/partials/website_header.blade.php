 <!-- Side-Nav -->
 <div class="side-navbar active-nav" id="sidebar">
    <div class="menu-section ">
        <div class="site-logo py-1">
            <a href="{{ route('home') }}">{{$content->company_name}}</a>
        </div>
      <nav class="left-sidebar">
            <ul id="nav_accordion">
                @foreach ($category as $item)
                <li class="nav-item">
                    <a class="nav-link" @if($item->SubCategory->count() > 0) data-bs-toggle="collapse" data-bs-target="#menu_item{{$item->id}}" @endif href="{{route('categoryWise.list',$item->slug)}}" >
                        <img src="{{ asset($item->image) }}" alt="" loading="lazy">
                        <span>{{$item->name}}</span>
                        @if($item->SubCategory->count() >0)
                        <span class="angle-right"> <i class="fas fa-angle-right"></i></span>
                        @endif
                    </a>
                    @if ($item->SubCategory->count() > 0)
                    <ul id="menu_item{{$item->id}}" class=" mb-0 collapse" data-bs-parent="#nav_accordion">
                        @foreach ($item->SubCategory as $i)
                        <li><a href="{{route('SubCategoryWise.list',$i->slug)}}"> <img src="{{ asset($i->image) }}" alt="" loading="lazy" class="mx-2">{{$i->name}} </a></li> 
                        @endforeach
                        
                    </ul>
                    @endif
                </li> 
                @endforeach
            </ul>
        </nav>
    </div>
</div>
<a href="{{route('checkout.user')}}"  class="btn fixed-bottom footer-fixed rounded-0 m-checkout-btn">Checkout</a>
<section class="fixed-bottom bg-warning footer-fixed-shopping">
    <div class="cart-bottom w-100 d-flex align-middle">
        <div class="w-25 bg-light text-center cursor-pointer pt-2">
            <div class=" position-relative">
                <a href="{{route('web.contact')}}">
                    <i class="fas text-success fa-comment-dots fa-2x"></i>
                </a>
            </div>
        </div>
        <div class="start-shopping w-50 pt-2">
            <a href="{{route('home')}}" class="btn bg-warning w-100">Start Shopping</a>
        </div>
        <div class="w-25 bg-light text-center cursor-pointer pt-2">
            <div class="bottom-cart position-relative">
                <i class="fas fa-cart-plus text-success bottom-cart-icon"></i>
                <span class="position-absolute translate-middle badge rounded-pill bg-warning bounch " id="cart-number-m"></span>
            </div>
        </div>
    </div> 
</section>

<!-- Main Wrapper -->
<div class="my-container active-cont">
    <!--Start  Header Section -->
   
    <section class="top-header sticky-top">
       
        <div class="container-fluid disply-responsive">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-8">
                    <p class="mb-0 py-2"> &nbsp; <a id="sidebar-toggle-btn" class="menu-btn" ><i
                        class="fas fa-bars text-white"></i></a> Onlline Shoping Site</p>
                </div>
                <div class="col-lg-6 col-md-6 col-4 d-flex justify-content-end ">
                    <div class="justify-content-end google-translate" id="google_translate_element"></div>
                    <p class="mb-0 py-2">Need Help?</p>
                </div>
            </div>
        </div>
        {{-- mobile menu --}}
        <section class="top-responsive mb-3">
            
            <div class="responsive-bar d-flex justify-content-center m-head-bar">
                <div class=" single-part"> <a class="menu-btn" id="menu-btn"><i class="fas fa-bars text-white"></i></a> </div>
                <div class="search-click">
                        <form class="" action="{{ route('search') }}" method="GET">
                            <span class="search-bar">
                                <input type="text" class="form-control search-bar-full keyword "type="text" name="q"  placeholder="Search...">
                                   
                            </span>
                         </form>
                </div>
                
                <div class="user-icon single-part"> <i class="fas fa-ellipsis-v top-icon "></i> </div>
                
            </div>
           
        </section>
        <div class="user-login-part">
            <ul class="user-menu">
                <li > <a class="nav-link" href="{{route('home')}}"><i class="fas fa-home me-1"></i> Home </a> </li>
                 <li > <a class="nav-link" href="{{route('about.website')}}"><i class="fas fa-eject me-1"></i> About </a> </li>
                 <li > <a class="nav-link" href="{{route('web.contact')}}"> <i class="fas fa-phone me-1"></i> Contact </a> </li>
                <li class="">
                    @if (Auth::guard('customer')->check())
                    <a href="{{route('customerLogout')}}"><i class="fas fa-sign-out-alt me-1"></i> Logout </a>
                    @else
                    <a href="{{route('customer.login')}}"><i class="fas fa-sign-in-alt me-1"></i> login </a>
                    @endif
                </li>
                <li class="d-flex"><i class="fas fa-language"></i><span id="google_translate_element"></span></li>
                <li class="">
                    @if (Auth::guard('customer')->check())
                    <a href="{{route('customer.panel')}}"><i class="fas fa-user me-1"></i> My Account</a>
                    @else
                    <a href="{{route('customer.signup')}}"><i class="fas fa-sign-in-alt me-1"></i>SignUp</a>
                    @endif
                </li>
            </ul>
        </div>
        <!--mobile cart bar start-->
            <ul class="top-20 bg-light m-auto w-100" id="m-cart-ul" style="z-index:9999999">
            
            
            </ul>
           
          
           

         
    </section>
    <!-- Start Mobile Menu -->

  
    <!-- End Mobile Menu -->
    <section class="sticky-top d-none d-md-block">
        <div class="container-fluid">
            <div class="row vertical-align">
                <div class="col-lg-4 col-md-4 col-12 py-1">
                    <div class="header-logo d-flex"> 
                        <a href="{{route('home')}}"><img src="{{ asset('website') }}/image/logo-4.png" alt=""> </a>
                        <span
                            class="typed company-typed" id="typed"></span> </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12  ">
                    <form action="{{route('search')}}" method="get">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12 py-4 input-search d-flex">
                            <form class="" action="{{ route('search') }}" method="GET">
                                <input class="search-control keyword" type="text" name="q" placeholder="Search...">
                                <button type="submit" class="btn-search"><i class="fas fa-search"></i></button>
                           </form>
                            {{-- <form class="" action="{{ route('search') }}" method="GET">
                                <input type="text" name="q" id="keyword" placeholder="Search...">
                                <button type="submit" class=" btn-search"><i class="fas fa-search"></i></button>
                            </form> --}}
                        </div>
                    </div>
                </form>
                </div>
                
                <div class="col-lg-4 col-md-4 top-icon col-12 py-3 d-flex justify-content-center">
                  <div class="header-right-side d-flex ">
                      <div class="cart-part-header d-flex me-3">
                            <div class="text-success position-relative" id="cart">Cart <i class="fas fa-cart-plus " id="navbar"></i>
                                
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning " id="cartItemNumber">
                                
                            </div>
                            <ul class="cart-ul" id="cart-ul">
                              
                            </ul>
                            
                      </div>
                      
                      <div class="p-1 text-success me-3">
                          @if (Auth::guard('customer')->check())
                          <a href="{{route('customerLogout')}}" onclick="return confirm('Are you sure logout?')">Logout </a>
                          @else
                          <a href="{{route('customer.login')}}" >login <i class="fas fa-user user-login"></i></a>

                          @endif
                         
                        </div>
                      <div class="text-success me-3">
                          
                          @if (Auth::guard('customer')->check())
                          <a href="{{route('customer.panel')}}">My Account</a>
                          @else
                          <a href="{{route('customer.signup')}}">SignUp</a>
                          @endif
                          
                      </div>
                      
                     
                </div> 

                    
                </div>
            
            </div>
        </div>
        <!-- Start Menu Section -->
        <section class="container-fluid d-none d-sm-block">
            <div class="main-menu">
                <nav class="navbar navbar-expand-md ">
                    <div class="container-fluid">
                        <nav class="navbar top-navbar navbar-light">

                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul>
                                    <li><a href="{{route('web.contact')}}">Contact Us</a></li>
                                    <li><a href="{{route('about.website')}}">About Us</a></li>
                                    <li><a href="{{route('home')}}">Home</a></li>
                                     
                                </ul>
                            </div>
                        </nav>
                    </div>
                </nav>
            </div>
        </section>
        <!-- End Menu Section -->

       

    </section>