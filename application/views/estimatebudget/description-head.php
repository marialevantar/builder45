<?php 
$stat = $this->session->userdata('filter');
if($stat == "rejected"):
  $backlink = base_url()."boutique/tailor";
elseif($stat == "new"):
  $backlink = base_url()."boutique/tailor";
elseif($stat == "active"):
  $backlink = base_url()."boutique/tailor";
else:
  $backlink = base_url()."boutique/tailor";
endif;
 ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Add
    <small>Title</small>
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

  <?php if($this->uri->segment(3) == NULL){ ?>
  <!-- Main content -->
  <section class="content">
  <div class="box box-info">
    <form enctype="multipart/form-data"  id="addcustomer" method="post" action="<?php echo base_url(); ?>estimattebudget/saveheadtitle/">
      <div class="box-header with-border">
      <span class="pull-right"><a class="btn btn-info" href="<?php echo @$backlink; ?>">
        Back</a></span>
      </div>
      <div class="box-body">
        <div class="row">

          <div class="col-md-12">
            <div class="form-group">
              <label>Name</label>
              <input name="name" type="text" class="form-control" value="">
            </div>
          </div>
          
   
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Add</button>
      </div>
    </form>
  </div>

  <div class="box box-info">
      <div class="box-header with-border">
        <div class="box-body">
            <table id="example2" class="table table-bordered table-striped">
              <thead>
                <tr>    
                  <th>Title Name(Description)</th>
                  <th>Action</th>
              </thead>
              <tbody>
                   <?php foreach($heades as $heades) {?>
                    <tr>
                        <td><?php echo $heades["header_name"]; ?></td>
                        <td>  <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this header ?');" href="<?php echo base_url(); ?>estimattebudget/removeheader/<?php echo $heades["hedaer_id"]; ?>"><i class="fa fa-trash"></i>
                  
                    </tr>
                   <?php } ?>
                  
              </tbody>
            </table>
        </div>
       </div>
     </div>
  <!-- /.row -->
  </section>
<?php }else{ ?>
    
    
    <?php } ?>

  <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<script>

</script>