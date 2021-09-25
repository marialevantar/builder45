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
      <small>Measurement Minnara</small>
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
                          <div class="col-xs-12 col-sm-8">
                            <label>Full length</label>
                            <input class="form-control" type="text" name="mt1_full_length" value="<?php echo @$measurement['mt1_full_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-4">
                            <label>Remarks</label>
                            <textarea name="mt1_remarks" class="form-control"><?php echo @$measurement['mt1_remarks']; ?></textarea>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Shoulder</label>
                            <input class="form-control" type="text" name="mt1_shoulder" value="<?php echo @$measurement['mt1_shoulder']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Upper Chest</label>
                            <input class="form-control" type="text" name="mt1_upper_chest" value="<?php echo @$measurement['mt1_upper_chest']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Brust</label>
                            <input class="form-control" type="text" name="mt1_brust" value="<?php echo @$measurement['mt1_brust']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Shape (Stomach)</label>
                            <input class="form-control" type="text" name="mt1_shape" value="<?php echo @$measurement['mt1_shape']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Hip</label>
                            <input class="form-control" type="text" name="mt1_hip" value="<?php echo @$measurement['mt1_hip']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Slite Length</label>
                            <input class="form-control" type="text" name="mt1_slite_length" value="<?php echo @$measurement['mt1_slite_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Slite Round</label>
                            <input class="form-control" type="text" name="mt1_slite_round" value="<?php echo @$measurement['mt1_slite_round']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Flair</label>
                            <input class="form-control" type="text" name="mt1_flair" value="<?php echo @$measurement['mt1_flair']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Sleeve Length</label>
                            <input class="form-control" type="text" name="mt1_sleeve_length" value="<?php echo @$measurement['mt1_sleeve_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Sleeve Round</label>
                            <input class="form-control" type="text" name="mt1_sleeve_round" value="<?php echo @$measurement['mt1_sleeve_round']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Arm Hole</label>
                            <input class="form-control" type="text" name="mt1_arm_hole" value="<?php echo @$measurement['mt1_arm_hole']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Front Neck Length</label>
                            <input class="form-control" type="text" name="mt1_front_neck_length" value="<?php echo @$measurement['mt1_front_neck_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Back Neck Length</label>
                            <input class="form-control" type="text" name="mt1_back_neck_length" value="<?php echo @$measurement['mt1_back_neck_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Shoulder Wide</label>
                            <input class="form-control" type="text" name="mt1_shoulder_wide" value="<?php echo @$measurement['mt1_shoulder_wide']; ?>"/>
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
                            <label>Full Length</label>
                            <input class="form-control" type="text" name="mt1_b_full_length" value="<?php echo @$measurement['mt1_b_full_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Knee Round</label>
                            <input class="form-control" type="text" name="mt1_b_knee_round" value="<?php echo @$measurement['mt1_b_knee_round']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Bottom Round</label>
                            <input class="form-control" type="text" name="mt1_b_round" value="<?php echo @$measurement['mt1_b_round']; ?>"/>
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
                          <div class="col-xs-12 col-sm-8">
                            <label>Full length</label>
                            <input class="form-control" type="text" name="mt2_full_length" value="<?php echo @$measurement['mt2_full_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-4">
                            <label>Remarks</label>
                            <textarea name="mt2_remarks" class="form-control"><?php echo @$measurement['mt2_remarks']; ?></textarea>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Shoulder</label>
                            <input class="form-control" type="text" name="mt2_shoulder" value="<?php echo @$measurement['mt2_shoulder']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Upper Chest</label>
                            <input class="form-control" type="text" name="mt2_upper_chest" value="<?php echo @$measurement['mt2_upper_chest']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Brust</label>
                            <input class="form-control" type="text" name="mt2_brust" value="<?php echo @$measurement['mt2_brust']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Shape (Stomach)</label>
                            <input class="form-control" type="text" name="mt2_shape" value="<?php echo @$measurement['mt2_shape']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Hip</label>
                            <input class="form-control" type="text" name="mt2_hip" value="<?php echo @$measurement['mt2_hip']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Slite Length</label>
                            <input class="form-control" type="text" name="mt2_slite_length" value="<?php echo @$measurement['mt2_slite_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Slite Round</label>
                            <input class="form-control" type="text" name="mt2_slite_round" value="<?php echo @$measurement['mt2_slite_round']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Flair</label>
                            <input class="form-control" type="text" name="mt2_flair" value="<?php echo @$measurement['mt2_flair']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Sleeve Length</label>
                            <input class="form-control" type="text" name="mt2_sleeve_length" value="<?php echo @$measurement['mt2_sleeve_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Sleeve Round</label>
                            <input class="form-control" type="text" name="mt2_sleeve_round" value="<?php echo @$measurement['mt2_sleeve_round']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Arm Hole</label>
                            <input class="form-control" type="text" name="mt2_arm_hole" value="<?php echo @$measurement['mt2_arm_hole']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Front Neck Length</label>
                            <input class="form-control" type="text" name="mt2_front_neck_length" value="<?php echo @$measurement['mt2_front_neck_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Back Neck Length</label>
                            <input class="form-control" type="text" name="mt2_back_neck_length" value="<?php echo @$measurement['mt2_back_neck_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Shoulder Wide</label>
                            <input class="form-control" type="text" name="mt2_shoulder_wide" value="<?php echo @$measurement['mt2_shoulder_wide']; ?>"/>
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
                            <label>Full Length</label>
                            <input class="form-control" type="text" name="mt2_b_full_length" value="<?php echo @$measurement['mt2_b_full_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Knee Round</label>
                            <input class="form-control" type="text" name="mt2_b_knee_round" value="<?php echo @$measurement['mt2_b_knee_round']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>Bottom Round</label>
                            <input class="form-control" type="text" name="mt2_b_round" value="<?php echo @$measurement['mt2_b_round']; ?>"/>
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
