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
      <small>Sheduled Work</small>
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
    <form id="addcustomer" method="post" action="<?php echo base_url(); ?>boutique/updatesheduledworkuser/">
      <div class="box-header with-border">
        <h3 class="box-title">Work Details</h3>
        <span class="pull-right"><a class="btn btn-info" href="<?php echo base_url(); ?>boutique/userprojects">
        Back</a></span>
      </div>
      <div class="box-body">
        <div class="row">

<div class="col-md-12">
            <div class="form-group">
              <label>Actual Work Planned</label>
              <input name="ac_wk_plan"  type="text" class="form-control" value="<?php echo $schedulework[0]["sceduled_work_planned"]; ?>" >
            </div>
          </div>
        <div class="col-md-12">
            <div class="form-group">
              <label>Scheduled Date</label>
              <input name="sheduleddate" id="datepicker3"  type="text" class="form-control" value="<?php echo $schedulework[0]["schedule_work_date"]; ?>" style="text-transform: capitalize;">
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
                    <option value="<?php echo $properties[$i]['boutique_property_id']; ?>" <?php if($properties[$i]['boutique_property_id']==$schedulework[0]['scheduled_property_id']) echo 'selected'; ?>>
                    <?php echo $properties[$i]['boutique_property_name']; ?>
                    </option>
                  <?php } ?>
                  </select>
                </div>
            </div>
          </div>
         
         
         
         <!--
          <div class="col-md-6">
            <div class="form-group">
              <label>Date From</label>
              <input name="starting_date"  id="datepicker1"  type="text" class="form-control" value="<?php echo $schedulework[0]["schedule_work_startingdate"]; ?>" >
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Date To</label>
              <input name="completed_date" id="datepicker2" type="text" class="form-control" value="<?php echo $schedulework[0]["schedule_work_completedate"]; ?>" >
            </div>
          </div>
         
         -->
          <div class="col-md-12">
            <div class="form-group">
              <label>Actual Work Done</label>
              <textarea name="actual_work" class="form-control" rows="3"><?php echo $schedulework[0]["schedule_work_actualwork"]; ?></textarea>
         </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Remarks</label>
              <textarea name="task" class="form-control" rows="3" ><?php echo $schedulework[0]["schedule_work_task"]; ?></textarea>
         </div>
          </div>
          
          <div class="col-md-12">
            <div class="form-group">
              <label>Work Status</label>
                    <select name="work_status" class="form-control">
                        <option value="0" <?php if($schedulework[0]["builder_work_status"] == 0){ echo "selected"; } ?>>Red</option>
                        <option value="1" <?php if($schedulework[0]["builder_work_status"] == 1){ echo "selected"; } ?>>Yellow</option>
                        <option value="2" <?php if($schedulework[0]["builder_work_status"] == 2){ echo "selected"; } ?>>Green</option>
                    </select>
             </div>
          </div>
  
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
      <input name="scheduled_id" type="hidden" class="form-control" value="<?php echo $schedulework[0]["schedule_work_id"]; ?>" >
            
        <button type="submit" class="btn btn-primary">Update</button>
      
        <!-- <input name="boutique_expense_id" type="hidden" class="form-control pull-right" value="<?php echo $expences['boutique_expense_id'];?>"> -->
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