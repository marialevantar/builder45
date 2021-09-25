<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Userlist      
      <small>List</small>
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
    <div class="row">
      <div class="col-xs-12">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">List</h3><br><br>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="example2" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                          <th width="15%"></th>
                        <th>User Name</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php 
                      $total = count($userlist);
                      for($i = 0; $i < $total; $i++) { ?>
                        <tr>
                        <td><?php if($userlist[$i]["builder_user_image"]&&$userlist[$i]["builder_user_image"]!="") {?><a target="_blank" href="<?php echo base_url();?>uploads/work/<?php echo $userlist[$i]["builder_user_image"]; ?>"><img width="100" height="100" src="<?php echo base_url();?>uploads/work/<?php echo $userlist[$i]["builder_user_image"]; ?>"></a> <?php } else {  echo "No image";}?>
                        <td><a href="<?php echo base_url(); ?>boutique/userprojectdetails/<?php echo $userlist[$i]["boutique_user_id"]; ?>"><?php echo $userlist[$i]["boutique_user_username"]; ?></a></td>
                        </tr>
                      <?php 
                      }
                       ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
              <!-- /.col -->
    </div>
    <!-- /.row (main row) -->
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