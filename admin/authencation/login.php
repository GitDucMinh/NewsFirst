<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
?>
<?php
    session_start();
    $baseUrl = '../';
    require_once $baseUrl.'connect.php';
    require_once $baseUrl.'utils/utility.php';
    require_once 'process_form_login.php';
    
    $user = getUserToken($conn);
    if($user != null) {
        header('Location: ../../index.php');
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="<?=$baseUrl?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?=$baseUrl?>css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Đăng nhập</h1>
                                    </div>
                                    <form class="user" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form">
                                        <div class="form-group">
                                            <input type="email" 
                                                class="form-control form-control-user"
                                                id="exampleInputEmail" 
                                                aria-describedby="emailHelp"
                                                placeholder="Nhập địa chỉ email..."
                                                name="email"
                                                value="<?php if(isset($_COOKIE['email'])) {echo $_COOKIE['email'];} else {echo $email_old;} ?>"
                                                >
                                                <p class="error_input"> <?php echo $emailErr; ?> </p>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" 
                                                class="form-control form-control-user"
                                                id="exampleInputPassword" 
                                                placeholder="Mật khẩu"
                                                name="password"
                                                value="<?php if(isset($_COOKIE['pass'])) {echo $_COOKIE['pass'];} ?>"
                                                >
                                                <p class="error_input"> <?php echo $passwordErr; ?> </p>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck" name="remember">
                                                <label class="custom-control-label" for="customCheck">
                                                    Nhớ mật khẩu
                                                </label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Đăng nhập
                                        </button>
                                        <!-- <hr>
                                        <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i>Đăng nhập với Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i>Đăng nhập với Facebook
                                        </a> -->
                                    </form>
                                    <hr>
                                    <!-- <div class="text-center">
                                        <a class="small" href="forgot-password.html">Quên mật khẩu?</a>
                                    </div> -->
                                    <div class="text-center">
                                        <a class="small mr-3" href="register.php">Tạo tài khoản mới! </a>
                                        <a class="small" href="../../forgotPassword.php"> Quên mật khẩu?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?=$baseUrl?>vendor/jquery/jquery.min.js"></script>
    <script src="<?=$baseUrl?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?=$baseUrl?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?=$baseUrl?>js/sb-admin-2.min.js"></script>

</body>

</html>