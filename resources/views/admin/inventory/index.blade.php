@extends('layouts.dashboard')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Product Inventory Manage</a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <div class="cart-tittle">
                        Product Inventory
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-responsive-md">

                        <tr>
                            <th>SL</th>
                            <th>Product name</th>
                            <th>Color</th>
                            <th>Size</th>
                            <th>Qty</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($inventories as $key => $inventory)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $inventory->rel_to_product->product_name }}</td>

                                <td>
                                    @php
                                        if (App\Models\Color::where('id', $inventory->color_id)->exists()) {
                                            echo $inventory->rel_to_color->color_name;
                                        } else {
                                            echo 'N/A';
                                        }
                                    @endphp
                                    {{-- {{ $inventory->rel_to_color->color_name }} --}}
                                </td>
                                <td>
                                    @php
                                        if (App\Models\Size::where('id', $inventory->size_id)->exists()) {
                                            echo $inventory->rel_to_size->size_name;
                                        } else {
                                            echo 'N/A';
                                        }
                                    @endphp
                                    {{-- {{ $inventory->rel_to_size->size_name }} --}}
                                </td>
                                <td>{{ $inventory->qty }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('inventory.edit', $inventory->id) }}"
                                            class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                                class="fa fa-pencil"></i></a>
                                        <button name="{{ route('inventory.delete', $inventory->id) }}" type="button"
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
                <div class="card-header">
                    <div class="card-tittle">
                        Add Inventory
                    </div>

                </div>
                <div class="card-body">
                    <form action="{{ url('/inventory/insert') }} " method="post">
                        @csrf
                        <div class="form-group mb-4">
                            <label for="" class="form-label">Product Name</label>
                            <input type="hidden" name="product_id" value="{{ $product_info->id }}" readonly
                                class="form-control">
                            <input type="text" name="product_name" readonly class="form-control"
                                value="{{ $product_info->product_name }}">

                        </div>
                        <div class="form-group mb-4">
                            <label for="" class="form-label">Size</label>

                            <select name="size_id" class="form-control" id="">
                                <option value="">--Select size--</option>
                                @foreach ($all_size as $size)
                                    <option value="{{ $size->id }}">{{ $size->size_name }}</option>
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
                                    <option value="{{ $color->id }}">{{ $color->color_name }}</option>
                                @endforeach



                            </select>
                            @error('color_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                        </div>
                        <div class="form-group mb-4">
                            <label for="" class="form-label">Qty</label>

                            <input type="number" name="qty" class="form-control">
                            @error('qty')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                        </div>
                        <button class="btn btn-primary btn-xs" type="submit">Add Inventory</button>


                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
