<?php
    require_once 'classes/DB.php';
    require_once 'classes/Session.php';
    require_once 'classes/Functions.php';

    $db = new DB();
    $db->connect();
    $db->set_char('utf8');

    $_DOMAIN = 'http://localhost/NewsFirst/admin/';

    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $date_current = '';
    $date_current = date("Y-m-d H:i:sa");

    $session = new Session();
    $session->start();

    if($session->get() != '') {
        $email = $session->get();
    } else {
        $email = '';
    }
?>