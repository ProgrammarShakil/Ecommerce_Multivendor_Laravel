<?php

namespace App\Http\Controllers\UserDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
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
