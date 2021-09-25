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
               <!-- <label  style=" margin-left: 45%; margin-right: 45%; font-size: 20px;">Gents</label><br> -->
               <label  class="text text-primary">Add Measurement</label><br><br>
                <div class="row form-group">
                <div class="col-md-6">
                Yoke Length
                  <input class="form-control" type="text" name="eth_yoke_length" value="<?php echo @$measurement['eth_yoke_length']; ?>" />
                  </div>
                  <div class="col-md-6">
                  Sleeve Length
                  <input class="form-control" type="text" name="eth_s_length" value="<?php echo @$measurement['eth_s_length']; ?>" />
                  </div>
                </div>
                <div class="row form-group">
                <div class="col-md-6">
                Full Length
                  <input class="form-control" type="text" name="eth_full_length" value="<?php echo @$measurement['eth_full_length']; ?>" />
                  </div>
                  <div class="col-md-6">
                  Sleeve Round
                  <input class="form-control" type="text" name="eth_s_round" value="<?php echo @$measurement['eth_s_round']; ?>" />
                  </div>
                </div>
                <div class="row form-group">
                <div class="col-md-6">
                Shoulder
                  <input class="form-control" type="text" name="eth_shoulder" value="<?php echo @$measurement['eth_shoulder']; ?>" />
                  </div>
                  <div class="col-md-6">
                  Sleeve Center
                  <input class="form-control" type="text" name="eth_s_center" value="<?php echo @$measurement['eth_s_center']; ?>" />
                  </div>
                </div>
                <div class="row form-group">
                <div class="col-md-6">
                Chest
                  <input class="form-control" type="text" name="eth_chest" value="<?php echo @$measurement['eth_chest']; ?>" />
                  </div>
                  <div class="col-md-6">
                  Armhole
                  <input class="form-control" type="text" name="eth_armhole" value="<?php echo @$measurement['eth_armhole']; ?>" />
                  </div>
                </div>
                <div class="row form-group">
                <div class="col-md-6">
                Bust
                  <input class="form-control" type="text" name="eth_bust" value="<?php echo @$measurement['eth_bust']; ?>" />
                  </div>
                  <div class="col-md-6">
                  Neck Front
                  <input class="form-control" type="text" name="eth_neck_front" value="<?php echo @$measurement['eth_neck_front']; ?>" />
                  </div>
                </div>
                <div class="row form-group">
                <div class="col-md-6">
                Waist
                  <input class="form-control" type="text" name="eth_waist" value="<?php echo @$measurement['eth_waist']; ?>" />
                  </div>
                  <div class="col-md-6">
                  Back
                  <input class="form-control" type="text" name="eth_back" value="<?php echo @$measurement['eth_back']; ?>" />
                  </div>
                </div>
                <div class="row form-group">
                <div class="col-md-6">
                Hip
                  <input class="form-control" type="text" name="eth_hip" value="<?php echo @$measurement['eth_hip']; ?>" />
                  </div>
                  <div class="col-md-6">
                  Slit/A-Line/Panel/Umberella
                  <input class="form-control" type="text" name="eth_s_a_p_u" value="<?php echo @$measurement['eth_s_a_p_u']; ?>" />
                  </div>
                </div>

                
                <label class="text text-primary">Back</label><br><br>
                <div class="row form-group">
                <div class="col-md-6">
                Keyhole
                  <input class="form-control" type="text" name="eth_keyhole" value="<?php echo @$measurement['eth_keyhole']; ?>" />
                  </div>
                  <div class="col-md-6">
                  Tear Drop
                  <input class="form-control" type="text" name="eth_t_d" value="<?php echo @$measurement['eth_t_d']; ?>" />
                  </div>
                </div>
                <div class="row form-group">
                <div class="col-md-6">
                Polti
                  <input class="form-control" type="text" name="eth_polti" value="<?php echo @$measurement['eth_polti']; ?>" />
                  </div>
                  <div class="col-md-6">
                 Zip
                  <input class="form-control" type="text" name="eth_zip" value="<?php echo @$measurement['eth_zip']; ?>" />
                  </div>
                </div>
                <div class="row form-group">
                <div class="col-md-6">
                Illusion
                  <input class="form-control" type="text" name="eth_illusion" value="<?php echo @$measurement['eth_illusion']; ?>" />
                  </div>
                  <div class="col-md-6">  
                  </div>
                </div>
                <div class="row form-group">
                <div class="col-md-6">
                Waist
                  <input class="form-control" type="text" name="eth_b_waist" value="<?php echo @$measurement['eth_b_waist']; ?>" />
                  </div>
                  <div class="col-md-6">
                 Thigh
                  <input class="form-control" type="text" name="eth_b_thigh" value="<?php echo @$measurement['eth_b_thigh']; ?>" />
                  </div>
                </div>
                <div class="row form-group">
                <div class="col-md-6">
                Knee
                  <input class="form-control" type="text" name="eth_b_knee" value="<?php echo @$measurement['eth_b_knee']; ?>" />
                  </div>
                  <div class="col-md-6">
                 Calf
                  <input class="form-control" type="text" name="eth_b_calf" value="<?php echo @$measurement['eth_b_calf']; ?>" />
                  </div>
                </div>
                <div class="row form-group">
                <div class="col-md-6">
                Ankle
                  <input class="form-control" type="text" name="eth_b_ankle" value="<?php echo @$measurement['eth_b_ankle']; ?>" />
                  </div>
                  <div class="col-md-6">
                  </div>
                </div>
                <div class="row form-group">
                <div class="col-md-6">
                Princess Cut
                  <input class="form-control" type="text" name="eth_b_p_c" value="<?php echo @$measurement['eth_b_p_c']; ?>" />
                  </div>
                  <div class="col-md-6">
                 Padded
                  <input class="form-control" type="text" name="eth_b_padded" value="<?php echo @$measurement['eth_b_padded']; ?>" />
                  </div>
                </div>
                <div class="row form-group">
                <div class="col-md-6">
               Side Zip
                  <input class="form-control" type="text" name="eth_b_s_z" value="<?php echo @$measurement['eth_b_s_z']; ?>" />
                  </div>
                  <div class="col-md-6">
                     </div>
                </div>
                <div class="row form-group">
                <div class="col-md-6">
                Cutting Point
                  <input class="form-control" type="text" name="eth_c_p" value="<?php echo @$measurement['eth_c_p']; ?>" />
                  </div>
                  <div class="col-md-6">
                 Point to Point
                  <input class="form-control" type="text" name="eth_b_p_p" value="<?php echo @$measurement['eth_b_p_p']; ?>" />
                  </div>
                </div>
                <div class="row form-group">
                <div class="col-md-6">
               Note
               <textarea class="form-control" name="eth_note"><?php echo @$measurement['eth_note']; ?></textarea>
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