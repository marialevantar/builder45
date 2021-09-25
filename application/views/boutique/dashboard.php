  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>

      <?php 
      if($this->session->userdata('UserRole') == 3 )
      {
        ?>

        <?php } ?>
      <small>Dashboard</small>
      </h1>
    </section>

    <!-- Main content -->
    <?php if($this->session->userdata('UserID') !=119) {?>
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <!-- ./col -->
        <?php if($this->session->userdata('UserRole')==2) {?>
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner" style="height: 260px;">
              <h3><?php echo @$properties_count;?></h3>

              <p>Sites</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?php echo base_url(); ?>boutique/sites" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
           <!-- Calendar -->
          <div class="box box-solid bg-green-gradient">
            <div class="box-header">
              <i class="fa fa-calendar"></i>
              <h3 class="box-title">Calendar</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <!-- button with a dropdown -->
                <div class="btn-group">
                  <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bars"></i></button>
                </div>

              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <!--The calendar -->
              <div id="calendar" style="width: 100%"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <?php }elseif($this->session->userdata('UserRole')==4) {?>
          <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner" style="height: 260px;">
              <h3><?php echo @$properties_count;?></h3>

              <p>Assigned Projects</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?php echo base_url(); ?>boutique/userprojects" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner" style="height: 260px;">
              <h3><?php echo @$properties_count;?></h3>

              <p>Payment Request</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?php echo base_url(); ?>boutique/list_payment_request" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <?php }elseif($this->session->userdata('UserRole')==5) {?>
        
          <!-- <div class="col-lg-6 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner" style="height: 260px;">
              <h3><?php echo @$properties_count;?></h3>

              <p>Assigned Projects</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?php echo base_url(); ?>boutique/userprojects" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div> -->
        <div class="col-lg-6 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner" style="height: 260px;">
              <h3><?php echo @$properties_count;?></h3>

              <p>Payment Request</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?php echo base_url(); ?>boutique/list_payment_request" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

          <?php }else{ ?>


        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner" style="height: 260px;">
              <h3><?php echo @$properties_count;?></h3>

              <p>Sites</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?php echo base_url(); ?>boutique/sites" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
           <!-- Calendar -->
          <div class="box box-solid bg-green-gradient">
            <div class="box-header">
              <i class="fa fa-calendar"></i>
              <h3 class="box-title">Calendar</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <!-- button with a dropdown -->
                <div class="btn-group">
                  <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bars"></i></button>
                </div>

              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <!--The calendar -->
              <div id="calendar" style="width: 100%"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>

            <?php } ?>


        

        <!-- <div class="col-lg-6 col-xs-6"> -->
          <!-- small box -->
          <!-- <br>
          <div class="small-box bg-green">
            <div class="inner" style="height: 260px;">
              <h3><?php echo @$tailors_count;?></h3>
              <p>Tailors</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="<?php echo base_url(); ?>boutique/tailor" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div> -->
        <!-- </div> -->

        <!-- <div class="col-lg-6 col-xs-6"> -->
          <!-- small box -->
          <!-- <br>
          <div class="small-box bg-orange">
            <div class="inner" style="height: 260px;">
              <p>Billing</p>
            </div>
            <div class="icon">
              <i class="ion ion-arrow-down-c"></i>
            </div>
            <?php if($this->session->userdata('BoutiqueBillingStatus') == 1){?>
              <a href="<?php echo base_url(); ?>billing/items" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            <?php 
              }
              else{
              ?>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              <?php
              }
            ?>
          </div>
        </div> -->
        <?php if($this->session->userdata('UserID') !=118) {?>
        <!--<div class="col-lg-6 col-xs-6">-->
          <!-- small box -->
           <!-- Calendar -->
        <!--   <br>-->
        <!--  <div class="box box-solid bg-green-gradient">-->
        <!--    <div class="box-header">-->
        <!--      <i class="fa fa-calendar"></i>-->
        <!--      <h3 class="box-title">Calendar</h3>-->
              <!-- tools box -->
        <!--      <div class="pull-right box-tools">-->
                <!-- button with a dropdown -->
        <!--        <div class="btn-group">-->
        <!--          <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">-->
        <!--            <i class="fa fa-bars"></i></button>-->
        <!--          <ul class="dropdown-menu pull-right" role="menu">-->
        <!--            <li><a href="<?php echo base_url(); ?>boutique/addwork">Add new Rent</a></li>-->
        <!--          </ul>-->
        <!--        </div>-->

        <!--      </div>-->
              <!-- /. tools -->
        <!--    </div>-->
            <!-- /.box-header -->
        <!--    <div class="box-body no-padding">-->
              <!--The calendar -->
        <!--      <div id="calendar" style="width: 100%"></div>-->
        <!--    </div>-->
            <!-- /.box-body -->
        <!--  </div>-->
          <!-- /.box -->

        <!--</div>-->
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
                    <?php foreach ($works_tomorrow as $work_tomorrow) {?>
                  <tr>
                    <td><a href="<?php echo base_url(); ?>boutique/workdetails/<?php echo $work_tomorrow['boutique_work_id'];?>"><?php echo $work_tomorrow['boutique_work_name'];?></a></td>
                    <td><?php echo $work_tomorrow['boutique_customer_name'];?></td>
                    <?php if($work_tomorrow['boutique_work_status'] == 1){?>
                    <td><span class="label label-warning">Pending</span></td>
                    <?php } ?>
                    <?php if($work_tomorrow['boutique_work_status'] == 2){?>
                    <td><span class="label label-info">Processing</span></td>
                    <?php } ?>
                    <?php if($work_tomorrow['boutique_work_status'] == 3){?>
                    <td><span class="label label-success">Completed</span></td>
                    <?php } ?>
                    <?php if($work_tomorrow['boutique_work_status'] == 4){?>
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
