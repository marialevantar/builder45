<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <!-- <h1>
      Sales     
      <small>List</small>
    </h1> -->
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
    <div class="row">
      <div class="col-xs-12">
                <div class="box">
                  <div class="box-header">
                  <a class="btn btn-info" href="javascript:history.back()">Go Back</a></span>
                                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="saleslist" class="table table-bordered table-striped">
                      
                      
          <div class="col-md-12">
            <div class="form-group">
              <label>Date</label>
              <input type="text" class="form-control" value="<?php echo $sale["boutique_sale_date"]; ?>">
           </div>
          </div>
          
          <div class="col-md-12">
            <div class="form-group">
              <label>Item Transfered To</label>
              <input name="boutique_expense_amount" type="text" class="form-control" value="<?php echo $sale["boutique_property_name"]; ?>" required>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Items</label>
            </div>
          </div>

          <tr>
				<td width="5%">Sl No</td>
				<td width="30%">Item Name</td>
				<td width="34%">HSN Code</td>
				<td width="12%">Quantity</td>
        <td width="24%">Unit Price</td>
				<!-- <td width="11%">'.@(float)$saleitem["boutique_sale_item_totalunitprice"]*@(float)$saleitem["boutique_sale_unit"].'</td> -->
			    </tr>
         <?php  
         $total = 0;
         foreach ($saleitems as $key => $saleitem) {
             		 	$i++;
            
           ?>
				<tr>
				<td width="5%"><?php echo $i ; ?></td>
				<td width="30%"><?php echo @$saleitem["boutique_sale_item_name"] ; ?></td>
				<td width="34%"><?php echo @$saleitem["boutique_item_hsn"] ; ?></td>
				<td width="12%"><?php echo @$saleitem["boutique_sale_unit"] ; ?></td>
        <td width="24%"><?php echo @$saleitem["boutique_sale_item_unitprice"] ; ?></td>
				<!-- <td width="11%">'.@(float)$saleitem["boutique_sale_item_totalunitprice"]*@(float)$saleitem["boutique_sale_unit"].'</td> -->
			    </tr>
			    <!-- $subtotal = $subtotal + @$saleitem["boutique_sale_item_unitprice"] * @$saleitem["boutique_sale_unit"]; -->
			    <!-- $taxamt = $taxamt + @$saleitem["boutique_sale_item_tax"] * @$saleitem["boutique_sale_unit"]; -->
	
  	<?php
  $total = $total + ($saleitem["boutique_sale_item_unitprice"]*@$saleitem["boutique_sale_unit"]); 
  } ?>
    <tr>
				<td width="5%"></td>
				<td width="35%"></td>
				<td width="34%"></td>
				<td width="12%"></td>
        <td width="24%"></td>
				<!-- <td width="11%">'.@(float)$saleitem["boutique_sale_item_totalunitprice"]*@(float)$saleitem["boutique_sale_unit"].'</td> -->
			    </tr>
    <tr>
				<td width="5%"></td>
				<td width="35%"></td>
				<td width="34%"></td>
				<td width="12%">Total Amount</td>
        <td width="24%"><?php echo $total; ?></td>
				<!-- <td width="11%">'.@(float)$saleitem["boutique_sale_item_totalunitprice"]*@(float)$saleitem["boutique_sale_unit"].'</td> -->
			    </tr>
		

                    </table>
                  </div>
                  <!-- /.box-body display:none;-->
                </div>
                <!-- /.box -->
              </div>
              <!-- /.col -->
    </div>
    <!-- /.row (main row) -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this team?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <a class="btn btn-danger btn-ok">Delete</a>
      </div>
    </div>
  </div>
</div>