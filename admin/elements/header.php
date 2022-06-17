<?php session_start();?>
<?php 
    
    // require_once $baseUrl.'connect.php';
    require_once $baseUrl.'utils/utility.php';
    
    $user = getUserToken($conn);
    if($user == null) {
        header('Location: authencation/login.php');
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

        <title><?=$title?></title>

        <!-- Custom fonts for this template-->
        <link href="<?=$baseUrl?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="<?=$baseUrl?>css/sb-admin-2.min.css" rel="stylesheet">
        <script src="<?=$baseUrl?>ckeditor/ckeditor.js"></script>

    </head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
    
        <!-- Sidebar -->
        <?php require_once $baseUrl.'elements/sidebar.php';?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php require_once $baseUrl.'elements/topbar.php';?>
                <!-- End of Topbar --> 