@extends('fontend.master')
@section('content')
    <!-- breadcrumb_section - start ================================================== -->
    <div class="breadcrumb_section">
        <div class="container">
            <ul class="breadcrumb_nav ul_li">
                <li><a href="index.html">Home</a></li>
                <li>Checkout</li>
            </ul>
        </div>
    </div>
    <!-- breadcrumb_section - end================================================== -->

    <!-- checkout-section - start -->
    <section class="checkout-section section_space">
        <div class="container">
            <div class="row">
                <div class="col col-xs-12">
                    <div class="woocommerce bg-light p-3">
                        <form name="checkout" method="post" class="checkout woocommerce-checkout"
                            action="{{ route('checkout.insert') }}">
                            @csrf
                            <div class="col2-set" id="customer_details">
                                <div class="coll-1">
                                    <div class="woocommerce-billing-fields">
                                        <h3>Billing Details</h3>
                                        <p class="form-row form-row form-row-first validate-required"
                                            id="billing_first_name_field">
                                            <label for="billing_first_name" class="">Name <abbr
                                                    class="required" title="required">*</abbr></label>
                                            <input type="text" class="input-text " name="name" id="billing_first_name"
                                                placeholder="" autocomplete="given-name"
                                                value="{{ Auth::guard('customerlogin')->user()->name }}" />
                                        </p>
                                        <p class="form-row form-row form-row-last validate-required validate-email"
                                            id="billing_email_field">
                                            <label for="billing_email" class="">Email Address <abbr
                                                    class="required" title="required">*</abbr></label>
                                            <input type="email" class="input-text " name="email" id="billing_email"
                                                placeholder="" autocomplete="email"
                                                value="{{ Auth::guard('customerlogin')->user()->email }}" />
                                        </p>
                                        <div class="clear"></div>
                                        <p class="form-row form-row form-row-first" id="billing_company_field">
                                            <label for="billing_company" class="">Company Name</label>
                                            <input type="text" class="input-text " name="company" id="company"
                                                placeholder="" autocomplete="organization" value="" />
                                        </p>

                                        <p class="form-row form-row form-row-last validate-required validate-phone"
                                            id="billing_phone_field">
                                            <label for="billing_phone" class="">Phone <abbr
                                                    class="required" title="required">*</abbr></label>
                                            <input type="tel" class="input-text " name="phone" id="billing_phone"
                                                placeholder="" autocomplete="tel"
                                                value="{{ Auth::guard('customerlogin')->user()->number }}" />
                                        </p>
                                        <div class="clear"></div>
                                        <p class="form-row form-row form-row-first address-field update_totals_on_change validate-required"
                                            id="billing_country_field">
                                            <label for="billing_country" class="">Country <abbr
                                                    class="required" title="required">*</abbr></label>
                                            <select name="country_id" class="js-example-basic-single" id="country_id">
                                                <option value="">Select a Country&hellip;</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                        <p
                                            class="form-row form-row form-row-first address-field update_totals_on_change validate-required">
                                            <label for="state_id" class="">State <abbr class="required"
                                                    title="required">*</abbr></label>
                                            <select name="state_id" class="js-example-basic-single" id="state_id">
                                                <option value="">Select a State</option>

                                            </select>
                                        </p>
                                        <p
                                            class="form-row form-row form-row-first address-field update_totals_on_change validate-required">
                                            <label for="city_id" class="">City <abbr class="required"
                                                    title="required">*</abbr></label>
                                            <select name="city_id" class="js-example-basic-single" id="city_id">
                                                <option value="">Select a City</option>

                                            </select>
                                        </p>



                                        <p class="form-row form-row form-row-last address-field validate-required"
                                            id="billing_address_1_field">
                                            <label for="billing_address_1" class="">Address <abbr
                                                    class="required" title="required">*</abbr></label>
                                            <input type="text" class="input-text " name="address" id="billing_address_1"
                                                placeholder="Street address" autocomplete="address-line1" value="" />
                                        </p>
                                    </div>
                                    <p class="form-row form-row notes" id="order_comments_field">
                                        <label for="order_comments" class="">Order Notes</label>
                                        <textarea name="notes" class="input-text " id="order_comments"
                                            placeholder="Notes about your order, e.g. special notes for delivery."
                                            rows="2" cols="5"></textarea>
                                    </p>
                                </div>
                            </div>
                            <h3 id="order_review_heading">Your order</h3>
                            <div id="order_review" class="woocommerce-checkout-review-order">
                                <table class="shop_table woocommerce-checkout-review-order-table">
                                    @php
                                        $sub_total = 0;
                                        foreach (App\Models\Cart::where('customer_id', Auth::guard('customerlogin')->id())->get() as $cart) {
                                            $sub_total += $cart->rel_to_product->after_discount * $cart->quantity;
                                        }
                                        
                                    @endphp
                                    <tr class="cart-subtotal">
                                        <th>Subtotal</th>
                                        <td><span class="woocommerce-Price-amount amount">&#2547;
                                                <span> {{ $sub_total }}</span></span>
                                        </td>
                                        <input type="hidden" name="sub_total" id="sub_total" value="{{ $sub_total }}">

                                    </tr>
                                    <tr class="cart-subtotal">
                                        <th>Discount</th>
                                        <td><span class="woocommerce-Price-amount amount">
                                                {{ session('discount') }}</span>
                                            {{ session('type') }}

                                        </td>
                                        {{-- koto % discount cilo  seta controller deya hoicha --}}
                                        <input type="hidden" name="discount" value="{{ session('discount') }}">

                                        {{-- cart page theke discount calculation kore niya ascha hoicha --}}
                                        <input type="hidden" id="discount" value="{{ session('discount_cal') }}">
                                    </tr>
                                    <tr class="shipping">
                                        <th>Delivery Charge</th>
                                        <td data-title="Shipping">

                                            <input type="radio" class="delivery_btn" name="delivery_charge" value="60">
                                            Dhaka (60)
                                            <br>
                                            <input type="radio" class="delivery_btn" name="delivery_charge" value="100">
                                            Outside Dhaka (100)
                                        </td>
                                    </tr>
                                    <tr class="order-total">
                                        <th>Total</th>
                                        <td><strong><span class="woocommerce-Price-amount amount"
                                                    id="grad_total">{{ session('discount_cal') }}</span></strong>
                                        </td>
                                    </tr>
                                </table>
                                <div id="payment" class="woocommerce-checkout-payment py-3 mt-5">
                                    <ul class="wc_payment_methods payment_methods methods">
                                        <li class="wc_payment_method payment_method_cheque mb-2">
                                            <input id="payment_method_cheque" type="radio" class="input-radio"
                                                name="payment_method" value="1" checked='checked'
                                                data-order_button_text="" />
                                            <!--grop add span for radio button style-->
                                            <span class='grop-woo-radio-style'></span>
                                            <!--custom change-->
                                            <label for="payment_method_cheque">Cash On Delivery</label>
                                        </li>
                                        <li class="wc_payment_method payment_method_paypal mb-2">
                                            <input id="payment_method_ssl" type="radio" class="input-radio"
                                                name="payment_method" value="2"
                                                data-order_button_text="Proceed to SSL Commerz" />
                                            <!--grop add span for radio button style-->
                                            <span class='grop-woo-radio-style'></span>
                                            <!--custom change-->
                                            <label for="payment_method_ssl">SSL Commerz</label>
                                        </li>
                                        <li class="wc_payment_method payment_method_paypal">
                                            <input id="payment_method_stripe" type="radio" class="input-radio"
                                                name="payment_method" value="3"
                                                data-order_button_text="Proceed to SSL Commerz" />
                                            <!--grop add span for radio button style-->
                                            <span class='grop-woo-radio-style'></span>
                                            <!--custom change-->
                                            <label for="payment_method_stripe">Stripe Payment</label>
                                        </li>
                                    </ul>
                                    <div class="form-row place-order">
                                        <noscript>
                                            Since your browser does not support JavaScript, or it is disabled, please ensure
                                            you click the <em>Update Totals</em> button before placing your order. You may
                                            be charged more than the amount stated above if you fail to do so.
                                            <br />
                                            <input type="submit" class="button alt"
                                                name="woocommerce_checkout_update_totals" value="Update totals" />
                                        </noscript>
                                        <input type="submit" class="button alt" id="place_order" value="Place order" />

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- checkout-section - end -->
@endsection
@section('footer_script')
    <script>
        $('.delivery_btn').click(function() {
            // alert('ok');
            var devilery_charge = $(this).val();
            var sub_total = $('#sub_total').val();
            var discount = $('#discount').val();
            var total = parseInt(discount) + parseInt(devilery_charge);
            $('#grad_total').html(total);
            alert(discount)
            // alert(devilery_charge)
        })
    </script>

    <script>
        // In your Javascript (external .js resource or <script> tag) select 2 dropdown
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>

    {{-- country ajax dropdown --}}
    <script>
        $('#country_id').change(function() {
            var country_id = $(this).val();
            // alert(country_id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/getState',
                type: 'post',
                data: {
                    'country_id': country_id
                },
                success: function(data) {
                    // alert(data)
                    $('#state_id').html(data);
                    $('#state_id').select2();

                }
            });

        });
    </script>
    <script>
        $('#state_id').change(function() {
            var state_id = $(this).val();
            // alert(state_id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/getCity',
                type: 'post',
                data: {
                    'state_id': state_id
                },
                success: function(data) {
                    // alert(data)
                    // $('#city_id').select2();
                    $('#city_id').html(data);

                }
            });

        });
    </script>
@endsection
