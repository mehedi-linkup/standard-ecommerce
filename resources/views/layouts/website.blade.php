<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $content->title }}</title>
    <meta name="description" content="Free Web tutorials">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="icon" type="image/png" href="{{ $content->logo }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('website/css/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('website/css/all.min.css') }}">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="{{ asset('website/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('website/css/slider.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('website/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('website/css/menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('website/css/style.css') }}">
    <link href="{{ asset('website/css/toastr.min.css') }}" rel="stylesheet" id="galio-skin">
    <script src="{{ asset('website/js/jquery.min.js') }}"></script>
    
    @yield('website-css')

    
</head>

<body>
    <!-- Side-Nav -->
    @include('partials.website_header')
    <!--End  Header Section -->

    <!-- Start Main slider  -->
    @yield('website-content')
    <!-- End New arrivel Section -->
    <!-- Start Footer Section -->
    @include('partials.website_footer')
  
    <script src="{{ asset('website/js/zoom-image.js') }}"></script>
    <script src="{{ asset('website/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('website/js/owl.carousel.js') }}"></script>
    <script src="{{ asset('website/js/type.js') }}"></script>
    <script src="{{ asset('website/js/main.js') }}"></script>
    {{-- toster --}}
    <script src="{{ asset('website/js/toastr.min.js') }}"></script>
    <script>
        $('img').on('load', function(){
            $('img').css('background','none');
        });
    </script>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en', includedLanguages: 'en,bn'
            }, 'google_translate_element');
        }
    </script>

    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    <script>
        @if(Session::has('cart'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.success("{{ session('cart') }}");
        @endif

      

        @if(Session::has('update'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.success("{{ session('update') }}");
        @endif

        @if(Session::has('message'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.success("{{ session('message') }}");
        @endif
        @if(Session::has('success'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.success("{{ session('success') }}");
        @endif
      
        @if(Session::has('remove'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.error("{{ session('remove') }}");
        @endif
        
        @if(Session::has('error'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.error("{{ session('error') }}");
        @endif
      
    </script>
    @stack('website-js')
    <script>
        function myFunction() {
            document.getElementById("demo").innerHTML = "Hello World";
        }
    </script>
    <script>
        // mobile menu
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.sidebar .nav-link').forEach(function(element) {
                element.addEventListener('click', function(e) {
                    let nextEl = element.nextElementSibling;
                    let parentEl = element.parentElement;
                    if (nextEl) {
                        e.preventDefault();
                        let mycollapse = new bootstrap.Collapse(nextEl);
                        if (nextEl.classList.contains('show')) {
                            mycollapse.hide();
                        } else {
                            mycollapse.show();
                            // find other submenus with class=show
                            var opened_submenu = parentEl.parentElement.querySelector(
                                '.submenu.show');
                            // if it exists, then close all of them
                            if (opened_submenu) {
                                new bootstrap.Collapse(opened_submenu);
                            }
                        }
                    }
                }); // addEventListener
            }) // forEach
        });
        // DOMContentLoaded  end
        $('.search-click').on('click', function() {
            $('.user-seach-bar').slideToggle();
            $('.dropdown-content').hide();
            $('.user-login-part').hide();
            $('.mobile-dropdown-menu').hide();
        });
        $('.bottom-cart').on('click', function() {
            $("#m-cart-ul").fadeToggle("fast");
            $(".m-checkout-btn").fadeToggle("fast");
            $('.user-seach-bar').hide();
            $('.user-login-part').hide();
            $('.mobile-dropdown-menu').hide();
            
        });
        $('.user-icon').on('click', function() {
            $('.user-login-part').toggle();
            $('.mobile-dropdown-menu').hide();
            $('.dropdown-content').hide();
            $('.user-seach-bar').hide();
            $(".side-navbar").hide();
        });
        $('.m-menu').on('click', function() {
            $('.mobile-dropdown-menu').slideToggle();
            $('.user-login-part').hide();
            $('.dropdown-content').hide();
            $('.user-seach-bar').hide();
        });
        $('.user-login-part').on('click',function(){
            $('.user-login-part').hide();
        })
    </script>
    <script>
        var typed6 = new Typed('#typed', {
            strings: ['Zenevia Express Shop'],
            typeSpeed: 100,
            backSpeed: 100,
            loop: true
        });
    </script>
    <script>
        $(".slider-active").owlCarousel({
            loop: true,
            margin: 0,
            nav: true,
            autoplay: true,
            items: 1,
            autoplayTimeout: 10000,
            navText: ["<div class='nav-btn prev-slide'></div>", "<div class='nav-btn next-slide'></div>"],
          
            lazyLoad: true,
            responsive: {
                0: {
                    items: 1
                },
                320: {
                    items: 1
                },
                522: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                },
                1024: {
                    items: 1
                }
            }
        });
    </script>
    <script>
        $('.arrivel-new').owlCarousel({

            loop: true,
            margin: 30,
            nav: true,
            // autoplay:true,
            // autoplayTimeout:1000,

            navText: ["<div class='nav-btn prev-slider'></div>", "<div class='nav-btn next-slider'></div>"],
            responsive: {
                0: {
                    items: 2
                },
                320: {
                    items: 2
                },
                522: {
                    items: 2
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 5
                },
                1024: {
                    items: 5
                },
                1200: {
                    items: 6
                }
            }
        });
    </script>


    
<script>
    (function() {
        $("#cart").on("click", function() {
            $(".cart-ul").fadeToggle("fast");
        });

    })();
</script>
    <!-- sideber menu -->
    <script>
       
       $(document).ready(function () { 
        if($(window).width() < 768) { 
           $("#sidebar-toggle-btn").addClass("css-test"); 
           $("#sidebar-toggle-btn").removeClass("menu-btn");  
           
        }     
    }); 
    </script>

<script>
      if ($(window).width() < 768) {
            $('#menu-btn').removeClass('menu-btn');
            $('#menu-btn').addClass('sm-menu-btn');
        } else {
            $('#menu-btn').removeClass('sm-menu-btn');
            $('#menu-btn').addClass('menu-btn');
        }
        // $('.menu-section ul li ul li').on('click'){
        //     $('.side-navbar').show();
        // }
        $('.nav_accordion').on('click',function(){
            $('.side-navbar').show()
        })

      
        
 </script>
 <script>
    if ($(window).width() < 768) {
        var myobj = document.getElementById("google_translate_element");
         myobj.remove();
      } else {
      }
      

</script>
 <script>

        $('.sm-menu-btn').on('click', function() {
            $(".side-navbar").toggle();
            $('.user-login-part').hide();
        });
        
         $('.left-sidebar').on('click',function(){
            $(".side-navbar").show();
         })
        if ($(window).width() < 767) {
            $('#sidebar').on('click',function(e){
                $(".side-navbar").hide('slow');
            }).on('click', '#nav_accordion', function(e) {
                    e.stopPropagation();
                });
         }

        

 </script>

    <script>
        // var menu_btn = document.querySelector(".menu-btn");
        var sidebar = document.querySelector("#sidebar");
        var container = document.querySelector(".my-container");

        $(document).on('click', '.menu-btn', function(){
            sidebar.classList.toggle("active-nav");
            container.classList.toggle("active-cont");
        });
    </script>
   <script>

        let new_time = new Date().getTime();
    
        let old_date = localStorage.getItem('cartTime');
        if(old_date == null){
           
            let old_date = new Date().getTime();
    
            localStorage.setItem('cartTime',old_date);
        }
        var diff = new_time - old_date;
        
        if(diff >= 1800000){
            $.ajax({
                    url:'/cart-remove-auto',
                    type:"get",
                    dataType: "json",
                    success:function(res){
                      if(res){
                        localStorage.removeItem('cartTime');
                    }
                      
                   }
                })
        }
        else{
               
        }
        
    
 
   

</script>
    <script>
        // ajax card add
    function addToCard(id){
        var url = "/cart-add/"+id;
        $.ajax({
                url:url,
                type:"get",
                dataType: "json",
                success:function(res){
                    let new_time = new Date().getTime();
        
                    localStorage.setItem('cartTime',new_time);
                    cartAllData();
                    $('#details-btn'+id).show();
                    $('#addCart'+id).hide();
                }
            })
        var overlay_1 = $('.overlay-1'+id).hide();
        $('.overlay-2'+id).show();
        $('#add-btn'+id).remove();
        $('#increment_decrement_part').show();
    }


   
// ajax card delete
function deleteCard(id){
  var url = "/remove/"+id;
  $.ajax({
            url:url,
            type:"get",
            dataType: "json",
            success:function(res){
                cartAllData();
            }
        })
}

// ajax card  all data show
      function cartAllData(){
          var cartTotal = $('#cartTotal').val();
        $.ajax({
                url:"{{route('cart.alldata')}}",
                type:"get",
                dataType: "json",
                success:function(res){
                    
                    var data = "";
                    $.each(res,function(key,value){
                        var url = "/product-details/"+value.attributes.slug;
                        data = data + '<li class="d-flex py-2"><span class="d-flex my-auto"><span id="decrement-minus" class="minus-decrement btn btn-sm minus ml-0" onclick="decrement('+value.id+')"><i class="fas fa-minus"></i></span><span class="value mx-1 my-auto"> '+value.quantity+'</span><span class="plus increment-plus mx-1 btn  btn-sm" onclick="increment('+value.id+')"><i class="fas fa-plus"></i></span></span><span class="cart-img my-auto"> <img src="/uploads/product/'+value.attributes.image+'" alt=""></span><span class="px-2">'+value.name+'</span><span>'+value.quantity+'*'+value.price+' ='+value.quantity*value.price+'</span></a></br><span class="ms-auto del" onclick="deleteCard('+value.id+') "> <i class="fas fa-times del"></i></span></li>'

                    })
                    data = data + '<li class="d-flex"><span class="ms-auto"> SubTotal:</span></span> <span class="text-end fw-bolder total_amount" id="total_amount"></span></li>'
                    data = data + '<li class="d-flex m-d-none"> <a href="{{route('checkout.user')}}" class="bt btn-danger text-center p-1 w-100"> CheckOut</a></li>'
                    $('#cart-ul').html(data);
                    $('#m-cart-ul').html(data);
                    cartcontent();

                }
            })
      };

      cartAllData();

    </script>
    <script>
        // ajax card  content show
          function cartcontent(){
           $.ajax({
            url:"{{route('cart.content')}}",
                type:"get",
                dataType: "json",
                success:function(res){
                    $('#cartItemNumber').text(res.total_item);
                    $('#cart-number-m').text(res.total_item);
                    $('.total_amount').text(res.total_amount);
                    $('.item-number').text(res.total_item);
                }
           })
          }
          cartcontent();
    </script>
    <script>
       function qnt_incre(){
		$(".qtyBtn").on("click", function() {
		  var qtyField = $(this).parent(".qtyField"),
			 oldValue = $(qtyField).find(".qty").val(),
             id = $(qtyField).find(".id").val(),
			  newVal = 1;
	
		  if ($(this).is(".plus")) {
			newVal = parseInt(oldValue) + 1;
           
		  } else if (oldValue > 1) {
			newVal = parseInt(oldValue) - 1;
		  }

		 var quantity = $(qtyField).find(".qty").val(newVal);
          let url = "/cart-add/update/"+id;
             $.ajax({
                url:url,
                type:"get",
                dataType: "json",
                data: quantity,
                success:function(res){
                    if(res.error){
                        toastr.error(res.error);
                    }
                   
                    cartAllData();
                    $('#cartItemNumber').text(res.total_item);
                    $('#cart-number-m').text(res.total_item);
                    $('#total_amount').text(res.total_amount);
                },
                error:function(error){
                    toastr.error('Stock not available');
                }

           })

		});
	}
	qnt_incre();


    function decrement(id){
          let url = "/cart/decrement/"+id;
          $.ajax({
                url:url,
                type:"get",
                dataType: "json",
                success:function(res){
                    cartAllData();
                    $('#cartItemNumber').text(res.total_item);
                    $('#cart-number-m').text(res.total_item);
                    $('#total_amount').text(res.total_amount);
                }
           })

	
	}
	decrement();

    function increment(id){
          let url = "/cart/increment/"+id;
          $.ajax({
                url:url,
                type:"get",
                dataType: "json",
                success:function(res){
                    if(res){
                        toastr.error(res.error);
                    }
                    cartAllData();
                    $('#cartItemNumber').text(res.total_item);
                    $('#cart-number-m').text(res.total_item);
                    $('#total_amount').text(res.total_amount);
                }
               
           })

	
	}
	increment();

    </script>
  <script src="{{asset('website/js/bootstrap3-typeahead.min.js')}}" ></script>
  <script type="text/javascript">
      var baseUri = "{{ url('/') }}";
      $('.keyword').typeahead({
          minLength: 1,
          source: function (keyword, process) {
              return $.get(`${baseUri}/get_suggestions/${keyword}`, function (data) {
                  return process(data);
              });
          },

          updater:function (item) {
              $(location).attr('href', '/search?q='+item);
              return item;
          }

      });
  </script>
  <script>
    
    $(document).on("change","#area_id",function(){
    var area_id = $(this).val();
      $.ajax({
        url:"{{route('area.charge')}}",
        type: "GET",
        data:{area_id:area_id},
        success:function(res){
          $('.shipping_charge').text(res);
        }
    });


  });
</script>
<script>
    const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#id_password');

togglePassword.addEventListener('click', function (e) {
// toggle the type attribute
const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
password.setAttribute('type', type);
// toggle the eye slash icon
this.classList.toggle('fa-eye-slash');
});
</script>


  <script>
       if ($(window).width() < 767) {
            $('.user-login-part').on('click',function(e){
                $(".side-navbar").hide('slow');
            }).on('click', '#google_translate_element', function(e) {
                    e.stopPropagation();
                });
         }
  </script>
  <script>
      /* bounch*/
      var getAttention = function(elementClass,initialDistance, times, damping) {
        for(var i=1; i<=times; i++){
            var an = Math.pow(-1,i)*initialDistance/(i*damping);
            $('.'+elementClass).animate({'top':an},100);
        }
        $('.'+elementClass).animate({'top':0},100);
        }

        $(".add").click(function() {
            getAttention("bounch", 50, 10, 1.2);
        });
  </script>
  <script>
    const images = document.querySelectorAll("img");

        const imgOptions = {
        threshold: 0.2
        };
        const imgObserver = new IntersectionObserver((entries, imgObserver) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) return;

            const img = entry.target;
            img.src = img.src.replace("w=10&", "w=800&");
            imgObserver.unobserve(entry.target);
        });
        }, imgOptions);

        images.forEach((img) => {
        imgObserver.observe(img);
        });
</script>

{{-- <script>
    document.addEventListener('contextmenu', function(e) {
          e.preventDefault();
        });
        document.addEventListener('keydown', function(e) {
            if(e.keyCode == 123) { 
            return false; 
            } 
            if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)){ 
                e.preventDefault();
            } 
            if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)){ 
                e.preventDefault();
            } 
            if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)){ 
                e.preventDefault();
            }
        });
</script> --}}

   <!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/626111ff7b967b11798bc423/1g15isjr4';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
</script>

<!--End of Tawk.to Script-->
</body>

</html>
