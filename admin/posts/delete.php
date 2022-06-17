<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
?>
<?php include '../connect.php';?>
<?php
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM tin WHERE id=$id";
    $result = mysqli_query($conn, $query);
    if(!$result) {
        echo "Xóa không thành công!";
        echo "
        <script>
            setTimeout(function(){
                location.href ='index.php';
            }, 2000);
        </script>";
    } else {
        echo "Đã Xóa!";
        echo "
        <script>
            setTimeout(function(){
                location.href ='index.php';
            }, 2000);
        </script>";
    }
    mysqli_close($conn);

}
?>