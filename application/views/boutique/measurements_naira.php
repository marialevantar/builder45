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
      <small>Measurement Naira</small>
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
                          <div class="col-xs-12 col-sm-1">
                            <label>FL</label>
                            <input class="form-control" type="text" name="mt1_fl" value="<?php echo @$measurement['mt1_fl']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>SH</label>
                           <input class="form-control" type="text" name="mt1_sh" value="<?php echo @$measurement['mt1_sh']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>CH</label>
                            <input class="form-control" type="text" name="mt1_ch" value="<?php echo @$measurement['mt1_ch']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>B</label>
                            <input class="form-control" type="text" name="mt1_b" value="<?php echo @$measurement['mt1_b']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>W</label>
                            <input class="form-control" type="text" name="mt1_w" value="<?php echo @$measurement['mt1_w']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>STOM</label>
                            <input class="form-control" type="text" name="mt1_stom" value="<?php echo @$measurement['mt1_stom']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>HIP</label>
                            <input class="form-control" type="text" name="mt1_hip" value="<?php echo @$measurement['mt1_hip']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>UB</label>
                            <input class="form-control" type="text" name="mt1_ub" value="<?php echo @$measurement['mt1_ub']; ?>"/>
                          </div>
                        </div>


                    <div class="row">
                          <div class="col-xs-12 col-sm-1">
                            <label>Sh-B</label>
                            <input class="form-control" type="text" name="mt1_sh_b" value="<?php echo @$measurement['mt1_sh_b']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>Sh-W</label>
                           <input class="form-control" type="text" name="mt1_sh_w" value="<?php echo @$measurement['mt1_sh_w']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>Sh-Stom</label>
                            <input class="form-control" type="text" name="mt1_sh_stom" value="<?php echo @$measurement['mt1_sh_stom']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>Sh-HIP</label>
                            <input class="form-control" type="text" name="mt1_sh_hip" value="<?php echo @$measurement['mt1_sh_hip']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>SLV L</label>
                            <input class="form-control" type="text" name="mt1_slv_l" value="<?php echo @$measurement['mt1_slv_l']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>SLV R</label>
                            <input class="form-control" type="text" name="mt1_slv_r" value="<?php echo @$measurement['mt1_slv_r']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>BICEPS</label>
                            <input class="form-control" type="text" name="mt1_biceps" value="<?php echo @$measurement['mt1_biceps']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>AH</label>
                            <input class="form-control" type="text" name="mt1_ah" value="<?php echo @$measurement['mt1_ah']; ?>"/>
                          </div>
                        </div>

                    <div class="row">
                          <div class="col-xs-12 col-sm-1">
                            <label>FN</label>
                            <input class="form-control" type="text" name="mt1_fn" value="<?php echo @$measurement['mt1_fn']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>BN</label>
                           <input class="form-control" type="text" name="mt1_bn" value="<?php echo @$measurement['mt1_bn']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>WIDE</label>
                            <input class="form-control" type="text" name="mt1_wide" value="<?php echo @$measurement['mt1_wide']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>COLLAR R</label>
                            <input class="form-control" type="text" name="mt1_collar_r" value="<?php echo @$measurement['mt1_collar_r']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>FW</label>
                            <input class="form-control" type="text" name="mt1_fw" value="<?php echo @$measurement['mt1_fw']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>BW</label>
                            <input class="form-control" type="text" name="mt1_bw" value="<?php echo @$measurement['mt1_bw']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>SLT L</label>
                            <input class="form-control" type="text" name="mt1_slt_l" value="<?php echo @$measurement['mt1_slt_l']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>SLT R</label>
                            <input class="form-control" type="text" name="mt1_slt_r" value="<?php echo @$measurement['mt1_slt_r']; ?>"/>
                          </div>
                        </div>

                    <div class="row">
                          <div class="col-xs-12 col-sm-1">
                            <label>Yoke L</label>
                            <input class="form-control" type="text" name="mt1_yoke_l" value="<?php echo @$measurement['mt1_yoke_l']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>Yoke R</label>
                           <input class="form-control" type="text" name="mt1_yoke_r" value="<?php echo @$measurement['mt1_yoke_r']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>CW</label>
                            <input class="form-control" type="text" name="mt1_cw" value="<?php echo @$measurement['mt1_cw']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>FLR</label>
                            <input class="form-control" type="text" name="mt1_flr" value="<?php echo @$measurement['mt1_flr']; ?>"/>
                          </div>
                        </div>

                    <div class="row">
                          <div class="col-xs-12 col-sm-1">
                            <label>Btm L</label>
                            <input class="form-control" type="text" name="mt1_btm_l" value="<?php echo @$measurement['mt1_btm_l']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>Btm W</label>
                           <input class="form-control" type="text" name="mt1_btm_w" value="<?php echo @$measurement['mt1_btm_w']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>EDGE R</label>
                            <input class="form-control" type="text" name="mt1_edge_r" value="<?php echo @$measurement['mt1_edge_r']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>W-Th L</label>
                            <input class="form-control" type="text" name="mt1_w_th_l" value="<?php echo @$measurement['mt1_w_th_l']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>Thigh R</label>
                            <input class="form-control" type="text" name="mt1_thigh_r" value="<?php echo @$measurement['mt1_thigh_r']; ?>"/>
                          </div>

                        </div>


                    <div class="row">
                          <div class="col-xs-12 col-sm-1">
                            <label>W-Knee L</label>
                            <input class="form-control" type="text" name="mt1_w_knee_l" value="<?php echo @$measurement['mt1_w_knee_l']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>Knee R</label>
                           <input class="form-control" type="text" name="mt1_knee_r" value="<?php echo @$measurement['mt1_knee_r']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>W-Calf L</label>
                            <input class="form-control" type="text" name="mt1_w_calf_l" value="<?php echo @$measurement['mt1_w_calf_l']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>Calf R</label>
                            <input class="form-control" type="text" name="mt1_calf_r" value="<?php echo @$measurement['mt1_calf_r']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>Crotch L</label>
                            <input class="form-control" type="text" name="mt1_crotch_l" value="<?php echo @$measurement['mt1_crotch_l']; ?>"/>
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
                          <div class="col-xs-12 col-sm-1">
                            <label>FL</label>
                            <input class="form-control" type="text" name="mt2_fl" value="<?php echo @$measurement['mt2_fl']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>SH</label>
                           <input class="form-control" type="text" name="mt2_sh" value="<?php echo @$measurement['mt2_sh']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>CH</label>
                            <input class="form-control" type="text" name="mt2_ch" value="<?php echo @$measurement['mt2_ch']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>B</label>
                            <input class="form-control" type="text" name="mt2_b" value="<?php echo @$measurement['mt2_b']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>W</label>
                            <input class="form-control" type="text" name="mt2_w" value="<?php echo @$measurement['mt2_w']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>STOM</label>
                            <input class="form-control" type="text" name="mt2_stom" value="<?php echo @$measurement['mt2_stom']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>HIP</label>
                            <input class="form-control" type="text" name="mt2_hip" value="<?php echo @$measurement['mt2_hip']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>UB</label>
                            <input class="form-control" type="text" name="mt2_ub" value="<?php echo @$measurement['mt2_ub']; ?>"/>
                          </div>
                        </div>


                    <div class="row">
                          <div class="col-xs-12 col-sm-1">
                            <label>Sh-B</label>
                            <input class="form-control" type="text" name="mt2_sh_b" value="<?php echo @$measurement['mt2_sh_b']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>Sh-W</label>
                           <input class="form-control" type="text" name="mt2_sh_w" value="<?php echo @$measurement['mt2_sh_w']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>Sh-Stom</label>
                            <input class="form-control" type="text" name="mt2_sh_stom" value="<?php echo @$measurement['mt2_sh_stom']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>Sh-HIP</label>
                            <input class="form-control" type="text" name="mt2_sh_hip" value="<?php echo @$measurement['mt2_sh_hip']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>SLV L</label>
                            <input class="form-control" type="text" name="mt2_slv_l" value="<?php echo @$measurement['mt2_slv_l']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>SLV R</label>
                            <input class="form-control" type="text" name="mt2_slv_r" value="<?php echo @$measurement['mt2_slv_r']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>BICEPS</label>
                            <input class="form-control" type="text" name="mt2_biceps" value="<?php echo @$measurement['mt2_biceps']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>AH</label>
                            <input class="form-control" type="text" name="mt2_ah" value="<?php echo @$measurement['mt2_ah']; ?>"/>
                          </div>
                        </div>

                    <div class="row">
                          <div class="col-xs-12 col-sm-1">
                            <label>FN</label>
                            <input class="form-control" type="text" name="mt2_fn" value="<?php echo @$measurement['mt2_fn']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>BN</label>
                           <input class="form-control" type="text" name="mt2_bn" value="<?php echo @$measurement['mt2_bn']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>WIDE</label>
                            <input class="form-control" type="text" name="mt2_wide" value="<?php echo @$measurement['mt2_wide']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>COLLAR R</label>
                            <input class="form-control" type="text" name="mt2_collar_r" value="<?php echo @$measurement['mt2_collar_r']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>FW</label>
                            <input class="form-control" type="text" name="mt2_fw" value="<?php echo @$measurement['mt2_fw']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>BW</label>
                            <input class="form-control" type="text" name="mt2_bw" value="<?php echo @$measurement['mt2_bw']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>SLT L</label>
                            <input class="form-control" type="text" name="mt2_slt_l" value="<?php echo @$measurement['mt2_slt_l']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>SLT R</label>
                            <input class="form-control" type="text" name="mt2_slt_r" value="<?php echo @$measurement['mt2_slt_r']; ?>"/>
                          </div>
                        </div>

                    <div class="row">
                          <div class="col-xs-12 col-sm-1">
                            <label>Yoke L</label>
                            <input class="form-control" type="text" name="mt2_yoke_l" value="<?php echo @$measurement['mt2_yoke_l']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>Yoke R</label>
                           <input class="form-control" type="text" name="mt2_yoke_r" value="<?php echo @$measurement['mt2_yoke_r']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>CW</label>
                            <input class="form-control" type="text" name="mt2_cw" value="<?php echo @$measurement['mt2_cw']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>FLR</label>
                            <input class="form-control" type="text" name="mt2_flr" value="<?php echo @$measurement['mt2_flr']; ?>"/>
                          </div>
                        </div>

                    <div class="row">
                          <div class="col-xs-12 col-sm-1">
                            <label>Btm L</label>
                            <input class="form-control" type="text" name="mt2_btm_l" value="<?php echo @$measurement['mt2_btm_l']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>Btm W</label>
                           <input class="form-control" type="text" name="mt2_btm_w" value="<?php echo @$measurement['mt2_btm_w']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>EDGE R</label>
                            <input class="form-control" type="text" name="mt2_edge_r" value="<?php echo @$measurement['mt2_edge_r']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>W-Th L</label>
                            <input class="form-control" type="text" name="mt2_w_th_l" value="<?php echo @$measurement['mt2_w_th_l']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>Thigh R</label>
                            <input class="form-control" type="text" name="mt2_thigh_r" value="<?php echo @$measurement['mt2_thigh_r']; ?>"/>
                          </div>

                        </div>


                    <div class="row">
                          <div class="col-xs-12 col-sm-1">
                            <label>W-Knee L</label>
                            <input class="form-control" type="text" name="mt2_w_knee_l" value="<?php echo @$measurement['mt2_w_knee_l']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>Knee R</label>
                           <input class="form-control" type="text" name="mt2_knee_r" value="<?php echo @$measurement['mt2_knee_r']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>W-Calf L</label>
                            <input class="form-control" type="text" name="mt2_w_calf_l" value="<?php echo @$measurement['mt2_w_calf_l']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>Calf R</label>
                            <input class="form-control" type="text" name="mt2_calf_r" value="<?php echo @$measurement['mt2_calf_r']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-1">
                            <label>Crotch L</label>
                            <input class="form-control" type="text" name="mt2_crotch_l" value="<?php echo @$measurement['mt2_crotch_l']; ?>"/>
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
