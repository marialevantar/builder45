<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 1
  </div>
  <strong>Copyright &copy; <?php echo date('Y');?> <a href="http://www.levantarsolutions.in/" target="_blank" style="color: #000; font-weight: bold;">LEVANTAR SOLUTIONS PRIVATE LIMITED</a>.</strong> All rights
  reserved.
</footer>
</div>
<!-- ./wrapper -->
<!-- jQuery 3 -->
<script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>


<!-- jQuery 3 -->
<script src="<?php echo base_url(); ?>assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
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

<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/tagsly.js"></script>
<script>
    $('#addresstag').tagsly();
</script>

<script>
// boutique_user_role
$('#boutique_user_role').on('change', function() {
    if($(this).val() == 4)
    {
        $("#image_upload_user").show();
    }
    else
    {
        $("#image_upload_user").hide();
    }
});

$('#customerid').on('change', function() {
  //alert( this.value );
    var cid=this.value;
    console.log(cid);
    if(cid == 0){
        $('#address').html('');
    }
    
    $.ajax({
    type: "POST",
    url: 'viewCustomer',
    dataType: 'json',
    data: {"cid":cid},
    
    
   
    success: function(data){
        var price= data.customer.tenants_room_rent;
        $('#price').val(price)
  //     alert(price);
    }
    
});
    });


</script>
<script type="text/javascript">
// $("#monthly_date").show(); leave_type
$("#leave_type").change(function(){
    if($(this).val() == 1)
    {
        $("#type_time").hide();
    }  
    else
    {
        $("#type_time").show();
    }
});
// $( "#datepicker_attandance" ).datepicker({
//   autoclose: true,
//   format: 'dd-mm-yyyy'
// }).datepicker("setDate",'now');
  
function goBack() {
  window.history.back();
}

let days="<?php echo $this->uri->segment(4); ?>";
    if(days !=='')
    {

    $( "#datepicker_site" ).datepicker({
  autoclose: true,
  format: 'dd-mm-yyyy'
}).datepicker("setDate",days);
    
    }
    else{
      $('#datepicker_site').datepicker({
          
  autoclose: true,
  format: 'dd-mm-yyyy'
}).datepicker("setDate",'now');

    }

 $('#datepicker').datepicker({
  autoclose: true,
  format: 'dd/mm/yyyy'
}).datepicker("setDate",'now');

$('.datepickercl').datepicker({
   autoclose: true,
   format: 'dd-mm-yyyy'
});

$('#datepicker1').datepicker({
   autoclose: true,
   format: 'dd/mm/yyyy'
})
$('#datepicker2').datepicker({
   autoclose: true,
   format: 'dd/mm/yyyy'
})
$('#datepicker3').datepicker({
   autoclose: true,
   format: 'dd/mm/yyyy'
})
$('#datepicker4').datepicker({
   autoclose: true,
   format: 'dd/mm/yyyy'
})

$('#boutique_trail_date').datepicker({
   autoclose: true,
   format: 'dd/mm/yyyy'
})
$('.report_date').datepicker({
   autoclose: true,
   format: 'dd/mm/yyyy'
})

 $('#example3').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      'responsive'  : true,
      'order': [] 
    });
    $('#fulllist').DataTable( {
    'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'responsive'  : true,
      
    // 'responsive'  : false,
    dom: 'Bfrtip',
        buttons: [
            { extend: 'csv',text: 'Save As CSV',filename: 'Reports'}, { extend: 'excel',text: 'Save As Excel',filename: 'Reports'},{ extend: 'pdf',text: 'Save As pdf',filename: 'Reports'},{ extend: 'print',text: 'Print',filename: 'Reports'}
        ]
    } );  
    $('#fulllisttransfer').DataTable( {
        'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'responsive'  : true,  
    'responsive'  : false,
    dom: 'Bfrtip',
        buttons: [
            { extend: 'csv',text: 'Save As CSV',filename: 'Reports'}, { extend: 'excel',text: 'Save As Excel',filename: 'Reports'},{ extend: 'pdf',text: 'Save As pdf',filename: 'Reports'},{ extend: 'print',text: 'Print',filename: 'Reports'}
        ]
    } ); 
    //
    
    $('#fullliststatus').DataTable( {
        'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'responsive'  : true,  
    'responsive'  : false,
    dom: 'Bfrtip',
        buttons: [
            { extend: 'csv',text: 'Save As CSV',filename: 'Reports'}, { extend: 'excel',text: 'Save As Excel',filename: 'Reports'},{ extend: 'pdf',text: 'Save As pdf',filename: 'Reports'},{ extend: 'print',text: 'Print',filename: 'Reports'}
        ]
    } );
    $('#fulllistschedule').DataTable( {
        'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'responsive'  : true,  
    'responsive'  : false,
    dom: 'Bfrtip',
        buttons: [
            { extend: 'csv',text: 'Save As CSV',filename: 'Reports'}, { extend: 'excel',text: 'Save As Excel',filename: 'Reports'},{ extend: 'pdf',text: 'Save As pdf',filename: 'Reports'},{ extend: 'print',text: 'Print',filename: 'Reports'}
        ]
    } );  
    $('#fulllistdays').DataTable( {
        'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'responsive'  : true,  
    'responsive'  : false,
    dom: 'Bfrtip',
        buttons: [
            { extend: 'csv',text: 'Save As CSV',filename: 'Reports'}, { extend: 'excel',text: 'Save As Excel',filename: 'Reports'},{ extend: 'pdf',text: 'Save As pdf',filename: 'Reports'},{ extend: 'print',text: 'Print',filename: 'Reports'}
        ]
    } ); 
 $('#exreportsdata').DataTable( {
    // 'ordering'    : false,
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
    var sessionid=<?php echo $this->session->userdata('UserID');?>;
    if(sessionid!=136){
    $('.total_expense').html(tableexport.column(4, {"filter": "applied"}).data().sumex());
    }else{
    $('.total_expense').html(tableexport.column(5, {"filter": "applied"}).data().sumex());
    }
    });

    $('#property').on( 'keyup', function () {
        tableexport
        .columns( 2 )
        .search( this.value )
        .draw();
} );




  $(function () {
    $('#workDataTable').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      'responsive'  : true,
      'stateSave'   : true,
      "stateSaveParams": function (oSettings, oData) {
          oData.search.search = "";
        },
      "bStateSave": true,
      "fnStateSave": function (oSettings, oData) {
            localStorage.setItem( 'DataTables', JSON.stringify(oData) );
        },
        "fnStateLoad": function (oSettings) {
            return JSON.parse( localStorage.getItem('DataTables') );
        },
      //"ajax": "data/arrays.txt",
      "deferRender" : true,
      'order': [],
      'dom' : 'Bfrtip',
      'buttons': [
            { extend: 'csv',text: 'Save As CSV',filename: 'Reports',exportOptions: {
                columns: [0,1,2]
            }}, { extend: 'excel',text: 'Save As Excel',filename: 'Reports',exportOptions: {
                columns: [0,1,2]
            }},{ extend: 'print',text: 'Print',filename: 'Reports',exportOptions: {
                columns: [0,1,2]
            }}
        ]
    });
    $('#workDataTable2').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      'responsive'  : true,
      'stateSave'   : true,
      "stateSaveParams": function (oSettings, oData) {
          oData.search.search = "";
        },
      "bStateSave": true,
      "fnStateSave": function (oSettings, oData) {
            localStorage.setItem( 'DataTables', JSON.stringify(oData) );
        },
        "fnStateLoad": function (oSettings) {
            return JSON.parse( localStorage.getItem('DataTables') );
        },
      //"ajax": "data/arrays.txt",
      "deferRender" : true,
      'order': [],
      'dom' : 'Bfrtip',
      'buttons': [
            { extend: 'csv',text: 'Save As CSV',filename: 'Reports',exportOptions: {
                columns: [0,1,2]
            }}, { extend: 'excel',text: 'Save As Excel',filename: 'Reports',exportOptions: {
                columns: [0,1,2]
            }},{ extend: 'print',text: 'Print',filename: 'Reports',exportOptions: {
                columns: [0,1,2]
            }}
        ]
    });
    $('#customerdetailsTable').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      'responsive'  : true,
      'stateSave'   : true,
      "stateSaveParams": function (oSettings, oData) {
          oData.search.search = "";
        },
      "bStateSave": true,
      "fnStateSave": function (oSettings, oData) {
            localStorage.setItem( 'DataTables', JSON.stringify(oData) );
        },
        "fnStateLoad": function (oSettings) {
            return JSON.parse( localStorage.getItem('DataTables') );
        },
      //"ajax": "data/arrays.txt",
      "deferRender" : true,
      'order': [],
      'dom' : 'Bfrtip',
      'buttons': [
            { extend: 'csv',text: 'Save As CSV',filename: 'Reports',exportOptions: {
                columns: [0,1,2,3]
            }}, { extend: 'excel',text: 'Save As Excel',filename: 'Reports',exportOptions: {
                columns: [0,1,2,3]
            }},{ extend: 'print',text: 'Print',filename: 'Reports',exportOptions: {
                columns: [0,1,2,3]
            }}
        ]
    });
    $('#customerdetailsTable-history').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      'responsive'  : true,
      'stateSave'   : true,
      "stateSaveParams": function (oSettings, oData) {
          oData.search.search = "";
        },
      "bStateSave": true,
      "fnStateSave": function (oSettings, oData) {
            localStorage.setItem( 'DataTables', JSON.stringify(oData) );
        },
        "fnStateLoad": function (oSettings) {
            return JSON.parse( localStorage.getItem('DataTables') );
        },
      //"ajax": "data/arrays.txt",
      "deferRender" : true,
      'order': [],
      'dom' : 'Bfrtip',
      'buttons': [
            { extend: 'csv',text: 'Save As CSV',filename: 'Reports',exportOptions: {
                columns: [0,1,2,3]
            }}, { extend: 'excel',text: 'Save As Excel',filename: 'Reports',exportOptions: {
                columns: [0,1,2,3]
            }},{ extend: 'print',text: 'Print',filename: 'Reports',exportOptions: {
                columns: [0,1,2,3]
            }}
        ]
    });
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      'responsive'  : true,
      'stateSave'   : true,
      "stateSaveParams": function (oSettings, oData) {
          oData.search.search = "";
        },
      "bStateSave": true,
      "fnStateSave": function (oSettings, oData) {
            localStorage.setItem( 'DataTables', JSON.stringify(oData) );
        },
        "fnStateLoad": function (oSettings) {
            return JSON.parse( localStorage.getItem('DataTables') );
        },
      //"ajax": "data/arrays.txt",
      "deferRender" : true,
      'order': [],
      'dom' : 'Bfrtip',
      'buttons': [
            { extend: 'csv',text: 'Save As CSV',filename: 'Reports',exportOptions: {
                columns: [0,1,2,3,4,5,6,7]
            }}, { extend: 'excel',text: 'Save As Excel',filename: 'Reports',exportOptions: {
                columns: [0,1,2,3,4,5,6,7]
            }},{ extend: 'print',text: 'Print',filename: 'Reports',exportOptions: {
                columns: [0,1,2,3,4,5,6,7]
            }}
        ]
    });

    jQuery.fn.dataTable.Api.register( 'sumsale()', function () {
    return this.flatten().reduce( function ( a, b ) {
        return (a*1) + (b*1); // cast values in-case they are strings
    });
    });

    var tablesale = $("#example2").DataTable();
    var sessionid=<?php echo $this->session->userdata('UserID');?>;
    if(sessionid==136){
    $('.grand_total_c').html((tablesale.column(4, {"filter": "applied"}).data().sumsale()).toFixed(2));
    $('.amount_paid_c').html(tablesale.column(5, {"filter": "applied"}).data().sumsale());
    $('.bal_pay_c').html((tablesale.column(6, {"filter": "applied"}).data().sumsale()).toFixed(2));

    $("#example2").on('search.dt', function() {
    //console.log(table.column( 2, {page:'current'} ).data().sum() );
    $('.grand_total_c').html((tablesale.column(4, {"filter": "applied"}).data().sumsale()).toFixed(2));
    $('.amount_paid_c').html(tablesale.column(5, {"filter": "applied"}).data().sumsale());
    $('.bal_pay_c').html((tablesale.column(6, {"filter": "applied"}).data().sumsale()).toFixed(2));

    });    
        
    }
    else{
    $('.grand_total_c').html(tablesale.column(3, {"filter": "applied"}).data().sumsale());
    $('.amount_paid_c').html(tablesale.column(4, {"filter": "applied"}).data().sumsale());
    $('.bal_pay_c').html(tablesale.column(5, {"filter": "applied"}).data().sumsale());

    $("#example2").on('search.dt', function() {
    //console.log(table.column( 2, {page:'current'} ).data().sum() );
    $('.grand_total_c').html(tablesale.column(3, {"filter": "applied"}).data().sumsale());
    $('.amount_paid_c').html(tablesale.column(4, {"filter": "applied"}).data().sumsale());
    $('.bal_pay_c').html(tablesale.column(5, {"filter": "applied"}).data().sumsale());

    });
}

    $('#customer_table').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      'responsive'  : true
    });
    $('#latest_works').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      'responsive'  : true
    });
    
    $('#datepicker1').on('changeDate show', function(e) {
        // Revalidate the date when user change it
        $('#workvali').bootstrapValidator('revalidateField', 'delivery_date');
    });
    
    $("#clear_order_form").click(function () {
      //$("#order_filter_form")[0].reset();
      $('.datepickercl').val('');
      table = $('#orders_boutique').DataTable();
      $('form').each(function() { this.reset() });
      $('input[type=text]').val('');
      table.state.clear();
      //window.location.reload();
      window.location.href = "<?php echo base_url();?>boutique/orders";
      
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
                        maxSize: 6000 * 4000,
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

$("#phone_validate").change(function(){
  $.ajax({
        url:"<?php echo base_url(); ?>boutique/phonevalidate",
        method:"POST",
        data:'phone_validate = '+$('#phone_validate').val(),
        success:function(response) {
          var userobj = jQuery.parseJSON(response);
          if(userobj.status != 'success'){
              $('#errorPhMsg').html('This Phone Number Already Registered');
          }
          else{
              $('#errorPhMsg').html('');
          }
       },
       error:function(){
        alert("error");
       }

      });
});


//-------------------------------------------- add work fulki ---------------------------------------

$("#boutique_tailor_id").change(function(){

  $.ajax({
        url:"<?php echo base_url(); ?>boutique/getStaffHourlyRate",
        method:"POST",
        data:'boutique_tailor_id= '+$("#boutique_tailor_id").val(),
        success:function(response) {
          var userobj = jQuery.parseJSON(response);
          if(userobj.status == 'success'){
              
              var hourlyRate = userobj.data;
              $('.tailor_staff_hourly_rate').val(hourlyRate);
              if($("#tailor_staff_hours").val()){
                  $('.tailor_staff_amount').val(hourlyRate*$("#tailor_staff_hours").val());
              }
              staffAmountSum();
          }
          else{
              return "";
          }
       },
       error:function(){
        alert("error");
       }

      });

});

$("#tailor_staff_hours").change(function(){
  $('.tailor_staff_amount').val($('.tailor_staff_hourly_rate').val() * $("#tailor_staff_hours").val());
  staffAmountSum();
});


$("#boutique_tailor_id_d").change(function(){

  $.ajax({
        url:"<?php echo base_url(); ?>boutique/getStaffHourlyRate",
        method:"POST",
        data:'boutique_tailor_id= '+$("#boutique_tailor_id_d").val(),
        success:function(response) {
          var userobj = jQuery.parseJSON(response);
          if(userobj.status == 'success'){
              
              var hourlyRate = userobj.data;
              $('.boutique_work_staff_hourly_rate_d').val(hourlyRate);
              if($("#boutique_work_staff_hours_d").val()){
                  $('.boutique_work_staff_amount_d').val(hourlyRate*$("#boutique_work_staff_hours_d").val());
              }
              staffAmountSum();

          }
          else{
              return "";
          }
       },
       error:function(){
        alert("error");
       }

      });

});

$("#boutique_work_staff_hours_d").change(function(){
  $('.boutique_work_staff_amount_d').val($('.boutique_work_staff_hourly_rate_d').val() * $("#boutique_work_staff_hours_d").val());
  staffAmountSum();
});




$("#boutique_tailor_id_h").change(function(){

  $.ajax({
        url:"<?php echo base_url(); ?>boutique/getStaffHourlyRate",
        method:"POST",
        data:'boutique_tailor_id= '+$("#boutique_tailor_id_h").val(),
        success:function(response) {
          var userobj = jQuery.parseJSON(response);
          if(userobj.status == 'success'){
              
              var hourlyRate = userobj.data;
              $('.boutique_work_staff_hourly_rate_h').val(hourlyRate);
              if($("#boutique_work_staff_hours_h").val()){
                  $('.boutique_work_staff_amount_h').val(hourlyRate*$("#boutique_work_staff_hours_h").val());
              }
              staffAmountSum();

          }
          else{
              return "";
          }
       },
       error:function(){
        alert("error");
       }

      });

});

$("#boutique_work_staff_hours_h").change(function(){
  $('.boutique_work_staff_amount_h').val($('.boutique_work_staff_hourly_rate_h').val() * $("#boutique_work_staff_hours_h").val());
  staffAmountSum();
});


$("#boutique_tailor_id_m").change(function(){

  $.ajax({
        url:"<?php echo base_url(); ?>boutique/getStaffHourlyRate",
        method:"POST",
        data:'boutique_tailor_id= '+$("#boutique_tailor_id_m").val(),
        success:function(response) {
          var userobj = jQuery.parseJSON(response);
          if(userobj.status == 'success'){
              
              var hourlyRate = userobj.data;
              $('.boutique_work_staff_hourly_rate_m').val(hourlyRate);
              if($("#boutique_work_staff_hours_m").val()){
                  $('.boutique_work_staff_amount_m').val(hourlyRate*$("#boutique_work_staff_hours_m").val());
              }
              staffAmountSum();

          }
          else{
              return "";
          }
       },
       error:function(){
        alert("error");
       }

      });

});

$("#boutique_work_staff_hours_m").change(function(){
  $('.boutique_work_staff_amount_m').val($('.boutique_work_staff_hourly_rate_m').val() * $("#boutique_work_staff_hours_m").val());
  staffAmountSum();
});

$("#boutique_tailor_id_f").change(function(){

  $.ajax({
        url:"<?php echo base_url(); ?>boutique/getStaffHourlyRate",
        method:"POST",
        data:'boutique_tailor_id= '+$("#boutique_tailor_id_f").val(),
        success:function(response) {
          var userobj = jQuery.parseJSON(response);
          if(userobj.status == 'success'){
              
              var hourlyRate = userobj.data;
              $('.boutique_work_staff_hourly_rate_f').val(hourlyRate);
              if($("#boutique_work_staff_hours_f").val()){
                  $('.boutique_work_staff_amount_f').val(hourlyRate*$("#boutique_work_staff_hours_f").val());
              }
              staffAmountSum();

          }
          else{
              return "";
          }
       },
       error:function(){
        alert("error");
       }

      });

});

$("#boutique_work_staff_hours_f").change(function(){
  $('.boutique_work_staff_amount_f').val($('.boutique_work_staff_hourly_rate_f').val() * $("#boutique_work_staff_hours_f").val());

  staffAmountSum();

});



function staffAmountSum(){

    var staffAmountSum = Number($('.boutique_work_staff_amount_d').val())+Number($('.boutique_work_staff_amount_h').val()) + Number($('.boutique_work_staff_amount_m').val()) + Number($('.boutique_work_staff_amount_f').val()) + Number($('.tailor_staff_amount').val());

    $('.boutique_work_staff_amount').val(staffAmountSum);
    $('.boutique_work_expense_amount').val(Number($('.boutique_work_staff_amount').val()) + Number($('.boutique_work_purchase_amount').val()));
}

// ------------------------------------- purchase order work fulki studio ----------------

$("#add_purchase").click(function(){

$(".purchase_orders:last").after('<div class="purchase_orders"><div class="col-md-3"><div class="form-group"><input type="text" class="form-control" name="boutique_work_purchase_item_name[]" value=""></div></div><div class="col-md-3"><div class="form-group"><textarea class="form-control" rows="1" name="boutique_work_purchase_item_desc[]"></textarea></div></div><div class="col-md-3"><div class="form-group"><input name="boutique_work_purchase_item_image[]" type="file" class="form-control" value=""></div></div><div class="col-md-2"><div class="form-group"><input name="boutique_work_purchase_item_unitprice[]" type="text" class="form-control boutique_work_purchase_item_unitprice" value="" onchange="update_purchase_amount(this.value)"></div></div> <div class="col-md-1"><div class="form-group"><a class="delete_purchase" href="javascript:void(0);" title="Remove row">X</a></div></div></div>');
        
});


$(document).on("click", "a.delete_purchase" , function() {

    $(this).parents('.purchase_orders').remove();

    var sum = 0;
    // iterate through each td based on class and add the values
    $(".boutique_work_purchase_item_unitprice").each(function() {

        var value = $(this).val();
        // add only if the value is number
        if(!isNaN(value) && value.length != 0) {
            sum += Number(value);
        }
    });

    $('.boutique_work_purchase_amount').val(sum);

    $('.boutique_work_expense_amount').val(Number($('.boutique_work_purchase_amount').val()) + Number($('.boutique_work_staff_amount').val()));
    //update_total();
    //if ($(".delete").length < 2) $(".delete").hide();
});

function update_purchase_amount(amount) {

  var sum = 0;
    // iterate through each td based on class and add the values
    $(".boutique_work_purchase_item_unitprice").each(function() {

        var value = $(this).val();
        // add only if the value is number
        if(!isNaN(value) && value.length != 0) {
            sum += Number(value);
        }
    });

  $('.boutique_work_purchase_amount').val(sum);

    $('.boutique_work_expense_amount').val(Number($('.boutique_work_purchase_amount').val()) + Number($('.boutique_work_staff_amount').val()));

}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#clothimgprev').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#clothimg").change(function(){
    $("#clothimgprev").css("display", "block");
    readURL(this);
});
$("#customerid").change(function(){
    var c_id=$("#customerid").val();
    var chtml="<label><input type='radio' name='measurement_type' value='1' checked>Measurements - <a href='<?php echo base_url(); ?>boutique/measurements/"+c_id+"/1' target='_blank'>Add measurement</a></label>";
    $("#cmeasurements").html(chtml);
});
var c_id=$("#customerid").val();
    var chtml="<label><input type='radio' name='measurement_type' value='1' checked>Measurements - <a href='<?php echo base_url(); ?>boutique/measurements/"+c_id+"/1' target='_blank'>Add measurement</a></label>";
    $("#cmeasurements").html(chtml);
</script>
<!-- for add customer page start -->
<script>
    
$('#monthly_date_pick').datepicker({
   autoclose: true,
   format: 'dd/mm/yyyy'
})
$("#monthly_date").hide();
$('input:radio[name="rent_type"]').change(
    function(){
        if (this.checked && this.value == 'monthly') {
            $("#monthly_date").show();
        }else if(this.checked && this.value == 'daily')
        {
            $("#monthly_date").hide();
        }
    });
    $(document).ready(function () {
	var fileTypes = ['jpg', 'jpeg', 'png'];  //acceptable file types
	$("input:file").change(function (evt) {
	    var parentEl = $(this).parent();
	    var tgt = evt.target || window.event.srcElement,
	                    files = tgt.files;

	    // FileReader support
	    if (FileReader && files && files.length) {
	        var fr = new FileReader();
	        var extension = files[0].name.split('.').pop().toLowerCase(); 
	        fr.onload = function (e) {
	        	success = fileTypes.indexOf(extension) > -1;
	        	if(success)
		        	$(parentEl).append('<img height='80' width='80' src="' + fr.result + '" class="preview"/>');
	        }
	        fr.onloadend = function(e){
	            console.debug("Load End");
	        }
	        fr.readAsDataURL(files[0]);
	    }   
	});
});

</script>
<?php if(@$customer['boutique_monthly_or_daily']=="monthly"){ ?>
    <script>
          $("#monthly_date").show();
    </script>
<?php } ?>
<!-- end add cutomer -->
</body>
</html>
