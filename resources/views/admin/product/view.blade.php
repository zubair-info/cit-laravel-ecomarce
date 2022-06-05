@extends('layouts.dashboard')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Product</a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-center">
                    <h4 class="font-weight-bold text-black ">Product List</h4>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="example4" class="display min-w850">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Product name</th>
                                    <th>Added By</th>
                                    <th>Preview</th>
                                    <th>Price</th>
                                    <th>Discount(%)</th>
                                    <th>After Discount</th>
                                    {{-- <th>Sort Desp</th> --}}
                                    {{-- <th>Long Desp</th> --}}
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($all_product as $key => $product)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>
                                            @php
                                                if (App\Models\User::where('id', $product->user_id)->exists()) {
                                                    echo $product->rel_to_user->name;
                                                } else {
                                                    echo 'N/A';
                                                }
                                            @endphp
                                        </td>
                                        <td width="100">
                                            <img src="{{ asset('/uploads/product/preview') }}/{{ $product->preview }}"
                                                height="90px" alt="">
                                        </td>
                                        <td>{{ $product->product_price }}</td>
                                        <td>{{ $product->discount }}%</td>
                                        <td>{{ $product->after_discount }}</td>
                                        {{-- <td>{{ $product->sort_desp }}</td>
                                    <td>{{ $product->long_desp }}</td> --}}

                                        <td width="100">

                                            <div class="d-flex">

                                                {{-- <button type="button" class="btn btn-primary shadow btn-xs sharp mx-1"
                                                    data-toggle="modal" data-target="#bd-example-modal-lg"><i
                                                        class="fa fa-eye" aria-hidden="true"></i></button> --}}
                                                <a href="{{ route('add.inventory', $product->id) }}"
                                                    class="btn btn-info shadow btn-xs sharp mr-1"><i class="fa fa-archive"
                                                        aria-hidden="true"></i></a>
                                                <a href="{{ route('edit.product', $product->id) }}"
                                                    class="btn btn-warning shadow btn-xs sharp mr-1"><i
                                                        class="fa fa-pencil" aria-hidden="true"></i></a>
                                                {{-- <a href="{{ route('product.delete', $product->id) }}"
                                                    class="btn btn-danger shadow btn-xs sharp"><i
                                                        class="fa fa-trash"></i></a> --}}
                                                <button name="{{ route('product.delete', $product->id) }}" type="button"
                                                    class="delete_btn btn btn-danger shadow btn-xs sharp"><i
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


    {{-- product  view modal --}}
    {{-- <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Product View</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr>
                            <td>Product name</td>
                            <td>{{ $product->product_name }}</td>
                        </tr>
                        <tr>
                            <td>Product Image</td>
                            <td><img src="{{ asset('/uploads/product/preview') }}/{{ $product->preview }}"
                                    height="90px" alt=""></td>
                        </tr>
                        <tr>
                            <td>Product Price</td>
                            <td>{{ $product->product_price }}</td>
                        </tr>
                        <tr>
                            <td>Product Discount</td>
                            <td>{{ $product->discount }}</td>
                        </tr>
                        <tr>
                            <td>After Discount Price </td>
                            <td>{{ $product->after_discount }}</td>
                        </tr>
                        <tr>
                            <td>Sort Description</td>
                            <td>{{ $product->sort_desp }}</td>
                        </tr>
                        <tr>
                            <td>Long Description</td>
                            <td>{{ $product->long_desp }}</td>
                        </tr>
                        <tr>
                            <td>Color</td>
                            <td>{{ $product->long_desp }}</td>
                        </tr>
                        <tr>
                            <td>Size</td>
                            <td>{{ $product->long_desp }}</td>
                        </tr>
                        <tr>
                            <td>Qty</td>
                            <td>{{ $product->long_desp }}</td>
                        </tr>

                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light shadow btn-xs " data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div> --}}

    </div>
@endsection
@section('footer_script')
    <script>
        $(document).ready(function() {
            // alert('ok');

            $('.delete_btn').click(function() {
                // alert('ok');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        var link = $(this).attr('name')
                        alert(link)
                        window.location.href = link

                    }


                })

            });
        });
    </script>
@endsection
