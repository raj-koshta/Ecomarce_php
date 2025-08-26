<?php
if (empty($this->CartModel->get_cart())) {
    redirect('member/index'); // or show a message
}
?>


<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Checkout</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php $this->load->view('member/links'); ?>

    <style>
        .card p {
            margin-bottom: 5px;
        }

        .address-card {
            cursor: pointer;
            display: block;
            transition: all 0.2s ease-in-out;
        }

        .address-card:hover {
            background-color: #f8f9fa;
        }

        .address-checkbox:checked~* {
            border-color: #007bff;
        }
    </style>
</head>

<body>

    <?php $this->load->view('member/header') ?>

    <main>

        <!-- breadcrumb area start -->
        <section class="breadcrumb__area include-bg pt-95 pb-50" data-bg-color="#EFF1F5">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="breadcrumb__content p-relative z-index-1">
                            <h3 class="breadcrumb__title">Checkout</h3>
                            <div class="breadcrumb__list">
                                <span><a href="#">Home</a></span>
                                <span>Checkout</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb area end -->

        <!-- checkout area start -->
        <section class="tp-checkout-area pb-120" data-bg-color="#EFF1F5">
            <div class="container">
                <div class="row">
                    <div class="col-xl-7 col-lg-7">
                        <div class="tp-checkout-verify">
                            <div class="tp-checkout-verify-item" style="margin-bottom: 0px;">
                                <p class="tp-checkout-verify-reveal">
                                    Want to use previous billing addresses?
                                    <button type="button" class="tp-checkout-login-form-reveal-btn">Click here to see
                                        previous addresses
                                    </button>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-30">
                        <div id="tpReturnCustomerLoginForm" class="tp-return-customer">
                            <div class="row">
                                <?php if(!empty($billingAddresses)):?>
                                    <?php $sn = 1;?>
                                    <?php foreach($billingAddresses as $billingAddress):?>
                                        <div class="col-md-6 col-lg-4">
                                            <label class="card border p-3 address-card" for="selectAddress<?= $billingAddress->id?>"
                                            data-billing_address_id="<?= $billingAddress->id?>"
                                            data-first_name="<?= $billingAddress->first_name?>"
                                            data-last_name="<?= $billingAddress->last_name?>"
                                            data-country="<?= $billingAddress->country?>"
                                            data-street="<?= $billingAddress->street?>"
                                            data-city="<?= $billingAddress->city?>"
                                            data-state="<?= $billingAddress->state?>"
                                            data-zip="<?= $billingAddress->zip_code?>"
                                            data-phone="<?= $billingAddress->phone?>"
                                            data-email="<?= $billingAddress->email?>">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <h4 class="mb-0">Address <?= $sn++;?></h4>
                                                    <input type="checkbox" name="selectAddress" value="1" id="selectAddress<?= $billingAddress->id?>"
                                                    class="address-checkbox">
                                                </div>
                                                <p><strong>Name:</strong> <?= $billingAddress->first_name.' '.$billingAddress->last_name?></p>
                                                <p><strong>Country:</strong> <?= $billingAddress->country?></p>
                                                <p><strong>Address:</strong> <?= $billingAddress->street.' '.$billingAddress->city.' '.$billingAddress->state.' '.$billingAddress->country.', '.$billingAddress->zip_code?></p>
                                                <p><strong>Phone:</strong> <?= $billingAddress->phone?></p>
                                                <p><strong>Email:</strong> <?= $billingAddress->email?></p>
                                            </label>
                                        </div>
                                    <?php endforeach;?>
                                <?php else:?>
                                    <div class="col-12 d-flex text-center">
                                        No Billing records found.
                                    </div>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="tp-checkout-bill-area">
                            <h3 class="tp-checkout-bill-title">Billing Details</h3>

                            <div class="tp-checkout-bill-form">
                                <form action="member/place_order" method="post" id="billing_address">
                                    <div class="tp-checkout-bill-inner">
                                        <div class="row">
                                            <input type="hidden" name="billing_address_id">
                                            <input type="hidden" name="delivery" value="<?= $total_price['delivery'] ?>">
                                            <input type="hidden" name="grandtotal" value="<?= $total_price['grandtotal'] ?>">
                                            <input type="hidden" name="payment" id="payment_method" value="cod">
                                            <input type="hidden" name="checkout_token" value="<?= $checkout_token ?>">
                                            <div class="col-md-6">
                                                <div class="tp-checkout-input">
                                                    <label>First Name <span>*</span></label>
                                                    <input type="text" placeholder="First Name" name="first_name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="tp-checkout-input">
                                                    <label>Last Name <span>*</span></label>
                                                    <input type="text" placeholder="Last Name" name="last_name" required>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-12">
                                                <div class="tp-checkout-input">
                                                    <label>Company name (optional)</label>
                                                    <input type="text" placeholder="Example LTD.">
                                                </div>
                                            </div> -->
                                            <div class="col-md-12">
                                                <div class="tp-checkout-input">
                                                    <label>Street address</label>
                                                    <input required type="text" placeholder="House number, street name, Apartment, suite, unit, etc. (optional)" name="street">
                                                </div>

                                                <!-- <div class="tp-checkout-input">
                                                    <input type="text"
                                                        placeholder="Apartment, suite, unit, etc. (optional)">
                                                </div> -->
                                            </div>
                                            <div class="col-md-6">
                                                <div class="tp-checkout-input">
                                                    <label>Country / Region </label>
                                                    <input type="text" placeholder="United States" name="country" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="tp-checkout-input">
                                                    <label>Town / City</label>
                                                    <input type="text" placeholder="Texas" name="city" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="tp-checkout-input">
                                                    <label>State / County</label>
                                                    <input type="text" placeholder="Austin" name="state" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="tp-checkout-input">
                                                    <label>Postcode ZIP</label>
                                                    <input type="number" placeholder="45236" name="zip_code" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="tp-checkout-input">
                                                    <label>Phone <span>*</span></label>
                                                    <input type="number" placeholder="8562351574" name="phone" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="tp-checkout-input">
                                                    <label>Email address <span>*</span></label>
                                                    <input type="email" placeholder="xyz@gmail.com" name="email" required>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-12">
                                                <div class="tp-checkout-option-wrapper">
                                                    <div class="tp-checkout-option">
                                                        <input id="create_free_account" type="checkbox">
                                                        <label for="create_free_account">Create an account?</label>
                                                    </div>
                                                    <div class="tp-checkout-option">
                                                        <input id="ship_to_diff_address" type="checkbox">
                                                        <label for="ship_to_diff_address">Ship to a different
                                                            address?</label>
                                                    </div>
                                                </div>
                                            </div> -->
                                            <div class="col-md-12">
                                                <div class="tp-checkout-input">
                                                    <label>Order notes (optional)</label>
                                                    <textarea name="order_note"
                                                        placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <!-- checkout place order -->
                        <div class="tp-checkout-place white-bg">
                            <h3 class="tp-checkout-place-title">Your Order</h3>

                            <?php if(!empty($carts)):?>
                                <div class="tp-order-info-list">
                                    <ul>

                                        <!-- header -->
                                        <li class="tp-order-info-list-header">
                                            <h4>Product</h4>
                                            <h4>Total</h4>
                                        </li>

                                        <!-- item list -->
                                        <?php foreach($carts as $cart):?>
                                            <li class="tp-order-info-list-desc">
                                                <!-- <p><?= $cart->product_name?><span> x <?= $cart->product_qty?></span></p> -->
                                                <p><?= substr($cart->product_name, 0, 30) ?><?= (strlen($cart->product_name) > 30 ? '...' : '') ?><span> x <?= $cart->product_qty ?></span></p>
                                                <span>
                                                    <?php $totalPrice = $cart->selling_price * $cart->product_qty;
                                                    echo '$'.number_format($totalPrice,2);?>
                                                </span>
                                            </li>
                                        <?php endforeach;?>
                                        

                                        <!-- subtotal -->
                                        <li class="tp-order-info-list-subtotal">
                                            <span>Subtotal</span>
                                            <span>$<?= number_format($total_price['subtotal'],2)?></span>
                                        </li>

                                        <li class="tp-order-info-list-subtotal">
                                            <span>Shipping Charges</span>
                                            <?php if($total_price['subtotal'] > 999): ?>
                                                <span>$<?php echo number_format($total_price['delivery'],2)?></span>
                                            <?php else:?>
                                                    <span>$<?php echo number_format($total_price['delivery'],2)?></span>
                                            <?php endif;?>
                                        </li>

                                        <li>
                                            <span>Have a coupon?</span>
                                            <span>
                                                <button type="button" class="tp-checkout-coupon-form-reveal-btn">
                                                    Click here to enter your code
                                                </button>
                                            </span>
                                        </li>
                                        <div id="tpCheckoutCouponForm" class="tp-return-customer" style="margin-top: 0px;">
                                            <form action="#">
                                                <div class="tp-return-customer-input">
                                                    <label>Coupon Code :</label>
                                                    <input type="text" placeholder="Coupon">
                                                </div>
                                                <button type="submit"
                                                    class="tp-return-customer-btn tp-checkout-btn">Apply</button>
                                            </form>
                                        </div>

                                        <!-- total -->
                                        <li class="tp-order-info-list-total">
                                            <span>Total</span>
                                            <span>$<?= number_format($total_price['grandtotal'],2)?></span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tp-checkout-payment">
                                    <div class="tp-checkout-payment-item">
                                        <input type="radio" id="back_transfer" name="payment">
                                        <label for="back_transfer" data-bs-toggle="direct-bank-transfer">Direct Bank
                                            Transfer</label>
                                        <div class="tp-checkout-payment-desc direct-bank-transfer">
                                            <p>Make your payment directly into our bank account. Please use your Order ID as
                                                the payment reference. Your order will not be shipped until the funds have
                                                cleared in our account.</p>
                                        </div>
                                    </div>
                                    <div class="tp-checkout-payment-item">
                                        <input type="radio" id="cheque_payment" name="payment">
                                        <label for="cheque_payment">Cheque Payment</label>
                                        <div class="tp-checkout-payment-desc cheque-payment">
                                            <p>Make your payment directly into our bank account. Please use your Order ID as
                                                the payment reference. Your order will not be shipped until the funds have
                                                cleared in our account.</p>
                                        </div>
                                    </div>
                                    <div class="tp-checkout-payment-item">
                                        <input type="radio" id="cod" name="payment" checked>
                                        <label for="cod">Cash on Delivery</label>
                                        <!-- <div class="tp-checkout-payment-desc cash-on-delivery" style="display: block;">
                                            <p>Make your payment directly into our bank account. Please use your Order ID as
                                                the payment reference. Your order will not be shipped until the funds have
                                                cleared in our account.</p>
                                        </div> -->
                                    </div>
                                    <div class="tp-checkout-payment-item paypal-payment">
                                        <input type="radio" id="paypal" name="payment">
                                        <label for="paypal">PayPal <img src="assets/frontend/img/icon/payment-option.png" alt=""> <a
                                                href="https://www.paypal.com/in/home">What is PayPal?</a></label>
                                    </div>
                                </div>
                                <div class="tp-checkout-agree">
                                    <div class="tp-checkout-option">
                                        <input id="read_all" type="checkbox">
                                        <label for="read_all">I have read and agree to the website.</label>
                                    </div>
                                </div>
                                <div class="tp-checkout-btn-wrapper">
                                    <button type="submit" form="billing_address" class="tp-checkout-btn w-100">Place Order</button>
                                </div>
                            <?php else:?>
                                <p>Your Cart is empty.</p>
                                <div class="tp-checkout-btn-wrapper">
                                    <a href="<?= base_url('')?>" class="tp-checkout-btn w-100">Continue Shopping</a>
                                </div>
                            <?php endif;?>

                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- checkout area end -->


    </main>

    <?php $this->load->view('member/footer') ?>

    <!-- Toast Container -->
    <div class="position-fixed end-0 p-3" style="z-index: 11;top: 20px !important;">
        <div id="uploadToast" class="toast align-items-center text-bg-success border-0" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body" id="toastMessage">
                    Image uploaded successfully!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>


    <!-- For  information update toster show -->
    <?php if (!empty($this->session->flashdata('successMsg'))): ?>
        <script>
            $('#uploadToast').removeClass('text-bg-danger').addClass('text-bg-success');
            $('#toastMessage').text('<?= $this->session->flashdata('successMsg') ?>');
            // Show toast
            let toast = new bootstrap.Toast(document.getElementById('uploadToast'));
            toast.show();
        </script>
    <?php elseif (!empty($this->session->flashdata('errorMsg'))): ?>
        <script>
            $('#uploadToast').removeClass('text-bg-success').addClass('text-bg-danger');
            $('#toastMessage').text('<?= $this->session->flashdata('errorMsg') ?>');
            // Show toast
            let toast = new bootstrap.Toast(document.getElementById('uploadToast'));
            toast.show();
        </script>
    <?php endif; ?>

    <!-- Auto Address Filling -->
    <script>
        $(document).on("change", ".address-checkbox", function () {
            // Uncheck all other checkboxes
            $(".address-checkbox").not(this).prop("checked", false);

            // If current checkbox is checked, autofill form
            if ($(this).is(":checked")) {
                let card = $(this).closest(".address-card");

                $("input[name='first_name']").val(card.data("first_name"));
                $("input[name='last_name']").val(card.data("last_name"));
                $("input[name='country']").val(card.data("country"));
                $("input[name='street']").val(card.data("street"));
                $("input[name='city']").val(card.data("city"));
                $("input[name='state']").val(card.data("state"));
                $("input[name='zip_code']").val(card.data("zip"));
                $("input[name='phone']").val(card.data("phone"));
                $("input[name='email']").val(card.data("email"));
                $("input[name='billing_address_id']").val(card.data("billing_address_id"));
            } else {
                // Optional: clear form if user unchecks the selected address
                $("input[name='first_name'], input[name='last_name'], input[name='country'], input[name='street'], input[name='city'], input[name='state'], input[name='zip_code'], input[name='phone'], input[name='email']").val('');
            }
        });

    </script>

    <script>
        $(document).on("change", "input[name=payment]", function(){
            $("#payment_method").val($(this).attr("id"));
        });

    </script>
</body>

</html>