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
                                    <strong>Assalamualicum</strong> User,
                                    <?php
                                    if (!empty($_POST)) {
                                        $username = $_POST['username'];
                                        $password = md5($_POST['password']);


                                        if (!empty($username)) {
                                            if (!empty($password)) {
                                                $sel = "SELECT * FROM users WHERE user_username='$username' AND   user_password='$password'";
                                                $Q = mysqli_query($con, $sel);
                                                $data = mysqli_fetch_assoc($Q);
                                                if ($data) {
                                                    $_SESSION['id'] = $data['user_id'];
                                                    $_SESSION['name'] = $data['user_name'];
                                                    $_SESSION['email'] = $data['user_email'];
                                                    $_SESSION['role'] = $data['role_id'];
                                                    $_SESSION['pic'] = $data['user_photo'];
                                                    header('Location: index.php');
                                                } else {
                                                    echo "Username and password did not match";
                                                }
                                            } else {
                                                echo "Please enter your password";
                                            }
                                        } else {
                                            echo "Please enter your Username";
                                        }
                                    }

                                    ?>
                                    <form action="" method="post" class="row g-4">
                                        <div class="col-12">
                                            <label>Username<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="fas fa-user"></i></div>
                                                <input type="text" name="username" class="form-control" placeholder="Enter Username">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label>Password<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="fas fa-lock"></i></div>
                                                <input type="password" name="password" class="form-control" placeholder="Enter Password">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="inlineFormCheck">
                                                <label class="form-check-label" for="inlineFormCheck">Remember me</label>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <a href="forget-password.php" class="float-end text-primary">Forgot Password?</a>
                                        </div>

                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary px-4 float-end mt-4">login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-5 ps-0 d-none d-md-block">
                                <div class="form-right h-100 bg-primary text-white text-center pt-5">
                                    <i class="fas fa-user-shield"></i>
                                    <h2 class="fs-1">Welcome Back!!!</h2>
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