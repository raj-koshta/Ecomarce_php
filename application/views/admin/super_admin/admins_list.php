<!doctype html>
<html lang="en">


<!-- Mirrored from themesdesign.in/tocly/layouts/5.3.1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Nov 2023 08:52:23 GMT -->

<head>

    <meta charset="utf-8" />
    <title><?= $title?></title>
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
                    <div class="card">
                        <div class="card-body">

                            <div class="card-header border-0 align-items-center d-flex mb-4 p-0 pt-2">
                                <h4 class="card-title mb-0 flex-grow-1"><?= $title ?></h4>
                            </div>

                            <table id="datatable-buttons"
                                class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Admin ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Gender</th>
                                        <th>Phone</th>
                                        <th>Joined On</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <?php if (!empty($admins)): ?>
                                        <?php $i = 1;
                                        foreach ($admins as $admin): ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $admin->admin_id?></td>
                                                <td><?= $admin->name?></td>
                                                <td><?= $admin->email?></td>
                                                <td>
                                                    <select data-admin_id="<?= $admin->admin_id ?>"
                                                    name="role_id" id="role-toggle">
                                                    <?php foreach($roles as $role):?>
                                                        <option value="<?= $role->role_id?>"
                                                            <?= $admin->role_id == $role->role_id ? 'selected' : ''?>
                                                            >
                                                                <?= $role->role_name?>
                                                        </option>
                                                    <?php endforeach;?>
                                                    </select>
                                                </td>
                                                <td><?= $admin->gender?></td>
                                                <td><?= $admin->phone?></td>
                                                <td><?= date('M d, Y',strtotime($admin->added_on))?></td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input admin-status-toggle"
                                                            type="checkbox"
                                                            data-admin_id="<?= $admin->admin_id ?>"
                                                            <?= $admin->status == '1' ? 'checked' : '' ?> 
                                                        >
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>

                            </table>
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
        $(document).on("change", "#role-toggle", function () {
            let admin_id = $(this).data("admin_id");
            let role_id = $(this).val();

            $.ajax({
                url: "<?= base_url('superadmin/update-role') ?>",
                type: "POST",
                data: { admin_id: admin_id, role_id: role_id },
                dataType: "json",
                success: function (res) {
                    if (res.success) {
                        Swal.fire({
                            icon: 'success',
                            title: res.msg,
                            showConfirmButton: false,
                            timer: 2500
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: res.msg,
                            showConfirmButton: true
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: "Something went wrong!",
                        showConfirmButton: true
                    });
                }
            });
        });

        $(document).on("change", ".admin-status-toggle", function () {
            let admin_id = $(this).data("admin_id");
            let status = $(this).is(":checked") ? 1 : 0;

            $.ajax({
                url: "<?= base_url('superadmin/update-status') ?>",
                type: "POST",
                data: { admin_id: admin_id, status: status },
                dataType: "json",
                success: function (res) {
                    if (res.success) {
                        Swal.fire({
                            icon: 'success',
                            title: res.msg,
                            showConfirmButton: false,
                            timer: 2500
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: res.msg,
                            showConfirmButton: true
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: "Something went wrong!",
                        showConfirmButton: true
                    });
                }
            });
        });
    </script>