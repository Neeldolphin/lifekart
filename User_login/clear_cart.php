<?php
	session_start();
	unset($_SESSION['cart']);
	unset($_SESSION['coupen_name']);
	unset($_SESSION['qty']);
header("location: view_cart.php?id=".$_SESSION['id']);
?>