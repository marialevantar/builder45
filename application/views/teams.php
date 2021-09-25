<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Drills & Skills
      <small>Team</small>
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
                    <h3 class="box-title">List</h3>
                    <span class="pull-right" style="margin: 5px;"><a class="btn btn-info btn-xs" href="<?php echo base_url(); ?>teams">Show All</a></span>
                    <span class="pull-right" style="margin: 5px;"><a class="btn btn-primary btn-xs" href="<?php echo base_url(); ?>teams/filter/new">New</a></span>
                    <span class="pull-right" style="margin: 5px;"><a class="btn btn-success btn-xs" href="<?php echo base_url(); ?>teams/filter/active">Active</a></span>
                    <span class="pull-right" style="margin: 5px;"><a class="btn btn-danger btn-xs" href="<?php echo base_url(); ?>teams/filter/rejected">Rejected</a></span>
                    <span class="pull-right" style="margin: 5px;">Filter By:</span>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Remove</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php foreach($teamDatas as $team){ ?>
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
    <div class="box box-info">
      <form  enctype="multipart/form-data" id="addteam" method="post" action="<?php echo base_url(); ?>Teams/saveregistration">
        <div class="box-header with-border">
          <h3 class="box-title">Add New Team</h3>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Contact Name</label>
                <input type="text" name="name" class="form-control" value="">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Team Name</label>
                <input name="teamName" type="text" class="form-control" value="">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Email</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="fa-envelope fa"></span></span>
                  <input type="text" name="email" class="form-control" value="">
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Phone</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="fa-phone fa"></span></span>
                  <input name="phone" type="text" class="form-control" value="">
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Age Category</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="fa-user fa"></span></span>
                  <select class="form-control" name="age_cat">
                    <option value="1">Novice</option>
                    <option value="2">Atom</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Head Coach Name</label>
                <input name="coachName" type="text" class="form-control" value="">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>City</label>
                <input name="city" type="text" class="form-control" value="">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Level</label>
                <input name="level" type="text" class="form-control" value="">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Description</label>
                <textarea name="summary" class="form-control" rows="3"></textarea>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Password</label>
                <input name="password" type="password" class="form-control" value="">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Confirm Password</label>
                <input name="c_password" type="password" class="form-control" value="">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Status</label>
                  <select class="form-control" name="status">
                    <option value="1">Active</option>
                    <option value="0">New</option>
                    <option value="2">Rejected</option>
                  </select>
                <!-- </div> -->
              </div>
            </div>
            <div class="col-md-12">
              <div id="filediv"><input name="file[]" type="file" id="file"/></div><br/>
              
              <input type="button" id="add_more" class="btn btn-info" value="Add More Files"/>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-primary submit"  id="upload">Add New Team</button>
          <span id="loading_gif"><i class="fa fa-refresh fa-spin fa-fw margin-bottom"></i>Please wait!</span>
        </div>
      </form>
    </div>

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