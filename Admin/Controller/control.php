<?php 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
include '../Model/class.php';

$action_id=$_POST['action'];

class action{
    public function getAction($action_id)
    {
        switch ($action_id) {
            case 'product_details':
                return $this->insertProductDetail();
                break;
                case 'product_change':
                    return $this->changeProductDetail();
                    break;
                    case 'product_update':
                        return $this->updateProductDetail();
                        break;
                        case 'product_delete':
                            return $this->deleteProductDetail();
                            break;
                            case 'single_remove':
                                return $this->removeImage();
                                break;
                                case 'image_details':
                                    return $this->insertImageDetails();
                                    break;
                                    case 'image_edit':
                                        return $this->editImageDetail();
                                        break;
                                        case 'image_update':
                                            return $this->updateImageDetail();
                                            break;
                                            case 'image_delete':
                                                return $this->deleteImageDetail();
                                                break;
                                                case 'customer_details':
                                                    return $this->insertCustomerDetails();
                                                    break;
                                                    case 'customer_edit':
                                                        return $this->editCustomerDetail();
                                                        break;
                                                        case 'customer_update':
                                                            return $this->updateCustomerDetail();
                                                            break;
                                                            case 'customer_delete':
                                                                return $this->deleteCustomerDetail();
                                                                break;
                                                                case 'category_details':
                                                                    return $this->insertCategoryDetails();
                                                                    break;
                                                                    case 'category_edit':
                                                                        return $this->editCategoryDetail();
                                                                        break;
                                                                        case 'category_update':
                                                                            return $this->updateCategoryDetail();
                                                                            break;
                                                                            case 'category_delete':
                                                                                return $this->deleteCategoryDetail();
                                                                                break;
                                                                                case 'coupen_details':
                                                                                    return $this->insertCoupenDetails();
                                                                                    break;
                                                                                    case 'coupen_edit':
                                                                                        return $this->editCoupenDetail();
                                                                                        break;
                                                                                        case 'coupen_update':
                                                                                            return $this->updateCoupenDetail();
                                                                                            break;
                                                                                            case 'coupen_delete':
                                                                                                return $this->deleteCoupenDetail();
                                                                                                break;
            
            default:
            
                break;
        }

    }

    public function insertProductDetail(){
        $pname = $_POST['pname'];
        $category = $_POST['category'];
        $SKU = $_POST['sku'];
        $image = $_POST['image'];
        $price = $_POST['Price'];
        $description = $_POST['Description'];
        $Video = $_POST['Video'];
        $qty = $_POST['QTY'];
        $Status = $_POST['Status'];
        $create_at=date("Y/m/d");
        $update_at=date("Y/m/d");
        $files = $_FILES;
        $image = new product();
        $image->insert($files,$pname,$category,$SKU,$price,$description,$qty,$Status,$create_at,$update_at);
    }

    public function changeProductDetail(){
        $id = $_POST['id'];
        $change =new product();
        $change->edit($id);
    }
    public function updateProductDetail(){
        if(!empty($_POST['eid'])){
            $create_at=date("Y/m/d");
            $update_at=date("Y/m/d");
            $files=$_FILES;
            $post=$_POST;
            $update = new product();
            $update->update($files,$post,$create_at,$update_at);   
        }
    }

    public function deleteProductDetail(){
        $id = $_POST['id'];
        $delete=new product();
        $delete->delete($id);
        echo 1;

    }
    public function removeImage(){
        $post = $_POST;
        $remove=new product();
        $remove->removeimage($post);
        echo 1;

    }

    public function insertImageDetails()
    {
        $post=$_POST;
        $files=$_FILES;
        $image_insert=new carousel();
        $image_insert->insertcarousel($post,$files);

    }
    public function editImageDetail()
    {
        $post=$_POST;
        $image_edit=new carousel();
        $image_edit->editcarousel($post);
    }
    public function updateImageDetail()
    {
        $post=$_POST;
        $files=$_FILES;
        $image_update=new carousel();
        $image_update->updatecarousel($post,$files);
    }
    public function deleteImageDetail()
    {
        $post=$_POST;
        $image_insert=new carousel();
        $image_insert->deletecarousel($post);
    }


    public function insertCustomerDetails()
    {
        if(count([$_POST])>0){
            $FirstName = $_POST['FirstName'];
            $LastName = $_POST['LastName'];
            $Email = $_POST['Email'];
            $phone_number = $_POST['phone_number'];
            $Address = $_POST['Address'];
            $country = $_POST['country'];
            $create_at=date("Y/m/d");
            $update_at=date("Y/m/d");
            $customer_insert = new customer();
            $customer_insert->insert($FirstName,$LastName,$Email,$phone_number,$Address,$country,$create_at,$update_at);
            }
    }
    public function editCustomerDetail()
    {
        $id = $_POST['id'];
        $edit =new customer();
       $edit->edit($id);
    }
    public function updateCustomerDetail()
    {
        if(!empty($_POST['Id'])){
            $create_at=date("Y/m/d");
            $update_at=date("Y/m/d");
            $post=$_POST;
            $update = new customer();
            $update->update($post,$create_at,$update_at);
        echo 1;
        }
    }
    public function deleteCustomerDetail()
    {
        $id = $_POST['id'];
        $delete=new customer();
        $delete->delete($id);
        echo 1;
    }


    public function insertCategoryDetails()
    {
        $CName = $_POST['cname'];
        $image = $_POST['image'];
        $description = $_POST['description'];
        $create_at=date("Y/m/d");
        $update_at=date("Y/m/d");
       $files = $_FILES;
       $image = new category();
       $image->insert($files,$CName,$image,$description,$create_at,$update_at);
        
    }
    public function editCategoryDetail()
    {
        $id = $_POST['id'];
        $edit =new category();
        $edit->edit($id);
    }
    public function updateCategoryDetail()
    {
        if(!empty($_POST['eid'])){
    

            $create_at=date("Y/m/d");
            $update_at=date("Y/m/d");
            $files=$_FILES;
            $post=$_POST;
            $update = new category();
            $update->update($files,$post,$create_at,$update_at);
            echo 1;
        
        }   
    }
    public function deleteCategoryDetail()
    {
        $id = $_POST['id'];
        $delete=new category();
        $delete->delete($id);
        echo 1;
    }


    public function insertCoupenDetails()
    {
        if(count([$_POST])>0){
            $CoupenCode = $_POST['CoupenCode'];
            $CoupenDiscount = $_POST['CoupenDiscount'];
            
            $coupen_insert = new coupen();
            $coupen_insert->insert($CoupenCode,$CoupenDiscount);
            }
    }
    public function editCoupenDetail()
    {
        $id = $_POST['id'];
        $edit =new coupen();
        $edit->edit($id);
    }
    public function updateCoupenDetail()
    {
        if(!empty($_POST['coupen_id'])){
            $post=$_POST;
            $update = new coupen();
            $update->update($post);
        echo 1; 
        }  
    }
    public function deleteCoupenDetail()
    {
        $id = $_POST['id'];
        $delete=new coupen();
        $delete->delete($id);
        echo 1;
    }


}


$action = new action();
$action->getAction($action_id);
?>