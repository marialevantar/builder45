<?php
class Work_model extends CI_Model {
//\\//\\//\\//\// work
	function m_addwork($newfileName) {
	    
	    
	    
	    if($this->session->userdata('UserID') ==136) {
	        $gst==0;
	    $pricewithoutgst = $this->input->post('price');
		@$rent_discount = @$this->input->post('discount');
		$pricewithoutgst = $pricewithoutgst-@$rent_discount;
		$pricetdf = @$this->input->post('price_tdf');
        
		$this->db->select( '*');
		$this->db->from('b_boutique_customers bcg');
		$this->db->where(array('bcg.boutique_id'=>$this->session->userdata('BoutiqueID'),'bcg.boutique_customer_id'=>$this->input->post('customerid')));
		$this->db->order_by("bcg.boutique_customer_id",'desc');
		$this->db->limit('1');
		$cusengst = $this->db->get();
		$gstdata = $cusengst->result_array();
		$gst_status = @$gstdata[0]['boutique_gst_status'];
	    if($gst_status==2){
	        $gst=round(($pricewithoutgst*(18/100)),2);
			$price=$pricewithoutgst+$gst;
		}
		if($gst_status==0){
	        $gst=round(($pricewithoutgst*(19/100)),2);
			$price=$pricewithoutgst;
		}
		if($gst_status==1){
	        $gst=round(($pricewithoutgst*(19/100)),2);
			$price=$pricewithoutgst+$gst;

	    }
		}
        else{
		$price = $this->input->post('price');
		
		}
		$boutique_work_handwork = $this->input->post('boutique_work_handwork');
		$boutique_work_material_remaining = $this->input->post('boutique_work_material_remaining');
		$totalPrice = $price + (int)$boutique_work_handwork + (int)$boutique_work_material_remaining;

		$order_date = $this->input->post('order_date');
		$delivery_date = $this->input->post('delivery_date');
		$trial_date = $this->input->post('trial_date');
		$due_date = $this->input->post('due_date');
		$boutique_id = $this->session->userdata('BoutiqueID');
		$customerid = $this->input->post('customerid');
		$tailorid = $this->input->post('tailorid');

		$this->db->select( '*');
		$this->db->from('b_boutique_orders bo');
		$this->db->where('boutique_id', $this->session->userdata('BoutiqueID'));
		$this->db->order_by("bo.boutique_order_id",'desc');
		$this->db->limit('1');
		$q = $this->db->get();
		$orderdata = $q->result_array();
		$boutique_work_number = @$orderdata[0]['boutique_order_number'] +1;
        
        $this->db->select( '*');
		$this->db->from('b_boutique_orders bo');
		$this->db->where('boutique_id', $this->session->userdata('BoutiqueID'));
		$this->db->order_by("bo.boutique_order_id",'desc');
		$this->db->limit('1');
		$q = $this->db->get();
		$orderdata = $q->result_array();
		$boutique_bill_number = @$orderdata[0]['boutique_bill_number'] +1;
		
		if(!$this->input->post('orderid')){
			$orderdata = array('boutique_order_grandtotal'=>$totalPrice,
			'boutique_order_date'=>$order_date,
			'boutique_order_delivery_date'=>$delivery_date,
			'boutique_id'=>$boutique_id,'boutique_order_number'=>$boutique_work_number,
			'boutique_bill_number'=>$boutique_bill_number,'boutique_order_no_items'=>1,
			'boutique_order_form_number'=>$this->input->post('boutique_order_form_number'),
			'boutique_trail_date'=>$this->input->post('trial_date'),'boutique_due_date'=>$due_date,
			'b_boutique_orders_tdf'=>@$this->input->post('price_tdf'),
			
			'rent_from_date'=>@$this->input->post('rent_from_date'),
			'rent_to_date'=>@$this->input->post('rent_to_date'),
			
			'rent_discount'=>@$this->input->post('discount'),
			'rent_month'=>@$this->input->post('month_name'),
			'price_without_gst'=>@$this->input->post('price'),
			
				

			'b_boutique_gt_tdf'=>$totalPrice-@$this->input->post('price_tdf')
		);
		
			$this->db->insert('b_boutique_orders',$orderdata);
			$orderID = $this->db->insert_id();
	    }
	    else{
	    	$orderID = $this->input->post('orderid');
	    }

		$workname = $this->input->post('workname');
		$comments = $this->input->post('comments');
		
		$boutique_work_number = $orderID.$boutique_id.$customerid.$tailorid.rand(1000, 9999);

		$data = array('boutique_work_name'=>ucfirst($workname),'boutique_customer_id'=>$customerid,'boutique_work_price'=>$price,'boutique_work_order_date'=>$order_date,'boutique_work_delivery_date'=>$delivery_date,
			'boutique_tailor_id'=>$tailorid,'boutique_work_material_desc'=>$comments,'boutique_work_image'=>$newfileName,'boutique_id'=>$boutique_id,'boutique_work_number'=>$boutique_work_number,'boutique_order_id'=>$orderID,
			'boutique_measurement_type'=>$this->input->post('measurement_type'),'boutique_work_staff_amount'=>$this->input->post('boutique_work_staff_amount'),'boutique_work_purchase_amount'=>$this->input->post('boutique_work_purchase_amount'),
			'boutique_work_expense_amount'=>$this->input->post('boutique_work_expense_amount'),'boutique_stitching_options'=>@implode(',',@$this->input->post('boutique_stitching_options')) ,'boutique_work_handwork'=>$boutique_work_handwork,
			'boutique_work_material_remaining'=>$boutique_work_material_remaining,'boutique_work_trial_date'=>$trial_date,'boutique_work_due_date'=>$due_date
		);

		$this->db->insert('b_boutique_works',$data);
		$workID = $this->db->insert_id();

		if($this->input->post('orderid'))
		{
		    $price = ($price) ? $price : 0;
	    	$this->db->set('boutique_order_no_items', 'boutique_order_no_items+1', FALSE);
	    	$this->db->set('boutique_order_status', 1, FALSE);
	    	$this->db->set('boutique_order_grandtotal', 'boutique_order_grandtotal+'.$price, FALSE);
			$this->db->where('boutique_order_id', $this->input->post('orderid'));
			$this->db->update('b_boutique_orders');
	    }

	    //-------------------------------- for fulki studio - 27 -----------------------------------//
	    if($this->session->userdata('BoutiqueID') == 27){

	    	if($this->input->post('tailorid')){
		    	$data1 = array('boutique_tailor_id'=>$this->input->post('tailorid'),'boutique_work_id'=>$workID,'boutique_work_staff_hours'=>$this->input->post('tailor_staff_hours'),'boutique_work_staff_hourly_rate'=>$this->input->post('tailor_staff_hourly_rate'),'boutique_work_staff_amount'=>$this->input->post('tailor_staff_amount'),'boutique_staff_type'=>1);

				$this->db->insert('b_boutique_work_staffs',$data1);
			}

			if($this->input->post('boutique_tailor_id_d')){
		    	$data2 = array('boutique_tailor_id'=>$this->input->post('boutique_tailor_id_d'),'boutique_work_id'=>$workID,'boutique_work_staff_hours'=>$this->input->post('boutique_work_staff_hours_d'),'boutique_work_staff_hourly_rate'=>$this->input->post('boutique_work_staff_hourly_rate_d'),'boutique_work_staff_amount'=>$this->input->post('boutique_work_staff_amount_d'),'boutique_staff_type'=>2);

				$this->db->insert('b_boutique_work_staffs',$data2);
			}

			if($this->input->post('boutique_tailor_id_h')){
		    	$data3 = array('boutique_tailor_id'=>$this->input->post('boutique_tailor_id_h'),'boutique_work_id'=>$workID,'boutique_work_staff_hours'=>$this->input->post('boutique_work_staff_hours_h'),'boutique_work_staff_hourly_rate'=>$this->input->post('boutique_work_staff_hourly_rate_h'),'boutique_work_staff_amount'=>$this->input->post('boutique_work_staff_amount_h'),'boutique_staff_type'=>3);

				$this->db->insert('b_boutique_work_staffs',$data3);
			}

			if($this->input->post('boutique_tailor_id_m')){
		    	$data4 = array('boutique_tailor_id'=>$this->input->post('boutique_tailor_id_m'),'boutique_work_id'=>$workID,'boutique_work_staff_hours'=>$this->input->post('boutique_work_staff_hours_m'),'boutique_work_staff_hourly_rate'=>$this->input->post('boutique_work_staff_hourly_rate_m'),'boutique_work_staff_amount'=>$this->input->post('boutique_work_staff_amount_m'),'boutique_staff_type'=>4);

				$this->db->insert('b_boutique_work_staffs',$data4);
			}

			if($this->input->post('boutique_tailor_id_f')){
		    	$data4 = array('boutique_tailor_id'=>$this->input->post('boutique_tailor_id_f'),'boutique_work_id'=>$workID,'boutique_work_staff_hours'=>$this->input->post('boutique_work_staff_hours_f'),'boutique_work_staff_hourly_rate'=>$this->input->post('boutique_work_staff_hourly_rate_f'),'boutique_work_staff_amount'=>$this->input->post('boutique_work_staff_amount_f'),'boutique_staff_type'=>5);

				$this->db->insert('b_boutique_work_staffs',$data4);
			}

			//----------------- purchase order -------------------------------------------------

			$itemNameAry = $this->input->post('boutique_work_purchase_item_name');
			$itemDescAry = $this->input->post('boutique_work_purchase_item_desc');
			$itemPriceAry = $this->input->post('boutique_work_purchase_item_unitprice');

			foreach ($itemNameAry as $key => $itemName) {

				$datapurchase = array('boutique_work_purchase_item_name'=>$itemName,'boutique_work_id'=>$workID,'boutique_work_purchase_item_desc'=>$itemDescAry[$key],'boutique_work_purchase_item_unitprice'=>$itemPriceAry[$key],'boutique_work_purchase_item_total_amount'=>$itemPriceAry[$key]);

				$this->db->insert('b_boutique_work_purchase_items',$datapurchase);
				
			}



		  }

	    //-------------------------------- for fulki studio ---------------------------------------//


		//------------------------------- for aro b ara -33-----------------------------------//
	    if($this->session->userdata('BoutiqueID') == 33){

	    	if($this->input->post('tailorid')){
		    	$data1 = array('boutique_tailor_id'=>$this->input->post('tailorid'),'boutique_work_id'=>$workID,'boutique_work_staff_hours'=>'','boutique_work_staff_hourly_rate'=>'','boutique_work_staff_amount'=>'','boutique_staff_type'=>1);

				$this->db->insert('b_boutique_work_staffs',$data1);
			}

			if($this->input->post('boutique_tailor_id_d')){
		    	$data2 = array('boutique_tailor_id'=>$this->input->post('boutique_tailor_id_d'),'boutique_work_id'=>$workID,'boutique_work_staff_hours'=>'','boutique_work_staff_hourly_rate'=>'','boutique_work_staff_amount'=>'','boutique_staff_type'=>2);

				$this->db->insert('b_boutique_work_staffs',$data2);
			}

			if($this->input->post('boutique_tailor_id_h')){
		    	$data3 = array('boutique_tailor_id'=>$this->input->post('boutique_tailor_id_h'),'boutique_work_id'=>$workID,'boutique_work_staff_hours'=>'','boutique_work_staff_hourly_rate'=>'','boutique_work_staff_amount'=>'','boutique_staff_type'=>3);

				$this->db->insert('b_boutique_work_staffs',$data3);
			}

			if($this->input->post('boutique_tailor_id_m')){
		    	$data4 = array('boutique_tailor_id'=>$this->input->post('boutique_tailor_id_m'),'boutique_work_id'=>$workID,'boutique_work_staff_hours'=>'','boutique_work_staff_hourly_rate'=>'','boutique_work_staff_amount'=>'','boutique_staff_type'=>4);

				$this->db->insert('b_boutique_work_staffs',$data4);
			}

			$data5 = array();
			if($this->input->post('mt1_zip_4_1')){
				$data5[] = array('boutique_order_id'=>$orderID,
					'boutique_work_id'=>$workID,
					'boutique_order_customfield_key'=>'mt1_zip_4_1',
					'boutique_order_customfield_value'=>$this->input->post('mt1_zip_4_1')
				);
			}
			if($this->input->post('mt1_zip_4_2')){
				$data5[] = array('boutique_order_id'=>$orderID,
					'boutique_work_id'=>$workID,
					'boutique_order_customfield_key'=>'mt1_zip_4_2',
					'boutique_order_customfield_value'=>$this->input->post('mt1_zip_4_2')
				);
			}
			if($this->input->post('mt1_lining_4_1')){
				$data5[] = array('boutique_order_id'=>$orderID,
					'boutique_work_id'=>$workID,
					'boutique_order_customfield_key'=>'mt1_lining_4_1',
					'boutique_order_customfield_value'=>$this->input->post('mt1_lining_4_1')
				);
			}
			if($this->input->post('mt1_sleeve_4_1')){
				$data5[] = array('boutique_order_id'=>$orderID,
					'boutique_work_id'=>$workID,
					'boutique_order_customfield_key'=>'mt1_sleeve_4_1',
					'boutique_order_customfield_value'=>$this->input->post('mt1_sleeve_4_1')
				);
			}
			if($this->input->post('mt1_piping_4_1')){
				$data5[] = array('boutique_order_id'=>$orderID,
					'boutique_work_id'=>$workID,
					'boutique_order_customfield_key'=>'mt1_piping_4_1',
					'boutique_order_customfield_value'=>$this->input->post('mt1_piping_4_1')
				);
			}
			if($this->input->post('mt1_piping_4_2')){
				$data5[] = array('boutique_order_id'=>$orderID,
					'boutique_work_id'=>$workID,
					'boutique_order_customfield_key'=>'mt1_piping_4_2',
					'boutique_order_customfield_value'=>$this->input->post('mt1_piping_4_2')
				);
			}
			if($this->input->post('mt1_piping_4_3')){
				$data5[] = array('boutique_order_id'=>$orderID,
					'boutique_work_id'=>$workID,
					'boutique_order_customfield_key'=>'mt1_piping_4_3',
					'boutique_order_customfield_value'=>$this->input->post('mt1_piping_4_3')
				);
			}
			if($this->input->post('mt1_piping_4_4')){
				$data5[] = array('boutique_order_id'=>$orderID,
					'boutique_work_id'=>$workID,
					'boutique_order_customfield_key'=>'mt1_piping_4_4',
					'boutique_order_customfield_value'=>$this->input->post('mt1_piping_4_4')
				);
			}
			if($this->input->post('mt1_pad_4_1')){
				$data5[] = array('boutique_order_id'=>$orderID,
					'boutique_work_id'=>$workID,
					'boutique_order_customfield_key'=>'mt1_pad_4_1',
					'boutique_order_customfield_value'=>$this->input->post('mt1_pad_4_1')
				);
			}
			if($this->input->post('mt1_pad_4_3')){
				$data5[] = array('boutique_order_id'=>$orderID,
					'boutique_work_id'=>$workID,
					'boutique_order_customfield_key'=>'mt1_pad_4_3',
					'boutique_order_customfield_value'=>$this->input->post('mt1_pad_4_3')
				);
			}
			if($this->input->post('mt1_princess_cut_5_1')){
				$data5[] = array('boutique_order_id'=>$orderID,
					'boutique_work_id'=>$workID,
					'boutique_order_customfield_key'=>'mt1_princess_cut_5_1',
					'boutique_order_customfield_value'=>$this->input->post('mt1_princess_cut_5_1')
				);
			}
			if($this->input->post('mt1_princess_cut_5_2')){
				$data5[] = array('boutique_order_id'=>$orderID,
					'boutique_work_id'=>$workID,
					'boutique_order_customfield_key'=>'mt1_princess_cut_5_2',
					'boutique_order_customfield_value'=>$this->input->post('mt1_princess_cut_5_2')
				);
			}
			if($this->input->post('mt1_panel_cut_5_1')){
				$data5[] = array('boutique_order_id'=>$orderID,
					'boutique_work_id'=>$workID,
					'boutique_order_customfield_key'=>'mt1_panel_cut_5_1',
					'boutique_order_customfield_value'=>$this->input->post('mt1_panel_cut_5_1')
				);
			}
			if($this->input->post('mt1_panel_cut_5_2')){
				$data5[] = array('boutique_order_id'=>$orderID,
					'boutique_work_id'=>$workID,
					'boutique_order_customfield_key'=>'mt1_panel_cut_5_2',
					'boutique_order_customfield_value'=>$this->input->post('mt1_panel_cut_5_2')
				);
			}

			if($this->input->post('mt1_round_umbrella_5_1')){
				$data5[] = array('boutique_order_id'=>$orderID,
					'boutique_work_id'=>$workID,
					'boutique_order_customfield_key'=>'mt1_round_umbrella_5_1',
					'boutique_order_customfield_value'=>$this->input->post('mt1_round_umbrella_5_1')
				);
			}
			if($this->input->post('mt1_round_umbrella_5_2')){
				$data5[] = array('boutique_order_id'=>$orderID,
					'boutique_work_id'=>$workID,
					'boutique_order_customfield_key'=>'mt1_round_umbrella_5_2',
					'boutique_order_customfield_value'=>$this->input->post('mt1_round_umbrella_5_2')
				);
			}

			if($this->input->post('mt1_straight_umbrella_5_1')){
				$data5[] = array('boutique_order_id'=>$orderID,
					'boutique_work_id'=>$workID,
					'boutique_order_customfield_key'=>'mt1_straight_umbrella_5_1',
					'boutique_order_customfield_value'=>$this->input->post('mt1_straight_umbrella_5_1')
				);
			}
			if($this->input->post('mt1_straight_umbrella_5_2')){
				$data5[] = array('boutique_order_id'=>$orderID,
					'boutique_work_id'=>$workID,
					'boutique_order_customfield_key'=>'mt1_straight_umbrella_5_2',
					'boutique_order_customfield_value'=>$this->input->post('mt1_straight_umbrella_5_2')
				);
			}

			if($this->input->post('mt1_straight_kurta_5_1')){
				$data5[] = array('boutique_order_id'=>$orderID,
					'boutique_work_id'=>$workID,
					'boutique_order_customfield_key'=>'mt1_straight_kurta_5_1',
					'boutique_order_customfield_value'=>$this->input->post('mt1_straight_kurta_5_1')
				);
			}
			if($this->input->post('mt1_straight_kurta_5_2')){
				$data5[] = array('boutique_order_id'=>$orderID,
					'boutique_work_id'=>$workID,
					'boutique_order_customfield_key'=>'mt1_straight_kurta_5_2',
					'boutique_order_customfield_value'=>$this->input->post('mt1_straight_kurta_5_2')
				);
			}

			if($this->input->post('mt1_embroidery_5_1')){
				$data5[] = array('boutique_order_id'=>$orderID,
					'boutique_work_id'=>$workID,
					'boutique_order_customfield_key'=>'mt1_embroidery_5_1',
					'boutique_order_customfield_value'=>$this->input->post('mt1_embroidery_5_1')
				);
			}
			if($this->input->post('mt1_embroidery_5_2')){
				$data5[] = array('boutique_order_id'=>$orderID,
					'boutique_work_id'=>$workID,
					'boutique_order_customfield_key'=>'mt1_embroidery_5_2',
					'boutique_order_customfield_value'=>$this->input->post('mt1_embroidery_5_2')
				);
			}

			$this->db->insert_batch('b_boutique_order_customfields',$data5);

		  }

	    //-------------------------------- for ara b ara studio ---------------------------------------//

		return $orderID;
	}

	function m_getworkmeasurements($id) {
		$this->db->select( '*');
		$this->db->from('b_boutique_order_customfields');
		$this->db->where('boutique_work_id', $id);
		$q = $this->db->get();
		$data = $q->result_array();
		return @$data;
	}

	function  m_addpayment(){

			$total_bill = $this->input->post('boutique_order_grandtotal');
			$tillpaid = $this->input->post('boutique_order_amtpaid') + $this->input->post('amount_paid');
            $balance_for_pay=$total_bill- $tillpaid;
			if($total_bill <= $tillpaid){
				$paymentStatus = 3;
			}
			else{
				$paymentStatus = 2;
			}
			
	    	$this->db->set('boutique_order_amtpaid', 'boutique_order_amtpaid+'.$this->input->post('amount_paid'), FALSE);
	    	$this->db->set('boutique_order_payment_status', $paymentStatus, FALSE);
			$this->db->where('boutique_order_id', $this->input->post('orderid'));
			$this->db->update('b_boutique_orders');

			$data = array(
			'boutique_order_paymentamt'=>$this->input->post('amount_paid'),
			'boutique_order_paid_date'=>$this->input->post('paid_date'),
			'boutique_order_paymentdesc'=>$this->input->post('comments'),'boutique_order_id'=>$this->input->post('orderid'));
		$this->db->insert('b_boutique_order_payments',$data);
		$this->send_sms($this->input->post('orderid'),$this->input->post('amount_paid'),$balance_for_pay); //sending sms to customer

	}
    public function send_sms($orderid, $amount_paid,$balance_for_pay) // send sms if add payment is clicked.
	{
		$username = "boutiquemanagerin";
		$password = "Boutique@123#";
		$sender = "BTQMNG";

		$boutique = $this->m_getboutiquedetails();
		$orderdetails = $this->m_getordercusdetails($orderid);
		$number = $orderdetails['boutique_customer_ph'];

		if (@$orderdetails['boutique_order_form_number']) {
			$order_number = $orderdetails['boutique_order_form_number'];
		} else {
			$order_number = $orderdetails['boutique_order_number'];
		}
		if (@$number) {

			$customer = $orderdetails['boutique_customer_name'] ? ucwords($orderdetails['boutique_customer_name']) : 'Customer';
			$boutiquename = $boutique['boutique_name'];
	
				$message = "Dear " . $customer . ", \r\n \r\n";
				$message .= "Greetings from ".$boutiquename." !!! \r\n \r\n";
				$message .= "Your payment of Rs. " .  $amount_paid . "/- has been received. \r\n \r\n";
				$message .= "Pending amount on this bill is Rs. " . $balance_for_pay . "/- . \r\n \r\n";
				$message .= "Have a good day !!!\r\n \r\n";
			

			$url = "http://smsc.a4add.com/api/smsapi.aspx?username=BTQMNG&password=bonneyjp4*&to=" . urlencode($number) . "&from=MTQBPP&message=" . urlencode($message) . "";
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$curl_scraped_page = curl_exec($ch);
			curl_close($ch);
			$this->m_addstatusmsg($message, $orderdetails['boutique_customer_id'], $number, $curl_scraped_page);
		}

		return TRUE;
	}
    public function validatecurrentpassword($user_password){
        $query = $this->db->get_where('b_boutique_user', array('boutique_user_id' => $this->session->userdata('UserID')));
         $v_arr = $query->result();
        if (@$v_arr[0]->boutique_user_pwd == $user_password) {
            return TRUE;
        }
        else {
            return false;
        }

    }

    public function savepassword($user_password){
        $data = array('boutique_user_pwd'=>$user_password);
        $this->db->where('boutique_user_id', $this->session->userdata('UserID'));
		$this->db->update('b_boutique_user',$data);
		return TRUE;
    }
    
	function m_getallorders($customerid = NULL,$orderdate = NULL,$startdate = NULL,$enddate = NULL){
		$this->db->select( '*');
		$this->db->from('b_boutique_works bw');
		$this->db->join('b_boutique_orders bo', 'bw.boutique_order_id = bo.boutique_order_id');
		$this->db->join('b_boutique_customers bc', 'bw.boutique_customer_id = bc.boutique_customer_id');
		if(@$customerid){
			$this->db->where('bw.boutique_customer_id',$customerid);
		}
		if(@$orderdate){
			$this->db->where('bo.boutique_order_date',date('d/m/Y',strtotime($orderdate)));
		}
		
		if(@$startdate && @$enddate){
			//$this->db->where('bo.boutique_order_delivery_date >= ',date('d/m/Y',strtotime($startdate)));
			$this->db->where("STR_TO_DATE(bo.boutique_due_date, '%d/%m/%Y') BETWEEN STR_TO_DATE('".date('d/m/Y',strtotime($startdate))."', '%d/%m/%Y') AND STR_TO_DATE('".date('d/m/Y',strtotime($enddate))."', '%d/%m/%Y')");
		}
		
		$this->db->where('bo.boutique_id',$this->session->userdata('BoutiqueID'));
		$this->db->group_by("bw.boutique_order_id");
		$this->db->order_by("bo.boutique_order_id",'desc');
		$q = $this->db->get();
		$data = $q->result_array();
		return @$data;
	}

	function m_getorderdetails($orderid = NULL){
		$this->db->select( '*');
		$this->db->from('b_boutique_orders bo');
		$this->db->join('b_boutique b', 'b.boutique_id = bo.boutique_id');
		$this->db->join('b_boutique_works bw', 'bw.boutique_order_id = bo.boutique_order_id');
		$this->db->join('b_boutique_customers bc', 'bw.boutique_customer_id = bc.boutique_customer_id');
		$this->db->where('bo.boutique_order_id',$orderid);
		//$this->db->group_by("bo.boutique_order_id");
		$q = $this->db->get();
		$data = $q->result_array();
		return @$data[0];
	}

	function m_getallworks($orderid){
		$this->db->select( '*');
		$this->db->from('b_boutique_works bw');
		$this->db->join('b_boutique_orders bo', 'bw.boutique_order_id = bo.boutique_order_id');
		$this->db->join('b_boutique_customers bc', 'bw.boutique_customer_id = bc.boutique_customer_id');
		$this->db->where('bw.boutique_order_id',$orderid);
		$q = $this->db->get();
		$data = $q->result_array();
		return @$data;
	}

	function m_getallTailorworks($tailorId){
		$this->db->select( '*');
		$this->db->from('b_boutique_works bw');
		$this->db->join('b_boutique_customers bc', 'bw.boutique_customer_id = bc.boutique_customer_id');
		$this->db->where('bw.boutique_tailor_id',$tailorId);
		$q = $this->db->get();
		$data = $q->result_array();
		return @$data;
	}

	function m_gettodayworks() {
		$this->db->select( '*');
		$this->db->from('b_boutique_works bw');
		$this->db->join('b_boutique_orders bo', 'bw.boutique_order_id = bo.boutique_order_id');
		$this->db->join('b_boutique_customers bc', 'bw.boutique_customer_id = bc.boutique_customer_id');
        $this->db->where('bo.boutique_order_delivery_date',date('d/m/Y',time()));
        $this->db->where('bo.boutique_id',$this->session->userdata('BoutiqueID'));
        $this->db->group_by("bw.boutique_order_id");
		$q = $this->db->get();
		$data = $q->result_array();
		return @$data;
	}

	function m_gettomorrowworks() {
		$this->db->select( '*');
		$this->db->from('b_boutique_works bw');
		$this->db->join('b_boutique_orders bo', 'bw.boutique_order_id = bo.boutique_order_id');
		$this->db->join('b_boutique_customers bc', 'bw.boutique_customer_id = bc.boutique_customer_id');
        $this->db->where('bo.boutique_order_delivery_date',date('d/m/Y',strtotime(' +1 day')));
        $this->db->where('bo.boutique_id',$this->session->userdata('BoutiqueID'));
        $this->db->group_by("bw.boutique_order_id");
		$q = $this->db->get();
		$data = $q->result_array();
		return @$data;
	}
    /*
	function m_getwork($id) {
		$this->db->select( '*');
		$this->db->from('b_boutique_works bw');
		$this->db->join('b_boutique_customers bc', 'bw.boutique_customer_id = bc.boutique_customer_id');
		$this->db->join('b_boutique b', 'bw.boutique_id = b.boutique_id');
		$this->db->where('bw.boutique_work_id', $id);
		$q = $this->db->get();
		$data = $q->result_array();
		return @$data[0];
	}
    */
    function m_getwork($id) {
		$this->db->select( '*');
		$this->db->from('b_boutique_works bw');
		$this->db->join('b_boutique_customers bc', 'bw.boutique_customer_id = bc.boutique_customer_id');
		$this->db->join('b_boutique_orders bo', 'bw.boutique_order_id = bo.boutique_order_id');
		$this->db->join('b_boutique b', 'bw.boutique_id = b.boutique_id');
		$this->db->where('bw.boutique_work_id', $id);
		$q = $this->db->get();
		$data = $q->result_array();
		return @$data[0];
	}
	
	function m_getallpayments($orderid){
		$this->db->select( '*');
		$this->db->from('b_boutique_orders bo');
		$this->db->join('b_boutique_order_payments bp', 'bp.boutique_order_id = bo.boutique_order_id');
		$this->db->where('bp.boutique_order_id', $orderid);
		$q = $this->db->get();
		$data = $q->result_array();
		return @$data;
	}

	function m_updatework($id,$newfileName) {
	    
	    	    
	    if($this->session->userdata('UserID') ==136) {
	        @$gst==0;
	    $pricewithoutgst = $this->input->post('price');
	    $this->db->select( '*');
		$this->db->from('b_boutique_customers bcg');
		$this->db->where(array('bcg.boutique_id'=>$this->session->userdata('BoutiqueID'),'bcg.boutique_customer_id'=>$this->input->post('customerid')));
		$this->db->order_by("bcg.boutique_customer_id",'desc');
		$this->db->limit('1');
		$cusengst = $this->db->get();
		$gstdata = $cusengst->result_array();
		$gst_status = @$gstdata[0]['boutique_gst_status'];
	   if($gst_status==2){
	        $gst=round(($pricewithoutgst*(18/100)),2);
			$price=$pricewithoutgst+$gst;
		}
		if($gst_status==0){
	        $gst=round(($pricewithoutgst*(19/100)),2);
			$price=$pricewithoutgst;
		}
		if($gst_status==1){
	        $gst=round(($pricewithoutgst*(19/100)),2);
			$price=$pricewithoutgst+$gst;

	    }
	    }
        else{
		$price = $this->input->post('price');
        }
	    
		$workname = $this->input->post('workname');
		$customerid = $this->input->post('customerid');
	//	$price = $this->input->post('price');
		$order_date = $this->input->post('order_date');
		$delivery_date = $this->input->post('delivery_date');
		$due_date = $this->input->post('due_date');
		$comments = $this->input->post('comments');
		$tailorid = $this->input->post('tailorid');
		$boutique_work_status = $this->input->post('boutique_work_status');


		
		$boutique_work_handwork = $this->input->post('boutique_work_handwork');
		$boutique_work_material_remaining = $this->input->post('boutique_work_material_remaining');

		$totalPrice = $price + (int)$boutique_work_handwork + (int)$boutique_work_material_remaining;
		
		$workdetails = $this->m_getwork($id);
		//for update due date
		$this->db->set('boutique_due_date',$due_date);
		$this->db->where('boutique_order_id', $this->input->post('boutique_order_id'));
		$this->db->update('b_boutique_orders');
		///end due date updation
		if($price != $workdetails['boutique_work_price']){
			if($price > $workdetails['boutique_work_price']){
				$changeAmt = $price - $workdetails['boutique_work_price'];
				$this->db->set('boutique_due_date',$due_date);
				$this->db->set('boutique_order_payment_status', 2, FALSE);
				$this->db->set('boutique_order_grandtotal', 'boutique_order_grandtotal+'.$changeAmt, FALSE);
				$this->db->where('boutique_order_id', $this->input->post('boutique_order_id'));
				$this->db->update('b_boutique_orders');
			}
			else{
				$changeAmt = $workdetails['boutique_work_price'] - $price;
				$this->db->set('boutique_due_date',$due_date);
				$this->db->set('boutique_order_payment_status', 2, FALSE);
				$this->db->set('boutique_order_grandtotal', 'boutique_order_grandtotal-'.$changeAmt, FALSE);
				$this->db->where('boutique_order_id', $this->input->post('boutique_order_id'));
				$this->db->update('b_boutique_orders');
			}
		}

		// Update work details Update query additioal

$totalPrice = $price + (int)$boutique_work_handwork + (int)$boutique_work_material_remaining;

		$updateorderdata = array(
		 'price_without_gst'=>$this->input->post('price'),
		'boutique_order_grandtotal'=>$totalPrice,
		'rent_from_date'=>@$this->input->post('rent_from_date'),
		'rent_to_date'=>@$this->input->post('rent_to_date'),
		'rent_discount'=>@$this->input->post('discount'),
		'rent_month'=>@$this->input->post('month_name'),
		'b_boutique_orders_tdf'=>@$this->input->post('price_tdf')
	);	
	$this->db->where('boutique_order_id', $this->input->post('boutique_order_id'));			
		$this->db->update('b_boutique_orders',$updateorderdata);


		if($boutique_work_handwork != $workdetails['boutique_work_handwork']){
			if($boutique_work_handwork > $workdetails['boutique_work_handwork']){
				$changehAmt = (int)$boutique_work_handwork - (int)$workdetails['boutique_work_handwork'];
				$this->db->set('boutique_order_payment_status', 2, FALSE);
				$this->db->set('boutique_order_grandtotal', 'boutique_order_grandtotal+'.$changehAmt, FALSE);
				$this->db->where('boutique_order_id', $this->input->post('boutique_order_id'));
				$this->db->update('b_boutique_orders');
			}
			else{
				$changehAmt = (int)$workdetails['boutique_work_handwork'] - (int)$boutique_work_handwork;
				$this->db->set('boutique_order_payment_status', 2, FALSE);
				$this->db->set('boutique_order_grandtotal', 'boutique_order_grandtotal-'.$changehAmt, FALSE);
				$this->db->where('boutique_order_id', $this->input->post('boutique_order_id'));
				$this->db->update('b_boutique_orders');
			}
		}

		if($boutique_work_material_remaining != $workdetails['boutique_work_material_remaining']){
			if($boutique_work_material_remaining > $workdetails['boutique_work_material_remaining']){
				$changemAmt = (int)$boutique_work_material_remaining - (int)$workdetails['boutique_work_material_remaining'];
				$this->db->set('boutique_order_payment_status', 2, FALSE);
				$this->db->set('boutique_order_grandtotal', 'boutique_order_grandtotal+'.$changemAmt, FALSE);
				$this->db->where('boutique_order_id', $this->input->post('boutique_order_id'));
				$this->db->update('b_boutique_orders');
			}
			else{
				$changemAmt = (int)$workdetails['boutique_work_material_remaining'] - (int)$boutique_work_material_remaining;
				$this->db->set('boutique_order_payment_status', 2, FALSE);
				$this->db->set('boutique_order_grandtotal', 'boutique_order_grandtotal-'.$changemAmt, FALSE);
				$this->db->where('boutique_order_id', $this->input->post('boutique_order_id'));
				$this->db->update('b_boutique_orders');
			}
		}

		if($newfileName == "") {
			$data = array('boutique_work_name'=>ucfirst($workname),'boutique_customer_id'=>$customerid,'boutique_work_price'=>$price,'boutique_work_order_date'=>$order_date,'boutique_work_delivery_date'=>$delivery_date,
				'boutique_tailor_id'=>$tailorid,'boutique_work_material_desc'=>$comments,'boutique_work_status'=>$boutique_work_status,'boutique_measurement_type'=>$this->input->post('measurement_type'),'boutique_work_staff_amount'=>$this->input->post('boutique_work_staff_amount'),'boutique_work_purchase_amount'=>$this->input->post('boutique_work_purchase_amount'),'boutique_work_expense_amount'=>$this->input->post('boutique_work_expense_amount'),'boutique_stitching_options'=>@implode(',',@$this->input->post('boutique_stitching_options')),
				'boutique_work_handwork'=>$boutique_work_handwork,
			'boutique_work_material_remaining'=>$boutique_work_material_remaining,'boutique_work_due_date'=>$due_date);
		}
		else {
			$data = array('boutique_work_name'=>ucfirst($workname),'boutique_customer_id'=>$customerid,'boutique_work_price'=>$price,'boutique_work_order_date'=>$order_date,'boutique_work_delivery_date'=>$delivery_date,
				'boutique_tailor_id'=>$tailorid,'boutique_work_material_desc'=>$comments,'boutique_work_image'=>$newfileName,'boutique_work_status'=>$boutique_work_status,'boutique_measurement_type'=>$this->input->post('measurement_type'),'boutique_work_staff_amount'=>$this->input->post('boutique_work_staff_amount'),'boutique_work_purchase_amount'=>$this->input->post('boutique_work_purchase_amount'),'boutique_work_expense_amount'=>$this->input->post('boutique_work_expense_amount'),'boutique_stitching_options'=>@implode(',',@$this->input->post('boutique_stitching_options')),
			'boutique_work_handwork'=>$boutique_work_handwork,
			'boutique_work_material_remaining'=>$boutique_work_material_remaining,'boutique_work_due_date'=>$due_date
		);
		}
		$this->db->where('boutique_work_id', $id);
		$this->db->update('b_boutique_works',$data);

		$workID = $id;

		//-------------------------------- for fulki studio - 27 -----------------------------------//
			if($this->session->userdata('BoutiqueID') == 27){

			$this->db->where('boutique_work_id', $id);
			$this->db->delete('b_boutique_work_staffs');

	    	if($this->input->post('tailorid')){
		    	$data1 = array('boutique_tailor_id'=>$this->input->post('tailorid'),'boutique_work_id'=>$workID,'boutique_work_staff_hours'=>$this->input->post('tailor_staff_hours'),'boutique_work_staff_hourly_rate'=>$this->input->post('tailor_staff_hourly_rate'),'boutique_work_staff_amount'=>$this->input->post('tailor_staff_amount'),'boutique_staff_type'=>1);

				$this->db->insert('b_boutique_work_staffs',$data1);
			}

			if($this->input->post('boutique_tailor_id_d')){
		    	$data2 = array('boutique_tailor_id'=>$this->input->post('boutique_tailor_id_d'),'boutique_work_id'=>$workID,'boutique_work_staff_hours'=>$this->input->post('boutique_work_staff_hours_d'),'boutique_work_staff_hourly_rate'=>$this->input->post('boutique_work_staff_hourly_rate_d'),'boutique_work_staff_amount'=>$this->input->post('boutique_work_staff_amount_d'),'boutique_staff_type'=>2);

				$this->db->insert('b_boutique_work_staffs',$data2);
			}

			if($this->input->post('boutique_tailor_id_h')){
		    	$data3 = array('boutique_tailor_id'=>$this->input->post('boutique_tailor_id_h'),'boutique_work_id'=>$workID,'boutique_work_staff_hours'=>$this->input->post('boutique_work_staff_hours_h'),'boutique_work_staff_hourly_rate'=>$this->input->post('boutique_work_staff_hourly_rate_h'),'boutique_work_staff_amount'=>$this->input->post('boutique_work_staff_amount_h'),'boutique_staff_type'=>3);

				$this->db->insert('b_boutique_work_staffs',$data3);
			}

			if($this->input->post('boutique_tailor_id_m')){
		    	$data4 = array('boutique_tailor_id'=>$this->input->post('boutique_tailor_id_m'),'boutique_work_id'=>$workID,'boutique_work_staff_hours'=>$this->input->post('boutique_work_staff_hours_m'),'boutique_work_staff_hourly_rate'=>$this->input->post('boutique_work_staff_hourly_rate_m'),'boutique_work_staff_amount'=>$this->input->post('boutique_work_staff_amount_m'),'boutique_staff_type'=>4);

				$this->db->insert('b_boutique_work_staffs',$data4);
			}

			if($this->input->post('boutique_tailor_id_f')){
		    	$data4 = array('boutique_tailor_id'=>$this->input->post('boutique_tailor_id_f'),'boutique_work_id'=>$workID,'boutique_work_staff_hours'=>$this->input->post('boutique_work_staff_hours_f'),'boutique_work_staff_hourly_rate'=>$this->input->post('boutique_work_staff_hourly_rate_f'),'boutique_work_staff_amount'=>$this->input->post('boutique_work_staff_amount_f'),'boutique_staff_type'=>5);

				$this->db->insert('b_boutique_work_staffs',$data4);
			}

			//----------------- purchase order -------------------------------------------------

			$this->db->where('boutique_work_id', $id);
			$this->db->delete('b_boutique_work_purchase_items');

			$itemNameAry = $this->input->post('boutique_work_purchase_item_name');
			$itemDescAry = $this->input->post('boutique_work_purchase_item_desc');
			$itemPriceAry = $this->input->post('boutique_work_purchase_item_unitprice');

			foreach ($itemNameAry as $key => $itemName) {

				$datapurchase = array('boutique_work_purchase_item_name'=>$itemName,'boutique_work_id'=>$workID,'boutique_work_purchase_item_desc'=>$itemDescAry[$key],'boutique_work_purchase_item_unitprice'=>$itemPriceAry[$key],'boutique_work_purchase_item_total_amount'=>$itemPriceAry[$key]);

				$this->db->insert('b_boutique_work_purchase_items',$datapurchase);
				
			}


		  }

	    //-------------------------------- for fulki studio ---------------------------------------//

				//------------------------------- for aro b ara -33-----------------------------------//
	    if($this->session->userdata('BoutiqueID') == 33){

	    	$this->db->where('boutique_work_id', $id);
			$this->db->delete('b_boutique_work_staffs');

			$this->db->where('boutique_work_id', $id);
			$this->db->delete('b_boutique_order_customfields');

			$orderID = $this->input->post('boutique_order_id');
			
	    	if($this->input->post('tailorid')){
		    	$data1 = array('boutique_tailor_id'=>$this->input->post('tailorid'),'boutique_work_id'=>$workID,'boutique_work_staff_hours'=>'','boutique_work_staff_hourly_rate'=>'','boutique_work_staff_amount'=>'','boutique_staff_type'=>1);

				$this->db->insert('b_boutique_work_staffs',$data1);
			}

			if($this->input->post('boutique_tailor_id_d')){
		    	$data2 = array('boutique_tailor_id'=>$this->input->post('boutique_tailor_id_d'),'boutique_work_id'=>$workID,'boutique_work_staff_hours'=>'','boutique_work_staff_hourly_rate'=>'','boutique_work_staff_amount'=>'','boutique_staff_type'=>2);

				$this->db->insert('b_boutique_work_staffs',$data2);
			}

			if($this->input->post('boutique_tailor_id_h')){
		    	$data3 = array('boutique_tailor_id'=>$this->input->post('boutique_tailor_id_h'),'boutique_work_id'=>$workID,'boutique_work_staff_hours'=>'','boutique_work_staff_hourly_rate'=>'','boutique_work_staff_amount'=>'','boutique_staff_type'=>3);

				$this->db->insert('b_boutique_work_staffs',$data3);
			}

			if($this->input->post('boutique_tailor_id_m')){
		    	$data4 = array('boutique_tailor_id'=>$this->input->post('boutique_tailor_id_m'),'boutique_work_id'=>$workID,'boutique_work_staff_hours'=>'','boutique_work_staff_hourly_rate'=>'','boutique_work_staff_amount'=>'','boutique_staff_type'=>4);

				$this->db->insert('b_boutique_work_staffs',$data4);
			}

			$data5 = array();
			if($this->input->post('mt1_zip_4_1')){
				$data5[] = array('boutique_order_id'=>$orderID,
					'boutique_work_id'=>$workID,
					'boutique_order_customfield_key'=>'mt1_zip_4_1',
					'boutique_order_customfield_value'=>$this->input->post('mt1_zip_4_1')
				);
			}
			if($this->input->post('mt1_zip_4_2')){
				$data5[] = array('boutique_order_id'=>$orderID,
					'boutique_work_id'=>$workID,
					'boutique_order_customfield_key'=>'mt1_zip_4_2',
					'boutique_order_customfield_value'=>$this->input->post('mt1_zip_4_2')
				);
			}
			if($this->input->post('mt1_lining_4_1')){
				$data5[] = array('boutique_order_id'=>$orderID,
					'boutique_work_id'=>$workID,
					'boutique_order_customfield_key'=>'mt1_lining_4_1',
					'boutique_order_customfield_value'=>$this->input->post('mt1_lining_4_1')
				);
			}
			if($this->input->post('mt1_sleeve_4_1')){
				$data5[] = array('boutique_order_id'=>$orderID,
					'boutique_work_id'=>$workID,
					'boutique_order_customfield_key'=>'mt1_sleeve_4_1',
					'boutique_order_customfield_value'=>$this->input->post('mt1_sleeve_4_1')
				);
			}
			if($this->input->post('mt1_piping_4_1')){
				$data5[] = array('boutique_order_id'=>$orderID,
					'boutique_work_id'=>$workID,
					'boutique_order_customfield_key'=>'mt1_piping_4_1',
					'boutique_order_customfield_value'=>$this->input->post('mt1_piping_4_1')
				);
			}
			if($this->input->post('mt1_piping_4_2')){
				$data5[] = array('boutique_order_id'=>$orderID,
					'boutique_work_id'=>$workID,
					'boutique_order_customfield_key'=>'mt1_piping_4_2',
					'boutique_order_customfield_value'=>$this->input->post('mt1_piping_4_2')
				);
			}
			if($this->input->post('mt1_piping_4_3')){
				$data5[] = array('boutique_order_id'=>$orderID,
					'boutique_work_id'=>$workID,
					'boutique_order_customfield_key'=>'mt1_piping_4_3',
					'boutique_order_customfield_value'=>$this->input->post('mt1_piping_4_3')
				);
			}
			if($this->input->post('mt1_piping_4_4')){
				$data5[] = array('boutique_order_id'=>$orderID,
					'boutique_work_id'=>$workID,
					'boutique_order_customfield_key'=>'mt1_piping_4_4',
					'boutique_order_customfield_value'=>$this->input->post('mt1_piping_4_4')
				);
			}
			if($this->input->post('mt1_pad_4_1')){
				$data5[] = array('boutique_order_id'=>$orderID,
					'boutique_work_id'=>$workID,
					'boutique_order_customfield_key'=>'mt1_pad_4_1',
					'boutique_order_customfield_value'=>$this->input->post('mt1_pad_4_1')
				);
			}
			if($this->input->post('mt1_pad_4_3')){
				$data5[] = array('boutique_order_id'=>$orderID,
					'boutique_work_id'=>$workID,
					'boutique_order_customfield_key'=>'mt1_pad_4_3',
					'boutique_order_customfield_value'=>$this->input->post('mt1_pad_4_3')
				);
			}
			if($this->input->post('mt1_princess_cut_5_1')){
				$data5[] = array('boutique_order_id'=>$orderID,
					'boutique_work_id'=>$workID,
					'boutique_order_customfield_key'=>'mt1_princess_cut_5_1',
					'boutique_order_customfield_value'=>$this->input->post('mt1_princess_cut_5_1')
				);
			}
			if($this->input->post('mt1_princess_cut_5_2')){
				$data5[] = array('boutique_order_id'=>$orderID,
					'boutique_work_id'=>$workID,
					'boutique_order_customfield_key'=>'mt1_princess_cut_5_2',
					'boutique_order_customfield_value'=>$this->input->post('mt1_princess_cut_5_2')
				);
			}
			if($this->input->post('mt1_panel_cut_5_1')){
				$data5[] = array('boutique_order_id'=>$orderID,
					'boutique_work_id'=>$workID,
					'boutique_order_customfield_key'=>'mt1_panel_cut_5_1',
					'boutique_order_customfield_value'=>$this->input->post('mt1_panel_cut_5_1')
				);
			}
			if($this->input->post('mt1_panel_cut_5_2')){
				$data5[] = array('boutique_order_id'=>$orderID,
					'boutique_work_id'=>$workID,
					'boutique_order_customfield_key'=>'mt1_panel_cut_5_2',
					'boutique_order_customfield_value'=>$this->input->post('mt1_panel_cut_5_2')
				);
			}

			if($this->input->post('mt1_round_umbrella_5_1')){
				$data5[] = array('boutique_order_id'=>$orderID,
					'boutique_work_id'=>$workID,
					'boutique_order_customfield_key'=>'mt1_round_umbrella_5_1',
					'boutique_order_customfield_value'=>$this->input->post('mt1_round_umbrella_5_1')
				);
			}
			if($this->input->post('mt1_round_umbrella_5_2')){
				$data5[] = array('boutique_order_id'=>$orderID,
					'boutique_work_id'=>$workID,
					'boutique_order_customfield_key'=>'mt1_round_umbrella_5_2',
					'boutique_order_customfield_value'=>$this->input->post('mt1_round_umbrella_5_2')
				);
			}

			if($this->input->post('mt1_straight_umbrella_5_1')){
				$data5[] = array('boutique_order_id'=>$orderID,
					'boutique_work_id'=>$workID,
					'boutique_order_customfield_key'=>'mt1_straight_umbrella_5_1',
					'boutique_order_customfield_value'=>$this->input->post('mt1_straight_umbrella_5_1')
				);
			}
			if($this->input->post('mt1_straight_umbrella_5_2')){
				$data5[] = array('boutique_order_id'=>$orderID,
					'boutique_work_id'=>$workID,
					'boutique_order_customfield_key'=>'mt1_straight_umbrella_5_2',
					'boutique_order_customfield_value'=>$this->input->post('mt1_straight_umbrella_5_2')
				);
			}

			if($this->input->post('mt1_straight_kurta_5_1')){
				$data5[] = array('boutique_order_id'=>$orderID,
					'boutique_work_id'=>$workID,
					'boutique_order_customfield_key'=>'mt1_straight_kurta_5_1',
					'boutique_order_customfield_value'=>$this->input->post('mt1_straight_kurta_5_1')
				);
			}
			if($this->input->post('mt1_straight_kurta_5_2')){
				$data5[] = array('boutique_order_id'=>$orderID,
					'boutique_work_id'=>$workID,
					'boutique_order_customfield_key'=>'mt1_straight_kurta_5_2',
					'boutique_order_customfield_value'=>$this->input->post('mt1_straight_kurta_5_2')
				);
			}

			if($this->input->post('mt1_embroidery_5_1')){
				$data5[] = array('boutique_order_id'=>$orderID,
					'boutique_work_id'=>$workID,
					'boutique_order_customfield_key'=>'mt1_embroidery_5_1',
					'boutique_order_customfield_value'=>$this->input->post('mt1_embroidery_5_1')
				);
			}
			if($this->input->post('mt1_embroidery_5_2')){
				$data5[] = array('boutique_order_id'=>$orderID,
					'boutique_work_id'=>$workID,
					'boutique_order_customfield_key'=>'mt1_embroidery_5_2',
					'boutique_order_customfield_value'=>$this->input->post('mt1_embroidery_5_2')
				);
			}

			$this->db->insert_batch('b_boutique_order_customfields',$data5);

		  }

	    //-------------------------------- for ara b ara studio ---------------------------------------//


		if(@$boutique_work_status > 1){
			$i = 1;
			$j = 1;
			$works = $this->getworkbyorderid($this->input->post('boutique_order_id'));
			foreach($works as $work){
				if($work['boutique_work_status'] != 3){
					$i++;
				}
			}
			foreach($works as $work){
				if($work['boutique_work_status'] != 4){
					$j++;
				}
			}

			if($i == 1){
				$this->db->set('boutique_order_status', 3 , FALSE);
				$this->db->where('boutique_order_id', $this->input->post('boutique_order_id'));
				$this->db->update('b_boutique_orders');
			}
			elseif($j == 1){
				$this->db->set('boutique_order_status', 4 , FALSE);
				$this->db->where('boutique_order_id', $this->input->post('boutique_order_id'));
				$this->db->update('b_boutique_orders');
			}
			else{
				$this->db->set('boutique_order_status', 2 , FALSE);
				$this->db->where('boutique_order_id', $this->input->post('boutique_order_id'));
				$this->db->update('b_boutique_orders');
			}
		}

		$orderdata = array(
			'boutique_order_date'=>$order_date,
			'boutique_order_delivery_date'=>$delivery_date,
			'boutique_order_form_number'=>$this->input->post('boutique_order_form_number')
		);

		$this->db->where('boutique_order_id', $this->input->post('boutique_order_id'));
		$this->db->update('b_boutique_orders',$orderdata);

		return TRUE;
	}
	
	function m_removework($id) {
		$img_name = $this->getimagebyworkid($id);
		$uploaddir = $this->config->item('project_path')."uploads/work/";
		$uploadfile = $uploaddir . $img_name["boutique_work_image"];
		@unlink($uploadfile);
		$this->db->where('boutique_work_id', $id);
		$this->db->delete('b_boutique_works');

		$this->db->where('boutique_work_id', $id);
		$this->db->delete('b_boutique_work_staffs');

		$this->db->where('boutique_work_id', $id);
		$this->db->delete('b_boutique_work_purchase_items');

		$this->db->set('boutique_order_no_items', 'boutique_order_no_items-1', FALSE);
		$this->db->set('boutique_order_grandtotal', 'boutique_order_grandtotal-'.$img_name["boutique_work_price"], FALSE);
		$this->db->where('boutique_order_id', $img_name["boutique_order_id"]);
		$this->db->update('b_boutique_orders');

		//-------------- order status check --------------------------------------
			$i = 1;
			$j = 1;
			$works = $this->getworkbyorderid($img_name["boutique_order_id"]);
			foreach($works as $work){
				if($work['boutique_work_status'] != 3){
					$i++;
				}
			}
			foreach($works as $work){
				if($work['boutique_work_status'] != 4){
					$j++;
				}
			}

			if($i == 1){
				$this->db->set('boutique_order_status', 3 , FALSE);
				$this->db->where('boutique_order_id', $img_name["boutique_order_id"]);
				$this->db->update('b_boutique_orders');
			}
			elseif($j == 1){
				$this->db->set('boutique_order_status', 4 , FALSE);
				$this->db->where('boutique_order_id', $img_name["boutique_order_id"]);
				$this->db->update('b_boutique_orders');
			}
			else{
				$this->db->set('boutique_order_status', 2 , FALSE);
				$this->db->where('boutique_order_id', $img_name["boutique_order_id"]);
				$this->db->update('b_boutique_orders');
			}

			//-------------------------------------------------------------------------------

		return $img_name['boutique_order_id'];
	}

	function m_removeorder($id) {
		$works = $this->getworkbyorderid($id);
		foreach($works as $work){
			$img_name = $this->getimagebyworkid($work['boutique_work_id']);
			$uploaddir = $this->config->item('project_path')."uploads/work/";
			$uploadfile = $uploaddir . $img_name["boutique_work_image"];
			@unlink($uploadfile);
			$this->db->where('boutique_work_id', $work['boutique_work_id']);
			$this->db->delete('b_boutique_works');
		}
		$this->db->where('boutique_order_id', $id);
		$this->db->delete('b_boutique_orders');

		$this->db->where('boutique_order_id', $id);
		$this->db->delete('b_boutique_order_payments');

		return TRUE;
	}

	function getworkbyorderid($id) {
		$this->db->select( 'boutique_work_id,boutique_work_status');
		$this->db->from('b_boutique_works');
		$this->db->where('boutique_order_id', $id);
		$q = $this->db->get();
		$data = $q->result_array();
		return @$data;
	}

	function getimagebyworkid($id) {
		$this->db->select( 'boutique_work_image,boutique_order_id,boutique_work_price');
		$this->db->from('b_boutique_works');
		$this->db->where('boutique_work_id', $id);
		$q = $this->db->get();
		$data = $q->result_array();
		return @$data[0];
	}
	function m_getcustomername($id) {
		$this->db->select( 'boutique_customer_name');
		$this->db->from('b_boutique_customers');
		$this->db->where('boutique_customer_id', $id);
		$q = $this->db->get();
		$data = $q->result_array();
		return @$data[0];
	}
	function m_gettailorname($id) {
		$this->db->select( 'boutique_tailor_username');
		$this->db->from('b_boutique_tailor');
		$this->db->where('boutique_tailor_id', $id);
		$q = $this->db->get();
		$data = $q->result_array();
		return @$data[0];
	}


	function m_getworkstaffwithtype($id,$workid) {
		$this->db->select( '*');
		$this->db->from('b_boutique_work_staffs ws');
	$this->db->join(' b_boutique_tailor bt', 'bt.boutique_tailor_id = ws.boutique_tailor_id', 'left');
		$this->db->where('ws.boutique_work_id', $workid);
		$this->db->where('ws.boutique_staff_type', $id);
		$q = $this->db->get();
		$data = $q->result_array();
		return @$data[0];
	}

	function m_getworkpurchaseitem($workid) {
		$this->db->select( '*');
		$this->db->from('b_boutique_work_purchase_items');
		$this->db->where('boutique_work_id', $workid);
		$q = $this->db->get();
		$data = $q->result_array();
		return @$data;
	}

	function m_getboutiquedetails(){
		$this->db->select('*');
		$this->db->from('b_boutique');
		$this->db->where('boutique_id', $this->session->userdata('BoutiqueID'));
		$q = $this->db->get();
		$data = $q->result_array();
		return @$data[0];
	}

	function m_getordercusdetails($orderid){
		$this->db->select('*');
		$this->db->from('b_boutique_orders o');
		$this->db->join('b_boutique_works w', 'o.boutique_order_id = w.boutique_order_id');
		$this->db->join('b_boutique_customers c', 'w.boutique_customer_id = c.boutique_customer_id', 'left');
		$this->db->where('o.boutique_order_id', $orderid);
		$this->db->group_by("w.boutique_order_id");
		$q = $this->db->get();
		$data = $q->result_array();
		return @$data[0];
	}
    
    function m_getsalecusdetails($saleid){
		$this->db->select('*');
		$this->db->from('b_boutique_sales s');
		$this->db->join('b_boutique_customers c', 's.boutique_customer_id = c.boutique_customer_id', 'left');
		$this->db->where('s.boutique_sale_id', $saleid);
		$q = $this->db->get();
		$data = $q->result_array();
		return @$data[0];
	}
	
	function m_addstatusmsg($message,$customer_id,$number,$curl_scraped_page){
		$data = array('boutique_message_text'=>$message,'boutique_message_phone'=>$number,'boutique_message_customerid'=>$customer_id,'boutique_message_type'=>1,'boutique_message_response_details'=>$curl_scraped_page,'boutique_message_gateway'=>'bulksmsgateway','boutique_id'=>$this->session->userdata('BoutiqueID'));

		$this->db->insert('b_boutique_messages',$data);
		return TRUE;

	}

	public function getreports() {
       $this->db->select("*");
       $this->db->from('b_boutique_works bw');
	   $this->db->join('b_boutique_customers bc', 'bw.boutique_customer_id = bc.boutique_customer_id');
       $this->db->where("bw.boutique_id", $this->session->userdata('BoutiqueID'));

       if(@$this->input->post('date_from_report') && @$this->input->post('date_to_report')){
          $this->db->where("STR_TO_DATE(bw.boutique_work_order_date, '%d/%m/%Y') BETWEEN STR_TO_DATE('".$this->input->post('date_from_report')."', '%d/%m/%Y') AND STR_TO_DATE('".$this->input->post('date_to_report')."', '%d/%m/%Y')");
       }

       $q = $this->db->get();
       $data = $q->result_array();
       return @$data;
   }
   	function m_getpropertyname($id) {
		$this->db->select('*');
		$this->db->from('b_boutique_properties');
		$this->db->where('boutique_property_id', $id);
		$q = $this->db->get();
		$data = $q->result_array();
		return @$data[0];
	}
	public function m_getallmonthreport($id)
	{
		$this->db->select("*");
		$this->db->from('b_builders_attendanace ba');
		$this->db->join('b_boutique_tailor bt', 'ba.user_id = bt.boutique_tailor_id');
		$this->db->where('ba.user_id', $id);
		$q = $this->db->get();
		$data = $q->result_array();
		return @$data;
		
	}


	// new function
	
	////\\//\\//\\//\\//
}
?>