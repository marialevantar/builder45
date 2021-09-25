<?php 
$stat = $this->session->userdata('filter');
if($stat == "rejected"):
  $backlink = base_url()."billing/items";
elseif($stat == "new"):
  $backlink = base_url()."billing/items";
elseif($stat == "active"):
  $backlink = base_url()."billing/items";
else:
  $backlink = base_url()."billing/items";
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
    <form id="addcustomer" method="post" action="<?php echo base_url(); ?>billing/updateitem/" enctype="multipart/form-data">
      <div class="box-header with-border">
        <h3 class="box-title">Items Details</h3>
        <span class="pull-right"><a class="btn btn-info" href="<?php echo @$backlink; ?>">
        Back</a></span>
      </div>
      <div class="box-body">
        <div class="row">

          <div class="col-md-12">
            <div class="form-group">
              <label>Item Name</label>
              <input name="boutique_item_name" type="text" class="form-control" value="<?php echo $item['boutique_item_name']; ?>">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Item Code/SKU</label>
              <input name="boutique_item_code" type="text" class="form-control" value="<?php echo $item['boutique_item_code']; ?>">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>HSN Code</label>
                <input name="boutique_item_hsn" type="text" class="form-control" value="<?php echo $item['boutique_item_hsn']; ?>"> 
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Item Unit Price(inclusive amount)</label>
              <div class="input-group">
                <span class="input-group-addon"><span class="fa-inr fa"></span></span>
                <input name="boutique_item_unit_price" type="text" class="form-control" value="<?php echo $item['boutique_item_unit_price']; ?>" id="boutique_item_unit_price" >
              </div>
            </div>
          </div>
           <div class="col-md-12">
            <div class="form-group">
              <label>Item Purchase Price</label>
              <div class="input-group">
              <span class="input-group-addon"><span class="fa-inr fa"></span></span>
              <input name="boutique_item_purchase_price" type="text" class="form-control" value="<?php echo $item['boutique_item_purchase_price']; ?>">
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Item Description</label>
              <textarea name="boutique_item_desc" class="form-control" rows="3"><?php echo $item['boutique_item_desc']; ?>
              </textarea>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Item Image</label>
              <input type="file" name="boutique_item_image" class="form-control">
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Applicable Tax</label>
              <div class="input-group">
                <span class="input-group-addon"><span class="fa-tasks fa"></span></span>
                <select name="boutique_tax_id" class="form-control" id="boutique_tax_id">
                <option value="" data-taxrate=''>No Tax</option>    
                <?php
                for($i=0; $i<count($taxes);$i++) {
                 ?>
                  <option value="<?php echo $taxes[$i]['boutique_tax_id'];?>" <?php if($taxes[$i]['boutique_tax_id'] == $item['boutique_tax_id']){ echo 'selected="selected"';}?> data-taxrate="<?php echo $taxes[$i]['boutique_tax_rate']; ?>">
                  <?php echo $taxes[$i]['boutique_tax_name']; ?>
                  </option>
                <?php } ?>
                </select>
              </div>
            </div>
          </div>

        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Update</button>
        <input name="boutique_item_id" type="hidden" class="form-control" value="<?php echo $item['boutique_item_id']; ?>">
        <input name="boutique_item_image" type="hidden" class="form-control" value="<?php echo $item['boutique_item_image']; ?>">
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