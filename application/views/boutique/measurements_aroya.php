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
      <small>Measurement Aroya</small>
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
                          <br>
                          <div class="col-xs-12 col-sm-2">
                            <label><b style="font-size: 24px;">Measurements</b></label>
                          </div>
                        </div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-6 col-sm-2">
                            <label>Top Length</label>
                          </div>
                          <div class="col-xs-6 col-sm-5">
                            <input class="form-control" type="text" name="mt1_top_legth" value="<?php echo @$measurement['mt1_top_legth']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-6 col-sm-2">
                            <label>Shoulder Length</label>
                          </div>
                          <div class="col-xs-6 col-sm-5">
                            <input class="form-control" type="text" name="mt1_shoulder_length" value="<?php echo @$measurement['mt1_shoulder_length']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-6 col-sm-2">
                            <label>Arm Hole</label>
                          </div>
                          <div class="col-xs-6 col-sm-5">
                            <input class="form-control" type="text" name="mt1_arm_hole" value="<?php echo @$measurement['mt1_arm_hole']; ?>"/>
                          </div>
                      	</div>
                        <div class="row">
                          <br>
                          <div class="col-xs-6 col-sm-2">
                            <label>Chest</label>
                          </div>
                          <div class="col-xs-6 col-sm-5">
                            <input class="form-control" type="text" name="mt1_chest_1" value="<?php echo @$measurement['mt1_chest_1']; ?>"/>
                          </div>
                        </div>
                        <div class="row">
                          <br>
                          <div class="col-xs-6 col-sm-2">
                            <label>Bust</label>
                          </div>
                          <div class="col-xs-6 col-sm-5">
                            <input class="form-control" type="text" name="mt1_bust_1" value="<?php echo @$measurement['mt1_bust_1']; ?>"/>
                          </div>
                        </div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-6 col-sm-2">
                            <label>Waist</label>
                          </div>
                          <div class="col-xs-6 col-sm-5">
                            <input class="form-control" type="text" name="mt1_waist_1" value="<?php echo @$measurement['mt1_waist_1']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-6 col-sm-2">
                            <label>Hip</label>
                          </div>
                          <div class="col-xs-6 col-sm-5">
                            <input class="form-control" type="text" name="mt1_hip_1" value="<?php echo @$measurement['mt1_hip_1']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-6 col-sm-2">
                            <label>F Neck Length</label>
                          </div>
                          <div class="col-xs-6 col-sm-5">
                            <input class="form-control" type="text" name="mt1_fneck_length_1" value="<?php echo @$measurement['mt1_fneck_length_1']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-6 col-sm-2">
                            <label>F Neck Wide</label>
                          </div>
                          <div class="col-xs-6 col-sm-5">
                            <input class="form-control" type="text" name="mt1_fneck_wide_1" value="<?php echo @$measurement['mt1_fneck_wide_1']; ?>"/>
                          </div>
                      	</div>
                        <div class="row">
                          <br>
                          <div class="col-xs-6 col-sm-2">
                            <label>B Neck Length</label>
                          </div>
                          <div class="col-xs-6 col-sm-5">
                            <input class="form-control" type="text" name="mt1_bneck_length_1" value="<?php echo @$measurement['mt1_bneck_length_1']; ?>"/>
                          </div>
                        </div>
                        <div class="row">
                          <br>
                          <div class="col-xs-6 col-sm-2">
                            <label>B Neck Wide</label>
                          </div>
                          <div class="col-xs-6 col-sm-5">
                            <input class="form-control" type="text" name="mt1_bneck_wide_1" value="<?php echo @$measurement['mt1_bneck_wide_1']; ?>"/>
                          </div>
                        </div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-6 col-sm-2">
                            <label>Shoulder To Tip</label>
                          </div>
                          <div class="col-xs-6 col-sm-5">
                            <input class="form-control" type="text" name="mt1_shouldertip_1" value="<?php echo @$measurement['mt1_shouldertip_1']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-6 col-sm-2">
                            <label>Bust Point To Bust Point</label>
                          </div>
                          <div class="col-xs-6 col-sm-5">
                            <input class="form-control" type="text" name="mt1_bustpoint_1" value="<?php echo @$measurement['mt1_bustpoint_1']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-6 col-sm-2">
                            <label>Shoulder To Slit</label>
                          </div>
                          <div class="col-xs-6 col-sm-5">
                            <input class="form-control" type="text" name="mt1_soulderslit_1" value="<?php echo @$measurement['mt1_soulderslit_1']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-6 col-sm-2">
                            <label>Slit Round</label>
                          </div>
                          <div class="col-xs-6 col-sm-5">
                            <input class="form-control" type="text" name="mt1_slitround_1" value="<?php echo @$measurement['mt1_slitround_1']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-6 col-sm-2">
                            <label>Yolk Length</label>
                          </div>
                          <div class="col-xs-6 col-sm-5">
                            <input class="form-control" type="text" name="mt1_yolklength_1" value="<?php echo @$measurement['mt1_yolklength_1']; ?>"/>
                          </div>
                      	</div>
                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-6">
                            <label><b style="font-size: 24px;">Sleeve Measurements</b></label>
                          </div>
                        </div>
                        <div class="row">
                          <br>
                           <div class="col-xs-3 col-sm-3">
                            <label></label>
                          </div>
                          <div class="col-xs-3 col-sm-3">
                            <label>Length</label>
                          </div>
                          <div class="col-xs-3 col-sm-3">
                            <label>Round Right</label>
                          </div>
                           <div class="col-xs-3 col-sm-3">
                            <label>Round Left</label>
                          </div>
                        </div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-3 col-sm-3">
                            <label>Biceps/Short</label>
                          </div>
                          <div class="col-xs-3 col-sm-3">
                            <input class="form-control" type="text" name="mt1_biceps_2_1" value="<?php echo @$measurement['mt1_biceps_2_1']; ?>"/>
                          </div>
                          <div class="col-xs-3 col-sm-3">
                            <input class="form-control" type="text" name="mt1_biceps_2_2" value="<?php echo @$measurement['mt1_biceps_2_2']; ?>"/>
                          </div>
                          <div class="col-xs-3 col-sm-3">
                            <input class="form-control" type="text" name="mt1_biceps_2_3" value="<?php echo @$measurement['mt1_biceps_2_3']; ?>"/>
                          </div>
                      	</div>
                          <div class="row">
                          <br>
                          <div class="col-xs-3 col-sm-3">
                            <label>Elbow</label>
                          </div>
                          <div class="col-xs-3 col-sm-3">
                            <input class="form-control" type="text" name="mt1_elbow_2_1" value="<?php echo @$measurement['mt1_elbow_2_1']; ?>"/>
                          </div>
                          <div class="col-xs-3 col-sm-3">
                            <input class="form-control" type="text" name="mt1_elbow_2_2" value="<?php echo @$measurement['mt1_elbow_2_2']; ?>"/>
                          </div>
                          <div class="col-xs-3 col-sm-3">
                            <input class="form-control" type="text" name="mt1_elbow_2_3" value="<?php echo @$measurement['mt1_elbow_2_3']; ?>"/>
                          </div>
                        </div>
                          <div class="row">
                          <br>
                          <div class="col-xs-3 col-sm-3">
                            <label>Long</label>
                          </div>
                          <div class="col-xs-3 col-sm-3">
                            <input class="form-control" type="text" name="mt1_long_2_1" value="<?php echo @$measurement['mt1_long_2_1']; ?>"/>
                          </div>
                          <div class="col-xs-3 col-sm-3">
                            <input class="form-control" type="text" name="mt1_long_2_2" value="<?php echo @$measurement['mt1_long_2_2']; ?>"/>
                          </div>
                          <div class="col-xs-3 col-sm-3">
                            <input class="form-control" type="text" name="mt1_long_2_3" value="<?php echo @$measurement['mt1_long_2_3']; ?>"/>
                          </div>
                        </div>
                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-6">
                            <label><b style="font-size: 24px;">Bottom Measurements</b></label>
                          </div>
                        </div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-6 col-sm-2">
                            <label>Waist</label>
                          </div>
                          <div class="col-xs-6 col-sm-5">
                            <input class="form-control" type="text" name="mt1_waist_3_1" value="<?php echo @$measurement['mt1_waist_3_1']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-6 col-sm-2">
                            <label>Length</label>
                          </div>
                          <div class="col-xs-6 col-sm-5">
                            <input class="form-control" type="text" name="mt1_length_3_1" value="<?php echo @$measurement['mt1_length_3_1']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-6 col-sm-2">
                            <label>Thighs</label>
                          </div>
                          <div class="col-xs-6 col-sm-5">
                            <input class="form-control" type="text" name="mt1_thighs_3_1" value="<?php echo @$measurement['mt1_thighs_3_1']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-6 col-sm-2">
                            <label>Knee</label>
                          </div>
                          <div class="col-xs-6 col-sm-5">
                            <input class="form-control" type="text" name="mt1_knee_3_1" value="<?php echo @$measurement['mt1_knee_3_1']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-6 col-sm-2">
                            <label>Ankle</label>
                          </div>
                          <div class="col-xs-6 col-sm-5">
                            <input class="form-control" type="text" name="mt1_ankle_3_1" value="<?php echo @$measurement['mt1_ankle_3_1']; ?>"/>
                          </div>
                      	</div>
                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-6">
                            <label><b style="font-size: 24px;">Aditional Requirements</b></label>
                          </div>
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-3 col-sm-2">
                            <label>Zip</label>
                          </div>
                          <div class="col-xs-2 col-sm-2">
                           Back
                          </div>
                           <div class="col-xs-2 col-sm-1">
                            <input class="form-check-input" type="checkbox" name="mt1_zip_4_1" value="1" <?php if(@$measurement['mt1_zip_4_1']) echo 'checked'; ?>/>
                          </div>
                          <div class="col-xs-3 col-sm-2">
                           Side
                          </div>
                          <div class="col-xs-2 col-sm-1">
                            <input class="form-check-input" type="checkbox" name="mt1_zip_4_2" value="1" <?php if(@$measurement['mt1_zip_4_2']) echo 'checked'; ?>/>
                          </div>
                        </div>

                         <div class="row">
                          <br>
                          <div class="col-xs-3 col-sm-2">
                            <label>Lining</label>
                          </div>
                          <div class="col-xs-2 col-sm-2">
                           <label>Body</label>
                          </div>
                           <div class="col-xs-2 col-sm-1">
                            <input class="form-check-input" type="checkbox" name="mt1_lining_4_1" value="1" <?php if(@$measurement['mt1_lining_4_1']) echo 'checked'; ?>/>
                          </div>
                          <div class="col-xs-3 col-sm-2">
                           <label>Sleeve</label>
                          </div>
                          <div class="col-xs-2 col-sm-1">
                            <input class="form-check-input" type="checkbox" name="mt1_sleeve_4_1" value="1" <?php if(@$measurement['mt1_sleeve_4_1']) echo 'checked'; ?>/>
                          </div>
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-3 col-sm-2">
                            <label>Piping</label>
                          </div>
                          <div class="col-xs-2 col-sm-2">
                            <div class="checkbox">
                              <label><input type="checkbox" name="mt1_piping_4_1" value="1" <?php if(@$measurement['mt1_piping_4_1']) echo 'checked'; ?>>F.Neck</label>
                            </div>
                          </div>
                           <div class="col-xs-2 col-sm-1">
                            <div class="checkbox">
                              <label><input type="checkbox" name="mt1_piping_4_2" value="1" <?php if(@$measurement['mt1_piping_4_2']) echo 'checked'; ?>>B.Neck</label>
                            </div>
                          </div>
                          <div class="col-xs-2 col-sm-2">
                            <div class="checkbox">
                              <label><input type="checkbox" name="mt1_piping_4_3" value="1" <?php if(@$measurement['mt1_piping_4_3']) echo 'checked'; ?>>Slit</label>
                            </div>
                          </div>
                          <div class="col-xs-2 col-sm-1">
                           <div class="checkbox">
                              <label><input type="checkbox" name="mt1_piping_4_4" value="1" <?php if(@$measurement['mt1_piping_4_4']) echo 'checked'; ?>>Sleeve</label>
                            </div>
                          </div>
                        </div>
                       

                        <div class="row">
                          <br>
                          <div class="col-xs-3 col-sm-2">
                            <label>Pad</label>
                          </div>
                          <div class="col-xs-2 col-sm-2">

                            <div class="checkbox">
                              <label><input type="checkbox" name="mt1_pad_4_1" value="1" <?php if(@$measurement['mt1_pad_4_1']) echo 'checked'; ?>></label>
                            </div>
                          </div>
                          <div class="col-xs-3 col-sm-2">
                           <label>Pad Size</label>
                          </div>
                          <div class="col-xs-4 col-sm-2">
                            <input class="form-control" type="text" name="mt1_pad_4_3" value="<?php echo @$measurement['mt1_pad_4_3']; ?>"/>
                          </div>
                        </div>

                         <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-6">
                            <label><b style="font-size: 24px;">Design Requirements</b></label>
                          </div>
                        </div>
                      	 <div class="row">
                          <br>
                          <div class="col-xs-4 col-sm-2">
                            <label>Princess Cut</label>
                          </div>
                          <div class="col-xs-2 col-sm-1">
                            <input class="form-check-input" type="checkbox" name="mt1_princess_cut_5_1" value="1" <?php if(@$measurement['mt1_princess_cut_5_1']) echo 'checked'; ?>/>
                          </div>
                          <div class="col-xs-6 col-sm-3">
                            <input class="form-control" type="text" name="mt1_princess_cut_5_2" value="<?php echo @$measurement['mt1_princess_cut_5_2']; ?>"/>
                          </div>
                    
                        </div>
                        <div class="row">
                          <br>
                          <div class="col-xs-4 col-sm-2">
                            <label>Panel Cut</label>
                          </div>
                          <div class="col-xs-2 col-sm-1">
                            <input class="form-check-input" type="checkbox" name="mt1_panel_cut_5_1" value="1" <?php if(@$measurement['mt1_panel_cut_5_1']) echo 'checked'; ?>/>
                          </div>
                          <div class="col-xs-6 col-sm-3">
                            <input class="form-control" type="text" name="mt1_panel_cut_5_2" value="<?php echo @$measurement['mt1_panel_cut_5_2']; ?>"/>
                          </div>
                    
                        </div>
                        <div class="row">
                          <br>
                          <div class="col-xs-4 col-sm-2">
                            <label>Round Umbrella</label>
                          </div>
                          <div class="col-xs-2 col-sm-1">
                            <input class="form-check-input" type="checkbox" name="mt1_round_umbrella_5_1" value="1" <?php if(@$measurement['mt1_round_umbrella_5_1']) echo 'checked'; ?>/>
                          </div>
                          <div class="col-xs-6 col-sm-3">
                            <input class="form-control" type="text" name="mt1_round_umbrella_5_2" value="<?php echo @$measurement['mt1_round_umbrella_5_2']; ?>"/>
                          </div>
                    
                        </div>
                        <div class="row">
                          <br>
                          <div class="col-xs-4 col-sm-2">
                            <label>Straight Umbrella</label>
                          </div>
                          <div class="col-xs-2 col-sm-1">
                            <input class="form-check-input" type="checkbox" name="mt1_straight_umbrella_5_1" value="1" <?php if(@$measurement['mt1_straight_umbrella_5_1']) echo 'checked'; ?>/>
                          </div>
                          <div class="col-xs-6 col-sm-3">
                            <input class="form-control" type="text" name="mt1_straight_umbrella_5_2" value="<?php echo @$measurement['mt1_straight_umbrella_5_2']; ?>"/>
                          </div>
                    
                        </div>
                        <div class="row">
                          <br>
                          <div class="col-xs-4 col-sm-2">
                            <label>Straight Kurta</label>
                          </div>
                          <div class="col-xs-2 col-sm-1">
                            <input class="form-check-input" type="checkbox" name="mt1_straight_kurta_5_1" value="1" <?php if(@$measurement['mt1_straight_kurta_5_1']) echo 'checked'; ?>/>
                          </div>
                          <div class="col-xs-6 col-sm-3">
                            <input class="form-control" type="text" name="mt1_straight_kurta_5_2" value="<?php echo @$measurement['mt1_straight_kurta_5_2']; ?>" />
                          </div>
                    
                        </div>
                        <div class="row">
                          <br>
                          <div class="col-xs-4 col-sm-2">
                            <label>Embroidery</label>
                          </div>
                          <div class="col-xs-2 col-sm-1">
                            <input class="form-check-input" type="checkbox" name="mt1_embroidery_5_1" value="1" <?php if(@$measurement['mt1_embroidery_5_1']) echo 'checked'; ?>/>
                          </div>
                          <div class="col-xs-6 col-sm-3">
                            <input class="form-control" type="text" name="mt1_embroidery_5_2" value="<?php echo @$measurement['mt1_embroidery_5_2']; ?>" />
                          </div>
                    
                        </div>

                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-12 col-sm-2">
                            <label>Remarks</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
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
                          <div class="col-xs-12 col-sm-3">
                            <label>Front Neck - Length</label>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt2_frontneck_length" value="<?php echo @$measurement['mt2_frontneck_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <label>Front Neck - Width</label>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt2_frontneck_width"  value="<?php echo @$measurement['mt2_frontneck_width']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                          <div class="col-xs-12 col-sm-3">
                            <label>Back Neck - Length</label>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt2_backneck_length" value="<?php echo @$measurement['mt2_backneck_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <label>Back Neck - Width</label>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt2_backneck_width" value="<?php echo @$measurement['mt2_backneck_width']; ?>"/>
                          </div>

                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-12 col-sm-2">
                            <label>Chest</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt2_chest_1" value="<?php echo @$measurement['mt2_chest_1']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt2_chest_2" value="<?php echo @$measurement['mt2_chest_2']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-12 col-sm-2">
                            <label>Breast Point</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt2_breast_point_1" value="<?php echo @$measurement['mt2_breast_point_1']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt2_breast_point_2" value="<?php echo @$measurement['mt2_breast_point_2']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-12 col-sm-2">
                            <label>Breast Distance</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt2_breast_distance_1" value="<?php echo @$measurement['mt2_breast_distance_1']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-12 col-sm-2">
                            <label>Waist</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt2_waist_1" value="<?php echo @$measurement['mt2_waist_1']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt2_waist_2" value="<?php echo @$measurement['mt2_waist_2']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-12 col-sm-2">
                            <label>Yoke</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt2_yoke_1" value="<?php echo @$measurement['mt2_yoke_1']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt2_yoke_2" value="<?php echo @$measurement['mt2_yoke_2']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-12 col-sm-2">
                            <label>HIP</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt2_hip_1" value="<?php echo @$measurement['mt2_hip_1']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt2_hip_2" value="<?php echo @$measurement['mt2_hip_2']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-12 col-sm-2">
                            <label>Slit</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt2_slit_1" value="<?php echo @$measurement['mt2_slit_1']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-12 col-sm-2">
                            <label>Sleeve Total</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt2_sleevetotal_1" value="<?php echo @$measurement['mt2_sleevetotal_1']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt2_sleevetotal_2" value="<?php echo @$measurement['mt2_sleevetotal_2']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-12 col-sm-2">
                            <label>Sleeve Middle</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt2_sleevemiddle_1" value="<?php echo @$measurement['mt2_sleevemiddle_1']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt2_sleevemiddle_2" value="<?php echo @$measurement['mt2_sleevemiddle_2']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-12 col-sm-2">
                            <label>Armhole</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt2_armhole_1" value="<?php echo @$measurement['mt2_armhole_1']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-12 col-sm-2">
                            <label>Shoulder</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt2_shoulder_1" value="<?php echo @$measurement['mt2_shoulder_1']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-12 col-sm-2">
                            <label>Finished Shoulder</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt2_finished_shoulder_1" value="<?php echo @$measurement['mt2_finished_shoulder_1']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-12 col-sm-2">
                            <label>Total Length</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt2_totallength_1" value="<?php echo @$measurement['mt2_totallength_1']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-12 col-sm-2">
                            <label>Waist</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt2_waist_3" value="<?php echo @$measurement['mt2_waist_3']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-12 col-sm-2">
                            <label>HIP</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt2_hip_3" value="<?php echo @$measurement['mt2_hip_3']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt2_hip_4" value="<?php echo @$measurement['mt2_hip_4']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-12 col-sm-2">
                            <label>Middle/Thighs</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt2_middle_thighs_1" value="<?php echo @$measurement['mt2_middle_thighs_1']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt2_middle_thighs_2" value="<?php echo @$measurement['mt2_middle_thighs_2']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-12 col-sm-2">
                            <label>¾th</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt2_3th_1" value="<?php echo @$measurement['mt2_3th_1']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt2_3th_2" value="<?php echo @$measurement['mt2_3th_2']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-12 col-sm-2">
                            <label>Leg Open</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt2_legopen_1" value="<?php echo @$measurement['mt2_legopen_1']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-12 col-sm-2">
                            <label>Total Length</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt2_totallength_2" value="<?php echo @$measurement['mt2_totallength_2']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-12 col-sm-2">
                            <label>Remarks</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <textarea name="mt2_remarks" class="form-control"><?php echo @$measurement['mt2_remarks']; ?></textarea>
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
