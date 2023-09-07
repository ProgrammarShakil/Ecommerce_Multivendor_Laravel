<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $data = [];
        $data['categories'] = Category::get();
        return view('frontend.pages.index');
    }
    public function shop()
    {
        return view('frontend.pages.shop');
    }
    public function shopDetails()
    {
        return view('frontend.pages.shop_details');
    }
    public function cart()
    {
        return view('frontend.pages.cart');
    }
    public function checkout()
    {
        return view('frontend.pages.checkout');
    }
    public function contact()
    {
        return view('frontend.pages.contact');
    }
    public function categories($id)
    {

        $category = Category::find($id);
        return view('frontend.pages.categories',compact('category'));
    }
}
