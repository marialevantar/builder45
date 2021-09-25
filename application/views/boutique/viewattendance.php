<!-- Content Wrapper. Contains page content -->

<!-- Content Wrapper. Contains page content -->
<!--<script type='text/javascript' src='js/jquery-1.3.2.min.js'></script>-->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<body>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Attendance      
      <small>Reports</small>
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


<!-- /.content -->


  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">Attendance List</h3><br><br>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
<form method="POST">
<div  style="float: right;     margin-left: 8px;">
<input type="text" name="dateid" id="datepicker_list" ></label></div>

</form>
           
                    <table id="exreportsdata" class="table table-bordered table-striped">
                         <thead>
                      <tr>
                        <th>Names</th>
                        <th>Sites</th>
                        <th width="15%">Salary / Day</th>
                        <th width="5%">Overtime</th>
                        <th width="5%">Offtime</th>
                        <th>salary</th>
                      </tr>
                      </thead>
                      <tbody>
                     <?php                       
                      for($i = 0; $i < count($sheet); $i++) { ?>
                        <tr>
                         <td><?php echo $sheet[$i]["boutique_tailor_username"]; ?></td>
                         <td><?php echo $sheet[$i]["boutique_property_name"]; ?></td>
                         <td><?php echo $sheet[$i]["boutique_staff_hourly_rate"]; ?></td>
                         <td><?php echo $sheet[$i]["builder_overtime_hour"]; ?></td>
                         <td><?php echo $sheet[$i]["builder_exit_hours"]; ?></td>
                         <td><?php echo $sheet[$i]["salary"]; ?></td>
                       
                       
                        </tr>
                      <?php 
                      }
                       ?>
                    
                      </tbody>
                    </table>
                  </div>
                  <!-- /.box-body -->
        
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

</body>
<script>



$('#datepicker_site').on('change', function() {
  console.log("Hai")
    
  alert("Hai")
    days = $('#datepicker_site').val();
    location.href = "<?= base_url() ?>Boutique/siteattendance/" + cid+"/"+days;



  });
  </script>