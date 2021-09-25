<?php 
$stat = $this->session->userdata('filter');
if($stat == "rejected"):
  $backlink = base_url()."boutique/customer";
elseif($stat == "new"):
  $backlink = base_url()."boutique/customer";
elseif($stat == "active"):
  $backlink = base_url()."boutique/customer";
else:
  $backlink = base_url()."boutique/customer";
endif;
 ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit
      <small>Tenant</small>
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
    <form id="addcustomer" method="post" action="<?php echo base_url(); ?>Boutique/updatecustomer/<?php echo @$customer['boutique_customer_id']; ?>" enctype="multipart/form-data">
      <div class="box-header with-border">
        <h3 class="box-title">Tenant  Details</h3>
        <span class="pull-right"><a class="btn btn-info" href="<?php echo @$backlink; ?>">

        Back</a></span>
      </div>
      <div class="box-body">
        <div class="row">

          <div class="col-md-12">
            <div class="form-group">
              <label>Name</label>
              <input name="name" type="text" class="form-control" value="<?php echo @$customer['boutique_customer_name']; ?>" style="text-transform: capitalize;">
            </div>
          </div>
          <?php if($this->session->userdata('UserID') ==136) {?>
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
                    <option value="<?php echo $properties[$i]['boutique_property_id']; ?>" <?php if(@$customer['boutique_property']==$properties[$i]['boutique_property_id']) {echo "selected";}?>>
                    <?php echo $properties[$i]['boutique_property_name']; ?>
                    </option>
                  <?php } ?>
                  </select>
                </div>
            </div>
          </div>
            <?php } ?>
          <!--
          <div class="col-md-12">
            <div class="form-group">
              <label>Email</label>
              <div class="input-group">
                <span class="input-group-addon"><span class="fa-envelope fa"></span></span>
                <input type="text" name="email" class="form-control" value="<?php //echo @$customer['boutique_customer_email']; ?>">
              </div>
            </div>
          </div>
        -->
          <div class="col-md-12">
            <div class="form-group">
              <label>Phone</label>
              <div class="input-group">
                <span class="input-group-addon"><span class="fa-phone fa"></span></span>
                <input name="phone" type="text" class="form-control" value="<?php echo @$customer['boutique_customer_ph']; ?>">
              </div>
            </div>
          </div>
         
          <div class="col-md-12">
            <div class="form-group">
            <label>Address (use " , " for separate sentence)</label>
              <input name="address"  type="text" class="form-control" id="addresstag" value="<?php echo @$customer['boutique_customer_address']; ?>">
            </div>
          </div>

<!-- gst 136 OPENING-->
<?php if($this->session->userdata('UserID') ==136) {?>
          <div class="col-md-12">
            <div class="form-group row">
              <div class="col-md-3">
              <label>No GST</label><br>
              <input type="radio"  name="gst_status" value="0" <?php if($customer['boutique_gst_status']==0){echo "checked";}?>>
              </div>
              <div class="col-md-3">
              <label>GST 18 %</label><br>
              <input type="radio"  name="gst_status" value="2" <?php if($customer['boutique_gst_status']==2){echo "checked";}?>>
              </div>
              <div class="col-md-3">
              <label>GST 19 %</label><br>
              <input type="radio"  name="gst_status" value="1" <?php if($customer['boutique_gst_status']==1){echo "checked";}?>>  
              </div>     
            </div>
          </div>
          <?php }else{ ?>
            <div class="col-md-12">
            <div class="form-group row">
              <div class="col-md-6">
              <label>Enable GST</label><br>
              <input type="checkbox"  name="gst_status" value="1" <?php if(@$customer['boutique_gst_status']){echo "checked";} ?> > 
              </div>
              <div class="col-md-6">
             
              </div>
        
            </div>
          </div>

          <?php } ?>

<!-- GST CLOSING-->

          <div class="col-md-12">
            <div class="form-group row">
              <div class="col-md-2">
              <label>Rent Type</label><br>
              Monthly &nbsp;<input type="radio"  name="rent_type"  value="monthly" <?php if(@$customer['boutique_monthly_or_daily']=="monthly"){echo "checked";} ?> required>&nbsp;&nbsp;
              Daily&nbsp;<input type="radio"  name="rent_type"  value="daily" <?php if(@$customer['boutique_monthly_or_daily']=="daily"){echo "checked";} ?> required>
              </div>
              <div class="col-md-4" id="monthly_date">
              <label>Monthy Rent Date</label><br>
              <input name="monthly_date" type="text" class="form-control" value="<?php echo @$customer['boutique_monthy_rent_date']; ?>"  id="monthly_date_pick">
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Rent Amount</label>
              <div class="input-group">
                <span class="input-group-addon"><span class="fa-inr fa"></span></span>
                <input name="price" type="text" class="form-control" value="<?php echo @$customer['tenants_room_rent']; ?>">
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Period</label>
              <div class="input-group">
                <span class="input-group-addon"></span>
                <?php if(@$customer['rent_period']==1)
                {
                  ?>
                <select name="period"  class="form-control">
                  <option value="1" selected>11 Months</option>
                  <option value="2">3 Year</option>
                  </select>
            <?php }elseif(@$customer['rent_period']==2) { ?>
              <select name="period" class="form-control">
                  <option value="1">11 Months</option>
                  <option value="2" selected>3 Year</option>
                  </select>
        
            <?php }else{  ?>
              <select name="period"  class="form-control">
                  <option value="1" selected>11 Months</option>
                  <option value="2">3 Year</option>
                  </select>
         
<?php } ?>


                  </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>date</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>	
                <input name="rent_from_date" type="text" value="<?php echo @$customer['nxt_tenant_roomrent_date']; ?>" class="form-control pull-right" id="datepicker1">
              </div>
            </div>
          </div>
         
          <div class="col-md-12">
          <h4 class="box-title">Upload Document</h4>
            <div class="form-group row" style="border-style: solid;border-width: thin; margin-left: 0px;margin-right: 0px;">
              <div class="col-md-6">
              <label>Document Name 1</label>
           <input type="text"  name="document_name1" class="form-control"  value="<?php echo  @$customer['boutique_doc1_name']; ?>">
              </div>
              <div class="col-md-6">
              <label>Select File</label>
              <input name="document_file1" type="file"  class="form-control" accept="image/*,.pdf"><br>
              <input name="document_file1_old" type="hidden"  value="<?php echo  @$customer['boutique_doc1_file']; ?>" class="form-control" >
               <?php if(!empty(@$customer['boutique_doc1_file'])){ $path="./uploads/documents/".@$customer['boutique_doc1_file']; if(file_exists($path)){ ?>
              <a class="btn btn-primary btn-sm" href="<?php echo base_url();?>uploads/documents/<?php echo  @$customer['boutique_doc1_file']; ?>" target="_blank">Preview</a>
              <br><img src="<?php echo base_url();?>uploads/documents/<?php echo  @$customer['boutique_doc1_file']; ?>" class="preview">
              <?php  }else{echo "<font color='red'>file not found</font>";} }else{ echo "<font color='red'>file not found</font>";} ?>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group row" style="border-style: solid;border-width: thin;margin-left: 0px;margin-right: 0px;">
              <div class="col-md-6">
              <label>Document Name 2</label>
           <input type="text"  name="document_name2" class="form-control"  value="<?php echo  @$customer['boutique_doc2_name']; ?>">
              </div>
              <div class="col-md-6">
              <label>Select File</label>
              <input name="document_file2" type="file" class="form-control" accept="image/*,.pdf">
              <input name="document_file2_old" type="hidden"  value="<?php echo  @$customer['boutique_doc2_file']; ?>" class="form-control" >
              <br>
              <?php  if(!empty(@$customer['boutique_doc2_file'])){ $path="./uploads/documents/".@$customer['boutique_doc2_file']; if(file_exists($path)){ ?>
              <a class="btn btn-primary btn-sm" href="<?php echo base_url();?>uploads/documents/<?php echo  @$customer['boutique_doc2_file']; ?>" target="_blank">Preview</a>
            <br><img src="<?php echo base_url();?>uploads/documents/<?php echo  @$customer['boutique_doc2_file']; ?>" class="preview">
              <?php }else{echo "<font color='red'>file not found</font>";}}else{ echo "<font color='red'>file not found</font>";}  ?>
             
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group row" style="border-style: solid;border-width: thin;margin-left: 0px;margin-right: 0px;">
              <div class="col-md-6">
              <label>Document Name 3</label>
           <input type="text"  name="document_name3" class="form-control"  value="<?php echo  @$customer['boutique_doc3_name']; ?>">
              </div>
              <div class="col-md-6">
              <label>Select File</label>
              <input name="document_file3" type="file" class="form-control" accept="image/*,.pdf">
              <input name="document_file3_old" type="hidden"  value="<?php echo  @$customer['boutique_doc3_file']; ?>" class="form-control" >
              <br>
               <?php if(!empty(@$customer['boutique_doc3_file'])){ $path="./uploads/documents/".@$customer['boutique_doc3_file']; if(file_exists($path)){ ?>
              <a class="btn btn-primary btn-sm" href="<?php echo base_url();?>uploads/documents/<?php echo  @$customer['boutique_doc3_file']; ?>" target="_blank">Preview</a>
              <br><img src="<?php echo base_url();?>uploads/documents/<?php echo  @$customer['boutique_doc3_file']; ?>" class="preview">
              <?php }else{echo "<font color='red'>file not found</font>";} }else{ echo "<font color='red'>file not found</font>";} ?>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group row" style="border-style: solid;border-width: thin;margin-left: 0px;margin-right: 0px;">
              <div class="col-md-6">
              <label>Document Name 4</label>
           <input type="text"  name="document_name4" class="form-control" value="<?php echo  @$customer['boutique_doc4_name']; ?>">
              </div>
              <div class="col-md-6">
              <label>Select File</label>
              <input name="document_file4" type="file" class="form-control" accept="image/*,.pdf">
              <input name="document_file4_old" type="hidden"  value="<?php echo  @$customer['boutique_doc4_file']; ?>" class="form-control" >
              <br>
                <?php if(!empty(@$customer['boutique_doc4_file'])){ $path="./uploads/documents/".@$customer['boutique_doc4_file']; if(file_exists($path)){ ?>
              <a class="btn btn-primary btn-sm" href="<?php echo base_url();?>uploads/documents/<?php echo  @$customer['boutique_doc4_file']; ?>" target="_blank">Preview</a>
              <br><img src="<?php echo base_url();?>uploads/documents/<?php echo  @$customer['boutique_doc4_file']; ?>" class="preview">
              <?php }else{echo "<font color='red'>file not found</font>";}}else{ echo "<font color='red'>file not found</font>";}  ?>
              </div>
            </div>
          </div>
          <?php if($stitchstatus == 1){?>
         
          <!-- <div class="col-md-12">
            <div class="form-group">
              <label>Preview Measurements</label>
                            <a href="<?php echo base_url(); ?>boutique/customerMeasurements/<?php echo $customer['boutique_customer_id'];?>" target="_blank"><span class="label label-success">Measurements</span></a> 
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Update Measurements</label>
                          <td>
                            <a href="<?php echo base_url(); ?>boutique/measurements/<?php echo $customer['boutique_customer_id'];?>/1/" target="_blank"><span class="label label-success">Measurements</span></a> 
            </div>
          </div> -->

<?php } ?>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Update</button>

      </div>
    </form>
  </div>

<?php if($stitchstatus == 1){?>
<!-- TABLE: LATEST ORDERS -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Tenant Orders</h3>

              <div class="box-tools pull-right">
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              Total Orders : <?php echo count($works);?> &nbsp;&nbsp; Total Amount : <?php echo array_sum(array_map(function($item) { 
    return $item['boutique_order_grandtotal']; 
}, $works));?> &nbsp;&nbsp;Amount Paid : <?php echo array_sum(array_map(function($item) { 
    return $item['boutique_order_amtpaid']; 
}, $works));?> &nbsp;&nbsp;
              <br><br>
              <div class="table-responsive">
                <table id="customerdetailsTable" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>Order Number</th>
                        <!-- <th>No of items</th> -->
                        <th>Grand Total</th>
                        <th>Amount Paid</th>
                        <th>Due Date</th>
                        <!-- <th>Delivery Date</th> -->
                        <th>Payment Status</th>
                        <!-- <th>Order Status</th> -->
                      </tr>
                      </thead>
                      <tbody>
                      <?php 
                      $total = count($works);
                      for($i = 0; $i < $total; $i++){
                        ?>
                        <tr>
                          <td><a href="<?php echo base_url(); ?>boutique/works/<?php echo $works[$i]["boutique_order_id"]; ?>"><?php echo $works[$i]["boutique_order_number"]; ?></a> </td>
                          <!-- <td><?php echo $works[$i]["boutique_order_no_items"]; ?></td> -->

                          <!-- <td> <?php //echo $this->Work_model->m_getcustomername($works[$i]["boutique_customer_id"])["boutique_customer_name"];
                          ?> </td>-->

                          <td> <?php echo $works[$i]["boutique_order_grandtotal"]; ?> </td>
                           <td> <?php echo $works[$i]["boutique_order_amtpaid"]; ?> </td>
                          <td> <?php echo $works[$i]["boutique_due_date"]; ?> </td>
                          <!-- <td> <?php echo $works[$i]["boutique_order_delivery_date"]; ?> </td> -->
                         
                         <?php if($works[$i]['boutique_order_payment_status'] == 1){?>
                          <td><span class="label label-danger">Not Paid</span></td>
                          <?php } ?>
                          <?php if($works[$i]['boutique_order_payment_status'] == 2){?>
                          <td><span class="label label-warning">Partial Paid</span></td>
                          <?php } ?>
                          <?php if($works[$i]['boutique_order_payment_status'] == 3){?>
                          <td><span class="label label-success">Paid</span></td>
                          <?php } ?>

                          <!-- <?php if($works[$i]['boutique_order_status'] == 1){?>
                          <td><span class="label label-warning">Pending</span></td>
                          <?php } ?>
                          <?php if($works[$i]['boutique_order_status'] == 2){?>
                          <td><span class="label label-info">Processing</span></td>
                          <?php } ?>
                          <?php if($works[$i]['boutique_order_status'] == 3){?>
                          <td><span class="label label-success">Completed</span></td>
                          <?php } ?>
                          <?php if($works[$i]['boutique_work_status'] == 4){?>
                          <td><span class="label label-success">Delivered</span></td>
                          <?php } ?> -->
                        </tr>
                        <?php
                      }
                       ?>
                      </tbody>
                    </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
<?php } ?>

<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Tenant Payment History</h3>

              <div class="box-tools pull-right">
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             &nbsp;&nbsp; Total Amount Paid: <?php echo array_sum(array_map(function($payment) { 
    return $payment['boutique_order_paymentamt']; 
}, $payment_history));?>
              <br><br>
              <div class="table-responsive">
                <table id="customerdetailsTable-history" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                           <th>Order Number</th>
                        <th>Paid Amount</th>
                        <!-- <th>No of items</th> -->
                        <th>Description</th>
                        <th>Paid Date</th>
                      </tr>
                      </thead>
                      <tbody>
                   <?php  foreach($payment_history as $payment) {?>
                        <tr>
                            <td> <a href="<?php echo base_url(); ?>boutique/works/<?php echo $payment["boutique_order_id"]; ?>"><?php $cusobj=new Customer_model(); echo $cusobj->get_order_number($payment["boutique_order_id"]); ?></a> </td>
                          <td> <?php echo $payment["boutique_order_paymentamt"]; ?> </td>
                           <td> <?php echo $payment["boutique_order_paymentdesc"]; ?> </td>
                           <td> <?php echo $payment["boutique_order_paid_date"]; ?> </td>
                        </tr>
                   <?php }  ?>
                      </tbody>
                    </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <!-- /.box-footer -->
          </div>
  </section>



  <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<script>

</script>