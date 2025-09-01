<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Wishlist</title>
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
                            <h3 class="breadcrumb__title">Wishlist</h3>
                            <div class="breadcrumb__list">
                                <span><a href="#">Home</a></span>
                                <span>Wishlist</span>
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
                <div class="row">
                    <div class="col-xl-12">
                        <div class="tp-cart-list mb-45 mr-30">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan="2" class="tp-cart-header-product">Product</th>
                                        <th class="tp-cart-header-price">Price</th>
                                        <th class="tp-cart-header-quantity">Quantity</th>
                                        <th>Action</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($wishlists)): ?>
                                        <?php foreach ($wishlists as $wishlist): ?>
                                            <form action="member/add-to-cart" method="post">
                                                <tr>
                                                    <!-- img -->
                                                    <td class="tp-cart-img"><a href="product/<?= $wishlist->slug ?>"> <img
                                                                src="uploads/products/<?= $wishlist->product_image ?>"
                                                                alt=""></a></td>
                                                    <!-- title -->
                                                    <td class="tp-cart-title"><a
                                                            href="product/<?= $wishlist->slug ?>"><?= $wishlist->product_name ?></a>
                                                    </td>
                                                    <!-- price -->
                                                    <td class="tp-cart-price">
                                                        <span>$<?= number_format($wishlist->product_price, 2) ?></span>
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
                                                            <input class="tp-cart-input" type="text" value="1"
                                                                name="product_qty">
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
                                                    </td>
                                                    <input type="hidden" name="product_id" value="<?= $wishlist->product_id ?>">
                                                    <td class="tp-cart-add-to-cart">
                                                        <button type="submit" class="tp-btn tp-btn-2 tp-btn-blue">Add To
                                                            Cart</button>
                                                    </td>

                                                    <!-- action -->
                                                    <td class="tp-cart-action">
                                                        <a class="tp-cart-action-btn"
                                                            href="member/delete-wishlist/<?= $wishlist->wishlist_id ?>">
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
                                            </form>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5">No records found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tp-cart-bottom">
                            <div class="row align-items-end">
                                <div class="col-xl-6 col-md-4">
                                    <div class="tp-cart-update">
                                        <a href="member/cart" class="tp-cart-update-btn">Go To Cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- cart area end -->

    </main>
    <?php $this->load->view('member/footer') ?>

    <?php if (!empty($this->session->flashdata('successMsg'))): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: '<?= $this->session->flashdata('successMsg') ?>',
                showConfirmButton: false,
                timer: 2500
            });
        </script>
    <?php elseif (!empty($this->session->flashdata('errorMsg'))): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: '<?= $this->session->flashdata('errorMsg') ?>',
                showConfirmButton: true
            });
        </script>
    <?php endif; ?>
</body>

</html>