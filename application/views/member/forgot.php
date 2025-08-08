<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Forgot Password</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php $this->load->view('member/links'); ?>
</head>

<body>

    <?php $this->load->view('member/header') ?>


    <main>

        <!-- breadcrumb area start -->
        <section class="breadcrumb__area include-bg text-center pt-95 pb-50">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="breadcrumb__content p-relative z-index-1">
                            <h3 class="breadcrumb__title">Forgot Password</h3>
                            <div class="breadcrumb__list">
                                <span><a href="#">Home</a></span>
                                <span>Reset Passowrd</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb area end -->

        <!-- login area start -->
        <section class="tp-login-area pb-140 p-relative z-index-1 fix">
            <div class="tp-login-shape">
                <img class="tp-login-shape-1" src="assets/frontend/img/login/login-shape-1.png" alt="">
                <img class="tp-login-shape-2" src="assets/frontend/img/login/login-shape-2.png" alt="">
                <img class="tp-login-shape-3" src="assets/frontend/img/login/login-shape-3.png" alt="">
                <img class="tp-login-shape-4" src="assets/frontend/img/login/login-shape-4.png" alt="">
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-8">
                        <div class="tp-login-wrapper">
                            <div class="tp-login-top text-center mb-30">
                                <h3 class="tp-login-title">Reset Passowrd</h3>
                                <p>Enter your email address to request password reset.</p>
                            </div>
                            <div class="tp-login-option">
                                <div class="tp-login-input-wrapper">
                                    <div class="tp-login-input-box">
                                        <div class="tp-login-input">
                                            <input id="email" type="email" placeholder="shofy@mail.com">
                                        </div>
                                        <div class="tp-login-input-title">
                                            <label for="email">Your Email</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="tp-login-bottom mb-15">
                                    <button type="submit" class="tp-login-btn w-100">Send Mail</button>
                                </div>
                                <div class="tp-login-suggetions d-sm-flex align-items-center justify-content-center">
                                    <div class="tp-login-forgot">
                                        <span>Remeber Passowrd? <a href="login.html"> Login</a></span>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- login area end -->

    </main>

    <?php $this->load->view('member/footer') ?>

</body>

</html>