<?php
class Tailor_model extends CI_Model {
//\\//\\//\\//\//
	function m_addtailor($newfileName) {
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$address = $this->input->post('address');
		$boutique_staff_type = @$this->input->post('boutique_staff_type');
		$boutique_staff_hourly_rate = @$this->input->post('boutique_staff_hourly_rate');
		$wage = @$this->input->post('wage');
		$overtime = @$this->input->post('overtime_hourly_rate');	
		$offtime = @$this->input->post('offtime_hourly_rate');
	
		$data = array('boutique_tailor_username'=>ucfirst($name),'Staff_image'=>$newfileName,'staff_offtime_rate'=>$offtime,'staff_overtime_rate'=>$overtime,'wage_option'=>$wage,'boutique_tailor_email'=>$email,'boutique_tailor_ph'=>$phone,'boutique_tailor_address'=>$address,'boutique_staff_type'=>@$boutique_staff_type,'boutique_staff_hourly_rate'=>@$boutique_staff_hourly_rate,'boutique_id'=>$this->session->userdata('BoutiqueID'));
	
		$this->db->insert('b_boutique_tailor',$data);
		return TRUE;
	}

	function m_getalltailors1() {
		$this->db->select( '*');
		$this->db->from('b_boutique_tailor bt');
		$this->db->join('b_boutique_work_staff_types bws','bt.boutique_staff_type = bws.boutique_work_staff_type_id', 'full');
		$this->db->where('bt.boutique_id', $this->session->userdata('BoutiqueID'));
		if($this->session->userdata('BoutiqueID') == 27){
			$this->db->where('bt.boutique_staff_type', 1);
		}
		$q = $this->db->get();
		$data = $q->result_array();
			return @$data;
		
		
	}

	function m_getalltailors() {
		
		$date = $this->uri->segment(4);

		$this->db->select( '*');
		$this->db->from('b_boutique_tailor bt');
		$this->db->join('b_builders_attendanace ba','bt.boutique_tailor_id = ba.user_id', 'full');
		$this->db->where('ba.attendance_date', $date);
		$this->db->where('bt.boutique_id', $this->session->userdata('BoutiqueID'));
		if($this->session->userdata('BoutiqueID') == 27){
			$this->db->where('bt.boutique_staff_type', 1);
		}
		$q = $this->db->get();
		$data = $q->result_array();
		// var_dump(count($data));
		// exit(0);
		if(empty($data))
		{
			$this->db->select( '*');
			$this->db->from('b_boutique_tailor');
			$this->db->where('boutique_id', $this->session->userdata('BoutiqueID'));
		// $this->db->where('ba.attendance_date', $date);
		
			if($this->session->userdata('BoutiqueID') == 27){
				$this->db->where('boutique_staff_type', 1);
			}
			$data = $this->db->get()->result_array();
			return @$data;
		}else
		{
			return @$data;
		}
		
	}

	function m_getalltailorsnew($id) {



		$this->db->select( '*');
		$this->db->from('b_boutique_tailor bt');
		$this->db->join('b_builders_attendanace ba','bt.boutique_tailor_id = ba.user_id', 'full');
		
		// $this->db->from('b_boutique_tailor bt');
		// $this->db->JOIN('b_builders_attendanace ba');
		// $this->db->ON('bt.boutique_tailor_id = ba.user_id');
		

		$this->db->where('bt.boutique_id', $this->session->userdata('BoutiqueID'));
		if($this->session->userdata('BoutiqueID') == 27){
			$this->db->where('bt.boutique_staff_type', 1);
		}
		$q = $this->db->get();
		$data = $q->result_array();
		return @$data;
	}
	function m_getallstaffwithtype($id) {
		$this->db->select( '*');
		$this->db->from('b_boutique_tailor');
		$this->db->where('boutique_id', $this->session->userdata('BoutiqueID'));
		$this->db->where('boutique_staff_type', $id);
		$q = $this->db->get();
		$data = $q->result_array();
		return @$data;
	}

	function m_gettailor($id) {
		$this->db->select( '*');
		$this->db->from('b_boutique_tailor');
		$this->db->where('boutique_tailor_id', $id);
		$q = $this->db->get();
		$data = $q->result_array();
		return @$data[0];
	}
	function m_updatetailor($id,$newfileName) {
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$address = $this->input->post('address');

		$offtime = $this->input->post('offtime_hourly_rate');
		$wage = $this->input->post('wage');
		

		$boutique_staff_type = @$this->input->post('boutique_staff_type');
		$boutique_staff_hourly_rate = @$this->input->post('boutique_staff_hourly_rate');
		$overtime = @$this->input->post('overtime_hourly_rate');
	

		$data = array('boutique_tailor_username'=>ucfirst($name),'wage_option'=>$wage,'staff_offtime_rate'=>$offtime,'staff_overtime_rate'=>$overtime,'boutique_tailor_email'=>$email,'boutique_tailor_ph'=>$phone,'boutique_tailor_address'=>$address,'boutique_staff_type'=>@$boutique_staff_type,'boutique_staff_hourly_rate'=>@$boutique_staff_hourly_rate);
		$this->db->where('boutique_tailor_id', $id);
		$this->db->update('b_boutique_tailor',$data);
		return TRUE;
	}
	function m_removetailor($id) {
		$this->db->where('boutique_tailor_id', $id);
		$this->db->delete('b_boutique_tailor');
		return true;
	}
	function stafftype() {
		$this->db->select( '*');
		$this->db->from('b_boutique_work_staff_types');
		$this->db->where('boutique_id', $this->session->userdata('BoutiqueID'));
		$q = $this->db->get();
		$data = $q->result_array();
		return @$data;
	}


	// function m_addstafftype() {
	    
	// 	$boutique_work_staff_type_name = @$this->input->post('boutique_work_staff_type_name');

	// 	$data = array('boutique_work_staff_type_name'=>$boutique_work_staff_type_name,'boutique_id'=>$this->session->userdata('BoutiqueID'));
	// 	$this->db->insert('b_boutique_work_staff_types',$data);
	// 	return TRUE;
	// }


	function m_addstafftype() {
	    
		$boutique_work_staff_type_name = @$this->input->post('boutique_work_staff_type_name');
		$status=@$this->input->post('status');
		$data = array('boutique_work_staff_type_name'=>$boutique_work_staff_type_name,'boutique_id'=>$this->session->userdata('BoutiqueID'), 'status'=>$status);

		$this->db->select( '*');
		$this->db->from('b_boutique_work_staff_types');
		$this->db->where('boutique_work_staff_type_name', $boutique_work_staff_type_name);
		$q = $this->db->get();
		// $data=$q->result_array();
		$existing_data = $q->result_array();

		// echo "<PRE>";
		//    print_r($existing_data);

		//    echo "databse value = " ;
		   
		//  print_r($existing_data[0]['boutique_work_staff_type_name']);

		//    echo "<br /> ";

		//    echo "screen value = " . $boutique_work_staff_type_name;
		// echo "</PRE>";
		// exit;
		// return @$data;
		if($existing_data[0]['boutique_work_staff_type_name']==$boutique_work_staff_type_name)
		{
			return "already_exists";
		}
		else{

			$this->db->insert('b_boutique_work_staff_types',$data);
		    return "ok";
		}

		


		

	}
	function m_removestafftype($id) {
		$this->db->where('boutique_work_staff_type_id', $id);
		$this->db->delete('b_boutique_work_staff_types');
		return true;
	}
	////\\//\\//\\//\\//
}
?>