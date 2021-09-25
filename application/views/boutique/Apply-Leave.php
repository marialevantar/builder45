<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
        Apply
      <small>Leave</small>
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
    <form id="addcustomer" method="post" action="<?php echo base_url(); ?>boutique/saveleave/">
      <div class="box-header with-border">
        <h3 class="box-title">Leave Form</h3>
        <span class="pull-right">
        <a class="btn btn-info" href="javascript:history.back()">Go Back</a></span>
      </div>
      <div class="box-body">
        <div class="row">

        <div class="col-md-12">
            <div class="form-group">
              <label>Date</label>
              <input name="current_date" type="date" class="form-control" value="<?php echo date("Y-m-d"); ?>" required>
            </div>
          </div>

        
          <div class="col-md-12">
            <div class="form-group">
              <label>Leave Date</label>
              <input name="starting_date" type="date" class="form-control" value="" required>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Type</label>
                <select id="leave_type" name="leave_type" class="form-control">
                    <option  value="1">Full Day</option>
                    <option  value="2">Half Day</option>
                </select>
            </div>
          </div>

          <div class="col-md-12" id="type_time" style="display: none;">
            <div class="form-group">
              <label>Time</label>
                <select name="type_time" class="form-control">
                <option  value="0">Select Time</option>
                <option  value="1">For Noon</option>
                    <option  value="2">After Noon</option>
                </select>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Description</label>
            <textarea name="description" class="form-control" cols="30" rows="4"></textarea>
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


<script>

</script>