@extends('fontend.master')
@section('content')
    <!-- breadcrumb_section - start ================================================== -->
    <div class="breadcrumb_section">
        <div class="container">
            <ul class="breadcrumb_nav ul_li">
                <li><a href="index.html">Home</a></li>
                <li>Cart</li>
            </ul>
        </div>
    </div>
    <!-- breadcrumb_section - end================================================== -->

    <!-- cart_section - start ================================================== -->
    <section class="cart_section section_space">
        <div class="container">

            @if (App\Models\Cart::where('customer_id', Auth::guard('customerlogin')->id())->count() > 0)
                <div class="cart_table">
                    <table class="table">

                        <thead>
                            <tr>
                                <th>Product</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $sub_total = 0;
                            @endphp
                            @foreach ($carts as $cart)
                                <form action="{{ url('/cart/update') }}" method="POST">
                                    @csrf
                                    <tr>
                                        <td>
                                            <div class="cart_product">
                                                <img src="{{ asset('uploads/product/preview') }}/{{ $cart->rel_to_product->preview }}"
                                                    alt="image_not_found">
                                                <h3><a
                                                        href="shop_details.html">{{ $cart->rel_to_product->product_name }}</a>
                                                </h3>
                                            </div>
                                        </td>
                                        <td class="text-center abc"><span class="price_text">&#2547;
                                                {{ $cart->rel_to_product->after_discount }}</span>
                                        </td>
                                        <td class="text-center abc">


                                            <div class="quantity_input">
                                                <button type="button" class="input_number_decrement">
                                                    <i data-price={{ $cart->rel_to_product->after_discount }}
                                                        class="fal fa-minus"></i>
                                                </button>
                                                <input class="input_numbers" name="quantity[{{ $cart->id }}]"
                                                    type="text" value="{{ $cart->quantity }}" />
                                                <button type="button" class="input_number_increment">
                                                    <i data-price={{ $cart->rel_to_product->after_discount }}
                                                        class="fal fa-plus"></i>
                                                </button>
                                            </div>

                                        </td>
                                        <td class="text-center abc"><span class="price_text">&#2547;
                                                {{ $cart->rel_to_product->after_discount * $cart->quantity }}</span></td>
                                        {{-- <td class="text-center"><button type="button" data-cartId={{ $cart->id }}
                                                class="remove_btn"><i class="fal fa-trash-alt"></i></button></td> --}}
                                        <td class="text-center"><a type="button" class="remove_btn"
                                                href="{{ route('cart.remove', $cart->id) }}"><i
                                                    class="fal fa-trash-alt"></i></a></td>

                                    </tr>
                                    @php
                                        $sub_total += $cart->rel_to_product->after_discount * $cart->quantity;
                                    @endphp
                            @endforeach

                        </tbody>
                    </table>
                </div>



                <div class="row">

                    @php
                        // if ($type == '%') {
                        //     session([
                        //         'discount' => $discount,
                        //     ]);
                        // }
                        
                        // $type == 'percentage' ? '%' : 'Tk';
                        session([
                            'discount' => $discount,
                            'discount_cal' => $type == 'percentage' ? round($sub_total - ($sub_total * $discount) / 100) : $sub_total - $discount,
                        ]);
                        
                    @endphp
                    <div class="col col-lg-6">
                        {{-- <ul class="btns_group ul_li_right">
                            <li class="m-3"><button class="btn border_black" type="submit">Update Cart</button>
                            </li>
                            <li><a class="btn btn_dark" href="{{ route('checkout') }}">Prceed To Checkout</a></li>
                        </ul> --}}
                    </div>


                    <div class="col col-lg-6">
                        <div class="cart_total_table">
                            <h3 class="wrap_title">Cart Totals</h3>
                            <ul class="ul_li_block">
                                <li>
                                    <span>Cart Subtotal</span>
                                    <span>&#2547; {{ $sub_total }}</span>
                                </li>
                                <li>
                                    <span>Discount</span>
                                    <span>
                                        {{ $discount }}
                                        {{-- @if ($discount < 5000)
                                            {{ $discount = 500 }}
                                        @elseif($discount < 10000)
                                            {{ $discount = 500 }}
                                        @else
                                            {{ $discount }}
                                        @endif --}}
                                        @php
                                            if ($type == 'percentage') {
                                                session([
                                                    'type' => '%',
                                                ]);
                                                echo '%';
                                            } else {
                                                session([
                                                    'type' => 'Tk',
                                                ]);
                                                echo 'Tk';
                                            }
                                        @endphp


                                    </span>
                                </li>
                                <li>
                                    <span>Order Total</span>
                                    <span class="total_price">
                                        &#2547;

                                        {{ $type == 'percentage' ? round($sub_total - ($sub_total * $discount) / 100) : $sub_total - $discount }}</span>
                                </li>
                            </ul>
                            <ul class="btns_group ul_li_right">
                                <li class="m-3"><button class="btn border_black" type="submit">Update
                                        Cart</button>
                                </li>
                                <li><a class="btn btn_dark" href="{{ route('checkout') }}">Prceed To Checkout</a></li>
                            </ul>
                        </div>

                    </div>
                    </form>
                    <div class="">

                        <div class="row">
                            <div class="col col-lg-6">
                                @if ($message)
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @endif
                                <form action="{{ url('/cart') }}" method="GET">
                                    <div class="coupon_form form_item mb-0">
                                        <input type="text" name="coupon" placeholder="Coupon Code..."
                                            value="{{ @$_GET['coupon'] }}">
                                        <button type="submit" class="btn btn_dark">Apply Coupon</button>
                                        <div class="info_icon">
                                            <i class="fas fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Your Info Here"></i>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            @else
                <!-- empty_cart_section - start-->
                <section class="empty_cart_section section_space">
                    <div class="container">
                        <div class="empty_cart_content text-center">
                            <span class="cart_icon">
                                <i class="icon icon-ShoppingCart"></i>
                            </span>
                            <h3>There are no more items in your cart</h3>
                            <a class="btn btn_secondary" href="{{ route('homepage') }}"><i
                                    class="far fa-chevron-left"></i>Continue shopping </a>
                        </div>
                    </div>
                </section>
                <!-- empty_cart_section - end==== -->
            @endif
        </div>
    </section>
    {{-- cart_section - end==- --}}
@endsection
@section('footer_script')
    <script>
        let quantity_input = document.querySelectorAll('.abc');
        let arr = Array.from(quantity_input);
        arr.map(item => {
            item.addEventListener('click', function(e) {
                if (e.target.className == 'fal fa-plus') {
                    e.target.parentElement.previousElementSibling.value++
                    let qty = e.target.parentElement.previousElementSibling.value
                    let price = e.target.dataset.price;
                    item.nextElementSibling.innerHTML = price * qty
                }
                if (e.target.parentElement.nextElementSibling.value > 1) {
                    if (e.target.className == 'fal fa-minus') {
                        e.target.parentElement.nextElementSibling.value--
                        let qty = e.target.parentElement.nextElementSibling.value
                        let price = e.target.dataset.price;
                        item.nextElementSibling.innerHTML = price * qty
                    }

                }

            });
        });
    </script>

    <script>
        $('.remove_btn').click(function() {
            let cart_id = $(this).attr('data-cartId');
            // alert(cart_id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: '/getCartId',
                data: {
                    'cart_id': cart_id
                },
                success: function(data) {

                }

            });

        });
    </script>
@endsection
