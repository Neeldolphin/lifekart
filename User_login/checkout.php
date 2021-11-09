<?php
	session_start();
	header('location: cart.php?id='.$_SESSION['id']);
?>