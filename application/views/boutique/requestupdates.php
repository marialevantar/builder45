<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <?php if($this->session->userdata('UserID') ==126 ) {?>
 
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
  <?php 
if($this->session->userdata('UserRole') == 2) { ?>

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
                          <th></th>
                          <th>Departmnts</th>
                      </tr>           
                      <tr>
                        <th>Sl No</th>
                        <th width="23%">Project Manager</th>
                        <th width="23%">QA & QC</th>
                        <th width="23%">Purchase </th>
                        <th width="23%">Account</th>
                    <!-- <?php if($this->session->userdata('UserID') !=118) {?>  <th>Actions</th> <?php }?> -->
                      </tr>
                      </thead>
                      <tbody>
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
  <?php } ?>

<?php } ?>
<?php 
if($this->session->userdata('UserRole') == 5) { ?>
 <section class="content-header">
    <h1>
      Purchase Request 
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
  <div class="box box-info">
    <form id="addcustomer" method="post" action="<?php echo base_url(); ?>boutique/updateqa/">
      <div class="box-header with-border">
        <h3 class="box-title"></h3>
        <span class="pull-right"><a class="btn btn-info" href="<?php echo @$backlink; ?>">
        Back</a></span>
      </div>
      <div class="box-body">
        <div class="row">

          <div class="col-md-12">
            <div class="form-group">
              <label>Date</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input name="purchasedate" type="text" class="form-control pull-right" value="<?php echo $updateinfo[0]["builder_purchase_request_date"]; ?>" disabled>
              </div>
            </div>
          </div>
          
     
          <div class="col-md-12">
            <div class="form-group">
              <label>Item Name</label>
              <input name="itemname" type="text" class="form-control" value="<?php echo $updateinfo[0]["builder_purchase_request_item"]; ?>" disabled>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>To be Date</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input name="tobedate" type="text" class="form-control pull-right" value="<?php echo $updateinfo[0]["builder_purchase_request_tobedate"]; ?>" disabled>
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Delivery Date</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input name="deliverydate" type="text" class="form-control pull-right" value="<?php echo $updateinfo[0]["builder_purchase_request_deliverydate"]; ?>" disabled>
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Description</label>
              <textarea name="description" class="form-control" rows="3" disabled><?php echo $updateinfo[0]["builder_purchase_request_description"]; ?></textarea>
              <input name="qa_id" type="hidden" class="form-control pull-right" value="<?php echo $updateinfo[0]["builder_purchase_request_id"]; ?>">
              <input name="status" type="hidden" class="form-control pull-right" value="2">
             
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Office</label>
              <textarea name="qa_qcdescription" class="form-control" rows="3"><?php echo $updateinfo[0]["bulder_qa_qc_description"]; ?></textarea>
            </div>
          </div>

        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">

      <?php if($updateinfo[0]["builder_request_status"] == 1){ ?>

        <button type="submit" name="action" class="btn btn-success" value="accept">ACCEPT</button>
        <button type="submit" name="action" class="btn btn-danger" value="reject">REJECT</button>
        <a formnovalidate id="<?php echo @$teamdetail->TeamID; ?>" class="pull-right">
     
      <?php } ?>
        </a>
      </div>
    </form>
  </div>

    <!-- /.row -->
  </section>
 

<?php 
}?>
<?php 
if($this->session->userdata('UserRole') == 6) { ?>
 <section class="content-header">
    <h1>
      Purchase Request
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
  <div class="box box-info">
    <form id="addcustomer" method="post" action="<?php echo base_url(); ?>boutique/updatepurchase/">
      <div class="box-header with-border">
        <h3 class="box-title"></h3>
        <span class="pull-right"><a class="btn btn-info" href="<?php echo @$backlink; ?>">
        Back</a></span>
      </div>
      <div class="box-body">
        <div class="row">

          <div class="col-md-12">
            <div class="form-group">
              <label>Date</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input name="purchasedate" type="text" class="form-control pull-right" value="<?php echo $updateinfo[0]["builder_purchase_request_date"]; ?>" disabled>
              </div>
            </div>
          </div>
          
     
          <div class="col-md-12">
            <div class="form-group">
              <label>Item Name</label>
              <input name="itemname" type="text" class="form-control" value="<?php echo $updateinfo[0]["builder_purchase_request_item"]; ?>" disabled>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>To be Date</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input name="tobedate" type="text" class="form-control pull-right" value="<?php echo $updateinfo[0]["builder_purchase_request_tobedate"]; ?>" disabled>
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Delivery Date</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input name="deliverydate" type="text" class="form-control pull-right" value="<?php echo $updateinfo[0]["builder_purchase_request_deliverydate"]; ?>" disabled>
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Description</label>
              <textarea name="description" class="form-control" rows="3" disabled><?php echo $updateinfo[0]["builder_purchase_request_description"]; ?></textarea>
              <input name="qa_id" type="hidden" class="form-control pull-right" value="<?php echo $updateinfo[0]["builder_purchase_request_id"]; ?>">
              <input name="status" type="hidden" class="form-control pull-right" value="2">
             
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>QA & QC Description</label>
              <textarea name="qa_qcdescription" class="form-control" rows="3" disabled><?php echo $updateinfo[0]["bulder_qa_qc_description"]; ?></textarea>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Purchase Description</label>
              <textarea name="purchase_qcdescription" class="form-control" rows="3"><?php echo $updateinfo[0]["builder_purchase_description"]; ?></textarea>
            </div>
          </div>

        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
      <?php if($updateinfo[0]["builder_request_status"] == 2){ ?>
        <button type="submit" name="action" class="btn btn-success" value="accept">ACCEPT</button>
        <button type="submit" name="action" class="btn btn-danger" value="reject">REJECT</button>
        <a formnovalidate id="<?php echo @$teamdetail->TeamID; ?>" class="pull-right">
        </a>
        <?php } ?>
      </div>
    </form>
  </div>

    <!-- /.row -->
  </section>
 

<?php 
}?>
<?php 
if($this->session->userdata('UserRole') == 7) { ?>
 <section class="content-header">
    <h1>
      Purchase Request
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
  <div class="box box-info">
    <form id="addcustomer" method="post" action="<?php echo base_url(); ?>boutique/updateaccount/">
      <div class="box-header with-border">
        <h3 class="box-title"></h3>
        <span class="pull-right"><a class="btn btn-info" href="<?php echo @$backlink; ?>">
        Back</a></span>
      </div>
      <div class="box-body">
        <div class="row">

          <div class="col-md-12">
            <div class="form-group">
              <label>Date</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input name="purchasedate" type="text" class="form-control pull-right" value="<?php echo $updateinfo[0]["builder_purchase_request_date"]; ?>" disabled>
              </div>
            </div>
          </div>
          
     
          <div class="col-md-12">
            <div class="form-group">
              <label>Item Name</label>
              <input name="itemname" type="text" class="form-control" value="<?php echo $updateinfo[0]["builder_purchase_request_item"]; ?>" disabled>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>To be Date</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input name="tobedate" type="text" class="form-control pull-right" value="<?php echo $updateinfo[0]["builder_purchase_request_tobedate"]; ?>" disabled>
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Delivery Date</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input name="deliverydate" type="text" class="form-control pull-right" value="<?php echo $updateinfo[0]["builder_purchase_request_deliverydate"]; ?>" disabled>
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Description</label>
              <textarea name="description" class="form-control" rows="3" disabled><?php echo $updateinfo[0]["builder_purchase_request_description"]; ?></textarea>
              <input name="qa_id" type="hidden" class="form-control pull-right" value="<?php echo $updateinfo[0]["builder_purchase_request_id"]; ?>">
              <input name="status" type="hidden" class="form-control pull-right" value="2">
             
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>QA & QC Description</label>
              <textarea name="qa_qcdescription" class="form-control" rows="3" disabled><?php echo $updateinfo[0]["bulder_qa_qc_description"]; ?></textarea>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Purchase Description</label>
              <textarea name="qa_qcdescription" class="form-control" rows="3" disabled><?php echo $updateinfo[0]["builder_purchase_description"]; ?></textarea>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Accounts Description</label>
              <textarea name="account_qcdescription" class="form-control" rows="3"><?php echo $updateinfo[0]["builder_account_decription"]; ?></textarea>
            </div>
          </div>

        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
      <?php if($updateinfo[0]["builder_request_status"] == 4){ ?>
        <button type="submit" name="action" class="btn btn-success" value="accept">ACCEPT</button>
        <button type="submit" name="action" class="btn btn-danger" value="reject">REJECT</button>
        <a formnovalidate id="<?php echo @$teamdetail->TeamID; ?>" class="pull-right">
        </a>
      <?php } ?>
      </div>
    </form>
  </div>

    <!-- /.row -->
  </section>
 

<?php 
}?>


<?php 
if($this->session->userdata('UserRole') == 4) { ?>
 <section class="content-header">
    <h1>
      Purchase Request
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
  <div class="box box-info">
    <form id="addcustomer" method="post" action="<?php echo base_url(); ?>boutique/updaterequest/">
      <div class="box-header with-border">
        <h3 class="box-title"></h3>
        <span class="pull-right"><a class="btn btn-info" href="<?php echo @$backlink; ?>">
        Back</a></span>
      </div>
      <div class="box-body">
        <div class="row">

          <div class="col-md-12">
            <div class="form-group">
              <label>Date</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input name="purchasedate" type="text" class="form-control pull-right" value="<?php echo $updateinfo[0]["builder_purchase_request_date"]; ?>">
              </div>
            </div>
          </div>
          
     
          <div class="col-md-12">
            <div class="form-group">
              <label>Item Name</label>
              <input name="itemname" type="text" class="form-control" value="<?php echo $updateinfo[0]["builder_purchase_request_item"]; ?>">
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>To be Date</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input name="tobedate" type="text" class="form-control pull-right" value="<?php echo $updateinfo[0]["builder_purchase_request_tobedate"]; ?>">
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Delivery Date</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input name="deliverydate" type="text" class="form-control pull-right" value="<?php echo $updateinfo[0]["builder_purchase_request_deliverydate"]; ?>">
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Description</label>
              <textarea name="description" class="form-control" rows="3"><?php echo $updateinfo[0]["builder_purchase_request_description	"]; ?></textarea>
            </div>
          </div>

        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
      <input name="id_request" type="hidden" value="<?php echo $updateinfo[0]["builder_purchase_request_id"]; ?>">
              
        <button type="submit" class="btn btn-danger">Update</button>

        <a formnovalidate id="<?php echo @$teamdetail->TeamID; ?>" class="pull-right">
        </a>
      </div>
    </form>
  </div>

    <!-- /.row -->
  </section>
 

<?php 
}?>
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