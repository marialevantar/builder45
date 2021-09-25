<?php 
$stat = $this->session->userdata('filter');
if($stat == "rejected"):
  $backlink = base_url()."boutique/tailor";
elseif($stat == "new"):
  $backlink = base_url()."boutique/tailor";
elseif($stat == "active"):
  $backlink = base_url()."boutique/tailor";
else:
  $backlink = base_url()."boutique/tailor";
endif;
 ?>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit
      <small><?php echo ($this->session->userdata('BoutiqueID') == 27) ? 'Staff' : (($this->session->userdata('BoutiqueID') == 33) ? "Staff" : "Staff") ; ?></small>
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
    <form id="addcustomer" method="post" action="<?php echo base_url(); ?>Boutique/updatetailor/<?php echo @$tailor['boutique_tailor_id']; ?>">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo ($this->session->userdata('BoutiqueID') == 27) ? 'Staff' : (($this->session->userdata('BoutiqueID') == 33) ? "Staff" : "Staff") ; ?> Details</h3> 
        <span class="pull-right"><a class="btn btn-info" href="<?php echo @$backlink; ?>">
        Back</a></span>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Name</label>
              <input name="name" type="text" class="form-control" value="<?php echo @$tailor['boutique_tailor_username']; ?>" style="text-transform: capitalize;">
            </div>
          </div>

          <?php if($this->session->userdata('BoutiqueID') == 27){?>
          <div class="col-md-12">
            <div class="form-group">
                <label>Select Staff Type</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="fa-user fa"></span></span>
                  <select name="boutique_staff_type" class="form-control">
                    <option value="1" <?php if($tailor['boutique_staff_type'] == 1) { ?> selected="selected" <?php } ?>>Tailor</option>
                    <option value="2" <?php if($tailor['boutique_staff_type'] == 2) { ?> selected="selected" <?php } ?>>Designer</option>
                    <option value="3" <?php if($tailor['boutique_staff_type'] == 3) { ?> selected="selected" <?php } ?>>Hand Worker</option>
                    <option value="4" <?php if($tailor['boutique_staff_type'] == 4) { ?> selected="selected" <?php } ?>>Machine Embroidary</option>
                    <option value="5" <?php if($tailor['boutique_staff_type'] == 5) { ?> selected="selected" <?php } ?>>Finishing Person</option>
                  </select>
                </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Hourly Rate</label>
              <div class="input-group">
                <span class="input-group-addon"><span class="fa-inr fa"></span></span>
                <input name="boutique_staff_hourly_rate" type="number" class="form-control" value="<?php echo @$tailor['boutique_staff_hourly_rate']; ?>">
              </div>
            </div>
          </div>
        <?php } ?>

         <?php if($this->session->userdata('BoutiqueID') == 33){?>
          <div class="col-md-12">
            <div class="form-group">
                <label>Select Staff Type</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="fa-user fa"></span></span>
                  <select name="boutique_staff_type" class="form-control">
                    <option value="1" <?php if($tailor['boutique_staff_type'] == 1) { ?> selected="selected" <?php } ?>>Tailor</option>
                    <option value="2" <?php if($tailor['boutique_staff_type'] == 2) { ?> selected="selected" <?php } ?>>Cutting master</option>
                    <option value="3" <?php if($tailor['boutique_staff_type'] == 3) { ?> selected="selected" <?php } ?>>Embroidery</option>
                    <option value="4" <?php if($tailor['boutique_staff_type'] == 4) { ?> selected="selected" <?php } ?>>Attended by</option>
                  </select>
                </div>
            </div>
          </div>
        <?php } ?>
        
        <div class="col-md-12">
            <div class="form-group">
                <label>Select Staff Type</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="fa-user fa"></span></span>
                  <select name="boutique_staff_type" class="form-control" required="required">
                  <option value="">Select Staff Type</option>
                     <?php
                      $total = count($stafftype);
                      for($i = 0; $i < $total; $i++){ ?>
                     
                    <option value="<?php echo $stafftype[$i]["boutique_work_staff_type_id"]; ?>" <?php if($stafftype[$i]['boutique_work_staff_type_id']==$tailor['boutique_staff_type']) echo 'selected'; ?>><?php echo $stafftype[$i]["boutique_work_staff_type_name"]; ?></option>
                    
                     <?php 
                    }
                       ?>
                       
                  </select>
                </div>
            </div>
          </div>


          <div class="col-md-12">
            <div class="form-group">
              <label>Phone</label>
              <div class="input-group">
                <span class="input-group-addon"><span class="fa-phone fa"></span></span>
                <input name="phone" type="text" class="form-control" value="<?php echo @$tailor['boutique_tailor_ph']; ?>">
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Address</label>
              <textarea name="address" class="form-control" rows="3"><?php echo @$tailor['boutique_tailor_address']; ?></textarea>
            </div>
          </div>

          
          <div class="col-md-12">
            <div class="form-group">
                <label>Wage Type</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="fa-user fa"></span></span>
                  <select name="wage" class="form-control">
                    <option value="<?php echo @$tailor['wage_option']; ?>"><?php echo @$tailor['wage_option']; ?></option>
                    <option value="Daily">Daily</option>
                    <option value="Weekly">Weekly</option>
                    <option value="Monthly">Monthly</option>
                  </select>
                </div>
            </div>
          </div>


          <div class="col-md-12">
            <div class="form-group">
              <label>Amount</label>
              <div class="input-group">
                <span class="input-group-addon"><span class="fa-inr fa"></span></span>
                <input name="boutique_staff_hourly_rate" type="number" class="form-control" value="<?php echo @$tailor['boutique_staff_hourly_rate']; ?>">
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Overtime</label>
              <div class="input-group">
                <span class="input-group-addon"><span class="fa-inr fa"></span></span>
                <input name="overtime_hourly_rate" type="number" class="form-control" value="<?php echo @$tailor['staff_overtime_rate']; ?>">
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Offtime Amount</label>
              <input name="offtime_hourly_rate" type="text" class="form-control" value="<?php echo @$tailor['staff_offtime_rate']; ?>" >
            </div>
          </div>

<!-- Staff image file  -->
          <div class="col-md-12">
            <div class="form-group">
              <label>Photo</label>
              <input type="file" id="clothimg" name="clothimg" class="form-control">
                <img height="150" src="<?php echo base_url().'uploads/work/'.$tailor['Staff_image']; ?>" id="clothimgprev" <?php if(!$tailor['Staff_image']){?> style="display: none;" <?php } ?>>
              </div>
          </div>

          <input type="hidden" name="url" id="url" value="<?php echo $this->uri->segment(3); ?>">


        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>

          <!-- TABLE: LATEST ORDERS -->
          <div class="box box-info">
            <div class="box-header with-border">
            <div class="col-md-10">
         </div>
          <div class="col-md-2">
          <select id='gMonth2' class="form-control">
                            <option value='01'>Janaury</option>
                            <option value='02' >February</option>
                            <option value='03'>March</option>
                            <option value='04'>April</option>
                            <option value='05'>May</option>
                            <option value='06'>June</option>
                            <option value='07'>July</option>
                            <option value='08'>August</option>
                            <option value='09'>September</option>
                            <option value='10'>October</option>
                            <option value='11'>November</option>
                            <option value='12'>December</option>
                            </select> 
             
          </div>
<table class="table table-bordered table-striped">
          <tr>
            <th>Date</th>
            <th>Overtime Hours</th>
            <th>Offtime Hours</th>
            <th>Daily Wage</th>
          </tr>
          <?php
              $year=2021;
              $mo=$this->uri->segment(4);
              if($mo == NULL)
              {
                $mo= date('m');
              }
              else{
                $mo=$this->uri->segment(4);
                
              }
              $d=cal_days_in_month(CAL_GREGORIAN,$mo,2021);
              for($i=1; $i<=$d ; $i++)
              {
                foreach($monthreport as $m_report)
                {
                  $b_attendance = $m_report["builder_attendance"];
                  $b_date = $m_report["attendance_date"];
                  $orderdate = explode('-', $b_date);
                  $month = $orderdate[1];
                  $year = $orderdate[2];
                  $day = $orderdate[0];
                  if($i== $day && $mo == $month)
                  {
                    if($b_attendance == 1 )
                    { 
                      $attendance_count= $attendance_count + 1;
                      $overtime = $overtime+$m_report["builder_overtime_hour"];
                      $offtime = $offtime+$m_report["builder_exit_hours"];
                      $salary= $salary+$m_report["boutique_staff_hourly_rate"]+($m_report["staff_overtime_rate"]*$m_report["builder_overtime_hour"])-($m_report["staff_offtime_rate"]*$m_report["builder_exit_hours"]);
                      $flag=1;
                     
                   ?>
                <tr>
                  <td><?php echo $m_report["attendance_date"]; ?></td>
                  <td><?php echo $m_report["builder_overtime_hour"]; ?></td>
                  <td><?php echo $m_report["builder_exit_hours"]; ?></td>
                  <td><?php echo $m_report["boutique_staff_hourly_rate"]+($m_report["staff_overtime_rate"]*$m_report["builder_overtime_hour"])-($m_report["staff_offtime_rate"]*$m_report["builder_exit_hours"]);?></td>
                </tr>                    
                    
                    
                    <?php 
                   break;  
                  }else{ 
                      $flag=1;
                      $dayofweek = date('w', strtotime($m_report["attendance_date"]));
                 
                 ?>

                <tr>
                  <td><?php echo $m_report["attendance_date"]; ?></td>
                  <td></td>
                  <td></td>
                  <td>
                  <?php if($dayofweek == 0)
                  {
                    echo "Sunday Holiday";
                  }
                  else
                  {
                    echo "Absent";
                  }
                  
                  ?>
                  </td>
                </tr>      
                    <?php 
                  break;  
                  }
                  }
                  else
                  {
                    $flag=0;
                  
                  }

                
                }
                if($flag!=1)
                {
                  $orderdate[1] = $mo;
                  $orderdate[2]= $year;
                  $orderdate[0] = $i ;
                  $orderdate = implode('-', $orderdate);
                  $dayofweek = date('w', strtotime($orderdate));
                  ?>

                <tr>
                  <td><?php echo $orderdate; ?></td>
                  <td></td>
                  <td></td>
                  <td>
                  <?php if($dayofweek == 0)
                  {
                    echo "Sunday Holiday";
                  }
                  else
                  {
                    echo "Absent";
                  }
                  
                  ?>
                  </td>
                </tr>                    
                  
                   
                <?php }
              }
          ?>
            
         </table>

          <div class="col-md-10">
<!-- <b>Month :</b> <?php echo $month; ?>&nbsp;&nbsp;&nbsp;&nbsp;  <b> -->
            <h4>Working days : </b> <?php echo $attendance_count; ?>&nbsp;&nbsp;&nbsp;&nbsp; <b>Overtime Hours :</b><?php echo $overtime; ?>  &nbsp;&nbsp;&nbsp;&nbsp;<b>Offtime hours :</b><?php echo $offtime; ?>&nbsp;&nbsp;&nbsp;&nbsp;<b>Monthaly Salary :</b><?php echo $salary; ?></h4>
          </div>
      
              <!-- <h3 class="box-title">Statistics</h3>
      -->
     
            </div>
            <!-- /.box-header -->
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <!-- /.box-footer -->
      
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!--  -->
<script>

$('#gMonth2').on('change', function() {
    var cid = $(this).val();
var days = $('#url').val();
 
    location.href = "<?= base_url() ?>Boutique/tailordetails/" + days+"/"+cid;



  });
</script>