<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
       Estimate     
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
                    <span class="pull-right"><a class="btn btn-info" href="<?php echo base_url(); ?>estimattebudget/addproject">Add Project</a></span>
        
                  </div>
                  <div class="box-body">
                    <table id="workDataTable" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                            <th>Project Name</th>
                            <th>Header</th>
                            <th>Sub Header</th>
                            <th>Estimated Cost</th>
                            <th>Actual Cost</th>
                            <th>Current Paid</th>
                            <th>Amount Due</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach($projects as $projects) {?>
                    <tr>
                        <td><a href="<?php echo base_url(); ?>estimattebudget/editproject/<?php echo $projects["estimated_budget_id"]; ?>"><?php echo $projects["boutique_property_name"]; ?></a></td>
                        <td><?php echo $projects["header_name"]; ?></td>
                        <td><?php echo $projects["subheader_name"]; ?></td>
                        <td><?php echo $projects["total_cost"]; ?></td>
                        <td><?php echo $projects["actual_cost"]; ?></td>
                        <td><?php echo $projects["current_paid"]; ?></td>
                        <td><?php echo $projects["amount_due"]; ?></td>
                        <td><?php echo $projects["completed_percentage"]; ?></td>
                        <td>
                        <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this budget ?');" href="<?php echo base_url(); ?>estimattebudget/removeproject/<?php echo $projects["estimated_budget_id"]; ?>"><i class="fa fa-trash"></i></a>
                        | <a href="<?php echo base_url(); ?>estimattebudget/pdfcreation/<?php echo $projects["builder_property"]; ?>">Print budget</a></td>
                    </tr>
                   <?php } ?>

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