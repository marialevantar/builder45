<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gantchartbuilders extends CI_Controller {

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
              $this->load->model('Gantchart_model');

			 $this->load->helper(array('cookie', 'admin'));
 			 
 			 $this->load->library('zend');
        	 $this->zend->load('Zend/Barcode');

 			if (!$this->session->userdata('UserID')) {
				redirect(base_url() . 'login/', 'refresh');
			}
 			 
  	}
	  function addChartSuccessorDependency($id)
	  {
	  
		  
		  $data = $this->Gantchart_model->getSuccessorData($id);
		  $array = array();
		  foreach($data as $content)
		  {
			  $array[] = $content['builders_task_id'];
		  }
		  
		  return $array;
	  }
function displaychart() 
{
	
	
	$project_id = $this->uri->segment(3);
		
    $data = $this->Gantchart_model->getdata($project_id);

    $i=0;
    foreach($data as $content)
    {
        $start_date =  (strtotime($content["builders_start_date"])*1000)+86400000;
        $end_date =  (strtotime($content["builders_end_date"])*1000)+86400000;
        $task = $content["builders_task_name"];
        $assignee_name = $content["boutique_property_name"];
        $id = $content["builders_task_id"];
        
		$predecessorDependency = $content["builders_task_predecessor_id"];  
		$successorDependency = $this->addChartSuccessorDependency($id); 
		
		$dependency = $successorDependency;
		array_push($dependency, $predecessorDependency);
       
        $content_array = array('start'=>$start_date,'end' => $end_date, 'name'=>$task, 'id'=>$id,'dependency'=>$dependency , 'y'=> $i);
        $array[] =$content_array;
        $i++;
    }

	$data["content"] =  json_encode($array);
	$data["properties"] = $this->Billing_model->getproperties();
  
    $this->load->view('boutique/header');
    $this->load->view('builders/gantchart',@$data);
    $this->load->view('boutique/footer');

}
public function addchartcontent()
{

    $data["properties"] = $this->Billing_model->getproperties();

	$data["tasks"] = $this->Gantchart_model->getdata();
   

    $this->load->view('boutique/header');
    $this->load->view('builders/input-chart',@$data);
    $this->load->view('boutique/footer');
}
public function savechartdetails()
{
    $this->Gantchart_model->addchartcontent();
    redirect(base_url() . 'Gantchartbuilders/displaychart', 'refresh');
}
public function viewtask()
{
    $data["tasks"] = $this->Gantchart_model->getdata();
    $this->load->view('boutique/header');
    $this->load->view('builders/view-task',@$data);
    $this->load->view('boutique/footer');
        
}
public function removetask()
{
    
		$id = $this->uri->segment(3);
		$orderid = $this->Gantchart_model->remove_task($id);
		$this->session->set_flashdata('notification', 'Task deleted!');
		$this->session->set_flashdata('status', 'danger');
		redirect(base_url() . 'Gantchartbuilders/viewtask/', 'refresh');
	
}


}
