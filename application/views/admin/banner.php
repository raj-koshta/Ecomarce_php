<!doctype html>
<html lang="en">


<!-- Mirrored from themesdesign.in/tocly/layouts/5.3.1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Nov 2023 08:52:23 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Banner</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <base href="<?php echo base_url() ?>">
    <?php $this->load->view('admin/links'); ?>

    <style>
        .card-img-top {
            height: 200px;
            object-fit: cover;
            /* Fill area, crop if needed */
            object-position: center;
        }
    </style>
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
                                <div class="card-header border-0 align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Add Banner</h4>
                                    <a href="admin/add_banner"
                                        class="btn btn-primary waves-effect waves-light btn-sm">Add Banner <i
                                            class="mdi mdi-arrow-right ms-1"></i></a>
                                </div>
                                <div class="card-body">

                                    <div class="row g-4">

                                        <?php if (!empty($banners)): ?>
                                            <?php foreach ($banners as $banner): ?>
                                                <!-- Banner Card -->
                                                <div class="col-md-4 col-sm-6 col-12">
                                                    <div class="card shadow-lg border-0 h-100">
                                                        <!-- Banner Image -->
                                                        <img src="uploads/banner/<?= $banner->bann_image ?>"
                                                            class="card-img-top" alt="Banner">

                                                        <!-- Card Body -->
                                                        <div class="card-body pb-0">
                                                            <h5 class="card-title mb-2"><?= $banner->title ?></h5>
                                                            <p class="card-text text-muted"><?= $banner->description ?></p>
                                                        </div>

                                                        <!-- Card Footer Actions -->
                                                        <div
                                                            class="card-footer bg-white d-flex justify-content-between align-items-center pt-0">
                                                            <!-- Edit Button -->
                                                            <a href="admin/update-banner/<?= $banner->bann_id ?>"
                                                                class="btn btn-outline-primary btn-sm">
                                                                <i class="bi bi-pencil"></i> Edit
                                                            </a>

                                                            <!-- Switch Slider -->
                                                            <div class="form-check form-switch m-0">
                                                                <input class="form-check-input banner-status-toggle"
                                                                    type="checkbox" data-id="<?= $banner->bann_id ?>"
                                                                    <?= $banner->status == '1' ? 'checked' : '' ?>>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <h5 class="text-center">No Banner found. Please add banner</h5>
                                        <?php endif; ?>

                                    </div>


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
        $(document).on("change", ".banner-status-toggle", function () {
            let bann_id = $(this).data("id");
            let status = $(this).is(":checked") ? 1 : 0;

            $.ajax({
                url: "<?= base_url('admin/update-banner-status') ?>",
                type: "POST",
                data: { bann_id: bann_id, status: status },
                dataType: "json",
                success: function (res) {
                    if (res.success) {
                        $('#uploadToast').removeClass('text-bg-danger').addClass('text-bg-success');
                        $('#toastMessage').text('Status updated successfully');
                        // Show toast
                        let toast = new bootstrap.Toast(document.getElementById('uploadToast'));
                        toast.show();
                    } else {
                        $('#uploadToast').removeClass('text-bg-success').addClass('text-bg-danger');
                        $('#toastMessage').text("Failed to update status");
                        // Show toast
                        let toast = new bootstrap.Toast(document.getElementById('uploadToast'));
                        toast.show();
                    }
                },
                error: function () {
                    $('#uploadToast').removeClass('text-bg-success').addClass('text-bg-danger');
                    $('#toastMessage').text("Something went wrong!");
                    // Show toast
                    let toast = new bootstrap.Toast(document.getElementById('uploadToast'));
                    toast.show();
                }
            });
        });

    </script>