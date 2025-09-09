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
        <section class="breadcrumb__area include-bg text-center pt-70">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="breadcrumb__content p-relative z-index-1">
                            <!-- <h3 class="breadcrumb__title">Forgot Password</h3>
                            <div class="breadcrumb__list">
                                <span><a href="#">Home</a></span>
                                <span>Reset Passowrd</span>
                            </div> -->
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
                        <div class="tp-login-wrapper" style="padding-top: 20px;">
                            <div class="tp-login-top text-center mb-50">
                                <h3 class="breadcrumb__title mb-3">Reset Passowrd</h3>
                                <p>Enter your email address to request password reset.</p>
                            </div>
                            <div class="tp-login-option">
                                <?= form_open('', ['id' => 'otpForm']) ?>
                                <div class="tp-login-input-wrapper">
                                    <div class="tp-login-input-box">
                                        <div class="tp-login-input">
                                            <input id="email" name="email" type="email" placeholder="shofy@mail.com"
                                                required>
                                        </div>
                                        <div class="tp-login-input-title">
                                            <label for="email">Your Email</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- OTP field (hidden by default) -->
                                <div class="tp-login-input-wrapper mt-3" id="otpSection" style="display:none;">
                                    <div class="tp-login-input-box">
                                        <div class="tp-login-input">
                                            <input id="otp" name="otp" type="text" placeholder="Enter OTP">
                                        </div>
                                        <div class="tp-login-input-title">
                                            <label for="otp">Enter OTP</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="tp-login-bottom mb-15">
                                    <button type="button" id="sendMailBtn" class="tp-login-btn w-100">Send Mail</button>
                                    <button type="button" id="verifyOtpBtn" class="tp-login-btn w-100"
                                        style="display:none;">Verify OTP</button>
                                </div>
                                <?= form_close() ?>

                                <div class="tp-login-suggetions d-sm-flex align-items-center justify-content-center">
                                    <div class="tp-login-forgot">
                                        <span>Remeber Passowrd? <a href="member/login"> Login</a></span>

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

    <!-- Change Password Modal -->
    <div class="modal fade" id="changePasswordModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3">
                <div class="modal-header">
                    <h5 class="modal-title">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="changePasswordForm">
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">New Password</label>
                            <input type="password" id="newPassword" name="newPassword" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" id="confirmPassword" name="confirmPassword" class="form-control"
                                required>
                        </div>
                        <div id="passwordError" class="text-danger mb-2" style="display:none;"></div>
                        <button type="submit" class="btn btn-primary w-100">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <?php $this->load->view('member/footer') ?>

    <script>
        $(document).ready(function () {

            let email = '';

            // when Send Mail is clicked
            $('#sendMailBtn').on('click', function (e) {
                e.preventDefault();

                email = $('#email').val();
                if (email == '') {
                    Swal.fire({
                        icon: 'error',
                        title: "Please enter email",
                        showConfirmButton: true
                    });
                    return;
                }

                $.ajax({
                    url: "<?= base_url('auth/send_otp') ?>",
                    type: "POST",
                    data: { email: email },
                    dataType: "json",
                    success: function (data) {
                        if (data.status === 'success') {
                            $('#otpSection').show();
                            $('#sendMailBtn').hide();
                            $('#verifyOtpBtn').show();

                            Swal.fire({
                                icon: 'success',
                                title: data.message,
                                showConfirmButton: true
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: data.message,
                                showConfirmButton: true
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr.responseText);
                        Swal.fire({
                            icon: 'error',
                            title: "Something went wrong!",
                            showConfirmButton: true
                        });
                    }
                });
            });

            $('#verifyOtpBtn').on('click', function (e) {
                e.preventDefault();

                let otp = $('#otp').val();
                if (otp == '') {
                    Swal.fire({
                        icon: 'error',
                        title: "Please enter OTP",
                        showConfirmButton: true
                    });
                    return;
                }

                $.ajax({
                    url: "<?= base_url('auth/verify_otp') ?>",
                    type: "POST",
                    data: { otp: otp },
                    dataType: "json",
                    success: function (data) {
                        if (data.status === 'success') {
                            // ✅ OTP matched
                            $('#otpSection').hide();
                            $('#sendMailBtn').show();
                            $('#verifyOtpBtn').hide();

                            // Open Change Password Modal
                            var modal = new bootstrap.Modal(document.getElementById('changePasswordModal'));
                            modal.show();
                        } else if (data.message.includes('expired')) {
                            // ✅ OTP expired
                            $('#otpSection').hide();
                            $('#sendMailBtn').show();
                            $('#verifyOtpBtn').hide();

                            Swal.fire({
                                icon: 'error',
                                title: data.message,
                                showConfirmButton: true
                            });
                        } else {
                            // ❌ Invalid OTP
                            // Keep OTP section open, keep Verify OTP button
                            Swal.fire({
                                icon: 'error',
                                title: data.message,
                                showConfirmButton: true
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr.responseText);
                        Swal.fire({
                            icon: 'error',
                            title: "Something went wrong!",
                            showConfirmButton: true
                        });
                    }
                });
            });


            // Handle Change Password form submit
            $('#changePasswordForm').on('submit', function (e) {
                e.preventDefault();

                let newPass = $('#newPassword').val();
                let confirmPass = $('#confirmPassword').val();

                if (newPass === '' || confirmPass === '') {
                    $('#passwordError').text("Both fields are required.").show();
                    return;
                }

                if (newPass !== confirmPass) {
                    $('#passwordError').text("New password and Confirm password must match.").show();
                    return;
                }

                $('#passwordError').hide();

                // Example AJAX request to update password
                $.ajax({
                    url: "<?= base_url('auth/change_password') ?>",
                    type: "POST",
                    data: { password: newPass, email: email },
                    dataType: "json",
                    success: function (data) {
                        if (data.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: data.message,
                                showConfirmButton: true
                            }).then(() => {
                                window.location.replace("<?= base_url('member/login')?>");
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: data.message,
                                showConfirmButton: true
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr.responseText);
                        Swal.fire({
                            icon: 'error',
                            title: "Something went wrong!",
                            showConfirmButton: true
                        });
                    }
                });
            });


        });
    </script>


</body>

</html>