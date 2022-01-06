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
                            case 'deletecustomer_group_price':
                                return $this->deleteCustomerGroupPrice();
                                break;
                                case 'single_view':
                                    return $this->singleView();
                                    break;
                            case 'single_remove':
                                return $this->removeImage();
                                break;
                                case 'video_pop':
                                    return $this->videoDisplay();
                                    break;
                                    case 'customer_pop':
                                        return $this->customerDisplay();
                                        break;
                                case 'export_csv':
                                    return $this->exportCSV();
                                    break;
                                    case 'import_csv':
                                        return $this->importCSV();
                                        break;
                                        case 'delete_csv':
                                            return $this->deleteCSV();
                                            break;
                                            case 'select_delete_csv':
                                                return $this->selectdeleteCsv();
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
                                                case 'order_search_info':
                                                    return $this->OrderSearchInfo();
                                                    break;
                                                case 'customer_group_insert':
                                                    return $this->insertCustomerGroup();
                                                    break;
                                                    case 'customer_group_edit':
                                                        return $this->editCustomerGroup();
                                                        break;
                                                        case 'customer_group_update':
                                                            return $this->updateCustomerGroup();
                                                            break;
                                                            case 'customer_group_delete':
                                                                return $this->deleteCustomerGroup();
                                                                break;
                                                                case 'select_delete_group':
                                                                    return $this->selectdeleteGroup();
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
                                                                                                case 'order_pop':
                                                                                                    return $this->order_pop();
                                                                                                    break;
            
            default:
            
                break;
        }

    }

    public function insertProductDetail(){
   
        $pname = $_POST['pname'];
        $category = $_POST['category'];
        $SKU = $_POST['sku'];
        $price = $_POST['Price'];
        $description = $_POST['Description'];
        $qty = $_POST['QTY'];
        $Status = $_POST['Status'];
        $create_at=date("Y/m/d");
        $update_at=date("Y/m/d");
        $customergroup=$_POST['CustomerGroup'];
        $customergroupprice=$_POST['CustomerGroupPrice'];
        $files = $_FILES;
        $image = new product();
        $image->insert($files,$pname,$category,$SKU,$price,$description,$qty,$Status,$create_at,$update_at);
        $image->insert2($customergroup,$customergroupprice,$SKU);
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
            $SKU = $_POST['esku'];
            $customergroup=$_POST['eCustomerGroup'];
            $customergroupprice=$_POST['eCustomerGroupPrice'];
            $files=$_FILES;
            $post=$_POST;
            $update = new product();
            $update->update($files,$post,$create_at,$update_at);   
            $update->update2($customergroup,$customergroupprice,$SKU); 
        }
    }

    public function deleteProductDetail(){
        $id = $_POST['id'];
        $delete=new product();
        $delete->delete($id);
        echo 1;

    }
    public function deleteCustomerGroupPrice(){
        $id = $_POST['id'];
        $delete=new product();
        $delete->deleteprice($id);
        echo 1;

    }
    public function removeImage(){
        $post = $_POST;
        $remove=new product();
        $remove->removeimage($post);
        echo 1;
    }

    public function singleView(){
        $id = $_POST['id'];
        $View=new product();
        $View->disImg($id);
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


    public function insertCustomerGroup()
    {
        if(count([$_POST])>0){
            $CustomerGroup = $_POST['CustomerGroup'];
            $customerGroup_insert = new customer();
            $customerGroup_insert->customerGrpinsert($CustomerGroup);
            }
    }
    
    public function OrderSearchInfo()
    {
        
    }

    public function editCustomerGroup()
    {
        $id = $_POST['id'];
        $edit =new customer();
       $edit->customerGrpedit($id);
    }

    public function updateCustomerGroup()
    {
        if(!empty($_POST['id'])){
            $post=$_POST;
            $update = new customer();
            $update->customerGrpupdate($post);
        echo 1;
        }
    }

    public function deleteCustomerGroup()
    {
        $id = $_POST['id'];
        $delete=new customer();
        $delete->customerGrpdelete($id);
        echo 1;
    }

    public function selectdeleteGroup()
    {
        $post=$_POST;
        $delete=new customer();
        $delete->SelectDeleteGroup($post);
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
            $CustomerGroup = $_POST['customerGroup'];
            $create_at=date("Y/m/d");
            $update_at=date("Y/m/d");
            $customer_insert = new customer();
            $customer_insert->insert($FirstName,$LastName,$Email,$phone_number,$Address,$country,$CustomerGroup,$create_at,$update_at);
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

    public function order_pop()
    {
        $id = $_POST['id'];
        $edit =new cart();
        $edit->OrderInfo($id);
    }

    public function exportCSV()
    {       
            $post=$_POST;
            $export=new product();
            $export->ExportCsv($post);
    }

    public function importCSV()
    {
            $files=$_FILES;
            $import=new product();
            $import->ImportCsv($files);
    }
    public function deleteCSV()
    {
        $files=$_FILES;
        $delete=new product();
        $delete->DeleteCsv($files);
    }

    public function selectdeleteCsv()
    {
        
        $post=$_POST;
        $delete=new product();
        $delete->SelectDeleteCsv($post);
    }

    public function videoDisplay(){
        $id = $_POST['id'];
        $change =new product();
        $change->displayVideo($id);
    }
    public function customerDisplay(){
        $id = $_POST['id'];
        $change =new customer();
        $change->CustomerDisplay($id);
    }
}


$action = new action();
$action->getAction($action_id);
?>