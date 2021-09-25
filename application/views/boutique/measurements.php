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
      <small>Measurement</small>
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
                    <div class="col-xs-12 col-sm-4">
                        <label>Length</label>
                        <input class="form-control" type="text" name="mt1_length" value="<?php echo @$measurement['mt1_length']; ?>" />
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <label>Shoulder</label>
                        <input class="form-control" type="text" name="mt1_shoulder" value="<?php echo @$measurement['mt1_shoulder']; ?>"/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-4">
                        <label>Armhole</label>
                        <input class="form-control" type="text" name="mt1_armhole" value="<?php echo @$measurement['mt1_armhole']; ?>" />
                    </div>
                    <div class="col-xs-12 col-sm-8">
                        <label>Sleve</label>
                        <div class="row">
                          <div class="col-xs-12 col-sm-4">
                            <input class="form-control" type="text" name="mt1_sleve1" value="<?php echo @$measurement['mt1_sleve1']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-4">
                           <input class="form-control" type="text" name="mt1_sleve2" value="<?php echo @$measurement['mt1_sleve2']; ?>"/>
                          </div>
                          <div class="col-xs-12 col-sm-4">
                            <input class="form-control" type="text" name="mt1_sleve3" value="<?php echo @$measurement['mt1_sleve3']; ?>"/>
                          </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-4">
                        <label>Chest</label>
                        <input class="form-control" type="text" name="mt1_chest" value="<?php echo @$measurement['mt1_chest']; ?>" />
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <label>Shape</label>
                        <input class="form-control" type="text" name="mt1_shape" value="<?php echo @$measurement['mt1_shape']; ?>" />
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <label>Slit</label>
                        <input class="form-control" type="text" name="mt1_slit" value="<?php echo @$measurement['mt1_slit']; ?>" />
                    </div>
                </div>

                 <div class="row">
                    <div class="col-xs-12 col-sm-4">
                        <label>Neck</label>
                        <input class="form-control" type="text" name="mt1_neck" value="<?php echo @$measurement['mt1_neck']; ?>" />
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <label>Neck Width</label>
                        <input class="form-control" type="text" name="mt1_neck_width" value="<?php echo @$measurement['mt1_neck_width']; ?>" />
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <label>Flair</label>
                        <input class="form-control" type="text" name="mt1_flair" value="<?php echo @$measurement['mt1_flair']; ?>" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-2">
                        <label>Bottom</label>
                        <input class="form-control" type="text" name="mt1_bottom1" value="<?php echo @$measurement['mt1_bottom1']; ?>" />
                    </div>
                    <div class="col-xs-12 col-sm-2">
                        <label>&nbsp;</label>
                        <input class="form-control" type="text" name="mt1_bottom2" value="<?php echo @$measurement['mt1_bottom2']; ?>" />
                    </div>
                    <div class="col-xs-12 col-sm-2">
                        <label>&nbsp;</label>
                        <input class="form-control" type="text" name="mt1_bottom3" value="<?php echo @$measurement['mt1_bottom3']; ?>" />
                    </div>
                </div>
              </div>
            <?php } ?>

            <?php if($typeid == 2) {?>
              
              <div class="row">
                    <div class="col-xs-12 col-sm-4">
                        <label>Length</label>
                        <input class="form-control" type="text" name="mt2_length" value="<?php echo @$measurement['mt2_length']; ?>" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-4">
                        <label>Shoulder</label>
                        <input class="form-control" type="text" name="mt2_shoulder" value="<?php echo @$measurement['mt2_shoulder']; ?>"/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-4">
                        <label>Armhole</label>
                        <input class="form-control" type="text" name="mt2_armhole" value="<?php echo @$measurement['mt2_armhole']; ?>" />
                    </div>
                    <div class="col-xs-12 col-sm-8">
                        <label>F. Regal</label>
                        <div class="row">
                          <div class="col-xs-12 col-sm-4">
                            <input class="form-control" type="text" name="mt2_fregal" value="<?php echo @$measurement['mt2_fregal']; ?>"/>
                          </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-2">
                        <label>Chest</label>
                        <input class="form-control" type="text" name="mt2_chest1" value="<?php echo @$measurement['mt2_chest1']; ?>" />
                    </div>
                    
                    <div class="col-xs-12 col-sm-2">
                        <label>&nbsp;</label>
                        <input class="form-control" type="text" name="mt2_chest2" value="<?php echo @$measurement['mt2_chest2']; ?>" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-2">
                        <label>Point</label>
                        <input class="form-control" type="text" name="mt2_point1" value="<?php echo @$measurement['mt2_point1']; ?>" />
                    </div>
                    
                    <div class="col-xs-12 col-sm-2">
                        <label>&nbsp;</label>
                        <input class="form-control" type="text" name="mt2_point2" value="<?php echo @$measurement['mt2_point2']; ?>" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-2">
                        <label>Waist</label>
                        <input class="form-control" type="text" name="mt2_waist1" value="<?php echo @$measurement['mt2_waist1']; ?>" />
                    </div>
                    
                    <div class="col-xs-12 col-sm-2">
                        <label>&nbsp;</label>
                        <input class="form-control" type="text" name="mt2_waist2" value="<?php echo @$measurement['mt2_waist2']; ?>" />
                    </div>
                </div>
                 <div class="row">
                    <div class="col-xs-12 col-sm-2">
                        <label>Neck</label>
                        <input class="form-control" type="text" name="mt2_neck1" value="<?php echo @$measurement['mt2_neck1']; ?>" />
                    </div>
                    <div class="col-xs-12 col-sm-2">
                        <label>&nbsp;</label>
                        <input class="form-control" type="text" name="mt2_neck2" value="<?php echo @$measurement['mt2_neck2']; ?>" />
                    </div>
                    <div class="col-xs-12 col-sm-2">
                        <label>Shoulder Width</label>
                        <input class="form-control" type="text" name="mt2_shoulder_width" value="<?php echo @$measurement['mt2_shoulder_width']; ?>" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-2">
                        <label>Sleeve</label>
                        <input class="form-control" type="text" name="mt2_sleeve1" value="<?php echo @$measurement['mt2_sleeve1']; ?>" />
                    </div>
                    <div class="col-xs-12 col-sm-2">
                        <label>&nbsp;</label>
                        <input class="form-control" type="text" name="mt2_sleeve2" value="<?php echo @$measurement['mt2_sleeve2']; ?>" />
                    </div>
                    <div class="col-xs-12 col-sm-2">
                        <label>&nbsp;</label>
                        <input class="form-control" type="text" name="mt2_sleeve3" value="<?php echo @$measurement['mt2_sleeve3']; ?>" />
                    </div>
                    <div class="col-xs-12 col-sm-2">
                        <label>&nbsp;</label>
                        <input class="form-control" type="text" name="mt2_sleeve4" value="<?php echo @$measurement['mt2_sleeve4']; ?>" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-2">
                        <label>UBL</label>
                        <input class="form-control" type="text" name="mt2_ubl" value="<?php echo @$measurement['mt2_ubl']; ?>" />
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
