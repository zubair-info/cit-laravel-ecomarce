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
                    <h4 class="font-weight-bold text-black ">Add Product </h4>
                    {{-- <h3 class="float-end">Count: <span></span></h3> --}}
                </div>
                <div class="card-body">

                    <form action="{{ url('/product/insert') }} " method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label for="" class="form-label">Category Name</label>
                                    <select name="category_id" id="category" class="form-control">
                                        <option value="">---Select Category---</option>
                                        @foreach ($all_category as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label for="" class="form-label">Sub Category Name</label>
                                    <select name="subcategory_id" id="subcategory" class="form-control">
                                        <option value="">---Select Sub Category---</option>
                                        {{-- @foreach ($all_subcategory as $subcategory)
                                            <option value="{{ $subcategory->id }}">{{ $subcategory->subcategory_name }}
                                            </option>
                                        @endforeach --}}
                                    </select>

                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label for="" class="form-label">Product Name</label>

                                    <input type="text" name="product_name" class="form-control">
                                    @error('product_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label for="" class="form-label">Product Price</label>

                                    <input type="number" name="product_price" class="form-control">
                                    @error('product_price')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror


                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label for="" class="form-label">Discount(%)</label>

                                    <input type="number" name="discount" class="form-control">

                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label for="" class="form-label">Sort Description</label>

                                    <input type="text" name="sort_desp" class="form-control">
                                    @error('sort_desp')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mt-4">
                                    <label for="" class="form-label">Long Description</label>

                                    <textarea name="long_desp" id="" cols="30" rows="10" class="form-control"></textarea>
                                    @error('long_desp')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mt-4">
                                    <label for="" class="form-label">Product Preview</label>

                                    <input type="file" name="preview" class="form-control">
                                    <div class="img-holder"></div>
                                    @error('preview')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group mt-4">
                                    <label for="" class="form-label">Product Thamnil</label>

                                    <input type="file" name="thumbnil[]" multiple class="form-control">

                                </div>
                            </div>
                        </div>



                        <div class="form-group mt-4 text-center">

                            <button class="btn btn-primary btn-xs" type="submit">Add Product</button>
                        </div>


                    </form>

                </div>
            </div>

        </div>

    </div>
@endsection
@section('footer_script')
    <script>
        $('#category').change(function() {
            var category_id = $(this).val();
            // alert(category_id);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: '/getSubcategory',
                data: {
                    'category_id': category_id
                },
                success: function(data) {

                    $('#subcategory').html(data);

                }
            });

        });
    </script>
    <script>
        //Reset input file
        $('input[type="file"][name="preview"]').val('');
        //Image preview
        $('input[type="file"][name="preview"]').on('change', function() {
            var img_path = $(this)[0].value;
            var img_holder = $('.img-holder');
            var extension = img_path.substring(img_path.lastIndexOf('.') + 1).toLowerCase();
            if (extension == 'jpeg' || extension == 'jpg' || extension == 'png') {
                if (typeof(FileReader) != 'undefined') {
                    img_holder.empty();
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('<img/>', {
                            'src': e.target.result,
                            'class': 'img-fluid',
                            'style': 'max-width:100px;margin-bottom:10px;'
                        }).appendTo(img_holder);
                    }
                    img_holder.show();
                    reader.readAsDataURL($(this)[0].files[0]);
                } else {
                    $(img_holder).html('This browser does not support FileReader');
                }
            } else {
                $(img_holder).empty();
            }
        });
    </script>
@endsection
