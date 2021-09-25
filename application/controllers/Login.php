<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
  }

	public function index()
	{
		$this->load->view('login');
        
	}

	public function login() {
      $this->load->library('form_validation');
      $this->load->helper(array('cookie', 'admin'));
      $this->form_validation->set_rules('UserEmail', 'Username', 'required');
      $this->form_validation->set_rules('UserPwd', 'Password', 'required');

      if ($this->form_validation->run() == FALSE) {
          return print_r(json_encode(array('status'=>'failure','msg' => 'You must enter a valid username and password.')));
      } else {
          $user_email = format_input($this->input->post('UserEmail'));
          $user_password = crypt_password($this->input->post('UserPwd'));
          if ($v_arr = $this->Boutique->login($user_email,$user_password)) {
              return print_r(json_encode(array('status'=>'success','msg' => 'Loged in success.','role' =>$v_arr->boutique_user_role)));
          } else {
              return print_r(json_encode(array('status'=>'failure','msg' => 'You must enter a valid username and password.')));
          }
      }
  }

  public function logout() {
        $this->Boutique->logout();
        redirect(base_url()."login");
  }
  public function check()
  {
    $this->load->helper(array('cookie', 'admin'));
      echo crypt_password("abcdefgh");
  }

}
