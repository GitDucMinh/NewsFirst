<?php
  session_start();
  include_once('function.php');
?>
<header id="header">
          <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
              <div class="navbar-top">
                <div class="d-flex justify-content-between align-items-center">
                  <ul class="navbar-top-left-menu">
                    <!-- <li class="nav-item">
                      <a href="pages/index-inner.html" class="nav-link">Advertise</a>
                    </li>
                    <li class="nav-item">
                      <a href="pages/aboutus.html" class="nav-link">About</a>
                    </li>
                    <li class="nav-item">
                      <a href="#" class="nav-link">Events</a>
                    </li> -->
                    <li class="nav-item">
                      <a href="contactForm.php" class="nav-link">Liên hệ</a>
                    </li>
                    <!-- <li class="nav-item">
                      <a href="#" class="nav-link">In the Press</a>
                    </li> -->
                  </ul>
                  <ul class="navbar-top-right-menu">
                    <?php
                       $user = getUserToken($conn);
                       if($user == null) {
                           echo '<li class="nav-item">
                                  <a href="#" class="nav-link"></a>
                                </li>
                                <li class="nav-item">
                                  <a href="admin/authencation/login.php" class="nav-link">Đăng nhập</a>
                                </li>
                                <li class="nav-item">
                                  <a href="admin/authencation/register.php" class="nav-link">Đăng ký</a>
                                </li>';
                     } else {
                      if(isset($_SESSION['hoten'])){
                        echo '<li class="nav-item">
                                <a href="admin/users/UserEdit.php?id='.$_SESSION['idUser'].'" class="nav-link">Xin chào '.$_SESSION['hoten'].'</a>
                              </li>'; 
                        } else {
                          echo '<li class="nav-item">
                                  <a href="#" class="nav-link">Chào Minh</a>
                                </li>';
                        } 
                     }
                    ?>
                </div>
              </div>
              <div class="navbar-bottom">
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <a class="navbar-brand" href="index.php">
                    <!-- <img src="assets/images/logo.svg" alt=""/> -->
                   <h1 style="color: white;">NewsFirst</h1>
                  </a>
                  </div>
                  <div>
                    <button
                      class="navbar-toggler"
                      type="button"
                      data-target="#navbarSupportedContent"
                      aria-controls="navbarSupportedContent"
                      aria-expanded="false"
                      aria-label="Toggle navigation"
                    >
                      <span class="navbar-toggler-icon"></span>
                    </button>
                    <div
                      class="navbar-collapse justify-content-center collapse"
                      id="navbarSupportedContent"
                    >
                      <ul
                        class="navbar-nav d-lg-flex justify-content-between align-items-center"
                      >
                        <li>
                          <button class="navbar-close">
                            <i class="mdi mdi-close"></i>
                          </button>
                        </li>
                        <?php
                          $category = "SELECT * from theloai";
                          $result = mysqli_query($conn, $category);
                          while($row = $result->fetch_array()) {
                            echo '
                            <li class="nav-item active">
                              <a class="nav-link" href="page_category.php?id='.$row['id'].'">'.$row["tenTL"].'</a>
                            </li>
                            ';
                          }
                        ?>
                      </ul>
                    </div>
                  </div>
                  <ul class="social-media">
                    <li>
                      <a href="https://www.facebook.com/" target="_blank">
                        <i class="mdi mdi-facebook"></i>
                      </a>
                    </li>
                    <li>
                      <a href="https://www.youtube.com/" target="_blank">
                        <i class="mdi mdi-youtube"></i>
                      </a>
                    </li>
                    <li>
                      <a href="https://www.twitter.com/" target="_blank">
                        <i class="mdi mdi-twitter"></i>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </nav>
          </div>
        </header>
        <!-- partial -->
<div class="flash-news-banner">
  <div class="container">
    <div class="d-lg-flex align-items-center justify-content-between">
      <div class="d-flex align-items-center">
        <span class="badge badge-dark mr-3">Tin nóng</span>
        <p class="mb-0">
        <?php
          $post = "SELECT * from tin limit 1";
          $rsl = mysqli_query($conn, $post);
          $row = mysqli_fetch_array($rsl);
          echo $row['tieude'];
        ?>
        </p>
      </div>
      <div class="d-flex">
        <span class="mr-3 text-danger">Wed, March 4, 2020</span>
        <span class="text-danger">30°C,London</span>
      </div>
    </div>
  </div>
</div>