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

                                    <?= form_open('admin/add_admin', ['id' => 'adminForm']); ?>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="name" name="name"
                                                    placeholder="Enter Your Name" value="">
                                                <label for="name">Name</label>
                                                <?php echo form_error('name') ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="email" class="form-control" id="email" name="email"
                                                    placeholder="Enter Your Email" value="" readonly>
                                                <label for="email">Email</label>
                                                <?php echo form_error('email') ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control" id="password"
                                                    name="password" placeholder="Enter Your Password"
                                                    autocomplete="false">
                                                <label for="password">Password</label>
                                                <?php echo form_error('password') ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control" id="confirm_password"
                                                    name="confirm_password" placeholder="Enter Your Confirm Password"
                                                    autocomplete="false">
                                                <label for="confirm_password">Confirm Password</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <select class="form-control" name="role_id" id="role_id">
                                                    <option value="">Select Role</option>
                                                    <?php foreach ($roles as $role): ?>
                                                        <option value="<?= $role->role_id ?>"><?= $role->role_name ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <label for="role_id">Role</label>
                                                <?php echo form_error('role_id') ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <select class="form-control" name="gender" id="gender">
                                                    <option value="">Select Gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                                <label for="gender">Gender</label>
                                                <?php echo form_error('gender') ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" id="phone" name="phone">
                                                <label for="phone">Phone</label>
                                                <?php echo form_error('phone') ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <select class="form-control" name="status">
                                                    <option value="">Select Status</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                                <label for="status">Status</label>
                                                <?php echo form_error('status') ?>
                                            </div>
                                        </div>

                                    </div>

                                    <div>
                                        <button type="submit" class="btn btn-primary w-md">Submit</button>
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
        document.getElementById("adminForm").addEventListener("submit", function (e) {
            let password = document.getElementById("password").value.trim();
            let confirmPassword = document.getElementById("confirm_password").value.trim();

            if (password !== confirmPassword) {
                e.preventDefault(); // stop form submission
                Swal.fire({
                    icon: 'error',
                    title: 'Password Mismatch',
                    text: 'Password and Confirm Password must be the same!',
                    confirmButtonColor: '#3085d6',
                });
            }
        });
    </script>