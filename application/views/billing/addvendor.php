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
      Add Vendor
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
    <form id="addcustomer" method="post" action="<?php echo base_url(); ?>Billing/savevendor/">
      <div class="box-header with-border">
        <!-- <span class="pull-right"><a class="btn btn-info" href="<?php echo base_url('billing/purchaselist');?>">

        Back</a></span> -->
      </div>
      <div class="box-body">
        <div class="row">

          <div class="col-md-12">
            <div class="form-group">
              <label>Name</label>
              <input name="name" type="text" class="form-control" value="" style="text-transform: capitalize;">
            </div>
          </div>
          
          <div class="col-md-12">
            <div class="form-group">
              <label>Phone</label>
              <div class="input-group">
                <span class="input-group-addon"><span class="fa-phone fa"></span></span>
    <input name="phone" type="text" class="form-control" id="phone_validate">
              </div>
              <span id="errorPhMsg" style="color:orange;"></span>
            </div>
          </div>
         
          <div class="col-md-12">
            <div class="form-group">
              <label>Address</label>
              <textarea name="address" class="form-control" rows="3"></textarea>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>GST NO</label>
              <input name="gst_no" type="text" class="form-control" value="" style="text-transform: capitalize;">
            </div>
          </div>
          <?php if($this->session->userdata('BoutiqueID') == 27){?>
          <div class="col-md-12">
            <div class="form-group">
                <label>Select Staff Type</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="fa-user fa"></span></span>
                  <select name="boutique_staff_type" class="form-control">
                    <option value="1">Tailor</option>
                    <option value="2">Designer</option>
                    <option value="3">Hand Worker</option>
                    <option value="4">Machine Embroidary</option>
                    <option value="5">Finishing Person</option>
                  </select>
                </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Hourly Rate</label>
              <div class="input-group">
                <span class="input-group-addon"><span class="fa-inr fa"></span></span>
                <input name="boutique_staff_hourly_rate" type="number" class="form-control" value="">
              </div>
            </div>
          </div>
        <?php } ?>

        <?php if($this->session->userdata('BoutiqueID') == 33){?>
          <div class="col-md-12">
            <div class="form-group">
                <label>Select Staff Type</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="fa-user fa"></span></span>
                  <select name="boutique_staff_type" class="form-control">
                    <option value="1">Tailor</option>
                    <option value="2">Cutting master</option>
                    <option value="3">Embroidery</option>
                    <option value="4">Attended by</option>
                  </select>
                </div>
            </div>
          </div>
        <?php } ?>

          <!-- <div class="col-md-12">
            <div class="form-group">
              <label>Phone</label>
              <div class="input-group">
                <span class="input-group-addon"><span class="fa-phone fa"></span></span>
                <input name="phone" type="text" class="form-control" value="">
              </div>
            </div>
          </div>
         
          <div class="col-md-12">
            <div class="form-group">
              <label>Address</label>
              <textarea name="address" class="form-control" rows="3"></textarea>
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