<?php
  require_once('admin/connect.php');
  include('includes/head.php');
  include('includes/headerPage.php');


    if(isset($_GET['id'])) {
        $id = $_GET['id'];
    }
    if(isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }

    $num_page = 6;
    $start_from = ($page - 1) * 6;
?>
    <div class="content-wrapper">
        <div class="container">
            <div class="col-sm-12">
                <div class="card" data-aos="fade-up">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <h1 class="font-weight-600 mb-4">
                                    <?php
                                        echo getCategory($conn, $id);
                                    ?>
                                </h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <?php
                                    listPageCategory($conn, $id, $start_from, $num_page);
                                ?>
                                <ul style="float:right;">
                                    <?php
                                        pagination($conn, $page, $num_page, $start_from, $id);
                                    ?>
                                    
                                </ul>     
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
                </div>
            </div>
    </div>
</div>
        
<?php include('includes/footer.php'); ?>