<?php
if(count($_POST)>0)
{    
    include('connection.php');  
     
     $FirstName = $_POST['FirstName'];
     $LastName = $_POST['LastName'];
     $Email = $_POST['Email'];
     $phone_number = $_POST['phone_number'];
     $Address = $_POST['Address'];
     $country = $_POST['country'];
     $da=date("Y/m/d");
     $ua=date("Y/m/d");
   
     if(!empty($_POST)){
 
      $query = "INSERT INTO customer_info(FirstName,LastName,Email,phone_number,Address,country,create_at,update_at)
      VALUES ('$FirstName','$LastName','$Email','$phone_number','$Address','$country','$da','$ua')";
      $result = mysqli_query($con, $query); 
     echo 1;
     }else{ 
     echo 0;
     }
}
?>

