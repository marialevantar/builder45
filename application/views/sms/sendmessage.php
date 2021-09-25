<?php 
if(@$orderid):
  $backlink = base_url()."messages/works/";
else:
  $backlink = base_url()."messages/orders/";
endif;
 ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Send      
      <small>Message</small>
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
    <form enctype="multipart/form-data" id="workvali" method="post" action="<?php echo base_url(); ?>messages/sendingmessage/">
      <div class="box-header with-border">
        <h3 class="box-title">Message Details</h3>
      </div>
      <div class="box-body">
        <div class="row">
          
          <div class="col-md-6">
            <div class="form-group">
              <label>Message</label>
              <textarea name="message" class="form-control" rows="3" required></textarea>
            </div>
          </div>
          
          <div class="col-md-3">
            <div class="form-group">
              <label>Select Type</label>
              <div class="input-group">
                <span class="input-group-addon"><span class="fa-user fa"></span></span>
                <select name="select_type" id="select_type" class="form-control">
                  <option value="2">Select From List</option>
                  <option value="1">Select All</option>
                  
                </select>
              </div>
            </div>
          </div>

        <div class="col-md-3">
          <div class="form-group">
            <label>&nbsp;</label><br>
            <button type="submit" name="sendsms" value="1" class="btn btn-primary">Send Message</button>
          </div>
        </div>

          

        </div>

        <table id="sendsms" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>Name</th>
                        <?php 
                        if( $this->session->userdata('BoutiqueID') == 29){
                        ?>
                        <th>Customer ID</th>
                        <?php } ?>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Actions</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php 
                      $total = count($customers);
                      for($i = 0; $i < $total; $i++) { ?>
                        <tr>
                          <td><a href="<?php echo base_url(); ?>messages/customerdetails/<?php echo $customers[$i]["boutique_customer_id"]; ?>"><?php echo $customers[$i]["boutique_customer_name"]; ?></a></td>
                          
                          <?php 
                          if( $this->session->userdata('BoutiqueID') == 29){
                          ?>
                          <td><?php echo $customers[$i]["boutique_customer_number"]; ?> </td>
                          <?php } ?>

                          <td><?php echo $customers[$i]["boutique_customer_ph"]; ?> </td>
                          <td><?php echo $customers[$i]["boutique_customer_address"]; ?> </td>
                          <td>
                            <input type="checkbox" class="form-check-input custselected" name="custselected[]" value="<?php echo $customers[$i]["boutique_customer_id"]; ?>">
                          </td>
                        </tr>
                      <?php 
                      }
                       ?>
                      </tbody>
                    </table>

      </div>
      <div class="box-footer">
        
      </div>



    </form>
  </div>
  </section>
</div>

