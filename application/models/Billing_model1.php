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
       $q = $this->db->get('b_boutique_billing_heads');
       $data = $q->result_array();
       return @$data;
   }
    public function addexpencecategories(){
      $CI = & get_instance();
      $expencecatData = array(
        'boutique_billing_head_name'=>$this->input->post('head_name'),        
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

   public function getexpences() {
       $this->db->select('*');
        $this->db->from('b_boutique_expenses bx');
        $this->db->join('b_boutique_billing_heads bh', 'bx.boutique_billing_head_id = bh.boutique_billing_head_id', 'left');
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
      $CI = & get_instance();
      $expenceData = array(
        'boutique_expense_date'=>$this->input->post('boutique_expense_date'),
        'boutique_billing_head_id'=>$this->input->post('boutique_billing_head_id'),
        'boutique_expense_amount'=>$this->input->post('boutique_expense_amount'),
        'boutique_expense_details'=>$this->input->post('boutique_expense_details'),
        'boutique_expense_createdby'=>$this->session->userdata('UserID'),
        'boutique_id'=>$this->session->userdata('BoutiqueID')
      );
      if($this->session->userdata('UserID') ==136) {
      $expenceData['boutique_property'] =$this->input->post('property_id'); 
      }
      $this->db->insert('b_boutique_expenses',$expenceData);
      $esID = $this->db->insert_id();

      return $esID;
    }

    public function removeexpence($id) {
      $this->db->where('boutique_expense_id', $id);
      $this->db->delete('b_boutique_expenses');
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
      if($this->session->userdata('UserID') ==136) {
      $exData['boutique_property'] =$this->input->post('property_id'); 
      }
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

    public function getexpencesreport() {
       $this->db->select("*");
        $this->db->from('b_boutique_expenses bx');
        $this->db->join('b_boutique_billing_heads bh', 'bx.boutique_billing_head_id = bh.boutique_billing_head_id','left');
       $this->db->where("bx.boutique_id", $this->session->userdata('BoutiqueID'));

       if(@$this->input->post('date_from_report') && @$this->input->post('date_to_report')){
          $this->db->where("STR_TO_DATE(bx.boutique_expense_date, '%d/%m/%Y') BETWEEN STR_TO_DATE('".$this->input->post('date_from_report')."', '%d/%m/%Y') AND STR_TO_DATE('".$this->input->post('date_to_report')."', '%d/%m/%Y')");
       }

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
       $this->db->join('b_boutique_customers bc', 'bc.boutique_customer_id = bs.boutique_customer_id','left');
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
        'boutique_sale_items'=>count($this->input->post('boutique_item_id')),
        'boutique_sale_price'=>$this->input->post('boutique_sale_price'),
        'boutique_sale_amountpaid'=>$this->input->post('boutique_sale_amountpaid'),
        'boutique_sale_balanceamount'=>$this->input->post('boutique_sale_balanceamount'),
        'boutique_sale_date'=>$this->input->post('boutique_sale_date'),
        'boutique_sale_paymenttype'=>$this->input->post('boutique_sale_paymenttype'),
        'boutique_sale_billtype'=>$this->input->post('boutique_sale_billtype'),
        'boutique_sale_invoice'=>$this->input->post('boutique_sale_invoice'),
        'boutique_sale_invoice_number'=>$this->input->post('boutique_sale_invoice'),
        'boutique_sale_invoice_gstnumber'=>$this->input->post('boutique_sale_invoice_gstnumber'),
        'boutique_customer_id'=>$this->input->post('boutique_customer_id'),
        'boutique_customer_details'=>$this->input->post('boutique_customer_details'),
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
            'boutique_item_id'=>$itemsids[$i],
            'boutique_sale_unit'=>$itemsqantity[$i],
            'boutique_sale_item_name'=>$itemsname[$i],
            'boutique_sale_item_desc'=>$itemsdesc[$i],
            'boutique_sale_item_tax'=>$itemstax[$i],
            'boutique_sale_item_hsn'=>$itemshsn[$i],
            'boutique_sale_item_totalunitprice'=>$itemstotalprice[$i],
            //'boutique_sale_item_unitprice'=>$itemdetails['boutique_item_unit_price'],
            'boutique_sale_item_unitprice'=>$itemsprice[$i],
            'boutique_sale_item_code'=>$itemdetails['boutique_item_code'],
            'boutique_sale_item_barcode'=>$itemdetails['boutique_item_barcode'],
            'boutique_sale_id'=>$saleID,
            'boutique_customer_id'=>$this->input->post('boutique_customer_id'),
            'boutique_id'=>$this->session->userdata('BoutiqueID')
          );
          $this->db->insert('b_boutique_sale_items',$saleitemData);
        }
        else{

         $saleitemData = array(
            'boutique_item_id'=>$itemsids[$i],
            'boutique_sale_unit'=>$itemsqantity[$i],
            'boutique_sale_item_name'=>$itemsname[$i],
            'boutique_sale_item_desc'=>$itemsdesc[$i],
            'boutique_sale_item_tax'=>$itemstax[$i],
            'boutique_sale_item_hsn'=>$itemshsn[$i],
            'boutique_sale_item_totalunitprice'=>$itemstotalprice[$i],
            'boutique_sale_item_unitprice'=>$itemsprice[$i],
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
       $this->db->join('b_boutique_customers bc', 'bc.boutique_customer_id = bs.boutique_customer_id', 'left');
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
        'boutique_id'=>$this->session->userdata('BoutiqueID')
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
        'boutique_property_name'=>$this->input->post('boutique_property_name')
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


}
