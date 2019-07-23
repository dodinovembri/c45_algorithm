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
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Departures</li>
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
              <a class="btn btn-app bg-olive" href="<?php echo site_url('admin/departures/add'); ?>">
                <i class="fa fa-plus"></i> Add / Create
              </a>
             <a class="btn btn-app bg-olive" href="<?php echo site_url('admin/departures/import'); ?>">
                <i class="fa fa-plus"></i> Import
              </a>
            </div>

            <div id="usersTable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
              <div class="row">
                <div class="col-sm-12">
                  <table id="usersTable" class="table table-bordered table-striped dataTable">
                    <thead>
                      <tr>
                        <th>Airlines</th>
                        <th>Flight No.</th>
                        <th>Schedule Time</th>
                        <th>Airport</th>
                        <th>Tanggal</th>
                        <th>Delay</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                    foreach ($dt_users as $dt)
                    {
                      echo '<tr>' .PHP_EOL;
                        echo '<td>'.$dt['airlines'].'</td>' .PHP_EOL;
                        echo '<td>'.$dt['flight_no'].'</td>' .PHP_EOL;
                        echo '<td>'.date("H:i:s", strtotime($dt['schedule_time'])).'</td>' .PHP_EOL;
                        echo '<td>'.$dt['airport'].'</td>' .PHP_EOL;
                        echo '<td>'.date("Y-m-d", strtotime($dt['tanggal'])).'</td>' .PHP_EOL;
                        echo '<td>'.$dt['status'].'</td>' .PHP_EOL;
                      echo '</tr>' .PHP_EOL;
                    }
                     ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Airlines</th>
                        <th>Flight No.</th>
                        <th>Schedule Time</th>
                        <th>Airport</th>
                        <th>Tanggal</th>
                        <th>Delay</th>
                      </tr>
                    </tfoot>
                  </table>
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