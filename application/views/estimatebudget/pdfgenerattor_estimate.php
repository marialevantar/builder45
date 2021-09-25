  <?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=EstimateBill.xls");

// $filename = 'Estimatebill'.date('Ymd').'.csv'; 
// header("Content-Description: File Transfer"); 
// header("Content-Disposition: attachment; filename=$filename"); 
// header("Content-Type: application/csv; ");
 ?> 
  <table style="width:100%" border='1'>
 <tr>
  <th>Description</th>
  <th>Vendor Or Suncontractor</th>
  <th style="background-color:#D1F083;">Labor</th>
  <th style="background-color:#F0D38B;">Material</th>
  <th style="background-color:#A0F5CA;">Total</th>
  <th style="background-color:#F9B6AD;">Actual cost</th>
  <th>Variance</th>
  <th>%completed</th>
  <th style="background-color:#CBB5FA;">Current Paid</th>
  <th style="background-color:#FAB5F3;">Amount Due</th>
  <th>Notes</th>

 </tr>
<?php


  $this->db->select( '*');
	$this->db->from('builder_description_header');    
  $q = $this->db->get();
	$data = $q->result_array();        
  foreach($data as $da1)
    {
?>
      <tr style="background-color:#52AEDF;"><th colspan="11" style="font-size:18px;"><i><?php echo $da1["header_name"]; ?></i></th><br></tr>  
<?php
  $this->db->select( '*');
  $this->db->from('builder_description_subheader bsh');    
  $this->db->where("header_id",$da1["hedaer_id"]);
  $q = $this->db->get();
  $datasubheader = $q->result_array();
  $labortotal =0;
  $material =0 ;
  $totaltotal=0;
  $actualtotal=0;
  $curenttotal=0;
  $amountduetotal=0;
  
  foreach($datasubheader as $datasub)
  { 
?>
    <tr>
      <td>
        <?php echo $datasub["subheader_name"]; ?>
      </td>
        <?php
          $this->db->select( '*');
          $this->db->from('builder_estimtaed_budget');    
          $this->db->where("subheader_id",$datasub["subheader_id"]);
          $this->db->where("builder_property",$id);
          $q = $this->db->get();
          $databudget = $q->result_array();

            if($databudget == NULL)
            {
     ?>

      <td>
      </td>
      <td style="background-color:#D1F083;">
      </td>
      <td style="background-color:#F0D38B;">
      </td>
      <td style="background-color:#A0F5CA;">
      </td>
      <td style="background-color:#F9B6AD;">
      </td>
      <td>
      </td>
      <td>
      </td>
      <td style="background-color:#CBB5FA;">
      </td>
      <td style="background-color:#FAB5F3;">
      </td>
      <td>
      </td>

     <?php         
            }
            else
            {


          foreach($databudget as $databud)
          {
        ?>
      <td>
          <?php  echo $databud["vendor_contractor"]; ?>
      </td>
      <td style="background-color:#D1F083;">
          <?php  echo $databud["labor_cost"]; 
          $labortotal = $labortotal+$databud["labor_cost"];
          ?>
      </td>
      <td style="background-color:#F0D38B;">
          <?php  echo $databud["materail_cost"]; 
          $material =$material + $databud["materail_cost"];
          ?>
      </td>
      <td style="background-color:#A0F5CA;">
          <?php  echo $databud["total_cost"];
          $totaltotal =$totaltotal+$databud["total_cost"];
          ?>
      </td>
      <td style="background-color:#F9B6AD;">
          <?php  echo $databud["actual_cost"];
          $actualtotal=$actualtotal+$databud["actual_cost"];
          ?>
      </td>
      <td>
          <?php  echo $databud["variance"]; ?>
      </td>
      <td>
          <?php  echo $databud["completed_percentage"]; ?>
      </td>
      <td style="background-color:#CBB5FA;">
          <?php  echo $databud["current_paid"];
          $curenttotal=$curenttotal+$databud["current_paid"];
          ?>
      </td>
      <td style="background-color:#FAB5F3;">
          <?php  echo $databud["amount_due"];
          $amountduetotal=$amountduetotal+$databud["amount_due"];
          ?>
      </td>
      <td>
          <?php  echo $databud["builder_notes"]; ?>
      </td>

        <?php
          }
        }
        ?>
    
    </tr>

    

<?php    
  }          
?>
<tr style="background-color:#A3D3EC">
  <th><b style="font-size:14px;">SUB TOTAL</b></th>
  <th></th>
  <th style="background-color:#D1F083;"><?php echo $labortotal; $finallabourtotal =  $finallabourtotal+$labortotal; ?></th>

  <th style="background-color:#F0D38B;"><?php echo $material; $finalmaterial = $finalmaterial+$material; ?></th>
  <th style="background-color:#A0F5CA;"><?php echo $totaltotal; $finaltotaltotal = $finaltotaltotal+$totaltotal; ?></th>
  <th style="background-color:#F9B6AD;"><?php echo $actualtotal; $finalactualtotal = $finalactualtotal+$actualtotal; ?></th>
  <th></th>
  <th></th>
  <th style="background-color:#CBB5FA;"><?php echo $curenttotal; $finalcurrenttotal = $finalcurrenttotal+$curenttotal; ?></th>
  <th style="background-color:#FAB5F3;"><?php echo $amountduetotal; $finalamountduetotal=$finalamountduetotal+$amountduetotal;?></th>
  <th></th>

 </tr>
<?php
    }
?>
<!--   -->
<tr>
  <td colspan="11">&nbsp;&nbsp;Note: Add 20% to 25% for contractors overhead and profit, plus up to 8% for sales and marketing if purchased from a developer.</td>
</tr>

<tr>
  <td colspan="11">&nbsp;&nbsp;<b>&#169; 2015 BuildingAdvisor LLC.  All rights reserved.</b></td>
</tr>

<tr style="background-color:#F8C471">
  <th><b style="font-size:14px;">TOTAL CONSTRUCTION COST</b></th>
  <th></th>
  <th style="background-color:#D1F083;"><?php echo $finallabourtotal; ?></th>
  <th style="background-color:#F0D38B;"><?php echo $finalmaterial; ?></th>
  <th style="background-color:#A0F5CA;"><?php echo $finaltotaltotal; ?></th>
  <th style="background-color:#F9B6AD;"><?php echo $finalactualtotal; ?></th>
  <th></th>
  <th></th>
  <th style="background-color:#CBB5FA;"><?php echo $finalcurrenttotal; ?></th>
  <th style="background-color:#FAB5F3;"><?php echo $finalamountduetotal; ?></th>
  <th></th>
 </tr>

<tr>
    <td></td>
</tr>
</table>