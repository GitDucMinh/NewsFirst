<?php
    session_start();
    $baseUrl = '../';
    require_once $baseUrl.'connect.php';
    require_once $baseUrl.'utils/utility.php';

    $user = getUserToken($conn);
    if($user != null) {
        $token = getCookie('token');
        $id = $user['id'];
        $sql = "delete from tokens where user_id = '$id' and token = '$token'";
        mysqli_query($conn, $sql);
        setcookie('token',"",time() - 100, '/');
    }
    echo '<script>location.href="../index.php"</script>';
    session_destroy();
?>