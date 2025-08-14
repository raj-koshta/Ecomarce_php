<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>My Profile</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php $this->load->view('member/links'); ?>

    <style>
        /* Remove Bootstrap's default focus ring */
        .form-control:focus {
            outline: none;
            box-shadow: none;
        }

        .form-control.is-valid,
        .was-validated .form-control:valid,
        input[type=text]:focus {
            border-color: var(--tp-theme-primary);
            box-shadow: none;
        }
    </style>
</head>

<body>

    <?php $this->load->view('member/header') ?>

    <main>
        <?php $user_obj = $this->session->userdata('user_obj'); ?>

        <!-- profile area start -->
        <section class="profile__area pt-120 pb-120">
            <div class="container">
                <div class="profile__inner p-relative">
                    <div class="profile__shape">
                        <img class="profile__shape-1" src="assets/frontend/img/login/laptop.png" alt="">
                        <img class="profile__shape-2" src="assets/frontend/img/login/man.png" alt="">
                        <img class="profile__shape-3" src="assets/frontend/img/login/shape-1.png" alt="">
                        <img class="profile__shape-4" src="assets/frontend/img/login/shape-2.png" alt="">
                        <img class="profile__shape-5" src="assets/frontend/img/login/shape-3.png" alt="">
                        <img class="profile__shape-6" src="assets/frontend/img/login/shape-4.png" alt="">
                    </div>
                    <div class="row">
                        <div class="col-xxl-4 col-lg-4">
                            <div class="profile__tab mr-40">
                                <nav>
                                    <div class="nav nav-tabs tp-tab-menu flex-column" id="profile-tab" role="tablist">
                                        <button class="nav-link active" id="nav-profile-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-profile" type="button" role="tab"
                                            aria-controls="nav-profile" aria-selected="false"><span><i
                                                    class="fa-regular fa-user-pen"></i></span>Profile</button>
                                        <button class="nav-link" id="nav-information-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-information" type="button" role="tab"
                                            aria-controls="nav-information" aria-selected="false"><span><i
                                                    class="fa-regular fa-circle-info"></i></span> Information</button>
                                        <button class="nav-link" id="nav-address-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-address" type="button" role="tab"
                                            aria-controls="nav-address" aria-selected="false"><span><i
                                                    class="fa-light fa-location-dot"></i></span> Address </button>
                                        <button class="nav-link" id="nav-order-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-order" type="button" role="tab"
                                            aria-controls="nav-order" aria-selected="false"><span><i
                                                    class="fa-light fa-clipboard-list-check"></i></span> My Orders
                                        </button>

                                        <button class="nav-link" id="nav-password-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-password" type="button" role="tab"
                                            aria-controls="nav-password" aria-selected="false"><span><i
                                                    class="fa-regular fa-lock"></i></span> Change Password</button>
                                        <span id="marker-vertical" class="tp-tab-line d-none d-sm-inline-block"></span>
                                    </div>
                                </nav>
                            </div>
                        </div>
                        <div class="col-xxl-8 col-lg-8">
                            <div class="profile__tab-content">
                                <div class="tab-content" id="profile-tabContent">
                                    <div class="tab-pane fade show active" id="nav-profile" role="tabpanel"
                                        aria-labelledby="nav-profile-tab">
                                        <div class="profile__main">
                                            <div class="profile__main-top pb-80">
                                                <div class="row align-items-center">
                                                    <div class="col-md-6">
                                                        <!-- Profile Section -->
                                                        <div
                                                            class="profile__main-inner d-flex flex-wrap align-items-center">
                                                            <div class="profile__main-thumb">
                                                                <?php if (!empty($this->session->userdata('user_obj'))): ?>
                                                                    <img id="profileImage"
                                                                        src="uploads/profile/<?= $this->session->userdata('user_obj')->image; ?>"
                                                                        alt="">
                                                                <?php else: ?>
                                                                    <img id="profileImage"
                                                                        src="assets/frontend/img/users/user-10.jpg" alt="">
                                                                <?php endif; ?>

                                                                <div class="profile__main-thumb-edit">
                                                                    <input id="profile-thumb-input"
                                                                        class="profile-img-popup" type="file"
                                                                        name="profile_image"
                                                                        accept=".jpeg,.jpg,.png,.gif">
                                                                    <label for="profile-thumb-input"><i
                                                                            class="fa-light fa-camera"></i></label>
                                                                </div>
                                                            </div>
                                                            <div class="profile__main-content">
                                                                <h4 class="profile__main-title">
                                                                    Welcome <?= $this->session->userdata('username') ?>!
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="profile__main-logout text-sm-end">
                                                            <a href="member/logout" class="tp-logout-btn">Logout</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="profile__main-info">
                                                <div class="row gx-3">
                                                    <div class="col-md-3 col-sm-6">
                                                        <div class="profile__main-info-item">
                                                            <div class="profile__main-info-icon">
                                                                <span>
                                                                    <span
                                                                        class="profile-icon-count profile-download">2</span>
                                                                    <svg enable-background="new 0 0 512 512"
                                                                        viewBox="0 0 512 512">
                                                                        <path
                                                                            d="m334.52 286.41c3.21 3.21 3.21 8.42 0 11.63l-71.73 71.73c-1.48 2.16-3.97 3.59-6.79 3.59-.03 0-.07 0-.1 0s-.07 0-.1 0c-2.11 0-4.21-.8-5.82-2.41l-72.5-72.5c-3.21-3.21-3.21-8.42 0-11.63s8.42-3.21 11.63 0l58.66 58.66v-198.62c0-4.54 3.68-8.23 8.23-8.23 4.54 0 8.23 3.68 8.23 8.23v198.21l58.66-58.66c3.21-3.21 8.42-3.21 11.63 0zm117.29-226.22c39.34 38.21 58.47 100.39 60.19 195.66v.3c-1.72 95.28-20.85 157.46-60.19 195.66-38.21 39.34-100.39 58.47-195.66 60.19-.05 0-.1 0-.15 0s-.1 0-.15 0c-95.28-1.72-157.46-20.85-195.66-60.19-39.34-38.21-58.47-100.38-60.19-195.66 0-.1 0-.2 0-.3 1.72-95.28 20.85-157.46 60.19-195.66 38.21-39.34 100.39-58.47 195.66-60.19h.3c95.27 1.72 157.45 20.85 195.66 60.19zm43.73 195.81c-1.65-90.63-19.22-149.13-55.28-184.09-.06-.06-.12-.12-.18-.18-34.95-36.06-93.45-53.62-184.08-55.27-90.63 1.65-149.13 19.22-184.09 55.28-.06.06-.12.12-.18.18-36.06 34.95-53.62 93.44-55.27 184.08 1.65 90.63 19.22 149.13 55.28 184.09l.18.18c34.95 36.06 93.45 53.62 184.09 55.28 90.63-1.65 149.13-19.22 184.09-55.28l.18-.18c36.04-34.96 53.61-93.45 55.26-184.09z" />
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                            <h4 class="profile__main-info-title">Downlaods</h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-6">
                                                        <div class="profile__main-info-item">
                                                            <div class="profile__main-info-icon">
                                                                <span>
                                                                    <span
                                                                        class="profile-icon-count profile-order">5</span>
                                                                    <svg viewBox="0 0 512 512">
                                                                        <path
                                                                            d="M472.916,224H448.007a24.534,24.534,0,0,0-23.417-18H398V140.976a6.86,6.86,0,0,0-3.346-6.062L207.077,26.572a6.927,6.927,0,0,0-6.962,0L12.48,134.914A6.981,6.981,0,0,0,9,140.976V357.661a7,7,0,0,0,3.5,6.062L200.154,472.065a7,7,0,0,0,3.5.938,7.361,7.361,0,0,0,3.6-.938L306,415.108v41.174A29.642,29.642,0,0,0,335.891,486H472.916A29.807,29.807,0,0,0,503,456.282v-202.1A30.2,30.2,0,0,0,472.916,224Zm-48.077-4A10.161,10.161,0,0,1,435,230.161v.678A10.161,10.161,0,0,1,424.839,241H384.161A10.161,10.161,0,0,1,374,230.839v-.678A10.161,10.161,0,0,1,384.161,220ZM203.654,40.717l77.974,45.018L107.986,185.987,30.013,140.969ZM197,453.878,23,353.619V153.085L197,253.344Zm6.654-212.658-81.668-47.151L295.628,93.818,377.3,140.969ZM306,254.182V398.943l-95,54.935V253.344L384,153.085V206h.217A24.533,24.533,0,0,0,360.8,224H335.891A30.037,30.037,0,0,0,306,254.182Zm183,202.1A15.793,15.793,0,0,1,472.916,472H335.891A15.628,15.628,0,0,1,320,456.282v-202.1A16.022,16.022,0,0,1,335.891,238h25.182a23.944,23.944,0,0,0,23.144,17H424.59a23.942,23.942,0,0,0,23.143-17h25.183A16.186,16.186,0,0,1,489,254.182Z" />
                                                                        <path
                                                                            d="M343.949,325h7.327a7,7,0,1,0,0-14H351V292h19.307a6.739,6.739,0,0,0,6.655,4.727A7.019,7.019,0,0,0,384,289.743v-4.71A7.093,7.093,0,0,0,376.924,278H343.949A6.985,6.985,0,0,0,337,285.033v32.975A6.95,6.95,0,0,0,343.949,325Z" />
                                                                        <path
                                                                            d="M344,389h33a7,7,0,0,0,7-7V349a7,7,0,0,0-7-7H344a7,7,0,0,0-7,7v33A7,7,0,0,0,344,389Zm7-33h19v19H351Z" />
                                                                        <path
                                                                            d="M351.277,439H351V420h18.929a7.037,7.037,0,0,0,14.071.014v-6.745A7.3,7.3,0,0,0,376.924,406H343.949A7.191,7.191,0,0,0,337,413.269v32.975A6.752,6.752,0,0,0,343.949,453h7.328a7,7,0,1,0,0-14Z" />
                                                                        <path
                                                                            d="M393.041,286.592l-20.5,20.5-6.236-6.237a7,7,0,1,0-9.9,9.9l11.187,11.186a7,7,0,0,0,9.9,0l25.452-25.452a7,7,0,0,0-9.9-9.9Z" />
                                                                        <path
                                                                            d="M393.041,415.841l-20.5,20.5-6.236-6.237a7,7,0,1,0-9.9,9.9l11.187,11.186a7,7,0,0,0,9.9,0l25.452-25.452a7,7,0,0,0-9.9-9.9Z" />
                                                                        <path
                                                                            d="M464.857,295H420.891a7,7,0,0,0,0,14h43.966a7,7,0,0,0,0-14Z" />
                                                                        <path
                                                                            d="M464.857,359H420.891a7,7,0,0,0,0,14h43.966a7,7,0,0,0,0-14Z" />
                                                                        <path
                                                                            d="M464.857,423H420.891a7,7,0,0,0,0,14h43.966a7,7,0,0,0,0-14Z" />
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                            <h4 class="profile__main-info-title">Orders</h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-6">
                                                        <div class="profile__main-info-item">
                                                            <div class="profile__main-info-icon">
                                                                <span>
                                                                    <span
                                                                        class="profile-icon-count profile-wishlist">10</span>
                                                                    <svg viewBox="0 -20 480 480"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="m348 0c-43 .0664062-83.28125 21.039062-108 56.222656-24.71875-35.183594-65-56.1562498-108-56.222656-70.320312 0-132 65.425781-132 140 0 72.679688 41.039062 147.535156 118.6875 216.480469 35.976562 31.882812 75.441406 59.597656 117.640625 82.625 2.304687 1.1875 5.039063 1.1875 7.34375 0 42.183594-23.027344 81.636719-50.746094 117.601563-82.625 77.6875-68.945313 118.726562-143.800781 118.726562-216.480469 0-74.574219-61.679688-140-132-140zm-108 422.902344c-29.382812-16.214844-224-129.496094-224-282.902344 0-66.054688 54.199219-124 116-124 41.867188.074219 80.460938 22.660156 101.03125 59.128906 1.539062 2.351563 4.160156 3.765625 6.96875 3.765625s5.429688-1.414062 6.96875-3.765625c20.570312-36.46875 59.164062-59.054687 101.03125-59.128906 61.800781 0 116 57.945312 116 124 0 153.40625-194.617188 266.6875-224 282.902344zm0 0" />
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                            <h4 class="profile__main-info-title">Wishlist</h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-6">
                                                        <div class="profile__main-info-item">
                                                            <div class="profile__main-info-icon">
                                                                <span>
                                                                    <span
                                                                        class="profile-icon-count profile-wishlist">07</span>
                                                                    <svg viewBox="0 0 512 512">
                                                                        <path
                                                                            d="m352.742 291.476h-263.963l228.58-145.334a6 6 0 0 0 1.844-8.284l-22.647-35.618a36.285 36.285 0 0 0 -50.033-11.14l-32.165 20.451 2.548-12.191a34.314 34.314 0 1 0 -66.987-14.914l-16.71 75.054-55.951-12.454a34.315 34.315 0 0 0 -21 65.026l-34.458 21.91a36.285 36.285 0 0 0 -11.14 50.032l22.647 35.619a6 6 0 0 0 8.283 1.845l21.08-13.4v151.888a36.285 36.285 0 0 0 36.246 36.244h223.584a36.285 36.285 0 0 0 36.244-36.244v-162.49a6 6 0 0 0 -6.002-6zm-99.78-190.248a24.084 24.084 0 0 1 12.961-3.794 24.481 24.481 0 0 1 5.316.587 24.09 24.09 0 0 1 15.19 10.658l19.428 30.555-94.5 60.086-32.436-51.014zm-91.33-14.173a22.314 22.314 0 1 1 43.545 9.775l-4.926 23.564-53.667 34.249zm7.16 67.69 32.436 51.014-54.76 34.816-32.435-51.014zm-117.821 37.768a22.314 22.314 0 0 1 23.679-33.754l48.485 10.794-53.822 33.739-4.362-.972a22.168 22.168 0 0 1 -13.98-9.807zm-10.755 115.619-19.427-30.556a24.272 24.272 0 0 1 7.45-33.467l75.667-48.109 32.435 51.014zm116.353 176.078h-57.653a24.272 24.272 0 0 1 -24.244-24.244v-156.49h81.9zm76.264 0h-64.264v-180.734h64.264zm113.909-24.244a24.272 24.272 0 0 1 -24.242 24.244h-77.667v-180.734h101.909z" />
                                                                        <path
                                                                            d="m419.833 236.971 2.87-16.735a6 6 0 0 0 -8.703-6.325l-15.028 7.9-15.029-7.9a6 6 0 0 0 -8.706 6.325l2.87 16.735-12.158 11.85a6 6 0 0 0 3.325 10.235l16.8 2.442 7.514 15.225a6 6 0 0 0 10.762 0l7.513-15.225 16.8-2.442a6 6 0 0 0 3.325-10.235zm-12.817 13.1a6 6 0 0 0 -4.518 3.282l-3.529 7.152-3.53-7.152a6 6 0 0 0 -4.517-3.282l-7.894-1.147 5.712-5.567a6 6 0 0 0 1.726-5.311l-1.349-7.862 7.06 3.711a5.994 5.994 0 0 0 5.584 0l7.059-3.711-1.348 7.862a6 6 0 0 0 1.725 5.311l5.712 5.567z" />
                                                                        <path
                                                                            d="m488.841 154.3-16.5-4.01-6.051-15.863a6 6 0 0 0 -10.714-1.012l-8.911 14.453-16.957.853a6 6 0 0 0 -4.272 9.876l10.991 12.941-4.427 16.39a6 6 0 0 0 8.073 7.115l15.7-6.454 14.227 9.277a6 6 0 0 0 9.261-5.479l-1.285-16.93 13.213-10.657a6 6 0 0 0 -2.348-10.5zm-20.856 13.8a6 6 0 0 0 -2.216 5.125l.6 7.953-6.681-4.359a6 6 0 0 0 -5.559-.524l-7.376 3.032 2.08-7.7a6 6 0 0 0 -1.219-5.449l-5.163-6.079 7.966-.4a6 6 0 0 0 4.807-2.842l4.185-6.789 2.842 7.452a6 6 0 0 0 4.189 3.691l7.751 1.884z" />
                                                                        <path
                                                                            d="m400.6 56.763-4.429 16.39a6 6 0 0 0 8.073 7.116l15.7-6.455 14.221 9.279a6 6 0 0 0 9.261-5.48l-1.285-16.93 13.216-10.658a6 6 0 0 0 -2.348-10.5l-16.5-4.009-6.05-15.864a6 6 0 0 0 -10.714-1.01l-8.91 14.452-16.958.852a6 6 0 0 0 -4.273 9.876zm13.991-11.844a6 6 0 0 0 4.806-2.843l4.186-6.789 2.842 7.452a6 6 0 0 0 4.189 3.692l7.75 1.883-6.208 5.006a6 6 0 0 0 -2.217 5.125l.6 7.954-6.681-4.359a6 6 0 0 0 -5.559-.524l-7.376 3.032 2.08-7.7a6 6 0 0 0 -1.219-5.45l-5.163-6.08z" />
                                                                        <path
                                                                            d="m291.746 237.835c-13.546 8.525-20.164 18.855-20.439 19.291a6 6 0 0 0 10.134 6.427c.9-1.4 22.609-34.215 69.86-22.527a6 6 0 0 0 2.883-11.648c-29.072-7.193-50.001.628-62.438 8.457z" />
                                                                        <path
                                                                            d="m405.6 174.293a6 6 0 0 0 4.6-11.084c-42.714-17.727-73.759-4.452-92.28 9.808a112.488 112.488 0 0 0 -29.868 35.246 6 6 0 1 0 10.748 5.337 101.191 101.191 0 0 1 26.44-31.075c23.288-17.925 50.325-20.697 80.36-8.232z" />
                                                                        <path
                                                                            d="m338.178 129.844a6 6 0 0 0 3.862 7.555 90.163 90.163 0 0 0 25.438 3.676c10.034 0 21.623-1.811 32.015-7.971 13.6-8.058 22.32-21.787 25.934-40.8a6 6 0 1 0 -11.789-2.24c-2.938 15.461-9.738 26.46-20.211 32.69-19.921 11.853-47.267 3.367-47.7 3.229a6 6 0 0 0 -7.549 3.861z" />
                                                                        <path
                                                                            d="m258.867 284.873a10.806 10.806 0 1 0 -10.805-10.806 10.819 10.819 0 0 0 10.805 10.806zm0-12a1.195 1.195 0 1 1 -1.194 1.194 1.2 1.2 0 0 1 1.194-1.194z" />
                                                                        <path
                                                                            d="m343.887 88.873a10.806 10.806 0 1 0 -10.806-10.806 10.818 10.818 0 0 0 10.806 10.806zm0-12a1.195 1.195 0 1 1 -1.195 1.194 1.2 1.2 0 0 1 1.195-1.194z" />
                                                                        <path
                                                                            d="m496.194 80.633a10.806 10.806 0 1 0 10.806 10.805 10.817 10.817 0 0 0 -10.806-10.805zm0 12a1.195 1.195 0 1 1 1.195-1.195 1.2 1.2 0 0 1 -1.195 1.195z" />
                                                                        <path
                                                                            d="m254.444 224.027a10.806 10.806 0 1 0 -10.8 10.806 10.817 10.817 0 0 0 10.8-10.806zm-10.8 1.2a1.195 1.195 0 1 1 1.194-1.2 1.2 1.2 0 0 1 -1.199 1.195z" />
                                                                        <path
                                                                            d="m478.4 230.812a10.806 10.806 0 1 0 10.806 10.806 10.818 10.818 0 0 0 -10.806-10.806zm0 12a1.194 1.194 0 1 1 1.195-1.194 1.2 1.2 0 0 1 -1.195 1.194z" />
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                            <h4 class="profile__main-info-title">Gift Box</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-information" role="tabpanel"
                                        aria-labelledby="nav-information-tab">
                                        <div class="profile__info">
                                            <h3 class="profile__info-title">Personal Details</h3>
                                            <div class="profile__info-content">
                                                <?= form_open('member/update-profile-info') ?>
                                                <div class="row">
                                                    <div class="col-12" style="font-weight: 600;">General</div>
                                                    <div class="col-xxl-6 col-md-6">
                                                        <div class="profile__input-box">
                                                            <div class="profile__input">
                                                                <input type="text" placeholder="Enter your username"
                                                                    name="username" value="<?= $user_obj->username ?>">
                                                                <span>
                                                                    <svg width="17" height="19" viewBox="0 0 17 19"
                                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M9 9C11.2091 9 13 7.20914 13 5C13 2.79086 11.2091 1 9 1C6.79086 1 5 2.79086 5 5C5 7.20914 6.79086 9 9 9Z"
                                                                            stroke="currentColor" stroke-width="1.5"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round" />
                                                                        <path
                                                                            d="M15.5 17.6C15.5 14.504 12.3626 12 8.5 12C4.63737 12 1.5 14.504 1.5 17.6"
                                                                            stroke="currentColor" stroke-width="1.5"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round" />
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-6 col-md-6">
                                                        <div class="profile__input-box">
                                                            <div class="profile__input">
                                                                <input type="email" placeholder="Enter your email"
                                                                    name="email" value="<?= $user_obj->email ?>"
                                                                    readonly>
                                                                <span>
                                                                    <svg width="18" height="16" viewBox="0 0 18 16"
                                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M13 14.6H5C2.6 14.6 1 13.4 1 10.6V5C1 2.2 2.6 1 5 1H13C15.4 1 17 2.2 17 5V10.6C17 13.4 15.4 14.6 13 14.6Z"
                                                                            stroke="currentColor" stroke-width="1.5"
                                                                            stroke-miterlimit="10"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round" />
                                                                        <path
                                                                            d="M13 5.3999L10.496 7.3999C9.672 8.0559 8.32 8.0559 7.496 7.3999L5 5.3999"
                                                                            stroke="currentColor" stroke-width="1.5"
                                                                            stroke-miterlimit="10"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round" />
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="col-xxl-6 col-md-6">
                                                            <div class="profile__input-box">
                                                                <div class="profile__input">
                                                                    <input type="text" placeholder="Enter username"
                                                                        value="shahnewzname">
                                                                    <span>
                                                                        <i class="fa-brands fa-facebook-f"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6 col-md-6">
                                                            <div class="profile__input-box">
                                                                <div class="profile__input">
                                                                    <input type="text" placeholder="Enter username"
                                                                        value="shahnewzname">
                                                                    <span><i class="fa-brands fa-twitter"></i></span>
                                                                </div>
                                                            </div>
                                                        </div> -->
                                                    <div class="col-xxl-6 col-md-6">
                                                        <div class="profile__input-box">
                                                            <div class="profile__input">
                                                                <input type="number" placeholder="Enter your number"
                                                                    min="1" name="phone"
                                                                    value="<?= set_value('phone', !empty($user_obj->phone) ? $user_obj->phone : '', true) ?>">
                                                                <span>
                                                                    <svg width="15" height="18" viewBox="0 0 15 18"
                                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M13.9148 5V13C13.9148 16.2 13.1076 17 9.87892 17H5.03587C1.80717 17 1 16.2 1 13V5C1 1.8 1.80717 1 5.03587 1H9.87892C13.1076 1 13.9148 1.8 13.9148 5Z"
                                                                            stroke="currentColor" stroke-width="1.5"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round" />
                                                                        <path opacity="0.4" d="M9.08026 3.80054H5.85156"
                                                                            stroke="currentColor" stroke-width="1.5"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round" />
                                                                        <path opacity="0.4"
                                                                            d="M7.45425 14.6795C8.14522 14.6795 8.70537 14.1243 8.70537 13.4395C8.70537 12.7546 8.14522 12.1995 7.45425 12.1995C6.76327 12.1995 6.20312 12.7546 6.20312 13.4395C6.20312 14.1243 6.76327 14.6795 7.45425 14.6795Z"
                                                                            stroke="currentColor" stroke-width="1.5"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round" />
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-6 col-md-6">
                                                        <div class="profile__input-box">
                                                            <div class="profile__input">
                                                                <select name="gender">
                                                                    <option value="">Select Gender</option>
                                                                    <option value="Male" <?= !empty($user_obj->gender) ? $user_obj->gender == 'Male' ? 'selected' : '' : '' ?>>
                                                                        Male</option>
                                                                    <option value="Female" <?= !empty($user_obj->gender) ? $user_obj->gender == 'Female' ? 'selected' : '' : '' ?>>Female</option>
                                                                    <option value="Other" <?= !empty($user_obj->gender) ? $user_obj->gender == 'Other' ? 'selected' : '' : '' ?>>Others</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-12">
                                                        <div class="profile__input-box">
                                                            <div class="profile__input">
                                                                <textarea name="bio"
                                                                    placeholder="Enter your bio"><?= !empty($user_obj->bio) ? $user_obj->bio : '' ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-12">
                                                        <div class="profile__btn">
                                                            <button type="submit" class="tp-btn">Update
                                                                Profile</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?= form_close() ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-password" role="tabpanel"
                                        aria-labelledby="nav-password-tab">
                                        <div class="profile__password">
                                            <form action="member/update-password" method="post">
                                                <div class="row">
                                                    <!-- Old Password -->
                                                    <div class="col-xxl-12">
                                                        <div class="tp-profile-input-box old_pass position-relative">
                                                            <div class="tp-contact-input d-flex align-items-center">
                                                                <input name="old_pass" id="old_pass" type="password"
                                                                    class="form-control">
                                                                <i class="bi bi-eye-slash toggle-password ms-2"
                                                                    data-target="#old_pass" style="cursor:pointer;"></i>
                                                            </div>
                                                            <div class="tp-profile-input-title">
                                                                <label for="old_pass">Old Password</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- New Password -->
                                                    <div class="col-xxl-6 col-md-6">
                                                        <div class="tp-profile-input-box position-relative">
                                                            <div class="tp-profile-input d-flex align-items-center">
                                                                <input name="new_pass" id="new_pass" type="password"
                                                                    class="form-control">
                                                                <i class="bi bi-eye-slash toggle-password ms-2"
                                                                    data-target="#new_pass" style="cursor:pointer;"></i>
                                                            </div>
                                                            <div class="tp-profile-input-title">
                                                                <label for="new_pass">New Password</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Confirm Password -->
                                                    <div class="col-xxl-6 col-md-6">
                                                        <div class="tp-profile-input-box position-relative">
                                                            <div class="tp-profile-input d-flex align-items-center">
                                                                <input name="con_new_pass" id="con_new_pass"
                                                                    type="password" class="form-control">
                                                                <i class="bi bi-eye-slash toggle-password ms-2"
                                                                    data-target="#con_new_pass"
                                                                    style="cursor:pointer;"></i>
                                                            </div>
                                                            <div class="tp-profile-input-title">
                                                                <label for="con_new_pass">Confirm Password</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Submit -->
                                                    <div class="col-xxl-6 col-md-6">
                                                        <div class="profile__btn">
                                                            <button type="submit" id="passwordUpdateBtn"
                                                                class="tp-btn">Update</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-address" role="tabpanel"
                                        aria-labelledby="nav-address-tab">
                                        <div class="profile__address">
                                            <div class="row">
                                                <div class="col-12 d-flex justify-content-end mb-20">
                                                    <button type="button" class="tp-btn" data-bs-toggle="modal"
                                                        data-bs-target="#addAddressModal">
                                                        Add Address
                                                    </button>
                                                </div>
                                                <?php if (!empty($addresses)): ?>
                                                    <?php $sn = 1;
                                                    foreach ($addresses as $address): ?>
                                                        <div class="col-md-6">
                                                            <div class="profile__address-item d-sm-flex align-items-start">
                                                                <div class="profile__address-content">
                                                                    <h3 class="profile__address-title">Address <?= $sn++; ?>
                                                                        <a href="javascript:void(0)" class="edit-address-btn"
                                                                            style="color: skyblue;"
                                                                            data-id="<?= $address->id ?>"
                                                                            data-street="<?= htmlspecialchars($address->street) ?>"
                                                                            data-city="<?= htmlspecialchars($address->city) ?>"
                                                                            data-state="<?= htmlspecialchars($address->state) ?>"
                                                                            data-phone="<?= htmlspecialchars($address->phone) ?>"
                                                                            data-zip="<?= htmlspecialchars($address->zip_code) ?>"
                                                                            data-country="<?= htmlspecialchars($address->country) ?>">
                                                                            <i class="bi bi-pencil-square"></i>
                                                                        </a>
                                                                        <a href="javascript:void(0)" style="color: red;"><i
                                                                                class="bi bi-trash"></i></a>
                                                                    </h3>
                                                                    <p><span>Street:</span><?= $address->street ?></p>
                                                                    <p><span>City:</span><?= $address->city ?></p>
                                                                    <p><span>State/province/area:</span><?= $address->state ?>
                                                                    </p>
                                                                    <p><span>Phone number:</span><?= $address->phone ?></p>
                                                                    <p><span>Zip code:</span><?= $address->zip_code ?></p>
                                                                    <p><span>Country:</span><?= $address->country ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <div class="col-md-6">
                                                        <div class="profile__address-item d-sm-flex align-items-start">
                                                            No Record Found...
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-order" role="tabpanel"
                                        aria-labelledby="nav-order-tab">
                                        <div class="profile__ticket table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Order Id</th>
                                                        <th scope="col">Product Title</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">View</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row"> #2245</th>
                                                        <td data-info="title">How can i share ?</td>
                                                        <td data-info="status pending">Pending </td>
                                                        <td><a href="#" class="tp-logout-btn">Invoice</a></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"> #2220</th>
                                                        <td data-info="title">Send money, but not working</td>
                                                        <td data-info="status reply">Need your replay</td>
                                                        <td><a href="#" class="tp-logout-btn">Reply</a></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"> #2125</th>
                                                        <td data-info="title">Balance error</td>
                                                        <td data-info="status done">Resolved</td>
                                                        <td><a href="#" class="tp-logout-btn">Invoice</a></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"> #2124</th>
                                                        <td data-info="title">How to decline bid</td>
                                                        <td data-info="status hold">On Hold</td>
                                                        <td><a href="#" class="tp-logout-btn">Status</a></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"> #2121</th>
                                                        <td data-info="title">How to contact</td>
                                                        <td data-info="status done">Resolved</td>
                                                        <td><a href="#" class="tp-logout-btn">Invoice</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- profile area end -->

    </main>

    <!-- Crop Modal -->
    <div class="modal fade" id="cropImageModal" tabindex="-1" aria-labelledby="cropImageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crop Profile Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <div>
                        <img id="imagePreview" style="max-width: 100%;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="uploadCroppedImage" class="btn btn-primary">Upload</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Address Modal -->
    <div class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="addAddressModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg"> <!-- Large width for better 2-column layout -->
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="addAddressModalLabel">Add Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <form id="addressForm" action="member/add-address" method="post" novalidate>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="street" class="form-label">Street</label>
                                <input type="text" class="form-control" id="street" name="street" required>
                                <div class="invalid-feedback">Please enter your street.</div>
                            </div>

                            <div class="col-md-6">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control" id="city" name="city" required>
                                <div class="invalid-feedback">Please enter your city.</div>
                            </div>

                            <div class="col-md-6">
                                <label for="state" class="form-label">State / Province / Area</label>
                                <input type="text" class="form-control" id="state" name="state" required>
                                <div class="invalid-feedback">Please enter your state or province.</div>
                            </div>

                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="number" class="form-control" id="phone" name="phone" pattern="[0-9]{10}"
                                    required>
                                <div class="invalid-feedback">Please enter a valid 10-digit phone number.</div>
                            </div>

                            <div class="col-md-6">
                                <label for="zip" class="form-label">Zip Code</label>
                                <input type="number" class="form-control" id="zip" name="zip_code" pattern="[0-9]{4,6}"
                                    required>
                                <div class="invalid-feedback">Please enter a valid zip code.</div>
                            </div>

                            <div class="col-md-6">
                                <label for="country" class="form-label">Country</label>
                                <input type="text" class="form-control" id="country" name="country" required>
                                <div class="invalid-feedback">Please enter your country.</div>
                            </div>
                        </div>

                        <div class="mt-4 d-flex justify-content-end">
                            <button type="submit" class="tp-btn address-form-submit-btn">Save</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

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


    <?php $this->load->view('member/footer') ?>

    <!-- For profile information update toster show -->
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
            $('#toastMessage').text(<?= $this->session->flashdata('errorMsg') ?>);
            // Show toast
            let toast = new bootstrap.Toast(document.getElementById('uploadToast'));
            toast.show();
        </script>
    <?php endif; ?>

    <!-- Profile pic upload script -->
    <script>
        let cropper;
        let selectedFile;

        $('#profile-thumb-input').on('change', function (e) {
            const files = e.target.files;
            if (files && files.length > 0) {
                selectedFile = files[0];
                const reader = new FileReader();
                reader.onload = function (event) {
                    $('#imagePreview').attr('src', event.target.result);
                    $('#cropImageModal').modal('show');
                };
                reader.readAsDataURL(selectedFile);
            }
        });

        $('#cropImageModal').on('shown.bs.modal', function () {
            cropper = new Cropper(document.getElementById('imagePreview'), {
                aspectRatio: 1,
                viewMode: 1,
                responsive: true,
                autoCropArea: 1
            });
        }).on('hidden.bs.modal', function () {
            cropper.destroy();
            cropper = null;
        });

        $('#uploadCroppedImage').on('click', function () {
            if (!cropper) return;
            cropper.getCroppedCanvas({
                width: 300,
                height: 300
            }).toBlob(function (blob) {
                const formData = new FormData();
                formData.append('image', blob, 'profile.jpg');
                formData.append('user_id', '<?= $this->session->userdata('user_id') ?>');

                $.ajax({
                    url: '<?= base_url("member/upload_profile_image") ?>',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        let res = JSON.parse(response);

                        // Set toast message & style
                        if (res.status === 'success') {
                            $('#uploadToast').removeClass('text-bg-danger').addClass('text-bg-success');
                            $('#toastMessage').text('Image uploaded successfully!');
                        } else {
                            $('#uploadToast').removeClass('text-bg-success').addClass('text-bg-danger');
                            $('#toastMessage').text(res.message || 'Something went wrong!');
                        }

                        // Show toast
                        let toast = new bootstrap.Toast(document.getElementById('uploadToast'));
                        toast.show();

                        // Close modal
                        $('#cropImageModal').modal('hide');

                        // Reload page after 2 seconds
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    },
                    error: function () {
                        $('#uploadToast').removeClass('text-bg-success').addClass('text-bg-danger');
                        $('#toastMessage').text('Server error! Please try again.');
                        let toast = new bootstrap.Toast(document.getElementById('uploadToast'));
                        toast.show();
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    }
                });
            }, 'image/jpeg');
        });


    </script>

    <!-- Address form submittion validation -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const form = document.getElementById("addressForm");

            form.addEventListener("submit", function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add("was-validated");
            }, false);
        });
    </script>

    <!-- Script for edit address  -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const editButtons = document.querySelectorAll(".edit-address-btn");

            editButtons.forEach(btn => {
                btn.addEventListener("click", function () {
                    // Fill form fields
                    document.getElementById("street").value = this.dataset.street;
                    document.getElementById("city").value = this.dataset.city;
                    document.getElementById("state").value = this.dataset.state;
                    document.getElementById("phone").value = this.dataset.phone;
                    document.getElementById("zip").value = this.dataset.zip;
                    document.getElementById("country").value = this.dataset.country;

                    // Change form action to include the address ID for editing
                    document.getElementById("addressForm").action = "member/update-address/" + this.dataset.id;

                    document.querySelector('.address-form-submit-btn').innerHTML = 'Update';

                    // Show modal
                    const modal = new bootstrap.Modal(document.getElementById("addAddressModal"));
                    modal.show();
                });
            });
        });
    </script>


    <!-- password hide and unhide -->
    <script>
        $(document).on("click", ".toggle-password", function () {
            var inputSelector = $(this).data("target");
            var input = $(inputSelector);

            if (input.attr("type") === "password") {
                input.attr("type", "text");
                $(this).removeClass("bi-eye-slash").addClass("bi-eye");
            } else {
                input.attr("type", "password");
                $(this).removeClass("bi-eye").addClass("bi-eye-slash");
            }
        });

    </script>

    <!-- Script for old password check -->
    <script>
        $(document).ready(function () {
            var oldPassValid = false;

            // Check old password on blur
            $("#old_pass").on("blur", function () {
                var oldPass = $(this).val().trim();
                var errorBoxId = "old-pass-error";
                $("#" + errorBoxId).remove();

                if (oldPass !== "") {
                    $.ajax({
                        url: "<?= base_url('member/check_old_password') ?>",
                        type: "POST",
                        data: { old_pass: oldPass },
                        dataType: "json",
                        success: function (data) {
                            oldPassValid = data.valid;

                            if (!data.valid) {
                                var error = $("<div>")
                                    .attr("id", errorBoxId)
                                    .addClass("text-danger mt-1")
                                    .text("Old password is incorrect.");
                                $("#old_pass").closest('.tp-profile-input-box.old_pass').append(error);
                            }

                            validateForm();
                        },
                        error: function (xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                }
            });

            // Check match of new password & confirm password
            $("#new_pass, #con_new_pass").on("input", function () {
                validateForm();
            });

            // Validate form
            function validateForm() {
                var newPass = $("#new_pass").val().trim();
                var conPass = $("#con_new_pass").val().trim();
                var oldPass = $("#old_pass").val().trim();

                var allFilled = oldPass !== "" && newPass !== "" && conPass !== "";

                // only disable if old password is wrong or fields empty
                if (allFilled && oldPassValid) {
                    $("#passwordUpdateBtn").prop("disabled", false);
                } else {
                    $("#passwordUpdateBtn").prop("disabled", true);
                }
            }


            // Form submit check
            $("form").on("submit", function (e) {
                let newPass = $("#new_pass").val().trim();
                let conPass = $("#con_new_pass").val().trim();
                console.log(newPass);

                if (newPass != conPass) {
                    e.preventDefault();
                    $('#uploadToast').removeClass('text-bg-success').addClass('text-bg-danger');
                    $('#toastMessage').text("New password and confirm password do not match.");
                    let toast = new bootstrap.Toast(document.getElementById('uploadToast'));
                    toast.show();
                    return; // stop here
                }

                if (!oldPassValid) {
                    e.preventDefault();
                    $('#uploadToast').removeClass('text-bg-success').addClass('text-bg-danger');
                    $('#toastMessage').text('Please Enter Old Password');
                    let toast = new bootstrap.Toast(document.getElementById('uploadToast'));
                    toast.show();
                    return; // stop here
                }
            });

        });

    </script>




</body>

</html>