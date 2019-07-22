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
              <a class="btn btn-app" href="<?php echo site_url('admin/products'); ?>">
                <i class="fa fa-arrow-left"></i> Back
              </a>
              <a class="btn btn-app" href="<?php echo site_url('admin/products/edit/'.$dt_users->id); ?>">
                <i class="fa fa-rotate-left"></i> Undo
              </a>
            </div>
            <div class="col-sm-6">
              <a class="btn btn-app pull-right bg-maroon" href="<?php echo site_url('admin/products/update/'.$dt_users->id); ?>">
                <i class="fa fa-download"></i> Save
              </a>            
              <a class="btn btn-app pull-right bg-maroon" href="<?php echo site_url('admin/products/delete/'.$dt_users->id); ?>">
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
            <h3 class="box-title">Form</h3>
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
                <label class="col-sm-2 control-label">Nama produk</label>
                <div class="col-sm-8">
                  <input name="nama_produk" class="form-control" id="input-username" placeholder="Nama Produk" type="text" value="<?php echo $dt_users->nama_product; ?>">
                </div>
                <div class="col-sm-1">
                  
                </div>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <div class="col-sm-1">
                  
                </div>
                <label class="col-sm-2 control-label">Keterangan Produk</label>
                <div class="col-sm-8">
                  <textarea name="ket_product" class="form-control" id="input-email" placeholder="Ket Produk" type="text" value="<?php echo $dt_users->ket_product; ?>"><?php echo $dt_users->ket_product; ?></textarea>
                </div>
                <div class="col-sm-1">
                  
                </div>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <div class="col-sm-1">
                  
                </div>
                <label class="col-sm-2 control-label">Gambar Product</label>
                <div class="col-sm-8">
                  <img src="<?php echo base_url('assets/public/uploads/') ?><?php echo $dt_users->gambar_product ?>" width="150" height="150" />
                  <br />
                  <input name="gambar_product" class="form-control" id="input-password" placeholder="Password" type="file">
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