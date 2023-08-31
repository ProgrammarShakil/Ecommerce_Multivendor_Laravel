<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {

        $categories = Category::get();

        return view('admin_dashboard.pages.categories.index')->with('categories', $categories);
    }

    public function create()
    {
        return view('admin_dashboard.pages.categories.create');
    }

    public function store()
    {
        request()->validate([
            'category_name' => 'required|unique:categories,id',
            'category_status' => 'required'
        ]);

        $category_name = request('category_name');
        $data = [
            'name' => $category_name,
            'slug' => Str::slug($category_name),
            'status' => request('category_status'),
        ];

        try{
            Category::create($data);
            return redirect()->route('admin_dashboard.category.index')->with('successMessage', 'Category Added Successfully');
        }catch ( Exception $e){
            $e->getMessage();
            return redirect()->back()->withInput()->with('errorMessage', 'Please Type Unique Name');
        }

    }

    public function edit($id)
    {
       $category = Category::find($id);
        return view('admin_dashboard.pages.categories.edit')->with('category', $category);
    }

    public function update($id)
    {
        request()->validate([
            'category_name' => 'required|unique:categories,id',
            'category_status' => 'required'
        ]);

        $category_name = request('category_name');
        $data = [
            'name' => $category_name,
            'slug' => Str::slug($category_name),
            'status' => request('category_status'),
        ];

        $category = Category::find($id);
        try{
            $category->update($data);
            return redirect()->route('admin_dashboard.category.index')->with('successMessage', 'Category Updated Successfully');
        }catch ( Exception $e){
            $e->getMessage();
            return redirect()->back()->withInput()->with('errorMessage', 'Please Type Unique Name');
        }
    }

    public function delete($id)
    {
        $category = Category::find($id);
        try{
            $category->delete();
            return redirect()->back()->with('successMessage', 'Category Deleted Successfully');
        }catch (Exception $e){
            $e->getMessage();
            return redirect()->back()->with('errorMessage', 'Please Try Again');
        }
    }
}
