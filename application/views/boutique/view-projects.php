<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Task      
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
  <?php if($this->session->userdata('UserID') !=118) {?>  <span class="pull-right"></span> <?php }?>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="example2" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>Sl No</th>
                        <th>Scheduled Date</th>
                        <th>Scheduled Person</th>
                        <th>Planned Work</th>
                        <th>Project</th>
                        <th>Actual Work Done</th>
                        <th>Remarks</th>
                        <th>Comments</th>
                      </tr>
                      </thead>
                      <tbody>
                     <?php 
                      $total = count($listschedulework);
                      foreach($projects as $listschedulework ){ ?>
                        <tr style="background-color:<?php if($listschedulework["builder_work_status"]== 0 ){ echo "#fc5959"; } elseif($listschedulework["builder_work_status"] == 1){ echo "#EAFC47";  }else { echo "#53FC47"; } ?>;">

                       <td><a style="color:blue" href="<?php echo base_url(); ?>boutique/updatescheduledwork/<?php echo $listschedulework["schedule_work_id"]; ?>"><?php echo $i+1; ?></a></td>
                          
                          <td><a style="color:blue" href="<?php echo base_url(); ?>boutique/updatescheduledwork/<?php echo $listschedulework["schedule_work_id"]; ?>"><?php echo $listschedulework["schedule_work_date"]; ?></a></td>

                          <td><?php echo $listschedulework["scheduled_work_builders_asignee"]; ?></td>

                          <td><?php echo $listschedulework["sceduled_work_planned"]; ?></td>
                          
                          <td><a style="color:blue" href="<?php echo base_url(); ?>boutique/updatescheduledwork/<?php echo $listschedulework["schedule_work_id"]; ?>"><?php echo $listschedulework["boutique_property_name"]; ?></a></td>
                        
                          <td><?php echo $listschedulework["schedule_work_actualwork"]; ?></td>
                          
                          <td><?php echo $listschedulework["schedule_work_task"]; ?></td>
                          <td><?php echo $listschedulework["scheduled_work_builders_comments"]; ?></td>
                          
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