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
      <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
      <li class="active">Here</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
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
              <a class="btn btn-app" href="<?php echo site_url('admin/services'); ?>">
                <i class="fa fa-arrow-left"></i> Back
              </a>
            </div>
            <div class="col-sm-6">      
              <a class="btn btn-app pull-right bg-maroon" href="<?php echo site_url('admin/services/delete/'.$dt_users->id); ?>">
                <i class="fa fa-download"></i> Delete
              </a>
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
        
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Detail</h3>
          </div>     
          <!-- /.box-header -->
          <div class="box-body">
          
            <div class="form-horizontal">
              <div class="form-group hidden">
                <div class="col-sm-1">
                  
                </div>
                <label class="col-sm-2 control-label">Id</label>
                <div class="col-sm-8">
                  <input name="id" class="form-control" id="input-id" placeholder="ID" type="text" value="<?php echo $dt_users->id; ?>">
                </div>
                <div class="col-sm-1">
                  
                </div>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <div class="col-sm-1">
                  
                </div>
                <label class="col-sm-2 control-label">Nama Service</label>
                <div class="col-sm-8">
                  <input name="nama_service" class="form-control" id="input-username" placeholder="Nama Service" type="text" value="<?php echo $dt_users->nama_service; ?>">
                </div>
                <div class="col-sm-1">
                  
                </div>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <div class="col-sm-1">
                  
                </div>
                <label class="col-sm-2 control-label">Keterangan</label>
                <div class="col-sm-8">
                  <textarea name="ket" class="form-control" id="input-email" placeholder="Ket" type="text" value="<?php echo $dt_users->ket; ?>"><?php echo $dt_users->ket; ?></textarea>
                </div>
                <div class="col-sm-1">
                  
                </div>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <div class="col-sm-1">
                  
                </div>
                <label class="col-sm-2 control-label">Icon Service</label>
                <div class="col-sm-8">
                  <input name="icon_service" class="form-control" id="input-password" placeholder="Password" type="text" value="<?php echo $dt_users->icon_service ?>">
                </div>
                <div class="col-sm-1">
                  
                </div>
              </div>
            </div>
            <!-- /.form-horizontal -->
  
          </div>
          <!-- /.box-body -->
          
        </div>
        <!-- /.box -->
       
      </div>
      <!-- /.col-sm-12 -->

    </div>
    <!-- /.row -->
  
    <!--------------------------
      | Your Page Content Here |
      -------------------------->
    
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->