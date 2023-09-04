<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {

        $products = Product::get();

        return view('admin_dashboard.pages.products.index')->with('products', $products);
    }

    public function create()
    {
        return view('admin_dashboard.pages.products.create');
    }

    public function store()
    {
        request()->validate([
            'admin_id' => 'required',
            'category_id' => 'required',
            'product_title' => 'required',
            'product_description' => 'required',
            'product_image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'product_status' => 'required',
        ]);

        $product_image_path = request()->file('product_image_path');

        if ($product_image_path) {
            $file_name = uniqid('product_photo_', 10) . '.' . $product_image_path->getClientOriginalExtension();
            $product_image_path->move('uploads/products/images', $file_name);
        }


        $data = [
            'admin_id' => request('admin_id'),
            'category_id' => request('category_id'),
            'title' => request('product_title'),
            'description' => request('product_description'),
            'product_image_path' => $file_name,
            'status' => request('product_status'),
        ];
        try {
            Product::create($data);
            return redirect()->route('admin_dashboard.product.index')->with('successMessage', 'Product Added Successfully');
        } catch (Exception $e) {
            $e->getMessage();
            return redirect()->back()->withInput()->with('errorMessage', 'Cant Add, Try Again');
        }
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin_dashboard.pages.products.edit')->with('product', $product);
    }

    public function update($id)
    {
        request()->validate([
            'admin_id' => 'required',
            'category_id' => 'required',
            'product_title' => 'required',
            'product_description' => 'required',
            'product_image_path' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'product_status' => 'required',
        ]);

        $product = Product::find($id);
        $product_image_path = request()->file('product_image_path');

        if ($product_image_path) {

            if (!($product->product_image_path == 'default.png')) {
                unlink(public_path('uploads/products/images/' . $product->product_image_path));
            }

            $file_name = uniqid('product_photo_', 10) . '.' . $product_image_path->getClientOriginalExtension();
            $product_image_path->move('uploads/products/images', $file_name);
        }else{
            $file_name = request('product_image_path_update');
        }
        $data = [
            'admin_id' => request('admin_id'),
            'category_id' => request('category_id'),
            'title' => request('product_title'),
            'description' => request('product_description'),
            'product_image_path' => $file_name,
            'status' => request('product_status'),
        ];
        try {
            $product->update($data);
            return redirect()->route('admin_dashboard.product.index')->with('successMessage', 'Product Updated Successfully');
        } catch (Exception $e) {
            $e->getMessage();
            return redirect()->back()->withInput()->with('errorMessage', 'Cant Add, Try Again');
        }
    }

    public function delete($id)
    {
        $product = Product::find($id);

        try {
            if (!($product->product_image_path == 'default.png')) {
                unlink(public_path('uploads/products/images/' . $product->product_image_path));
            }

            $product->delete();

            return redirect()->back()->with('successMessage', 'Product Deleted Successfully');
        } catch (Exception $e) {

            $e->getMessage();
            return redirect()->back()->with('errorMessage', 'Please Try Again');
        }
    }
}
