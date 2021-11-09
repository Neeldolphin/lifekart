<?php
	session_start();

	//remove the id from our cart array
	$key = array_search($_GET['id'], $_SESSION['cart']);	
	unset($_SESSION['cart'][$key]);

	unset($_SESSION['qty'][$_GET['index']]);
	//rearrange array after unset
	$_SESSION['qty'] = array_values($_SESSION['qty']);
	header("location: view_cart.php?id=".$_SESSION['id']);
?>