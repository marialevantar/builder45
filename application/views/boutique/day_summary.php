  <!-- Content Wrapper. Contains page content -->
<!--<script type='text/javascript' src='js/jquery-1.3.2.min.js'></script>-->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Days Summary
        <small></small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <!-- ./col -->

        


      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <br>
      </div>
      <div class="row">

      <div class="col-md-12">
          <!-- PRODUCT LIST -->
          <div class="box box-primary">
            <div class="box-header with-border">
            <div class="col-md-8">
            <input name="date_attendance" type="text" class="form-control pull-right" id="datepicker" >
           </div>
            <div class="col-md-2">
            <input name="date_attendance" type="button" value="Filter" class="form-control pull-right btn-primary" id="datechange" >
            </div>
            <div class="col-md-2">
            <input name="date_attendance" type="button" value="Clear" class="form-control pull-right btn-primary" id="clearchange" >
             </div>
            </div>
          </div>  
        </div>

      
        <!--  class="btn btn-primary" Left col -->
        <div class="col-md-12">

          <!-- TABLE: LATEST ORDERS -->
          <div class="box box-info">
            <div class="box-header with-border">
 
              <div class="box-tools pull-right">
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            EXPENSE LIST
              <div class="table-responsive">
                <table class="table no-margin" id="fulllist">
                  <thead>
                  <tr style="padding: 15px; background-color: #eeeeee;">
                    <th>Head</th>
                    <th>Property</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                      $total = count($expences);
                      for($i = 0; $i < $total; $i++) { ?>
                      <tr>
                        <td><?php echo $expences[$i]["boutique_billing_head_name"]; ?></td>
                        <td><?php echo $this->Work_model->m_getpropertyname($expences[$i]["boutique_property"])["boutique_property_name"];?></td>
                        <td><?php echo $expences[$i]["boutique_expense_details"]; ?></td>
                        <td><?php echo $expences[$i]["boutique_expense_amount"]; ?></td>
                        <th></th>
                      </tr>
                    <?php } ?>

                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->

          <!-- /.box -->

        </div>
        <!-- /.col -->

        <div class="col-md-12">
<div class="box box-info">
  <div class="box-header with-border">

    <div class="box-tools pull-right">
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
  Income List
    <div class="table-responsive">
      <table class="table no-margin" id="fulllistdays">
        <thead>
                <tr style="padding: 15px; background-color: #eeeeee;">
                    <th>Head</th>
                    <th>Property</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th></th>
                  </tr>
        </thead>
        <tbody>
              
        <?php 
                      $total = count($income);
                      for($i = 0; $i < $total; $i++) { ?>
                      <tr>
                            <td><?php echo $income[$i]["boutique_billing_head_name"]; ?></td>
                          
                          <td><?php echo $income[$i]["boutique_property_name"]; ?></td>
                          
                          <td><?php echo $income[$i]["boutique_expense_details"]; ?></td>
                        
                          <td><?php echo $income[$i]["boutique_expense_amount"]; ?></td>
                          <th></th>
                      </tr>

                    <?php } ?>
      
        </tbody>
      </table>
    </div>
  </div>
  </div>
</div>

        <div class="col-md-12">
<div class="box box-info">
  <div class="box-header with-border">

    <div class="box-tools pull-right">
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
  Scheduled Work
    <div class="table-responsive">
      <table class="table no-margin" id="fulllistschedule">
        <thead>
       
                <tr  style="padding: 15px; background-color: #eeeeee;">
                    <th>Sheduled Date</th>
                    <th>Starting date</th>
                    <th>Ending date</th>
                    <th>Actual Work</th>
                    <th>Remarks</th>
                  </tr>
        </thead>
        <tbody>
            <?php 
                      $total = count($listschedulework);
                      for($i = 0; $i < $total; $i++) { ?>
                        <tr>

                       
                          <td><?php echo $listschedulework[$i]["schedule_work_date"]; ?></td>
                          <td><?php echo $listschedulework[$i]["schedule_work_startingdate"]; ?></td>
                          <td><?php echo $listschedulework[$i]["schedule_work_completedate"]; ?></td>
                          <td><?php echo $listschedulework[$i]["schedule_work_actualwork"]; ?></td>
                          <td><?php echo $listschedulework[$i]["schedule_work_task"]; ?></td>
                          
                        </tr>
                      <?php 
                      }
                       ?>

        </tbody>
      </table>
    </div>
  </div>
  </div>
</div>

        <div class="col-md-12">
<div class="box box-info">
  <div class="box-header with-border">

    <div class="box-tools pull-right">
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
  Transfered Items
    <div class="table-responsive">
      <table class="table no-margin" id="fulllisttransfer">
        <thead>
          <tr style="padding: 15px; background-color: #eeeeee;">
              <th>Item Transfered Date</th>
              <th>Property name</th>
              <th>Total Amount</th>
             
          </tr>
        </thead>
        <tbody>
        <?php 
            $total = count($sales);
            for($i = 0; $i < $total; $i++) { ?>
            <tr>
<td width="15%"><?php echo $sales[$i]["boutique_sale_date"]; ?></td>
<td width="15%"><?php echo $sales[$i]["boutique_property_name"]; ?></td>
<td width="15%"><?php echo $sales[$i]["boutique_sale_price"]; ?></td>
</tr>
          <?php
          }
           ?>
         
        </tbody>
      </table>
    </div>
    <!-- /.table-responsive -->
  </div>
  <!-- /.box-body -->
  <!-- /.box-footer -->
</div>
<!-- /.box -->

<!-- /.box -->

</div>
      

<div class="col-md-12">
<div class="box box-info">
  <div class="box-header with-border">

    <div class="box-tools pull-right">
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
  Request Status
    <div class="table-responsive">
      <table class="table no-margin" id="fullliststatus">
        <thead>
       
                <tr  style="padding: 15px; background-color: #eeeeee;">
                    <th>Name</th>
                    <th>Project Manager</th>
                    <th>QA & QC</th>
                    <th>Purchase</th>
                    <th>Accounts</th>
                  </tr>
        </thead>
        <tbody>
        <?php 
                      $total = count($request);
                      for($i = 0; $i < $total; $i++) { ?>
                        <tr>
                     
                        <!-- <th width="5%"><?php echo $request[$i]["builder_purchase_request_date"]; ?></th> -->
                        <th width="10%"><?php echo $request[$i]["builder_purchase_request_item"]; ?></th>
                        <!-- PM -->
                        <td>
                          <span class="label label-success">Requested</span>
                        </td>
<!-- QA & QC -->
                        <td>
                        <?php if($request[$i]["builder_request_status"] == 1){?>
                          <span class="label label-warning">Processing</span>
                          <?php } elseif($request[$i]["builder_request_status"] == 3){ ?>
                         
                          <span class="label label-danger">Rejected</span>
                          <?php } else { ?>
                            <span class="label label-success">Approved</span>
                          <?php } ?>
                        </td>
                        <!-- Purchase -->
                        <td>
                        
                          <?php if($request[$i]["builder_request_status"] == 2){?>
                          <span class="label label-warning">Processing</span>
                          <?php } ?>
                          
                          <?php if($request[$i]["builder_request_status"] == 4){?>
                          <span class="label label-success">Approved</span>
                          <?php } ?>
                          <?php if($request[$i]["builder_request_status"] == 5){?>
                          <span class="label label-danger">Rejected</span>
                          <?php } ?>
                          <?php if($request[$i]["builder_request_status"] == 6){?>
                          <span class="label label-success">Approved</span>
                          <?php } ?>
                          <?php if($request[$i]["builder_request_status"] == 7){?>
                          <span class="label label-success">Approved</span>
                          <?php } ?>
                        </td>
                        <!-- Account -->
                        <td>
                          
                          
                          <?php if($request[$i]["builder_request_status"] == 4){?>
                          <span class="label label-warning">Processing</span>
                          <?php } ?>
                          <?php if($request[$i]["builder_request_status"] == 6){?>
                          <span class="label label-success">Approved</span>
                          <?php } ?>
                          <?php if($request[$i]["builder_request_status"] == 7){?>
                          <span class="label label-danger">Rejected</span>
                          <?php } ?>
                        </td>    
                        </tr>

                        <?php } ?>

        </tbody>
      </table>
    </div>
  </div>
  </div>
</div>

        <!-- /.col -->
      </div>
      <!-- /.row (main row) -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  </body>
<script>

// $("#datepicker").datepicker({
//     onSelect: function(dateText) {
//       display("Selected date: " + dateText + ", Current Selected Value= " + this.value);
//       $(this).change();
//     }
//   }).on("change", function() {
//     alert("Hai")
//   });

  $('#datechange').on('click', function() {
    var cid = $(this).val();
    days = $('#datepicker').val();
var days = days.split("/").join("-");
    location.href = "<?= base_url() ?>Boutique/day_summary/" + days+"/";

  });

  $('#clearchange').on('click', function() {
    location.href = "<?= base_url() ?>Boutique/day_summary/";
  });



  </script>
