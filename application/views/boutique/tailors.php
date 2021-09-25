<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?php echo ($this->session->userdata('BoutiqueID') == 27) ? 'Staffs' : (($this->session->userdata('BoutiqueID') == 33) ? "Staffs" : "Staff") ; ?>     
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
                    <h3 class="box-title">List</h3><br>
                    <?php if($this->session->userdata('UserID') !=118) { ?>
                    <span class="pull-right"><a class="btn btn-info" href="<?php echo base_url(); ?>boutique/addtailor">Add <?php echo ($this->session->userdata('BoutiqueID') == 27) ? 'Staff' : (($this->session->userdata('BoutiqueID') == 33) ? "Staff" : "Staff") ; ?></a></span>
                    <?php } ?>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="example2" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>Name</th>

                        <?php if($this->session->userdata('BoutiqueID') == 27){?>
                        <th>Staff Type</th>
                        <th>Hourly Rate</th>
                        <?php } ?>
                        <th>Designation</th>
                       
                        <th>Phone</th>
                        <th>Address</th>
                        <?php if($this->session->userdata('UserID') !=118) { ?> <th>Remove</th><?php } ?>
                      </tr>
                      </thead>
                      <tbody>
                      <?php
                      $total = count($tailors);
                      for($i = 0; $i < $total; $i++){ ?>
                      <tr>
                      <?php if($this->session->userdata('UserID') !=118) { ?>
                        <td><a href="<?php echo base_url(); ?>boutique/tailordetails/<?php echo $tailors[$i]["boutique_tailor_id"]; ?>">
                        <?php echo $tailors[$i]["boutique_tailor_username"]; ?> </a></td>
                      <?php }else {?>
                        <td>
                        <?php echo $tailors[$i]["boutique_tailor_username"]; ?></td>
                      <?php }?>
                        
                       <td><?php echo $tailors[$i]["boutique_work_staff_type_name"]; ?></td>

                        <?php if($this->session->userdata('BoutiqueID') == 27){?>
                        
                        
                          <?php if($tailors[$i]["boutique_staff_type"]== 1){?>
                          <td><span class="label label-warning">Tailor</span></td>
                          <?php } ?>
                          <?php if($tailors[$i]["boutique_staff_type"] == 2){?>
                          <td><span class="label label-info">Designer</span></td>
                          <?php } ?>
                          <?php if($tailors[$i]["boutique_staff_type"] == 3){?>
                          <td><span class="label label-success">Hand Worker</span></td>
                          <?php } ?>
                          <?php if($tailors[$i]["boutique_staff_type"] == 4){?>
                          <td><span class="label label-info">Machine Embroidary</span></td>
                          <?php } ?>
                          <?php if($tailors[$i]["boutique_staff_type"] == 5){?>
                          <td><span class="label label-warning">Finishing Person</span></td>
                          <?php } ?>

                          <td> Rs <?php echo $tailors[$i]["boutique_staff_hourly_rate"]; ?> </td>

                        <?php } ?>

                        <?php if($this->session->userdata('BoutiqueID') == 33){?>
                        
                        
                          <?php if($tailors[$i]["boutique_staff_type"]== 1){?>
                          <td><span class="label label-warning">Tailor</span></td>
                          <?php } ?>
                          <?php if($tailors[$i]["boutique_staff_type"] == 2){?>
                          <td><span class="label label-info">Cutting master</span></td>
                          <?php } ?>
                          <?php if($tailors[$i]["boutique_staff_type"] == 3){?>
                          <td><span class="label label-success">Embroidery</span></td>
                          <?php } ?>
                          <?php if($tailors[$i]["boutique_staff_type"] == 4){?>
                          <td><span class="label label-info">Attended by</span></td>
                          <?php } ?>

                        <?php } ?>

                        <td><?php echo $tailors[$i]["boutique_tailor_ph"]; ?> </td>
                        <td><?php echo $tailors[$i]["boutique_tailor_address"]; ?> </td>
                          <?php if($this->session->userdata('UserID') !=118) { ?><td><a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this tailor?');" href="<?php echo base_url(); ?>boutique/removetailor/<?php echo $tailors[$i]["boutique_tailor_id"]; ?>"><i class="fa fa-trash"></i></a></td><?php } ?>
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