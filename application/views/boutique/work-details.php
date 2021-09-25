<?php 
$stat = $this->session->userdata('filter');

if($stat == "rejected"):
  $backlink = base_url()."boutique/works";
elseif($stat == "new"):
  $backlink = base_url()."boutique/works";
elseif($stat == "active"):
  $backlink = base_url()."boutique/works";
else:
  $backlink = base_url()."boutique/works/".@$work['boutique_order_id'];
endif;
 ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit
      <small>Rent</small>
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
    <form id="workvaliedit" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>boutique/updatework/<?php echo @$work['boutique_work_id']; ?>">
      <div class="box-header with-border">
        <h3 class="box-title">Rent Details</h3>
        <span class="pull-right"><a class="btn btn-info" href="<?php echo @$backlink; ?>">
        Back</a></span>
      </div>
      <div class="box-body">
        <div class="row">
          <!-- <div class="col-md-12">
            <div class="form-group">
              <label>Cloth/Work Name</label>
              <input name="workname" type="text" class="form-control" value="<?php echo @$work['boutique_work_name']; ?>" style="text-transform: capitalize;">
            </div>
          </div> -->
          <div class="col-md-12">
            <div class="form-group">
              <label>Customer</label>
              <div class="input-group">
                <span class="input-group-addon"><span class="fa-user fa"></span></span>
                <select name="customerid" class="form-control">
                <?php
                for($i=0; $i<count($customers);$i++) {
                 ?>
                  <option <?php if($work['boutique_customer_id'] == $customers[$i]['boutique_customer_id']) { ?> selected="selected" <?php } ?>
                   value="<?php echo $customers[$i]['boutique_customer_id'];  ?> ">
                  <?php echo $customers[$i]['boutique_customer_name']; ?>
                  </option>
                <?php } ?>
                </select>
              </div>
            </div>
          </div>
          
          <div class="col-md-12">
            <div class="form-group">
              <label>Receipt Number</label>
              <div class="input-group">
                <div class="input-group-addon">
                  
                </div>
<input name="boutique_order_form_number" type="text" class="form-control pull-right" value="<?php echo @$work['boutique_order_form_number']; ?>">
              </div>
            </div>
          </div>
          
          <!-- <div class="col-md-12">
            <div class="form-group">
                <label>Select Tailor</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="fa-user fa"></span></span>
                  <select name="tailorid" class="form-control">
                  <?php
                  for($i=0; $i<count($tailors);$i++) {
                   ?>
                    <option <?php if($work['boutique_tailor_id'] == $tailors[$i]['boutique_tailor_id']) { ?> selected="selected" <?php } ?> value="<?php echo $tailors[$i]['boutique_tailor_id']; ?>">
                    <?php echo $tailors[$i]['boutique_tailor_username']; ?>
                    </option>
                  <?php } ?>
                  </select>
                </div>
            </div>
          </div> -->
      
          
          
          
          <div class="col-md-12">
            <div class="form-group">
              <label>Rent Amount</label>
              <div class="input-group">
                <span class="input-group-addon"><span class="fa-inr fa"></span></span>
                <input name="price" type="text" class="form-control" value="<?php echo @$work['price_without_gst']; ?>">
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>TDS</label>
              <div class="input-group">
                <span class="input-group-addon"><span class="fa-inr fa"></span></span>
                <input name="price_tdf" type="text" class="form-control" value="<?php echo @$work['b_boutique_orders_tdf']; ?>">
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Discount</label>
              <div class="input-group">
                <span class="input-group-addon"><span class="fa-inr fa"></span></span>
                <input name="discount" type="text" class="form-control" value="<?php echo @$work['rent_discount']; ?>">
              </div>
            </div>
          </div>
          
          <div class="col-md-12">
            <div class="form-group">
              <label>Rent From</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input name="rent_from_date" type="text" value="<?php echo @$work['rent_from_date']; ?>" class="form-control pull-right" id="datepicker1">
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>For the Month :</label>
              <div class="input-group date"">
                <span class="input-group-addon"><span class="fa-inr fa"></span></span>
                <input name="month_name" type="text" class="form-control" value="<?php echo @$work['rent_month']; ?>">
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Rent To</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input name="rent_to_date" value="<?php echo @$work['rent_to_date']; ?>" type="text" class="form-control pull-right" id="datepicker2">
              </div>
            </div>
          </div>
       


          <div class="col-md-12">
            <div class="form-group">
              <label>Due date</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input name="due_date" type="text" value="<?php echo @$work['boutique_work_due_date']; ?>" class="form-control pull-right" id="datepicker1">
              </div>
            </div>
          </div>
          <!-- <div class="col-md-12">
            <div class="form-group">
              <label>Order Date</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input name="order_date" type="text" class="form-control pull-right" value="<?php echo @$work['boutique_work_order_date']; ?>" id="datepicker4">
              </div>
            </div>
          </div> -->
          <!-- <div class="col-md-12">
            <div class="form-group">
              <label>Delivery Date</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input name="delivery_date" value="<?php echo @$work['boutique_work_delivery_date']; ?>" type="text" class="form-control pull-right" id="datepicker1">
              </div>
            </div>
          </div> -->
         
          <div class="col-md-12">
            <div class="form-group">
              <label>Comments</label>
              <textarea name="comments" class="form-control" rows="3"><?php echo @$work['boutique_work_material_desc']; ?></textarea>
            </div>
          </div>

          


           <!-- <div class="col-md-12">
              <div class="form-group">
                <label>Photo Of Cloth</label>
                <input type="file" id="clothimg" name="clothimg" class="form-control">
                <img height="150" src="<?php echo base_url().'uploads/work/'.$work['boutique_work_image']; ?>" id="clothimgprev" <?php if(!$work['boutique_work_image']){?> style="display: none;" <?php } ?>>
              </div>
           </div> -->

           <!-- <div class="col-md-12">
            <div class="form-group">
                <label>Status</label>
                  <select multiple class="form-control" name="boutique_work_status">
                      <option value="1" <?php if($work['boutique_work_status'] == 1){ echo "selected='selected'"; } ?>>Started</option>
                      <option value="2" <?php if($work['boutique_work_status'] == 2){ echo "selected='selected'"; } ?>>Processing</option>
                      <option value="3" <?php if($work['boutique_work_status'] == 3){ echo "selected='selected'"; } ?>>Completed</option>
                       <?php if( $this->session->userdata('BoutiqueID') == 15){
                       ?>
                      <option value="4" <?php if($work['boutique_work_status'] == 4){ echo "selected='selected'"; } ?>>Delivered</option>
                      <?php 
                       }
                       ?>
                  </select>
            </div>
          </div> -->
<!-- 
         
          <div class="col-md-12">
            <div class="form-group">
              <label>Measurements</label>
              <div class="radio">
                <label><input type="radio" name="measurement_type" value="1" <?php if($work['boutique_measurement_type'] == 1){ echo "checked"; } ?>>Measurements - <a href="<?php echo base_url(); ?>boutique/measurements/<?php echo $work['boutique_customer_id'];?>/1" target="_blank">Add measurement</a></label>
              </div>
            </div>
          </div> -->


        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <input type="hidden" name="boutique_order_id" value="<?php echo @$work['boutique_order_id']; ?>">
        <input type="hidden" name="amt_paid" value="<?php echo @$work['boutique_order_amtpaid']; ?>">
        
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>

    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<script>

</script>