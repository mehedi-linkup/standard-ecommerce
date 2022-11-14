<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Area;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Product;
use App\Models\Category;
use App\Models\CompanyProfile;
use App\Models\DeliveryTime;
use App\Models\Management;
use App\Models\Partner;
use App\Models\Service;
use App\Models\SubCategory;
use App\Models\Team;
use App\Models\Thana;
use Illuminate\Http\Request;
use PharIo\Manifest\Manifest;

class HomeController extends Controller
{
    public function index()
    {
        $banner = Banner::latest()->get();
        $category = Category::with('SubCategory')->orderBy('rank_id', 'ASC')->get();
        $recent = Product::latest()->take(24)->get();
        $popular = Product::latest()->where('is_popular', '1')->limit(24)->get();
        $new_arrival = Product::where('is_arrival', '1')->get();
        $home = Product::where('category_id', '8')->inRandomOrder()->limit(12)->get();
        $fullAd = Ad::where('status', 'a')->where('position', '5')->inRandomOrder()->limit(1)->get();
        $partner = Partner::latest()->get();
        $cartAll = \Cart::getContent();
        return view('website.index', compact('banner', 'category',  'new_arrival', 'cartAll', 'fullAd', 'popular', 'home', 'recent'));
    }


    public function ProductDetails($slug)
    {
        $product = Product::with('category')->where('slug', $slug)->first();
        if (isset($product->sub_category_id)) {
            $subCategory_id = $product->sub_category_id;
            $related = Product::where('sub_category_id', '=', $subCategory_id)->where('id', '!=', $product->id)->get();
        } else {
            $category_id = $product->category_id;
            $related = Product::where('category_id', '=', $product->category->id)->where('id', '!=', $product->id)->limit('12')->get();
        }
        return view('website.productDetails', compact('product', 'related'));
    }


    // product details popup
    public function PopUpProduct($id)
    {
        $product = Product::with(['category', 'productImage'])->where('id', $id)->first();
        //  $product::with()->productImage['otherImage'] = asset($product->otherImage);
        $product['otherImage'] = $product->product_image;

        $product['image'] = asset('uploads/product/' . $product->image);
        return response()->json($product);
    }



    public function CategoryWise($slug)
    {
        $centerBigAds = Ad::where('status', 'a')->where('position', '4')->inRandomOrder()->limit(1)->get();
        $category_list = Category::where('slug', $slug)->first();
        $categories = Category::all();
        $category_wise_product = $category_list->product()->inRandomOrder()->get();
        return view('website.category', compact('categories', 'category_wise_product', 'centerBigAds', 'category_list'));
    }
    public function singleSubCategory($slug)
    {
        $Categorylist = Category::where('slug', $slug)->first();

        return view('website.subcategory_list', compact('Categorylist'));
    }

    public function Products()
    {
        $category = Category::latest()->get();
        $product = Product::inRandomOrder()->paginate(5);
        $centerBigAds = Ad::where('status', 'a')->where('position', '4')->inRandomOrder()->limit(1)->get();
        $leftAds = Ad::where('status', 'a')->where('position', '1')->inRandomOrder()->limit(1)->get();
        return view('website.productsList', compact('product', 'category', 'centerBigAds', 'leftAds'));
    }


    public function SubCategoryWise($slug)
    {
        $subcategory = SubCategory::where('slug', $slug)->first();
        $categories = Category::all();
        $subcategory_wise_product = $subcategory->product()->inRandomOrder()->get();
        $centerBigAds = Ad::where('status', 'a')->where('position', '4')->inRandomOrder()->limit(1)->get();
        $leftAds = Ad::where('status', 'a')->where('position', '1')->inRandomOrder()->limit(1)->get();
        return view('website.subcategory', compact('subcategory', 'categories', 'subcategory_wise_product', 'centerBigAds', 'leftAds'));
    }

    public function newsEvent()
    {
        $news = Blog::latest()->get();
        return view('website.newsEvent', compact('news'));
    }

    public function newsDetails($slug)
    {
        $category = Category::inRandomOrder()->limit(5)->get();
        $newArrival = Product::inRandomOrder()->limit(5)->get();
        $news = Blog::where('slug', $slug)->first();
        return view('website.newsDetails', compact('news', 'category', 'newArrival'));
    }
    public function contact()
    {
        return view('website.contact');
    }


    public function aboutWebsite()
    {
        $service = Service::latest()->get();
        $management = Management::all();
        return view('website.about', compact('management', 'service'));
    }
    public function tramsCondition()
    {
        return view('website.trams_condition');
    }

    // search
    public function getSearchSuggestions($keyword)
    {
        $product = Product::select('name')
            ->where('name', 'like', "%$keyword%")
            ->get()->toArray();

        $category = Category::select('name as name')
            ->where('name', 'like', "%$keyword%")
            ->get()->toArray();

        $subcategory = SubCategory::select('name as name')
            ->where('name', 'like', "%$keyword%")
            ->get()->toArray();

        $mergedArray = array_merge($product, $category, $subcategory);

        $search_results = [];

        foreach ($mergedArray as $sr) {
            $search_results[] = $sr['name'];
        }

        return response()->json($search_results);
    }

    public function productSearch()
    {
        if (request()->query('q')) {

            $categories = Category::all();
            $centerBigAds = Ad::where('status', 'a')->where('position', '4')->take(1)->get();
            $leftAds = Ad::where('status', 'a')->where('position', '1')->latest()->take(1)->get();

            $keyword = request()->query('q');
            $search_result = Product::Where('name', 'like', "%$keyword%")->get();

            return view('website.search', compact('search_result', 'keyword', 'leftAds', 'centerBigAds', 'categories'));
        }

        return redirect()->back();
    }

    public function allProduct()
    {
        $recent = Product::latest()->paginate(72);
        return view('website.allProduct', compact('recent'));
    }

    public function timeShow(Request $request)
    {
        $d_number = $request->day_pass;
        if ($d_number == 'Sat') {
            return  $time = DeliveryTime::where('group_id', 1)->get();
        } elseif ($d_number == 'Sun') {
            return $time = DeliveryTime::where('group_id', 2)->get();
        } elseif ($d_number == 'Mon') {
            return $time = DeliveryTime::where('group_id', 3)->get();
        } elseif ($d_number == 'Tue') {
            return  $time = DeliveryTime::where('group_id', 4)->get();
        } elseif ($d_number == 'Wed') {
            return  $time = DeliveryTime::where('group_id', 5)->get();
        } elseif ($d_number == 'Thu') {
            return $time = DeliveryTime::where('group_id', 6)->get();
        } else {
            return  $time = DeliveryTime::where('group_id', 7)->get();
        }
    }

    public function thanaChange(Request $request)
    {
        $thana = Thana::where('district_id', $request->district_id)->get();
        return response()->json($thana);
    }

    public function areaChange(Request $request)
    {
        $thana = Area::where('thana_id', $request->thana_id)->get();
        return response()->json($thana);
    }
}
