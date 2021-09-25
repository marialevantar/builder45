<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	 public function __construct() {
 			 parent::__construct();
 			 $this->load->library('session');
 			 $this->load->database();
 			 
 			 $this->load->model('Boutique');
 			 //$this->load->library('Zebra_Image');
			 $this->load->helper(array('cookie', 'admin'));
 			 if(!$this->session->userdata('UserID') || $this->session->userdata('UserRole') != 1){
 				redirect(base_url().'login/', 'refresh');
 			 }
 			 
  }

	public function index()
	{
		$data['teamDatas'] = $this->Team->getAllTeams();
		$this->session->set_userdata('filter','');
		$this->load->view('header');
		$this->load->view('teams',$data);
		$this->load->view('footer');
	}

	public function boutiques()
	{
		$data['boutiqueDatas'] = $this->Boutique->getAllBoutiques();
		$this->session->set_userdata('filter','');

		$this->load->view('header');
		$this->load->view('boutiques',@$data);
		$this->load->view('footer');
	}

	public function boutiquedetails()
	{
		$boutique_id = $this->uri->segment(3);
		$data['boutiquedetails'] = $this->Boutique->getBoutique($boutique_id);
		$data['boutiqueadmin'] = $this->Boutique->getBoutiqueAdmin($boutique_id);
		$data['boutiquetailor'] = $this->Boutique->getBoutiqueTailor($boutique_id);
		$this->load->view('header');
		$this->load->view('boutique-details',@$data);
		$this->load->view('footer');
	}

	public function addboutique()
	{
		$this->load->view('header');
		$this->load->view('add-boutique',@$data);
		$this->load->view('footer');
	}

	  // --------------- save boutique --------------------------------------------
	public function saveboutique() {
			$this->load->library('form_validation');
			$this->load->helper(array('cookie', 'admin'));
			//print_r($this->input->post())		;
				
			$this->form_validation->set_rules('adminusername', 'Admin Username', 'required|is_unique[b_boutique_user.boutique_user_role]');
			
			$this->form_validation->set_rules('tailorusername','Tailor Username', 'required|is_unique[b_boutique_user.boutique_user_role]');
			
			if($this->input->post('adminusername') == $this->input->post('tailorusername')){
				$this->session->set_flashdata('notification', 'Admin and Tailor login should be unique');
				$this->session->set_flashdata('status', 'fail');
				$data = $this->input->post();
				$this->session->set_flashdata('lolwut',$data);
				redirect(base_url().'admin/addboutique');
			}

			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('notification', 'Admin and Tailor login should be unique');
				$this->session->set_flashdata('status', 'fail');
				$data = $this->input->post();
				$this->session->set_flashdata('lolwut',$data);
				redirect(base_url().'admin/addboutique');

			} else {
				if(@$_FILES['boutique_logo']['name']){
					@$image = @basename($_FILES['boutique_logo']['name']);
					@$extension  = strtolower(pathinfo($image,PATHINFO_EXTENSION));
					@$newfileName = time().rand()."." . $extension;
					$uploaddir = $this->config->item('project_path')."uploads/logo/";
					$uploadfile = $uploaddir . $newfileName;
					if (@move_uploaded_file(@$_FILES['boutique_logo']['tmp_name'], $uploadfile)) {
						
					}
				}
				else{
					$newfileName = '';
					
				}

				if ($boutiqueid = $this->Boutique->saveboutique($newfileName)){
					$this->session->set_flashdata('notification', 'Boutique added successfully.');
				    $this->session->set_flashdata('status', 'success');
				    redirect(base_url().'admin/boutiquedetails/'.$boutiqueid);
				} else {
					// $this->session->set_flashdata('notification', 'Password changed failed.');
					// $this->session->set_flashdata('status', 'fail');
					return print_r(json_encode(array('status'=>'failure','msg' => 'Boutique added failed.')));
				}
			}
	}
      //--------------------------------------------------------------------------

	public function updateboutiquedetails()
	{				
					if(@$_FILES['boutique_logo']['name']){
						@$image = @basename($_FILES['boutique_logo']['name']);
						@$extension  = strtolower(pathinfo($image,PATHINFO_EXTENSION));
						@$newfileName = time().rand()."." . $extension;
						$uploaddir = $this->config->item('project_path')."uploads/logo/";
						$uploadfile = $uploaddir . $newfileName;
						if (@move_uploaded_file(@$_FILES['boutique_logo']['tmp_name'], $uploadfile)) {
							
						}
					}
					else{
						$newfileName = $this->input->post('boutique_logo_old');
					}

					$this->Boutique->updateboutique($newfileName);
					$backlink = base_url()."admin/boutiquedetails/".$this->uri->segment(3);
					$this->session->set_flashdata('notification', 'Boutique Updated successfully!');
					$this->session->set_flashdata('status', 'success');
					redirect($backlink);	
	}



	public function measurements()
	{
		$this->load->view('header');
		$this->load->view('measurements',@$data);
		$this->load->view('footer');
	}

	public function addmeasurement()
	{
		$this->load->view('header');
		$this->load->view('add-measurement',@$data);
		$this->load->view('footer');
	}

	public function measurementdetails()
	{
		$this->load->view('header');
		$this->load->view('measurement-details',@$data);
		$this->load->view('footer');
	}
	
	public function filter()
	{
		$status = -1;
		$filter_string = $this->uri->segment(3);
		if($filter_string == "new"):
			$status = 0;
			$this->session->set_userdata('filter','new');
		endif;
		if($filter_string == "active"):
			$status = 1;
			$this->session->set_userdata('filter','active');
		endif;
		if($filter_string == "rejected"):
			$status = 2;
			$this->session->set_userdata('filter','rejected');
		endif;
		$data['teamDatas'] = $this->Team->getFilterTeams($status);
		$this->load->view('header');
		$this->load->view('teams',$data);
		$this->load->view('footer');
	}

	public function deleteboutique(){

		$delid = $this->uri->segment(3);
		$this->Boutique->trashBoutique($delid);
		
		$backlink = base_url()."admin/boutiques";
		$this->session->set_flashdata('notification', 'Boutique moved to trash!');
		$this->session->set_flashdata('status', 'success');
		redirect($backlink);
	}

	// --------------- update pwd --------------------------------------------
	public function updatepassword() {
			$this->load->library('form_validation');
			$this->load->helper(array('cookie', 'admin'));
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'required|matches[password]');

			if ($this->form_validation->run() == FALSE) {
				// $this->session->set_flashdata('notification', 'Password and Confirm Password Should Match');
				// $this->session->set_flashdata('status', 'fail');
				return print_r(json_encode(array('status'=>'failure','msg' => 'Password and Confirm Password Should Match')));
			} else {
				$user_password = crypt_password($this->input->post('password'));
				$adminId = $this->input->post('boutique_admin_id');
				if ($this->Boutique->updatepassword($user_password,$adminId)){
					// $this->session->set_flashdata('notification', 'Password changed successfully.');
					// $this->session->set_flashdata('status', 'success');
					return print_r(json_encode(array('status'=>'success','msg' => 'Password changed successfully.')));
				} else {
					// $this->session->set_flashdata('notification', 'Password changed failed.');
					// $this->session->set_flashdata('status', 'fail');
					return print_r(json_encode(array('status'=>'failure','msg' => 'Password changed failed.')));
				}
			}
	}
      //--------------------------------------------------------------------------

	// --------------- update pwd --------------------------------------------
	public function updatetailorpassword() {
			$this->load->library('form_validation');
			$this->load->helper(array('cookie', 'admin'));
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'required|matches[password]');

			if ($this->form_validation->run() == FALSE) {
				// $this->session->set_flashdata('notification', 'Password and Confirm Password Should Match');
				// $this->session->set_flashdata('status', 'fail');
				return print_r(json_encode(array('status'=>'failure','msg' => 'Password and Confirm Password Should Match')));
			} else {
				$user_password = crypt_password($this->input->post('password'));
				$tailorId = $this->input->post('boutique_tailor_id');
				if ($this->Boutique->updateTailorpassword($user_password,$tailorId)){
					// $this->session->set_flashdata('notification', 'Password changed successfully.');
					// $this->session->set_flashdata('status', 'success');
					return print_r(json_encode(array('status'=>'success','msg' => 'Password changed successfully.')));
				} else {
					// $this->session->set_flashdata('notification', 'Password changed failed.');
					// $this->session->set_flashdata('status', 'fail');
					return print_r(json_encode(array('status'=>'failure','msg' => 'Password changed failed.')));
				}
			}
	}
      //--------------------------------------------------------------------------

	public function smsreports(){
		$data["date_from_report"] = $this->input->post('date_from_report');
		$data["date_to_report"] = $this->input->post('date_to_report');
		$data["smsreports"] = $this->Boutique->getsmsreports();

		$this->load->view('header');
		$this->load->view('smsreports',@$data);
		$this->load->view('footer');
	}
}
