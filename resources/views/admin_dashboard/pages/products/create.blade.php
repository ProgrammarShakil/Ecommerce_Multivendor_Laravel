@extends('admin_dashboard.layouts.app')

@section('admin_dashboard_content')
    <!-- Begin Page Content -->
    <div class="container">
        <!-- DataTales -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="m-0 font-weight-bold text-primary">Create Product</h6>
                    </div>
                    <div><a href="{{ route('admin_dashboard.product.index') }}"><button
                                class="btn btn-primary btn-sm">Back</button></a></div>
                </div>
            </div>
            <div class="card-body">

                <form action="{{ route('admin_dashboard.product.store') }}" method="POST" enctype="multipart/form-data">

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    toastr.options.closeButton = true;
                                    toastr.error('{{ $error }}');
                                });
                            </script>
                        @endforeach
                    @endif
                    @if (session()->has('errorMessage'))
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                toastr.options.closeButton = true;
                                toastr.error('{{ session('errorMessage') }}');
                            });
                        </script>
                    @endif

                    @csrf
                    @method('POST')
                    <div class="form-row">

                        <input type="hidden" name="admin_id" class="form-control" value="{{ auth()->guard('admin')->user()->id }}">

                        <div class="col-md-6 mb-3">
                            <label for="product_title">Product Title</label>
                            <input type="text" name="product_title" class="form-control" placeholder=""
                                value="{{ old('product_title') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="product_status">Product Status</label>
                            <select name="product_status" class="custom-select">
                                <option selected value="1">Active</option>
                                <option value="0">Draft</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="category_id">Category</label>
                            <select name="category_id" class="custom-select">
                                <option value="4">4</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="product_image_path">Product Image</label> <br>
                            <input class="form-control" value="{{old('product_image_path')}}" type="file" name="product_image_path">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="product_description">Product Description</label>
                            <textarea class="form-control" name="product_description" cols="10" rows="4">{{old('product_description')}}</textarea>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Add</button>
                </form>

            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
