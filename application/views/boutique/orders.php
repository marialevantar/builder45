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
  
<form name="order_filter_form" action="<?php echo base_url(); ?>boutique/orders/" method="post">
        
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">List</h3><br><br>
                    <span class="pull-right"><a class="btn btn-info" onclick="history.back()">Back</a></span><span class="pull-right">&nbsp;&nbsp;</span>
                    <?php if($this->session->userdata('UserID') !=118) { ?>
                    <span class="pull-right"><a class="btn btn-info" href="<?php echo base_url(); ?>boutique/addwork/">Add Rent</a></span>
                    <?php } ?>
                    <span class="pull-right">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <span class="pull-right"><a class="btn btn-default" id="clear_order_form">Clear</a></span>
                    <span class="pull-right">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <span class="pull-right">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    </span>
                    <span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
                    <span class="pull-right"><input type="text" class="form-control pull-right datepickercl" autocomplete="off" data-bv-field="order_date" name="end_date_order" value="<?php echo @$enddate;?>" required></span>
                     <span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
                    <span class="pull-right">End Date : </span>
                    <span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
                    <span class="pull-right"><input type="text" class="form-control pull-right datepickercl" autocomplete="off" data-bv-field="order_date" name="start_date_order" value="<?php echo @$startdate;?>" required></span>
                    <span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
                    <span class="pull-right">Start Date : </span>
                  </div>
    </form>
    
                  
                  <div class="box-body">
                    <table>
                      <tr><td width="17%">Grand Total : </td><td width="17%" class="grand_total_c"></td><td width="17%">Amount Paid : </td><td width="17%" class="amount_paid_c"></td><td width="17%">Balance To Pay : </td><td width="17%" class="bal_pay_c"></td></tr>
                      <tr></tr>
                    </table>
                  </br></br>
                    <table id="example2" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>Order Number</th>
                        <th>Receipt Number</th>
                        <th>Tenant</th>
                        <?php 
                          if( $this->session->userdata('UserID') == 136){
                        ?>
                        <th>Property</th>
                        <!--<th>Image</th>-->
                        <?php } ?>
                        <th>Grand Total</th>
                        <?php 
                          if( $this->session->userdata('BoutiqueID') == 33){
                        ?>
                         <th>Advance received</th>
                         <th>Balance to pay</th>
                        <?php
                          }
                          else{
                        ?>
                        <th>Amount Paid</th>
                        <th>Balance Amount</th>
                        <?php } ?>
                        <th>TDS</th>
                        <th>Discount </th>
                        <th>Due Date</th>
                        <!-- <th>Delivery Date</th> -->
                        <!-- <th>Trial Date</th> -->
                        <th>Payment Status</th>
                        <!-- <th>Order Status</th> -->
                        <th>Add Payment</th>  
                        <!--<th>Payment History</th>-->
                            <th>Remove</th> 
                      
                        <th></th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php 
                      $total = count($works);
                      for($i = 0; $i < $total; $i++){
                        ?>
                        <tr>
                        <?php if($this->session->userdata('UserID') !=118){  ?>
                          <td><a href="<?php echo base_url(); ?>boutique/works/<?php echo $works[$i]["boutique_order_id"]; ?>"><?php echo $works[$i]["boutique_order_number"]; ?></a> </td>
                        <?php }else {?>
                          <td><?php echo $works[$i]["boutique_order_number"]; ?></td>
                        <?php } ?>
                          
                        

                          <td><?php echo $works[$i]["boutique_order_form_number"]; ?></td>
                          <td><?php echo $works[$i]["boutique_customer_name"]; ?></td>
                        <?php 
                          if( $this->session->userdata('UserID') == 136){
                        ?>
                        <td><?php echo $this->Work_model->m_getpropertyname($works[$i]["boutique_property"])["boutique_property_name"];
                          ?></td>
                          <!-- <td><?php if($works[$i]['boutique_work_image']&&$works[$i]['boutique_work_image']!="") {?><a target="_blank" href="<?php echo base_url();?>uploads/work/<?php echo $works[$i]['boutique_work_image']; ?>"><img width="100" height="100" src="<?php echo base_url();?>uploads/work/<?php echo $works[$i]['boutique_work_image']; ?>"></a> <?php } else {  echo "No image";}?>-->
                          <!--</td>-->
                        <?php } ?>
                          <!-- <td> <?php //echo $this->Work_model->m_getcustomername($works[$i]["boutique_customer_id"])["boutique_customer_name"];
                          ?> </td>-->

                          <td>
                            <?php 
                            
                                echo $works[$i]["boutique_order_grandtotal"]-$works[$i]["b_boutique_orders_tdf"]; 
                          
                            ?> 
                          </td>
                          <td> <?php echo $works[$i]["boutique_order_amtpaid"] ?> </td>
                           
                          <td> <?php echo $works[$i]["boutique_order_grandtotal"] - $works[$i]["boutique_order_amtpaid"]-$works[$i]["b_boutique_orders_tdf"]; ?> </td>
                            <td><?php echo $works[$i]["b_boutique_orders_tdf"]; ?></td>
                              <td><?php echo $works[$i]["rent_discount"]; ?></td>
                          <td> <?php echo $works[$i]["boutique_work_due_date"]; ?> </td>
                          <!-- <td> <?php echo $works[$i]["boutique_order_delivery_date"]; ?> </td>
                          <td> <?php echo $works[$i]["boutique_trail_date"]; ?> </td> -->
                         <?php if($works[$i]['boutique_order_payment_status'] == 1){?>
                          <td><span class="label label-danger">Not Paid</span></td>
                          <?php } ?>
                          <?php if($works[$i]['boutique_order_payment_status'] == 2){?>
                          <td><span class="label label-warning">Partial Paid</span></td>
                          <?php } ?>
                          <?php if($works[$i]['boutique_order_payment_status'] == 3){?>
                          <td><span class="label label-success">Paid</span></td>
                          <?php } ?>

                          <!-- <?php if($works[$i]['boutique_order_status'] == 1){?>
                          <td><span class="label label-warning">Pending</span></td>
                          <?php } ?>
                          <?php if($works[$i]['boutique_order_status'] == 2){?>
                          <td><span class="label label-info">Processing</span></td>
                          <?php } ?>
                          <?php if($works[$i]['boutique_order_status'] == 3){?>
                          <td><span class="label label-success">Completed</span></td>
                          <?php } ?>
                          <?php if($works[$i]['boutique_order_status'] == 4){?>
                          <td><span class="label label-success">Delivered</span></td>
                          <?php } ?> -->
                          
                          <?php if($this->session->userdata('UserID') !=118){  ?>
                            <td><a  href="<?php echo base_url(); ?>boutique/addpayment/<?php echo $works[$i]["boutique_order_id"]; ?>"><span class="label label-primary">Pay</span></a></td>
                            <!--<td><a href="<?php echo base_url(); ?>boutique/works/<?php echo $works[$i]["boutique_order_id"]; ?>"><span class="label label-primary">Payment History</span></a> </td>-->
                            <td><a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this work?');" href="<?php echo base_url(); ?>boutique/removeorder/<?php echo $works[$i]["boutique_order_id"]; ?>"><i class="fa fa-trash"></i></a></td>
                          <?php }else{?>
                            <td><i class="fa fa-times-circle"></i></td>
                            <td><i class="fa fa-times-circle"></i></td>
                          <?php }?>
                           
                         
                         
                          <?php 
                          if( $this->session->userdata('BoutiqueID') == 7 || $this->session->userdata('BoutiqueID') == 12 || $this->session->userdata('BoutiqueID') == 5|| $this->session->userdata('BoutiqueID') == 8|| $this->session->userdata('BoutiqueID') == 9|| $this->session->userdata('BoutiqueID') == 10 ||$this->session->userdata('BoutiqueID') == 25 ||$this->session->userdata('BoutiqueID') == 15 ||$this->session->userdata('BoutiqueID') == 33 ||$this->session->userdata('BoutiqueID') == 35){ ?>
                          <td> <a href="<?php echo base_url(); ?>boutique/bill/<?php echo $works[$i]["boutique_order_id"]; ?>" target="_blank">View Bill</a> | 
                          <a href="<?php echo base_url(); ?>boutique/orderbill/<?php echo $works[$i]["boutique_customer_id"]; ?>/<?php echo $works[$i]["boutique_order_id"]; ?>" target="_blank">Order Form</a>
                          </td>
                          <?php }
                          elseif($this->session->userdata('BoutiqueID') == 27){?>
                            <td> <a href="<?php echo base_url(); ?>boutique/bill/<?php echo $works[$i]["boutique_order_id"]; ?>" target="_blank">View Bill</a> | 
                          <a href="<?php echo base_url(); ?>boutique/orderbill/<?php echo $works[$i]["boutique_customer_id"]; ?>/<?php echo $works[$i]["boutique_order_id"]; ?>" target="_blank">Order Form</a>| 
                          <a href="<?php echo base_url(); ?>boutique/managementbill/<?php echo $works[$i]["boutique_customer_id"]; ?>/<?php echo $works[$i]["boutique_order_id"]; ?>" target="_blank">Management Bill</a>
                          </td>
                          <?php 
                          } 
                          else{ ?>
                              <td> <a href="<?php echo base_url(); ?>boutique/bill/<?php echo $works[$i]["boutique_order_id"]; ?>" target="_blank">View Bill</a>
                                
                          <!-- <a href="<?php echo base_url(); ?>boutique/orderbill/<?php echo $works[$i]["boutique_customer_id"]; ?>/<?php echo $works[$i]["boutique_order_id"]; ?>" target="_blank">Order Form</a> -->
                              </td>

                          <?php
                          }
                          ?>
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