@extends('layouts.dashboard')
@section('content')
    <div class="col-lg-4 m-auto">
        <div class="card">
            <div class="card-header text-center">
                <h4 class="font-weight-bold text-black ">Add Product Color</h4>
                {{-- <h3 class="float-end">Count: <span></span></h3> --}}
            </div>
            <div class="card-body">

                <form action="{{ url('update/color') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" class="form-control" value="{{ $color_info->id }}">


                    <div class="form-group mb-4">
                        <label for="" class="form-label">Color Name</label>

                        <input type="text" name="color_name" class="form-control" value="{{ $color_info->color_name }}">
                        @error('color_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="form-group mb-4">
                        <label for="" class="form-label">Color Code</label>

                        <input type="text" name="color_code" class="form-control" value="{{ $color_info->color_code }}">
                        @error('color_code')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="form-group mt-4">

                        <button class="btn btn-primary btn-xs" type="submit">Update Color</button>
                    </div>


                </form>

            </div>
        </div>

    </div>
@endsection
