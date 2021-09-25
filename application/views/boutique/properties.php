<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Properties      
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
 <span class="pull-right"><a class="btn btn-info" href="<?php echo base_url(); ?>boutique/addproperty">Add Property</a></span> 
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="example3" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>Property Name</th>
                        <th>Client name</th>
                        <th>Phone Number</th>
                        <th>Actions</th> 
                      </tr>
                      </thead>
                      <tbody>
                     <?php 
                      $total = count($properties);
                      for($i = 0; $i < $total; $i++) { ?>
                        <tr>
                          <td><a href="<?php echo base_url(); ?>boutique/propertydetails/<?php echo $properties[$i]["boutique_property_id"]; ?>"><?php echo $properties[$i]["boutique_property_name"]; ?></a></td></td>
                             <td><?php echo $properties[$i]["b_boutique_subheader"]; ?></td>
                          <td><?php echo $properties[$i]["b_boutique_phone"]; ?></td>
                       
                            <td>
                            <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete ?');" href="<?php echo base_url(); ?>boutique/removeproperty/<?php echo $properties[$i]["boutique_property_id"]; ?>"><i class="fa fa-trash"></i></a>
                          </td> 
                       
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