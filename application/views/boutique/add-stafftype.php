<?php
$stat = $this->session->userdata('filter');
if ($stat == "rejected") :
  $backlink = base_url() . "boutique/tailor";
elseif ($stat == "new") :
  $backlink = base_url() . "boutique/tailor";
elseif ($stat == "active") :
  $backlink = base_url() . "boutique/stafftype";
else :
  $backlink = base_url() . "boutique/stafftype";
endif;
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Add
      <small> Staff Type</small>
    </h1>

    <?php if ($this->session->flashdata('notification')) :
      if ($this->session->flashdata('status') == "success") :
        $s_class = " alert-success ";
      else :
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
      <form name="myForm_Usertype" id="addcustomer" method="post" action="<?php echo base_url(); ?>Boutique/savestafftype/">
        <div class="box-header with-border">
          <h3 class="box-title">Staff Type Details</h3>
          
          <span class="pull-right"><a class="btn btn-info" href="<?php echo @$backlink; ?>">

              Back</a></span>
        </div>
        <div class="box-body">
          <div class="row">
          <div class="col-md-12">
          <div class="alert alert-danger" style="display:none;" id="error"></div>
          </div>
            <div class="col-md-6">
           
              <div class="form-group">
                <label>Staff Type</label>
                <input name="boutique_work_staff_type_name" type="text" class="form-control" value="" style="text-transform: capitalize;">
              </div>
            </div>

            <div class="col-md-6">
              <!-- <div class="alert alert-danger" style="display:none;" id="error"></div> -->
                <div class="form-group">
                  <label>Status</label>
                  <select name="status" id="" class="form-control" style="text-transform: capitalize;">
                    <option value="1">Active</option>
                    <option value="0">In Active</option>
                  </select>
                </div>
              </div>
            </div>
        </div>

        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-primary" onclick="return validate()">Add</button>
        </div>
      </form>
    </div>

    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<script>
  function validate() {
    var User_type = document.forms['myForm_Usertype']['boutique_work_staff_type_name'].value;
    if (User_type == '') {
      document.getElementById('error').style.display = 'block';
      document.getElementById('error').innerHTML = 'Enter something!!!!';
      return false;
    }
  }
</script>