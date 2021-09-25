<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Messages extends CI_Controller {

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

 			 
 			 //$this->load->model('Team');
 			 //$this->load->library('Zebra_Image');
			 $this->load->helper(array('cookie', 'admin'));
 			 
 			if(!$this->session->userdata('UserID')){
 				redirect(base_url().'login/', 'refresh');
 			}
 			
 			
 			 
  }

	

	public function dashboard(){

 		$data["works"] = $this->Work_model->m_getallorders();
 		$data["works_count"] = count($data["works"]);

 		$data["customers"] = $this->Customer_model->m_getallcustomers();
 		$data["customers_count"] = count($data["customers"]);

 		$data["tailors"] = $this->Tailor_model->m_getalltailors();
 		$data["tailors_count"] = count($data["tailors"]);

 		$data["works_today"] = $this->Work_model->m_gettodayworks();
 		$data["works_tomorrow"] = $this->Work_model->m_gettomorrowworks();
 		
        $data["bdata"] = $this->Work_model->getBoutique($this->session->userdata('BoutiqueID'));
        
		$this->load->view('sms/header');
		$this->load->view('sms/dashboard',@$data);
		$this->load->view('sms/footer');
	}

    public function updatepassword(){

		$this->load->view('boutique/header');
		$this->load->view('boutique/updatepassword');
		$this->load->view('boutique/footer');
	}

	public function savepassword(){

	  $this->load->library('form_validation');
      $this->load->helper(array('cookie', 'admin'));

      $this->form_validation->set_rules('current_password', 'Current Password', 'required');
      $this->form_validation->set_rules('new_password', 'New Password', 'required');
      $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required');

      if ($this->form_validation->run() == FALSE) {
          $this->session->set_flashdata('notification', 'Please enter all fields!');
			$this->session->set_flashdata('status', 'failure');
			redirect(base_url().'messages/updatepassword', 'refresh');
      }
      else {
          $user_password = crypt_password($this->input->post('current_password'));
          $currentpwdstatus = $this->Work_model->validatecurrentpassword($user_password);
          if($currentpwdstatus != TRUE){
			$this->session->set_flashdata('notification', 'Current password is invalid!');
			$this->session->set_flashdata('status', 'failure');
			redirect(base_url().'messages/updatepassword', 'refresh');
		}
      }

		if($this->input->post('new_password') != $this->input->post('confirm_password')){
			$this->session->set_flashdata('notification', 'New and Confirm password should match!');
			$this->session->set_flashdata('status', 'failure');
			redirect(base_url().'messages/updatepassword', 'refresh');
		}

		$user_new_password = crypt_password($this->input->post('new_password'));
		$this->Work_model->savepassword($user_new_password);

		$this->session->set_flashdata('notification', 'Password updated successfully!');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url().'messages/updatepassword', 'refresh');
	}
	
	
	public function customer(){

		$data["customers"] = $this->Customer_model->m_getallcustomers();
		$this->load->view('boutique/header');
		$this->load->view('boutique/customers',@$data);
		$this->load->view('boutique/footer');
	}
    
    
	
	public function addcustomer(){

		$this->load->view('boutique/header');
		$this->load->view('boutique/add-customer',@$data);
		$this->load->view('boutique/footer');
	}
	public function customerdetails(){

		$id = $this->uri->segment(3);
		$data["customer"] = $this->Customer_model->m_getcustomer($id);
		$this->load->view('boutique/header');
		$this->load->view('boutique/customer-details',@$data);
		$this->load->view('boutique/footer');
	}

	

	public function groups(){

		$data["groups"] = $this->Customer_model->m_getallgroups();
		$this->load->view('boutique/header');
		$this->load->view('boutique/groups',@$data);
		$this->load->view('boutique/footer');
	}

	public function addgroup(){

		$this->load->view('boutique/header');
		$this->load->view('boutique/add-group',@$data);
		$this->load->view('boutique/footer');
	}

	public function savegroup(){

		$this->Customer_model->m_addgroup();
		$this->session->set_flashdata('notification', 'New group added successfully!');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url().'boutique/groups', 'refresh');
	}

	

	

	


	public function updategroup(){

		$id = $this->uri->segment(3);
		$this->Customer_model->m_updategroup($id);
		$this->session->set_flashdata('notification', 'Group updated successfully!');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url().'boutique/groups', 'refresh');
	}

	public function removetailor(){

		$id = $this->uri->segment(3);
		$this->Tailor_model->m_removetailor($id);
		$data["tailors"] = $this->Tailor_model->m_getalltailors();
		$this->session->set_flashdata('notification', 'Tailor deleted!');
		$this->session->set_flashdata('status', 'danger');
		redirect(base_url().'boutique/tailor', 'refresh');
	}

	public function removegroup(){

		$id = $this->uri->segment(3);
		$this->Customer_model->m_removegroup($id);
		$this->session->set_flashdata('notification', 'Group deleted!');
		$this->session->set_flashdata('status', 'danger');
		redirect(base_url().'boutique/groups', 'refresh');
	}

	public function savecustomer(){

		$cID = $this->Customer_model->m_addcustomer();
		$data["customers"] = $this->Customer_model->m_getallcustomers();
		$this->session->set_flashdata('notification', 'New Customer added successfully!');
		$this->session->set_flashdata('status', 'success');
	    redirect(base_url().'messages/customer/', 'refresh');
	}
	
	public function updatecustomer(){

		$id = $this->uri->segment(3);
		$this->Customer_model->m_updatecustomer($id);
		$data["customer"] = $this->Customer_model->m_getcustomer($id);
		$this->session->set_flashdata('notification', 'Customer updated successfully!');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url().'messages/customer/', 'refresh');
	}
	
	public function removecustomer(){

		

		$id = $this->uri->segment(3);
		$this->Customer_model->m_removecustomer($id);
		$data["customers"] = $this->Customer_model->m_getallcustomers();
		$this->session->set_flashdata('notification', 'Customer deleted!');
		$this->session->set_flashdata('status', 'danger');
		redirect(base_url().'messages/customer/', 'refresh');
	}
	
	
	
	public function sendStatusMessage($orderid,$status){
		$boutique = $this->Work_model->m_getboutiquedetails();
		if($boutique['boutique_whatsapp_msg_status'] == 0 && $boutique['boutique_sms_msg_status'] == 0){
				return FALSE;
			}
		elseif($boutique['boutique_whatsapp_msg_status'] == 1){
			//$this->sendStatusMessageWhatsapp($orderid,$status);
		}
		elseif($boutique['boutique_sms_msg_status'] == 1){
			$this->sendStatusMessageSMS($orderid,$status);
		}

	}

	public function sendStatusMessageSMS($orderid,$status){
		$username="boutiquemanagerin";
		$password ="Boutique@123#";
		$sender="BTQMNG";

		$boutique = $this->Work_model->m_getboutiquedetails();
		$orderdetails = $this->Work_model->m_getordercusdetails($orderid);
		$number=$orderdetails['boutique_customer_ph'];
		  if(@$number){

		  	$customer = $orderdetails['boutique_customer_name'] ? ucwords($orderdetails['boutique_customer_name']) : 'Customer';
			$boutiquename = $boutique['boutique_name'];

			if($status == 3){

				$message = "Dear ".$customer.", \r\n \r\n";
				$message.= "Greetings from ".$boutiquename." Boutique ! \r\n \r\n";
				$message.= "Your order no ".$orderdetails['boutique_order_number']." has been completed and ready for delivery. \r\n";
				$message.= "Your bill amount is Rs ".$orderdetails['boutique_order_grandtotal']."/- . \r\n \r\n";
				$message.= "Thank you for doing business with us.";

			}
			else{
				$message = "Dear ".$customer.", <br />";
				$message.= "Greetings from ".$boutiquename." Boutique !<br />";
				$message.= "Your order no ".$orderdetails['boutique_order_number']." has been delivered.<br />";
				$message.= "Thank you for doing business with us.";
			}

			$url="login.bulksmsgateway.in/sendmessage.php?user=".urlencode($username)."&password=".urlencode($password)."&mobile=".urlencode($number)."&sender=".urlencode($sender)."&message=".urlencode($message)."&type=".urlencode('3'); 
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$curl_scraped_page = curl_exec($ch);
			curl_close($ch); 
			$this->Work_model->m_addstatusmsg($message,$orderdetails['boutique_customer_id'],$number,$curl_scraped_page);
		  }

		  return TRUE;
	}

	
	public function removework(){
 		
		$id = $this->uri->segment(3);
		$orderid = $this->Work_model->m_removework($id);
		$this->session->set_flashdata('notification', 'Work deleted!');
		$this->session->set_flashdata('status', 'danger');
		redirect(base_url().'boutique/works/'.$orderid, 'refresh');
	}

	public function removeorder(){
 		
		$id = $this->uri->segment(3);
		$this->Work_model->m_removeorder($id);
		$this->session->set_flashdata('notification', 'Order deleted!');
		$this->session->set_flashdata('status', 'danger');
		redirect(base_url().'boutique/orders/', 'refresh');
	}

	public function logout() {
        $this->Tailors->logout();
        redirect(base_url()."boutique");
        }
	
	public function addpayment(){

 		$data["orderid"] = $this->uri->segment(3);
		$data["orderpayments"] = $this->Work_model->m_getorderdetails($this->uri->segment(3));
		$this->load->view('boutique/header');
		$this->load->view('boutique/add-payment',@$data);
		$this->load->view('boutique/footer');
	}
	
	public function savepayment(){

		$orderId = $this->Work_model->m_addpayment();
		$this->session->set_flashdata('notification', 'Payment added successfully!');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url().'boutique/addpayment/'.$this->input->post('orderid'), 'refresh');
	}
	
	public function phonevalidate(){
  
		  $phone_validate = $this->input->post('phone_validate_');
          if ($this->Customer_model->phonevalidate($phone_validate)) {
              return print_r(json_encode(array('status'=>'success')));
          } else {
              return print_r(json_encode(array('status'=>'failure')));
          }

	}
	
	public function sendmessage(){
		$data["customerid"] = @$this->uri->segment(3);
		$data["customers"] = $this->Customer_model->m_getallcustomers();
		$this->load->view('sms/header');
		$this->load->view('sms/sendmessage',@$data);
		$this->load->view('sms/footer');
	}

	public function sendingmessage(){

		ini_set('max_execution_time', 0); // for infinite time of execution
		
		ini_set('memory_limit','2048M');
		
		set_time_limit(0);

		$username="boutiquemanagerin";
		$password ="Boutique@123#";
		$sender="ANUPMA";
		$boutique = $this->Work_model->m_getboutiquedetails();
		if($this->input->post('select_type') == 2){
		$customers = $this->input->post('custselected');
		foreach($customers as $customer){
		$customerdetails = $this->Work_model->m_getcustomer($customer);
		$number=$customerdetails['boutique_customer_ph'];
		  if(@$number){

		  	$customer = $customerdetails['boutique_customer_name'] ? ucwords($customerdetails['boutique_customer_name']) : 'Customer';
			$boutiquename = $boutique['boutique_name'];

				$message = "Dear ".$customer.", \r\n \r\n";
				$message.= "Greetings from ".$boutiquename." ! \r\n \r\n";
				$message.= $this->input->post('message');

			$url="login.bulksmsgateway.in/sendmessage.php?user=".urlencode($username)."&password=".urlencode($password)."&mobile=".urlencode($number)."&sender=".urlencode($sender)."&message=".urlencode($message)."&type=".urlencode('203'); 
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$curl_scraped_page = curl_exec($ch);
			curl_close($ch); 
			$this->Work_model->m_addstatusmsg($message,$customerdetails['boutique_customer_id'],$number,$curl_scraped_page);
			$this->Work_model->m_addmsgcount($message,1);
		  }
		}
		}
		elseif($this->input->post('select_type') == 1){
			$customers = $this->Customer_model->m_getallcustomers();
			$numberlist ='';
			$i = 0;
			foreach($customers as $customerdetails){
				$number=$customerdetails['boutique_customer_ph'];
			  	if(@$number){
				  	if($numberlist !=''){
				  		$numberlist .= ",$number";
				  	}
				  	else{
				  		$numberlist = "$number";
				  	}
				}
				$i++;
			}

			$boutiquename = $boutique['boutique_name'];

			$message = "Dear Customer, \r\n \r\n";
			$message.= "Greetings from ".$boutiquename." ! \r\n \r\n";
			$message.= $this->input->post('message');

			$url="login.bulksmsgateway.in/sendmessage.php?user=".urlencode($username)."&password=".urlencode($password)."&mobile=".urlencode($numberlist)."&sender=".urlencode($sender)."&message=".urlencode($message)."&type=".urlencode('203'); 
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$curl_scraped_page = curl_exec($ch);
			curl_close($ch); 
			$this->Work_model->m_addstatusmsg($message,$customerdetails['boutique_customer_id'],$numberlist,$curl_scraped_page);
			$this->Work_model->m_addmsgcount($message,$i);
		}
        
		$this->session->set_flashdata('notification', 'Message send successfully!');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url().'messages/sendmessage/', 'refresh');
	}

	



  	


public function bill(){

	if( $this->session->userdata('BoutiqueID') == 16){
  		$id = $this->uri->segment(3);
  		$work = $this->Work_model->m_getorderdetails($id);
  		$orders = $this->Work_model->m_getallworks($id);
  		$orderdata = '';
  		$i = 0;
  		 foreach ($orders as $key => $order) {
  		 	$i++;
  			
			if(@$order["boutique_work_handwork"] && @$order["boutique_work_material_remaining"]){
				
				$orderdata .= '
							<tr>
								<td width="10%"  rowspan="3">'.@$i.'</td>
								<td width="45%">'.@$order["boutique_work_name"].'</td>
								<td width="35%">'.@$order["boutique_work_material_desc"].'</td>
								<td width="15%">'.@$order["boutique_work_price"].'</td>
							</tr>
							<tr>
								<td width="45%">Handwork</td>
								<td width="35%"></td>
								<td width="15%">'.@$order["boutique_work_handwork"].'</td>
							</tr>
							<tr>
								<td width="45%">Material Remaining</td>
								<td width="35%"></td>
								<td width="15%">'.@$order["boutique_work_material_remaining"].'</td>
							</tr>';
				}
				elseif(@!$order["boutique_work_handwork"] && @$order["boutique_work_material_remaining"]){
						$orderdata .= '
							<tr>
								<td width="10%"  rowspan="2">'.@$i.'</td>
								<td width="45%">'.@$order["boutique_work_name"].'</td>
								<td width="35%">'.@$order["boutique_work_material_desc"].'</td>
								<td width="15%">'.@$order["boutique_work_price"].'</td>
							</tr>
							<tr>
								<td width="45%">Material Remaining</td>
								<td width="35%"></td>
								<td width="15%">'.@$order["boutique_work_material_remaining"].'</td>
							</tr>';
					}
				elseif (@$order["boutique_work_handwork"] && @!$order["boutique_work_material_remaining"]) {
						$orderdata .= '
							<tr>
								<td width="10%"  rowspan="2">'.@$i.'</td>
								<td width="45%">'.@$order["boutique_work_name"].'</td>
								<td width="35%">'.@$order["boutique_work_material_desc"].'</td>
								<td width="15%">'.@$order["boutique_work_price"].'</td>
							</tr>
							<tr>
								<td width="45%">Handwork</td>
								<td width="35%"></td>
								<td width="15%">'.@$order["boutique_work_handwork"].'</td>
							</tr>';
				}
				else{
						$orderdata .= '
						<tr>
							<td width="10%">'.@$i.'</td>
							<td width="45%">'.@$order["boutique_work_name"].'</td>
							<td width="35%">'.@$order["boutique_work_material_desc"].'</td>
							<td width="15%">'.@$order["boutique_work_price"].'</td>
						</tr>';
				}
				
			}

  		ini_set('max_execution_time', 0); // for infinite time of execution

  		$this->load->library('Pdf');
  		
  		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Nicola Asuni');
		$pdf->SetTitle($work['boutique_name']);
		$pdf->SetSubject($work['boutique_work_name']);
		$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

		// set default header data
		//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 061', PDF_HEADER_STRING);

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
		
		$pdf->AddPage();
		
		if( $this->session->userdata('BoutiqueID') == 7 || $this->session->userdata('BoutiqueID') == 5 || $this->session->userdata('BoutiqueID') == 14 || $this->session->userdata('BoutiqueID') == 16 || $this->session->userdata('BoutiqueID') == 22){
			$logo =	'';
		}
		elseif($this->session->userdata('BoutiqueID') == 8){
			$logo = '<img height="80" width="210" src="http://boutiquemanager.in/boutiquemanagerdev/uploads/logo/beboo-logo.png">';
		}
		else{
		    $logo =	'<img src="http://boutiquemanager.in/boutiquemanager/assets/images/images.jpg" height="100" width="160" />';
		}
		
		if($this->session->userdata('BoutiqueID') == 22){
			$addre_boutique = '
			INVOICE #'.$work['boutique_bill_number'].' <br>
			Order Number:'.$work['boutique_order_number'].' <br>
			Order Date: '.$work['boutique_order_date'].'<br>
			Trail Date: '.$work['boutique_trail_date'].'<br>
			Delivery Date: '.$work['boutique_order_delivery_date'].'<br>
			Salesperson: '.$work['boutique_attented_by'].'<br>';
		}
		else{
			$addre_boutique = '
			INVOICE #'.$work['boutique_bill_number'].' <br>
			Order Number:'.$work['boutique_order_number'].' <br>
			Order Date: '.$work['boutique_order_date'].'<br>
			Delivery Date: '.$work['boutique_order_delivery_date'].'<br>';
		}
		// Set some content to print
		$html ='		<table width="100%">
			<tr>
				<td width="60%">
				'.$logo.'
					<br>
				</td>
				<td width="40%">
					<b>'.$work['boutique_name'].'.</b><br>'.
				$work['boutique_address'].	'<br>
			Phone: '.$work['boutique_ph'].'<br>
			Email: '.$work['boutique_email'].'<br>
				</td>
			</tr>
		</table>
		<div style="padding: 15px; background-color: #eeeeee;">
		'.$addre_boutique.'
		</div>
		<table>
			<tr>
				<td>&nbsp;</td>
			</tr>
		</table>
		<div>
			Invoiced To<br>
			<b>'.$work['boutique_customer_name'].'</b><br>
			'.$work['boutique_customer_address'].'<br>
			Phone:'.$work['boutique_customer_ph'].'<br>
			Email:'.$work['boutique_customer_email'].'<br>
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
				<td width="10%">Qty</td>
				<td width="45%"><b>Name</b></td>
				<td width="35%"><b>Remarks</b></td>
				<td width="15%"><b>Total</b></td>
			</tr>
			'.$orderdata.'
			<tr style="padding: 15px; background-color: #eeeeee;">
				<td width="10%"></td>
				<td width="45%"><b>Total</b></td>
				<td width="35%"></td>
				<td width="15%"><b>Rs '.$work['boutique_order_grandtotal'].'</b></td>
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
		else{
			$id = $this->uri->segment(3);
	  		$work = $this->Work_model->m_getorderdetails($id);
	  		$orders = $this->Work_model->m_getallworks($id);
	  		$orderdata = '';
	  		$i = 0;
  		 	foreach ($orders as $key => $order) {
  		 			$i++;
  					$workimage = @$order['boutique_work_image'];
					$orderdata .= '
						<tr>
							<td width="25%">'.@$i.'</td>
							<td width="60%">'.@$order["boutique_work_name"].'</td>
							<td width="25%">'.@$order["boutique_work_price"].'</td>
						</tr>';
			}

  		ini_set('max_execution_time', 0); // for infinite time of execution

  		$this->load->library('Pdf');
  		
  		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Nicola Asuni');
		$pdf->SetTitle($work['boutique_name']);
		$pdf->SetSubject($work['boutique_work_name']);
		$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

		// set default header data
		//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 061', PDF_HEADER_STRING);

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
		
		$pdf->AddPage();
		
		if( $this->session->userdata('BoutiqueID') == 7 || $this->session->userdata('BoutiqueID') == 5 || $this->session->userdata('BoutiqueID') == 14 || $this->session->userdata('BoutiqueID') == 16 || $this->session->userdata('BoutiqueID') == 22 || $this->session->userdata('BoutiqueID') ==32){
			$logo =	'';
		}
		elseif($this->session->userdata('BoutiqueID') == 8){
			$logo = '<img height="80" width="210" src="http://boutiquemanager.in/boutiquemanagerdev/uploads/logo/beboo-logo.png">';
		}
		else{
		    $logo =	'<img src="http://boutiquemanager.in/boutiquemanager/assets/images/images.jpg" height="100" width="160" />';
		}
		
		// Set some content to print
		if($this->session->userdata('BoutiqueID') == 22){
			$addre_boutique = '
			INVOICE #'.$work['boutique_bill_number'].' <br>
			Order Number:'.$work['boutique_order_number'].' <br>
			Job Number:'.$work['boutique_order_form_number'].' <br>
			Order Date: '.$work['boutique_order_date'].'<br>
			Trail Date: '.$work['boutique_trail_date'].'<br>
			Delivery Date: '.$work['boutique_order_delivery_date'].'<br>
			Salesperson: '.$work['boutique_attented_by'].'<br>';
		}
		else{
			$addre_boutique = '
			INVOICE #'.$work['boutique_bill_number'].' <br>
			Order Number:'.$work['boutique_order_number'].' <br>
			Order Date: '.$work['boutique_order_date'].'<br>
			Delivery Date: '.$work['boutique_order_delivery_date'].'<br>';
		}
		// Set some content to print
		$html ='		<table width="100%">
			<tr>
				<td width="60%">
				'.$logo.'
					<br>
				</td>
				<td width="40%">
					<b>'.$work['boutique_name'].'.</b><br>'.
				$work['boutique_address'].	'<br>
			Phone: '.$work['boutique_ph'].'<br>
			Email: '.$work['boutique_email'].'<br>
				</td>
			</tr>
		</table>
		<div style="padding: 15px; background-color: #eeeeee;">
		'.$addre_boutique.'
		</div>
		<table>
			<tr>
				<td>&nbsp;</td>
			</tr>
		</table>
		<div>
			Invoiced To<br>
			<b>'.$work['boutique_customer_name'].'</b><br>
			'.$work['boutique_customer_address'].'<br>
			Phone:'.$work['boutique_customer_ph'].'<br>
			Email:'.$work['boutique_customer_email'].'<br>
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
				<td width="25%"><b>Rs '.$work['boutique_order_grandtotal'].'</b></td>
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
  	
public function bill1(){

  		$id = $this->uri->segment(3);
  		$work = $this->Work_model->m_getorderdetails($id);
  		$orders = $this->Work_model->m_getallworks($id);
  		$orderdata = '';
  		$i = 0;
  		 		foreach ($orders as $key => $order) {
  		 			$i++;
  			$workimage = @$order['boutique_work_image'];
  			$orderdata .= '
			<tr>
				<td width="25%">'.@$i.'</td>
				<td width="60%">'.@$order["boutique_work_name"].'</td>
				<td width="25%">'.@$order["boutique_work_price"].'</td>
			</tr>';
			}
  		ini_set('max_execution_time', 0); // for infinite time of execution

  		$this->load->library('Pdf');
  		
  		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle($work['boutique_name']);
$pdf->SetSubject($work['boutique_work_name']);
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 061', PDF_HEADER_STRING);

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
		
		/*
		if(count($orders) > 3){
			$pdf->AddPage();
		}
		else{
			$pdf->AddPage('L', 'A5');
		}
		*/
		$pdf->AddPage();
		
		if( $this->session->userdata('BoutiqueID') == 7 || $this->session->userdata('BoutiqueID') == 5|| $this->session->userdata('BoutiqueID') == 14|| $this->session->userdata('BoutiqueID') == 1 || $this->session->userdata('BoutiqueID') == 16){
			$logo =	'';
		}
		else{
		    $logo =	'<img src="http://boutiquemanager.in/boutiquemanager/assets/images/images.jpg" height="100" width="160" />';
		}
		
		// Set some content to print
		$html ='		<table width="100%">
			<tr>
				<td width="60%">
				'.$logo.'
					<br>
				</td>
				<td width="40%">
					<b>'.$work['boutique_name'].'.</b><br>'.
				$work['boutique_address'].	'<br>
			Phone: '.$work['boutique_ph'].'<br>
			Email: '.$work['boutique_email'].'<br>
				</td>
			</tr>
		</table>
		<div style="padding: 15px; background-color: #eeeeee;">
		INVOICE #'.$work['boutique_bill_number'].' <br>
		Order Number:'.$work['boutique_order_number'].' <br>
		Order Form Number:'.$work['boutique_order_form_number'].' <br>
		Order Date: '.$work['boutique_order_date'].'<br>
		Delivery Date: '.$work['boutique_order_delivery_date'].'<br>
		</div>
		<table>
			<tr>
				<td>&nbsp;</td>
			</tr>
		</table>
		<div>
			Invoiced To<br>
			<b>'.$work['boutique_customer_name'].'</b><br>
			'.$work['boutique_customer_address'].'<br>
			Phone:'.$work['boutique_customer_ph'].'<br>
			Email:'.$work['boutique_customer_email'].'<br>
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
				<td width="25%"><b>Rs '.$work['boutique_order_grandtotal'].'</b></td>
			</tr>
		</table>';

/*
$html .= '<style>'.file_get_contents('http://boutiquemanager.in/boutiquemanager/assets/bower_components/bootstrap/dist/css/bootstrap.min.css').'</style>';

$html .= '<style>'.file_get_contents('http://boutiquemanager.in/boutiquemanager/assets/dist/css/AdminLTE.min.css').'</style>';
*/


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
    
    public function reports(){
		$data["date_from_report"] = $this->input->post('date_from_report');
		$data["date_to_report"] = $this->input->post('date_to_report');
		$data["reports"] = $this->Work_model->getreports();
		$arr = $data["reports"];
		$data["total_expences_stitch"] = array_sum(array_map(function($item) { 
    		return $item['boutique_work_price']; 
		}, $arr));
		$data["total_expences_handwork"] = array_sum(array_map(function($item) { 
    		return $item['boutique_work_handwork']; 
		}, $arr));
		$data["boutique_work_material_remaining"] = array_sum(array_map(function($item) { 
    		return $item['boutique_work_material_remaining']; 
		}, $arr));

		$this->load->view('boutique/header');
		$this->load->view('boutique/reports',@$data);
		$this->load->view('boutique/footer');
	}

}