<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Add Task
      <small>Gantt Chart</small>
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
    <form id="addcustomer" method="post" action="<?php echo base_url(); ?>Gantchartbuilders/savechartdetails/">
      <div class="box-header with-border">
        <h3 class="box-title">chart Details</h3>
         <span class="pull-right"><a class="btn btn-info" href="<?php echo @$backlink; ?>">
        Back</a></span> 
      </div>
      <br>
      <div class="box-body">
        <div class="row">

        <div class="col-md-12">
            <div class="form-group">
              <label>Task</label>
              <input name="builder_task" type="text" class="form-control" value="">
            </div>
          </div>
          <!-- <div class="col-md-12">
            <div class="form-group">
              <label>Assignee</label>
              <input name="builder_asignee" type="text" class="form-control" value="">
            </div>
          </div>   -->
        <div class="col-md-12">
            <div class="form-group">
              <label>Starting Date</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input name="starting_date" type="text" class="form-control pull-right" id="datepicker">
                
                <!-- <input name="starting_date" type="datetime-local" class="form-control pull-right"> -->
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Ending Date</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input name="ending_date" type="text" class="form-control pull-right" id="datepicker1">
         
                <!-- <input name="ending_date" type="datetime-local" class="form-control pull-right"> -->
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
                <label>Select Project</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="fa-user fa"></span></span>
                  <select name="project_id" class="form-control">
                    <option value="">Select Project</option>
                    <?php
                        foreach($properties as $pro)
                        {
                    ?>
                        <option value="<?php echo $pro["boutique_property_id"]; ?>"><?php echo $pro["boutique_property_name"]; ?></option>
                    <?php
                        }
                    ?>
                  </select>
                </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
                <label>Select Predecessor</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="fa-user fa"></span></span>
                  <select name="predecessor_id" class="form-control">
                    <option value="">Select Predecessor</option>
                    <?php
                        foreach($tasks as $task)
                        {
                    ?>
                        <option value="<?php echo $task["builders_task_id"]; ?>"><?php echo $task["builders_task_name"]; ?></option>
                    <?php
                        }
                    ?>
                  </select>
                </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
                <label>Select Successor</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="fa-user fa"></span></span>
                  <select name="successor_id" class="form-control">
                    <option value="">Select Successor</option>
                    <?php
                        foreach($tasks as $task)
                        {
                    ?>
                        <option value="<?php echo $task["builders_task_id"]; ?>"><?php echo $task["builders_task_name"]; ?></option>
                    <?php
                        }
                    ?>
                  </select>
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