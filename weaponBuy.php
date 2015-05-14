<?php 
session_start();
if(!isset($_SESSION['id']))
{
    header('Location: /');
    exit();
}
require_once("./assets/city_class.php");
$buy = new WeaponMerchant($_POST['id'],$_SESSION['id']);
$buy -> weaponBuy();

?>