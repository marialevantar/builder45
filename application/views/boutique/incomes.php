<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Income      
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
                        <th>Date</th>
                        <th>Head</th>
                        <th>Project</th>
                        <th>Description</th>

                        <th>Amount</th>
                          <?php if($this->session->userdata('UserID') !=118) {?>  <th>Actions</th> <?php }?>
                      </tr>
                      </thead>
                      <tbody>
                     <?php 
                      $total = count($expences);
                      for($i = 0; $i < $total; $i++) { ?>
                        <tr>
                        <?php if($this->session->userdata('UserID') !=118) {?>
                          <td><a href="<?php echo base_url(); ?>boutique/incomedetails/<?php echo $expences[$i]["boutique_expense_id"]; ?>"><?php echo $expences[$i]["boutique_expense_date"]; ?></a></td>
                        <?php }else { ?>
                          <td><?php echo $expences[$i]["boutique_expense_date"]; ?></td>
                        <?php } ?>
                        
                          <td><?php echo $expences[$i]["boutique_billing_head_name"]; ?></td>
                          
                          <td><?php echo $expences[$i]["boutique_property_name"]; ?></td>
                          
                          <td><?php echo $expences[$i]["boutique_expense_details"]; ?></td>
                        
                          <td><?php echo $expences[$i]["boutique_expense_amount"]; ?></td>
                          <?php if($this->session->userdata('UserID') !=118) {?> <td>
                            <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this expence ?');" href="<?php echo base_url(); ?>billing/removeincome/<?php echo $expences[$i]["boutique_expense_id"]; ?>"><i class="fa fa-trash"></i></a>
                          
                            <a class="btn btn-sm btn-success" href="<?php echo base_url(); ?>boutique/print_income_bill/<?php echo $expences[$i]["boutique_expense_id"]; ?>" target="_blank"><i class="fa fa-print"></i></a>
                          
                          </td> <?php } ?>
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