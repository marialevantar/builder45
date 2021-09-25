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
    <form enctype="multipart/form-data"  id="addcustomer" method="post" action="<?php echo base_url(); ?>estimattebudget/saveprojectestimate/">
      <div class="box-header with-border">
      <span class="pull-right"><a class="btn btn-info" href="<?php echo @$backlink; ?>">
        Back</a></span>
      </div>
      <div class="box-body">
        <div class="row">

        <div class="col-md-12">
            <div class="form-group">
              <label>Property</label>
                  <select name="property_name"  class="form-control" id="property_selection" required>
                    <?php foreach($properties as $properties) {?>
                      <option value="<?php echo $properties["boutique_property_id"]; ?>" <?php if($this->uri->segment(4)){ if($this->uri->segment(4)==$properties["boutique_property_id"]){ echo "selected"; } } ?>><?php echo $properties["boutique_property_name"]; ?></option>
                    <?php } ?>
                  </select>
            </div>
          </div>

        <div class="col-md-12">
            <div class="form-group">
              <label>Title</label>  
              <select name="title" class="form-control" id="header_selection" required>
                    <option value=""></option>
                <?php foreach($heades as $heades) {?>
                  <option value="<?php echo $heades["hedaer_id"]; ?>" <?php if($this->uri->segment(3)){ if($this->uri->segment(3)==$heades["hedaer_id"]){ echo "selected"; } } ?>><?php echo $heades["header_name"]; ?></option>
                <?php } ?>
           
              </select>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Sub title</label>
                  <select name="subtitle"  class="form-control" id="subheader_selection" required>
                    <?php foreach($subheades as $subheades) {?>
                      <option value="<?php echo $subheades["subheader_id"]; ?>"><?php echo $subheades["subheader_name"]; ?></option>
                    <?php } ?>
                  </select>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Vendor Or Subcontractor</label>
              <input name="name" type="text" class="form-control" value="">
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
              <input name="Labor_cost" id="Labor_cost" type="text" class="form-control" value="" onkeyup="laborcharge()" >
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
            <label>Material</label>
              <input name="material_cost" id="material_cost" type="text" class="form-control" value="" onkeyup="laborcharge()">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
            <label>Total Cost</label>
              <input name="total_cost" id="total_cost" type="text" class="form-control" value="" readonly>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
            <label>Actual Cost</label>
              <input id="actual_cost" onkeyup="actualcost()" name="actual_cost" type="text" class="form-control" value="">
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
            <label>Variance</label>
              <input id="variance_cost" name="variance_cost" type="text" class="form-control" value="" readonly>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
            <label>% Completed</label>
              <input name="completed_percentage" type="text" class="form-control" value="">
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
            <label>Current Paid</label>
              <input id="currentpaid" onkeyup="currentpaidamnt()" name="current_paid" type="text" class="form-control" value="">
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
            <label>Amount Due</label>
              <input id="amount_due" name="amount_due" type="text" class="form-control" value="" readonly>
            </div>
          </div>
          
          <div class="col-md-12">
            <div class="form-group">
            <label>Notes</label>
                <textarea row="3"class="form-control" name="notes"></textarea>
            </div>
          </div>
   
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