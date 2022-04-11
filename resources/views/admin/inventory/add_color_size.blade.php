@extends('layouts.dashboard')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Product Color & Size</a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header text-center">
                    <h4 class="font-weight-bold text-black card-title">Product Color List</h4>
                    {{-- <h3 class="float-end">Count: <span></span></h3> --}}
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Color Name</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($all_color as $key => $color)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><span
                                        style='background:#{{ $color->color_code }};color:white;padding:5px;border-radius:5px;'>{{ $color->color_name }}</span>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('color.edit', $color->id) }}"
                                            class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                                class="fa fa-pencil"></i></a>
                                        <button name="{{ route('color.delete', $color->id) }}" type="button"
                                            class="delete_btn btn btn-danger shadow btn-xs sharp"><i
                                                class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>


                </div>
            </div>

        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header text-center">
                    <h4 class="font-weight-bold text-black ">Add Product Color</h4>
                    {{-- <h3 class="float-end">Count: <span></span></h3> --}}
                </div>
                <div class="card-body">

                    <form action="{{ url('/insert/color') }} " method="post">
                        @csrf

                        <div class="form-group mb-4">
                            <label for="" class="form-label">Color Name</label>

                            <input type="text" name="color_name" class="form-control">
                            @error('color_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                        </div>
                        <div class="form-group mb-4">
                            <label for="" class="form-label">Color Code</label>

                            <input type="text" name="color_code" class="form-control">
                            @error('color_code')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                        </div>
                        <div class="form-group mt-4">

                            <button class="btn btn-primary btn-xs" type="submit">Add Color</button>
                        </div>


                    </form>

                </div>
            </div>

        </div>

    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header text-center">
                    <h4 class="font-weight-bold text-black ">Product Size List</h4>

                </div>
                <div class="card-body">

                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Size Name</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($all_size as $key => $size)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $size->size_name }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('size.edit', $size->id) }}"
                                            class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                                class="fa fa-pencil"></i></a>
                                        <button name="{{ route('size.delete', $size->id) }}" type="button"
                                            class="delete_btn btn btn-danger shadow btn-xs sharp"><i
                                                class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>

                </div>
            </div>

        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header text-center">
                    <h4 class="font-weight-bold text-black ">Add Product Size</h4>
                </div>
                <div class="card-body">

                    <form action="{{ url('/insert/size') }} " method="post">
                        @csrf

                        <div class="form-group mb-4">
                            <label for="" class="form-label">Size Name</label>

                            <input type="text" name="size_name" class="form-control">
                            @error('size_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                        </div>

                        <div class="form-group mt-4">

                            <button class="btn btn-primary btn-xs" type="submit">Add Size</button>
                        </div>


                    </form>

                </div>
            </div>

        </div>

    </div>
@endsection
