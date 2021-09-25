<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <!-- <h1>
      Sales     
      <small>List</small>
    </h1> -->
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
  <?php if($this->session->userdata('UserID') !=118) {?>  <span class="pull-right"><a class="btn btn-info" href="<?php echo base_url(); ?>boutique/additemtransferedtosite">Add Item  </a></span>  <?php } ?> 
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="saleslist" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>Item Transfered Date</th>
                        <th>Property name</th>
                        <th>Total Amount</th>
                        <?php if($this->session->userdata('BoutiqueID') == 21 || $this->session->userdata('BoutiqueID') == 30){?>
                        <th>Amount Paid</th>
                        <th>Balance Amount</th>
                        <?php } ?>
                        <?php if($this->session->userdata('UserID') !=118) {?> 
                        <th>Actions</th>
                         <?php if($this->session->userdata('BoutiqueID') == 21 || $this->session->userdata('BoutiqueID') == 30){?>
                        <th>Bill</th>
                         <?php } ?>
                         <?php } ?> 
                      </tr>
                      </thead>
                      <tbody>
                     <?php 
                      $total = count($sales);
                      for($i = 0; $i < $total; $i++) {
                      if(@is_numeric($sales[$i]["boutique_sale_price"]) && @is_numeric($sales[$i]["boutique_sale_amountpaid"])){
                            $balance_amt = @$sales[$i]["boutique_sale_price"] - @$sales[$i]["boutique_sale_amountpaid"];
                      }
                      else{
                            $balance_amt = 0;    
                      }
                      ?>
                        <tr>
                          <td><a href="<?php echo base_url(); ?>boutique/viewtransferlist/<?php echo $sales[$i]["boutique_sale_id"]; ?>"><?php echo $sales[$i]["boutique_sale_date"]; ?></a></td>
                           
                          <td width="15%"><?php echo $sales[$i]["boutique_property_name"]; ?></td>
                          
                          <?php if($this->session->userdata('BoutiqueID') == 21 || $this->session->userdata('BoutiqueID') == 30){?>
                          <td width="4%"><?php echo $sales[$i]["boutique_sale_price"]; ?></td>  
                          <td width="4%"><?php echo $sales[$i]["boutique_sale_amountpaid"]; ?></td>
                          <td width="4%"><?php echo @$balance_amt; ?></td>
                          <td width="4%"><?php echo $sales[$i]["boutique_sale_paymenttype"]; ?></td>
                          <?php } ?>
                          <?php if($this->session->userdata('UserID') !=118) {?> 
                          <?php if($this->session->userdata('BoutiqueID') == 21 || $this->session->userdata('BoutiqueID') == 30){?>

                            <td>
                            <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this sale ?');" href="<?php echo base_url(); ?>billing/removesale/<?php echo $sales[$i]["boutique_sale_id"]; ?>"><i class="fa fa-trash"></i>
                            </a>
                            |<a href="<?php echo base_url(); ?>billing/addsale/<?php echo $sales[$i]["boutique_sale_id"]; ?>">Details</a>
                            |<a href="<?php echo base_url(); ?>billing/addsalepayment/<?php echo $sales[$i]["boutique_sale_id"]; ?>">Pay</a>
                          </td>
                            <td width="5%">
                              <select onchange="selectbilltype(this.value,<?php echo $sales[$i]["boutique_sale_id"]; ?>,<?php echo $sales[$i]["boutique_sale_billtype"]; ?>)">
                                <option value="0">Select Bill Type</option>
                                <option value="1">Original for recipient</option>
                                <option value="2">Duplicate for transporter</option>
                                <option value="3">Triplicated</option>
                              </select>
                            </td>
                           <?php }
                                elseif($this->session->userdata('BoutiqueID') == 31){ ?>
                                  <td><?php echo $sales[$i]["boutique_sale_price"]; ?></td>
                                  <td><?php echo $sales[$i]["boutique_sale_paymenttype"]; ?></td>
                                  <td>
                                  <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this sale ?');" href="<?php echo base_url(); ?>billing/removesale/<?php echo $sales[$i]["boutique_sale_id"]; ?>"><i class="fa fa-trash"></i>
                                  </a>
                                  |<a href="<?php echo base_url(); ?>billing/addsale/<?php echo $sales[$i]["boutique_sale_id"]; ?>">View Details</a>
                                  <!--
                                  |<a href="<?php //echo base_url(); ?>billing/billthermal/<?php //echo $sales[$i]["boutique_sale_id"]; ?>" target="_blank">View Bill 1</a>
                                  -->
                                  |<a href="<?php echo base_url(); ?>billing/billthermalnew/<?php echo $sales[$i]["boutique_sale_id"]; ?>" target="_blank">View Bill</a>
                                   <!--
                                  |<a href="<?php //echo base_url(); ?>billing/billthermal1/<?php //echo $sales[$i]["boutique_sale_id"]; ?>" target="_blank">View Bill 3</a>
                                   -->
                               </td>
                          <?php
                                }
                                else{ ?>
                                  <td><?php echo $sales[$i]["boutique_sale_price"]; ?></td>
                                  <td>
                                  <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this sale ?');" href="<?php echo base_url(); ?>billing/removesale/<?php echo $sales[$i]["boutique_sale_id"]; ?>"><i class="fa fa-trash"></i>
                                  </a>
                                  <!-- |<a href="<?php echo base_url(); ?>billing/addsale/<?php echo $sales[$i]["boutique_sale_id"]; ?>">View Details</a>
                                  |<a href="<?php echo base_url(); ?>billing/bill/<?php echo $sales[$i]["boutique_sale_id"]; ?>" target="_blank">View Bill</a> -->
                               </td>
                          <?php
                                } }
                            ?>
                        </tr>
                      <?php 
                      }
                       ?>
                      </tbody>
                    </table>
                    <?php if($this->session->userdata('BoutiqueID') == 21 || $this->session->userdata('BoutiqueID') == 30){?>
                         <div style="display:none;" class="total_sale_c">Total Balance : <span class="total_sale"></span></div>
                    <?php 
                      }
                    ?>
                    
                  </div>
                  <!-- /.box-body display:none;-->
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