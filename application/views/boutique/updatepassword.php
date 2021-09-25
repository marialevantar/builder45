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
      Update
      <small>Password</small>
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
    <form id="addcustomer" method="post" action="<?php echo base_url(); ?>boutique/savepassword/">
      <div class="box-header with-border">
        <h3 class="box-title">Update Password Details</h3>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Current Password</label>
              <input name="current_password" type="password" class="form-control" value="">
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>New Password</label>
              <input name="new_password" type="password" class="form-control" value="">
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Confirm Password</label>
              <input name="confirm_password" type="password" class="form-control" value="">
            </div>
          </div>

        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
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