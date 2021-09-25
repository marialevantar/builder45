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
      Add
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
    <form id="addcustomer" method="post" action="<?php echo base_url(); ?>boutique/savecustomer/" enctype="multipart/form-data">
      <div class="box-header with-border">
        <h3 class="box-title">Tenant Details</h3>
        <?php if($this->session->userdata('UserID') !=119) {?>
        <span class="pull-right"><a class="btn btn-info" href="<?php echo @$backlink; ?>">
        Back</a></span>
        <?php } ?>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Name</label>
              <input name="name" type="text" class="form-control" value="" style="text-transform: capitalize;">
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
                    <option value="<?php echo $properties[$i]['boutique_property_id']; ?>">
                    <?php echo $properties[$i]['boutique_property_name']; ?>
                    </option>
                  <?php } ?>
                  </select>
                </div>
            </div>
          </div>
<!-- Add Room No-->
<div class="col-md-12">
            <div class="form-group">
              <label>Room No</label>
              <input name="room_no" type="text" class="form-control">
            </div>
          </div>
          
<!-- Closing Room No-->


            <?php } ?>
          <!--
          <div class="col-md-12">
            <div class="form-group">
              <label>Email</label>
              <div class="input-group">
                <span class="input-group-addon"><span class="fa-envelope fa"></span></span>
                <input type="email" name="email" class="form-control" value="">
              </div>
            </div>
          </div>
        -->
          <div class="col-md-12">
            <div class="form-group">
              <label>Phone</label>
              <div class="input-group">
                <span class="input-group-addon"><span class="fa-phone fa"></span></span>
    <input name="phone" type="text" class="form-control" id="phone_validate">
              </div>
              <span id="errorPhMsg" style="color:orange;"></span>
            </div>
          </div>
       
          <div class="col-md-12">
            <div class="form-group">
              <label>Address (use " , " for separate sentence)</label>
              <input name="address"  type="text" class="form-control" id="addresstag">
            </div>
          </div>
          <!-- Gst In 136-->  

          <?php if($this->session->userdata('UserID') ==136) {?>
          <div class="col-md-12">
            <div class="form-group row">
            <div class="col-md-2">
              <label>No GST</label><br>
              <input type="radio"  name="gst_status" value="" checked>
              </div>
        
              <div class="col-md-2">
              <label>Enable GST ( 18 % )</label><br>
              <input type="radio"  name="gst_status" value="2">
              </div>
              <div class="col-md-2">
              <label>Enable GST ( 19 % )</label><br>
              <input type="radio"  name="gst_status" value="1">
              </div>
            </div>
          </div>
          <?php } ?>
          <!-- Closing GST -->
          
 
          <div class="col-md-12">
            <div class="form-group row">
              <div class="col-md-2">
              <label>Rent Type</label><br>
              Monthly &nbsp;<input type="radio"  name="rent_type"  value="monthly" required>&nbsp;&nbsp;
              Daily&nbsp;<input type="radio"  name="rent_type"  value="daily" required>
              </div>
              <div class="col-md-4" id="monthly_date">
              <label>Monthy Rent Date</label><br>
              <input name="monthly_date" type="text" class="form-control" id="monthly_date_pick">
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
              <label>Period</label>
              <div class="input-group">
                <span class="input-group-addon"></span>
                <select name="period" id="cars" class="form-control">
                  <option value="1" selected>11 Months</option>
                  <option value="2">3 Year</option>
                </select>
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
                <input name="rent_from_date" type="text" class="form-control pull-right" id="datepicker1">
              </div>
            </div>
          </div>


         
          <div class="col-md-12">
          <h4 class="box-title">Upload Document</h4>
            <div class="form-group row" style="border-style: solid;border-width: thin; margin-left: 0px;margin-right: 0px;">
              <div class="col-md-6">
              <label>Document Name 1</label>
           <input type="text"  name="document_name1" class="form-control" >
              </div>
              <div class="col-md-6">
              <label>Select File</label>
              <input name="document_file1" type="file"  class="form-control" accept="image/*,.pdf">
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group row" style="border-style: solid;border-width: thin;margin-left: 0px;margin-right: 0px;">
              <div class="col-md-6">
              <label>Document Name 2</label>
           <input type="text"  name="document_name2" class="form-control" >
              </div>
              <div class="col-md-6">
              <label>Select File</label>
              <input name="document_file2" type="file" class="form-control" accept="image/*,.pdf">
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group row" style="border-style: solid;border-width: thin;margin-left: 0px;margin-right: 0px;">
              <div class="col-md-6">
              <label>Document Name 3</label>
           <input type="text"  name="document_name3" class="form-control" >
              </div>
              <div class="col-md-6">
              <label>Select File</label>
              <input name="document_file3" type="file" class="form-control" accept="image/*,.pdf">
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group row" style="border-style: solid;border-width: thin;margin-left: 0px;margin-right: 0px;">
              <div class="col-md-6">
              <label>Document Name 4</label>
           <input type="text"  name="document_name4" class="form-control" >
              </div>
              <div class="col-md-6">
              <label>Select File</label>
              <input name="document_file4" type="file" class="form-control" accept="image/*,.pdf">
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Add</button>
        <a formnovalidate id="<?php echo @$teamdetail->TeamID; ?>" class="pull-right">
        </a>
      </div>
    </form>
  </div>

    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->


