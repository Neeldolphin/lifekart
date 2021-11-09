<?php
	session_start();
	unset($_SESSION['cart']);

header("location: view_cart.php?id=".$_SESSION['id']);
?>