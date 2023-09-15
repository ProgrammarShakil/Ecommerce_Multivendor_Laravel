@extends('user_dashboard.layouts.app')

@section('user_dashboard_content')
    <div class="container">
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                toastr.options.closeButton = true;
                toastr.error('{{$error}}');
            });
        </script>
        @endforeach
    @endif
    @if (session()->has('errorMessage'))
         <script>
            document.addEventListener('DOMContentLoaded', function() {
                toastr.options.closeButton = true;
                toastr.error('{{session('errorMessage')}}');
            });
        </script>
    @endif

    @if (session()->has('successMessage'))
    <script>
       document.addEventListener('DOMContentLoaded', function() {
           toastr.options.closeButton = true;
           toastr.success('{{session('successMessage')}}');
       });
   </script>
   @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="m-0 font-weight-bold text-primary">All Roles</h6>
                    </div>
                    <div><a href="{{ route('user_dashboard.role_permission.create') }}"><button
                                class="btn btn-primary btn-sm">Create</button></a></div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Serial</th>
                                <th>Roles List</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{$role->name}}</td>
                                    <td>
                                        <div class="d-flex justify-content-start">
                                            <div>
                                                <a href="{{ route('user_dashboard.role_permission.edit', $role->id) }}">
                                                    <button class="btn btn-primary btn-sm">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                </a>
                                            </div>
                                            <div class="ml-2">
                                                <form
                                                    action="{{ route('user_dashboard.role_permission.destroy', $role->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('Are you Sure?')" type="submit" class="btn btn-danger btn-sm">
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
@endsection
