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
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="card-header border-0 align-items-center d-flex mb-2 p-0 pt-2">
                                <h4 class="card-title mb-0 flex-grow-1"><?= $title?></h4>
                                <!-- <a href="admin/add-category" class="btn btn-primary waves-effect waves-light btn-sm">Add
                                    Category <i class="mdi mdi-arrow-right ms-1"></i></a> -->
                            </div>

                            <table id="datatable-buttons"
                                class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Order ID</th>
                                        <th>User Id</th>
                                        <th>User Name</th>
                                        
                                        
                                        <th>Products</th>
                                        <th>Delivery charges</th>
                                        <th>Total</th>
                                        <th>Order Status</th>
                                        <th>Payment Mode</th>
                                        <th>Payment ID</th>
                                        <th>Order Date</th>
                                        <th>Delivery Date</th>
                                        <th>Delivery Note</th>
                                        <th>Recipient Name</th>
                                        <th>Recipient Phone</th>
                                        <th>Address</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <?php if (!empty($orders)): ?>
                                        <?php $i = 1; ?>
                                        <?php foreach ($orders as $order): ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td>#<?= $order->id?></td>
                                                <td>#<?= $order->user_id?></td>
                                                <td><?= $order->username?></td>
                                                <td>
                                                    <ul>
                                                        <?php $order_products = $this->AdminModel->get_order_products($order->id);
                                                        if (!empty($order_products)) :
                                                        foreach($order_products as $product):?>
                                                            <li>
                                                                <?php echo $product->product_name?>
                                                                <span style="color: blue;">x <?= $product->product_qty?></span>
                                                            </li>
                                                        <?php endforeach; else: ?>
                                                            <li>No data</li>
                                                        <?php endif;?>
                                                    </ul>
                                                </td>
                                                <td>$<?= number_format($order->delivery_charges,2)?></td>
                                                <td>$<?= number_format($order->total,2)?></td>
                                                <td>
                                                    <select name="order_status" id="order_status" data-order-id="<?= $order->id?>">
                                                        <?php $order_status = $this->AdminModel->get_all_order_status();?>
                                                        <?php foreach($order_status as $orderStatus):?>
                                                            <option value="<?= $orderStatus->order_status_id ?>" 
                                                            <?= $order->order_status == $orderStatus->order_status_id ? 'selected' : ''?>>
                                                                <?= $orderStatus->status?>
                                                            </option>
                                                        <?php endforeach;?>
                                                    </select>
                                                </td>
                                                <td><?= $order->payment_mode?></td>
                                                <td><?= $order->payment_id?></td>
                                                <td><?= date('d M Y', strtotime($order->order_date))?></td>
                                                <td><?= date('d M Y', strtotime($order->delivery_date))?></td>
                                                <td><?= $order->note?></td>
                                                <td><?= $order->recipient_name?></td>
                                                <td><?= $order->recipient_phone?></td>
                                                <td><?= $order->address?></td>
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
        $(document).on('change','#order_status', function(){
            var status = $(this).val();
            var orderId = $(this).data('order-id');

           $.ajax({
            'url' : '<?= base_url('admin/update_order_status')?>',
            'type' : 'POST',
            'data' : {order_id : orderId, order_status: status},
            'dataType' : 'json',
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
           })
            
        });
    </script>