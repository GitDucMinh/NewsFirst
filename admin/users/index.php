<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
?>
<?php 
    $baseUrl = '../';
    $title = "Quản lý người dùng";
    require $baseUrl.'connect.php'; 
?>
<?php
    require_once $baseUrl.'elements/header.php';
?>
<div>
    <a href="add.php" class="btn btn-success" style="margin-left:50px;">Add</a>
</div>
<br>
<!-- Begin Page Content -->
    <table class="table ml-5">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Họ tên</th>
                <th scope="col">Tên đăng nhập</th>
                <th scope="col">Email</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $query = "SELECT * FROM users";
                $result = mysqli_query($conn, $query);
                $i = 1;
                while($row = $result->fetch_array()) {
                    echo "
                        <tr>
                            <th scope='row'>".$i++."</th>
                            <td>".$row['hoten']."</td>
                            <td>".$row['tendangnhap']."</td>
                            <td>".$row['email']."</td>
                            <td>
                                <a href='edit.php?id=".$row['id']."' class='btn btn-primary'>Edit</a> 
                                <a href='delete.php?id=".$row['id']."' class='btn btn-danger'>Delete</a>
                            </td>
                        </tr>
                        ";   
                }
            ?>
        </tbody>
    </table>
<?php
require_once $baseUrl.'elements/footer.php';
?>