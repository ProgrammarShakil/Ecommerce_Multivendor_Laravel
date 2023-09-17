@extends('user_dashboard.layouts.app')

@section('user_dashboard_content')
    <div class="container">
        <!-- DataTales -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="m-0 font-weight-bold text-primary">Create Category</h6>
                    </div>
                    <div><a href="{{ route('user_dashboard.role_permission.index') }}"><button
                                class="btn btn-primary btn-sm">Back</button></a></div>
                </div>
            </div>
            <div class="card-body">

                <form action="{{ route('user_dashboard.role_permission.store') }}" method="POST">

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
                            <label for="role_name">Role Name</label>
                            <input type="text" name="role_name" class="form-control" id="role_name" placeholder=""
                                value="{{ old('role_name') }}">
                        </div>
                    </div>

                    <div>
                        {{-- select all --}}
                        <div class="form-check my-3">
                            <input type="checkbox" onchange="checkAll(this)" id="selectAll" class="form-check-input">
                            <label for="selectAll">Select All</label>
                        </div>
                        {{-- select all --}}

                        @php $index = 1; @endphp
                        @foreach ($permission_group as $group)
                            <div class="row">

                                {{-- check groups --}}
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input
                                            onchange="checkPermissionGroup('role-{{ $index }}-management-checkbox', this)"
                                            value=" {{ $group->group_name }}" id="{{ $index }}-management"
                                            type="checkbox" name="group_name" class="form-check-input">
                                        <label for="{{ $index }}-management"> {{ $group->group_name }}</label>
                                    </div>
                                </div>
                                {{-- check groups --}}

                                {{-- check boxes --}}
                                <div class="col-md-6 mb-3 role-{{ $index }}-management-checkbox">

                                    @php
                                        $get_permission_names_by_group_name = App\Models\User::getPermissionNamesByGroupName($group->group_name);
                                    @endphp

                                    @php $nested_index = 1; @endphp
                                    @foreach ($get_permission_names_by_group_name as $permission)
                                        <div class="form-check">
                                            <input class="" value="{{ $permission->name }}"
                                                id="checkPermission-{{ $permission->id }}" type="checkbox"
                                                name="permissions[]" class="form-check-input">
                                            <label for="checkPermission-{{ $permission->id }}">
                                                {{ $permission->name }}</label>
                                        </div>
                                        @php $nested_index++; @endphp
                                    @endforeach
                                </div>
                                {{-- check boxes --}}

                            </div>
                            @php $index++; @endphp
                        @endforeach
                    </div>
                    <button class="btn btn-primary" type="submit">Add</button>
                </form>

            </div>
        </div>
    </div>
    <script>
        let check_boxes = document.querySelectorAll("input[type='checkbox']");

        function checkAll(myCheckbox) {
            if (myCheckbox.checked == true) {
                check_boxes.forEach(checkbox => {
                    checkbox.checked = true
                });
            } else {
                check_boxes.forEach(checkbox => {
                    checkbox.checked = false
                });
            }
            if (check_boxes.length == 0) {
                myCheckbox.checked == false
            }
        }

        function checkPermissionGroup(className, checkThis) {
            const groupIdName = document.getElementById(checkThis.id);
            const classCheckboxes = document.querySelectorAll('.' + className + ' input');

            if (groupIdName.checked) {
                classCheckboxes.forEach(checkbox => {
                    checkbox.checked = true;
                });
            } else {
                classCheckboxes.forEach(checkbox => {
                    checkbox.checked = false;
                });
            }
        }
    </script>
@endsection
