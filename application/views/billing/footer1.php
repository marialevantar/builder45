<footer class="main-footer" id="hiderow">
  <div class="pull-right hidden-xs">
    <b>Version</b> 1
  </div>
  <strong>Copyright &copy; 2021 <a href="http://www.levantarsolutions.in/" target="_blank" style="color: #000; font-weight: bold;">LEVANTAR SOLUTIONS PRIVATE LIMITED</a>.</strong> All rights
  reserved.
</footer>
</div>
<!-- ./wrapper -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<!-- jQuery 3 -->
<script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>


<!-- jQuery 3 -->
<script src="<?php echo base_url(); ?>assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Select2 -->
<script src="<?php echo base_url(); ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>

<!-- Morris.js charts -->
<script src="<?php echo base_url(); ?>assets/bower_components/raphael/raphael.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url(); ?>assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>

<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url(); ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url(); ?>assets/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url(); ?>assets/bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<!-- FastClick -->
<script src="<?php echo base_url(); ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url(); ?>assets/dist/js/pages/dashboard.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>
<!-- page script -->
<script src="<?php echo base_url(); ?>assets/dist/js/bootstrap-datepicker.min.js"></script>

<script src="<?php echo base_url(); ?>assets/dist/js/bootstrapValidator.js"></script>

<script src="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script type="text/javascript">
    var mysessionvar = '<?php echo $this->session->userdata('BoutiqueID');?>';
    </script>
<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/sales_invoice.js'></script>

<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>

<script type="text/javascript">
 $('#datepicker').datepicker({
  autoclose: true,
  format: 'dd/mm/yyyy'
}).datepicker("setDate",'now');

$('#datepicker1').datepicker({
   autoclose: true,
   format: 'dd/mm/yyyy'
})
$('#datepicker2').datepicker({
   autoclose: true,
   format: 'dd/mm/yyyy'
})
 
$('.report_date').datepicker({
   autoclose: true,
   format: 'dd/mm/yyyy'
})
  $(function () {
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'responsive'  : true,
      'order': [] 
    });
    $('#customer_table').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      'responsive'  : true,
      'order': [] 
    });
    $('#latest_works').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      'responsive'  : true,
      'order': [] 
    });

    $('#reportsdata').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            { extend: 'csv',text: 'Save As CSV',filename: 'Reports'}, { extend: 'excel',text: 'Save As Excel',filename: 'Reports'},{ extend: 'pdf',text: 'Save As pdf',filename: 'Reports'},{ extend: 'print',text: 'Print',filename: 'Reports'}
        ]
    } );

     jQuery.fn.dataTable.Api.register( 'sumsale()', function () {
    return this.flatten().reduce( function ( a, b ) {
        return (a*1) + (b*1); // cast values in-case they are strings
    });
    });

    var tablesale = $("#reportsdata").DataTable();

    $("#reportsdata").on('search.dt', function() {
    //console.log(table.column( 2, {page:'current'} ).data().sum() );
    $('.total_expense').html(tablesale.column(3, {"filter": "applied"}).data().sumsale());
    });

     $('#exreportsdata').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            { extend: 'csv',text: 'Save As CSV',filename: 'Reports'}, { extend: 'excel',text: 'Save As Excel',filename: 'Reports'},{ extend: 'pdf',text: 'Save As pdf',filename: 'Reports'},{ extend: 'print',text: 'Print',filename: 'Reports'}
        ]
    } );
    
    jQuery.fn.dataTable.Api.register( 'sumex()', function () {
    return this.flatten().reduce( function ( a, b ) {
        return (a*1) + (b*1); // cast values in-case they are strings
    });
    });

    var tableexport = $("#exreportsdata").DataTable();

    $("#exreportsdata").on('search.dt', function() {
    //console.log(table.column( 2, {page:'current'} ).data().sum() );
    $('.total_expense').html(tableexport.column(2, {"filter": "applied"}).data().sumex());
    });
    
     var table = $("#saleslist").DataTable({'order': [] });

    $("#saleslist").on('search.dt', function() {

   
    $('.total_sale_c').css("display", "block");
     var total = table.column(3, {"filter": "applied"}).data().sumex();
    var paid = table.column(4, {"filter": "applied"}).data().sumex();
    $('.total_sale').html(total - paid);
    });
    
    
    
    $('#itemstock').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            { extend: 'csv',text: 'Save As CSV',filename: 'Reports',exportOptions: {
                columns: [0,1,2]
            }}, { extend: 'excel',text: 'Save As Excel',filename: 'Reports',exportOptions: {
                columns: [0,1,2]
            }},{ extend: 'pdf',text: 'Save As pdf',filename: 'Reports',exportOptions: {
                columns: [0,1,2]
            }},{ extend: 'print',text: 'Print',filename: 'Reports',exportOptions: {
                columns: [0,1,2]
            }}
        ]
    } );
    $('#balancesheet').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            { extend: 'csv',text: 'Save As CSV',filename: 'Reports',exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8,9]
            }}, { extend: 'excel',text: 'Save As Excel',filename: 'Reports',exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8,9]
            }},{ extend: 'pdf',text: 'Save As pdf',filename: 'Reports',exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8,9]
            }},{ extend: 'print',text: 'Print',filename: 'Reports',exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8,9]
            }}
        ],
        order: [],
columnDefs: [ { orderable: false, targets: [0]}]
    } );

    var tableexport = $("#balancesheet").DataTable();
    $("#balancesheet").on('search.dt', function() {
    //console.log(table.column( 2, {page:'current'} ).data().sum() );
    $('.total_sell').html(tableexport.column(1, {"filter": "applied"}).data().sumex());
    $('.total_expense').html(tableexport.column(4, {"filter": "applied"}).data().sumex());
    $('.total_sell').html(tableexport.column(1, {"filter": "applied"}).data().sumex());
    $('.total_expense').html(tableexport.column(4, {"filter": "applied"}).data().sumex());
    $('.net_profit').html(tableexport.column(1, {"filter": "applied"}).data().sumex() - tableexport.column(4, {"filter": "applied"}).data().sumex());
 
});

//     var tableexport = $("#balancesheet").DataTable();

// $("#balancesheet").on('search.dt', function() {
// //console.log(table.column( 2, {page:'current'} ).data().sum() );
// $('.total_sale').html(tableexport.column(4, {"filter": "applied"}).data().sumex());
// });

//  var table = $("#saleslist").DataTable({'order': [] });

// $("#saleslist").on('search.dt', function() {


// $('.total_sale_c').css("display", "block");
// //  var total = table.column(3, {"filter": "applied"}).data().sumex();
// var paid = table.column(4, {"filter": "applied"}).data().sumex();
// $('.total_sale').html(paid);
// });






    $('#datepicker1').on('changeDate show', function(e) {
        // Revalidate the date when user change it
        $('#workvali').bootstrapValidator('revalidateField', 'delivery_date');
    });
    
    
  });

  $('#addcustomer').bootstrapValidator({
//        live: 'disabled',
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'Customer name is required'
                    }
                }
            },
            phone: {
                message: 'Phone number is not valid',
                validators: {
                    stringLength: {
                        min: 9,
                        max: 11,
                        message: 'Phone number is not valid'
                    },
                    regexp: {
                        regexp: /^[0-9]*$/,
                        message: 'Only numbers are allowed'
                    }
                }
            }
        }
    });


$('#workvali').bootstrapValidator({
//        live: 'disabled',
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            workname: {
                validators: {
                    notEmpty: {
                        message: 'Work name is required'
                    }
                }
            },
            customerid: {
                validators: {
                    notEmpty: {
                        message: 'Customer is required'
                    }
                }
            },
            order_date: {
                validators: {
                    notEmpty: {
                        message: 'Order date is required'
                    }
                }
            },
            delivery_date: {
                validators: {
                    notEmpty: {
                        message: 'Delivery date is required'
                    }
                }
            },
             tailorid: {
                validators: {
                    notEmpty: {
                        message: 'Tailor  is required'
                    }
                }
            },
            clothimg: {
                validators: {
                    file: {
                        extension: 'jpeg,png,jpg',
                        type: 'image/jpeg,image/png,image/jpg',
                        maxSize: 2048 * 1024,
                        message: 'The selected file is not valid'
                    }
                }
            }
        }
    });

$('#workvaliedit').bootstrapValidator({
//        live: 'disabled',
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            workname: {
                validators: {
                    notEmpty: {
                        message: 'Work name is required'
                    }
                }
            },
            customerid: {
                validators: {
                    notEmpty: {
                        message: 'Customer is required'
                    }
                }
            },
            order_date: {
                validators: {
                    notEmpty: {
                        message: 'Order date is required'
                    }
                }
            },
            delivery_date: {
                validators: {
                    notEmpty: {
                        message: 'Delivery date is required'
                    }
                }
            },
             tailorid: {
                validators: {
                    notEmpty: {
                        message: 'Tailor  is required'
                    }
                }
            }
        }
    });

</script>

<script>
$('#cname').on('change', function() {
  //alert( this.value );
    var cid=this.value;
    if(cid == 0){
        $('#address').html('');
    }
    
    $.ajax({
    type: "POST",
    url: 'viewCustomer',
    dataType: 'json',
    data: {"cid":cid},
    success: function(data){

        var text= data.boutique_customer_name+'\n'+data.boutique_customer_address+'\nPhone : '+data.boutique_customer_ph;
        $('#address').html(text);
       // alert(text);
    }
});
    });

$('#boutique_sale_amountpaid').on('change', function() {
    if($('#totaltext').val() > 0 && $('#boutique_sale_amountpaid').val()){
        var balance = $('#totaltext').val() - $('#boutique_sale_amountpaid').val();
        if(balance > 0){
            $('#boutique_sale_balanceamount').val(balance);
            $('#boutique_sale_balanceamount_value').val(balance);
        }
        else
        {
            $('#boutique_sale_balanceamount').val(0);
            $('#boutique_sale_balanceamount_value').val(0);
        }
    }
});

function selectbilltype(billtype,sale_id,billformat){
    if(billtype != 0 && billformat == 1){
        window.open("<?php echo base_url(); ?>billing/bill/"+sale_id+"/"+billtype+"/");
    }
    else if(billtype != 0 && billformat == 2){
        window.open("<?php echo base_url(); ?>billing/gstbill/"+sale_id+"/"+billtype+"/")
    }
}
</script>

<script>
$(function() {
    $("#skill_input").autocomplete({
        source: "viewCustomers/",
    });
});
</script>

<script>
$(document).ready(function(){
    $("#sku").keyup(function(){
        $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>billing/getitemssearch/",
        data:'keyword='+$(this).val(),
        beforeSend: function(){
            $("#sku").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
        },
        success: function(data){
            $("#suggesstion-box").show();
            $("#suggesstion-box").html(data);
            $("#sku").css("background","#FFF");
        }
        });
    });
});

function selectCountry(val) {
$("#sku").val(val);
$("#suggesstion-box").hide();
$("#addrow").click();
}

//Initialize Select2 Elements
$('.select2').select2();
// below code are used for exclusive amount(item add page) calculation
<?php  if($this->session->userdata('BoutiqueID') == 61) {?>
$("#boutique_item_unit_price").change(function(){
        var keepUnitPrice=$("#boutique_item_unit_price").val();
        sessionStorage.setItem("unitprice", keepUnitPrice);
    });
$(document).ready(function(){
 
    $("#boutique_tax_id").change(function(){
        var selected = $(this).find('option:selected');
       var tax_rate = selected.data('taxrate'); 
     if(tax_rate !='')
     {
         if($("#boutique_item_unit_price").val() !='')
         {
             var exclusiveTax=sessionStorage.getItem("unitprice")-((sessionStorage.getItem("unitprice")-(sessionStorage.getItem("unitprice")*(100/(100+tax_rate)))));
             $("#boutique_item_unit_price").val(Math.round(exclusiveTax));
         }
       
     }
     else
     {  
        if($("#boutique_item_unit_price").val() !='')
         {
             $("#boutique_item_unit_price").val(sessionStorage.getItem("unitprice"));
         }
     }
    });
});
// funtion will hide qty remining based on parent selection
$("#boutique_parent_id").change(function(){
        if($("#boutique_parent_id").val() !='')
        {
                    $("#item_qty_rm").hide();
        }else
        {
            $("#item_qty_rm").show();
        }
        
    });

<?php }?>
</script>
<script>
  $(function () {
  $('#ship-address').tooltip();
})
</script>
</body>
</html>
