<!doctype html>
<html lang="en">


<!-- Mirrored from themesdesign.in/tocly/layouts/5.3.1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Nov 2023 08:52:23 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Pincode</title>
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="card-header border-0 align-items-center d-flex mb-4 p-0 pt-2">
                                <h4 class="card-title mb-0 flex-grow-1">Pincode</h4>
                                <a href="admin/add-pincode" class="btn btn-primary waves-effect waves-light btn-sm">Add
                                    Pincode <i class="mdi mdi-arrow-right ms-1"></i></a>
                            </div>

                            <table id="datatable-buttons"
                                class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Pincode</th>
                                        <th>Delivery Charges</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <?php if (!empty($pincodes)): ?>
                                        <?php $i = 1;
                                        foreach ($pincodes as $pin): ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $pin->pincode; ?></td>
                                                <td>$<?= number_format($pin->delivery_charge, 2); ?></td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input pincode-status-toggle" type="checkbox"
                                                            data-id="<?= $pin->id ?>" <?= $pin->status == '1' ? 'checked' : '' ?>>
                                                    </div>
                                                </td>
                                                <td style="width: 10%;">
                                                    <a href="admin/update-pincode/<?= $pin->id ?>"
                                                        class="btn btn-outline-primary btn-sm edit me-2">
                                                        <i class="fas fa-pencil-alt"></i> Edit
                                                    </a>
                                                    <a href="admin/delete-pincode/<?= $pin->id ?>"
                                                        class="btn btn-outline-danger btn-sm delete">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>

                                    <?php endif; ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->



        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <?php $this->load->view('admin/footer'); ?>

    <script>
        $(document).on("change", ".pincode-status-toggle", function () {
            let id = $(this).data("id");
            let status = $(this).is(":checked") ? 1 : 0;

            $.ajax({
                url: "<?= base_url('admin/update-pincode-status') ?>",
                type: "POST",
                data: { id: id, status: status },
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