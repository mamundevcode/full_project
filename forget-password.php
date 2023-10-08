<?php
require_once('function/function.php')
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="login-page bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <h3 class="mb-3">Login Now</h3>
                    <div class="bg-white shadow rounded">
                        <div class="row">
                            <div class="col-md-7 pe-0">
                                <div class="form-left h-100 py-5 px-5">
                                    <!-- <strong>Assalamualicum</strong> User, -->
                                    <?php
                                    if ($_POST) {
                                        $email = $_POST['email'];

                                        $sel = "SELECT * FROM users WHERE user_email='$email'";
                                        $Q = mysqli_query($con, $sel);
                                        $data = mysqli_fetch_assoc($Q);

                                        if ($data) {
                                            header('Location: reset-password.php?rp=' . $data['user_slug']);
                                        } else {
                                            echo "Please Enter Correct Email Address.";
                                        }
                                    }
                                    ?>
                                    <form action="" method="post" class="row g-4">
                                        <div class="col-12">
                                            <label>Email<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                                                <input type="text" name="email" class="form-control" placeholder="Enter your email address">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary px-4 float-end mt-4">SEND</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-5 ps-0 d-none d-md-block">
                                <div class="form-right h-100 bg-primary text-white text-center pt-5">
                                    <i class="fas fa-user-shield"></i>
                                    <h2 class="fs-1">Forget Someting!!!</h2>
                                    <img class="login_img" height="100px" src="images/Login.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>