<!-- Content Wrapper. Contains page content -->
<!--<script type='text/javascript' src='js/jquery-1.3.2.min.js'></script>-->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<body>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         <small></small>
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
        <form method="post" action="<?php echo base_url(); ?>boutique/updatsalary/">
          <div class="box-header with-border">
            <span class="pull-right"><a class="btn btn-info" href="<?php echo @$backlink; ?>">
                Back</a></span>

            <br>
          <br>
            <div class="col-md-4">
            <div class="form-group">

           </div>
            </div>

<div class="col-md-8">
            <div class="form-group">
            <select name="property_id" id="sites" class="form-control">
              <option value="0">Select Property</option>
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


        

          <div class="box-body">




            <table class="table table-bordered table-striped">
                         <thead>
                      <tr>
                        <th>Names</th>
                        <th>Site</th>
                        <th>Salary / Day</th>
                        <th width="3%">Overtime</th>
                        <th width="3%">Offtime</th>
                        <th>Salary</th>
                      </tr>
                      </thead>
                      <tbody>
                      <input type="hidden" id="att_date" name="date" value="<?php echo $this->uri->segment(4); ?>"">
                       
                      <!-- <?php echo $this->uri->segment(4); ?> -->
                      <input type="hidden" id="count" value="<?php echo count($sheet);?>">
                     <?php                       
                      for($i = 0; $i < count($sheet); $i++) { ?>
                        <tr>
                         <td><?php echo $sheet[$i]["boutique_tailor_username"]; ?></td>
                         <td><?php echo $sheet[$i]["boutique_property_name"]; ?></td>
                         <td><?php echo $sheet[$i]["boutique_staff_hourly_rate"]; ?></td>
                        
                         <td><input  style="width: 50px;" type="text" id="over" name="overtime[]" value="<?php echo $sheet[$i]["builder_overtime_hour"]; ?>"></td>
                         <td><input  style="width: 50px;" type="text" id="off" name="offtime[]" value="<?php echo $sheet[$i]["builder_exit_hours"]; ?>"></td>
                         <td>
                         <?php echo $sheet[$i]["salary"]; ?>
                         <input type="hidden" name="user_id[]" value="<?php echo $sheet[$i]["user_id"]; ?>"">
                         <input type="hidden" id="att_date" name="date" value="<?php echo $this->uri->segment(4); ?>"">
                       
                         <!-- <input type="hidden" name="overtime[]" value="<?php echo $sheet[$i]["staff_overtime_rate"]; ?>"">
                         <input type="hidden" name="offtime[]" value="<?php echo $sheet[$i]["staff_offtime_rate"]; ?>"">
                         <input type="hidden" name="daily[]" value="<?php echo $sheet[$i]["boutique_staff_hourly_rate"]; ?>""> -->
                         
                         </td>
                        
                        </tr>
                      <?php 
                      }
                       ?>
                    
                      </tbody>
                    </table>

            


            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
          <input type="hidden" name="dates" value="<?php echo $this->uri->segment(4); ?>">
            
            <?php if($this->uri->segment(3)==0)
            {?>
     <input type="submit" class="btn btn-primary" disabled></button>
         
            <?php }else{ ?>

              <input type="submit" class="btn btn-primary"></button>
         
            <?php } ?>
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

$('#over').on('change', function() {
    var cid = $(this).val();
    days = $('#count').val();
 for (i = 0; i < days; i++) {
  text += cars[i] + "<br>";
} 
    alert(days)
    // $('#sala[]').val(cid);



  });


  $('#sites').on('change', function() {
    var cid = $(this).val();

    days = $('#att_date').val();
    // alert(days)
    location.href = "<?= base_url() ?>Boutique/emplyoeedetails/" + cid+"/"+days;



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