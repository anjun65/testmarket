<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Models\Banner;
use App\Product;


class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $banners = Banner::where("is_show", 1)->latest()->get();
        $bannercount = $banners->count();
        $categories = Category::take(6)->get();
        $products = Product::with(['galleries'])->latest()->take(8)->get();
        
        return view('pages.home', [
            'banners'=> $banners,
            'bannercount'=> $bannercount,
            'categories'=> $categories,
            'products' => $products
        ]);

        
    }
}
