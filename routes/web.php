<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdController;
use App\Http\Controllers\Api\TestController;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\PagelistController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ManagementController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\PhotoGalleryController;
use App\Http\Controllers\Admin\PublicMessageController;
use App\Http\Controllers\Admin\MessageSendingController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\ThanaController;
use App\Http\Controllers\Admin\TimeSetController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Http\Controllers\Customer\CustomerController as CustomerCustomerController;
use App\Http\Controllers\Customer\OrderCancelController;
use Illuminate\Support\Facades\Artisan;

// use GuzzleHttp\Middleware;



// Route::get('/', function () {
//     return view('welcome');
// });

// optimiZe
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return 'DONE'; //Return anything
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product-details/{slug}', [HomeController::class, 'ProductDetails'])->name('product.details');
Route::get('/product-show/{id}', [HomeController::class, 'PopUpProduct'])->name('product.popup');
Route::get('/products', [HomeController::class, 'Products'])->name('productsList');
Route::get('/category/{slug}', [HomeController::class, 'CategoryWise'])->name('categoryWise.list');
Route::get('/SubCategory/{slug}', [HomeController::class, 'SubCategoryWise'])->name('SubCategoryWise.list');
Route::get('/subcategory/list/{slug}',[HomeController::class,'singleSubCategory'])->name('single.subcategory.list');
Route::get('/allproduct',[HomeController::class,'allProduct'])->name('all.product');

// company profile route

Route::get('/about-us', [HomeController::class, 'aboutWebsite'])->name('about.website');
Route::get('/trams-and-condition', [HomeController::class, 'tramsCondition'])->name('trams.website');

// news and event
Route::get('/news-and-event', [HomeController::class, 'newsEvent'])->name('news.list');
Route::get('/news-and-event-details/{slug}', [HomeController::class, 'newsDetails'])->name('news.details');
// page list
Route::get('/contact', [HomeController::class, 'contact'])->name('web.contact');
Route::post('/contact-store', [PublicMessageController::class, 'contactStore'])->name('contact.Store');
// Subscriber store
Route::post('/subscriber-store', [SubscriberController::class, 'subscriberList'])->name('subscriber.Store');



// serarch route
Route::get('/get_suggestions/{k}', [HomeController::class, 'getSearchSuggestions'])->name('searh.product');
Route::get('/search', [HomeController::class, 'productSearch'])->name('search');



// User Login
Route::get('/customer', [CustomerCustomerController::class, 'customer'])->name('customer.login');
Route::get('/customer/signUp', [CustomerCustomerController::class, 'signUp'])->name('customer.signup');
Route::post('/customer-auth', [CustomerCustomerController::class, 'AuthCheck'])->name('customer.auth');
Route::get('/customerPanel', [CustomerCustomerController::class, 'customerPanel'])->name('customer.panel');
Route::post('/customerStore', [CustomerCustomerController::class, 'customerStore'])->name('customerStore');
Route::get('/customer-resend-otp', [CustomerCustomerController::class, 'registerResendOtp'])->name('customer.resend.otp');
Route::get('/customer/otp', [CustomerCustomerController::class, 'acccountOpenOtp'])->name('customer.otp');
Route::post('/customer/verify', [CustomerCustomerController::class, 'acccountOpenOtpStore'])->name('customer.verify');
Route::put('/customer-Update', [CustomerCustomerController::class, 'customerUpdate'])->name('customerUpdate');
Route::put('/customer-password-update', [CustomerCustomerController::class, 'customerPasswordUpdate'])->name('customerPasswordUpdate');
Route::get('/customerLogout', [CustomerCustomerController::class, 'logout'])->name('customerLogout');
Route::get('/forget/password', [CustomerCustomerController::class, 'forgetPassword'])->name('forget.password');
Route::post('/forget/password/store', [CustomerCustomerController::class, 'forgetPasswordStore'])->name('forget.password.store');
Route::get('/forget/password/form', [CustomerCustomerController::class, 'forgetResetPasswordForm'])->name('forget.password.form');
Route::post('/forget/otp/check', [CustomerCustomerController::class, 'forgetPassOtpCheck'])->name('forget.password.otp.check');
Route::get('/forget/password/form/reset', [CustomerCustomerController::class, 'forgetPasswordResetForm'])->name('forget.password.reset.form');
Route::post('/forget/password/reset/change', [CustomerCustomerController::class, 'forgetpasswordResetUpdate'])->name('forget.password.reset.update');


// customer invoice
Route::get('/invoice-customer/{id}', [CustomerCustomerController::class, 'invoice'])->name('invoice.customer');
Route::post('/customer-invoice-remove/{id}', [OrderCancelController::class, 'deleteInvoice'])->name('invoice.remove');

// cart
Route::get('/cart', [CartController::class, 'cartList'])->name('cart.list');
Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');
Route::get('/cart-add/{id}', [CartController::class, 'addToCartAjax'])->name('cart.store.ajax');
Route::get('/cart-add/update/{id}', [CartController::class, 'addToCartAjaxUpdate'])->name('cart.increment.ajax.update');
Route::post('/cart-buy', [CartController::class, 'buyToCart'])->name('cart.buy');
Route::post('/update-cart', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/remove', [CartController::class, 'removeCart'])->name('cart.remove');
Route::post('/clear', [CartController::class, 'clearAllCart'])->name('cart.clear');

Route::get('/remove/{id}', [CartController::class, 'removeCartAjax'])->name('cart.remove.ajax');
Route::get('/cart-all', [CartController::class, 'cartAllData'])->name('cart.alldata');
Route::get('/cart-content', [CartController::class, 'cartContent'])->name('cart.content');
Route::get('/cart/decrement/{id}',[CartController::class,'decrement'])->name('decrement');
Route::get('/cart/increment/{id}',[CartController::class,'increment'])->name('increment');
Route::get('/cart-remove-auto',[CartController::class,'cartRemoveAuto'])->name('cart.remove.auto');
// Checkout route

Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout.user');
Route::post('/orderStore', [CheckoutController::class, 'orderStore'])->name('orderStore');
Route::get('/customer/order/cancel/{id}',[OrderCancelController::class,'cancel'])->name('customer.order.cancel');


Route::get('/time/show',[HomeController::class,'timeShow'])->name('time.show');
Route::get('/area/charge',[AreaController::class,'change'])->name('area.charge');
Route::get('/thana/change',[HomeController::class,'thanaChange'])->name('thana.change');
Route::get('/area/change',[HomeController::class,'areaChange'])->name('area.change');


// admin route
Route::get('/login',[AuthController::class, 'loginShow'])->name('login');


Route::post('/login',[AuthController::class, 'authCheck'])->name('login.check');
// Route::get('/otp',[AuthController::class, 'otp'])->name('login.otp');
// Route::post('/otp',[AuthController::class, 'otpCheck'])->name('otp.check');


// Route::group(['middleware' => ['auth','userLoginCheck']], function(){
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/invoice/{id}',[InvoiceController::class, 'invoice'])->name('invoice.admin');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.index');
    // customer prefix
    Route::prefix('customer')->group(function(){
        //customer route
            Route::get('customer',[CustomerController::class,'index'])->name('customer')->middleware('check');
            Route::get('customer/all',[CustomerController::class,'allData'])->name('customer.all')->middleware('check');
            Route::post('customer/store',[CustomerController::class,'store'])->name('customer.store');
            Route::get('customer/edit/{id}',[CustomerController::class,'edit'])->name('customer.edit')->middleware('check');
            Route::post('customer/update/',[CustomerController::class,'update'])->name('customer.update');
            Route::get('customer/delete/{id}',[CustomerController::class,'destroy'])->name('customer.delete');
            Route::get('/pending/customer',[CustomerController::class,'pending'])->name('customer.pending')->middleware('check');
            Route::get('/customer-list',[CustomerController::class,'customerList'])->name('customer.list')->middleware('check');
            Route::get('/active/customer/{id}',[CustomerController::class,'customerActive'])->name('customer.active');
            Route::get('/deactive/customer/{id}',[CustomerController::class,'customerDeactive'])->name('customer.deactive');
       
    });

    // Order Route
    Route::get('/order',[OrderController::class,'index'])->name('order.index')->middleware('check');
    Route::get('/order/offer-pending',[OrderController::class,'orderOfferPending'])->name('order.offer.pending')->middleware('check');
    Route::get('/onprocess',[OrderController::class,'onProcess'])->name('order.onProcess')->middleware('check');
    Route::get('/order-way',[OrderController::class,'ontheWay'])->name('order.way')->middleware('check');
    Route::get('offer/onprocess',[OrderController::class,'onProcess2'])->name('offer.onProcess')->middleware('check');
    Route::get('/offer-order-way',[OrderController::class,'ontheWay2'])->name('offer.way')->middleware('check');
    Route::get('/waiting-delivered',[OrderController::class,'waitingDelivered'])->name('waiting.delivered');

    Route::get('/share-sale-list',[OrderController::class,'shareSaleWay'])->name('share.sale.list');
    Route::get('/share-delivery-list',[OrderController::class,'offerDeliveryList'])->name('share.delivery.list');
    
    
    // customer delete invoice
    
    Route::get('/customer-delete-invoice',[OrderController::class,'deleteInvoiceList'])->name('customer-delete.invoice');
    // normal weating delivary
    Route::get('/normarl-waiting-delivered',[OrderController::class,'waitingDeliveredOne'])->name('waiting.delivered.normal');
    Route::get('/normarl-waiting-delivered/{id}',[OrderController::class,'watingDelivaryOne'])->name('normal.delivered');
    Route::get('/normal-delivered',[OrderController::class,'normaldelivered'])->name('order.normal.delivary');

    Route::get('/delivered',[OrderController::class,'delivered'])->name('order.delivary')->middleware('check');
    Route::get('/sales-report',[OrderController::class,'salesReport'])->name('sales.report')->middleware('check');
    Route::get('/sales-search',[OrderController::class,'searchSales'])->name('search.sales');
    Route::get('/order/record',[OrderController::class,'orderRecord'])->name('order.record');
    Route::get('/order/record/search',[OrderController::class,'orderRecordSearch'])->name('order.record.search');
    
    //   order process route
    Route::post('/order/pending/{id}',[OrderController::class,'pending'])->name('order.pending');
    Route::get('/offer/pending/{id}',[OrderController::class,'offerPending'])->name('offer.pending');
    Route::get('/offer/pending2/{id}',[OrderController::class,'offerPending2'])->name('offer.pending2');
    Route::get('/share/sale/{id}',[OrderController::class,'shareSale'])->name('share.sale');
    Route::post('/order/process/{id}',[OrderController::class,'process'])->name('order.process');
    Route::get('/order/way/{id}',[OrderController::class,'wayProcess'])->name('order.wayProcess');
    Route::post('/order/off_process/{id}',[OrderController::class,'process2'])->name('offer.process');
    Route::get('/order/off_way/{id}',[OrderController::class,'wayProcess2'])->name('offer.wayProcess');
    Route::get('/order/waiting-delivered/{id}',[OrderController::class,'waitingDelivery'])->name('waiting.delivery');
    Route::get('/order/details/{id}',[OrderController::class,'orderDetails'])->name('order.details.edit')->middleware('check');
    Route::get('/order/print/{id}',[OrderController::class,'orderPrint'])->name('order.print')->middleware('check');
    Route::get('/order/cancel/{id}',[OrderController::class,'cancel'])->name('order.cancel');
    Route::post('/order/edit/{id}',[OrderController::class,'orderEdit'])->name('order.edit')->middleware('check');
    Route::post('/order/delete/{id}',[OrderController::class,'destroy'])->name('product.order.delete');
    Route::get('/cancel/list',[OrderController::class,'cancelList'])->name('cancel.list');
    Route::get('/cancel-to-pending/{id}',[OrderController::class,'canceltoPending'])->name('cancel.to.pending');
    Route::get('/offer/delivery/{id}',[OrderController::class,'OfferorderDelivery'])->name('offer.delivery');
  
    Route::get('/product/delete/{id}',[OrderController::class,'orderProductDelete'])->name('order.product.delete');
    Route::get('/product/soft-delete/{id}',[OrderController::class,'orderSoftDelete'])->name('order.soft.delete');
    

    
    Route::prefix('product')->group(function(){
        // category route 

        
        // product prefix
        // Route::resource('/category', CategoryController::class)->except('create', 'show');

        // category route
        Route::get('/category',[CategoryController::class,'index'])->name('category.index')->middleware('check');
        Route::post('/category/store',[CategoryController::class,'store'])->name('category.store');
        Route::get('/category/edit/{slug}',[CategoryController::class,'edit'])->name('category.edit')->middleware('check');
        Route::put('/category/update/{id}',[CategoryController::class,'update'])->name('category.update');
        Route::delete('/category/{category}',[CategoryController::class,'destroy'])->name('category.destroy');

        Route::get('/category-list', [CategoryController::class, 'list'])->name('category.list')->middleware('check');
        Route::get('/category-rank', [CategoryController::class, 'rank'])->name('category.rank');
        Route::post('/rank-update', [CategoryController::class, 'rankStore'])->name('rank.update');

        // subcategory route
        // Route::resource('/subcategory', SubcategoryController::class)->except('create', 'show')->middleware('check');
         // category route
         Route::get('/subcategory',[SubcategoryController::class,'index'])->name('subcategory.index')->middleware('check');
         Route::post('/subcategory/store',[SubcategoryController::class,'store'])->name('subcategory.store');
         Route::get('/subcategory/edit/{id}',[SubcategoryController::class,'edit'])->name('subcategory.edit')->middleware('check');
         Route::put('/subcategory/update/{id}',[SubcategoryController::class,'update'])->name('subcategory.update');
         Route::delete('/subcategory/{id}',[SubcategoryController::class,'destroy'])->name('subcategory.destroy');

        Route::get('/subcategory-list', [SubcategoryController::class, 'list'])->name('subcategory.list')->middleware('check');
        // product route dfsdfs
        Route::get('/product-create', [ProductController::class, 'create'])->name('product.create')->middleware('check');
        Route::post('/product-store', [ProductController::class, 'store'])->name('product.store');

        Route::get('/subcategory/list/{id}', [ProductController::class, 'getSubcategory']);

        Route::get('/product', [ProductController::class, 'index'])->name('product.index');
        Route::delete('/product/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');
        Route::get('/product/edit/{slug}', [ProductController::class, 'edit'])->name('product.edit')->middleware('check');
        // update
        Route::put('/remove-other-image/{id}', [ProductController::class, 'update'])->name('product.update');
        // remove other image
        Route::delete('/remove-other-image/{id}', [ProductController::class, 'removeImage'])->name('remove.image');

        // color route
        Route::get('/color',[ColorController::class,'index'])->name('color.index')->middleware('check');
        Route::post('/color/store',[ColorController::class,'store'])->name('color.store');
        Route::get('/color/edit/{id}',[ColorController::class,'edit'])->name('color.edit')->middleware('check');
        Route::put('/color/update/{id}',[ColorController::class,'update'])->name('color.update');
        Route::delete('/color/{id}',[ColorController::class,'destroy'])->name('color.destroy');
        // size route
        Route::get('/size',[SizeController::class,'index'])->name('size.index')->middleware('check');
        Route::post('/size/store',[SizeController::class,'store'])->name('size.store');
        Route::get('/size/edit/{id}',[SizeController::class,'edit'])->name('size.edit')->middleware('check');
        Route::put('/size/update/{id}',[SizeController::class,'update'])->name('size.update');
        Route::delete('/size/{id}',[SizeController::class,'destroy'])->name('size.destroy');



    });
    // Website related all route here
    Route::prefix('website-content')->group(function(){
        Route::get('/welcome',[ContentController::class,'welcome'])->name('welcome')->middleware('check');
        Route::post('/welcome/update/{company}',[ContentController::class,'welcomeUpdate'])->name('welcome.update');
        Route::get('/company/service',[ContentController::class,'service'])->name('company.service')->middleware('check');

        // banner route
        Route::get('/banner',[BannerController::class,'index'])->name('company.banner')->middleware('check');
        Route::get('/banner/allDtata',[BannerController::class,'allData'])->name('banner.all')->middleware('check');
        Route::post('/banner/store',[BannerController::class,'store'])->name('banner.store');
        Route::get('/banner/edit/{id}',[BannerController::class,'edit'])->name('banner.edit')->middleware('check');
        Route::post('/banner/update',[BannerController::class,'update'])->name('banner.update');
        Route::get('/banner/delete/{id}',[BannerController::class,'destroy'])->name('banner.delete');

        // about us route
        Route::get('/about-us',[ContentController::class,'aboutUs'])->name('about.us')->middleware('check');
        Route::post('/about/update/{company}',[ContentController::class,'aboutUpdate'])->name('about.update');
        
        // mission vission route
        Route::get('/mission/vision',[ContentController::class,'mission'])->name('mission')->middleware('check');
        Route::post('/mission/vision/update',[ContentController::class,'missionUpdate'])->name('mission.update');
        
        // refund route
        Route::get('/refund',[ContentController::class,'refund'])->name('refund')->middleware('check');
        Route::post('/refund/update',[ContentController::class,'refundUpdate'])->name('refund.update');
        
        // faq route
        Route::get('/faq',[ContentController::class,'faq'])->name('faq')->middleware('check');
        Route::post('/faq/update',[ContentController::class,'faqUpdate'])->name('faq.update');

    
        // video route resource
        Route::resource('/video', VideoController::class)->except('create', 'show')->middleware('check');
        
        // photo gallery route resource
        Route::resource('/photo-gallery', PhotoGalleryController::class)->except('create', 'show')->middleware('check'); 
        
        // service
        Route::get('/service',[ServiceController::class,'index'])->name('service.index')->middleware('check');
        Route::get('/service/edit/{id}',[ServiceController::class,'edit'])->name('service.edit')->middleware('check');
        Route::post('/service-store',[ServiceController::class,'store'])->name('service.store');
        Route::post('/service/update/{id}',[ServiceController::class,'update'])->name('service.update');
        Route::post('/service/delete/{id}',[ServiceController::class,'destroy'])->name('service.delete');
    
        // Management route resource
        Route::get('/management',[ManagementController::class,'index'])->name('management.index')->middleware('check');
        Route::post('/management/store',[ManagementController::class,'store'])->name('management.store');
        Route::get('/management/edit/{management}',[ManagementController::class,'edit'])->name('management.edit')->middleware('check');
        Route::put('/management/update/{management}',[ManagementController::class,'update'])->name('management.update');
        Route::delete('/management/{management}',[ManagementController::class,'destroy'])->name('management.destroy');

        // team  route resource
        Route::get('/team',[TeamController::class,'index'])->name('team.index')->middleware('check');
        Route::post('/team/store',[TeamController::class,'store'])->name('team.store');
        Route::get('/team/edit/{team}',[TeamController::class,'edit'])->name('team.edit')->middleware('check');
        Route::put('/team/update/{team}',[TeamController::class,'update'])->name('team.update');
        Route::delete('/team/{team}',[TeamController::class,'destroy'])->name('team.destroy');

        //AdController Route
        Route::get('/ad',[AdController::class,'index'])->name('ad.index');
        Route::post('/ad/store',[AdController::class,'store'])->name('ad.store');
        Route::get('/ad/edit/{team}',[AdController::class,'edit'])->name('ad.edit')->middleware('check');
        Route::put('/ad/update/{team}',[AdController::class,'update'])->name('ad.update');
        Route::delete('/ad/{team}',[AdController::class,'destroy'])->name('ad.destroy');
        Route::get('/ad/active/{id}',[AdController::class,'active'])->name('ad.active');

         //Partner Route
        Route::get('/partner',[PartnerController::class,'index'])->name('partner.index')->middleware('check');
        Route::post('/partner/store',[PartnerController::class,'store'])->name('partner.store');
        Route::get('/partner/edit/{id}',[PartnerController::class,'edit'])->name('partner.edit')->middleware('check');
        Route::put('/partner/update/{id}',[PartnerController::class,'update'])->name('partner.update');
        Route::delete('/partner/{id}',[PartnerController::class,'destroy'])->name('partner.destroy');
         
        //Blog Route
        Route::get('/news-and-event',[BlogController::class,'index'])->name('blog.index')->middleware('check');
        Route::post('/blog/store',[BlogController::class,'store'])->name('blog.store');
        Route::get('/news-and-event/{id}',[BlogController::class,'edit'])->name('blog.edit')->middleware('check');
        Route::put('/blog/update/{id}',[BlogController::class,'update'])->name('blog.update');
        Route::delete('/blog/{id}',[BlogController::class,'destroy'])->name('blog.destroy');

    });
        // setting all route here
    Route::prefix('setting')->group(function(){

            // time set route
            Route::get('/time-set',[TimeSetController::class,'setTime'])->name('set-time');
            Route::post('/time-set-store',[TimeSetController::class,'setTimeStore'])->name('set-time.store');
            Route::delete('/time-set-delete/{id}',[TimeSetController::class,'destroy'])->name('set-time.delete');
            Route::get('/time-set-show/{id}',[TimeSetController::class,'show'])->name('set-time.show');
            // company profile 
            Route::get('company-profile', [ContentController::class, 'edit'])->name('profile.edit');
            Route::put('company-profile/{company}', [ContentController::class, 'update'])->name('profile.update');
            Route::get('/admin/phone/edit',[ContentController::class,'adminPhone'])->name('admin.phone.edit')->middleware('check');
            Route::get('/user/phone/edit',[ContentController::class,'userPhone'])->name('user.phone.edit')->middleware('check');
            Route::post('/admin/phone/update',[ContentController::class,'adminPhoneUpdate'])->name('admin.phone.update');
            Route::post('/user/phone/update',[ContentController::class,'userPhoneUpdate'])->name('user.phone.update');
            //country route
            Route::resource('/country',CountryController::class)->middleware('check');
            //area route
            Route::get('/area',[AreaController::class,'index'])->name('area.index')->middleware('check');
            Route::post('/area/store',[AreaController::class,'store'])->name('area.store');
            Route::get('/area/edit/{id}',[AreaController::class,'edit'])->name('area.edit')->middleware('check');
            Route::put('/area/update/{id}',[AreaController::class,'update'])->name('area.update');
            Route::delete('/area/{id}',[AreaController::class,'destroy'])->name('area.destroy');
            
            Route::get('/thana',[ThanaController::class,'index'])->name('thana.index')->middleware('check');
            Route::post('/thana/store',[ThanaController::class,'store'])->name('thana.store');
            Route::get('/thana/edit/{id}',[ThanaController::class,'edit'])->name('thana.edit')->middleware('check');
            Route::put('/thana/update/{id}',[ThanaController::class,'update'])->name('thana.update');
            Route::delete('/thana/{id}',[ThanaController::class,'destroy'])->name('thana.destroy');

            Route::get('/page/list',[PagelistController::class,'index'])->name('page.list')->middleware('check');
            Route::post('/page/active',[PagelistController::class,'active'])->name('page.active');
            
            Route::get('/sms/sending',[MessageSendingController::class,'smsSending'])->name('sms.sending')->middleware('check');
            Route::post('/sms/send/menualy',[MessageSendingController::class,'smsSentAll'])->name('sent.sms.multiple');
            Route::get('/sms/all',[MessageSendingController::class,'sms'])->name('sms')->middleware('check');

            //pages route
            
            Route::get('/page',[PageController::class,'index'])->name('page.index')->middleware('check');
            Route::post('/page/store',[PageController::class,'store'])->name('page.store');
            Route::get('/permission',[PermissionController::class,'index'])->name('permission.index')->middleware('check');
            Route::get('/permission/edit/{id}', [PermissionController::class, 'permission'])->name('permission.edit')->middleware('check');
            Route::post('/permission/store/{id}', [PermissionController::class, 'store'])->name('permission.store');
            Route::get('/action-permission/{id}',[PermissionController::class,'permissionTwo'])->name('action.permission');
            Route::post('/action-permission/{id}',[PermissionController::class,'permissionAction'])->name('permission.two.action');
            
            // Admin Register
            Route::get('user-create', [UserController::class, 'register'])->name('user.index')->middleware('check');
            Route::post('user-store', [UserController::class, 'createUser'])->name('user.store');
            Route::get('user-edit/{id}', [UserController::class, 'edit'])->name('user.edit')->middleware('check');
            Route::put('user-update/{id}', [UserController::class, 'updateUser'])->name('user.update');
            Route::delete('user-delete/{id}', [UserController::class, 'deleteUser'])->name('user.destroy');
            Route::get('/password/change', [UserController::class, 'passwordChange'])->name('password.change');
            Route::post('/password/update', [UserController::class, 'passwordUpdate'])->name('password.update');

            Route::get('/offer',[OfferController::class,'index'])->name('customer.offer');
            Route::post('/offer/update/{offer}',[OfferController::class,'update'])->name('offer.update');
    });

        // subscriber route 
        Route::get('/subscriber',[SubscriberController::class,'index'])->name('subscriber.list')->middleware('check');
        // Public message route 
        Route::get('/feedback',[PublicMessageController::class,'index'])->name('public.sms')->middleware('check');

// });

   

