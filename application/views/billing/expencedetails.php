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
      Update
      <small>Expense</small>
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
    <form id="addcustomer" method="post" action="<?php echo base_url(); ?>billing/updateexpence/">
      <div class="box-header with-border">
        <h3 class="box-title">Expense Details</h3>
        <span class="pull-right"><a class="btn btn-info" href="<?php echo @$backlink; ?>">
        Back</a></span>
      </div>
      <div class="box-body">
        <div class="row">

          <div class="col-md-12">
            <div class="form-group">
              <label>Date</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input name="boutique_expense_date" type="text" class="form-control pull-right" id="datepicker1" value="<?php echo $expences['boutique_expense_date'];?>">
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
                <label>Select Head</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="fa-user fa"></span></span>
                  <select name="boutique_billing_head_id" class="form-control">
                    <option value="">Select Head</option>
                  <?php
                  for($i=0; $i<count($expencecategory);$i++) {
                   ?>
                    <option value="<?php echo $expencecategory[$i]['boutique_billing_head_id']; ?>" <?php if($expences['boutique_billing_head_id'] == $expencecategory[$i]['boutique_billing_head_id']){ echo 'selected="selected"';}?>>
                    <?php echo $expencecategory[$i]['boutique_billing_head_name']; ?>
                    </option>
                  <?php } ?>
                  </select>
                </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Amount</label>
              <input name="boutique_expense_amount" type="text" class="form-control" value="<?php echo $expences['boutique_expense_amount'];?>">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Expense Description</label>
              <textarea name="boutique_expense_details" class="form-control" rows="3"><?php echo $expences['boutique_expense_details'];?></textarea>
            </div>
          </div>

        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Update</button>
        <input name="boutique_expense_id" type="hidden" class="form-control pull-right" value="<?php echo $expences['boutique_expense_id'];?>">
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