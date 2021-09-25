<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Profit      
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
<section class="content">
   <form name="" action="<?php echo base_url(); ?>billing/profitreport/" method="post">
    <div class="row">
        <div class="col-md-4 col-md-offset-2 col-xs-6">
            <div class="input-group">
                <span class="input-group-addon bg-light-blue"><i class="fa fa-calendar"></i></span>
                 <input type="text" name="date_from_report" class="form-control report_date" value="<?php echo @$data["date_from_report"];?>" required>
            </div>
        </div>
        <div class="col-md-4 col-xs-6">
            <div class="input-group">
                <span class="input-group-addon bg-light-blue"><i class="fa fa-calendar"></i></span>
                 <input type="text" name="date_to_report" class="form-control report_date" value="<?php echo @$data["date_to_report"];?>" required>
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
                                     <?php 
                                     
                                     $total_expences = $data["total_expences"];
                                     
                                     echo $total_expences;
                                     ?>
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="box box-solid">
                <div class="box-body">
                    <table class="table table-striped">
                        
                        <tr>
                            <th>Total Income:</th>
                            <td>
                                 <span class="total_sell">
                                  <?php 
                                  
                                  $total_sale = $data["total_sale"];
                                  
                                  echo $total_sale;?>
                                </span>
                            </td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-solid">
                <div class="box-body">
                    <h3 class="text-muted">
                        Net Profit: 
                        <span class="net_profit">
                            <?php 
                            $net =  $total_sale - $total_expences;
                            echo $net;
                            ?>
                        </span>
                    </h3>
                </div>
            </div>
        </div>
    </div>
  

</section>
<!-- /.content -->
<section class="content">
    <div class="row">
      <div class="col-xs-12">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">Opening Balance = &#x20b9; 10000</h3><br><br> 
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="balancesheet" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>Date</th>
                        <th>Income</th>
                        <th>Head</th>
                        <th>Property</th>
                        <th>Expense</th>
                        <th>Head</th>
                        <th>Property</th>
                        <th>Cash in Hand</th>
                        <th>Cash in Bank</th>
                        <th>Balance</th>
                      </tr>
                      </thead>
                      <tbody>
                 <?php 
                 
                 foreach($list as $value){
                   
                   ?>
                        <tr>
                        <td><?php  echo $value['date']; ?></td>
                 <td><?php  echo $value['sales']; ?></td>
                 
                 <td><?php  echo $value['headincome']; ?></td>
                 <td><?php  echo $value['propertyincome']; ?></td>
                 
                 <td><?php  echo $value['expence']; ?></td>
                 <td><?php  echo $value['head']; ?></td>
                 <td><?php  echo $value['expenseincome']; ?></td>
                 
                 <td><?php  echo $value['handbalance']; ?></td>
                 <td><?php  echo $value['bankbalance']; ?></td>
                
                 <td><?php  echo $value['balance']; ?></td>
                    </tr>
                      <?php 
                      }
                       ?>
                      </tbody>
                    </table>
                    
                  </div>
                  <!-- /.box-body display:none;-->
                </div>
                <!-- /.box -->
              </div>
              <!-- /.col -->
    </div>
    <!-- /.row (main row) -->
  </section>
  

  
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