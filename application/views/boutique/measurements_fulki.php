<?php 
if(@$orderid):
  $backlink = base_url()."boutique/works/".@$orderid;
else:
  $backlink = base_url()."boutique/orders/";
endif;
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Add
      <small>Measurement Fulki</small>
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
    <?php 
    //sleep(15);
    echo "<script>window.close();</script>";
    endif; ?>

  </section>

  <!-- Main content -->
  <section class="content">
  <div class="box box-info">
    <form enctype="multipart/form-data" id="workvali" method="post" action="<?php echo base_url(); ?>boutique/addmeasurement/">
      <div class="box-header with-border">
        <h3 class="box-title">Measurement Details</h3>
      </div>
      <div class="box-body">
        <div class="row">

          <div class="col-md-12">
            <div class="form-group">
              <label>Customer</label>
              <div class="input-group">
                <span class="input-group-addon"><span class="fa-user fa"></span></span>
                <select name="customerid" class="form-control" disabled>
                <?php
                for($i=0; $i<count(@$customers);$i++) {
                 ?>
                  <option value="<?php echo $customers[$i]['boutique_customer_id']; ?>" <?php if($customers[$i]['boutique_customer_id'] == $customerid){ echo "selected='selected'"; }?>>
                  <?php echo $customers[$i]['boutique_customer_name']; ?>
                  </option>
                <?php } ?>
                </select>
              </div>
            </div>

          <?php if($typeid == 1) {?>
              <div style="">
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                    	<div class="row">
                          <div class="col-xs-12 col-sm-5"  style="text-align: center;">
                            <label>Upper Body</label>
                          </div>
                          
                          <div class="col-xs-12 col-sm-5" style="text-align: center;">
                            <label>Lower Body</label>
                          </div>

                      	</div>
                      	<div class="row">
                      	  <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Length</label>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt1_u_length" value="<?php echo @$measurement['mt1_u_length']; ?>"/>
                          </div>
                          
                          <div class="col-xs-12 col-sm-2">
                            <label>Length</label>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt1_l_length" value="<?php echo @$measurement['mt1_l_length']; ?>"/>
                          </div>
                          
                          

                      	</div>


                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Upper Chest</label>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt1_u_upper_chest" value="<?php echo @$measurement['mt1_u_upper_chest']; ?>"/>
                          </div>
                                             
                          <div class="col-xs-12 col-sm-2">
                            <label>Waist</label>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt1_l_waist" value="<?php echo @$measurement['mt1_l_waist']; ?>"/>
                          </div>
                          

                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Front Cross</label>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt1_u_front_cross" value="<?php echo @$measurement['mt1_u_front_cross']; ?>"/>
                          </div>
                         
                          <div class="col-xs-12 col-sm-2">
                            <label>Hip</label>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt1_l_hip" value="<?php echo @$measurement['mt1_l_hip']; ?>"/>
                          </div>
                          
                          

                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Chest</label>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt1_u_chest" value="<?php echo @$measurement['mt1_u_chest']; ?>"/>
                          </div>
                          
                          
                          <div class="col-xs-12 col-sm-2">
                            <label>Fork</label>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt1_l_fork" value="<?php echo @$measurement['mt1_l_fork']; ?>"/>
                          </div>
                          
                          

                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Dart Point</label>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt1_u_dartpoint" value="<?php echo @$measurement['mt1_u_dartpoint']; ?>"/>
                          </div>
                          
                          
                          <div class="col-xs-12 col-sm-2">
                            <label>Thigh</label>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt1_l_thigh" value="<?php echo @$measurement['mt1_l_thigh']; ?>"/>
                          </div>
                         
                          

                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Waist</label>
                          </div>
                          
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt1_u_waist" value="<?php echo @$measurement['mt1_u_waist']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label>Knee</label>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt1_l_knee" value="<?php echo @$measurement['mt1_l_knee']; ?>"/>
                          </div>
                          
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Hip</label>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt1_u_hip" value="<?php echo @$measurement['mt1_u_hip']; ?>"/>
                          </div>
                          
                          <div class="col-xs-12 col-sm-2">
                            <label>Ankle</label>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt1_l_ankle" value="<?php echo @$measurement['mt1_l_ankle']; ?>"/>
                          </div>
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Shoulder</label>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt1_u_shoulder" value="<?php echo @$measurement['mt1_u_shoulder']; ?>"/>
                          </div>
                          
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Sleeves Length</label>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt1_u_sleeves_length" value="<?php echo @$measurement['mt1_u_sleeves_length']; ?>"/>
                          </div>
                          
                          
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Sleeves Open</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_u_sleeves_open_1" value="<?php echo @$measurement['mt1_u_sleeves_open_1']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_u_sleeves_open_2" value="<?php echo @$measurement['mt1_u_sleeves_open_2']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_u_sleeves_open_3" value="<?php echo @$measurement['mt1_u_sleeves_open_3']; ?>"/>
                          </div>
                          
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Arm Hole</label>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt1_u_armholes" value="<?php echo @$measurement['mt1_u_armholes']; ?>"/>
                          </div>
                          
                          
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Front Neck</label>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt1_u_frontneck" value="<?php echo @$measurement['mt1_u_frontneck']; ?>"/>
                          </div>
                          
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Back Neck</label>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt1_u_backneck" value="<?php echo @$measurement['mt1_u_backneck']; ?>"/>
                          </div>
                          
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Remarks</label>
                          </div>
                          
                          <div class="col-xs-12 col-sm-4">
                            <textarea name="mt1_remarks" class="form-control"><?php echo @$measurement['mt1_remarks']; ?></textarea>
                          </div>
                        </div>

                	</div>
              	</div>
             </div>
            <?php } ?>
            <?php if($typeid == 2) {?>
                          
                <div style="">
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                      <div class="row">
                          <div class="col-xs-12 col-sm-5"  style="text-align: center;">
                            <label>Upper Body</label>
                          </div>
                          
                          <div class="col-xs-12 col-sm-5" style="text-align: center;">
                            <label>Lower Body</label>
                          </div>

                        </div>
                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Length</label>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt1_u_length" value="<?php echo @$measurement['mt1_u_length']; ?>"/>
                          </div>
                          
                          <div class="col-xs-12 col-sm-2">
                            <label>Length</label>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt1_l_length" value="<?php echo @$measurement['mt1_l_length']; ?>"/>
                          </div>
                          
                          

                        </div>


                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Upper Chest</label>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt1_u_upper_chest" value="<?php echo @$measurement['mt1_u_upper_chest']; ?>"/>
                          </div>
                                             
                          <div class="col-xs-12 col-sm-2">
                            <label>Waist</label>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt1_l_waist" value="<?php echo @$measurement['mt1_l_waist']; ?>"/>
                          </div>
                          

                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Front Cross</label>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt1_u_front_cross" value="<?php echo @$measurement['mt1_u_front_cross']; ?>"/>
                          </div>
                         
                          <div class="col-xs-12 col-sm-2">
                            <label>Hip</label>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt1_l_hip" value="<?php echo @$measurement['mt1_l_hip']; ?>"/>
                          </div>
                          
                          

                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Chest</label>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt1_u_chest" value="<?php echo @$measurement['mt1_u_chest']; ?>"/>
                          </div>
                          
                          
                          <div class="col-xs-12 col-sm-2">
                            <label>Fork</label>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt1_l_fork" value="<?php echo @$measurement['mt1_l_fork']; ?>"/>
                          </div>
                          
                          

                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Dart Point</label>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt1_u_dartpoint" value="<?php echo @$measurement['mt1_u_dartpoint']; ?>"/>
                          </div>
                          
                          
                          <div class="col-xs-12 col-sm-2">
                            <label>Thigh</label>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt1_l_thigh" value="<?php echo @$measurement['mt1_l_thigh']; ?>"/>
                          </div>
                         
                          

                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Waist</label>
                          </div>
                          
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt1_u_waist" value="<?php echo @$measurement['mt1_u_waist']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label>Knee</label>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt1_l_knee" value="<?php echo @$measurement['mt1_l_knee']; ?>"/>
                          </div>
                          
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Hip</label>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt1_u_hip" value="<?php echo @$measurement['mt1_u_hip']; ?>"/>
                          </div>
                          
                          <div class="col-xs-12 col-sm-2">
                            <label>Ankle</label>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt1_l_ankle" value="<?php echo @$measurement['mt1_l_ankle']; ?>"/>
                          </div>
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Shoulder</label>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt1_u_shoulder" value="<?php echo @$measurement['mt1_u_shoulder']; ?>"/>
                          </div>
                          
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Sleeves Length</label>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt1_u_sleeves_length" value="<?php echo @$measurement['mt1_u_sleeves_length']; ?>"/>
                          </div>
                          
                          
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Sleeves Open</label>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt1_u_sleeves_open" value="<?php echo @$measurement['mt1_u_sleeves_open']; ?>"/>
                          </div>
                          
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Arm Hole</label>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt1_u_armholes" value="<?php echo @$measurement['mt1_u_armholes']; ?>"/>
                          </div>
                          
                          
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Front Neck</label>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt1_u_frontneck" value="<?php echo @$measurement['mt1_u_frontneck']; ?>"/>
                          </div>
                          
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Back Neck</label>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt1_u_backneck" value="<?php echo @$measurement['mt1_u_backneck']; ?>"/>
                          </div>
                          
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Remarks</label>
                          </div>
                          
                          <div class="col-xs-12 col-sm-4">
                            <textarea name="mt1_remarks" class="form-control"><?php echo @$measurement['mt1_remarks']; ?></textarea>
                          </div>
                        </div>

                  </div>
                </div>
             </div>

            <?php } ?>
         

        </div>
      </div>
      <div class="box-footer">
        <input type="hidden" name="typeid" value="<?php echo @$typeid;?>">
        <input type="hidden" name="customerid" value="<?php echo @$customerid;?>">
        <input type="hidden" name="orderid" value="<?php echo @$orderid;?>">
        <button type="submit" name="add_measurement" value="1" class="btn btn-primary">ADD</button>
      </div>
    </form>
  </div>
  </section>
</div>
<script src="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
