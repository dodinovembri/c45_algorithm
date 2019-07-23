<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?php echo $page_title ?>
        <small><?php echo $page_description ?></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?= base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?= base_url('departures') ?>"><i class="fa fa-users"></i> Departures</a></li>
      <li class="active">Import Departures</li>
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
          <!-- /.box-header -->
          <div class="box-body">
            <div class="col-sm-6">
              <a class="btn btn-app" href="<?php echo site_url('admin/departures'); ?>">
                <i class="fa fa-arrow-left"></i> Back
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
        <?php echo form_open_multipart('admin/departures/import'); ?>
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Form Impor Departures</h3>
          </div>     
          <!-- /.box-header -->
          <div class="box-body">
          
            <div class="form-horizontal">
              <div class="form-group">
                <div class="col-sm-1">
                  
                </div>
                <label class="col-sm-2 control-label">Pilih File</label>
                <div class="col-sm-8">
                  <!-- <input name="first_name" class="form-control" id="input-first-name" placeholder="First Name" type="text"> -->
                  <?= form_upload('userfile') ?>
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