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
      <small>Measurement Trends</small>
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
                            <label>L</label>
                            <input class="form-control" type="text" name="mt1_l" value="<?php echo @$measurement['mt1_l']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-4">
                            <label>Remarks</label>
                            <textarea name="mt1_remarks" class="form-control"><?php echo @$measurement['mt1_remarks']; ?></textarea>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>SH</label>
                            <input class="form-control" type="text" name="mt1_sh" value="<?php echo @$measurement['mt1_sh']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>SL</label>
                            <input class="form-control" type="text" name="mt1_sl" value="<?php echo @$measurement['mt1_sl']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>SR</label>
                            <input class="form-control" type="text" name="mt1_sr" value="<?php echo @$measurement['mt1_sr']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>AH</label>
                            <input class="form-control" type="text" name="mt1_ah" value="<?php echo @$measurement['mt1_ah']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>CH</label>
                            <input class="form-control" type="text" name="mt1_ch" value="<?php echo @$measurement['mt1_ch']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>BR</label>
                            <input class="form-control" type="text" name="mt1_br" value="<?php echo @$measurement['mt1_br']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>W</label>
                            <input class="form-control" type="text" name="mt1_w" value="<?php echo @$measurement['mt1_w']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>SE</label>
                            <input class="form-control" type="text" name="mt1_se" value="<?php echo @$measurement['mt1_se']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>SL</label>
                            <input class="form-control" type="text" name="mt1_s_l" value="<?php echo @$measurement['mt1_s_l']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>FL</label>
                            <input class="form-control" type="text" name="mt1_f_l" value="<?php echo @$measurement['mt1_f_l']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>NF</label>
                            <input class="form-control" type="text" name="mt1_n_f" value="<?php echo @$measurement['mt1_n_f']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>NB</label>
                            <input class="form-control" type="text" name="mt1_n_b" value="<?php echo @$measurement['mt1_n_b']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>W</label>
                            <input class="form-control" type="text" name="mt1_w_1" value="<?php echo @$measurement['mt1_w_1']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>BOTTOM</label>
                            <input class="form-control" type="text" name="mt1_bottom" value="<?php echo @$measurement['mt1_bottom']; ?>"/>
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
                            <label>L</label>
                            <input class="form-control" type="text" name="mt2_l" value="<?php echo @$measurement['mt2_l']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-4">
                            <label>Remarks</label>
                            <textarea name="mt2_remarks" class="form-control"><?php echo @$measurement['mt2_remarks']; ?></textarea>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>SH</label>
                            <input class="form-control" type="text" name="mt2_sh" value="<?php echo @$measurement['mt2_sh']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>SL</label>
                            <input class="form-control" type="text" name="mt2_sl" value="<?php echo @$measurement['mt2_sl']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>SR</label>
                            <input class="form-control" type="text" name="mt2_sr" value="<?php echo @$measurement['mt2_sr']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>AH</label>
                            <input class="form-control" type="text" name="mt2_ah" value="<?php echo @$measurement['mt2_ah']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>CH</label>
                            <input class="form-control" type="text" name="mt2_ch" value="<?php echo @$measurement['mt2_ch']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>BR</label>
                            <input class="form-control" type="text" name="mt2_br" value="<?php echo @$measurement['mt2_br']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>W</label>
                            <input class="form-control" type="text" name="mt2_w" value="<?php echo @$measurement['mt2_w']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>SE</label>
                            <input class="form-control" type="text" name="mt2_se" value="<?php echo @$measurement['mt2_se']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>SL</label>
                            <input class="form-control" type="text" name="mt2_s_l" value="<?php echo @$measurement['mt2_s_l']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>FL</label>
                            <input class="form-control" type="text" name="mt2_f_l" value="<?php echo @$measurement['mt2_f_l']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>NF</label>
                            <input class="form-control" type="text" name="mt2_n_f" value="<?php echo @$measurement['mt2_n_f']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>NB</label>
                            <input class="form-control" type="text" name="mt2_n_b" value="<?php echo @$measurement['mt2_n_b']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>W</label>
                            <input class="form-control" type="text" name="mt2_w_1" value="<?php echo @$measurement['mt2_w_1']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-8">
                            <label>BOTTOM</label>
                            <input class="form-control" type="text" name="mt2_bottom" value="<?php echo @$measurement['mt2_bottom']; ?>"/>
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
