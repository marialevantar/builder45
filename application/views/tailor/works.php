<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Works      
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
                    <!-- 
                    <span class="pull-right" style="margin: 5px;"><a class="btn btn-info btn-xs" href="<?php echo base_url(); ?>admin/boutiques">Show All</a></span>
                    <span class="pull-right" style="margin: 5px;"><a class="btn btn-success btn-xs" href="<?php echo base_url(); ?>admin/boutiques">Active</a></span>
                    <span class="pull-right" style="margin: 5px;"><a class="btn btn-danger btn-xs" href="<?php echo base_url(); ?>admin/boutiques">InActive</a></span>
                    <span class="pull-right" style="margin: 5px;">Filter By:</span> -->
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="tailor_works" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>Work Number</th>
                        <th>Name</th>
                        <th>Tailor Name</th>
                        <th>Customer Name</th>
                        <th>Status</th>
                        <th>Delivery Date</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php                       
                      foreach(@$works as $work){ 
                        //print_r($work);
                      ?>
                      <tr>
                        <td><?php echo $work->boutique_work_number;?></td>
                        <td><a href="<?php echo base_url(); ?>tailor/workdetails/<?php echo $work->boutique_work_id; ?>"><?php echo $work->boutique_work_name;?></a></td>
                        <td><?php echo $work->boutique_tailor_username;?></td>
                        <td><?php echo $work->boutique_customer_name;?></td>
                         <?php if($work->boutique_work_status == 1){?>
                          <td><span class="label label-warning">Started</span></td>
                          <?php } ?>
                          <?php if($work->boutique_work_status == 2){?>
                          <td><span class="label label-info">Processing</span></td>
                          <?php } ?>
                          <?php if($work->boutique_work_status == 3){?>
                          <td><span class="label label-success">Completed</span></td>
                          <?php } ?>
                        <td><?php echo $work->boutique_work_delivery_date;?></td>
                      </tr>
                      <?php }
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