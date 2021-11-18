<?php
	session_start();
	unset($_SESSION['cart']);
	unset($_SESSION['coupen_name']);

header("location: view_cart.php?id=".$_SESSION['id']);
?>