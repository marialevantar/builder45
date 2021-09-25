<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tailor extends CI_Controller {

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
 			 
 			 $this->load->model('Tailors');
 			 $this->load->model('Tailor_model');
 			 $this->load->model('Customer_model');
 			 $this->load->model('Work_model');
 			 //$this->load->library('Zebra_Image');
			 $this->load->helper(array('cookie', 'admin'));
 			 
 			 if(!$this->session->userdata('UserID') || $this->session->userdata('UserRole') != 3){
 				redirect(base_url().'login/', 'refresh');
 			 }
 			 
  }

	public function dashboard(){
 		$data['work_count'] = $this->Tailors->workCount($this->session->userdata('BoutiqueID'));
		$this->load->view('tailor/header');
		$this->load->view('tailor/dashboard',@$data);
		$this->load->view('tailor/footer');
	}

	public function works(){
		
 		$data['works'] = $this->Tailors->getBoutiqueWorks($this->session->userdata('BoutiqueID'));
		$this->load->view('tailor/header');
		$this->load->view('tailor/works',@$data);
		$this->load->view('tailor/footer');
	}
	
	public function workdetails()
	{	
		
 		$data['work'] = $this->Tailors->getBoutiqueSingleWork($this->uri->segment(3));
 		$data["measurement"] = $this->getAllmeasurements($data['work']->boutique_customer_id);
		$this->load->view('tailor/header');
		$this->load->view('tailor/work-details',@$data);
		$this->load->view('tailor/footer');
	}

	public function getAllmeasurements($id) {


		$measurement_array =  $this->Customer_model->m_getmeasurements($id);
		$i = 0;
		$m_array = array();
		foreach($measurement_array as $key => $value) {
			if($value) {
				$m_array[$measurement_array[$i]["b_customer_measurement_key"]] = $measurement_array[$i]["b_customer_measurement_value"];
				$i++;
			}
		}
		return $m_array;
	}

	public function updateWorkDetails(){

 		$this->Tailors->updateWorkDetails();
		$backlink = base_url()."tailor/workdetails/".$this->uri->segment(3);
		$this->session->set_flashdata('notification', 'Work Updated successfully!');
		$this->session->set_flashdata('status', 'success');
		redirect($backlink);

	}
}
