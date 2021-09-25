<?php 
$stat = $this->session->userdata('filter');
if($stat == "rejected"):
  $backlink = base_url()."admin/boutiques";
elseif($stat == "new"):
  $backlink = base_url()."admin/boutiques";
elseif($stat == "active"):
  $backlink = base_url()."admin/boutiques";
else:
  $backlink = base_url()."admin/boutiques";
endif;
 ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Add
      <small>Boutique</small>
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
  <?php //print_r( $this->session->flashdata('lolwut')); ?>
  <?php if($this->session->flashdata('lolwut')){
          $boutiquedetails  = $this->session->flashdata('lolwut');
  }

  ?>
  <!-- Main content -->
  <section class="content">
  <div class="box box-info">
    <form id="addBoutique" method="post" action="<?php echo base_url(); ?>admin/saveboutique" enctype="multipart/form-data">
      <div class="box-header with-border">
        <h3 class="box-title">Boutique Details</h3>
        <span class="pull-right"><a class="btn btn-info" href="<?php echo @$backlink; ?>">

        Back</a></span>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Boutique Name</label>
              <input type="text" name="boutiqueName" class="form-control" value="<?php echo @$boutiquedetails['boutiqueName']; ?>">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Contact Name</label>
              <input name="contactName" type="text" class="form-control" value="<?php echo @$boutiquedetails['contactName']; ?>">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Email</label>
              <div class="input-group">
                <span class="input-group-addon"><span class="fa-envelope fa"></span></span>
                <input type="text" name="email" class="form-control" value="<?php echo @$boutiquedetails['email']; ?>">
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Phone</label>
              <div class="input-group">
                <span class="input-group-addon"><span class="fa-phone fa"></span></span>
                <input name="phone" type="text" class="form-control" value="<?php echo @$boutiquedetails['phone']; ?>">
              </div>
            </div>
          </div>
         
          <div class="col-md-12">
            <div class="form-group">
              <label>Tag Line</label>
              <input name="tagline" type="text" class="form-control" value="<?php echo @$boutiquedetails['tagline']; ?>">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Description</label>
              <textarea name="description" class="form-control" rows="3"><?php echo @$boutiquedetails['description']; ?></textarea>
            </div>
          </div>
           <div class="col-md-12">
            <div class="form-group">
              <label>City</label>
              <input name="city" type="text" class="form-control" value="<?php echo @$boutiquedetails['city']; ?>">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>State</label>
              <input name="state" type="text" class="form-control" value="<?php echo @$boutiquedetails['state']; ?>">
            </div>
           </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Address</label>
              <input name="address" type="text" class="form-control" value="<?php echo @$boutiquedetails['address']; ?>">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Logo</label>
              <input type="file" id="boutique_logo" name="boutique_logo" class="form-control">
              <img id="clothimgprev" src="#" alt="Photo Of Cloth" height="150" style="display: none;" />
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
                <label>Enable Billing</label>
                  <select name="boutique_billing_status" class="form-control">
                    <option value="0">Select Status</option>
                    <option value="1">Enable</option>
                    <option value="0">Disable</option>
                  </select>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
                <label>Enable Stitching</label>
                  <select name="boutique_stitching_status" class="form-control">
                    <option value="1">Enable</option>
                    <option value="0">Disable</option>
                  </select>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
                <label>Enable Whatsapp Message</label>
                  <select name="boutique_whatsapp_msg_status" class="form-control">
                    <option value="0">Select Status</option>
                    <option value="1">Enable</option>
                    <option value="0">Disable</option>
                  </select>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
                <label>Enable SMS Message</label>
                  <select name="boutique_sms_msg_status" class="form-control">
                    <option value="0">Select Status</option>
                    <option value="1">Enable</option>
                    <option value="0">Disable</option>
                  </select>
            </div>
          </div>
          <!--
            <div class="col-md-12">
            <div class="form-group">
              <label>Logo Image</label>
              <input type="file" id="logoimg" class="form-control">
            </div>
           </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Background Image</label>
              <input type="file" id="bgimg" class="form-control">
            </div>
          </div>
        -->

          <!-- admin section -->

		  <div class="col-md-12">
            <div class="form-group">
              <label>Admin UserName</label>
              <input type="text" name="adminusername" class="form-control" value="<?php echo @$boutiquedetails['adminusername'] ?>">
            </div>
          </div>

        <div class="col-md-12">
          <div class="form-group">
            <label>Admin Password</label>
            <input type="password" name="adminpassword" class="form-control" required>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label>Admin Confirm Password</label>
            <input name="adminconfirmpassword" type="password" class="form-control" data-match="#inputPassword" data-match-error="Whoops, these don't match" required>
          </div>
        </div>

        <!-- admin section -->

          <!-- admin section -->

		  <div class="col-md-12">
            <div class="form-group">
              <label>Tailor UserName</label>
              <input type="text" name="tailorusername" class="form-control" value="<?php echo @$boutiquedetails['tailorusername']; ?>" required>
            </div>
          </div>

        <div class="col-md-12">
          <div class="form-group">
            <label>Tailor Password</label>
            <input type="password" name="tailorpassword" class="form-control" required>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label>Tailor Confirm Password</label>
            <input name="tailorconfirmpassword" type="password" class="form-control" data-match="#inputPassword" data-match-error="Whoops, these don't match" required>
          </div>
        </div>

        <!-- admin section -->

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