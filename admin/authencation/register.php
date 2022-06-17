<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
?>

<?php
    session_start();
    $baseUrl = '../';
    require_once $baseUrl."connect.php";
    require_once $baseUrl.'utils/utility.php';
    require_once 'process_form_register.php';
    $user = getUserToken($conn);
    if($user != null) {
        header('Location: '.$baseUrl.'index.php');
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

    <title>SB Admin 2 - Register</title>

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

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Tạo tài khoản mới!</h1>
                            </div>
                            <form class="user" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                            <div class="form-group">
                                    <input type="text" 
                                        class="form-control form-control-user" 
                                        id="name"
                                        placeholder="Họ Tên"
                                        name="name"
                                        value="<?php if($name_old == "") echo $name; else echo $name_old; ?>"
                                        >
                                        <p class="error_input"><?php echo $nameErr;?></p>
                                </div>

                                <div class="form-group">
                                    <input type="text" 
                                        class="form-control form-control-user" 
                                        id="username"
                                        placeholder="Tên đăng nhập"
                                        name="username"
                                        value="<?php if($username_old == "") echo $username; else echo $username_old;?>"
                                        >
                                        <p class="error_input"><?php echo $usernameErr; ?></p>
                                </div>

                                <div class="form-group">
                                    <input type="email" 
                                        class="form-control form-control-user" 
                                        id="exampleInputEmail"
                                        placeholder="Địa chỉ email"
                                        name="email"
                                        value="<?php if($email_old == "") echo $email; else echo $email_old;?>"
                                        >
                                        <p class="error_input"><?php echo $emailErr ?></p>
                                </div>
                                
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" 
                                            class="form-control form-control-user"
                                            id="exampleInputPassword" 
                                            placeholder="Mật khẩu"
                                            name="password"
                                            value="<?php if($password_old == "") echo $password; else echo $password_old; ?>"
                                            >
                                            <p class="error_input"><?php echo $passwordErr; ?></p>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" 
                                            class="form-control form-control-user"
                                            id="exampleRepeatPassword" 
                                            placeholder="Nhập lại mật khẩu"
                                            name="repass"
                                            value="<?php if($repass_old == "") echo $repass; else echo $repass_old;?>"
                                            >
                                            <p class="error_input"><?php echo $repassErr; ?></p>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block" name="submit">
                                    Đăng ký tài khoản
                                </button>
                                <!-- <hr>
                                <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Đăng ký với Google
                                </a>
                                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Đăng ký với Facebook
                                </a> -->
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Quên mật khẩu?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.php">Đã có tài khoản? Đăng nhập!</a>
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