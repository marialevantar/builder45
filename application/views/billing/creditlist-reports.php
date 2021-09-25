<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Credit List      
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
  <form name="" action="<?php echo base_url(); ?>billing/creditlistreport/" method="post">
 
<!-- Main content -->
<section class="content" style="min-height: 0px;">
    <div class="row">
        <div class="col-md-4 col-md-offset-2 col-xs-6">
            <div class="input-group">
                <span class="input-group-addon bg-light-blue"><i class="fa fa-calendar"></i></span>
                 <input type="text" name="date_from_report" class="form-control report_date" value="<?php echo @$date_from_report;?>">
            </div>
        </div>
        <div class="col-md-4 col-xs-6">
            <div class="input-group">
                <span class="input-group-addon bg-light-blue"><i class="fa fa-calendar"></i></span>
                 <input type="text" name="date_to_report" class="form-control report_date" value="<?php echo @$date_to_report;?>">
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
    <br>
    <div class="row">
        <div class="col-sm-4">
            <div class="box box-solid">
                <div class="box-body">
                    <table class="table table-striped">
                        
                        <tr>
                            <th>Credit Amount ( Total ):</th>
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
        <div class="col-sm-4">
            <div class="box box-solid">
                <div class="box-body">
                    <table class="table table-striped">
                        
                        <tr>
                            <th>Credit Amount ( Paid ):</th>
                            <td>
                                 <span class="total_paid">
                                    <?php echo $total_paid;?>
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="box box-solid">
                <div class="box-body">
                    <table class="table table-striped">
                        
                        <tr>
                            <th>Credit Paid ( To be Paid ):</th>
                            <td>
                                 <span class="total_balance">
                                    <?php echo $total_balance;?>
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
                    <h3 class="box-title">All Credit List</h3><br><br>
                  </div>
                  
                  
                  <div class="box-header with-border">
                  <div class="col-sm-5">  
                  </div>
       
                  <div class="col-sm-3">  
<!-- vendor -->
          <select name="vendor_name"  class="form-control">
                  <option value="0">Select Vendor</option>
                    <?php foreach($vendor as $vendor) {?>
                      <option value="<?php echo $vendor["b_boutique_vendor_id"]; ?>" ><?php echo $vendor["b_boutique_vendor_name"]; ?></option>
                    <?php } ?>
                  </select>       

                  </div>
        <div class="col-sm-3">  
                <select name="property_name"  class="form-control">
                  <option value="0">Select Property</option>
                    <?php foreach($properties as $properties) {?>
                      <option value="<?php echo $properties["boutique_property_id"]; ?>" <?php if($this->uri->segment(4)){ if($this->uri->segment(4)==$properties["boutique_property_id"]){ echo "selected"; } } ?>><?php echo $properties["boutique_property_name"]; ?></option>
                    <?php } ?>
                  </select>       
        </div>      
        <div class="col-sms-1">
        <button type="submit" class="btn btn-primary">search</button>

        </div>
        <span class="pull-right">

      </span>
      </div>
     

                  <div class="box-body">
                  <hr>
                  <!-- <div  style="float: right;     margin-left: 8px;"><input type="text" class="input-sm" id='property' placeholder="Search Property" ></label></div> -->
                    <table id="exreportsdata" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>Date</th>
                            <th>Invoice No</th>
                        <th>Property</th>
                        <th>Vendor</th>
                        <th>Total Amount</th>
                        <th>Paid Amount</th>
                        <th>Balance Amount</th>
                      </tr>
                      </thead>
                      <tbody>
                     <?php 
                      $total = count($expences);
                      for($i = 0; $i < $total; $i++) { ?>
                        <tr>
                          <td><?php echo $expences[$i]["boutique_expense_date"]; ?></td>
                             <?php 
                          if( $this->session->userdata('UserID') == 126){
                        ?>
                         <td>
                              <?php echo $expences[$i]["builder_create_invoice"]; ?>
                         </td>
                         
                        
                        <?php } ?>
                  
  <td><?php echo $expences[$i]["boutique_property_name"]; ?></td>
  <td><?php echo $expences[$i]["b_boutique_vendor_name"]; ?></td>
  
  <td>
  <?php echo $expences[$i]["boutique_expense_amount"]; ?>
  </td>
  <td>
  <?php echo $expences[$i]["credit_paid_amount"]; ?>
  </td>
  <td>
  <?php echo $expences[$i]["boutique_expense_amount"]-$expences[$i]["credit_paid_amount"]; ?>
  </td>
  
                  
                        </tr>
                      <?php 
                      }
                       ?>
                      </tbody>
             <!--         <tfoot>
            <tr>
                 <th>Date</th>
                        <th>Head</th>
                        <th>Property</th>
                        <th>Description</th>
                        <th>Amount</th>
                     </tr>
        </tfoot>-->
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
  </form>
 
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

