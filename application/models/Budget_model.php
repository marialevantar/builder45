<?php
class Budget_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    public function m_getallheades()
    {
        $this->db->select( '*');
		$this->db->from('builder_description_header');
		$this->db->where('header_builder_id	', $this->session->userdata('BoutiqueID'));
		$q = $this->db->get();
		$data = $q->result_array();
        return $data;
    }
    public function m_getallsubheades()
    {
        $this->db->select( '*');
		$this->db->from('builder_description_subheader');
        $this->db->join('builder_description_header','builder_description_subheader.header_id = builder_description_header.hedaer_id');
		$this->db->where('builder_description_header.header_builder_id	', $this->session->userdata('BoutiqueID'));
		$q = $this->db->get();
		$data = $q->result_array();
        return $data;    
    }
    public function saveheadtitle()
    {
        // exit(0);
        $taxData = array(
            'header_name'=>$this->input->post('name'),        
            'header_builder_id'=>$this->session->userdata('BoutiqueID'),        
            'status'=>'0'
          );
          $this->db->insert('builder_description_header',$taxData);
          $esID = $this->db->insert_id();
          return $esID;
    }
    public function savesubheadtitle()
    {
        $taxData = array(
            'subheader_name'=>$this->input->post('name'),        
            'header_builder_id'=>$this->session->userdata('BoutiqueID'),        
            'header_id'=>$this->input->post('title')
          );
          $this->db->insert('builder_description_subheader',$taxData);
          $esID = $this->db->insert_id();
          return $esID;    
    }
    public function get_subheaders($id,$pro_id)
    {
        $this->db->select( '*');
		$this->db->from('builder_estimtaed_budget');
        $this->db->where('builder_property',$pro_id);
		$q = $this->db->get();
		$useddata = $q->result_array();
        // echo count($useddata);
        // echo $useddata[0]["subheader_id"];

        $this->db->select( '*');
		$this->db->from('builder_description_subheader');
        $this->db->where('header_id',$id);
		for($i=0; $i<count($useddata); $i++)
        {
            $this->db->where('subheader_id !=',$useddata[$i]["subheader_id"]);            
        }
        
        $q = $this->db->get();
		$data = $q->result_array();
        return $data;          

    }
    public function saveprojectestimate()
    {
        $taxData = array(
            'header_id'=>$this->input->post('title'),
            'subheader_id'=>$this->input->post('subtitle'),
            'builder_property'=>$this->input->post('property_name'),
            'vendor_contractor'=>$this->input->post('name'),
            'labor_cost'=>$this->input->post('Labor_cost'),
            'materail_cost'=>$this->input->post('material_cost'),
            'total_cost'=>$this->input->post('total_cost'),
            'actual_cost'=>$this->input->post('actual_cost'),
            'variance'=>$this->input->post('variance_cost'),
            'completed_percentage'=>$this->input->post('completed_percentage'),
            'current_paid'=>$this->input->post('current_paid'),
            'amount_due'=>$this->input->post('amount_due'),        
            'builder_notes'=>$this->input->post('notes')
          );
          $this->db->insert('builder_estimtaed_budget',$taxData);
          $esID = $this->db->insert_id();
          return $esID;        
    }
    public function m_getallprojectdetails()
    {
        $this->db->select( '*');
		$this->db->from('builder_estimtaed_budget');
        $this->db->join('builder_description_header','builder_estimtaed_budget.header_id = builder_description_header.hedaer_id');
        $this->db->join('builder_description_subheader','builder_estimtaed_budget.subheader_id = builder_description_subheader.subheader_id');
	    $this->db->join('b_boutique_properties','builder_estimtaed_budget.builder_property = b_boutique_properties.boutique_property_id');
		      
        $q = $this->db->get();
		$data = $q->result_array();
        return $data;              
    }
    public function m_getcurrentproject($id)
    {
        $this->db->select( '*');
		$this->db->from('builder_estimtaed_budget');
        $this->db->join('builder_description_header','builder_estimtaed_budget.header_id = builder_description_header.hedaer_id');
        $this->db->join('builder_description_subheader','builder_estimtaed_budget.subheader_id = builder_description_subheader.subheader_id');
	    $this->db->join('b_boutique_properties','builder_estimtaed_budget.builder_property = b_boutique_properties.boutique_property_id');
        $this->db->where('estimated_budget_id',$id);		      
        $q = $this->db->get();
		$data = $q->result_array();
        return $data;
    }
    public function updateprojectestimate()
    {
        $taxData = array(
            'vendor_contractor'=>$this->input->post('name'),
            'labor_cost'=>$this->input->post('Labor_cost'),
            'materail_cost'=>$this->input->post('material_cost'),
            'total_cost'=>$this->input->post('total_cost'),
            'actual_cost'=>$this->input->post('actual_cost'),
            'variance'=>$this->input->post('variance_cost'),
            'completed_percentage'=>$this->input->post('completed_percentage'),
            'current_paid'=>$this->input->post('current_paid'),
            'amount_due'=>$this->input->post('amount_due'),        
            'builder_notes'=>$this->input->post('notes')
          );
        $this->db->where('estimated_budget_id', $this->input->post('orderid'));
        $this->db->update('builder_estimtaed_budget',$taxData);
        return true;
    }
    public function m_getgetestimatebillproperty($id)
    {
        // $this->db->select( '*');
		// $this->db->from('builder_description_header bh');
        // // $this->db->from('builder_description_subheader bsh');
        // $this->db->join('builder_description_subheader bsh', 'bsh.header_id = bh.hedaer_id','left');
        // $this->db->join('builder_estimtaed_budget bud', 'bsh.header_id = bud.subheader_id','full');
        // // $this->db->where("bud.builder_property",$id);
        // $this->db->order_by("bh.hedaer_id", "asc");
     // $this->db->from('builder_estimtaed_budget be');
        // $this->db->where('be.builder_property',$id);
	
    }
    public function removesubheader($id)
    {
        $this->db->where('subheader_id', $id);
        $this->db->delete('builder_description_subheader');
        return true;
      
    }
    public function removeheader($id)
    {
        $this->db->where('hedaer_id', $id);
        $this->db->delete('builder_description_header');

        $this->db->where('header_id', $id);
        $this->db->delete('builder_description_subheader');
        return true;  
    }
    public function removebudget($id)
    {
        $this->db->where('estimated_budget_id', $id);
        $this->db->delete('builder_estimtaed_budget');
        return true;  
    }
}
//