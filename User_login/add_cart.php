<?php
	session_start();
    //initialize cart if not set or is unset
	if(!isset($_SESSION['cart'])){
		$_SESSION['cart'] = array();
	}
	//check if product is already in the cart
	if(!in_array($_POST['msg'], $_SESSION['cart'])){
		array_push($_SESSION['cart'], $_POST['msg']);
	}
	$key= count($_SESSION['cart']);
	$_SESSION['qty'][$key] = $_POST['quantity'];
	header("location: view_cart.php?id=".$_SESSION['id']);

?>