<?php
class Billing_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    /*Sales*/
    function m_loadcustomers($id) {
        $custData=array();
		$this->db->select( '*');
		$this->db->from('b_boutique_customers');
		$this->db->where('boutique_id', $this->session->userdata('BoutiqueID'));
		$this->db->like('boutique_customer_id', $id);
		$q = $this->db->get();
		$data = $q->result_array();

		return json_encode($data[0]);
	}

    function getSkuItem($sku) {
        $custData=array();
		$this->db->select( '*');
		$this->db->from('b_boutique_items bi');
    $this->db->join('b_boutique_tax bt', 'bi.boutique_tax_id = bt.boutique_tax_id', 'left');
		$this->db->where('bi.boutique_id', $this->session->userdata('BoutiqueID'));

		$this->db->where('bi.boutique_item_code', $sku);
    $this->db->or_where('bi.boutique_item_barcode', $sku);
		$q = $this->db->get();
		$data = $q->row_array();
		return json_encode($data);
	}
	
	  function getitemssearch($keyword){
    $this->db->select( 'boutique_item_name,boutique_item_code');
    $this->db->from('b_boutique_items bi');
    $this->db->where('bi.boutique_id', $this->session->userdata('BoutiqueID'));
    $this->db->where("bi.boutique_item_total_remaining >", 0);
    $this->db->like('bi.boutique_item_name', $keyword);
    $q = $this->db->get();
    $data = $q->result_array();
    return $data;
  }
  
    /*****************Starts Tax Section*****************/
    public function getTaxrate() {
		   $this->db->select('*');
       $this->db->where("boutique_id", $this->session->userdata('BoutiqueID'));
       $q = $this->db->get('b_boutique_tax');
       $data = $q->result_array();
       return @$data;
   }
    public function addTaxRate(){
      $CI = & get_instance();
      $taxData = array(
        'boutique_tax_name'=>$this->input->post('tax_name'),        
        'boutique_tax_rate'=>$this->input->post('tax_rate'),        
        'boutique_id'=>$this->session->userdata('BoutiqueID')
      );
      $this->db->insert('b_boutique_tax',$taxData);
      $esID = $this->db->insert_id();
      return $esID;
    }
    public function removeTaxRate($id) {
      $this->db->where('boutique_tax_id', $id);
      $this->db->delete('b_boutique_tax');
      return true;
    }
    /*****************Ends Tax Section*****************/
/*****************Starts Expence Category*****************/
    public function getexpencecategories() {
		   $this->db->select('*');
       $this->db->where("boutique_id", $this->session->userdata('BoutiqueID'));
       $this->db->where("boutique_billing_head_type",1);
       
       $q = $this->db->get('b_boutique_billing_heads');
       $data = $q->result_array();
       return @$data;
   }
    public function addexpencecategories(){
      $CI = & get_instance();
      $expencecatData = array(
        'boutique_billing_head_name'=>$this->input->post('head_name'),    
        'boutique_billing_head_type'=>1,    
            
        'boutique_id'=>$this->session->userdata('BoutiqueID')
      );
      $this->db->insert('b_boutique_billing_heads',$expencecatData);
      $esID = $this->db->insert_id();
      return $esID;
    }
    public function removeexpencecategory($id) {
      $this->db->where('boutique_billing_head_id', $id);
      $this->db->delete('b_boutique_billing_heads');
      return true;
    }
    /*****************Ends Expence Category*****************/

   public function getexpences($id = NULL) {
       $this->db->select('*');
        $this->db->from('b_boutique_expenses bx');
        $this->db->join('b_boutique_billing_heads bh', 'bx.boutique_billing_head_id = bh.boutique_billing_head_id', 'left');
        if(@$id){
          $this->db->where('bx.boutique_property',$id);
          }
        
        $this->db->where("bx.boutique_id", $this->session->userdata('BoutiqueID'));
       $q = $this->db->get('');
       $data = $q->result_array();
       return @$data;
   }

   public function getexpencesdetails($id) {
       $this->db->select('*');
        $this->db->from('b_boutique_expenses bx');
        $this->db->join('b_boutique_billing_heads bh', 'bx.boutique_billing_head_id = bh.boutique_billing_head_id', 'left');
       $this->db->where("bx.boutique_id", $this->session->userdata('BoutiqueID'));
       $this->db->where("bx.boutique_expense_id", $id);
       $q = $this->db->get('');
       $data = $q->result_array();
       return @$data[0];
   }
   
    public function addexpence(){

      $date = $this->input->post('boutique_expense_date');
      $date = explode('/', $date);
      $month = $date[0];
      $day   = $date[1];
      $year  = $date[2];
      
      if(strlen($year) == 2)
      {
        $year= '20'.$year;
        $date = $month."/".$day."/".$year;
      }
      else
      {
        $date = $this->input->post('boutique_expense_date');   
      }


      if($this->session->userdata('UserRole') == 4 || $this->session->userdata('UserRole') == 5 || $this->session->userdata('UserRole') == 6 || $this->session->userdata('UserRole') == 7)
      {

        $CI = & get_instance();
        $expenceData = array(
          'boutique_expense_date'=>$date,
          'boutique_billing_head_id'=>$this->input->post('boutique_billing_head_id'),
          'boutique_expense_amount'=>$this->input->post('boutique_expense_amount'),
          'boutique_expense_pay_type'=>$this->input->post('boutique_sale_paymenttype'),
          'boutique_expense_details'=>$this->input->post('boutique_expense_details'),
          'boutique_billing_user_id'=>$this->input->post('boutique_billing_user_id'),
          'boutique_expense_createdby'=>$this->session->userdata('UserID'),
          'builder_expense_status'=>$this->input->post('petty_cash'),
          'boutique_id'=>$this->session->userdata('BoutiqueID'),
          'pettycash_pm_id'=>$this->session->userdata('UserID')
         );
        $this->db->insert('b_boutique_petty_expenses',$expenceData);
        $esID = $this->db->insert_id();
      }
      else
      {
        $CI = & get_instance();
        $expenceData = array(
          'boutique_expense_date'=>$date,
          'boutique_billing_head_id'=>$this->input->post('boutique_billing_head_id'),
          'boutique_expense_amount'=>$this->input->post('boutique_expense_amount'),
          'boutique_expense_pay_type'=>$this->input->post('boutique_sale_paymenttype'),
          'boutique_expense_details'=>$this->input->post('boutique_expense_details'),
          'boutique_billing_user_id'=>$this->input->post('boutique_billing_user_id'),
          'boutique_expense_createdby'=>$this->session->userdata('UserID'),
          'builder_expense_status'=>$this->input->post('petty_cash'),
          'boutique_id'=>$this->session->userdata('BoutiqueID')
        );
        
        if($this->session->userdata('UserID') ==126 || $this->session->userdata('UserID') == 128) {
        $expenceData['boutique_property'] =$this->input->post('property_id'); 
        }
        $this->db->insert('b_boutique_expenses',$expenceData);
        $esID = $this->db->insert_id();
        
      }
      return $esID;
    }

    public function removeincome($id) {
      $this->db->where('boutique_expense_id', $id);
      $this->db->delete('b_boutique_income');
      return true;
    }
    public function removeexpence($id) {

      $this->db->where('boutique_expense_id', $id);
      if($this->session->userdata('UserRole')== 4 || $this->session->userdata('UserRole')== 5 || $this->session->userdata('UserRole')== 6 || $this->session->userdata('UserRole')== 7) 
      {
        $this->db->delete('b_boutique_petty_expenses');
      }
      else
      {
        $this->db->delete('b_boutique_expenses');
      }
      return true;
    }
    public function updateexpence(){
        $CI = & get_instance();
        $exData = array(
        'boutique_expense_date'=>$this->input->post('boutique_expense_date'),
        'boutique_billing_head_id'=>$this->input->post('boutique_billing_head_id'),
        'boutique_expense_amount'=>$this->input->post('boutique_expense_amount'),
        'boutique_expense_details'=>$this->input->post('boutique_expense_details')
      );
      $exData['boutique_property'] =$this->input->post('property_id'); 
      $this->db->where('boutique_expense_id',$this->input->post('boutique_expense_id'));
      $this->db->update('b_boutique_expenses',$exData);
      return TRUE;
    }

    
    public function getitems() {
       $this->db->select('*');
       $this->db->where("boutique_id", $this->session->userdata('BoutiqueID'));
       $q = $this->db->get('b_boutique_items');
       $data = $q->result_array();
       return @$data;
    }

    public function gettaxes() {
       $this->db->select('*');
       $this->db->where("boutique_id", $this->session->userdata('BoutiqueID'));
       $q = $this->db->get('b_boutique_tax');
       $data = $q->result_array();
       return @$data;
    }

    public function additem($newfileName){
      $CI = & get_instance();
      if(@$this->input->post('boutique_item_code')){
          $sku = $this->input->post('boutique_item_code');
      }
      else{
          $sku = 'BM'.$this->session->userdata('BoutiqueID').mt_rand(10000, 99999);
      }

      $barcode = 'BMB'.$this->session->userdata('BoutiqueID').mt_rand(100000, 999999);

      $imageResource = Zend_Barcode::factory('code128', 'image', array('text'=>$barcode), array())->draw();
      imagepng($imageResource, 'uploads/barcode/'.$barcode.'.png');

      $itemData = array(
        'boutique_item_name'=>$this->input->post('boutique_item_name'),
        'boutique_item_desc'=>$this->input->post('boutique_item_desc'),
        'boutique_item_image'=>$newfileName,
        'boutique_item_unit_price'=>$this->input->post('boutique_item_unit_price'),
        'boutique_item_purchase_price'=>$this->input->post('boutique_item_purchase_price'),
        'boutique_item_total_remaining'=>$this->input->post('boutique_item_total_remaining'),
        'boutique_item_total_quantity'=>$this->input->post('boutique_item_total_remaining'),
        'boutique_item_total_sold'=>0,
        'boutique_item_code'=>$sku,
        'boutique_item_barcode'=>$barcode,
        'boutique_item_hsn'=>$this->input->post('boutique_item_hsn'),
        'boutique_tax_id'=>$this->input->post('boutique_tax_id'),
        'boutique_item_createdby'=>$this->session->userdata('UserID'),
        'boutique_id'=>$this->session->userdata('BoutiqueID')
      );
      $this->db->insert('b_boutique_items',$itemData);
      $itID = $this->db->insert_id();
      return $itID;
    }

    public function removeitem($id) {
      $this->db->where('boutique_item_id', $id);
      $this->db->delete('b_boutique_items');
      return true;
    }

    public function getitemdetails($id) {
       $this->db->select('*');
       $this->db->where("boutique_id", $this->session->userdata('BoutiqueID'));
       $this->db->where("boutique_item_id", $id);
       $q = $this->db->get('b_boutique_items');
       $data = $q->result_array();
       return @$data[0];
    }

    public function updateitem($id,$newfileName){
      $CI = & get_instance();
      $itemData = array(
        'boutique_item_name'=>$this->input->post('boutique_item_name'),
        'boutique_item_code'=>$this->input->post('boutique_item_code'),
        'boutique_item_hsn'=>$this->input->post('boutique_item_hsn'),
        'boutique_item_desc'=>$this->input->post('boutique_item_desc'),
        'boutique_item_image'=>$newfileName,
        'boutique_item_unit_price'=>$this->input->post('boutique_item_unit_price'),
        'boutique_item_purchase_price'=>$this->input->post('boutique_item_purchase_price'),
        'boutique_tax_id'=>$this->input->post('boutique_tax_id')
      );
      $this->db->where('boutique_item_id',$this->input->post('boutique_item_id'));
      $this->db->update('b_boutique_items',$itemData);
      return TRUE;
    }

    public function updateitemstock(){
      $CI = & get_instance();
      $this->db->set('boutique_item_total_remaining', 'boutique_item_total_remaining+'.$this->input->post('boutique_item_total_remaining'), FALSE);
      $this->db->set('boutique_item_total_quantity', 'boutique_item_total_quantity+'.$this->input->post('boutique_item_total_remaining'), FALSE);
      $this->db->where('boutique_item_id',$this->input->post('boutique_item_id'));
      $this->db->update('b_boutique_items');
      return TRUE;
    }

    public function getexpencesreport($id = NULL) {
       $this->db->select("*");
       
       if($this->session->userdata('UserRole') == 4)
       {
        $this->db->from('b_boutique_petty_expenses bx');  
       }
       else
       {
        $this->db->from('b_boutique_expenses bx');
       }
       
       // $this->db->from('b_boutique_expenses bx');
        $this->db->join('b_boutique_billing_heads bh', 'bx.boutique_billing_head_id = bh.boutique_billing_head_id','left');
        $this->db->join('b_boutique_properties bp ', 'bp.boutique_property_id = bx.boutique_property','left');
        if(@$id){
          $this->db->where('bx.boutique_property',$id);
        }
        $this->db->where("bx.boutique_id", $this->session->userdata('BoutiqueID'));

       if(@$this->input->post('date_from_report') && @$this->input->post('date_to_report')){
          $this->db->where("STR_TO_DATE(bx.boutique_expense_date, '%d/%m/%Y') BETWEEN STR_TO_DATE('".$this->input->post('date_from_report')."', '%d/%m/%Y') AND STR_TO_DATE('".$this->input->post('date_to_report')."', '%d/%m/%Y')");
       }
      //  if($this->session->userdata('UserRole') == 4)
      //  {
      //   $this->db->where('bx.pettycash_pm_id',$this->session->userdata('UserID'));
      // }
       

       $q = $this->db->get();
       $data = $q->result_array();
       return @$data;
   }

   public function getsalereport() {
       $this->db->select("bs.*,GROUP_CONCAT(bsi.boutique_sale_item_name SEPARATOR ',') AS boutique_item_names");
       $this->db->from('b_boutique_sales bs');
       $this->db->join('b_boutique_sale_items bsi', 'bs.boutique_sale_id = bsi.boutique_sale_id','left');
       $this->db->where("bs.boutique_id", $this->session->userdata('BoutiqueID'));
       $this->db->where("bs.boutique_sale_billtype", 1);

       if(@$this->input->post('date_from_report') && @$this->input->post('date_to_report')){

          $from_date = str_replace('/','-',$this->input->post('date_from_report'));
       	  $to_date   = str_replace('/','-',$this->input->post('date_to_report'));

          $this->db->where("STR_TO_DATE(bs.boutique_sale_date, '%d-%m-%Y') BETWEEN STR_TO_DATE('".$from_date."', '%d-%m-%Y') AND STR_TO_DATE('".$to_date."', '%d-%m-%Y')");
       }
       $this->db->group_by("bs.boutique_sale_id");
       $q = $this->db->get();
       $data = $q->result_array();
       return @$data;
   }

    public function getgstreport() {
       $this->db->select("bs.*,GROUP_CONCAT(bsi.boutique_sale_item_name SEPARATOR ',') AS boutique_item_names");
       $this->db->from('b_boutique_sales bs');
       $this->db->join('b_boutique_sale_items bsi', 'bs.boutique_sale_id = bsi.boutique_sale_id','left');
       $this->db->where("bs.boutique_id", $this->session->userdata('BoutiqueID'));
       $this->db->where("bs.boutique_sale_billtype", 2);

       if(@$this->input->post('date_from_report') && @$this->input->post('date_to_report')){

          $from_date = str_replace('/','-',$this->input->post('date_from_report'));
          $to_date   = str_replace('/','-',$this->input->post('date_to_report'));

          $this->db->where("STR_TO_DATE(bs.boutique_sale_date, '%d-%m-%Y') BETWEEN STR_TO_DATE('".$from_date."', '%d-%m-%Y') AND STR_TO_DATE('".$to_date."', '%d-%m-%Y')");
       }
       $this->db->group_by("bs.boutique_sale_id");
       $q = $this->db->get();
       $data = $q->result_array();
       return @$data;
   }
   
   public function getsales() {
       $this->db->select('*');
       $this->db->from('b_boutique_sales bs');
       $this->db->join('b_boutique_properties bp', 'bp.boutique_property_id = bs.boutique_customer_id','left');
       $this->db->where("bs.boutique_id", $this->session->userdata('BoutiqueID'));
       $this->db->order_by("bs.boutique_sale_id", "desc");
       $q = $this->db->get();
       $data = $q->result_array();
       return @$data;
    }
    
    public function getlastsale() {
       $this->db->select('*');
       $this->db->from('b_boutique_sales bs');
       $this->db->join('b_boutique_customers bc', 'bc.boutique_customer_id = bs.boutique_customer_id','left');
       $this->db->where_in("bs.boutique_id", $this->session->userdata('BoutiqueID'));
       $this->db->order_by("bs.boutique_sale_id", "desc");
       $q = $this->db->get();
       $data = $q->result_array();
       return @$data;
    }
    
    
    public function removesale($id) {

       $this->db->select('*');
       $this->db->where("boutique_id", $this->session->userdata('BoutiqueID'));
       $this->db->where("boutique_sale_id", $id);
       $q = $this->db->get('b_boutique_sale_items');
       $saleitem = $q->result_array();

       $this->db->where('boutique_sale_id', $id);
       $this->db->delete('b_boutique_sale_items');

       $this->db->where('boutique_sale_id', $id);
       $this->db->delete('b_boutique_sales');

       foreach($saleitem as $item){
         $this->db->set('boutique_item_total_remaining', 'boutique_item_total_remaining+'.$item['boutique_sale_unit'], FALSE);
         $this->db->set('boutique_item_total_sold', 'boutique_item_total_sold-'.$item['boutique_sale_unit'], FALSE);
         $this->db->where('boutique_item_id',$item['boutique_item_id']);
         $this->db->update('b_boutique_items');
       }
      return true;
    }

    public function savesalepayment(){
      $this->db->set('boutique_sale_amountpaid', 'boutique_sale_amountpaid+'.$this->input->post('boutique_sale_balanceamount'), FALSE);
       $this->db->set('boutique_sale_balanceamount', 'boutique_sale_balanceamount-'.$this->input->post('boutique_sale_balanceamount'), FALSE);
      $this->db->where('boutique_sale_id', $this->input->post('boutique_sale_id'));
      $this->db->update('b_boutique_sales');
      return true;
    }


    public function addsale() {

  
      $saleData = array(
        'boutique_sale_items'=>count(@$this->input->post('boutique_item_id')),
        'boutique_sale_price'=>@$this->input->post('boutique_sale_price'),
        'boutique_sale_amountpaid'=>@$this->input->post('boutique_sale_amountpaid'),
        'boutique_sale_balanceamount'=>@$this->input->post('boutique_sale_balanceamount'),
        'boutique_sale_date'=>@$this->input->post('date'),
        'boutique_sale_paymenttype'=>@$this->input->post('boutique_sale_paymenttype'),
        'boutique_sale_billtype'=>@$this->input->post('boutique_sale_billtype'),
        'boutique_sale_invoice'=>@$this->input->post('boutique_sale_invoice'),
        'boutique_sale_invoice_number'=>@$this->input->post('boutique_sale_invoice'),
        'boutique_sale_invoice_gstnumber'=>@$this->input->post('boutique_sale_invoice_gstnumber'),
        'boutique_customer_id'=>@$this->input->post('property_id'),
        'boutique_customer_details'=>@$this->input->post('boutique_customer_details'),
        'boutique_id'=>$this->session->userdata('BoutiqueID')
      
      );
      $this->db->insert('b_boutique_sales',$saleData);
      $saleID = $this->db->insert_id();

      $itemsids = $this->input->post('boutique_item_id');
      $itemsqantity = $this->input->post('boutique_item_total_quantity');

      $itemsprice = $this->input->post('boutique_sale_item_unitprice');
      $itemstax = $this->input->post('boutique_sale_item_tax');
      $itemstotalprice = $this->input->post('boutique_sale_item_totalunitprice');
      $itemsname = $this->input->post('boutique_sale_item_name');
      $itemsdesc = $this->input->post('boutique_sale_item_desc');
      $itemshsn = $this->input->post('boutique_sale_item_hsn');
      
      $total = count($itemsids);
      for($i = 0; $i < $total; $i++) { 

        if($itemsids[$i]!=0){
            $this->db->set('boutique_item_total_remaining', 'boutique_item_total_remaining-'.$itemsqantity[$i], FALSE);
         $this->db->set('boutique_item_total_sold', 'boutique_item_total_sold+'.$itemsqantity[$i], FALSE);
         $this->db->where('boutique_item_id',$itemsids[$i]);
         $this->db->update('b_boutique_items');
        $itemdetails = $this->getitemdetails($itemsids[$i]);

        $saleitemData = array(
            'boutique_item_id'=>@$itemsids[$i],
            'boutique_sale_unit'=>@$itemsqantity[$i],
            'boutique_sale_item_name'=>@$itemsname[$i],
            'boutique_sale_item_desc'=>@$itemsdesc[$i],
            'boutique_sale_item_tax'=>@$itemstax[$i],
            'boutique_sale_item_hsn'=>@$itemshsn[$i],
            'boutique_sale_item_totalunitprice'=>@$itemstotalprice[$i],
            //'boutique_sale_item_unitprice'=>$itemdetails['boutique_item_unit_price'],
            'boutique_sale_item_unitprice'=>@$itemsprice[$i],
            'boutique_sale_item_code'=>@$itemdetails['boutique_item_code'],
            'boutique_sale_item_barcode'=>@$itemdetails['boutique_item_barcode'],
            'boutique_sale_id'=>@$saleID,
            'boutique_customer_id'=>$this->input->post('boutique_customer_id'),
            'boutique_id'=>$this->session->userdata('BoutiqueID')
          );
          $this->db->insert('b_boutique_sale_items',$saleitemData);
        }
        else{

         $saleitemData = array(
            'boutique_item_id'=>@$itemsids[$i],
            'boutique_sale_unit'=>@$itemsqantity[$i],
            'boutique_sale_item_name'=>@$itemsname[$i],
            'boutique_sale_item_desc'=>@$itemsdesc[$i],
            'boutique_sale_item_tax'=>@$itemstax[$i],
            'boutique_sale_item_hsn'=>@$itemshsn[$i],
            'boutique_sale_item_totalunitprice'=>@$itemstotalprice[$i],
            'boutique_sale_item_unitprice'=>@$itemsprice[$i],
            'boutique_sale_item_code'=>0,
            'boutique_sale_item_barcode'=>0,
            'boutique_sale_id'=>$saleID,
            'boutique_customer_id'=>$this->input->post('boutique_customer_id'),
            'boutique_id'=>$this->session->userdata('BoutiqueID')
          );
          $this->db->insert('b_boutique_sale_items',$saleitemData);

        } 
      }
      return $saleID;
    }

    public function m_getsaledetails($id){
       $this->db->select('*');
       $this->db->from('b_boutique_sales bs');
       $this->db->join('b_boutique b', 'b.boutique_id = bs.boutique_id', 'left');
       $this->db->join('b_boutique_properties bp', 'bp.boutique_property_id = bs.boutique_customer_id', 'left');
       $this->db->where("bs.boutique_id", $this->session->userdata('BoutiqueID'));
       $this->db->where("bs.boutique_sale_id", $id);
       $q = $this->db->get('');
       $data = $q->result_array();
       return @$data[0];
    } 

    public function m_getallsaleitems($id){
       $this->db->select('*');
       $this->db->from('b_boutique_sale_items bsi');
       $this->db->join('b_boutique_items bi', 'bsi.boutique_item_id = bi.boutique_item_id', 'left');
       $this->db->join('b_boutique_tax bt', 'bt.boutique_tax_id = bi.boutique_tax_id', 'left');
       $this->db->where("bsi.boutique_id", $this->session->userdata('BoutiqueID'));
       $this->db->where("bsi.boutique_sale_id", $id);
       $q = $this->db->get();
       $saleitems = $q->result_array();
       return $saleitems;
    }  
    
    
   public function getsalereportforprofit() {
       $this->db->select("bs.*,bop.*");
       $this->db->from('b_boutique_orders bs');
       $this->db->join('b_boutique_order_payments bop', 'bop.boutique_order_id = bs.boutique_order_id');
       $this->db->where("bs.boutique_id", $this->session->userdata('BoutiqueID'));
       $this->db->where("bs.boutique_order_status", 1);
       if(@$this->input->post('date_from_report') && @$this->input->post('date_to_report')){
       $this->db->where("STR_TO_DATE(bop.boutique_order_paid_date, '%d/%m/%Y') BETWEEN STR_TO_DATE('".$this->input->post('date_from_report')."', '%d/%m/%Y') AND STR_TO_DATE('".$this->input->post('date_to_report')."', '%d/%m/%Y')");
       }
       $this->db->group_by("bop.boutique_order_paymentid");
       $q = $this->db->get();
       $data = $q->result_array();
     //  print_r($this->db->last_query());//exit;
       return @$data;
   }


 public function getpropertydetails($id) {
       $this->db->select('*');
        $this->db->from('b_boutique_properties bx');
       $this->db->where("bx.boutique_id", $this->session->userdata('BoutiqueID'));
       $this->db->where("bx.boutique_property_id", $id);
       $q = $this->db->get('');
       $data = $q->result_array();
       return @$data[0];
   }
   
    public function addproperty(){
      $CI = & get_instance();
    
     
      $propertyData = array(
        'boutique_property_name'=>$this->input->post('boutique_property_name'),
        'b_boutique_header'=>@$this->input->post('header1'),
        'b_boutique_subheader'=>@$this->input->post('subheader1'),
        'b_boutique_phone'=>@$this->input->post('phone'),
        'boutique_id'=>$this->session->userdata('BoutiqueID'),
        'auth_signature_1'=>@$this->input->post('sig_1'),
        'auth_signature_2'=>@$this->input->post('sig_2')
      
      
      );
      $this->db->insert('b_boutique_properties',$propertyData);
      $esID = $this->db->insert_id();

      return $esID;
    }

    public function removeproperty($id) {
      $this->db->where('boutique_property_id', $id);
      $this->db->delete('b_boutique_properties');
      return true;
    }

    public function updateproperty(){
        $CI = & get_instance();
        $exData = array(
        'boutique_property_name'=>@$this->input->post('boutique_property_name'),
        'b_boutique_header'=>@$this->input->post('header1'),
        'b_boutique_subheader'=>@$this->input->post('subheader1'),
        'b_boutique_phone'=>@$this->input->post('phone'),
        'auth_signature_1'=>@$this->input->post('sig_1'),
        'auth_signature_2'=>@$this->input->post('sig_2')
      
     
      );
      $this->db->where('boutique_property_id',$this->input->post('boutique_property_id'));
      $this->db->update('b_boutique_properties',$exData);
      return TRUE;
    }

       public function getproperties() {
       $this->db->select('*');
       $this->db->from('b_boutique_properties bx');
       $this->db->where("bx.boutique_id", $this->session->userdata('BoutiqueID'));
       $q = $this->db->get('');
       $data = $q->result_array();
       return @$data;
   }
   public function getincomes($id = NULL) {
    $this->db->select('*');
     $this->db->from('b_boutique_income bx');
     $this->db->join('b_boutique_billing_heads bh', 'bx.boutique_billing_head_id = bh.boutique_billing_head_id', 'left');
     $this->db->join('b_boutique_properties bp ', 'bp.boutique_property_id = bx.boutique_property','left');
 
     if(@$id){
			$this->db->where('bx.boutique_property',$id);
		  }
     $this->db->where("bx.boutique_id", $this->session->userdata('BoutiqueID'));
    
    $q = $this->db->get('');
    $data = $q->result_array();
    return @$data;
}

public function addincome(){

  $date = $this->input->post('boutique_expense_date');
      $date = explode('/', $date);
      $month = $date[0];
      $day   = $date[1];
      $year  = $date[2];
      
      if(strlen($year) == 2)
      {
        $year= '20'.$year;
        $date = $month."/".$day."/".$year;
      }
      else
      {
        $date = $this->input->post('boutique_expense_date');   
      }
  $CI = & get_instance();
  $expenceData = array(
    'boutique_expense_date'=>$date,
    'boutique_billing_head_id'=>$this->input->post('boutique_billing_head_id'),
    'boutique_expense_amount'=>$this->input->post('boutique_expense_amount'),
    'boutique_expense_pay_type'=>$this->input->post('boutique_sale_paymenttype'),
    'boutique_expense_details'=>$this->input->post('boutique_expense_details'),
    'boutique_expense_createdby'=>$this->session->userdata('UserID'),
    'boutique_id'=>$this->session->userdata('BoutiqueID')
  );
  if($this->session->userdata('UserID') ==126 || $this->session->userdata('UserID') ==128) {
  $expenceData['boutique_property'] =$this->input->post('property_id'); 
  }
  $this->db->insert('b_boutique_income',$expenceData);
  $esID = $this->db->insert_id();
  $this->sendStatusMessageSMS($esID);



  return $esID;
}
public function sendStatusMessageSMS($esID){
  $username="boutiquemanagerin";
  $password ="Boutique@123#";
  $sender="BTQMNG";
 
		
  $this->db->select('*');
  $this->db->from('b_boutique_income bx');
  $this->db->join('b_boutique_billing_heads bh', 'bx.boutique_billing_head_id = bh.boutique_billing_head_id','left');
  $this->db->join('b_boutique_properties bp ', 'bp.boutique_property_id = bx.boutique_property','left');
   
  $this->db->where("bx.boutique_expense_id", $esID);
  $q = $this->db->get('');
  $data = $q->result_array();
  $income = $data[0]["boutique_expense_amount"];
  
  $date = $data[0]["boutique_expense_date"];
  
  $head_name = $data[0]["b_boutique_subheader"];
  $number = $data[0]["b_boutique_phone"];



  if(@$number){

    $message = "Dear ".$head_name.", \r\n \r\n";
    $message.= "Greetings from LEVANTAR BUILDERS!!! \r\n \r\n";
    $message.= "Your payment of Rs.".$income." has been received on ".$date." and we acknowledge the same. \r\n\n";
    $message.= "Thank you for being our valuable client...";

    $url = "http://smsc.a4add.com/api/smsapi.aspx?username=BTQMNG&password=bonneyjp4*&to=" . urlencode($number) . "&from=MTQBPP&message=" . urlencode($message) . "";

    
    
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $curl_scraped_page = curl_exec($ch);
  curl_close($ch); 
  $this->Work_model->m_addstatusmsg($message,$propert_name,$number,$curl_scraped_page);
  }
    return TRUE;
}

public function getincomecategories() {
  $this->db->select('*');
  $this->db->where("boutique_id", $this->session->userdata('BoutiqueID'));
  $this->db->where("boutique_billing_head_type", 2);
  
  $q = $this->db->get('b_boutique_billing_heads');
  $data = $q->result_array();
  return @$data;
}
public function addincomecategories(){
  $CI = & get_instance();
  $expencecatData = array(
    'boutique_billing_head_name'=>$this->input->post('head_name'),  
    'boutique_billing_head_type'=>2,        
    'boutique_id'=>$this->session->userdata('BoutiqueID')
  );
  $this->db->insert('b_boutique_billing_heads',$expencecatData);
  $esID = $this->db->insert_id();
  return $esID;
}
public function getincomereport($id = NULL) {
  $this->db->select("*");
  if($this->session->userdata('UserRole') == 4)
  {
    $this->db->from('b_boutique_expenses bx');  
  }
  else{
    $this->db->from('b_boutique_income bx');
  }
   
   $this->db->join('b_boutique_billing_heads bh', 'bx.boutique_billing_head_id = bh.boutique_billing_head_id','left');
   $this->db->join('b_boutique_properties bp ', 'bp.boutique_property_id = bx.boutique_property','left');
   if(@$id){
    $this->db->where('bx.boutique_property',$id);
  }
   $this->db->where("bx.boutique_id", $this->session->userdata('BoutiqueID'));

  if(@$this->input->post('date_from_report') && @$this->input->post('date_to_report')){
     $this->db->where("STR_TO_DATE(bx.boutique_expense_date, '%d/%m/%Y') BETWEEN STR_TO_DATE('".$this->input->post('date_from_report')."', '%d/%m/%Y') AND STR_TO_DATE('".$this->input->post('date_to_report')."', '%d/%m/%Y')");
  }
  if($this->session->userdata('UserRole') == 4)
       {
        $this->db->where('bx.builder_expense_status',1);
        $this->db->where('bx.boutique_billing_user_id',$this->session->userdata('UserID'));
      }

  $q = $this->db->get();
  $data = $q->result_array();
  return @$data;
}

public function getexpencesreport1($id) {
  $this->db->select("*");
if($this->session->userdata('UserRole') == 4)
{
  $this->db->from('b_boutique_petty_expenses bx');
}
else
{
  $this->db->from('b_boutique_expenses bx');
}
  
   $this->db->join('b_boutique_billing_heads bh', 'bx.boutique_billing_head_id = bh.boutique_billing_head_id','left');
   $this->db->join('b_boutique_properties bp ', 'bp.boutique_property_id = bx.boutique_property','left');
 
   $this->db->where("bx.boutique_id", $this->session->userdata('BoutiqueID'));
   $this->db->where("bx.boutique_property", $id);

  if(@$this->input->post('date_from_report') && @$this->input->post('date_to_report')){
     $this->db->where("STR_TO_DATE(bx.boutique_expense_date, '%d/%m/%Y') BETWEEN STR_TO_DATE('".$this->input->post('date_from_report')."', '%d/%m/%Y') AND STR_TO_DATE('".$this->input->post('date_to_report')."', '%d/%m/%Y')");
  }
  if($this->session->userdata('UserRole') == 4)
{
  $this->db->where("bx.pettycash_pm_id", $this->session->userdata('UserID'));

  // 
}

  $q = $this->db->get();
  $data = $q->result_array();
  return @$data;

}

public function getincomereport1($id) {
  $this->db->select("*");
   $this->db->from('b_boutique_income bx');
   $this->db->join('b_boutique_billing_heads bh', 'bx.boutique_billing_head_id = bh.boutique_billing_head_id','left');
   $this->db->join('b_boutique_properties bp ', 'bp.boutique_property_id = bx.boutique_property','left');
 
   $this->db->where("bx.boutique_id", $this->session->userdata('BoutiqueID'));
   $this->db->where("bx.boutique_property", $id);

  if(@$this->input->post('date_from_report') && @$this->input->post('date_to_report')){
     $this->db->where("STR_TO_DATE(bx.boutique_expense_date, '%d/%m/%Y') BETWEEN STR_TO_DATE('".$this->input->post('date_from_report')."', '%d/%m/%Y') AND STR_TO_DATE('".$this->input->post('date_to_report')."', '%d/%m/%Y')");
  }

  $q = $this->db->get();
  $data = $q->result_array();
  return @$data;
}
public function get_all_dates($id = NULL)
{
  //all date from sales table
  $this->db->select('boutique_expense_date');
  $this->db->from('b_boutique_income');
  $this->db->group_by('boutique_expense_date');
  $this->db->order_by('boutique_expense_date');
  if(@$id){
    $this->db->where('boutique_property',$id);
  }
  if(@$this->input->post('date_from_report') && @$this->input->post('date_to_report')){
    $this->db->where("STR_TO_DATE(boutique_expense_date, '%d/%m/%Y') BETWEEN STR_TO_DATE('".$this->input->post('date_from_report')."', '%d/%m/%Y') AND STR_TO_DATE('".$this->input->post('date_to_report')."', '%d/%m/%Y')");
 }

  

  $this->db->where("boutique_id", $this->session->userdata('BoutiqueID'));
  $data1=$this->db->get()->result_array();
  foreach($data1 as $value) // talking dates to $dates[] array
   {
     $dates[]=$value['boutique_expense_date'];
   }
 
   $this->db->select('boutique_expense_date');
   $this->db->from('b_boutique_expenses');
   $this->db->group_by('boutique_expense_date');
   $this->db->order_by('boutique_expense_date');
   if(@$id){
    $this->db->where('boutique_property',$id);
  }
  if(@$this->input->post('date_from_report') && @$this->input->post('date_to_report')){
    $this->db->where("STR_TO_DATE(boutique_expense_date, '%d/%m/%Y') BETWEEN STR_TO_DATE('".$this->input->post('date_from_report')."', '%d/%m/%Y') AND STR_TO_DATE('".$this->input->post('date_to_report')."', '%d/%m/%Y')");
 }

  $this->db->where("boutique_id", $this->session->userdata('BoutiqueID'));
   $data2=$this->db->get()->result_array();
   foreach($data2 as $value)  // talking dates to $dates[] array
   {
     $dates[]=$value['boutique_expense_date'];
   }

   $array2=array_unique($dates); // change the index value 
   $array=array();
   foreach($array2 as $value){ // we rearrage index value to an order
    $array[]=$value;
  }
   for($j = 0; $j < count($array); $j ++) {   //sorting date array to ascending
    for($i = 0; $i < count($array)-1; $i ++){
        if(strtotime(str_replace('/','-',$array[$i])) > strtotime(str_replace('/','-',$array[$i+1]))) {
          $temp = $array[$i+1];
          $array[$i+1]=$array[$i];
          $array[$i]=$temp;
      }       
    }
 }
// var_dump($array);
// exit(0);
  return $array;
}
public function get_sale_expence($date, $id = NULL)
{
  //sale
  // $this->db->select_sum('boutique_expense_amount');
  $this->db->select("*");
  if($this->session->userdata('UserRole') == 4)
  {
    $this->db->from('b_boutique_expenses bx');
  }
  else{
    $this->db->from('b_boutique_income bx');
  }

  $this->db->where("bx.boutique_expense_date",$date);
  $this->db->join('b_boutique_billing_heads bh', 'bx.boutique_billing_head_id = bh.boutique_billing_head_id','left');
  //proprty join
  $this->db->join('b_boutique_properties bp', 'bx.boutique_property = bp.boutique_property_id','left');
 
  if(@$id){
    $this->db->where('bx.boutique_property',$id);
  }
  $this->db->where("bx.boutique_id", $this->session->userdata('BoutiqueID'));
  if($this->session->userdata('UserRole') == 4)
  {
    $this->db->where("bx.builder_expense_status",1);
    $this->db->where("bx.boutique_billing_user_id", $this->session->userdata('UserID'));
  }
   $data['sales']=$this->db->get()->result_array();


   //expence
  //  $this->db->select_sum('boutique_expense_amount');
  $this->db->select("*");
  if($this->session->userdata('UserRole') == 4)
  {
    $this->db->from('b_boutique_petty_expenses bx');
  }
  else{
    $this->db->from('b_boutique_expenses bx');
  }
  $this->db->where("bx.boutique_expense_date",$date);
  $this->db->join('b_boutique_billing_heads bh', 'bx.boutique_billing_head_id = bh.boutique_billing_head_id','left');
  //property join
  $this->db->join('b_boutique_properties bp', 'bx.boutique_property = bp.boutique_property_id','left');
  
  if(@$id){
    $this->db->where('bx.boutique_property',$id);
  } 
  $this->db->where("bx.boutique_id", $this->session->userdata('BoutiqueID'));
  if($this->session->userdata('UserRole') == 4)
  {
    $this->db->where("bx.boutique_billing_user_id", $this->session->userdata('UserID'));
  }
  $data['expense']=$this->db->get()->result_array();

  //  var_dump(count($data['expense']));
  // //  exit(0);
  // var_dump($data['expense']);
  // exit(0);
  return $data;

}

public function getincomedetails($id) {
  $this->db->select('*');
   $this->db->from('b_boutique_income bx');
   $this->db->join('b_boutique_billing_heads bh', 'bx.boutique_billing_head_id = bh.boutique_billing_head_id', 'left');
  $this->db->where("bx.boutique_id", $this->session->userdata('BoutiqueID'));
  $this->db->where("bx.boutique_expense_id", $id);
  $q = $this->db->get('');
  $data = $q->result_array();
  return @$data[0];
}
public function updateincome(){
  $CI = & get_instance();
  $exData = array(
  'boutique_expense_date'=>$this->input->post('boutique_expense_date'),
  'boutique_billing_head_id'=>$this->input->post('boutique_billing_head_id'),
  'boutique_expense_amount'=>$this->input->post('boutique_expense_amount'),
  'boutique_expense_details'=>$this->input->post('boutique_expense_details')
);
$exData['boutique_property'] =$this->input->post('property_id'); 

$this->db->where('boutique_expense_id',$this->input->post('boutique_expense_id'));
$this->db->update('b_boutique_income',$exData);
return TRUE;
}


public function addattendance()
{
  // $date = date('d-m-Y');
  $date =$this->input->post("dates");


  $this->db->where('attendance_date', $date);
  $this->db->delete('b_builders_attendanace');
 
  $userid =$this->input->post('userid[]');
$total = count($userid);
  
for($i=0; $i<$total ; $i++)
  {
    $overtime =$this->input->post('overtime['.$i.']');
    
    $timeout =$this->input->post('timeout['.$i.']');
    
  $userid =$this->input->post('userid['.$i.']');
  $attendance =$this->input->post('attendance['.$i.']');
  
 
    $site_id =$this->input->post('builder_site_id['.$i.']');


   
  $taxData = array(
    'builder_attendance'=>$attendance,        
    'user_id'=>$userid,     
    '	builder_overtime_hour'=>$overtime,        
    'builder_exit_hours'=>$timeout,     
    'builder_site_id'=>$site_id,      
    'attendance_date'=>$date
  );
  $this->db->insert('b_builders_attendanace',$taxData);


  }


}

public function attendancesheet($id,$date)
{

	  $this->db->select( '*');
		$this->db->from('b_builders_attendanace ba');
    $this->db->join('b_boutique_tailor bt', 'bt.boutique_tailor_id = ba.user_id','left');

    $this->db->join('b_boutique_properties bp', 'bp.boutique_property_id = ba.builder_site_id','left');

    $this->db->where('ba.builder_site_id', $id);
	  $this->db->where('ba.attendance_date', $date);
		
    $q = $this->db->get();
		$data = $q->result_array();
 return @$data;
	

}
public function salarysheet($date,$id)
{
  if($id==0 || $id=='' )
  {
    $this->db->select( '*');
		$this->db->from('b_builders_attendanace ba');
    $this->db->join('b_boutique_tailor bt', 'bt.boutique_tailor_id = ba.user_id','left');
   
    $this->db->join('b_boutique_properties bp', 'bp.boutique_property_id = ba.builder_site_id','left');
   
    $this->db->where('ba.builder_attendance', 1);
	  $this->db->where('ba.attendance_date', $date);
		
    $q = $this->db->get();
		$data = $q->result_array();
 
  }
  else{
    $this->db->select( '*');
		$this->db->from('b_builders_attendanace ba');
    $this->db->join('b_boutique_tailor bt', 'bt.boutique_tailor_id = ba.user_id','left');
   
    $this->db->join('b_boutique_properties bp', 'bp.boutique_property_id = ba.builder_site_id','left');
   
    $this->db->where('ba.builder_attendance', 1);
	  $this->db->where('ba.attendance_date', $date);
		$this->db->where('ba.builder_site_id', $id);
		
    $q = $this->db->get();
		$data = $q->result_array();
 
  }
 return @$data;
	

}
public function addsalary()
{
  $cnt =$this->input->post('user_id[]');
  $date= $this->input->post('date');

  $total = count($cnt);
for($i=0; $i<$total ; $i++)
{
$user_id =$this->input->post('user_id['.$i.']');

$overtime =$this->input->post('overtime['.$i.']');

$offtime =$this->input->post('offtime['.$i.']');

echo $overtime;
$this->db->select( '*');
$this->db->from('b_boutique_tailor');
$this->db->where('boutique_tailor_id', $user_id);		
$q = $this->db->get();
$cust = $q->result_array();
echo "=";
$ovt= $cust[0]["staff_overtime_rate"];
$offt =  $cust[0]["staff_offtime_rate"];
$dat = $cust[0]["boutique_staff_hourly_rate"];

$salary = (($ovt*$overtime)+$dat)-($offtime*$offt) ;



$data = array('builder_overtime_hour'=>$overtime,'builder_exit_hours'=>$offtime,'salary'=>$salary);
$this->db->where('user_id', $user_id);
$this->db->where('attendance_date', $date);

$this->db->update('b_builders_attendanace',$data);
}
return TRUE;


}
//Builders Demo Updates
public function addstoreitem()
{
  // $CI = & get_instance();
  $exData = array(
  'store_item_code'=>$this->input->post('item_code'),
  'store_item_name'=>$this->input->post('name'),
  'store_item_quantity'=>$this->input->post('item_quantity')
);
$this->db->insert('store_items',$exData);
return TRUE;
}
public function storeitemlist() {
  $this->db->select('*');
  $this->db->from('store_items');
  $q = $this->db->get('');
  $data = $q->result_array();
  return @$data;
}
public function m_removestoreitem($id) {
  $this->db->where('Store_item_id', $id);
  $this->db->delete('store_items');
  return true;
}
public function addscheduledwork()
{
  //  scheduled_work_builders scheduled_work_builders_asignee	
  $exData = array(
    'schedule_work_date'=>$this->input->post('sheduleddate'),
    'schedule_work_completedate'=>$this->input->post('completed_date'),
    'schedule_work_startingdate'=>$this->input->post('starting_date'),
    'schedule_work_actualwork'=>$this->input->post('actual_work'),
    'sceduled_work_planned'=>$this->input->post('ac_work_planned'),
    'scheduled_property_id'=>$this->input->post('property_id'),
    'scheduled_work_builders_user_id'=>$this->input->post('user_name'),
    'scheduled_work_builders_asignee'=>$this->input->post('sheduled_person'),
    'schedule_work_task'=>$this->input->post('task')
  );
  $this->db->insert('scheduled_work_builders',$exData);
  return TRUE;  
}
public function listschedulework($id = NULL)
{
  $this->db->select('*');
  $this->db->from('scheduled_work_builders swb');
  $this->db->join('b_boutique_properties bp', 'bp.boutique_property_id = swb.scheduled_property_id', 'left');
  if(@$id){
    $this->db->where(' swb.schedule_work_id',$id);
    }
  $q = $this->db->get('');
  $data = $q->result_array();
  return @$data;
}
public function m_removesheduledwork($id)
{
  $this->db->where('schedule_work_id', $id);
  $this->db->delete('scheduled_work_builders');
  return true;
}
function m_getalluserlist(){
  $this->db->select( '*');
  $this->db->from('b_boutique_user');
  $this->db->where('boutique_id', $this->session->userdata('BoutiqueID'));
   $this->db->where('boutique_user_id!=',127);
  $this->db->where_in('boutique_user_role', array(3,4,5,6,7));
  $q = $this->db->get();
  $data = $q->result_array();
  return @$data;
}
function saveuser($image)
{
  $CI = & get_instance();
  /*
  $boutique_tailor_id = '';
  if($this->input->post('boutique_user_role') == 5){
    $boutique_tailor_id = $this->input->post('boutique_tailor_id');
  }
  */
  $boutiqueAdminData = array(
      'boutique_id'=>$this->session->userdata('BoutiqueID'),
      'boutique_user_username'=>$this->input->post('userusername'),
      'boutique_user_pwd'=>sha1($this->input->post('userpassword') . $CI->config->item('encryption_key')),
      'boutique_user_role'=>$this->input->post('boutique_user_role'),
      //'boutique_tailor_id'=>$boutique_tailor_id,
      'boutique_user_ph'=>$this->input->post('phone'),
      'user_property'=>$this->input->post('property_id'),
      'boutique_user_email'=>$this->input->post('email')
    );
  
    $this->db->insert('b_boutique_user',$boutiqueAdminData);
    $uID = $this->db->insert_id();

    $boutiqueimage = array(
      'builder_user_image'=>$image,
      'builder_user_creteated_id	'=>$uID,
    );
    $this->db->insert('builder_user',$boutiqueimage);
    return $this->input->post('boutique_user_role');
}
public function m_removeuser($id)
	{
		$this->db->where('boutique_user_id', $id);
		$this->db->delete('b_boutique_user');
		return true;
	 
	}
  public function sendrequest()
  {
    $CI = & get_instance();
    $requestdata = array(
      'builder_purchase_request_date'=>$this->input->post('purchasedate'),
      'builder_purchase_request_item'=>$this->input->post('itemname'),
      'builder_purchase_request_tobedate'=>$this->input->post('tobedate'),
      'builder_purchase_request_deliverydate'=>$this->input->post('deliverydate'),
      'reuested_id'=>$this->session->userdata('UserID'),
      'builder_request_status'=>$this->input->post('request_status'),
      'builder_purchase_request_description'=>$this->input->post('description')
    );
    $this->db->insert('builder_purchase_request',$requestdata);
    $esID = $this->db->insert_id();
    return $esID;
  
  }
  public function requestlist()
  {
  $this->db->select( '*');
  $this->db->from('builder_purchase_request');
  if($this->session->userdata('UserRole') == 6) {
    $this->db->or_where('builder_request_status', 2 );
    $this->db->or_where('builder_request_status', 4 );
    $this->db->or_where('builder_request_status', 5 );
    $this->db->or_where('builder_request_status', 6 );
    $this->db->or_where('builder_request_status', 7 );
  
  }
  if($this->session->userdata('UserRole') == 7) {
    $this->db->or_where('builder_request_status', 4 );
    $this->db->or_where('builder_request_status', 6 );
    $this->db->or_where('builder_request_status', 7 );
  
  }
  if($this->session->userdata('UserRole') == 5) {
    // $this->db->where('builder_request_status', 1 );
    // $this->db->where('builder_request_status', 3 );
    // $this->db->or_where('builder_request_status', 2 );
    // $this->db->or_where('builder_request_status', 4 );
    // $this->db->or_where('builder_request_status', 5 );
    // $this->db->or_where('builder_request_status', 6 );
  }
  if($this->session->userdata('UserRole') == 4) {
    // $this->db->where('builder_request_status', 1 );
    // $this->db->or_where('builder_request_status', 3 );
  }
  $q = $this->db->get();
  $data = $q->result_array();
  return @$data; 
  }
  public function allrequestlist()
  {
  $this->db->select( '*');
  $this->db->from('builder_purchase_request bp');
  $this->db->join('b_boutique_user bh', 'bp.reuested_id = bh.boutique_user_id', 'left');
   
  $q = $this->db->get();
  $data = $q->result_array();
  return @$data; 
  }
  public function updateinfo($id)
  {
    $this->db->select( '*');
    $this->db->from('builder_purchase_request');
    $this->db->where('builder_purchase_request_id', $id);
    $q = $this->db->get();
    $data = $q->result_array();
    return @$data;     
  }
  public function requestaccept()
  {
    if($this->session->userdata('UserRole') == 6){

    if ($_POST['action'] == 'accept') 
    {
    $exData = array(
      'builder_purchase_description'=>$this->input->post('purchase_qcdescription'),
      'builder_request_status'=>4
    );
    $this->db->where('builder_purchase_request_id',$this->input->post('qa_id'));
    $this->db->update('builder_purchase_request',$exData);
    return TRUE;
    }
    else {
      $exData = array(
        'builder_purchase_description'=>$this->input->post('purchase_qcdescription'),
        'builder_request_status'=>5
      );
      $this->db->where('builder_purchase_request_id',$this->input->post('qa_id'));
      $this->db->update('builder_purchase_request',$exData);
      return TRUE;
      
      }
    }
    elseif($this->session->userdata('UserRole') == 7){

      if ($_POST['action'] == 'accept') 
      {
      $exData = array(
        'builder_account_decription'=>$this->input->post('account_qcdescription'),
        'builder_request_status'=>6
      );
      $this->db->where('builder_purchase_request_id',$this->input->post('qa_id'));
      $this->db->update('builder_purchase_request',$exData);
      return TRUE;
      }
      else {
        $exData = array(
          'builder_account_decription'=>$this->input->post('account_qcdescription'),
          'builder_request_status'=>7
        );
        $this->db->where('builder_purchase_request_id',$this->input->post('qa_id'));
        $this->db->update('builder_purchase_request',$exData);
        return TRUE;
        
        }
      }
    else{
      if ($_POST['action'] == 'accept') 
    {
    $exData = array(
      'bulder_qa_qc_description'=>$this->input->post('qa_qcdescription'),
      'builder_request_status'=>2
    );
    $this->db->where('builder_purchase_request_id',$this->input->post('qa_id'));
    $this->db->update('builder_purchase_request',$exData);
    return TRUE;
    }
    else {
      $exData = array(
        'bulder_qa_qc_description'=>$this->input->post('qa_qcdescription'),
        'builder_request_status'=>3
      );
      $this->db->where('builder_purchase_request_id',$this->input->post('qa_id'));
      $this->db->update('builder_purchase_request',$exData);
      return TRUE;
      
      }
    }
  }
  public function updaterequest()
  {
    $CI = & get_instance();
    $exData = array(
    'builder_purchase_request_date'=>$this->input->post('purchasedate'),
    'builder_purchase_request_item'=>$this->input->post('itemname'),
    'builder_purchase_request_tobedate'=>$this->input->post('tobedate'),
    'builder_purchase_request_deliverydate'=>$this->input->post('deliverydate'),
    'builder_purchase_request_description'=>$this->input->post('description')
  );
  $this->db->where('builder_purchase_request_id',$this->input->post('id_request'));
  $this->db->update('builder_purchase_request',$exData);
  return TRUE;
  }
  public function getpettycashlist()
  {
    $this->db->select('*');
    $this->db->from('b_boutique_expenses bx');
    $this->db->join('b_boutique_user bh', 'bx.boutique_billing_user_id = bh.boutique_user_id', 'left');
    $this->db->where("bx.builder_expense_status", 1);
    $this->db->where("bx.builder_expense_status", 1);
 
    $q = $this->db->get('');
   $data = $q->result_array();
   return @$data;

  }
  public function getprojectengineer()
  {
    $this->db->select('*');
    $this->db->from('b_boutique_user');
   $this->db->where("boutique_user_role", 4);
   $this->db->or_where("boutique_user_role", 5);
   $this->db->or_where("boutique_user_role", 6);
   $this->db->or_where("boutique_user_role", 7);
   $q = $this->db->get('');
   $data = $q->result_array();
   return @$data;

  }
  public function getpettyexpences($id) {
    $this->db->select('*');
     $this->db->from('b_boutique_petty_expenses bpe');
     $this->db->join('b_boutique_user bu', 'bu.boutique_user_id = bpe.pettycash_pm_id', 'full');
     $this->db->where('bpe.pettycash_pm_id',$id);
    $q = $this->db->get('');
    $data = $q->result_array();
  // var_dump($data);
  // exit(0);
    return @$data;
  }
  public function getpettycashinbank()
  {
    $this->db->select_sum('boutique_expense_amount');
    $this->db->from('b_boutique_expenses');
    $this->db->where('boutique_billing_user_id',$this->session->userdata('UserID'));
    $this->db->where('builder_expense_status',1);
    $this->db->where('boutique_expense_pay_type','Card');


    $q = $this->db->get('');
   $data = $q->result_array();
  //  echo $data;
  //  var_dump($data);
  //  exit(0);
   return @$data;
  }
  public function getpettycashinhand()
  {
    $this->db->select_sum('boutique_expense_amount');
    $this->db->from('b_boutique_expenses');
    $this->db->where('boutique_billing_user_id',$this->session->userdata('UserID'));
    $this->db->where('builder_expense_status',1);
    $this->db->where('boutique_expense_pay_type','Cash');


    $q = $this->db->get('');
   $data = $q->result_array();
  //  echo $data;
  //  var_dump($data);
  //  exit(0);
   return @$data;
  }
  public function savestock()
  {
  //   $CI = & get_instance();
  //   $exData = array(
  //   'builder_stock_name'=>$this->input->post('itemname'),
  //   'builder_stock_hsn'=>$this->input->post('item_hsn_code'),
  //   'builder_stock_unitprice'=>$this->input->post('unit_price'),
  //   'builder_stock_quantity'=>$this->input->post('quantity'),
  //   'builder_stock_item_desription'=>$this->input->post('item_description')
  // );
  // $this->db->insert('builder_stock',$exData);
  // $esID = $this->db->insert_id();
  // return $esID;
  $CI = & get_instance();
  if(@$this->input->post('boutique_item_code')){
      $sku = $this->input->post('boutique_item_code');
  }
  else{
      $sku = 'BM'.$this->session->userdata('BoutiqueID').mt_rand(10000, 99999);
  }

  $barcode = 'BMB'.$this->session->userdata('BoutiqueID').mt_rand(100000, 999999);

  // $imageResource = Zend_Barcode::factory('code128', 'image', array('text'=>$barcode), array())->draw();
  // imagepng($imageResource, 'uploads/barcode/'.$barcode.'.png');

  $itemData = array(
    'boutique_item_name'=>$this->input->post('itemname'),
    'boutique_item_desc'=>$this->input->post('item_description'),
    // 'boutique_item_image'=>$newfileName,
    'boutique_item_unit_price'=>$this->input->post('unit_price'),
    'boutique_item_purchase_price'=>$this->input->post('boutique_item_purchase_price'),
    'boutique_item_total_remaining'=>$this->input->post('quantity'),
    'boutique_item_total_quantity'=>$this->input->post('quantity'),
    'boutique_item_total_sold'=>0,
    'boutique_item_code'=>$sku,
    'boutique_item_barcode'=>$barcode,
    'boutique_item_hsn'=>$this->input->post('item_hsn_code'),
    // 'boutique_tax_id'=>$this->input->post('boutique_tax_id'),
    'boutique_item_createdby'=>$this->session->userdata('UserID'),
    'boutique_id'=>$this->session->userdata('BoutiqueID')
  );
  $this->db->insert('b_boutique_items',$itemData);
  $itID = $this->db->insert_id();
  return $itID;
}
    public function getstocklist($id = NULL)
    {
    
      $this->db->select('*');
      $this->db->from('b_boutique_items');
      $this->db->where("boutique_id", $this->session->userdata('BoutiqueID'));
      if($id){
        $this->db->where("boutique_item_id", $id);
        }
      $q = $this->db->get('');
      $data = $q->result_array();
      return @$data;
    
    }
    public function m_removestock($id)
    {
      $this->db->where('builder_stock_id', $id);
      $this->db->delete('builder_stock');
      return true; 
    }
    public function updatesheduledwork()
    {
      $CI = & get_instance();
      $exData = array(
        'schedule_work_date'=>$this->input->post('sheduleddate'),
        'schedule_work_completedate'=>$this->input->post('completed_date'),
        'schedule_work_startingdate'=>$this->input->post('starting_date'),
        // 'schedule_work_actualwork'=>$this->input->post('actual_work'),
        'scheduled_property_id'=>$this->input->post('property_id'),
        'sceduled_work_planned'=>$this->input->post('ac_wk_plan'),
        'builder_work_status'=>$this->input->post('work_status'),
        'scheduled_work_builders_comments'=>$this->input->post('comments')
        // 'schedule_work_task'=>$this->input->post('task')
      );
    $this->db->where('schedule_work_id',$this->input->post('scheduled_id'));
    $this->db->update('scheduled_work_builders',$exData);
    return TRUE;
    }
    public function updatestockitem()
    {
      $CI = & get_instance();
      $exData = array(
        'boutique_item_name'=>$this->input->post('itemname'),
        'boutique_item_hsn'=>$this->input->post('item_hsn_code'),
        'boutique_item_unit_price'=>$this->input->post('unit_price'),
        'boutique_item_desc'=>$this->input->post('item_description')
      );
    $this->db->where('boutique_item_id',$this->input->post('item_id'));
    $this->db->update('b_boutique_items',$exData);
    return TRUE;
      
    }
    public function getdayexpences($id) {
      $id = str_replace('-','/',$id);
   
      $this->db->select('*');
       $this->db->from('b_boutique_expenses bx');
       $this->db->join('b_boutique_billing_heads bh', 'bx.boutique_billing_head_id = bh.boutique_billing_head_id', 'left');
       if(@$id){
        $this->db->where('bx.boutique_expense_date', $id);
         }
       
       $this->db->where("bx.boutique_id", $this->session->userdata('BoutiqueID'));
      $q = $this->db->get('');
      $data = $q->result_array();
  //  var_dump($data);
   
      return @$data;
  }  
  public function getdayincomes($id) {
    $id = str_replace('-','/',$id);
    $this->db->select('*');
     $this->db->from('b_boutique_income bx');
     $this->db->join('b_boutique_billing_heads bh', 'bx.boutique_billing_head_id = bh.boutique_billing_head_id', 'left');
     $this->db->join('b_boutique_properties bp ', 'bp.boutique_property_id = bx.boutique_property','left');
 
     if(@$id){
      $this->db->where('bx.boutique_expense_date', $id);
    }
     $this->db->where("bx.boutique_id", $this->session->userdata('BoutiqueID'));
    
    $q = $this->db->get('');
    $data = $q->result_array();
    return @$data;
}
public function listdayschedulework($id)
{
  $id = str_replace('-','/',$id);
  $this->db->select('*');
  $this->db->from('scheduled_work_builders');
  if(@$id){
    $this->db->where('schedule_work_date', $id);
    $this->db->or_where('schedule_work_completedate', $id);
    $this->db->or_where('schedule_work_startingdate', $id);
  }
  
  $q = $this->db->get('');
  $data = $q->result_array();
  return @$data;
}
public function getdaysales($id) {
  $id = str_replace('-','/',$id);
  $this->db->select('*');
  $this->db->from('b_boutique_sales bs');
  $this->db->join('b_boutique_properties bp', 'bp.boutique_property_id = bs.boutique_customer_id','left');
  $this->db->where("bs.boutique_id", $this->session->userdata('BoutiqueID'));
  if(@$id){
    $this->db->where('bs.boutique_sale_date', $id);
  }
  $this->db->order_by("bs.boutique_sale_id", "desc");
  $q = $this->db->get();
  $data = $q->result_array();
  // var_dump($id);
  // exit(0);
  return @$data;
}
public function alldayrequestlist($id)
  {
    $id = str_replace('-','/',$id);
  $this->db->select( '*');
  $this->db->from('builder_purchase_request');
  if(@$id){
    $this->db->where('builder_purchase_request_date', $id);
  }
  $q = $this->db->get();
  $data = $q->result_array();
  // var_dump($id);
  // exit(0);
  return @$data; 
  }

  // Credit item open

  public function getinvoiceno()
{
  $this->db->select( '*');
		$this->db->from('credit_item_list');
		$this->db->order_by("builder_create_invoice",'desc');
		$this->db->limit('1');
		$q = $this->db->get();
		$data = $q->result_array();
    return @$data;
  }

  public function m_getallvendors()
    {
      $this->db->select('*');
      $this->db->from('b_boutique_vendor');
      $this->db->where('boutique_id', $this->session->userdata('BoutiqueID'));
      $q = $this->db->get();
      $data = $q->result_array();
      return @$data;   
    }

    public function addcredititems(){
      $CI = & get_instance();
      $pay_type = $this->input->post('boutique_sale_paymenttype');
      $pay_type = explode (",", $pay_type); 
      $paytype = $pay_type[0];
      $pay_mode = $pay_type[1];
  

      $date = $this->input->post('boutique_expense_date');
      $date = explode('/', $date);
      $month = $date[0];
      $day   = $date[1];
      $year  = $date[2];
      
      if(strlen($year) == 2)
      {
        $year= '20'.$year;
        $date = $month."/".$day."/".$year;
      }
      else
      {
        $date = $this->input->post('boutique_expense_date');   
      }
      $expenceData = array(
        'boutique_expense_date'=>$date,
        'boutique_billing_head_id'=>$this->input->post('boutique_billing_head_id'),
        'boutique_expense_amount'=>$this->input->post('boutique_expense_amount'),
        'builder_create_invoice'=>$this->input->post('invoice_no'),
        'boutique_expense_pay_type'=>$this->input->post('boutique_sale_paymenttype'),
        'boutique_expense_details'=>$this->input->post('boutique_expense_details'),
        'credit_item_total_sgst'=>$this->input->post('totalsgst'),
        'credit_item_total_cgst'=>$this->input->post('totalcgst'),
        'credit_item_total_igst'=>$this->input->post('totaligst'),
        'credit_item_total_total_gst'=>$this->input->post('totalgst'),
        'credit_date_of_arrival'=>$this->input->post('boutique_arrival_date'),
        'credit_last_date_payment'=>$this->input->post('boutique_last_date_payment'),
        'boutique_expense_pay_type'=>$paytype,'builders_payment_mode'=>$pay_mode,
        'boutique_expense_createdby'=>$this->session->userdata('UserID'),
        'boutique_id'=>$this->session->userdata('BoutiqueID')
        // 'boutique_expense_pay_type'=>$paytype,'builder_invoice_no'=>$invoice_No,'builders_payment_mode'=>$pay_mode,'b_boutoque_invoice_no'=>$invoice,
      
      );
      if($this->session->userdata('UserID') ==126) {
      $expenceData['boutique_property'] =$this->input->post('property_id'); 
      }
      $this->db->insert('credit_item_list',$expenceData);
      $esID = $this->db->insert_id();
  
      $i=0;
      $total = count($this->input->post('ltem_name[]'));
  
      for($i=0 ; $i<$total ; $i++)
      {
  
  
          $itemname = $this->input->post('ltem_name['.$i.'][]');
          $hsncode = $this->input->post('hsncode['.$i.'][]');
          $itemprice = $this->input->post('itemprice['.$i.'][]');
          $gst_per = $this->input->post('gst_per['.$i.'][]');       
          $gst_per_sgst = $this->input->post('gst_persgst['.$i.'][]');       
          $gst_per_igst = $this->input->post('gst_perigst['.$i.'][]');         
          $gst_mode= $this->input->post('gst_mode['.$i.'][]');
          $quantity =  $this->input->post('quantity['.$i.'][]');
          $amount_item =  $this->input->post('amount_item['.$i.'][]');
       
          // var_dump($itemname);
         
          $data = array('builders_credit_item_name'=>$itemname[0],
        'builders_credit_item_hsn_code'=>$hsncode[0],
        'builders_credit_item_price'=>$itemprice[0],     
        'builders_credit_item_gst_per'=>$gst_per[0],
        'builders_credit_item_sgst_per'=>$gst_per_sgst[0],
        'builders_credit_item_igst_per'=>$gst_per_igst[0],
        'builders_credit_item_gst_mode'=>$gst_mode[0],
        'builders_credit_item_quantity'=>$quantity[0],
        'builders_credit_item_Amount'=>$amount_item[0],
        'credit_item_purchaseI_id'=>$esID,
        'boutique_id'=>$this->session->userdata('BoutiqueID'));
        $this->db->insert('builders_credit_items',$data);
      }
  //  exit(0);
      return $esID;
    }

    public function m_addvendor()
    {
      $name = $this->input->post('name');
      $gst = $this->input->post('gst_no');
      $phone = $this->input->post('phone');
      $address = $this->input->post('address');
      $data = array('b_boutique_vendor_name'=>ucfirst($name),'b_boutique_GST_no'=>$gst,'b_boutique_ven_phone'=>$phone,'b_boutique_ven_add'=>$address,'boutique_id'=>$this->session->userdata('BoutiqueID'));
      $this->db->insert('b_boutique_vendor',$data);
      return TRUE;
    }

    public function credititemlist($id =NULL,$option=NULL) {
      $this->db->select('*');
       $this->db->from('credit_item_list bx');
       $this->db->join('b_boutique_properties bp', 'bx.boutique_property = bp.boutique_property_id', 'left');
       $this->db->join('b_boutique_vendor bv', 'bx.boutique_billing_head_id = bv.b_boutique_vendor_id', 'left');
       $this->db->where("bx.boutique_id", $this->session->userdata('BoutiqueID'));
       if(@$id){
        $this->db->where('bx.boutique_property',$id);
      }
      if(@$option){
        $this->db->where('bx.builders_payment_mode',$option);
      }
       $q = $this->db->get('');
      $data = $q->result_array();
      return @$data;
    }

    public function m_getvendors($id)
    {
      $this->db->select('*');
      $this->db->from('b_boutique_vendor');
      $this->db->where('boutique_id', $this->session->userdata('BoutiqueID'));
      $this->db->where('b_boutique_vendor_id', $id);
      $q = $this->db->get();
      $data = $q->result_array();
      return @$data;   
    }
    public function updatevendor(){
      
      $exData = array(
      'b_boutique_vendor_name'=>$this->input->post('name'),
      'b_boutique_ven_phone'=>$this->input->post('phone'),
      'b_boutique_ven_phone'=>$this->input->post('gst_no'),
      'b_boutique_ven_add'=>$this->input->post('address'),
    );
    $this->db->where('b_boutique_vendor_id',$this->input->post('vendor_id'));
    $this->db->update('b_boutique_vendor',$exData);
    return TRUE;
  }
  public function removevender($id) {

    $this->db->where('b_boutique_vendor_id', $id);
    $this->db->delete('b_boutique_vendor');

 }

 public function removecredititems($id) 
 {
    $this->db->where('boutique_expense_id', $id);
    $this->db->delete('credit_item_list');
    

    // credit_item_purchaseI_id
    // $this->db->where('boutique_order_id', $id);
    // $this->db->where('order_type', 3);
    // $this->db->delete('b_boutique_order_payments');
    
    $this->db->where('credit_item_purchaseI_id', $id);
    $this->db->delete('builders_credit_items');
    
    return true;
}

public function credititemlistid($id) {
  $this->db->select('*');
   $this->db->from('credit_item_list bx');
   $this->db->join('b_boutique_properties bp', 'bx.boutique_property = bp.boutique_property_id', 'left');
   $this->db->join('b_boutique_vendor bv', 'bx.boutique_billing_head_id = bv.b_boutique_vendor_id', 'left');
   $this->db->where("bx.boutique_id", $this->session->userdata('BoutiqueID'));
   $this->db->where("bx.boutique_expense_id", $id);

  $q = $this->db->get('');
  $data = $q->result_array();
  return @$data;
}

public function m_getallcredititems($id)
  {
    $this->db->select( '*');
		$this->db->from('builders_credit_items');
		$this->db->where('credit_item_purchaseI_id', $id);
    $q = $this->db->get();
    $data = $q->result_array();
    return $data;
  }
  public function updateCredit(){

// builders_credit_item_name
$item_name = $this->input->post('builders_credit_item_name') ;
$item_hsn = $this->input->post('builders_credit_item_hsn_code') ;
$item_price = $this->input->post('builders_credit_item_price') ;
$item_cgst = $this->input->post('cgst') ;
$item_sgst = $this->input->post('sgst') ;
$item_igst = $this->input->post('igst') ;
// var_dump()
$item_quantity = $this->input->post('builders_credit_item_quantity') ;
$item_amount = $this->input->post('builders_credit_item_Amount') ;
// echo (count($item_name));

    $this->db->where('credit_item_purchaseI_id', $this->input->post('boutique_expense_id'));
    $this->db->delete('builders_credit_items');
    

for($i=0 ; $i<count($item_name) ; $i++)
{

  $data = array('builders_credit_item_name'=>$item_name[$i],
  'builders_credit_item_hsn_code'=>$item_hsn[$i],
  'builders_credit_item_price'=>$item_price[$i],     
  'builders_credit_item_gst_per'=>$item_cgst[$i],
  'builders_credit_item_sgst_per'=>$item_sgst[$i],
  'builders_credit_item_igst_per'=>$item_igst[$i],
  'builders_credit_item_gst_mode'=>$item_name[$i],
  'builders_credit_item_quantity'=>$item_quantity[$i],
  'builders_credit_item_Amount'=>$item_amount[$i],
  'credit_item_purchaseI_id'=>$this->input->post('boutique_expense_id'),
  'boutique_id'=>$this->session->userdata('BoutiqueID'));
  $this->db->insert('builders_credit_items',$data);

}  
    $CI = & get_instance();
    $exData = array(
      'boutique_expense_date'=>$this->input->post('boutique_expense_date'),
      'boutique_billing_head_id'=>$this->input->post('boutique_billing_head_id'),
      'boutique_expense_amount'=>$this->input->post('boutique_expense_amount'),
      // 'builder_create_invoice'=>$this->input->post('invoice_no'),
      // 'boutique_expense_pay_type'=>$this->input->post('boutique_sale_paymenttype'),
      'boutique_expense_details'=>$this->input->post('boutique_expense_details'),
      'credit_item_total_sgst'=>$this->input->post('totalsgst'),
      'credit_item_total_cgst'=>$this->input->post('totalcgst'),
      'credit_item_total_igst'=>$this->input->post('totaligst'),
      'credit_item_total_total_gst'=>$this->input->post('totalgst'),
      'credit_date_of_arrival'=>$this->input->post('date_of_arrival'),
      'credit_last_date_payment'=>$this->input->post('last_date_payment'),
    );
  $exData['boutique_property'] =$this->input->post('property_id'); 
  $this->db->where('boutique_expense_id',$this->input->post('boutique_expense_id'));
  $this->db->update('credit_item_list',$exData);
  return TRUE;
}

public function getlivecreditreport($id = NULL , $option = NULL) {
 
  $this->db->select("*");
  // $this->db->from('b_boutique_order_payments bop');

  $this->db->from('credit_item_list bx');
  $this->db->join('b_boutique_vendor bv ', 'bv.b_boutique_vendor_id = bx.boutique_billing_head_id','full');
  
  // boutique_billing_head_id $this->db->join('credit_item_list bx', 'bx.boutique_expense_id = bop.boutique_order_id','left');
  $this->db->join('b_boutique_properties bp ', 'bp.boutique_property_id = bx.boutique_property','left');
   if(@$this->input->post('property_name') != 0){
    $this->db->where('bx.boutique_property',$this->input->post('property_name'));
  }
  if(@$this->input->post('vendor_name') != 0){
    $this->db->where('bx.boutique_billing_head_id',$this->input->post('vendor_name'));
  }
  //  $this->db->where("bx.boutique_id", $this->session->userdata('BoutiqueID'));
// property_name
  if(@$this->input->post('date_from_report') && @$this->input->post('date_to_report'))
  {
     $this->db->where('bx.boutique_expense_date >=', @$this->input->post('date_from_report'));
     $this->db->where('bx.boutique_expense_date <=', @$this->input->post('date_to_report'));
  }
  // $this->db->where('bop.order_type', 3);

  $q = $this->db->get();
  $data = $q->result_array();
  return @$data;
}
public function m_getorderdetailscredititemslist($orderid)
{
	$this->db->select( '*');
	$this->db->from('credit_item_list bo');
	$this->db->where('bo.boutique_expense_id',$orderid);
	$q = $this->db->get();
	$data = $q->result_array();
	return @$data[0];	
}

function  m_addpaymentcredititems(){

	
	$tillpaid = $this->input->post('boutique_order_amtpaid') + $this->input->post('amount_paid');
	$data = array('credit_paid_amount'=>$tillpaid);
	$this->db->where('boutique_expense_id', $this->input->post('expece_id'));
	$this->db->update('credit_item_list',$data);

	$pay_type = $this->input->post('boutique_sale_paymenttype');
	$pay_type = explode (",", $pay_type); 
	$paytype = $pay_type[0];
	$pay_mode = $pay_type[1];
  

	$data = array(
		'boutique_order_paymentamt'=>$this->input->post('amount_paid'),
		'boutique_order_paid_date'=>$this->input->post('paid_date'),
		'boutique_order_paymentdesc'=>$this->input->post('comments'),
		'boutique_expense_pay_type'=>$paytype,
		'builders_payment_mode'=>$pay_mode,
		'order_type'=>3,
	'boutique_order_id'=>$this->input->post('expece_id'));
	$this->db->insert('b_boutique_order_payments',$data);

return;
}
public function updatedatestracture()
{
  // Petty Cash
  $this->db->select('*');
	$this->db->from('b_boutique_petty_expenses');
	$q = $this->db->get();
  $data = $q->result_array();
  foreach($data as $data)
  {
    $date = $data["boutique_expense_date"];
    $date = explode('/', $date);
    $month = $date[0];
    $day   = $date[1];
    $year  = $date[2];

    if(strlen($year) == 2)
      {
        $year= '20'.$year;
        $date = $month."/".$day."/".$year;
        $exData = array('boutique_expense_date'=>$date);
        $this->db->where('boutique_expense_id',$data["boutique_expense_id"]);
        $this->db->update('b_boutique_petty_expenses',$exData);
      }
  }
  // Expense
  $this->db->select('*');
	$this->db->from('b_boutique_expenses');
	$q = $this->db->get();
  $data = $q->result_array();
  foreach($data as $data)
  {
    $date = $data["boutique_expense_date"];
    $date = explode('/', $date);
    $month = $date[0];
    $day   = $date[1];
    $year  = $date[2];

    if(strlen($year) == 2)
      {
        $year= '20'.$year;
        $date = $month."/".$day."/".$year;
        $exData = array('boutique_expense_date'=>$date);
        $this->db->where('boutique_expense_id',$data["boutique_expense_id"]);
        $this->db->update('b_boutique_expenses',$exData);
      }
  }
  // Income
  $this->db->select('*');
	$this->db->from('b_boutique_income');
	$q = $this->db->get();
  $data = $q->result_array();
  foreach($data as $data)
  {
    $date = $data["boutique_expense_date"];
    $date = explode('/', $date);
    $month = $date[0];
    $day   = $date[1];
    $year  = $date[2];

    if(strlen($year) == 2)
      {
        $year= '20'.$year;
        $date = $month."/".$day."/".$year;
        $exData = array('boutique_expense_date'=>$date);
        $this->db->where('boutique_expense_id',$data["boutique_expense_id"]);
        $this->db->update('b_boutique_income',$exData);
      }
  }
	
return;  

}
public function userlist_others()
{
  $this->db->select( '*');
	$this->db->from('b_boutique_user');
	// $this->db->where('boutique_user_role',3);
	$this->db->where('boutique_user_role',4);
	
  $this->db->where('boutique_user_id!=',127);
	$q = $this->db->get();
	$data = $q->result_array();
	return @$data;	
}
public function selectallprojects($id=NULL)
{
  // $this->db->select( '*');
	// $this->db->from('scheduled_work_builders');
	// $this->db->where('scheduled_work_builders_user_id',$this->session->userdata('UserID'));
	// $q = $this->db->get();
	// $data = $q->result_array();
	// return @$data;	
  $this->db->select('*');
  $this->db->from('scheduled_work_builders swb');
  $this->db->join('b_boutique_properties bp', 'bp.boutique_property_id = swb.scheduled_property_id', 'left');
  if(@$id){
    $this->db->where(' swb.schedule_work_id',$id);
    }
  $this->db->where('swb.scheduled_work_builders_user_id',$this->session->userdata('UserID'));

    $q = $this->db->get('');
  $data = $q->result_array();
  return @$data;
}
public function updatesheduledworkuser()
{
  $CI = & get_instance();
  $exData = array(
    'schedule_work_date'=>$this->input->post('sheduleddate'),
    'schedule_work_completedate'=>$this->input->post('completed_date'),
    'schedule_work_startingdate'=>$this->input->post('starting_date'),
    'schedule_work_actualwork'=>$this->input->post('actual_work'),
    'scheduled_property_id'=>$this->input->post('property_id'),
    'sceduled_work_planned'=>$this->input->post('ac_wk_plan'),
    'builder_work_status'=>$this->input->post('work_status'),
    'schedule_work_task'=>$this->input->post('task')
  );
$this->db->where('schedule_work_id',$this->input->post('scheduled_id'));
$this->db->update('scheduled_work_builders',$exData);
return TRUE;
}
public function assignedusername($id)
{
  $this->db->select( '*');
	$this->db->from('b_boutique_user');	
  $this->db->where('boutique_user_id',$id);
	$q = $this->db->get();
	$data = $q->row_array();
	return @$data;	

}
public function saveleave()
{
  $leaveData = array(
    'builder_leave_apply_date'=>$this->input->post('starting_date'),
    'builder_leave_apply_applied_date'=>$this->input->post('current_date'),
    'builder_leave_apply_type'=>$this->input->post('leave_type'),
    'builder_leave_apply_time'=>$this->input->post('type_time'),
    'builder_leave_apply_user_id'=>$this->session->userdata('UserID'),
    'builder_leave_apply_description'=>$this->input->post('description'),
    'builder_leave_apply_status'=>1
  );
$this->db->insert('builder_leave_apply',$leaveData);
return TRUE;
}
      public function getallleave()
      {
        $this->db->select( '*');
        $this->db->from('builder_leave_apply');	
        if($this->session->userdata('UserRole') == 3 )
        {
          $this->db->where('builder_leave_apply_user_id',$this->session->userdata('UserID'));         
        }
        $this->db->order_by("builder_leave_apply_id", "desc");
        $q = $this->db->get();
        $data = $q->result_array();
        return @$data;	
      }
      public function getallleave_admin()
      {
        $this->db->select( '*');
        $this->db->from('builder_leave_apply bla');	
        $this->db->join('b_boutique_user bu', 'bu.boutique_user_id = bla.builder_leave_apply_user_id', 'full');
        $this->db->order_by("bla.builder_leave_apply_id", "desc");
        $q = $this->db->get();
        $data = $q->result_array();
        return @$data;	
        
      }
      public function getcurrent_leave($id)
      {
        $this->db->select( '*');
        $this->db->from('builder_leave_apply bla');	
        $this->db->join('b_boutique_user bu', 'bu.boutique_user_id = bla.builder_leave_apply_user_id', 'full');
        $this->db->where('bla.builder_leave_apply_id',$id);         
        $q = $this->db->get();
        $data = $q->row_array();
        return @$data;	
      }
      public function updateadminleave()
      {
        $leaveData = array(
            'builder_leave_apply_office_commment'=>$this->input->post('comments_admin'),
            'builder_leave_apply_status'=>$this->input->post('leave_status')
          );
        $this->db->where('builder_leave_apply_id',$this->input->post('apply_id'));
        $this->db->update('builder_leave_apply',$leaveData);
        return TRUE;            
      }
      public function updateleave()
      {
        $leaveData = array(
          'builder_leave_apply_date'=>$this->input->post('starting_date'),
          'builder_leave_apply_applied_date'=>$this->input->post('current_date'),
          'builder_leave_apply_type'=>$this->input->post('leave_type'),
          'builder_leave_apply_time'=>$this->input->post('type_time'),
          'builder_leave_apply_description'=>$this->input->post('description')
        );
      $this->db->where('builder_leave_apply_id',$this->input->post('apply_id'));
      $this->db->update('builder_leave_apply',$leaveData);
      return TRUE;            
      
      }
      public function removeleave($id)
      {
        $this->db->where('builder_leave_apply_id', $id);
        $this->db->delete('builder_leave_apply');
        return true;
      }
      public function builders_derails($id)
      {
        $this->db->select( '*');
        $this->db->from('b_boutique bo');	
        $this->db->join('b_boutique_user bu', 'bu.boutique_id = bo.boutique_id', 'full');
        $this->db->where('bu.boutique_user_id',$id);         
        $q = $this->db->get();
        $data = $q->row_array();
        return @$data;
      }
      public function getexpencesreport_pettycash($id = NULL)
      {
        $this->db->select("*");
          $this->db->from('b_boutique_petty_expenses bx');
          
           $this->db->join('b_boutique_billing_heads bh', 'bx.boutique_billing_head_id = bh.boutique_billing_head_id','left');
           $this->db->join('b_boutique_properties bp ', 'bp.boutique_property_id = bx.boutique_property','left');
         
           $this->db->where("bx.boutique_id", $this->session->userdata('BoutiqueID'));
           $this->db->where("bx.boutique_property", $id);
        
          if(@$this->input->post('date_from_report') && @$this->input->post('date_to_report')){
             $this->db->where("STR_TO_DATE(bx.boutique_expense_date, '%d/%m/%Y') BETWEEN STR_TO_DATE('".$this->input->post('date_from_report')."', '%d/%m/%Y') AND STR_TO_DATE('".$this->input->post('date_to_report')."', '%d/%m/%Y')");
          }
          $this->db->where("bx.pettycash_pm_id", $this->session->userdata('UserID'));
        
          $q = $this->db->get();
          $data = $q->result_array();
          return @$data;
        
      }
      function m_getalluserlist_others(){
        $this->db->select( '*');
        $this->db->from('b_boutique_user bu');
        $this->db->join('builder_user buu', 'buu.builder_user_creteated_id = bu.boutique_user_id', 'full');
        $this->db->where('bu.boutique_user_id!=',127);
        $this->db->where_in('bu.boutique_user_role', 4);
        $q = $this->db->get();
        $data = $q->result_array();
        return @$data;
      }
      public function listschedulework_person($id)
      {

  $this->db->select('*');
  $this->db->from('scheduled_work_builders swb');
  $this->db->join('b_boutique_properties bp', 'bp.boutique_property_id = swb.scheduled_property_id', 'left');
  $this->db->where(' swb.scheduled_work_builders_user_id',$id);
  $q = $this->db->get('');
  $data = $q->result_array();
  return @$data;


      }

      public function savepaymentrequest()
      {
        $paymentData = array(
          'builder_payment_request_requested_date'=>$this->input->post('current_date'),
          'builder_payment_request_date'=>$this->input->post('starting_date'),
          'builder_payment_request_amount'=>$this->input->post('payment_amount'),
          'builder_payment_request_user_id'=>$this->session->userdata('UserID'),
          'builder_payment_request_description'=>$this->input->post('description'),
          'builder_payment_request_payment_status'=>1
        );
      $this->db->insert('builder_payment_request',$paymentData);
      return TRUE;
      }
      public function getallpaymentrequest()
      {
        $this->db->select('*');
        $this->db->from('builder_payment_request');
        $this->db->where('builder_payment_request_user_id',$this->session->userdata('UserID'));
        $q = $this->db->get('');
        $data = $q->result_array();
        return @$data;
      
      }
      public function getallpaymentrequest_details($id)
      {
        $this->db->select('*');
        $this->db->from('builder_payment_request');
        $this->db->where('builder_payment_request_id',$id);
        $q = $this->db->get('');
        $data = $q->row_array();
        return @$data;
      
      }
      public function updatepaymentrequest()
      {
        $paymentData = array(
          'builder_payment_request_requested_date'=>$this->input->post('current_date'),
          'builder_payment_request_date'=>$this->input->post('starting_date'),
          'builder_payment_request_amount'=>$this->input->post('payment_amount'),
          'builder_payment_request_description'=>$this->input->post('description'),
        );
      // var_dump($this->input->post('payment_amount'));
      // exit();

      $this->db->where('builder_payment_request_id',$this->input->post('payment_request_id'));
        $this->db->update('builder_payment_request',$paymentData);
      return TRUE;  
      }
      public function allgetallpaymentrequest()
      {
        $this->db->select('*');
        $this->db->from('builder_payment_request bpr');
        $this->db->join('b_boutique_user bu', 'bpr.builder_payment_request_user_id = bu.boutique_user_id', 'full');      
        $q = $this->db->get('');
        $data = $q->result_array();
      //  var_dump($data);
      //  exit();
        return @$data;
      
      }
      public function updateadminpayment()
      {
        $paymentData = array(
          'builder_payment_request_office_comment'=>$this->input->post('office_description'),
          'builder_payment_request_payment_status'=>$this->input->post('payment_status')
        );
      $this->db->where('builder_payment_request_id',$this->input->post('payment_request_id'));
      $this->db->update('builder_payment_request',$paymentData);
      return TRUE;    
      }
      public function remove_delete_payment_request($id)
      {
        $this->db->where('builder_payment_request_id', $id);
        $this->db->delete('builder_payment_request');
        return true;
     
      }
            public function getallpettycashlist()
      {
        $this->db->select('*');
        $this->db->from('b_boutique_expenses');
        $this->db->where('boutique_billing_user_id',$this->session->userdata('UserID'));
        $this->db->where('builder_expense_status',1);
        $q = $this->db->get('');
       $data = $q->result_array();
      //  echo $data;
      //  var_dump($data);
      //  exit(0);
       return @$data;
      }
      public function getallsupervisior()
      {
        $this->db->select('*');
        $this->db->from('b_boutique_user');
       $this->db->where("boutique_user_role", 4);
      //  $this->db->or_where("boutique_user_role", 5);
      //  $this->db->or_where("boutique_user_role", 6);
      //  $this->db->or_where("boutique_user_role", 7);
       $q = $this->db->get('');
       $data = $q->result_array();
       return @$data;    
      }
      public function getpettycashuserid($id)
      {
        $this->db->select('*');
        $this->db->from('b_boutique_user');
       $this->db->where("boutique_user_id", $id);
       $q = $this->db->get('');
       $data = $q->row_array();
       return @$data;    
        
      }

      // credit item close description

}
//