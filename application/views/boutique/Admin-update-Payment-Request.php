<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
        Update
      <small>Payment Request</small>
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
    <form id="addcustomer" method="post" action="<?php echo base_url(); ?>boutique/updateadminpayment/">
      <div class="box-header with-border">
        <h3 class="box-title">Payment Request Form</h3>
        <span class="pull-right">
        <a class="btn btn-info" href="javascript:history.back()">Go Back</a></span>
      </div>
      <div class="box-body">
        <div class="row">

        <div class="col-md-12">
            <div class="form-group">
              <label>Requested Date</label>
              <input name="current_date" type="date" class="form-control" value="<?php echo $payment["builder_payment_request_requested_date"]; ?>" disabled>
            </div>
          </div>

        
          <div class="col-md-12">
            <div class="form-group">
              <label>Date</label>
              <input name="starting_date" type="date" class="form-control" value="<?php echo $payment["builder_payment_request_date"]; ?>" disabled>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Amount</label>
                <input type="text" name="payment_amount" value="<?php echo $payment["builder_payment_request_amount"]; ?>" class="form-control" disabled>
            </div>
          </div>


          <div class="col-md-12">
            <div class="form-group">
              <label>Description</label>
            <textarea name="description" class="form-control" cols="30" rows="4" disabled><?php echo $payment["builder_payment_request_description"]; ?></textarea>
            <input type="hidden" name="payment_request_id" value="<?php echo $this->uri->segment(3); ?>">
          </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Description</label>
            <textarea name="office_description" class="form-control" cols="30" rows="4" ><?php echo $payment["builder_payment_request_office_comment"]; ?></textarea>
          </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Status</label>
              <select name="payment_status" class="form-control">
                    <option value="2">Accept</option>
                    <option value="3">Reject</option>
                </select>
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