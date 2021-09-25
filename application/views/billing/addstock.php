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
      Add
      <small>Item Stock</small>
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
    <form id="addcustomer" method="post" action="<?php echo base_url(); ?>billing/updateitemstock/" enctype="multipart/form-data">
      <div class="box-header with-border">
        <h3 class="box-title">Item Stock Details</h3>
        <span class="pull-right"><a class="btn btn-info" onClick="window.history.back()">
        Back</a></span></br></br>
        <span>Item Name : <?php echo $item['boutique_item_name'];?></span></br></br>
        <span>Item Code/SKU : <?php echo $item['boutique_item_code'];?></span>
      </div>
      <div class="box-body">
        <div class="row">

          <div class="col-md-12">
            <div class="form-group">
              <label>Current Stock</label>
              <input type="text" class="form-control" value="<?php echo $item['boutique_item_total_remaining'];?>" disabled>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Add Stock</label>
              <input name="boutique_item_total_remaining" type="text" class="form-control" value="">
            </div>
          </div>
          
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Update</button>
        <input name="boutique_item_id" type="hidden" class="form-control" value="<?php echo $item['boutique_item_id'];?>">
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