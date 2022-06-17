<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
?>

<?php
    $baseUrl = '../';
    $title = 'Thêm bài viết';
    include $baseUrl.'connect.php';
    require_once $baseUrl.'elements/header.php';
    $title = $summary = $category = $content = $loaitin = "";
    $title_old = $summary_old = $category_old = $content_old = $loaitin_old = "";
    $title_error = $summary_error = $category_error = $content_error = $loaitin_error = "";
    $image_error =  $image_error1 = "";
    $pathImage = "";
    $alert = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(empty($_POST['title'])) {
            $title_error = "Tiêu đề không được để trống";
        } else {
            $title = check_input($_POST['title']);
            $title_old = $title;
        }

        if(empty($_POST['summary'])) {
            $summary_error = "Bạn cần tóm tắt nội dung";
        } else {
            $summary = check_input($_POST['summary']);
            $summary_old = $summary;
        }

        if(empty($_POST['category'])) {
            $category_error = "Thể loại không được để trống";
        } else {
            $category = check_input($_POST['category']);
            $category_old = $category;
        }

        if(empty($_POST['loaitin'])) {
            $loaitin_error = "Loại tin không được để trống";
        } else {
            $loatin = check_input($_POST['loaitin']);
            $loaitin = (int)($loatin);
            $loaitin_old = $loaitin;
        }

        if(empty($_POST['contents'])) {
            $content_error = "Bạn cần nhập nội dung cho bài viết";
        } else {
            $content = check_input($_POST['contents']);
            $content_old = $content;
        }

        $originImage = $_FILES["fileToUpload"]["name"];

        if($title_error == "" && $summary_error == "" && $category_error == "" && $content_error == "" && $loaitin_error == "" && $image_error == "" && $image_error1 == "") {
            $query = "INSERT INTO tin (tieude,tomtat,idTL,idLT,noidung,urlHinh) VALUES ('$title','$summary','$category','$loaitin','$content','$originImage')";
            
            if(mysqli_query($conn, $query)) {
                move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "uploads/".basename($_FILES["fileToUpload"]["name"]));
                $alert = "Thêm thành công!";
                echo "
                <script>
                    setTimeout(function(){
                        location.href ='index.php';
                    }, 1000);
                </script>";
            } else {
                echo "Error: " .$query."<br>".mysqli_error($conn);
            }
        
            mysqli_close($conn);
        }
    }

    function check_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<?php 
// require_once $baseUrl.'elements/header.php';?>

<h2 style="margin-left: 50px;" >Thêm bài viết</h2>
<div style="width: 90%; margin-left: 50px;" >
<?php
    if($alert != "") {
        echo ' <div class="alert alert-success" role="alert">
                    '.$alert.'
            </div>';
    }
?>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group" style="width: 50%;">
            <label for="">Tiêu đề</label>
            <input type="text" class="form-control" name="title" value="<?php echo $title_old; ?>">
            <small class="text-danger"><?php echo $title_error;?> </small>
        </div>
        <div class="form-group">
            <label for="">Tóm tắt</label>
            <input type="text" class="form-control" name="summary" value="<?php echo $summary_old; ?>">
            <small class="text-danger"><?php echo $summary_error;?> </small>
        </div>
        <div>
            <label for="fileToUpload">Hình ảnh</label> 
            <br>
            <input type="file" name="fileToUpload" id="fileToUpload" placeholder="NO UPLOAD">
            <br>
            <small class="text-danger"><?php echo $image_error; ?></small>
        </div>
        <br>
        <div class="form-group" style="width: 30%;">
            <label for="category">Thể loại</label>
            <select class="form-control" name="category" id="category">
                <option value="">Chọn thể loại</option>
                <?php 
                    $query = "SELECT * FROM theloai";
                    $result = mysqli_query($conn, $query);
                    while ($row = $result->fetch_array()) {                                    
                        echo '<option value="'.$row["id"].'">'.$row["tenTL"].'</option>';
                    }
                ?>                                    
            </select>
            <small class="text-danger"><?php echo $category_error;?> </small>
        </div>
        <div class="form-group" style="width: 30%;">
            <label for="loaitin">Loại tin</label>
            <select class="form-control" name="loaitin" id="loaitin">
                <option value="">Chọn loại tin</option>
                <?php 
                    $qr = "SELECT * FROM loaitin";
                    $rs = mysqli_query($conn, $qr);
                    while ($r = $rs->fetch_array()) {                                    
                        echo '<option value="'.$r["id"].'">'.$r["tenLT"].'</option>';
                    }
                ?>                                    
            </select>
            <small class="text-danger"><?php echo $loaitin_error;?> </small>
        </div>
        <!-- <div class="form-group" style="width: 30%;">
            <label class="text-dark" for="datepicker">Ngày đăng</label>
            <input type="text" class="form-control" name="datepost" id="datepicker" aria-describedby="date"
            value="">
        </div> -->

        <div>
        <textarea name="contents" id="contents" value="<?php echo $content_old; ?>"></textarea>
        <small class="text-danger"><?php echo $content_error;?> </small>
        </div>
        <br>
        <button type="submit" class="btn btn-success" name="submit">Add</button>
    </form>
</div>
<?php require_once $baseUrl.'elements/footer.php';?>
