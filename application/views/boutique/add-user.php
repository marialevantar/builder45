<?php 
$stat = $this->session->userdata('filter');
if($stat == "rejected"):
  $backlink = base_url()."boutique/userlist";
elseif($stat == "new"):
  $backlink = base_url()."boutique/userlist";
elseif($stat == "active"):
  $backlink = base_url()."boutique/userlist";
else:
  $backlink = base_url()."boutique/userlist";
endif;
 ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Add
      <small>User</small>
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

  <?php if($this->session->flashdata('lolwut')){
      $userdetails  = $this->session->flashdata('lolwut');
  }
  else{
      $userdetails  = array();
  }
  ?>

  <!-- Main content -->
  <section class="content">
  <div class="box box-info">
    <form enctype="multipart/form-data" id="addcustomer" method="post" action="<?php echo base_url(); ?>boutique/saveuser/">
      <div class="box-header with-border">
        <h3 class="box-title">User Details</h3>
        <span class="pull-right"><a class="btn btn-info" href="<?php echo @$backlink; ?>">
        Back</a></span>
      </div>
      <div class="box-body">
        <div class="row">

       
          
          <div class="col-md-12">
            <div class="form-group">
              <label>UserName</label>
              <input type="text" name="userusername" class="form-control"  value="<?php echo @$userdetails['userusername']; ?>" required>
            </div>
          </div>

        <div class="col-md-12">
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="userpassword" class="form-control" required>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label>Confirm Password</label>
            <input name="userconfirmpassword" type="password" class="form-control" data-match="#inputPassword" data-match-error="Whoops, these don't match" required>
          </div>
        </div>

          <div class="col-md-12">
            <div class="form-group">
                <label>User Role</label>
                  <select name="boutique_user_role" class="form-control" id="boutique_user_role">
                    <option value="4" <?php if(@$userdetails['boutique_user_role'] == 4){ echo "selected='selected'";}?>>Supervisor</option>
                    <option value="5" selected>Office</option>
                    <!-- <option value="6" <?php if(@$userdetails['boutique_user_role'] == 6){ echo "selected='selected'";}?>>Purchase</option>
                    <option value="7" <?php if(@$userdetails['boutique_user_role'] == 7){ echo "selected='selected'";}?>>Accounts</option>

                    <option value="3" <?php if(@$userdetails['boutique_user_role'] == 3){ echo "selected='selected'";}?>>Others</option> -->
           
                  </select>
            </div>
          </div>

          <div class="col-md-12" id="image_upload_user" style="display: none;">
            <div class="form-group">
                <label>Image</label>
                <input type="file" id="clothimg" name="clothimg" class="form-control">
              <img id="clothimgprev" src="#" alt="image" height="80" style="display: none;" />
           </div>
          </div>
          
          <div class="col-md-12">
            <div class="form-group">
                <label>Select Property</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="fa-user fa"></span></span>
                  <select name="property_id" class="form-control">
                    <option value="">Select Property</option>


                  <?php
                 
                  foreach($properties as $pro)
                  // for($i=0; $i<count($properties);$i++) 
                  {
                   ?>
                    <option value="<?php echo $pro['boutique_property_id']; ?>">
<!--  <?php if($pro['boutique_property_id']==$expences['boutique_property']) echo 'selected'; ?> -->
                    <?php echo $pro['boutique_property_name']; ?>
                    </option>
                  <?php } ?>
                  </select>
                </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Phone</label>
              <div class="input-group">
                <span class="input-group-addon"><span class="fa-phone fa"></span></span>
    <input name="phone" type="text" class="form-control" id="phone_validate"  value="<?php echo @$userdetails['phone']; ?>" required>
              </div>
              <span id="errorPhMsg" style="color:orange;"></span>
            </div>
          </div>
         
          <div class="col-md-12">
            <div class="form-group">
              <label>Email</label>
              <div class="input-group">
                <span class="input-group-addon"><span class="fa-envelope fa"></span></span>
                <input name="email" type="text" class="form-control" id="email_validate"  value="<?php echo @$userdetails['email']; ?>">
              </div>
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