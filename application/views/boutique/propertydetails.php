<?php 
$stat = $this->session->userdata('filter');
if($stat == "rejected"):
  $backlink = base_url()."boutique/properties";
elseif($stat == "new"):
  $backlink = base_url()."boutique/properties";
elseif($stat == "active"):
  $backlink = base_url()."boutique/properties";
else:
  $backlink = base_url()."boutique/properties";
endif;
 ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Update
      <small>Property</small>
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
    <form id="addcustomer" method="post" action="<?php echo base_url(); ?>boutique/updateproperty/">
      <div class="box-header with-border">
        <h3 class="box-title">Property Details</h3>
        <span class="pull-right"><a class="btn btn-info" href="<?php echo @$backlink; ?>">
        Back</a></span>
      </div>
      <div class="box-body">
        <div class="row">

          <div class="col-md-12">
            <div class="form-group">
              <label>Property Name</label>
              <textarea name="boutique_property_name" class="form-control" rows="3"><?php echo $properties['boutique_property_name'];?></textarea>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Location</label>
              <input type="text" name="header1" class="form-control" value="<?php echo $properties['b_boutique_header'];?>" required>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Client Name</label>
              <input type="text" name="subheader1" class="form-control" value="<?php echo $properties['b_boutique_subheader'];?>" required>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Phone </label>
              <input name="phone" type="text" class="form-control" value="<?php echo $properties['b_boutique_phone'];?>" id="phone_validate">
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Site In charge</label>
              <input name="sig_1" type="text" class="form-control" value="<?php echo $properties['auth_signature_1'];?>" id="phone_validate">
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Site In charge Contact No </label>
              <input name="sig_2" type="text" class="form-control" value="<?php echo $properties['auth_signature_2'];?>" id="phone_validate">
            </div>
          </div>

        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Update</button>
        <input name="boutique_property_id" type="hidden" class="form-control pull-right" value="<?php echo $properties['boutique_property_id'];?>">
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