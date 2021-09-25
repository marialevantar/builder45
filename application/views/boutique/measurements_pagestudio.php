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
      <small>Measurement Page3Studio</small>
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
                      <div class="col-xs-12 col-sm-12">
                        <label>All Measures are in inches</label>
                        <br>
                        <label>Top</label>
                        <br><br>
                      </div>
                    </div>
                        <div class="row">
                          <div class="col-xs-12 col-sm-8">
                            <label>Top length (L)</label>
                            <input class="form-control" type="text" name="mt1_top_length" value="<?php echo @$measurement['mt1_top_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Upper Chest (UC)</label>
                            <input class="form-control" type="text" name="mt1_upper_chest" value="<?php echo @$measurement['mt1_upper_chest']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Chest (C)</label>
                            <input class="form-control" type="text" name="mt1_chest" value="<?php echo @$measurement['mt1_chest']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Shape (S)</label>
                            <input class="form-control" type="text" name="mt1_shape" value="<?php echo @$measurement['mt1_shape']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Hip (H)</label>
                            <input class="form-control" type="text" name="mt1_hip" value="<?php echo @$measurement['mt1_hip']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Shoulder (SHL)</label>
                            <input class="form-control" type="text" name="mt1_shoulder" value="<?php echo @$measurement['mt1_shoulder']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Sleeve (SL)</label>
                            <input class="form-control" type="text" name="mt1_sleeve" value="<?php echo @$measurement['mt1_sleeve']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Arm Hole (AH)</label>
                            <input class="form-control" type="text" name="mt1_arm_hole" value="<?php echo @$measurement['mt1_arm_hole']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Biceps (B)</label>
                            <input class="form-control" type="text" name="mt1_biceps" value="<?php echo @$measurement['mt1_biceps']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Elbow (E)</label>
                            <input class="form-control" type="text" name="mt1_elbow" value="<?php echo @$measurement['mt1_elbow']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Wrist (W)</label>
                            <input class="form-control" type="text" name="mt1_wrist" value="<?php echo @$measurement['mt1_wrist']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Front Neck</label>
                            <input class="form-control" type="text" name="mt1_front_neck" value="<?php echo @$measurement['mt1_front_neck']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Back Neck</label>
                            <input class="form-control" type="text" name="mt1_back_neck" value="<?php echo @$measurement['mt1_back_neck']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Collar (COL)</label>
                            <input class="form-control" type="text" name="mt1_collar" value="<?php echo @$measurement['mt1_collar']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Apex (BLOUSE)</label>
                            <input class="form-control" type="text" name="mt1_blouse" value="<?php echo @$measurement['mt1_blouse']; ?>"/>
                          </div>
                        </div>

                    <div class="row">
                      <div class="col-xs-12 col-sm-12">
                        <br>
                        <label>Bottom</label>
                        <br><br>
                      </div>
                    </div>
                    
                    <div class="row">
                          <div class="col-xs-12 col-sm-8">
                            <label>Length</label>
                            <input class="form-control" type="text" name="mt1_b_length" value="<?php echo @$measurement['mt1_b_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Hips</label>
                            <input class="form-control" type="text" name="mt1_b_hips" value="<?php echo @$measurement['mt1_b_hips']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Thighs</label>
                            <input class="form-control" type="text" name="mt1_b_thighs" value="<?php echo @$measurement['mt1_b_thighs']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Knees</label>
                            <input class="form-control" type="text" name="mt1_b_knees" value="<?php echo @$measurement['mt1_b_knees']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Calf</label>
                            <input class="form-control" type="text" name="mt1_b_calf" value="<?php echo @$measurement['mt1_b_calf']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Ankle</label>
                            <input class="form-control" type="text" name="mt1_b_ankle" value="<?php echo @$measurement['mt1_b_ankle']; ?>"/>
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
                      <div class="col-xs-12 col-sm-12">
                        <label>All Measures are in inches</label>
                        <br>
                        <label>Top</label>
                        <br><br>
                      </div>
                    </div>
                        <div class="row">
                          <div class="col-xs-12 col-sm-8">
                            <label>Top length (L)</label>
                            <input class="form-control" type="text" name="mt2_top_length" value="<?php echo @$measurement['mt2_top_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Upper Chest (UC)</label>
                            <input class="form-control" type="text" name="mt2_upper_chest" value="<?php echo @$measurement['mt2_upper_chest']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Chest (C)</label>
                            <input class="form-control" type="text" name="mt2_chest" value="<?php echo @$measurement['mt2_chest']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Shape (S)</label>
                            <input class="form-control" type="text" name="mt2_shape" value="<?php echo @$measurement['mt2_shape']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Hip (H)</label>
                            <input class="form-control" type="text" name="mt2_hip" value="<?php echo @$measurement['mt2_hip']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Shoulder (SHL)</label>
                            <input class="form-control" type="text" name="mt2_shoulder" value="<?php echo @$measurement['mt2_shoulder']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Sleeve (SL)</label>
                            <input class="form-control" type="text" name="mt2_sleeve" value="<?php echo @$measurement['mt2_sleeve']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Arm Hole (AH)</label>
                            <input class="form-control" type="text" name="mt2_arm_hole" value="<?php echo @$measurement['mt2_arm_hole']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Biceps (B)</label>
                            <input class="form-control" type="text" name="mt2_biceps" value="<?php echo @$measurement['mt2_biceps']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Elbow (E)</label>
                            <input class="form-control" type="text" name="mt2_elbow" value="<?php echo @$measurement['mt2_elbow']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Wrist (W)</label>
                            <input class="form-control" type="text" name="mt2_wrist" value="<?php echo @$measurement['mt2_wrist']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Front Neck</label>
                            <input class="form-control" type="text" name="mt2_front_neck" value="<?php echo @$measurement['mt2_front_neck']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Back Neck</label>
                            <input class="form-control" type="text" name="mt2_back_neck" value="<?php echo @$measurement['mt2_back_neck']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Collar (COL)</label>
                            <input class="form-control" type="text" name="mt2_collar" value="<?php echo @$measurement['mt2_collar']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Apex (BLOUSE)</label>
                            <input class="form-control" type="text" name="mt2_blouse" value="<?php echo @$measurement['mt2_blouse']; ?>"/>
                          </div>
                        </div>

                    <div class="row">
                      <div class="col-xs-12 col-sm-12">
                        <br>
                        <label>Bottom</label>
                        <br><br>
                      </div>
                    </div>
                    
                    <div class="row">
                          <div class="col-xs-12 col-sm-8">
                            <label>Length</label>
                            <input class="form-control" type="text" name="mt2_b_length" value="<?php echo @$measurement['mt2_b_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Hips</label>
                            <input class="form-control" type="text" name="mt2_b_hips" value="<?php echo @$measurement['mt2_b_hips']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Thighs</label>
                            <input class="form-control" type="text" name="mt2_b_thighs" value="<?php echo @$measurement['mt2_b_thighs']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Knees</label>
                            <input class="form-control" type="text" name="mt2_b_knees" value="<?php echo @$measurement['mt2_b_knees']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Calf</label>
                            <input class="form-control" type="text" name="mt2_b_calf" value="<?php echo @$measurement['mt2_b_calf']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Ankle</label>
                            <input class="form-control" type="text" name="mt2_b_ankle" value="<?php echo @$measurement['mt2_b_ankle']; ?>"/>
                          </div>
                    </div>
                                            
                </div>
              </div>


            <?php } ?>
          </div>

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
