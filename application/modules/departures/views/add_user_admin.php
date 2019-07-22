<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.full.js"></script>

<style>
.js-example-basic-single {
    width: 30%;       
}

</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?php echo $page_title ?>
        <small><?php echo $page_description ?></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="#"><i class="fa fa-circle-o"></i> Departure</a></li>
      <li class="active">Add</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <?php if(!empty($message))
    {
    ?> 
    <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-ban"></i> Alert!</h4> 
      <?php echo $message; ?>
    </div>
    <?php } ?>
    <!-- /.alert -->
    <div class="row">
      <div class="col-sm-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Tools</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
          </div>     
          <!-- /.box-header -->
          <div class="box-body">
            <div class="col-sm-6">
              <a class="btn btn-app" href="<?php echo site_url('admin/departures'); ?>">
                <i class="fa fa-arrow-left"></i> Back
              </a>
              <a class="btn btn-app" href="<?php echo site_url('admin/departures/add'); ?>">
                <i class="fa fa-rotate-left"></i> Undo
              </a>
            </div>
            <div class="col-sm-6">
                         
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-sm-12">
        <?php echo form_open_multipart('admin/departures/add'); ?>
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Form</h3>
          </div>     
          <!-- /.box-header -->
          <div class="box-body">
          
            <div class="form-horizontal">
              <div class="form-group">
                <div class="col-sm-1">
                  
                </div>

                <label class="col-sm-2 control-label">Airlines Name</label>
                <div class="col-sm-8">
                  <select class="js-example-basic-single" name="airlines" id="airlines">
                    <option value="">Select Airlines</option>
                    <?php foreach ($airlines as $key => $value) { ?>
                        <option value="<?= $value['name'] ?>"><?= $value['name'] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col-sm-1">
                  
                </div>
              </div>

              <!-- /.form-group -->
              <div class="form-group">
                <div class="col-sm-1">
                  
                </div>
                <label class="col-sm-2 control-label">Flight No.</label>
                <div class="col-sm-8">
                  <select class="js-example-basic-single" name="flight_no" id="flight_no">
                    <option value="">Select Airlines First</option>
                    <?php foreach ($flights as $key => $value) { ?>
                        <option value="<?= $value['flight_no'] ?>" <?php echo !empty($_GET['flight_no']) && ($_GET['flight_no'] == $value['flight_no']) ? 'selected' : '' ?>><?= $value['flight_no'] ?></option>
                    <?php } ?>

                  </select>
                </div>
                <div class="col-sm-1">
                  
                </div>
              </div>

              <!-- /.form-group -->
              <div class="form-group">
                <div class="col-sm-1">
                  
                </div>
                <label class="col-sm-2 control-label">Select Airports</label>
                <div class="col-sm-8">

                  <select class="js-example-basic-single" name="airport" id="airport">
                    <option value="">Select Airports</option>


                    <?php foreach ($airports as $key => $value) { ?>
                        <option value="<?= $value['name'] ?>" <?php echo !empty($_GET['airport']) && ($_GET['airport'] == $value['name']) ? 'selected' : '' ?>><?= $value['name'] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col-sm-1">
                  
                </div>
              </div>

              <!-- /.form-group -->
              <div class="form-group">
                <div class="col-sm-1">
                  
                </div>
                <label class="col-sm-2 control-label">Schedule Time</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control"  name="schedule_time" id="schedule_time" autocomplete="off" placeholder="18:05" />
                </div>
                <div class="col-sm-1">
                  
                </div>
              </div>

              <!-- /.form-group -->
              <div class="form-group">
                <div class="col-sm-1">
                  
                </div>
                <label class="col-sm-2 control-label">Schedule Date</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control"  name="tanggal" id="tanggal" autocomplete="off" placeholder="2019-07-15" />
                </div>
                <div class="col-sm-1">
                  
                </div>
              </div>

              <!-- /.form-group -->
              <div class="form-group">
                <div class="col-sm-1">
                  
                </div>
                <label class="col-sm-2 control-label">Delay Status</label>
                <div class="col-sm-8">

                  <select class="js-example-basic-single" name="status" id="status">
                    <option value="">Select status</option>
                    <option value="Ya">Ya</option>
                    <option value="Tidak">Tidak</option>
                  </select>
                </div>
                <div class="col-sm-1">
                </div>
              </div>


            </div>
            <!-- /.form-horizontal -->
  
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <div class="col-sm-1">
            </div>
            <div class="col-sm-2">
            </div>
            <div class="col-sm-8">
              <button type="submit" class="btn btn-info">Save</button>
            </div>
            
            <div class="col-sm-1">
            </div> 
           </div>
        </div>
        <!-- /.box -->
        <?php echo form_close(); ?>
      </div>
      <!-- /.col-sm-12 -->

    </div>
    <!-- /.row -->
  <?php
  echo print_r($template_data['uri_segment']);
  echo '<br/>';
  echo $template_data['module'];
  echo '<br/>';
  echo $template_data['controller'];
  echo '<br/>';
  echo $template_data['method'];
  echo '<br/>';
  echo $template_data['directory'];
  ?>
    <!--------------------------
      | Your Page Content Here |
      -------------------------->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script type="text/javascript">
  
  $("#tanggal").datetimepicker({format: 'yyyy-mm-dd', forceParse: true, autoclose: true});
  $("#schedule_time").datetimepicker({format: 'hh:i', forceParse: true, autoclose: true});
</script>