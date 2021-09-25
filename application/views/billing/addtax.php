<?php 
$stat = $this->session->userdata('filter');
if($stat == "rejected"):
  $backlink = base_url()."billing/expences";
elseif($stat == "new"):
  $backlink = base_url()."billing/expences";
elseif($stat == "active"):
  $backlink = base_url()."billing/expences";
else:
  $backlink = base_url()."billing/expences";
endif;
 ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Add
      <small>Tax</small>
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
    <form id="addcustomer" method="post" action="<?php echo base_url(); ?>billing/savetax/">
      <div class="box-header with-border">
        <h3 class="box-title">Tax Details</h3>
        <span class="pull-right"><a class="btn btn-info" href="<?php echo @$backlink; ?>">
        Back</a></span>
      </div>
      <div class="box-body">
        <div class="row">

          
          <div class="col-md-12">
            <div class="form-group">
                <label>Enter Tax</label>
                <input name="tax_name" type="text" class="form-control" value="" required>
            </div>
          </div>
          
        </div>
      </div>
      <div class="box-body">
        <div class="row">

          
          <div class="col-md-12">
            <div class="form-group">
                <label>Enter Tax Rate</label>
                <input name="tax_rate" type="text" class="form-control" value="" required>
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