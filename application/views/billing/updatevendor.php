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
      Update Vendor
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
    <form id="addcustomer" method="post" action="<?php echo base_url(); ?>Billing/updatevendor/">
      <div class="box-header with-border">
        <span class="pull-right"><a class="btn btn-info" href="<?php echo base_url('billing/addvendor');?>">Add Vendor</a></span>
      </div>
      <div class="box-body">
        <div class="row">

          <div class="col-md-12">
            <div class="form-group">
              <label>Name</label>
              <input name="name" type="text" class="form-control" value="<?php  echo $vendor[0]["b_boutique_vendor_name"]; ?>" style="text-transform: capitalize;">
              <input name="vendor_id" type="hidden" class="form-control" value="<?php  echo $vendor[0]["b_boutique_vendor_id"]; ?>">
            
            </div>
          </div>
          

          <div class="col-md-12">
            <div class="form-group">
              <label>Phone</label>
              <div class="input-group">
                <span class="input-group-addon"><span class="fa-phone fa"></span></span>
                <input name="phone" type="text" class="form-control" value="<?php  echo $vendor[0]["b_boutique_ven_phone"]; ?>">
              </div>
            </div>
          </div>
         
          <div class="col-md-12">
            <div class="form-group">
              <label>Address</label>
              <textarea name="address" class="form-control" rows="3"><?php  echo $vendor[0]["b_boutique_ven_add"]; ?></textarea>
            </div>
          </div>

          
          <div class="col-md-12">
            <div class="form-group">
              <label>GST No</label>
              <input name="gst_no" type="text" class="form-control" value="<?php  echo $vendor[0]["b_boutique_GST_no"]; ?>" style="text-transform: capitalize;">
            
            </div>
          </div>

        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">update</button>
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