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
<?php //print_r($boutiqueadmin);?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit
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

  <!-- Main content -->
  <section class="content">
  <div class="box box-info">
    <form id="updateBoutique" method="post" action="<?php echo base_url(); ?>admin/updateboutiquedetails/<?php echo @$boutiquedetails['boutique_id']; ?>"  enctype="multipart/form-data">
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
              <input type="text" name="boutiqueName" class="form-control" value="<?php echo @$boutiquedetails['boutique_name']; ?>">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Contact Name</label>
              <input name="contactName" type="text" class="form-control" value="<?php echo @$boutiquedetails['boutique_contact_name']; ?>">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Email</label>
              <div class="input-group">
                <span class="input-group-addon"><span class="fa-envelope fa"></span></span>
                <input type="text" name="email" class="form-control" value="<?php echo @$boutiquedetails['boutique_email']; ?>">
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Phone</label>
              <div class="input-group">
                <span class="input-group-addon"><span class="fa-phone fa"></span></span>
                <input name="phone" type="text" class="form-control" value="<?php echo @$boutiquedetails['boutique_ph']; ?>">
              </div>
            </div>
          </div>
         
          <div class="col-md-12">
            <div class="form-group">
              <label>Tag Line</label>
              <input name="tagline" type="text" class="form-control" value="<?php echo @$boutiquedetails['boutique_tagline']; ?>">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Description</label>
              <textarea name="description" class="form-control" rows="3"><?php echo @$boutiquedetails['boutique_desc']; ?></textarea>
            </div>
          </div>
           <div class="col-md-12">
            <div class="form-group">
              <label>City</label>
              <input name="city" type="text" class="form-control" value="<?php echo @$boutiquedetails['boutique_city']; ?>">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>State</label>
              <input name="state" type="text" class="form-control" value="<?php echo @$boutiquedetails['boutique_state']; ?>">
            </div>
           </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Address</label>
              <input name="address" type="text" class="form-control" value="<?php echo @$boutiquedetails['boutique_address']; ?>">
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Logo</label>
              <input type="file" id="boutique_logo" name="boutique_logo" class="form-control">
              <img id="clothimgprev" src="../../uploads/logo/<?php echo @$boutiquedetails['boutique_logo']; ?>" alt="Photo Of Cloth" height="150" />
              <input type="hidden" id="boutique_logo_old" name="boutique_logo_old" class="form-control" value="<?php echo @$boutiquedetails['boutique_logo']; ?>">
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
                <label>Enable Billing</label>
                  <select name="boutique_billing_status" class="form-control">
                    <option value="0">Select Status</option>
                    <option value="1" <?php if($boutiquedetails['boutique_billing_status'] == 1){ echo 'selected="selected"';} ?>>Enable</option>
                    <option value="0" <?php if($boutiquedetails['boutique_billing_status'] == 0){ echo 'selected="selected"';} ?>>Disable</option>
                  </select>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
                <label>Enable Stitching</label>
                  <select name="boutique_stitching_status" class="form-control">
                    <option value="1" <?php if($boutiquedetails['boutique_stitching_status'] == 1){ echo 'selected="selected"';} ?>>Enable</option>
                    <option value="0" <?php if($boutiquedetails['boutique_stitching_status'] == 0){ echo 'selected="selected"';} ?>>Disable</option>
                  </select>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
                <label>Enable Whatsapp Message</label>
                  <select name="boutique_whatsapp_msg_status" class="form-control">
                    <option value="1"  <?php if($boutiquedetails['boutique_whatsapp_msg_status'] == 1){ echo 'selected="selected"';} ?>>Enable</option>
                    <option value="0"  <?php if($boutiquedetails['boutique_whatsapp_msg_status'] == 0){ echo 'selected="selected"';} ?>>Disable</option>
                  </select>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
                <label>Enable SMS Message</label>
                  <select name="boutique_sms_msg_status" class="form-control">
                    <option value="1"  <?php if($boutiquedetails['boutique_sms_msg_status'] == 1){ echo 'selected="selected"';} ?>>Enable</option>
                    <option value="0"  <?php if($boutiquedetails['boutique_sms_msg_status'] == 0){ echo 'selected="selected"';} ?>>Disable</option>
                  </select>
            </div>
          </div>
            <!-- Select multiple-->
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
          
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <input type="hidden" name="boutique_id" value="<?php echo @$boutiquedetails['boutique_id']; ?>">
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>

  <!-- Update password-->
<div class="box box-info">
  <form name="pwdupdate" id="pwdupdate" method="post" action="#" data-toggle="validator" role="form">
    <div class="box-header with-border">
      <h3 class="box-title">Admin Login</h3>
    </div>
    <div class="box-body">
      <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>UserName</label>
              <input type="text" name="name" class="form-control" value="<?php echo @$boutiqueadmin['boutique_user_username']; ?>" disabled>
            </div>
          </div>

        <div class="col-md-12">
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label>Confirm Password</label>
            <input name="confirmpassword" type="password" class="form-control" data-match="#inputPassword" data-match-error="Whoops, these don't match" required>
          </div>
        </div>
      </div>
    </div>
    <div class="box-footer">
      <input type="hidden" name="boutique_admin_id" id="" value="<?php echo @$boutiqueadmin['boutique_user_id']; ?>"/>
      <button type="submit" class="btn btn-primary">Update</button>
      <div id="errorMsgpwd" style="color:#000;"></div>
    </div>
  </form>
</div>
<!-- Update password-->

  <!-- Update password-->
<div class="box box-info">
  <form name="pwdupdateTailor" id="pwdupdateTailor" method="post" action="#" data-toggle="validator" role="form">
    <div class="box-header with-border">
      <h3 class="box-title">Tailor Login</h3>
    </div>
    <div class="box-body">
      <div class="row">

        <div class="col-md-12">
            <div class="form-group">
              <label>UserName</label>
              <input type="text" name="name" class="form-control" value="<?php echo @$boutiquetailor['boutique_user_username']; ?>" disabled>
            </div>
          </div>

        <div class="col-md-12">
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label>Confirm Password</label>
            <input name="confirmpassword" type="password" class="form-control" data-match="#inputPassword" data-match-error="Whoops, these don't match" required>
          </div>
        </div>
      </div>
    </div>
    <div class="box-footer">
      <input type="hidden" name="boutique_tailor_id" id="boutique_tailor_id" value="<?php echo @$boutiquetailor['boutique_user_id']; ?>"/>
      <button type="submit" class="btn btn-primary">Update</button>
      <div id="errorMsgtpwd" style="color:#000;"></div>
    </div>
  </form>
</div>
<!-- Update password-->

    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this team?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <a class="btn btn-danger btn-ok">Delete</a>
      </div>
    </div>
  </div>
</div>


<script>

</script>