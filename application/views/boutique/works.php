<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Rent      
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
                    <span class="pull-right"><a class="btn btn-info" href="<?php echo base_url(); ?>boutique/orders/">Back</a></span><span class="pull-right">&nbsp;&nbsp;</span>
                    <span class="pull-right"><a class="btn btn-info" href="<?php echo base_url(); ?>boutique/addwork/">Add Rent</a></span>
                    <!-- <span class="pull-right"><a class="btn btn-info" href="<?php echo base_url(); ?>boutique/addwork/0/<?php echo $orderid;?>">Add Work</a></span> -->
        
                  </div>
                  <div class="box-body">
                    <table id="workDataTable" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>Tenant</th>
                        <?php 
                          if( $this->session->userdata('UserID') == 136){
                        ?>
                        <th>Property</th>
                        <th>Image</th>
                        <?php } ?>
                        <th>Price</th>
                        <th>Due Date</th>
                        <th>Remove</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php 
                      $total = count($works);
                      for($i = 0; $i < $total; $i++){
                        ?>
                        <tr>
                          <td>
                          <a href="<?php echo base_url(); ?>boutique/workdetails/<?php echo $works[$i]["boutique_work_id"]; ?>"> <?php echo $this->Work_model->m_getcustomername($works[$i]["boutique_customer_id"])["boutique_customer_name"];
                          ?> </a>
                          </td>
                           <?php 
                          if( $this->session->userdata('UserID') == 136){
                        ?>
                        <td><?php echo $this->Work_model->m_getpropertyname($works[$i]["boutique_property"])["boutique_property_name"];
                          ?></td>
                           <td><?php if($works[$i]['boutique_work_image']&&$works[$i]['boutique_work_image']!="") {?><a target="_blank" href="<?php echo base_url();?>uploads/work/<?php echo $works[$i]['boutique_work_image']; ?>"><img width="100" height="100" src="<?php echo base_url();?>uploads/work/<?php echo $works[$i]['boutique_work_image']; ?>"></a> <?php } else {  echo "No image";}?>
                          </td>
                        <?php } ?>
                          <td> <?php echo $works[$i]["boutique_work_price"]; ?> </td>
                          <td> <?php echo $works[$i]["boutique_work_due_date"]; ?> </td>      
                          <td><a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this work?');" href="<?php echo base_url(); ?>boutique/removework/<?php echo $works[$i]["boutique_work_id"]; ?>"><i class="fa fa-trash"></i></a></td>
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
    <div class="row">
      <div class="col-xs-12">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">Order Payment History</h3><br><br>
                    <span class="pull-right"><a class="btn btn-info" href="<?php echo base_url(); ?>boutique/orders/">Back</a></span><span class="pull-right">&nbsp;&nbsp;</span>
                    <?php if(@$payments[0]['boutique_order_amtpaid'] >= @$payments[0]['boutique_order_grandtotal']){?>
                    <?php }
                      else{
                        ?>
                    <span class="pull-right"><a class="btn btn-info" href="<?php echo base_url(); ?>boutique/addpayment/<?php echo $orderid;?>">Add Payment</a></span>
                    <?php
                      }
                     ?>
                    <span>Order Total : <?php print_r(@$payments[0]['boutique_order_grandtotal']);?></span> <span> | </span> <span>Amount Paid : <?php print_r(@$payments[0]['boutique_order_amtpaid']);?></span> <span> | </span> <span>Balance Amount : <?php print_r(@$payments[0]['boutique_order_grandtotal'] - @$payments[0]['boutique_order_amtpaid']);?></span>
        
                  </div>
                  <div class="box-body">
                    <table id="workDataTable2" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>Amount Paid</th>
                        <th>Payment Date</th>
                        <th>Payment Desc</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php 
                      $total = count($payments);
                      for($i = 0; $i < $total; $i++){
                        ?>
                        <tr>
                          <td> <?php echo $payments[$i]["boutique_order_paymentamt"]; ?> </td>
                          <td> <?php echo $payments[$i]["boutique_order_paid_date"]; ?> </td>
                          <td> <?php echo $payments[$i]["boutique_order_paymentdesc"]; ?> </td>
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