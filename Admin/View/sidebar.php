<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
<?php 
 include '../Controller/css/style.css';
 ?>
</style>
</head>
<body>

<div class="sidenav">
<a href="http://localhost/lifekart/Admin/View/logout.php">logout</a>
 <div class="dropdown-btn">Catelog
    <i class="fa fa-caret-down"></i>
</div>
  <div class="dropdown-container">
    <a href="http://localhost/lifekart/Admin/View/product.php">product </a>
    <a href="http://localhost/lifekart/Admin/View/category.php">Category</a>
  </div>
    <a href="http://localhost/lifekart/Admin/View/customer.php">Customer</a>
    <a href="http://localhost/lifekart/Admin/View/imageslider.php">Image Slider</a>
    <a href="http://localhost/lifekart/Admin/View/coupen.php">Coupen</a>
</div>


<script>
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}
</script>
</body>
</html> 