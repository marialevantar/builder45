<?php
class Gantchart_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getdata($id=NULL)
    {
        $this->db->select('*');
		$this->db->from('builders_project_tasks bgh');
        $this->db->join('b_boutique_properties bp', 'bp.boutique_property_id = bgh.builders_project_id','full');
        if(@$id){
            $this->db->where('bgh.builders_project_id',$id);
          }
        $q = $this->db->get('');
        $data = $q->result_array();
        return @$data;    
    }
    public function getSuccessorData($id)
    {
        $this->db->select('builders_task_id');
		$this->db->from('builders_project_tasks bgh');
        $this->db->join('b_boutique_properties bp', 'bp.boutique_property_id = bgh.builders_project_id','full');
        $this->db->where('bgh.builders_task_sucessor_id',$id);
        
        $q = $this->db->get('');
        $data = $q->result_array();
        return @$data;    
    }
    public function addchartcontent()
    {
    //   echo $this->input->post('starting_date');
    //   echo $this->input->post('ending_date');
    $var = $this->input->post('starting_date');
    $date = str_replace('/', '-', $var);
    $starting_date = date('Y-m-d', strtotime($date));
    
    $var = $this->input->post('ending_date');
    $date = str_replace('/', '-', $var);
    $ending_date = date('Y-m-d', strtotime($date));
   

    
      $addchart = array(
          'builders_task_name'=>$this->input->post('builder_task'),
          'builders_start_date'=>$starting_date,
          'builders_end_date'=>$ending_date,
          'builders_asignee_name'=>$this->input->post('builder_asignee'),
          'builders_task_predecessor_id'=>$this->input->post('predecessor_id'),
          'builders_task_sucessor_id'=>$this->input->post('successor_id'),
          'builders_project_id'=>$this->input->post('project_id')
        );
   $this->db->insert('builders_project_tasks',$addchart);
   $chart_insert_id = $this->db->insert_id();
  
  //  $addchart_order = array(
  //     'builders_task_order_task_id'=>$chart_insert_id,
  //     'builders_task_order_parent_id'=>$this->input->post('predecessor_id')
  //   );
  //     $this->db->insert('builders_task_order',$addchart_order);

  //     $addchart_order = array(
  //         'builders_task_order_task_id'=>$this->input->post('successor_id'),
  //         'builders_task_order_parent_id'=>$chart_insert_id
  //       );
  //         $this->db->insert('builders_task_order',$addchart_order);
  
   return TRUE;

    }
    public function remove_task($id)
    {
        $this->db->where('builders_task_id', $id);
		$this->db->delete('builders_project_tasks');
        return ;
    }


}
