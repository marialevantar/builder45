<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
 
  <section class="content-header">
    <h1>
      Store      
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
                          <th width="5%"></th>
                          <th width="10%"></th>
                          <th></th>
                            <th>Status</th>
                      </tr>           
                      <tr>
                        <th width="5%">Date</th>
                        <th width="10%">Name</th>
                        <th width="10%"></th>
                        <th>Supervisor</th>
                        <th>Office</th>
                        <!-- <th>Purchase</th>
                        <th>Accounts</th> -->
                        
                        <!-- <th width="23%">Account</th> -->
                    <!-- <?php if($this->session->userdata('UserID') !=118) {?>  <th>Actions</th> <?php }?> -->
                      </tr>
                      </thead>
                      <tbody>
                      <?php 
                      $total = count($request);
                      for($i = 0; $i < $total; $i++) { ?>
                        <tr>
                        <td><a href="<?php echo base_url(); ?>boutique/viewrequest/<?php echo $request[$i]["builder_purchase_request_id"]; ?>"><?php echo $request[$i]["builder_purchase_request_date"]; ?></a></td>
                     
                        <!-- <th width="5%"><?php echo $request[$i]["builder_purchase_request_date"]; ?></th> -->
                        <th width="10%"><?php echo $request[$i]["builder_purchase_request_item"]; ?></th>
                        <th width="10%"></th>
                        <!-- PM -->
                        <td>
                          <?php echo $request[$i]["boutique_user_username"]; ?>
                          <span class="label label-success">Requested</span>
                        
                          <br>
                        <?php echo $request[$i]["builder_purchase_request_description"]; ?>
                          
                        </td>
<!-- QA & QC -->
                        <td>
                        <?php if($request[$i]["builder_request_status"] == 1){?>
                          <span class="label label-warning">Processing</span>
                          <?php } elseif($request[$i]["builder_request_status"] == 3){ ?>
                         
                          <span class="label label-danger">Rejected</span>
                          <?php } else { ?>
                            <span class="label label-success">Approved</span>
                          <?php } ?>
                          <br>
                        <?php echo $request[$i]["bulder_qa_qc_description"]; ?>
                          
                        </td>
                        <!-- Purchase -->
                        <!-- <td>
                        
                          <?php if($request[$i]["builder_request_status"] == 2){?>
                          <span class="label label-warning">Processing</span>
                          <?php } ?>
                          
                          <?php if($request[$i]["builder_request_status"] == 4){?>
                          <span class="label label-success">Approved</span>
                          <?php } ?>
                          <?php if($request[$i]["builder_request_status"] == 5){?>
                          <span class="label label-danger">Rejected</span>
                          <?php } ?>
                          <?php if($request[$i]["builder_request_status"] == 6){?>
                          <span class="label label-success">Approved</span>
                          <?php } ?>
                          <?php if($request[$i]["builder_request_status"] == 7){?>
                          <span class="label label-success">Approved</span>
                          <?php } ?>
                          <br>
                        <?php echo $request[$i]["builder_purchase_description"]; ?>
                          
                        </td> -->
                        <!-- Account -->
                        <!-- <td>
                          
                          
                          <?php if($request[$i]["builder_request_status"] == 4){?>
                          <span class="label label-warning">Processing</span>
                          <?php } ?>
                          <?php if($request[$i]["builder_request_status"] == 6){?>
                          <span class="label label-success">Approved</span>
                          <?php } ?>
                          <?php if($request[$i]["builder_request_status"] == 7){?>
                          <span class="label label-danger">Rejected</span>
                          <?php } ?>
                          
                          <br>
                        <?php echo $request[$i]["builder_account_decription"]; ?>
                          
                        </td>     -->
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