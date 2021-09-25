<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    stock      
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
  <?php if($this->session->userdata('UserID') !=118) {?>  <span class="pull-right"><a class="btn btn-info" href="<?php echo base_url(); ?>boutique/addstock">Add Stock</a></span> <?php }?>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="example3" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>Item Name</th>
                        <th>HSN code</th>
                        <th>Unit Price</th>
                        <th>Remaining Quantity</th>
                        <th>Description</th>
  <?php if($this->session->userdata('UserID') !=118) {?>  <th>Actions</th> <?php }?>
                      </tr>
                      </thead>
                      <tbody>
                     <?php 
                      $total = count($stock);
                      for($i = 0; $i < $total; $i++) { ?>
                        <tr>
                          <td><a href="<?php echo base_url(); ?>boutique/updatestock/<?php echo $stock[$i]["boutique_item_id"]; ?>"><?php echo $stock[$i]["boutique_item_name"]; ?></a></td>
                       
                       
                         <td><?php echo $stock[$i]["boutique_item_hsn"]; ?></td>
                
                        <td><?php echo $stock[$i]["boutique_item_unit_price"]; ?></td>
                        <td><?php echo $stock[$i]["boutique_item_total_remaining"]; ?></td>
                        <td><?php echo $stock[$i]["boutique_item_desc"]; ?></td>
                    <?php if($this->session->userdata('UserID') !=118) {?> 
                         <td>
                            <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this Stock ?');" href="<?php echo base_url(); ?>billing/removeitem/<?php echo $stock[$i]["boutique_item_id"]; ?>"><i class="fa fa-trash"></i></a>
                            | <a class="btn btn-sm btn-info" href="<?php echo base_url(); ?>billing/addstock/<?php echo $stock[$i]["boutique_item_id"]; ?>">Add Stock</a>
                           
                          </td> <?php } ?>
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