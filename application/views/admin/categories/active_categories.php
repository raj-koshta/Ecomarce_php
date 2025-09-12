<!doctype html>
<html lang="en">


<!-- Mirrored from themesdesign.in/tocly/layouts/5.3.1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Nov 2023 08:52:23 GMT -->

<head>

    <meta charset="utf-8" />
    <title><?php echo $title?></title>
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

                            <div class="card-header border-0 align-items-center d-flex mb-2 p-0 pt-2">
                                <h4 class="card-title mb-0 flex-grow-1"><?= $title?></h4>
                                <!-- <a href="admin/add-category" class="btn btn-primary waves-effect waves-light btn-sm">Add
                                    Category <i class="mdi mdi-arrow-right ms-1"></i></a> -->
                            </div>
                            <div class="mb-4 text-danger">
                                Note: Categories that do not have a parent category name are considered parent categories.
                            </div>

                            <table id="datatable-buttons"
                                class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Category Name</th>
                                        <th>Parent Category Name</th>
                                        <th>Image</th>
                                        <th>Products Count</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <?php if (!empty($categories)): ?>
                                        <?php $i = 1;
                                        foreach ($categories as $category): ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $category->category_name; ?></td>

                                                <td>
                                                    <?php $parent_id = $category->parent_id;
                                                        $parent_cat_name = "";
                                                        if(!empty($parent_id)) {
                                                            $parent_cat_name = $this->db->where('category_id', $parent_id)->get('tbl_category')->row()->category_name;
                                                        }
                                                    ?>
                                                    <?= $parent_cat_name;?>
                                                </td>

                                                <!-- Small image -->
                                                <td>
                                                    <?php if (!empty($category->image)): ?>
                                                        <img src="<?= base_url('uploads/products/' . $category->image) ?>"
                                                            alt="Category Image"
                                                            style="width: 50px; height: 50px; object-fit: fit; border-radius: 6px;">
                                                    <?php else: ?>
                                                        <span class="text-muted">No Image</span>
                                                    <?php endif; ?>
                                                </td>

                                                <td>
                                                    <?php 
                                                        if (!empty($category->parent_id)) {
                                                            // Child category → count only by sub_category
                                                            $products_count = $this->db->where('sub_category', $category->category_id)
                                                                                    ->count_all_results('tbl_product');
                                                        } else {
                                                            // Parent category → count only by category
                                                            $products_count = $this->db->where('category', $category->category_id)
                                                                                    ->group_start()
                                                                                        ->where('sub_category', 0)
                                                                                        ->or_where('sub_category IS NULL', null, false)
                                                                                    ->group_end()
                                                                                    ->count_all_results('tbl_product');
                                                        }

                                                        echo $products_count;
                                                    ?>
                                                </td>

                                                <!-- Switch toggle -->
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input category-status-toggle"
                                                            type="checkbox"
                                                            data-id="<?= $category->category_id ?>"
                                                            <?= $category->status == '1' ? 'checked' : '' ?> 
                                                        >
                                                    </div>
                                                </td>

                                                <td style="width: 10%;">
                                                    <a href="admin/update-category/<?= $category->category_id ?>"
                                                        class="btn btn-outline-primary btn-sm edit me-2">
                                                        <i class="fas fa-pencil-alt"></i> Edit
                                                    </a>
                                                    <a href="admin/delete-category/<?= $category->category_id ?>"
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

    <!-- Updating category station dynamically -->
    <script>
        $(document).on("change", ".category-status-toggle", function () {
            let category_id = $(this).data("id");
            let status = $(this).is(":checked") ? 1 : 0;

            $.ajax({
                url: "<?= base_url('admin/update-category-status') ?>",
                type: "POST",
                data: { category_id: category_id, status: status },
                dataType: "json",
                success: function (res) {
                    if (res.success) {
                        Swal.fire({
                            icon: 'success',
                            title: res.msg,
                            showConfirmButton: false,
                            timer: 2500
                        }).then(() => {
                            location.reload();
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

    <script>
        $(document).ready(function () {
            $(".delete").on("click", function (e) {
                e.preventDefault(); // stop default link behavior

                var link = $(this).attr("href"); // get href value

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to undo this action! We recommend deactivating the category instead of deleting it, so customers will no longer see the products under this category.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect only if confirmed
                        window.location.href = link;
                    }
                });
            });
        });
    </script>