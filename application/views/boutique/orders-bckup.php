<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Orders      
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
                    <span class="pull-right"><a class="btn btn-info" onclick="history.back()">Back</a></span><span class="pull-right">&nbsp;&nbsp;</span>
                    <span class="pull-right"><a class="btn btn-info" href="<?php echo base_url(); ?>boutique/addwork/<?php echo $customerid;?>">Add Work</a></span>
                  </div>
                  <div class="box-body">
                    <table id="example2" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>Order Number</th>
                        <th>Customer</th>
                        <th>No of items</th>
                        <th>Grand Total</th>
                        <th>Amount Paid</th>
                        <th>Order Date</th>
                        <th>Delivery Date</th>
                        <th>Payment Status</th>
                        <th>Order Status</th>
                        <th>Add Payment</th>
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
                          <td><a href="<?php echo base_url(); ?>boutique/works/<?php echo $works[$i]["boutique_order_id"]; ?>"><?php echo $works[$i]["boutique_order_number"]; ?></a> </td>
                           <td><?php echo $works[$i]["boutique_customer_name"]; ?></td>
                          <td><?php echo $works[$i]["boutique_order_no_items"]; ?></td>

                          <!-- <td> <?php //echo $this->Work_model->m_getcustomername($works[$i]["boutique_customer_id"])["boutique_customer_name"];
                          ?> </td>-->

                          <td> <?php echo $works[$i]["boutique_order_grandtotal"]; ?> </td>
                           <td> <?php echo $works[$i]["boutique_order_amtpaid"]; ?> </td>
                          <td> <?php echo $works[$i]["boutique_order_date"]; ?> </td>
                          <td> <?php echo $works[$i]["boutique_order_delivery_date"]; ?> </td>
                         
                         <?php if($works[$i]['boutique_order_payment_status'] == 1){?>
                          <td><span class="label label-danger">Not Paid</span></td>
                          <?php } ?>
                          <?php if($works[$i]['boutique_order_payment_status'] == 2){?>
                          <td><span class="label label-warning">Partial Paid</span></td>
                          <?php } ?>
                          <?php if($works[$i]['boutique_order_payment_status'] == 3){?>
                          <td><span class="label label-success">Paid</span></td>
                          <?php } ?>

                          <?php if($works[$i]['boutique_order_status'] == 1){?>
                          <td><span class="label label-warning">Pending</span></td>
                          <?php } ?>
                          <?php if($works[$i]['boutique_order_status'] == 2){?>
                          <td><span class="label label-info">Processing</span></td>
                          <?php } ?>
                          <?php if($works[$i]['boutique_order_status'] == 3){?>
                          <td><span class="label label-success">Completed</span></td>
                          <?php } ?>
                          <td><a href="<?php echo base_url(); ?>boutique/addpayment/<?php echo $works[$i]["boutique_order_id"]; ?>"><span class="label label-primary">Pay</span></a></td>
                          <td><a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this work?');" href="<?php echo base_url(); ?>boutique/removeorder/<?php echo $works[$i]["boutique_order_id"]; ?>"><i class="fa fa-trash"></i></a></td>
                          <?php 
                          if( $this->session->userdata('BoutiqueID') == 7 || $this->session->userdata('BoutiqueID') == 12){ ?>
                          <td> <a href="<?php echo base_url(); ?>boutique/bill/<?php echo $works[$i]["boutique_order_id"]; ?>" target="_blank">View Bill</a> | 
                          <a href="<?php echo base_url(); ?>boutique/orderbill/<?php echo $works[$i]["boutique_customer_id"]; ?>/<?php echo $works[$i]["boutique_order_id"]; ?>" target="_blank">Order Form</a>
                          </td>
                          <?php } 
                          else{ ?>
                              <td> <a href="<?php echo base_url(); ?>boutique/workinvoice/<?php echo $works[$i]["boutique_order_id"]; ?>" target="_blank">View Bill</a></td>
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