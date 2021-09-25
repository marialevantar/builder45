<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />
<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/css/invoice_style.css' />
	<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/css/print.css' media="print" />
	<!--<script type='text/javascript' src='js/jquery-1.3.2.min.js'></script>-->
	
	<style>
.frmSearch {border: 1px solid #a8d4b1;background-color: #c6f7d0;margin: 2px 0px;padding:40px;border-radius:4px;}
#country-list{float:left;list-style:none;margin-top:36px;padding:0;width:400px;position: absolute; z-index: 500; height: 160px; overflow:scroll;}
#country-list li{padding: 10px; background: #f0f0f0; border-bottom: #bbb9b9 1px solid;}
#country-list li:hover{background:#ece3d2;cursor: pointer;}
#search-box{padding: 10px;border: #a8d4b1 1px solid;border-radius:4px;}
</style>

<?php
$stat = $this->session->userdata('filter');
if($stat == "rejected"):
  $backlink = base_url()."billing/expences";
elseif($stat == "new"):
  $backlink = base_url()."billing/expences";
elseif($stat == "active"):
  $backlink = base_url()."billing/expences";
else:
  $backlink = base_url()."billing/expences";
endif;
 ?>
<script language="javascript">var p = false;</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Add
      <small>Expence</small>
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
  <form id="addcustomer" method="post" action="<?php echo base_url(); ?>billing/savesale/" onsubmit = "return(p)">
  <section class="content hiderow" id="hiderow" style="min-height: 0px;">
  <div class="box box-info">

      <div class="box-header with-border">
        <h3 class="box-title">Add Sale</h3>
        <?php if(@$sale['boutique_sale_id']){?>        <span class="pull-right"><a class="btn btn-info" href="<?php echo base_url(); ?>billing/addsale">

        Add New Sale</a></span>
        &nbsp;&nbsp;
        <?php }?>        
        <span class="pull-right"><a class="btn btn-info" href="<?php echo base_url(); ?>billing/sales">

        Back</a></span>
        &nbsp;&nbsp;
      </div>
      <div class="box-body">
        <div class="row">

          <div class="col-md-12">
            <div class="form-group">
              <label>Customer</label>
              <div class="input-group">
                <span class="input-group-addon"><span class="fa-user fa"></span></span>
                <select id="cname" name="boutique_customer_id" class="form-control select2">
                  <option value="0">Walk-In Customer</option>                
              <?php
                for($i=0; $i<count($customers);$i++) {
                 ?>
                  <option value="<?php echo $customers[$i]['boutique_customer_id']; ?>" <?php if($customers[$i]['boutique_customer_id'] == @$sale['boutique_customer_id']){ echo 'selected="selected"';} ?>>
                  <?php echo $customers[$i]['boutique_customer_name']; ?>
                  </option>
                <?php } ?>
                </select>
              </div>
            </div>
          </div>



        </div>
      </div>
      <!-- /.box-body -->

  </div>

    <!-- /.row -->
  </section>

  <!-- Main content -->
  <section class="content">
  <div class="box box-info">


      <div id="page-wrap">

		<textarea id="header" style="height:40px;">INVOICE</textarea>

		<div id="identity">

            <textarea id="address" name="boutique_customer_details"> <?php if(@$sale['boutique_customer_details'] ==''){ ?>  <?php } else{ echo $sale['boutique_customer_details']; }?></textarea>

            <!--<div id="logo">

              <div id="logoctr">
                <a href="javascript:;" id="change-logo" title="Change logo">Change Logo</a>
                <a href="javascript:;" id="save-logo" title="Save changes">Save</a>
                |
                <a href="javascript:;" id="delete-logo" title="Delete logo">Delete Logo</a>
                <a href="javascript:;" id="cancel-logo" title="Cancel changes">Cancel</a>
              </div>

              <div id="logohelp">
                <input id="imageloc" type="text" size="50" value="" /><br />
                (max width: 540px, max height: 100px)
              </div>
              <img id="image" src="images/logo.png" alt="logo" />
            </div>-->

            <div id="company_name">
             <h3><b><?php echo $boutiquedetails['boutique_name'];?></b></h3>
              <?php echo $boutiquedetails['boutique_address'];?>
            </div>
		</div>

		<div style="clear:both"></div>

		<div id="customer">

            <!-- <textarea id="customer-title"><?php //echo $boutiquedetails['boutique_name'];?></textarea> -->

            <table id="meta">
                <tr>
                    <td class="meta-head">Invoice #</td>
                    <td><textarea name="boutique_sale_invoice"><?php if(@$sale['boutique_sale_invoice']){ echo $sale['boutique_sale_invoice']; }else{ echo $invoiceid;}?></textarea></td>
                    <input type="hidden" name="boutique_sale_invoice_gstnumber" value="<?php echo $gstinvoiceid;?>">
                </tr>
                <tr>
                    <td class="meta-head">Date</td>
                    <td><textarea name="boutique_sale_date"><?php if(@$sale['boutique_sale_date']){ echo $sale['boutique_sale_date']; }else{echo date("d-m-Y");}?></textarea></td>
                </tr>
                <tr>
                    <td class="meta-head">Payment Type</td>
                    <td>
                      <select id="boutique_sale_paymenttype" name="boutique_sale_paymenttype" class="form-control">
                        <option value="Cash" <?php if(@$sale['boutique_sale_paymenttype'] == "Cash"){ echo "selected='selected'"; }?>>Cash</option>
                        <option value="Card" <?php if(@$sale['boutique_sale_paymenttype'] == "Card"){ echo "selected='selected'"; }?>>Card</option>
                      </select>
                    </td>
                </tr>
                <?php if(@$this->session->userdata('BoutiqueID') == 30){?>
                <tr>
                    <td class="meta-head">Bill Type</td>
                    <td>
                      <select id="boutique_sale_billtype" name="boutique_sale_billtype" class="form-control">
                        <option value="1" <?php if(@$sale['boutique_sale_billtype'] == 1){ echo "selected='selected'"; }?>>Normal</option>
                        <option value="2" <?php if(@$sale['boutique_sale_billtype'] == 2){ echo "selected='selected'"; }?>>GST</option>
                      </select>
                    </td>
                </tr>
            	<?php }
            		  else{
            	?>
            	<input type="hidden" name="boutique_sale_billtype" value="1" >
            	<?php
            		  }
            	 ?>
            </table>

		</div>
    <?php if(@!$sale['boutique_sale_id']){?>
    <div class="col-md-6" id="hiderow">    
        <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-barcode"></i>
                </span>
                <input class="form-control mousetrap ui-autocomplete-input" placeholder="Enter SKU / Scan bar code / Search Item" autofocus="" name="search_product" type="text" autocomplete="off" name="sku" id="sku">
                
                <div id="suggesstion-box"></div>
                <input type="hidden" name="siteurl" id="siteurl" value="<?php echo base_url(); ?>billing/getProduct">
                
              </div>
        </div>
   </div>
   <div class="col-md-3" id="hiderow">    
        <div class="form-group">
            <input type="button" id="addrow" value="Enter"> | <input type="button" id="addcrow" value="Add Row">
        </div>
   </div>
   <?php }?>    

   <table id="items" class="table-responsive table">
		  <tr>
		      <th>Item</th>
           <?php if($this->session->userdata('BoutiqueID') == 21 || $this->session->userdata('BoutiqueID') == 30){?>
          <th>HSN Code</th>
          <?php } ?>
		      <th>Description</th>
		      <th>Unit Cost</th>
          <th>Tax Value</th>
          <th>Total Cost</th>
		      <th>Quantity</th>
		      <th>Price</th>
		  </tr>

		  <tr class="item-row" style="display:none;">
		      <td class="item-name"><div class="delete-wpr"><textarea>Web Updates</textarea><a class="delete" href="javascript:;" title="Remove row">X</a></div></td>
		      <td class="description"><textarea>Monthly web updates for http://widgetcorp.com (Nov. 1 - Nov. 30, 2009)</textarea></td>
		      <td><textarea class="cost">0.00</textarea></td>
		      <td><textarea class="qty">1</textarea></td>
		      <td><span class="price">0.00</span></td>
		  </tr>
      <?php foreach($saleitems as $items) { ?>
        <tr class="item-row">
        <td class="item-name"><div class="delete-wpr"><input type="hidden" name="boutique_item_id[]" value="<?php echo $items['boutique_item_id'];?>"><textarea name="boutique_sale_item_name[]"><?php echo $items['boutique_sale_item_name'];?></textarea><a class="delete" href="javascript:;" title="Remove row">X</a></div></td>
         <?php if($this->session->userdata('BoutiqueID') == 21 || $this->session->userdata('BoutiqueID') == 30){?>
        <td class="boutique_sale_item_hsn"><textarea name="boutique_sale_item_hsn[]"><?php echo $items['boutique_sale_item_hsn'];?></textarea></td>
        <?php } ?>
        <td class="description"><textarea name="boutique_sale_item_desc[]"><?php echo $items['boutique_sale_item_desc'];?></textarea></td>
        <td><textarea name="boutique_sale_item_unitprice[]" class="cost"><?php echo $items['boutique_sale_item_unitprice'];?></textarea></td>
        <td><textarea name="boutique_sale_item_tax[]" class="tax"><?php echo round($items['boutique_sale_item_tax'],2);?></textarea></td>
        <td><textarea name="boutique_sale_item_totalunitprice[]" class="totalvalue"><?php echo round($items['boutique_sale_item_totalunitprice'],2);?></textarea></td>
        <td><textarea name="boutique_item_total_quantity[]" class="qty" max=""><?php echo $items['boutique_sale_unit'];?></textarea></td>
        <td><span class="price">Rs <?php echo round($items['boutique_sale_unit']*$items['boutique_sale_item_totalunitprice'],2);?></span></td>
      </tr>
    <?php } ?>
		  <!--<tr class="item-row">
		      <td class="item-name"><div class="delete-wpr"><textarea>SSL Renewals</textarea><a class="delete" href="javascript:;" title="Remove row">X</a></div></td>

		      <td class="description"><textarea>Yearly renewals of SSL certificates on main domain and several subdomains</textarea></td>
		      <td><textarea class="cost">$75.00</textarea></td>
		      <td><textarea class="qty">3</textarea></td>
		      <td><span class="price">$225.00</span></td>
		  </tr>-->

		  <!--<tr id="hiderow">
		    <td colspan="5"><a id="addrow" href="javascript:;" title="Add a row">Add a row</a></td>
		  </tr>-->

		  <!--<tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Subtotal</td>
		      <td class="total-value"><div id="subtotal">0</div></td>
		  </tr>-->
		  <tr>
          <?php if($this->session->userdata('BoutiqueID') == 21 || $this->session->userdata('BoutiqueID') == 30){?>
		      <td colspan="7" class="total-line">Total</td>
          <?php } 
          else {?>
          <td colspan="6" class="total-line">Total</td>
          <?php } ?>
		      <td class="total-value"><div id="total"><?php if(@$sale['boutique_sale_price']){ echo @round($sale['boutique_sale_price'],2);}else{ echo "0";}?></div>
            <input id="totaltext" type="hidden" name="boutique_sale_price" value="<?php echo @round($sale['boutique_sale_price'],2);?>"> </td>
		  </tr>
		  <!--<tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Amount Paid</td>

		      <td class="total-value"><textarea id="paid">0</textarea></td>
		  </tr>-->
		  <!--<tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line balance">Balance Due</td>
		      <td class="total-value balance"><div class="due">0</div></td>
		  </tr>-->

		</table>
     <?php if($this->session->userdata('BoutiqueID') == 21 || $this->session->userdata('BoutiqueID') == 30){?>
    <br>
    <br>
    <div class="col-md-6">
            <div class="form-group">
              <label>Amount Paid</label>
              <input name="boutique_sale_amountpaid" id="boutique_sale_amountpaid" type="text" class="form-control" value="<?php echo @$sale['boutique_sale_amountpaid'];?>">
            </div>
          </div>
     <div class="col-md-6">
            <div class="form-group">
              <label>Amount Balance</label>
              <input id="boutique_sale_balanceamount" type="text" class="form-control" value="<?php echo @$sale['boutique_sale_balanceamount'];?>" disabled>
              <input name="boutique_sale_balanceamount" id="boutique_sale_balanceamount_value" type="hidden" class="form-control" value="<?php echo @$sale['boutique_sale_balanceamount'];?>" >
            </div>
          </div>
      <?php } ?>

		<br>
    <br>
  </br>
    <?php if(@!$sale['boutique_sale_id']){?>
		<input type="submit" class="btn btn-primary" id="hiderow" value="add" onClick = "javascript: p=true;">
    <?php } ?>
    <?php if(@$sale['boutique_sale_id'] && $this->session->userdata('BoutiqueID') != 31){?>
		<span class="pull-right" id="hiderow"><a href="<?php echo base_url(); ?>billing/bill/<?php echo $sale['boutique_sale_id']; ?>" target="_blank">Print Bill</a></span>
    <?php }
          elseif(@$sale['boutique_sale_id'] && $this->session->userdata('BoutiqueID') == 31){?>
          <span class="pull-right" id="hiderow"><a href="<?php echo base_url(); ?>billing/billthermalnew/<?php echo $sale['boutique_sale_id']; ?>" target="_blank">Print Bill</a></span>
    <?php          
          }
    ?>
    <br>
    <br>

		<!--<div id="terms">
		  <h5>Terms</h5>
		  <textarea>NET 30 Days. Finance Charge of 1.5% will be made on unpaid balances after 30 days.</textarea>
		</div>-->

	</div>


  </div>

    <!-- /.row -->
  </section>
    <!-- /.content -->
  </form>
</div>
<!-- /.content-wrapper -->

