<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
.js-example-basic-single {
    width: 100%;       
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
      <li class="active">Laporan Terbanyak</li>
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
      <div class="col-sm-6">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Jam Terbanyak</h3>
          </div>
          <!-- /.box-header -->

            <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                    <label><strong>Jam Terbanyak</strong></label>
                    <h5><?= $dt_jam_tebanyak->schedule_time ?></h5>
                  </div>

                  <div class="col-md-6">
                    <label><strong>Jumlah Delay</strong></label>
                    <h6><?= $dt_jam_tebanyak->jumlah ?></h6>
                  </div>
                </div>
                </div>
              </div>

            </div>

          <div class="col-sm-6">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Maskapai Terbanyak</h3>
              </div>
              <!-- /.box-header -->

                <div class="box-body">
                    <div class="row">
                      <div class="col-md-6">
                        <label><strong>Maskapai Terbanyak</strong></label>
                        <h5><?= $dt_maskapai_tebanyak->airlines ?></h5>
                      </div>

                      <div class="col-md-6">
                        <label><strong>Jumlah Delay</strong></label>
                        <h6><?= $dt_maskapai_tebanyak->jumlah ?></h6>
                      </div>
                    </div>
                    </div>
                  </div>

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
