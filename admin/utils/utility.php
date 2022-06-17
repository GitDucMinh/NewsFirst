<?php
    require_once $baseUrl.'connect.php';
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
?>