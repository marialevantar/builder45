<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
		
		$this->load->model('Boutique');
		
		if(!$this->session->userdata('UserID') || $this->session->userdata('UserRole') != 1){
 				redirect(base_url().'login/', 'refresh');
 		}
	   
  	}

	public function index()	{
		/*
		$data['teams_count'] = count($this->Team->getActiveTeams());
		$data['newteams_count'] = count($this->Team->getInactiveTeams());
		$data['rejected_count'] = count($this->Team->getRejectedTeams());
		*/
		$this->load->view('header');
		$this->load->view('dashboard',@$data);
		$this->load->view('footer');
	}

	public function profile() {
		$user_id = $this->session->userdata('UserID');
		$data['userdata'] = $this->Team->getUserbyId($user_id);
		$this->load->view('header');
		$this->load->view('profile',$data);
		$this->load->view('footer');
	}

	public function updateprofile() {
		// $email = $this->input->post('useremail');
		// $old_p = $this->input->post('oldpwd');
		// $new_p = $this->input->post('newpwd');

//		$this->load->library('form_validation');
		$this->load->helper(array('cookie', 'admin'));
		    $user_email = format_input($this->input->post('useremail'));
		    $old_p = crypt_password($this->input->post('oldpwd'));
		    $new_p = crypt_password($this->input->post('newpwd'));
		    if ($this->Team->checkUser($old_p)) {
		    	$this->Team->UpdateProfile($user_email,$new_p);
		        $this->session->set_flashdata('notification', 'Updated successfully');
		        $this->session->set_flashdata('status', 'success');
		    } else {
		       // return print_r(json_encode(array('status'=>'failure','msg' => 'You must enter a valid email address and password.')));
		    	$this->session->set_flashdata('notification', 'You must enter a valid email address and password.');
		    	$this->session->set_flashdata('status', 'fail');
		    }
			redirect('dashboard/profile','refresh');
	}
}
