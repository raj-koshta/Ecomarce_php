<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Admin - Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="<?php echo base_url() ?>">
    <?php $this->load->view('admin/links'); ?>

    <!-- Bootstrap Icons (for eye/eye-slash) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Blurred background image */
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url("assets/admin/images/comingsoon-bg.jpg") no-repeat center center/cover;
            filter: blur(6px);
            transform: scale(1.1);
            z-index: 0;
        }

        /* Frosted glass login card */
        .login-card {
            position: relative;
            z-index: 1;
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.75);
            border: 1px solid rgba(255, 255, 255, 0.18);
            padding: 2rem;
            width: 100%;
            max-width: 400px;
            color: #fff;
        }

        .login-card h3 {
            color: #fff;
        }

        .login-card label {
            color: #fff;
            font-weight: 500;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.15);
            border: none;
            color: #fff;
        }

        .form-control::placeholder {
            color: #ddd;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.25);
            box-shadow: none;
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #fff;
        }

        /* Eye icon style */
        .input-group-text {
            background: rgba(255, 255, 255, 0.15);
            border: none;
            cursor: pointer;
            color: #fff;
        }

        @media (max-width: 568px) {
            .login-card {
                height: 100vh;
                max-width: 100%;
                border-radius: 0;
                box-shadow: none;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }
        }

        /* Remove browser autofill background */
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0px 1000px rgba(255, 255, 255, 0.15) inset !important;
            -webkit-text-fill-color: #fff !important;
            /* Text color */
            caret-color: #fff;
            /* Cursor color */
            transition: background-color 5000s ease-in-out 0s;
            /* Prevent flash */
        }
    </style>

    <style>
        /* Custom toast layout */
        .swal2-popup.custom-toast {
            width: 350px !important;
            padding: 1.5rem !important;
            display: flex !important;
            flex-direction: column !important;
            /* Stack icon, text, and button vertically */
            align-items: center !important;
            text-align: center !important;
        }

        /* Move the icon above */
        .swal2-popup.custom-toast .swal2-icon {
            margin: 0 0 1rem 0 !important;
        }

        /* Style the title/message */
        .swal2-popup.custom-toast .swal2-title {
            font-size: 1.1rem !important;
            margin: 0.5rem 0 !important;
            font-weight: 500 !important;
        }

        /* Center the button */
        .swal2-popup.custom-toast .swal2-actions {
            margin-top: 1rem !important;
            justify-content: center !important;
        }
    </style>
</head>

<body>

    <div class="login-card">
        <h3 class="text-center mb-4">Login</h3>

        <form action="admin/login" method="post">
            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
            </div>

            <!-- Password with eye icon -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" name="password" id="password"
                        placeholder="Enter password">
                    <span class="input-group-text" onclick="togglePassword()">
                        <i class="bi bi-eye-slash" id="toggleIcon"></i>
                    </span>
                </div>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>

        <p class="text-center mt-3">
            <a href="#" class="text-light">Forgot Password?</a>
        </p>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById("password");
            const toggleIcon = document.getElementById("toggleIcon");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.classList.remove("bi-eye-slash");
                toggleIcon.classList.add("bi-eye");
            } else {
                passwordInput.type = "password";
                toggleIcon.classList.remove("bi-eye");
                toggleIcon.classList.add("bi-eye-slash");
            }
        }
    </script>



    <?php if (!empty($this->session->flashdata('errorMsg'))): ?>
        <script>
            Swal.fire({
                toast: true,
                position: 'center',
                icon: 'error',
                title: '<?= $this->session->flashdata('errorMsg') ?>',
                showConfirmButton: true,
                confirmButtonText: 'OK',
                background: '#fff',
                color: '#000',
                customClass: {
                    popup: 'custom-toast'
                }
            });
        </script>
    <?php elseif (!empty($this->session->flashdata('successMsg'))): ?>
        <script>
            Swal.fire({
                toast: true,
                position: 'center',
                icon: 'success',
                title: '<?= $this->session->flashdata('successMsg') ?>',
                background: '#fff',
                color: '#000',
                customClass: {
                    popup: 'custom-toast'
                }
            });
        </script>
    <?php endif; ?>









</body>

</html>