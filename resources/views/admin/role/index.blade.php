@extends('layouts.dashboard')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Role Manager</a></li>
        </ol>
    </div>
    <div class="row">

        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <div class="cart-tittle">
                        Role Manager
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">

                            <tr>
                                <th>SL</th>
                                <th>Role Name</th>
                                <th>Permission</th>
                                <th>Action</th>
                            </tr>

                            @foreach ($roles as $key => $role)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @foreach ($role->getPermissionNames() as $permissions)
                                            {{ $permissions }},
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('edit.permissions', $role->id) }}"
                                            class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                                class="fa fa-pencil"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                        </table>
                    </div>
                </div>

            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <div class="cart-tittle">
                        User List
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">

                            <tr>
                                <th>SL</th>
                                <th>User Name</th>
                                <th>Role</th>
                                <th>Permission</th>
                                <th>Action</th>

                            </tr>

                            @foreach ($users as $key => $user)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        @forelse ($user->getRoleNames() as $role)
                                            {{ $role }},
                                        @empty
                                            Not Assigned Yet!
                                        @endforelse
                                    </td>
                                    <td>
                                        @forelse ($user->getAllPermissions() as $permissions)
                                            {{ $permissions->name }},
                                        @empty
                                            Not Assigned Yet!
                                        @endforelse
                                    </td>
                                    <td>

                                        <div class="d-flex">
                                            <a href="{{ route('edit.role.permissions', $user->id) }}"
                                                class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                                    class="fa fa-pencil"></i></a>
                                            <a href="{{ route('role.permission', $user->id) }}"
                                                class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>

                                            {{-- <button name="{{ route('categorySoft.delete', $category->id) }}"
                                                type="button" class="delete_btn btn btn-danger shadow btn-xs sharp"><i
                                                    class="fa fa-trash"></i></button> --}}
                                        </div>
                                    </td>

                                </tr>
                            @endforeach

                        </table>
                    </div>
                </div>

            </div>

        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="font-weight-bold text-black">Add Role </h4>

                </div>
                <div class="card-body">
                    <form action="{{ url('/add/permission') }} " method="post">
                        @csrf
                        <div class="form-group mb-4">

                            <div class="form-group mb-4">
                                <label for="" class="form-label">Permission Name</label>

                                <input type="text" name="permission_name" class="form-control"
                                    placeholder="Permission Name">

                                @error('permission_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>



                        </div>

                        <button class="btn btn-primary btn-xs" type="submit">Add Permission</button>


                    </form>
                </div>
                <div class="card-body">
                    <form action="{{ url('/add/role') }}" method="post">
                        @csrf
                        <div class="form-group mb-4">

                            <div class="form-group mb-4">
                                <label for="" class="form-label">Role Name</label>

                                <input type="text" name="role_name" class="form-control" placeholder="Role Name">

                                @error('role_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>
                            <div class="form-group mb-4">
                                <label for="" class="form-label">Permission Name</label>
                                <br>
                                @foreach ($permission as $permission)
                                    <input type="checkbox" name="permission[]" value="{{ $permission->id }}"
                                        placeholder="Role Name"> {{ $permission->name }} <br>
                                @endforeach
                                @error('permission_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>


                        </div>

                        <button class="btn btn-primary btn-xs" type="submit">Add Role</button>


                    </form>
                </div>

                <div class="card-body">
                    <form action="{{ url('/assign/role') }}" method="post">
                        @csrf
                        <div class="form-group mb-4">

                            <div class="mb-3">
                                <label for="" class="form-label">User Name</label>
                                <select name="user_id" id="user_id" class="form-control">
                                    <option value="">----Select User----
                                        @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Role Name</label>
                                <select name="role_id" id="role_id" class="form-control">
                                    <option value="">----Select User----
                                        @foreach ($roles as $key => $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>



                        </div>

                        <button class="btn btn-primary btn-xs" type="submit">Add Role</button>


                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
