<?php
	if(isset($_POST['save'])){
		foreach($_POST['indexes'] as $key){
			$_SESSION['qty'][$key] = $_POST['qty_'.$key];
		}
		header('location: view_cart.php?id='.$_SESSION['id']);
	}
?>
