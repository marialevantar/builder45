<?php
class Customer_model extends CI_Model {

//\\//\\//\\//\//
	function m_addcustomer() {
		if (@$_FILES['document_file1']['name']) {
			@$image = @basename($_FILES['document_file1']['name']);
			@$extension  = strtolower(pathinfo($image, PATHINFO_EXTENSION));
			@$newfileName = time() . rand() . "." . $extension;
			$uploaddir = $this->config->item('project_path') . "uploads/documents/";
			$uploadfile = $uploaddir . $newfileName;
			if (@move_uploaded_file(@$_FILES['document_file1']['tmp_name'], $uploadfile)) {
				$data["boutique_doc1_name"]=$this->input->post('document_name1');
				$data["boutique_doc1_file"]=$newfileName;

			}
		} 
		if (@$_FILES['document_file2']['name']) {
			@$image = @basename($_FILES['document_file2']['name']);
			@$extension  = strtolower(pathinfo($image, PATHINFO_EXTENSION));
			@$newfileName = time() . rand() . "." . $extension;
			$uploaddir = $this->config->item('project_path') . "uploads/documents/";
			$uploadfile = $uploaddir . $newfileName;
			if (@move_uploaded_file(@$_FILES['document_file2']['tmp_name'], $uploadfile)) {
				$data["boutique_doc2_name"]=$this->input->post('document_name2');
				$data["boutique_doc2_file"]=$newfileName;

			}
		} 
		if (@$_FILES['document_file3']['name']) {
			@$image = @basename($_FILES['document_file3']['name']);
			@$extension  = strtolower(pathinfo($image, PATHINFO_EXTENSION));
			@$newfileName = time() . rand() . "." . $extension;
			$uploaddir = $this->config->item('project_path') . "uploads/documents/";
			$uploadfile = $uploaddir . $newfileName;
			if (@move_uploaded_file(@$_FILES['document_file3']['tmp_name'], $uploadfile)) {
				$data["boutique_doc3_name"]=$this->input->post('document_name3');
				$data["boutique_doc3_file"]=$newfileName;

			}
		} 
		if (@$_FILES['document_file4']['name']) {
			@$image = @basename($_FILES['document_file4']['name']);
			@$extension  = strtolower(pathinfo($image, PATHINFO_EXTENSION));
			@$newfileName = time() . rand() . "." . $extension;
			$uploaddir = $this->config->item('project_path') . "uploads/documents/";
			$uploadfile = $uploaddir . $newfileName;
			if (@move_uploaded_file(@$_FILES['document_file4']['tmp_name'], $uploadfile)) {
				$data["boutique_doc4_name"]=$this->input->post('document_name4');
				$data["boutique_doc4_file"]=$newfileName;

			}
		} 
		if($this->session->userdata('UserID') ==136) {
		$data["boutique_property"]=$this->input->post('property_id');
		}
		$data["boutique_customer_name"]=ucwords($this->input->post('name'));
		$data["boutique_customer_email"]=$this->input->post('email');
		$data["boutique_customer_ph"]=$this->input->post('phone');
		$data["boutique_customer_address"]=$this->input->post('address');
		$data["boutique_id"]=$this->session->userdata('BoutiqueID');
		$data["boutique_gst_status"]=$this->input->post('gst_status');
		$data["boutique_monthly_or_daily"]=$this->input->post('rent_type');
		$data["boutique_monthy_rent_date"]=$this->input->post('monthly_date');
		$data["tenants_room_rent"]=$this->input->post('price');
		$data["nxt_tenant_roomrent_date"]=$this->input->post('rent_from_date');
		$data["rent_period"]=$this->input->post('period');

		
		
		$data["rent_room_no"]=@$this->input->post('room_no');
		$this->db->insert('b_boutique_customers',$data);
		$cID = $this->db->insert_id();
		/*
		$i =0;
		$mdata = array();
		if($postdata){
			foreach($postdata as $key => $value) {
				if($value) {
					$mdata[$i]["boutique_customer_id"] = $cID;
					$mdata[$i]["b_customer_measurement_key"] = $key;
					$mdata[$i]["b_customer_measurement_value"] = $value;
					$i++;
				}
			}
			$this->db->insert_batch('b_boutique_customer_measurements', $mdata); 
		}
		*/
		
		return $cID;
	}
	function m_getallcustomers() {
	   if($this->session->userdata('UserID') ==136) {
	    $this->db->select( '*');
		$this->db->from('b_boutique_customers b');
		$this->db->join('b_boutique_properties bp', 'b.boutique_property=bp.boutique_property_id ','left');
		$this->db->where('b.boutique_id', $this->session->userdata('BoutiqueID'));
	    }
	    else{
		$this->db->select( '*');
		$this->db->from('b_boutique_customers');
		$this->db->where('boutique_id', $this->session->userdata('BoutiqueID'));
	    }
		$q = $this->db->get();
		$data = $q->result_array();
		return @$data;
	}
	function m_getcustomer($id) {
		$this->db->select( '*');
		$this->db->from('b_boutique_customers');
		$this->db->where('boutique_customer_id', $id);
		$q = $this->db->get();
		$data = $q->result_array();
		return @$data[0];
	}
	function m_updatecustomer($id) {
		if (@$_FILES['document_file1']['name']) {
			@$image = @basename($_FILES['document_file1']['name']);
			@$extension  = strtolower(pathinfo($image, PATHINFO_EXTENSION));
			@$newfileName = time() . rand() . "." . $extension;
			$uploaddir = $this->config->item('project_path') . "uploads/documents/";
			$uploadfile = $uploaddir . $newfileName;
			if (@move_uploaded_file(@$_FILES['document_file1']['tmp_name'], $uploadfile)) {
				$data["boutique_doc1_name"]=$this->input->post('document_name1');
				$data["boutique_doc1_file"]=$newfileName;
				$path="uploads/documents/".$this->input->post('document_file1_old');
				 if(file_exists($path))
				 {
					 unlink($path);
				 }
			}
		} 
		if (@$_FILES['document_file2']['name']) {
			@$image = @basename($_FILES['document_file2']['name']);
			@$extension  = strtolower(pathinfo($image, PATHINFO_EXTENSION));
			@$newfileName = time() . rand() . "." . $extension;
			$uploaddir = $this->config->item('project_path') . "uploads/documents/";
			$uploadfile = $uploaddir . $newfileName;
			if (@move_uploaded_file(@$_FILES['document_file2']['tmp_name'], $uploadfile)) {
				$data["boutique_doc2_name"]=$this->input->post('document_name2');
				$data["boutique_doc2_file"]=$newfileName;
				$path="uploads/documents/".$this->input->post('document_file2_old');
				if(file_exists($path))
				{
					unlink($path);
				}

			}
		} 
		if (@$_FILES['document_file3']['name']) {
			@$image = @basename($_FILES['document_file3']['name']);
			@$extension  = strtolower(pathinfo($image, PATHINFO_EXTENSION));
			@$newfileName = time() . rand() . "." . $extension;
			$uploaddir = $this->config->item('project_path') . "uploads/documents/";
			$uploadfile = $uploaddir . $newfileName;
			if (@move_uploaded_file(@$_FILES['document_file3']['tmp_name'], $uploadfile)) {
				$data["boutique_doc3_name"]=$this->input->post('document_name3');
				$data["boutique_doc3_file"]=$newfileName;
				$path="uploads/documents/".$this->input->post('document_file3_old');
				if(file_exists($path))
				{
					unlink($path);
				}

			}
		} 
		if (@$_FILES['document_file4']['name']) {
			@$image = @basename($_FILES['document_file4']['name']);
			@$extension  = strtolower(pathinfo($image, PATHINFO_EXTENSION));
			@$newfileName = time() . rand() . "." . $extension;
			$uploaddir = $this->config->item('project_path') . "uploads/documents/";
			$uploadfile = $uploaddir . $newfileName;
			if (@move_uploaded_file(@$_FILES['document_file4']['tmp_name'], $uploadfile)) {
				$data["boutique_doc4_name"]=$this->input->post('document_name4');
				$data["boutique_doc4_file"]=$newfileName;
				$path="uploads/documents/".$this->input->post('document_file4_old');
				if(file_exists($path))
				{
					unlink($path);
				}

			}
		} 
		if($this->session->userdata('UserID') ==136) {
		$data["boutique_property"]=$this->input->post('property_id');
		}
		$data["boutique_customer_name"]=ucwords($this->input->post('name'));
		$data["boutique_customer_email"]=$this->input->post('email');
		$data["boutique_customer_ph"]=$this->input->post('phone');
		$data["boutique_customer_address"]=$this->input->post('address');
		$data["boutique_id"]=$this->session->userdata('BoutiqueID');
		$data["boutique_gst_status"]=$this->input->post('gst_status');
		$data["boutique_monthly_or_daily"]=$this->input->post('rent_type');
		$data["boutique_monthy_rent_date"]=$this->input->post('monthly_date');
		$data["tenants_room_rent"]=$this->input->post('price');
		$data["nxt_tenant_roomrent_date"]=$this->input->post('rent_from_date');
		$data["rent_period"]=$this->input->post('period');

		
		
		$this->db->where('boutique_customer_id', $id);
		$this->db->update('b_boutique_customers',$data);
		
		return TRUE;
	}

	function m_removecustomer($id) {
		$this->db->where('boutique_customer_id', $id);
		$this->db->delete('b_boutique_customers');

		$this->db->where('boutique_customer_id', $id);
		$this->db->delete('b_boutique_customer_measurements');

		return true;
	}
	
	function m_updatemeasurements($id) {
		$array_data = $this->input->post();
		$i =0;
		if($array_data) {
			$this->db->where('boutique_customer_id', $id);
			$this->db->where('b_customer_measurement_type',$this->input->post('typeid'));
			$this->db->delete('b_boutique_customer_measurements');
		}
		foreach($array_data as $key => $value) {
			if($value) {
				$data[$i]["boutique_customer_id"] = $id;
				$data[$i]["b_customer_measurement_key"] = $key;
				$data[$i]["b_customer_measurement_type"] = $this->input->post('typeid');
				$data[$i]["b_customer_measurement_value"] = $value;
				$i++;
			}
		}
		$this->db->insert_batch('b_boutique_customer_measurements', $data); 
		return TRUE;
	}
	
	function m_getmeasurements($id) {
		$this->db->select( '*');
		$this->db->from('b_boutique_customer_measurements');
		$this->db->where('boutique_customer_id', $id);
		$q = $this->db->get();
		$data = $q->result_array();
		return @$data;
	}
	
	public function phonevalidate($phone_validate){
        $this->db->select('*');
        $this->db->from('b_boutique_customers');
        $this->db->where('boutique_id', $this->session->userdata('BoutiqueID'));
        $this->db->where('boutique_customer_ph', trim($phone_validate));
        $q = $this->db->get();
        $data = $q->result_array();
        if(@$data[0]){
          return false;
        }
        else{
          return true;
        }
    }
	public function payment_history($id)
	{
		$this->db->select('*');
		$this->db->from('b_boutique_order_payments');
		$this->db->join('b_boutique_works', 'b_boutique_works.boutique_order_id = b_boutique_order_payments.boutique_order_id', 'left');
		$this->db->where("b_boutique_works.boutique_customer_id",$id);
		return $this->db->get()->result_array();
	}
	function get_order_number($oid)
	{
	    $this->db->select("*");
	    $this->db->from("b_boutique_orders");
	    $this->db->where("boutique_order_id",$oid);
	  $res= $this->db->get()->row_array();
	  if(!empty($res))
	  {
	     if(!empty($res['boutique_order_form_number']))
	     {
	         return $res['boutique_order_form_number'];
	     }else
	     {
	         return $res['boutique_order_number'];
	     }
	  }
	  else
	  {
	       return '';
	  }
	    
	}
	public function m_loadcustomers($cid)
	{
		$custData=array();
		$this->db->select( '*');
		$this->db->from('b_boutique_customers');
		$this->db->where('boutique_customer_id', $cid);
		$q = $this->db->get();
		$data = $q->result_array();
		return @$data[0];
	
 
	}
	public function updatetenantamount()
	{
		$this->db->select('*');
		$this->db->from('b_boutique_customers');
		$q = $this->db->get();
		$data = $q->result_array();
		for ($i=0 ; $i<count($data) ; $i++)
		{
		
			$date= $data[$i]['nxt_tenant_roomrent_date'];
			
			$date = str_replace('/', '-', $date);
		     	if(date("d-m-Y") == $date)
		 	{
				      
				 
					if($data[$i]['rent_period']==2)
					{
						$newdate= date('d-m-Y', strtotime("+36 months", strtotime($date)));	
						 $rent = $data[$i]['tenants_room_rent'];
						$rent15 = ((15/100)*$rent);
						$nxtrent15 = $rent + $rent15;

						$this->db->set('nxt_tenant_roomrent_date', $newdate);
						$this->db->set('tenants_room_rent',$nxtrent15);
                        $this->db->where('boutique_customer_id', $data[$i]['boutique_customer_id']);
                        $this->db->update('b_boutique_customers');                   
						

					}
				     elseif($data[$i]['rent_period']==1)
					 {
						$newdate1= date('d-m-Y', strtotime("+11 months", strtotime($date)));

						$rent = $data[$i]['tenants_room_rent'];
						$rent7 = ((7/100)*$rent);
						$nxtrent7 = $rent + $rent7;
						//echo $nxtrent7;
						$this->db->set('nxt_tenant_roomrent_date', $newdate1);
						$this->db->set('tenants_room_rent',$nxtrent7);
                        $this->db->where('boutique_customer_id', $data[$i]['boutique_customer_id']);
                        $this->db->update('b_boutique_customers');                   
						
					 }
			}
		
		}
			
	
	}
////\\//\\//\\//\\//	
//\\//\\//\\//\\//\\

// 	function m_getrestaurant($id) {
// 		$this->db->select( '*');
// 		$this->db->from('restaurant');
// 		$this->db->where('restaurantid', $id);
// 		$q = $this->db->get();
// 		$data = $q->result_array();
// 		return @$data[0];
// 	}

// 	function register() {
// 		$name 		= $this->input->post('name');
// 		$email 		= $this->input->post('email');
// 		$phone 		= $this->input->post('phone');
// 		$address 	= $this->input->post('address');
// 		$location 	= $this->input->post('location');
// 		$password   = $this->input->post('password');
// 		$description   = $this->input->post('description');
// 		$password   = md5($password);
// 		$data = array('name'=>$name,'email'=>$email,'phone'=>$phone,'address'=>$address,'location'=>$location,'password'=>$password,'description'=>$description);
// 		$this->db->insert('restaurant',$data);
// 		return TRUE;
// 	}

// /* __________________________________*/

// 	function getallfeatures() {
// 		$this->db->select( 'featurelistid AS id,name,image');
// 		$this->db->from('featurelist');
// 		$q = $this->db->get();
// 		$data = $q->result_array();
// 		return @$data;
// 	}

// 	function getallcuisines() {
// 		$this->db->select( 'cuisineslistid AS id,name,image');
// 		$this->db->from('cuisineslist');
// 		$q = $this->db->get();
// 		$data = $q->result_array();
// 		return @$data;
// 	}

// 	function s_cuisines() {
// 		$this->db->select( 'cuisineslistid AS id');
// 		$this->db->from('cuisines');
// 		$this->db->where('restaurantid', $this->session->userdata('user_id'));
// 		$q = $this->db->get();
// 		$data = $q->result_array();
// 		$res = array();
// 		$k =0;
// 		foreach ($data as $dt) {
// 			$res[$k] = $dt["id"];
// 			$k++;
// 		}
// 		return @$res;

// 	}

// 	function s_features() {
// 		$this->db->select( 'featureslistid AS id');
// 		$this->db->from('features');
// 		$this->db->where('restaurantid', $this->session->userdata('user_id'));
// 		$q = $this->db->get();
// 		$data = $q->result_array();
// 		$res = array();
// 		$k =0;
// 		foreach ($data as $dt) {
// 			$res[$k] = $dt["id"];
// 			$k++;
// 		}
// 		return @$res;
// 	}

// 	function getalllocations() {
// 		$this->db->select( 'locationslistid AS id,name');
// 		$this->db->from('locationslist');
// 		$q = $this->db->get();
// 		$data = $q->result_array();
// 		return @$data;
// 	}

// 	function getallmenu() {
// 		$this->db->select( 'menuid AS id,name,price');
// 		$this->db->from('menu');
// 		$this->db->where('restaurantid', $this->session->userdata('user_id'));
// 		$q = $this->db->get();
// 		$data = $q->result_array();
// 		return @$data;
// 	}

// 	function savemenu() {
// 		$name = $this->input->post('name');
// 		$price = $this->input->post('price');
// 		$id = $this->session->userdata('user_id');
// 		$data = array('name'=>$name,'price'=>$price,'restaurantid'=>$id);
// 		$this->db->insert('menu',$data);
// 		return TRUE;
// 	}

// 	function deletemenu($id) {
// 		$this->db->where('menuid', $id);
// 		$this->db->delete('menu');
// 		return true;
// 	}

// 	function deletecuisines($id) {
// 		$this->db->where('cuisineslistid', $id);
// 		$this->db->delete('cuisineslist');
// 		return true;
// 	}

// 	function savecuisine($newfileName) {
// 		$name = $this->input->post('cuisine');
// 		$data = array('name'=>$name,'image'=>$newfileName);
// 		$this->db->insert('cuisineslist',$data);
// 		return TRUE;
// 	}

// 	function deletefeatures($id) {
// 		$this->db->where('featurelistid', $id);
// 		$this->db->delete('featurelist');
// 		return true;
// 	}

// 	function savefeature($newfileName) {
// 		$name = $this->input->post('feature');
// 		$data = array('name'=>$name,'image'=>$newfileName);
// 		$this->db->insert('featurelist',$data);
// 		return TRUE;
// 	}

// 	function getUserDetails($username,$password) {
// 		$this->db->select( 'userid AS id,name,email,phone,location');
// 		$this->db->from('user');
// 		$this->db->where('email', $username);
// 		$this->db->where('password', $password);
// 		$q = $this->db->get();
// 		$data = $q->result_array();
// 		return @$data[0];
// 	}

// 	function registerUser() {
// 		$name = $this->input->post('name');
// 		$email = $this->input->post('email');
// 		$password = $this->input->post('password');
// 		$phone = $this->input->post('phone');
// 		$location = $this->input->post('location');
// 		if($name && $email && $password && $phone && $location):
// 			$data = array('name'=>$name,'email'=>$email,'phone'=>$phone,'password'=>$password,'location'=>$location);
// 			$this->db->insert('user',$data);
// 			return true;
// 		else:
// 			return false;
// 		endif;
// 	}

// 	function updateUser() {
// 		$id = $this->input->post('id');
// 		$name = $this->input->post('name');
// 		$email = $this->input->post('email');
// 		$password = $this->input->post('password');
// 		$phone = $this->input->post('phone');
// 		$location = $this->input->post('location');
// 		$data = array('name'=>$name,'email'=>$email,'phone'=>$phone,'password'=>$password,'location'=>$location);
// 		$this->db->where('userid', $id);
// 		$this->db->update('user',$data);
// 		return TRUE;
// 	}

// 	function featuredRestaurants() {
// 		$this->db->select( 'restaurantid AS id,name,image,capacity,location,address,phone,email,latitude,longitude');
// 		$this->db->from('restaurant');
// 		$this->db->where('featured', 1);
// 		$q = $this->db->get();
// 		$data = $q->result_array();
// 		return @$data;
// 	}

// 	function restaurantDetails() {
// 		$id = $this->input->post('id');
// 		$this->db->select( 'restaurantid AS id,name,image,capacity,location,address,phone,email,latitude,longitude,opentime,closetime,description,website');
// 		$this->db->from('restaurant');
// 		$this->db->where('restaurantid', $id);
// 		$q = $this->db->get();
// 		$data = $q->result_array();
// 		return @$data[0];
// 	}
// 	public function addrestimage($restaurantid,$newfileName){
// 	  $ImgData = array(
// 	    'restaurantid'=>$restaurantid,
// 	    'name'=>$newfileName
// 	  );
// 	  $this->db->insert('images',$ImgData);
// 	}
// 	public function m_getallimages($restaurantid) {
// 		$this->db->select('imageid,name');
// 		$this->db->from('images');
// 		$this->db->where('restaurantid', $restaurantid);
// 		$q = $this->db->get();
// 		$data = $q->result_array();
// 		return @$data;
// 	}
// 	public function getimagebyid($imgid) {
// 		$this->db->select('imageid,name');
// 		$this->db->from('images');
// 		$this->db->where('imageid', $imgid);
// 		$q = $this->db->get();
// 		$data = $q->result_array();
// 		return @$data[0];
// 	}

// 	public function getadmindata() {
// 		$this->db->select('username,password');
// 		$this->db->from('admin');
// 		$q = $this->db->get();
// 		$data = $q->result_array();
// 		return @$data[0];
// 	}
// 	function restorders() {
// 		$restaurantid = $this->session->userdata('user_id');
// 		$this->db->distinct('orders.ordersid');
// 		$this->db->select( 'orders.ordersid AS id,orders.seats,orders.time,orders.totalprice,orders.status,user.name AS username');
// 		$this->db->from('orders');
// 		$this->db->join('user', 'orders.userid = user.userid', 'left');
// 		$this->db->join('restaurant', 'orders.restaurantid = restaurant.restaurantid', 'left');
// 		$this->db->where('restaurant.restaurantid', $restaurantid);
// 		$this->db->order_by('orders.time','asc');
// 		$q = $this->db->get();
// 		$data = $q->result_array();
// 		return @$data;
// 	}
// 	function changeorderstatus($orderid,$status) {

// 		$data = array('status'=>$status);
// 		$this->db->where('ordersid', $orderid);
// 		$this->db->update('orders',$data);
// 		return TRUE;
// 	}

// 	function newrestaurants() {
// 		$this->db->select( 'restaurantid AS id,name,location,address,phone,email,description');
// 		$this->db->from('restaurant');
// 		$this->db->where('featured', 0);
// 		$q = $this->db->get();
// 		$data = $q->result_array();
// 		return @$data;
// 	}
// 	function approvedrestaurants() {
// 		$this->db->select( 'restaurantid AS id,name,location,address,phone,email');
// 		$this->db->from('restaurant');
// 		$this->db->where('featured', 1);
// 		$q = $this->db->get();
// 		$data = $q->result_array();
// 		return @$data;
// 	}
// 	function approve ($id) {
// 		$data = array('featured'=>1);
// 		$this->db->where('restaurantid', $id);
// 		$this->db->update('restaurant',$data);
// 		return TRUE;
// 	}

// 	function remainingseats() {
// 		$date = new DateTime("now");
// 		$curr_date = $date->format('Y-m-d ');

// 		$this->db->select('SUM(seats) AS seats');
// 		$this->db->from('orders'); 
// 		$this->db->where('DATE(time)',$curr_date);//use date function
// 		$this->db->where('restaurantid',$this->session->userdata('user_id'));
// 		$this->db->where('status',1);
// 		$q = $this->db->get();
// 		$data = $q->result_array();
// 		return $data[0]["seats"];
// 	}

// 	function totalorders() {
// 		$date = new DateTime("now");
// 		$curr_date = $date->format('Y-m-d ');

// 		$this->db->select('COUNT(seats) AS total');
// 		$this->db->from('orders'); 
// 		$this->db->where('DATE(time)',$curr_date);//use date function
// 		$this->db->where('restaurantid',$this->session->userdata('user_id'));
// 		$q = $this->db->get();
// 		$data = $q->result_array();
// 		return $data[0]["total"];
// 	}
// 	function allorders() {
// 		$this->db->select('COUNT(seats) AS alltotal');
// 		$this->db->from('orders');
// 		$this->db->where('restaurantid',$this->session->userdata('user_id'));
// 		$q = $this->db->get();
// 		$data = $q->result_array();
// 		return $data[0]["alltotal"];
// 	}

// 	function todayreveneue() {
// 		$date = new DateTime("now");
// 		$curr_date = $date->format('Y-m-d ');

// 		$this->db->select('SUM(totalprice) AS totalprice');
// 		$this->db->from('orders'); 
// 		$this->db->where('DATE(time)',$curr_date);//use date function
// 		$this->db->where('status',3);
// 		$this->db->where('restaurantid',$this->session->userdata('user_id'));
// 		$q = $this->db->get();
// 		$data = $q->result_array();
// 		return $data[0]["totalprice"];
// 	}
// 	function totalreveneue() {
// 		$this->db->select('SUM(totalprice) AS totalprice');
// 		$this->db->from('orders');
// 		$this->db->where('status',3);
// 		$this->db->where('restaurantid',$this->session->userdata('user_id'));
// 		$q = $this->db->get();
// 		$data = $q->result_array();
// 		return $data[0]["totalprice"];
// 	}
}
?>