<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <script>document.write(new Date().getFullYear())</script> © Tocly.
            </div>
            <div class="col-sm-6">
                <div class="text-sm-end d-none d-sm-block">
                    Crafted with <i class="mdi mdi-heart text-danger"></i> by RajKoshta
                </div>
            </div>
        </div>
    </div>
</footer>

</div>
<!-- end main content-->

</div>
<!-- END layout-wrapper -->

<!-- Right Sidebar -->
<div class="right-bar">
    <div data-simplebar class="h-100">
        <div class="rightbar-title d-flex align-items-center px-3 py-4">

            <h5 class="m-0 me-2">Settings</h5>

            <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                <i class="mdi mdi-close noti-icon"></i>
            </a>
        </div>

        <!-- Settings -->
        <hr class="mt-0" />
        <h6 class="text-center mb-0">Choose Layouts</h6>

        <div class="p-4">
            <div class="mb-2">
                <img src="assets/admin/images/layouts/layout-1.jpg" class="img-fluid img-thumbnail" alt="layout-1">
            </div>

            <div class="form-check form-switch mb-3">
                <input class="form-check-input theme-choice" type="checkbox" id="light-mode-switch" checked>
                <label class="form-check-label" for="light-mode-switch">Light Mode</label>
            </div>

            <div class="mb-2">
                <img src="assets/admin/images/layouts/layout-2.jpg" class="img-fluid img-thumbnail" alt="layout-2">
            </div>
            <div class="form-check form-switch mb-3">
                <input class="form-check-input theme-choice" type="checkbox" id="dark-mode-switch"
                    data-bsStyle="assets/admin/css/bootstrap-dark.min.css"
                    data-appStyle="assets/admin/css/app-dark.min.html">
                <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
            </div>

            <!-- <div class="mb-2">
                <img src="assets/admin/images/layouts/layout-3.jpg" class="img-fluid img-thumbnail" alt="layout-3">
            </div>
            <div class="form-check form-switch mb-5">
                <input class="form-check-input theme-choice" type="checkbox" id="rtl-mode-switch"
                    data-appStyle="assets/admin/css/app-rtl.min.css">
                <label class="form-check-label" for="rtl-mode-switch">RTL Mode</label>
            </div> -->


        </div>

    </div> <!-- end slimscroll-menu-->
</div>
<!-- /Right-bar -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<!-- JAVASCRIPT -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="assets/admin/libs/jquery/jquery.min.js"></script>
<script src="assets/admin/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/admin/libs/metismenu/metisMenu.min.js"></script>
<script src="assets/admin/libs/simplebar/simplebar.min.js"></script>
<script src="assets/admin/libs/node-waves/waves.min.js"></script>

<!-- Icon -->
<script src="https://unicons.iconscout.com/release/v2.0.1/script/monochrome/bundle.js"></script>

<!-- apexcharts -->
<script src="assets/admin/libs/apexcharts/apexcharts.min.js"></script>

<!-- Vector map-->
<script src="assets/admin/libs/jsvectormap/js/jsvectormap.min.js"></script>
<script src="assets/admin/libs/jsvectormap/maps/world-merc.js"></script>

<script src="assets/admin/js/pages/dashboard.init.js"></script>

<!-- App js -->
<script src="assets/admin/js/app.js"></script>

<!-- Required datatable js -->
<script src="assets/admin/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="assets/admin/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/admin/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="assets/admin/libs/jszip/jszip.min.js"></script>
<script src="assets/admin/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="assets/admin/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="assets/admin/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="assets/admin/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="assets/admin/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

<script src="assets/admin/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="assets/admin/libs/datatables.net-select/js/dataTables.select.min.js"></script>

<!-- Responsive examples -->
<script src="assets/admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/admin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<!-- Datatable init js -->
<script src="assets/admin/js/pages/datatables.init.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!-- Toast Container -->
<!-- <div class="position-fixed end-0 p-3" style="z-index: 11;top: 60px !important;">
    <div id="uploadToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive"
        aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body" id="toastMessage">
                Image uploaded successfully!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div> -->


<!-- For  information update toster show -->
<!-- <?php if (!empty($this->session->flashdata('successMsg'))): ?>
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
        $('#toastMessage').text('<?= $this->session->flashdata('errorMsg') ?>');
        // Show toast
        let toast = new bootstrap.Toast(document.getElementById('uploadToast'));
        toast.show();
    </script>
<?php endif; ?> -->

<?php if (!empty($this->session->flashdata('successMsg'))): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: '<?= $this->session->flashdata('successMsg') ?>',
            showConfirmButton: false,
            timer: 2500
        });
    </script>
<?php elseif (!empty($this->session->flashdata('errorMsg'))): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: '<?= $this->session->flashdata('errorMsg') ?>',
            showConfirmButton: true
        });
    </script>
<?php endif; ?>

</body>


<!-- Mirrored from themesdesign.in/tocly/layouts/5.3.1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Nov 2023 08:52:54 GMT -->

</html>