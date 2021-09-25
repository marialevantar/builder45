<?php 
$stat = $this->session->userdata('filter');
if($stat == "rejected"):
  $backlink = base_url()."boutique/expences";
elseif($stat == "new"):
  $backlink = base_url()."boutique/expences";
elseif($stat == "active"):
  $backlink = base_url()."boutique/expences";
else:
  $backlink = base_url()."boutique/expences";
endif;
 ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Add
      <small>Petty Cash</small>
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
    <form id="addcustomer" method="post" action="<?php echo base_url(); ?>boutique/saveexpence/">
      <div class="box-header with-border">
        <h3 class="box-title">Details</h3>
        <span class="pull-right">
        <a class="btn btn-info" href="javascript:history.back()">Go Back</a></span>
        </span>
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
                <input name="boutique_expense_date" type="text" class="form-control pull-right" id="datepicker">
              </div>
            </div>
          </div>
                     <?php if($this->session->userdata('UserID') ==126) {?>
           <div class="col-md-12">
            <div class="form-group">
                <label>Select Property</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="fa-user fa"></span></span>
                  <select name="property_id" class="form-control">
                    <option value="">Select Property</option>
                  <?php
                  for($i=0; $i<count($properties);$i++) {
                   ?>
                    <option value="<?php echo $properties[$i]['boutique_property_id']; ?>">
                    <?php echo $properties[$i]['boutique_property_name']; ?>
                    </option>
                  <?php } ?>
                  </select>
                </div>
            </div>
          </div>
            <?php } ?>
          <div class="col-md-12">
            <div class="form-group">
                <label>Select Project Engineer</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="fa-user fa"></span></span>
                  <select name="boutique_billing_user_id" class="form-control">
                    <option value="">Select Project Engineer</option>
                  <?php
                  for($i=0; $i<count($projectengineer);$i++) {
                   ?>
                    <option value="<?php echo $projectengineer[$i]['boutique_user_id']; ?>">
                    <?php echo $projectengineer[$i]['boutique_user_username']; ?>
                    </option>
                  <?php } ?>
                  </select>
                </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Amount</label>
              <input name="boutique_expense_amount" type="text" class="form-control" value="" required>
            </div>
          </div>


          <div class="col-md-12">
            <div class="form-group">
              <label>Payment Type</label>

              <select name="boutique_sale_paymenttype" class="form-control">
                        <option value="Cash">Cash</option>
                        <option value="Card">Card</option>
                      </select>
            </div>
          </div>
          

          <input name="petty_cash" type="hidden" class="form-control" value="1">

          <div class="col-md-12">
            <div class="form-group">
              <label>Pettycash Description</label>
              <textarea name="boutique_expense_details" class="form-control" rows="3"></textarea>
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