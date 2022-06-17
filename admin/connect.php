<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
?>

<?php
    $username = "root";
    $password = "";
    $database = "db_news";
    $servername = "localhost";

    $conn = mysqli_connect($servername, $username, $password, $database);
    if($conn->connect_error) {
        die("Connection failed: ". $conn->connect_error);
    }
?>