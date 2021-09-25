<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Customers      
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
                    <span><a class="btn btn-info" href="<?php echo base_url(); ?>boutique/addcustomer">Add Customer</a></span>
                    <span class="pull-right" style="margin: 5px;"><a class="btn btn-info btn-xs" href="<?php echo base_url(); ?>admin/boutiques">Show All</a></span>
                    <span class="pull-right" style="margin: 5px;"><a class="btn btn-success btn-xs" href="<?php echo base_url(); ?>admin/boutiques">Active</a></span>
                    <span class="pull-right" style="margin: 5px;"><a class="btn btn-danger btn-xs" href="<?php echo base_url(); ?>admin/boutiques">InActive</a></span>
                    <span class="pull-right" style="margin: 5px;">Filter By:</span>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th></th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr><td><a href="<?php echo base_url(); ?>boutique/customerdetails/1">Customer 1</a></td><td> Trivandrum <td><td> Active </td><td> Details </td></tr>
                      <?php 
                      /*
                      foreach(@$teamDatas as $team){ ?>
                      <tr>
                        <td><a href="<?php echo base_url(); ?>teams/teamdetails/<?php echo $team['TeamID']; ?>"><?php echo $team['TeamName'];?></a></td>
                        <td><?php echo $team['TeamCity'];?></td>
                        <td><?php
                        $old_date_timestamp = strtotime($team['TeamCreatedOn']);
                        $new_date = date('m-d-Y, H:i', $old_date_timestamp);
                        echo $new_date;?></td>
                        <?php if($team['TeamApprovedStatus'] == 1){?>
                        <td><button type="button" class="btn btn-success teamstatus" data-id="<?php echo $team['TeamApprovedStatus'];?>" data-team-id="<?php echo $team['TeamID'];?>" style="width:100px;">Active</button></td>
                          <?php } else if($team['TeamApprovedStatus'] == 0){ ?>
                          <td><button type="button" class="btn btn-primary teamstatus" data-id="<?php echo $team['TeamApprovedStatus'];?>" data-team-id="<?php echo $team['TeamID'];?>" style="width:100px;">New</button></td>
                          <?php } else {?>
                          <td><button type="button" class="btn btn-danger teamstatus" data-id="<?php echo $team['TeamApprovedStatus'];?>" data-team-id="<?php echo $team['TeamID'];?>" style="width:100px;">Rejected</button></td>
                          <?php } ?>
                          <td>
                            <!-- <button class="btn btn-danger"><i class="fa-trash fa"></i></button> -->
                            <a formnovalidate id="<?php echo $team['TeamID']; ?>" class="pull-right">
                              <button title="Delete" class="btn btn-danger" data-href="<?php echo $team['TeamID']; ?>" data-toggle="modal" data-target="#confirm-delete">
                                <i class="fa-trash fa"></i> 
                              </button>
                            </a>
                          </td>
                      </tr>
                      <?php }

					*/
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