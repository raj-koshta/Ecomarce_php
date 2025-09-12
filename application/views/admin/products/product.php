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
    <style>
        .table td, .table th {
            text-align: start;
            vertical-align: middle; /* Optional: aligns content vertically */
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="card-header border-0 align-items-center d-flex mb-2 p-0 pt-2">
                                <h4 class="card-title mb-0 flex-grow-1"><?= $title?></h4>
                                <a href="admin/add-product" class="btn btn-primary waves-effect waves-light btn-sm">Add
                                    Product <i class="mdi mdi-arrow-right ms-1"></i></a>
                            </div>
                            <!-- <div class="mb-4 text-danger">
                                Note: Categories that do not have a parent category name are considered parent categories.
                            </div> -->

                            <table id="datatable-buttons"
                                class="table table-striped table-bordered dt-responsive nowrap align-items-center"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Product Name</th>
                                        <th>Brand</th>
                                        <th>Category</th>
                                        <th>Main Image</th>
                                        <th>Stock</th>
                                        <th>Selling Price</th>
                                        <th>MRP</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <?php if (!empty($products)): ?>
                                        <?php $i = 1;
                                        foreach ($products as $product): ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td style="max-width: 200px; word-wrap: break-word; white-space: normal;">
                                                    <?= $product->product_name; ?>
                                                </td>
                                                <td><?= $product->brand; ?></td>
                                                <!-- <td><?= $product->category; ?></td> -->

                                                <td>
                                                <?php $category_id = !empty($product->sub_category) ? $product->sub_category : $product->category;
                                                        $product_category_name = "";
                                                        if(!empty($category_id)) {
                                                            $product_category_name = $this->db->where('category_id', $category_id)->get('tbl_category')->row()->category_name;
                                                        }
                                                    ?>
                                                    <?= $product_category_name;?>
                                                </td>

                                                <!-- Small image -->
                                                <td>
                                                    <?php if (!empty($product->product_main_image)): ?>
                                                        <img src="<?= base_url('uploads/products/' . $product->product_main_image) ?>"
                                                            alt="Category Image"
                                                            style="width: 50px; height: 50px; object-fit: fit; border-radius: 6px;">
                                                    <?php else: ?>
                                                        <span class="text-muted">No Image</span>
                                                    <?php endif; ?>
                                                </td>

                                                <td><?= $product->stock?></td>
                                                <td>$<?= number_format($product->selling_price,2) ?></td>
                                                <td>$<?= number_format($product->mrp,2) ?></td>

                                                <!-- Switch toggle -->
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input product-status-toggle"
                                                            type="checkbox"
                                                            data-id="<?= $product->product_id ?>"
                                                            <?= $product->status == '1' ? 'checked' : '' ?> 
                                                        >
                                                    </div>
                                                </td>

                                                <td style="width: 10%;">
                                                    <a href="admin/update-product/<?= $product->product_id ?>"
                                                        class="btn btn-outline-primary btn-sm edit me-2">
                                                        <i class="fas fa-pencil-alt"></i> Edit
                                                    </a>
                                                    <a href="admin/delete-product/<?= $product->product_id ?>"
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
        $(document).on("change", ".product-status-toggle", function () {
            let product_id = $(this).data("id");
            let status = $(this).is(":checked") ? 1 : 0;

            $.ajax({
                url: "<?= base_url('admin/update-product-status') ?>",
                type: "POST",
                data: { product_id: product_id, status: status },
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