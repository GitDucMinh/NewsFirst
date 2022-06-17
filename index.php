
<?php
  require_once('admin/connect.php');
  include('includes/head.php');
  include('includes/headerPage.php');
?>
<div class="content-wrapper">
          <div class="container">
            <div class="row" data-aos="fade-up">
              <div class="col-xl-8 stretch-card grid-margin">
              <?php
              tinDauTrang($conn);
            ?>   
              </div>
              <div class="col-xl-4 stretch-card grid-margin">
                <div class="card bg-dark text-white">
                  <div class="card-body">
                    <h2>Tin mới nhất</h2>
                      <?php tinMoiHeader($conn); ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="row" data-aos="fade-up">
              <div class="col-lg-3 stretch-card grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h2>Danh mục</h2>
                    <ul class="vertical-menu">
                    <?php
                      menuCategory($conn);
                    ?>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-lg-9 stretch-card grid-margin">
                <div class="card">
                  <div class="card-body">
                  <?php
                    listCategory($conn);
                    ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="row" data-aos="fade-up">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-xl-6">
                        <div class="card-title">
                          Nhân vật thể thao
                        </div>
                        <div class="row">
                          <div class="col-xl-6 col-lg-8 col-sm-6">
                            <?php
                              renderNhanvat($conn);
                            ?>
                          </div>
                          <div class="col-xl-6 col-lg-4 col-sm-6">
                           <?php listPostNoImage($conn);?>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-6">
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="card-title">
                              Tin mới Covid 19
                            </div>
                            <?php renderSpotLight($conn);?>
                          </div>
                          <div class="col-sm-6">
                            <div class="card-title">
                              Chứng Khoán
                            </div>
                            <?php renderChungKhoang($conn);?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
<!-- main-panel ends -->
<!-- container-scroller ends -->
<?php include('includes/footer.php'); ?>