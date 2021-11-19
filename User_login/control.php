<?php 
include 'class.php';
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
                            case 'on_search':
                                return $this->onSearch();
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
	}
	$key= count($_SESSION['qty']);
	$_SESSION['qty'][$key] = $_POST['quantity'];


header("location: view_cart.php?id=".$_SESSION['id']);
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
{   
    $id = (int)$_POST['id'];
    $check= new cart();
    $array=$check->qty_check($id);
       if($array[0]<$_POST['value']){
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


}
$action = new action();
$action->getAction($action_id);

?>