<?php
include 'connection.php';
                     $id = (int)$_POST['id'];
                    $query="select qty from Product_info where id=".$id; 
				        $result=mysqli_query($con,$query);
                       $array= mysqli_fetch_array($result);
                        if($array[0]<$_POST['value']){
                            echo 1;
                        }
                    ?>

