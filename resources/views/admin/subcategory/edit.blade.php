@extends('layouts.dashboard')
@section('content')
    <div class="row">

        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h4 class="font-weight-bold text-black">Edit Sub Category </h4>
                    {{-- <h3 class="float-end">Count: <span></span></h3> --}}
                </div>
                <div class="card-body">

                    <form action="{{ url('/subcategory/update') }} " method="POST">
                        @csrf
                        <input type="hidden" name="id" class="form-control" value="{{ $subcategory_info->id }}">
                        <div class="form-group mb-4">
                            <label for="" class="form-label">Category Name</label>
                            <select name="category_id" id="" class="form-control">
                                <option value="">---Select Category---</option>
                                @foreach ($all_category as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $category->id == $subcategory_info->category_id ? 'selected' : '' }}>
                                        {{ $category->category_name }}</option>
                                @endforeach
                            </select>

                            @error('category_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                        </div>
                        <div class="form-group mb-4">
                            <label for="" class="form-label">Sub Category Name</label>

                            <input type="text" name="subcategory_name" class="form-control"
                                value="{{ $subcategory_info->subcategory_name }}">

                            @if ('same_cat')
                                <strong class="text-danger">{{ session('same_cat') }}</strong>
                            @endif
                            @error('subcategory_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                        </div>
                        <button class="btn btn-primary" type="submit">Update Subcategory</button>


                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection
