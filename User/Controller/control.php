<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
include '../Model/class.php';
session_start();

$action_id=$_POST['action'];

class action{
    public function getAction($action_id)
    {
        switch ($action_id) {
            case 'productdetail':
                return $this->productDetail();
                break;
                case 'coupen_apply':
                    return $this->coupenApply();
                    break;
                    case 'coupen_remove':
                        return $this->coupenRemove();
                        break;
                        case 'qty_check':
                            return $this->qtyCheck();
                            break;
                            case 'qty_check2':
                                return $this->qtyCheck2();
                                break;
                            case 'on_search':
                                return $this->onSearch();
                                break;
                                case 'clear_cart':
                                    return $this->clear_Cart();
                                    break;
                                    case 'delete_Item':
                                        return $this->DeleteItem();
                                        break;
                                        case 'customer_update':
                                            return $this->customerUpdate();
                                            break;

                default:
            
                break;
        }

    }

public function productDetail()
{
    if(!isset($_SESSION['cart'])){
		$_SESSION['cart'] = array();
	}

	if(!in_array($_POST['msg'], $_SESSION['cart'])){
		array_push($_SESSION['cart'], $_POST['msg']);
        $key= count($_SESSION['qty']);
        $_SESSION['qty'][$key] = $_POST['quantity'];   
    }
    else{
             $key=array_search($_POST['msg'],$_SESSION['cart']);
             $_SESSION['qty'][$key] += $_POST['quantity'];  
        }
header("location: ../View/view_cart.php?id=".$_SESSION['id']);
}

public function coupenApply()
{
    $coupen =$_POST['coupen_code'];
    $view= new cart();
   $array=$view->coupen_view($coupen);
   if ($array != '') {
       $_SESSION['coupen_name']=$array[1];
       $_SESSION['coupen_discount']=$array[2];
       echo 1;
       }else{
           echo 2;
       }
}

public function coupenRemove()
{
    unset($_SESSION['coupen_name']);
		unset($_SESSION['coupen_discount']);
}

public function qtyCheck()
{   $value=$_POST['value'];
    $id = (int)$_POST['id'];
    $check= new cart();
    $array=$check->qty_check($id);
    if (in_array($_POST['id'],$_SESSION['cart'])){
        
        $key=array_search($_POST['id'],$_SESSION['cart']);
        $value += $_SESSION['qty'][$key];
    }
    if($array[0]<$value){
           echo 1;
       }else if($value==0){
        echo 1;
         }else{
           echo 2;
       }
}

public function qtyCheck2()
{   $value=$_POST['value'];
    $id = (int)$_POST['id'];
    $check= new cart();
    $array=$check->qty_check($id);
    if($array[0]<$value){
           echo 1;
       }else if($value==0){
        echo 1;
         }else{
           echo 2;
       }
}

public function onSearch()
{
        $Name = $_POST['search'];
        $search=new product_details();
        $array=$search->search_item($Name);
          echo json_encode($array); 
}

public function clear_Cart()
{
    unset($_SESSION['cart']);
	unset($_SESSION['coupen_name']);
    unset($_SESSION['coupen_discount']);
	unset($_SESSION['qty']);
    header('location: ../View/view_cart.php?id='.$_SESSION['id']);
}

public function DeleteItem()
{
    	//remove the id from our cart array
	$key = array_search($_POST['id'], $_SESSION['cart']);	
	unset($_SESSION['cart'][$key]);

	unset($_SESSION['qty'][$_POST['index']]);
	//rearrange array after unset
    $_SESSION['cart'] = array_values($_SESSION['cart']);
	$_SESSION['qty'] = array_values($_SESSION['qty']);
    header('location: ../View/view_cart.php?id='.$_SESSION['id']);
}

public function customerUpdate()
{
        $post=$_POST;
        $update = new log_in();
        $update->update($post);
}

}
$action = new action();
$action->getAction($action_id);

?>