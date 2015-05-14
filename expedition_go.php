<?php
require_once("./assets/expedition.php");
//
	session_start();
//
	$check = new endExpeditions(($_SESSION['id']));
//
	$check -> checkTime();
//
//
//Dodać sprawdzanie geta czy ktoś nie hackuje hehhehehehheheheheh
$foo = new startExpeditions(($_SESSION['id']),($_GET['id']));
$foo -> setExpedition();
header("Location: /expedition.php");
?>