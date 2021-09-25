<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Boutique extends CI_Controller
{

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

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->database();
		$this->load->model('Tailor_model');
		$this->load->model('Customer_model');
		$this->load->model('Work_model');
		$this->load->model('Tailors');
		$this->load->model('Billing_model');


		//$this->load->model('Team');
		//$this->load->library('Zebra_Image');
		$this->load->helper(array('cookie', 'admin'));

		if (!$this->session->userdata('UserID')) {
			redirect(base_url() . 'login/', 'refresh');
		}
	}

	// || $this->session->userdata('UserRole') != 2




	public function dashboard()
	{


		$data["works"] = $this->Work_model->m_getallorders();
		$data["works_count"] = count($data["works"]);

		$data["customers"] = $this->Customer_model->m_getallcustomers();
		$data["customers_count"] = count($data["customers"]);

		$data["tailors"] = $this->Tailor_model->m_getalltailors();
		$data["tailors_count"] = count($data["tailors"]);

		$data["works_today"] = $this->Work_model->m_gettodayworks();
		$data["works_tomorrow"] = $this->Work_model->m_gettomorrowworks();

		$this->Customer_model->updatetenantamount();
	
		$this->Billing_model->updatedatestracture();
	
       
        if($this->session->userdata('UserID') ==136) {
        $data["properties"] = $this->Billing_model->getproperties();
		$data["properties_count"] = count($data["properties"]);
        }
        
		$this->load->view('boutique/header');
		if (@$this->session->userdata('BoutiqueStitchingStatus') == 1) {
			$this->load->view('boutique/dashboard', @$data);
		} else {
			$this->load->view('boutique/dashboard_billing', @$data);
		}
		$this->load->view('boutique/footer');
	}

	public function updatepassword()
	{

		$this->load->view('boutique/header');
		$this->load->view('boutique/updatepassword');
		$this->load->view('boutique/footer');
	}

	public function savepassword()
	{

		$this->load->library('form_validation');
		$this->load->helper(array('cookie', 'admin'));

		$this->form_validation->set_rules('current_password', 'Current Password', 'required');
		$this->form_validation->set_rules('new_password', 'New Password', 'required');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('notification', 'Please enter all fields!');
			$this->session->set_flashdata('status', 'failure');
			redirect(base_url() . 'boutique/updatepassword', 'refresh');
		} else {
			$user_password = crypt_password($this->input->post('current_password'));
			$currentpwdstatus = $this->Work_model->validatecurrentpassword($user_password);
			if ($currentpwdstatus != TRUE) {
				$this->session->set_flashdata('notification', 'Current password is invalid!');
				$this->session->set_flashdata('status', 'failure');
				redirect(base_url() . 'boutique/updatepassword', 'refresh');
			}
		}

		if ($this->input->post('new_password') != $this->input->post('confirm_password')) {
			$this->session->set_flashdata('notification', 'New and Confirm password should match!');
			$this->session->set_flashdata('status', 'failure');
			redirect(base_url() . 'boutique/updatepassword', 'refresh');
		}

		$user_new_password = crypt_password($this->input->post('new_password'));
		$this->Work_model->savepassword($user_new_password);

		$this->session->set_flashdata('notification', 'Password updated successfully!');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url() . 'boutique/updatepassword', 'refresh');
	}


	public function customer()
	{
		$boutique = $this->Work_model->m_getboutiquedetails();
		$data["stitchstatus"] = $boutique['boutique_stitching_status'];
		$data["customers"] = $this->Customer_model->m_getallcustomers();
		$this->load->view('boutique/header');
		$this->load->view('boutique/customers', @$data);
		$this->load->view('boutique/footer');
	}

	public function measurements()
	{

		$id = $this->uri->segment(3);
		$data["customerid"] = $this->uri->segment(3);
		$data["customers"] = $this->Customer_model->m_getallcustomers();
		$data["works"] = $this->Work_model->m_getallorders($id);
		$data["customer"] = $this->Customer_model->m_getcustomer($id);
		$data["measurement"] = $this->getAllmeasurements($id);

		$data["typeid"] = $this->uri->segment(4);

		$this->load->view('boutique/header');
		if ($this->session->userdata('BoutiqueID') == 5) {
			$this->load->view('boutique/measurements_naira', @$data);
		} elseif ($this->session->userdata('BoutiqueID') == 6) {
			$this->load->view('boutique/measurements_trends', @$data);
		} elseif ($this->session->userdata('BoutiqueID') == 7) {
			$this->load->view('boutique/measurements_minnara', @$data);
		} elseif ($this->session->userdata('BoutiqueID') == 12) {
			$this->load->view('boutique/measurements_pagestudio', @$data);
		} elseif ($this->session->userdata('BoutiqueID') == 8 || $this->session->userdata('BoutiqueID') == 9 || $this->session->userdata('BoutiqueID') == 10) {
			$this->load->view('boutique/measurements_beboo', @$data);
		} elseif ($this->session->userdata('BoutiqueID') == 14) {
			$this->load->view('boutique/measurements_jaz', @$data);
		} elseif ($this->session->userdata('BoutiqueID') == 15) {
			$this->load->view('boutique/measurements_madams', @$data);
		} elseif ($this->session->userdata('BoutiqueID') == 25) {
			$this->load->view('boutique/measurements_ndotcouture', @$data);
		} elseif ($this->session->userdata('BoutiqueID') == 27) {
			$this->load->view('boutique/measurements_fulki', @$data);
		} elseif ($this->session->userdata('BoutiqueID') == 33) {
			$this->load->view('boutique/measurements_aroya', @$data);
		} elseif ($this->session->userdata('BoutiqueID') == 35) {
			$this->load->view('boutique/measurements_dandjavenue', @$data);
		} elseif ($this->session->userdata('BoutiqueID') == 57) {
			$this->load->view('boutique/measurements_zmaata', @$data);
		} elseif ($this->session->userdata('BoutiqueID') == 61) {
			$this->load->view('boutique/measurements_Ethereal', @$data);
		} 
		else {
			$this->load->view('boutique/measurements_gcselect', @$data);
		}
		$this->load->view('boutique/footer');
	}

	public function addcustomer()
	{
	    if ($this->session->userdata('UserID') == 136) {
		$data["properties"] = $this->Billing_model->getproperties();
	    }
		$this->load->view('boutique/header');
		$this->load->view('boutique/add-customer', @$data);
		$this->load->view('boutique/footer');
	}
	public function customerdetails()
	{

		$id = $this->uri->segment(3);
		if ($this->session->userdata('UserID') == 136) {
		$data["properties"] = $this->Billing_model->getproperties();
	    }
		$boutique = $this->Work_model->m_getboutiquedetails();
		$data["stitchstatus"] = $boutique['boutique_stitching_status'];
		$data["works"] = $this->Work_model->m_getallorders($id);
		$data["customer"] = $this->Customer_model->m_getcustomer($id);
		$data["measurement"] = $this->getAllmeasurements($id);
		$data["payment_history"]=$this->Customer_model->payment_history($id);
		$this->load->view('boutique/header');
		$this->load->view('boutique/customer-details', @$data);
		$this->load->view('boutique/footer');
	}
	public function tailor()
	{

		$data["tailors"] = $this->Tailor_model->m_getalltailors1();

		$this->load->view('boutique/header');
		$this->load->view('boutique/tailors', @$data);
		$this->load->view('boutique/footer');
	}

	public function addtailor()
	{
		$data["stafftype"] = $this->Tailor_model->stafftype();
	
		$this->load->view('boutique/header');
		$this->load->view('boutique/add-tailor', @$data);
		$this->load->view('boutique/footer');
	}

	public function tailordetails()
	{

		$data["stafftype"] = $this->Tailor_model->stafftype();
		$id = $this->uri->segment(3);
		$data["tailor"] = $this->Tailor_model->m_gettailor($id);
		$data["works"] = $this->Work_model->m_getallTailorworks($id);
		
		$data["monthreport"] = $this->Work_model->m_getallmonthreport($id);
		$id2 = $this->uri->segment(4);
		
		$this->load->view('boutique/header');
		$this->load->view('boutique/tailor-details', @$data);
		$this->load->view('boutique/footer');
	}

	public function orders()
	{

		$customerid = $this->uri->segment(3);
		$orderdate = $this->uri->segment(4);

		$startdate = $this->input->post('start_date_order');
		$enddate = $this->input->post('end_date_order');

		$data["works"] = $this->Work_model->m_getallorders($customerid, $orderdate, $startdate, $enddate);

		//$data["works"] = $this->Work_model->m_getallorders($customerid,$orderdate);

		$data["customerid"] = $customerid;
		$data["boutiqueid"] = $this->session->userdata('BoutiqueID');

		$data["startdate"] = $startdate;
		$data["enddate"] = $enddate;

		$this->load->view('boutique/header');
		$this->load->view('boutique/orders', @$data);
		$this->load->view('boutique/footer');
	}

	public function works()
	{
		$orderid = $this->uri->segment(3);
		$data["works"] = $this->Work_model->m_getallworks($orderid);
		$data["payments"] = $this->Work_model->m_getallpayments($orderid);
		$data["orderid"] = $orderid;
		$this->load->view('boutique/header');
		$this->load->view('boutique/works', @$data);
		$this->load->view('boutique/footer');
	}

	public function addwork()
	{

		$data["customerid"] = $this->uri->segment(3);
		$data["orderid"] = $this->uri->segment(4);
		$data["customers"] = $this->Customer_model->m_getallcustomers();
		$data["tailors"] = $this->Tailor_model->m_getalltailors();

        $id= $data["customerid"];
		$data["cust"] = $this->Customer_model->m_getcustomer($id);
	
		if ($this->session->userdata('BoutiqueID') == 27) {
			$data["designers"] = $this->Tailor_model->m_getallstaffwithtype(2);
			$data["handworkers"] = $this->Tailor_model->m_getallstaffwithtype(3);
			$data["machine"] = $this->Tailor_model->m_getallstaffwithtype(4);
			$data["finishing"] = $this->Tailor_model->m_getallstaffwithtype(5);
		}

		if ($this->session->userdata('BoutiqueID') == 33) {
			$data["tailors"] = $this->Tailor_model->m_getallstaffwithtype(1);
			$data["cuttingmaster"] = $this->Tailor_model->m_getallstaffwithtype(2);
			$data["embroidery"] = $this->Tailor_model->m_getallstaffwithtype(3);
			$data["attended"] = $this->Tailor_model->m_getallstaffwithtype(4);
		}

		$this->load->view('boutique/header');
		$this->load->view('boutique/add-work', @$data);
		$this->load->view('boutique/footer');
	}

	public function workdetails()
	{

		$id = $this->uri->segment(3);
		$data["customers"] = $this->Customer_model->m_getallcustomers();
		$data["tailors"] = $this->Tailor_model->m_getalltailors();

		if ($this->session->userdata('BoutiqueID') == 27) {
			$data["designers"] = $this->Tailor_model->m_getallstaffwithtype(2);
			$data["handworkers"] = $this->Tailor_model->m_getallstaffwithtype(3);
			$data["machine"] = $this->Tailor_model->m_getallstaffwithtype(4);
			$data["finishing"] = $this->Tailor_model->m_getallstaffwithtype(5);
			$data["worktailor"] = $this->Work_model->m_getworkstaffwithtype(1, $id);
			$data["workdesigner"] = $this->Work_model->m_getworkstaffwithtype(2, $id);
			$data["workhand"] = $this->Work_model->m_getworkstaffwithtype(3, $id);
			$data["workmachine"] = $this->Work_model->m_getworkstaffwithtype(4, $id);
			$data["workfinish"] = $this->Work_model->m_getworkstaffwithtype(5, $id);
			$data["workpurchase"] = $this->Work_model->m_getworkpurchaseitem($id);
		}

		if ($this->session->userdata('BoutiqueID') == 33) {
			$data["measurement"] = $this->getAllworkmeasurements($id);
			$data["tailors"] = $this->Tailor_model->m_getallstaffwithtype(1);
			$data["cuttingmaster"] = $this->Tailor_model->m_getallstaffwithtype(2);
			$data["embroidery"] = $this->Tailor_model->m_getallstaffwithtype(3);
			$data["attended"] = $this->Tailor_model->m_getallstaffwithtype(4);

			$data["worktailor"] = $this->Work_model->m_getworkstaffwithtype(1, $id);
			$data["workcuttingmaster"] = $this->Work_model->m_getworkstaffwithtype(2, $id);
			$data["workembroidery"] = $this->Work_model->m_getworkstaffwithtype(3, $id);
			$data["workattended"] = $this->Work_model->m_getworkstaffwithtype(4, $id);
		}

		$work_data = $this->Work_model->m_getwork($id);
		//print_r($work_data);
		$data["work"] = $work_data;
		$data["payments"] = $this->Work_model->m_getallpayments($work_data['boutique_order_id']);

		$this->load->view('boutique/header');
		$this->load->view('boutique/work-details', @$data);
		$this->load->view('boutique/footer');
	}
	////////////////////////////
	public function savetailor()
	{

		if(@$_FILES['clothimg']['name']){
			@$image = @basename($_FILES['clothimg']['name']);
			@$extension  = strtolower(pathinfo($image,PATHINFO_EXTENSION));
			@$newfileName = time().rand()."." . $extension;
			$uploaddir = $this->config->item('project_path')."uploads/work/";
			$uploadfile = $uploaddir . $newfileName;
			if (@move_uploaded_file(@$_FILES['clothimg']['tmp_name'], $uploadfile)) {
			// $this->Work_model->m_addwork($newfileName);
			$this->Tailor_model->m_addtailor($newfileName);
		
		}
		}
		else{
			$newfileName = '';
			// $orderId = $this->Work_model->m_addwork($newfileName);		
			$this->Tailor_model->m_addtailor($newfileName);
		
		}	
		


		// $this->Tailor_model->m_addtailor();
		$data["tailors"] = $this->Tailor_model->m_getalltailors();

		if ($this->session->userdata('BoutiqueID') == 27 || $this->session->userdata('BoutiqueID') == 33) {
			$this->session->set_flashdata('notification', 'New staff added successfully!');
		} else {
			$this->session->set_flashdata('notification', 'New Staff added successfully!');
		}

		$this->session->set_flashdata('status', 'success');
		redirect(base_url() . 'boutique/tailor', 'refresh');
	}

	public function updatetailor()
	{

		$id = $this->uri->segment(3);


		$newfileName = "";
		@$image = @basename($_FILES['clothimg']['name']);
		if($image) {
			@$extension  = strtolower(pathinfo($image,PATHINFO_EXTENSION));
			@$newfileName = time().rand()."." . $extension;
			$uploaddir = $this->config->item('project_path')."uploads/work/";
			$uploadfile = $uploaddir . $newfileName;
		}
		if($newfileName != "") {
			move_uploaded_file(@$_FILES['clothimg']['tmp_name'], $uploadfile);
		}
//		$this->Work_model->m_updatework($id,$newfileName);



		$this->Tailor_model->m_updatetailor($id,$newfileName);
		$data["tailor"] = $this->Tailor_model->m_gettailor($id);
		$data["works"] = $this->Work_model->m_getallTailorworks($id);

		if ($this->session->userdata('BoutiqueID') == 27 || $this->session->userdata('BoutiqueID') == 33) {
			$this->session->set_flashdata('notification', 'Staff updated successfully!');
		} else {
			$this->session->set_flashdata('notification', 'Tailor updated successfully!');
		}

		$this->session->set_flashdata('status', 'success');
		redirect(base_url() . 'boutique/tailor', 'refresh');
	}
	public function removetailor()
	{

		$id = $this->uri->segment(3);
		$this->Tailor_model->m_removetailor($id);
		$data["tailors"] = $this->Tailor_model->m_getalltailors();
		$this->session->set_flashdata('notification', 'Tailor deleted!');
		$this->session->set_flashdata('status', 'danger');
		redirect(base_url() . 'boutique/tailor', 'refresh');
	}

	public function savecustomer()
	{

		$boutique = $this->Work_model->m_getboutiquedetails();
		$cID = $this->Customer_model->m_addcustomer();
		$data["customers"] = $this->Customer_model->m_getallcustomers();
		$this->session->set_flashdata('notification', 'New Customer added successfully!');
		$this->session->set_flashdata('status', 'success');
		if ($this->session->userdata('UserID') != 119) {
			if ($boutique['boutique_stitching_status'] == 1) {
				redirect(base_url() . 'boutique/addwork/' . $cID, 'refresh');
			} else {
				redirect(base_url() . 'boutique/customer/', 'refresh');
			}
		} else {
			redirect(base_url() . 'boutique/addcustomer/', 'refresh');
		}
	}

	public function updatecustomer()
	{

		$id = $this->uri->segment(3);
		$this->Customer_model->m_updatecustomer($id);
		$data["customer"] = $this->Customer_model->m_getcustomer($id);
		$data["measurement"] = $this->getAllmeasurements($id);
		$this->session->set_flashdata('notification', 'Customer updated successfully!');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url() . 'boutique/customerdetails/' . $id, 'refresh');
	}

	public function removecustomer()
	{



		$id = $this->uri->segment(3);
		$this->Customer_model->m_removecustomer($id);
		$data["customers"] = $this->Customer_model->m_getallcustomers();
		$this->session->set_flashdata('notification', 'Customer deleted!');
		$this->session->set_flashdata('status', 'danger');
		redirect(base_url() . 'boutique/customer/', 'refresh');
	}

	public function addmeasurement()
	{
		$id = $this->input->post('customerid');
		$this->Customer_model->m_updatemeasurements($id);
		$this->session->set_flashdata('notification', 'Customer measurements updated successfully!');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url() . 'boutique/measurements/' . $id . '/' . $this->input->post('typeid'), 'refresh');
	}

	public function updatemeasurements()
	{



		$id = $this->uri->segment(3);
		$this->Customer_model->m_updatemeasurements($id);
		$data["customer"] = $this->Customer_model->m_getcustomer($id);
		$data["measurement"] = $this->getAllmeasurements($id);
		$this->session->set_flashdata('notification', 'Customer measurements updated successfully!');
		$this->session->set_flashdata('status', 'success');
		$this->load->view('boutique/header');
		$this->load->view('boutique/customer-details', @$data);
		$this->load->view('boutique/footer');
	}
	public function getAllmeasurements($id)
	{


		$measurement_array =  $this->Customer_model->m_getmeasurements($id);
		$i = 0;
		$m_array = array();
		foreach ($measurement_array as $key => $value) {
			if ($value) {
				$m_array[$measurement_array[$i]["b_customer_measurement_key"]] = $measurement_array[$i]["b_customer_measurement_value"];
				$i++;
			}
		}
		return $m_array;
	}

	public function getAllworkmeasurements($id)
	{


		$measurement_array =  $this->Work_model->m_getworkmeasurements($id);
		$i = 0;
		$m_array = array();
		foreach ($measurement_array as $key => $value) {
			if ($value) {
				$m_array[$measurement_array[$i]["boutique_order_customfield_key"]] = $measurement_array[$i]["boutique_order_customfield_value"];
				$i++;
			}
		}
		return $m_array;
	}

	public function savework()
	{

		if (@$_FILES['clothimg']['name']) {
			@$image = @basename($_FILES['clothimg']['name']);
			@$extension  = strtolower(pathinfo($image, PATHINFO_EXTENSION));
			@$newfileName = time() . rand() . "." . $extension;
			$uploaddir = $this->config->item('project_path') . "uploads/work/";
			$uploadfile = $uploaddir . $newfileName;
			if (@move_uploaded_file(@$_FILES['clothimg']['tmp_name'], $uploadfile)) {
				$orderId = $this->Work_model->m_addwork($newfileName);
			}
		} else {
			$newfileName = '';
			$orderId = $this->Work_model->m_addwork($newfileName);
		}
		//$this->sendStatusMessageSMS_GCSelect($orderId, 1); 
		$this->session->set_flashdata('notification', 'New Work added successfully!');
		$this->session->set_flashdata('status', 'success');
		if (@$this->input->post('finish')) {
			redirect(base_url() . 'boutique/orders/', 'refresh');
		} else {
			redirect(base_url() . 'boutique/addwork/' . $this->input->post('customerid') . '/' . $orderId, 'refresh');
		}
	}


	public function updatework()
	{

		$id = $this->uri->segment(3);
		$workdetails = $this->Work_model->m_getwork($id);

		$boutique_work_status = $this->input->post('boutique_work_status');

		$newfileName = "";
		@$image = @basename($_FILES['clothimg']['name']);
		if ($image) {
			@$extension  = strtolower(pathinfo($image, PATHINFO_EXTENSION));
			@$newfileName = time() . rand() . "." . $extension;
			$uploaddir = $this->config->item('project_path') . "uploads/work/";
			$uploadfile = $uploaddir . $newfileName;
		}
		if ($newfileName != "") {
			move_uploaded_file(@$_FILES['clothimg']['tmp_name'], $uploadfile);
		}
		$this->Work_model->m_updatework($id, $newfileName);

		//-------------------- Messageg Services ----------------------------------
		if ( @$boutique_work_status == 3 && $workdetails['boutique_work_status'] != 3) {
			//$this->sendStatusMessageSMS_GCSelect($this->input->post('boutique_order_id'), 3); 
		}

		if (@$boutique_work_status == 3 && $workdetails['boutique_work_status'] != 3) {
			$i = 1;
			$works = $this->Work_model->getworkbyorderid($this->input->post('boutique_order_id'));
			foreach ($works as $work) {
				if ($work['boutique_work_status'] != 3) {
					$i++;
				}
			}
			//if($i == 1){
				
		//	$this->sendStatusMessage($this->input->post('boutique_order_id'), 3);
		

			//}
		}

		if (@$boutique_work_status == 4 && $workdetails['boutique_work_status'] != 4) {
			$i = 1;
			$works = $this->Work_model->getworkbyorderid($this->input->post('boutique_order_id'));
			foreach ($works as $work) {
				if ($work['boutique_work_status'] != 4) {
					$j++;
				}
			}
			//if($j == 1){
			//$this->sendStatusMessage($this->input->post('boutique_order_id'), 4);
			//}
		}

		// ------------------------------------------------------------------------------------

		$data["customer"] = $this->Customer_model->m_getcustomer($id);
		$data["measurement"] = $this->getAllmeasurements($id);
		$this->session->set_flashdata('notification', 'Work updated successfully!');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url() . 'boutique/workdetails/' . $id, 'refresh');
		// $this->load->view('boutique/header');
		// $this->load->view('boutique/work-details',@$data);
		// $this->load->view('boutique/footer');
	}
	public function sendStatusMessageSMS_GCSelect($orderid, $status)
	{
		// $username = "boutiquemanagerin";
		// $password = "Boutique@123#";
		// $sender = "BTQMNG";

		// $boutique = $this->Work_model->m_getboutiquedetails();
		// $orderdetails = $this->Work_model->m_getordercusdetails($orderid);
		// $number = $orderdetails['boutique_customer_ph'];

		// if (@$orderdetails['boutique_order_form_number']) {
		// 	$order_number = $orderdetails['boutique_order_form_number'];
		// } else {
		// 	$order_number = $orderdetails['boutique_order_number'];
		// }
		// if (@$number) {

		// 	$customer = $orderdetails['boutique_customer_name'] ? ucwords($orderdetails['boutique_customer_name']) : 'Customer';
		// 	$boutiquename = $boutique['boutique_name'];
		// 	if ($status == 3) {
		// 		$message = "Dear " . $customer . ", \r\n \r\n";
		// 		$message .= "Greetings from GC Select Men's Lifestyle Boutique ! \r\n \r\n";
		// 		$message .= "Your order no " . $order_number . " has been completed and ready for delivery. \r\n";
		// 		$message .= "Your bill amount is Rs " . $orderdetails['boutique_order_grandtotal'] . "/- . \r\n \r\n";
		// 		$message .= "Trial and Deliveries are usually done after 6:30pm, if you are planning earlier please call 08041207470 to check the same.\r\n \r\n";
		// 		$message .= "Wishing you a stylish day ahead.\r\n \r\n";
		// 	} else {
		// 		$message = "Dear " . $customer . ",\r\n \r\n";
		// 		$message .= "Greetings from the GC Select Team! \r\n \r\n";
		// 		$message .="Thank you for your order number ".$order_number.". Your order will be delivered on ".$orderdetails['boutique_work_delivery_date']." after 6:30pm.\r\n \r\n";
		// 		$message .= "For any queries please call: 08041207470 \r\n \r\n";
		// 		$message .= "Thank you for your order.";
		// 	}

		// 	$url = "http://smsc.a4add.com/api/smsapi.aspx?username=BTQMNG&password=bonneyjp4*&to=" . urlencode($number) . "&from=MTQBPP&message=" . urlencode($message) . "";
		// 	$ch = curl_init($url);
		// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// 	$curl_scraped_page = curl_exec($ch);
		// 	curl_close($ch);
		// 	$this->Work_model->m_addstatusmsg($message, $orderdetails['boutique_customer_id'], $number, $curl_scraped_page);
		// }

		return TRUE;
	}
	public function sendStatusMessage($orderid, $status)
	{
		// $boutique = $this->Work_model->m_getboutiquedetails();
		// if ($boutique['boutique_whatsapp_msg_status'] == 0 && $boutique['boutique_sms_msg_status'] == 0) {
		// 	return FALSE;
		// } elseif ($boutique['boutique_whatsapp_msg_status'] == 1) {
		// 	//$this->sendStatusMessageWhatsapp($orderid,$status);
		// } elseif ($boutique['boutique_sms_msg_status'] == 1) {
		// 	$this->sendStatusMessageSMS($orderid, $status);
		// }
	}

	public function sendStatusMessageSMS($orderid, $status)
	{
		// $username = "boutiquemanagerin";
		// $password = "Boutique@123#";
		// $sender = "BTQMNG";

		// $boutique = $this->Work_model->m_getboutiquedetails();
		// $orderdetails = $this->Work_model->m_getordercusdetails($orderid);
		// $number = $orderdetails['boutique_customer_ph'];

		// if (@$orderdetails['boutique_order_form_number']) {
		// 	$order_number = $orderdetails['boutique_order_form_number'];
		// } else {
		// 	$order_number = $orderdetails['boutique_order_number'];
		// }
		// if (@$number) {

		// 	$customer = $orderdetails['boutique_customer_name'] ? ucwords($orderdetails['boutique_customer_name']) : 'Customer';
		// 	$boutiquename = $boutique['boutique_name'];

		// 	if ($status == 3) {

		// 		$message = "Dear " . $customer . ", \r\n \r\n";
		// 		$message .= "Greetings from " . $boutiquename . " Boutique ! \r\n \r\n";
		// 		$message .= "Your order no " . $order_number . " has been completed and ready for delivery. \r\n";
		// 		$message .= "Your bill amount is Rs " . $orderdetails['boutique_order_grandtotal'] . "/- . \r\n \r\n";
		// 		$message .= "Thank you for doing business with us.";
		// 	} else {
		// 		$message = "Dear " . $customer . ", <br />";
		// 		$message .= "Greetings from " . $boutiquename . " Boutique !<br />";
		// 		$message .= "Your order no " . $order_number . " has been delivered.<br />";
		// 		$message .= "Thank you for doing business with us.";
		// 	}

		// 	$url = "http://smsc.a4add.com/api/smsapi.aspx?username=BTQMNG&password=bonneyjp4*&to=" . urlencode($number) . "&from=MTQBPP&message=" . urlencode($message) . "";
		// 	$ch = curl_init($url);
		// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// 	$curl_scraped_page = curl_exec($ch);
		// 	curl_close($ch);
		// 	$this->Work_model->m_addstatusmsg($message, $orderdetails['boutique_customer_id'], $number, $curl_scraped_page);
		// }

		return TRUE;
	}

	public function removework()
	{

		$id = $this->uri->segment(3);
		$orderid = $this->Work_model->m_removework($id);
		$this->session->set_flashdata('notification', 'Work deleted!');
		$this->session->set_flashdata('status', 'danger');
		redirect(base_url() . 'boutique/works/' . $orderid, 'refresh');
	}

	public function removeorder()
	{

		$id = $this->uri->segment(3);
		$this->Work_model->m_removeorder($id);
		$this->session->set_flashdata('notification', 'Order deleted!');
		$this->session->set_flashdata('status', 'danger');
		redirect(base_url() . 'boutique/orders/', 'refresh');
	}

	public function logout()
	{
		$this->Tailors->logout();
		redirect(base_url() . "boutique");
	}

	public function addpayment()
	{

		$data["orderid"] = $this->uri->segment(3);
		$data["orderpayments"] = $this->Work_model->m_getorderdetails($this->uri->segment(3));
		$this->load->view('boutique/header');
		$this->load->view('boutique/add-payment', @$data);
		$this->load->view('boutique/footer');
	}

	public function savepayment()
	{

		$orderId = $this->Work_model->m_addpayment();
		$this->session->set_flashdata('notification', 'Payment added successfully!');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url() . 'boutique/addpayment/' . $this->input->post('orderid'), 'refresh');
	}

	public function phonevalidate()
	{

		$phone_validate = $this->input->post('phone_validate_');
		if ($this->Customer_model->phonevalidate($phone_validate)) {
			return print_r(json_encode(array('status' => 'success')));
		} else {
			return print_r(json_encode(array('status' => 'failure')));
		}
	}

	public function workinvoice()
	{

		$id = $this->uri->segment(3);
		$work = $this->Work_model->m_getorderdetails($id);
		$orders = $this->Work_model->m_getallworks($id);
		$orderdata = '';
		foreach ($orders as $key => $order) {
			$workimage = @$order['boutique_work_image'];
			$orderdata .= '
			<tr>
				<td width="25%">' . @$order["boutique_work_name"] . '</td>
				<td width="40%">' . @$order["boutique_work_material_desc"] . '</td>
				<td width="30%"><img src="https://boutiquesmanager.com/uploads/work/' . $workimage . '" height="80" width="160"></td>
				<td width="15%">' . @$order["boutique_work_price"] . '</td>
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
		$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT - 10, PDF_MARGIN_TOP - 20, PDF_MARGIN_RIGHT);
		//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
			require_once(dirname(__FILE__) . '/lang/eng.php');
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

		$logo =	'';

		// Set some content to print
		$html = '		<table width="100%">
			<tr>
				<td width="60%">
				' . $logo . '
					<br>
				</td>
				<td width="40%">
					<b>' . $work['boutique_name'] . '.</b><br>' .
			$work['boutique_address'] .	'<br>
			Phone: ' . $work['boutique_ph'] . '<br>
			Email: ' . $work['boutique_email'] . '<br>
				</td>
			</tr>
		</table>
		<div style="padding: 15px; background-color: #eeeeee;">
		INVOICE #' . $work['boutique_order_number'] . ' <br>
		Order Date: ' . $work['boutique_order_date'] . '<br>
		Delivery Date: ' . $work['boutique_order_delivery_date'] . '<br>
		</div>
		<table>
			<tr>
				<td>&nbsp;</td>
			</tr>
		</table>
		<div>
			Invoiced To<br>
			<b>' . $work['boutique_customer_name'] . '</b><br>
			' . $work['boutique_customer_address'] . '<br>
			Phone:' . $work['boutique_customer_ph'] . '<br>
			Email:' . $work['boutique_customer_email'] . '<br>
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
				<td width="25%">Name</td>
				<td width="40%"><b>Description</b></td>
				<td width="30%"><b>Image</b></td>
				<td width="15%"><b>Total</b></td>
			</tr>
			' . $orderdata . '
			<tr style="padding: 15px; background-color: #eeeeee;">
				<td width="25%"><b>Total</b></td>
				<td width="40%"></td>
				<td width="30%"></td>
				<td width="15%"><b>Rs ' . $work['boutique_order_grandtotal'] . '</b></td>
			</tr>
		</table>';

		/*
$html .= '<style>'.file_get_contents('https://boutiquesmanager.com/assets/bower_components/bootstrap/dist/css/bootstrap.min.css').'</style>';

$html .= '<style>'.file_get_contents('https://boutiquesmanager.com/assets/dist/css/AdminLTE.min.css').'</style>';
*/


		// Print text using writeHTMLCell()
		$pdf->writeHTML($html, true, false, true, false, '');

		// ---------------------------------------------------------

		// Close and output PDF document
		// This method has several options, check the source code documentation for more information.
		$pdf->Output(time() . '.pdf', 'I');

		//============================================================+
		// END OF FILE
		//============================================================+

	}

	public function workinvoice1()
	{

		$id = $this->uri->segment(3);
		$work = $this->Work_model->m_getwork($id);
		$workimage = $work['boutique_work_image'];
		$workimagepath = '<img height="100" src="https://boutiquesmanager.com/uploads/work/"' . $workimage . '">';
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
		$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
			require_once(dirname(__FILE__) . '/lang/eng.php');
			$pdf->setLanguageArray($l);
		}

		// ---------------------------------------------------------

		// set font
		$pdf->SetFont('helvetica', '', 10);


		// Add a page
		// This method has several options, check the source code documentation for more information.
		$pdf->AddPage();

		// Set some content to print
		$html = '<table width="100%" cellpadding="5" style="border-spacing: 0px;">
	<tr>
		<td colspan="3"><h2 style="margin-bottom:5px;">' . $work['boutique_name'] . '</h2></td>
	</tr>
	<tr>
		<td colspan="3"><div style="border-top: 1px solid #cccccc"></div></td>
	</tr>
	<tr>
		<td width="33.33%">
			From <br>
			<i>
			<b>' . $work['boutique_name'] . '.</b><br>' .
			$work['boutique_address'] .	'<br>
			Phone: ' . $work['boutique_ph'] . '<br>
			Email: ' . $work['boutique_email'] . '<br>
			</i>
		</td>
		<td width="33.33%">
			To<br>
			<i>
			<b>' . $work['boutique_customer_name'] . '</b><br>
			' . $work['boutique_customer_address'] . '<br>
			Phone:' . $work['boutique_customer_ph'] . '<br>
			Email:' . $work['boutique_customer_email'] . '<br>
			</i>
		</td>
		<td width="33.33%" valign="top">
			<b>Order Number:</b> ' . $work['boutique_work_number'] . '<br>
			<b>Order Date:</b> ' . $work['boutique_work_order_date'] . '<br>
			<b>Delivery Date:</b> ' . $work['boutique_work_delivery_date'] . '<br>
		</td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td><b>Name</b></td>
		<td><b>Image</b></td>
		<td><b>Description</b></td>
	</tr>
	<tr><td colspan="3"><div style="border-top: 1px solid #cccccc"></div></td></tr>
	<tr>
		<td>' . $work['boutique_work_name'] . '</td>
		<td><img height="100" src="https://boutiquesmanager.com/uploads/work/' . $workimage . '"></td>
		<td>' . $work['boutique_work_material_desc'] . '</td>
	</tr>
	<tr>
		<td colspan="3" style="border-top:1px solid #cccccc;"><div style="height: 50px;"></div></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td>
			<div style="border-top: 1px solid #cccccc"></div>
			<div style="margin:10px 0px 10px 0px;">
				<table width="100%">
					<tr>
						<td width="60%">Subtotal:</td>
						<td width="40%">Rs ' . $work['boutique_work_price'] . '</td>
					</tr>
				</table>
			</div>
			<div style="border-top: 1px solid #cccccc"></div>
			<div style="margin:10px 0px 10px 0px;">
				<table width="100%">
					<tr>
						<td width="60%">Total:</td>
						<td width="40%">Rs ' . $work['boutique_work_price'] . '</td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
</table>
<br>
<br>
<br>
<table width="100%">';

		/*
$html .= '<style>'.file_get_contents('https://boutiquesmanager.com/assets/bower_components/bootstrap/dist/css/bootstrap.min.css').'</style>';

$html .= '<style>'.file_get_contents('https://boutiquesmanager.com/assets/dist/css/AdminLTE.min.css').'</style>';
*/


		// Print text using writeHTMLCell()
		$pdf->writeHTML($html, true, false, true, false, '');

		// ---------------------------------------------------------

		// Close and output PDF document
		// This method has several options, check the source code documentation for more information.
		$pdf->Output(time() . '.pdf', 'I');

		//============================================================+
		// END OF FILE
		//============================================================+

	}

	public function customerMeasurements()
	{


		$id = $this->uri->segment(3);
		$measurements = $this->getAllmeasurements($id);
		$customer = $this->Customer_model->m_getcustomer($id);
		//$workimage = $work['boutique_work_image'];
		//$workimagepath = '<img height="100" src="https://boutiquesmanager.com/uploads/work/"'.$workimage.'">';

		ini_set('max_execution_time', 0); // for infinite time of execution

		$this->load->library('Pdf');

		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Boutique Manager');
		$pdf->SetTitle('Churidar Measurements');
		$pdf->SetSubject('Churidar Measurements - customer');
		$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

		// set default header data
		//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 061', PDF_HEADER_STRING);

		// set header and footer fonts
		$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT - 10, PDF_MARGIN_TOP - 30, PDF_MARGIN_RIGHT);
		//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
			require_once(dirname(__FILE__) . '/lang/eng.php');
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
		if ($this->session->userdata('BoutiqueID') == 35) {

			$logoimagepath = 'D & J The Avenue';

			$addressBoutique = 'RATAN CENTRAL, Opposite Maharastra Guest House, Dr Baba Saheb Ambedkar Rd, Parel, Mumbai, Maharashtra 400012<br>
            Ph : 02224195043  | Email - media@donandjulio.com';


			$html = '<div style="text-align: center;">
			<h1>' . $logoimagepath . '</h1>
			<h4>' . $addressBoutique . '</h4>
			<div>Measurement Form</div>
			<table width="100%">
		<tr>
			<td>Name:' . @$customer['boutique_customer_name'] . '</td>
			<td>Mob:' . @$customer['boutique_customer_ph'] . '</td>
		</tr>
	</table>
	<div style="height: 100px;"></div>

	
	<table>
		<tr>
	<td width="92%" style="border:1px solid black; text-align:center; padding:15px 15px 15px 15px;"> <br><br>Top<br></td>
	</tr>
	<tr>
	<td width="100%">
	<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px;">
	<tr>
	<td colspan="2" width="20%" style="border:1px solid black;">Shirt Length</td>
	<td colspan="2" width="22%" style="border:1px solid black; text-align:center;">Shoulder</td>
	<td colspan="2" width="20%" style="border:1px solid black;">Sleeves</td>
	<td colspan="2" width="15%" style="border:1px solid black;">Arm</td>
	<td colspan="2" width="15%" style="border:1px solid black;"></td>
	</tr>
	<tr>
	<td colspan="2" width="20%" style="border:1px solid black;">' . @$measurements['mt1_top_shirt_length'] . '</td>
	<td colspan="2" width="22%" style="border:1px solid black; text-align:center;">' . @$measurements['mt1_top_shoulder'] . '</td>	
	<td colspan="2" width="20%" style="border:1px solid black;">' . @$measurements['mt1_top_sleeves'] . '</td>
	<td colspan="2" width="15%" style="border:1px solid black;">' . @$measurements['mt1_top_arm'] . '</td>
	<td colspan="2" width="15%" style="border:1px solid black;"></td>
	</tr>

	<tr><td rowspan="1" width="20%" style="border:1px solid black;">Suit Length</td>
		<td style="border:1px solid black;"  width="22%">Final</td>
		<td style="border:1px solid black;"  width="20%">Final</td>
		<td style="border:1px solid black;"  width="15%">Final</td>
		<td style="border:1px solid black;"  width="15%"></td>
	</tr>
	<tr><td rowspan="1" width="20%" style="border:1px solid black;">' . @$measurements['mt1_top_suit_length'] . '</td>
		<td style="border:1px solid black;"  width="22%">' . @$measurements['mt1_top_final_1'] . '</td>
		<td style="border:1px solid black;"  width="20%">' . @$measurements['mt1_top_final_2'] . '</td>
		<td style="border:1px solid black;"  width="15%">' . @$measurements['mt1_top_final_3'] . '</td>
		<td style="border:1px solid black;"  width="15%"></td>
	</tr>
	<tr><td rowspan="1" width="20%" style="border:1px solid black;">Sherwani / Indo Western Length</td>
		<td style="border:1px solid black;"  width="22%">Chest</td>
		<td style="border:1px solid black;"  width="20%">Stomach</td>
		<td style="border:1px solid black;"  width="15%">Hip</td>
		<td style="border:1px solid black;"  width="15%"></td>
	</tr>
	
	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">' . @$measurements['mt1_top_sherwani_indo_length'] . '</td>
		<td style="border:1px solid black;"  width="22%">' . @$measurements['mt1_top_chest'] . '</td>
		<td style="border:1px solid black;"  width="20%">' . @$measurements['mt1_top_stomach'] . '</td>
		<td style="border:1px solid black;"  width="15%">' . @$measurements['mt1_top_hip'] . '</td>
		<td style="border:1px solid black;"  width="15%"></td>
	</tr>
	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">Kurta Length</td>
		<td style="border:1px solid black;"  width="22%">Final</td>
		<td style="border:1px solid black;"  width="20%">Final</td>
		<td style="border:1px solid black;"  width="15%">Final</td>
		<td style="border:1px solid black;"  width="15%"></td>
	</tr>
	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">' . @$measurements['mt1_top_kurta_length'] . '</td>
		<td style="border:1px solid black;"  width="22%">' . @$measurements['mt1_top_final_4'] . '</td>
		<td style="border:1px solid black;"  width="20%">' . @$measurements['mt1_top_final_5'] . '</td>
		<td style="border:1px solid black;"  width="15%">' . @$measurements['mt1_top_final_6'] . '</td>
		<td style="border:1px solid black;"  width="15%"></td>
	</tr>
	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">Bandi Length</td>
		<td style="border:1px solid black;"  width="22%">Collar</td>
		<td style="border:1px solid black;"  width="20%">Cuff</td>
		<td style="border:1px solid black;"  width="15%">Final</td>
		<td style="border:1px solid black;"  width="15%">Final</td>
	</tr>
	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">' . @$measurements['mt1_top_bandi_length'] . '</td>
		<td style="border:1px solid black;"  width="22%">' . @$measurements['mt1_top_collar'] . '</td>
		<td style="border:1px solid black;"  width="20%">' . @$measurements['mt1_top_cuff'] . '</td>
		<td style="border:1px solid black;"  width="15%">' . @$measurements['mt1_top_final_7'] . '</td>
		<td style="border:1px solid black;"  width="15%">' . @$measurements['mt1_top_final_8'] . '</td>
	</tr>

	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">Chest Front</td>
		<td style="border:1px solid black;"  width="22%">' . @$measurements['mt1_top_chest_front_1'] . '</td>
		<td style="border:1px solid black;"  width="20%">' . @$measurements['mt1_top_chest_front_2'] . '</td>
		<td style="border:1px solid black;"  width="15%">' . @$measurements['mt1_top_chest_front_3'] . '</td>
		<td style="border:1px solid black;"  width="15%"></td>
	</tr>
	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">Chest Back</td>
		<td style="border:1px solid black;"  width="22%">' . @$measurements['mt1_top_chest_back_1'] . '</td>
		<td style="border:1px solid black;"  width="20%">' . @$measurements['mt1_top_chest_back_2'] . '</td>
		<td style="border:1px solid black;"  width="15%">' . @$measurements['mt1_top_chest_back_3'] . '</td>
		<td style="border:1px solid black;"  width="15%"></td>
	</tr>



	</table></td>
	</tr>
	<tr>
	<td width="107%" style="text-align:center; padding:15px 15px 15px 15px;"></td>
	</tr>
	<tr>
	<td width="107%" style="border:1px solid black; text-align:center; padding:15px 15px 15px 15px;"> <br><br>Bottom<br></td>
	</tr>
	<tr>
	<td width="100%">
	<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px;">
	
	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">Length</td>
		<td style="border:1px solid black;"  width="22%">Final</td>
		<td style="border:1px solid black;"  width="15%">Things</td>
		<td style="border:1px solid black;"  width="15%">Final</td>
		<td style="border:1px solid black;"  width="35%" colspan="3" rowspan="11"> Remarks :- <br>
		&nbsp;&nbsp;' . @$measurements['mt1_remarks'] . '</td>
	</tr>
	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">' . @$measurements['mt1_bottom_length'] . '</td>
		<td style="border:1px solid black;"  width="22%">' . @$measurements['mt1_bottom_final_1'] . '</td>
		<td style="border:1px solid black;"  width="15%">' . @$measurements['mt1_bottom_things'] . '</td>
		<td style="border:1px solid black;"  width="15%">' . @$measurements['mt1_bottom_final_2'] . '</td>
	</tr>
	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">Waist</td>
		<td style="border:1px solid black;"  width="22%">Final</td>
		<td style="border:1px solid black;"  width="15%">Knee</td>
		<td style="border:1px solid black;"  width="15%">Final</td>
	</tr>
	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">' . @$measurements['mt1_bottom_waist'] . '</td>
		<td style="border:1px solid black;"  width="22%">' . @$measurements['mt1_bottom_final_3'] . '</td>
		<td style="border:1px solid black;"  width="15%">' . @$measurements['mt1_bottom_knee'] . '</td>
		<td style="border:1px solid black;"  width="15%">' . @$measurements['mt1_bottom_final_4'] . '</td>
	</tr>
	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">Hip</td>
		<td style="border:1px solid black;"  width="22%">Final</td>
		<td style="border:1px solid black;"  width="15%">Bottom</td>
		<td style="border:1px solid black;"  width="15%">Final</td>
	</tr>
	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">' . @$measurements['mt1_bottom_hip'] . '</td>
		<td style="border:1px solid black;"  width="22%">' . @$measurements['mt1_bottom_final_5'] . '</td>
		<td style="border:1px solid black;"  width="15%">' . @$measurements['mt1_bottom_bottom'] . '</td>
		<td style="border:1px solid black;"  width="15%">' . @$measurements['mt1_bottom_final_6'] . '</td>
	</tr>
	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">Insim</td>
		<td style="border:1px solid black;"  width="22%">Final</td>
		<td style="border:1px solid black;"  width="15%">Fork</td>
		<td style="border:1px solid black;"  width="15%">Crotch U</td>
	</tr>
	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">' . @$measurements['mt1_bottom_insim'] . '</td>
		<td style="border:1px solid black;"  width="22%">' . @$measurements['mt1_bottom_final_5'] . '</td>
		<td style="border:1px solid black;"  width="15%">' . @$measurements['mt1_bottom_fork'] . '</td>
		<td style="border:1px solid black;"  width="15%">' . @$measurements['mt1_bottom_crotchu'] . '</td>
	</tr>	

	</table></td>
	</tr>
	</table>
	<div style="height: 50px;"></div>
	<table width="100%">
	</table>
	</div>';
		} elseif ($this->session->userdata('BoutiqueID') == 33) {

			$logoimagepath = '<img height="70" width="210" src="https://boutiquesmanager.com/uploads/logo/beboo-logo.png">';
			$logoimagepath = 'AROYA by ARYA';

			$addressBoutique = 'TC 29/3385, Govardhanam,, Near All India Radio, Vazhuthacaud-DPI Road,, Vazhuthacaud, Thiruvananthapuram, Kerala 695014<br>
            Ph : 98951 66914  | Email - aroya@gmail.com';

			$html = '<div style="text-align: center;">
			<h1>' . $logoimagepath . '</h1>
			<h4>' . $addressBoutique . '</h4>
			<div>Measurement Form</div>
			<table width="100%">
		<tr>
			<td>Name:' . @$customer['boutique_customer_name'] . '</td>
			<td>Mob:' . @$customer['boutique_customer_ph'] . '</td>
		</tr>
	</table>
	<div style="height: 1px;"></div>

	
	<table>
	<tr><td width="48%">
	<table width="100%" style="padding:5px 0px 5px 0px;">
		<tr>
			<td>Measurements</td>
		</tr>
	</table>
	</td>
	</tr>
	<tr>
	<td width="48%">
	<table style="border:1px solid black; text-align:left; padding:2px 0px 0px 2px;">

	<tr><td colspan="2" width="50%" style="border:1px solid black;">Top Length</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['mt1_top_legth'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Shoulder Length</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['mt1_shoulder_length'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Arm Hole</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['mt1_arm_hole'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;">Chest</td><td colspan="2">' . @$measurements['mt1_chest_1'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Bust</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['mt1_bust_1'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Waist</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['mt1_waist_1'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;">Hip</td><td colspan="2">' . @$measurements['mt1_hip_1'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;">F Neck Length</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['mt1_fneck_length_1'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">F Neck Wide</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['mt1_fneck_wide_1'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">B Neck Length</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['mt1_bneck_length_1'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">B Neck Wide</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['mt1_bneck_wide_1'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Shoulder To Tip</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['mt1_shouldertip_1'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Bust Point To Bust Point</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['mt1_bustpoint_1'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Shoulder To Slit</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['mt1_soulderslit_1'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Slit Round</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['mt1_slitround_1'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Yolk Length</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['mt1_yolklength_1'] . '</td></tr>

	</table>

	<table width="100%" style="padding:5px 0px 5px 0px;">
		<tr>
			<td>Sleeve Measurements</td>
		</tr>
	</table>

	<table style="border:1px solid black; text-align:left; padding:2px 0px 0px 2px;">

	

	<tr><td colspan="2" rowspan="2" width="50%" style="border:1px solid black;"></td>
	<td colspan="2" rowspan="2" width="22%" style="border:1px solid black; text-align:center;">Length</td>
	<td colspan="2" width="28%">Round</td>
	</tr>
	<tr><td colspan="2" width="14%" style="border:1px solid black; text-align:center;">Left</td>
	<td colspan="2" width="14%" style="border:1px solid black; text-align:center;">Right</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;">Biceps/Short</td>
	<td colspan="2" width="22%" style="border:1px solid black;">' . @$measurements['mt1_biceps_2_1'] . '</td>
	<td colspan="2" width="14%" style="border:1px solid black;">' . @$measurements['mt1_biceps_2_2'] . '</td>
	<td colspan="2" width="14%" style="border:1px solid black;">' . @$measurements['mt1_biceps_2_3'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;">Elbow</td>
	<td colspan="2" width="22%" style="border:1px solid black;">' . @$measurements['mt1_elbow_2_1'] . '</td>
	<td colspan="2" width="14%" style="border:1px solid black;">' . @$measurements['mt1_elbow_2_2'] . '</td>
	<td colspan="2" width="14%" style="border:1px solid black;">' . @$measurements['mt1_elbow_2_3'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;">Long</td>
	<td colspan="2" width="22%" style="border:1px solid black;">' . @$measurements['mt1_long_2_1'] . '</td>
	<td colspan="2" width="14%" style="border:1px solid black;">' . @$measurements['mt1_long_2_2'] . '</td>
	<td colspan="2" width="14%" style="border:1px solid black;">' . @$measurements['mt1_long_2_3'] . '</td></tr>
	

	</table>

	<table width="100%" style="padding:5px 0px 5px 0px;">
		<tr>
			<td>Bottom Measurements</td>
		</tr>
	</table>

	<table style="border:1px solid black; text-align:left; padding:2px 0px 0px 2px;">

	<tr><td colspan="2" width="50%" style="border:1px solid black;">Waist</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['mt1_waist_3_1'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Length</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['mt1_length_3_1'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Thighs</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['mt1_thighs_3_1'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;">Knee</td><td colspan="2">' . @$measurements['mt1_knee_3_1'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Ankle</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['mt1_ankle_3_1'] . '</td></tr>

	</table>

	<table width="100%" style="padding:5px 0px 5px 0px;">
		<tr>
			<td>Additional Requirements</td>
		</tr>
	</table>

	<table style="border:1px solid black; text-align:left; padding:2px 0px 0px 2px;">

	<tr>
	<td colspan="2" width="22%" style="border:1px solid black;">Zip</td>
	<td colspan="2" width="31%" style="border:1px solid black;">Back</td>
	<td colspan="2" width="8%" style="border:1px solid black; text-align:center;">' . ((@$measurements['mt1_zip_4_1']) ? 'X' : "-") . '</td>
	<td colspan="2" width="31%" style="border:1px solid black;">Side</td>
	<td colspan="2" width="8%" style="border:1px solid black; text-align:center;">' . ((@$measurements['mt1_zip_4_2']) ? 'X' : "-") . '</td>
	</tr>
	<tr>
	<td colspan="2" width="22%" style="border:1px solid black;">Lining</td>
	<td colspan="2" width="31%" style="border:1px solid black;">Body</td>
	<td colspan="2" width="8%" style="border:1px solid black; text-align:center;">' . ((@$measurements['mt1_lining_4_1']) ? 'X' : "-") . '</td>
	<td colspan="2" width="31%" style="border:1px solid black;">Sleeve</td>
	<td colspan="2" width="8%" style="border:1px solid black; text-align:center;">' . ((@$measurements['mt1_sleeve_4_1']) ? 'X' : "-") . '</td>
	</tr>

	
	<tr>
	<td colspan="2" width="22%" style="border:1px solid black;">Piping</td>
	<td colspan="2" width="14%" style="border:1px solid black;">F.Neck</td>
	<td colspan="2" width="7%" style="border:1px solid black; text-align:center;">' . ((@$measurements['mt1_lining_4_1']) ? 'X' : "-") . '</td>
	<td colspan="2" width="14%" style="border:1px solid black;">B.Neck</td>
	<td colspan="2" width="7%" style="border:1px solid black; text-align:center;">' . ((@$measurements['mt1_lining_4_1']) ? 'X' : "-") . '</td>
	<td colspan="2" width="8%" style="border:1px solid black;">Slit</td>
	<td colspan="2" width="7%" style="border:1px solid black; text-align:center;">' . ((@$measurements['mt1_lining_4_1']) ? 'X' : "-") . '</td>
	<td colspan="2" width="14%" style="border:1px solid black;">Sleeve</td>
	<td colspan="2" width="7%" style="border:1px solid black; text-align:center;">' . ((@$measurements['mt1_lining_4_1']) ? 'X' : "-") . '</td>
	</tr>

	<tr>
	<td colspan="2" width="22%" style="border:1px solid black;">Pad</td>
	<td colspan="2" width="14%" style="border:1px solid black;text-align:center;">' . ((@$measurements['mt1_pad_4_1']) ? 'X' : "-") . '</td>
	<td colspan="2" width="34%" style="border:1px solid black;">Pad Size</td>
	<td colspan="2" width="30%" style="border:1px solid black;">&nbsp;' . @$measurements['mt1_pad_4_3'] . '</td>
	</tr>
	
	</table>

		<table width="100%" style="padding:5px 0px 5px 0px;">
		<tr>
			<td>Design Requirements</td>
		</tr>
	</table>

	<table style="border:1px solid black; text-align:left; padding:2px 0px 0px 2px;">

	<tr><td colspan="2" width="50%" style="border:1px solid black;">Princess Cut</td>
	<td colspan="2" width="1%" style="border-bottom:1px solid white;"></td>
	<td colspan="2" width="8%" style="border:1px solid black; text-align:center;">' . ((@$measurements['mt1_princess_cut_5_1']) ? 'X' : "-") . '</td>
	<td colspan="2" width="1%" style="border-bottom:1px solid white;"></td>
	<td colspan="2" width="40%" style="border:1px solid black;">' . @$measurements['mt1_princess_cut_5_2'] . '</td>
	</tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Panel Cut</td>
	<td colspan="2" width="1%" style="border-bottom:1px solid white;"></td>
	<td colspan="2" width="8%" style="border:1px solid black; text-align:center;">' . ((@$measurements['mt1_panel_cut_5_1']) ? 'X' : "-") . '</td>
	<td colspan="2" width="1%" style="border-bottom:1px solid white;"></td>
	<td colspan="2" width="40%" style="border:1px solid black;">' . @$measurements['mt1_panel_cut_5_2'] . '</td>
	</tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Round Umbrella</td>
	<td colspan="2" width="1%" style="border-bottom:1px solid white;"></td>
	<td colspan="2" width="8%" style="border:1px solid black; text-align:center;">' . ((@$measurements['mt1_round_umbrella_5_1']) ? 'X' : "-") . '</td>
	<td colspan="2" width="1%" style="border-bottom:1px solid white;"></td>
	<td colspan="2" width="40%" style="border:1px solid black;">' . @$measurements['mt1_round_umbrella_5_2'] . '</td>
	</tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;">Straight Umbrella</td>

	<td colspan="2" width="1%" style="border-bottom:1px solid white;"></td>
	<td colspan="2" width="8%" style="border:1px solid black; text-align:center;">' . ((@$measurements['mt1_straight_umbrella_5_1']) ? 'X' : "-") . '</td>
	<td colspan="2" width="1%" style="border-bottom:1px solid white;"></td>
	<td colspan="2" width="40%" style="border:1px solid black;">' . @$measurements['mt1_straight_umbrella_5_2'] . '</td>
	</tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Straight Kurta</td>

	<td colspan="2" width="1%" style="border-bottom:1px solid white;"></td>
	<td colspan="2" width="8%" style="border:1px solid black; text-align:center;">' . ((@$measurements['mt1_straight_kurta_5_1']) ? 'X' : "-") . '</td>
	<td colspan="2" width="1%" style="border-bottom:1px solid white;"></td>
	<td colspan="2" width="40%" style="border:1px solid black;">' . @$measurements['mt1_straight_kurta_5_2'] . '</td>

	</tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Embroidery</td>
	<td colspan="2" width="1%" style=""></td>
	<td colspan="2" width="8%" style="border:1px solid black; text-align:center;">' . ((@$measurements['mt1_embroidery_5_1']) ? 'X' : "-") . '</td>
	<td colspan="2" width="1%" style=""></td>
	<td colspan="2" width="40%" style="border:1px solid black;">' . @$measurements['mt1_embroidery_5_2'] . '</td>

	</tr>

	</table>


	</td>
	<td width="1%">
	</td>

	<td width="48%"><table width="100%">
	<tr><td style="border:1px solid black;" width="118%" height="533"></td></tr>
	<tr><td style="border:1px solid black; text-align:left;" width="118%" height="113"> Special Notes <br>
	 ' . @$measurements['mt1_remarks'] . '
	</td></tr>
	</table></td>
	</tr>
	</table>
	<div style="height: 50px;"></div>
	<table width="100%">
	</table>
	</div>';
		} elseif ($this->session->userdata('BoutiqueID') == 27) {

			$logoimagepath = 'Fulki Studio';

			$addressBoutique = 'Door No.26/410, Palace Road, Central Building (Kalliyath Building), Thrissur<br>
            Ph : 08040970806  | Email - fulkiwear@gmail.com';

			$html = '<div style="text-align: center;">
			<h1>' . $logoimagepath . '</h1>
			<h4>' . $addressBoutique . '</h4>
			<div>Measurement Form</div>
			<table width="100%">
		<tr>
			<td>Name:' . @$customer['boutique_customer_name'] . '</td>
			<td>Mob:' . @$customer['boutique_customer_ph'] . '</td>
		</tr>
	</table>
	<div style="height: 100px;"></div>

	<table width="98%" style="border:1px solid #000000;">
		<br><br>
		<tr>
			<td width="21%" style="padding: 10px; width: 30px; height: 30px;">
			Tick On
			</td>

			<td width="13%" style="padding: 10px; width: 30px; height: 30px;">
			Saree
			</td>
			<td width="4%" style="border:1px solid #000000; width: 10px; height: 30px;"></td>

			<td width="13%" style="padding: 10px; width: 30px; height: 30px;">
			Suits
			</td>
			<td width="4%" style="border:1px solid #000000; width: 10px; height: 30px;"></td>

			<td width="13%" style="padding: 10px; width: 30px; height: 30px;">
			Kurtis
			</td>
			<td width="4%" style="border:1px solid #000000; width: 10px; height: 30px;"></td>

			<td width="13%" style="padding: 10px; width: 30px; height: 30px;">
			Blouse
			</td>
			<td width="4%" style="border:1px solid #000000; width: 10px; height: 30px;"></td>

			<td width="13%" style="padding: 10px; width: 30px; height: 30px;">
			Tights
			</td>
			<td width="4%" style="border:1px solid #000000; width: 10px; height: 30px;"></td>

			<td width="2%"></td>
		</tr>

		<tr>
			<td></td>
			<td></td>
			<td></td><td></td><td></td><td></td><td></td><td></td><td width="2%"></td>
		</tr>
	</table>
	<table>
	<tr>
	<td width="33%">
	<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px;">
	<tr><td width="100%" style="text-align: center;">Upper Body</td></tr>
	<br>
	<tr>
		<td width="50%" style="">Length</td>

		<td style="border:1px solid black;"  width="25%">' . @$measurements['mt1_u_length'] . '</td>
	</tr>
	<br>
	<tr>
		<td width="50%" style="">Upper Chest</td>

		<td style="border:1px solid black;"  width="25%">' . @$measurements['mt1_u_upper_chest'] . '</td>
	</tr>
	<br>

	<tr>
		<td width="50%" style="">Front Cross</td>

		<td style="border:1px solid black;"  width="25%">' . @$measurements['mt1_u_front_cross'] . '</td>
	</tr>
	<br>
	<tr>
		<td width="50%" style="">Chest</td>

		<td style="border:1px solid black;"  width="25%">' . @$measurements['mt1_u_chest'] . '</td>
	</tr>
	<br>

	<tr>
		<td width="50%" style="">Dart Point</td>

		<td style="border:1px solid black;"  width="25%">' . @$measurements['mt1_u_dartpoint'] . '</td>
	</tr>
	<br>
	<tr>
		<td width="50%" style="">Waist</td>

		<td style="border:1px solid black;"  width="25%">' . @$measurements['mt1_u_waist'] . '</td>
	</tr>
	<br>

	<tr>
		<td width="50%" style="">Hip</td>

		<td style="border:1px solid black;"  width="25%">' . @$measurements['mt1_u_hip'] . '</td>
	</tr>
	<br>
	<tr>
		<td width="50%" style="">Shoulder</td>

		<td style="border:1px solid black;"  width="25%">' . @$measurements['mt1_u_shoulder'] . '</td>
	</tr>
	<br>

	<tr>
		<td width="50%" style="">Sleeves Length</td>

		<td style="border:1px solid black;"  width="25%">' . @$measurements['mt1_u_sleeves_length'] . '</td>
	</tr>
	<br>
	<tr>
		<td width="50%" style="">Sleeves Open</td>

		<td style="border:1px solid black;"  width="15%">' . @$measurements['mt1_u_sleeves_open_1'] . '</td>

		<td style="border:1px solid black;"  width="15%">' . @$measurements['mt1_u_sleeves_open_2'] . '</td>

		<td style="border:1px solid black;"  width="15%">' . @$measurements['mt1_u_sleeves_open_3'] . '</td>

	</tr>
	<br>

	<tr>
		<td width="50%" style="">Arm Hole</td>

		<td style="border:1px solid black;"  width="25%">' . @$measurements['mt1_u_armholes'] . '</td>
	</tr>
	<br>
	<tr>
		<td width="50%" style="">Front Neck</td>

		<td style="border:1px solid black;"  width="25%">' . @$measurements['mt1_u_frontneck'] . '</td>
	</tr>
	<br>

	<tr>
		<td width="50%" style="">Back Neck</td>

		<td style="border:1px solid black;"  width="25%">' . @$measurements['mt1_u_backneck'] . '</td>
	</tr>
	<br>

	
	<tr><td width="100%" style=""></td></tr>

	</table></td>
	<td width="47%">
		<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px;">
	<tr><td width="100%" style="text-align: center;">Lower Body</td></tr>
	<br>
	<tr>
		<td width="50%" style="">Length</td>

		<td style="border:1px solid black;"  width="25%">' . @$measurements['mt1_l_length'] . '</td>
	</tr>
	<br>
	<tr>
		<td width="50%" style="">Waist</td>

		<td style="border:1px solid black;"  width="25%">' . @$measurements['mt1_l_waist'] . '</td>
	</tr>
	<br>

	<tr>
		<td width="50%" style="">Hip</td>
		<td style="border:1px solid black;"  width="25%">' . @$measurements['mt1_l_hip'] . '</td>
	</tr>
	<br>
	<tr>
		<td width="50%" style="">Fork</td>

		<td style="border:1px solid black;"  width="25%">' . @$measurements['mt1_l_fork'] . '</td>
	</tr>
	<br>

	<tr>
		<td width="50%" style="">Thigh</td>

		<td style="border:1px solid black;"  width="25%">' . @$measurements['mt1_l_thigh'] . '</td>
	</tr>
	<br>
	<tr>
		<td width="50%" style="">Knee</td>

		<td style="border:1px solid black;"  width="25%">' . @$measurements['mt1_l_knee'] . '</td>
	</tr>
	<br>

	<tr>
		<td width="50%" style="">Ankle</td>

		<td style="border:1px solid black;"  width="25%">' . @$measurements['mt1_l_ankle'] . '</td>
	</tr>
	<br>
	<tr>
		<td width="50%" style=""></td>

		<td style=""  width="25%"></td>
	</tr>
	
<br>

<tr>
		<td width="5%" style=""></td>

		<td style="border:1px solid black; height:190px;"  width="60%">
		Design
		<br>
		&nbsp; ' . @$measurements['mt1_remarks'] . '
		</td>
	</tr>
	
<br>


	
	<tr><td width="100%" style=""></td></tr>

	</table>
	</td>
	<td width="40%">
		<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px; height:500px;" width="100%">
		<tr>
		<td width="5%" style="height:603px;"></td>

		<td style=""  width="60%">
		</td>
	</tr>
		</table>
	</td>
	</tr>
	</table>
	<div style="height: 50px;"></div>
	<table width="100%">
	</table>
	</div>';
		} elseif ($this->session->userdata('BoutiqueID') == 15) {

			$logoimagepath = 'Madams Fashion House';

			$addressBoutique = 'T.C 4/1037 [3], Heera Palace, Gokulam Chits Building, Kowdiar Jn., Trivandrum - 695003<br>
            Ph : 9447022660  | Email - madamsfashionhouse@yahoo.com';


			$html = '<div style="text-align: center;">
			<h1>' . $logoimagepath . '</h1>
			<h4>' . $addressBoutique . '</h4>
			<div>Measurement Form</div>
			<table width="100%">
		<tr>
			<td>Name:' . @$customer['boutique_customer_name'] . '</td>
			<td>Mob:' . @$customer['boutique_customer_ph'] . '</td>
		</tr>
	</table>
	<div style="height: 100px;"></div>

	
	<table>
		<tr>
	<td width="107%" style="border:1px solid black; text-align:center; padding:15px 15px 15px 15px;"> <br><br>Top<br></td>
	</tr>
	<tr>
	<td width="100%">
	<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px;">
	<tr>
	<td colspan="2" width="20%" style="border:1px solid black;">Shape Length</td>
	<td colspan="2" width="22%" style="border:1px solid black; text-align:center;">Full Length</td>
	<td colspan="2" width="20%" style="border:1px solid black;"></td>
	<td colspan="2" width="15%" style="border:1px solid black;"></td>
	<td colspan="2" width="15%" style="border:1px solid black;"></td>
	<td colspan="2" width="15%" style="border:1px solid black;"></td>
	</tr>
	<tr>
	<td colspan="2" width="20%" style="border:1px solid black;">' . @$measurements['mt1_top_shape_length'] . '</td>
	<td colspan="2" width="22%" style="border:1px solid black; text-align:center;">' . @$measurements['mt1_top_full_length'] . '</td>	
	<td colspan="2" width="20%" style="border:1px solid black;"></td>
	<td colspan="2" width="15%" style="border:1px solid black;"></td>
	<td colspan="2" width="15%" style="border:1px solid black;"></td>
	<td colspan="2" width="15%" style="border:1px solid black;"></td>
	</tr>

	<tr><td rowspan="1" width="20%" style="border:1px solid black;">Upper Chest</td>
		<td style="border:1px solid black;"  width="22%">Lower Chest</td>
		<td style="border:1px solid black;"  width="20%">Waist</td>
		<td style="border:1px solid black;"  width="15%">Seat</td>
		<td style="border:1px solid black;"  width="15%"></td>
		<td style="border:1px solid black;"  width="15%"></td>
	</tr>
	<tr><td rowspan="1" width="20%" style="border:1px solid black;">' . @$measurements['mt1_top_upper_chest'] . '</td>
		<td style="border:1px solid black;"  width="22%">' . @$measurements['mt1_top_lower_chest'] . '</td>
		<td style="border:1px solid black;"  width="20%">' . @$measurements['mt1_top_waist'] . '</td>
		<td style="border:1px solid black;"  width="15%">' . @$measurements['mt1_top_seat'] . '</td>
		<td style="border:1px solid black;"  width="15%"></td>
		<td style="border:1px solid black;"  width="15%"></td>
	</tr>
	<tr><td rowspan="1" width="20%" style="border:1px solid black;">Shoulder</td>
		<td style="border:1px solid black;"  width="22%">Sleeve Length</td>
		<td style="border:1px solid black;"  width="20%">Sleeve End Width</td>
		<td style="border:1px solid black;"  width="15%">Arm Hole</td>
		<td style="border:1px solid black;"  width="15%"></td>
		<td style="border:1px solid black;"  width="15%"></td>
	</tr>
	
	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">' . @$measurements['mt1_top_shoulder'] . '</td>
		<td style="border:1px solid black;"  width="22%">' . @$measurements['mt1_top_sleeve_length'] . '</td>
		<td style="border:1px solid black;"  width="20%">' . @$measurements['mt1_top_sleeve_end_width'] . '</td>
		<td style="border:1px solid black;"  width="15%">' . @$measurements['mt1_top_sleeve_arm_hole'] . '</td>
		<td style="border:1px solid black;"  width="15%"></td>
		<td style="border:1px solid black;"  width="15%"></td>
	</tr>
	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">Front Neck Depth</td>
		<td style="border:1px solid black;"  width="22%">Front Neck Width</td>
		<td style="border:1px solid black;"  width="20%">Breast Point</td>
		<td style="border:1px solid black;"  width="15%"></td>
		<td style="border:1px solid black;"  width="15%"></td>
		<td style="border:1px solid black;"  width="15%"></td>
	</tr>
	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">' . @$measurements['mt1_top_front_neck_depth'] . '</td>
		<td style="border:1px solid black;"  width="22%">' . @$measurements['mt1_top_front_neck_width'] . '</td>
		<td style="border:1px solid black;"  width="20%">' . @$measurements['mt1_top_breast_point'] . '</td>
		<td style="border:1px solid black;"  width="15%"></td>
		<td style="border:1px solid black;"  width="15%"></td>
		<td style="border:1px solid black;"  width="15%"></td>
	</tr>
	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">Back Neck</td>
		<td style="border:1px solid black;"  width="22%">Slit Length</td>
		<td style="border:1px solid black;"  width="20%">Flair</td>
		<td style="border:1px solid black;"  width="15%"></td>
		<td style="border:1px solid black;"  width="15%"></td>
		<td style="border:1px solid black;"  width="15%"></td>
	</tr>
	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">' . @$measurements['mt1_top_back_neck'] . '</td>
		<td style="border:1px solid black;"  width="22%">' . @$measurements['mt1_top_slit_length'] . '</td>
		<td style="border:1px solid black;"  width="20%">' . @$measurements['mt1_top_flair'] . '</td>
		<td style="border:1px solid black;"  width="15%"></td>
		<td style="border:1px solid black;"  width="15%"></td>
		<td style="border:1px solid black;"  width="15%"></td>
	</tr>	

	</table></td>
	</tr>
	<tr>
	<td width="107%" style="text-align:center; padding:15px 15px 15px 15px;"></td>
	</tr>
	<tr>
	<td width="107%" style="border:1px solid black; text-align:center; padding:15px 15px 15px 15px;"> <br><br>Bottom<br></td>
	</tr>
	<tr>
	<td width="100%">
	<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px;">
	<tr><td colspan="2" width="20%" style="border:1px solid black;"></td>
	<td colspan="2" width="22%" style="border:1px solid black; text-align:center;">Churi Bottom</td>
	<td colspan="2" width="15%" style="border:1px solid black; text-align:center;">Pant</td>
	<td colspan="2" width="15%" style="border:1px solid black; text-align:center;">Pencil Bottom</td>
	<td colspan="2" width="20%" style="border:1px solid black; text-align:center;"></td>
	<td colspan="2" width="15%" style="border:1px solid black; text-align:center;">Salwar Bottom</td>
	</tr>

	<tr><td rowspan="1" width="20%" style="border:1px solid black;">Thigh Length</td>
		<td style="border:1px solid black;"  width="22%">' . @$measurements['mt1_cb_thigh_length'] . '</td>
		<td style="border:1px solid black;"  width="15%">' . @$measurements['mt1_p_thigh_length'] . '</td>
		<td style="border:1px solid black;"  width="15%">' . @$measurements['mt1_pb_thigh_length'] . '</td>
		<td style="border:1px solid black;"  width="20%">Bottom Length</td>
		<td style="border:1px solid black;"  width="15%">' . @$measurements['mt1_sb_bottom_length'] . '</td>
	</tr>
	<tr><td rowspan="1" width="20%" style="border:1px solid black;">Knee Length</td>
		<td style="border:1px solid black;"  width="22%">' . @$measurements['mt1_cb_knee_length'] . '</td>
		<td style="border:1px solid black;"  width="15%">' . @$measurements['mt1_p_knee_length'] . '</td>
		<td style="border:1px solid black;"  width="15%">' . @$measurements['mt1_pb_knee_length'] . '</td>
		<td style="border:1px solid black;"  width="20%">End Width</td>
		<td style="border:1px solid black;"  width="15%">' . @$measurements['mt1_sb_end_width'] . '</td>
	</tr>
	<tr><td rowspan="1" width="20%" style="border:1px solid black;">Full Length</td>
		<td style="border:1px solid black;"  width="22%">' . @$measurements['mt1_cb_full_length'] . '</td>
		<td style="border:1px solid black;"  width="15%">' . @$measurements['mt1_p_full_length'] . '</td>
		<td style="border:1px solid black;"  width="15%">' . @$measurements['mt1_pb_full_length'] . '</td>
		<td style="border:1px solid black;"  width="20%">Waist Width</td>
		<td style="border:1px solid black;"  width="15%">' . @$measurements['mt1_sb_waist_width'] . '</td>
	</tr>
	
	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">Waist Width</td>
		<td style="border:1px solid black;"  width="22%">' . @$measurements['mt1_cb_waist_width'] . '</td>
		<td style="border:1px solid black;"  width="15%">' . @$measurements['mt1_p_waist_width'] . '</td>
		<td style="border:1px solid black;"  width="15%">' . @$measurements['mt1_pb_waist_width'] . '</td>
		<td style="border:1px solid black;"  width="35%" colspan="3" rowspan="11"> Remarks :- <br>
		&nbsp;&nbsp;' . @$measurements['mt1_remarks'] . '</td>
	</tr>
	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">Seat Width</td>
		<td style="border:1px solid black;"  width="22%"> ---- </td>
		<td style="border:1px solid black;"  width="15%">' . @$measurements['mt1_p_seat_width'] . '</td>
		<td style="border:1px solid black;"  width="15%">' . @$measurements['mt1_pb_seat_width'] . '</td>
	</tr>
	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">Things Width</td>
		<td style="border:1px solid black;"  width="22%">' . @$measurements['mt1_cb_things_width'] . '</td>
		<td style="border:1px solid black;"  width="15%">' . @$measurements['mt1_p_things_width'] . '</td>
		<td style="border:1px solid black;"  width="15%">' . @$measurements['mt1_pb_things_width'] . '</td>
	</tr>
	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">Knee Width</td>
		<td style="border:1px solid black;"  width="22%">' . @$measurements['mt1_cb_knee_width'] . '</td>
		<td style="border:1px solid black;"  width="15%">' . @$measurements['mt1_p_knee_width'] . '</td>
		<td style="border:1px solid black;"  width="15%">' . @$measurements['mt1_pb_knee_width'] . '</td>
	</tr>
	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">Ankle Width</td>
		<td style="border:1px solid black;"  width="22%">' . @$measurements['mt1_cb_ankle_width'] . '</td>
		<td style="border:1px solid black;"  width="15%"> ---- </td>
		<td style="border:1px solid black;"  width="15%"> ---- </td>
	</tr>
	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">End Width</td>
		<td style="border:1px solid black;"  width="22%"> ---- </td>
		<td style="border:1px solid black;"  width="15%">' . @$measurements['mt1_p_end_width'] . '</td>
		<td style="border:1px solid black;"  width="15%">' . @$measurements['mt1_pb_end_width'] . '</td>
	</tr>	

	</table></td>
	</tr>
	</table>
	<div style="height: 50px;"></div>
	<table width="100%">
	</table>
	</div>';
		} elseif ($this->session->userdata('BoutiqueID') == 25) {

			$logoimagepath = 'N Dot Couture';


			$addressBoutique = '1st Cross Rd, Kuvempunagara North, Saraswathipuram, Mysuru, Karnataka 570009<br>
            Ph : 948293829  | Email - ndoutcouture@gmail.com';


			$html = '<div style="text-align: center;">
			<h1>' . $logoimagepath . '</h1>
			<h4>' . $addressBoutique . '</h4>
			<div>Measurement Form</div>
			<table width="100%">
		<tr>
			<td>Name:' . @$customer['boutique_customer_name'] . '</td>
			<td>Mob:' . @$customer['boutique_customer_ph'] . '</td>
		</tr>
	</table>
	<div style="height: 100px;"></div>

	
	<table>
	<tr>
	<td width="100%">
	<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px;">
	<tr><td colspan="2" width="20%" style="border:1px solid black;"></td>
	<td colspan="2" width="12%" style="border:1px solid black; text-align:center;">Blouse</td>
	<td colspan="2" width="12%" style="border:1px solid black; text-align:center;">Dress</td>
	<td colspan="2" width="12%" style="border:1px solid black; text-align:center;">Gown</td>
	<td colspan="2" width="12%" style="border:1px solid black; text-align:center;">Lahenga<br>1.Blouse</td>
	<td colspan="2" width="15%" style="border:1px solid black; text-align:center;"></td>
	<td colspan="2" width="12%" style="border:1px solid black; text-align:center;">Pencil fit Pant</td>
	<td colspan="2" width="12%" style="border:1px solid black; text-align:center;">Normal pant</td>
	</tr>

	<tr><td rowspan="1" width="20%" style="border:1px solid black;">Shoulder</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_blouse_shoulder'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_dress_shoulder'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_gown_shoulder'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_lehenga_shoulder'] . '</td>
		<td style="border:1px solid black;"  width="15%">Length</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_pencilpant_length'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_normalpant_length'] . '</td>
	</tr>

	<tr><td rowspan="1" width="20%" style="border:1px solid black;">Length/Full Length</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_blouse_length'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_dress_length'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_gown_length'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_lehenga_length'] . '</td>
		<td style="border:1px solid black;"  width="15%">Waist round</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_pencilpant_waistround'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_normalpant_waistround'] . '</td>
	</tr>

	<tr><td rowspan="1" width="20%" style="border:1px solid black;">Chest</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_blouse_chest'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_dress_chest'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_gown_chest'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_lehenga_chest'] . '</td>
		<td style="border:1px solid black;"  width="15%">Ankle round</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_pencilpant_ankleround'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_normalpant_ankleround'] . '</td>
	</tr>

	<tr><td rowspan="1" width="20%" style="border:1px solid black;">Waist Round</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_blouse_waistround'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_dress_waistround'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_gown_waistround'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_lehenga_waistround'] . '</td>
		<td style="border:1px solid black;"  width="15%">Knee round</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_pencilpant_kneeround'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_normalpant_kneeround'] . '</td>
	</tr>

	<tr><td rowspan="1" width="20%" style="border:1px solid black;">Dot Point</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_blouse_dotpoint'] . '</td>
		<td style="border:1px solid black;"  width="12%"></td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_gown_dotpoint'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_lehenga_dotpoint'] . '</td>
		<td style="border:1px solid black;"  width="15%">Thigh round</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_pencilpant_thighround'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_normalpant_thighround'] . '</td>
	</tr>
	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">Hip round</td>
		<td style="border:1px solid black;"  width="12%"> -- </td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_dress_hip'] . '</td>
		<td style="border:1px solid black;"  width="12%"> -- </td>
		<td style="border:1px solid black;"  width="12%"> -- </td>
		<td style="border:1px solid black;"  width="39%" colspan="3" rowspan="11"> Remarks :- <br>
		&nbsp;&nbsp;' . @$measurements['mt1_remarks'] . '</td>
	</tr>
	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">Slit</td>
		<td style="border:1px solid black;"  width="12%"> -- </td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_dress_slit'] . '</td>
		<td style="border:1px solid black;"  width="12%"> -- </td>
		<td style="border:1px solid black;"  width="12%"> -- </td>
	</tr>
	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">Yolk</td>
		<td style="border:1px solid black;"  width="12%"> -- </td>
		<td style="border:1px solid black;"  width="12%"> -- </td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_gown_yolk'] . '</td>
		<td style="border:1px solid black;"  width="12%"> -- </td>
	</tr>
	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">Arm hole</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_blouse_armhole'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_dress_armhole'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_gown_armhole'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_lehenga_armhole'] . '</td>
	</tr>
	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">Sleeve length</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_blouse_sleevelength'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_dress_sleevelength'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_gown_sleevelength'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_lehenga_sleevelength'] . '</td>
	</tr>
	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">Sleeve round</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_blouse_sleeveround'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_dress_sleeveround'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_gown_sleeveround'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_lehenga_sleeveround'] . '</td>
	</tr>
	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">Front deep</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_blouse_frontdeep'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_dress_frontdeep'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_gown_frontdeep'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_lehenga_frontdeep'] . '</td>
	</tr>
	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">Back deep</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_blouse_backdeep'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_dress_backdeep'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_gown_backdeep'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_lehenga_backdeep'] . '</td>
	</tr>

	<tr>
		<td rowspan="1" width="20%"></td>
		<td width="12%"></td>
		<td width="12%"></td>
		<td width="12%"></td>
		<td width="12%">2.Skirt</td>
	</tr>
	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">Length</td>
		<td style="border-top:1px solid black;"  width="12%"></td>
		<td style="border-top:1px solid black;"  width="12%"></td>
		<td style="border-top:1px solid black;"  width="12%"></td>
		<td style="border-top:1px solid black;"  width="12%">' . @$measurements['mt1_skrit_lehenga_length'] . '</td>
	</tr>
	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">Waist round</td>
		<td style="border-top:1px solid black;"  width="12%"></td>
		<td style="border-top:1px solid black;"  width="12%"></td>
		<td style="border-top:1px solid black;"  width="12%"></td>
		<td style="border-top:1px solid black;"  width="12%">' . @$measurements['mt1_skrit_lehenga_waistround'] . '</td>
	</tr>
	

	</table></td>
	</tr>
	</table>
	<div style="height: 50px;"></div>
	<table width="100%">
	</table>
	</div>';
		} elseif ($this->session->userdata('BoutiqueID') == 8 || $this->session->userdata('BoutiqueID') == 9 || $this->session->userdata('BoutiqueID') == 10) {

			$logoimagepath = '<img height="70" width="210" src="https://boutiquesmanager.com/uploads/logo/beboo-logo.png">';

			if ($this->session->userdata('BoutiqueID') == 9) {
				$addressBoutique = 'Door No.26/410, Palace Road, Central Building (Kalliyath Building), Thrissur<br>
            Ph : 82814 34180  | Email - rose@bebooandme.com';
			} elseif ($this->session->userdata('BoutiqueID') == 8) {
				$addressBoutique = 'Avenue Road, Mundupalam Junction,Thrissur<br>
            Ph : 62389 89824  | Email - rose@bebooandme.com';
			} elseif ($this->session->userdata('BoutiqueID') == 10) {
				$addressBoutique = 'Parakkot Lane, Pattraickal,Thrissur 233020<br>
            Ph : 91881 80458  | Email - rose@bebooandme.com';
			}


			$html = '<div style="text-align: center;">
			<h1>' . $logoimagepath . '</h1>
			<h4>' . $addressBoutique . '</h4>
			<div>Measurement Form</div>
			<table width="100%">
		<tr>
			<td>Name:' . @$customer['boutique_customer_name'] . '</td>
			<td>Mob:' . @$customer['boutique_customer_ph'] . '</td>
		</tr>
	</table>
	<div style="height: 100px;"></div>

	<table width="98%" style="border:1px solid #000000;">
		<br><br>
		<tr>
			<td width="10%" style="padding: 10px; width: 30px; height: 30px;">
			Kurta
			</td>
			<td width="4%" style="border:1px solid #000000; width: 10px; height: 30px;"></td>

			<td width="10%" style="padding: 10px; width: 30px; height: 30px;">
			Frock
			</td>
			<td width="4%" style="border:1px solid #000000; width: 10px; height: 30px;"></td>

			<td width="10%" style="padding: 10px; width: 30px; height: 30px;">
			Top
			</td>
			<td width="4%" style="border:1px solid #000000; width: 10px; height: 30px;"></td>

			<td width="10%" style="padding: 10px; width: 30px; height: 30px;">
			Blouse
			</td>
			<td width="4%" style="border:1px solid #000000; width: 10px; height: 30px;"></td>

			<td width="8%" style="padding: 10px; width: 30px; height: 30px;">
			Skirt
			</td>
			<td width="4%" style="border:1px solid #000000; width: 10px; height: 30px;"></td>

			<td width="8%" style="padding: 10px; width: 30px; height: 30px;">
			Cape
			</td>
			<td width="4%" style="border:1px solid #000000; width: 10px; height: 30px;"></td>

			<td width="10%" style="padding: 10px; width: 30px; height: 30px;">
			Overcoat
			</td>
			<td width="4%" style="border:1px solid #000000; width: 10px; height: 30px;"></td>

			<td width="8%" style="padding: 10px; width: 30px; height: 30px;">
			Saree
			</td>
			<td width="4%" style="border:1px solid #000000; width: 10px; height: 30px;"></td>
			<td width="2%"></td>
		</tr>
<br>
		<tr>
			<td width="10%" style="padding: 10px; width: 30px; height: 30px;">
			Churi
			</td>
			<td width="4%" style="border:1px solid #000000; width: 10px; height: 30px;"></td>

			<td width="10%" style="padding: 10px; width: 30px; height: 30px;">
			Salwar
			</td>
			<td width="4%" style="border:1px solid #000000; width: 10px; height: 30px;"></td>

			<td width="10%" style="padding: 10px; width: 30px; height: 30px;">
			Pattiyala
			</td>
			<td width="4%" style="border:1px solid #000000; width: 10px; height: 30px;"></td>

			<td width="10%" style="padding: 10px; width: 30px; height: 30px;">
			Gown
			</td>
			<td width="4%" style="border:1px solid #000000; width: 10px; height: 30px;"></td>

			<td width="14%" style="padding: 10px; width: 30px; height: 30px;">
			Straight Pant
			</td>
			<td width="4%" style="border:1px solid #000000; width: 10px; height: 30px;"></td>

			<td width="14%" style="padding: 10px; width: 30px; height: 30px;">
			Narrow Pant
			</td>
			<td width="4%" style="border:1px solid #000000; width: 10px; height: 30px;"></td>

			<td width="10%" style="padding: 10px; width: 30px; height: 30px;">
			Palazo
			</td>
			<td width="4%" style="border:1px solid #000000; width: 10px; height: 30px;"></td>

			<td></td>
			<td></td>
			<td width="2%"></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td><td></td><td></td><td></td><td></td><td></td><td width="2%"></td>
		</tr>
	</table>
	<table>
	<tr>
	<td width="33%">
	<table style="border:1px solid black; text-align:left; padding:5px 0px 0px 5px;">
	<tr><td rowspan="2" width="50%" style="border:1px solid black;">Front Neck</td><td style="border:1px solid black;" width="25%">Length</td><td style="border:1px solid black;"  width="25%">' . @$measurements['mt1_frontneck_length'] . '</td></tr>
	<tr><td style="border:1px solid black;">Width</td><td style="border:1px solid black;">' . @$measurements['mt1_frontneck_width'] . '</td></tr>

	<tr><td rowspan="2" style="border:1px solid black;">Back Neck</td><td style="border:1px solid black;">Length</td><td style="border:1px solid black;">' . @$measurements['mt1_backneck_length'] . '</td></tr>
	<tr><td style="border:1px solid black;">Width</td><td style="border:1px solid black;">' . @$measurements['mt1_backneck_width'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Chest</td><td style="border:1px solid black;" width="25%">' . @$measurements['mt1_chest_1'] . '</td><td style="border:1px solid black;" width="25%">' . @$measurements['mt1_chest_2'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;">Breast Point</td><td width="25%" style="border:1px solid black;">' . @$measurements['mt1_breast_point_1'] . '</td><td width="25%" style="border:1px solid black;">' . @$measurements['mt1_breast_point_2'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;">Breast Distance</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['mt1_breast_distance_1'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;">Waist</td><td width="25%" style="border:1px solid black;">' . @$measurements['mt1_waist_1'] . '</td><td width="25%" style="border:1px solid black;">' . @$measurements['mt1_waist_2'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;">Yoke</td><td width="25%" style="border:1px solid black;">' . @$measurements['mt1_yoke_1'] . '</td><td width="25%" style="border:1px solid black;">' . @$measurements['mt1_yoke_2'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;">HIP</td><td width="25%" style="border:1px solid black;">' . @$measurements['mt1_hip_1'] . '</td><td width="25%" style="border:1px solid black;">' . @$measurements['mt1_hip_2'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;">Slit</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['mt1_slit_1'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;">Sleeve Total</td><td width="25%" style="border:1px solid black;">' . @$measurements['mt1_sleevetotal_1'] . '</td><td width="25%" style="border:1px solid black;">' . @$measurements['mt1_sleevetotal_2'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;">Sleeve Middle</td><td width="25%" style="border:1px solid black;">' . @$measurements['mt1_sleevemiddle_1'] . '</td><td width="25%" style="border:1px solid black;">' . @$measurements['mt1_sleevemiddle_2'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;">Armhole</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['mt1_armhole_1'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Shoulder</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['mt1_shoulder_1'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Finished Shoulder</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['mt1_finished_shoulder_1'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;">Total Length</td><td colspan="2">' . @$measurements['mt1_totallength_1'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;"></td><td colspan="2" width="50%" style="border:1px solid black;"></td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Waist</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['mt1_waist_3'] . '</td></tr>


	<tr><td colspan="2" width="50%" style="border:1px solid black;">HIP</td><td width="25%" style="border:1px solid black;">' . @$measurements['mt1_hip_3'] . '</td><td width="25%" style="border:1px solid black;">' . @$measurements['mt1_hip_4'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;">Middle/Thighs</td><td width="25%" style="border:1px solid black;">' . @$measurements['mt1_middle_thighs_1'] . '</td><td width="25%" style="border:1px solid black;">' . @$measurements['mt1_middle_thighs_2'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;">¾th</td><td width="25%" style="border:1px solid black;">' . @$measurements['mt1_3th_1'] . '</td><td width="25%" style="border:1px solid black;">' . @$measurements['mt1_3th_2'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;">Leg Open</td><td colspan="2">' . @$measurements['mt1_legopen_1'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;">Total Length</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['mt1_totallength_2'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;"></td><td colspan="2" width="50%" style="border:1px solid black;"></td></tr>

	</table></td>
	<td><table width="100%">
	<tr><td style="border:1px solid black;" width="146%" height="433"></td></tr>
	<tr><td style="border:1px solid black; text-align:left;" width="146%" height="83"> Remarks <br>
	 ' . @$measurements['mt1_remarks'] . '
	</td></tr>
	</table></td>
	</tr>
	</table>
	<div style="height: 50px;"></div>
	<table width="100%">
	</table>
	</div>';
		} elseif ($this->session->userdata('BoutiqueID') == 5) {

			$html = '<div style="text-align: center;">
			<h1>Naira Designer Boutique</h1>
			<div>Measurement Form</div>
			<table width="100%">
		<tr>
			<td>Name:' . @$customer['boutique_customer_name'] . '</td>
			<td>Mob:' . @$customer['boutique_customer_ph'] . '</td>
		</tr>
	</table>
	<div style="height: 100px;"></div>

	<table width="100%">
		<tr>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				FL</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				SH</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				CH</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				B</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				W</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				STOM</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				HIP</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				UB</th>
		   <th></th>
		</tr>
		<tr>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_fl'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_sh'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_ch'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_b'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_w'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_stom'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_hip'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_ub'] . '
			</td>
			<td width="20%"></td>
		</tr>
	</table>
	<div style="height: 50px;"></div>
	<table width="100%">
		<tr>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				Sh-B</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				Sh-W</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				Sh-Stom</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				Sh-HIP</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				SLV L</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				SLV R</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				BICEPS</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				AH</th>
		   <th></th>
		</tr>
		<tr>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_sh_b'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_sh_w'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_sh_stom'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_sh_hip'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_slv_l'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_slv_r'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_biceps'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_ah'] . '
			</td>
			<td width="20%"></td>
		</tr>
	</table>
	<div style="height: 50px;"></div>
	<table width="100%">
		<tr>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				FN</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				BN</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				WIDE</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				Collar R</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				FW</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				BW</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				SLT L</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				SLT R</th>
		   <th></th>
		</tr>
		<tr>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_fn'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_bn'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_wide'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_collar_r'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_fw'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_bw'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_slt_l'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_slt_r'] . '
			</td>
			<td width="20%"></td>
		</tr>
	</table>
	<div style="height: 50px;"></div>
	<table width="100%">
		<tr>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				Yoke L</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				Yoke R</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				CW</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				FLR</th>
		   <th></th>
		</tr>
		<tr>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
				' . @$measurements['mt1_yoke_l'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
				' . @$measurements['mt1_yoke_r'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
				' . @$measurements['mt1_cw'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
				' . @$measurements['mt1_flr'] . '
			</td>
			
			<td width="60%"></td>
		</tr>
	</table>
<div style="height: 50px;"></div>
	<table width="100%">
		<tr>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				Btm L</th>
				<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				Btm W</th>
				<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				Edge R</th>
				<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				W-Th L</th>
				<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				Thigh R</th>
		   <th></th>
		</tr>
		<tr>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_btm_l'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_btm_w'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_edge_r'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_w_th_l'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_thigh_r'] . '
			</td>
			
			<td width="50%"></td>
		</tr>
	</table>
<div style="height: 50px;"></div>
	<table width="100%">
		<tr>
		   <th><div style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				W-Knee L</div></th>
			<th width="2.5%"></th>
		   <th><div style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				Knee R</div></th>
		   <th width="2.5%"></th>
		   <th><div style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				W-Calf L</div></th>
		   <th width="2.5%"></th>
		   <th><div style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				Calf R</div></th>
		   <th width="2.5%"></th>
		   <th><div style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				Crotch L</div></th>
		   <th></th>
		</tr>
		<tr>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 40px; height: 30px;">
			' . @$measurements['mt1_w_knee_l'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_knee_r'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_w_calf_l'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_calf_r'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_crotch_l'] . '
			</td>
			
			<td width="50%"></td>
		</tr>
	</table>

		</div>';
		} elseif ($this->session->userdata('BoutiqueID') == 6) {
			$html = '<div style="text-align: center;">
			<h1>Trends Boutique</h1>
			</div>
			<table width="100%" style="border-bottom:1px solid #000000;">
		<tr>
			<td>Name: ' . @$customer['boutique_customer_name'] . '</td>
			<td>Mob: ' . @$customer['boutique_customer_ph'] . '</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
		</tr>
	</table>
	<div style="height: 10px;"></div>


	<table width="100%">
		<tr>
			<td>
			<table width="100%">
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			L
			</td>
			<td width="50%" style=" padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_l'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			SH
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_sh'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			SL
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_sl'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			SR
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_sr'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			AH
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_ah'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			CH
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_ch'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			BR
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_br'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			W
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_w'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			SE
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_se'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			SL
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_s_l'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			FL
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_f_l'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			NF
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_n_f'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			NB
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_n_b'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			W
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_w_1'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			BOTTOM
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_bottom'] . '
			</td>
		</tr>
		
	</table></td>
			<td>
			<table>
			<tr>
			<td width="100%" height="30px" align="left" style="">
			Remarks
			</td>
			</tr>
			<tr>
			<td width="100%" style="border:1px solid #000000; padding: 10px; width: 50px; height: 200px;">
			<br><br>&nbsp;&nbsp;
			' . @$measurements['mt1_remarks'] . '
			</td>
			</tr>
			</table>
			</td>
		</tr>
	</table>
		</div>';
		} elseif ($this->session->userdata('BoutiqueID') == 7) {
			$html = '<div style="text-align: center;">
			<h1>Tailor Made Fashion Studio</h1>
			<h4>Ettumanoor - Mob: 9847016103</h4>
			</div>
			<table width="100%" style="border-bottom:1px solid #000000;">
		<tr>
			<td>Name: ' . @$customer['boutique_customer_name'] . '</td>
			<td>Mob: ' . @$customer['boutique_customer_ph'] . '</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
		</tr>
	</table>
	<div style="height: 10px;"></div>


	<table width="100%">
		<tr>
			<td>
			<table width="100%">
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			Full length
			</td>
			<td width="50%" style=" padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_full_length'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			Shoulder
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_shoulder'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			Upper Chest
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_upper_chest'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			Brust
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_brust'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			Shape (Stomach)
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_shape'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			Hip
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_hip'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			Slite Length
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_slite_length'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			Slite Round
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_slite_round'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			Flair
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_flair'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			Sleeve Length
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_sleeve_length'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			Sleeve Round
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_sleeve_round'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			Arm Hole
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_arm_hole'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			Front Neck Length
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_front_neck_length'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			Back Neck Length
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_back_neck_length'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			Shoulder Wide
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_shoulder_wide'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="center" style="">
			<br>
			Bottom
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			Full Length
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_b_full_length'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			Knee Round
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_b_knee_round'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			Bottom Round
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt1_b_round'] . '
			</td>
		</tr>
	</table></td>
			<td>
			<table>
			<tr>
			<td width="100%" height="30px" align="left" style="">
			Remarks
			</td>
			</tr>
			<tr>
			<td width="100%" style="border:1px solid #000000; padding: 10px; width: 50px; height: 200px;">
			<br><br>&nbsp;&nbsp;
			' . @$measurements['mt1_remarks'] . '
			</td>
			</tr>
			</table>
			</td>
		</tr>
	</table>
		</div>';
		} elseif ($this->session->userdata('BoutiqueID') == 12) {

			$logo =	'<img src="https://boutiquesmanager.com/assets/images/images.jpg" height="100" width="160" />';

			$html = '<div style="text-align: center; border-top:1px solid #000000; border-left:1px solid #000000; border-right:1px solid #000000;">
			' . $logo . '
		</div>
		<table width="100%" style="border-top:1px solid #000000; border-left:1px solid #000000; border-right:1px solid #000000; padding:5px;">
		<tr>
			<td colspan="3">Customer Name: ' . @$customer['boutique_customer_name'] . '</td>
		</tr>
		<tr>
			<td>Mob: ' . @$customer['boutique_customer_ph'] . '</td>
			<td colspan="2">Address: ' . @$customer['boutique_customer_address'] . '</td>
		</tr>
		</table>

	
	<table width="100%" style="border:1px solid #000000;">
	<tr>
			<td>
			<br>
			<br>
			<u>All Measurements Are In Inches</u>
			<br>
			</td>
		</tr>
		<tr>
			<td width="50%">
		<table width="100%" style="border:1px solid #000000; padding:5px;">
		<tr>
			<td width="50%" height="30px" align="left" >
			<br>
			TOP : -
			</td>
			<td width="50%" style=" padding: 10px; width: 30px; height: 30px;">
			
			</td>
		</tr>
		<tr>
			<td width="10%">1.</td>
			<td width="50%" height="30px" align="left" style="">
			<br>
			TOP LENGTH (L)
			</td>
			<td width="30%" style="width: 30px; height: 30px; border-bottom:1px dotted black; padding-right:10px;">
			' . @$measurements['mt1_top_length'] . '
			</td>
		</tr>
		<tr>
			<td width="10%">2.</td>
			<td width="50%" height="30px" align="left" style="">
			<br>
			UPPER CHEST (UC)
			</td>
			<td width="30%" style="width: 30px; height: 30px; border-bottom:1px dotted black; padding-right:10px;">
			' . @$measurements['mt1_upper_chest'] . '
			</td>
		</tr>
		<tr>
		    <td width="10%">3.</td>
			<td width="50%" height="30px" align="left" style="">
			<br>
			CHEST (C)
			</td>
			<td width="30%" style="width: 30px; height: 30px; border-bottom:1px dotted black; padding-right:10px;">
			' . @$measurements['mt1_chest'] . '
			</td>
		</tr>
		<tr>
		    <td width="10%">4.</td>
			<td width="50%" height="30px" align="left" style="">
			<br>
			SHAPE (S)
			</td>
			<td width="30%" style="width: 30px; height: 30px; border-bottom:1px dotted black; padding-right:10px;">
			' . @$measurements['mt1_shape'] . '
			</td>
		</tr>
		<tr>
		    <td width="10%">5.</td>
			<td width="50%" height="30px" align="left" style="">
			<br>
			HIP (H)
			</td>
			<td width="30%" style="width: 30px; height: 30px; border-bottom:1px dotted black; padding-right:10px;">
			' . @$measurements['mt1_hip'] . '
			</td>
		</tr>
		<tr>
		    <td width="10%">6.</td>
			<td width="50%" height="30px" align="left" style="">
			<br>
			SHOULDER (SHL)
			</td>
			<td width="30%" style="width: 30px; height: 30px; border-bottom:1px dotted black; padding-right:10px;">
			' . @$measurements['mt1_shoulder'] . '
			</td>
		</tr>
		<tr>
		    <td width="10%">7.</td>
			<td width="50%" height="30px" align="left" style="">
			<br>
			SLEEVE (SL)
			</td>
			<td width="30%" style="width: 30px; height: 30px; border-bottom:1px dotted black; padding-right:10px;">
			' . @$measurements['mt1_sleeve'] . '
			</td>
		</tr>
		<tr>
		    <td width="10%">.</td>
			<td width="50%" height="30px" align="left" style="">
			<br>
			ARM HOLE (AH)
			</td>
			<td width="30%" style="width: 30px; height: 30px; border-bottom:1px dotted black; padding-right:10px;">
			' . @$measurements['mt1_arm_hole'] . '
			</td>
		</tr>
		<tr>
		    <td width="10%">.</td>
			<td width="50%" height="30px" align="left" style="">
			<br>
			BICEPS (B)
			</td>
			<td width="30%" style="width: 30px; height: 30px; border-bottom:1px dotted black; padding-right:10px;">
			' . @$measurements['mt1_biceps'] . '
			</td>
		</tr>
		<tr>
		    <td width="10%">.</td>
			<td width="50%" height="30px" align="left" style="">
			<br>
			ELBOW (E)
			</td>
			<td width="30%" style="width: 30px; height: 30px; border-bottom:1px dotted black; padding-right:10px;">
			' . @$measurements['mt1_elbow'] . '
			</td>
		</tr>
		<tr>
		    <td width="10%">.</td>
			<td width="50%" height="30px" align="left" style="">
			<br>
			WRIST (W)
			</td>
			<td width="30%" style="width: 30px; height: 30px; border-bottom:1px dotted black; padding-right:10px;">
			' . @$measurements['mt1_wrist'] . '
			</td>
		</tr>
		<tr>
		    <td width="10%">8.</td>
			<td width="50%" height="30px" align="left" style="">
			<br>
			FRONT NECK (FN)
			</td>
			<td width="30%" style="width: 30px; height: 30px; border-bottom:1px dotted black; padding-right:10px;">
			' . @$measurements['mt1_front_neck'] . '
			</td>
		</tr>
		<tr>
		    <td width="10%">9.</td>
			<td width="50%" height="30px" align="left" style="">
			<br>
			BACK NECK (BN)
			</td>
			<td width="30%" style="width: 30px; height: 30px; border-bottom:1px dotted black; padding-right:10px;">
			' . @$measurements['mt1_back_neck'] . '
			</td>
		</tr>
		<tr>
		    <td width="10%">10.</td>
			<td width="50%" height="30px" align="left" style="">
			<br>
			COLLAR (COL)
			</td>
			<td width="30%" style="width: 30px; height: 30px; border-bottom:1px dotted black; padding-right:10px;">
			' . @$measurements['mt1_collar'] . '
			</td>
		</tr>
		<tr>
		    <td width="10%">8.</td>
			<td width="50%" height="30px" align="left" style="">
			<br>
			APEX (BLOUSE)
			</td>
			<td width="30%" style="width: 30px; height: 30px; border-bottom:1px dotted black; padding-right:10px;">
			' . @$measurements['mt1_blouse'] . '
			</td>
		</tr>
	</table>
	</td>
	<td width="50%">
	<table width="100%" style="border:1px solid #000000; padding:5px;">
						<tr>
			<td width="50%" height="30px" align="center" style="">
			<br>
			<u>BOTTOM</u>
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			</td>
		</tr>
		<tr>
			<td width="10%">1.</td>
			<td width="50%" height="30px" align="left" style="">
			<br>
			LENGTH
			</td>
			<td width="30%" style="width: 30px; height: 30px; border-bottom:1px dotted black; padding-right:10px;">
			' . @$measurements['mt1_b_length'] . '
			</td>
		</tr>
		<tr>
			<td width="10%">2.</td>
			<td width="50%" height="30px" align="left" style="">
			<br>
			HIPS
			</td>
			<td width="30%" style="width: 30px; height: 30px; border-bottom:1px dotted black; padding-right:10px;">
			' . @$measurements['mt1_b_hips'] . '
			</td>
		</tr>
		<tr>
		    <td width="10%">3.</td>
			<td width="50%" height="30px" align="left" style="">
			<br>
			THINGS
			</td>
			<td width="30%" style="width: 30px; height: 30px; border-bottom:1px dotted black; padding-right:10px;">
			' . @$measurements['mt1_b_thighs'] . '
			</td>
		</tr>
		<tr>
		    <td width="10%">4.</td>
			<td width="50%" height="30px" align="left" style="">
			<br>
			KNEES
			</td>
			<td width="30%" style="width: 30px; height: 30px; border-bottom:1px dotted black; padding-right:10px;">
			' . @$measurements['mt1_b_knees'] . '
			</td>
		</tr>
		<tr>
		    <td width="10%">5.</td>
			<td width="50%" height="30px" align="left" style="">
			<br>
			CALF
			</td>
			<td width="30%" style="width: 30px; height: 30px; border-bottom:1px dotted black; padding-right:10px;">
			' . @$measurements['mt1_b_calf'] . '
			</td>
		</tr>
		<tr>
		    <td width="10%">6.</td>
			<td width="50%" height="30px" align="left" style="">
			<br>
			ANKLE
			</td>
			<td width="30%" style="width: 30px; height: 30px; border-bottom:1px dotted black; padding-right:10px;">
			' . @$measurements['mt1_b_ankle'] . '
			</td>
		</tr>
	</table>
	</td>
		</tr>
		<tr>
		<td></td>
		<td></td>
		</tr>
	</table>

		</div>';
		}elseif($this->session->userdata('BoutiqueID') == 57)
		{
			$logoimagepath = $this->session->userdata('BoutiqueName');

			$addressBoutique = $this->session->userdata('BoutiqueAddr') . '<br>
            Ph : ' . $this->session->userdata('BoutiquePh') . '  | Email - ' . $this->session->userdata('BoutiqueEmail');
			if ($this->session->userdata('BoutiqueID') == 53) {
				$field_name = "Weight ";
			} else {
				$field_name = "Ghera";
			}
			$html = '<div style="text-align: center;">
			<h1>' . $logoimagepath . '</h1>
			<h4>' . $addressBoutique . '</h4>
			<div>Measurement Form<br></div>
			<table width="100%">
		<tr>
			
			<td width="50%">Name:' . @$customer['boutique_customer_name'] . '</td>
			<td width="50%">Mob:' . @$customer['boutique_customer_ph'] . '</td>
			
			
		</tr>

	</table>
	<div style="height:1px;"></div>
	<div style="height:1px;">GENTS</div>
	<table width="105%" height="500px" style="border:1px solid black;">
	<tr>
	<td  colspan="6" style="border:1px solid black;">
	[SHIRT/KURTHA]-STYLE
	</td>
	</tr>
	<tr>
	<td   style="border:1px solid black; text-align:center;">Length<br>' . @$measurements['zm_sk_length'] . '</td>
	<td   style="border:1px solid black; text-align:center;">Chest<br>' . @$measurements['zm_sk_chest'] . '</td>
	<td   style="border:1px solid black; text-align:center;">Stomach<br>' . @$measurements['zm_sk_stomach'] . '</td>
	<td   style="border:1px solid black; text-align:center;">Hip<br>' . @$measurements['zm_sk_hip'] . '</td>
	<td   style="border:1px solid black; text-align:center;">Shoulder<br>' . @$measurements['zm_sk_shoulder'] . '</td>
	<td   style="border:1px solid black; text-align:center;">Sleeves<br>' . @$measurements['zm_sk_sleeves'] . '</td>
	</tr>
	<tr>
	<td   style="border:1px solid black; text-align:center;">Neck<br>' . @$measurements['zm_sk_neck'] . '</td>
	<td   style="border:1px solid black; text-align:center;">Collar<br>' . @$measurements['zm_sk_collar'] . '</td>
	<td   style="border:1px solid black; text-align:center;">Half chest<br>' . @$measurements['zm_sk_half_chest'] . '</td>
	<td   style="border:1px solid black; text-align:center;"> Half back<br>' . @$measurements['zm_sk_half_back'] . '</td>
	<td   style="border:1px solid black; text-align:center;">Full kurtha length<br>' . @$measurements['zm_sk_full_kurtha_length'] . '</td>
	<td   style="border:1px solid black; text-align:center;"> Biceps<br>' . @$measurements['zm_sk_biceps'] . '</td>
	</tr>
	</table>
	<div style="height: 1px;"></div>
	<table width="105%" style="border:1px solid black;">
	<tr>
	<td  colspan="6" style="border:1px solid black;">
	[PANT]-STYLE
	</td>
	</tr>
	<tr>
	<td   style="border:1px solid black; text-align:center;">Length<br>' . @$measurements['zm_p_length'] . '</td>
	<td   style="border:1px solid black; text-align:center;">Waist<br>' . @$measurements['zm_p_waist'] . '</td>
	<td   style="border:1px solid black; text-align:center;">Hip<br>' . @$measurements['zm_p_hip'] . '</td>
	<td   style="border:1px solid black; text-align:center;">Thigh<br>' . @$measurements['zm_p_thigh'] . '</td>
	<td   style="border:1px solid black; text-align:center;">Bottom<br>' . @$measurements['zm_p_bottom'] . '</td>
	<td   style="border:1px solid black; text-align:center;"> Full fork<br>' . @$measurements['zm_p_full_fork'] . '</td>
	</tr>
	<tr>
	<td   style="border:1px solid black; text-align:center;">In-seam<br>' . @$measurements['zm_p_in_seam'] . '</td>
	<td   style="border:1px solid black; text-align:center;"> Knee<br>' . @$measurements['zm_p_knee'] . '</td>
	<td   style="border:1px solid black; text-align:center;">Calf<br>' . @$measurements['zm_p_calf'] . '</td>
	<td   style="border:1px solid black; text-align:center;">&nbsp;<br>' . @$measurements['zm_p_other1'] . '</td>
	<td   style="border:1px solid black; text-align:center;">&nbsp;<br>' . @$measurements['zm_p_other2'] . '</td>
	<td   style="border:1px solid black; text-align:center;">&nbsp;<br>' . @$measurements['zm_p_other3'] . '</td>
	</tr>
	</table>
	<div style="height: 1px;"></div>
	<table width="105%" style="border:1px solid black;">
	<tr>
	<td  colspan="6" style="border:1px solid black;">
	[SUIT/INDO WESTERN]-STYLE
	</td>
	</tr>
	<tr>
	<td   style="border:1px solid black; text-align:center;">Length<br>' . @$measurements['zm_si_length'] . '</td>
	<td   style="border:1px solid black; text-align:center;">Chest<br>' . @$measurements['zm_si_chest'] . '</td>
	<td   style="border:1px solid black; text-align:center;">Stomach<br>' . @$measurements['zm_si_stomach'] . '</td>
	<td   style="border:1px solid black; text-align:center;">Hip<br>' . @$measurements['zm_si_hip'] . '</td>
	<td   style="border:1px solid black; text-align:center;">Shoulder<br>' . @$measurements['zm_si_shoulder'] . '</td>
	<td   style="border:1px solid black; text-align:center;">Sleeves<br>' . @$measurements['zm_si_sleeves'] . '</td>
	</tr>
	<tr>
	<td   style="border:1px solid black; text-align:center;">Neck<br>' . @$measurements['zm_si_neck'] . '</td>
	<td   style="border:1px solid black; text-align:center;">Collar<br>' . @$measurements['zm_si_collar'] . '</td>
	<td   style="border:1px solid black; text-align:center;">Half chest<br>' . @$measurements['zm_si_half_chest'] . '</td>
	<td   style="border:1px solid black; text-align:center;"> Waist coat length<br>' . @$measurements['zm_si_waist_coat_length'] . '</td>
	<td   style="border:1px solid black; text-align:center;"> Sherwani length<br>' . @$measurements['zm_si_sherwani_length'] . '</td>
	<td   style="border:1px solid black; text-align:center;">Bundi coat length<br>' . @$measurements['zm_si_bundi_coat_length'] . '</td>
	</tr>
	</table>
	<div style="height: 1px;"></div>
	<div style="height:1px;">LADIES</div>
	<table>
	<tr>
	<td width="35%">
	<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px;">
	<tr><td colspan="2" width="100%" style="border:1px solid black; text-align:center;">Top</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Full Length</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['zm_l_full_length'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Yoke</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['zm_l_yoke'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Upper chest</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['zm_l_upper_chest'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;"> Bust</td><td colspan="2">' . @$measurements['zm_l_bust'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Lower bust</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['zm_l_lower_bust'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;"> Waist</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['zm_l_waist'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;"> Hip</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['zm_l_hip'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;"> Seat</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['zm_l_seat'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">  Shoulder</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['zm_l_shoulder'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Sleeve length</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['zm_l_sleeve_length'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;"> Armhole</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['zm_l_armhole'] . '</td></tr>

	</table>
	</td>
<td width="1%">
	</td>
	<td width="35%">
	<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px;">
	<tr><td colspan="2" width="50%" style="border:1px solid black;"> Bicep</td><td colspan="2">' . @$measurements['zm_l_bicep'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;"> Elbow</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['zm_l_elbow'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Sleeve round</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['zm_l_sleeve_round'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">  Wrist</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['zm_l_wrist'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;"> Front neck</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['zm_l_front_neck'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;"> Back neck</td><td colspan="2">' . @$measurements['zm_l_back_neck'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;"> Neck width</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['zm_l_neck_width'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;"> Collar</td><td colspan="2">' . @$measurements['zm_l_collar'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;">Slit</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['zm_l_slit'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">  Flair</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['zm_l_flair'] . '</td></tr>
	

	</table>
	</td>
	<td width="1%"></td>
	<td width="35%">
	<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px;">
	<tr><td colspan="2" width="100%" style="border:1px solid black; text-align:center;">Bottom</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Length</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['zm_lb_length'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;"> Hip</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['zm_lb_hip'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;"> Thigh</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['zm_lb_thigh'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;">Calf</td><td colspan="2">' . @$measurements['zm_lb_calf'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Ankle</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['zm_lb_ankle'] . '</td></tr>

	</table>
	</td>

	<td width="1%">
	</td>

	</tr>
	</table>

	<div style="height: 50px;"></div>

	<table width="100%">
	<tr>
	<td style="border:1px solid black; text-align:left;" width="107%" > Remarks :- <br>
		&nbsp;&nbsp;' . @$orders[0]['boutique_work_material_desc'] . '<br>&nbsp;&nbsp;' . @$orders[1]['boutique_work_material_desc'] . '</td>
	</tr>
	</table>
	

	</div>';

		}elseif($this->session->userdata('BoutiqueID') == 61)
		{
			$logoimagepath = $this->session->userdata('BoutiqueName');

			$addressBoutique = $this->session->userdata('BoutiqueAddr') . '<br>
            Ph : ' . $this->session->userdata('BoutiquePh') . '  | Email - ' . $this->session->userdata('BoutiqueEmail');
			if ($this->session->userdata('BoutiqueID') == 53) {
				$field_name = "Weight ";
			} else {
				$field_name = "Ghera";
			}
			$html = '<div style="text-align: center;">
			<h1>' . $logoimagepath . '</h1>
			<h4>' . $addressBoutique . '</h4>
			<div>Measurement Form</div>
			<table width="100%">
		<tr>
			<td>Name:' . @$customer['boutique_customer_name'] . '</td>
			<td>Mob:' . @$customer['boutique_customer_ph'] . '</td>
		</tr>
	</table>
	<div style="height: 1px;"></div>
		
		
		<table>
		<tr>
		<td width="45%">
		<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px;">
		<tr><td colspan="2" width="100%" style="border:1px solid black; text-align:center;">Front</td></tr>
		<tr><td colspan="2" width="50%" style="border:1px solid black;">Yoke Length</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['eth_yoke_length'] . '</td></tr>
		<tr><td colspan="2" width="50%" style="border:1px solid black;">Sleeve Length</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['eth_s_length'] . '</td></tr>
		<tr><td colspan="2" width="50%" style="border:1px solid black;">Full Length</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['eth_full_length'] . '</td></tr>
		
		<tr><td colspan="2" width="50%" style="border:1px solid black;">Sleeve Round</td><td colspan="2">' . @$measurements['eth_s_round'] . '</td></tr>
		<tr><td colspan="2" width="50%" style="border:1px solid black;">Shoulder</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['eth_shoulder'] . '</td></tr>
		<tr><td colspan="2" width="50%" style="border:1px solid black;">Sleeve Center</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['eth_s_center'] . '</td></tr>
		
		<tr><td colspan="2" width="50%" style="border:1px solid black;">Chest</td><td colspan="2">' . @$measurements['eth_chest'] . '</td></tr>
		
		<tr><td colspan="2" width="50%" style="border:1px solid black;">Armhole</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['eth_armhole'] . '</td></tr>
		<tr><td colspan="2" width="50%" style="border:1px solid black;">Bust</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['eth_bust'] . '</td></tr>
		<tr><td colspan="2" width="50%" style="border:1px solid black;">Neck Front</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['eth_neck_front'] . '</td></tr>
		
		<tr><td colspan="2" width="50%" style="border:1px solid black;">Waist</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['eth_waist'] . '</td></tr>
		<tr><td colspan="2" width="50%" style="border:1px solid black;">Back</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['eth_back'] . '</td></tr>
		
		<tr><td colspan="2" width="50%" style="border:1px solid black;">Hip</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['eth_hip'] . '</td></tr>
		<tr><td colspan="2" width="50%" style="border:1px solid black;">Slit/A-Line/Panel/Umberella</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['eth_s_a_p_u'] . '</td></tr>
		
		
		</table>
		</td>
		
		<td width="1%">
		</td>
		
		<td width="45%">
		<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px;">
		
		<tr><td colspan="2" width="100%" style="border:1px solid black; text-align:center;">Back</td></tr>
		<tr><td colspan="2" width="50%" style="border:1px solid black;">Keyhole</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['eth_keyhole'] . '</td></tr>
		<tr><td colspan="2" width="50%" style="border:1px solid black;">Tear Drop</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['eth_t_d'] . '</td></tr>
		<tr><td colspan="2" width="50%" style="border:1px solid black;">Polti</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['eth_polti'] . '</td></tr>
		
		<tr><td colspan="2" width="50%" style="border:1px solid black;">Zip</td><td colspan="2">' . @$measurements['eth_zip'] . '</td></tr>
		<tr><td colspan="2" width="50%" style="border:1px solid black;">Illusion</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['eth_illusion'] . '</td></tr>
		
		<tr><td colspan="2" width="50%" style="border:1px solid black;">Waist</td><td colspan="2">' . @$measurements['eth_b_waist'] . '</td></tr>
		
		<tr><td colspan="2" width="50%" style="border:1px solid black;">Thigh</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['eth_b_thigh'] . '</td></tr>
		<tr><td colspan="2" width="50%" style="border:1px solid black;">Knee</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['eth_b_knee'] . '</td></tr>
		<tr><td colspan="2" width="50%" style="border:1px solid black;">Calf</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['eth_b_calf'] . '</td></tr>
		<tr><td colspan="2" width="50%" style="border:1px solid black;">Ankle</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['eth_b_ankle'] . '</td></tr>
		
		<tr><td colspan="2" width="50%" style="border:1px solid black;">Princess Cut</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['eth_b_p_c'] . '</td>
		</tr>
		<tr><td colspan="2" width="50%" style="border:1px solid black;">Padded</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['eth_b_padded'] . '</td>
		</tr>
		<tr><td colspan="2" width="50%" style="border:1px solid black;">Side Zip</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['eth_b_s_z'] . '</td>
		</tr>
		<tr><td colspan="2" width="50%" style="border:1px solid black;">Cutting Point</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['eth_c_p'] . '</td>
		</tr>
		<tr><td colspan="2" width="50%" style="border:1px solid black;">Point to Point</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['eth_b_p_p'] . '</td>
		</tr>
		</table>
		</td>
		
		<td width="1%">
		</td>
		
		
		</tr>
		</table>
		
		<div style="height: 50px;"></div>
		
		<table width="100%">
		<tr>
		<td style="border:1px solid black; text-align:left;" width="107%" height="150"> Remarks :- <br>
		&nbsp;&nbsp;' .@$measurements['eth_note']. '</td>
		</tr>
		</table>
		
		<div style="height: 50px;"></div>
		<table width="100%">
		</table>
		</div>';
		}
		 else {

			$logoimagepath = $this->session->userdata('BoutiqueName');

			$addressBoutique = $this->session->userdata('BoutiqueAddr') . '<br>
            Ph : ' . $this->session->userdata('BoutiquePh') . '  | Email - ' . $this->session->userdata('BoutiqueEmail');
			if ($this->session->userdata('BoutiqueID') == 53) {
				$field_name = "Weight ";
			} else {
				$field_name = "Ghera";
			}
	$html = '<div style="text-align: center;">
	<h1>' . $logoimagepath . '</h1>
	<h4>' . $addressBoutique . '</h4>
	<div>Measurement Form</div>
	<table width="100%">
<tr>
<td>Name:' . @$customer['boutique_customer_name'] . '</td>
			<td>Mob:' . @$customer['boutique_customer_ph'] . '</td>
</tr>

</table>
<div style="height: 1px;"></div>


<div style="height: 1px;"></div>


<table>
<tr>
<td width="35%">
<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px;">
<tr><td colspan="2" width="100%" style="border:1px solid black; text-align:center;">Coat</td></tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;">Length</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['c_length'] . '</td></tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;">Shoulder</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['c_sholder'] . '</td></tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;">Sleeve Length</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['c_s_length'] . '</td></tr>

<tr><td colspan="2" width="50%" style="border:1px solid black;">Chest</td><td colspan="2">' . @$measurements['c_chest'] . '</td></tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;">Waist</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['c_waist'] . '</td></tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;">Hip</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['c_hip'] . '</td></tr>

<tr><td colspan="2" width="50%" style="border:1px solid black;">Neck</td><td colspan="2">' . @$measurements['c_cb'] . '</td></tr>

<tr><td colspan="2" width="50%" style="border:1px solid black;"> C B</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['c_cb'] . '</td></tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;">Back Length</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['c_b_length'] . '</td></tr>
</table>
<table><tr><td></td></tr></table>
<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px;">
<tr><td colspan="2" width="100%" style="border:1px solid black; text-align:center;">Shirt</td></tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;">Length</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['shirt_length'] . '</td></tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;">Shoulder</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['shirt_sholder'] . '</td></tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;">Sleeve Length</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['shirt_s_length'] . '</td></tr>

<tr><td colspan="2" width="50%" style="border:1px solid black;">Chest</td><td colspan="2">' . @$measurements['shirt_chest'] . '</td></tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;">Waist</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['shirt_waist'] . '</td></tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;">Hip</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['shirt_hip'] . '</td></tr>

<tr><td colspan="2" width="50%" style="border:1px solid black;">Neck</td><td colspan="2">' . @$measurements['shirt_neck'] . '</td></tr>
</table>
<table><tr><td></td></tr></table>
</td>

<td width="1%">
</td>

<td width="35%">
<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px;">

<tr><td colspan="2" width="100%" style="border:1px solid black; text-align:center;">Pant</td></tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;">Length</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['pant_length'] . '</td></tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;">Waist</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['pant_waist'] . '</td></tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;">Hip</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['pant_hip'] . '</td></tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;"> Knee</td><td colspan="2">' . @$measurements['pant_knee'] . '</td></tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;">Thigh</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['pant_thigh'] . '</td></tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;">Bottom</td><td colspan="2">' . @$measurements['pant_bottom'] . '</td></tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;"> Fork</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['pant_fork'] . '</td></tr>
</table>
<table><tr><td></td></tr></table>
<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px;">
<tr><td colspan="2" width="100%" style="border:1px solid black; text-align:center;">Half Coat</td></tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;">Length</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['half_coat_l'] . '</td></tr>
</table>
<table><tr><td></td></tr></table>
<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px;">
<tr><td colspan="2" width="100%" style="border:1px solid black; text-align:center;">Bundi</td></tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;">Length</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['bundi_l'] . '</td></tr>
</table>
<table><tr><td></td></tr></table>
<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px;">
<tr><td colspan="2" width="100%" style="border:1px solid black; text-align:center;">Sherwani</td></tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;">Length</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['sherwani_l'] . '</td></tr>
</table>
<table><tr><td></td></tr></table>
<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px;">
<tr><td colspan="2" width="100%" style="border:1px solid black; text-align:center;">Indo Western</td></tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;">Length</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['indo_western_l'] . '</td></tr>
</table>
</td>

<td width="1%">
</td>
<td width="35%">
<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px; height:520px;">
<tr><td colspan="2" width="100%" style="border:1px solid black;text-align:center;">Breeches</td></tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;">Length</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['breeches_l'] . '</td></tr>
</table>
<table><tr><td></td></tr></table>
<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px; height:520px;">
<tr><td colspan="2" width="100%" style="border:1px solid black;text-align:center;">Kurtha</td></tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;">Length</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['kurtha_l'] . '</td></tr>
</table>
<table><tr><td></td></tr></table>
<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px; height:520px;">
<tr><td colspan="2" width="100%" style="border:1px solid black;text-align:center;">Dothi</td></tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;">Length</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['dothi_l'] . '</td></tr>
</table>
<table><tr><td></td></tr></table>
<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px; height:520px;">
<tr><td colspan="2" width="100%" style="border:1px solid black;text-align:center;">Sharara Bottom</td></tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;">Length</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['sb_l'] . '</td></tr>
</table>
</td>
</tr>
</table>

<div style="height: 50px;"></div>

<table width="100%">
<tr>
<td style="border:1px solid black; text-align:left;" width="107%" height="100"> Remarks :- <br>
&nbsp;&nbsp;' . @$measurements['mt1_remarks'] .'</td>
</tr>
</table>

<div style="height: 50px;"></div>
<table width="100%">
</table>
</div>';
		}
		/*
$html .= '<style>'.file_get_contents('https://boutiquesmanager.com/assets/bower_components/bootstrap/dist/css/bootstrap.min.css').'</style>';

$html .= '<style>'.file_get_contents('https://boutiquesmanager.com/assets/dist/css/AdminLTE.min.css').'</style>';
*/


		// Print text using writeHTMLCell()
		$pdf->writeHTML($html, true, false, true, false, '');

		// ---------------------------------------------------------

		// Close and output PDF document
		// This method has several options, check the source code documentation for more information.
		$pdf->Output(time() . '.pdf', 'I');

		//============================================================+
		// END OF FILE
		//============================================================+

	}

	public function customerMeasurements1()
	{


		$id = $this->uri->segment(3);
		$measurements = $this->getAllmeasurements($id);
		$customer = $this->Customer_model->m_getcustomer($id);
		//$workimage = $work['boutique_work_image'];
		//$workimagepath = '<img height="100" src="https://boutiquesmanager.com/uploads/work/"'.$workimage.'">';

		ini_set('max_execution_time', 0); // for infinite time of execution

		$this->load->library('Pdf');

		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Boutique Manager');
		$pdf->SetTitle('Blouse Measurements');
		$pdf->SetSubject('Blouse Measurements - customer');
		$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

		// set default header data
		//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 061', PDF_HEADER_STRING);

		// set header and footer fonts
		$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT - 10, PDF_MARGIN_TOP - 30, PDF_MARGIN_RIGHT);
		//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
			require_once(dirname(__FILE__) . '/lang/eng.php');
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
		if ($this->session->userdata('BoutiqueID') == 27) {

			$logoimagepath = 'Fulki Studio';

			$addressBoutique = 'Door No.26/410, Palace Road, Central Building (Kalliyath Building), Thrissur<br>
            Ph : 08040970806  | Email - fulkiwear@gmail.com';

			$html = '<div style="text-align: center;">
			<h1>' . $logoimagepath . '</h1>
			<h4>' . $addressBoutique . '</h4>
			<div>Measurement Form</div>
			<table width="100%">
		<tr>
			<td>Name:' . @$customer['boutique_customer_name'] . '</td>
			<td>Mob:' . @$customer['boutique_customer_ph'] . '</td>
		</tr>
	</table>
	<div style="height: 100px;"></div>

	<table width="98%" style="border:1px solid #000000;">
		<br><br>
		<tr>
			<td width="21%" style="padding: 10px; width: 30px; height: 30px;">
			Tick On
			</td>

			<td width="13%" style="padding: 10px; width: 30px; height: 30px;">
			Saree
			</td>
			<td width="4%" style="border:1px solid #000000; width: 10px; height: 30px;"></td>

			<td width="13%" style="padding: 10px; width: 30px; height: 30px;">
			Suits
			</td>
			<td width="4%" style="border:1px solid #000000; width: 10px; height: 30px;"></td>

			<td width="13%" style="padding: 10px; width: 30px; height: 30px;">
			Kurtis
			</td>
			<td width="4%" style="border:1px solid #000000; width: 10px; height: 30px;"></td>

			<td width="13%" style="padding: 10px; width: 30px; height: 30px;">
			Blouse
			</td>
			<td width="4%" style="border:1px solid #000000; width: 10px; height: 30px;"></td>

			<td width="13%" style="padding: 10px; width: 30px; height: 30px;">
			Tights
			</td>
			<td width="4%" style="border:1px solid #000000; width: 10px; height: 30px;"></td>

			<td width="2%"></td>
		</tr>

		<tr>
			<td></td>
			<td></td>
			<td></td><td></td><td></td><td></td><td></td><td></td><td width="2%"></td>
		</tr>
	</table>
	<table>
	<tr>
	<td width="33%">
	<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px;">
	<tr><td width="100%" style="text-align: center;">Upper Body</td></tr>
	<br>
	<tr>
		<td width="50%" style="">Length</td>

		<td style="border:1px solid black;"  width="25%">' . @$measurements['mt1_u_length'] . '</td>
	</tr>
	<br>
	<tr>
		<td width="50%" style="">Upper Chest</td>

		<td style="border:1px solid black;"  width="25%">' . @$measurements['mt1_u_upper_chest'] . '</td>
	</tr>
	<br>

	<tr>
		<td width="50%" style="">Front Cross</td>

		<td style="border:1px solid black;"  width="25%">' . @$measurements['mt1_u_front_cross'] . '</td>
	</tr>
	<br>
	<tr>
		<td width="50%" style="">Chest</td>

		<td style="border:1px solid black;"  width="25%">' . @$measurements['mt1_u_chest'] . '</td>
	</tr>
	<br>

	<tr>
		<td width="50%" style="">Dart Point</td>

		<td style="border:1px solid black;"  width="25%">' . @$measurements['mt1_u_dartpoint'] . '</td>
	</tr>
	<br>
	<tr>
		<td width="50%" style="">Waist</td>

		<td style="border:1px solid black;"  width="25%">' . @$measurements['mt1_u_waist'] . '</td>
	</tr>
	<br>

	<tr>
		<td width="50%" style="">Hip</td>

		<td style="border:1px solid black;"  width="25%">' . @$measurements['mt1_u_hip'] . '</td>
	</tr>
	<br>
	<tr>
		<td width="50%" style="">Shoulder</td>

		<td style="border:1px solid black;"  width="25%">' . @$measurements['mt1_u_shoulder'] . '</td>
	</tr>
	<br>

	<tr>
		<td width="50%" style="">Sleeves Length</td>

		<td style="border:1px solid black;"  width="25%">' . @$measurements['mt1_u_sleeves_length'] . '</td>
	</tr>
	<br>
	<tr>
		<td width="50%" style="">Sleeves Open</td>

		<td style="border:1px solid black;"  width="15%">' . @$measurements['mt1_u_sleeves_open_1'] . '</td>

		<td style="border:1px solid black;"  width="15%">' . @$measurements['mt1_u_sleeves_open_2'] . '</td>

		<td style="border:1px solid black;"  width="15%">' . @$measurements['mt1_u_sleeves_open_3'] . '</td>

	</tr>
	<br>

	<tr>
		<td width="50%" style="">Arm Hole</td>

		<td style="border:1px solid black;"  width="25%">' . @$measurements['mt1_u_armholes'] . '</td>
	</tr>
	<br>
	<tr>
		<td width="50%" style="">Front Neck</td>

		<td style="border:1px solid black;"  width="25%">' . @$measurements['mt1_u_frontneck'] . '</td>
	</tr>
	<br>

	<tr>
		<td width="50%" style="">Back Neck</td>

		<td style="border:1px solid black;"  width="25%">' . @$measurements['mt1_u_backneck'] . '</td>
	</tr>
	<br>

	
	<tr><td width="100%" style=""></td></tr>

	</table></td>
	<td width="47%">
		<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px;">
	<tr><td width="100%" style="text-align: center;">Lower Body</td></tr>
	<br>
	<tr>
		<td width="50%" style="">Length</td>

		<td style="border:1px solid black;"  width="25%">' . @$measurements['mt1_l_length'] . '</td>
	</tr>
	<br>
	<tr>
		<td width="50%" style="">Waist</td>

		<td style="border:1px solid black;"  width="25%">' . @$measurements['mt1_l_waist'] . '</td>
	</tr>
	<br>

	<tr>
		<td width="50%" style="">Hip</td>
		<td style="border:1px solid black;"  width="25%">' . @$measurements['mt1_l_hip'] . '</td>
	</tr>
	<br>
	<tr>
		<td width="50%" style="">Fork</td>

		<td style="border:1px solid black;"  width="25%">' . @$measurements['mt1_l_fork'] . '</td>
	</tr>
	<br>

	<tr>
		<td width="50%" style="">Thigh</td>

		<td style="border:1px solid black;"  width="25%">' . @$measurements['mt1_l_thigh'] . '</td>
	</tr>
	<br>
	<tr>
		<td width="50%" style="">Knee</td>

		<td style="border:1px solid black;"  width="25%">' . @$measurements['mt1_l_knee'] . '</td>
	</tr>
	<br>

	<tr>
		<td width="50%" style="">Ankle</td>

		<td style="border:1px solid black;"  width="25%">' . @$measurements['mt1_l_ankle'] . '</td>
	</tr>
	<br>
	<tr>
		<td width="50%" style=""></td>

		<td style=""  width="25%"></td>
	</tr>
	
<br>

<tr>
		<td width="5%" style=""></td>

		<td style="border:1px solid black; height:190px;"  width="60%">
		Design
		<br>
		&nbsp; ' . @$measurements['mt1_remarks'] . '
		</td>
	</tr>
	
<br>


	
	<tr><td width="100%" style=""></td></tr>

	</table>
	</td>
	<td width="40%">
		<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px; height:500px;" width="100%">
		<tr>
		<td width="5%" style="height:603px;"></td>

		<td style=""  width="60%">
		</td>
	</tr>
		</table>
	</td>
	</tr>
	</table>
	<div style="height: 50px;"></div>
	<table width="100%">
	</table>
	</div>';
		} elseif ($this->session->userdata('BoutiqueID') == 25) {

			$logoimagepath = 'N Dot Couture';


			$addressBoutique = '1st Cross Rd, Kuvempunagara North, Saraswathipuram, Mysuru, Karnataka 570009<br>
            Ph : 948293829  | Email - ndoutcouture@gmail.com';


			$html = '<div style="text-align: center;">
			<h1>' . $logoimagepath . '</h1>
			<h4>' . $addressBoutique . '</h4>
			<div>Measurement Form</div>
			<table width="100%">
		<tr>
			<td>Name:' . @$customer['boutique_customer_name'] . '</td>
			<td>Mob:' . @$customer['boutique_customer_ph'] . '</td>
		</tr>
	</table>
	<div style="height: 100px;"></div>

	
	<table>
	<tr>
	<td width="100%">
	<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px;">
	<tr><td colspan="2" width="20%" style="border:1px solid black;"></td>
	<td colspan="2" width="12%" style="border:1px solid black; text-align:center;">Blouse</td>
	<td colspan="2" width="12%" style="border:1px solid black; text-align:center;">Dress</td>
	<td colspan="2" width="12%" style="border:1px solid black; text-align:center;">Gown</td>
	<td colspan="2" width="12%" style="border:1px solid black; text-align:center;">Lahenga<br>1.Blouse</td>
	<td colspan="2" width="15%" style="border:1px solid black; text-align:center;"></td>
	<td colspan="2" width="12%" style="border:1px solid black; text-align:center;">Pencil fit Pant</td>
	<td colspan="2" width="12%" style="border:1px solid black; text-align:center;">Normal pant</td>
	</tr>

	<tr><td rowspan="1" width="20%" style="border:1px solid black;">Shoulder</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_blouse_shoulder'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_dress_shoulder'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_gown_shoulder'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_lehenga_shoulder'] . '</td>
		<td style="border:1px solid black;"  width="15%">Length</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_pencilpant_length'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_normalpant_length'] . '</td>
	</tr>

	<tr><td rowspan="1" width="20%" style="border:1px solid black;">Length/Full Length</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_blouse_length'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_dress_length'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_gown_length'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_lehenga_length'] . '</td>
		<td style="border:1px solid black;"  width="15%">Waist round</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_pencilpant_waistround'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_normalpant_waistround'] . '</td>
	</tr>

	<tr><td rowspan="1" width="20%" style="border:1px solid black;">Chest</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_blouse_chest'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_dress_chest'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_gown_chest'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_lehenga_chest'] . '</td>
		<td style="border:1px solid black;"  width="15%">Ankle round</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_pencilpant_ankleround'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_normalpant_ankleround'] . '</td>
	</tr>

	<tr><td rowspan="1" width="20%" style="border:1px solid black;">Waist Round</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_blouse_waistround'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_dress_waistround'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_gown_waistround'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_lehenga_waistround'] . '</td>
		<td style="border:1px solid black;"  width="15%">Knee round</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_pencilpant_kneeround'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_normalpant_kneeround'] . '</td>
	</tr>

	<tr><td rowspan="1" width="20%" style="border:1px solid black;">Dot Point</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_blouse_dotpoint'] . '</td>
		<td style="border:1px solid black;"  width="12%"></td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_gown_dotpoint'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_lehenga_dotpoint'] . '</td>
		<td style="border:1px solid black;"  width="15%">Thigh round</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_pencilpant_thighround'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_normalpant_thighround'] . '</td>
	</tr>
	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">Hip round</td>
		<td style="border:1px solid black;"  width="12%"> -- </td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_dress_hip'] . '</td>
		<td style="border:1px solid black;"  width="12%"> -- </td>
		<td style="border:1px solid black;"  width="12%"> -- </td>
		<td style="border:1px solid black;"  width="39%" colspan="3" rowspan="11"> Remarks :- <br>
		&nbsp;&nbsp;' . @$measurements['mt1_remarks'] . '</td>
	</tr>
	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">Slit</td>
		<td style="border:1px solid black;"  width="12%"> -- </td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_dress_slit'] . '</td>
		<td style="border:1px solid black;"  width="12%"> -- </td>
		<td style="border:1px solid black;"  width="12%"> -- </td>
	</tr>
	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">Yolk</td>
		<td style="border:1px solid black;"  width="12%"> -- </td>
		<td style="border:1px solid black;"  width="12%"> -- </td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_gown_yolk'] . '</td>
		<td style="border:1px solid black;"  width="12%"> -- </td>
	</tr>
	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">Arm hole</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_blouse_armhole'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_dress_armhole'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_gown_armhole'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_lehenga_armhole'] . '</td>
	</tr>
	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">Sleeve length</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_blouse_sleevelength'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_dress_sleevelength'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_gown_sleevelength'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_lehenga_sleevelength'] . '</td>
	</tr>
	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">Sleeve round</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_blouse_sleeveround'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_dress_sleeveround'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_gown_sleeveround'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_lehenga_sleeveround'] . '</td>
	</tr>
	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">Front deep</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_blouse_frontdeep'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_dress_frontdeep'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_gown_frontdeep'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_lehenga_frontdeep'] . '</td>
	</tr>
	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">Back deep</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_blouse_backdeep'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_dress_backdeep'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_gown_backdeep'] . '</td>
		<td style="border:1px solid black;"  width="12%">' . @$measurements['mt1_lehenga_backdeep'] . '</td>
	</tr>

	<tr>
		<td rowspan="1" width="20%"></td>
		<td width="12%"></td>
		<td width="12%"></td>
		<td width="12%"></td>
		<td width="12%">2.Skirt</td>
	</tr>
	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">Length</td>
		<td style="border-top:1px solid black;"  width="12%"></td>
		<td style="border-top:1px solid black;"  width="12%"></td>
		<td style="border-top:1px solid black;"  width="12%"></td>
		<td style="border-top:1px solid black;"  width="12%">' . @$measurements['mt1_skrit_lehenga_length'] . '</td>
	</tr>
	<tr>
		<td rowspan="1" width="20%" style="border:1px solid black;">Waist round</td>
		<td style="border-top:1px solid black;"  width="12%"></td>
		<td style="border-top:1px solid black;"  width="12%"></td>
		<td style="border-top:1px solid black;"  width="12%"></td>
		<td style="border-top:1px solid black;"  width="12%">' . @$measurements['mt1_skrit_lehenga_waistround'] . '</td>
	</tr>
	

	</table></td>
	</tr>
	</table>
	<div style="height: 50px;"></div>
	<table width="100%">
	</table>
	</div>';
		} elseif ($this->session->userdata('BoutiqueID') == 8 || $this->session->userdata('BoutiqueID') == 9 || $this->session->userdata('BoutiqueID') == 10) {

			$logoimagepath = '<img height="70" width="210" src="https://boutiquesmanager.com/uploads/logo/beboo-logo.png">';

			if ($this->session->userdata('BoutiqueID') == 9) {
				$addressBoutique = 'Door No.26/410, Palace Road, Central Building (Kalliyath Building), Thrissur<br>
            Ph : 82814 34180  | Email - rose@bebooandme.com';
			} elseif ($this->session->userdata('BoutiqueID') == 8) {
				$addressBoutique = 'Avenue Road, Mundupalam Junction,Thrissur<br>
            Ph : 62389 89824  | Email - rose@bebooandme.com';
			} elseif ($this->session->userdata('BoutiqueID') == 10) {
				$addressBoutique = 'Parakkot Lane, Pattraickal,Thrissur 233020<br>
            Ph : 91881 80458  | Email - rose@bebooandme.com';
			}


			$html = '<div style="text-align: center;">
			<h1>' . $logoimagepath . '</h1>
			<h4>' . $addressBoutique . '</h4>
			<div>Measurement Form</div>
			<table width="100%">
		<tr>
			<td>Name:' . @$customer['boutique_customer_name'] . '</td>
			<td>Mob:' . @$customer['boutique_customer_ph'] . '</td>
		</tr>
	</table>
	<div style="height: 100px;"></div>

	<table width="98%" style="border:1px solid #000000;">
		<br><br>
		<tr>
			<td width="10%" style="padding: 10px; width: 30px; height: 30px;">
			Kurta
			</td>
			<td width="4%" style="border:1px solid #000000; width: 10px; height: 30px;"></td>

			<td width="10%" style="padding: 10px; width: 30px; height: 30px;">
			Frock
			</td>
			<td width="4%" style="border:1px solid #000000; width: 10px; height: 30px;"></td>

			<td width="10%" style="padding: 10px; width: 30px; height: 30px;">
			Top
			</td>
			<td width="4%" style="border:1px solid #000000; width: 10px; height: 30px;"></td>

			<td width="10%" style="padding: 10px; width: 30px; height: 30px;">
			Blouse
			</td>
			<td width="4%" style="border:1px solid #000000; width: 10px; height: 30px;"></td>

			<td width="8%" style="padding: 10px; width: 30px; height: 30px;">
			Skirt
			</td>
			<td width="4%" style="border:1px solid #000000; width: 10px; height: 30px;"></td>

			<td width="8%" style="padding: 10px; width: 30px; height: 30px;">
			Cape
			</td>
			<td width="4%" style="border:1px solid #000000; width: 10px; height: 30px;"></td>

			<td width="10%" style="padding: 10px; width: 30px; height: 30px;">
			Overcoat
			</td>
			<td width="4%" style="border:1px solid #000000; width: 10px; height: 30px;"></td>

			<td width="8%" style="padding: 10px; width: 30px; height: 30px;">
			Saree
			</td>
			<td width="4%" style="border:1px solid #000000; width: 10px; height: 30px;"></td>
			<td width="2%"></td>
		</tr>
<br>
		<tr>
			<td width="10%" style="padding: 10px; width: 30px; height: 30px;">
			Churi
			</td>
			<td width="4%" style="border:1px solid #000000; width: 10px; height: 30px;"></td>

			<td width="10%" style="padding: 10px; width: 30px; height: 30px;">
			Salwar
			</td>
			<td width="4%" style="border:1px solid #000000; width: 10px; height: 30px;"></td>

			<td width="10%" style="padding: 10px; width: 30px; height: 30px;">
			Pattiyala
			</td>
			<td width="4%" style="border:1px solid #000000; width: 10px; height: 30px;"></td>

			<td width="10%" style="padding: 10px; width: 30px; height: 30px;">
			Gown
			</td>
			<td width="4%" style="border:1px solid #000000; width: 10px; height: 30px;"></td>

			<td width="14%" style="padding: 10px; width: 30px; height: 30px;">
			Straight Pant
			</td>
			<td width="4%" style="border:1px solid #000000; width: 10px; height: 30px;"></td>

			<td width="14%" style="padding: 10px; width: 30px; height: 30px;">
			Narrow Pant
			</td>
			<td width="4%" style="border:1px solid #000000; width: 10px; height: 30px;"></td>

			<td width="10%" style="padding: 10px; width: 30px; height: 30px;">
			Palazo
			</td>
			<td width="4%" style="border:1px solid #000000; width: 10px; height: 30px;"></td>

			<td></td>
			<td></td>
			<td width="2%"></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td><td></td><td></td><td></td><td></td><td></td><td width="2%"></td>
		</tr>
	</table>
	<table>
	<tr>
	<td width="33%">
	<table style="border:1px solid black; text-align:left; padding:5px 0px 0px 5px;">
	<tr><td rowspan="2" width="50%" style="border:1px solid black;">Front Neck</td><td style="border:1px solid black;" width="25%">Length</td><td style="border:1px solid black;"  width="25%">' . @$measurements['mt2_frontneck_length'] . '</td></tr>
	<tr><td style="border:1px solid black;">Width</td><td style="border:1px solid black;">' . @$measurements['mt2_frontneck_width'] . '</td></tr>

	<tr><td rowspan="2" style="border:1px solid black;">Back Neck</td><td style="border:1px solid black;">Length</td><td style="border:1px solid black;">' . @$measurements['mt2_backneck_length'] . '</td></tr>
	<tr><td style="border:1px solid black;">Width</td><td style="border:1px solid black;">' . @$measurements['mt2_backneck_width'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Chest</td><td style="border:1px solid black;" width="25%">' . @$measurements['mt2_chest_1'] . '</td><td style="border:1px solid black;" width="25%">' . @$measurements['mt2_chest_2'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;">Breast Point</td><td width="25%" style="border:1px solid black;">' . @$measurements['mt2_breast_point_1'] . '</td><td width="25%" style="border:1px solid black;">' . @$measurements['mt2_breast_point_2'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;">Breast Distance</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['mt2_breast_distance_1'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;">Waist</td><td width="25%" style="border:1px solid black;">' . @$measurements['mt2_waist_1'] . '</td><td width="25%" style="border:1px solid black;">' . @$measurements['mt2_waist_2'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;">Yoke</td><td width="25%" style="border:1px solid black;">' . @$measurements['mt2_yoke_1'] . '</td><td width="25%" style="border:1px solid black;">' . @$measurements['mt2_yoke_2'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;">HIP</td><td width="25%" style="border:1px solid black;">' . @$measurements['mt2_hip_1'] . '</td><td width="25%" style="border:1px solid black;">' . @$measurements['mt2_hip_2'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;">Slit</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['mt2_slit_1'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;">Sleeve Total</td><td width="25%" style="border:1px solid black;">' . @$measurements['mt2_sleevetotal_1'] . '</td><td width="25%" style="border:1px solid black;">' . @$measurements['mt2_sleevetotal_2'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;">Sleeve Middle</td><td width="25%" style="border:1px solid black;">' . @$measurements['mt2_sleevemiddle_1'] . '</td><td width="25%" style="border:1px solid black;">' . @$measurements['mt2_sleevemiddle_2'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;">Armhole</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['mt2_armhole_1'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Shoulder</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['mt2_shoulder_1'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Finished Shoulder</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['mt2_finished_shoulder_1'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;">Total Length</td><td colspan="2">' . @$measurements['mt2_totallength_1'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;"></td><td colspan="2" width="50%" style="border:1px solid black;"></td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Waist</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['mt2_waist_3'] . '</td></tr>


	<tr><td colspan="2" width="50%" style="border:1px solid black;">HIP</td><td width="25%" style="border:1px solid black;">' . @$measurements['mt2_hip_3'] . '</td><td width="25%" style="border:1px solid black;">' . @$measurements['mt2_hip_4'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;">Middle/Thighs</td><td width="25%" style="border:1px solid black;">' . @$measurements['mt2_middle_thighs_1'] . '</td><td width="25%" style="border:1px solid black;">' . @$measurements['mt2_middle_thighs_2'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;">¾th</td><td width="25%" style="border:1px solid black;">' . @$measurements['mt2_3th_1'] . '</td><td width="25%" style="border:1px solid black;">' . @$measurements['mt2_3th_2'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;">Leg Open</td><td colspan="2">' . @$measurements['mt2_legopen_1'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;">Total Length</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['mt2_totallength_2'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;"></td><td colspan="2" width="50%" style="border:1px solid black;"></td></tr>

	</table></td>
	<td><table width="100%">
	<tr><td style="border:1px solid black;" width="146%" height="433"></td></tr>
	<tr><td style="border:1px solid black; text-align:left;" width="146%" height="83"> Remarks <br>
	 ' . @$measurements['mt2_remarks'] . '
	</td></tr>
	</table></td>
	</tr>
	</table>
	<div style="height: 50px;"></div>
	<table width="100%">
	</table>
	</div>';
		} elseif ($this->session->userdata('BoutiqueID') == 5) {
			$html = '<div style="text-align: center;">
			<h1>Naira Designer Boutique</h1>
			<div>Measurement Form</div>
			<table width="100%">
		<tr>
			<td>Name:' . @$customer['boutique_customer_name'] . '</td>
			<td>Mob:' . @$customer['boutique_customer_ph'] . '</td>
		</tr>
	</table>
	<div style="height: 100px;"></div>

	<table width="100%">
		<tr>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				FL</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				SH</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				CH</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				B</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				W</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				STOM</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				HIP</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				UB</th>
		   <th></th>
		</tr>
		<tr>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_fl'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_sh'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_ch'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_b'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_w'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_stom'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_hip'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_ub'] . '
			</td>
			<td width="20%"></td>
		</tr>
	</table>
	<div style="height: 50px;"></div>
	<table width="100%">
		<tr>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				Sh-B</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				Sh-W</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				Sh-Stom</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				Sh-HIP</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				SLV L</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				SLV R</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				BICEPS</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				AH</th>
		   <th></th>
		</tr>
		<tr>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_sh_b'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_sh_w'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_sh_stom'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_sh_hip'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_slv_l'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_slv_r'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_biceps'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_ah'] . '
			</td>
			<td width="20%"></td>
		</tr>
	</table>
	<div style="height: 50px;"></div>
	<table width="100%">
		<tr>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				FN</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				BN</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				WIDE</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				Collar R</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				FW</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				BW</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				SLT L</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				SLT R</th>
		   <th></th>
		</tr>
		<tr>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_fn'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_bn'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_wide'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_collar_r'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_fw'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_bw'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_slt_l'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_slt_r'] . '
			</td>
			<td width="20%"></td>
		</tr>
	</table>
	<div style="height: 50px;"></div>
	<table width="100%">
		<tr>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				Yoke L</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				Yoke R</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				CW</th>
			<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				FLR</th>
		   <th></th>
		</tr>
		<tr>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
				' . @$measurements['mt2_yoke_l'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
				' . @$measurements['mt2_yoke_r'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
				' . @$measurements['mt2_cw'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
				' . @$measurements['mt2_flr'] . '
			</td>
			
			<td width="60%"></td>
		</tr>
	</table>
<div style="height: 50px;"></div>
	<table width="100%">
		<tr>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				Btm L</th>
				<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				Btm W</th>
				<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				Edge R</th>
				<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				W-Th L</th>
				<th width="2.5%"></th>
		   <th width="10%" style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				Thigh R</th>
		   <th></th>
		</tr>
		<tr>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_btm_l'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_btm_w'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_edge_r'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_w_th_l'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_thigh_r'] . '
			</td>
			
			<td width="50%"></td>
		</tr>
	</table>
<div style="height: 50px;"></div>
	<table width="100%">
		<tr>
		   <th><div style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				W-Knee L</div></th>
			<th width="2.5%"></th>
		   <th><div style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				Knee R</div></th>
		   <th width="2.5%"></th>
		   <th><div style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				W-Calf L</div></th>
		   <th width="2.5%"></th>
		   <th><div style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				Calf R</div></th>
		   <th width="2.5%"></th>
		   <th><div style="padding-bottom: 0px !important; width: 75px; height: 20px;">
				Crotch L</div></th>
		   <th></th>
		</tr>
		<tr>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 40px; height: 30px;">
			' . @$measurements['mt2_w_knee_l'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_knee_r'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_w_calf_l'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_calf_r'] . '
			</td>
			<td width="2.5%"></td>
			<td width="10%" style="border:1px solid #000000; padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_crotch_l'] . '
			</td>
			
			<td width="50%"></td>
		</tr>
	</table>

		</div>';
		} elseif ($this->session->userdata('BoutiqueID') == 6) {
			$html = '<div style="text-align: center;">
			<h1>Trends Boutique</h1>
			</div>
			<table width="100%" style="border-bottom:1px solid #000000;">
		<tr>
			<td>Name: ' . @$customer['boutique_customer_name'] . '</td>
			<td>Mob: ' . @$customer['boutique_customer_ph'] . '</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
		</tr>
	</table>
	<div style="height: 10px;"></div>


	<table width="100%">
		<tr>
			<td>
			<table width="100%">
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			L
			</td>
			<td width="50%" style=" padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_l'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			SH
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_sh'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			SL
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_sl'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			SR
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_sr'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			AH
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_ah'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			CH
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_ch'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			BR
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_br'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			W
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_w'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			SE
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_se'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			SL
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_s_l'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			FL
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_f_l'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			NF
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_n_f'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			NB
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_n_b'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			W
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_w_1'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			BOTTOM
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_bottom'] . '
			</td>
		</tr>
		
	</table></td>
			<td>
			<table>
			<tr>
			<td width="100%" height="30px" align="left" style="">
			Remarks
			</td>
			</tr>
			<tr>
			<td width="100%" style="border:1px solid #000000; padding: 10px; width: 50px; height: 200px;">
			<br><br>&nbsp;&nbsp;
			' . @$measurements['mt2_remarks'] . '
			</td>
			</tr>
			</table>
			</td>
		</tr>
	</table>
		</div>';
		} elseif ($this->session->userdata('BoutiqueID') == 7) {
			$html = '<div style="text-align: center;">
			<h1>Tailor Made Fashion Studio</h1>
			<h4>Ettumanoor - Mob: 9847016103</h4>
			</div>
			<table width="100%" style="border-bottom:1px solid #000000;">
		<tr>
			<td>Name: ' . @$customer['boutique_customer_name'] . '</td>
			<td>Mob: ' . @$customer['boutique_customer_ph'] . '</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
		</tr>
	</table>
	<div style="height: 10px;"></div>


	<table width="100%">
		<tr>
			<td>
			<table width="100%">
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			Full length
			</td>
			<td width="50%" style=" padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_full_length'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			Shoulder
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_shoulder'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			Upper Chest
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_upper_chest'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			Brust
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_brust'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			Shape (Stomach)
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_shape'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			Hip
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_hip'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			Slite Length
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_slite_length'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			Slite Round
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_slite_round'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			Flair
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_flair'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			Sleeve Length
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_sleeve_length'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			Sleeve Round
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_sleeve_round'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			Arm Hole
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_arm_hole'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			Front Neck Length
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_front_neck_length'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			Back Neck Length
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_back_neck_length'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			Shoulder Wide
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_shoulder_wide'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="center" style="">
			<br>
			Bottom
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			Full Length
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_b_full_length'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			Knee Round
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_b_knee_round'] . '
			</td>
		</tr>
		<tr>
			<td width="50%" height="30px" align="left" style="">
			<br>
			Bottom Round
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			' . @$measurements['mt2_b_round'] . '
			</td>
		</tr>
	</table></td>
			<td>
			<table>
			<tr>
			<td width="100%" height="30px" align="left" style="">
			Remarks
			</td>
			</tr>
			<tr>
			<td width="100%" style="border:1px solid #000000; padding: 10px; width: 50px; height: 200px;">
			<br><br>&nbsp;&nbsp;
			' . @$measurements['mt2_remarks'] . '
			</td>
			</tr>
			</table>
			</td>
		</tr>
	</table>
		</div>';
		} elseif ($this->session->userdata('BoutiqueID') == 12) {

			$logo =	'<img src="https://boutiquesmanager.com/assets/images/images.jpg" height="100" width="160" />';

			$html = '<div style="text-align: center; border-top:1px solid #000000; border-left:1px solid #000000; border-right:1px solid #000000;">
			' . $logo . '
		</div>
		<table width="100%" style="border-top:1px solid #000000; border-left:1px solid #000000; border-right:1px solid #000000; padding:5px;">
		<tr>
			<td colspan="3">Customer Name: ' . @$customer['boutique_customer_name'] . '</td>
		</tr>
		<tr>
			<td>Mob: ' . @$customer['boutique_customer_ph'] . '</td>
			<td colspan="2">Address: ' . @$customer['boutique_customer_address'] . '</td>
		</tr>
		</table>

	
	<table width="100%" style="border:1px solid #000000;">
	<tr>
			<td>
			<br>
			<br>
			<u>All Measurements Are In Inches</u>
			<br>
			</td>
		</tr>
		<tr>
			<td width="50%">
		<table width="100%" style="border:1px solid #000000; padding:5px;">
		<tr>
			<td width="50%" height="30px" align="left" >
			<br>
			TOP : -
			</td>
			<td width="50%" style=" padding: 10px; width: 30px; height: 30px;">
			
			</td>
		</tr>
		<tr>
			<td width="10%">1.</td>
			<td width="50%" height="30px" align="left" style="">
			<br>
			TOP LENGTH (L)
			</td>
			<td width="30%" style="width: 30px; height: 30px; border-bottom:1px dotted black; padding-right:10px;">
			' . @$measurements['mt2_top_length'] . '
			</td>
		</tr>
		<tr>
			<td width="10%">2.</td>
			<td width="50%" height="30px" align="left" style="">
			<br>
			UPPER CHEST (UC)
			</td>
			<td width="30%" style="width: 30px; height: 30px; border-bottom:1px dotted black; padding-right:10px;">
			' . @$measurements['mt2_upper_chest'] . '
			</td>
		</tr>
		<tr>
		    <td width="10%">3.</td>
			<td width="50%" height="30px" align="left" style="">
			<br>
			CHEST (C)
			</td>
			<td width="30%" style="width: 30px; height: 30px; border-bottom:1px dotted black; padding-right:10px;">
			' . @$measurements['mt2_chest'] . '
			</td>
		</tr>
		<tr>
		    <td width="10%">4.</td>
			<td width="50%" height="30px" align="left" style="">
			<br>
			SHAPE (S)
			</td>
			<td width="30%" style="width: 30px; height: 30px; border-bottom:1px dotted black; padding-right:10px;">
			' . @$measurements['mt2_shape'] . '
			</td>
		</tr>
		<tr>
		    <td width="10%">5.</td>
			<td width="50%" height="30px" align="left" style="">
			<br>
			HIP (H)
			</td>
			<td width="30%" style="width: 30px; height: 30px; border-bottom:1px dotted black; padding-right:10px;">
			' . @$measurements['mt2_hip'] . '
			</td>
		</tr>
		<tr>
		    <td width="10%">6.</td>
			<td width="50%" height="30px" align="left" style="">
			<br>
			SHOULDER (SHL)
			</td>
			<td width="30%" style="width: 30px; height: 30px; border-bottom:1px dotted black; padding-right:10px;">
			' . @$measurements['mt2_shoulder'] . '
			</td>
		</tr>
		<tr>
		    <td width="10%">7.</td>
			<td width="50%" height="30px" align="left" style="">
			<br>
			SLEEVE (SL)
			</td>
			<td width="30%" style="width: 30px; height: 30px; border-bottom:1px dotted black; padding-right:10px;">
			' . @$measurements['mt2_sleeve'] . '
			</td>
		</tr>
		<tr>
		    <td width="10%">.</td>
			<td width="50%" height="30px" align="left" style="">
			<br>
			ARM HOLE (AH)
			</td>
			<td width="30%" style="width: 30px; height: 30px; border-bottom:1px dotted black; padding-right:10px;">
			' . @$measurements['mt2_arm_hole'] . '
			</td>
		</tr>
		<tr>
		    <td width="10%">.</td>
			<td width="50%" height="30px" align="left" style="">
			<br>
			BICEPS (B)
			</td>
			<td width="30%" style="width: 30px; height: 30px; border-bottom:1px dotted black; padding-right:10px;">
			' . @$measurements['mt2_biceps'] . '
			</td>
		</tr>
		<tr>
		    <td width="10%">.</td>
			<td width="50%" height="30px" align="left" style="">
			<br>
			ELBOW (E)
			</td>
			<td width="30%" style="width: 30px; height: 30px; border-bottom:1px dotted black; padding-right:10px;">
			' . @$measurements['mt2_elbow'] . '
			</td>
		</tr>
		<tr>
		    <td width="10%">.</td>
			<td width="50%" height="30px" align="left" style="">
			<br>
			WRIST (W)
			</td>
			<td width="30%" style="width: 30px; height: 30px; border-bottom:1px dotted black; padding-right:10px;">
			' . @$measurements['mt2_wrist'] . '
			</td>
		</tr>
		<tr>
		    <td width="10%">8.</td>
			<td width="50%" height="30px" align="left" style="">
			<br>
			FRONT NECK (FN)
			</td>
			<td width="30%" style="width: 30px; height: 30px; border-bottom:1px dotted black; padding-right:10px;">
			' . @$measurements['mt2_front_neck'] . '
			</td>
		</tr>
		<tr>
		    <td width="10%">9.</td>
			<td width="50%" height="30px" align="left" style="">
			<br>
			BACK NECK (BN)
			</td>
			<td width="30%" style="width: 30px; height: 30px; border-bottom:1px dotted black; padding-right:10px;">
			' . @$measurements['mt2_back_neck'] . '
			</td>
		</tr>
		<tr>
		    <td width="10%">10.</td>
			<td width="50%" height="30px" align="left" style="">
			<br>
			COLLAR (COL)
			</td>
			<td width="30%" style="width: 30px; height: 30px; border-bottom:1px dotted black; padding-right:10px;">
			' . @$measurements['mt2_collar'] . '
			</td>
		</tr>
		<tr>
		    <td width="10%">8.</td>
			<td width="50%" height="30px" align="left" style="">
			<br>
			APEX (BLOUSE)
			</td>
			<td width="30%" style="width: 30px; height: 30px; border-bottom:1px dotted black; padding-right:10px;">
			' . @$measurements['mt2_blouse'] . '
			</td>
		</tr>
	</table>
	</td>
	<td width="50%">
	<table width="100%" style="border:1px solid #000000; padding:5px;">
						<tr>
			<td width="50%" height="30px" align="center" style="">
			<br>
			<u>BOTTOM</u>
			</td>
			<td width="50%" style="padding: 10px; width: 30px; height: 30px;">
			</td>
		</tr>
		<tr>
			<td width="10%">1.</td>
			<td width="50%" height="30px" align="left" style="">
			<br>
			LENGTH
			</td>
			<td width="30%" style="width: 30px; height: 30px; border-bottom:1px dotted black; padding-right:10px;">
			' . @$measurements['mt2_b_length'] . '
			</td>
		</tr>
		<tr>
			<td width="10%">2.</td>
			<td width="50%" height="30px" align="left" style="">
			<br>
			HIPS
			</td>
			<td width="30%" style="width: 30px; height: 30px; border-bottom:1px dotted black; padding-right:10px;">
			' . @$measurements['mt2_b_hips'] . '
			</td>
		</tr>
		<tr>
		    <td width="10%">3.</td>
			<td width="50%" height="30px" align="left" style="">
			<br>
			THINGS
			</td>
			<td width="30%" style="width: 30px; height: 30px; border-bottom:1px dotted black; padding-right:10px;">
			' . @$measurements['mt2_b_thighs'] . '
			</td>
		</tr>
		<tr>
		    <td width="10%">4.</td>
			<td width="50%" height="30px" align="left" style="">
			<br>
			KNEES
			</td>
			<td width="30%" style="width: 30px; height: 30px; border-bottom:1px dotted black; padding-right:10px;">
			' . @$measurements['mt2_b_knees'] . '
			</td>
		</tr>
		<tr>
		    <td width="10%">5.</td>
			<td width="50%" height="30px" align="left" style="">
			<br>
			CALF
			</td>
			<td width="30%" style="width: 30px; height: 30px; border-bottom:1px dotted black; padding-right:10px;">
			' . @$measurements['mt2_b_calf'] . '
			</td>
		</tr>
		<tr>
		    <td width="10%">6.</td>
			<td width="50%" height="30px" align="left" style="">
			<br>
			ANKLE
			</td>
			<td width="30%" style="width: 30px; height: 30px; border-bottom:1px dotted black; padding-right:10px;">
			' . @$measurements['mt2_b_ankle'] . '
			</td>
		</tr>
	</table>
	</td>
		</tr>
		<tr>
		<td></td>
		<td></td>
		</tr>
	</table>

		</div>';
		} else {
			// Set some content to print
			$html = '<div style="text-align: center;">
			<h1>TAAZA DESIGNS</h1>
		</div>

		<table width="100%">
			<tr>
				<td width="10%">NAME:</td>
				<td  width="40%" style="border-bottom: 1px solid #000000;">
				' . @$customer['boutique_customer_name'] . '
				</td>
				<td width="10%"> MOB </td>
				<td  width="40%" style="border-bottom: 1px solid #000000;">
				' . @$customer['boutique_customer_ph'] . '
				</td>
			</tr>
		</table>
		<table width="100%" cellpadding="2" cellspacing="5">
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td style="width: 100px">LENGTH</td>
				<td style="width: 10px">:</td>
				<td style="border:1px solid #000000; padding: 10px; width: 150px; height: 20px;">
				' . @$measurements['mt2_length'] . '
				</td>
				<td></td>
			</tr>
			<tr>
				<td>SHOULDER</td>
				<td>:</td>
				<td style="border:1px solid #000000; padding: 10px; width: 150px; height: 20px;">
				' . @$measurements['mt2_shoulder'] . '
				</td>
				<td></td>
			</tr>
			<tr>
				<td>ARM HOLE</td>
				<td>:</td>
				<td style="border:1px solid #000000; padding: 10px; width: 150px; height: 20px;">
				' . @$measurements['mt2_armhole'] . '
				</td>
				<td></td>
			</tr>
			<tr>
				<td>CHEST</td>
				<td>:</td>
				<td style="border:1px solid #000000; padding: 10px; width: 150px; height: 20px;">
				' . @$measurements['mt2_chest1'] . '
				</td>
				<td style="border:1px solid #000000; padding: 10px; width: 150px; height: 20px;">
				' . @$measurements['mt2_chest2'] . '
				</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>POINT</td>
				<td>:</td>
				<td style="border:1px solid #000000; padding: 10px; width: 150px; height: 20px;">
				' . @$measurements['mt2_point1'] . '
				</td>
				<td style="border:1px solid #000000; padding: 10px; width: 150px; height: 20px;">
				' . @$measurements['mt2_point2'] . '
				</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>WAIST</td>
				<td>:</td>
				<td style="border:1px solid #000000; padding: 10px; width: 150px; height: 20px;">
				' . @$measurements['mt2_waist1'] . '
				</td>
				<td style="border:1px solid #000000; padding: 10px; width: 150px; height: 20px;">
				' . @$measurements['mt2_waist2'] . '
				</td>
				<td>&nbsp;</td>
			</tr>
		</table>
		<table width="100%" cellpadding="1" cellspacing="5">
			<tr>
				<td style="width: 100px">NECK</td>
				<td style="width: 10px">:</td>
				<td style="width: 10px">F</td>
				<td style="border:1px solid #000000; padding: 10px; width: 105px; height: 20px;">
				' . @$measurements['mt2_neck1'] . '</td>
				<td style="width: 10px">&nbsp;</td>
				<td style="width: 18px">B</td>
				<td style="border:1px solid #000000; padding: 10px; width: 105px; height: 10px;">
				' . @$measurements['mt2_neck2'] . '
				</td>
				<td style="width: 150px"> &nbsp; SHOULDER WIDTH </td>
				<td style="border:1px solid #000000; padding: 5px; width: 105px; height: 10px;">
				' . @$measurements['mt2_shoulder_width'] . '
				</td>
				<td>&nbsp;</td>
			</tr>
		</table>
		<table width="100%" cellpadding="2" cellspacing="5">
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td style="width: 100px">SLEEVE</td>
				<td style="width: 10px">:</td>
				<td style="border:1px solid #000000; padding: 10px; width: 100px; height: 20px;">
				' . @$measurements['mt2_sleeve1'] . '</td>
				<td style="border:1px solid #000000; padding: 10px; width: 100px; height: 20px;">
				' . @$measurements['mt2_sleeve2'] . '</td>
				<td style="border:1px solid #000000; padding: 10px; width: 100px; height: 20px;">
				' . @$measurements['mt2_sleeve3'] . '</td>
				<td style="border:1px solid #000000; padding: 10px; width: 100px; height: 20px;">
				' . @$measurements['mt2_sleeve4'] . '</td>
				<td></td>
			</tr>
		</table>

		<table width="100%" cellpadding="2" cellspacing="5">
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td style="width: 100px">UBL</td>
				<td style="width: 10px">:</td>
				<td style="border:1px solid #000000; padding: 10px; width: 150px; height: 20px;">
				' . @$measurements['mt2_ubl'] . '</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
		</table>
		<div >
			
		</div>';
		}
		/*
$html .= '<style>'.file_get_contents('https://boutiquesmanager.com/assets/bower_components/bootstrap/dist/css/bootstrap.min.css').'</style>';

$html .= '<style>'.file_get_contents('https://boutiquesmanager.com/assets/dist/css/AdminLTE.min.css').'</style>';
*/


		// Print text using writeHTMLCell()
		$pdf->writeHTML($html, true, false, true, false, '');

		// ---------------------------------------------------------

		// Close and output PDF document
		// This method has several options, check the source code documentation for more information.
		$pdf->Output(time() . '.pdf', 'I');

		//============================================================+
		// END OF FILE
		//============================================================+

	}


	public function orderbill()
	{

		$id = $this->uri->segment(3);
		$measurements = $this->getAllmeasurements($id);
		$customer = $this->Customer_model->m_getcustomer($id);

		$wid = $this->uri->segment(4);

		$work = $this->Work_model->m_getorderdetails($wid);
		$orders = $this->Work_model->m_getallworks($wid);

		if ($this->session->userdata('BoutiqueID') == 33) {
			$workid = @$orders[0]['boutique_work_id'];
			$worktailor = $this->Work_model->m_getworkstaffwithtype(1, $workid);
			$workcuttingmaster = $this->Work_model->m_getworkstaffwithtype(2, $workid);
			$workembroidery = $this->Work_model->m_getworkstaffwithtype(3, $workid);
			$workattended = $this->Work_model->m_getworkstaffwithtype(4, $workid);
			$workmeasurement = $this->getAllworkmeasurements($workid);
		}

		$workimage = @$orders[0]['boutique_work_image'];
		$workimagepath = '<img src="https://boutiquesmanager.com/uploads/work/' . $workimage . '" height="140" width="240">';

		$workimage1 = @$orders[1]['boutique_work_image'];
		$workimagepath1 = '<img src="https://boutiquesmanager.com/uploads/work/' . $workimage1 . '" height="140" width="240">';

		ini_set('max_execution_time', 0); // for infinite time of execution

		$this->load->library('Pdf');

		if ($this->session->userdata('BoutiqueID') != 0) {

			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		} else {
			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, false, 'ISO-8859-1', false);
		}

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Boutique Manager');
		$pdf->SetTitle('Order Form');
		$pdf->SetSubject('Order Form - customer');
		$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

		// set default header data
		//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 061', PDF_HEADER_STRING);

		// set header and footer fonts
		$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT - 10, PDF_MARGIN_TOP - 30, PDF_MARGIN_RIGHT);
		//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
			require_once(dirname(__FILE__) . '/lang/eng.php');
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
		//$logoimgurl = 
		$logoimagepath = '<img height="100" width="160" src="'.base_url().'uploads/logo/' . $this->session->userdata('BoutiqueLogo') . '">';

		//echo $logoimagepath;
		//exit();

		if (!$this->session->userdata('BoutiqueLogo')) {
			$logoimagepath = $this->session->userdata('BoutiqueName');
		}

		$addressBoutique = $this->session->userdata('BoutiqueAddr') . '<br>
            Ph : ' . $this->session->userdata('BoutiquePh') . '  | Email - ' . $this->session->userdata('BoutiqueEmail');

		if (@$work['boutique_order_form_number']) {
			$order_number = @$work['boutique_order_form_number'];
		} else {
			$order_number = @$work['boutique_order_number'];
		}
		if ($this->session->userdata('BoutiqueID') == 53) {
			$field_name = "Weight ";
		} else {
			$field_name = "Ghera";
		}
		$html = '<div style="text-align: center;">
			<h1>' . $logoimagepath . '</h1>
			<h4>' . $addressBoutique . '</h4>
			<div>Measurement Form<br><br></div>
			<table width="100%">
		<tr>
			<td width="15%">Order No : ' . @$order_number . '</td>
			<td width="15%">Name:' . @$customer['boutique_customer_name'] . '</td>
			<td>Mob:' . @$customer['boutique_customer_ph'] . '</td>
			<td>Order Date :' . @$work['boutique_order_date'] . '</td>
			<td width="30%">Delivery Date :' . @$work['boutique_order_delivery_date'] . '</td>
		</tr>

	</table>
	<div style="height: 1px;"></div>

	
	<div style="height: 1px;"></div>

	
	<table>
	<tr>
	<td width="35%">
	<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px;">
	<tr><td colspan="2" width="100%" style="border:1px solid black; text-align:center;">Coat</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Length</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['c_length'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Shoulder</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['c_sholder'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Sleeve Length</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['c_s_length'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;">Chest</td><td colspan="2">' . @$measurements['c_chest'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Waist</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['c_waist'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Hip</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['c_hip'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;">Neck</td><td colspan="2">' . @$measurements['c_cb'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;"> C B</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['c_cb'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Back Length</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['c_b_length'] . '</td></tr>
	</table>
	<table><tr><td></td></tr></table>
	<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px;">
	<tr><td colspan="2" width="100%" style="border:1px solid black; text-align:center;">Shirt</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Length</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['shirt_length'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Shoulder</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['shirt_sholder'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Sleeve Length</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['shirt_s_length'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;">Chest</td><td colspan="2">' . @$measurements['shirt_chest'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Waist</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['shirt_waist'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Hip</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['shirt_hip'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;">Neck</td><td colspan="2">' . @$measurements['shirt_neck'] . '</td></tr>
	</table>
	<table><tr><td></td></tr></table>
	</td>

<td width="1%">
	</td>

	<td width="35%">
	<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px;">

	<tr><td colspan="2" width="100%" style="border:1px solid black; text-align:center;">Pant</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Length</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['pant_length'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Waist</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['pant_waist'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Hip</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['pant_hip'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;"> Knee</td><td colspan="2">' . @$measurements['pant_knee'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Thigh</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['pant_thigh'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Bottom</td><td colspan="2">' . @$measurements['pant_bottom'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;"> Fork</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['pant_fork'] . '</td></tr>
	</table>
	<table><tr><td></td></tr></table>
	<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px;">
	<tr><td colspan="2" width="100%" style="border:1px solid black; text-align:center;">Half Coat</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Length</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['half_coat_l'] . '</td></tr>
	</table>
	<table><tr><td></td></tr></table>
	<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px;">
	<tr><td colspan="2" width="100%" style="border:1px solid black; text-align:center;">Bundi</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Length</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['bundi_l'] . '</td></tr>
	</table>
	<table><tr><td></td></tr></table>
	<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px;">
	<tr><td colspan="2" width="100%" style="border:1px solid black; text-align:center;">Sherwani</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Length</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['sherwani_l'] . '</td></tr>
	</table>
	<table><tr><td></td></tr></table>
	<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px;">
	<tr><td colspan="2" width="100%" style="border:1px solid black; text-align:center;">Indo Western</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Length</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['indo_western_l'] . '</td></tr>
	</table>
	</td>

	<td width="1%">
	</td>
	<td width="35%">
	<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px; height:520px;">
	<tr><td colspan="2" width="100%" style="border:1px solid black;text-align:center;">Breeches</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Length</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['breeches_l'] . '</td></tr>
	</table>
	<table><tr><td></td></tr></table>
	<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px; height:520px;">
	<tr><td colspan="2" width="100%" style="border:1px solid black;text-align:center;">Kurtha</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Length</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['kurtha_l'] . '</td></tr>
	</table>
	<table><tr><td></td></tr></table>
	<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px; height:520px;">
	<tr><td colspan="2" width="100%" style="border:1px solid black;text-align:center;">Dothi</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Length</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['dothi_l'] . '</td></tr>
	</table>
	<table><tr><td></td></tr></table>
	<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px; height:520px;">
	<tr><td colspan="2" width="100%" style="border:1px solid black;text-align:center;">Sharara Bottom</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Length</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['sb_l'] . '</td></tr>
	</table>
	</td>
	</tr>
	</table>

	<div style="height: 50px;"></div>

	<table width="100%">
	<tr>
	<td style="border:1px solid black; text-align:left;" width="107%" height="100"> Remarks :- <br>
		&nbsp;&nbsp;' . @$orders[0]['boutique_work_material_desc'] . '<br>&nbsp;&nbsp;' . @$orders[1]['boutique_work_material_desc'] . '</td>
	</tr>
	</table>
	
	<div style="height: 50px;"></div>
	<table width="100%">
	</table>
	</div>';
		$html2 = '<div style="text-align: center;">
			<h1>' . $logoimagepath . '</h1>
			<h4>' . $addressBoutique . '</h4>
			<div>Measurement Form<br></div>
			<table width="100%">
		<tr>
			<td width="15%">Order No : ' . @$order_number . '</td>
			<td width="15%">Name:' . @$customer['boutique_customer_name'] . '</td>
			<td>Mob:' . @$customer['boutique_customer_ph'] . '</td>
			<td>Order Date :' . @$work['boutique_order_date'] . '</td>
			<td width="30%">Delivery Date :' . @$work['boutique_order_delivery_date'] . '</td>
		</tr>

	</table>
	<div style="height:1px;"></div>
	<div style="height:1px;">GENTS</div>
	<table width="105%" height="500px" style="border:1px solid black;">
	<tr>
	<td  colspan="6" style="border:1px solid black;">
	[SHIRT/KURTHA]-STYLE
	</td>
	</tr>
	<tr>
	<td   style="border:1px solid black; text-align:center;">Length<br>' . @$measurements['zm_sk_length'] . '</td>
	<td   style="border:1px solid black; text-align:center;">Chest<br>' . @$measurements['zm_sk_chest'] . '</td>
	<td   style="border:1px solid black; text-align:center;">Stomach<br>' . @$measurements['zm_sk_stomach'] . '</td>
	<td   style="border:1px solid black; text-align:center;">Hip<br>' . @$measurements['zm_sk_hip'] . '</td>
	<td   style="border:1px solid black; text-align:center;">Shoulder<br>' . @$measurements['zm_sk_shoulder'] . '</td>
	<td   style="border:1px solid black; text-align:center;">Sleeves<br>' . @$measurements['zm_sk_sleeves'] . '</td>
	</tr>
	<tr>
	<td   style="border:1px solid black; text-align:center;">Neck<br>' . @$measurements['zm_sk_neck'] . '</td>
	<td   style="border:1px solid black; text-align:center;">Collar<br>' . @$measurements['zm_sk_collar'] . '</td>
	<td   style="border:1px solid black; text-align:center;">Half chest<br>' . @$measurements['zm_sk_half_chest'] . '</td>
	<td   style="border:1px solid black; text-align:center;"> Half back<br>' . @$measurements['zm_sk_half_back'] . '</td>
	<td   style="border:1px solid black; text-align:center;">Full kurtha length<br>' . @$measurements['zm_sk_full_kurtha_length'] . '</td>
	<td   style="border:1px solid black; text-align:center;"> Biceps<br>' . @$measurements['zm_sk_biceps'] . '</td>
	</tr>
	</table>
	<div style="height: 1px;"></div>
	<table width="105%" style="border:1px solid black;">
	<tr>
	<td  colspan="6" style="border:1px solid black;">
	[PANT]-STYLE
	</td>
	</tr>
	<tr>
	<td   style="border:1px solid black; text-align:center;">Length<br>' . @$measurements['zm_p_length'] . '</td>
	<td   style="border:1px solid black; text-align:center;">Waist<br>' . @$measurements['zm_p_waist'] . '</td>
	<td   style="border:1px solid black; text-align:center;">Hip<br>' . @$measurements['zm_p_hip'] . '</td>
	<td   style="border:1px solid black; text-align:center;">Thigh<br>' . @$measurements['zm_p_thigh'] . '</td>
	<td   style="border:1px solid black; text-align:center;">Bottom<br>' . @$measurements['zm_p_bottom'] . '</td>
	<td   style="border:1px solid black; text-align:center;"> Full fork<br>' . @$measurements['zm_p_full_fork'] . '</td>
	</tr>
	<tr>
	<td   style="border:1px solid black; text-align:center;">In-seam<br>' . @$measurements['zm_p_in_seam'] . '</td>
	<td   style="border:1px solid black; text-align:center;"> Knee<br>' . @$measurements['zm_p_knee'] . '</td>
	<td   style="border:1px solid black; text-align:center;">Calf<br>' . @$measurements['zm_p_calf'] . '</td>
	<td   style="border:1px solid black; text-align:center;">&nbsp;<br>' . @$measurements['zm_p_other1'] . '</td>
	<td   style="border:1px solid black; text-align:center;">&nbsp;<br>' . @$measurements['zm_p_other2'] . '</td>
	<td   style="border:1px solid black; text-align:center;">&nbsp;<br>' . @$measurements['zm_p_other3'] . '</td>
	</tr>
	</table>
	<div style="height: 1px;"></div>
	<table width="105%" style="border:1px solid black;">
	<tr>
	<td  colspan="6" style="border:1px solid black;">
	[SUIT/INDO WESTERN]-STYLE
	</td>
	</tr>
	<tr>
	<td   style="border:1px solid black; text-align:center;">Length<br>' . @$measurements['zm_si_length'] . '</td>
	<td   style="border:1px solid black; text-align:center;">Chest<br>' . @$measurements['zm_si_chest'] . '</td>
	<td   style="border:1px solid black; text-align:center;">Stomach<br>' . @$measurements['zm_si_stomach'] . '</td>
	<td   style="border:1px solid black; text-align:center;">Hip<br>' . @$measurements['zm_si_hip'] . '</td>
	<td   style="border:1px solid black; text-align:center;">Shoulder<br>' . @$measurements['zm_si_shoulder'] . '</td>
	<td   style="border:1px solid black; text-align:center;">Sleeves<br>' . @$measurements['zm_si_sleeves'] . '</td>
	</tr>
	<tr>
	<td   style="border:1px solid black; text-align:center;">Neck<br>' . @$measurements['zm_si_neck'] . '</td>
	<td   style="border:1px solid black; text-align:center;">Collar<br>' . @$measurements['zm_si_collar'] . '</td>
	<td   style="border:1px solid black; text-align:center;">Half chest<br>' . @$measurements['zm_si_half_chest'] . '</td>
	<td   style="border:1px solid black; text-align:center;"> Waist coat length<br>' . @$measurements['zm_si_waist_coat_length'] . '</td>
	<td   style="border:1px solid black; text-align:center;"> Sherwani length<br>' . @$measurements['zm_si_sherwani_length'] . '</td>
	<td   style="border:1px solid black; text-align:center;">Bundi coat length<br>' . @$measurements['zm_si_bundi_coat_length'] . '</td>
	</tr>
	</table>
	<div style="height:1px;">LADIES</div>
	<table>
	<tr>
	<td width="35%">
	<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px;">
	<tr><td colspan="2" width="100%" style="border:1px solid black; text-align:center;">Top</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Full Length</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['zm_l_full_length'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Yoke</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['zm_l_yoke'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Upper chest</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['zm_l_upper_chest'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;"> Bust</td><td colspan="2">' . @$measurements['zm_l_bust'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Lower bust</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['zm_l_lower_bust'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;"> Waist</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['zm_l_waist'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;"> Hip</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['zm_l_hip'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;"> Seat</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['zm_l_seat'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">  Shoulder</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['zm_l_shoulder'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Sleeve length</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['zm_l_sleeve_length'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;"> Armhole</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['zm_l_armhole'] . '</td></tr>

	</table>
	</td>
<td width="1%">
	</td>
	<td width="35%">
	<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px;">
	<tr><td colspan="2" width="50%" style="border:1px solid black;"> Bicep</td><td colspan="2">' . @$measurements['zm_l_bicep'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;"> Elbow</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['zm_l_elbow'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Sleeve round</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['zm_l_sleeve_round'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">  Wrist</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['zm_l_wrist'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;"> Front neck</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['zm_l_front_neck'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;"> Back neck</td><td colspan="2">' . @$measurements['zm_l_back_neck'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;"> Neck width</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['zm_l_neck_width'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;"> Collar</td><td colspan="2">' . @$measurements['zm_l_collar'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;">Slit</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['zm_l_slit'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">  Flair</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['zm_l_flair'] . '</td></tr>
	

	</table>
	</td>
	<td width="1%"></td>
	<td width="35%">
	<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px;">
	<tr><td colspan="2" width="100%" style="border:1px solid black; text-align:center;">Bottom</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Length</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['zm_lb_length'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;"> Hip</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['zm_lb_hip'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;"> Thigh</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['zm_lb_thigh'] . '</td></tr>

	<tr><td colspan="2" width="50%" style="border:1px solid black;">Calf</td><td colspan="2">' . @$measurements['zm_lb_calf'] . '</td></tr>
	<tr><td colspan="2" width="50%" style="border:1px solid black;">Ankle</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['zm_lb_ankle'] . '</td></tr>

	</table>
	</td>


	</tr>
	</table>

	<div style="height: 10px;"></div>

	<table width="100%">
	<tr>
	<td style="border:1px solid black; text-align:left;" width="107%" > Remarks :- <br>
		&nbsp;&nbsp;' . @$orders[0]['boutique_work_material_desc'] . '<br>&nbsp;&nbsp;' . @$orders[1]['boutique_work_material_desc'] . '</td>
	</tr>
	</table>
	

	</div>';
	$html3 = '<div style="text-align: center;">
	<h1>' . $logoimagepath . '</h1>
	<h4>' . $addressBoutique . '</h4>
	<div>Measurement Form<br><br></div>
	<table width="100%">
<tr>
	<td width="15%">Order No : ' . @$order_number . '</td>
	<td width="15%">Name:' . @$customer['boutique_customer_name'] . '</td>
	<td>Mob:' . @$customer['boutique_customer_ph'] . '</td>
	<td>Order Date :' . @$work['boutique_order_date'] . '</td>
	<td width="30%">Delivery Date :' . @$work['boutique_order_delivery_date'] . '</td>
</tr>

</table>
<div style="height: 1px;"></div>


<div style="height: 1px;"></div>


<table>
<tr>
<td width="45%">
<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px;">
<tr><td colspan="2" width="100%" style="border:1px solid black; text-align:center;">Front</td></tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;">Yoke Length</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['eth_yoke_length'] . '</td></tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;">Sleeve Length</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['eth_s_length'] . '</td></tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;">Full Length</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['eth_full_length'] . '</td></tr>

<tr><td colspan="2" width="50%" style="border:1px solid black;">Sleeve Round</td><td colspan="2">' . @$measurements['eth_s_round'] . '</td></tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;">Shoulder</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['eth_shoulder'] . '</td></tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;">Sleeve Center</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['eth_s_center'] . '</td></tr>

<tr><td colspan="2" width="50%" style="border:1px solid black;">Chest</td><td colspan="2">' . @$measurements['eth_chest'] . '</td></tr>

<tr><td colspan="2" width="50%" style="border:1px solid black;">Armhole</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['eth_armhole'] . '</td></tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;">Bust</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['eth_bust'] . '</td></tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;">Neck Front</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['eth_neck_front'] . '</td></tr>

<tr><td colspan="2" width="50%" style="border:1px solid black;">Waist</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['eth_waist'] . '</td></tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;">Back</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['eth_back'] . '</td></tr>

<tr><td colspan="2" width="50%" style="border:1px solid black;">Hip</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['eth_hip'] . '</td></tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;">Slit/A-Line/Panel/Umberella</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['eth_s_a_p_u'] . '</td></tr>


</table>
</td>

<td width="1%">
</td>

<td width="45%">
<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px;">

<tr><td colspan="2" width="100%" style="border:1px solid black; text-align:center;">Back</td></tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;">Keyhole</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['eth_keyhole'] . '</td></tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;">Tear Drop</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['eth_t_d'] . '</td></tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;">Polti</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['eth_polti'] . '</td></tr>

<tr><td colspan="2" width="50%" style="border:1px solid black;">Zip</td><td colspan="2">' . @$measurements['eth_zip'] . '</td></tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;">Illusion</td><td colspan="2" width="50%" style="border:1px solid black;">' . @$measurements['eth_illusion'] . '</td></tr>

<tr><td colspan="2" width="50%" style="border:1px solid black;">Waist</td><td colspan="2">' . @$measurements['eth_b_waist'] . '</td></tr>

<tr><td colspan="2" width="50%" style="border:1px solid black;">Thigh</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['eth_b_thigh'] . '</td></tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;">Knee</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['eth_b_knee'] . '</td></tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;">Calf</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['eth_b_calf'] . '</td></tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;">Ankle</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['eth_b_ankle'] . '</td></tr>

<tr><td colspan="2" width="50%" style="border:1px solid black;">Princess Cut</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['eth_b_p_c'] . '</td>
</tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;">Padded</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['eth_b_padded'] . '</td>
</tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;">Side Zip</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['eth_b_s_z'] . '</td>
</tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;">Cutting Point</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['eth_c_p'] . '</td>
</tr>
<tr><td colspan="2" width="50%" style="border:1px solid black;">Point to Point</td><td colspan="2"  width="50%" style="border:1px solid black;">' . @$measurements['eth_b_p_p'] . '</td>
</tr>
</table>
</td>

<td width="1%">
</td>


</tr>
</table>

<div style="height: 50px;"></div>

<table width="100%">
<tr>
<td style="border:1px solid black; text-align:left;" width="107%" height="150"> Remarks :- <br>
&nbsp;&nbsp;' .@$measurements['eth_note']. '</td>
</tr>
</table>

<div style="height: 50px;"></div>
<table width="100%">
</table>
</div>';
		//print_r($html);

		//exit();

		// Print text using writeHTMLCell()
		if ($this->session->userdata('BoutiqueID') == 57) {
			$pdf->writeHTML($html2, true, false, true, false, '');
		} elseif($this->session->userdata('BoutiqueID') == 61)
		{
			$pdf->writeHTML($html3, true, false, true, false, '');
		} else{
			$pdf->writeHTML($html, true, false, true, false, '');
		}
		// ---------------------------------------------------------

		// Close and output PDF document
		// This method has several options, check the source code documentation for more information.
		$pdf->Output(time() . '.pdf', 'I');

		//============================================================+
		// END OF FILE
		//============================================================+

	}



	public function managementbill()
	{

		$id = $this->uri->segment(3);
		$measurements = $this->getAllmeasurements($id);
		$customer = $this->Customer_model->m_getcustomer($id);

		$wid = $this->uri->segment(4);
		$work = $this->Work_model->m_getorderdetails($wid);
		$orders = $this->Work_model->m_getallworks($wid);

		$worktailor = $this->Work_model->m_getworkstaffwithtype(1, $orders[0]['boutique_work_id']);
		$workdesigner = $this->Work_model->m_getworkstaffwithtype(2, $orders[0]['boutique_work_id']);
		$workhand = $this->Work_model->m_getworkstaffwithtype(3, $orders[0]['boutique_work_id']);
		$workmachine = $this->Work_model->m_getworkstaffwithtype(4, $orders[0]['boutique_work_id']);
		$workfinish = $this->Work_model->m_getworkstaffwithtype(5, $orders[0]['boutique_work_id']);
		$workpurchase = $this->Work_model->m_getworkpurchaseitem($orders[0]['boutique_work_id']);

		$manpowerusage = '';

		if ($worktailor) {
			$manpowerusage .= '<tr>
		<td width="20%" style="text-align:center;border-right:1px solid black;border-top:1px solid black;">Tailor</td>
		<td width="20%" style="text-align:center;border-right:1px solid black;border-top:1px solid black;">' . $worktailor['boutique_tailor_username'] . '</td>
		<td width="20%" style="text-align:center;border-right:1px solid black;border-top:1px solid black;">' . $worktailor['boutique_work_staff_hourly_rate'] . '</td>
		<td width="20%" style="text-align:center;border-right:1px solid black;border-top:1px solid black;">' . $worktailor['boutique_work_staff_hours'] . '</td>
		<td width="26%" style="text-align:center;border-top:1px solid black;">' . $worktailor['boutique_work_staff_amount'] . '</td>
	</tr>';
		}

		if ($workdesigner) {
			$manpowerusage .= '<tr>
		<td width="20%" style="text-align:center;border-right:1px solid black;border-top:1px solid black;">Designer</td>
		<td width="20%" style="text-align:center;border-right:1px solid black;border-top:1px solid black;">' . $workdesigner['boutique_tailor_username'] . '</td>
		<td width="20%" style="text-align:center;border-right:1px solid black;border-top:1px solid black;">' . $workdesigner['boutique_work_staff_hourly_rate'] . '</td>
		<td width="20%" style="text-align:center;border-right:1px solid black;border-top:1px solid black;">' . $workdesigner['boutique_work_staff_hours'] . '</td>
		<td width="26%" style="text-align:center;border-top:1px solid black;">' . $workdesigner['boutique_work_staff_amount'] . '</td>
	</tr>';
		}

		if ($workhand) {
			$manpowerusage .= '<tr>
		<td width="20%" style="text-align:center;border-right:1px solid black;border-top:1px solid black;">Hand Work</td>
		<td width="20%" style="text-align:center;border-right:1px solid black;border-top:1px solid black;">' . $workhand['boutique_tailor_username'] . '</td>
		<td width="20%" style="text-align:center;border-right:1px solid black;border-top:1px solid black;">' . $workhand['boutique_work_staff_hourly_rate'] . '</td>
		<td width="20%" style="text-align:center;border-right:1px solid black;border-top:1px solid black;">' . $workhand['boutique_work_staff_hours'] . '</td>
		<td width="26%" style="text-align:center;border-top:1px solid black;">' . $workhand['boutique_work_staff_amount'] . '</td>
	</tr>';
		}

		if ($workmachine) {
			$manpowerusage .= '<tr>
		<td width="20%" style="text-align:center;border-right:1px solid black;border-top:1px solid black;">Machine Embroiderytd>
		<td width="20%" style="text-align:center;border-right:1px solid black;border-top:1px solid black;">' . $workmachine['boutique_tailor_username'] . '</td>
		<td width="20%" style="text-align:center;border-right:1px solid black;border-top:1px solid black;">' . $workmachine['boutique_work_staff_hourly_rate'] . '</td>
		<td width="20%" style="text-align:center;border-right:1px solid black;border-top:1px solid black;">' . $workmachine['boutique_work_staff_hours'] . '</td>
		<td width="26%" style="text-align:center;border-top:1px solid black;">' . $worktailor['boutique_work_staff_amount'] . '</td>
	</tr>';
		}

		if ($workfinish) {
			$manpowerusage .= '<tr>
		<td width="20%" style="text-align:center;border-right:1px solid black;border-top:1px solid black;">Finishing Person</td>
		<td width="20%" style="text-align:center;border-right:1px solid black;border-top:1px solid black;">' . $workfinish['boutique_tailor_username'] . '</td>
		<td width="20%" style="text-align:center;border-right:1px solid black;border-top:1px solid black;">' . $workfinish['boutique_work_staff_hourly_rate'] . '</td>
		<td width="20%" style="text-align:center;border-right:1px solid black;border-top:1px solid black;">' . $workfinish['boutique_work_staff_hours'] . '</td>
		<td width="26%" style="text-align:center;border-top:1px solid black;">' . $workfinish['boutique_work_staff_amount'] . '</td>
	</tr>';
		}

		$purchaseorder  = "";
		foreach ($workpurchase as $key => $purchase) {
			$purchaseorder .= '<tr>
		<td width="25%" style="text-align:center;border-right:1px solid black;border-top:1px solid black;">' . $purchase['boutique_work_purchase_item_name'] . '</td>
		<td width="25%" style="text-align:center;border-right:1px solid black;border-top:1px solid black;">' . $purchase['boutique_work_purchase_item_desc'] . '</td>
		<td width="25%" style="text-align:center;border-right:1px solid black;border-top:1px solid black;"></td>
		<td width="31%" style="text-align:center;border-right:1px solid black;border-top:1px solid black;">' . $purchase['boutique_work_purchase_item_total_amount'] . '</td>
	</tr>';
		}

		$workimage = @$orders[0]['boutique_work_image'];
		$workimagepath = '<img src="https://boutiquesmanager.com/uploads/work/' . $workimage . '" height="140" width="240">';

		ini_set('max_execution_time', 0); // for infinite time of execution

		$this->load->library('Pdf');

		if ($this->session->userdata('BoutiqueID') != 0) {

			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		} else {
			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, false, 'ISO-8859-1', false);
		}

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Boutique Manager');
		$pdf->SetTitle('Order Form');
		$pdf->SetSubject('Order Form - customer');
		$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

		// set default header data
		//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 061', PDF_HEADER_STRING);

		// set header and footer fonts
		$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT - 10, PDF_MARGIN_TOP - 30, PDF_MARGIN_RIGHT);
		//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
			require_once(dirname(__FILE__) . '/lang/eng.php');
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

		if ($this->session->userdata('BoutiqueID') == 27) {

			$logoimagepath = '<img height="130" width="240" src="https://boutiquesmanager.com/uploads/logo/fulki.jpg">';

			$addressBoutique = 'Shop No. 55, 5th Cross Rd, KHB Colony, 6th Block, Koramangala, Bengaluru, Karnataka 560095<br>
            Web : www.fulki.in  |  Ph : 08040970806  | Email - fulkiwear@gmail.com';

			$html = '<div style="text-align: center;">
			<h1>' . $logoimagepath . '</h1>
			<h4>' . $addressBoutique . '</h4>
			</div>
			<table width="100%">
		<tr>
			<td>Order No : ' . @$work['boutique_order_number'] . '</td>
			<td>Name:' . @$customer['boutique_customer_name'] . '</td>
			<td>Mob:' . @$customer['boutique_customer_ph'] . '</td>
			<td>Delivery Date :' . @$work['boutique_order_delivery_date'] . '</td>
		</tr>
	</table>
	<div style="height: 100px;"></div>

	<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px;">
	<tr>
		<td colspan="5" width="106%" style="text-align:center;border:1px solid black;">Manpower Usage</td>
	</tr>
	<tr>
		<td width="20%" style="text-align:center;border-right:1px solid black;">Staff Type</td>
		<td width="20%" style="text-align:center;border-right:1px solid black;">Staff Name</td>
		<td width="20%" style="text-align:center;border-right:1px solid black;">Hourly Rate</td>
		<td width="20%" style="text-align:center;border-right:1px solid black;">Hours Needed</td>
		<td width="20%">Total Amount</td>
	</tr>
	' . $manpowerusage . '
	<tr>
		<td width="80%" colspan="5" style="text-align:center;border-right:1px solid black;border-top:1px solid black;">Total</td>
		
		<td width="26%" style="text-align:center;border-top:1px solid black;">' . $orders[0]['boutique_work_staff_amount'] . '</td>
	</tr>
	</table>
	<div style="height: 100px;"></div>

		<table style="border:1px solid black; text-align:left; padding:5px 5px 5px 5px;">
	<tr>
		<td colspan="5" width="106%" style="text-align:center;border:1px solid black;">Purchase  Order</td>
	</tr>
	<tr>
		<td width="25%" style="text-align:center;border-right:1px solid black;">Item Name</td>
		<td width="25%" style="text-align:center;border-right:1px solid black;">Item Desc</td>
		<td width="25%" style="text-align:center;border-right:1px solid black;">Item Image</td>
		<td width="31%" style="text-align:center;border-right:1px solid black;">Item Price</td>
	</tr>
	' . $purchaseorder . '
	<tr>
		<td width="80%" colspan="3" style="text-align:center;border-right:1px solid black;border-top:1px solid black;">Total</td>
		
		<td width="26%" style="text-align:center;border-top:1px solid black;">' . $orders[0]['boutique_work_purchase_amount'] . '</td>
	</tr>

	<tr>
		<td width="80%" colspan="3" style="text-align:center;border-right:1px solid black;border-top:1px solid black;">Total Order Expenses</td>
		
		<td width="26%" style="text-align:center;border-top:1px solid black;">' . $orders[0]['boutique_work_expense_amount'] . '</td>
	</tr>

	</table>
	';
		} else {
		}

		//print_r($html);

		//exit();

		// Print text using writeHTMLCell()
		$pdf->writeHTML($html, true, false, true, false, '');

		// ---------------------------------------------------------

		// Close and output PDF document
		// This method has several options, check the source code documentation for more information.
		$pdf->Output(time() . '.pdf', 'I');

		//============================================================+
		// END OF FILE
		//============================================================+

	}


	public function bill()
	{

		if ($this->session->userdata('BoutiqueID') == 25) {
			$id = $this->uri->segment(3);
			$work = $this->Work_model->m_getorderdetails($id);
			$orders = $this->Work_model->m_getallworks($id);

			if (@$work['boutique_order_form_number']) {
				$order_number = @$work['boutique_order_form_number'];
			} else {
				$order_number = @$work['boutique_order_number'];
			}

			$orderdata = '';
			$i = 0;
			foreach ($orders as $key => $order) {
				$i++;

				if (@$order["boutique_work_handwork"] && @$order["boutique_work_material_remaining"]) {

					$orderdata .= '
							<tr>
								<td width="10%"  rowspan="3">' . @$i . '</td>
								<td width="45%">' . @$order["boutique_work_name"] . '</td>
								<td width="35%">' . @$order["boutique_work_material_desc"] . '</td>
								<td width="15%">' . @$order["boutique_work_price"] . '</td>
							</tr>
							<tr>
								<td width="45%">Handwork</td>
								<td width="35%"></td>
								<td width="15%">' . @$order["boutique_work_handwork"] . '</td>
							</tr>
							<tr>
								<td width="45%">Material Remaining</td>
								<td width="35%"></td>
								<td width="15%">' . @$order["boutique_work_material_remaining"] . '</td>
							</tr>';
				} elseif (@!$order["boutique_work_handwork"] && @$order["boutique_work_material_remaining"]) {
					$orderdata .= '
							<tr>
								<td width="10%"  rowspan="2">' . @$i . '</td>
								<td width="45%">' . @$order["boutique_work_name"] . '</td>
								<td width="35%">' . @$order["boutique_work_material_desc"] . '</td>
								<td width="15%">' . @$order["boutique_work_price"] . '</td>
							</tr>
							<tr>
								<td width="45%">Material Remaining</td>
								<td width="35%"></td>
								<td width="15%">' . @$order["boutique_work_material_remaining"] . '</td>
							</tr>';
				} elseif (@$order["boutique_work_handwork"] && @!$order["boutique_work_material_remaining"]) {
					$orderdata .= '
							<tr>
								<td width="10%"  rowspan="2">' . @$i . '</td>
								<td width="45%">' . @$order["boutique_work_name"] . '</td>
								<td width="35%">' . @$order["boutique_work_material_desc"] . '</td>
								<td width="15%">' . @$order["boutique_work_price"] . '</td>
							</tr>
							<tr>
								<td width="45%">Handwork</td>
								<td width="35%"></td>
								<td width="15%">' . @$order["boutique_work_handwork"] . '</td>
							</tr>';
				} else {
					$orderdata .= '
						<tr>
							<td width="10%">' . @$i . '</td>
							<td width="45%">' . @$order["boutique_work_name"] . '</td>
							<td width="35%">' . @$order["boutique_work_material_desc"] . '</td>
							<td width="15%">' . @$order["boutique_work_price"] . '</td>
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
			$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

			// set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
				require_once(dirname(__FILE__) . '/lang/eng.php');
				$pdf->setLanguageArray($l);
			}

			// ---------------------------------------------------------

			// set font
			$pdf->SetFont('helvetica', '', 10);


			$pdf->SetPrintHeader(false);
			$pdf->SetPrintFooter(false);

			$pdf->AddPage();

			$logo =	'<img height="80" width="210" src="https://boutiquesmanager.com/uploads/logo/ndot.jpg">';

			$addre_boutique = '
			INVOICE NO:' . $order_number . ' <br>
			Order Date: ' . $work['boutique_order_date'] . '<br>
			Delivery Date: ' . $work['boutique_order_delivery_date'] . '<br>
			Trial Date: ' . $work['boutique_trail_date'] . '<br>';

			// Set some content to print
			$html = '		<table width="100%">
			<tr>
				<td width="60%">
				' . $logo . '
					<br>
				</td>
				<td width="40%">
					<b>' . $work['boutique_name'] . '.</b><br>' .
				$work['boutique_address'] .	'<br>
			Phone: ' . $work['boutique_ph'] . '<br>
			Email: ' . $work['boutique_email'] . '<br>
				</td>
			</tr>
		</table>
		<div style="padding: 15px; background-color: #eeeeee;">
		' . $addre_boutique . '
		</div>
		<table>
			<tr>
				<td>&nbsp;</td>
			</tr>
		</table>
		<div>
			Invoiced To<br>
			<b>' . $work['boutique_customer_name'] . '</b><br>
			' . $work['boutique_customer_address'] . '<br>
			Phone:' . $work['boutique_customer_ph'] . '<br>
			Email:' . $work['boutique_customer_email'] . '<br>
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
				<td width="45%"><b>Name</b></td>
				<td width="35%"><b>Remarks</b></td>
				<td width="15%"><b>Total</b></td>
			</tr>
			' . $orderdata . '
			<tr style="padding: 15px; background-color: #eeeeee;">
				<td width="10%"></td>
				<td width="45%"><b>Total</b></td>
				<td width="35%"></td>
				<td width="15%"><b>Rs ' . $work['boutique_order_grandtotal'] . '</b></td>
			</tr>
		</table>';
			// Print text using writeHTMLCell()
			$pdf->writeHTML($html, true, false, true, false, '');

			// ---------------------------------------------------------

			// Close and output PDF document
			// This method has several options, check the source code documentation for more information.
			$pdf->Output(time() . '.pdf', 'I');

			//============================================================+
			// END OF FILE
			//============================================================+

		} else {

			$id = $this->uri->segment(3);
			$work = $this->Work_model->m_getorderdetails($id);
			$orders = $this->Work_model->m_getallworks($id);
			$orderdata = '';

			if (@$work['boutique_order_form_number']) {
				$order_number = @$work['boutique_order_form_number'];
			} else {
				$order_number = @$work['boutique_order_number'];
			}

			$i = 0;
			foreach ($orders as $key => $order) {
				$i++;
				$workimage = @$order['boutique_work_image'];
				$orderdata .= '
			<tr>
				<td width="25%">' . @$i . '</td>
				<td width="60%">' . @$order["boutique_work_name"] . '</td>
				<td width="25%">' . @$order["boutique_work_price"] . '</td>
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
			$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

			// set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
				require_once(dirname(__FILE__) . '/lang/eng.php');
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

			if ($this->session->userdata('BoutiqueID') == 7 || $this->session->userdata('BoutiqueID') == 5 || $this->session->userdata('BoutiqueID') == 15 || $this->session->userdata('BoutiqueID') == 33) {
				$logo =	'';
			} elseif ($this->session->userdata('BoutiqueID') == 8 || $this->session->userdata('BoutiqueID') == 9 || $this->session->userdata('BoutiqueID') == 10) {
				$logo = '<img height="80" width="210" src="https://boutiquesmanager.com/uploads/logo/beboo-logo.png">';
			} elseif ($this->session->userdata('BoutiqueID') == 25) {
				$logo = '<img height="80" width="210" src="https://boutiquesmanager.com/uploads/logo/ndot.jpg">';
			} elseif ($this->session->userdata('BoutiqueID') == 27) {
				$logo = '<img height="110" width="210" src="https://boutiquesmanager.com/uploads/logo/fulki.jpg">';
			} elseif ($this->session->userdata('BoutiqueID') == 35) {
				$logo = '<img height="110" width="310" src="https://boutiquesmanager.com/uploads/logo/dandjavenue.jpg">';
			} elseif ($this->session->userdata('BoutiqueID') == 12) {
				$logo = '<img src="https://boutiquesmanager.com/assets/images/images.jpg" height="100" width="160" />';
			} else {
				$blogo = $this->session->userdata('BoutiqueLogo');
				$logo =	'<img src="'.base_url().'uploads/logo/' . $blogo . '" height="100" width="160" />';
			}

			// Set some content to print
			if ($this->session->userdata('BoutiqueID') == 53 || $this->session->userdata('BoutiqueID') == 59) {
				$pending_amt = ($work['boutique_order_grandtotal'] - $work['boutique_order_amtpaid']);
				$html = '		<table width="100%">
			<tr>
				<td width="60%">
				' . $logo . '
					<br>
				</td>
				<td width="40%">
					<b>' . $work['boutique_name'] . '.</b><br>' .
					$work['boutique_address'] .	'<br>
			Phone: ' . $work['boutique_ph'] . '<br>
			Email: ' . $work['boutique_email'] . '<br>
				</td>
			</tr>
		</table>
		<div style="padding: 15px; background-color: #eeeeee;">
		Order Number:' . $order_number . ' <br>
		Order Date: ' . $work['boutique_order_date'] . '<br>
		Delivery Date: ' . $work['boutique_order_delivery_date'] . '<br>
		</div>
		<table>
			<tr>
				<td>&nbsp;</td>
			</tr>
		</table>
		<div>
			Invoiced To<br>
			<b>' . $work['boutique_customer_name'] . '</b><br>
			' . $work['boutique_customer_address'] . '<br>
			Phone:' . $work['boutique_customer_ph'] . '<br>
			Email:' . $work['boutique_customer_email'] . '<br>
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
                <td width="25%">No</td>
                <td width="60%"><b>Name</b></td>
                <td width="25%"><b>Total</b></td>
            </tr>
            ' . $orderdata . '
            <tr style="padding: 15px; background-color: #eeeeee;">
                <td width="25%"></td>
                <td width="60%"><b>Total</b></td>
                <td width="25%"><b>Rs ' . $work['boutique_order_grandtotal'] . '</b></td>
            </tr>
            <tr style="padding: 15px; background-color: #eeeeee;">
                <td width="25%"></td>
                <td width="60%"><b>Amount Paid</b></td>
                <td width="25%"><b>Rs ' . $work['boutique_order_amtpaid'] . '</b></td>
            </tr>
            <tr style="padding: 15px; background-color: #eeeeee;">
                <td width="25%"></td>
                <td width="60%"><b>Pending Amount</b></td>
                <td width="25%"><b style="font-size:20px;">Rs ' . $pending_amt . '</b></td>
                
            </tr>
        </table>';
			}
			elseif($this->session->userdata('BoutiqueID') == 61)//Ethereal
			{
				$pending_amt = ($work['boutique_order_grandtotal'] - $work['boutique_order_amtpaid']);
				$html = '		<table width="100%">
				<tr>
					<td width="60%">
					' . $logo . '
						<br>
					</td>
					<td width="40%">
						<b>' . $work['boutique_name'] . '.</b><br>' .
						$work['boutique_address'] .	'<br>
				Phone: ' . $work['boutique_ph'] . '<br>
				Email: ' . $work['boutique_email'] . '<br>
					</td>
				</tr>
			</table>
			<div style="padding: 15px; background-color: #eeeeee;">
			Order Number:' . $order_number . ' <br>
			Order Date: ' . $work['boutique_order_date'] . '<br>
			Delivery Date: ' . $work['boutique_order_delivery_date'] . '<br>
			</div>
			<table>
				<tr>
					<td>&nbsp;</td>
				</tr>
			</table>
			<div>
				To<br>
				<b>' . $work['boutique_customer_name'] . '</b><br>
				' . $work['boutique_customer_address'] . '<br>
				Phone:' . $work['boutique_customer_ph'] . '<br>
				Email:' . $work['boutique_customer_email'] . '<br>
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
					<td width="25%">No</td>
					<td width="60%"><b>Name</b></td>
					<td width="25%"><b>Total</b></td>
				</tr>
				' . $orderdata . '
				<tr style="padding: 15px; background-color: #eeeeee;">
                <td width="25%"></td>
                <td width="60%"><b>Total</b></td>
                <td width="25%"><b>Rs ' . $work['boutique_order_grandtotal'] . '</b></td>
            </tr>
            <tr style="padding: 15px; background-color: #eeeeee;">
                <td width="25%"></td>
                <td width="60%"><b>Amount Paid</b></td>
                <td width="25%"><b>Rs ' . $work['boutique_order_amtpaid'] . '</b></td>
            </tr>
            <tr style="padding: 15px; background-color: #eeeeee;">
                <td width="25%"></td>
                <td width="60%"><b>Pending Amount</b></td>
                <td width="25%"><b style="font-size:16px;">Rs ' . $pending_amt . '</b></td>
                
            </tr>
			</table>
			<table width="100%" style="padding-top:395px;">
				<tr>
					<td width="70%">
					* Composition dealer not eligible to collect Tax.
					</td>
					<td width="30%">
						<b>Our Bank Account Details</b><br>
						Account no: 00000037212869115<br>
						Name: Ethereal<br>
						IFSC Code: SBIN0010569<br>
						Bank: State Bank of India<br>
						Branch: Thrikkakara<br>
					</td>
				</tr>
			</table>
			<table>
			<tr>
				<td width="37%"></td>
				<td width="30%">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img style="padding-left:10px;" src="https://boutiquesmanager.com/uploads/logo/' . $blogo . '"  height="50" width="80" /><br>
				<u><b>TERMS AND CONDITIONS</b></u>
				</td>
				<td width="30%"></td>
				</tr>
		</table>
		<div><br><br>
		Customers are asked to carefully read our Terms and Conditions below.<br><br>
		<u><b>PAYMENT OF ORDER</b></u><br><br>
		a) Customer are required to pay a 50% NON-REFUNDABLE deposite on the date of ordering.<br><br>
		b) No goods may be removed from the premises until full payment of the order has been fulfilled. <br><br>
		ALL GARMENTS REMAIN THE PROPERTY OF ETHEREAL UNTIL PAID FOR IN FULL. <br><br>
		c) Customers should retain their sales receipts as proof of purchase, and be sure to have read this<br><br>
		TERMS AND CONDITIONS NOTICE and fully understand its requirements.<br><br>
		All items purchased are non-returnable/refundable.<br><br>
		<u><b>CANCELLATION OF ORDERS</b></u><br><br>
		a) Customers who cancel their sales contract are NOT entitled to a refund.<br><br>
		 Dress orders will still have to be paid for in FULL, if the function is cancelled for whatever reason regardless of ANY circumstance.<br><br>
		 <u><b>NON-COLLECTION OF GOODS</b></u><br><br>
		 a) If cutomers do not collect their goods within 3 months after due date, it will be deemed<br><br>
		 cancelled without any further notification and amount paid will not be refunded.<br><br>
		 Garments will be put into the shops stock to be resold<br><br>
		 Ethereal is unable to guarantee fabric swatch matches with instore garments due to fabric changes<br><br>
		 Swatches should be regarded as indication only.<br><br>
		 This applies to all fabrics,laces,beading,and any other trimmings or embellishments.<br><br>
		  WE RECOMMEND DRY WASH FOR ALL GARMENTS
		</div>
			';
			} 
		// Starting of 136 

		elseif($this->session->userdata('UserID') ==136) {
			$id = $work['boutique_property'];
			
			$po_name = $this->Work_model->m_getpropertyname($id);
			
			$final_adrs=$work['boutique_customer_address']; 
			$gst_status=$work['boutique_gst_status'];
			$current_date=date("d/m/Y");
			if($gst_status == 2)
			{
				$sgct=round(($work['boutique_order_grandtotal']*(9/118)),2);//sgst same as cgst
				$rent=($work['boutique_order_grandtotal']-$sgct+$sgct)+$work['rent_discount'];
				$orderdata = '
				
				<tr>
					<td ></td>
					<td >Building Name &nbsp;:'.$po_name['boutique_property_name'].'</td>
					<td ></td>
				</tr>

				<tr>
				<td ></td>
				<td >Rent Period: From &nbsp;'.$work['rent_from_date'].' &nbsp; to  &nbsp; '.$work['rent_to_date'].'</td>
				<td ></td>
				</tr>

				<tr>
					<td ></td>
					<td >From the month of &nbsp;:&nbsp;'.$work['rent_month'].'</td>
					<td ></td>
				</tr>
				
				<tr>
					<td ></td>
					<td >Room No &nbsp;:'.$work['rent_room_no'].'</td>
					<td ></td>
				</tr>
				<tr>
					<td ></td>
					<td >Rent</td>
					<td >'.$work['price_without_gst'].'</td>
				</tr>
				<tr>
						<td ></td>
						<td >Discount</td>
						<td >'.$work['rent_discount'].'</td>
				</tr>
			
				<tr>
					<td ></td>
					<td >SGST 9%</td>
					<td >'.$sgct.'</td>
				</tr>
				<tr>
					<td ></td>
					<td >CGST 9%</td>
					<td >'.$sgct.'</td>
				</tr>
				<tr>
					<td ></td>
					<td >KFC 1%</td>
					<td >'.$kfc.'</td>
				</tr>
				<tr>
					<td ></td>
					<td >Round Off</td>
					<td ></td>
				</tr>
				';
			}
			elseif($gst_status == 1)
			{
				$sgct=round(($work['boutique_order_grandtotal']*(9/119)),2);//sgst same as cgst
				$kfc=round(($work['boutique_order_grandtotal']*(1/119)),2);
				$rent=($work['boutique_order_grandtotal']-($sgct+$sgct+$kfc))+$work['rent_discount'];
				$orderdata = '
				
				<tr>
					<td ></td>
					<td >Building Name &nbsp;:'.$po_name['boutique_property_name'].'</td>
					<td ></td>
				</tr>

			    <tr>
				<td ></td>
				<td >Rent Period: From &nbsp;'.$work['rent_from_date'].' &nbsp; to  &nbsp; '.$work['rent_to_date'].'</td>
				<td ></td>
				</tr>
				<tr>
					<td ></td>
					<td >From the month of &nbsp;:&nbsp;'.$work['rent_month'].'</td>
					<td ></td>
				</tr>
				
				<tr>
					<td ></td>
					<td >Room No &nbsp;:'.$work['rent_room_no'].'</td>
					<td ></td>
				</tr>
				<tr>
					<td ></td>
					<td >Rent</td>
					<td >'.$work['price_without_gst'].'</td>
				</tr>
				<tr>
						<td ></td>
						<td >Discount</td>
						<td >'.$work['rent_discount'].'</td>
				</tr>
			
				<tr>
					<td ></td>
					<td >SGST 9%</td>
					<td >'.$sgct.'</td>
				</tr>
				<tr>
					<td ></td>
					<td >CGST 9%</td>
					<td >'.$sgct.'</td>
				</tr>
				<tr>
					<td ></td>
					<td >KFC 1%</td>
					<td >'.$kfc.'</td>
				</tr>
				<tr>
					<td ></td>
					<td >Round Off</td>
					<td ></td>
				</tr>
				';
			}
			else
			{
				$orderdata = '
					
					<tr>
					<td ></td>
					<td >Building Name &nbsp;:'.$po_name['boutique_property_name'].'</td>
					<td ></td>
				</tr>

				<tr>
				<td ></td>
				<td >Rent Period: From &nbsp;'.$work['rent_from_date'].' &nbsp; to  &nbsp; '.$work['rent_to_date'].'</td>
				<td ></td>
				</tr>
				<tr>
					<td ></td>
					<td >From the month of &nbsp;:&nbsp;'.$work['rent_month'].'</td>
					<td ></td>
				</tr>
			
				
				<tr>
					<td ></td>
					<td >Room No &nbsp;:'.$work['rent_room_no'].'</td>
					<td ></td>
				</tr>		
					<tr>
						<td ></td>
						<td >Rent</td>
						<td >'.$work['boutique_order_grandtotal'].'</td>
					</tr>
					<tr>
						<td ></td>
						<td >Discount</td>
						<td >'.$work['rent_discount'].'</td>
					</tr>
				
					<tr>
						<td ></td>
						<td >SGST 9%</td>
						<td ></td>
					</tr>
					<tr>
						<td ></td>
						<td >CGST 9%</td>
						<td ></td>
					</tr>
					<tr>
						<td ></td>
						<td >KFC 1%</td>
						<td ></td>
					</tr>
					<tr>
						<td ></td>
						<td >Round Off</td>
						<td ></td>
					</tr>
					';
			}
			
			// <b>DIVISION:&nbsp;</b>'.$work['boutique_city'].'<br>
			//	Email:' . $work['boutique_customer_email'] . '<br>
			$html = '<table width="100%">
	<tr>
			<td width="20%">
	


	No.&nbsp;&nbsp; '.$order_number .'
			</td>
			<td width="60%"  style="text-align:center">
		<center><h1>&nbsp;'.$po_name['b_boutique_header'].'</h1><br>
			'.$po_name['b_boutique_subheader'].'<br>
			<br>
		 <b>INVOICE</b>
			</center></td>
			
			<td width="20%">
		Mob&nbsp; : '.$po_name['b_boutique_phone'].'<br>
	
		Date&nbsp;&nbsp;: '.$current_date.'
			</td>
		</tr>
	</table>
	
	<table>
		<tr>
			<td>&nbsp;</td>
		</tr>
	</table>
	<div>
		Invoiced To<br>
		<b>' . $work['boutique_customer_name'] . '</b><br>
		' . $final_adrs. '<br>
		Phone:' . $work['boutique_customer_ph'] . '<br>
	
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
			<td width="25%">Sl.No.</td>
			<td width="60%"><b>Description</b></td>
			<td width="25%"><b>Amount</b></td>
		</tr>
		' . $orderdata . '
		<tr style="padding: 15px; background-color: #eeeeee;">
			<td width="25%"></td>
			<td width="60%"><b>Total</b></td>
			<td width="25%"><b>Rs ' . $work['boutique_order_grandtotal'] . '</b></td>
		</tr>


		
	</table>
	<table width="100%" style="padding:5px;">
		<tr>
			<td width="60%">
			</td>
			<td width="10%">
			
			</td>
			<td width="30%">
			</td>
		</tr>
		<tr>
			<td>
			&nbsp;
			</td>
		</tr>
	</table>
	<table>
			<tr>
				<th>
				</th>
			</tr>
			<tr>
			<td>
			&nbsp;
			</td>
			</tr>
			<tr>
				<td width="50%">
				'.$po_name['auth_signature_1'].'
				</td>
				<td width="25%">
				</td>
				<td width="25%">
				'.$po_name['auth_signature_2'].'
				</td>
			</tr>
	</table>
	

	';
		}
		
		//Ending of 136
			


			else {
				//only for SACHIN T PULLIMOOTIL 
				$final_adrs=$work['boutique_customer_address']; 
				$gst_status=$work['boutique_gst_status'];
				$current_date=date("d/m/Y");
				if($gst_status)
				{
					$sgct=round(($work['boutique_order_grandtotal']*(9/119)),0);//sgst same as cgst
					$kfc=round(($work['boutique_order_grandtotal']*(1/119)),0);
					$rent=($work['boutique_order_grandtotal']-($sgct+$sgct+$kfc));
					$orderdata = '
					<tr>
						<td ></td>
						<td >For the Month of:&nbsp;'.$work['boutique_due_date'].'</td>
						<td ></td>
					</tr>
					<tr>
						<td ></td>
						<td >Building No.&Room No &nbsp;:</td>
						<td ></td>
					</tr>
					<tr>
						<td ></td>
						<td >Rent</td>
						<td >'.$rent.'</td>
					</tr>
					<tr>
						<td ></td>
						<td >SGST 9%</td>
						<td >'.$sgct.'</td>
					</tr>
					<tr>
						<td ></td>
						<td >CGST 9%</td>
						<td >'.$sgct.'</td>
					</tr>
					<tr>
						<td ></td>
						<td >KFC 1%</td>
						<td >'.$kfc.'</td>
					</tr>
					<tr>
						<td ></td>
						<td >Round Off</td>
						<td ></td>
					</tr>
					';
				}
				else
				{
					$orderdata = '
						<tr>
							<td ></td>
							<td >For the Month of:&nbsp;'.$work['boutique_due_date'].'</td>
							<td ></td>
						</tr>
						<tr>
							<td ></td>
							<td >Building No.&Room No &nbsp;:</td>
							<td ></td>
						</tr>
						<tr>
							<td ></td>
							<td >Rent</td>
							<td >'.$work['boutique_order_grandtotal'].'</td>
						</tr>
						<tr>
							<td ></td>
							<td >SGST 9%</td>
							<td ></td>
						</tr>
						<tr>
							<td ></td>
							<td >CGST 9%</td>
							<td ></td>
						</tr>
						<tr>
							<td ></td>
							<td >KFC 1%</td>
							<td ></td>
						</tr>
						<tr>
							<td ></td>
							<td >Round Off</td>
							<td ></td>
						</tr>
						';
				}
				// <b>DIVISION:&nbsp;</b>'.$work['boutique_city'].'<br>
				//	Email:' . $work['boutique_customer_email'] . '<br>
				$html = '<table width="100%">
			<tr>
				<td width="40%">
		
	
	
		No.&nbsp;&nbsp; '.$order_number .'
				</td>
				<td width="40%">
				<h3>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;' . $work['boutique_name'] . '</h3><br>
				  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; '.$work['boutique_city'].'<br>
				  &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <b>INVOICE</b>
				</td>
				<td width="20%">
			Mob&nbsp; : ' . $work['boutique_ph'] . '<br>
		
			Date&nbsp;&nbsp;: '.$current_date.'
				</td>
			</tr>
		</table>
		
		<table>
			<tr>
				<td>&nbsp;</td>
			</tr>
		</table>
		<div>
			Invoiced To<br>
			<b>' . $work['boutique_customer_name'] . '</b><br>
			' . $final_adrs. '<br>
			Phone:' . $work['boutique_customer_ph'] . '<br>
		
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
				<td width="25%">Sl.No.</td>
				<td width="60%"><b>Description</b></td>
				<td width="25%"><b>Amount</b></td>
			</tr>
			' . $orderdata . '
			<tr style="padding: 15px; background-color: #eeeeee;">
				<td width="25%"></td>
				<td width="60%"><b>Total</b></td>
				<td width="25%"><b>Rs ' . $work['boutique_order_grandtotal'] . '</b></td>
			</tr>
		</table>
		<table width="100%" style="padding:5px;">
			<tr>
				<td width="60%">
				<br>'.ucwords($this->getIndianCurrency( $work['boutique_order_grandtotal'])).' Only
				</td>
				<td width="10%">
				
				</td>
				<td width="30%">
				<br><br><br><b>'. $work['boutique_name'] .'</b>
				</td>
			</tr>
		</table>
		
	
		';
			}


			/*
$html .= '<style>'.file_get_contents('https://boutiquesmanager.com/assets/bower_components/bootstrap/dist/css/bootstrap.min.css').'</style>';

$html .= '<style>'.file_get_contents('https://boutiquesmanager.com/assets/dist/css/AdminLTE.min.css').'</style>';
*/


			// Print text using writeHTMLCell()
			$pdf->writeHTML($html, true, false, true, false, '');

			// ---------------------------------------------------------

			// Close and output PDF document
			// This method has several options, check the source code documentation for more information.
			$pdf->Output(time() . '.pdf', 'I');

			//============================================================+
			// END OF FILE
			//============================================================+

		}
	}


	public function getStaffHourlyRate()
	{
		$id = $this->input->post('boutique_tailor_id');
		$staffDetails = $this->Tailor_model->m_gettailor($id);
		if ($staffDetails) {
			return print_r(json_encode(array('status' => 'success', 'data' => $staffDetails['boutique_staff_hourly_rate'])));
		} else {
			return print_r(json_encode(array('status' => 'failure')));
		}
	}

	public function reports()
	{
		$data["date_from_report"] = $this->input->post('date_from_report');
		$data["date_to_report"] = $this->input->post('date_to_report');
		$data["reports"] = $this->Work_model->getreports();
		$arr = $data["reports"];
		$data["total_expences_stitch"] = array_sum(array_map(function ($item) {
			return $item['boutique_work_price'];
		}, $arr));
		$data["total_expences_handwork"] = array_sum(array_map(function ($item) {
			return $item['boutique_work_handwork'];
		}, $arr));
		$data["boutique_work_material_remaining"] = array_sum(array_map(function ($item) {
			return $item['boutique_work_material_remaining'];
		}, $arr));

		$this->load->view('boutique/header');
		$this->load->view('boutique/reports', @$data);
		$this->load->view('boutique/footer');
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


	public function expencecategory(){
	    if ($this->session->userdata('UserID') == 136) {
		$data["properties"] = $this->Billing_model->getproperties();
	    }
		$data["expencecategory"] = $this->Billing_model->getexpencecategories();
		$data["customers"] = $this->Customer_model->m_getallcustomers();
		$this->load->view('boutique/header');
		$this->load->view('boutique/expencecategories',@$data);
		$this->load->view('boutique/footer');
	}
        public function addexpencecategory(){

    	$data["expencecategory"] = $this->Billing_model->getexpencecategories();
		$this->load->view('boutique/header');
		$this->load->view('boutique/addexpencecategory',@$data);
		$this->load->view('boutique/footer');
	}
    public function saveexpencecategory(){

		$this->Billing_model->addexpencecategories();
		$data["expencecategory"] = $this->Billing_model->getexpencecategories();
        $data["customers"] = $this->Customer_model->m_getallcustomers();
		$this->session->set_flashdata('notification', 'Expence Category added successfully!');
		$this->session->set_flashdata('status', 'success');
		$this->load->view('boutique/header');
		$this->load->view('boutique/expencecategories',@$data);
		$this->load->view('boutique/footer');
	}
    public function removeexpencecategory($id){

		//$id = $this->uri->segment(3);
		$this->Billing_model->removeexpencecategory($id);
		$this->session->set_flashdata('notification', 'Expence Category deleted!');
		$this->session->set_flashdata('status', 'danger');
		redirect(base_url().'boutique/expencecategory/', 'refresh');
	}
/***************Ends Expence Category***********************/
	public function expences(){

		if($this->session->userdata('UserRole')== 4 || $this->session->userdata('UserRole')== 5 || $this->session->userdata('UserRole')== 6 || $this->session->userdata('UserRole')== 7)
		{
			$data["expences"] = $this->Billing_model->getpettyexpences($this->session->userdata('UserID'));	
			// var_dump($data["expences"]);
			$data["recieved_petty_bank"] = $this->Billing_model->getpettycashinbank();
			$data["recieved_petty_hand"] = $this->Billing_model->getpettycashinhand();
		
		}
		else
		{
			$id = $this->uri->segment(3);
			$data["expences"] = $this->Billing_model->getexpences($id);	
		}
//$this->session->userdata('UserRole')== 4
		$this->load->view('boutique/header');
		$this->load->view('boutique/expences',@$data);
		$this->load->view('boutique/footer');
	}
    
    public function addexpence(){
	    if ($this->session->userdata('UserID') == 126 || $this->session->userdata('UserID') == 128) {
		$data["properties"] = $this->Billing_model->getproperties();
	    }
    	$data["expencecategory"] = $this->Billing_model->getexpencecategories();
		$this->load->view('boutique/header');
		$this->load->view('boutique/addexpence',@$data);
		$this->load->view('boutique/footer');
	}

	public function saveexpence(){

		$this->Billing_model->addexpence();
		$data["expences"] = $this->Billing_model->getexpences();

		$this->session->set_flashdata('notification', 'Expence added successfully!');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url().'boutique/expences/', 'refresh');
	
		// $this->load->view('boutique/header');
		// $this->load->view('boutique/expences',@$data);
		// $this->load->view('boutique/footer');
	}  

	public function updateexpence(){
    
		$data["properties"] = $this->Billing_model->getproperties();
	
		$this->Billing_model->updateexpence();
		$this->session->set_flashdata('notification', 'Expence updated Sucessfully!');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url().'boutique/expencedetails/'.$this->input->post('boutique_expense_id'), 'refresh');
	} 

	public function removeexpence(){

		$id = $this->uri->segment(3);
		$this->Billing_model->removeexpence($id);
		$this->session->set_flashdata('notification', 'Expence deleted!');
		$this->session->set_flashdata('status', 'danger');
		redirect(base_url().'boutique/expences/', 'refresh');
	}

	public function expencedetails(){

		$id = $this->uri->segment(3);
		$data["properties"] = $this->Billing_model->getproperties();
	
		$data["expences"] = $this->Billing_model->getexpencesdetails($id);
		$data["expencecategory"] = $this->Billing_model->getexpencecategories();
		$this->load->view('boutique/header');
		$this->load->view('boutique/expencedetails',@$data);
		$this->load->view('boutique/footer');
	}
	public function expencereport(){
		$data["date_from_report"] = $this->input->post('date_from_report');
		$data["date_to_report"] = $this->input->post('date_to_report');
		$data["expences"] = $this->Billing_model->getexpencesreport();
		$arr = $data["expences"];
		$data["total_expences"] = array_sum(array_map(function($item) { 
    		return $item['boutique_expense_amount']; 
		}, $arr));

		$this->load->view('boutique/header');
		$this->load->view('boutique/expences-reports',@$data);
		$this->load->view('boutique/footer');
	}
	public function profitreport(){
		
		$data["date_from_report"] = $this->input->post('date_from_report');
		$data["date_to_report"] = $this->input->post('date_to_report');
		$data["expences"] = $this->Billing_model->getexpencesreport();
		$arr = $data["expences"];
		$data["total_expences"] = array_sum(array_map(function($item) { 
    		return $item['boutique_expense_amount']; 
		}, $arr));
		$data["sale"] = $this->Billing_model->getsalereportforprofit();
		$arr = $data["sale"];
		$data["total_sale"] = array_sum(array_map(function($item) { 
    		return $item['boutique_order_paymentamt']; 
		}, $arr));
		$this->load->view('boutique/header');
		$this->load->view('boutique/profit-reports',@$data);
		$this->load->view('boutique/footer');
	}
	//property add
	
		public function properties(){
		$data["properties"] = $this->Billing_model->getproperties();
		$this->load->view('boutique/header');
		$this->load->view('boutique/properties',@$data);
		$this->load->view('boutique/footer');
	}
    
    public function addproperty(){
		$this->load->view('boutique/header');
		$this->load->view('boutique/addproperty',@$data);
		$this->load->view('boutique/footer');
	}

	public function saveproperty(){

		$this->Billing_model->addproperty();
		$data["properties"] = $this->Billing_model->getproperties();
		$this->session->set_flashdata('notification', 'Property added successfully!');
		$this->session->set_flashdata('status', 'success');
		$this->load->view('boutique/header');
		$this->load->view('boutique/properties',@$data);
		$this->load->view('boutique/footer');
	}  

	public function updateproperty(){

		$this->Billing_model->updateproperty();
		$this->session->set_flashdata('notification', 'Property updated Sucessfully!');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url().'boutique/propertydetails/'.$this->input->post('boutique_property_id'), 'refresh');
	} 

	public function removeproperty(){

		$id = $this->uri->segment(3);
		$this->Billing_model->removeproperty($id);
		$this->session->set_flashdata('notification', 'Property deleted!');
		$this->session->set_flashdata('status', 'danger');
		redirect(base_url().'boutique/properties/', 'refresh');
	}

	public function propertydetails(){

		$id = $this->uri->segment(3);
		$data["properties"] = $this->Billing_model->getpropertydetails($id);
		$this->load->view('boutique/header');
		$this->load->view('boutique/propertydetails',@$data);
		$this->load->view('boutique/footer');
	}
	public function viewCustomer()
	{
		$cid=$this->input->post('cid');
        if($cid == 0){
            return false;
        }
		$cust = $this->Customer_model->m_loadcustomers($cid);
		
		$data['customer']=$cust;
		echo json_encode($data);
  
	}
	public function income(){
		$id = $this->uri->segment(3);
	
		$data["expences"] = $this->Billing_model->getincomes($id);
		$this->load->view('boutique/header');
		$this->load->view('boutique/incomes',@$data);
		$this->load->view('boutique/footer');
	}
	public function addincome(){
	    if ($this->session->userdata('UserID') == 126 || $this->session->userdata('UserID') == 128) {
		$data["properties"] = $this->Billing_model->getproperties();
	    }
    	$data["expencecategory"] = $this->Billing_model->getincomecategories();
		$this->load->view('boutique/header');
		$this->load->view('boutique/addincome',@$data);
		$this->load->view('boutique/footer');
	}
	public function saveincome(){

		$this->Billing_model->addincome();
		$data["expences"] = $this->Billing_model->getincomes();
		

		$this->session->set_flashdata('notification', 'Income added successfully!');
		$this->session->set_flashdata('status', 'success');
		$this->load->view('boutique/header');
		$this->load->view('boutique/incomes',@$data);
		$this->load->view('boutique/footer');
	}  
	public function incomecategory(){
	    if ($this->session->userdata('UserID') == 136) {
		$data["properties"] = $this->Billing_model->getproperties();
	    }
		$data["expencecategory"] = $this->Billing_model->getincomecategories();
		$data["customers"] = $this->Customer_model->m_getallcustomers();
		$this->load->view('boutique/header');
		$this->load->view('boutique/incomecategories',@$data);
		$this->load->view('boutique/footer');
	}
	public function addincomecategory(){

    	$data["expencecategory"] = $this->Billing_model->getexpencecategories();
		$this->load->view('boutique/header');
		$this->load->view('boutique/addincomecategory',@$data);
		$this->load->view('boutique/footer');
	}
	public function saveincomecategory(){

		$this->Billing_model->addincomecategories();
		$data["expencecategory"] = $this->Billing_model->getincomecategories();
		$data["customers"] = $this->Customer_model->m_getallcustomers();
	
		$this->session->set_flashdata('notification', 'Income Category added successfully!');
		$this->session->set_flashdata('status', 'success');
		$this->load->view('boutique/header');
		$this->load->view('boutique/incomecategories',@$data);
		$this->load->view('boutique/footer');
	}
	public function expensecate_property(){
		
		
		$id = $this->uri->segment(3);
		$data["date_from_report"] = $this->input->post('date_from_report');
		$data["date_to_report"] = $this->input->post('date_to_report');
		$data["expences"] = $this->Billing_model->getexpencesreport1($id);
		$arr = $data["expences"];
		$data["total_expences"] = array_sum(array_map(function($item) { 
    		return $item['boutique_expense_amount']; 
		}, $arr));

		$this->load->view('boutique/header');
		$this->load->view('boutique/expences-reports-property',@$data);
		$this->load->view('billing/footer');
	}
	
	public function incomecate_property(){
		
		
		$id = $this->uri->segment(3);
		$data["date_from_report"] = $this->input->post('date_from_report');
		$data["date_to_report"] = $this->input->post('date_to_report');
		$data["expences"] = $this->Billing_model->getincomereport1($id);
		$arr = $data["expences"];
		$data["total_expences"] = array_sum(array_map(function($item) { 
    		return $item['boutique_expense_amount']; 
		}, $arr));

		$this->load->view('boutique/header');
		$this->load->view('boutique/Income-reports-property',@$data);
		$this->load->view('billing/footer');
	}
	public function stafftype(){
	    
		$data["stafftype"] = $this->Tailor_model->stafftype();
		$this->load->view('boutique/header');
		$this->load->view('boutique/stafftype',@$data);
		$this->load->view('boutique/footer');
	}
	public function addstafftype(){
			 
		$this->load->view('boutique/header');
		$this->load->view('boutique/add-stafftype',@$data);
		$this->load->view('boutique/footer');
	}
	public function savestafftype(){
		if($this->session->userdata('UserRole') == 5){
 				redirect(base_url().'login/', 'refresh');
 			 }
		$return_value = $this->Tailor_model->m_addstafftype();

		if($return_value =="already_exists")
		{
			$this->session->set_flashdata('notification', 'This staff is already exists!! you cant add this employee!!');
			redirect(base_url().'boutique/stafftype', 'refresh');
			
		}
		else
		{
			$this->session->set_flashdata('notification', 'New Staff Type Added successfully!');

			$this->session->set_flashdata('status', 'success');
			redirect(base_url().'boutique/stafftype', 'refresh');

		}

		// $this->session->set_flashdata('notification', 'This staff is already exists!! you cant add this employee!!');
		// redirect(base_url().'boutique/stafftype', 'refresh');

		// $this->session->set_flashdata('notification', 'New Staff Type Added successfully!');

		// $this->session->set_flashdata('status', 'success');
		// redirect(base_url().'boutique/stafftype', 'refresh');
	}
	public function removestafftype(){
		if($this->session->userdata('UserRole') == 5){
 				redirect(base_url().'login/', 'refresh');
 			 }
		$id = $this->uri->segment(3);
		$this->Tailor_model->m_removestafftype($id);
		$this->session->set_flashdata('notification', 'Staff Type Deleted!');
		$this->session->set_flashdata('status', 'danger');
		redirect(base_url().'boutique/stafftype', 'refresh');
	}
	public function sites(){
		$data["properties"] = $this->Billing_model->getproperties();
		$this->load->view('boutique/header');
		$this->load->view('boutique/sites',@$data);
		$this->load->view('boutique/footer');
	}

	public function incomedetails(){

		$id = $this->uri->segment(3);
	
		$data["properties"] = $this->Billing_model->getproperties();
	
		$data["expences"] = $this->Billing_model->getincomedetails($id);
		$data["expencecategory"] = $this->Billing_model->getexpencecategories();
		$this->load->view('boutique/header');
		$this->load->view('boutique/incomedetails',@$data);
		$this->load->view('boutique/footer');
	}
	public function updateincome(){
    	$data["properties"] = $this->Billing_model->getproperties();
	
		$this->Billing_model->updateincome();
		$this->session->set_flashdata('notification', 'Expence updated Sucessfully!');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url().'boutique/incomedetails/'.$this->input->post('boutique_expense_id'), 'refresh');
	}
	public function siteattendance($cid=''){
		// echo $cid;
		// $id = $this->uri->segment(3);
			$data["tailors"] = $this->Tailor_model->m_getalltailors();
			$data["properties"] = $this->Billing_model->getproperties();
			$data['current_property_id']=$cid;
		
		$this->load->view('boutique/header');
		$this->load->view('boutique/sites-attendance',@$data);
		$this->load->view('boutique/footer');
	} 
	
	public function updateattendance()
	{
		
		$this->Billing_model->addattendance();
		redirect(base_url() . 'boutique/siteattendance', 'refresh');
	

	}
	public function sitedetails()
	{
		$id = $this->uri->segment(3);
	
		$this->load->view('boutique/header');
		$this->load->view('boutique/sites-details',@$id);
		$this->load->view('boutique/footer');
		
	}
	public function emplyoeedetails()
	{
		$date = $this->uri->segment(4);
		$id = $this->uri->segment(3);
		$data["sheet"]=$this->Billing_model->salarysheet($date,$id);
		$data["properties"] = $this->Billing_model->getproperties();
		
		$this->load->view('billing/header');
		$this->load->view('boutique/updatesalary',@$data);
	
		$this->load->view('billing/footer');
	
	
	}
	public function updatsalary()
	{

	$this->Billing_model->addsalary();
	$date= $this->input->post('date');

	redirect(base_url() . 'boutique/emplyoeedetails/0/'.$date.'', 'refresh');
			
	}

	// Builders Demo Updates

	public function listitemstore()
	{
		
		$data["storeitemlist"] = $this->Billing_model->storeitemlist();
		
		$this->load->view('billing/header');
		$this->load->view('boutique/listitemstore',@$data);
		$this->load->view('billing/footer');
		
	}
	public function additemstore()
	{
		$this->load->view('billing/header');
		$this->load->view('boutique/additemstore');
		$this->load->view('billing/footer');
	}
	public function savestoreitem()
	{
		$this->Billing_model->addstoreitem();
		redirect(base_url() . 'boutique/listitemstore/', 'refresh');
			
	}
	public function removestoreitem()
	{
		$id = $this->uri->segment(3);
		$this->Billing_model->m_removestoreitem($id);
		$this->session->set_flashdata('notification', 'Item deleted!');
		$this->session->set_flashdata('status', 'danger');
		redirect(base_url() . 'boutique/listitemstore', 'refresh');
			
	}
	public function schedulework()
	{
	    $data["properties"] = $this->Billing_model->getproperties();

		// $data["others"] = $this->Billing_model->userlist_others();
		$data["others"] = $this->Billing_model->userlist_others();
	    
		$this->load->view('billing/header');
		$this->load->view('boutique/addschedulework',@$data);
		$this->load->view('billing/footer');	
	}
	public function savescheduledwork()
	{
		$this->Billing_model->addscheduledwork();
		redirect(base_url() . 'boutique/listschedulework/', 'refresh');
	}
	public function listschedulework()
	{
		$data["listschedulework"] = $this->Billing_model->listschedulework();
		$this->load->view('billing/header');
		$this->load->view('boutique/listscheduledworks',@$data);
		$this->load->view('billing/footer');
	}
	public function removesheduledwork()
	{
		$id = $this->uri->segment(3);
		$this->Billing_model->m_removesheduledwork($id);
		$this->session->set_flashdata('notification', 'Sheduled Work deleted!');
		$this->session->set_flashdata('status', 'danger');
		redirect(base_url() . 'boutique/listschedulework', 'refresh');
	}
	public function adduser(){

$data["properties"] = $this->Billing_model->getproperties();
		
		$this->load->view('boutique/header');
		$this->load->view('boutique/add-user',@$data);
		$this->load->view('boutique/footer');
	}
	public function userlist(){

		$data["userlist"] = $this->Billing_model->m_getalluserlist();
		$this->load->view('boutique/header');
		$this->load->view('boutique/userlist',@$data);
		$this->load->view('boutique/footer');
	}
	public function saveuser() 
	{
		$this->load->library('form_validation');
		$this->load->helper(array('cookie', 'admin'));
			
		$this->form_validation->set_rules('userusername', 'Username', 'required|is_unique[b_boutique_user.boutique_user_username]');
		
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('notification', 'Username already used.');
			$this->session->set_flashdata('status', 'fail');
			$data = $this->input->post();
			$this->session->set_flashdata('lolwut',$data);
			redirect(base_url().'boutique/adduser');

		} else {

// echo $_FILES['upload_image']['name'];
// echo $_FILES['upload_image'];
// var_dump($_FILES['upload_image']['name']);
// exit();
					if(@$_FILES['clothimg']['name']){
						@$image = @basename($_FILES['clothimg']['name']);
						@$extension  = strtolower(pathinfo($image,PATHINFO_EXTENSION));
						@$newfileName = time().rand()."." . $extension;
						$uploaddir = $this->config->item('project_path')."uploads/work/";
						$uploadfile = $uploaddir . $newfileName;
						if (@move_uploaded_file(@$_FILES['clothimg']['tmp_name'], $uploadfile)) {
						// $this->Work_model->m_addwork($newfileName);
						$image = $newfileName;

					}
					}
					else
					{
						$image = "";
					}

			
			if ($boutiqueid = $this->Billing_model->saveuser($image)){

				if($boutiqueid == 4)
				{
					$this->session->set_flashdata('notification', 'Supervisor added successfully.');
				}
				else
				{
					$this->session->set_flashdata('notification', 'Office added successfully.');
				}
				$this->session->set_flashdata('status', 'success');
				redirect(base_url().'boutique/userlist/');
			} else {
				// $this->session->set_flashdata('notification', 'Password changed failed.');
				// $this->session->set_flashdata('status', 'fail');
				return print_r(json_encode(array('status'=>'failure','msg' => 'User added failed.')));
			}
		}
	}
	public function removeuser()
	{
		if($this->session->userdata('UserRole') == 5){
 				redirect(base_url().'login/', 'refresh');
 			 }
		$id = $this->uri->segment(3);
		$this->Billing_model->m_removeuser($id);
		$this->session->set_flashdata('notification', 'Customer deleted!');
		$this->session->set_flashdata('status', 'danger');
		redirect(base_url().'boutique/userlist/', 'refresh');
	}
	public function purchase_request()
	{
		$this->load->view('boutique/header');
		$this->load->view('boutique/purchaserequest');
		$this->load->view('boutique/footer');
	}
	public function requestpm()
	{
		$this->Billing_model->sendrequest();
		$this->session->set_flashdata('notification', 'Request added successfully!');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url().'boutique/requestlist/', 'refresh');
	
	}
	public function requestlist()
	{
		if($this->session->userdata('UserRole') == 6) {
			$data["request"] = $this->Billing_model->requestlist();
		}
		else{
			$data["request"] = $this->Billing_model->requestlist();
		}
		$this->load->view('boutique/header');
		$this->load->view('boutique/requestlist',@$data);
		$this->load->view('boutique/footer');
	}
	public function requestupdates()
	{
		$id = $this->uri->segment(3);
		$data["updateinfo"] = $this->Billing_model->updateinfo($id);
		$this->load->view('boutique/header');
		$this->load->view('boutique/requestupdates',@$data);
		$this->load->view('boutique/footer');	
	}
	public function updateqa()
	{
		$this->Billing_model->requestaccept();
		// $this->session->set_flashdata('notification', 'Request Accept!');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url().'boutique/requestlist/', 'refresh');	
	}
	public function updatepurchase()
	{
		$this->Billing_model->requestaccept();
		// $this->session->set_flashdata('notification', 'Request Accept!');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url().'boutique/requestlist/', 'refresh');		
	}
	public function updateaccount()
	{
		$this->Billing_model->requestaccept();
		// $this->session->set_flashdata('notification', 'Request Accept!');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url().'boutique/requestlist/', 'refresh');		
	
	}
	public function purchase_requestflow()
	{
		$data["request"] = $this->Billing_model->allrequestlist();
		$this->load->view('boutique/header');
		$this->load->view('boutique/purchase_requestflow',@$data);
		$this->load->view('boutique/footer');
				
	}
	public function updaterequest()
	{
		$this->Billing_model->updaterequest();
		// $this->session->set_flashdata('notification', 'Request Accept!');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url().'boutique/requestlist/', 'refresh');		
	}
	public function viewrequest()
	{
		$id = $this->uri->segment(3);
		$data["updateinfo"] = $this->Billing_model->updateinfo($id);
		$this->load->view('boutique/header');
		$this->load->view('boutique/viewrequest',@$data);
		$this->load->view('boutique/footer');			
	}
	public function addpettycash()
	{
		$data["properties"] = $this->Billing_model->getproperties();
		// $data["projectengineer"] = $this->Billing_model->getprojectengineer();
		$data["projectengineer"] = $this->Billing_model->getallsupervisior();
		
		// var_dump($data["projectengineer"]);
		
		$this->load->view('boutique/header');
		$this->load->view('boutique/addpettycash',@$data);
		$this->load->view('boutique/footer');
		
	}
	public function listcash()
	{
		// $id = $this->uri->segment(3);
	
		$data["expences"] = $this->Billing_model->getpettycashlist();
		$this->load->view('boutique/header');
		$this->load->view('boutique/pettycashlist',@$data);
		$this->load->view('boutique/footer');
	}
	public function stocklist()
	{
		$data["stock"] = $this->Billing_model->getstocklist();		
		$this->load->view('boutique/header');
		$this->load->view('boutique/stocklist',@$data);
		$this->load->view('boutique/footer');	
	}
	public function addstock()
	{
		$this->load->view('boutique/header');
		$this->load->view('boutique/addstock');
		$this->load->view('boutique/footer');		
	}
	public function savestock()
	{
		$this->Billing_model->savestock();
		$this->session->set_flashdata('notification', 'Item Added!');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url().'boutique/stocklist/', 'refresh');				
	}
	public function removestock()
	{
		$id = $this->uri->segment(3);
		$this->Billing_model->m_removestock($id);
		$this->session->set_flashdata('notification', 'Stock deleted!');
		$this->session->set_flashdata('status', 'danger');
		redirect(base_url() . 'boutique/stocklist', 'refresh');
			
	}
	public function additemtransferedtosite()
	{
	
		$data["properties"] = $this->Billing_model->getproperties();
		$this->load->view('billing/header');
		$this->load->view('boutique/addsiteitemstransfer',@$data);
		$this->load->view('billing/footer');			
	}
	//Transfered item list in Site
	public function itemtransferedlist()
	{
		$data["sales"] = $this->Billing_model->getsales();
		$this->load->view('billing/header');
		$this->load->view('billing/sales',@$data);
		$this->load->view('billing/footer');
	}
	public function viewtransferlist()
	{
		$id = $this->uri->segment(3);
		$data["sale"] = $this->Billing_model->m_getsaledetails($id);
		$data["saleitems"] = $this->Billing_model->m_getallsaleitems($id);
	
		// var_dump($data["sale"]["boutique_sale_date"]);
		// exit(0);

		$this->load->view('boutique/header');
		$this->load->view('boutique/viewtransferlist',@$data);
		$this->load->view('boutique/footer');
	}
	public function viewscheduledwork()
	{
		$id = $this->uri->segment(3);
		$data["schedulework"] = $this->Billing_model->listschedulework($id);
		$data["properties"] = $this->Billing_model->getproperties();
	
		$this->load->view('boutique/header');
		$this->load->view('boutique/viewscheduledwork',@$data);
		$this->load->view('boutique/footer');	
	}
	public function updatesheduledwork()
	{
		$this->Billing_model->updatesheduledwork();
		$this->session->set_flashdata('notification', 'scheduled Work updated Sucessfully!');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url().'boutique/listschedulework/', 'refresh');
	}
	public function updatestock()
	{
		$id = $this->uri->segment(3);
		$data["updatestock"] = $this->Billing_model->getstocklist($id);
		$this->load->view('boutique/header');
		$this->load->view('boutique/updatestock',@$data);
		$this->load->view('boutique/footer');		
	}
	public function updatestocksitems()
	{
		$this->Billing_model->updatestockitem();
		$this->session->set_flashdata('notification', 'Stock updated Sucessfully!');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url().'boutique/stocklist/', 'refresh');
	}
	public function day_summary()
	{
		
		// echo $date;
		// exit(0);
		$id = $this->uri->segment(3);
	if($id == NULL)
	{
		$date = date('d-m-Y');
		$data["expences"] = $this->Billing_model->getdayexpences($date);
		$data["income"] = $this->Billing_model->getdayincomes($date);
		$data["listschedulework"] = $this->Billing_model->listdayschedulework($date);
		$data["sales"] = $this->Billing_model->getdaysales($date);
		$data["request"] = $this->Billing_model->alldayrequestlist($date);
	
		
	}
	else
	{
		// $id= 
		$id = explode("-", $id);
		$id = $id[0]."/".$id[1]."/".$id[2];
// echo $id;
// exit(0);

		$data["expences"] = $this->Billing_model->getdayexpences($id);
		$data["income"] = $this->Billing_model->getdayincomes($id);
		$data["listschedulework"] = $this->Billing_model->listdayschedulework($id);
		$data["sales"] = $this->Billing_model->getdaysales($id);
		$data["request"] = $this->Billing_model->alldayrequestlist($id);
	
	}
		
		$this->load->view('boutique/header');
		$this->load->view('boutique/day_summary',@$data);
		$this->load->view('boutique/footer');		
	}

	public function userprojects()
	{
		$data["projects"] = $this->Billing_model->selectallprojects();
		// var_dump($data["projects"]);
		$this->load->view('boutique/header');
		$this->load->view('boutique/view-projects',@$data);
		$this->load->view('boutique/footer');		
	
	}
	public function updatescheduledwork()
	{
		$id = $this->uri->segment(3);
		$data["schedulework"] = $this->Billing_model->listschedulework($id);
		$data["properties"] = $this->Billing_model->getproperties();
	
		$this->load->view('boutique/header');
		$this->load->view('boutique/update-user-scheduledwork',@$data);

		// $this->load->view('boutique/viewscheduledwork',@$data);
		$this->load->view('boutique/footer');	
	}
	public function updatesheduledworkuser()
	{
		$this->Billing_model->updatesheduledworkuser();
		$this->session->set_flashdata('notification', 'scheduled Work updated Sucessfully!');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url().'boutique/userprojects/', 'refresh');		
	}
	// public function rejectrequest()
	// {
	// 	$id = $this->uri->segment(3);
	// 	$this->Billing_model->rejectpmrequest($id);
		
	// }

	// 09 Sept
	public function applyleave()
	{

		$this->load->view('boutique/header');
		$this->load->view('boutique/Apply-Leave');
		$this->load->view('boutique/footer');	
	
	}
	public function saveleave()
	{
		$this->Billing_model->saveleave();
		$this->session->set_flashdata('notification', 'Leave Added Sucessfully!');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url().'boutique/listleave/', 'refresh');		
	}
	public function listleave()
	{
		$data["leave"] = $this->Billing_model->getallleave();
		$this->load->view('boutique/header');
		$this->load->view('boutique/List-Leave',@$data);
		$this->load->view('boutique/footer');	
		
	}
	public function leave_applications()
	{
		$data["leave"] = $this->Billing_model->getallleave_admin();
		$this->load->view('boutique/header');
		$this->load->view('boutique/Admin-List-Leave',@$data);
		$this->load->view('boutique/footer');	
	}
	public function update_admin_leave()
	{
		$id = $this->uri->segment(3);
	
		$data["leave"] = $this->Billing_model->getcurrent_leave($id);
		$this->load->view('boutique/header');
		$this->load->view('boutique/Admin-view-Leave',@$data);
		$this->load->view('boutique/footer');	
		
	}
	public function updateadminleave()
	{
		$this->Billing_model->updateadminleave();
		$this->session->set_flashdata('notification', 'Leave Updated Sucessfully!');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url().'boutique/leave_applications/', 'refresh');				
	}
	public function update_leave()
	{
		$id = $this->uri->segment(3);
	
		$data["leave"] = $this->Billing_model->getcurrent_leave($id);

		$this->load->view('boutique/header');
		$this->load->view('boutique/update-view-Leave',@$data);
		$this->load->view('boutique/footer');	

	}
	public function updateleave()
	{
		$this->Billing_model->updateleave();
		$this->session->set_flashdata('notification', 'Leave Updated Sucessfully!');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url().'boutique/listleave/', 'refresh');					
	}
	public function remove_delete()
	{
		$id = $this->uri->segment(3);
	
		$this->Billing_model->removeleave($id);
		$this->session->set_flashdata('notification', 'Leave Deleted Sucessfully!');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url().'boutique/leave_applications/', 'refresh');						
	}
	public function print_income_bill()
	{
		$id = $this->uri->segment(3);

		$builder_details = $this->Billing_model->builders_derails($this->session->userdata('UserID'));
	
		$expences = $this->Billing_model->getincomedetails($id);
		$properties = $this->Billing_model->getpropertydetails($expences["boutique_property"]);

		// var_dump($expences);
		// exit();
		
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
		$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
			require_once(dirname(__FILE__) . '/lang/eng.php');
			$pdf->setLanguageArray($l);
		}

		// ---------------------------------------------------------

		// set font
		$pdf->SetFont('helvetica', '', 10);


		$pdf->SetPrintHeader(false);
		$pdf->SetPrintFooter(false);

		$pdf->AddPage();

		$logo =	'<img height="80" width="210" src="">';


		// Set some content to print
		$html = '		
			<div>
				<table width="100%" cellpadding="5" cellspacing="0" bordercolor="#cccccc">
					<tr>
						<td></td>
						<td></td>
						<td style="text-align:right; font-size:14px">'.$builder_details["boutique_name"].'</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td style="text-align:right; font-size:10px">'.$builder_details["boutique_address"].'</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td style="text-align:right; font-size:10px"><b>E-mail:</b>'.$builder_details["boutique_email"].'</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td style="text-align:right; font-size:10px"><b>Phone:</b>'.$builder_details["boutique_ph"].'</td>
					</tr>

				</table>
				<hr>
			</div>
			<div>	
			From;
			</div>
			<div>
				<table width="100%" cellpadding="3" cellspacing="0" bordercolor="#cccccc">
					<tr>
						<td width="2%"></td>
						<td><b>'.$properties["b_boutique_subheader"].'</b></td>
					</tr>
					<tr>
						<td width="2%"></td>
						<td>'.$properties["boutique_property_name"].'</td>
					</tr>
					<tr>
						<td width="2%"></td>
						<td>'.$properties["b_boutique_header"].'</td>
					</tr>
					<tr>
						<td width="2%"></td>
						<td>'.$properties["b_boutique_phone"].'</td>
					</tr>
				</table>
			</div>

			<div>
				<table border="1" width="100%" cellpadding="6" cellspacing="2" style=" background-color:grey" bordercolor="#cccccc">
					<tr>
						<th><b style="text-align:center">Date</b></th>
						<td>'.$expences["boutique_expense_date"].'</td>
					</tr>
					<tr>
						<th><b style="text-align:center">Head</b></th>
						<td>'.$expences["boutique_billing_head_name"].'</td>
					</tr>
					<tr>
						<th><b style="text-align:center">Amount</b></th>
						<td>'.$expences["boutique_expense_amount"].'</td>
					</tr>
				</table>
			</div>
		';
		// Print text using writeHTMLCell()
		$pdf->writeHTML($html, true, false, true, false, '');

		// ---------------------------------------------------------

		// Close and output PDF document
		// This method has several options, check the source code documentation for more information.
		$pdf->Output(time() . '.pdf', 'I');

		//============================================================+
		// END OF FILE
		//============================================================+

	}
	public function user_dashboard()
	{
		$this->load->view('boutique/header');
		$this->load->view('boutique/dashboard');
		$this->load->view('boutique/footer');

	}
	public function userlist_others()
	{
		$data["userlist"] = $this->Billing_model->m_getalluserlist_others();

		$this->load->view('boutique/header');
		$this->load->view('boutique/userlist-others',@$data);
		$this->load->view('boutique/footer');
	}
	public function userprojectdetails()
	{
		$id = $this->uri->segment(3);

		$data["listschedulework"] = $this->Billing_model->listschedulework_person($id);
		$this->load->view('billing/header');
		$this->load->view('boutique/listscheduledworks',@$data);
		$this->load->view('billing/footer');

	}
	public function apply_payment_request()
	{
		$this->load->view('boutique/header');
		$this->load->view('boutique/Apply-payment-request');
		$this->load->view('boutique/footer');		
	}
	public function savepaymentrequest()
	{
		$this->Billing_model->savepaymentrequest();
		$this->session->set_flashdata('notification', 'Payment Request Added Sucessfully!');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url().'boutique/list_payment_request/', 'refresh');		
	}
	public function list_payment_request()
	{
		$data["payment"] = $this->Billing_model->getallpaymentrequest();
		$this->load->view('boutique/header');
		$this->load->view('boutique/List-Payment-Request',@$data);
		$this->load->view('boutique/footer');			
	}
	public function update_request()
	{
		$id = $this->uri->segment(3);
		$data["payment"] = $this->Billing_model->getallpaymentrequest_details($id);

		$this->load->view('boutique/header');
		$this->load->view('boutique/update-Payment-Request',@$data);
		$this->load->view('boutique/footer');			

	}
	public function updatepaymentrequest()
	{
		$this->Billing_model->updatepaymentrequest();
		$this->session->set_flashdata('notification', 'Payment Request Updated!');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url().'boutique/list_payment_request/', 'refresh');		

	}
	public function payment_requests()
	{
		$data["payment"] = $this->Billing_model->allgetallpaymentrequest();
		$this->load->view('boutique/header');
		$this->load->view('boutique/List-admin-Payment-Request',@$data);
		$this->load->view('boutique/footer');			
	}
	public function update_admin_payment()
	{
		$id = $this->uri->segment(3);
		$data["payment"] = $this->Billing_model->getallpaymentrequest_details($id);

		$this->load->view('boutique/header');
		$this->load->view('boutique/Admin-update-Payment-Request',@$data);
		$this->load->view('boutique/footer');			

	}
	public function updateadminpayment()
	{
		$this->Billing_model->updateadminpayment();
		$this->session->set_flashdata('notification', 'Payment Request Updated Successfully!');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url().'boutique/payment_requests/', 'refresh');				
	}
	public function remove_delete_payment_request()
	{
		$id = $this->uri->segment(3);
	
		$this->Billing_model->remove_delete_payment_request($id);
		$this->session->set_flashdata('notification', 'Payment Request Deleted Sucessfully!');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url().'boutique/payment_requests/', 'refresh');						

	}
	
		public function pettycashlist()
	{
		$data["pettycashlist"] = $this->Billing_model->getallpettycashlist();
		$this->load->view('boutique/header');
		$this->load->view('boutique/petty-cash-list',@$data);
		$this->load->view('boutique/footer');			
	}
}
