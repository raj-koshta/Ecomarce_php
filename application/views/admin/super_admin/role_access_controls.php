<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title><?= $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="<?= base_url() ?>">
    <?php $this->load->view('admin/links'); ?>
</head>

<?php $this->load->view('admin/header'); ?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">

                        <!-- Page Title -->
                        <div class="card-header border-0 align-items-center d-flex pb-0">
                            <h4 class="card-title mb-0 flex-grow-1"><?= $title ?></h4>
                        </div>

                        <div class="card-body mt-3">

                            <!-- Admin Select Dropdown -->
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="admin_select">
                                            <option value="">Select Admin</option>
                                            <?php foreach ($admins as $admin): ?>
                                                <option value="<?= $admin->admin_id ?>"
                                                    <?= ($selected_admin == $admin->admin_id) ? 'selected' : '' ?>>
                                                    <?= $admin->name ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label for="admin_select">Select Admin</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Access Form -->
                            <?php if ($selected_admin): ?>
                                <?= form_open('superadmin/update-role-access'); ?>

                                <input type="hidden" name="admin_id" value="<?= $selected_admin ?>">

                                <div class="row mt-4">
                                    <?php foreach ($accesses as $key => $label): ?>

                                        <div class="col-md-4 col-sm-6 mb-4">
                                            <div class="d-flex justify-content-between align-items-center p-3 border rounded">

                                                <h6 class="m-0"><?= $label ?></h6>

                                                <div class="square-switch">
                                                    <input type="checkbox"
                                                           id="<?= $key ?>"
                                                           name="<?= $key ?>"
                                                           switch="none"
                                                           <?= (!empty($admin_access[$key]) && $admin_access[$key] == 1) ? 'checked' : '' ?>>

                                                    <label for="<?= $key ?>" 
                                                           data-on-label="On" 
                                                           data-off-label="Off"></label>
                                                </div>

                                            </div>
                                        </div>

                                    <?php endforeach; ?>
                                </div>

                                <button type="submit" class="btn btn-primary ms-2">Update</button>

                                <?= form_close(); ?>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php $this->load->view('admin/footer'); ?>
</div>

<script>
    // Auto reload on admin change
    document.getElementById("admin_select").addEventListener("change", function () {
        let admin_id = this.value;
        if (admin_id) {
            window.location.href = "superadmin/role-control?admin_id=" + admin_id;
        } else {
            window.location.href = "superadmin/role-control";
        }
    });
</script>