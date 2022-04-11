@extends('layouts.dashboard')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Sub Category</a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="font-weight-bold text-black">Add Sub Category </h4>
                    {{-- <h3 class="float-end">Count: <span></span></h3> --}}
                </div>
                <div class="card-body">

                    <form action="{{ url('/subcategory/insert') }} " method="post">
                        @csrf
                        <div class="form-group mb-4">
                            <label for="" class="form-label">Category Name</label>
                            <select name="category_id" id="" class="form-control">
                                <option value="">---Select Category---</option>
                                @foreach ($all_category as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>

                            @error('category_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                        </div>
                        <div class="form-group mb-4">
                            <label for="" class="form-label">Sub Category Name</label>

                            <input type="text" name="subcategory_name" class="form-control">
                            @if ('same_cat')
                                <strong class="text-danger">{{ session('same_cat') }}</strong>
                            @endif
                            @error('subcategory_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                        </div>
                        <button class="btn btn-primary btn-xs" type="submit">Add Subcategory</button>


                    </form>

                </div>
            </div>

        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="font-weight-bold text-black">Sub Category List</h4>
                    {{-- <h3 class="float-end">Count: <span></span></h3> --}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example4" class="display min-w850">

                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Added By</th>
                                    <th>Create at</th>
                                    <th>Action</th>

                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($all_subcategory as $key => $subcategory)
                                    <tr class="{{ $loop->odd ? 'text-danger' : 'text-success' }}">

                                        <td>{{ $key + 1 }}</td>


                                        <td>
                                            @php
                                                if (App\Models\Category::where('id', $subcategory->category_id)->exists()) {
                                                    echo $subcategory->rel_to_category->category_name;
                                                } else {
                                                    echo 'Uncategorized';
                                                }
                                            @endphp
                                        </td>

                                        <td>{{ $subcategory->subcategory_name }}</td>

                                        <td>
                                            @php
                                                if (App\Models\User::where('id', $subcategory->user_id)->exists()) {
                                                    echo $subcategory->rel_to_user->name;
                                                } else {
                                                    echo 'N/A';
                                                }
                                            @endphp
                                        </td>

                                        <td>{{ $subcategory->created_at->diffForHumans() }}</td>
                                        <td>

                                            <div class="d-flex">
                                                <a href="{{ route('subcategory.edit', $subcategory->id) }}"
                                                    class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                                        class="fa fa-pencil"></i></a>

                                                <button name="{{ route('subcategory.delete', $subcategory->id) }}"
                                                    type="button" class="delete_btn btn btn-danger shadow btn-xs sharp"><i
                                                        class="fa fa-trash"></i></button>
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
    </div>
@endsection
