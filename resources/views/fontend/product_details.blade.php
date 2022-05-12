@extends('fontend.master')
@section('content')
    <!-- breadcrumb_section - start================================================== -->
    <div class="breadcrumb_section">
        <div class="container">
            <ul class="breadcrumb_nav ul_li">
                <li><a href="index.html">Home</a></li>
                <li>Product Details</li>
            </ul>
        </div>
    </div>
    <!-- breadcrumb_section - end=============================-->

    <!-- product_details - start=======================-->
    <section class="product_details section_space pb-0">
        <div class="container">
            <div class="row">
                <div class="col col-lg-6">
                    <div class="product_details_image">
                        @php
                            // echo App\Models\Thumbnil::where('product_id', $product_info->id)->get();
                        @endphp
                        <div class="details_image_carousel">
                            @foreach (App\Models\Product::where('id', $product_info->id)->get() as $preview)
                                <div class="slider_item">
                                    <img src="{{ asset('/uploads/product/preview') }}/{{ $preview->preview }}"
                                        alt="image_not_found">
                                </div>
                            @endforeach
                        </div>

                        <div class="details_image_carousel_nav">
                            @foreach (App\Models\Thumbnil::where('product_id', $product_info->id)->get() as $thumb)
                                <div class="slider_item">
                                    <img src="{{ asset('/uploads/product/thumbnil') }}/{{ $thumb->thumbnil }}"
                                        alt="image_not_found">
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="product_details_content">
                        <h2 class="item_title">{{ $product_info->product_name }}</h2>
                        <p>{{ $product_info->sort_desp }}</p>
                        <div class="item_review">
                            <ul class="rating_star ul_li">
                                <li><i class="fas fa-star"></i>></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star-half-alt"></i></li>
                            </ul>
                            <span class="review_value"> 3 Rating(s)</span>
                        </div>
                        <form action="{{ url('/cart/store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product_info->id }}">
                            <div class="item_price">
                                <span> &#2547;</span><span id="price"> {{ $product_info->after_discount }}</span>
                                <del>&#2547; {{ $product_info->product_price }}</del>
                            </div>
                            <hr>

                            <div class="item_attribute">

                                <div class="row">
                                    <div class="col col-md-6">
                                        <div class="select_option clearfix">
                                            <h4 class="input_title">Color *</h4>
                                            <select id="color_id" name="color_id" class="form-control">
                                                <option data-display="- Please select -" value="0">Choose A Option</option>

                                                @foreach ($avaliable_color as $color)
                                                    <option value="{{ $color->color_id }}">
                                                        {{ $color->rel_to_color->color_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col col-md-6">
                                        <div class="select_option clearfix">
                                            <h4 class="input_title">Size*</h4>
                                            <select id="size_id" name="size_id" class="form-control">
                                                <option data-display="- Please select -" value="0">Choose A Option</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="quantity_wrap">
                                <div class="quantity_input">
                                    <button type="button" class="input_number_decrement">
                                        <i class="fal fa-minus"></i>
                                    </button>
                                    <input class="input_number2" type="text" value="1" name="quantity">
                                    <button type="button" class="input_number_increment">
                                        <i class="fal fa-plus"></i>
                                    </button>
                                </div>
                                <div class="total_price">Total:<span id="total">
                                        {{ $product_info->after_discount }}</span></div>
                            </div>

                            <ul class="default_btns_group ul_li">
                                @auth('customerlogin')
                                    <li><button class="btn btn_primary addtocart_btn" type="submit">Add To Cart</button></li>
                                @else
                                    <li><a class="btn btn_primary addtocart_btn" href="{{ route('customer.register') }}">Add
                                            To
                                            Cart</a></li>
                                @endauth
                            </ul>
                        </form>
                    </div>

                </div>
            </div>

            <div class="details_information_tab">
                <ul class="tabs_nav nav ul_li" role=tablist>
                    <li>
                        <button class="active" data-bs-toggle="tab" data-bs-target="#description_tab" type="button"
                            role="tab" aria-controls="description_tab" aria-selected="true">
                            Description
                        </button>
                    </li>
                    <li>
                        <button data-bs-toggle="tab" data-bs-target="#additional_information_tab" type="button" role="tab"
                            aria-controls="additional_information_tab" aria-selected="false">
                            Additional information
                        </button>
                    </li>
                    <li>
                        <button data-bs-toggle="tab" data-bs-target="#reviews_tab" type="button" role="tab"
                            aria-controls="reviews_tab" aria-selected="false">
                            Reviews(2)
                        </button>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="description_tab" role="tabpanel">

                        <p class="mb-0">
                            <?php echo $product_info->long_desp; ?>
                        </p>
                    </div>

                    <div class="tab-pane fade" id="additional_information_tab" role="tabpanel">
                        <p>
                            Return into stiff sections the bedding was hardly able to cover it and seemed ready to slide off
                            any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about
                            helplessly as he looked what's happened to me he thought It wasn't a dream. His room, a proper
                            human room although a little too small
                        </p>

                        <div class="additional_info_list">
                            <h4 class="info_title">Additional Info</h4>
                            <ul class="ul_li_block">
                                <li>No Side Effects</li>
                                <li>Made in USA</li>
                            </ul>
                        </div>

                        <div class="additional_info_list">
                            <h4 class="info_title">Product Features Info</h4>
                            <ul class="ul_li_block">
                                <li>Compatible for indoor and outdoor use</li>
                                <li>Wide polypropylene shell seat for unrivalled comfort</li>
                                <li>Rust-resistant frame</li>
                                <li>Durable UV and weather-resistant construction</li>
                                <li>Shell seat features water draining recess</li>
                                <li>Shell and base are stackable for transport</li>
                                <li>Choice of monochrome finishes and colourways</li>
                                <li>Designed by Nagi</li>
                            </ul>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="reviews_tab" role="tabpanel">
                        <div class="average_area">
                            <div class="row align-items-center">
                                <div class="col-md-12 order-last">
                                    <div class="average_rating_text">
                                        <ul class="rating_star ul_li_center">
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                        </ul>
                                        <p class="mb-0">
                                            Average Star Rating: <span>4 out of 5</span> (2 vote)
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="customer_reviews">
                            <h4 class="reviews_tab_title">2 reviews for this product</h4>
                            <div class="customer_review_item clearfix">
                                <div class="customer_image">
                                    <img src="assets/images/team/team_1.jpg" alt="image_not_found">
                                </div>
                                <div class="customer_content">
                                    <div class="customer_info">
                                        <ul class="rating_star ul_li">
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star-half-alt"></i></li>
                                        </ul>
                                        <h4 class="customer_name">Aonathor troet</h4>
                                        <span class="comment_date">JUNE 2, 2021</span>
                                    </div>
                                    <p class="mb-0">Nice Product, I got one in black. Goes with anything!</p>
                                </div>
                            </div>

                            <div class="customer_review_item clearfix">
                                <div class="customer_image">
                                    <img src="assets/images/team/team_2.jpg" alt="image_not_found">
                                </div>
                                <div class="customer_content">
                                    <div class="customer_info">
                                        <ul class="rating_star ul_li">
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star-half-alt"></i></li>
                                        </ul>
                                        <h4 class="customer_name">Danial obrain</h4>
                                        <span class="comment_date">JUNE 2, 2021</span>
                                    </div>
                                    <p class="mb-0">
                                        Great product quality, Great Design and Great Service.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="customer_review_form">
                            <h4 class="reviews_tab_title">Add a review</h4>
                            <form action="#">
                                <div class="form_item">
                                    <input type="text" name="name" placeholder="Your name*">
                                </div>
                                <div class="form_item">
                                    <input type="email" name="email" placeholder="Your Email*">
                                </div>
                                <div class="your_ratings">
                                    <h5>Your Ratings:</h5>
                                    <button type="button"><i class="fal fa-star"></i></button>
                                    <button type="button"><i class="fal fa-star"></i></button>
                                    <button type="button"><i class="fal fa-star"></i></button>
                                    <button type="button"><i class="fal fa-star"></i></button>
                                    <button type="button"><i class="fal fa-star"></i></button>
                                </div>
                                <div class="form_item">
                                    <textarea name="comment" placeholder="Your Review*"></textarea>
                                </div>
                                <button type="submit" class="btn btn_primary">Submit Now</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product_details - end-->

    <!-- related_products_section - start-->
    <section class="related_products_section section_space">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="best-selling-products related-product-area">
                        <div class="sec-title-link">
                            <h3>Related products</h3>
                            <div class="view-all"><a href="#">View all<i class="fal fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                        <div class="product-area clearfix">
                            @forelse ($related_product as $related)
                                <div class="grid">
                                    <div class="product-pic">
                                        <img src="{{ asset('uploads/product/preview/') }}/{{ $related->preview }}"
                                            alt>
                                        <div class="actions">
                                            <ul>
                                                <li>
                                                    <a href="#"><svg role="img" xmlns="http://www.w3.org/2000/svg"
                                                            width="48px" height="48px" viewBox="0 0 24 24" stroke="#2329D6"
                                                            stroke-width="1" stroke-linecap="square" stroke-linejoin="miter"
                                                            fill="none" color="#2329D6">
                                                            <title>Favourite</title>
                                                            <path
                                                                d="M12,21 L10.55,19.7051771 C5.4,15.1242507 2,12.1029973 2,8.39509537 C2,5.37384196 4.42,3 7.5,3 C9.24,3 10.91,3.79455041 12,5.05013624 C13.09,3.79455041 14.76,3 16.5,3 C19.58,3 22,5.37384196 22,8.39509537 C22,12.1029973 18.6,15.1242507 13.45,19.7149864 L12,21 Z" />
                                                        </svg></a>
                                                </li>
                                                <li>
                                                    <a href="#"><svg role="img" xmlns="http://www.w3.org/2000/svg"
                                                            width="48px" height="48px" viewBox="0 0 24 24" stroke="#2329D6"
                                                            stroke-width="1" stroke-linecap="square" stroke-linejoin="miter"
                                                            fill="none" color="#2329D6">
                                                            <title>Shuffle</title>
                                                            <path
                                                                d="M21 16.0399H17.7707C15.8164 16.0399 13.9845 14.9697 12.8611 13.1716L10.7973 9.86831C9.67384 8.07022 7.84196 7 5.88762 7L3 7" />
                                                            <path
                                                                d="M21 7H17.7707C15.8164 7 13.9845 8.18388 12.8611 10.1729L10.7973 13.8271C9.67384 15.8161 7.84196 17 5.88762 17L3 17" />
                                                            <path d="M19 4L22 7L19 10" />
                                                            <path d="M19 13L22 16L19 19" />
                                                        </svg></a>
                                                </li>
                                                <li>
                                                    <a class="quickview_btn" data-bs-toggle="modal"
                                                        href="#quickview_popup" role="button" tabindex="0"><svg width="48px"
                                                            height="48px" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg" stroke="#2329D6"
                                                            stroke-width="1" stroke-linecap="square" stroke-linejoin="miter"
                                                            fill="none" color="#2329D6">
                                                            <title>Visible (eye)</title>
                                                            <path
                                                                d="M22 12C22 12 19 18 12 18C5 18 2 12 2 12C2 12 5 6 12 6C19 6 22 12 22 12Z" />
                                                            <circle cx="12" cy="12" r="3" />
                                                        </svg></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="details">
                                        <h4><a href="#">Macbook Pro</a></h4>
                                        <p><a href="#">Apple MacBook Pro13.3″ Laptop with Touch ID </a></p>
                                        <div class="rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                        </div>
                                        <span class="price">
                                            <ins>
                                                <span class="woocommerce-Price-amount amount">
                                                    <bdi>
                                                        <span class="woocommerce-Price-currencySymbol">$</span>471.48
                                                    </bdi>
                                                </span>
                                            </ins>
                                        </span>
                                        <div class="add-cart-area">
                                            <button class="add-to-cart">Add to cart</button>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <h3>No Related Products</h3>
                            @endforelse

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- related_products_section - end-->
@endsection
@section('footer_script')
    <script>
        var qty = $('.input_number2').val();
        $('.input_number_increment').click(function() {
            qty++;
            $('.input_number2').val(qty);

            // alert(qty);
            var price = $('#price').html();
            // alert(price);
            var total = price * qty;
            // alert(total);


            $('#total').html(total);

        });
        var qty = $('.input_number2').val();
        $('.input_number_decrement').click(function() {
            if (qty > 1) {

                qty--;
            }
            $('.input_number2').val(qty);
            // alert(qty);
            var price = $('#price').html();
            // alert(price);
            var total = price * qty;
            // alert(total);
            $('#total').html(total);

        });

        // get size by color id /product id
        $('#color_id').change(function() {
            var color_id = $('#color_id').val();
            // alert(color_id);
            var product_id = '{{ $product_info->id }}';
            // alert(product_id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/getSize',
                data: {
                    'color_id': color_id,
                    'product_id': product_id
                },
                success: function(data) {
                    // alert(data);
                    $('#size_id').html(data);
                }

            });
        });
    </script>
    @if (session('insert'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: '{{ session('insert') }}'
            })
        </script>
    @endif
@endsection
