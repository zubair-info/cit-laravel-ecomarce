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
                        @foreach ($carts as $cart)
                            <tr>
                                <td>
                                    <div class="cart_product">
                                        <img src="{{ asset('uploads/product/preview') }}/{{ $cart->rel_to_product->preview }}"
                                            alt="image_not_found">
                                        <h3><a href="shop_details.html">{{ $cart->rel_to_product->product_name }}</a></h3>
                                    </div>
                                </td>
                                <td class="text-center abc"><span class="price_text">&#2547;
                                        {{ $cart->rel_to_product->after_discount }}</span>
                                </td>
                                <td class="text-center abc">
                                    <form action="#">
                                        <div class="quantity_input">
                                            <button type="button" class="input_number_decrement">
                                                <i data-price={{ $cart->rel_to_product->after_discount }}
                                                    class="fal fa-minus"></i>
                                            </button>
                                            <input class="input_numbers" type="text" value="{{ $cart->quantity }}" />
                                            <button type="button" class="input_number_increment">
                                                <i data-price={{ $cart->rel_to_product->after_discount }}
                                                    class="fal fa-plus"></i>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                                <td class="text-center abc"><span class="price_text">&#2547;
                                        {{ $cart->rel_to_product->after_discount * $cart->quantity }}</span></td>
                                <td class="text-center"><button type="button" data-cartId={{ $cart->id }}
                                        class="remove_btn"><i class="fal fa-trash-alt"></i></button></td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

            <div class="cart_btns_wrap">
                <div class="row">
                    <div class="col col-lg-6">
                        <form action="#">
                            <div class="coupon_form form_item mb-0">
                                <input type="text" name="coupon" placeholder="Coupon Code...">
                                <button type="submit" class="btn btn_dark">Apply Coupon</button>
                                <div class="info_icon">
                                    <i class="fas fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Your Info Here"></i>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col col-lg-6">
                        <ul class="btns_group ul_li_right">
                            <li><a class="btn border_black" href="#!">Update Cart</a></li>
                            <li><a class="btn btn_dark" href="#!">Prceed To Checkout</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col col-lg-6">
                    <div class="calculate_shipping">
                        <h3 class="wrap_title">Calculate Shipping <span class="icon"><i
                                    class="far fa-arrow-up"></i></span></h3>
                        <form action="#">
                            <div class="select_option clearfix">
                                <select>
                                    <option value="">Select Your Option</option>
                                    <option value="1">Inside City</option>
                                    <option value="2">Outside City</option>
                                </select>
                            </div>
                            <br>
                            <button type="submit" class="btn btn_primary rounded-pill">Update Total</button>
                        </form>
                    </div>
                </div>

                <div class="col col-lg-6">
                    <div class="cart_total_table">
                        <h3 class="wrap_title">Cart Totals</h3>
                        <ul class="ul_li_block">
                            <li>
                                <span>Cart Subtotal</span>
                                <span>$52.50</span>
                            </li>
                            <li>
                                <span>Delivery Charge</span>
                                <span>$5</span>
                            </li>
                            <li>
                                <span>Order Total</span>
                                <span class="total_price">$57.50</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
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
