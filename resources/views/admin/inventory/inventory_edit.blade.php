@extends('layouts.dashboard')
@section('content')
    <div class="col-lg-6 ">
        <div class="card">
            <div class="card-header text-center">
                <h4 class="font-weight-bold text-black ">Edit Enventory</h4>
                {{-- <h3 class="float-end">Count: <span></span></h3> --}}
            </div>
            <div class="card-body">

                <form action="{{ url('/inventory/update') }} " method="post">
                    @csrf
                    <input type="hidden" name="id" class="form-control" value="{{ $inventory_info->id }}">
                    <div class="form-group mb-4">
                        <label for="" class="form-label">Product Name</label>
                        {{-- <input type="hidden" name="product_id" value="{{ $product_info->id }}" readonly
                            class="form-control"> --}}
                        <input type="text" name="product_name" readonly class="form-control"
                            value="{{ $inventory_info->rel_to_product->product_name }}">


                    </div>
                    <div class="form-group mb-4">
                        <label for="" class="form-label">Size</label>

                        <select name="size_id" class="form-control" id="">
                            <option value="">--Select size--</option>
                            @foreach ($all_size as $size)
                                <option value="{{ $size->id }}"
                                    {{ $size->id == $inventory_info->size_id ? 'selected' : '' }}>
                                    {{ $size->size_name }}</option>
                            @endforeach

                        </select>
                        @error('size_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="form-group mb-4">
                        <label for="" class="form-label">Color</label>

                        <select name="color_id" class="form-control" id="">
                            <option value="">--Select Color--</option>
                            @foreach ($all_color as $color)
                                <option value="{{ $color->id }}"
                                    {{ $color->id == $inventory_info->color_id ? 'selected' : '' }}>
                                    {{ ucwords($color->color_name) }}</option>
                            @endforeach

                        </select>
                        @error('color_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="form-group mb-4">
                        <label for="" class="form-label">Qty</label>

                        <input type="number" name="qty" class="form-control" value="{{ $inventory_info->qty }}">
                        @error('qty')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                    </div>
                    <button class="btn btn-primary btn-xs" type="submit">Add Inventory</button>


                </form>

            </div>
        </div>

    </div>
@endsection
