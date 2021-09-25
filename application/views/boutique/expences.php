<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Expenses      
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
                    <h3 class="box-title"> <?php    if($this->session->userdata('UserRole')== 4 || $this->session->userdata('UserRole')== 5 || $this->session->userdata('UserRole')== 6 || $this->session->userdata('UserRole')== 7) { ?> <u><b>Total Amount Received</b></u> <br><?php echo "Cash IN Bank  :"; echo $recieved_petty_bank[0]["boutique_expense_amount"]; echo "<br>"; echo "Cash IN Hand  :"; echo $recieved_petty_hand[0]["boutique_expense_amount"]; }?></h3><br>
                    
                    <!-- recieved_petty_hand -->
                    <br>
  <?php if($this->session->userdata('UserID') !=118) {?>  <span class="pull-right"><a class="btn btn-info" href="<?php echo base_url(); ?>boutique/addexpence">Add Expense</a></span> <?php }?>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="example3" class="table table-bordered table-striped">
                      <thead>
                  <?php    if($this->session->userdata('UserRole')== 4 || $this->session->userdata('UserRole')== 5 || $this->session->userdata('UserRole')== 6 || $this->session->userdata('UserRole')== 7) { ?> 
                      <tr>
                      <th>Date</th>
                      <th>Amount</th>
                      <th>Description</th>
                      <th>Action</th>
                      </tr>

                  <?php } else { ?>
		
                      <tr>
                        <th>Date</th>
                         <?php 
                          if( $this->session->userdata('UserID') == 136){
                        ?>
                        <th>Property</th>
                        <?php } ?>
                        <th>Head</th>
                        <th>Property</th>
                        <th>Description</th>
                        <th>Amount</th>
                      <!--  <th>Details</th> -->
                           <?php if($this->session->userdata('UserID') !=118) {?>  <th>Actions</th> <?php }?>
                      </tr>
                  <?php } ?>
                      </thead>
                      <tbody>
                      <?php    if($this->session->userdata('UserRole')== 4 || $this->session->userdata('UserRole')== 5 || $this->session->userdata('UserRole')== 6 || $this->session->userdata('UserRole')== 7) { ?> 

                      <?php 
                      $cbank =0;
                      $chand =0;

                      $total = count($expences);
                      for($i = 0; $i < $total; $i++) { ?>
                      <tr>
                        <td><?php echo $expences[$i]["boutique_expense_date"]; ?></td>
                        <td><?php echo $expences[$i]["boutique_expense_amount"]; ?></td>
                        <td><?php echo $expences[$i]["boutique_expense_details"]; ?></td>
                        <td>
                        <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this expence ?');" href="<?php echo base_url(); ?>boutique/removeexpence/<?php echo $expences[$i]["boutique_expense_id"]; ?>"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr>

                        <?php
                      if($expences[$i]["boutique_expense_pay_type"]=="Cash"	)
                      {
                        $chand = $chand +$expences[$i]["boutique_expense_amount"];
                      }
                      elseif($expences[$i]["boutique_expense_pay_type"]=="Card"	)
                      {
                        $cbank = $cbank +$expences[$i]["boutique_expense_amount"];
                      }
                      
                      } ?>

                  <?php } else { ?>
	
                     <?php 
                      $total = count($expences);
                      for($i = 0; $i < $total; $i++) { ?>
                        <tr>
                        <?php if($this->session->userdata('UserID') !=118) {?>
                          <td><a href="<?php echo base_url(); ?>boutique/expencedetails/<?php echo $expences[$i]["boutique_expense_id"]; ?>"><?php echo $expences[$i]["boutique_expense_date"]; ?></a></td>
                        <?php }else { ?>
                          <td><?php echo $expences[$i]["boutique_expense_date"]; ?></td>
                        <?php } ?>
                         <?php 
                          if( $this->session->userdata('UserID') == 126 || $this->session->userdata('UserID') == 128){
                        ?>
                         <td><?php
                        //  builder_expense_status
                         if($expences[$i]["builder_expense_status"] == 1)
                         {

                          $user = $this->Billing_model->getpettycashuserid($expences[$i]["boutique_billing_user_id"]);
		
                          
                          echo "Petty Cash ("; echo $user["boutique_user_username"]; echo " )";
                         }
                         else
                         {
                          echo $expences[$i]["boutique_billing_head_name"];

                         }
                          ?></td>
                         
                        <td><?php echo $this->Work_model->m_getpropertyname($expences[$i]["boutique_property"])["boutique_property_name"];
                          ?></td>
                        <?php } ?>
                        <td><?php echo $expences[$i]["boutique_expense_details"]; ?></td>
                          <td><?php echo $expences[$i]["boutique_expense_amount"]; ?></td>
                                                    <?php if($this->session->userdata('UserID') !=118) {?> <td>
                            <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this expence ?');" href="<?php echo base_url(); ?>boutique/removeexpence/<?php echo $expences[$i]["boutique_expense_id"]; ?>"><i class="fa fa-trash"></i></a>
                          </td> <?php } ?>
                        </tr>
                      <?php 
                      }
                       ?>
                  <?php } ?>
  
                      </tbody>
                    </table>
                    <h3 class="box-title"><?php    if($this->session->userdata('UserRole')== 4 || $this->session->userdata('UserRole')== 5 || $this->session->userdata('UserRole')== 6 || $this->session->userdata('UserRole')== 7) { ?> <u><b>Balance Amount</b></u> <br><?php  echo "Cash IN Bank  :"; echo $recieved_petty_bank[0]["boutique_expense_amount"]-$cbank; echo "<br>"; echo "Cash IN Hand  :"; echo $recieved_petty_hand[0]["boutique_expense_amount"]-$chand; }?></h3><br>

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