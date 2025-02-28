<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Favicon -->
    <link href="img/favicon.jpg" rel="icon">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container-xxl py-5 otp_verify">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h1 class="text-primary mb-0"><i class="fa fa-utensils me-3"></i>Anytime Eats</h1>
            <h2 class="mb-5 otp_text">Verify OTP</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="wow fadeInUp" data-wow-delay="0.2s">
                    <form action="" method="POST">
                    <div class="mb-3">
                                <div class="form-floating">
                                    <div class="error-message"></div>
                                </div>
                            </div>
                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="text" name="otp" class="form-control" id="otp" placeholder="Your OTP">
                                <label for="otp">Your OTP</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary w-100 py-3" type="submit" name="verify_otp">Verify OTP</button>
                        </div>
                        <div class="mb-3">
                             
                             <button class="btn btn-primary w-100 py-3" type="submit" name="resend_otp">Resend</button>
                         </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
session_start();
include 'functions.php';

if (isset($_POST['verify_otp'])) {
    $otp = $_POST['otp'];
    $email = $_SESSION['email'];

    // Verify OTP
    $verify_result = validateOtp($email, $otp);

    if ($verify_result === true) {
        echo "<script>
                $(document).ready(function() {
                    $('.error-message').html('<div class=\"alert alert-success\">OTP verified successfully!</div>');
                    setTimeout(function() {
                        window.location.href = 'reset_password.php'; // Redirect to reset password page
                    }, 1000);
                });
              </script>";
    } else {
        echo "<script>
                $(document).ready(function() {
                    $('.error-message').html('<div class=\"alert alert-danger\">$verify_result</div>');
                });
              </script>";
    }
}
elseif (isset($_POST['resend_otp'])) {
    $email = $_SESSION['email']; // Assuming email is stored in session after registration

    $resend_result = resendOtp_Email($email);
    if ($resend_result === true) {
        echo "<script>
                $(document).ready(function() {
                    $('.error-message').html('<div class=\"alert alert-success\">A new OTP has been sent to your email.</div>');
                });
              </script>";
    } else {
        echo "<script>
                $(document).ready(function() {
                    $('.error-message').html('<div class=\"alert alert-danger\">$resend_result</div>');
                });
              </script>";
    }
}
?>

</body>
</html>
