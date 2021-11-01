<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
<?php 
 include 'style.css';
 ?>
</style>
</head>
<body>

<div class="sidenav">
<a href="http://localhost/lifekart/Admin_login/index.php">Dashboard</a>
 <button class="dropdown-btn">Catelog
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="http://localhost/lifekart/Admin_login/product.php">product </a>
    <a href="http://localhost/lifekart/Admin_login/category.php">Category</a>
  </div>
    <a href="http://localhost/lifekart/Admin_login/customer.php">Customer</a>
    <a href="http://localhost/lifekart/Admin_login/imageslider.php">Image Slider</a>
   <a href="#About">About</a>
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