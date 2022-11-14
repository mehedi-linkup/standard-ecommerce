
function myFunction() {
    document.getElementById("demo").innerHTML = "Hello World";
}

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

var typed6 = new Typed('#typed', {
    strings: ['Zenevia Express Shop'],
    typeSpeed: 100,
    backSpeed: 100,
    loop: true
});

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
        }
    }
});

(function() {
    $("#cart").on("click", function() {
        $(".dropdown-content-web").fadeToggle("fast");
    });

})();

(function() {
$("#cart").on("click", function() {
    $(".cart-ul").fadeToggle("fast");
});

})();

$(document).ready(function () { 
if($(window).width() < 768) { 
   $("#sidebar-toggle-btn").addClass("css-test"); 
   $("#sidebar-toggle-btn").removeClass("menu-btn");  
   
}     
}); 

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





$('.sm-menu-btn').on('click', function() {
    $(".side-navbar").toggle();
    $('.user-login-part').hide();
});
 // if ($(window).width() < 767) {
 //    $('#sidebar:not(#nav_accordion)').on('click',function(e){
        
 //        $(".side-navbar").hide('slow');
 //    })
 // }
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



 
// var menu_btn = document.querySelector(".menu-btn");
var sidebar = document.querySelector("#sidebar");
var container = document.querySelector(".my-container");

$(document).on('click', '.menu-btn', function(){
    sidebar.classList.toggle("active-nav");
    container.classList.toggle("active-cont");
});

