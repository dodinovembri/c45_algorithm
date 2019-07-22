<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?php echo $page_title ?>
        <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Laporan</li>
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
    <div class="row">
      <!-- DataTables start here -->
      <div class="col-sm-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title"></h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="col-sm-6">
              <a class="btn btn-app" href="<?php echo site_url('admin/laporan/mining_c45'); ?>">
                <i class="fa fa-gear"></i> Mining C45
              </a>
              <a class="btn btn-app" href="<?php echo site_url('admin/laporan/perhitungan'); ?>">
                <i class="fa fa-calculator"></i> Perhitungan C45
              </a>
              <a class="btn btn-app" href="<?php echo site_url('admin/laporan/keputusan'); ?>">
                <i class="fa fa-tree"></i> Pohon keputusan C45
              </a>              
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </div>
      <!--------------------------
        | Your Page Content Here |
        -------------------------->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->