<?php
    function capNhatSoLanXemTin($conn, $idTin) {
        $qr = "UPDATE tin SET views = views + 1 WHERE id = $idTin";
        mysqli_query($conn, $qr);
    }

    function rand_string($length) {
        $chars = "qwertyuiopasdfghjklzxcvbnm1234567890";
        $size = strlen($chars);
        $str = '';
        for($i = 0; $i < $length; $i++) {
            $str .= $chars[rand(0, $size - 1)];
        }
        return $str;
    }

    function fixSqlInject($sql) {
        $sql = str_replace('\\', '\\\\', $sql);
        $sql = str_replace('\'', '\\\'', $sql);
        return $sql;
    }

    function getCookie($key) {
        $value = "";
        if(isset($_COOKIE[$key])) {
            $value = $_COOKIE[$key];
            $value = fixSqlInject($value);
        }

        return trim($value);
    }

    function getUserToken($conn) {
        if(isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }

        $token = getCookie('token');
        $sql = "SELECT * FROM tokens WHERE token = '$token'";
        $query = mysqli_query($conn, $sql);
        $item = mysqli_fetch_array($query);
        if($item != null) {
            $userId = $item['user_id'];
            $sql = "SELECT * FROM users WHERE id = '$userId'";
            $query = mysqli_query($conn, $sql);
            $item = mysqli_fetch_array($query);
            if($item != null) {
                $_SESSION['user'] = $item;
                return $item;
            }
        }
        return null;
    }
    //lấy ham thể laoij getcategory từ đay
    function getCategory($conn, $id) {
        $sql = "SELECT * FROM theloai WHERE id = '$id' LIMIT 1";
        $query = mysqli_query($conn, $sql);
        $r = mysqli_fetch_array($query);
        return $r['tenTL'];   
    }

    function getLoaiTin($conn, $id) {
        $sql = "SELECT * FROM loaitin WHERE id = '$id' LIMIT 1";
        $query = mysqli_query($conn, $sql);
        $r = mysqli_fetch_array($query);
        return $r['tenLT'];   
    }

    function time_stamp($time_ago) {
        $cur_time=time();
        $time_elapsed = $cur_time - $time_ago;
        $seconds = $time_elapsed ;
        $minutes = round($time_elapsed / 60 );
        $hours = round($time_elapsed / 3600);
        $days = round($time_elapsed / 86400 );
        $weeks = round($time_elapsed / 604800);
        $months = round($time_elapsed / 2600640 );
        $years = round($time_elapsed / 31207680 );
        // Seconds
        if($seconds <= 60) {
            return " $seconds giây ";
        }
        //Minutes
        else if($minutes <=60) {
            if($minutes==1) {
                return " 1 phút ";
            } else {
               return " $minutes phút"; 
            }
        }
    
        //Hours
        else if($hours <=24) {
            if($hours==1) {
                return "1 tiếng ";
            } else {
                return "  $hours tiếng ";
            }
        }
    
        //Days
        else if($days <= 7) {
            if($days==1) {
                return " Hôm qua "; 
            } else {
                return "  $days ngày ";
            }
        }
    
        //Weeks
        else if($weeks <= 4.3) {
            if($weeks==1) {
                return " 1 tuần ";
            } else {
                return "  $weeks tuần";
            }
        }
    
        //Months
        else if($months <=12) {
            if($months==1) {
                return " 1 tháng ";
            } else {
                return " $months tháng";
            }
        }
    
        //Years
        else { 
            if($years==1) {
                return " 1 năm ";
            } else {
                return " $years năm ";
            }
        }
    
    }
    
//dung để lấy ra các dữ liệ in ra bai viết
    function tinMoiHeader($conn) {              
$post = "SELECT * from tin ORDER BY id DESC limit 0,3";//xắpxếp theo chiêu giảm giân củaid giớihạn 3bai viếtdaauf tiên
        $rs = mysqli_query($conn, $post);//query để lấy CSDL
        while($r = $rs->fetch_array()) {
            $time_ago =strtotime($r['timestamp']);//để lấy thơi gian từ truuwowng timestamp
            echo '
            <div class="d-flex border-bottom-blue pt-3 pb-4 align-items-center justify-content-between">
                <div class="pr-3">
                <h5><a href="post_page.php?id='.$r["id"].'" class="text-decoration-none text-white"> '.$r['tieude'].'</a></h5> //lay du lieu tu truong id,tieude
                <div class="fs-12">
                    <span class="mr-2"><strong class="text-danger">'.getCategory($conn, $r['idTL']).' </strong></span>'.time_stamp($time_ago).'
                </div>
                </div>
                <div class="rotate-img">
                <img
                    src="admin/posts/uploads/'.$r['urlHinh'].'"
                    alt="thumb"
                    class="img-fluid img-lg"
                />
                </div>
            </div>';
        }
    }
    function tinMoiNhat($conn) {
        $post = "SELECT * from tin ORDER BY id DESC limit 0,3";
        $rs = mysqli_query($conn, $post);
        
        while($r = $rs->fetch_array()) {
            $time_ago =strtotime($r['timestamp']);
            echo '
            <div class="row">
                <div class="col-sm-12">
                    <div class="border-bottom pb-4 pt-4">
                        <div class="row">
                            <div class="col-sm-8">
                                <h5 class="font-weight-600 mb-1">
                                <a href="post_page.php?id='.$r["id"].'" class="text-decoration-none text-dark"> '.$r['tieude'].'</a>
                                </h5>
                                <p class="fs-13 text-muted mb-0">        
                                    <span class="mr-2"><b class="text-danger">'.getCategory($conn, $r['idTL']).'</b> </span>'.time_stamp($time_ago).'
                                </p>
                            </div>
                            <div class="col-sm-4">
                                <div class="rotate-img">
                                    <img
                                    src="admin/posts/uploads/'.$r['urlHinh'].'"
                                    alt="banner"
                                    class="img-fluid"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
            ';   
        }
    }

    function tinXemNhieuNhat($conn) {
        $sql = "SELECT * FROM tin ORDER BY views DESC LIMIT 0,6";
        $query = mysqli_query($conn, $sql);
        while($r = $query->fetch_array()) {
            $time_ago =strtotime($r['timestamp']);
            echo '
            <div class="mb-5">
                <div class="rotate-img">
                    <img
                        src="admin/posts/uploads/'.$r['urlHinh'].'"
                        alt="banner"
                        class="img-fluid";
                    />
                </div>
                <h3 class="mt-3 font-weight-600">
                <a href="post_page.php?id='.$r["id"].'" class="text-decoration-none text-dark">'.$r['tieude'].'</a>
                </h3>
                <p class="fs-13 text-muted mb-0">
                    <span class="mr-2"><b class="text-danger">'.getCategory($conn, $r['idTL']).'</b> </span>'.time_stamp($time_ago).'
                </p>
                <div class="mb-2"> <strong><i class="fa fa-eye"> '.$r['views'].' Lượt xem</i></strong></div>
            </div>';
        }
    }
//getcategory truyen vao id thể loại
    function tinDauTrang($conn) {
        $post = "SELECT * from tin limit 1";
        $rs = mysqli_query($conn, $post);
        while($row = $rs->fetch_array()) {
        $time_ago =strtotime($row['timestamp']);
        echo '
        <div class="position-relative">
            <img src="admin/posts/uploads/'.$row['urlHinh'].'" alt="banner" class="img-fluid"/>
            <div class="banner-content">
            <div class="badge badge-danger fs-12 font-weight-bold mb-3">'.getCategory($conn, $row['idTL']).' </div>
            <h1 class="mb-0"><a href="post_page.php?id='.$row["id"].'" class="text-decoration-none text-white">'.$row['tieude'].'</a></h1>
            <h3 class="mb-2">'.$row['tomtat'].'</h3>
            <div class="fs-14">
                <div class="mb-2"> <strong><i class="fa fa-eye"> '.$row['views'].'</i></strong></div>
                <span class="mr-2"><b>'.getLoaiTin($conn, $row['idLT']).'</b></span>'.time_stamp($time_ago).'
                </div>
            </div>
        </div>
        ';
        }
    }
//in ra danh muc
    function menuCategory($conn) {
        $category = "SELECT * from theloai";
        $result = mysqli_query($conn, $category);
        while($row1 = $result->fetch_array()) {
        echo '
        <li class="nav-item active">
            <a class="nav-link" href="page_category.php?id='.$row1['id'].'">'.$row1["tenTL"].'</a>
        </li>
        ';//lay ra tu truong id va TLT
        }
    }
//lấy dữ liệ từ csdl
    function listCategory($conn) {
        $post = "SELECT * from tin limit 3";
        $rs = mysqli_query($conn, $post);
        while($row = $rs->fetch_array()) {
        $time_ago =strtotime($row['timestamp']);
        echo '
            <div class="row">
            <div class="col-sm-4 grid-margin">
            <div class="position-relative">
                <div class="rotate-img">
                <img
                    src="admin/posts/uploads/'.$row['urlHinh'].'"
                    alt="thumb"
                    class="img-fluid"
                />
                </div>
                <div class="badge-positioned">
                <span class="badge badge-danger font-weight-bold"
                    >'.getCategory($conn, $row['idTL']).'</span
                >
                </div>
            </div>
            </div>
            <div class="col-sm-8  grid-margin">
            <h2 class="mb-2 font-weight-600">
                <a href="post_page.php?id='.$row["id"].'" class="text-decoration-none text-dark">'.$row['tieude'].'</a>
            </h2>
            <div class="fs-13 mb-2">
                <span class="mr-2"><b>'.getLoaiTin($conn, $row['idLT']).'</b> </span>'.time_stamp($time_ago).'
            </div>
            <p class="mb-0">
            '.$row['tomtat'].'
            </p>
            </div>
        </div>
        ';}
    }

    function listPageCategory($conn, $id, $from, $num) {
        $post = "SELECT * from tin WHERE idTL = $id LIMIT $from, $num";
        $rs = mysqli_query($conn, $post);
        while($row = $rs->fetch_array()) {
        $time_ago =strtotime($row['timestamp']);
        echo '
            <div class="row">
            <div class="col-sm-4 grid-margin">
            <div class="position-relative">
                <div class="rotate-img">
                <img
                    src="admin/posts/uploads/'.$row['urlHinh'].'"
                    alt="thumb"
                    class="img-fluid"
                />
                </div>
                <div class="badge-positioned">
                <span class="badge badge-danger font-weight-bold"
                    >'.getCategory($conn, $row['idTL']).'</span
                >
                </div>
            </div>
            </div>
            <div class="col-sm-8  grid-margin">
            <h2 class="mb-2 font-weight-600">
                <a href="post_page.php?id='.$row["id"].'" class="text-decoration-none text-dark">'.$row['tieude'].'</a>
            </h2>
            <div class="fs-13 mb-2">
                <span class="mr-2"><b>'.getLoaiTin($conn, $row['idLT']).'</b> </span>'.time_stamp($time_ago).'
            </div>
            <p class="mb-0">
            '.$row['tomtat'].'
            </p>
            </div>
        </div>
        ';}
    }

    function pagination($conn, $page, $num_page, $start_from, $id) {
        $qr = "SELECT * FROM tin WHERE idTL = $id";
        $result = mysqli_query($conn, $qr);
        $total_record = mysqli_num_rows($result);
        $total_page = ceil($total_record/$num_page);
        $c = 0;
        if($page > 1) {
            echo '<li style="display: inline-block;">
                    <a class="btn btn-primary" href="page_category.php?page='.($page - 1).'&id='.$id.'">Previous</a>
                </li>';
        }
        for($i = 1; $i <= $total_page; $i++) {
            echo '
            <li style="display: inline-block;">
                <a class="btn btn-primary" href="page_category.php?page='.$i.'&id='.$id.'">'.$i.'</a>
            </li>
            ';
            $c = $i;
        }
        if($c > $page) {
            echo '<li style="display: inline-block;">
                    <a class="btn btn-primary" href="page_category.php?page='.($page + 1).'&id='.$id.'">Next</a>
                    </li>';
            }
    }

    function renderPost($conn, $id) {
        $sql = "SELECT * FROM tin WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result)) {
            $time_ago =strtotime($row['timestamp']);
            echo "<h3>".$row['tieude']."</h3><br/>";
            echo "<em>" .time_stamp($time_ago). "</em><br/>";
            echo htmlspecialchars_decode($row['noidung']);
            echo '<strong>Số lượt xem: '.$row['views'].'</strong>';
        }
    }

    function footerCategory($conn) {
        $category = "SELECT * from theloai";
        $result = mysqli_query($conn, $category);
        while($row = $result->fetch_array()) {
        echo '
        <div class="footer-border-bottom pb-2 mt-4">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 font-weight-600">'.$row['tenTL'].'</h5>
            </div>
        </div>
        ';
        }
    }

    function tinMoiFooter($conn) {
        $post = "SELECT * from tin ORDER BY id DESC limit 0,3";
        $rs = mysqli_query($conn, $post);
        
        while($row = $rs->fetch_array()) {
             $time_ago =strtotime($row['timestamp']);
            echo '
            <div class="row">
                <div class="col-sm-12">
                    <div class="footer-border-bottom pb-2 pt-2">
                    <div class="row">
                        <div class="col-3">
                        <img
                            src="admin/posts/uploads/'.$row['urlHinh'].'"
                            alt="thumb"
                            class="img-fluid"
                        />
                        </div>
                        <div class="col-9">
                        <h5 class="font-weight-600">
                            <a href="post_page.php?id='.$row["id"].'" class="text-decoration-none text-white">'.$row['tieude'].'</a>
                        </h5>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            ';
        }
    }

    function getLoaitinNhanVat($conn) {
        $ltNV = "SELECT * FROM loaitin WHERE id = 4";
        $result = mysqli_query($conn, $ltNV);
        $r = mysqli_fetch_array($result);
        return $r['tenLT'];
    }

    function renderNhanvat($conn) {
        $ltNV = "SELECT * FROM tin WHERE idLT = 4 ORDER BY id DESC limit 1";
        $result = mysqli_query($conn, $ltNV);
        $r = mysqli_fetch_array($result);
        $time_ago =strtotime($r['timestamp']);
        if(mysqli_num_rows($result)) {
        echo '
            <div class="rotate-img">
            <img
                src="admin/posts/uploads/'.$r['urlHinh'].'"
                alt="thumb"
                class="img-fluid"
                />
            </div>
            <h2 class="mt-3 text-primary mb-2">
            '.$r['tieude'].'
        </h2>
        <p class="fs-13 mb-1 text-muted">
            <span class="mr-2 text-danger"><strong>'.getLoaitinNhanVat($conn).'</strong> </span>'.time_stamp($time_ago).'
        </p>
        <p class="my-3 fs-15">
            '.$r['tomtat'].'
        </p>
        <a href="post_page.php?id='.$r["id"].'" class="font-weight-600 text-decoration-none text-dark">
            Đọc thêm...</a>
        ';
        }
    }

    function listPostNoImage($conn) {
        $sql = "SELECT * FROM tin ORDER BY id DESC LIMIT 0,4 ";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result)) {
            $time_ago =strtotime($row['timestamp']);
            echo '
            <div class="border-bottom pb-3 mb-3">
                <h4 class="font-weight-600 mb-0">
                <a href="post_page.php?id='.$row["id"].'" class="font-weight-600 text-decoration-none text-dark">'.$row['tieude'].'</a>
                </h4>
                <p class="fs-13 text-muted mb-0">
                <span class="mr-2 text-danger"><strong>'.getLoaitinNhanVat($conn).'</strong></span>'.time_stamp($time_ago).'
                </p>
                <p class="mb-0">
                Đọc thêm chi tiết bài viết
                </p>
            </div>
            ';
        }
    }

    function renderSpotLight($conn) {
        $CV19 = "SELECT * FROM tin WHERE idTL = 2 ORDER BY id DESC limit 2";
        $result = mysqli_query($conn, $CV19);
        while($r = $result->fetch_array()) {
            $time_ago =strtotime($r['timestamp']);
            echo '
            <div class="border-bottom pb-3">
                <div class="rotate-img">
                <img
                    src="admin/posts/uploads/'.$r['urlHinh'].'"
                    alt="thumb"
                    class="img-fluid"
                />
                </div>
                <p class="fs-16 font-weight-600 mb-0 mt-3">
                    <a href="post_page.php?id='.$r["id"].'" class="text-decoration-none text-dark">'.$r['tieude'].'</a>
                </p>
                <p class="fs-13 text-muted mb-0">
                <span class="mr-2 text-danger"><strong>'.getCategory($conn, $r['idTL']).'</strong> </span>'.time_stamp($time_ago).'
            </p>
          </div>
            ';
        }
    }

    function renderChungKhoang($conn) {
        $ck = "SELECT * FROM tin WHERE idTL = 3 ORDER BY id DESC limit 4";
        $result = mysqli_query($conn, $ck);
        while($r = $result->fetch_array()) {
        $time_ago =strtotime($r['timestamp']);
        echo '
        <div class="row">
            <div class="col-sm-12">
            <div class="border-bottom pb-3">
                <div class="row">
                    <div class="col-sm-5 pr-2 mt-2">
                        <div class="rotate-img">
                        <img
                            src="admin/posts/uploads/'.$r['urlHinh'].'"
                            alt="thumb"
                            class="img-fluid w-100"
                        />
                        </div>
                    </div>
                    <div class="col-sm-7 pl-2">
                        <p class="fs-16 font-weight-600 mb-0">
                        <a href="post_page.php?id='.$r["id"].'" class="text-decoration-none text-dark">'.$r['tieude'].'</a>
                        </p>
                        <p class="mb-0 fs-13">
                        '.$r['tomtat'].'<strong>'.time_stamp($time_ago).'</strong>
                        </p>
                    </div>
                </div>
            </div>
            </div>
        </div>
        ';
        }
    } 
?>