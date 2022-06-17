<?php
    require_once('admin/connect.php');
    include('includes/head.php');
    include('includes/headerPage.php');

    $error = '';
    $success = '';

    if(isset($_SESSION['errors'])) {
        $error = $_SESSION['errors'];
    }

    if(isset($_SESSION['success'])) {
        $success = $_SESSION['success'];
    }
?>
<div id="page-rePass" class="container mt-5 mb-5">
        <h1>Lấy lại mật khẩu</h1>
        <div class="row">
          <div class="col-md-3">    
            <center>
                <form action="sendMailForgot.php" method="POST">
                    <!-- <div class="form-group">
                        <label for="">Nhập mật khầu mới</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Nhập lại mật khầu</label>
                        <input type="password" name="re-password" class="form-control">
                    </div> -->
                    <?php
                        if(!empty($error)) {
                            echo "<div class='alert alert-danger'>$error</div>";
                        }

                        if(!empty($success)) {
                            echo "<div class='alert alert-success'>$success</div>";
                        }
                    ?>
                    <div class="form-group">
                        <label for="">Nhập email của bạn đã đăng ký</label>
                        <input type="text" name="email" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-success">Đổi mật khẩu</button>
                </form>
            </center>
        </div>
    </div>
</div>
<?php unset($_SESSION['errors']); ?>
<?php unset($_SESSION['success']); ?>
<?php include('includes/footer.php'); ?>