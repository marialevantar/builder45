  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Drills & Skills
        <small>Profile</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-6 col-xs-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Update Profile</h3>
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
            </div><!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="<?php echo base_url(); ?>dashboard/updateprofile" id="profile_update">
              <div class="box-body">

                <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input type="text" class="form-control" name="useremail" id="useremail" value="<?php echo $userdata['UserEmail']; ?>" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Old Password</label>
                  <input type="password" class="form-control" name="oldpwd" id="oldpwd" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">New Password</label>
                  <input type="password" class="form-control" name="newpwd" id="newpwd">
                </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary" id="profile-submit">Update</button>
              </div>
            </form>
          </div><!-- /.box -->
        </div>
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <!-- /.row (main row) -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
