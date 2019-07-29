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
      <li><a href="<?= base_url('admin/laporan') ?>"><i class="fa fa-lists"></i> Laporan</a></li>
      <li class="active">Perhitungan C45</li>
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
             <div class="btn btn-app">
                <i class="fa fa-tree"></i>
                <?php echo anchor('admin/laporan/keputusan/','Pohon keputusan C45', array('target' => '_blank')); ?>                

              </div>               
            </div>
            
            <div id="usersTable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
              <div class="row">
                <div class="col-sm-12">
                  <table id="usersTable" class="table table-bordered table-striped dataTable">
                    <thead>
                      <tr>
                        <th>NO</th>
                        <th>ATT GAIN RATIO MAX</th>
                        <th>ATRIBUT</th>
                        <th>NILAI ATRIBUT</th>
                        <th>TOTAL KASUS</th>
                        <th>JUMLAH DELAY</th>
                        <th>JUMLAH TIDAK DELAY</th>
                        <th>ENTROPY</th>
                        <th>GAIN</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                    foreach ($dt_users as $dt)
                    {
                      echo '<tr>' .PHP_EOL;
                        echo '<td>'.$dt['iterasi'].'</td>' .PHP_EOL;
                        echo '<td>'.$dt['atribut_gain_ratio_max'].'</td>' .PHP_EOL;
                        echo '<td>'.$dt['atribut'].'</td>' .PHP_EOL;
                        echo '<td>'.$dt['nilai_atribut'].'</td>' .PHP_EOL;
                        echo '<td>'.$dt['jml_kasus_total'].'</td>' .PHP_EOL;
                        echo '<td>'.$dt['jml_delay'].'</td>' .PHP_EOL;
                        echo '<td>'.$dt['jml_tdk_delay'].'</td>' .PHP_EOL;
                        echo '<td>'.$dt['entropy'].'</td>' .PHP_EOL;
                        echo '<td>'.$dt['inf_gain'].'</td>' .PHP_EOL;
                      echo '</tr>' .PHP_EOL;
                    }
                     ?>                      
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>NO</th>
                        <th>ATT GAIN RATIO MAX</th>
                        <th>ATRIBUT</th>
                        <th>NILAI ATRIBUT</th>
                        <th>TOTAL KASUS</th>
                        <th>JUMLAH DELAY</th>
                        <th>JUMLAH TIDAK DELAY</th>
                        <th>ENTROPY</th>
                        <th>GAIN</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
              <!--
              <div class="row">
                <div class="col-sm-5">
                  <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>
                </div>
                <div class="col-sm-7">
                  <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                    <ul class="pagination">
                      <li class="paginate_button previous disabled" id="example1_previous"><a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0">Previous</a></li>
                      <li class="paginate_button active"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0">1</a></li>
                      <li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0">2</a></li>
                      <li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0">3</a></li>
                      <li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0">4</a></li>
                      <li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0">5</a></li>
                      <li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0">6</a></li>
                      <li class="paginate_button next" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0">Next</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              -->
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