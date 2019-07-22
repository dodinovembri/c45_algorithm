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
            <li  class="active"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
    <div class="row">
        <div class="col-sm-12">

        <div class="box box-success">
          <!-- /.box-header -->
          <div class="box-body">
                <img src="<?= base_url('assets/image/bandara.jpg') ?>" style="width: 100%">
          </div>
          <!-- /.box-body -->
        </div>
        </div>
    </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->