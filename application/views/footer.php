<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 3
  </div>
  <strong>Copyright &copy; <?php echo date('Y');?> <a href="#">LEVANTAR SOLUTIONS PRIVATE LIMITED</a>.</strong> All rights
  reserved.
</footer>
</div>
<!-- ./wrapper -->
<!-- jQuery 3 -->
<script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url(); ?>assets/bower_components/jquery-ui/jquery-ui.min.js"></script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
$.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="<?php echo base_url(); ?>assets/bower_components/raphael/raphael.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url(); ?>assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
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
<!-- Slimscroll -->
<script src="<?php echo base_url(); ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url(); ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url(); ?>assets/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>

<script src="<?php echo base_url(); ?>assets/dist/js/bootstrapValidator.js"></script>

<script src="<?php echo base_url(); ?>assets/dist/js/upload.js"></script>


<script>

$('#confirm-delete').on('show.bs.modal', function(e) {
  $(this).find('.btn-ok').attr('href', '<?php echo base_url(); ?>admin/deleteboutique/'+$(e.relatedTarget).data('href'));
});

$(document).ready(function() {
  $("#loading_gif").hide();
  
  $("#addteam").submit(function () {
      $(".submit").attr("disabled", true);
      $("#loading_gif").show();
      return true;
  });
  $("#addimage").submit(function () {
      $(".submit").attr("disabled", true);
      $("#loading_gif").show();
      return true;
  });

    $('#addBoutique').bootstrapValidator({
//        live: 'disabled',
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            boutiqueName: {
                validators: {
                    notEmpty: {
                        message: 'Boutique name is required'
                    }
                }
            },
            contactName: {
                validators: {
                    notEmpty: {
                        message: 'Contact Name is required'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Email name is required'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
            phone: {
                message: 'Phone number is not valid',
                validators: {
                    notEmpty: {
                        message: 'Phone number is required and cannot be empty'
                    },
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
            },
            tagline: {
                validators: {
                    notEmpty: {
                        message: 'Tagline is required'
                    }
                }
            },
            description: {
                validators: {
                    notEmpty: {
                        message: 'Description is required'
                    }
                }
            },
            city: {
                validators: {
                    notEmpty: {
                        message: 'City name is required'
                    }
                }
            },
            state: {
                validators: {
                    notEmpty: {
                        message: 'State is required'
                    }
                }
            },
            address: {
                validators: {
                    notEmpty: {
                        message: 'Address is required'
                    }
                }
            },
            logoimg: {
                validators: {
                    notEmpty: {
                        message: 'Logo Img is required'
                    }
                }
            },
            bgimg: {
                validators: {
                    notEmpty: {
                        message: 'Bg Img is required'
                    }
                }
            },
            adminusername: {
                validators: {
                    notEmpty: {
                        message: 'Admin Username is required'
                    }
                }
            },
            adminpassword: {
                validators: {
                    notEmpty: {
                        message: 'The password is required'
                    },
                    identical: {
                        field: 'adminconfirmpassword',
                        message: 'Passwords are not matching'
                    },
                    stringLength: {
                        min: 5,
                        max: 10,
                        message: 'Password length should be between 5 and 10'
                    }
                }
            },
            adminconfirmpassword: {
                validators: {
                    notEmpty: {
                        message: 'The confirm password is required'
                    },
                    identical: {
                        field: 'adminpassword',
                        message: 'Passwords are not matching'
                    },
                    stringLength: {
                        min: 5,
                        max: 10,
                        message: 'Password length should be between 5 and 10'
                    }
                }
            },
            tailorusername: {
                validators: {
                    notEmpty: {
                        message: 'Tailor Username is required'
                    }
                }
            },
            tailorpassword: {
                validators: {
                    notEmpty: {
                        message: 'The Tailor password is required'
                    },
                    identical: {
                        field: 'tailorconfirmpassword',
                        message: 'Passwords are not matching'
                    },
                    stringLength: {
                        min: 5,
                        max: 10,
                        message: 'Password length should be between 5 and 10'
                    }
                }
            },
            tailorconfirmpassword: {
                validators: {
                    notEmpty: {
                        message: 'The confirm password is required'
                    },
                    identical: {
                        field: 'tailorpassword',
                        message: 'Passwords are not matching'
                    },
                    stringLength: {
                        min: 5,
                        max: 10,
                        message: 'Password length should be between 5 and 10'
                    }
                }
            }
        }
    });



    $('#updateBoutique').bootstrapValidator({
//        live: 'disabled',
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            boutiqueName: {
                validators: {
                    notEmpty: {
                        message: 'Boutique name is required'
                    }
                }
            },
            contactName: {
                validators: {
                    notEmpty: {
                        message: 'Contact Name is required'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Email name is required'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
            phone: {
                message: 'Phone number is not valid',
                validators: {
                    notEmpty: {
                        message: 'Phone number is required and cannot be empty'
                    },
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
            },
            tagline: {
                validators: {
                    notEmpty: {
                        message: 'Tagline is required'
                    }
                }
            },
            description: {
                validators: {
                    notEmpty: {
                        message: 'Description is required'
                    }
                }
            },
            city: {
                validators: {
                    notEmpty: {
                        message: 'City name is required'
                    }
                }
            },
            state: {
                validators: {
                    notEmpty: {
                        message: 'State is required'
                    }
                }
            },
            address: {
                validators: {
                    notEmpty: {
                        message: 'Address is required'
                    }
                }
            },
            logoimg: {
                validators: {
                    notEmpty: {
                        message: 'Logo Img is required'
                    }
                }
            },
            bgimg: {
                validators: {
                    notEmpty: {
                        message: 'Bg Img is required'
                    }
                }
            }
            
            
            
        }
    });

        $('#updateteam').bootstrapValidator({
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
                            message: 'Contact name is required'
                        }
                    }
                },
                teamName: {
                    validators: {
                        notEmpty: {
                            message: 'Team name is required'
                        }
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: 'Email name is required'
                        },
                        emailAddress: {
                            message: 'The input is not a valid email address'
                        }
                    }
                },
                phone: {
                    message: 'Phone number is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Phone number is required and cannot be empty'
                        },
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
                },
                age_cat: {
                    validators: {
                        notEmpty: {
                            message: 'Please select an age category'
                        }
                    }
                },
                coachName: {
                    validators: {
                        notEmpty: {
                            message: 'Coach name is required'
                        }
                    }
                },
                city: {
                    validators: {
                        notEmpty: {
                            message: 'City name is required'
                        }
                    }
                },
                level: {
                    validators: {
                        notEmpty: {
                            message: 'Level is required'
                        }
                    }
                },
                summary: {
                    validators: {
                        notEmpty: {
                            message: 'Description is required'
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: 'The password is required'
                        },
                        identical: {
                            field: 'c_password',
                            message: 'Passwords are not matching'
                        },
                        stringLength: {
                            min: 5,
                            max: 10,
                            message: 'Password length should be between 5 and 10'
                        }
                    }
                },
                c_password: {
                    validators: {
                        notEmpty: {
                            message: 'The confirm password is required'
                        },
                        identical: {
                            field: 'password',
                            message: 'Passwords are not matching'
                        },
                        stringLength: {
                            min: 5,
                            max: 10,
                            message: 'Password length should be between 5 and 10'
                        }
                    }
                }
            }
        });

  // $('#pwdupdate').bootstrapValidator({
  //   message: 'This value is not valid',
  //   feedbackIcons: {
  //       valid: 'glyphicon glyphicon-ok',
  //       invalid: 'glyphicon glyphicon-remove',
  //       validating: 'glyphicon glyphicon-refresh'
  //   },
  //   fields: {
  //       password: {
  //           validators: {
  //               notEmpty: {
  //                   message: 'The password is required'
  //               },
  //               identical: {
  //                   field: 'confirmpassword',
  //                   message: 'Passwords are not matching'
  //               },
  //               stringLength: {
  //                   min: 5,
  //                   max: 10,
  //                   message: 'Password length should be between 5 and 10'
  //               }
  //           }
  //       },
  //       confirmpassword: {
  //           validators: {
  //               notEmpty: {
  //                   message: 'The confirm password is required'
  //               },
  //               identical: {
  //                   field: 'password',
  //                   message: 'Passwords are not matching'
  //               },
  //               stringLength: {
  //                   min: 5,
  //                   max: 10,
  //                   message: 'Password length should be between 5 and 10'
  //               }
  //           }
  //       }
  //   }
  // });

  $('#profile_update').bootstrapValidator({
    message: 'This value is not valid',
    feedbackIcons: {
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
    },
    fields: {
        useremail: {
            validators: {
                notEmpty: {
                    message: 'Email is required'
                },
                emailAddress: {
                    message: 'The input is not a valid email address'
                }
            }
        },
        oldpwd: {
            validators: {
                notEmpty: {
                    message: 'The password is required'
                }
            }
        },
        newpwd: {
            validators: {
                notEmpty: {
                    message: 'The confirm password is required'
                },
                stringLength: {
                    min: 5,
                    max: 10,
                    message: 'Password length should be between 5 and 10'
                }
            }
        }
    }
  });
});



  $(function () {
    $('#example1').DataTable();

    $(document).on("click", ".teamstatus" , function() {
          var statusId = $(this).attr('data-id');
          var clickele = $(this);
          $.ajax({
            url:"<?php echo base_url(); ?>teams/changeTeamStatus",
            method:"POST",
            data:"teamId="+$(this).attr('data-team-id')+"&statusId="+$(this).attr('data-id'),
            success:function(response) {
              var userobj = jQuery.parseJSON(response);
              if(userobj.status == 'success'){
                    if(statusId == 2){
                       clickele.text('New');
                       clickele.attr('data-id',0);
                       clickele.removeClass('btn-success');
                       clickele.addClass('btn-primary');
                       clickele.removeClass('btn-danger');
                    }
                    else if(statusId == 0){
                       clickele.text('Active');
                       clickele.attr('data-id',1);
                       clickele.addClass('btn-success');
                       clickele.removeClass('btn-primary');
                       clickele.removeClass('btn-danger');
                    }
                    else if(statusId == 1) {
                        clickele.text('Rejected');
                        clickele.attr('data-id',2);
                        clickele.addClass('btn-danger');
                        clickele.removeClass('btn-primary');
                        clickele.removeClass('btn-success');
                    }
              }
              else {
                    console.log(response);
              }
           },
           error:function(){
            alert("error");
           }
          });
    });
    
   $('#pwdupdate').submit(function(e){
        $('#errorMsgpwd').html('');
        $.ajax({
          url:"<?php echo base_url(); ?>admin/updatepassword",
          method:"POST",
          data:$('#pwdupdate').serialize(),
          success:function(response) {
            var userobj = jQuery.parseJSON(response);
            if(userobj.status == 'success'){
              $('#errorMsgpwd').html(userobj.msg);
              $('#errorMsgpwd').css('color','#0b7b48');
            }
            else {
              $('#errorMsgpwd').html(userobj.msg);
              $('#errorMsgpwd').css('color','#ff0000');
            }

         },
         error:function(){
          alert("error");
         }

        });
        e.preventDefault();
    });

   $('#pwdupdateTailor').submit(function(e){
        $('#errorMsgtpwd').html('');
        $.ajax({
          url:"<?php echo base_url(); ?>admin/updatetailorpassword",
          method:"POST",
          data:$('#pwdupdateTailor').serialize(),
          success:function(response) {
            var userobj = jQuery.parseJSON(response);
            if(userobj.status == 'success'){
              $('#errorMsgtpwd').html(userobj.msg);
              $('#errorMsgtpwd').css('color','#0b7b48');
            }
            else {
              $('#errorMsgtpwd').html(userobj.msg);
              $('#errorMsgtpwd').css('color','#ff0000');
            }
         },
         error:function(){
          alert("error");
         }

        });
        e.preventDefault();
    });

   
    

  })
</script>


</body>
</html>
