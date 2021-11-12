<?php
include 'connection.php';
include 'class.php';
                     $id = (int)$_POST['id'];
                     $check= new cart();
                     $array=$check->qty_check($id);
                        if($array[0]<$_POST['value']){
                            echo 1;
                        }
                    ?>

