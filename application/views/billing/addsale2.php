<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />
<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/css/invoice_style.css' />
	<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/css/print.css' media="print" />
	<!--<script type='text/javascript' src='js/jquery-1.3.2.min.js'></script>-->

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

      </div>
      <div class="box-body">
        <div class="row">

          <div class="col-md-12">
            <div class="form-group">
              <label>Customer</label>
              <div class="input-group">
                <span class="input-group-addon"><span class="fa-user fa"></span></span>
                <select id="cname" name="boutique_customer_id" class="form-control">
                  <option value="">Walk-In Customer</option>                
              <?php
                for($i=0; $i<count($customers);$i++) {
                 ?>
                  <option value="<?php echo $customers[$i]['boutique_customer_id']; ?>" >
                  <?php echo $customers[$i]['boutique_customer_name']; ?>
                  </option>
                <?php } ?>
                </select>
              </div>
            </div>
          </div>
          <!--<div class="auto-widget">
    <p>Your Skills: <input type="text" id="skill_input"/></p>
</div>-->


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

            <textarea id="address" name="boutique_customer_details">Chris Coyier
123 Appleseed Street
Appleville, WI 53719

Phone: (555) 555-5555</textarea>

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
                    <td><textarea name="boutique_sale_invoice"><?php echo 'BM'.$this->session->userdata('BoutiqueID').mt_rand(10000, 99999);?></textarea></td>
                </tr>
                <tr>
                    <td class="meta-head">Date</td>
                    <td><textarea name="boutique_sale_date"><?php echo date("d-m-Y");?></textarea></td>
                </tr>
            </table>

		</div>

    <div class="col-md-6" id="hiderow">    
        <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-barcode"></i>
                </span>
                <input class="form-control mousetrap ui-autocomplete-input" placeholder="Enter SKU / Scan bar code" autofocus="" name="search_product" type="text" autocomplete="off" name="sku" id="sku">
              </div>
        </div>
   </div>
   <div class="col-md-3" id="hiderow">    
        <div class="form-group">
            <input type="button" id="addrow" value="Enter"> 
        </div>
   </div>

    <table id="items" class="table-responsive table">

		  <tr>
		      <th>Item</th>
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
		      <td colspan="6" class="total-line">Total</td>
		      <td class="total-value"><div id="total">0</div>
            <input id="totaltext" type="hidden" name="boutique_sale_price"> </td>
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
		<br>
    <br>
		<input type="submit" class="btn btn-primary" id="hiderow" value="add" onClick = "javascript: p=true;">

		<span class="pull-right" id="hiderow"><a onclick="window.print()">Print</a></span>
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
    <!-- /.content --></form>
</div>
<!-- /.content-wrapper -->

