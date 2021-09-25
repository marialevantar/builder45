<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Billing extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	 public function __construct() {
 			 parent::__construct();
 			 $this->load->library('session');
 			 $this->load->database();
 			 $this->load->model('Tailor_model');
 			 $this->load->model('Customer_model');
 			 $this->load->model('Work_model');
 			 $this->load->model('Tailors');
 			 $this->load->model('Billing_model');
 			 $this->load->model('Boutique');

			 $this->load->helper(array('cookie', 'admin'));
 			 
 			 $this->load->library('zend');
        	 $this->zend->load('Zend/Barcode');

 			if(!$this->session->userdata('UserID') || $this->session->userdata('UserRole') != 2 || $this->session->userdata('BoutiqueBillingStatus') != 1){
 				redirect(base_url().'login/', 'refresh');
 			}
 			 
  	}

    /*****************Starts Sale*****************/

    public function addsale(){

    	$id = $this->uri->segment(3);
    	
    	$getsales = $this->Billing_model->getlastsale();
    	
    	if(!@$getsales[0]['boutique_sale_invoice_number']){
    		$data["invoiceid"] = 1200 + @$getsales[0]['boutique_sale_invoice_number'] + 1;
    	}
    	else{
    		$data["invoiceid"] = $getsales[0]['boutique_sale_invoice_number'] + 1;
    	}

    	if(!@$getsales[0]['boutique_sale_invoice_gstnumber']){
    		$data["gstinvoiceid"] = 2000 + @$getsales[0]['boutique_sale_invoice_gstnumber'] + 1;
    	}
    	else{
    		$data["gstinvoiceid"] = $getsales[0]['boutique_sale_invoice_gstnumber'] + 1;
    	}
    	
    	if(@$id){
  			$data["sale"] = $this->Billing_model->m_getsaledetails($id);
  			$data["saleitems"] = $this->Billing_model->m_getallsaleitems($id);
  	    }
  	    else{
  	    	$data["sale"] = array();
  	    	$data["saleitems"] = array();
  	    }
    	$data["expencecategory"] = $this->Billing_model->getexpencecategories();
    	$data['boutiquedetails'] = $this->Boutique->getBoutique($this->session->userdata('BoutiqueID'));
        $data["customers"] = $this->Customer_model->m_getallcustomers();
		$this->load->view('billing/header');
		$this->load->view('billing/addsale',@$data);
		$this->load->view('billing/footer');
	}

    public function getProduct(){
        $sku=$this->input->post('sku');
        //$sku="1234";
        $data = $this->Billing_model->getSkuItem($sku);
        echo $data;
        //echo '{"sku":"Worked","value2":"test"}';
    }
    public function saveinvoice(){
       print_r($_POST);
    }

    /*****************ENDS SALE*****************/
    public function viewCustomer(){

        $cid=$this->input->post('cid');
        $cust = $this->Billing_model->m_loadcustomers($cid);
        echo $cust;
    }



    /*****************Starts Tax Rate*****************/
	public function tax(){
		$data["tax"] = $this->Billing_model->getTaxrate();
		$this->load->view('billing/header');
		$this->load->view('billing/tax',@$data);
		$this->load->view('billing/footer');
	}
        public function addtax(){

    	$data["tax"] = $this->Billing_model->getTaxrate();
		$this->load->view('billing/header');
		$this->load->view('billing/addtax',@$data);
		$this->load->view('billing/footer');
	}
    public function savetax(){

		$this->Billing_model->addTaxRate();
		$data["tax"] = $this->Billing_model->getTaxrate();
		$this->session->set_flashdata('notification', 'New Tax Slab Added..');
		$this->session->set_flashdata('status', 'success');
		$this->load->view('billing/header');
		$this->load->view('billing/tax',@$data);
		$this->load->view('billing/footer');
	}
    public function removetax($id){

		//$id = $this->uri->segment(3);
		$this->Billing_model->removeTaxRate($id);
		$this->session->set_flashdata('notification', 'Tax Slab deleted!');
		$this->session->set_flashdata('status', 'danger');
		redirect(base_url().'billing/tax/', 'refresh');
	}
/***************Ends Tax Rate***********************/
/*****************Starts Expence Category*****************/
	public function expencecategory(){
		$data["expencecategory"] = $this->Billing_model->getexpencecategories();
		$data["customers"] = $this->Customer_model->m_getallcustomers();
		$this->load->view('billing/header');
		$this->load->view('billing/expencecategories',@$data);
		$this->load->view('billing/footer');
	}
        public function addexpencecategory(){

    	$data["expencecategory"] = $this->Billing_model->getexpencecategories();
		$this->load->view('billing/header');
		$this->load->view('billing/addexpencecategory',@$data);
		$this->load->view('billing/footer');
	}
    public function saveexpencecategory(){

		$this->Billing_model->addexpencecategories();
		$data["expencecategory"] = $this->Billing_model->getexpencecategories();
        $data["customers"] = $this->Customer_model->m_getallcustomers();
		$this->session->set_flashdata('notification', 'Expence Category added successfully!');
		$this->session->set_flashdata('status', 'success');
		$this->load->view('billing/header');
		$this->load->view('billing/expencecategories',@$data);
		$this->load->view('billing/footer');
	}
    public function removeexpencecategory($id){

		//$id = $this->uri->segment(3);
		$this->Billing_model->removeexpencecategory($id);
		$this->session->set_flashdata('notification', 'Expence Category deleted!');
		$this->session->set_flashdata('status', 'danger');
		redirect(base_url().'billing/expencecategory/', 'refresh');
	}
/***************Ends Expence Category***********************/
	public function expences(){
		$data["expences"] = $this->Billing_model->getexpences();
		$this->load->view('billing/header');
		$this->load->view('billing/expences',@$data);
		$this->load->view('billing/footer');
	}
    
    public function addexpence(){

    	$data["expencecategory"] = $this->Billing_model->getexpencecategories();
		$this->load->view('billing/header');
		$this->load->view('billing/addexpence',@$data);
		$this->load->view('billing/footer');
	}

	public function saveexpence(){

		$this->Billing_model->addexpence();
		$data["expences"] = $this->Billing_model->getexpences();
		$this->session->set_flashdata('notification', 'Expence added successfully!');
		$this->session->set_flashdata('status', 'success');
		$this->load->view('billing/header');
		$this->load->view('billing/expences',@$data);
		$this->load->view('billing/footer');
	}  

	public function updateexpence(){

		$this->Billing_model->updateexpence();
		$this->session->set_flashdata('notification', 'Expence updated Sucessfully!');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url().'billing/expencedetails/'.$this->input->post('boutique_expense_id'), 'refresh');
	} 

	public function removeexpence(){

		$id = $this->uri->segment(3);
		$this->Billing_model->removeexpence($id);
		$this->session->set_flashdata('notification', 'Expence deleted!');
		$this->session->set_flashdata('status', 'danger');
		redirect(base_url().'billing/expences/', 'refresh');
	}

	public function expencedetails(){

		$id = $this->uri->segment(3);
		$data["expences"] = $this->Billing_model->getexpencesdetails($id);
		$data["expencecategory"] = $this->Billing_model->getexpencecategories();
		$this->load->view('billing/header');
		$this->load->view('billing/expencedetails',@$data);
		$this->load->view('billing/footer');
	}

	public function additem(){

		$data["taxes"] = $this->Billing_model->gettaxes();
		$this->load->view('billing/header');
		$this->load->view('billing/additem',@$data);
		$this->load->view('billing/footer');
	}
	
	public function items(){
		$data["items"] = $this->Billing_model->getitems();
		$this->load->view('billing/header');
		$this->load->view('billing/items',@$data);
		$this->load->view('billing/footer');
	}

	public function saveitem(){

		if(@$_FILES['boutique_item_image']['name']){
			@$image = @basename($_FILES['boutique_item_image']['name']);
			@$extension  = strtolower(pathinfo($image,PATHINFO_EXTENSION));
			@$newfileName = time().rand()."." . $extension;
			$uploaddir = $this->config->item('project_path')."uploads/items/";
			$uploadfile = $uploaddir . $newfileName;
			if (@move_uploaded_file(@$_FILES['boutique_item_image']['tmp_name'], $uploadfile)) {
				$this->Billing_model->additem($newfileName);
			}
		}
		else{
			$newfileName = '';
			$this->Billing_model->additem($newfileName);
		}
		
		$this->session->set_flashdata('notification', 'New Item added successfully!');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url().'billing/items/', 'refresh');
	}

	public function removeitem(){

		$id = $this->uri->segment(3);
		$this->Billing_model->removeitem($id);
		$this->session->set_flashdata('notification', 'Expence deleted!');
		$this->session->set_flashdata('status', 'danger');
		redirect(base_url().'billing/items/', 'refresh');
	}

	public function itemdetails(){

		$id = $this->uri->segment(3);
		$data["item"] = $this->Billing_model->getitemdetails($id);
		$data["taxes"] = $this->Billing_model->gettaxes();
		$this->load->view('billing/header');
		$this->load->view('billing/itemdetails',@$data);
		$this->load->view('billing/footer');
	}

	public function updateitem(){

		$id = $this->input->post('boutique_item_id');
		@$image = @basename($_FILES['boutique_item_image']['name']);
		if($image) {
			@$extension  = strtolower(pathinfo($image,PATHINFO_EXTENSION));
			@$newfileName = time().rand()."." . $extension;
			$uploaddir = $this->config->item('project_path')."uploads/items/";
			$uploadfile = $uploaddir . $newfileName;
		}
		if(@$newfileName != "") {
			move_uploaded_file(@$_FILES['boutique_item_image']['tmp_name'], $uploadfile);
		}
		else{
			$newfileName = $this->input->post('boutique_item_image');
		}
		$this->Billing_model->updateitem($id,$newfileName);
		$this->session->set_flashdata('notification', 'Item updated successfully!');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url().'billing/itemdetails/'.$id, 'refresh');
	}

	public function addstock(){
		$id = $this->uri->segment(3);
		$data["item"] = $this->Billing_model->getitemdetails($id);
		$this->load->view('billing/header');
		$this->load->view('billing/addstock',@$data);
		$this->load->view('billing/footer');
	}

	public function addsalepayment(){
		$data['saleid'] = $this->uri->segment(3);
		$this->load->view('billing/header');
		$this->load->view('billing/addsalepayment',$data);
		$this->load->view('billing/footer');
	}

	public function savesalepayment(){
		$this->Billing_model->savesalepayment();
		$this->session->set_flashdata('notification', 'Sale payment updated!');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url().'billing/sales', 'refresh');
	}

	public function updateitemstock(){

		$this->Billing_model->updateitemstock();
		$this->session->set_flashdata('notification', 'Stock updated Sucessfully!');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url().'billing/addstock/'.$this->input->post('boutique_item_id'), 'refresh');
	} 

	public function expencereport(){
		$data["date_from_report"] = $this->input->post('date_from_report');
		$data["date_to_report"] = $this->input->post('date_to_report');
		$data["expences"] = $this->Billing_model->getexpencesreport();
		$arr = $data["expences"];
		$data["total_expences"] = array_sum(array_map(function($item) { 
    		return $item['boutique_expense_amount']; 
		}, $arr));

		$this->load->view('billing/header');
		$this->load->view('billing/expences-reports',@$data);
		$this->load->view('billing/footer');
	}

	public function salereport(){

		$data["date_from_report"] = $this->input->post('date_from_report');
		$data["date_to_report"] = $this->input->post('date_to_report');
		$data["sale"] = $this->Billing_model->getsalereport();
		$arr = $data["sale"];
		$data["total_sale"] = array_sum(array_map(function($item) { 
    		return $item['boutique_sale_price']; 
		}, $arr));

		$this->load->view('billing/header');
		$this->load->view('billing/sale-reports',@$data);
		$this->load->view('billing/footer');
	}
	
	public function gstreport(){

		$data["date_from_report"] = $this->input->post('date_from_report');
		$data["date_to_report"] = $this->input->post('date_to_report');
		$data["sale"] = $this->Billing_model->getgstreport();
		$arr = $data["sale"];
		$data["total_sale"] = array_sum(array_map(function($item) { 
    		return $item['boutique_sale_price']; 
		}, $arr));

		$this->load->view('billing/header');
		$this->load->view('billing/gst-reports',@$data);
		$this->load->view('billing/footer');
	}

	public function profitreport(){
		
		$data["date_from_report"] = $this->input->post('date_from_report');
		$data["date_to_report"] = $this->input->post('date_to_report');
		$data["expences"] = $this->Billing_model->getexpencesreport();
		$arr = $data["expences"];
		$data["total_expences"] = array_sum(array_map(function($item) { 
    		return $item['boutique_expense_amount']; 
		}, $arr));
		$data["sale"] = $this->Billing_model->getsalereport();
		$arr = $data["sale"];
		$data["total_sale"] = array_sum(array_map(function($item) { 
    		return $item['boutique_sale_price']; 
		}, $arr));
		$this->load->view('billing/header');
		$this->load->view('billing/profit-reports',@$data);
		$this->load->view('billing/footer');
	}

	public function managestock(){
		$data["items"] = $this->Billing_model->getitems();
		$this->load->view('billing/header');
		$this->load->view('billing/itemstocks',@$data);
		$this->load->view('billing/footer');
	}

	public function sales(){
		$data["sales"] = $this->Billing_model->getsales();
		$this->load->view('billing/header');
		$this->load->view('billing/sales',@$data);
		$this->load->view('billing/footer');
	}

	public function removesale(){

		$id = $this->uri->segment(3);
		$this->Billing_model->removesale($id);
		$this->session->set_flashdata('notification', 'Sale deleted successfully!');
		$this->session->set_flashdata('status', 'danger');
		redirect(base_url().'billing/sales/', 'refresh');
	}

	public function savesale(){
		$saleid = $this->Billing_model->addsale();
		if($this->session->userdata('BoutiqueID') == 21){
			$this->sendStatusMessageSMS($saleid);
		}
		$this->session->set_flashdata('notification', 'Sale added successfully!');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url().'billing/addsale/'.$saleid, 'refresh');
	}
    
    public function sendStatusMessageSMS($saleid){
		$username="boutiquemanagerin";
		$password ="Boutique@123#";
		$sender="BTQMNG";

		$boutique = $this->Work_model->m_getboutiquedetails();
		$orderdetails = $this->Work_model->m_getsalecusdetails($saleid);
		$number=$orderdetails['boutique_customer_ph'];
		  if(@$number && $this->input->post('boutique_item_id')){

		  	$customer = $orderdetails['boutique_customer_name'] ? ucwords($orderdetails['boutique_customer_name']) : 'Customer';
			$boutiquename = $boutique['boutique_name'];

			
				$message = "Dear ".$customer.", \r\n \r\n";
				$message.= "Greetings from ".$boutiquename." !\r\n \r\n";
				$message.= "Your order no ".$orderdetails['boutique_sale_invoice_number']." has been placed with amount ".$orderdetails['boutique_sale_price'].".\r\n \r\n";
				$message.= "Thank you for doing business with us.";
			
			$url="login.bulksmsgateway.in/sendmessage.php?user=".urlencode($username)."&password=".urlencode($password)."&mobile=".urlencode($number)."&sender=".urlencode($sender)."&message=".urlencode($message)."&type=".urlencode('3'); 
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$curl_scraped_page = curl_exec($ch);
			curl_close($ch); 
			$this->Work_model->m_addstatusmsg($message,$orderdetails['boutique_customer_id'],$number,$curl_scraped_page);
		  }
		  elseif(@$number && !$this->input->post('boutique_item_id')){
		      $customer = $orderdetails['boutique_customer_name'] ? ucwords($orderdetails['boutique_customer_name']) : 'Customer';
			$boutiquename = $boutique['boutique_name'];

			
				$message = "Dear ".$customer.", \r\n \r\n";
				$message.= "Greetings from ".$boutiquename." !\r\n \r\n";
				$message.= "You have paid amount ".$this->input->post('boutique_sale_amountpaid').".\r\n \r\n";
				$message.= "Thank you for doing business with us.";
			
			$url="login.bulksmsgateway.in/sendmessage.php?user=".urlencode($username)."&password=".urlencode($password)."&mobile=".urlencode($number)."&sender=".urlencode($sender)."&message=".urlencode($message)."&type=".urlencode('3'); 
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$curl_scraped_page = curl_exec($ch);
			curl_close($ch); 
			$this->Work_model->m_addstatusmsg($message,$orderdetails['boutique_customer_id'],$number,$curl_scraped_page);
		  }

		  return TRUE;
	}
	
	public function billthermal(){

		$id = $this->uri->segment(3);
  		$sale = $this->Billing_model->m_getsaledetails($id);
  		$saleitems = $this->Billing_model->m_getallsaleitems($id);
  		$orderdata = '';
  		$i = 0;
	  	
	  	foreach ($saleitems as $key => $saleitem) {
	  		 	$i++;
	  			$orderdata .= '
				<tr>
				<td width="10%">'.@$i.'</td>
				<td width="30%">'.@$saleitem["boutique_sale_item_name"].'</td>
				<td width="20%">'.@$saleitem["boutique_sale_item_totalunitprice"].'</td>
				<td width="15%">'.@$saleitem["boutique_sale_unit"].'</td>
				<td width="25%">'.@(float)$saleitem["boutique_sale_item_totalunitprice"]*@(float)$saleitem["boutique_sale_unit"].'</td>
			    </tr>';
			}

			if($sale['boutique_customer_id'] == 0){
				$customerdetails = $sale['boutique_customer_details'];
			}	
			else{
				$customerdetails ='<b>'.$sale['boutique_customer_name'].'</b><br>
				'.$sale['boutique_customer_address'].'<br>
				Phone:'.$sale['boutique_customer_ph'].'<br>
				Email:'.$sale['boutique_customer_email'].'<br>';
			}

	  		ini_set('max_execution_time', 0); // for infinite time of execution

	  		$this->load->library('Pdf');
	  		
	  		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	  		//$pdf = new TCPDF('P', 'mm', array(100, 300), true, 'UTF-8', false);

			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('Nicola Asuni');
			$pdf->SetTitle($sale['boutique_name']);
			$pdf->SetSubject('INVOICE');
			$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

			// set default header data

			// set header and footer fonts
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

			// set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			    require_once(dirname(__FILE__).'/lang/eng.php');
			    $pdf->setLanguageArray($l);
			}

			// ---------------------------------------------------------

			// set font
			$pdf->SetFont('helvetica', '', 10);

			$pdf->SetPrintHeader(false);
			$pdf->SetPrintFooter(false);
			// Add a page
			// This method has several options, check the source code documentation for more information.

			$pdf->AddPage();
			
			if( $this->session->userdata('BoutiqueID') == 31){
				$logo =	'';
			}
			else{
			    $logo =	'';
			}
			
		

			$html = '<div style="text-align: center;">
	<div style="padding:10px; text-align: center; border: 1px solid #000000"> 

		<table width="100%" style="text-align: center;">
				<tr>
					<td width="100%">
					    <br><br>
						<b>'.@$sale['boutique_name'].'.</b><br>'.
					@$sale['boutique_address'].	'<br>
				Phone: '.@$sale['boutique_ph'].'<br>
				Email: '.@$sale['boutique_email'].'<br>
					</td>
				</tr>
				<tr><td>&nbsp;</td></tr>
			</table>

		<table width="100%" style="text-align: left;">
			<tr>
				<td>GSTIN</td>
				<td>: --------- </td>
			</tr>
		</table>
		<table width="100%" style="text-align: left; padding:10px;">
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td>Bill No</td>
				<td>: '.$sale['boutique_sale_invoice'].'</td>
				<td>Date : '.$sale['boutique_sale_date'].'</td>
			</tr>
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td>Party</td>
				<td colspan="2">: '.$customerdetails.'</td>
			</tr>
		</table>
		<table width="100%" style="text-align: left;">
			<tr>
				<td colspan="5"><hr></td>
			</tr>
			<tr>
				<td width="10%">Sl</td>
				<td width="30%"><b>Name</b></td>
				<td width="20%"><b>Rate</b></td>
				<td width="15%"><b>Qty</b></td>
				<td width="25%"><b>Amount</b></td>
			</tr>
			<tr>
				<td colspan="5"><hr></td>
			</tr>
			'.$orderdata.'
			<tr>
				<td colspan="5">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="5"><hr></td>
			</tr>
			<tr>
				<td colspan="2">Total</td>
				<td colspan="2"></td>
				<td>'.$sale['boutique_sale_price'].'</td>
			</tr>
			<tr>
				<td colspan="5">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="5"><hr style="border:none; border-bottom: 1px; border-style: double;"></td>
			</tr>
		</table>
		<p>Thank You</p>
		<p>Visit Again</p>
	</div>
</div>';

			// Print text using writeHTMLCell()
			$pdf->writeHTML($html, true, false, true, false, '');

			// ---------------------------------------------------------

			// Close and output PDF document
			// This method has several options, check the source code documentation for more information.
			$pdf->Output(time().'.pdf', 'I');

			//============================================================+
			// END OF FILE
			//============================================================+

	}

	public function billthermal1(){

		$id = $this->uri->segment(3);
  		$sale = $this->Billing_model->m_getsaledetails($id);
  		$saleitems = $this->Billing_model->m_getallsaleitems($id);
  		$orderdata = '';
  		$i = 0;
	  	
	  	foreach ($saleitems as $key => $saleitem) {
	  		 	$i++;
	  			$orderdata .= '
				<tr>
				<td width="10%">'.@$i.'</td>
				<td width="30%">'.@$saleitem["boutique_sale_item_name"].'</td>
				<td width="20%">'.@$saleitem["boutique_sale_item_totalunitprice"].'</td>
				<td width="15%">'.@$saleitem["boutique_sale_unit"].'</td>
				<td width="25%">'.@(float)$saleitem["boutique_sale_item_totalunitprice"]*@(float)$saleitem["boutique_sale_unit"].'</td>
			    </tr>';
			}

			if($sale['boutique_customer_id'] == 0){
				$customerdetails = $sale['boutique_customer_details'];
			}	
			else{
				$customerdetails ='<b>'.$sale['boutique_customer_name'].'</b><br>
				'.$sale['boutique_customer_address'].'<br>
				Phone:'.$sale['boutique_customer_ph'].'<br>
				Email:'.$sale['boutique_customer_email'].'<br>';
			}

	  		ini_set('max_execution_time', 0); // for infinite time of execution

	  		$this->load->library('Pdf');
	  		
	  		$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	  		//$pdf = new TCPDF('P', 'mm', array('44','150'), true, 'UTF-8', false);
			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('Nicola Asuni');
			$pdf->SetTitle($sale['boutique_name']);
			$pdf->SetSubject('INVOICE');
			$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

			// set default header data

			// set header and footer fonts
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

			// set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			    require_once(dirname(__FILE__).'/lang/eng.php');
			    $pdf->setLanguageArray($l);
			}

			// ---------------------------------------------------------

			// set font
			$pdf->SetFont('helvetica', '', 10);

			$pdf->SetPrintHeader(false);
			$pdf->SetPrintFooter(false);
			// Add a page
			// This method has several options, check the source code documentation for more information.

			$pdf->AddPage();
			
			if( $this->session->userdata('BoutiqueID') == 31){
				$logo =	'';
			}
			else{
			    $logo =	'';
			}
			
		

			$html = '<div style="text-align: center;">
	<div style="padding:10px; text-align: center; border: 1px solid #000000"> 

		<table width="100%" style="text-align: center;">
				<tr>
					<td width="100%">
					    <br><br>
						<b>'.@$sale['boutique_name'].'.</b><br>'.
					@$sale['boutique_address'].	'<br>
				Phone: '.@$sale['boutique_ph'].'<br>
				Email: '.@$sale['boutique_email'].'<br>
					</td>
				</tr>
				<tr><td>&nbsp;</td></tr>
			</table>

		<table width="100%" style="text-align: left;">
			<tr>
				<td>VAT TIN</td>
				<td>: --------- </td>
			</tr>
		</table>
		<table width="100%" style="text-align: left; padding:10px;">
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td>Bill No</td>
				<td>: '.$sale['boutique_sale_invoice'].'</td>
				<td>Date : '.$sale['boutique_sale_date'].'</td>
			</tr>
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td>Party</td>
				<td colspan="2">: '.$customerdetails.'</td>
			</tr>
		</table>
		<table width="100%" style="text-align: left;">
			<tr>
				<td colspan="5"><hr></td>
			</tr>
			<tr>
				<td width="10%">Sl</td>
				<td width="30%"><b>Name</b></td>
				<td width="20%"><b>Rate</b></td>
				<td width="15%"><b>Qty</b></td>
				<td width="25%"><b>Amount</b></td>
			</tr>
			<tr>
				<td colspan="5"><hr></td>
			</tr>
			'.$orderdata.'
			<tr>
				<td colspan="5">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="5"><hr></td>
			</tr>
			<tr>
				<td colspan="2">Total</td>
				<td colspan="2"></td>
				<td>'.$sale['boutique_sale_price'].'</td>
			</tr>
			<tr>
				<td colspan="5">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="5"><hr style="border:none; border-bottom: 1px; border-style: double;"></td>
			</tr>
		</table>
		<p>Thank You</p>
		<p>Visit Again</p>
	</div>
</div>';

			// Print text using writeHTMLCell()
			$pdf->writeHTML($html, true, false, true, false, '');

			// ---------------------------------------------------------

			// Close and output PDF document
			// This method has several options, check the source code documentation for more information.
			$pdf->Output(time().'.pdf', 'I');

			//============================================================+
			// END OF FILE
			//============================================================+

	}

	public function billthermalnew(){

		$id = $this->uri->segment(3);
  		$sale = $this->Billing_model->m_getsaledetails($id);
  		$saleitems = $this->Billing_model->m_getallsaleitems($id);
  		$orderdata = '';
  		$i = 0;
	  	
	  	foreach ($saleitems as $key => $saleitem) {
	  		 	$i++;
	  			$orderdata .= '
				<tr>
				<td width="10%">'.@$i.'</td>
				<td width="30%">'.@$saleitem["boutique_sale_item_name"].'</td>
				<td width="20%">'.@$saleitem["boutique_sale_item_totalunitprice"].'</td>
				<td width="15%">'.@$saleitem["boutique_sale_unit"].'</td>
				<td width="25%">'.@(float)$saleitem["boutique_sale_item_totalunitprice"]*@(float)$saleitem["boutique_sale_unit"].'</td>
			    </tr>';
			}

			if($sale['boutique_customer_id'] == 0){
				$customerdetails = $sale['boutique_customer_details'];
			}	
			else{
				$customerdetails ='<b>'.$sale['boutique_customer_name'].'</b><br>
				'.$sale['boutique_customer_address'].'<br>
				Phone:'.$sale['boutique_customer_ph'].'<br>
				Email:'.$sale['boutique_customer_email'].'<br>';
			}

	  		ini_set('max_execution_time', 0); // for infinite time of execution

			$html = '
			<script>window.print();  </script>

			<div style="text-align: center;">
	<div style="padding:10px; text-align: center; width: 400px; font-size:24px;"> 

		<table width="100%" style="text-align: center; font-size:24px;">
				<tr>
					<td width="100%">
					    <br><br>
						<b>'.@$sale['boutique_name'].'.</b><br>'.
					@$sale['boutique_address'].	'<br>
				Phone: '.@$sale['boutique_ph'].'<br>
				Email: '.@$sale['boutique_email'].'<br>
					</td>
				</tr>
				<tr><td>&nbsp;</td></tr>
			</table>

		<table width="100%" style="text-align: left; font-size:20px;">
			<tr>
				<td>GSTIN</td>
				<td>: 32AQAPV7360C1Z1 </td>
			</tr>
		</table>
		<table width="100%" style="text-align: left; padding:10px; font-size:20px;">
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td>Bill No</td>
				<td>: '.$sale['boutique_sale_invoice'].'</td>
				<td>Date : '.$sale['boutique_sale_date'].'</td>
			</tr>
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td>Party</td>
				<td colspan="2">: '.$customerdetails.'</td>
			</tr>
		</table>
		<table width="100%" style="text-align: left; font-size:18px;">
			<tr>
				<td colspan="5"><hr></td>
			</tr>
			<tr>
				<td width="10%">Sl</td>
				<td width="30%"><b>Name</b></td>
				<td width="20%"><b>Rate</b></td>
				<td width="15%"><b>Qty</b></td>
				<td width="25%"><b>Amount</b></td>
			</tr>
			<tr>
				<td colspan="5"><hr></td>
			</tr>
			'.$orderdata.'
			<tr>
				<td colspan="5">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="5"><hr></td>
			</tr>
			<tr>
				<td colspan="2">Total</td>
				<td colspan="2"></td>
				<td>'.$sale['boutique_sale_price'].'</td>
			</tr>
			<tr>
				<td colspan="5">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="5"><hr style="border:none; border-bottom: 1px; border-style: double;"></td>
			</tr>
		</table>
		<p>Thank You</p>
		<p>Visit Again</p>
	</div>
</div>';

	echo $html;

	}

	public function bill(){

  		$id = $this->uri->segment(3);
  		$sale = $this->Billing_model->m_getsaledetails($id);
  		$saleitems = $this->Billing_model->m_getallsaleitems($id);
  		$orderdata = '';
  		$i = 0;
		
  		$blogo = $this->session->userdata('BoutiqueLogo');
		$logo =	'<img src="http://boutiquemanager.in/boutiquemanagerapp/uploads/logo/'.$blogo.'" height="100" width="160" />';
		    
			foreach ($saleitems as $key => $saleitem) {
	  		 	$i++;
	  			$orderdata .= '
				<tr>
					<td width="25%">'.@$i.'</td>
					<td width="60%">'.@$saleitem["boutique_sale_item_name"].'</td>
					<td width="25%">'.@$saleitem["boutique_sale_item_totalunitprice"]*@$saleitem["boutique_sale_unit"].'</td>
				</tr>';
			}

			if($sale['boutique_customer_id'] == 0){
				$customerdetails = $sale['boutique_customer_details'];
			}	
			else{
				$customerdetails ='<b>'.$sale['boutique_customer_name'].'</b><br>
				'.$sale['boutique_customer_address'].'<br>
				Phone:'.$sale['boutique_customer_ph'].'<br>
				Email:'.$sale['boutique_customer_email'].'<br>';
			}

	  		ini_set('max_execution_time', 0); // for infinite time of execution

	  		$this->load->library('Pdf');
	  		
	  		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('Nicola Asuni');
			$pdf->SetTitle($sale['boutique_name']);
			$pdf->SetSubject('INVOICE');
			$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

			// set default header data

			// set header and footer fonts
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

			// set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			    require_once(dirname(__FILE__).'/lang/eng.php');
			    $pdf->setLanguageArray($l);
			}

			// ---------------------------------------------------------

			// set font
			$pdf->SetFont('helvetica', '', 10);

			$pdf->SetPrintHeader(false);
			$pdf->SetPrintFooter(false);
			// Add a page
			// This method has several options, check the source code documentation for more information.
			
			$pdf->AddPage();
			
			if( $this->session->userdata('BoutiqueID') == 7 || $this->session->userdata('BoutiqueID') == 5){
				$logo =	'';
			}
			elseif($this->session->userdata('BoutiqueID') == 8){
				$logo = '<img height="80" width="210" src="http://boutiquemanager.in/boutiquemanagerdev/uploads/logo/beboo-logo.png">';
			}
			elseif($this->session->userdata('BoutiqueID') == 12){
				$logo =	'<img src="http://boutiquemanager.in/boutiquemanager/assets/images/images.jpg" height="100" width="160" />';
			}
			else{
			    $logo =	$logo;
			}

			// Set some content to print
			$html ='		<table width="100%">
				<tr>
					<td width="60%">
					'.$logo.'
						<br>
					</td>
					<td width="40%">
						<b>'.$sale['boutique_name'].'.</b><br>'.
					$sale['boutique_address'].	'<br>
				Phone: '.$sale['boutique_ph'].'<br>
				Email: '.$sale['boutique_email'].'<br>
					</td>
				</tr>
			</table>
			<div style="padding: 15px; background-color: #eeeeee;">
			INVOICE #'.$sale['boutique_sale_invoice'].' <br>
			Bill Date: '.$sale['boutique_sale_date'].'<br>
			</div>
			<table>
				<tr>
					<td>&nbsp;</td>
				</tr>
			</table>
			<div style="width:300px;">
				Invoiced To<br>
				'.$customerdetails.'
			</div>
			<table>
				<tr>
					<td>
						&nbsp;
					</td>
				</tr>
			</table>
			<table width="90%" border="1" cellpadding="5" cellspacing="0" bordercolor="#cccccc">
				<tr style="padding: 15px; background-color: #eeeeee;">
					<td width="25%">Qty</td>
					<td width="60%"><b>Name</b></td>
					<td width="25%"><b>Total</b></td>
				</tr>
				'.$orderdata.'
				<tr style="padding: 15px; background-color: #eeeeee;">
					<td width="25%"><b>Total</b></td>
					<td width="60%"></td>
					<td width="25%"><b>Rs '.$sale['boutique_sale_price'].'</b></td>
				</tr>
			</table>';

			// Print text using writeHTMLCell()
			$pdf->writeHTML($html, true, false, true, false, '');

			// ---------------------------------------------------------

			// Close and output PDF document
			// This method has several options, check the source code documentation for more information.
			$pdf->Output(time().'.pdf', 'I');

			//============================================================+
			// END OF FILE
			//============================================================+

 }

  		public function gstbill(){

  		$id = $this->uri->segment(3);
  		$sale = $this->Billing_model->m_getsaledetails($id);
  		$saleitems = $this->Billing_model->m_getallsaleitems($id);
  		$orderdata = '';
  		$i = 0;
  		if($this->session->userdata('BoutiqueStitchingStatus') == 1){
	  		foreach ($saleitems as $key => $saleitem) {
	  		 	$i++;
	  			$orderdata .= '
				<tr>
				<td width="10%">'.@$i.'</td>
				<td width="40%">'.@$saleitem["boutique_sale_item_name"].'</td>
				<td width="20%">'.@$saleitem["boutique_sale_item_totalunitprice"].'</td>
				<td width="15%">'.@$saleitem["boutique_sale_unit"].'</td>
				<td width="25%">'.@(float)$saleitem["boutique_sale_item_totalunitprice"]*@(float)$saleitem["boutique_sale_unit"].'</td>
			    </tr>';
			}

			if($sale['boutique_customer_id'] == 0){
				$customerdetails = $sale['boutique_customer_details'];
			}	
			else{
				$customerdetails ='<b>'.$sale['boutique_customer_name'].'</b><br>
				'.$sale['boutique_customer_address'].'<br>
				Phone:'.$sale['boutique_customer_ph'].'<br>
				Email:'.$sale['boutique_customer_email'].'<br>';
			}

	  		ini_set('max_execution_time', 0); // for infinite time of execution

	  		$this->load->library('Pdf');
	  		
	  		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('Nicola Asuni');
			$pdf->SetTitle($sale['boutique_name']);
			$pdf->SetSubject('INVOICE');
			$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

			// set default header data

			// set header and footer fonts
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

			// set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			    require_once(dirname(__FILE__).'/lang/eng.php');
			    $pdf->setLanguageArray($l);
			}

			// ---------------------------------------------------------

			// set font
			$pdf->SetFont('helvetica', '', 10);

			$pdf->SetPrintHeader(false);
			$pdf->SetPrintFooter(false);
			// Add a page
			// This method has several options, check the source code documentation for more information.

			$pdf->AddPage();
			
			if( $this->session->userdata('BoutiqueID') == 7 || $this->session->userdata('BoutiqueID') == 5){
				$logo =	'';
			}
			elseif($this->session->userdata('BoutiqueID') == 8 || $this->session->userdata('BoutiqueID') == 9 || $this->session->userdata('BoutiqueID') == 10){
				$logo = '<img height="80" width="210" src="http://boutiquemanager.in/boutiquemanagerdev/uploads/logo/beboo-logo.png">';
			}
			elseif($this->session->userdata('BoutiqueID') == 12){
				$logo =	'<img src="http://boutiquemanager.in/boutiquemanager/assets/images/images.jpg" height="100" width="160" />';
			}
			elseif($this->session->userdata('BoutiqueID') == 25){
			$logo = '<img height="80" width="210" src="http://boutiquemanager.in/boutiquemanagerdev/uploads/logo/ndot.jpg">';
			}
			elseif($this->session->userdata('BoutiqueID') == 27){
				$logo = '<img height="110" width="210" src="http://boutiquemanager.in/boutiquemanagerdev/uploads/logo/fulki.jpg">';
			}
			else{
			    $logo =	'';
			}
			
			// Set some content to print
			$html ='		<table width="100%">
				<tr>
					<td width="60%">
					'.$logo.'
						<br>
					</td>
					<td width="40%">
						<b>'.$sale['boutique_name'].'.</b><br>'.
					$sale['boutique_address'].	'<br>
				Phone: '.$sale['boutique_ph'].'<br>
				Email: '.$sale['boutique_email'].'<br>
					</td>
				</tr>
			</table>
			<div style="padding: 15px; background-color: #eeeeee;">
			INVOICE #'.$sale['boutique_sale_invoice'].' <br>
			Bill Date: '.$sale['boutique_sale_date'].'<br>
			</div>
			<table>
				<tr>
					<td>&nbsp;</td>
				</tr>
			</table>
			<div style="width:300px;">
				Invoiced To<br>
				'.$customerdetails.'
			</div>
			<table>
				<tr>
					<td>
						&nbsp;
					</td>
				</tr>
			</table>
			<table width="90%" border="1" cellpadding="5" cellspacing="0" bordercolor="#cccccc">
				<tr style="padding: 15px; background-color: #eeeeee;">
					<td width="10%">No</td>
				    <td width="40%"><b>Name</b></td>
				    <td width="20%"><b>Unit Price</b></td>
				    <td width="15%"><b>Quantity</b></td>
				    <td width="25%"><b>Total</b></td>
				</tr>
				'.$orderdata.'
				<tr style="padding: 15px; background-color: #eeeeee;">
					<td width="10%"></td>
					<td width="75%"><b>Total</b></td>
					<td width="25%"><b>Rs '.$sale['boutique_sale_price'].'</b></td>
				</tr>
			</table>';

			// Print text using writeHTMLCell()
			$pdf->writeHTML($html, true, false, true, false, '');

			// ---------------------------------------------------------

			// Close and output PDF document
			// This method has several options, check the source code documentation for more information.
			$pdf->Output(time().'.pdf', 'I');

			//============================================================+
			// END OF FILE
			//============================================================+
		}
		elseif($this->session->userdata('BoutiqueID') == 30){
			
			$totalPiece = 0;
			$grossValue = 0;
			$gstValue = 0;
			$taxvalue = 0;
			$taxsgst = 0;
			$taxcgst = 0;
			
			$itemCount = count($saleitems);
			$table1Height = '100px';
			if($itemCount >= 12){
				$tableHeight = '0px';
				$brhtml ="<br>";
				$table1Height = '0px';
			}
			elseif($itemCount >= 11){
				$tableHeight = '0px';
				$brhtml ="<br>";
				$table1Height = '40px';
			}
			elseif($itemCount >= 10){
				$tableHeight = '0px';
				$brhtml ="<br>";
			}
			elseif ($itemCount >= 9) {
				$tableHeight = '50px';
				$brhtml ="";
			}
			elseif ($itemCount >= 8) {
				$tableHeight = '90px';
				$brhtml ="<br>";
			}
			elseif ($itemCount >= 7) {
				$tableHeight = '90px';
				$brhtml ="<br><br>";
			}
			elseif ($itemCount >= 6) {
				$tableHeight = '90px';
				$brhtml ="<br><br><br>";
			}
			elseif ($itemCount >= 5) {
				$tableHeight = '170px';
				$brhtml ="<br>";
			}
			elseif ($itemCount >= 4) {
				$tableHeight = '200px';
				$brhtml ="<br><br>";
			}
			elseif ($itemCount >= 3) {
				$tableHeight = '200px';
				
				$brhtml ="<br><br><br><br>";
			}
			elseif ($itemCount >= 2) {
				$tableHeight = '200px';
				
				$brhtml ="<br><br><br><br><br><br>";
			}
			elseif ($itemCount >= 1) {
				$tableHeight = '200px';
				
				$brhtml ="<br><br><br><br><br><br><br><br>";
			}
			else{
				$tableHeight = '250px';
				
				$brhtml ="<br><br><br><br><br><br><br><br>";
			}
			
			$totalSgstrate = 0;
			$totalCgstrate = 0;
			foreach ($saleitems as $key => $saleitem) {
	  		 	$i++;
	  		 	@$totalPiece = @$totalPiece + @$saleitem["boutique_sale_unit"];
	  		 	@$grossValue = @$grossValue + @$saleitem["boutique_sale_unit"]*@$saleitem["boutique_sale_item_unitprice"];
	  		 	if(@$saleitem["boutique_tax_rate"]){
	  		 		$taxvalue = @$saleitem["boutique_tax_rate"];
	  		 		$taxsgst = $taxvalue/2;
	  		 		$taxcgst = $taxvalue/2;
	  		 		$taxsgsttext = $taxvalue/2;
	  		 		$taxcgsttext = $taxvalue/2;
	  		 		$sgstrate = @$saleitem["boutique_sale_unit"]*@$saleitem["boutique_sale_item_unitprice"]*$taxsgst*.01;
	  		 		$cgstrate = @$saleitem["boutique_sale_unit"]*@$saleitem["boutique_sale_item_unitprice"]*$taxcgst*.01;
	  		 	}
	  		 	elseif(@$saleitem["boutique_sale_item_tax"]){
	  		 		$taxvalue = @$saleitem["boutique_sale_item_tax"];
	  		 		$taxsgst = $taxvalue/2;
	  		 		$taxcgst = $taxvalue/2;
	  		 		$taxsgsttext = '';
	  		 		$taxcgsttext = '';
	  		 		$sgstrate = @$saleitem["boutique_sale_item_tax"]*$saleitem["boutique_sale_unit"]/2;
	  		 		$cgstrate = @$saleitem["boutique_sale_item_tax"]*$saleitem["boutique_sale_unit"]/2;
	  		 	}
	  		 	else{
	  		 		$taxsgst = $taxvalue/2;
	  		 		$taxcgst = $taxvalue/2;
	  		 		$taxsgsttext = '';
	  		 		$taxcgsttext = '';
	  		 		$sgstrate = 0;
	  		 		$cgstrate = 0;
	  		 	}		 	
	  		 	$totalSgstrate = $totalSgstrate + $sgstrate;
	  		 	$totalCgstrate = $totalCgstrate + $cgstrate;

	  			$orderdata .= '
				<tr>
					<td width="4%" style="border-right:1px solid black;">'.@$i.'</td>
					<td width="12%"  style="border-right:1px solid black;">'.@$saleitem["boutique_sale_item_hsn"].'</td>
					<td width="22%" style="border-right:1px solid black;">'.@$saleitem["boutique_sale_item_name"].'</td>
					<td width="5%" style="border-right:1px solid black;">'.@$saleitem["boutique_sale_unit"].'</td>
					<td width="5%" style="border-right:1px solid black;"></td>
					<td width="7%" style="border-right:1px solid black;">'.@$saleitem["boutique_sale_item_unitprice"].'</td>
					<td width="12%" style="border-right:1px solid black;">'.@round($saleitem["boutique_sale_unit"]*@$saleitem["boutique_sale_item_unitprice"],2).'</td>
					<td width="4%" style="border-right:1px solid black;">'.@$taxsgsttext.'</td>
					<td width="8%" style="border-right:1px solid black;">'.@round($sgstrate,2).'</td>
					<td width="4%" style="border-right:1px solid black;">'.@$taxcgsttext.'</td>
					<td width="8%" style="border-right:1px solid black;">'.@round($cgstrate,2).'</td>
					<td width="9%" style="border-right:1px solid black;">'.@round($saleitem["boutique_sale_item_totalunitprice"]*@$saleitem["boutique_sale_unit"],2).'</td>
				</tr>';
			}

			if($sale['boutique_customer_id'] == 0){
				$customerdetails = $sale['boutique_customer_details'];
			}	
			else{
				$customerdetails ='<b>'.$sale['boutique_customer_name'].'</b><br>
				'.$sale['boutique_customer_address'].'<br>
				Phone:'.$sale['boutique_customer_ph'].'<br>
				Email:'.$sale['boutique_customer_email'].'<br>';
			}

	  		ini_set('max_execution_time', 0); // for infinite time of execution

	  		$this->load->library('Pdf');
	  		
	  		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('Nicola Asuni');
			$pdf->SetTitle($sale['boutique_name']);
			$pdf->SetSubject('INVOICE');
			$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

			// set default header data

			// set header and footer fonts
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

			// set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			    require_once(dirname(__FILE__).'/lang/eng.php');
			    $pdf->setLanguageArray($l);
			}

			// ---------------------------------------------------------

			// set font
			$pdf->SetFont('helvetica', '', 10);

			$pdf->SetPrintHeader(false);
			$pdf->SetPrintFooter(false);
			// Add a page
			// This method has several options, check the source code documentation for more information.
			
			$pdf->SetMargins(5, 5, 5, true);

			$pdf->AddPage();
		
			$logo =	'';
			
			// Set some content to print
			$html ='<table width="100%" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;border-top:1px solid black;">
				<tr><td colspan="3"></td></tr>
				<tr><td colspan="3"></td></tr>
				<tr>
					<td width="22%">
					'.$logo.'
						<br>
					</td>
					<td width="55%" align="center">
					<h1><b>'.strtoupper($sale['boutique_name']).'</b></h1>'.
					$sale['boutique_address'].'<br>
				Phone: '.$sale['boutique_ph'].' Email: '.$sale['boutique_email'].'<br>
				STATE : Kerala , CODE : 12<br>
				GSTIN:32AFAPU7205A1Z1
					</td>
					<td width="23%">
					INVOICE :'.$sale['boutique_sale_invoice_gstnumber'].' <br>
					Bill Date  : '.$sale['boutique_sale_date'].'<br>
					</td>
				</tr>
				<tr><td colspan="3" style="text-align:right;"> ORIGINAL FOR RECEIPIENT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
				<tr><td colspan="3"></td></tr>
			</table>
			<table style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">
				<tr><td colspan="3"></td></tr>
				<tr>
				<td width="3%" style="border-left:none;border-right:none;"></td>
				<td width="50%" style="border-left:none;border-right:none;">To<br>
				'.$customerdetails.'</td>
				<td width="47%"></td>
				</tr>
				<tr><td colspan="3"></td></tr>
			</table>
			<table width="100%" cellpadding="5" cellspacing="0"  style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">
				<tr>
					<td width="4%" rowspan="2" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">Sl</td>
					<td width="12%" rowspan="2" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">HSN Code</td>
					<td width="22%" rowspan="2" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">Description</td>
					<td width="5%" rowspan="2" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">Pcs</td>
					<td width="5%" rowspan="2" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">Kgs</td>
					<td width="7%" rowspan="2" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">Rate</td>
					<td width="12%" rowspan="2" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">Gross Value</td>
					<td width="12%" colspan="2" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">CGST</td>
					<td width="12%" colspan="2" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">SGST</td>
					<td width="9%" rowspan="2" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">Total</td>
				</tr>
				<tr>
					<td width="4%" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">%</td>
					<td width="8%" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">Amount</td>
					<td width="4%" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">%</td>
					<td width="8%" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">Amount</td>
				</tr>
				'.$orderdata.'
				<tr>
					<td width="4%" style="border-right:1px solid black;height:'.$tableHeight.';"></td>
					<td width="12%"  style="border-right:1px solid black;"></td>
					<td width="22%" style="border-right:1px solid black;"></td>
					<td width="5%" style="border-right:1px solid black;"></td>
					<td width="5%" style="border-right:1px solid black;"></td>
					<td width="7%" style="border-right:1px solid black;"></td>
					<td width="12%" style="border-right:1px solid black;"></td>
					<td width="4%" style="border-right:1px solid black;"></td>
					<td width="8%" style="border-right:1px solid black;"></td>
					<td width="4%" style="border-right:1px solid black;"></td>
					<td width="8%" style="border-right:1px solid black;"></td>
					<td width="9%" style="border-right:1px solid black;"></td>
				</tr>
				<tr>
				    <td width="4%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;"></td>
					<td width="12%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;"></td>
					<td width="22%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;">Sub Total</td>
					<td width="5%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;">'.round($totalPiece,2).'</td>
					<td width="5%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;"></td>
					<td width="7%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;"></td>
					<td width="12%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;">'.round($grossValue,2).'</td>	
					<td width="4%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;"></td>
					<td width="8%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;">'.round($totalCgstrate,2).'</td>
					<td width="4%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;"></td>
					<td width="8%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;">'.round($totalSgstrate,2).'</td>
					<td width="9%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;"><b>Rs '.round($sale['boutique_sale_price'],2).'</b></td>
				</tr>
				<tr>
				    <td colspan="12" width="100%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black; height:'.$table1Height.';">
				    </td>
				</tr>
				<tr>
				    <td colspan="8" width="67%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;font-weight: bold;font-size: 15px;">'.ucwords($this->getIndianCurrency($sale['boutique_sale_price'])).'</td>
					<td colspan="4" width="33%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;font-weight: bold;font-size: 15px;"> Bill Amount &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.round($sale['boutique_sale_price'],2).'</td>
					
				</tr>
				<tr>
				    <td colspan="12" width="100%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black; height:50px;"><br><br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Declaration:- "Composition taxable person, not eligible to collect tax on supplies”
				    </td>
				</tr>
				<tr>
				    <td colspan="8" rowspan="2" width="67%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;"><br>Bank Details <br>
				    Bank Name:FEDERAL Bank<br>
				    Bank A/C: 17160200000712<br>
				    Bank IFSC: FDRL0001716
				    </td>
					<td colspan="4" rowspan="2" width="33%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black; text-align:right;"> For HOME TECH <br><br><br>Authorised Signatory</td>
					
				</tr>
				<tr>
					<td colspan="8" width="67%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;"></td>
					
				</tr>
			</table>';

			// Print text using writeHTMLCell()
			$pdf->writeHTML($html, true, false, false, false, '');

			$html2 = '';
			if($this->uri->segment(4) == 2){

				$pdf->AddPage();

				$html2 .='<table width="100%" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;border-top:1px solid black;">
				<tr><td colspan="3"></td></tr>
				<tr><td colspan="3"></td></tr>
				<tr>
					<td width="22%">
					'.$logo.'
						<br>
					</td>
					<td width="55%" align="center">
					<h1><b>'.strtoupper($sale['boutique_name']).'</b></h1>'.
					$sale['boutique_address'].'<br>
				Phone: '.$sale['boutique_ph'].' Email: '.$sale['boutique_email'].'<br>
				STATE : Kerala , CODE : 12<br>
				GSTIN:32AFAPU7205A1Z1
					</td>
					<td width="23%">
					INVOICE :'.$sale['boutique_sale_invoice_gstnumber'].' <br>
					Bill Date  : '.$sale['boutique_sale_date'].'<br>
					</td>
				</tr>
				<tr><td colspan="3" style="text-align:right;"> DUPLICATE FOR TRANSPORTER&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
				<tr><td colspan="3"></td></tr>
			</table>
			<table style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">
				<tr><td colspan="3"></td></tr>
				<tr>
				<td width="3%" style="border-left:none;border-right:none;"></td>
				<td width="50%" style="border-left:none;border-right:none;">To<br>
				'.$customerdetails.'</td>
				<td width="47%"></td>
				</tr>
				<tr><td colspan="3"></td></tr>
			</table>
			<table width="100%" cellpadding="5" cellspacing="0"  style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">
				<tr>
					<td width="4%" rowspan="2" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">Sl</td>
					<td width="12%" rowspan="2" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">HSN Code</td>
					<td width="22%" rowspan="2" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">Description</td>
					<td width="5%" rowspan="2" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">Pcs</td>
					<td width="5%" rowspan="2" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">Kgs</td>
					<td width="7%" rowspan="2" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">Rate</td>
					<td width="12%" rowspan="2" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">Gross Value</td>
					<td width="12%" colspan="2" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">CGST</td>
					<td width="12%" colspan="2" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">SGST</td>
					<td width="9%" rowspan="2" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">Total</td>
				</tr>
				<tr>
					<td width="4%" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">%</td>
					<td width="8%" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">Amount</td>
					<td width="4%" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">%</td>
					<td width="8%" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">Amount</td>
				</tr>
				'.$orderdata.'
				<tr>
					<td width="4%" style="border-right:1px solid black;height:'.$tableHeight.';"></td>
					<td width="12%"  style="border-right:1px solid black;"></td>
					<td width="22%" style="border-right:1px solid black;"></td>
					<td width="5%" style="border-right:1px solid black;"></td>
					<td width="5%" style="border-right:1px solid black;"></td>
					<td width="7%" style="border-right:1px solid black;"></td>
					<td width="12%" style="border-right:1px solid black;"></td>
					<td width="4%" style="border-right:1px solid black;"></td>
					<td width="8%" style="border-right:1px solid black;"></td>
					<td width="4%" style="border-right:1px solid black;"></td>
					<td width="8%" style="border-right:1px solid black;"></td>
					<td width="9%" style="border-right:1px solid black;"></td>
				</tr>
				<tr>
				    <td width="4%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;"></td>
					<td width="12%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;"></td>
					<td width="22%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;">Sub Total</td>
					<td width="5%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;">'.round($totalPiece,2).'</td>
					<td width="5%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;"></td>
					<td width="7%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;"></td>
					<td width="12%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;">'.round($grossValue,2).'</td>	
					<td width="4%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;"></td>
					<td width="8%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;">'.round($totalCgstrate,2).'</td>
					<td width="4%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;"></td>
					<td width="8%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;">'.round($totalSgstrate,2).'</td>
					<td width="9%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;"><b>Rs '.round($sale['boutique_sale_price'],2).'</b></td>
				</tr>
				<tr>
				    <td colspan="12" width="100%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black; height:'.$table1Height.';">
				    </td>
				</tr>
				<tr>
				    <td colspan="8" width="67%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;font-weight: bold;font-size: 15px;">'.ucwords($this->getIndianCurrency($sale['boutique_sale_price'])).'</td>
					<td colspan="4" width="33%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;font-weight: bold;font-size: 15px;"> Bill Amount &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.round($sale['boutique_sale_price'],2).'</td>
					
				</tr>
				<tr>
				    <td colspan="12" width="100%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black; height:50px;"><br><br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Declaration:- "Composition taxable person, not eligible to collect tax on supplies”
				    </td>
				</tr>
				<tr>
				    <td colspan="8" rowspan="2" width="67%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;"><br>Bank Details <br>
				    Bank Name:FEDERAL Bank<br>
				    Bank A/C: 17160200000712<br>
				    Bank IFSC: FDRL0001716
				    </td>
					<td colspan="4" rowspan="2" width="33%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black; text-align:right;"> For HOME TECH <br><br><br>Authorised Signatory</td>
					
				</tr>
				<tr>
					<td colspan="8" width="67%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;"></td>
					
				</tr>
			</table>';

						// Print text using writeHTMLCell()
			$pdf->writeHTML($html2, true, false, false, false, '');

			}
			elseif ($this->uri->segment(4) == 3) {
				$pdf->AddPage();
				$html31 = '';
				$html31 .='<table width="100%" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;border-top:1px solid black;">
				<tr><td colspan="3"></td></tr>
				<tr><td colspan="3"></td></tr>
				<tr>
					<td width="22%">
					'.$logo.'
						<br>
					</td>
					<td width="55%" align="center">
					<h1><b>'.strtoupper($sale['boutique_name']).'</b></h1>'.
					$sale['boutique_address'].'<br>
				Phone: '.$sale['boutique_ph'].' Email: '.$sale['boutique_email'].'<br>
				STATE : Kerala , CODE : 12<br>
				GSTIN:32AFAPU7205A1Z1
					</td>
					<td width="23%">
					INVOICE :'.$sale['boutique_sale_invoice_gstnumber'].' <br>
					Bill Date  : '.$sale['boutique_sale_date'].'<br>
					</td>
				</tr>
				<tr><td colspan="3" style="text-align:right;"> DUPLICATE FOR TRANSPORTER&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
				<tr><td colspan="3"></td></tr>
			</table>
			<table style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">
				<tr><td colspan="3"></td></tr>
				<tr>
				<td width="3%" style="border-left:none;border-right:none;"></td>
				<td width="50%" style="border-left:none;border-right:none;">To<br>
				'.$customerdetails.'</td>
				<td width="47%"></td>
				</tr>
				<tr><td colspan="3"></td></tr>
			</table>
			<table width="100%" cellpadding="5" cellspacing="0"  style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">
				<tr>
					<td width="4%" rowspan="2" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">Sl</td>
					<td width="12%" rowspan="2" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">HSN Code</td>
					<td width="22%" rowspan="2" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">Description</td>
					<td width="5%" rowspan="2" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">Pcs</td>
					<td width="5%" rowspan="2" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">Kgs</td>
					<td width="7%" rowspan="2" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">Rate</td>
					<td width="12%" rowspan="2" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">Gross Value</td>
					<td width="12%" colspan="2" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">CGST</td>
					<td width="12%" colspan="2" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">SGST</td>
					<td width="9%" rowspan="2" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">Total</td>
				</tr>
				<tr>
					<td width="4%" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">%</td>
					<td width="8%" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">Amount</td>
					<td width="4%" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">%</td>
					<td width="8%" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">Amount</td>
				</tr>
				'.$orderdata.'
				<tr>
					<td width="4%" style="border-right:1px solid black;height:'.$tableHeight.';"></td>
					<td width="12%"  style="border-right:1px solid black;"></td>
					<td width="22%" style="border-right:1px solid black;"></td>
					<td width="5%" style="border-right:1px solid black;"></td>
					<td width="5%" style="border-right:1px solid black;"></td>
					<td width="7%" style="border-right:1px solid black;"></td>
					<td width="12%" style="border-right:1px solid black;"></td>
					<td width="4%" style="border-right:1px solid black;"></td>
					<td width="8%" style="border-right:1px solid black;"></td>
					<td width="4%" style="border-right:1px solid black;"></td>
					<td width="8%" style="border-right:1px solid black;"></td>
					<td width="9%" style="border-right:1px solid black;"></td>
				</tr>
				<tr>
				    <td width="4%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;"></td>
					<td width="12%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;"></td>
					<td width="22%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;">Sub Total</td>
					<td width="5%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;">'.round($totalPiece,2).'</td>
					<td width="5%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;"></td>
					<td width="7%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;"></td>
					<td width="12%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;">'.round($grossValue,2).'</td>	
					<td width="4%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;"></td>
					<td width="8%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;">'.round($totalCgstrate,2).'</td>
					<td width="4%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;"></td>
					<td width="8%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;">'.round($totalSgstrate,2).'</td>
					<td width="9%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;"><b>Rs '.round($sale['boutique_sale_price'],2).'</b></td>
				</tr>
				<tr>
				    <td colspan="12" width="100%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black; height:'.$table1Height.';">
				    </td>
				</tr>
				<tr>
				    <td colspan="8" width="67%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;font-weight: bold;font-size: 15px;">'.ucwords($this->getIndianCurrency($sale['boutique_sale_price'])).'</td>
					<td colspan="4" width="33%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;font-weight: bold;font-size: 15px;"> Bill Amount &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.round($sale['boutique_sale_price'],2).'</td>
					
				</tr>
				<tr>
				    <td colspan="12" width="100%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black; height:50px;"><br><br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Declaration:- "Composition taxable person, not eligible to collect tax on supplies”
				    </td>
				</tr>
				<tr>
				    <td colspan="8" rowspan="2" width="67%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;"><br>Bank Details <br>
				    Bank Name:FEDERAL Bank<br>
				    Bank A/C: 17160200000712<br>
				    Bank IFSC: FDRL0001716
				    </td>
					<td colspan="4" rowspan="2" width="33%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black; text-align:right;"> For HOME TECH <br><br><br>Authorised Signatory</td>
					
				</tr>
				<tr>
					<td colspan="8" width="67%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;"></td>
					
				</tr>
			</table>';
				// Print text using writeHTMLCell()
				$pdf->writeHTML($html31, true, false, false, false, '');
				$pdf->AddPage();

				$html32 = '';
				$html32 .= '<table width="100%" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;border-top:1px solid black;">
				<tr><td colspan="3"></td></tr>
				<tr><td colspan="3"></td></tr>
				<tr>
					<td width="22%">
					'.$logo.'
						<br>
					</td>
					<td width="55%" align="center">
					<h1><b>'.strtoupper($sale['boutique_name']).'</b></h1>'.
					$sale['boutique_address'].'<br>
				Phone: '.$sale['boutique_ph'].' Email: '.$sale['boutique_email'].'<br>
				STATE : Kerala , CODE : 12<br>
				GSTIN:32AFAPU7205A1Z1
					</td>
					<td width="23%">
					INVOICE :'.$sale['boutique_sale_invoice_gstnumber'].' <br>
					Bill Date  : '.$sale['boutique_sale_date'].'<br>
					</td>
				</tr>
				<tr><td colspan="3" style="text-align:right;">TRIPLICATED &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
				<tr><td colspan="3"></td></tr>
			</table>
			<table style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">
				<tr><td colspan="3"></td></tr>
				<tr>
				<td width="3%" style="border-left:none;border-right:none;"></td>
				<td width="50%" style="border-left:none;border-right:none;">To<br>
				'.$customerdetails.'</td>
				<td width="47%"></td>
				</tr>
				<tr><td colspan="3"></td></tr>
			</table>
			<table width="100%" cellpadding="5" cellspacing="0"  style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">
				<tr>
					<td width="4%" rowspan="2" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">Sl</td>
					<td width="12%" rowspan="2" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">HSN Code</td>
					<td width="22%" rowspan="2" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">Description</td>
					<td width="5%" rowspan="2" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">Pcs</td>
					<td width="5%" rowspan="2" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">Kgs</td>
					<td width="7%" rowspan="2" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">Rate</td>
					<td width="12%" rowspan="2" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">Gross Value</td>
					<td width="12%" colspan="2" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">CGST</td>
					<td width="12%" colspan="2" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">SGST</td>
					<td width="9%" rowspan="2" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">Total</td>
				</tr>
				<tr>
					<td width="4%" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">%</td>
					<td width="8%" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">Amount</td>
					<td width="4%" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">%</td>
					<td width="8%" style="border-right:1px solid black;;border-left:1px solid black;border-bottom:1px solid black;">Amount</td>
				</tr>
				'.$orderdata.'
				<tr>
					<td width="4%" style="border-right:1px solid black;height:'.$tableHeight.';"></td>
					<td width="12%"  style="border-right:1px solid black;"></td>
					<td width="22%" style="border-right:1px solid black;"></td>
					<td width="5%" style="border-right:1px solid black;"></td>
					<td width="5%" style="border-right:1px solid black;"></td>
					<td width="7%" style="border-right:1px solid black;"></td>
					<td width="12%" style="border-right:1px solid black;"></td>
					<td width="4%" style="border-right:1px solid black;"></td>
					<td width="8%" style="border-right:1px solid black;"></td>
					<td width="4%" style="border-right:1px solid black;"></td>
					<td width="8%" style="border-right:1px solid black;"></td>
					<td width="9%" style="border-right:1px solid black;"></td>
				</tr>
				<tr>
				    <td width="4%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;"></td>
					<td width="12%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;"></td>
					<td width="22%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;">Sub Total</td>
					<td width="5%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;">'.round($totalPiece,2).'</td>
					<td width="5%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;"></td>
					<td width="7%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;"></td>
					<td width="12%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;">'.round($grossValue,2).'</td>	
					<td width="4%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;"></td>
					<td width="8%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;">'.round($totalCgstrate,2).'</td>
					<td width="4%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;"></td>
					<td width="8%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;">'.round($totalSgstrate,2).'</td>
					<td width="9%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;"><b>Rs '.round($sale['boutique_sale_price'],2).'</b></td>
				</tr>
				<tr>
				    <td colspan="12" width="100%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black; height:'.$table1Height.';">
				    </td>
				</tr>
				<tr>
				    <td colspan="8" width="67%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;font-weight: bold;font-size: 15px;">'.ucwords($this->getIndianCurrency($sale['boutique_sale_price'])).'</td>
					<td colspan="4" width="33%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;font-weight: bold;font-size: 15px;"> Bill Amount &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.round($sale['boutique_sale_price'],2).'</td>
					
				</tr>
				<tr>
				    <td colspan="12" width="100%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black; height:50px;"><br><br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Declaration:- "Composition taxable person, not eligible to collect tax on supplies”
				    </td>
				</tr>
				<tr>
				    <td colspan="8" rowspan="2" width="67%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;"><br>Bank Details <br>
				    Bank Name:FEDERAL Bank<br>
				    Bank A/C: 17160200000712<br>
				    Bank IFSC: FDRL0001716
				    </td>
					<td colspan="4" rowspan="2" width="33%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black; text-align:right;"> For HOME TECH <br><br><br>Authorised Signatory</td>
					
				</tr>
				<tr>
					<td colspan="8" width="67%" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;"></td>
					
				</tr>
			</table>';
				// Print text using writeHTMLCell()
				$pdf->writeHTML($html32, true, false, false, false, '');

			}

			// -----------------------------------------------

			// Reset pointer to the last page
			$pdf->lastPage();

			// Close and output PDF document
			// This method has several options, check the source code documentation for more information.
			$pdf->Output(time().'.pdf', 'I');

			//============================================================+
			// END OF FILE
			//============================================================+
		}
		else{
			foreach ($saleitems as $key => $saleitem) {
	  		 	$i++;
	  			$orderdata .= '
				<tr>
					<td width="25%">'.@$i.'</td>
					<td width="60%">'.@$saleitem["boutique_sale_item_name"].'</td>
					<td width="25%">'.@$saleitem["boutique_sale_item_totalunitprice"]*@$saleitem["boutique_sale_unit"].'</td>
				</tr>';
			}

			if($sale['boutique_customer_id'] == 0){
				$customerdetails = $sale['boutique_customer_details'];
			}	
			else{
				$customerdetails ='<b>'.$sale['boutique_customer_name'].'</b><br>
				'.$sale['boutique_customer_address'].'<br>
				Phone:'.$sale['boutique_customer_ph'].'<br>
				Email:'.$sale['boutique_customer_email'].'<br>';
			}

	  		ini_set('max_execution_time', 0); // for infinite time of execution

	  		$this->load->library('Pdf');
	  		
	  		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('Nicola Asuni');
			$pdf->SetTitle($sale['boutique_name']);
			$pdf->SetSubject('INVOICE');
			$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

			// set default header data

			// set header and footer fonts
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

			// set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			    require_once(dirname(__FILE__).'/lang/eng.php');
			    $pdf->setLanguageArray($l);
			}

			// ---------------------------------------------------------

			// set font
			$pdf->SetFont('helvetica', '', 10);

			$pdf->SetPrintHeader(false);
			$pdf->SetPrintFooter(false);
			// Add a page
			// This method has several options, check the source code documentation for more information.
			
			$pdf->AddPage();
			
			if( $this->session->userdata('BoutiqueID') == 7 || $this->session->userdata('BoutiqueID') == 5){
				$logo =	'';
			}
			elseif($this->session->userdata('BoutiqueID') == 8){
				$logo = '<img height="80" width="210" src="http://boutiquemanager.in/boutiquemanagerdev/uploads/logo/beboo-logo.png">';
			}
			elseif($this->session->userdata('BoutiqueID') == 12){
				$logo =	'<img src="http://boutiquemanager.in/boutiquemanager/assets/images/images.jpg" height="100" width="160" />';
			}
			else{
			    $logo =	'';
			}
			
			// Set some content to print
			$html ='		<table width="100%">
				<tr>
					<td width="60%">
					'.$logo.'
						<br>
					</td>
					<td width="40%">
						<b>'.$sale['boutique_name'].'.</b><br>'.
					$sale['boutique_address'].	'<br>
				Phone: '.$sale['boutique_ph'].'<br>
				Email: '.$sale['boutique_email'].'<br>
					</td>
				</tr>
			</table>
			<div style="padding: 15px; background-color: #eeeeee;">
			INVOICE #'.$sale['boutique_sale_invoice'].' <br>
			Bill Date: '.$sale['boutique_sale_date'].'<br>
			</div>
			<table>
				<tr>
					<td>&nbsp;</td>
				</tr>
			</table>
			<div style="width:300px;">
				Invoiced To<br>
				'.$customerdetails.'
			</div>
			<table>
				<tr>
					<td>
						&nbsp;
					</td>
				</tr>
			</table>
			<table width="90%" border="1" cellpadding="5" cellspacing="0" bordercolor="#cccccc">
				<tr style="padding: 15px; background-color: #eeeeee;">
					<td width="25%">Qty</td>
					<td width="60%"><b>Name</b></td>
					<td width="25%"><b>Total</b></td>
				</tr>
				'.$orderdata.'
				<tr style="padding: 15px; background-color: #eeeeee;">
					<td width="25%"><b>Total</b></td>
					<td width="60%"></td>
					<td width="25%"><b>Rs '.$sale['boutique_sale_price'].'</b></td>
				</tr>
			</table>';

			// Print text using writeHTMLCell()
			$pdf->writeHTML($html, true, false, true, false, '');

			// ---------------------------------------------------------

			// Close and output PDF document
			// This method has several options, check the source code documentation for more information.
			$pdf->Output(time().'.pdf', 'I');

			//============================================================+
			// END OF FILE
			//============================================================+
		}

  	}

	public function createbarcode(){


  		$id = $this->uri->segment(3);
  		$item = $this->Billing_model->getitemdetails($id);
		$itemimage = $item['boutique_item_barcode'].'.png';
		$workimagepath = '<img height="100" src="http://boutiquemanager.in/boutiquemanagerdev/uploads/barcode/'.$itemimage.'">';

  		ini_set('max_execution_time', 0); // for infinite time of execution

  		$this->load->library('Pdf');
  		
  		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Boutique Manager');
$pdf->SetTitle('Barcode');
$pdf->SetSubject('Barcode - Print');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 061', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP-5, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 10);


		// Add a page
		// This method has several options, check the source code documentation for more information.
		$pdf->AddPage();

	$html ='<div style="text-align: center;">
			<h4>Item Name : '.$item['boutique_item_name'].'</h4>
			<h4>Item Code/SKU : '.$item['boutique_item_code'].'</h4>
	<table width="100%">
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td width="30%">Unit Price : '.$item['boutique_item_unit_price'].'<br>'.$workimagepath.'</td>
			<td width="5%"></td>
			<td width="30%">Unit Price : '.$item['boutique_item_unit_price'].'<br>'.$workimagepath.'</td>
			<td width="5%"></td>
			<td width="30%">Unit Price : '.$item['boutique_item_unit_price'].'<br>'.$workimagepath.'</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td width="30%">Unit Price : '.$item['boutique_item_unit_price'].'<br>'.$workimagepath.'</td>
			<td width="5%"></td>
			<td width="30%">Unit Price : '.$item['boutique_item_unit_price'].'<br>'.$workimagepath.'</td>
			<td width="5%"></td>
			<td width="30%">Unit Price : '.$item['boutique_item_unit_price'].'<br>'.$workimagepath.'</td>
		</tr>

		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td width="30%">Unit Price : '.$item['boutique_item_unit_price'].'<br>'.$workimagepath.'</td>
			<td width="5%"></td>
			<td width="30%">Unit Price : '.$item['boutique_item_unit_price'].'<br>'.$workimagepath.'</td>
			<td width="5%"></td>
			<td width="30%">Unit Price : '.$item['boutique_item_unit_price'].'<br>'.$workimagepath.'</td>
		</tr>

		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td width="30%">Unit Price : '.$item['boutique_item_unit_price'].'<br>'.$workimagepath.'</td>
			<td width="5%"></td>
			<td width="30%">Unit Price : '.$item['boutique_item_unit_price'].'<br>'.$workimagepath.'</td>
			<td width="5%"></td>
			<td width="30%">Unit Price : '.$item['boutique_item_unit_price'].'<br>'.$workimagepath.'</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td width="30%">Unit Price : '.$item['boutique_item_unit_price'].'<br>'.$workimagepath.'</td>
			<td width="5%"></td>
			<td width="30%">Unit Price : '.$item['boutique_item_unit_price'].'<br>'.$workimagepath.'</td>
			<td width="5%"></td>
			<td width="30%">Unit Price : '.$item['boutique_item_unit_price'].'<br>'.$workimagepath.'</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td width="30%">Unit Price : '.$item['boutique_item_unit_price'].'<br>'.$workimagepath.'</td>
			<td width="5%"></td>
			<td width="30%">Unit Price : '.$item['boutique_item_unit_price'].'<br>'.$workimagepath.'</td>
			<td width="5%"></td>
			<td width="30%">Unit Price : '.$item['boutique_item_unit_price'].'<br>'.$workimagepath.'</td>
		</tr>

	</table>

		</div>';

		// Print text using writeHTMLCell()
		$pdf->writeHTML($html, true, false, true, false, '');

		// ---------------------------------------------------------

		// Close and output PDF document
		// This method has several options, check the source code documentation for more information.
		$pdf->Output(time().'.pdf', 'I');

		//============================================================+
		// END OF FILE
		//============================================================+

  	}

  	function getIndianCurrency(float $number)
	{
	    $decimal = round($number - ($no = floor($number)), 2) * 100;
	    $hundred = null;
	    $digits_length = strlen($no);
	    $i = 0;
	    $str = array();
	    $words = array(0 => '', 1 => 'one', 2 => 'two',
	        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
	        7 => 'seven', 8 => 'eight', 9 => 'nine',
	        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
	        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
	        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
	        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
	        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
	        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
	    $digits = array('', 'hundred','thousand','lakh', 'crore');
	    while( $i < $digits_length ) {
	        $divider = ($i == 2) ? 10 : 100;
	        $number = floor($no % $divider);
	        $no = floor($no / $divider);
	        $i += $divider == 10 ? 1 : 2;
	        if ($number) {
	            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
	            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
	            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
	        } else $str[] = null;
	    }
	    $Rupees = implode('', array_reverse($str));
	    $paise = ($decimal) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
	    return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
	}

}
