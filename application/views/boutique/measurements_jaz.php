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
      <small>Measurement Jaz</small>
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
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>Blouse</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>Top</label>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label>Bottom</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>Salvar</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>Churidar</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>Plazo</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>Plazo</label>
                          </div>

                      	</div>
                      	<div class="row">
                      	  <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Length</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_blouse_length" value="<?php echo @$measurement['mt1_blouse_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_top_length" value="<?php echo @$measurement['mt1_top_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label>Length</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_salwar_length" value="<?php echo @$measurement['mt1_salwar_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_churidar_length" value="<?php echo @$measurement['mt1_churidar_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_plazo_length" value="<?php echo @$measurement['mt1_plazo_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_plazo_length" value="<?php echo @$measurement['mt1_plazo_length']; ?>"/>
                          </div>

                      	</div>


                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Over Bust</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_blouse_over_bust" value="<?php echo @$measurement['mt1_blouse_over_bust']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_top_over_bust" value="<?php echo @$measurement['mt1_top_over_bust']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label>Upper thing</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_salwar_upper_thing" value="<?php echo @$measurement['mt1_salwar_upper_thing']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_churidar_upper_thing" value="<?php echo @$measurement['mt1_churidar_upper_thing']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_plazo_upper_thing" value="<?php echo @$measurement['mt1_plazo_upper_thing']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_plazo_upper_thing" value="<?php echo @$measurement['mt1_plazo_upper_thing']; ?>"/>
                          </div>

                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Chest</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_blouse_chest" value="<?php echo @$measurement['mt1_blouse_chest']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_top_chest" value="<?php echo @$measurement['mt1_top_chest']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label>Mid thigh</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_salwar_mid_thigh" value="<?php echo @$measurement['mt1_salwar_mid_thigh']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_churidar_mid_thigh" value="<?php echo @$measurement['mt1_churidar_mid_thigh']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_plazo_mid_thigh" value="<?php echo @$measurement['mt1_plazo_mid_thigh']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_plazo_mid_thigh" value="<?php echo @$measurement['mt1_plazo_mid_thigh']; ?>"/>
                          </div>

                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Under Bust</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_blouse_under_bust" value="<?php echo @$measurement['mt1_blouse_under_bust']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_top_under_bust" value="<?php echo @$measurement['mt1_top_under_bust']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label>Lower thigh</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_salwar_lower_thigh" value="<?php echo @$measurement['mt1_salwar_lower_thigh']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_churidar_lower_thigh" value="<?php echo @$measurement['mt1_churidar_lower_thigh']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_plazo_lower_thigh" value="<?php echo @$measurement['mt1_plazo_lower_thigh']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_plazo_lower_thigh" value="<?php echo @$measurement['mt1_plazo_lower_thigh']; ?>"/>
                          </div>

                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Waist</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_blouse_waist" value="<?php echo @$measurement['mt1_blouse_waist']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_blouse_waist" value="<?php echo @$measurement['mt1_top_waist']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label>Knee</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_salwar_knee" value="<?php echo @$measurement['mt1_salwar_knee']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_churidar_knee" value="<?php echo @$measurement['mt1_churidar_knee']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_plazo_knee" value="<?php echo @$measurement['mt1_plazo_knee']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_plazo_knee" value="<?php echo @$measurement['mt1_plazo_knee']; ?>"/>
                          </div>

                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Hip</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_blouse_hip" value="<?php echo @$measurement['mt1_blouse_hip']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_top_hip" value="<?php echo @$measurement['mt1_top_hip']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label>Calf</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_salwar_calf" value="<?php echo @$measurement['mt1_salwar_calf']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_churidar_calf" value="<?php echo @$measurement['mt1_churidar_calf']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_plazo_calf" value="<?php echo @$measurement['mt1_plazo_calf']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_plazo_calf" value="<?php echo @$measurement['mt1_plazo_calf']; ?>"/>
                          </div>

                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Seat</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_blouse_seat" value="<?php echo @$measurement['mt1_blouse_seat']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_blouse_seat" value="<?php echo @$measurement['mt1_top_seat']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label>Ankle</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_salwar_ankle" value="<?php echo @$measurement['mt1_salwar_ankle']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_churidar_ankle" value="<?php echo @$measurement['mt1_churidar_ankle']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_plazo_ankle" value="<?php echo @$measurement['mt1_plazo_ankle']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_plazo_ankle" value="<?php echo @$measurement['mt1_plazo_ankle']; ?>"/>
                          </div>

                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Slit</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_blouse_slit" value="<?php echo @$measurement['mt1_blouse_slit']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_top_slit" value="<?php echo @$measurement['mt1_top_slit']; ?>"/>
                          </div>
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Shoulder</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_blouse_shoulder" value="<?php echo @$measurement['mt1_blouse_shoulder']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_top_shoulder" value="<?php echo @$measurement['mt1_top_shoulder']; ?>"/>
                          </div>
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Front across</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_blouse_front_across" value="<?php echo @$measurement['mt1_blouse_front_across']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_top_front_across" value="<?php echo @$measurement['mt1_top_front_across']; ?>"/>
                          </div>
                        </div>
                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Back across</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_blouse_back_across" value="<?php echo @$measurement['mt1_blouse_back_across']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_top_back_across" value="<?php echo @$measurement['mt1_top_back_across']; ?>"/>
                          </div>
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Front neck</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_blouse_front_neck" value="<?php echo @$measurement['mt1_blouse_front_neck']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_top_front_neck" value="<?php echo @$measurement['mt1_top_front_neck']; ?>"/>
                          </div>
                        </div>


                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Back neck</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_blouse_back_neck" value="<?php echo @$measurement['mt1_blouse_back_neck']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_top_back_neck" value="<?php echo @$measurement['mt1_top_back_neck']; ?>"/>
                          </div>
                        </div>


                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Arm Hole</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_blouse_arm_hole" value="<?php echo @$measurement['mt1_blouse_arm_hole']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_top_arm_hole" value="<?php echo @$measurement['mt1_top_arm_hole']; ?>"/>
                          </div>
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Sleeve length</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_blouse_sleeve_length" value="<?php echo @$measurement['mt1_blouse_sleeve_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_top_sleeve_length" value="<?php echo @$measurement['mt1_top_sleeve_length']; ?>"/>
                          </div>
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Biceps</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_blouse_biceps" value="<?php echo @$measurement['mt1_blouse_biceps']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_top_biceps" value="<?php echo @$measurement['mt1_top_biceps']; ?>"/>
                          </div>
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Forearm</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_blouse_forearm" value="<?php echo @$measurement['mt1_blouse_forearm']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_top_forearm" value="<?php echo @$measurement['mt1_top_forearm']; ?>"/>
                          </div>
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Writst</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_blouse_wrist" value="<?php echo @$measurement['mt1_blouse_wrist']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_top_wrist" value="<?php echo @$measurement['mt1_top_wrist']; ?>"/>
                          </div>
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Yoke Length</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_blouse_yoke_length" value="<?php echo @$measurement['mt1_blouse_yoke_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_top_yoke_length" value="<?php echo @$measurement['mt1_top_yoke_length']; ?>"/>
                          </div>
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Skirt Length</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_blouse_skirt_length" value="<?php echo @$measurement['mt1_blouse_skirt_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_top_skirt_length" value="<?php echo @$measurement['mt1_top_skirt_length']; ?>"/>
                          </div>
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Skirt round</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_blouse_skirt_round" value="<?php echo @$measurement['mt1_blouse_skirt_round']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_top_skirt_round" value="<?php echo @$measurement['mt1_top_skirt_round']; ?>"/>
                          </div>
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Gown Lenth</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_blouse_gown_lenth" value="<?php echo @$measurement['mt1_blouse_gown_lenth']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_top_gown_lenth" value="<?php echo @$measurement['mt1_top_gown_lenth']; ?>"/>
                          </div>
                        </div>
                         
                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Flare Width</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_blouse_flare_width" value="<?php echo @$measurement['mt1_blouse_flare_width']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_top_flare_width" value="<?php echo @$measurement['mt1_top_flare_width']; ?>"/>
                          </div>
                        </div>

                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-12 col-sm-2">
                            <label>Front Neck</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <textarea name="mt1_front_neck" class="form-control"><?php echo @$measurement['mt1_front_neck']; ?></textarea>
                          </div>
                      	</div>
                      	<div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2">
                            <label>Back Neck</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <textarea name="mt1_back_neck" class="form-control"><?php echo @$measurement['mt1_back_neck']; ?></textarea>
                          </div>
                        </div>
                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2">
                            <label>Instructions</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <textarea name="mt1_instructions" class="form-control"><?php echo @$measurement['mt1_instructions']; ?></textarea>
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
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>Blouse</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>Top</label>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label>Bottom</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>Salvar</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>Churidar</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>Plazo</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>Plazo</label>
                          </div>

                        </div>
                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Length</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_blouse_length" value="<?php echo @$measurement['mt2_blouse_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_top_length" value="<?php echo @$measurement['mt2_top_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label>Length</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_salwar_length" value="<?php echo @$measurement['mt2_salwar_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_churidar_length" value="<?php echo @$measurement['mt2_churidar_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_plazo_length" value="<?php echo @$measurement['mt2_plazo_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_plazo_length" value="<?php echo @$measurement['mt2_plazo_length']; ?>"/>
                          </div>

                        </div>


                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Over Bust</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_blouse_over_bust" value="<?php echo @$measurement['mt2_blouse_over_bust']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_top_over_bust" value="<?php echo @$measurement['mt2_top_over_bust']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label>Upper thing</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_salwar_upper_thing" value="<?php echo @$measurement['mt2_salwar_upper_thing']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_churidar_upper_thing" value="<?php echo @$measurement['mt2_churidar_upper_thing']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_plazo_upper_thing" value="<?php echo @$measurement['mt2_plazo_upper_thing']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_plazo_upper_thing" value="<?php echo @$measurement['mt2_plazo_upper_thing']; ?>"/>
                          </div>

                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Chest</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_blouse_chest" value="<?php echo @$measurement['mt2_blouse_chest']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_top_chest" value="<?php echo @$measurement['mt2_top_chest']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label>Mid thigh</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_salwar_mid_thigh" value="<?php echo @$measurement['mt2_salwar_mid_thigh']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_churidar_mid_thigh" value="<?php echo @$measurement['mt2_churidar_mid_thigh']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_plazo_mid_thigh" value="<?php echo @$measurement['mt2_plazo_mid_thigh']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_plazo_mid_thigh" value="<?php echo @$measurement['mt2_plazo_mid_thigh']; ?>"/>
                          </div>

                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Under Bust</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_blouse_under_bust" value="<?php echo @$measurement['mt2_blouse_under_bust']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_top_under_bust" value="<?php echo @$measurement['mt2_top_under_bust']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label>Lower thigh</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_salwar_lower_thigh" value="<?php echo @$measurement['mt2_salwar_lower_thigh']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_churidar_lower_thigh" value="<?php echo @$measurement['mt2_churidar_lower_thigh']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_plazo_lower_thigh" value="<?php echo @$measurement['mt2_plazo_lower_thigh']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_plazo_lower_thigh" value="<?php echo @$measurement['mt2_plazo_lower_thigh']; ?>"/>
                          </div>

                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Waist</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_blouse_waist" value="<?php echo @$measurement['mt2_blouse_waist']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_blouse_waist" value="<?php echo @$measurement['mt2_top_waist']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label>Knee</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_salwar_knee" value="<?php echo @$measurement['mt2_salwar_knee']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_churidar_knee" value="<?php echo @$measurement['mt2_churidar_knee']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_plazo_knee" value="<?php echo @$measurement['mt2_plazo_knee']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_plazo_knee" value="<?php echo @$measurement['mt2_plazo_knee']; ?>"/>
                          </div>

                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Hip</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_blouse_hip" value="<?php echo @$measurement['mt2_blouse_hip']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_top_hip" value="<?php echo @$measurement['mt2_top_hip']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label>Calf</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_salwar_calf" value="<?php echo @$measurement['mt2_salwar_calf']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_churidar_calf" value="<?php echo @$measurement['mt2_churidar_calf']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_plazo_calf" value="<?php echo @$measurement['mt2_plazo_calf']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_plazo_calf" value="<?php echo @$measurement['mt2_plazo_calf']; ?>"/>
                          </div>

                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Seat</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_blouse_seat" value="<?php echo @$measurement['mt2_blouse_seat']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_blouse_seat" value="<?php echo @$measurement['mt2_top_seat']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label>Ankle</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_salwar_ankle" value="<?php echo @$measurement['mt2_salwar_ankle']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_churidar_ankle" value="<?php echo @$measurement['mt2_churidar_ankle']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_plazo_ankle" value="<?php echo @$measurement['mt2_plazo_ankle']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_plazo_ankle" value="<?php echo @$measurement['mt2_plazo_ankle']; ?>"/>
                          </div>

                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Slit</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_blouse_slit" value="<?php echo @$measurement['mt2_blouse_slit']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_top_slit" value="<?php echo @$measurement['mt2_top_slit']; ?>"/>
                          </div>
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Shoulder</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_blouse_shoulder" value="<?php echo @$measurement['mt2_blouse_shoulder']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_top_shoulder" value="<?php echo @$measurement['mt2_top_shoulder']; ?>"/>
                          </div>
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Front across</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_blouse_front_across" value="<?php echo @$measurement['mt2_blouse_front_across']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_top_front_across" value="<?php echo @$measurement['mt2_top_front_across']; ?>"/>
                          </div>
                        </div>
                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Back across</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_blouse_back_across" value="<?php echo @$measurement['mt2_blouse_back_across']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_top_back_across" value="<?php echo @$measurement['mt2_top_back_across']; ?>"/>
                          </div>
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Front neck</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_blouse_front_neck" value="<?php echo @$measurement['mt2_blouse_front_neck']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_top_front_neck" value="<?php echo @$measurement['mt2_top_front_neck']; ?>"/>
                          </div>
                        </div>


                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Back neck</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_blouse_back_neck" value="<?php echo @$measurement['mt2_blouse_back_neck']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_top_back_neck" value="<?php echo @$measurement['mt2_top_back_neck']; ?>"/>
                          </div>
                        </div>


                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Arm Hole</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_blouse_arm_hole" value="<?php echo @$measurement['mt2_blouse_arm_hole']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_top_arm_hole" value="<?php echo @$measurement['mt2_top_arm_hole']; ?>"/>
                          </div>
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Sleeve length</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_blouse_sleeve_length" value="<?php echo @$measurement['mt2_blouse_sleeve_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_top_sleeve_length" value="<?php echo @$measurement['mt2_top_sleeve_length']; ?>"/>
                          </div>
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Biceps</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_blouse_biceps" value="<?php echo @$measurement['mt2_blouse_biceps']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_top_biceps" value="<?php echo @$measurement['mt2_top_biceps']; ?>"/>
                          </div>
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Forearm</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_blouse_forearm" value="<?php echo @$measurement['mt2_blouse_forearm']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_top_forearm" value="<?php echo @$measurement['mt2_top_forearm']; ?>"/>
                          </div>
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Writst</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_blouse_wrist" value="<?php echo @$measurement['mt2_blouse_wrist']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_top_wrist" value="<?php echo @$measurement['mt2_top_wrist']; ?>"/>
                          </div>
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Yoke Length</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_blouse_yoke_length" value="<?php echo @$measurement['mt2_blouse_yoke_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_top_yoke_length" value="<?php echo @$measurement['mt2_top_yoke_length']; ?>"/>
                          </div>
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Skirt Length</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_blouse_skirt_length" value="<?php echo @$measurement['mt2_blouse_skirt_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_top_skirt_length" value="<?php echo @$measurement['mt2_top_skirt_length']; ?>"/>
                          </div>
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Skirt round</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_blouse_skirt_round" value="<?php echo @$measurement['mt2_blouse_skirt_round']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_top_skirt_round" value="<?php echo @$measurement['mt2_top_skirt_round']; ?>"/>
                          </div>
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Gown Lenth</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_blouse_gown_lenth" value="<?php echo @$measurement['mt2_blouse_gown_lenth']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_top_gown_lenth" value="<?php echo @$measurement['mt2_top_gown_lenth']; ?>"/>
                          </div>
                        </div>
                         
                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Flare Width</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_blouse_flare_width" value="<?php echo @$measurement['mt2_blouse_flare_width']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt2_top_flare_width" value="<?php echo @$measurement['mt2_top_flare_width']; ?>"/>
                          </div>
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2">
                            <label>Front Neck</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <textarea name="mt2_front_neck" class="form-control"><?php echo @$measurement['mt2_front_neck']; ?></textarea>
                          </div>
                        </div>
                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2">
                            <label>Back Neck</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <textarea name="mt2_back_neck" class="form-control"><?php echo @$measurement['mt2_back_neck']; ?></textarea>
                          </div>
                        </div>
                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2">
                            <label>Instructions</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <textarea name="mt2_instructions" class="form-control"><?php echo @$measurement['mt2_instructions']; ?></textarea>
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
