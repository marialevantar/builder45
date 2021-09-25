<?php
if (@$orderid) :
  $backlink = base_url() . "boutique/works/" . @$orderid;
else :
  $backlink = base_url() . "boutique/orders/";
endif;
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Add
      <small>Measurement <?php echo $this->session->userdata('BoutiqueName'); ?></small>
    </h1>
    <?php if ($this->session->flashdata('notification')) :
      if ($this->session->flashdata('status') == "success") :
        $s_class = " alert-success ";
      else :
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
                    for ($i = 0; $i < count(@$customers); $i++) {
                    ?>
                      <option value="<?php echo $customers[$i]['boutique_customer_id']; ?>" <?php if ($customers[$i]['boutique_customer_id'] == $customerid) {
                                                                                              echo "selected='selected'";
                                                                                            } ?>>
                        <?php echo $customers[$i]['boutique_customer_name']; ?>
                      </option>
                    <?php } ?>
                  </select>
                </div>
              </div>
    

                <div class="row" style="margin:0;">
               <label  style=" margin-left: 45%; margin-right: 45%; font-size: 20px;">Gents</label><br>
               <label  class="text text-primary">Shirt/Kurtha-Style</label><br><br>
                <div class="row form-group">
                <div class="col-md-3">
                Length
                  <input class="form-control" type="text" name="zm_sk_length" value="<?php echo @$measurement['zm_sk_length']; ?>" />
                  </div>
                  <div class="col-md-3">
                  Chest
                  <input class="form-control" type="text" name="zm_sk_chest" value="<?php echo @$measurement['zm_sk_chest']; ?>" />
                  </div>
                  <div class="col-md-3">
                  Stomach
                  <input class="form-control" type="text" name="zm_sk_stomach" value="<?php echo @$measurement['zm_sk_stomach']; ?>" />
                  </div>
                  <div class="col-md-3">
                  Hip
                  <input class="form-control" type="text" name="zm_sk_hip" value="<?php echo @$measurement['zm_sk_hip']; ?>" />
                  </div>
                </div>
                <div class="row form-group">
                <div class="col-md-3">
                Shoulder
                  <input class="form-control" type="text" name="zm_sk_shoulder" value="<?php echo @$measurement['zm_sk_shoulder']; ?>" />
                  </div>
                  <div class="col-md-3">
                  Sleeves
                  <input class="form-control" type="text" name="zm_sk_sleeves" value="<?php echo @$measurement['zm_sk_sleeves']; ?>" />
                  </div>
                  <div class="col-md-3">
                  Neck
                  <input class="form-control" type="text" name="zm_sk_neck" value="<?php echo @$measurement['zm_sk_neck']; ?>" />
                  </div>
                  <div class="col-md-3">
                  Collar
                  <input class="form-control" type="text" name="zm_sk_collar" value="<?php echo @$measurement['zm_sk_collar']; ?>" />
                  </div>
                </div>
                <div class="row form-group">
                <div class="col-md-3">
                Half chest
                  <input class="form-control" type="text" name="zm_sk_half_chest" value="<?php echo @$measurement['zm_sk_half_chest']; ?>" />
                  </div>
                  <div class="col-md-3">
                  Half back
                  <input class="form-control" type="text" name="zm_sk_half_back" value="<?php echo @$measurement['zm_sk_half_back']; ?>" />
                  </div>
                  <div class="col-md-3">
                  Full kurtha length
                  <input class="form-control" type="text" name="zm_sk_full_kurtha_length" value="<?php echo @$measurement['zm_sk_full_kurtha_length']; ?>" />
                  </div>
                  <div class="col-md-3">
                  Biceps
                  <input class="form-control" type="text" name="zm_sk_biceps" value="<?php echo @$measurement['zm_sk_biceps']; ?>" />
                  </div>
                </div>
                <label class="text text-primary">Pant-Style</label><br><br>
                <div class="row form-group">
                <div class="col-md-3">
                Length
                  <input class="form-control" type="text" name="zm_p_length" value="<?php echo @$measurement['zm_p_length']; ?>" />
                  </div>
                  <div class="col-md-3">
                  Waist
                  <input class="form-control" type="text" name="zm_p_waist" value="<?php echo @$measurement['zm_p_waist']; ?>" />
                  </div>
                  <div class="col-md-3">
                  Hip
                  <input class="form-control" type="text" name="zm_p_hip" value="<?php echo @$measurement['zm_p_hip']; ?>" />
                  </div>
                  <div class="col-md-3">
                  Thigh
                  <input class="form-control" type="text" name="zm_p_thigh" value="<?php echo @$measurement['zm_p_thigh']; ?>" />
                  </div>
                </div>
                <div class="row form-group">
                <div class="col-md-3">
                Bottom
                  <input class="form-control" type="text" name="zm_p_bottom" value="<?php echo @$measurement['zm_p_bottom']; ?>" />
                  </div>
                  <div class="col-md-3">
                  Full fork
                  <input class="form-control" type="text" name="zm_p_full_fork" value="<?php echo @$measurement['zm_p_full_fork']; ?>" />
                  </div>
                  <div class="col-md-3">
                  In-seam
                  <input class="form-control" type="text" name="zm_p_in_seam" value="<?php echo @$measurement['zm_p_in_seam']; ?>" />
                  </div>
                  <div class="col-md-3">
                  Knee
                  <input class="form-control" type="text" name="zm_p_knee" value="<?php echo @$measurement['zm_p_knee']; ?>" />
                  </div>
                </div>
                <div class="row form-group">
                <div class="col-md-3">
                Calf
                  <input class="form-control" type="text" name="zm_p_calf" value="<?php echo @$measurement['zm_p_calf']; ?>" />
                  </div>
                  <div class="col-md-3">
                Other 1
                  <input class="form-control" type="text" name="zm_p_other1" value="<?php echo @$measurement['zm_p_other1']; ?>" />
                  </div>
                  <div class="col-md-3">
                  Other 2
                  <input class="form-control" type="text" name="zm_p_other2" value="<?php echo @$measurement['zm_p_other2']; ?>" />
                  </div>
                  <div class="col-md-3">
                  Other 3
                  <input class="form-control" type="text" name="zm_p_other3" value="<?php echo @$measurement['zm_p_other3']; ?>" />
                  </div>
                </div>
                <label class="text text-primary">Suit/indo western-Style</label><br><br>
                <div class="row form-group">
                <div class="col-md-3">
                Length
                  <input class="form-control" type="text" name="zm_si_length" value="<?php echo @$measurement['zm_si_length']; ?>" />
                  </div>
                  <div class="col-md-3">
                  Chest
                  <input class="form-control" type="text" name="zm_si_chest" value="<?php echo @$measurement['zm_si_chest']; ?>" />
                  </div>
                  <div class="col-md-3">
                  Stomach
                  <input class="form-control" type="text" name="zm_si_stomach" value="<?php echo @$measurement['zm_si_stomach']; ?>" />
                  </div>
                  <div class="col-md-3">
                  Hip
                  <input class="form-control" type="text" name="zm_si_hip" value="<?php echo @$measurement['zm_si_hip']; ?>" />
                  </div>
                </div>
                <div class="row form-group">
                <div class="col-md-3">
                Shoulder
                  <input class="form-control" type="text" name="zm_si_shoulder" value="<?php echo @$measurement['zm_si_shoulder']; ?>" />
                  </div>
                  <div class="col-md-3">
                  Sleeves
                  <input class="form-control" type="text" name="zm_si_sleeves" value="<?php echo @$measurement['zm_si_sleeves']; ?>" />
                  </div>
                  <div class="col-md-3">
                  Neck
                  <input class="form-control" type="text" name="zm_si_neck" value="<?php echo @$measurement['zm_si_neck']; ?>" />
                  </div>
                  <div class="col-md-3">
                  Collar
                  <input class="form-control" type="text" name="zm_si_collar" value="<?php echo @$measurement['zm_si_collar']; ?>" />
                  </div>
                </div>
                <div class="row form-group">
                <div class="col-md-3">
                Half chest
                  <input class="form-control" type="text" name="zm_si_half_chest" value="<?php echo @$measurement['zm_si_half_chest']; ?>" />
                  </div>
                  <div class="col-md-3">
                  Waist coat length
                  <input class="form-control" type="text" name="zm_si_waist_coat_length" value="<?php echo @$measurement['zm_si_waist_coat_length']; ?>" />
                  </div>
                  <div class="col-md-3">
                  Sherwani length
                  <input class="form-control" type="text" name="zm_si_sherwani_length" value="<?php echo @$measurement['zm_si_sherwani_length']; ?>" />
                  </div>
                  <div class="col-md-3">
                  Bundi coat length
                  <input class="form-control" type="text" name="zm_si_bundi_coat_length" value="<?php echo @$measurement['zm_si_bundi_coat_length']; ?>" />
                  </div>
                </div>
                <label  style=" margin-left: 45%; margin-right: 45%; font-size: 20px;">Ladies</label><br>
               <label  class="text text-primary">Top</label><br><br>
                <div class="row form-group">
                <div class="col-md-3">
                Full Length
                  <input class="form-control" type="text" name="zm_l_full_length" value="<?php echo @$measurement['zm_l_full_length']; ?>" />
                  </div>
                  <div class="col-md-3">
                  Yoke
                  <input class="form-control" type="text" name="zm_l_yoke" value="<?php echo @$measurement['zm_l_yoke']; ?>" />
                  </div>
                  <div class="col-md-3">
                  Upper chest
                  <input class="form-control" type="text" name="zm_l_upper_chest" value="<?php echo @$measurement['zm_l_upper_chest']; ?>" />
                  </div>
                  <div class="col-md-3">
                  Bust
                  <input class="form-control" type="text" name="zm_l_bust" value="<?php echo @$measurement['zm_l_bust']; ?>" />
                  </div>
                </div>
                <div class="row form-group">
                <div class="col-md-3">
                Lower bust
                  <input class="form-control" type="text" name="zm_l_lower_bust" value="<?php echo @$measurement['zm_l_lower_bust']; ?>" />
                  </div>
                  <div class="col-md-3">
                  Waist
                  <input class="form-control" type="text" name="zm_l_waist" value="<?php echo @$measurement['zm_l_waist']; ?>" />
                  </div>
                  <div class="col-md-3">
                  Hip
                  <input class="form-control" type="text" name="zm_l_hip" value="<?php echo @$measurement['zm_l_hip']; ?>" />
                  </div>
                  <div class="col-md-3">
                  Seat
                  <input class="form-control" type="text" name="zm_l_seat" value="<?php echo @$measurement['zm_l_seat']; ?>" />
                  </div>
                 
                </div>
                <div class="row form-group">
                <div class="col-md-3">
                  Shoulder
                  <input class="form-control" type="text" name="zm_l_shoulder" value="<?php echo @$measurement['zm_l_shoulder']; ?>" />
                  </div>
                <div class="col-md-3">
                Sleeve length
                  <input class="form-control" type="text" name="zm_l_sleeve_length" value="<?php echo @$measurement['zm_l_sleeve_length']; ?>" />
                  </div>
                  <div class="col-md-3">
               Armhole
                  <input class="form-control" type="text" name="zm_l_armhole" value="<?php echo @$measurement['zm_l_armhole']; ?>" />
                  </div>
                  <div class="col-md-3">
                  Bicep
                  <input class="form-control" type="text" name="zm_l_bicep" value="<?php echo @$measurement['zm_l_bicep']; ?>" />
                  </div>
                
                </div>
                <div class="row form-group">
                <div class="col-md-3">
                  Elbow
                  <input class="form-control" type="text" name="zm_l_elbow" value="<?php echo @$measurement['zm_l_elbow']; ?>" />
                  </div>
                  <div class="col-md-3">
                  Sleeve round
                  <input class="form-control" type="text" name="zm_l_sleeve_round" value="<?php echo @$measurement['zm_l_sleeve_round']; ?>" />
                  </div>
                <div class="col-md-3">
                Wrist
                  <input class="form-control" type="text" name="zm_l_wrist" value="<?php echo @$measurement['zm_l_wrist']; ?>" />
                  </div>
                  <div class="col-md-3">
                  Front neck
                  <input class="form-control" type="text" name="zm_l_front_neck" value="<?php echo @$measurement['zm_l_front_neck']; ?>" />
                  </div>
                  
                </div>
                <div class="row form-group">
                <div class="col-md-3">
                  Back neck
                  <input class="form-control" type="text" name="zm_l_back_neck" value="<?php echo @$measurement['zm_l_back_neck']; ?>" />
                  </div>
                  <div class="col-md-3">
                  Neck width
                  <input class="form-control" type="text" name="zm_l_neck_width" value="<?php echo @$measurement['zm_l_neck_width']; ?>" />
                  </div>
                <div class="col-md-3">
                Collar
                  <input class="form-control" type="text" name="zm_l_collar" value="<?php echo @$measurement['zm_l_collar']; ?>" />
                  </div>
                  <div class="col-md-3">
                  Slit
                  <input class="form-control" type="text" name="zm_l_slit" value="<?php echo @$measurement['zm_l_slit']; ?>" />
                  </div>
                </div>
                <div class="row form-group">
                <div class="col-md-3">
                  Flair
                  <input class="form-control" type="text" name="zm_l_flair" value="<?php echo @$measurement['zm_l_flair']; ?>" />
                  </div>
               </div>
                <label  class="text text-primary">Bottom</label><br><br>
                <div class="row form-group">
                <div class="col-md-3">
                Length
                  <input class="form-control" type="text" name="zm_lb_length" value="<?php echo @$measurement['zm_lb_length']; ?>" />
                  </div>
                  <div class="col-md-3">
                  Hip
                  <input class="form-control" type="text" name="zm_lb_hip" value="<?php echo @$measurement['zm_lb_hip']; ?>" />
                  </div>
                  <div class="col-md-3">
                 Thigh
                  <input class="form-control" type="text" name="zm_lb_thigh" value="<?php echo @$measurement['zm_lb_thigh']; ?>" />
                  </div>
                  <div class="col-md-3">
                  Calf
                  <input class="form-control" type="text" name="zm_lb_calf" value="<?php echo @$measurement['zm_lb_calf']; ?>" />
                  </div>
                </div>
                <div class="row form-group">
                <div class="col-md-3">
                Ankle
                  <input class="form-control" type="text" name="zm_lb_ankle" value="<?php echo @$measurement['zm_lb_ankle']; ?>" />
                  </div>
             
                </div>
                    <!-- <div class="col-xs-12 col-sm-12">
                     
                      <div class="row">
                        <br>
                        <div class="col-xs-12 col-sm-2">
                          <label>Length</label>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                          <input class="form-control" type="text" name="mt1_u_length" value="<?php echo @$measurement['mt1_u_length']; ?>" />
                        </div>

                        <div class="col-xs-12 col-sm-2">
                          <label>Length</label>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                          <input class="form-control" type="text" name="mt1_l_length" value="<?php echo @$measurement['mt1_l_length']; ?>" />
                        </div>



                      </div>


                      <div class="row">
                     

                        <div class="col-xs-12 col-sm-2">
                          <label>Upper Chest</label>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                          <input class="form-control" type="text" name="mt1_u_upper_chest" value="<?php echo @$measurement['mt1_u_upper_chest']; ?>" />
                        </div>

                        <div class="col-xs-12 col-sm-2">
                          <label>Waist</label>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                          <input class="form-control" type="text" name="mt1_l_waist" value="<?php echo @$measurement['mt1_l_waist']; ?>" />
                        </div>


                      </div>

                      <div class="row">
                        <br>
                        <div class="col-xs-12 col-sm-2">
                          <label>Front Cross</label>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                          <input class="form-control" type="text" name="mt1_u_front_cross" value="<?php echo @$measurement['mt1_u_front_cross']; ?>" />
                        </div>

                        <div class="col-xs-12 col-sm-2">
                          <label>Hip</label>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                          <input class="form-control" type="text" name="mt1_l_hip" value="<?php echo @$measurement['mt1_l_hip']; ?>" />
                        </div>



                      </div>

                      <div class="row">
                        <br>
                        <div class="col-xs-12 col-sm-2">
                          <label>Chest</label>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                          <input class="form-control" type="text" name="mt1_u_chest" value="<?php echo @$measurement['mt1_u_chest']; ?>" />
                        </div>


                        <div class="col-xs-12 col-sm-2">
                          <label>Fork</label>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                          <input class="form-control" type="text" name="mt1_l_fork" value="<?php echo @$measurement['mt1_l_fork']; ?>" />
                        </div>



                      </div>

                      <div class="row">
                        <br>
                        <div class="col-xs-12 col-sm-2">
                          <label>Dart Point</label>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                          <input class="form-control" type="text" name="mt1_u_dartpoint" value="<?php echo @$measurement['mt1_u_dartpoint']; ?>" />
                        </div>


                        <div class="col-xs-12 col-sm-2">
                          <label>Thigh</label>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                          <input class="form-control" type="text" name="mt1_l_thigh" value="<?php echo @$measurement['mt1_l_thigh']; ?>" />
                        </div>



                      </div>

                      <div class="row">
                        <br>
                        <div class="col-xs-12 col-sm-2">
                          <label>Waist</label>
                        </div>

                        <div class="col-xs-12 col-sm-3">
                          <input class="form-control" type="text" name="mt1_u_waist" value="<?php echo @$measurement['mt1_u_waist']; ?>" />
                        </div>
                        <div class="col-xs-12 col-sm-2">
                          <label>Knee</label>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                          <input class="form-control" type="text" name="mt1_l_knee" value="<?php echo @$measurement['mt1_l_knee']; ?>" />
                        </div>

                      </div>

                      <div class="row">
                        <br>
                        <div class="col-xs-12 col-sm-2">
                          <label>Hip</label>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                          <input class="form-control" type="text" name="mt1_u_hip" value="<?php echo @$measurement['mt1_u_hip']; ?>" />
                        </div>

                        <div class="col-xs-12 col-sm-2">
                          <label>Ankle</label>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                          <input class="form-control" type="text" name="mt1_l_ankle" value="<?php echo @$measurement['mt1_l_ankle']; ?>" />
                        </div>
                      </div>

                      <div class="row">
                        <br>
                        <div class="col-xs-12 col-sm-2">
                          <label>Shoulder</label>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                          <input class="form-control" type="text" name="mt1_u_shoulder" value="<?php echo @$measurement['mt1_u_shoulder']; ?>" />
                        </div>

                      </div>

                      <div class="row">
                        <br>
                        <div class="col-xs-12 col-sm-2">
                          <label>Sleeves Length</label>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                          <input class="form-control" type="text" name="mt1_u_sleeves_length" value="<?php echo @$measurement['mt1_u_sleeves_length']; ?>" />
                        </div>


                      </div>

                      <div class="row">
                        <br>
                        <div class="col-xs-12 col-sm-2">
                          <label>Sleeves Open</label>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                          <input class="form-control" type="text" name="mt1_u_sleeves_open" value="<?php echo @$measurement['mt1_u_sleeves_open']; ?>" />
                        </div>

                      </div>

                      <div class="row">
                        <br>
                        <div class="col-xs-12 col-sm-2">
                          <label>Arm Hole</label>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                          <input class="form-control" type="text" name="mt1_u_armholes" value="<?php echo @$measurement['mt1_u_armholes']; ?>" />
                        </div>


                      </div>

                      <div class="row">
                        <br>
                        <div class="col-xs-12 col-sm-2">
                          <label>Front Neck</label>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                          <input class="form-control" type="text" name="mt1_u_frontneck" value="<?php echo @$measurement['mt1_u_frontneck']; ?>" />
                        </div>

                      </div>

                      <div class="row">
                        <br>
                        <div class="col-xs-12 col-sm-2">
                          <label>Back Neck</label>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                          <input class="form-control" type="text" name="mt1_u_backneck" value="<?php echo @$measurement['mt1_u_backneck']; ?>" />
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

                    </div> -->
               
                </div>

           


            </div>
          </div>
          <div class="box-footer">
            <input type="hidden" name="typeid" value="<?php echo @$typeid; ?>">
            <input type="hidden" name="customerid" value="<?php echo @$customerid; ?>">
            <input type="hidden" name="orderid" value="<?php echo @$orderid; ?>">
            <button type="submit" name="add_measurement" value="1" class="btn btn-primary">ADD</button>
          </div>
      </form>
    </div>
  </section>
</div>
<script src="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>