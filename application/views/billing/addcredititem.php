<?php 
$stat = $this->session->userdata('filter');
if($stat == "rejected"):
  $backlink = base_url()."boutique/expences";
elseif($stat == "new"):
  $backlink = base_url()."boutique/expences";
elseif($stat == "active"):
  $backlink = base_url()."boutique/expences";
else:
  $backlink = base_url()."boutique/expences";
endif;
 ?>
 <!DOCTYPE html>
<html>
<head>
	<title>Credit Item Purchase | CIP</title>
        <!--Jquery Link-->
        <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src ="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!-- Bootstrap Styling-->
  <link href="https://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<!-- <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	-->
	
	<!-- custom stylesheet-->
	<link rel="stylesheet" type="text/css" href="dynamic.css" />

	<!-- custom javascript-->
	<script src="dynamic.js"></script>

</head>

<body>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Add
      <small>Credit Items</small>
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
    <form id="addcustomer" method="post" action="<?php echo base_url(); ?>billing/savecredititems/">
      <div class="box-header with-border">
        <h3 class="box-title">Credit Item Details</h3>
        <span class="pull-right"><a class="btn btn-info" href="<?php echo @$backlink; ?>">
        Back</a></span>
      </div>
      <div class="box-body">
        <div class="row">

          <div class="col-md-12">
            <div class="form-group">
              <label>Date</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input name="boutique_expense_date" type="text" class="form-control pull-right" id="datepicker">
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Invoice No</label>  
                <input name="invoice_no" type="text" class="form-control" value="<?php echo $invoice; ?>">
            </div>
          </div>
      
                     <?php if($this->session->userdata('UserID') ==126) {?>
           <div class="col-md-12">
            <div class="form-group">
                <label>Select Property</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="fa-user fa"></span></span>
                  <select name="property_id" class="form-control" required>
                    <option value="">Select Property</option>
                  <?php
                  for($i=0; $i<count($properties);$i++) {
                   ?>
                    <option value="<?php echo $properties[$i]['boutique_property_id']; ?>">
                    <?php echo $properties[$i]['boutique_property_name']; ?>
                    </option>
                  <?php } ?>
                  </select>
                </div>
            </div>
          </div>
            <?php } ?>
          <div class="col-md-12">
            <div class="form-group">
                <label>Select Vendor</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="fa-user fa"></span></span>
                  <select name="boutique_billing_head_id" class="form-control" required>
                    <option value="">Select Vendor</option>
                  <?php
                  for($i=0; $i<count($vendor);$i++) {
                   ?>
                    <option value="<?php echo $vendor[$i]['b_boutique_vendor_id']; ?>">
                    <?php echo $vendor[$i]['b_boutique_vendor_name']; ?>
                    </option>
                  <?php } ?>
                  </select>
                </div>
            </div>
          </div>

<!-- Advance Purchasing -->

<!-- Item List-->
<div class="col-md-12">
            <div class="form-group">
              <label>Add Credited Item</label>
            </div>
          </div>

<div class="col-md-12">
 
<div class="list_wrapper">  
                                <div class="row">

                                    <div class="col-xs-2 col-sm-2 col-md-2">

                                        <div class="form-group">
                                            Item Name
                                            <input name="ltem_name[0][]" type="text" placeholder="" class="form-control"/>
                                            
                                        </div>
                                    </div>

                                    
                                    <div class="col-xs-2 col-sm-2 col-md-2">

                                        <div class="form-group">
                                          HSN Code
                                            <input name="hsncode[0][]" type="text" placeholder="" class="form-control"/>
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-2 col-sm-2 col-md-2">

                                        <div class="form-group">
                                          Item Price
                                            <input id="itemprice" name="itemprice[0][]" type="text" value="0" placeholder="" class="form-control"/>
                                            
                                        </div>
                                    </div>

                                    <div class="col-xs-2 col-sm-2 col-md-2">

                                        <div class="form-group">
                                        CGST
                                            <!-- <input name="s_price[0][]" type="text" placeholder="" class="form-control"/> -->
                                            <input id="gst_percgst" name="gst_percgst1" type="hidden" value="0" placeholder="" class="form-control gst_percgst"/>
                                      
                                            <select id="gst_per" name="gst_per[0][]"  class="form-control gst_per">
                                              <option value="0">No Tax</option>
                                              <option value="2.5">2.5 %</option>
                                              <option value="6">6 %</option>
                                              <option value="9">9 %</option>
                                              <option value="14">14 %</option>
                                            </select>                                       
                                            
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2">

                                        <div class="form-group">
                                        SGST
                                            <!-- <input name="s_price[0][]" type="text" placeholder="" class="form-control"/> -->
                                            <input id="gst_persgst1lo" name="gst_persgst1" type="hidden" value="0" placeholder="" class="form-control gst_persgst1"/>
 
                                            <select id="gst_persgst" name="gst_persgst[0][]"  class="form-control">
                                              <option value="0">No Tax</option>
                                              <option value="2.5">2.5 %</option>
                                              <option value="6">6 %</option>
                                              <option value="9">9 %</option>
                                              <option value="14">14 %</option>
                                            </select>                                       
                                            
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2">

                                        <div class="form-group">
                                        IGST
                                            <!-- <input name="s_price[0][]" type="text" placeholder="" class="form-control"/> -->
                                            <input id="gst_perigst1lo" name="gst_perigst1"   class="form-control gst_perigst" type="hidden" value="0" placeholder="" class="form-control gst_perigst1"/>


                                            <select id="gst_perigst" name="gst_perigst[]"  class="form-control">
                                              <option value="0">No Tax</option>
                                              <option value="5">5 %</option>
                                              <option value="12">12 %</option>
                                              <option value="18">18 %</option>
                                              <option value="28">28 %</option>
                                            </select>                                       
                                            
                                        </div>
                                    </div>

                                 

                                    <div class="col-xs-2 col-sm2 col-md-2">

                                        <div class="form-group">
                                          Quantiy
                                            <input id="quantity" name="quantity[0][]" type="text" placeholder="" value="1" class="form-control"/>
                                            
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2">

                                        <div class="form-group">
                                         Amount
                                            <input id="amount_item" name="amount_item[0][]" type="text" placeholder="" value="0" class="form-control amount_item"/>
                                            
                                        </div>
                                    </div>
                                   
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                        <br>
                                       <button class="btn btn-primary list_add_button" type="button">+</button>
                                    </div>
                                </div>
                            </div>
                            
                   
 
</div>




          


<!-- Item Closing-->


<!-- Advance purchasing closing -->
          
<!-- 
          <div class="col-md-12">
            <div class="form-group">
              <label>Payment Type</label>

              <select name="boutique_sale_paymenttype" class="form-control">
                        <option value="Cash">Cash</option>
                        <option value="Card">Card</option>
                      </select>
            </div>
          </div> -->
          
          <div class="col-md-12">
            <div class="form-group">
              <label>Amount</label>
              <input id="totalamount" name="boutique_expense_amount" type="text" class="form-control" value="" required>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Payment Type</label>

              <select name="boutique_sale_paymenttype" class="form-control">
                        <option value="Cash,Cash">Cash</option>
                        <option value="Card,HDFC">HDFC BANK</option>
                        <option value="Card1,AXIS">AXIS BANK</option>
                      </select>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label>TOTAL SGST</label>
              <input id="totalsgst" name="totalsgst" type="text" value="0" class="form-control" value="">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>TOTAL CGST</label>
              <input id="totalcgst" name="totalcgst" type="text" value="0" class="form-control" value="">
            </div>
          </div><div class="col-md-3">
            <div class="form-group">
              <label>TOTAL IGST</label>
              <input id="totaligst" name="totaligst" type="text" value="0" class="form-control" value="">
            </div>
          </div><div class="col-md-3">
            <div class="form-group">
              <label>TOTAL GST</label>
              <input id="totalgst" name="totalgst" type="text" value="0" class="form-control" value="">
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Credit items Description</label>
              <textarea name="boutique_expense_details" class="form-control" rows="3"></textarea>
            </div>
          </div>
           <div class="col-md-12">
            <div class="form-group">
              <label>Date Of Arrival</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input name="boutique_arrival_date" type="text" class="form-control pull-right" id="datepicker1">
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Last date of Payment</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input name="boutique_last_date_payment" type="text" class="form-control pull-right" id="datepicker2">
              </div>
            </div>
          </div>

        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Add</button>
        <a formnovalidate id="<?php echo @$teamdetail->TeamID; ?>" class="pull-right">
        </a>
      </div>
    </form>
  </div>

    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->


</body>
<script>
$(document).ready(function()
{
  
  // $('.list_wrapper').on('click', '.list_add_button', function()
  //    {
  //     //  alert("Hai")
  //       $(this).closest('div.row').remove(); //Remove field html
  //       x--; //Decrement field counter
  //    });

 var x = 0; //Initial field counter
 var list_maxField = 100; //Input fields increment limitation
var index=0; 
     //Once add button is clicked
 $('.list_add_button').click(function()
     {
     //Check maximum number of input fields
     if(x < list_maxField){ 
         x++; 
         var list_fieldHTML = '<div class="row"><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input name="ltem_name['+x+'][]" type="text" id="cname'+x+'" placeholder="Type Item Name" class="form-control"/></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input name="hsncode['+x+'][]" type="text" id="barcode'+x+'" placeholder="Hsn code" class="form-control"/></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input id="itemprice'+x+'" name="itemprice['+x+'][]" type="text" placeholder="Item Price" value="0" class="form-control"/></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input id="gst_percgst'+x+'" name="gst_percgst'+x+'" type="hidden" value="0" placeholder="" class="form-control gst_percgst"/><select id="gst_per'+x+'" name="gst_per['+x+'][]"  class="form-control gst_per"><option value="0">No Tax</option><option value="2.5">2.5 %</option><option value="6">6 %</option><option value="9">9 %</option><option value="14">14 %</option></select> </div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input id="gst_persgst1'+x+'" name="gst_persgst1'+x+'" type="hidden" value="0" placeholder="" class="form-control gst_persgst1"/><select id="gst_persgst'+x+'" name="gst_persgst['+x+'][]"  class="form-control"><option value="0">No Tax</option><option value="2.5">2.5 %</option><option value="6">6 %</option><option value="9">9 %</option><option value="14">14 %</option></select> </div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input id="gst_perigst1'+x+'" name="gst_perigst1'+x+'" type="hidden" value="0" placeholder="" class="form-control gst_perigst"/><select id="gst_perigst'+x+'" name="gst_perigst['+x+'][]"  class="form-control"><option value="0">No Tax</option><option value="5">5 %</option><option value="12">12 %</option><option value="18">18 %</option><option value="28">28 %</option></select> </div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input id="quantity'+x+'" name="quantity['+x+'][]" type="text" placeholder="Quantity" value="1" class="form-control"/></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input id="amount_item'+x+'" value="0" name="amount_item['+x+'][]" type="text" placeholder="Amount" class="form-control amount_item"/></div></div><div class="col-xs-1 col-sm-7 col-md-1"><a href="javascript:void(0);" class="list_remove_button btn btn-danger">-</a></div><button class="btn btn-primary list_add_button" type="button">+</button></div>'; //New input field html  
         $('.list_wrapper').append(list_fieldHTML); //Add field html
         
//          $('#pu_price'+x+'').on('change', function() {
//   var cid=this.value;
//   parseFloat(cid);
//     if(cid == 0){
//         $('#amnt'+x+'').val(0);
//     }
//     else  <button class="btn btn-primary list_add_button" type="button">+</button><button class="btn btn-primary list_add_button" type="button">+</button>
//     {
//       cid=(parseFloat(cid)+parseFloat((cid*5)/100));
//       $('#amnt'+x+'').val(parseFloat(cid).toFixed(2));
//     }    
// });

// $('#gst_per'+x+'').on('change', function() {
//    alert("CGST")
//   // var cid=this.value;
//   totalamnt= (parseInt($('#itemprice'+x+'').val()) * ( parseInt($('#gst_per'+x+'').val()) / 100))
//   // $('#boutique_work_expense_amount2').val(parseInt($("#itemprice").val())+parseInt($("#gst_per").val()))    
//   $('#amount_item'+x+'').val((parseInt($('#itemprice'+x+'').val())+parseInt(totalamnt))*parseInt($('#quantity'+x+'').val()))
//   // alert(totalamnt)  
// });

// setInterval(function(){ 
//   total=0;
//   total=(parseInt($("#amount_item").val())+parseInt(total))
// for(i=0;i<x;i++)
// {
//   $('#totalamount').val((parseInt($('#amount_item'+x+'').val())+parseInt(total)))
// }    
//    }, 1000);
 
// $('#quantity'+x+'').on('change', function() {
//   alert("Hai")
//   // var cid=this.value;
//   totalamnt= (parseInt($('#itemprice'+x+'').val()) * ( parseInt($('#gst_per'+x+'').val()) / 100))
//   // $('#boutique_work_expense_amount2').val(parseInt($("#itemprice").val())+parseInt($("#gst_per").val()))    
//   $('#amount_item'+x+'').val((parseInt($('#itemprice'+x+'').val())+parseInt(totalamnt))*parseInt($('#quantity'+x+'').val()))
//   // alert(totalamnt)  
// });
$('#gst_per'+x+'').on('change', function() {
  // alert(this.value)
  // var cid=this.value;
  totalamnt=0
  totalamnt= (parseFloat($('#itemprice'+x+'').val()) * ( (parseFloat($('#gst_per'+x+'').val())+parseFloat($('#gst_persgst'+x+'').val())+parseFloat($('#gst_perigst'+x+'').val())) / 100))
  // $('#boutique_work_expense_amount2').val(parseInt($("#itemprice").val())+parseInt($("#gst_per").val()))    
  $('#amount_item'+x+'').val((parseFloat($('#itemprice'+x+'').val())+parseFloat(totalamnt))*parseFloat($('#quantity'+x+'').val()))
  // alert(totalamnt)  
  cgst =((parseFloat($('#itemprice'+x+'').val()) * ( (parseFloat($('#gst_per'+x+'').val())) / 100)))*parseFloat($('#quantity'+x+'').val())
$('#gst_percgst'+x+'').val(cgst)
// alert(sgst)
  sum=0
  $('.amount_item').each(function(){
            sum += parseFloat(this.value);
        $('#totalamount').val(sum)
         
})
cgst=0
  $('.gst_percgst').each(function(){
    cgst += parseFloat(this.value);
        $('#totalcgst').val(cgst)
         
})
// cgst=0
//   $('.gst_percgst').each(function(){
//             sum += parseFloat(this.value);
//         $('#totalcgst').val(cgst)
         
// })
    
});


$('#gst_persgst'+x+'').on('change', function() {
  // alert(this.value)
  // var cid=this.value;
  totalamnt= (parseFloat($('#itemprice'+x+'').val()) * ( (parseFloat($('#gst_per'+x+'').val())+parseFloat($('#gst_persgst'+x+'').val())+parseFloat($('#gst_perigst'+x+'').val()) ) / 100))
  // $('#boutique_work_expense_amount2').val(parseInt($("#itemprice").val())+parseInt($("#gst_per").val()))    
  $('#amount_item'+x+'').val((parseFloat($('#itemprice'+x+'').val())+parseFloat(totalamnt))*parseFloat($('#quantity'+x+'').val()))
    
 
  sgst =((parseFloat($('#itemprice'+x+'').val()) * ( (parseFloat($('#gst_persgst'+x+'').val())) / 100)))*parseFloat($('#quantity'+x+'').val())
$('#gst_persgst1'+x+'').val(sgst)


  sum=0
  $('.amount_item').each(function(){
            sum += parseFloat(this.value);
        $('#totalamount').val(sum)
         
})
sgst=0
  $('.gst_persgst1').each(function(){
    sgst += parseFloat(this.value);
        $('#totalsgst').val(sgst)
         
})

});
$('#gst_perigst'+x+'').on('change', function() {
//   alert(this.value)
  // var cid=this.value;
  totalamnt= (parseFloat($('#itemprice'+x+'').val()) * ( (parseFloat($('#gst_per'+x+'').val())+parseFloat($('#gst_persgst'+x+'').val())+parseFloat($('#gst_perigst'+x+'').val()) ) / 100))
  // $('#boutique_work_expense_amount2').val(parseInt($("#itemprice").val())+parseInt($("#gst_per").val()))    
  $('#amount_item'+x+'').val((parseFloat($('#itemprice'+x+'').val())+parseFloat(totalamnt))*parseFloat($('#quantity'+x+'').val()))
  // alert(totalamnt)  
  igst =((parseFloat($('#itemprice'+x+'').val()) * ( (parseFloat($('#gst_perigst'+x+'').val())) / 100)))*parseFloat($('#quantity'+x+'').val())
$('#gst_perigst1'+x+'').val(igst)


  sum=0
  $('.amount_item').each(function(){
            sum += parseFloat(this.value);
        $('#totalamount').val(sum)
         
})
igst=0
  $('.gst_perigst').each(function(){
    igst += parseFloat(this.value);
        $('#totaligst').val(igst)
         
})
});
//
$('#itemprice'+x+'').on('change', function() {
//   alert(this.value)
  // var cid=this.value;
  totalamnt= (parseFloat($('#itemprice'+x+'').val()) * ( (parseFloat($('#gst_per'+x+'').val())+parseFloat($('#gst_persgst'+x+'').val())+parseFloat($('#gst_perigst'+x+'').val()) ) / 100))
  // $('#boutique_work_expense_amount2').val(parseInt($("#itemprice").val())+parseInt($("#gst_per").val()))    
  $('#amount_item'+x+'').val((parseFloat($('#itemprice'+x+'').val())+parseFloat(totalamnt))*parseFloat($('#quantity'+x+'').val()))
  // alert(totalamnt)  
  cgst =((parseFloat($('#itemprice'+x+'').val()) * ( (parseFloat($('#gst_per'+x+'').val())) / 100)))*parseFloat($('#quantity'+x+'').val())
$('#gst_percgst'+x+'').val(cgst)

sgst =((parseFloat($('#itemprice'+x+'').val()) * ( (parseFloat($('#gst_persgst'+x+'').val())) / 100)))*parseFloat($('#quantity'+x+'').val())
$('#gst_persgst1'+x+'').val(sgst)

igst =((parseFloat($('#itemprice'+x+'').val()) * ( (parseFloat($('#gst_perigst'+x+'').val())) / 100)))*parseFloat($('#quantity'+x+'').val())
$('#gst_perigst1'+x+'').val(igst)

sum=0
  $('.amount_item').each(function(){
            sum += parseFloat(this.value);
        $('#totalamount').val(sum)
         
})
cgst=0
  $('.gst_percgst').each(function(){
    cgst += parseFloat(this.value);
        $('#totalcgst').val(cgst)
         
})
sgst=0
  $('.gst_persgst1').each(function(){
    sgst += parseFloat(this.value);
        $('#totalsgst').val(sgst)
         
})
igst=0
  $('.gst_perigst').each(function(){
    igst += parseFloat(this.value);
        $('#totaligst').val(igst)
         
})

});
$('#quantity'+x+'').on('change', function() {
  // alert(this.value)
  // var cid=this.value;
  totalamnt= (parseFloat($('#itemprice'+x+'').val()) * ( (parseFloat($('#gst_per'+x+'').val())+parseFloat($('#gst_persgst'+x+'').val())+parseFloat($('#gst_perigst'+x+'').val()) ) / 100))
  // $('#boutique_work_expense_amount2').val(parseInt($("#itemprice").val())+parseInt($("#gst_per").val()))    
  $('#amount_item'+x+'').val((parseInt($('#itemprice'+x+'').val())+parseInt(totalamnt))*parseInt($('#quantity'+x+'').val()))
  // alert(totalamnt)  
  cgst =((parseFloat($('#itemprice'+x+'').val()) * ( (parseFloat($('#gst_per'+x+'').val())) / 100)))*parseFloat($('#quantity'+x+'').val())
$('#gst_percgst'+x+'').val(cgst)

sgst =((parseFloat($('#itemprice'+x+'').val()) * ( (parseFloat($('#gst_persgst'+x+'').val())) / 100)))*parseFloat($('#quantity'+x+'').val())
$('#gst_persgst1'+x+'').val(sgst)

igst =((parseFloat($('#itemprice'+x+'').val()) * ( (parseFloat($('#gst_perigst'+x+'').val())) / 100)))*parseFloat($('#quantity'+x+'').val())
$('#gst_perigst1'+x+'').val(igst)

  sum=0
  $('.amount_item').each(function(){
            sum += parseFloat(this.value);
        $('#totalamount').val(sum)
         
})
cgst=0
  $('.gst_percgst').each(function(){
    cgst += parseFloat(this.value);
        $('#totalcgst').val(cgst)
         
})
sgst=0
  $('.gst_persgst1').each(function(){
    sgst += parseFloat(this.value);
        $('#totalsgst').val(sgst)
         
})
igst=0
  $('.gst_perigst').each(function(){
    igst += parseFloat(this.value);
        $('#totaligst').val(igst)
         
})

});


// $(".amount_item").change(function(){
//   alert("The text has been change.");
// });   
        }
 

     });

     $('.amount_item').each(function(){
sum=0
if (!isNaN(this.value) && this.value.length != 0) {
            sum += parseFloat(this.value);
        }
        // $('#totalamount').val(sum)
        $('#totalamount').val(sum)
});

  //    setInterval(function(){ 
  //      total=0;  list_add_button
  // for(i=1;i<=x;i++)
  // {
  //   $('#totalamount').val((parseInt($("#itemprice").val())+parseInt(total)))
  //  }    
  // }, 1000);
  

     //Once remove button is clicked
     $('.list_wrapper').on('click', '.list_remove_button', function()
     {
      //  alert("Hai")
        $(this).closest('div.row').remove(); //Remove field html
        x--; //Decrement field counter
        sum=0
  $('.amount_item').each(function(){
            sum += parseFloat(this.value);
        $('#totalamount').val(sum)
         
})
cgst=0
  $('.gst_percgst').each(function(){
    cgst += parseFloat(this.value);
        $('#totalcgst').val(cgst)
         
})
sgst=0
  $('.gst_persgst1').each(function(){
    sgst += parseFloat(this.value);
        $('#totalsgst').val(sgst)
         
})
igst=0
  $('.gst_perigst').each(function(){
    igst += parseFloat(this.value);
        $('#totaligst').val(igst)
         
})      
     });
});


// Default OR first Row

$('#gst_per').on('change', function() {
//   alert(this.value)
  // var cid=this.value;
  totalamnt= (parseFloat($("#itemprice").val()) * ( (parseFloat($("#gst_per").val())+parseFloat($("#gst_persgst").val())+parseFloat($("#gst_perigst").val())) / 100))
  // $('#boutique_work_expense_amount2').val(parseInt($("#itemprice").val())+parseInt($("#gst_per").val()))    

  $('#amount_item').val((parseFloat($("#itemprice").val())+parseFloat(totalamnt))*parseFloat($("#quantity").val()))
  // alert(totalamnt)  
  // $('.amount_item').each(function(){
// sum=0
// sum+=Number($(this).val());
cgst =((parseFloat($("#itemprice").val()) * ( (parseFloat($("#gst_per").val())) / 100)))*parseFloat($("#quantity").val())
$('#gst_percgst').val(cgst)
// });
sum=0
  $('.amount_item').each(function(){
            sum += parseFloat(this.value);
        $('#totalamount').val(sum)       
})
cgst=0
  $('.gst_percgst').each(function(){
    cgst += parseFloat(this.value);
        $('#totalcgst').val(cgst)
         
})

})
//SGST Chaning
$('#gst_persgst').on('change', function() {
//   alert(this.value)
  // var cid=this.value;
  totalamnt= (parseFloat($("#itemprice").val()) * ( (parseFloat($("#gst_per").val())+parseFloat($("#gst_persgst").val())+parseFloat($("#gst_perigst").val()) ) / 100))
  // $('#boutique_work_expense_amount2').val(parseInt($("#itemprice").val())+parseInt($("#gst_per").val()))    
  $('#amount_item').val((parseFloat($("#itemprice").val())+parseFloat(totalamnt))*parseFloat($("#quantity").val()))
  // alert(totalamnt)  
//   $('.amount_item').each(function(){
// sum=0 gst_persgst1
// sum+=Number($(this).val());
// $('#totalamount').val(sum)  gst_persgst1
// });
sgst =((parseFloat($("#itemprice").val()) * ( (parseFloat($("#gst_persgst").val())) / 100)))*parseFloat($("#quantity").val())
$('#gst_persgst1lo').val(sgst)

sum=0
  $('.amount_item').each(function(){
            sum += parseFloat(this.value);
        $('#totalamount').val(sum)
         
})
sgst=0
  $('.gst_persgst1').each(function(){
    sgst += parseFloat(this.value);
        $('#totalsgst').val(sgst)
         
})

});
//IGST Changing
$('#gst_perigst').on('change', function() {
//   alert(this.value)
  // var cid=this.value;
  totalamnt= (parseFloat($("#itemprice").val()) * ( (parseFloat($("#gst_per").val())+parseFloat($("#gst_persgst").val())+parseFloat($("#gst_perigst").val()) ) / 100))
  // $('#boutique_work_expense_amount2').val(parseInt($("#itemprice").val())+parseInt($("#gst_per").val()))    
  $('#amount_item').val((parseFloat($("#itemprice").val())+parseFloat(totalamnt))*parseFloat($("#quantity").val()))
  // alert(totalamnt)  
//   $('.amount_item').each(function(){
// sum=0
// sum+=Number($(this).val());
// $('#totalamount').val(sum)
// });
igst =((parseFloat($("#itemprice").val()) * ( (parseFloat($("#gst_perigst").val())) / 100)))*parseFloat($("#quantity").val())
$('#gst_perigst1lo').val(igst)

sum=0
  $('.amount_item').each(function(){
            sum += parseFloat(this.value);
        $('#totalamount').val(sum)
         
})
igst=0
  $('.gst_perigst').each(function(){
    igst += parseFloat(this.value);
        $('#totaligst').val(igst)
         
})
});
//Price Changing
$('#itemprice').on('change', function() {
//   alert(this.value)
  // var cid=this.value;
  totalamnt= (parseFloat($("#itemprice").val()) * ( (parseFloat($("#gst_per").val())+parseFloat($("#gst_persgst").val())+parseFloat($("#gst_perigst").val()) ) / 100))
  // $('#boutique_work_expense_amount2').val(parseInt($("#itemprice").val())+parseInt($("#gst_per").val()))    
  $('#amount_item').val((parseFloat($("#itemprice").val())+parseFloat(totalamnt))*parseFloat($("#quantity").val()))
  // alert(totalamnt)  
//   $('.amount_item').each(function(){
// sum=0
// sum+=Number($(this).val());
// $('#totalamount').val(sum)
// });
igst =((parseFloat($("#itemprice").val()) * ( (parseFloat($("#gst_perigst").val())) / 100)))*parseFloat($("#quantity").val())
$('#gst_perigst1lo').val(igst)

sgst =((parseFloat($("#itemprice").val()) * ( (parseFloat($("#gst_persgst").val())) / 100)))*parseFloat($("#quantity").val())
$('#gst_persgst1lo').val(sgst)

cgst =((parseFloat($("#itemprice").val()) * ( (parseFloat($("#gst_per").val())) / 100)))*parseFloat($("#quantity").val())
$('#gst_percgst').val(cgst)
sum=0
  $('.amount_item').each(function(){
            sum += parseFloat(this.value);
        $('#totalamount').val(sum)
         
})
cgst=0
  $('.gst_percgst').each(function(){
    cgst += parseFloat(this.value);
        $('#totalcgst').val(cgst)
         
})
sgst=0
  $('.gst_persgst1').each(function(){
    sgst += parseFloat(this.value);
        $('#totalsgst').val(sgst)
         
})
igst=0
  $('.gst_perigst').each(function(){
    igst += parseFloat(this.value);
        $('#totaligst').val(igst)
         
})
});

//Quantity
$('#quantity').on('change', function() {
  // alert(this.value)
  // var cid=this.value;
  totalamnt= (parseFloat($("#itemprice").val()) * ( (parseFloat($("#gst_per").val())+parseFloat($("#gst_persgst").val())+parseFloat($("#gst_perigst").val()) ) / 100))
  // $('#boutique_work_expense_amount2').val(parseInt($("#itemprice").val())+parseInt($("#gst_per").val()))    
  $('#amount_item').val((parseInt($("#itemprice").val())+parseInt(totalamnt))*parseInt($("#quantity").val()))
  // alert(totalamnt)  
//   $('.amount_item').each(function(){
// sum=0
// sum+=Number($(this).val());
// $('#totalamount').val(sum)
// });
igst =((parseFloat($("#itemprice").val()) * ( (parseFloat($("#gst_perigst").val())) / 100)))*parseFloat($("#quantity").val())
$('#gst_perigst1lo').val(igst)

sgst =((parseFloat($("#itemprice").val()) * ( (parseFloat($("#gst_persgst").val())) / 100)))*parseFloat($("#quantity").val())
$('#gst_persgst1lo').val(sgst)

cgst =((parseFloat($("#itemprice").val()) * ( (parseFloat($("#gst_per").val())) / 100)))*parseFloat($("#quantity").val())
$('#gst_percgst').val(cgst)
sum=0
  $('.amount_item').each(function(){
            sum += parseFloat(this.value);
        $('#totalamount').val(sum)
         
})
cgst=0
  $('.gst_percgst').each(function(){
    cgst += parseFloat(this.value);
        $('#totalcgst').val(cgst)
         
})
sgst=0
  $('.gst_persgst1').each(function(){
    sgst += parseFloat(this.value);
        $('#totalsgst').val(sgst)
         
})
igst=0
  $('.gst_perigst').each(function(){
    igst += parseFloat(this.value);
        $('#totaligst').val(igst)
         
})
// alert(igst)
});
// 




setInterval(function(){ 
//  total= ("#total").val()
//  expence = ("#expense").val()
  $('#totalgst').val(parseFloat($("#totaligst").val())+parseFloat($("#totalsgst").val())+parseFloat($("#totalcgst").val()))      
 
  }, 1000);

</script>
