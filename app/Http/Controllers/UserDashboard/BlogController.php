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
        if(is_null($this->user) || !$this->user->can('user_dashboard.pages.blog.create')){
            abort(403, 'Unauthorized');
        }
        return view('user_dashboard.pages.blog.create');
    }

    public function store(){
        return "Store Function Fired";
    }

    public function edit(){
        if(is_null($this->user) || !$this->user->can('user_dashboard.pages.blog.edit')){
            abort(403, 'Unauthorized');
        }
        return view('user_dashboard.pages.blog.edit');
    }

    public function update(){
        if(is_null($this->user) || !$this->user->can('user_dashboard.pages.blog.update')){
            abort(403, 'Unauthorized');
        }
        return "Update Function Fired";
    }

    public function delete(){
        if(is_null($this->user) || !$this->user->can('user_dashboard.pages.blog.delete')){
            abort(403, 'Unauthorized');
        }
        return "Delete Function Fired";
    }
}
