<?php 
$stat = $this->session->userdata('filter');
if($stat == "rejected"):
  $backlink = base_url()."boutique/userlist";
elseif($stat == "new"):
  $backlink = base_url()."boutique/userlist";
elseif($stat == "active"):
  $backlink = base_url()."boutique/userlist";
else:
  $backlink = base_url()."boutique/userlist";
endif;
 ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit
      <small>User</small>
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
    <form id="addcustomer" method="post" action="<?php echo base_url(); ?>boutique/saveuser/">
      <div class="box-header with-border">
        <h3 class="box-title">User Details</h3>
        <span class="pull-right"><a class="btn btn-info" href="<?php echo @$backlink; ?>">
        Back</a></span>
      </div>
      <div class="box-body">
        <div class="row">

        <div class="col-md-12">
          <div class="form-group">
            <label>Old Password</label>
            <input type="password" name="userpassword" class="form-control" required>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label>New Password</label>
            <input type="password" name="userpassword" class="form-control" required>
          </div>
        </div>
        
        <div class="col-md-12">
          <div class="form-group">
            <label>Confirm Password</label>
            <input name="userconfirmpassword" type="password" class="form-control" data-match="#inputPassword" data-match-error="Whoops, these don't match" required>
          </div>
        </div> 

        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <?php if($this->session->userdata('UserRole') == 4){?>
        <button type="submit" class="btn btn-primary">Update</button>
        <?php } ?>
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