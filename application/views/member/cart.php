<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Cart</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php $this->load->view('member/links'); ?>
</head>

<body>

    <?php $this->load->view('member/header') ?>


    <main>

        <!-- breadcrumb area start -->
        <section class="breadcrumb__area include-bg pt-95 pb-50">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="breadcrumb__content p-relative z-index-1">
                            <h3 class="breadcrumb__title">Shopping Cart</h3>
                            <div class="breadcrumb__list">
                                <span><a href="#">Home</a></span>
                                <span>Shopping Cart</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb area end -->

        <!-- cart area start -->
        <section class="tp-cart-area pb-120">
            <div class="container">

                <?php if ($this->session->flashdata('successMsg')) { ?>
                    <div class="alert alert-success">
                        <?= $this->session->flashdata('successMsg'); ?>
                    </div>
                <?php } else if ($this->session->flashdata('errorMsg')) { ?>
                        <div class="alert alert-danger">
                        <?= $this->session->flashdata('errorMsg'); ?>
                        </div>
                <?php } ?>
                <?php echo form_open('member/update-cart') ?>
                <div class="row">
                    <?php if (!empty($carts)): ?>
                        <div class="col-xl-9 col-lg-8">
                            <div class="tp-cart-list mb-25 mr-30">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="2" class="tp-cart-header-product">Product</th>
                                            <th class="tp-cart-header-price">Price</th>
                                            <th class="tp-cart-header-quantity">Quantity</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                        <?php foreach ($carts as $cart): ?>
                                            <tr>
                                                <!-- img -->
                                                <td class="tp-cart-img"><a href="#">
                                                        <img src="uploads/products/<?= $cart->product_image ?>" alt="">
                                                    </a></td>
                                                <!-- title -->
                                                <td class="tp-cart-title"><a href="#"><?= $cart->product_name ?></a></td>
                                                <!-- price -->
                                                <td class="tp-cart-price">
                                                    <span>$<?= number_format($cart->selling_price, 2) ?></span>
                                                </td>
                                                <!-- quantity -->
                                                <td class="tp-cart-quantity">
                                                    <div class="tp-product-quantity mt-10 mb-10">
                                                        <span class="tp-cart-minus">
                                                            <svg width="10" height="2" viewBox="0 0 10 2" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M1 1H9" stroke="currentColor" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                        </span>
                                                        <input class="tp-cart-input" type="text" name="up_qty[]" readonly
                                                            value="<?= $cart->product_qty ?>">
                                                        <span class="tp-cart-plus">
                                                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M5 1V9" stroke="currentColor" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path d="M1 5H9" stroke="currentColor" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                        </span>
                                                    </div>
                                                    <input type="hidden" name="up_product_id[]"
                                                        value="<?= $cart->product_id ?>">
                                                </td>
                                                <!-- action -->
                                                <td class="tp-cart-action">
                                                    <a href="member/delete-cart/<?= $cart->product_id ?>"
                                                        class="tp-cart-action-btn">
                                                        <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M9.53033 1.53033C9.82322 1.23744 9.82322 0.762563 9.53033 0.46967C9.23744 0.176777 8.76256 0.176777 8.46967 0.46967L5 3.93934L1.53033 0.46967C1.23744 0.176777 0.762563 0.176777 0.46967 0.46967C0.176777 0.762563 0.176777 1.23744 0.46967 1.53033L3.93934 5L0.46967 8.46967C0.176777 8.76256 0.176777 9.23744 0.46967 9.53033C0.762563 9.82322 1.23744 9.82322 1.53033 9.53033L5 6.06066L8.46967 9.53033C8.76256 9.82322 9.23744 9.82322 9.53033 9.53033C9.82322 9.23744 9.82322 8.76256 9.53033 8.46967L6.06066 5L9.53033 1.53033Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                        <span>Remove</span>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                            <div class="tp-cart-bottom">
                                <div class="row align-items-end">
                                <!-- <div class="col-xl-6 col-md-8">
                                    <div class="tp-cart-coupon">
                                        <form action="#">
                                            <div class="tp-cart-coupon-input-box">
                                                <label>Coupon Code:</label>
                                                <div class="tp-cart-coupon-input d-flex align-items-center">
                                                    <input type="text" placeholder="Enter Coupon Code">
                                                    <button type="submit">Apply</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div> -->
                                    <div class="col-xl-11 col-md-11">
                                        <div class="tp-cart-update text-md-end">
                                            <button type="submit" class="tp-cart-update-btn">Update Cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <div class="tp-cart-checkout-wrapper">
                                <div class="tp-cart-checkout-top d-flex align-items-center justify-content-between">
                                    <span class="tp-cart-checkout-top-title">Subtotal</span>
                                    <span class="tp-cart-checkout-top-price">$<?php echo number_format($total_price['subtotal'],2) ?></span>
                                </div>
                                <div class="tp-cart-checkout-shipping">
                                    <h4 class="tp-cart-checkout-shipping-title">Shipping</h4>

                                    <div class="tp-cart-checkout-shipping-option-wrapper">
                                        <?php if($total_price['subtotal'] > 999): ?>
                                            <div class="tp-cart-checkout-shipping-option d-flex align-items-center justify-content-between">
                                                <p>
                                                    <input id="free_shipping" type="radio" name="freeshipping" checked readonly>
                                                    <label for="free_shipping">Free shipping</label>
                                                </p>
                                                <p style="text-decoration: line-through;">$<?php echo number_format($total_price['delivery'],2)?></p>
                                            </div>
                                        <?php else :?>
                                            <div class="tp-cart-checkout-shipping-option d-flex align-items-center justify-content-between">
                                                <p>
                                                    <input id="shipping_charges" type="radio" name="shippingcharges" checked readonly>
                                                    <label for="shipping_charges">shipping Charges</label>
                                                </p>
                                                <p>$<?php echo number_format($total_price['delivery'],2)?></p>
                                                
                                            </div>
                                        <?php endif;?>
                                    </div>
                                </div>
                                <div class="tp-cart-checkout-total d-flex align-items-center justify-content-between">
                                    <span>Total</span>
                                    <span>$<?php echo number_format($total_price['grandtotal'],2);?></span>
                                </div>
                                <div class="tp-cart-checkout-proceed">
                                    <a href="member/checkout" class="tp-cart-checkout-btn w-100">Proceed to Checkout</a>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <tr>
                            <td class="tp-cart-title" colspan="4">
                                <p style="text-align: center;"> No Product Found. </p>
                                <a href="#" class="btn btn-primary w-25 m-auto">Shop Now</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                </div>
                <?php echo form_close() ?>
            </div>
        </section>
        <!-- cart area end -->

    </main>

    <?php $this->load->view('member/footer') ?>

</body>

</html>