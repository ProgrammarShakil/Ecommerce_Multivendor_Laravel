<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;



class FrontendController extends Controller
{
    public function index()
    {
        // data show from cache, if doesn't exists - query from database
        // but if new post create need to trigger a event at model

        $products = cache('products', function () {
            return Product::with('category', 'admin')->get();
        });

        return view('frontend.pages.index', compact('products'));
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

        $category = Category::with('products')->find($id);
        return view('frontend.pages.categories', compact('category'));
    }


    public function userVerification($token)
    {
        if ($token === null) {
            session()->flash('message', 'Invalid Token');
            return redirect()->route('login');
        }

        $user = User::where('email_verification_token', $token)->first();

        if ($user === null) {
            session()->flash('message', 'Invalid User');
            return redirect()->route('login');
        }

        $user->update([
            'email_verified' => 1,
            'email_verified_at' => Carbon::now(),
            'email_verification_token' => '',
        ]);

        session()->flash('message', 'Your Account is Verified Successfully');
        return redirect()->route('user_dashboard.index');
    }
}
