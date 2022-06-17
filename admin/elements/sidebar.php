<?php 
// session_start();

if(isset($_SESSION['role'])) {
    if($_SESSION['role'] == 1) {
        echo '
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="'.$baseUrl.'index.php">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
        </a>
    
        <!-- Divider -->
        <hr class="sidebar-divider my-0">
    
        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="'.$baseUrl.'index.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        <!-- Nav Item - Post -->
        <li class="nav-item active">
            <a class="nav-link" href="'.$baseUrl.'posts/index.php">
                <i class="fa fa-file"></i>
                <span>Bài viết</span></a>
        </li>
    
         <!-- Nav Item - Category -->
         <li class="nav-item active">
            <a class="nav-link" href="'.$baseUrl.'index.php">
                <i class="fa fa-list-alt"></i>
                <span>Thể loại</span></a>
        </li>
    
         <!-- Nav Item - Category -->
         <li class="nav-item active">
            <a class="nav-link" href="'.$baseUrl.'index.php">
                <i class="fa fa-indent"></i>
                <span>Loại tin</span></a>
        </li>
    
         <!-- Nav Item - Users -->
         <li class="nav-item active">
            <a class="nav-link" href="'.$baseUrl.'users/index.php">
            <i class="fas fa-user"></i>
                <span>Người dùng</span></a>
        </li>
    
         <!-- Nav Item - Users -->
         <li class="nav-item active">
            <a class="nav-link" href="'.$baseUrl.'users/updatePassword.php?id='.$_SESSION['idUser'].'">
            <i class="fas fa-key"></i>
                <span>Đổi mật khẩu</span></a>
        </li>
    
    </ul>
        ';
    } else if($_SESSION['role'] == 0){
        echo '
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="'.$baseUrl.'users/UserEdit.php?id='.$_SESSION['idUser'].'">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
        </a>
    
        <!-- Divider -->
        <hr class="sidebar-divider my-0">
    
        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="'.$baseUrl.'users/UserEdit.php?id='.$_SESSION['idUser'].'">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
         <!-- Nav Item - Users -->
         <li class="nav-item active">
            <a class="nav-link" href="'.$baseUrl.'users/updatePassword.php?id='.$_SESSION['idUser'].'">
            <i class="fas fa-key"></i>
                <span>Đổi mật khẩu</span></a>
        </li>
    
    </ul>
        ';
    }
}

?>
