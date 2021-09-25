<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Site Manager | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/bootstrapValidator.css">

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/upload.css">
  
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
  
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
  
    <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/select2/dist/css/select2.min.css">
  

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url(); ?>boutique/dashboard" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b><?php echo $this->session->userdata('BoutiqueName');?></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><?php echo $this->session->userdata('BoutiqueName');?></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <?php if($this->session->userdata('BoutiqueID') != 33 ){?>
              <img src="<?php echo base_url(); ?>assets/dist/img/avatar5.png" class="user-image" alt="User Image">
              <?php }
                    else{?>
               <img src="<?php echo base_url(); ?>assets/dist/img/aroya.png" class="user-image" alt="User Image">
              <?php
                    }
              ?>
              <span class="hidden-xs"><?php echo @$_SESSION['UserName'];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <?php if($this->session->userdata('BoutiqueID') != 33 ){?>  
                <img src="<?php echo base_url(); ?>assets/dist/img/avatar5.png" class="img-circle" alt="User Image">
                <?php }
                    else{?>
                <img src="<?php echo base_url(); ?>assets/dist/img/aroya.png" class="img-circle" alt="User Image">
                <?php
                    }
                ?>
                <p>
                  <?php echo @$_SESSION['UserName'];?>
                </p>
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                   <a href="<?php echo base_url(); ?>boutique/updatepassword" class="btn btn-default btn-flat">Change Password</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url(); ?>login/logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <?php if($this->session->userdata('BoutiqueID') != 33 ){?>  
            <img src="<?php echo base_url(); ?>assets/dist/img/avatar5.png" class="img-circle" alt="User Image">
          <?php }
                else{?>
            <img src="<?php echo base_url(); ?>assets/dist/img/aroya.png" class="img-circle" alt="User Image">
          <?php
               }
          ?>
        </div>
        <div class="pull-left info">
          <p><?php echo @$_SESSION['UserName'];?></p>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <?php if($this->session->userdata('UserID')==119) { ?>
        <ul class="sidebar-menu" data-widget="tree">
        <li class="treeview">
          <a href="#">
            <i class="fa fa-circle-o text-orange"></i> <span>Customers</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="<?php echo base_url(); ?>boutique/addcustomer"><i class="fa fa-circle-o"></i>Add Customer</a></li>
          </ul>
        </li>
      </ul>
      <?php }else{?>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header"><?php echo $this->session->userdata('BoutiqueName');?></li>
        <li>
          <a href="<?php echo base_url(); ?>boutique/dashboard">
            <i class="fa fa-circle-o text-blue"></i> <span>Dashboard</span>
          </a>
        </li>
        
        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-circle-o text-orange"></i> <span>Tenants</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="<?php echo base_url(); ?>boutique/customer"><i class="fa fa-circle-o"></i>Tenant List</a></li>
            <?php if($this->session->userdata('UserID') !=118) {?>
            <li class="active"><a href="<?php echo base_url(); ?>boutique/addcustomer"><i class="fa fa-circle-o"></i>Add Tenant</a></li>
            <?php }?>
          </ul>
        </li> -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-circle-o text-orange"></i> <span><?php echo (($this->session->userdata('BoutiqueID') == 27) || ($this->session->userdata('BoutiqueID') == 51) || ($this->session->userdata('BoutiqueID') == 52)) ? 'Staffs' : (($this->session->userdata('BoutiqueID') == 33) ? "Staffs" : "Staffs") ; ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="<?php echo base_url(); ?>boutique/tailor"><i class="fa fa-circle-o"></i><?php echo (($this->session->userdata('BoutiqueID') == 27) || ($this->session->userdata('BoutiqueID') == 51) || ($this->session->userdata('BoutiqueID') == 52)) ? 'Staffs' : (($this->session->userdata('BoutiqueID') == 33) ? "Staffs" : "Staff") ; ?> List</a></li>
             
            <li class="active"><a href="<?php echo base_url(); ?>boutique/addtailor"><i class="fa fa-circle-o"></i>Add <?php echo (($this->session->userdata('BoutiqueID') == 27) || ($this->session->userdata('BoutiqueID') == 51 || ($this->session->userdata('BoutiqueID') == 52))) ? 'Staff' : (($this->session->userdata('BoutiqueID') == 33) ? "Staff" : "Staff") ; ?></a></li>
           
            <li class="active"><a href="<?php echo base_url(); ?>boutique/stafftype"><i class="fa fa-circle-o"></i> Staff Type</a></li>
          </ul>
          
        </li>
        

          <li class="treeview">
          <a href="#">
            <i class="fa fa-circle-o text-orange"></i> <span>Expenses</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="<?php echo base_url(); ?>boutique/expences"><i class="fa fa-circle-o"></i>Expenses List</a></li>
            <?php if($this->session->userdata('UserID') !=118) {?>
            <li class="active"><a href="<?php echo base_url(); ?>boutique/addexpence"><i class="fa fa-circle-o"></i>Add Expense</a></li>
            <?php } ?>
            <li class="active"><a href="<?php echo base_url(); ?>boutique/expencecategory"><i class="fa fa-circle-o"></i>Expense Categories</a></li>
           
          </ul>
        </li>
        
          <!-- Builders Demo 01-04-2021 -->
        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-circle-o text-orange"></i> <span>Store</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="<?php echo base_url(); ?>boutique/listitemstore"><i class="fa fa-circle-o"></i>Item List</a></li>
            <li class="active"><a href="<?php echo base_url(); ?>boutique/additemstore"><i class="fa fa-circle-o"></i>Add Item</a></li>
           
          </ul>
        </li> -->

        <li class="treeview">
          <a href="#">
            <i class="fa fa-circle-o text-orange"></i> <span>Target</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="<?php echo base_url(); ?>boutique/schedulework"><i class="fa fa-circle-o"></i>Assign New Task</a></li>
            <li class="active"><a href="<?php echo base_url(); ?>boutique/listschedulework"><i class="fa fa-circle-o"></i>List of Assigned Tasks</a></li>
           
          </ul>
        </li>
        <?php if($this->session->userdata('UserID') == 126){?>
                            
                            <li class="treeview">
                              <a href="#">
                                <i class="fa fa-circle-o text-orange"></i> <span>User Create</span>
                                <span class="pull-right-container">
                                  <i class="fa fa-angle-left pull-right"></i>
                                </span>
                              </a>
                              <ul class="treeview-menu">
                                <li class="active"><a href="<?php echo base_url(); ?>boutique/userlist"><i class="fa fa-circle-o"></i>User List</a></li>
                              </ul>
                            </li>
                            
                            <li class="treeview">
                              <a href="#">
                                <i class="fa fa-circle-o text-orange"></i> <span>Petty Cash</span>
                                <span class="pull-right-container">
                                  <i class="fa fa-angle-left pull-right"></i>
                                </span>
                              </a>
                              <ul class="treeview-menu">
                                <li class="active"><a href="<?php echo base_url(); ?>boutique/addpettycash"><i class="fa fa-circle-o"></i>Add Petty Cash</a></li>
                                <li class="active"><a href="<?php echo base_url(); ?>boutique/listcash"><i class="fa fa-circle-o"></i>Petty Cash list</a></li>
                          
                          
                              </ul>
                            </li>
                            
                    
                            <li>
                              <a href="<?php echo base_url(); ?>boutique/purchase_requestflow">
                                <i class="fa fa-circle-o text-orange"></i> <span>Purchase Request</span>
                              </a>
                            </li>
                            
        <li>
          <a href="<?php echo base_url(); ?>boutique/day_summary">
            <i class="fa fa-circle-o text-orange"></i> <span>Days Summary</span>
          </a>
        </li>
                    
                            <?php } else { ?>
                            
                                                
                                                <li class="treeview">
                                                  <a href="#">
                                                    <i class="fa fa-circle-o text-orange"></i> <span>Request</span>
                                                    <span class="pull-right-container">
                                                      <i class="fa fa-angle-left pull-right"></i>
                                                    </span>
                                                  </a>
                                                  <ul class="treeview-menu">
                                                    <li class="active"><a href="<?php echo base_url(); ?>boutique/purchase_requestflow"><i class="fa fa-circle-o"></i>Request List</a></li>
                                                    <li class="active"><a href="<?php echo base_url(); ?>boutique/requestlist"><i class="fa fa-circle-o"></i>Requests</a></li>
                                                    <li class="active"><a href="<?php echo base_url(); ?>boutique/purchase_request"><i class="fa fa-circle-o"></i>Add Request</a></li>
                                                  </ul>
                                                </li>
                                        
                                                <?php } ?>
                           

              <!-- Builders Demo closing -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-circle-o text-orange"></i> <span>Income</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="<?php echo base_url(); ?>boutique/income"><i class="fa fa-circle-o"></i>Income List</a></li>
            <?php if($this->session->userdata('UserID') !=118) {?>
            <li class="active"><a href="<?php echo base_url(); ?>boutique/addincome"><i class="fa fa-circle-o"></i>Add Income</a></li>
            <?php } ?>
            <li class="active"><a href="<?php echo base_url(); ?>boutique/incomecategory"><i class="fa fa-circle-o"></i>Income Categories</a></li>
           
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-circle-o text-orange"></i> <span>Stock</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="<?php echo base_url(); ?>boutique/stocklist"><i class="fa fa-circle-o"></i>Stock List</a></li>
            <?php if($this->session->userdata('UserID') !=118) {?>
            <li class="active"><a href="<?php echo base_url(); ?>boutique/addstock"><i class="fa fa-circle-o"></i>Add Stock</a></li>
            <?php } ?>
            <!-- <li class="active"><a href="<?php echo base_url(); ?>boutique/incomecategory"><i class="fa fa-circle-o"></i>Income Categories</a></li> -->
           
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-circle-o text-orange"></i> <span>Item</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="<?php echo base_url(); ?>boutique/itemtransferedlist"><i class="fa fa-circle-o"></i>Item List</a></li>
            <?php if($this->session->userdata('UserID') !=118) {?>
            <li class="active"><a href="<?php echo base_url(); ?>boutique/additemtransferedtosite"><i class="fa fa-circle-o"></i>Add Item</a></li>
            <?php } ?>
            <!-- <li class="active"><a href="<?php echo base_url(); ?>boutique/incomecategory"><i class="fa fa-circle-o"></i>Income Categories</a></li> -->
           
          </ul>
        </li>
          <li>
          <a href="<?php echo base_url(); ?>boutique/properties">
            <i class="fa fa-circle-o text-orange"></i> <span>Projects</span>
          </a>
        </li>
        <li>
          <a href="<?php echo base_url(); ?>boutique/siteattendance">
            <i class="fa fa-circle-o text-orange"></i> <span>Attendance</span>
          </a>
        </li>
        
         <?php if($this->session->userdata('BoutiqueStitchingStatus') == 1){?>

        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-circle-o text-orange"></i> <span><?php echo ($this->session->userdata('BoutiqueID') == 27) ? 'Staffs' : (($this->session->userdata('BoutiqueID') == 33) ? "Staffs" : "Tailors") ; ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="<?php echo base_url(); ?>boutique/tailor"><i class="fa fa-circle-o"></i><?php echo ($this->session->userdata('BoutiqueID') == 27) ? 'Staffs' : (($this->session->userdata('BoutiqueID') == 33) ? "Staffs" : "Tailors") ; ?> List</a></li>
            <?php if($this->session->userdata('UserID') !=118) {?>
            <li class="active"><a href="<?php echo base_url(); ?>boutique/addtailor"><i class="fa fa-circle-o"></i>Add <?php echo ($this->session->userdata('BoutiqueID') == 27) ? 'Staff' : (($this->session->userdata('BoutiqueID') == 33) ? "Staff" : "Tailor") ; ?></a></li>
            <?php } ?>
          </ul>
        </li> -->
        
          <?php 
          if( $this->session->userdata('BoutiqueID') == 16 || $this->session->userdata('BoutiqueID') == 25){
          ?>
         <?php 
            }
          }
          ?>


<?php
if($this->session->userdata('UserRole') == 2 || $this->session->userdata('UserRole') == 7){
if($this->session->userdata('UserID') !=128) {?>
  <?php if($this->session->userdata('BoutiqueBillingStatus') == 1){?>

        <li class="header">Billing</li>
        <li class="treeview">
          <!-- <a href="#">
            <i class="fa fa-circle-o text-orange"></i> <span>Tax Rates</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a> -->
          <ul class="treeview-menu">
            <li class="active"><a href="<?php echo base_url(); ?>billing/tax"><i class="fa fa-circle-o"></i>Tax Rates</a></li>
            <?php if($this->session->userdata('UserID') !=118) {?>
            <li class="active"><a href="<?php echo base_url(); ?>billing/addtax"><i class="fa fa-circle-o"></i>Add Tax Rate</a></li>
            <?php }?>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-circle-o text-orange"></i> <span>Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="<?php echo base_url(); ?>billing/expencereport"><i class="fa fa-circle-o"></i>Expenses Reports</a></li>
            <li class="active"><a href="<?php echo base_url(); ?>billing/salereport"><i class="fa fa-circle-o"></i>Income Reports</a></li>
            <?php 
              if( $this->session->userdata('BoutiqueID') == 30){
            ?>
              <li class="active"><a href="<?php echo base_url(); ?>billing/gstreport"><i class="fa fa-circle-o"></i>GST Reports</a></li>
          <?php } ?>
            <li class="active"><a href="<?php echo base_url(); ?>billing/profitreport"><i class="fa fa-circle-o"></i>Profits</a></li>
          </ul>
        </li>
        <?php } ?>
          <!--  ESTIMATING AND BUDGETTING OPEN -->
        <li class="header">Estimation & Budgetting</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-circle-o text-orange"></i> <span>Estimate</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="<?php echo base_url(); ?>estimattebudget/description_head"><i class="fa fa-circle-o"></i>Header</a></li>
            <li class="active"><a href="<?php echo base_url(); ?>estimattebudget/description_subhead"><i class="fa fa-circle-o"></i>Sub Header</a></li>
            <li class="active"><a href="<?php echo base_url(); ?>estimattebudget/addproject"><i class="fa fa-circle-o"></i>Add Project</a></li>
            <li class="active"><a href="<?php echo base_url(); ?>estimattebudget/listprojects"><i class="fa fa-circle-o"></i>List Project</a></li>
          
          </ul>
        </li>

     <!-- ESTIMATING AND BUDGETING CLOSE  -->

     <!-- Chart -->
     <li class="header">Chart</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-circle-o text-orange"></i> <span>Chart</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="<?php echo base_url(); ?>Gantchartbuilders/addchartcontent"><i class="fa fa-circle-o"></i>Add Task</a></li>
            <li class="active"><a href="<?php echo base_url(); ?>Gantchartbuilders/viewtask"><i class="fa fa-circle-o"></i>View Task</a></li>
            <li class="active"><a href="<?php echo base_url(); ?>Gantchartbuilders/displaychart"><i class="fa fa-circle-o"></i>Chart</a></li>
        
          </ul>
        </li>
        <!-- Vendor Section -->
  
        <li class="treeview">
          <a href="#">
            <i class="fa fa-circle-o text-orange"></i> <span>Vendor</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="<?php echo base_url(); ?>billing/credit_item_list"><i class="fa fa-circle-o"></i>Credit Item List</a></li>
            <li class="active"><a href="<?php echo base_url(); ?>billing/add_credit_item"><i class="fa fa-circle-o"></i>Add Credit Item</a></li>
            <li class="active"><a href="<?php echo base_url(); ?>billing/vendorlist"><i class="fa fa-circle-o"></i>Add Vendor</a></li>
          </ul>
        </li>

        
      </ul>
              <?php } ?>
              <?php }  } ?>

    </section>
    <!-- /.sidebar -->
  </aside>
