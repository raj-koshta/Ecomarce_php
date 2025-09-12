<!doctype html>
<html lang="en">


<!-- Mirrored from themesdesign.in/tocly/layouts/5.3.1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Nov 2023 08:52:23 GMT -->

<head>

    <meta charset="utf-8" />
    <title><?= $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <base href="<?php echo base_url() ?>">
    <?php $this->load->view('admin/links'); ?>

</head>

<?php $this->load->view('admin/header'); ?>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">


            <div class="row">
                <div class="col-xl-12">
                    <div class="row">

                        <div class="col-xl-12">
                            <div class="card">

                                <div class="card-body">
                                    <h5 class="card-title mb-5"><?= $title ?></h5>

                                    <?= form_open('admin/forgot_admin_password', array('id' => 'password-form')); ?>
                                    <!-- <?php if (!empty($cate)): ?>
                                    <?php endif; ?> -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control" id="old_password"
                                                    name="old_password" autocomplete="false" autocapitalize="false" aria-autocomplete="false">
                                                <label for="old_password">Old Password</label>
                                                <?php echo form_error('old_password') ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control" id="new_password"
                                                    name="new_password" autocomplete="false" autocapitalize="false" aria-autocomplete="false">
                                                <label for="new_password">New Password</label>
                                                <?php echo form_error('new_password') ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control" id="confirm_password"
                                                    name="confirm_password" autocomplete="false" autocapitalize="false" aria-autocomplete="false">
                                                <label for="confirm_password">Confirm Password</label>
                                                <?php echo form_error('confirm_password') ?>
                                            </div>
                                        </div>

                                    </div>

                                    <input type="hidden" name="email" value="<?= $admin->email?>">
                                    <div>
                                        <button type="submit" class="btn btn-primary w-md">Update</button>
                                    </div>
                                    <?= form_close() ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <!-- END ROW -->



        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <?php $this->load->view('admin/footer'); ?>

    <script>
        $(document).ready(function () {
            var oldPassValid = false;
            var lastCheckedOldPass = "";

            // Optional: quick feedback on blur (still uses Swal only)
            $("#old_password").on("blur", function () {
                var oldPass = $(this).val().trim();
                if (oldPass === "") {
                    oldPassValid = false;
                    lastCheckedOldPass = "";
                    return;
                }

                // Do AJAX check (non-blocking)
                $.ajax({
                    url: "<?= base_url('admin/check_old_password') ?>",
                    type: "POST",
                    data: { old_password: oldPass },
                    dataType: "json"
                }).done(function (data) {
                    // Accept either { valid: true } or plain true/false
                    var valid = false;
                    if (typeof data === 'object' && data !== null) {
                        valid = (data.valid === true || data.valid === "true");
                    } else {
                        valid = (data === true || data === "true");
                    }

                    oldPassValid = valid;
                    lastCheckedOldPass = oldPass;

                    if (!valid) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Old password is incorrect.',
                            showConfirmButton: true
                        });
                    }
                }).fail(function (xhr, status, err) {
                    console.error('Old password check failed:', xhr.responseText || status);
                });
            });

            // Submit handler: full validation + server-side old-password check if needed
            $("#password-form").on("submit", function (e) {
                e.preventDefault();
                var form = this;
                var $form = $(form);
                var oldPass = $("#old_password").val().trim();
                var newPass = $("#new_password").val().trim();
                var conPass = $("#confirm_password").val().trim();

                // Collect missing fields
                var missingFields = [];
                if (oldPass === "") missingFields.push("Old Password");
                if (newPass === "") missingFields.push("New Password");
                if (conPass === "") missingFields.push("Confirm Password");

                if (missingFields.length > 0) {
                    Swal.fire({
                        icon: 'error',
                        title: "Please fill the following field(s):",
                        html: "<b>" + missingFields.join(", ") + "</b>",
                        showConfirmButton: true
                    });
                    return false;
                }

                // Length check
                if (newPass.length < 6) {
                    Swal.fire({
                        icon: 'error',
                        title: "Password must be at least 6 characters long.",
                        showConfirmButton: true
                    });
                    return false;
                }

                // Match check
                if (newPass !== conPass) {
                    Swal.fire({
                        icon: 'error',
                        title: "New password and confirm password do not match.",
                        showConfirmButton: true
                    });
                    return false;
                }

                // If we already validated this exact old password, submit immediately
                if (oldPassValid && lastCheckedOldPass === oldPass) {
                    form.submit(); // native submit (bypasses jQuery handler) -> sends form to server
                    return;
                }

                // Otherwise check old password via AJAX, then submit if valid
                var $submitBtn = $form.find('button[type="submit"]').first();
                $submitBtn.prop('disabled', true).data('orig-text', $submitBtn.text()).text('Checking...');

                $.ajax({
                    url: "<?= base_url('admin/check_old_password') ?>",
                    type: "POST",
                    data: { old_password: oldPass },
                    dataType: "json"
                }).done(function (data) {
                    var valid = false;
                    if (typeof data === 'object' && data !== null) {
                        valid = (data.valid === true || data.valid === "true");
                    } else {
                        valid = (data === true || data === "true");
                    }

                    if (!valid) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Old password is incorrect.',
                            showConfirmButton: true
                        });
                        oldPassValid = false;
                        lastCheckedOldPass = "";
                        $submitBtn.prop('disabled', false).text($submitBtn.data('orig-text'));
                        return;
                    }

                    // all good -> submit
                    oldPassValid = true;
                    lastCheckedOldPass = oldPass;
                    form.submit(); // native submit
                }).fail(function (xhr, status, err) {
                    // console.error('Old password check failed:', xhr.responseText || status);
                    Swal.fire({
                        icon: 'error',
                        title: 'Could not validate old password. Please try again.',
                        showConfirmButton: true
                    });
                    $submitBtn.prop('disabled', false).text($submitBtn.data('orig-text'));
                });
            });

        });
    </script>