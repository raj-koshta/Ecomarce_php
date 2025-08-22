<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Invoice</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php $this->load->view('member/links'); ?>
    <style>
        .card {
            border: none;
            border-radius: 1rem;
            backdrop-filter: blur(8px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, #4e73df, #1cc88a);
            border: none;
            padding: 1.8rem;
        }

        .card-header h4 {
            color: #fff;
            margin: 0;
            font-weight: 700;
            letter-spacing: 0.5px;
            font-size: 1.25rem;
        }

        .section-title {
            font-size: 0.9rem;
            font-weight: 700;
            color: #495057;
            text-transform: uppercase;
            letter-spacing: .7px;
            margin-bottom: .75rem;
        }

        .info-box {
            background: #fff;
            border-radius: .85rem;
            padding: 1.2rem 1.5rem;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
            transition: transform 0.2s ease;
        }

        .info-box:hover {
            transform: translateY(-2px);
        }

        .order-summary {
            background: #fff;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        }

        .order-summary h6 {
            font-weight: 700;
        }

        .table {
            border-radius: .75rem;
            overflow: hidden;
        }

        .table thead {
            background: #f8faff;
            font-weight: 600;
        }

        .table tbody tr:hover {
            background: #f1f5ff;
            transition: background 0.3s ease;
        }

        .badge-status {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: #fff;
            font-weight: 500;
            font-size: 0.8rem;
            padding: .5em .9em;
            border-radius: .65rem;
        }

        .btn-modern {
            background: linear-gradient(135deg, #4e73df, #1cc88a);
            border: none;
            border-radius: .65rem;
            font-weight: 600;
            padding: .75rem;
            transition: all 0.3s ease;
        }

        .btn-modern:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        .icon-text {
            display: flex;
            align-items: center;
            gap: 8px;
            word-break: break-word;
        }

        /* Mobile Responsive Product Table -> Card View */
        @media (max-width: 767.98px) {
            .table-responsive {
                display: none;
            }

            .product-card {
                background: #fff;
                border-radius: .75rem;
                padding: 1rem;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
                margin-bottom: 1rem;
            }

            .product-card h6 {
                font-size: 1rem;
                font-weight: 600;
            }

            .product-card p {
                margin: 0.25rem 0;
            }
        }
    </style>
</head>

<body>

    <?php $this->load->view('member/header') ?>

    <main>
        <div class="container my-4">
            <div class="card shadow-lg">
                <div class="card-header">
                    <h4><i class="bi bi-receipt-cutoff me-2"></i> Order Details</h4>
                </div>
                <div class="card-body p-4">

                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-lg-8">
                            <!-- Order Info -->
                            <div class="info-box">
                                <div class="section-title">Order Information</div>
                                <p class="mb-2 icon-text"><i class="bi bi-hash text-primary"></i> <strong>Order
                                        ID:</strong>
                                    <?= $order->id?></p>
                                <p class="mb-2 icon-text"><i class="bi bi-calendar-check text-success"></i>
                                    <strong>Date:</strong> 21 Aug
                                    2025
                                </p>
                                <p class="mb-2 icon-text"><i class="bi bi-check-circle text-success"></i>
                                    <strong>Status:</strong>
                                    <span class="badge-status">Completed</span>
                                </p>
                                <p class="mb-0 icon-text"><i class="bi bi-credit-card text-warning"></i> <strong>Payment
                                        Method:</strong>
                                    Credit Card</p>
                            </div>

                            <!-- Customer Info -->
                            <div class="info-box">
                                <div class="section-title">Customer Information</div>
                                <p class="mb-2 icon-text"><i class="bi bi-person-circle text-primary"></i>
                                    <strong>Name:</strong> John Doe
                                </p>
                                <p class="mb-2 icon-text"><i class="bi bi-envelope text-danger"></i>
                                    <strong>Email:</strong>
                                    john@example.com</p>
                                <p class="mb-2 icon-text"><i class="bi bi-telephone text-success"></i>
                                    <strong>Phone:</strong> +91
                                    9876543210
                                </p>
                                <p class="mb-0 icon-text"><i class="bi bi-geo-alt text-info"></i>
                                    <strong>Address:</strong>
                                    123 Main
                                    Street, City, Country</p>
                            </div>

                            <!-- Product Table (Desktop/Tablet) -->
                            <div class="info-box">
                                <div class="section-title">Products</div>
                                <div class="table-responsive">
                                    <table class="table align-middle mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Product</th>
                                                <th>Qty</th>
                                                <th>Price</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Flat Stomach Tea (500g)</td>
                                                <td>2</td>
                                                <td>₹500</td>
                                                <td>₹1000</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Detox Tea (250g)</td>
                                                <td>1</td>
                                                <td>₹300</td>
                                                <td>₹300</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Product Cards (Mobile) -->
                                <div class="d-md-none">
                                    <div
                                        class="product-card d-flex align-items-center mb-3 p-2 border rounded bg-light">
                                        <img src="https://via.placeholder.com/70" alt="Flat Stomach Tea"
                                            class="rounded me-3" style="width:70px; height:70px; object-fit:cover;">
                                        <div>
                                            <h6 class="mb-1">Flat Stomach Tea (500g)</h6>
                                            <p class="mb-0"><strong>Qty:</strong> 2</p>
                                            <p class="mb-0"><strong>Price:</strong> ₹500</p>
                                            <p class="mb-0"><strong>Subtotal:</strong> ₹1000</p>
                                        </div>
                                    </div>

                                    <div
                                        class="product-card d-flex align-items-center mb-3 p-2 border rounded bg-light">
                                        <img src="https://via.placeholder.com/70" alt="Detox Tea" class="rounded me-3"
                                            style="width:70px; height:70px; object-fit:cover;">
                                        <div>
                                            <h6 class="mb-1">Detox Tea (250g)</h6>
                                            <p class="mb-0"><strong>Qty:</strong> 1</p>
                                            <p class="mb-0"><strong>Price:</strong> ₹300</p>
                                            <p class="mb-0"><strong>Subtotal:</strong> ₹300</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-lg-4 mt-4 mt-lg-0">
                            <div class="order-summary">
                                <h6 class="mb-3"><i class="bi bi-basket2 me-2 text-primary"></i> Order Summary</h6>
                                <p class="d-flex justify-content-between mb-2">
                                    <span>Subtotal</span> <strong>₹1300</strong>
                                </p>
                                <p class="d-flex justify-content-between mb-2">
                                    <span>Shipping</span> <strong>₹50</strong>
                                </p>
                                <p class="d-flex justify-content-between mb-2">
                                    <span>Tax</span> <strong>₹100</strong>
                                </p>
                                <hr>
                                <p class="d-flex justify-content-between fs-5 fw-bold">
                                    <span>Total</span> <span class="text-success">₹1450</span>
                                </p>
                                <div class="mt-3">
                                    <button class="btn btn-modern w-100"><i class="bi bi-download me-2"></i> Download
                                        Invoice</button>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </main>

    <?php $this->load->view('member/footer') ?>

</body>

</html>