<?php 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL); 
 session_start();
$lastview=(int)$_GET['id'];
if (!isset($_SESSION['lastview'])){
    $_SESSION['lastview']=array();
}
  if(!in_array($lastview,$_SESSION['lastview'])){
      array_push($_SESSION['lastview'],$lastview);
  }
    setcookie('cards',json_encode($_SESSION['lastview']), time()+3600 ,'/');  
     $cookie = $_COOKIE['cards'];
     $cookie = stripslashes($cookie);
    $savedCard = json_decode($cookie, true);  
    // print_r($savedCard);
    //unset($_SESSION['lastview']);
    //setcookie("_name", "", time()-3600);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Lifekart</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  <link  rel="stylesheet" type="text/css" href="https://unpkg.com/xzoom/dist/xzoom.css" media="all"></link>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://unpkg.com/xzoom/dist/xzoom.min.js"></script>
  <script src="../Controller/js/main.js"></script>
  <style>
  <?php 

 include '../Controller/css/style.css';
 include '../Model/class.php';
 ?>
  </style>
</head>