@extends('user_dashboard.layouts.app')

@section('user_dashboard_content')
    <div class="container">
        <!-- DataTales -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="m-0 font-weight-bold text-primary">Create User</h6>
                    </div>
                    <div><a href="{{ route('user_dashboard.user.index') }}"><button
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
                            <label for="name">User Name</label>
                            <input type="text" name="name" class="form-control" id="name"
                                value="{{ old('name') }}">

                            <label class="mt-3" for="email">User Email</label>
                            <input type="email" name="email" class="form-control" id="email"
                                value="{{ old('email') }}">

                            <label class="mt-3" for="password">User Password</label>
                            <input type="password" name="password" class="form-control" id="password">

                            <label class="mt-3" for="password_confirmation">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                id="password_confirmation">

                            <label class="mt-3" for="roles">Assign Role</label>
                            <select class="select2 form-control" name="roles[]" id="roles" multiple>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Add</button>
                </form>

            </div>
        </div>
    </div>
@endsection
