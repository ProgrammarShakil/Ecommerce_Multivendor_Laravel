@extends('user_dashboard.layouts.app')

@section('user_dashboard_content')
    <div class="container">
        <!-- DataTales -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="m-0 font-weight-bold text-primary">Create New Blog</h6>
                    </div>
                    <div><a href="{{ route('user_dashboard.blog.index') }}"><button
                                class="btn btn-primary btn-sm">Back</button></a></div>
                </div>
            </div>
            <div class="card-body">

                <form action="{{ route('user_dashboard.user.store') }}" method="POST">

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
                        <div class="col-md-12 mb-3">
                            <label for="name">Blog Title</label>
                            <input class="summernote" type="text" name="name" class="form-control" class="name"
                                value="{{ old('name') }}">

                            <label class="mt-3" for="email">Blog Category</label>
                            <input class="summernote" type="email" name="email" class="form-control" id="email"
                                value="{{ old('email') }}">

                            <label class="mt-3" for="password">Blog Description</label>
                            <textarea class="summernote" name="" id="" cols="30" rows="10"></textarea>

                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Add</button>
                </form>

            </div>
        </div>
    </div>
@endsection
