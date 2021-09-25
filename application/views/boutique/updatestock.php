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
      Update
      <small>Item</small>
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
    <form id="addcustomer" method="post" action="<?php echo base_url(); ?>boutique/updatestocksitems/">
      <div class="box-header with-border">
        <h3 class="box-title">Work Details</h3>
        <span class="pull-right"><a class="btn btn-info" href="<?php echo @$backlink; ?>">
        Back</a></span>
      </div>
      <div class="box-body">
        <div class="row">

        <div class="col-md-12">
            <div class="form-group">
              <label>Item Name</label>
              <input name="itemname" type="text" class="form-control" value="<?php echo $updatestock[0]["boutique_item_name"]; ?>" required>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Item HSN Code</label>
              <input name="item_hsn_code" type="text" class="form-control" value="<?php echo $updatestock[0]["boutique_item_hsn"]; ?>" required>
            </div>
          </div>


          <div class="col-md-12">
            <div class="form-group">
              <label>Unit Price</label>
              <input name="unit_price" type="text" class="form-control" value="<?php echo $updatestock[0]["boutique_item_unit_price"]; ?>" required>
            </div>
          </div>

          <!-- <div class="col-md-12">
            <div class="form-group">
              <label>Quantity</label>
              <input name="quantity" type="text" class="form-control" value="<?php echo $updatestock[0]["boutique_item_name"]; ?>" required>
            </div>
          </div> -->

          <!-- <div class="col-md-12">
            <div class="form-group">
              <label>Amount</label>
              <input name="amount" type="text" class="form-control" value="" required>
            </div>
          </div> -->

          <div class="col-md-12">
            <div class="form-group">
              <label>Item Description</label>
              <textarea name="item_description" class="form-control" rows="3"><?php echo $updatestock[0]["boutique_item_desc"]; ?></textarea>
            </div>
          </div>
  
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
      <input name="item_id" type="hidden" class="form-control" value="<?php echo $updatestock[0]["boutique_item_id"]; ?>" >
            
        <button type="submit" class="btn btn-primary">Update</button>
      
        <!-- <input name="boutique_expense_id" type="hidden" class="form-control pull-right" value="<?php echo $expences['boutique_expense_id'];?>"> -->
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