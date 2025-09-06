<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Order History</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php $this->load->view('member/links'); ?>

    <style>
        .btn-default {
            background: #ddd;
        }

        .btn-default:hover {
            color: #fff;
            background: black;
            border: 1px solid black;
        }

        .disabled-link {
            pointer-events: none;
            /* disables click */
            opacity: 0.5;
            /* faded look */
            cursor: not-allowed;
            /* show blocked cursor */
        }
    </style>
</head>

<body>

    <?php $this->load->view('member/header') ?>

    <main>
        <!-- breadcrumb area start -->
        <section class="breadcrumb__area include-bg pt-100 pb-50">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="breadcrumb__content p-relative z-index-1">
                            <h3 class="breadcrumb__title">Order History</h3>
                            <div class="breadcrumb__list">
                                <span><a href="#">Home</a></span>
                                <span>Order History</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb area end -->

        <div class="container mb-100">
            <div class="row">
            <div class="col-xxl-12">
                <div class="profile__ticket table-responsive">
                    <table class="table" style="min-width: 1100px;">
                        <thead>
                            <tr>
                                <th scope="col">Order Id</th>
                                <th scope="col">Product Title and Quentity</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">Payment Mode</th>
                                <th scope="col">Delivery Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($orders)): ?>
                                <?php foreach ($orders as $order): ?>
                                    <tr>
                                        <th scope="row">
                                            <a href="member/order-details/<?= $order->id ?>"
                                                target="_blank">#<?= $order->id ?></a>
                                        </th>
                                        <td data-info="title">
                                            <ul>
                                                <?php
                                                $products = $this->db->select('product_name,product_qty')->where('order_id', $order->id)->get('tbl_order_products')->result();
                                                foreach ($products as $product):
                                                    ?>
                                                    <li><?= substr($product->product_name, 0, 20) ?><?= (strlen($product->product_name) > 20 ? '...' : '') ?>x<?= $product->product_qty ?>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </td>
                                        <td>$<?= number_format($order->total, 2) ?></td>
                                        <td><?= $order->payment_mode ?></td>
                                        <td><?= date('d/m/Y', strtotime($order->delivery_date)) ?></td>
                                        <td data-info="status"
                                            style="color: <?= $order->order_status_id == 5 ? 'red' : 'green' ?>">
                                            <?= $order->status ?>
                                        </td>
                                        <td>
                                            <a href="member/order-details/<?= $order->id ?>" target="_blank"
                                                class="tp-logout-btn">Invoice</a>
                                            <a href="member/cancel-order/<?= $order->id ?>"
                                                class="tp-logout-btn btn-default <?= $order->order_status_id == 5 ? 'disabled-link' : '' ?>">Cancel</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4">No Order Data found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
        </div>
    </main>

    <?php $this->load->view('member/footer') ?>

</body>

</html>