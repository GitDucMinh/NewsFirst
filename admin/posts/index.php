<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
?>
<?php 
    $baseUrl = '../';
    $title = "Bài viết";
    require_once $baseUrl.'elements/header.php';

    if(isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }

    $num_page = 5;
    $start_from = ($page - 1) * $num_page;
?>
<!-- Begin Page Content -->        
<div>
    <a href="add.php" class="btn btn-success" style="margin-left:50px;">Add</a>
</div>
<br>
<!-- Begin Page Content -->
<div class="content-table" style="width: 90%">
    <table class="table ml-5" width="100px">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Tiêu đề</th>
            <th scope="col">Tóm tắt</th>
            <th scope="col">Hình ảnh</th>
            <th scope="col">Ngày đăng</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            $query = "SELECT * FROM tin ORDER BY id DESC LIMIT  $start_from,$num_page";
            $result = mysqli_query($conn, $query);
            while($row = $result->fetch_array()) {
                echo "
                    <tr>
                        <th scope='row'>".$row['thutu']."</th>
                        <td>".$row['tieude']."</td>
                        <td>".$row['tomtat']."</td>
                        <td><img src='uploads/".$row['urlHinh']."' style='width:100px; heigth:100px;'></td>
                        <td>".$row['ngaydang']."</td>
                        <td style='width:16%'>
                            <a href='../posts/edit.php?id=".$row['id']."' class='btn btn-primary' style='text-align:center'>Edit</a> 
                            <a href='../posts/delete.php?id=".$row['id']."' class='btn btn-danger' style='text-align:center'>Delete</a>
                        </td>
                    </tr>
                    ";
            }
        ?>
        </tbody>
       
    </table>
    <div style="float: right;">
    
    <nav aria-label="Page navigation example">
            <ul class="pagination">
            <?php
                $qr = "SELECT * FROM tin";
                $result = mysqli_query($conn, $qr);
                $total_record = mysqli_num_rows($result);
                $total_page = ceil($total_record/$num_page);
                $c = 0;
                if($page > 1) {
                    echo '<li class="page-item"><a class="page-link" href="index.php?page='.($page-1).'">Previous</a></li>';
                }
                for($i = 1; $i <= $total_page; $i++) {
                    echo '<li class="page-item"><a class="page-link" href="index.php?page='.$i.'">'.$i.'</a></li>';
                    $c = $i;
                }
                if($c > $page) {
                    echo '<li class="page-item"><a class="page-link" href="index.php?page='.($page+1).'">Next</a></li>';
                }
            ?>
                <!-- <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li> -->
            </ul>
        </nav>
    </div>
</div>
<?php require_once $baseUrl.'elements/footer.php'; ?>
