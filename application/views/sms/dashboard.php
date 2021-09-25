  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Alerts App
        <small>Dashboard</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <!-- ./col -->
        
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner" style="height: 260px;">
              <h3><?php echo @$customers_count; ?></h3>

              <p>Customers</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?php echo base_url(); ?>messages/customer" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner" style="height: 260px;">
              <h3><?php echo @$bdata['boutique_msg_count']; ?></h3>

              <p>Message Used</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


      </div>
      <!-- /.row -->
      
    
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
