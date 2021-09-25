<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Payment Request      
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
                  
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="example2" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                            <th>Applies Date</th>
                            <th>Date</th>
                            <th>User</th>
                            <th>Amount</th>
                            <th>Description </th>
                            <th>Status</th>
                            <th>Comment ( Admin )</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($payment as $lea){ ?>

                          <tr>
                          <td><?php

                          echo date("d-m-Y",strtotime($lea["builder_payment_request_requested_date"]));

                          // echo $lea["builder_payment_request_requested_date"]; 
                          ?></td>

                          <td><?php echo date("d-m-Y",strtotime($lea["builder_payment_request_date"])); ?></td>
                                <td><?php 
                                if($lea["builder_payment_request_payment_status"] == 1)
                                {
                                    ?>
                               <a style="color:blue" href="<?php echo base_url(); ?>boutique/update_admin_payment/<?php echo $lea["builder_payment_request_id"]; ?>"><?php  echo $lea["boutique_user_username"]; ?></a> 
                                
                                <?php
                                    }
                                    else
                                    {
                                      echo $lea["boutique_user_username"];
                                    }
                                 ?></td>
                                <td><?php echo $lea["builder_payment_request_amount"]; ?></td>

                                <td><?php echo $lea["builder_payment_request_description"]; ?></td>
                                <td><?php  if($lea["builder_payment_request_payment_status"] == 1){ echo "Applied"; }elseif($lea["builder_payment_request_payment_status"] == 2){ echo "Accepted"; }elseif($lea["builder_payment_request_payment_status"] == 3){ echo "Rejected"; }else{ echo ""; } ?></td>
                              
                                <td><?php echo $lea["builder_payment_request_office_comment"]; ?></td>
                                    <td>
                                       <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this expence ?');"  href="<?php echo base_url(); ?>boutique/remove_delete_payment_request/<?php echo $lea["builder_payment_request_id"]; ?>"><i class="fa fa-trash"></i></a> 
                                    </td>
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