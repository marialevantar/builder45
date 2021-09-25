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
                    <span class="pull-right"><a class="btn btn-info" href="<?php echo base_url(); ?>Gantchartbuilders/addchartcontent/">Add Task</a></span>
        
                  </div>
                  <div class="box-body">
                    <table id="workDataTable" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <!-- <th>Task Name</th> -->
                        <th>Starting Date</th>
                        <th>Ending Date</th>
                        <th>Consignee</th>
                        <th>Project Name</th>
                        <th>Action</th>  
                    </tr>
                      </thead>
                      <tbody>
                        <?php
                            foreach($tasks as $task)
                            {
                        ?>
                            <tr>
                                <!-- <td><?php echo $task["builders_task_name"] ?></td> -->
                                <td><?php echo $task["builders_start_date"] ?></td>
                                <td><?php echo $task["builders_end_date"] ?></td>
                                <td><?php echo $task["builders_asignee_name"] ?></td>
                                <td><?php echo $task["boutique_property_name"] ?></td>
                                <!-- <td><?php echo $task["builders_task_id"] ?></td> -->
                                <td><a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this work?');" href="<?php echo base_url(); ?>Gantchartbuilders/removetask/<?php echo $task["builders_task_id"] ?>"><i class="fa fa-trash"></i></a></td>
              
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
  </section>
  <!-- /.content -->
</div>
