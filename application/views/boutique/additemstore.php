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
    <form enctype="multipart/form-data"  id="addcustomer" method="post" action="<?php echo base_url(); ?>Boutique/savestoreitem/">
      <div class="box-header with-border">
        <h3 class="box-title">Item Details</h3>
        <span class="pull-right"><a class="btn btn-info" href="<?php echo @$backlink; ?>">

        Back</a></span>
      </div>
      <div class="box-body">
        <div class="row">

          <div class="col-md-12">
            <div class="form-group">
              <label>Item Name</label>
              <input name="name" type="text" class="form-control" value="" style="text-transform: capitalize;">
            </div>
          </div>
         
          <div class="col-md-12">
            <div class="form-group">
              <label>Item Code</label>
              <input name="item_code" type="text" class="form-control" value="" >
            </div>
          </div>
         
          <div class="col-md-12">
            <div class="form-group">
              <label>Item Qunatity</label>
              <input name="item_quantity" type="text" class="form-control" value="" >
            </div>
          </div>

<!-- Staff image file  -->
          <!-- <div class="col-md-12">
            <div class="form-group">
              <label>Photo</label>
              <input type="file" id="clothimg" name="clothimg" class="form-control">
              <img id="clothimgprev" src="#" alt="Photo Of Cloth" height="150" style="display: none;" />
            </div>
          </div> -->

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