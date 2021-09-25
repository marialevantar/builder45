<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Staff Type  
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
                    <h3 class="box-title">List</h3><br>
                    <span class="pull-right"><a class="btn btn-info" href="<?php echo base_url(); ?>boutique/addstafftype">Add Staff Type</a></span>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="example2" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>Staff Type</th>
                        <th>Status</th>
                        <th>Remove</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php
                      $total = count($stafftype);
                      for($i = 0; $i < $total; $i++){ ?>
                      <tr>
                        <td><a href="<?php echo base_url(); ?>boutique/stafftypedetails/<?php echo $stafftype[$i]["boutique_work_staff_type_id"]; ?>">
                        <?php echo $stafftype[$i]["boutique_work_staff_type_name"]; ?> </a></td>
                        <td> <?php if($stafftype[$i]["status"]==1)
                        {
                          echo"Active";
                        } 
                        else
                        {
                          echo "In Active";
                        }
                       
                       
                       ?></td> 
                        <td><a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this Staff Type?');" href="<?php echo base_url(); ?>boutique/removestafftype/<?php echo $stafftype[$i]["boutique_work_staff_type_id"]; ?>"><i class="fa fa-trash"></i></a></td>
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