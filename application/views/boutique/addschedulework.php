<?php 
$stat = $this->session->userdata('filter');
if($stat == "rejected"):
  $backlink = base_url()."boutique/tailor";
elseif($stat == "new"):
  $backlink = base_url()."boutique/tailor";
elseif($stat == "active"):
  $backlink = base_url()."boutique/tailor";
else:
  $backlink = base_url()."boutique/tailor";
endif;
 ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Schedule Work 
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
    <form enctype="multipart/form-data"  id="addcustomer" method="post" action="<?php echo base_url(); ?>Boutique/savescheduledwork/">
      <div class="box-header with-border">
        <h3 class="box-title">Work Details</h3>
        <span class="pull-right"><a class="btn btn-info" href="<?php echo @$backlink; ?>">

        Back</a></span>
      </div>
      <div class="box-body">
        <div class="row">


          <div class="col-md-12">
            <div class="form-group">
              <label>Planned Work</label>
              <input name="ac_work_planned"  type="text" class="form-control" value="" >
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Scheduled Date</label>
              <input name="sheduleddate" id="datepicker" type="text" class="form-control" value="" style="text-transform: capitalize;">
            </div>
          </div>
          
          <div class="col-md-12">
            <div class="form-group">
                <label>Select Property</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="fa-user fa"></span></span>
                  <select name="property_id" class="form-control" required>
                    <option value="">Select Project</option>
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


          <div class="col-md-12">
            <div class="form-group">
              <label>Scheduled Person</label>
              <input name="sheduled_person" type="text" class="form-control" value="" style="text-transform: capitalize;">
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
                <label>Select Name</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="fa-user fa"></span></span>
                  <select name="user_name" class="form-control" required>
                    <option value="">Select Assignee Name</option>
                  <?php
                  foreach($others as $oth)
                  { 
                   ?>
                   <option value="<?php echo $oth["boutique_user_id"]; ?>"><?php echo $oth["boutique_user_username"]; ?></option>
                  <?php } ?>
                  </select>
                </div>
            </div>
          </div>


         <!-- 
          <div class="col-md-6">
            <div class="form-group">
              <label>Date From</label>
              <input name="starting_date" id="datepicker1" type="text" class="form-control" value="" >
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Date To</label>
              <input name="completed_date" id="datepicker2" type="text" class="form-control" value="" >
            </div>
          </div>
        -->
         
          <!-- <div class="col-md-12">
            <div class="form-group">
              <label>Actual Work Done</label>
              <textarea name="actual_work" class="form-control" rows="3"></textarea>
         </div>
          </div> -->

          <!-- <div class="col-md-12">
            <div class="form-group">
              <label>Remarks</label>
              <textarea name="task" class="form-control" rows="3"></textarea>
         </div>
          </div> -->

<!-- Staff image file  -->
          <!-- <div class="col-md-12">
            <div class="form-group">
              <label>Photo</label>
              <input type="file" id="clothimg" name="clothimg" class="form-control">
              <img id="clothimgprev" src="#" alt="Photo Of Cloth" height="150" style="display: none;" />
            </div>
          </div> -->

        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Add</button>
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