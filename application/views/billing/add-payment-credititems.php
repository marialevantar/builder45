<?php 
  $backlink = base_url()."boutique/orders/";
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Add
      <small>Payment</small>
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
    <form enctype="multipart/form-data" id="workvali" method="post" action="<?php echo base_url(); ?>billing/savepaymentcredititems">
      <div class="box-header with-border">
        <h3 class="box-title">Add Payment</h3>
        <span class="pull-right"><a class="btn btn-info" href="<?php echo @$backlink; ?>">
        Back</a></span>
      </div>
      <div class="box-body">
        <div class="row">
          
          <div class="col-md-12">
            <div class="form-group">
              <label>Grand Total</label>
              <div class="input-group">
                <span class="input-group-addon"><span class="fa-inr fa"></span></span>
                <input name="" type="text" class="form-control" value="<?php echo @$orderpayments['boutique_expense_amount']; ?>" disabled>
                <input name="boutique_order_grandtotal" type="hidden" class="form-control" value="<?php echo @$orderpayments['boutique_expense_amount']; ?>">
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Total Paid</label>
              <div class="input-group">
                <span class="input-group-addon"><span class="fa-inr fa"></span></span>
                <input name="" type="text" class="form-control" value="<?php echo @$orderpayments['credit_paid_amount']; ?>" disabled>
                <input name="boutique_order_amtpaid" type="hidden" class="form-control" value="<?php echo @$orderpayments['credit_paid_amount']; ?>">
              </div>
            </div>
          </div>
       

          <div class="col-md-12">
            <div class="form-group">
              <label>Amount<label>
              <div class="input-group">
                <span class="input-group-addon"><span class="fa-inr fa"></span></span>
                <input name="amount_paid" type="number" class="form-control" value="<?php echo @$teamdetail->TeamPhone; ?>">
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Payment Type</label>

              <select name="boutique_sale_paymenttype" class="form-control">
                        <option value="Cash,Cash">Cash</option>
                        <option value="Card,HDFC">HDFC</option>
                        <option value="Card1,AXIS">AXIS</option>
                    </select>
            </div>
          </div>
          
           <div class="col-md-12">
            <div class="form-group">
              <label>Paid Date</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input name="paid_date" type="text" class="form-control pull-right" id="datepicker">
              </div>
            </div>
          </div>
          
          <div class="col-md-12">
            <div class="form-group">
              <label>Comments</label>
              <textarea name="comments" class="form-control" rows="3"></textarea>
            </div>
          </div> 

        </div>
      </div>
      <div class="box-footer">
        <input type="hidden" name="orderid" value="<?php echo $orderid;?>">
        
        
        <input type="hidden" name="expece_id" value="<?php echo @$orderpayments['boutique_expense_id'];?>">
        
        <button type="submit" name="add_payment" value="1" class="btn btn-primary">ADD</button>
      </div>
    </form>
  </div>
  </section>
</div>
<script src="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
