@extends('admin_dashboard.layouts.app')

@section('admin_dashboard_content')
    <!-- Begin Page Content -->
    <div class="container">
        <!-- DataTales -->
        @if (session()->has('successMessage'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    toastr.options.closeButton = true;
                    toastr.success('{{ session('successMessage') }}');
                });
            </script>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="m-0 font-weight-bold text-primary">All Products</h6>
                    </div>
                    <div><a href="{{ route('admin_dashboard.product.create') }}"><button
                                class="btn btn-primary btn-sm">Create</button></a></div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->admin->name }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>
                                        @if ($product->status == 1)
                                            <span class="text-success">Active</span>
                                        @else
                                            <span class="text-danger">Draft</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($product->product_image_path == "default.png")
                                            <img src="{{ asset('uploads/products/images/default.png') }}"
                                                width="50px">
                                        @else
                                            <img src="{{ asset('uploads/products/images/' . $product->product_image_path) }}"
                                                width="50px">
                                        @endif


                                    <td>
                                        <div class="d-flex justify-content-start">
                                            <div>
                                                <a href="{{ route('admin_dashboard.product.edit', $product->id) }}">
                                                    <button class="btn btn-primary btn-sm">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                </a>
                                            </div>
                                            <div class="ml-2">
                                                <form action="{{ route('admin_dashboard.product.delete', $product->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('Are you Sure?')" type="submit"
                                                        class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
