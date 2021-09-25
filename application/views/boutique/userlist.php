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
                    <?php if($this->session->userdata('UserRole') == 2){?>
                    <span class="pull-right"><a class="btn btn-info" href="<?php echo base_url(); ?>boutique/adduser">Add User</a></span>
                    <?php } ?>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="example2" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>User Name</th>
                        <th>User Role</th>
                        <th>Actions</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php 
                      $total = count($userlist);
                      for($i = 0; $i < $total; $i++) { ?>
                        <tr>
                          <td><?php echo $userlist[$i]["boutique_user_username"]; ?></td>
        <!-- <a href="<?php echo base_url(); ?>boutique/userdetails/<?php echo $userlist[$i]["boutique_user_id"]; ?>">f</a> -->
                           <td>
                             <?php if($userlist[$i]["boutique_user_role"] == 4){?>
                              Supervisor
                             <?php }?>
                              <?php if($userlist[$i]["boutique_user_role"] == 5){?>
                              Office
                             <?php }?>
                              <?php if($userlist[$i]["boutique_user_role"] == 6){?>
                                Purchase
                             <?php }?>
                             <?php if($userlist[$i]["boutique_user_role"] == 7){?>
                              Accounts
                             <?php }?>
                            <?php if($userlist[$i]["boutique_user_role"] == 3){?>
                              Others
                             <?php }?>
                            </td>
                          <td>
                            <?php if($this->session->userdata('UserRole') == 2){?>
                            <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?');" href="<?php echo base_url(); ?>boutique/removeuser/<?php echo $userlist[$i]["boutique_user_id"]; ?>"><i class="fa fa-trash"></i></a>
                            <?php } ?>
                          </td>
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