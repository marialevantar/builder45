<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estimattebudget extends CI_Controller {

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
		$this->load->model('Budget_model');


		//$this->load->model('Team');
		//$this->load->library('Zebra_Image');
		$this->load->helper(array('cookie', 'admin'));

		if (!$this->session->userdata('UserID')) {
			redirect(base_url() . 'login/', 'refresh');
		}
	}
	public function description_head()
	{
        $data["heades"] = $this->Budget_model->m_getallheades();
        $this->load->view('boutique/header');
		$this->load->view('estimatebudget/description-head',@$data);
		$this->load->view('estimatebudget/footer');
    }

    public function description_subhead()
	{
        $data["heades"] = $this->Budget_model->m_getallheades();

        $data["subheades"] = $this->Budget_model->m_getallsubheades();
        
        $this->load->view('boutique/header');
		$this->load->view('estimatebudget/description-subhead',@$data);
		$this->load->view('estimatebudget/footer');
    }

    public function saveheadtitle()
    {
        $orderId = $this->Budget_model->saveheadtitle();
        if($orderId)
        {
            $this->session->set_flashdata('notification', 'New Work added successfully!');
            $this->session->set_flashdata('status', 'success');    
        }
        redirect(base_url() . 'Estimattebudget/description_head/', 'refresh');	
    }

    public function savesubheadtitle()
    {
        $orderId = $this->Budget_model->savesubheadtitle();
        if($orderId)
        {
            $this->session->set_flashdata('notification', 'New Work added successfully!');
            $this->session->set_flashdata('status', 'success');    
        }
        redirect(base_url() . 'Estimattebudget/description_subhead/', 'refresh');	
    }

    public function addproject()
    {
        $data["heades"] = $this->Budget_model->m_getallheades();
        $data["properties"] = $this->Billing_model->getproperties();
		
        if($this->uri->segment(3)!= NULL)
        {
            $subheaderid = $this->uri->segment(3);
            $property_id = $this->uri->segment(4);
            $data["subheades"] = $this->Budget_model->get_subheaders($subheaderid,$property_id);           
        }
        else
        {
            $data["subheades"] = "";          
        }

        $this->load->view('boutique/header');
		$this->load->view('estimatebudget/addproject',@$data);
		$this->load->view('estimatebudget/footer');        
    } 
    public function saveprojectestimate()
    {
        $projectId = $this->Budget_model->saveprojectestimate();
        redirect(base_url() . 'Estimattebudget/listprojects/', 'refresh');	
    }
    public function listprojects()
    {
        $data["projects"] = $this->Budget_model->m_getallprojectdetails();
        $this->load->view('boutique/header');
		$this->load->view('estimatebudget/addprojectlist',@$data);
		$this->load->view('estimatebudget/footer');            
    }
    public function editproject()
    {
        $id=$this->uri->segment(3);
        $data["projects"] = $this->Budget_model->m_getcurrentproject($id);
    //    var_dump($data["projects"]);
    //    exit(0);
        $this->load->view('boutique/header');
		$this->load->view('estimatebudget/editproject',@$data);
		$this->load->view('estimatebudget/footer');                        
    }
    public function editprojectestimate()
    {
        $projectId = $this->Budget_model->updateprojectestimate();
        redirect(base_url() . 'Estimattebudget/listprojects/', 'refresh');	    
    }
    public function pdfcreation()
    {
        $id=$this->uri->segment(3);
        // $data["estimatebill"] = $this->Budget_model->m_getgetestimatebillproperty($id);    
    
        //    var_dump($data["estimatebill"]);
        $data["id"]=$id;
        // exit(0);
    	$this->load->view('estimatebudget/pdfgenerattor_estimate',@$data);                            
    }
    public function removesubheader()
    {
        $id=$this->uri->segment(3);
        $this->Budget_model->removesubheader($id);
		$this->session->set_flashdata('notification', 'Subheader deleted!');
		$this->session->set_flashdata('status', 'danger');
		redirect(base_url().'estimattebudget/description_subhead/', 'refresh');
    }
    public function removeheader()
    {
        $id=$this->uri->segment(3);
        $this->Budget_model->removeheader($id);
		$this->session->set_flashdata('notification', 'header deleted!');
		$this->session->set_flashdata('status', 'danger');
		redirect(base_url().'estimattebudget/description_head/', 'refresh');
    }
    public function removeproject()
    {
        $id=$this->uri->segment(3);
        $this->Budget_model->removebudget($id);
		$this->session->set_flashdata('notification', 'Budget deleted!');
		$this->session->set_flashdata('status', 'danger');
		redirect(base_url().'estimattebudget/listprojects/', 'refresh');
        
    }
}
