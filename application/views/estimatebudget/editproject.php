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
      Add
    <small>Title</small>
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
    <form enctype="multipart/form-data"  id="addcustomer" method="post" action="<?php echo base_url(); ?>estimattebudget/editprojectestimate/">
      <div class="box-header with-border">
      <span class="pull-right"><a class="btn btn-info" href="<?php echo @$backlink; ?>">
        Back</a></span>
      </div>
      <div class="box-body">
        <div class="row">

        <div class="col-md-12">
            <div class="form-group">
              <label>Property Name : </label><b style="color:red;"><?php echo $projects[0]["boutique_property_name"]; ?></b> 
            </div>
          </div>

        <div class="col-md-12">
            <div class="form-group">
              <label>Title Name : </label><b style="color:red;"><?php echo $projects[0]["header_name"]; ?></b>  
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Sub title : </label><b style="color:red;"><?php echo $projects[0]["subheader_name"]; ?></b>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Vendor Or Subcontractor</label>
              <input name="name" type="text" class="form-control" value="<?php echo $projects[0]["vendor_contractor"]; ?>">
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <h4><b><i>Estimated Cost</i></b></h4>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
            <label>Labor</label>
              <input name="Labor_cost" id="Labor_cost" type="text" class="form-control" value="<?php echo $projects[0]["labor_cost"]; ?>" onkeyup="laborcharge()" >
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
            <label>Material</label>
              <input name="material_cost" id="material_cost" type="text" class="form-control" value="<?php echo $projects[0]["materail_cost"]; ?>" onkeyup="laborcharge()">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
            <label>Total Cost</label>
              <input name="total_cost" id="total_cost" type="text" class="form-control" value="<?php echo $projects[0]["total_cost"]; ?>">
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
            <label>Actual Cost</label>
              <input name="actual_cost" type="text" class="form-control" value="<?php echo $projects[0]["actual_cost"]; ?>">
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
            <label>Variance</label>
              <input name="variance_cost" type="text" class="form-control" value="<?php echo $projects[0]["variance"]; ?>">
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
            <label>% Completed</label>
              <input name="completed_percentage" type="text" class="form-control" value="<?php echo $projects[0]["completed_percentage"]; ?>">
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
            <label>Current Paid</label>
              <input name="current_paid" type="text" class="form-control" value="<?php echo $projects[0]["current_paid"]; ?>">
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
            <label>Amount Due</label>
              <input name="amount_due" type="text" class="form-control" value="<?php echo $projects[0]["amount_due"]; ?>">
            </div>
          </div>
          
          <div class="col-md-12">
            <div class="form-group">
            <label>Notes</label>
                <textarea row="3"class="form-control" name="notes"><?php echo $projects[0]["builder_notes"]; ?></textarea>
            </div>
          </div>
   
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <input type="hidden" name="orderid" value="<?php echo $this->uri->segment(3); ?>">
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