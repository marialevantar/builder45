<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
        Apply Leave
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
    <form id="addcustomer" method="post" action="<?php echo base_url(); ?>boutique/updateleave/">
      <div class="box-header with-border">
        <h3 class="box-title">Leave Form</h3>
        <span class="pull-right">
        <a class="btn btn-info" href="javascript:history.back()">Go Back</a></span>
      </div>
      <div class="box-body">
        <div class="row">

        <div class="col-md-12">
            <div class="form-group">
              <label>Applied Date</label>
              <input name="current_date" type="date" class="form-control" value="<?php echo $leave["builder_leave_apply_applied_date"]; ?>">
            </div>
          </div>
        
          <div class="col-md-12">
            <div class="form-group">
              <label>Leave Date</label>
              <input name="starting_date" type="date" class="form-control" value="<?php echo $leave["builder_leave_apply_date"]; ?>">
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Type</label>
                <select id="leave_type" name="leave_type" class="form-control">
                    <option  value="1" <?php if($leave["builder_leave_apply_type"]==1){ echo "selected"; }?>>Full Day</option>
                    <option  value="2" <?php if($leave["builder_leave_apply_type"]==2){ echo "selected"; }?>>Half Day</option>
                </select>
            </div>
          </div>

          <div class="col-md-12" id="type_time" <?php if($leave["builder_leave_apply_type"]!=2){ ?> style="display:none;" <?php }?>>
            <div class="form-group">
              <label>Time</label>
                <select name="type_time" class="form-control">
                <option  value="0" <?php if($leave["builder_leave_apply_time"]==0){ echo "selected"; }?>>Select Time</option>
                <option  value="1" <?php if($leave["builder_leave_apply_time"]==1){ echo "selected"; }?>>Morning</option>
                <option  value="2" <?php if($leave["builder_leave_apply_time"]==2){ echo "selected"; }?>>After Noon</option>
                </select>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Description</label>
            <textarea name="description" class="form-control" cols="30" rows="4"><?php echo $leave["builder_leave_apply_description"]; ?></textarea>
        <input type="hidden" name="apply_id" value="<?php echo $this->uri->segment(3); ?>">    
        </div>
          </div>


        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Update</button>
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


<script>

</script>