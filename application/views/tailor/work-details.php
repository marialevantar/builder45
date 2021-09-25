<?php 
$stat = $this->session->userdata('filter');
if($stat == "rejected"):
  $backlink = base_url()."tailor/works";
elseif($stat == "new"):
  $backlink = base_url()."tailor/works";
elseif($stat == "active"):
  $backlink = base_url()."tailor/works";
else:
  $backlink = base_url()."tailor/works";
endif;
 ?>
<?php //print_r($work);?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit
      <small>Work</small>
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
    <?php endif; ?>
  </section>

  <!-- Main content -->
  <section class="content">
  <div class="box box-info">
    <form id="updateteam" method="post" action="<?php echo base_url(); ?>tailor/updateWorkDetails/<?php echo @$work->boutique_work_id; ?>">
      <div class="box-header with-border">
        <h3 class="box-title">Update Work Details</h3>
        <span class="pull-right"><a class="btn btn-info" href="<?php echo @$backlink; ?>">

        Back</a></span>
      </div>
      <div class="box-body">
        <div class="row">

           <div class="col-md-12">
            <div class="form-group">
              <label>Cloth/Work Name</label>
              <div class="input-group">
              <span class="input-group-addon"><span class="fa-edit fa"></span></span>
              <input name="workname" type="text" class="form-control" value="<?php echo @$work->boutique_work_name; ?>" disabled>
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Order Date</label>
              <div class="input-group">
                <span class="input-group-addon"><span class="fa-edit fa"></span></span>
                <input name="phone" type="text" class="form-control" value="<?php echo @$work->boutique_work_order_date; ?>" disabled>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Delivery Date</label>
              <div class="input-group">
                <span class="input-group-addon"><span class="fa-edit fa"></span></span>
                <input name="phone" type="text" class="form-control" value="<?php echo @$work->boutique_work_delivery_date; ?>" disabled>
              </div>
            </div>
          </div>
         
          <div class="col-md-12">
            <div class="form-group">
              <label>Comments</label>
              <textarea name="address" class="form-control" rows="3" disabled><?php echo @$work->boutique_work_material_desc; ?></textarea>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Photo Of Cloth</label></br>
              <img height="200" src="<?php echo base_url().'uploads/work/'.$work->boutique_work_image; ?>">
            </div>
          </div>

           <!-- Select multiple-->
          <div class="col-md-12">
            <div class="form-group">
                <label>Status</label>
                  <select multiple class="form-control" name="boutique_work_status">
                      <option value="1" <?php if($work->boutique_work_status == 1){ echo "selected='selected'"; } ?>>Started</option>
                      <option value="2" <?php if($work->boutique_work_status == 2){ echo "selected='selected'"; } ?>>Processing</option>
                      <option value="3" <?php if($work->boutique_work_status == 3){ echo "selected='selected'"; } ?>>Completed</option>
                  </select>
            </div>
          </div>
            <!-- Select multiple-->

        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <input type="hidden" name="boutique_work_id" value="<?php echo @$work->boutique_work_id; ?>">
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>



      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Measurements</h3>

          <div class="box-tools pull-right">
          </div>
        </div>
        
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">

               <div class="col-md-12">
          <label>Measurements</label>
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">CHURIDAR TOP</a></li>
              <li><a href="#tab_2" data-toggle="tab">BLOUSE</a></li>
              <li><a href="#" data-toggle="tab">FROCK</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <span class="pull-right"><a href="#">Print</a></span>
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
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                <span class="pull-right"><a href="#">Print</a></span>
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

              </div>


              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                It has survived not only five centuries, but also the leap into electronic typesetting,
                remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
                like Aldus PageMaker including versions of Lorem Ipsum.
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>

          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->

      <div class="box-footer">      </div>

      </div>
      <!-- /.box -->

    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<script>

</script>