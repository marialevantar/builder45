  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <!--<h1>-->
        
      <!--  <small>Dashboard</small>-->
      <!--</h1>-->
    </section>

    <!-- Main content -->
    <?php if($this->session->userdata('UserID') !=119) {?>
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <!-- ./col -->
       


 <?php if($this->session->userdata('UserID') ==126) {?>
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner" style="height: 260px;">
              <h3><?php echo @$properties_count;?></h3>

              <p>Income Report <?php //echo $this->uri->segment(3); ?></p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?php echo base_url(); ?>billing/salereport/<?php echo $this->uri->segment(3); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
 
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner" style="height: 260px;">
              <h3><?php echo @$properties_count;?></h3>

              <p>Expense Report</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?php echo base_url(); ?>billing/expencereport/<?php echo $this->uri->segment(3); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner" style="height: 260px;">
              <h3><?php echo @$properties_count;?></h3>

              <p>Profit Report</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?php echo base_url(); ?>billing/profitreport/<?php echo $this->uri->segment(3); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner" style="height: 260px;">
              <h3><?php echo @$properties_count;?></h3>

              <p>Attendance</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?php echo base_url(); ?>billing/attendance/<?php echo $this->uri->segment(3); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
 
 
 
 <?php }?>

      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <br>
      </div>
      <?php if($this->session->userdata('UserID') !=118) {?>
      <div class="row">
        <!-- Left col -->
        <div class="col-md-8">

          <!-- TABLE: LATEST ORDERS -->
          <!--<div class="box box-info">-->
          <!--  <div class="box-header with-border">-->
          <!--    <h3 class="box-title">Latest Rent List</h3>-->

          <!--    <div class="box-tools pull-right">-->
          <!--    </div>-->
          <!--  </div>-->
            <!-- /.box-header -->
          <!--  <div class="box-body">-->
          <!--    <div class="table-responsive">-->
          <!--      <table class="table no-margin" id="latest_works">-->
          <!--        <thead>-->
          <!--        <tr>-->
          <!--          <th>Order Number</th>-->
          <!--          <th>No of items</th>-->
          <!--          <th>Grand Total</th>-->
          <!--          <th>Amount Paid</th>-->
          <!--          <th>Order Date</th>-->
          <!--          <th>Delivery Date</th>-->
          <!--          <th>Payment Status</th>-->
          <!--          <th>Order Status</th>-->
          <!--        </tr>-->
          <!--        </thead>-->
          <!--        <tbody>-->
          <!--        <?php foreach($works as $work) {?>-->
          <!--        <tr>-->
          <!--          <td><a href="<?php echo base_url(); ?>boutique/works/<?php echo $work['boutique_order_id'];?>"><?php echo $work['boutique_order_number'];?></a></td>-->
          <!--          <td>-->
          <!--            <?php echo $work['boutique_order_no_items'];?>-->
          <!--          </td>-->
          <!--          <td> <?php echo $work["boutique_order_grandtotal"]; ?> </td>-->
          <!--          <td> <?php echo $work["boutique_order_amtpaid"]; ?> </td>-->
          <!--          <td> <?php echo $work["boutique_order_date"]; ?> </td>-->
          <!--          <td> <?php echo $work["boutique_order_delivery_date"]; ?> </td>-->

          <!--          <?php if($work['boutique_order_payment_status'] == 1){?>-->
          <!--          <td><span class="label label-danger">Not Paid</span></td>-->
          <!--          <?php } ?>-->
          <!--          <?php if($work['boutique_order_payment_status'] == 2){?>-->
          <!--          <td><span class="label label-warning">Partial Paid</span></td>-->
          <!--          <?php } ?>-->
          <!--          <?php if($work['boutique_order_payment_status'] == 3){?>-->
          <!--          <td><span class="label label-success">Paid</span></td>-->
          <!--          <?php } ?>-->

          <!--          <?php if($work['boutique_work_status'] == 1){?>-->
          <!--          <td><span class="label label-warning">Pending</span></td>-->
          <!--          <?php } ?>-->
          <!--          <?php if($work['boutique_work_status'] == 2){?>-->
          <!--          <td><span class="label label-info">Processing</span></td>-->
          <!--          <?php } ?>-->
          <!--          <?php if($work['boutique_work_status'] == 3){?>-->
          <!--          <td><span class="label label-success">Completed</span></td>-->
          <!--          <?php } ?>-->
          <!--          <?php if($work['boutique_work_status'] == 4){?>-->
          <!--          <td><span class="label label-success">Delivered</span></td>-->
          <!--          <?php } ?>-->
          <!--        </tr>-->
          <!--      <?php } ?>-->
                 
          <!--        </tbody>-->
          <!--      </table>-->
          <!--    </div>-->
              <!-- /.table-responsive -->
          <!--  </div>-->
            <!-- /.box-body -->
          <!--  <div class="box-footer clearfix">-->
          <!--    <a href="<?php echo base_url(); ?>boutique/addwork" class="btn btn-sm btn-info btn-flat pull-left">Add New Rent</a>-->
          <!--    <a href="<?php echo base_url(); ?>boutique/works" class="btn btn-sm btn-default btn-flat pull-right">View All Rent</a>-->
          <!--  </div>-->
            <!-- /.box-footer -->
          <!--</div>-->
          <!-- /.box -->


                    <!-- TABLE: LATEST ORDERS -->
          <!--<div class="box box-info">-->
          <!--  <div class="box-header with-border">-->
              <!--<h3 class="box-title">Tenants</h3>-->

            <!--  <div class="box-tools pull-right">-->
            <!--  </div>-->
            <!--</div>-->
            <!-- /.box-header -->
          <!--  <div class="box-body">-->
          <!--    <div class="table-responsive">-->
          <!--      <table class="table no-margin" id="customer_table">-->
          <!--        <thead>-->
          <!--        <tr>-->
          <!--          <th>Customer Name</th>-->
          <!--          <th>Phone</th>-->
          <!--          <th>Address</th>-->
          <!--          <th></th>-->
          <!--        </tr>-->
          <!--        </thead>-->
          <!--        <tbody>-->
          <!--        <?php foreach ($customers as $customer) {?>-->
          <!--        <tr>-->
          <!--          <td><a href="<?php echo base_url(); ?>boutique/customerdetails/<?php echo $customer['boutique_customer_id'];?>"><?php echo $customer['boutique_customer_name'];?></a></td>-->
          <!--          <td><?php echo $customer['boutique_customer_ph'];?></td>-->
          <!--          <td><?php echo $customer['boutique_customer_address'];?></td>-->
          <!--          <td><a href="<?php echo base_url(); ?>boutique/addwork/<?php echo $customer['boutique_customer_id'];?>"><span class="label label-success">Add Rent</span></a> | -->
          <!--            <a href="<?php echo base_url(); ?>boutique/orders/<?php echo $customer['boutique_customer_id'];?>"><span class="label label-info">All Rents</span></a>-->
          <!--          </td>-->
          <!--        </tr>-->
          <!--        <?php } ?>-->
          <!--        </tbody>-->
          <!--      </table>-->
          <!--    </div>-->
              <!-- /.table-responsive -->
          <!--  </div>-->
            <!-- /.box-body -->
          <!--  <div class="box-footer clearfix">-->
          <!--    <a href="<?php echo base_url(); ?>boutique/addcustomer" class="btn btn-sm btn-info btn-flat pull-left">New Tenant</a>-->
          <!--    <a href="<?php echo base_url(); ?>boutique/customer" class="btn btn-sm btn-default btn-flat pull-right">View All Tenants</a>-->
          <!--  </div>-->
            <!-- /.box-footer -->
          <!--</div>-->
          <!-- /.box -->

        </div>
        <!-- /.col -->

        <div class="col-md-4">
          <!-- PRODUCT LIST -->
          <!-- <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">To be delivered today</h3>

              <div class="box-tools pull-right">
                
              </div>
            </div> -->
            <!-- /.box-header -->
            <!-- <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Work Name</th>
                    <th>Customer Name</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($works_today as $work_today) {?>
                  <tr>
                    <td><a href="<?php echo base_url(); ?>boutique/workdetails/<?php echo $work_today['boutique_work_id'];?>"><?php echo $work_today['boutique_work_name'];?></a></td>
                    <td><?php echo $work_today['boutique_customer_name'];?></td>
                    <?php if($work_today['boutique_work_status'] == 1){?>
                    <td><span class="label label-warning">Pending</span></td>
                    <?php } ?>
                    <?php if($work_today['boutique_work_status'] == 2){?>
                    <td><span class="label label-info">Processing</span></td>
                    <?php } ?>
                    <?php if($work_today['boutique_work_status'] == 3){?>
                    <td><span class="label label-success">Completed</span></td>
                    <?php } ?>
                    <?php if($work_today['boutique_work_status'] == 4){?>
                    <td><span class="label label-success">Delivered</span></td>
                    <?php } ?>
                  </tr>
                <?php } ?>
                  </tbody>
                </table>
              </div> -->
              <!-- /.table-responsive -->
            <!-- </div> -->
            <!-- /.box-body -->
            <!-- /.box-body -->
            <!-- /.box-footer -->
          <!-- </div> -->
          <!-- /.box -->

                    <!-- PRODUCT LIST -->
          <!-- <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">To be delivered tomorrow</h3>

              <div class="box-tools pull-right">
                
              </div>
            </div> -->
            <!-- /.box-header -->
            <!-- <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Work Name</th>
                    <th>Customer Name</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div> -->
              <!-- /.table-responsive -->
            <!-- </div> -->
            <!-- /.box-body -->
            <!-- /.box-body -->
            <!-- /.box-footer -->
          <!-- </div> -->
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
                    <?php } ?>
      <!-- /.row (main row) -->
    </section>
                    <?php } ?>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
