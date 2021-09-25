<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Expenses      
      <small>Reports</small>
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
<section class="content" style="min-height: 0px;">
  <form name="" action="<?php echo base_url(); ?>boutique/expencereport/" method="post">
    <div class="row">
        <div class="col-md-4 col-md-offset-2 col-xs-6">
            <div class="input-group">
                <span class="input-group-addon bg-light-blue"><i class="fa fa-calendar"></i></span>
                 <input type="text" name="date_from_report" class="form-control report_date" value="<?php echo @$date_from_report;?>" required>
            </div>
        </div>
        <div class="col-md-4 col-xs-6">
            <div class="input-group">
                <span class="input-group-addon bg-light-blue"><i class="fa fa-calendar"></i></span>
                 <input type="text" name="date_to_report" class="form-control report_date" value="<?php echo @$date_to_report;?>" required>
            </div>
        </div>
        <div class="col-md-2 col-xs-6">
            <div class="form-group">
                <div class="input-group">
                  <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </div>
    </div>
    </form>
    <br>
    <div class="row">
        <div class="col-sm-6">
            <div class="box box-solid">
                <div class="box-body">
                    <table class="table table-striped">
                        
                        <tr>
                            <th>Total Expense:</th>
                            <td>
                                 <span class="total_expense">
                                    <?php echo $total_expences;?>
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

    </div>
    
</section>
<!-- /.content -->


  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">All Expenses List</h3><br><br>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="exreportsdata" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>Date</th>
                        <?php  if( $this->session->userdata('UserID') == 136){
                        ?>
                        <th>Property</th>
                        <?php } ?>
                        <th>Head</th>
                        <th>Property</th>
                        <th>Amount</th>
                      </tr>
                      </thead>
                      <tbody>
                     <?php 
                      $total = count($expences);
                      // var_dump($expences);
                      for($i = 0; $i < $total; $i++) { ?>
                        <tr>
                          <td><?php echo $expences[$i]["boutique_expense_date"]; ?></td>
                          <?php 
                          if( $this->session->userdata('UserID') == 126){
                        ?>
                        <td><?php echo $this->Work_model->m_getpropertyname($expences[$i]["boutique_property"])["boutique_property_name"];
                          ?></td>
                        <?php } ?>
                          <td><?php
                          // if($expences[$i]["builder_expense_status"] == 1)
                          // {
 
                          //  $user = $this->Billing_model->getpettycashuserid($expences[$i]["boutique_billing_user_id"]);
     
                           
                          //  echo "Petty Cash ("; echo $user["boutique_user_username"]; echo " )";
                          // }
                          // else
                          // {
                          //  echo $expences[$i]["boutique_billing_head_name"];
 
                          // }
                          // echo $expences[$i]["boutique_billing_head_name"];
                           ?></td>
                          <td><?php echo $expences[$i]["boutique_expense_amount"]; ?></td>
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