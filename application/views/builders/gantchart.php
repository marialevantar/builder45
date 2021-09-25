<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Highcharts Gantt Example</title>

		<style type="text/css">
#container {
    max-width: 1200px;
    min-width: 800px;
    height: 100%;
    /* height: 400px; */
    margin: 1em auto;
}
.scrolling-container {
	/* overflow-x: auto; */
	-webkit-overflow-scrolling: touch;
}

		</style>
	</head>
	<body>
    <script src="https://code.highcharts.com/gantt/highcharts-gantt.js"></script>
<script src="https://code.highcharts.com/gantt/modules/exporting.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>


<!-- Content -->

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Gantt Chart    
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
    <div class="row">
      <div class="col-xs-12">
                <div class="box">
                  <div class="box-header">
                  </div>
                  <div class="box-body">

                  <div>
                  <form method="post" action="">
                    
                       <select name="project_id" id="project_id" class="form-control">
                    <option value="">Select Project</option>
                    <?php
                        foreach($properties as $pro)
                        {
                    ?>
                        <option value="<?php echo $pro["boutique_property_id"]; ?>" <?php if($this->uri->segment(3) == $pro["boutique_property_id"]){ echo "selected"; } ?>><?php echo $pro["boutique_property_name"]; ?></option>
                    <?php
                        }
                    ?>
                  </select>
                  </form>
                  </div>
                    

<div class="scrolling-container">
    <div id="container"></div>
</div>
                    

                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
              <!-- /.col -->
    </div>
    <!-- /.row (main row) -->

  </section>
  <!-- /.content -->
</div>


		<script type="text/javascript">

Highcharts.ganttChart('container', {

    title: {
        text: 'GANTT CHART'
    },

    xAxis: {
        tickPixelInterval: 70
    },

    yAxis: {
        type: 'category',
        grid: {
            enabled: true,
            borderColor: 'rgba(0,0,0,0.3)',
            borderWidth: 1,
            columns: [{
                title: {
                    text: 'Task'
                },
                labels: {
                    format: '{point.name}'
                }
            }, 
            // {
            //     title: {
            //         text: 'Assignee'
            //     },
            //     labels: {
            //         format: '{point.assignee}'
            //     }
            // },
             {
                title: {
                    text: 'Est. days'
                },
                labels: {
                    formatter: function () {
                        var point = this.point,
                            days = (1000 * 60 * 60 * 24),
                            number = (point.x2 - point.x) / days;
                        return (Math.round(number * 100) / 100)+1;
                    }
                }
            }, {
                labels: {
                    format: '{point.start:%e. %b}'
                },
                title: {
                    text: 'Start date'
                }
            }, {
                title: {
                    text: 'End date'
                },
                offset: 30,
                labels: {
                    format: '{point.end:%e. %b}'
                }
            }]
        }
    },

    tooltip: {
        xDateFormat: '%e %b %Y, %H:%M'
    },

    series: [{
        data: <?= $content?>
    
    }],
    exporting: {
        sourceWidth: 1000
    }
});

$('#project_id').on('change', function() {
    var cid = $(this).val();

    project = $('#project_id').val();
    // alert(project)
    location.href = "<?= base_url() ?>Gantchartbuilders/displaychart/"+project;
  });

		</script>
	</body>
</html>
