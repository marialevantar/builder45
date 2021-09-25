<!-- Content Wrapper. Contains page content -->
<!--<script type='text/javascript' src='js/jquery-1.3.2.min.js'></script>-->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<body>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Attendance <small>List</small>
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
        <form method="post" action="<?php echo base_url(); ?>boutique/updateattendance/">
          <div class="box-header with-border">
            <span class="pull-right"><a class="btn btn-info" href="<?php echo @$backlink; ?>">
                Back</a></span>

            <br>
          <br>
            <div class="col-md-4">
            <div class="form-group">
  <input name="date_attendance" type="text" class="form-control pull-right" id="datepicker_site" >

           </div>
            </div>

<div class="col-md-8">
            <div class="form-group">
            <select name="property_id" id="sites" class="form-control" change="<?php echo base_url(); ?>billing/sales">" required>
              <option value="">Select Property</option>
              <?php
              for ($i = 0; $i < count($properties); $i++) {
              ?>
                <option value="<?php echo $properties[$i]['boutique_property_id']; ?>" <?php if($properties[$i]['boutique_property_id']==$this->uri->segment(3)){  echo "selected"; } ?>>
                  <?php echo $properties[$i]['boutique_property_name']; ?>
                </option>
              <?php } ?>
            </select>
       
            </div>
</div>   


          </div>

          <div class="box-body">


            <div class="row" id="show">





              <?php
              $j = 0;
              $total = count($tailors);
              for ($i = 0; $i < $total; $i++) {
                $j++;
              ?>

                <div class="col-xs-12 col-sm-2">
                  <label><?php
                          echo "$j.";
                          echo $tailors[$i]["boutique_tailor_username"]; ?></label>
                </div>

                <div class="col-xs-12 col-sm-1">

                  <?php
                  if ($tailors[$i]["builder_attendance"] == 1) {
                  ?>

                    <input type="checkbox" <?php if (!empty($current_property_id)) {
                                              if ($current_property_id != $tailors[$i]['builder_site_id']) {
                                                echo 'disabled';
                                              }
                                            } ?> name="attendance[<?php echo $i; ?>]" id="procheck[<?php echo $i; ?>]" value="1" checked onclick="changeBuilderId(<?php echo $i; ?>)">
                    <?php if (!empty($current_property_id)) {
                      if ($current_property_id != $tailors[$i]['builder_site_id']) { ?>
                        <input type="hidden" name="attendance[<?php echo $i; ?>]" value="1">
                    <?php }
                    } ?>

                    <input type="hidden" name="userid[]" value="<?php echo $tailors[$i]["boutique_tailor_id"]; ?>">

                  <?php
                  } else {
                  ?>
                    <input type="checkbox" name="attendance[<?php echo $i; ?>]" id="procheck[<?php echo $i; ?>]" value="1" onclick="changeBuilderId(<?php echo $i; ?>)">


                    <input type="hidden" name="userid[]" value="<?php echo $tailors[$i]["boutique_tailor_id"]; ?>">


                  <?php } ?>

                </div>

                <div style="height:10px;" class="col-xs-12 col-sm-12">
                </div>

                <input type="hidden" name="builder_site_id[<?php echo $i; ?>]" value="<?php echo $tailors[$i]["builder_site_id"]; ?>">


              <?php } ?>



            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
          <input type="hidden" name="dates" value="<?php echo $this->uri->segment(4); ?>">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>

      <!-- /.row -->
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
</body>
<script>


  $('#sites').on('change', function() {
    var cid = $(this).val();

    days = $('#datepicker_site').val();
    location.href = "<?= base_url() ?>Boutique/siteattendance/" + cid+"/"+days;



  });
  function changeBuilderId(num) { // add builder_site_id based on checkbox selection
    var cid = "<?= $current_property_id ?>";
    if ($('input[name="attendance[' + num + ']"]').prop("checked") == true) {
      $('input[name="builder_site_id[' + num + ']"]').val(cid);
    } else if ($('input[name="attendance[' + num + ']"]').prop("checked") == false) {
      $('input[name="builder_site_id[' + num + ']"]').val('');
    }
  }
  let builderId="<?= $current_property_id ?>"; // disable checkbox if no property selected
  if(builderId=='')
  {
    $('input[type="checkbox"]').attr('disabled', 'disabled');
    $('button[type="submit"]').attr('disabled', 'disabled');
  }
</script>