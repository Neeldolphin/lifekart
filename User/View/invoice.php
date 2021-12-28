<?php 
 include '../Model/class.php';
 require_once "../vendor/autoload.php";  
session_start();
    class MYPDF extends TCPDF {

        //Page header
        public function Header() {
            // Logo
            $image_file = '../images/logo1.png';
            $this->Image($image_file, 10, 5, 40, '', 'PNG', '', 'T', false, 350, '', false, false, 0, false, false, false);
            // Set font
            $this->SetTextColor(143, 255, 0);
            $this->SetFont('times', 'B', 18);
            $data0 = 'INVOICE';
            // Title
            $this->writeHTMLCell(75,30,150,7, $data0, 0, 0, 0, true, 'L', true);

            $this->SetTextColor(0, 0, 0);
            $this->SetFont('times', '', 12);
            $data = 'Order # 1000019214<br>Order Date : '.date('Y-m-d').'';
            // Title
            $this->writeHTMLCell(75,30,150,15, $data, 0, 0, 0, true, 'L', true);
        }
    
        public function CreateTextBox($textval, $x = 0, $y, $width = 0, $height = 10, $fontsize = 10, $fontstyle = '', $align = 'L') {
            $this->SetXY($x, $y); 
            $this->SetFont(PDF_FONT_NAME_MAIN, $fontstyle, $fontsize);
            $this->Cell($width, $height, $textval, 0, false, $align);
        }
    
        public function Footer() {
            $this->SetY(-15);
            $this->SetFont('helvetica', 'I', 8);
            $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        }
    }
    
    // create new PDF document
    $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    
    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
    
    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    
    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    
    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP+10, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    
    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_TOP);
    
    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    
    
    $pdf->SetFont('times','', 12);
    $pdf->AddPage();
    
    $top_column1 = '';
    $top_column2 = '';
    
    $top_column3 = '<p>'.$_SESSION['firstname'].'  '.$_SESSION['lastname'].'<br>'.$_SESSION['address'].'<br>'.$_SESSION['country'].'<br>780454</p>';
    
    // writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
    $pdf->SetFillColor(223, 255,0);
    $pdf->SetTextColor(0, 63, 127);
    
    $pdf->writeHTMLCell(85, 10, '', 35, $top_column1, 0, 0, 1, true, 'L', true);
    $pdf->writeHTMLCell(95, 10, 100, 35, $top_column2, 0, 0, 1, true, 'L', true);
    
    $pdf->SetFillColor(223, 255, 0);
    $pdf->SetTextColor(0, 63, 127);
    
    
    $pdf->writeHTMLCell(180, 25,'', 45, $top_column3, 0, 1, 1, true, 'L', true);
    $pdf->writeHTMLCell(0, 25,100, 45, $top_column3, 0, 1, 1, true, 'L', true);
    
    
    ////////////////////////////////////////////////////////////////////////////
    
    $pdf->SetFillColor(255, 255, 200);
    $pdf->SetTextColor(0, 63, 127);
    
    $pdf->CreateTextBox('Bill to:', 15, 30, 120, 20, 14);
    $pdf->CreateTextBox('Ship to:', 100, 30, 120, 20, 14);

    $content = '';  
       $content .= '  
       <table border="1" cellspacing="1" cellpadding="5">  
                        <thead> 
                        <tr color = "#003F7F" bgcolor = "#DFFF00" >  
                            <th width="25%">Product Name</th>
                            <th width="25%">Price</th>
                            <th width="25%">Qty</th>
                            <th width="25%">Subtotal</th>
                        </tr>
                        </thead>  
      ';     
       $content .= '<tbody>
                ';
                    $index=0;
                    $shipping=0;
                   $total=0;
                   $session=$_SESSION;
                   $view= new cart();
                   $rows=$view->view_cart($session);
                   if(!empty($_SESSION['cart'])){
                    foreach($rows as $row){
                        $cate=new product_details();
                                  $ows=$cate->group_customer();
                                  if(in_array($row['SKU'],$ows)){
                                   $SKU=$row['SKU'];
                                   $gprice=$cate->group_price($SKU);
                                   $row['price']=$gprice[0];
                                  }
                                   $row['price']=$view->product_discount($row['Id'],$session,$row['price']);
                        $content .= '
                       <tr>
                       <td>'.$row['pname'].'</td>
                       <td>'.number_format($row['price'], 2).'</td>
                       <td>'.$_SESSION['qty'][$index].'</td>
                       <input type="hidden" name="indexes[]"  value="'. $index .'">
                       <td>'.number_format($_SESSION['qty'][$index]*$row['price'], 2).'</td>
                       ';
                       $total+=$_SESSION['qty'][$index]*$row['price'];
                        if(isset($_SESSION['coupen_discount'])){ 
                        $coupen =$total-($total*$_SESSION['coupen_discount'])/100; 
                       $discount =($total*$_SESSION['coupen_discount'])/100;
                        }
                       $content .= '
                   </tr>
                   ';
                   $index ++;
               }
            }
            $content .= '
        <tr>
        ';
        $content .= '
        <td colspan="3" align="right"><b>Total  </b></td>
        <td><b>'. number_format($total, 2).'</b></td>
         </tr>
         <tr>
         ';  
        if(isset($discount)){ 
            $content .= '
           <td colspan="3" align="right"><b>Discount</b></td>
           <td><b>'.number_format($discount, 2).'</b></td>
            '; 
             }
        $content .= '
           </tr>
           <tr>
           ';
           if(isset($coupen)){ 
            $content .= '
            <td colspan="3" align="right"><b>Paiable Amount</b></td>
           <td><b>'. number_format($coupen, 2).'</b></td>
           ';
         }
           $content .= '
       </tr>
       </tbody>
       ';   
      $content .= '</table>';  
      
      $pdf->SetFillColor(218, 247, 166) ;
      $pdf->SetTextColor(0, 63, 127);
      
      $pdf->writeHTMLCell(180,'','',80, $content, 0, 0, 1, true, 'J', true);

    $pdf->Output('example.pdf', 'I');

    $customer_id=$_SESSION['id'];
$p_id=$_SESSION['cart'];
$product_id=implode(",",$p_id);
$dataentry= new cart();
$entry=$dataentry->order_placed($customer_id,$product_id);
    
  ?>