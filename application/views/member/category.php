<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Category</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php $this->load->view('member/links'); ?>

    <style>
        .tp-category-main-thumb {
            height: 200px;
        }

        .tp-category-main-thumb img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            overflow: auto;
            padding-top: 50px;
            /* keeps proportions and crops excess */
        }
    </style>
</head>

<body>

    <?php $this->load->view('member/header') ?>

    <main>

        <!-- breadcrumb area start -->
        <section class="breadcrumb__area include-bg pt-100 pb-50">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="breadcrumb__content p-relative z-index-1">
                            <h3 class="breadcrumb__title">All Categories</h3>
                            <div class="breadcrumb__list">
                                <span><a href="#">Home</a></span>
                                <span>All Categories</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb area end -->

        <!-- category area start -->
        <section class="tp-category-area pb-120">
            <div class="container">
                <div class="row">
                    <?php if (!empty($allCategories)): ?>
                        <?php foreach ($allCategories as $category): ?>
                            <div class="col-lg-3 col-sm-6">
                                <div class="tp-category-main-box mb-25 p-relative fix" data-bg-color="#F3F5F7">
                                    <div
                                        class="tp-category-main-thumb d-flex justify-content-center align-items-center include-bg transition-3">
                                        <img src="uploads/products/<?= $category->image ?>" width="100" alt="">
                                    </div>
                                    <div class="tp-category-main-content">
                                        <h3 class="tp-category-main-title">
                                            <a href="category/<?php echo $category->slug ?>"><?= $category->category_name?></a>
                                        </h3>
                                        <?php $totalProducts =  $this->db->where('category', $category->category_id)->count_all_results('tbl_product');?>
                                        <span class="tp-category-main-item"><?= $totalProducts?> Products</span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <h2 class="text-center text-muted">No Data Found..</h2>
                    <?php endif ?>
                </div>
                <!-- <div class="row">
                    <div class="col-xl-12">
                        <div class="tp-category-main-result text-center mb-35 mt-35">
                            <p>Showing 12 of 46 products</p>
                            <div class="tp-category-main-result-bar">
                                <span data-width="40%"></span>
                            </div>
                        </div>
                        <div class="tp-category-main-more text-center">
                            <a href="shop.html" class="tp-load-more-btn">
                                Load More
                                <svg width="14" height="13" viewBox="0 0 14 13" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.0003 1.698V5.2986H9.39966" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M11.4933 8.29916C11.1032 9.40329 10.3649 10.3507 9.38948 10.9987C8.41408 11.6467 7.2545 11.9601 6.08548 11.8917C4.91647 11.8233 3.80134 11.3768 2.90816 10.6195C2.01497 9.86225 1.3921 8.83518 1.13343 7.69309C0.874748 6.551 0.99427 5.35578 1.47398 4.28753C1.95369 3.21928 2.7676 2.33588 3.79306 1.77045C4.81852 1.20502 5.99998 0.988199 7.15939 1.15265C8.3188 1.31711 9.39335 1.85393 10.2211 2.68222L12.9996 5.29866"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div> -->
            </div>
        </section>
        <!-- category area end -->


        <!-- subscribe area start -->
        <section class="tp-subscribe-area tp-subscribe-square pt-70 pb-65 theme-bg p-relative z-index-1">
            <div class="tp-subscribe-shape">
                <img class="tp-subscribe-shape-1" src="assets/frontend/img/subscribe/subscribe-shape-1.png" alt="">
                <img class="tp-subscribe-shape-2" src="assets/frontend/img/subscribe/subscribe-shape-2.png" alt="">
                <img class="tp-subscribe-shape-3" src="assets/frontend/img/subscribe/subscribe-shape-3.png" alt="">
                <img class="tp-subscribe-shape-4" src="assets/frontend/img/subscribe/subscribe-shape-4.png" alt="">
                <!-- plane shape -->
                <div class="tp-subscribe-plane">
                    <img class="tp-subscribe-plane-shape" src="assets/frontend/img/subscribe/plane.png" alt="">
                    <svg width="399" height="110" class="d-none d-sm-block" viewBox="0 0 399 110" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M0.499634 1.00049C8.5 20.0005 54.2733 13.6435 60.5 40.0005C65.6128 61.6426 26.4546 130.331 15 90.0005C-9 5.5 176.5 127.5 218.5 106.5C301.051 65.2247 202 -57.9188 344.5 40.0003C364 53.3997 384 22 399 22"
                            stroke="white" stroke-opacity="0.5" stroke-dasharray="3 3" />
                    </svg>
                    <svg class="d-sm-none" width="193" height="110" viewBox="0 0 193 110" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M1 1C4.85463 20.0046 26.9085 13.6461 29.9086 40.0095C32.372 61.6569 13.5053 130.362 7.98637 90.0217C-3.57698 5.50061 85.7981 127.53 106.034 106.525C145.807 65.2398 98.0842 -57.9337 166.742 40.0093C176.137 53.412 185.773 22.0046 193 22.0046"
                            stroke="white" stroke-opacity="0.5" stroke-dasharray="3 3" />
                    </svg>
                </div>
            </div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-7 col-lg-7">
                        <div class="tp-subscribe-content">
                            <span>Sale 20% off all store</span>
                            <h3 class="tp-subscribe-title">Subscribe our Newsletter</h3>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5">
                        <div class="tp-subscribe-form">
                            <form action="#">
                                <div class="tp-subscribe-input">
                                    <input type="email" placeholder="Enter Your Email">
                                    <button type="submit">Subscribe</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- subscribe area end -->
    </main>

    <?php $this->load->view('member/footer') ?>

</body>

</html>