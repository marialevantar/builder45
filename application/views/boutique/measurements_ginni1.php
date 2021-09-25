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
      <small>Measurement Ginni Wadhwa</small>
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
                          <div class="col-xs-12 col-sm-6"  style="text-align: center;">
                            <label>Measurements</label>
                          </div>
                          
                          <div class="col-xs-12 col-sm-6" style="text-align: center;">
                            <label>Purchase</label>
                          </div>

                      	</div>
                      	<div class="row">
                      	  <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>UPPER CHEST</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_m_upper_chest" value="<?php echo @$measurement['mt1_m_upper_chest']; ?>"/>
                          </div>
                          
                          <div class="col-xs-12 col-sm-1">
                            <label>BLOUSE</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          
                          <div class="col-xs-12 col-sm-2"> 
                            <label>A} LINNINGS</label>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            
                          </div>
                          
                          <div class="col-xs-12 col-sm-2">
                            <label>D} FABRICS</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                           
                          </div>
                          

                      	</div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>APEX POINT</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_m_apex_point" value="<?php echo @$measurement['mt1_m_apex_point']; ?>"/>
                          </div>
                          
                          <div class="col-xs-12 col-sm-1">
                            <label>BLOUSE LENGTH</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_m_blouse_length" value="<?php echo @$measurement['mt1_m_blouse_length']; ?>"/>
                          </div>
                          
                          <div class="col-xs-12 col-sm-2"> 
                            <label>BUTTER CREPE</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_m_butter_crepe" value="<?php echo @$measurement['mt1_m_butter_crepe']; ?>"/>
                          </div>
                          
                          <div class="col-xs-12 col-sm-2">
                            <label>GEOG / CREPE</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_m_geog_crepe" value="<?php echo @$measurement['mt1_m_geog_crepe']; ?>"/>
                          </div>
                          

                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>BELOW BUST</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_m_below_bust" value="<?php echo @$measurement['mt1_m_below_bust']; ?>"/>
                          </div>
                          
                          <div class="col-xs-12 col-sm-1">
                            <label>FRONT NECK</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_m_front_neck" value="<?php echo @$measurement['mt1_m_front_neck']; ?>"/>
                          </div>
                          
                          <div class="col-xs-12 col-sm-2"> 
                            <label>COTTON 2*1</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_m_cotton" value="<?php echo @$measurement['mt1_m_cotton']; ?>"/>
                          </div>
                          
                          <div class="col-xs-12 col-sm-2">
                            <label>RAW SILK / SILK</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                           <input class="form-control" type="text" name="mt1_m_raw_silk" value="<?php echo @$measurement['mt1_m_raw_silk']; ?>"/>
                          </div>
                          
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>WAIST</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_m_waist" value="<?php echo @$measurement['mt1_m_waist']; ?>"/>
                          </div>
                          
                          <div class="col-xs-12 col-sm-1">
                            <label>BACK NECK</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_m_back_neck" value="<?php echo @$measurement['mt1_m_back_neck']; ?>"/>
                          </div>
                          
                          <div class="col-xs-12 col-sm-2"> 
                            <label>SANTOON</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_m_santoon" value="<?php echo @$measurement['mt1_m_santoon']; ?>"/>
                          </div>
                          
                          <div class="col-xs-12 col-sm-2">
                            <label>COTTON</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                           <input class="form-control" type="text" name="mt1_m_cotton" value="<?php echo @$measurement['mt1_m_cotton']; ?>"/>
                          </div>
                          

                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>STOMACH</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_m_stomach" value="<?php echo @$measurement['mt1_m_stomach']; ?>"/>
                          </div>
                          
                          <div class="col-xs-12 col-sm-1">
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          
                          <div class="col-xs-12 col-sm-2"> 
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          
                          <div class="col-xs-12 col-sm-2">
                            <label>NET / FANCY NET</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                           <input class="form-control" type="text" name="mt1_m_net_fanc" value="<?php echo @$measurement['mt1_m_net_fanc']; ?>"/>
                          </div>
                          
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>HIP</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_m_hip" value="<?php echo @$measurement['mt1_m_hip']; ?>"/>
                          </div>
                          
                          <div class="col-xs-12 col-sm-1">
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          
                          <div class="col-xs-12 col-sm-2"> 
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          
                          <div class="col-xs-12 col-sm-2">
                            <label>PRINTED</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                           <input class="form-control" type="text" name="mt1_m_printed" value="<?php echo @$measurement['mt1_m_printed']; ?>"/>
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
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          
                          <div class="col-xs-12 col-sm-2"> 
                            <label>B} DYING</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          
                          <div class="col-xs-12 col-sm-2">
                            <label>LYCRA / SPANDEX</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                           <input class="form-control" type="text" name="mt1_m_lycra" value="<?php echo @$measurement['mt1_m_lycra']; ?>"/>
                          </div>
                          
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>SHOULDER</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_m_shoulder" value="<?php echo @$measurement['mt1_m_shoulder']; ?>"/>
                          </div>
                          
                          <div class="col-xs-12 col-sm-1">
                            <label>LEHENGA</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          
                          <div class="col-xs-12 col-sm-2"> 
                            <label>
                              <input class="form-control" type="text" name="mt1_m_dying_1" value="<?php echo @$measurement['mt1_m_dying_1']; ?>"/>
                            </label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                           
                          </div>
                          
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>ACROSS BACK</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_m_across_back" value="<?php echo @$measurement['mt1_m_across_back']; ?>"/>
                          </div>
                          
                          <div class="col-xs-12 col-sm-1">
                            <label>WAIST</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_m_waist" value="<?php echo @$measurement['mt1_m_waist']; ?>"/>
                          </div>
                          
                          <div class="col-xs-12 col-sm-2"> 
                            <label>
                              <input class="form-control" type="text" name="mt1_m_dying_2" value="<?php echo @$measurement['mt1_m_dying_2']; ?>"/>
                            </label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                           
                          </div>
                          
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>ACROSS FRONT</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_m_across_front" value="<?php echo @$measurement['mt1_m_across_front']; ?>"/>
                          </div>
                          
                          <div class="col-xs-12 col-sm-1">
                            <label>LENGTH</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_m_length" value="<?php echo @$measurement['mt1_m_length']; ?>"/>
                          </div>
                          
                          <div class="col-xs-12 col-sm-2"> 
                            <label>
                              <input class="form-control" type="text" name="mt1_m_dying_3" value="<?php echo @$measurement['mt1_m_dying_3']; ?>"/>
                            </label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                           
                          </div>
                          
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>ARMHOLE</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_m_armhole" value="<?php echo @$measurement['mt1_m_armhole']; ?>"/>
                          </div>
                          
                          <div class="col-xs-12 col-sm-1">
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          
                          <div class="col-xs-12 col-sm-2"> 
                            <label>
                              <input class="form-control" type="text" name="mt1_m_dying_4" value="<?php echo @$measurement['mt1_m_dying_4']; ?>"/>
                            </label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                           
                          </div>
                          
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>UP ARM</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_m_uparm" value="<?php echo @$measurement['mt1_m_uparm']; ?>"/>
                          </div>
                          
                          <div class="col-xs-12 col-sm-2">
                            <label>FULL LENGTH</label>
                          </div>
                          

                          
                          <div class="col-xs-12 col-sm-2"> 
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                           
                          </div>
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>SHORT SLEEVES</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_m_short_sleeves" value="<?php echo @$measurement['mt1_s_short_sleeves']; ?>"/>
                          </div>
                          
                          <div class="col-xs-12 col-sm-1">
                            <label>CROPPED</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_m_cropped" value="<?php echo @$measurement['mt1_m_cropped']; ?>"/>
                          </div>

                          
                          <div class="col-xs-12 col-sm-2"> 
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                           
                          </div>
                          
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>ELBOW LENGTH</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_u_elbom_length" value="<?php echo @$measurement['mt1_u_elbom_length']; ?>"/>
                          </div>
                          
                          <div class="col-xs-12 col-sm-1">
                            <label>WITH HEELS</label>
                          </div>
                          
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_u_with_heels" value="<?php echo @$measurement['mt1_u_with_heels']; ?>"/>
                          </div>
                          
                          <div class="col-xs-12 col-sm-2"> 
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                           
                          </div>
                          
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>3/4 SLEEVES</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_m_3_sleeves" value="<?php echo @$measurement['mt1_m_3_sleeves']; ?>"/>
                          </div>
                          
                          <div class="col-xs-12 col-sm-1">
                            <label>WITHOUT HEELS</label>
                          </div>
                          
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_m_without_heels" value="<?php echo @$measurement['mt1_m_without_heels']; ?>"/>
                          </div>
                          
                          <div class="col-xs-12 col-sm-2"> 
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                           
                          </div>
                          
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>FULL SLEEVES</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_m_full_sleeves" value="<?php echo @$measurement['mt1_m_full_sleeves']; ?>"/>
                          </div>
                          
                          <div class="col-xs-12 col-sm-1">
                            <label></label>
                          </div>
                          
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          
                          <div class="col-xs-12 col-sm-2"> 
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                           
                          </div>
                          
                        </div>


                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>TROUSERS</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          
                          <div class="col-xs-12 col-sm-1">
                            <label></label>
                          </div>
                          
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          
                          <div class="col-xs-12 col-sm-2"> 
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                           
                          </div>
                          
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>KNEE LENGTH</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_m_knee_length" value="<?php echo @$measurement['mt1_m_knee_length']; ?>"/>
                          </div>
                          
                          <div class="col-xs-12 col-sm-1">
                            <label>TUNIC LENGTH</label>
                          </div>
                          
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_m_tunic_length" value="<?php echo @$measurement['mt1_m_tunic_length']; ?>"/>
                          </div>
                          
                          <div class="col-xs-12 col-sm-2"> 
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                           
                          </div>
                          
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>TROUSER LENGTH</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_m_trouser_length" value="<?php echo @$measurement['mt1_m_trouser_length']; ?>"/>
                          </div>
                          
                          <div class="col-xs-12 col-sm-1">
                            <label></label>
                          </div>
                          
                          <div class="col-xs-12 col-sm-1">
                           
                          </div>
                          
                          <div class="col-xs-12 col-sm-2"> 
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                           
                          </div>
                          
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>BOTTOM ROUND</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_m_bottom_round" value="<?php echo @$measurement['mt1_m_bottom_round']; ?>"/>
                          </div>
                          
                          <div class="col-xs-12 col-sm-1">
                            <label>DRESS LENGTH</label>
                          </div>
                          
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_m_dress_length" value="<?php echo @$measurement['mt1_m_dress_length']; ?>"/>
                          </div>
                          
                          <div class="col-xs-12 col-sm-2"> 
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                           
                          </div>
                          
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>CALF</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_m_calf" value="<?php echo @$measurement['mt1_m_calf']; ?>"/>
                          </div>
                          
                          <div class="col-xs-12 col-sm-1">
                            <label></label>
                          </div>
                          
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          
                          <div class="col-xs-12 col-sm-2"> 
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                           
                          </div>
                          
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>KNEE ROUND</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_m_knee_round" value="<?php echo @$measurement['mt1_m_knee_round']; ?>"/>
                          </div>
                          
                          <div class="col-xs-12 col-sm-1">
                            <label>TOP LENGTH</label>
                          </div>
                          
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_m_top_length" value="<?php echo @$measurement['mt1_m_top_length']; ?>"/>
                          </div>
                          
                          <div class="col-xs-12 col-sm-2"> 
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                           
                          </div>
                          
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>MID THIGH</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_m_mid_thigh" value="<?php echo @$measurement['mt1_m_mid_thigh']; ?>"/>
                          </div>
                          
                          <div class="col-xs-12 col-sm-1">
                            <label></label>
                          </div>
                          
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          
                          <div class="col-xs-12 col-sm-2"> 
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                           
                          </div>
                          
                        </div>

                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>THIGH</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_m_thigh" value="<?php echo @$measurement['mt1_m_thigh']; ?>"/>
                          </div>
                          
                          <div class="col-xs-12 col-sm-1">
                            <label></label>
                          </div>
                          
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          
                          <div class="col-xs-12 col-sm-2"> 
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                           
                          </div>
                          
                        </div>


                        <div class="row">
                          <br>
                          <div class="col-xs-12 col-sm-2"> 
                            <label>WAIST</label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <input class="form-control" type="text" name="mt1_m_waist" value="<?php echo @$measurement['mt1_m_waist']; ?>"/>
                          </div>
                          
                          <div class="col-xs-12 col-sm-1">
                            <label></label>
                          </div>
                          
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          
                          <div class="col-xs-12 col-sm-2"> 
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            
                          </div>
                          
                          <div class="col-xs-12 col-sm-2">
                            <label></label>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                           
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
<script src="http://boutiquemanager.in/boutiquemanagerapp/assets/js/bootstrap-datepicker.min.js"></script>


