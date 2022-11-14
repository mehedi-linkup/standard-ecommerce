<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Permission;
use Facade\FlareClient\View;
use App\Models\CompanyProfile;
use App\Models\Offer;
use App\Models\Purchage;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // view()->share('permissions', Permission::all())->get();
        
        $permissions = Permission::where('user_id', Auth::id())->get();
        view()->share('permissions', $permissions);


        Paginator::useBootstrap();
        view()->share('content', CompanyProfile::first());
        view()->share('category', Category::OrderBy('rank_id','ASC')->get());
        view()->share('randCategory', Category::inRandomOrder()->limit(5)->get());
        view()->share('offer',Offer::first());
    }
}
