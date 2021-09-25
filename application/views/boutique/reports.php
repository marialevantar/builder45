<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Income   
      <small>Reports</small>
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
<section class="content" style="min-height: 0px;">
  <form name="" action="<?php echo base_url(); ?>boutique/reports/" method="post">
    <div class="row">
        <div class="col-md-4 col-md-offset-2 col-xs-6">
            <div class="input-group">
                <span class="input-group-addon bg-light-blue"><i class="fa fa-calendar"></i></span>
                 <input type="text" name="date_from_report" class="form-control report_date" value="<?php echo @$date_from_report;?>" required>
            </div>
        </div>
        <div class="col-md-4 col-xs-6">
            <div class="input-group">
                <span class="input-group-addon bg-light-blue"><i class="fa fa-calendar"></i></span>
                 <input type="text" name="date_to_report" class="form-control report_date" value="<?php echo @$date_to_report;?>" required>
            </div>
        </div>
        <div class="col-md-2 col-xs-6">
            <div class="form-group">
                <div class="input-group">
                  <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </div>
    </div>
    </form>
    <br>
    <div class="row">
        <div class="col-sm-6">
            <div class="box box-solid">
                <div class="box-body">
                    <table class="table table-striped">
                        
                       
                        <tr>
                            <th>Stitching</th>
                            <td>
                                 <span class="total_expense">
                                      <?php echo $total_expences_stitch;?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Handwork</th>
                            <td>
                                 <span class="total_expense">
                                      <?php echo $total_expences_handwork;?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Material Remaining</th>
                            <td>
                                 <span class="total_expense">
                                      <?php echo $boutique_work_material_remaining;?>
                                </span>
                            </td>
                        </tr>

                         <tr>
                            <th>Total</th>
                            <td>
                                 <span class="total_expense">
    <?php echo $total_expences_stitch + $total_expences_handwork + $boutique_work_material_remaining;?>
                                </span>
                            </td>
                        </tr>
                        
                    </table>
                </div>
            </div>
        </div>

    </div>
    
</section>
<!-- /.content -->


  
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->