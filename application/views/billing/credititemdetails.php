<?php 
$stat = $this->session->userdata('filter');
if($stat == "rejected"):
  $backlink = base_url()."boutique/expences";
elseif($stat == "new"):
  $backlink = base_url()."boutique/expences";
elseif($stat == "active"):
  $backlink = base_url()."boutique/expences";
else:
  $backlink = base_url()."boutique/expences";
endif;
 ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Update
      <small>Credit Items</small>
    </h1>
    <?php if($this->session->flashdata('notification')):
    if($this->session->flashdata('status') == "success"):
      $s_class = " alert-success ";
    else:
      $s_class = " alert-danger ";
    endif;
    ?>
    <div class="alert <?php echo $s_class; ?> alert-dismissible" style="margin-top:15px;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <?php echo $this->session->flashdata('notification'); ?>
    </div>
    <?php endif; ?>
  </section>

  <!-- Main content -->
  <section class="content">
  <div class="box box-info">
    <form id="addcustomer" method="post" action="<?php echo base_url(); ?>billing/updatecredititems/">
      <div class="box-header with-border">
        <h3 class="box-title">Credit Item Details</h3>
        <span class="pull-right"><a class="btn btn-info" href="<?php echo @$backlink; ?>">
        Back</a></span>
      </div>
      <div class="box-body">
        <div class="row">

          <div class="col-md-12">
            <div class="form-group">
              <label>Date</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input name="boutique_expense_date" type="text" class="form-control pull-right" id="datepicker1" value="<?php echo $expences[0]['boutique_expense_date'];?>">
              </div>
            </div>
          </div>
           <div class="col-md-12">
            <div class="form-group">
                <label>Select Property</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="fa-user fa"></span></span>
                  <select name="property_id" class="form-control" required>
                    <option value="">Select Property</option>
                  <?php
                  for($i=0; $i<count($properties);$i++) {
                   ?>
                    <option value="<?php echo $properties[$i]['boutique_property_id']; ?>" <?php if($properties[$i]['boutique_property_id']==$expences[0]['boutique_property']) echo 'selected'; ?>>
                    <?php echo $properties[$i]['boutique_property_name']; ?>
                    </option>
                  <?php } ?>
                  </select>
                </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
                <label>Select Vendor</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="fa-user fa"></span></span>
                  <select name="boutique_billing_head_id" class="form-control">
                    <option value="">Select Vendor</option>
                  <?php
                  for($i=0; $i<count($expencecategory);$i++) {
                   ?>
                    <option value="<?php echo $expencecategory[$i]['b_boutique_vendor_id']; ?>" <?php if($expences[0]['boutique_billing_head_id'] == $expencecategory[$i]['b_boutique_vendor_id']){ echo 'selected="selected"';}?>>
                    <?php echo $expencecategory[$i]['b_boutique_vendor_name']; ?>
                    </option>
                  <?php } ?>
                  </select>
                </div>
            </div>
          </div>
          
          <div class="col-md-12">
            <div class="form-group">
              <label>Date Of Arrival</label>
              <input name="date_of_arrival" type="text" class="form-control" value="<?php echo $expences[0]['credit_date_of_arrival'];?>">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Last date of Payment</label>
              <input name="last_date_payment" type="text" class="form-control" value="<?php echo $expences[0]['credit_last_date_payment'];?>">
            </div>
          </div>


          <div class="purchase_orders">

          <div class="col-md-2">
            <div class="form-group">
            <label>Name</label>
             </div>
          </div>
          <div class="col-md-1">
            <div class="form-group">
               <label>HSN</label>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
            <label>Unit Price</label>
            </div>
          </div> 
          <div class="col-md-1">
            <div class="form-group">
            <label>CGST</label>
            </div>
          </div>
          <div class="col-md-1">
            <div class="form-group">
            <label>SGST</label>
            </div>
          </div>
          <div class="col-md-1">
            <div class="form-group">
             <label>IGST</label>
            </div>
          </div> 
          <div class="col-md-1">
            <div class="form-group">
            <label>Quantity</label>
           </div>
          </div> 
          <div class="col-md-2">
            <div class="form-group">
                    <label>Amount</label>
            </div>
          </div> 
          <div class="col-md-1">
            <div class="form-group">
              <button type="button" id="add_purchase">+</button>
            </div>
          </div>


          </div>

<?php
foreach($crdeititemslist as $credit)
{
  $rand_var = md5(rand());
?>
               <!-- <div class="purchase_orders"><div class="col-md-1"><div class="form-group"><input type="text" class="form-control" name="boutique_work_purchase_item_name[]" value="<?php echo $purchase['boutique_work_purchase_item_name'];?>"></div></div><div class="col-md-1"><div class="form-group"><input type="text" class="form-control" name="boutique_work_purchase_item_name[]" value="<?php echo $purchase['boutique_work_purchase_item_name'];?>"></div></div><div class="col-md-1"><div class="form-group"><input type="text" class="form-control" name="boutique_work_purchase_item_name[]" value="<?php echo $purchase['boutique_work_purchase_item_name'];?>"></div></div><div class="col-md-2"><div class="form-group"><input type="text" class="form-control" name="boutique_work_purchase_item_name[]" value="<?php echo $purchase['boutique_work_purchase_item_name'];?>"></div></div><div class="col-md-2"><div class="form-group"><input type="text" class="form-control" name="boutique_work_purchase_item_name[]" value="<?php echo $purchase['boutique_work_purchase_item_name'];?>"></div></div><div class="col-md-2"><div class="form-group"><input type="text" class="form-control" name="boutique_work_purchase_item_name[]" value="<?php echo $purchase['boutique_work_purchase_item_name'];?>"></div></div><div class="col-md-1"><div class="form-group"><input type="text" class="form-control" name="boutique_work_purchase_item_name[]" value="<?php echo $purchase['boutique_work_purchase_item_name'];?>"></div></div><div class="col-md-1"><div class="form-group"><input type="text" class="form-control" name="boutique_work_purchase_item_name[]" value="<?php echo $purchase['boutique_work_purchase_item_name'];?>"></div></div><div class="col-md-1"><div class="form-group"><a class="delete_purchase" href="javascript:void(0);" title="Remove row">X</a></div></div></div> -->
               <div class="purchase_orders"><div class="col-md-2"><div class="form-group"><input type="text" class="form-control" name="builders_credit_item_name[]" value="<?php echo $credit["builders_credit_item_name"]; ?>"></div></div><div class="col-md-1"><div class="form-group"><input type="text" class="form-control" name="builders_credit_item_hsn_code[]" value="<?php echo $credit["builders_credit_item_hsn_code"]; ?>"></div></div><div class="col-md-2"><div class="form-group"><input type="text" class="form-control" id="price<?php echo $rand_var; ?>" onkeyup="creditupdate('<?php echo $rand_var; ?>')" name="builders_credit_item_price[]" value="<?php echo $credit["builders_credit_item_price"]; ?>"></div></div><div class="col-md-1"><div class="form-group"><select name="cgst[]" class="form-control"  onchange="creditupdatecgst('<?php echo $rand_var; ?>')" id="cgst<?php echo $rand_var; ?>" ><option value="0"<?php  if($credit["builders_credit_item_gst_per"] == 0){ echo "selected"; }?>>No Tax</option><option value="2.5"<?php  if($credit["builders_credit_item_gst_per"] == 2.5){ echo "selected"; }?>>2.5 %</option><option value="6" <?php  if($credit["builders_credit_item_gst_per"] == 6){ echo "selected"; }?>>6 %</option><option value="9"<?php  if($credit["builders_credit_item_gst_per"] == 9){ echo "selected"; }?>>9 %</option><option value="14"<?php  if($credit["builders_credit_item_gst_per"] == 14){ echo "selected"; }?>>14 %</option></select><input type="hidden" value="<?php echo ($credit["builders_credit_item_gst_per"]/100)*$credit["builders_credit_item_price"]; ?>" id="cgstamount<?php echo $rand_var; ?>"  class="form-control cgstamnteach"></div></div><div class="col-md-1"><div class="form-group"><select name="sgst[]" class="form-control" id="sgst<?php echo $rand_var; ?>" onchange="creditupdatesgst('<?php echo $rand_var; ?>')" ><option value="0"<?php  if($credit["builders_credit_item_sgst_per"] == 0){ echo "selected"; }?>>No Tax</option><option value="2.5"<?php  if($credit["builders_credit_item_sgst_per"] == 2.5){ echo "selected"; }?>>2.5 %</option><option value="6"<?php  if($credit["builders_credit_item_sgst_per"] == 6){ echo "selected"; }?>>6 %</option><option value="9"<?php  if($credit["builders_credit_item_sgst_per"] == 9){ echo "selected"; }?>>9 %</option><option value="14"<?php  if($credit["builders_credit_item_sgst_per"] == 14){ echo "selected"; }?>>14 %</option></select><input type="hidden" id="sgstamount<?php echo $rand_var; ?>" class="form-control sgstamnteach" value="<?php echo ($credit["builders_credit_item_sgst_per"]/100)*$credit["builders_credit_item_price"]; ?>"></div></div><div class="col-md-1"><div class="form-group"><select name="igst[]" class="form-control" id="igst<?php echo $rand_var; ?>" onchange="creditupdateigst('<?php echo $rand_var; ?>')" ><option value="0"<?php  if($credit["builders_credit_item_igst_per"] == 0){ echo "selected"; }?>>No Tax</option><option value="5"<?php  if($credit["builders_credit_item_igst_per"] == 5){ echo "selected"; }?>>5 %</option><option value="12"<?php  if($credit["builders_credit_item_igst_per"] == 12){ echo "selected"; }?>>12 %</option><option value="18"<?php  if($credit["builders_credit_item_igst_per"] == 18){ echo "selected"; }?>>18 %</option><option value="28" <?php  if($credit["builders_credit_item_igst_per"] == 28){ echo "selected"; }?>>28 %</option></select><input type="hidden" id="igstamount<?php echo $rand_var; ?>" class="form-contro igstamnteach" value="<?php echo ($credit["builders_credit_item_igst_per"]/100)*$credit["builders_credit_item_price"]; ?>"></div></div><div class="col-md-1"><div class="form-group"><input type="text" class="form-control" name="builders_credit_item_quantity[]" id="quantity<?php echo $rand_var; ?>" onkeyup="creditupdate('<?php echo $rand_var; ?>')"  value="<?php echo $credit["builders_credit_item_quantity"]; ?>"></div></div><div class="col-md-2"><div class="form-group"><input type="text" class="form-control totalamnt" name="builders_credit_item_Amount[]" value="<?php echo $credit["builders_credit_item_Amount"]; ?>" id="totalamount<?php echo $rand_var; ?>"></div></div><div class="col-md-1"><div class="form-group"><a class="delete_purchase" href="javascript:void(0);" title="Remove row">X</a></div></div></div>

<?php
}
?>

          

          <?php
            $total = count($crdeititemslist);
            for($i = 0; $i < $total; $i++) { ?>
          <!-- <tbody>
          <tr>
                        <td>Item Name</td>
                        <td>Hsn Code</td>
                        <td>Unit Price</td>
                        <td>CGST</td>
                        <td>SGST</td> -->
                        <!-- <th>Gst Mode</th> -->
                        <!-- <td>Quantity</td>
                        <td>Amount</td>
                      </tr>
          
          </tbody> -->
          <!-- foreach($crdeititemslist as $credititems)  {?> -->
            <!-- <div class="col-md-1">
            <div class="form-group">
              <input id="credit_item_name<?php echo $i; ?>" name="credit_item_name<?php echo $i; ?>" type="text" class="form-control" value="<?php echo $crdeititemslist[$i]["builders_credit_item_name"]; ?>"readonly>
            </div>
          </div>
          <div class="col-md-1">
            <div class="form-group">
              <input id="item_hsn_code<?php echo $i; ?>" name="item_hsn_code<?php echo $i; ?>" type="text" class="form-control" value="<?php echo $crdeititemslist[$i]["builders_credit_item_hsn_code"]; ?>"readonly>
            </div>
          </div>
          <div class="col-md-1">
            <div class="form-group">
              <input id="item_price<?php echo $i; ?>" name="item_price<?php echo $i; ?>" type="text" class="form-control" value="<?php echo $crdeititemslist[$i]["builders_credit_item_price"]; ?>"readonly>
            </div>
          </div> 
          <div class="col-md-2">
            <div class="form-group">
              <select id="item_gst_per<?php echo $i; ?>" name="item_gst_per<?php echo $i; ?>" class="form-control" readonly>
                        <option value="0"<?php  if($crdeititemslist[$i]["builders_credit_item_gst_per"] == 0){ echo "selected"; }?>>No Tax</option>
                        <option value="2.5"<?php  if($crdeititemslist[$i]["builders_credit_item_gst_per"] == 2.5){ echo "selected"; }?>>2.5 %</option>
                        <option value="6"<?php  if($crdeititemslist[$i]["builders_credit_item_gst_per"] == 6){ echo "selected"; }?>>6 %</option>
                        <option value="9"<?php  if($crdeititemslist[$i]["builders_credit_item_gst_per"] == 9){ echo "selected"; }?>>9 %</option>
                        <option value="14"<?php  if($crdeititemslist[$i]["builders_credit_item_gst_per"] == 14){ echo "selected"; }?>>14 %</option>
              </select>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <select id="item_sgst_per<?php echo $i; ?>" name="item_sgst_per<?php echo $i; ?>" class="form-control" readonly>
                        <option value="0"<?php  if($crdeititemslist[$i]["builders_credit_item_sgst_per"] == 0){ echo "selected"; }?>>No Tax</option>
                        <option value="2.5"<?php  if($crdeititemslist[$i]["builders_credit_item_sgst_per"] == 2.5){ echo "selected"; }?>>2.5 %</option>
                        <option value="6"<?php  if($crdeititemslist[$i]["builders_credit_item_sgst_per"] == 6){ echo "selected"; }?>>6 %</option>
                        <option value="9"<?php  if($crdeititemslist[$i]["builders_credit_item_sgst_per"] == 9){ echo "selected"; }?>>9 %</option>
                        <option value="14"<?php  if($crdeititemslist[$i]["builders_credit_item_sgst_per"] == 14){ echo "selected"; }?>>14 %</option>
              </select>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <select id="item_igst_per<?php echo $i; ?>" name="item_igst_per<?php echo $i; ?>" class="form-control" readonly>
                          <option value="0"<?php  if($crdeititemslist[$i]["builders_credit_item_igst_per"] == 0){ echo "selected"; }?>>No Tax</option>
                          <option value="5"<?php  if($crdeititemslist[$i]["builders_credit_item_igst_per"] == 5){ echo "selected"; }?>>5 %</option>
                          <option value="12"<?php  if($crdeititemslist[$i]["builders_credit_item_igst_per"] == 12){ echo "selected"; }?>>12 %</option>
                          <option value="18"<?php  if($crdeititemslist[$i]["builders_credit_item_igst_per"] == 18){ echo "selected"; }?>>18 %</option>
                          <option value="28"<?php  if($crdeititemslist[$i]["builders_credit_item_igst_per"] == 28){ echo "selected"; }?>>28 %</option>
             </select>
            </div>
          </div> 
          <div class="col-md-1">
            <div class="form-group">
              <input id="item_price<?php echo $i; ?>" name="item_price<?php echo $i; ?>" type="text" class="form-control" value="<?php echo $crdeititemslist[$i]["builders_credit_item_quantity"]; ?>" readonly>
            </div>
          </div> 
          <div class="col-md-2">
            <div class="form-group">
              <input id="item_price<?php echo $i; ?>" name="item_price<?php echo $i; ?>" type="text" class="form-control" value="<?php echo $crdeititemslist[$i]["builders_credit_item_Amount"]; ?>" readonly>
            </div>
          </div>         -->
          <?php } ?>

          <div class="col-md-3">
            <div class="form-group">
              <label>TOTAL SGST</label>
              <input id="totalsgst" name="totalsgst" type="text" class="form-control" value="<?php echo $expences[0]['credit_item_total_sgst'];?>"readonly>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>TOTAL CGST</label>
              <input id="totalcgst" name="totalcgst" type="text" class="form-control" value="<?php echo $expences[0]['credit_item_total_cgst'];?>"readonly>
            </div>
          </div><div class="col-md-3">
            <div class="form-group">
              <label>TOTAL IGST</label>
              <input id="totaligst" name="totaligst" type="text" class="form-control" value="<?php echo $expences[0]['credit_item_total_igst'];?>"readonly>
            </div>
          </div><div class="col-md-3">
            <div class="form-group">
              <label>TOTAL GST</label>
              <input id="totalgst" name="totalgst" type="text" class="form-control" value="<?php echo $expences[0]['credit_item_total_total_gst'];?>"readonly>
            </div>
          </div>

          


          <div class="col-md-12">
            <div class="form-group">
              <label>Amount</label>
              <input name="boutique_expense_amount" id="finalamount" type="text" class="form-control" value="<?php echo $expences[0]['boutique_expense_amount'];?>"readonly>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Creadit Item Description</label>
              <textarea name="boutique_expense_details" class="form-control" rows="3"><?php echo $expences[0]['boutique_expense_details'];?></textarea>
            </div>
          </div>


        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Update</button>
        <input name="boutique_expense_id" type="hidden" class="form-control pull-right" value="<?php echo $expences[0]['boutique_expense_id'];?>">
      </div>
    </form>
  </div>


  <div class="box box-info">
            <!-- <div class="box-header with-border">
              <h3 class="box-title">Credit Item List</h3>

              <div class="box-tools pull-right">
              </div>
            </div> -->
            <!-- /.box-header -->
            <div class="box-body">
              <br><br>
              <div class="table-responsive">
                <table id="customerdetailsTable-history" class="table table-bordered table-striped">
                      <thead>
                      <!-- <tr>
                           <th>Item Name</th>
                        <th>Hsn Code</th> -->
                        <!-- <th>No of items</th> -->
                        <!-- <th>Item Price</th>
                        <th>Gst %</th>
                        <th>Gst Mode</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                      </tr> -->
                      </thead>
                      <tbody>
                   <?php foreach($crdeititemslist as $credititems) {?>
                        <!-- <tr>
                          <td> <?php echo $credititems["builders_credit_item_name"]; ?> </td>
                           <td> <?php echo $credititems["builders_credit_item_hsn_code"]; ?> </td>
                           <td> <?php echo $credititems["builders_credit_item_price"]; ?> </td>
                           <td> <?php echo $credititems["builders_credit_item_gst_per"]; ?> </td>
                           <td> <?php if ($credititems["builders_credit_item_gst_mode"]==0){ echo "NO Gst"; }elseif($credititems["builders_credit_item_gst_mode"]==1){ echo "CGST & SGST";} else{ echo "IGST"; }; ?> </td>
                           <td> <?php echo $credititems["builders_credit_item_quantity"]; ?> </td>
                           <td> <?php echo $credititems["builders_credit_item_Amount"]; ?> </td>
                        </tr> -->
                   <?php }  ?>
                      </tbody>
                    </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <!-- /.box-footer -->
          </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<script>

</script>