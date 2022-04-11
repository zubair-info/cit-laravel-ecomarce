@extends('layouts.dashboard')
@section('content')
    <div class="col-lg- m-auto">
        <div class="card">
            <div class="card-header text-center">
                <h4 class="font-weight-bold text-black ">Add Product Color</h4>
                {{-- <h3 class="float-end">Count: <span></span></h3> --}}
            </div>
            <div class="card-body">

                <form action="{{ url('update/size') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" class="form-control" value="{{ $size_info->id }}">


                    <div class="form-group mb-4">
                        <label for="" class="form-label">Color Name</label>

                        <input type="text" name="size_name" class="form-control" value="{{ $size_info->size_name }}">
                        @error('size_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="form-group mt-4">

                        <button class="btn btn-primary btn-xs" type="submit">Update Size</button>
                    </div>


                </form>

            </div>
        </div>

    </div>
@endsection
