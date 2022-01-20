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
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  <link  rel="stylesheet" type="text/css" href="https://unpkg.com/xzoom/dist/xzoom.css" media="all"></link>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://unpkg.com/xzoom/dist/xzoom.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="../Controller/js/main.js"></script>
  <style>
  <?php 

 include '../Controller/css/style.css';
 include '../Model/class.php';
 ?>
  </style>
</head>