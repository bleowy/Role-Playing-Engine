<?php
require_once('./assets/login_class.php');
include('./assets/connect.php');
$login = new login($_POST['login'],$_POST['password']);
$login = new login_check($_POST['login'],$_POST['password']);
$login -> return_all();
$login -> login();
$login -> GoIntogameSite();
?>