<?php 
if($orderid):
  $backlink = base_url()."boutique/works/".$orderid;
else:
  $backlink = base_url()."boutique/orders/";
endif;
 ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Add
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
    <form enctype="multipart/form-data" id="workvali" method="post" action="<?php echo base_url(); ?>boutique/savework/">
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
              <input name="workname" type="text" class="form-control" value="<?php echo @$teamdetail->TeamName; ?>" style="text-transform: capitalize;">
            </div>
          </div> -->
          <div class="col-md-12">
            <div class="form-group">
              <label>Customer</label>
              <div class="input-group">
                <span class="input-group-addon"><span class="fa-user fa"></span></span>
                <select name="customerid" id="customerid" class="form-control">
                <?php
                for($i=0; $i<count($customers);$i++) {
                 ?>
                  <option value="<?php echo $customers[$i]['boutique_customer_id']; ?>" <?php if($customers[$i]['boutique_customer_id'] == $customerid){ echo "selected='selected'"; }?>>
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
                <input name="boutique_order_form_number" type="text" class="form-control pull-right">
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Rent Amount</label>
              <div class="input-group">
                <span class="input-group-addon"><span class="fa-inr fa"></span></span>
                <input name="price" type="text" class="form-control" value="<?php echo @$teamdetail->TeamPhone; ?>">
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
                <input name="due_date" type="text" class="form-control pull-right" id="datepicker">
              </div>
            </div>
          </div>
          <!-- <div class="col-md-12">
            <div class="form-group">
              <label>Delivery Date</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input name="delivery_date" type="text" class="form-control pull-right" id="datepicker1">
              </div>
            </div>
          </div> -->
          <!-- <div class="col-md-12">
            <div class="form-group">
              <label>Trial Date</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input name="trial_date" type="text" class="form-control pull-right" id="datepicker2">
              </div>
            </div>
          </div> -->

      	
          <div class="col-md-12">
            <div class="form-group">
              <label>Comments</label>
              <textarea name="comments" class="form-control" rows="3"></textarea>
            </div>
          </div>
           <?php if($this->session->userdata('UserID')==136) {?>
 <div class="col-md-12">
            <div class="form-group">
              <label>Image</label>
              <input type="file" id="clothimg" name="clothimg" class="form-control">
              <img id="clothimgprev" src="#" alt="image" height="80" style="display: none;" />
            </div>
          </div>
          <?php } ?>
          <!-- <div class="col-md-12">
            <div class="form-group">
                <label>Select Tailor</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="fa-user fa"></span></span>
                  <select name="tailorid" class="form-control">
                  <option value="">Select Tailor</option>
                  <?php
                  for($i=0; $i<count($tailors);$i++) {
                   ?>
                    <option value="<?php echo $tailors[$i]['boutique_tailor_id']; ?>">
                    <?php echo $tailors[$i]['boutique_tailor_username']; ?>
                    </option>
                  <?php } ?>
                  </select>
                </div>
            </div>
          </div> -->


           <!-- <div class="col-md-12">
            <div class="form-group">
              <label>Photo Of Cloth</label>
              <input type="file" id="clothimg" name="clothimg" class="form-control">
              <img id="clothimgprev" src="#" alt="Photo Of Cloth" height="150" style="display: none;" />
            </div>
          </div> -->
<!-- 

          <div class="col-md-12">
            <div class="form-group">
              <label>Measurements</label>
              <div class="radio" id="cmeasurements">
                <label><input type="radio" name="measurement_type" value="1" checked>Measurements - <a href="<?php echo base_url(); ?>boutique/measurements/<?php echo $customerid;?>/1" target="_blank">Add measurement</a></label>
              </div>
              
            </div>
          </div> -->
  

        </div>
      </div>
      <div class="box-footer">
        <input type="hidden" name="orderid" value="<?php echo $orderid;?>">
        <button type="submit" name="finish" value="1" class="btn btn-primary">FINISH</button>
        <!-- <button type="submit" name="add_another_work" value="2" class="btn btn-primary">ADD ANOTHER WORK</button> -->
      </div>
    </form>
  </div>
  </section>
</div>
<script src="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
