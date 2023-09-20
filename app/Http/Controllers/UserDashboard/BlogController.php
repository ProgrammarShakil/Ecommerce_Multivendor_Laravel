<?php

namespace App\Http\Controllers\UserDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{

    public $user;

    public function __construct()
    {
        $this->middleware(function($request, $next){
            $this->user = Auth::guard('web')->user();
            return $next($request);
        });
    }
    public function index(){
        if(is_null($this->user) || !$this->user->can('user_dashboard.pages.blog.index')){
            abort(403, 'Unauthorized');
        }
        return view('user_dashboard.pages.blog.index');
    }

    public function create(){
        return view('user_dashboard.pages.blog.create');
    }

    public function store(){
        return "Store Function Fired";
    }

    public function edit(){
        return view('user_dashboard.pages.blog.edit');
    }

    public function update(){
        return "Update Function Fired";
    }

    public function delete(){
        return "Delete Function Fired";
    }
}
