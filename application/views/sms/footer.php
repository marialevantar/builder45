<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 3
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
 
$('#datepicker4').datepicker({
   autoclose: true,
   format: 'dd/mm/yyyy'
})

$('.report_date').datepicker({
   autoclose: true,
   format: 'dd/mm/yyyy'
})

$('#boutique_trail_date').datepicker({
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
      'autoWidth'   : false,
      'responsive'  : true
    });
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
    
    $('#orders_boutique').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      'responsive'  : true,
      'order': [] 
    });

    $('#sendsms').DataTable({
      'paging'      : true,
      'pageLength'  : 50,
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

    $('#select_type').change(function() {
      var tid = $('option:selected', $(this)).val();
      if(tid == 1){
          
        $('#sendsms').DataTable().rows().every(function (rowIdx, tableLoop, rowLoop) {
            var data = this.node();
            $(data).find('input').prop('checked', true );
        });

      }
      else{
        
        $('#sendsms').DataTable().rows().every(function (rowIdx, tableLoop, rowLoop) {
            var data = this.node();
            $(data).find('input').prop('checked', false );
        });
        
      }

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
        url:"<?php echo base_url(); ?>messages/phonevalidate",
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

</script>

</body>
</html>
