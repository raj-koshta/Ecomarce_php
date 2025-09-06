<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Thank You</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php $this->load->view('member/links'); ?>

    <style>
        .thankyou-card {
            max-width: 600px;
            margin: 60px auto;
            border-radius: 1rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        /* Animated Checkmark */
        .checkmark {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: block;
            stroke-width: 2;
            stroke: #28a745;
            stroke-miterlimit: 10;
            margin: 20px auto;
            box-shadow: inset 0px 0px 0px #28a745;
            animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
        }

        .checkmark__circle {
            stroke-dasharray: 166;
            stroke-dashoffset: 166;
            stroke-width: 2;
            stroke-miterlimit: 10;
            stroke: #28a745;
            fill: none;
            animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
        }

        .checkmark__check {
            transform-origin: 50% 50%;
            stroke-dasharray: 48;
            stroke-dashoffset: 48;
            animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
        }

        @keyframes stroke {
            100% {
                stroke-dashoffset: 0;
            }
        }

        @keyframes scale {

            0%,
            100% {
                transform: none;
            }

            50% {
                transform: scale3d(1.1, 1.1, 1);
            }
        }

        @keyframes fill {
            100% {
                box-shadow: inset 0px 0px 0px 60px #28a745;
            }
        }
    </style>
</head>

<body>

    <?php $this->load->view('member/header') ?>

    <main>
        <div class="container">
            <div class="card thankyou-card text-center p-5">

                <!-- Animated Checkmark -->
                <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                    <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
                    <path class="checkmark__check" fill="none" stroke="#fff" stroke-width="4" d="M14 27l7 7 16-16" />
                </svg>

                <h2 class="mb-3">Thank You for Your Order!</h2>
                <p class="text-muted">Your order has been placed successfully.</p>

                <!-- Show Order ID -->
                <div class="alert alert-success mt-4" role="alert">
                    <strong>Order ID:</strong> <?= $order_id?>
                </div>

                <a href="<?= base_url('')?>" class="btn btn-primary mt-3">Continue Shopping</a>
            </div>
        </div>
    </main>

    <?php $this->load->view('member/footer') ?>

</body>

</html>