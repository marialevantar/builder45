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
      <small>Measurement Madams Fashion House</small>
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
                          <div class="col-xs-12 col-sm-4">
                            <label>TOP</label>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label>Shape Length</label>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label>Full Length</label>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-xs-12 col-sm-2"> 
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <input class="form-control" type="text" name="mt1_top_shape_length" value="<?php echo @$measurement['mt1_top_shape_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <input class="form-control" type="text" name="mt1_top_full_length" value="<?php echo @$measurement['mt1_top_full_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>

                        </div>
                      </br>
                      <div class="row">
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label>Upper Chest</label>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label>Lower Chest</label>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label>Waist</label>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label>Seat</label>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-xs-12 col-sm-2"> 
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <input class="form-control" type="text" name="mt1_top_upper_chest" value="<?php echo @$measurement['mt1_top_upper_chest']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <input class="form-control" type="text" name="mt1_top_lower_chest" value="<?php echo @$measurement['mt1_top_lower_chest']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <input class="form-control" type="text" name="mt1_top_waist" value="<?php echo @$measurement['mt1_top_waist']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                           <input class="form-control" type="text" name="mt1_top_seat" value="<?php echo @$measurement['mt1_top_seat']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>

                        </div>
                        </br>
                        <div class="row">
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label>Shoulder</label>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label>Sleeve Length</label>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label>Sleeve End Width</label>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label>Arm Hole</label>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-xs-12 col-sm-2"> 
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <input class="form-control" type="text" name="mt1_top_shoulder" value="<?php echo @$measurement['mt1_top_shoulder']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <input class="form-control" type="text" name="mt1_top_sleeve_length" value="<?php echo @$measurement['mt1_top_sleeve_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <input class="form-control" type="text" name="mt1_top_sleeve_end_width" value="<?php echo @$measurement['mt1_top_sleeve_end_width']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                           <input class="form-control" type="text" name="mt1_top_sleeve_arm_hole" value="<?php echo @$measurement['mt1_top_sleeve_arm_hole']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>

                        </div>
                        </br>
                        <div class="row">
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label>Front Neck Depth</label>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label>Front Neck Width</label>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label>Breast Point</label>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-xs-12 col-sm-2"> 
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <input class="form-control" type="text" name="mt1_top_front_neck_depth" value="<?php echo @$measurement['mt1_top_front_neck_depth']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <input class="form-control" type="text" name="mt1_top_front_neck_width" value="<?php echo @$measurement['mt1_top_front_neck_width']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <input class="form-control" type="text" name="mt1_top_breast_point" value="<?php echo @$measurement['mt1_top_breast_point']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>

                        </div>
                         </br>
                        <div class="row">
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label>Back Neck</label>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label>Slit Length</label>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label>Flair</label>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>
                      </div>
                      <div class="row">
                          <div class="cos-12 col-sm-2"> 
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <input class="form-control" type="text" name="mt1_top_back_neck" value="<?php echo @$measurement['mt1_top_back_neck']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <input class="form-control" type="text" name="mt1_top_slit_length" value="<?php echo @$measurement['mt1_top_slit_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                             <input class="form-control" type="text" name="mt1_top_flair" value="<?php echo @$measurement['mt1_top_flair']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>

                        </div>
                      </br> </br>
                      <div class="row">
                          <div class="col-xs-12 col-sm-4">
                            <label>BOTTOM</label>
                          </div>
                      </div>
                    	<div class="row">
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>Churi Bottom</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>Pant</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>Pencil Bottom</label>
                          </div>
  
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>Salwar Bottom</label>
                          </div>
                      	</div>
                      	<div class="row">
                      	  <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Thigh Length</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_cb_thigh_length" value="<?php echo @$measurement['mt1_cb_thigh_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_p_thigh_length" value="<?php echo @$measurement['mt1_p_thigh_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_pb_thigh_length" value="<?php echo @$measurement['mt1_pb_thigh_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label>Bottom Length</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_sb_bottom_length" value="<?php echo @$measurement['mt1_sb_bottom_length']; ?>"/>
                          </div>

                      	</div>


                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Knee Length</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_cb_knee_length" value="<?php echo @$measurement['mt1_cb_knee_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_p_knee_length" value="<?php echo @$measurement['mt1_p_knee_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_pb_knee_length" value="<?php echo @$measurement['mt1_pb_knee_length']; ?>"/>
                          </div>                    
                          <div class="col-xs-12 col-sm-2">
                            <label>End Width</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_sb_end_width" value="<?php echo @$measurement['mt1_sb_end_width']; ?>"/>
                          </div>
                          

                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Full Length</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_cb_full_length" value="<?php echo @$measurement['mt1_cb_full_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_p_full_length" value="<?php echo @$measurement['mt1_p_full_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_pb_full_length" value="<?php echo @$measurement['mt1_pb_full_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label>Waist Width</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_sb_waist_width" value="<?php echo @$measurement['mt1_sb_waist_width']; ?>"/>
                          </div>
                          

                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Waist Width</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_cb_waist_width" value="<?php echo @$measurement['mt1_cb_waist_width']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_p_waist_width" value="<?php echo @$measurement['mt1_p_waist_width']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_pb_waist_width" value="<?php echo @$measurement['mt1_pb_waist_width']; ?>"/>
                          </div>
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Seat Width</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_p_seat_width" value="<?php echo @$measurement['mt1_p_seat_width']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_pb_seat_width" value="<?php echo @$measurement['mt1_pb_seat_width']; ?>"/>
                          </div>

                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Things Width</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_cb_things_width" value="<?php echo @$measurement['mt1_cb_things_width']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_p_things_width" value="<?php echo @$measurement['mt1_p_things_width']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_pb_things_width" value="<?php echo @$measurement['mt1_pb_things_width']; ?>"/>
                          </div>

                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Knee Width</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_cb_knee_width" value="<?php echo @$measurement['mt1_cb_knee_width']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_p_knee_width" value="<?php echo @$measurement['mt1_p_knee_width']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_pb_knee_width" value="<?php echo @$measurement['mt1_pb_knee_width']; ?>"/>
                          </div>
                          
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Ankle Width</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_cb_ankle_width" value="<?php echo @$measurement['mt1_cb_ankle_width']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>End Width</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_p_end_width" value="<?php echo @$measurement['mt1_p_end_width']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_pb_end_width" value="<?php echo @$measurement['mt1_pb_end_width']; ?>"/>
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
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>Blouse</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>Dress</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>Gown</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>Lehenga <br>1.Blouse</label>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>Pencil fit Pant</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>Normal pant</label>
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
                            <input class="form-control" type="text" name="mt1_dress_shoulder" value="<?php echo @$measurement['mt1_dress_shoulder']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_gown_shoulder" value="<?php echo @$measurement['mt1_gown_shoulder']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_lehenga_shoulder" value="<?php echo @$measurement['mt1_lehenga_shoulder']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label>Length</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_pencilpant_length" value="<?php echo @$measurement['mt1_pencilpant_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_normalpant_length" value="<?php echo @$measurement['mt1_normalpant_length']; ?>"/>
                          </div>
                          

                        </div>


                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Length/Full Length</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_blouse_length" value="<?php echo @$measurement['mt1_blouse_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_dress_length" value="<?php echo @$measurement['mt1_dress_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_gown_length" value="<?php echo @$measurement['mt1_gown_length']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_lehenga_length" value="<?php echo @$measurement['mt1_lehenga_length']; ?>"/>
                          </div>                      
                          <div class="col-xs-12 col-sm-2">
                            <label>Waist round</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_pencilpant_waistround" value="<?php echo @$measurement['mt1_pencilpant_waistround']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_churidar_upper_thing" value="<?php echo @$measurement['mt1_normalpant_waistround']; ?>"/>
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
                            <input class="form-control" type="text" name="mt1_dress_chest" value="<?php echo @$measurement['mt1_dress_chest']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_gown_chest" value="<?php echo @$measurement['mt1_gown_chest']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_lehenga_chest" value="<?php echo @$measurement['mt1_lehenga_chest']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label>Ankle round</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_pencilpant_ankleround" value="<?php echo @$measurement['mt1_pencilpant_ankleround']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_normalpant_ankleround" value="<?php echo @$measurement['mt1_normalpant_ankleround']; ?>"/>
                          </div>
                          

                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Waist Round</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_blouse_waistround" value="<?php echo @$measurement['mt1_blouse_waistround']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_dress_waistround" value="<?php echo @$measurement['mt1_dress_waistround']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_gown_waistround" value="<?php echo @$measurement['mt1_gown_waistround']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_lehenga_waistround" value="<?php echo @$measurement['mt1_lehenga_waistround']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label>Knee round</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_pencilpant_kneeround" value="<?php echo @$measurement['mt1_pencilpant_kneeround']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_normalpant_kneeround" value="<?php echo @$measurement['mt1_normalpant_kneeround']; ?>"/>
                          </div>
                          

                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Dot Point</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_blouse_dotpoint" value="<?php echo @$measurement['mt1_blouse_dotpoint']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_gown_dotpoint" value="<?php echo @$measurement['mt1_gown_dotpoint']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_lehenga_dotpoint" value="<?php echo @$measurement['mt1_lehenga_dotpoint']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <label>Thigh round</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_pencilpant_thighround" value="<?php echo @$measurement['mt1_pencilpant_thighround']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_normalpant_thighround" value="<?php echo @$measurement['mt1_normalpant_thighround']; ?>"/>
                          </div>
                          

                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Hip round</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_dress_hip" value="<?php echo @$measurement['mt1_dress_hip']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Slit</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_dress_slit" value="<?php echo @$measurement['mt1_dress_slit']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          

                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Yolk</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_gown_yolk" value="<?php echo @$measurement['mt1_gown_yolk']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          

                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Arm hole</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_blouse_armhole" value="<?php echo @$measurement['mt1_blouse_armhole']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_dress_armhole" value="<?php echo @$measurement['mt1_dress_armhole']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_gown_armhole" value="<?php echo @$measurement['mt1_gown_armhole']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_lehenga_armhole" value="<?php echo @$measurement['mt1_lehenga_armhole']; ?>"/>
                          </div>
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Sleeve length</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_blouse_sleevelength" value="<?php echo @$measurement['mt1_blouse_sleevelength']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_dress_sleevelength" value="<?php echo @$measurement['mt1_dress_sleevelength']; ?>"/>
                          </div>
                           <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_gown_sleevelength" value="<?php echo @$measurement['mt1_gown_sleevelength']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_lehenga_sleevelength" value="<?php echo @$measurement['mt1_lehenga_sleevelength']; ?>"/>
                          </div>
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Sleeve round</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_blouse_sleeveround" value="<?php echo @$measurement['mt1_blouse_sleeveround']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_dress_sleeveround" value="<?php echo @$measurement['mt1_dress_sleeveround']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_gown_sleeveround" value="<?php echo @$measurement['mt1_gown_sleeveround']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_lehenga_sleeveround" value="<?php echo @$measurement['mt1_lehenga_sleeveround']; ?>"/>
                          </div>
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Front deep</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_blouse_frontdeep" value="<?php echo @$measurement['mt1_blouse_frontdeep']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_dress_frontdeep" value="<?php echo @$measurement['mt1_dress_frontdeep']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_gown_frontdeep" value="<?php echo @$measurement['mt1_gown_frontdeep']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_lehenga_frontdeep" value="<?php echo @$measurement['mt1_lehenga_frontdeep']; ?>"/>
                          </div>
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Back deep</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_blouse_backdeep" value="<?php echo @$measurement['mt1_blouse_backdeep']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_dress_backdeep" value="<?php echo @$measurement['mt1_dress_backdeep']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_gown_backdeep" value="<?php echo @$measurement['mt1_gown_backdeep']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_lehenga_backdeep" value="<?php echo @$measurement['mt1_lehenga_backdeep']; ?>"/>
                          </div>
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>2.Skirt</label>
                          </div>
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Length</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_skrit_lehenga_length" value="<?php echo @$measurement['mt1_skrit_lehenga_length']; ?>"/>
                          </div>
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>Waist round</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_skrit_lehenga_waistround" value="<?php echo @$measurement['mt1_skrit_lehenga_waistround']; ?>"/>
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
