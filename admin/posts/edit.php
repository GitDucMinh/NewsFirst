<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
?>

<?php
    $baseUrl = '../';
    $title = "Chỉnh sửa bài viết";
    include $baseUrl.'connect.php';
    $title = $summary = $category = $content = $loaitin = "";
    $title_old = $summary_old = $category_old = $content_old = $loaitin_old = "";
    $title_error = $summary_error = $category_error = $content_error = $loaitin_error = $image_error = "";
    $pathImage = "";
    $alert = "";
    
    $sql = "SELECT * FROM tin WHERE id = ". $_GET['id']."";
    $rs = mysqli_query($conn, $sql);
    $r = mysqli_fetch_array($rs);

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_GET['id'];
    
        if(empty($_POST['title'])) {
            $title_error = "Tiêu đề không được để trống";
        } else {
            $title = check_input($_POST['title']);
            $title_old = $title;
        }

        if(empty($_POST['summary'])) {
            $summary_error = "Bạn cần tóm tắt nội dung";
        } else {
            if(strlen($_POST['summary']) > 500) {
                $summary_error = "Tóm tắt của bạn vượt quá 500 ký tự";
            }
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

        if($_FILES["fileToUpload"]["name"] == '') {
            $originImage = $_FILES["fileToUpload"]["name"];
        } else {
            $originImage = $_FILES["fileToUpload"]["name"];
        }
        
        if($title_error == "" && $summary_error == "" && $category_error == "" && $content_error == "" && $loaitin_error == "" && $originImage != '') {
            $query = "UPDATE tin SET tieude = '$title', tomtat = '$summary', idTL = '$category', idLT = '$loatin', noidung = '$content', urlHinh = '$originImage' WHERE id = $id";
            if(mysqli_query($conn, $query)) {
                $alert = true;
                move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "uploads/".basename($_FILES["fileToUpload"]["name"]));
                echo "
                    <script>
                        setTimeout(function(){
                            location.href ='index.php';
                        }, 1000);
                    </script>"
                ;
            } else {
                $alert = false;
                echo "Error: " .$query."<br>".mysqli_error($conn);
            }
        
            mysqli_close($conn);
        }
        if($title_error == "" && $summary_error == "" && $category_error == "" && $content_error == "" && $loaitin_error == "" && $originImage == '') {
            $query = "UPDATE tin SET tieude = '$title', tomtat = '$summary', idTL = '$category', idLT = '$loatin', noidung = '$content' WHERE id = $id";
            if(mysqli_query($conn, $query)) {
                $alert = true;
                echo "
                    <script>
                        setTimeout(function(){
                            location.href ='index.php';
                        }, 1000);
                    </script>"
                ;
            } else {
                $alert = false;
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

<?php require_once $baseUrl.'elements/header.php';?>
            
    <?php
            if(isset($_POST['submit'])) {
                if($alert == true) {
                    echo ' <div class="alert alert-success" role="alert">
                                Cập nhật thành công!
                        </div>';
                } else {
                    echo ' <div class="alert alert-danger" role="alert">
                                Cập nhật thất bại!
                        </div>';
                }
            }
        ?>
        <h2 style="margin-left: 50px;" >Thêm bài viết</h2>
        <div style="width: 90%; margin-left: 50px;" >
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group" style="width: 50%;">
                    <label for="">Tiêu đề</label>
                    <input type="text" class="form-control" name="title" value="<?php if(isset($_POST['edit'])){echo $title_old;} else {echo $r['tieude'];} ?>">
                    <small class="input-status"><?php echo $title_error;?> </small>
                </div>
                <div class="form-group">
                    <label for="">Tóm tắt</label>
                    <input type="text" class="form-control" name="summary" value="<?php if(isset($_POST['edit'])){echo $summary_old;} else {echo $r['tomtat'];} ?>">
                    <small class="input-status"><?php echo $summary_error;?> </small>
                </div>
                <div>
                    <label for="fileToUpload">Hình ảnh</label> 
                    <br>
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <br>
                    <small class="input-status"><?php echo $image_error; ?></small>
                </div>
                <br>
                <div class="form-group" style="width: 30%;">
                    <label for="category">Thể loại</label>
                    <select class="form-control" name="category" id="category">
                        <option value="<?php if(isset($_POST['edit'])){echo $category_old;} else {echo $r['idTL'];} ?>"><?php 
                            $q = "SELECT * FROM theloai";
                            $tl = "";
                            $rl = mysqli_query($conn, $q);
                            while($rw = $rl->fetch_array()) {
                                if($rw['id'] == $r['idTL']) {
                                    $tl = $rw['tenTL'];
                                }
                            } 
                            echo $tl;   
                        ?></option>
                        <?php 
                            $query = "SELECT * FROM theloai";
                            $result = mysqli_query($conn, $query);
                            while ($row = $result->fetch_array()) {                                    
                                echo '<option value="'.$row["id"].'">'.$row["tenTL"].'</option>';
                            }
                        ?>                                    
                    </select>
                    <small class="input-status"><?php echo $category_error;?> </small>
                </div>
                
                <div class="form-group" style="width: 30%;">
                    <label for="loaitin">Loại tin</label>
                    <select class="form-control" name="loaitin" id="loaitin">
                        <option value="<?php if(isset($_POST['edit'])){echo $loaitin_old;} else {echo $r['idLT'];} ?>">
                        <?php $qe = "SELECT * FROM loaitin";
                            $lt = "";
                            $rsl = mysqli_query($conn, $qe);
                            while($rws = $rsl->fetch_array()) {
                                if($rws['id'] == $r['idLT']) {
                                    $lt = $rws['tenLT'];
                                }
                            } 
                            echo $lt;  ?></option>
                        <?php 
                            $qr = "SELECT * FROM loaitin";
                            $rs = mysqli_query($conn, $qr);
                            while ($rLT = $rs->fetch_array()) {                                    
                                echo '<option value="'.$rLT["id"].'">'.$rLT["tenLT"].'</option>';
                            }
                        ?>                                    
                    </select>
                    
                    <small class="input-status"><?php echo $loaitin_error;?> </small>
                </div>
                <!-- <div class="form-group" style="width: 30%;">
                    <label class="text-dark" for="datepicker">Ngày đăng</label>
                    <input type="text" class="form-control" name="datepost" id="datepicker" aria-describedby="date"
                    value="">
                </div> -->
                
                <div>
                <textarea name="contents" id="contents">
                <?php if(isset($_POST['edit'])){echo $content_old;} else {echo $r['noidung'];} ?>
                </textarea>
                <script>CKEDITOR.replace('contents');</script>
                <small class="input-status"><?php echo $content_error;?> </small>
                </div>
                <br>
                <button type="submit" class="btn btn-success" name="submit">Add</button>
            </form>
        </div>
<!-- </div> -->
<?php require_once $baseUrl.'elements/footer.php';?>