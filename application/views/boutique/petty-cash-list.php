<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Petty cash      
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
                    <!-- recieved_petty_hand -->
                    <br>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="example3" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Type</th>
                        <th>Description</th>
                      <!--  <th>Details</th> -->
                      </tr>
                      </thead>
                      <tbody>
                          <?php 
                            foreach($pettycashlist as $petty)
                            {
                                ?>
                                    <tr>
                                        <td><?php echo $petty["boutique_expense_date"]; ?></td>
                                        <td><?php echo $petty["boutique_expense_amount"]; ?></td>
                                        <td><?php echo $petty["boutique_expense_pay_type"]; ?></td>
                                        <td><?php echo $petty["boutique_expense_details"]; ?></td>
                     
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