@extends('admin_dashboard.layouts.app')

@section('admin_dashboard_content')
    <!-- Begin Page Content -->
    <div class="container">
        <!-- DataTales -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="m-0 font-weight-bold text-primary">Edit Category</h6>
                    </div>
                    <div><a href="{{ route('admin_dashboard.category.index') }}"><button
                                class="btn btn-primary btn-sm">Back</button></a></div>
                </div>
            </div>
            <div class="card-body">

                <form action="{{ route('admin_dashboard.category.update', $category->id) }}" method="POST">

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
                    @method('PUT')
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="category-name">Category Name</label>
                            <input type="text" name="category_name" class="form-control" id="category-name"
                                placeholder="" value="{{ $category->name }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="category-name">Category Status</label>
                            <select name="category_status" class="custom-select">
                                <option @if ($category->status == 1) selected @endif value="1">
                                    Active</option>
                                <option @if ($category->status == 0) selected @endif value="0">
                                    Draft</option>
                            </select>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Update</button>
                </form>

            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
