<?php
include 'connection.php';
session_start();

if($_POST['action']=='productdetail')
{    
    if(!isset($_SESSION['cart'])){
		$_SESSION['cart'] = array();
	}
	//check if product is already in the cart
	if(!in_array($_POST['msg'], $_SESSION['cart'])){
		array_push($_SESSION['cart'], $_POST['msg']);
	}
	$key= count($_SESSION['cart'])-1;
	$_SESSION['qty'][$key] = $_POST['quantity'];

header("location: view_cart.php?id=".$_SESSION['id']);
}

?>