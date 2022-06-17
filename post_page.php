<?php
  require_once('admin/connect.php');
  include('includes/head.php');
  include('includes/headerPage.php');
  include_once('function.php');

  $id = $_GET['id'];

  if(isset($_GET['id'])) {
    $idTin = $_GET['id'];
    // settype($idTin, "int");
  }else {
    $idTin = 1;
  }
  capNhatSoLanXemTin($conn, $idTin);
?>
<div class="container mb-5">
  <div class="row" data-aos="fade-up">
    <div class="col-md-8">
    <?php
      renderPost($conn, $id);
    ?>
    <div>
      <div id="fb-root" class="mt-3"></div>
      <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v12.0&appId=146545390839956&autoLogAppEvents=1" nonce="KXt5J4xw"></script>
      <div class="fb-like" data-href="http://hoangcongminh.tk/" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="true"></div>
    </div>
    <div class="mt-3">
      <div id="fb-root"></div>
      <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v12.0&appId=146545390839956&autoLogAppEvents=1" nonce="ACIXofaY"></script>
      <div class="fb-comments" data-href="http://hoangcongminh.tk/" data-width="600" data-numposts="5"></div>
    </div>
  </div>
    <div class="col-md-4">
        <h2 class="mb-4 text-primary font-weight-600">
        Tin mới nhất
        </h2>
        <?php 
        tinMoiNhat($conn);
        ?>
        
        <div class="trending">
            <h2 class="mb-4 text-primary font-weight-600">
                Tin tức được xem nhiều
            </h2>
            <?php tinXemNhieuNhat($conn); ?>
        </div>
    </div>
</div>
  
</div>
<?php include('includes/footer.php'); ?>