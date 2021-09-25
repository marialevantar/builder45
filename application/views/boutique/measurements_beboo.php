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
      <small>Measurement Beboo</small>
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
                          <div class="col-xs-12 col-sm-3">
                            <label>Front Neck - Length</label>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt1_frontneck_length" value="<?php echo @$measurement['mt1_frontneck_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <label>Front Neck - Width</label>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt1_frontneck_width" value="<?php echo @$measurement['mt1_frontneck_width']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                          <div class="col-xs-12 col-sm-3">
                            <label>Back Neck - Length</label>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt1_backneck_length" value="<?php echo @$measurement['mt1_backneck_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <label>Back Neck - Width</label>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <input class="form-control" type="text" name="mt1_backneck_width" value="<?php echo @$measurement['mt1_backneck_width']; ?>"/>
                          </div>

                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-12 col-sm-2">
                            <label>Chest</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt1_chest_1" value="<?php echo @$measurement['mt1_chest_1']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt1_chest_2" value="<?php echo @$measurement['mt1_chest_2']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-12 col-sm-2">
                            <label>Breast Point</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt1_breast_point_1" value="<?php echo @$measurement['mt1_breast_point_1']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt1_breast_point_2" value="<?php echo @$measurement['mt1_breast_point_2']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-12 col-sm-2">
                            <label>Breast Distance</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt1_breast_distance_1" value="<?php echo @$measurement['mt1_breast_distance_1']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-12 col-sm-2">
                            <label>Waist</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt1_waist_1" value="<?php echo @$measurement['mt1_waist_1']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt1_waist_2" value="<?php echo @$measurement['mt1_waist_2']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-12 col-sm-2">
                            <label>Yoke</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt1_yoke_1" value="<?php echo @$measurement['mt1_yoke_1']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt1_yoke_2" value="<?php echo @$measurement['mt1_yoke_2']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-12 col-sm-2">
                            <label>HIP</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt1_hip_1" value="<?php echo @$measurement['mt1_hip_1']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt1_hip_2" value="<?php echo @$measurement['mt1_hip_2']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-12 col-sm-2">
                            <label>Slit</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt1_slit_1" value="<?php echo @$measurement['mt1_slit_1']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-12 col-sm-2">
                            <label>Sleeve Total</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt1_sleevetotal_1" value="<?php echo @$measurement['mt1_sleevetotal_1']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt1_sleevetotal_2" value="<?php echo @$measurement['mt1_sleevetotal_2']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-12 col-sm-2">
                            <label>Sleeve Middle</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt1_sleevemiddle_1" value="<?php echo @$measurement['mt1_sleevemiddle_1']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt1_sleevemiddle_2" value="<?php echo @$measurement['mt1_sleevemiddle_2']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-12 col-sm-2">
                            <label>Armhole</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt1_armhole_1" value="<?php echo @$measurement['mt1_armhole_1']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-12 col-sm-2">
                            <label>Shoulder</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt1_shoulder_1" value="<?php echo @$measurement['mt1_shoulder_1']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-12 col-sm-2">
                            <label>Finished Shoulder</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt1_finished_shoulder_1" value="<?php echo @$measurement['mt1_finished_shoulder_1']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-12 col-sm-2">
                            <label>Total Length</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt1_totallength_1" value="<?php echo @$measurement['mt1_totallength_1']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-12 col-sm-2">
                            <label>Waist</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt1_waist_3" value="<?php echo @$measurement['mt1_waist_3']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-12 col-sm-2">
                            <label>HIP</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt1_hip_3" value="<?php echo @$measurement['mt1_hip_3']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt1_hip_4" value="<?php echo @$measurement['mt1_hip_4']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-12 col-sm-2">
                            <label>Middle/Thighs</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt1_middle_thighs_1" value="<?php echo @$measurement['mt1_middle_thighs_1']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt1_middle_thighs_2" value="<?php echo @$measurement['mt1_middle_thighs_2']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-12 col-sm-2">
                            <label>¾th</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt1_3th_1" value="<?php echo @$measurement['mt1_3th_1']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt1_3th_2" value="<?php echo @$measurement['mt1_3th_2']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-12 col-sm-2">
                            <label>Leg Open</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt1_legopen_1" value="<?php echo @$measurement['mt1_legopen_1']; ?>"/>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                      	  <div class="col-xs-12 col-sm-2">
                            <label>Total Length</label>
                          </div>
                          <div class="col-xs-12 col-sm-5">
                            <input class="form-control" type="text" name="mt1_totallength_2" value="<?php echo @$measurement['mt1_totallength_2']; ?>"/>
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
