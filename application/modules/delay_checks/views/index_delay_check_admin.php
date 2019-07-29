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
      <li class="active">Delay Check</li>
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
      <div class="col-sm-4">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Filter</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" class="form">

            <div class="box-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Airlines Name</label>

                <br />
                <select class="js-example-basic-single" name="airlines" id="airlines">
                  <option value="">Select Airlines</option>
                  <?php foreach ($airlines as $key => $value) { ?>
                      <option value="<?= $value['name'] ?>" <?php echo !empty($_GET['airlines']) && ($_GET['airlines'] == $value['name']) ? 'selected' : '' ?>><?= $value['name'] ?></option>
                  <?php } ?>
                </select>
              </div>

              <div class="form-group ml-2">
                <label for="exampleInputEmail1">Flight No.</label>

                <br />
                <select class="js-example-basic-single" name="flight_no" id="flight_no">
                  <option value="">Select Airlines First</option>
                  <?php foreach ($flights as $key => $value) { ?>
                      <option value="<?= $value['flight_no'] ?>" <?php echo !empty($_GET['flight_no']) && ($_GET['flight_no'] == $value['flight_no']) ? 'selected' : '' ?>><?= $value['flight_no'] ?></option>
                  <?php } ?>

                </select>
              </div>

              <div class="form-group ml-2">
                <label for="exampleInputEmail1">Type</label>

                <br />
                <select class="js-example-basic-single" name="type" id="type" value="<?= $_GET['type'] ?>">
                  <option value="">Select Type</option>
                  <option value="Arrival" <?php echo !empty($_GET['type']) && ($_GET['type'] == 'Arrival') ? 'selected' : '' ?>>Arrival</option>
                  <option value="Departure" <?php echo !empty($_GET['type']) && ($_GET['type'] == 'Departure') ? 'selected' : '' ?>>Departure</option>
                </select>
              </div>
              <div class="form-group ml-2">
                <label for="exampleInputEmail1">Airport</label>

                <br />
                <select class="js-example-basic-single" name="airport" id="airport">
                  <option value="">Select Airports</option>


                  <?php foreach ($airports as $key => $value) { ?>
                      <option value="<?= $value['name'] ?>" <?php echo !empty($_GET['airport']) && ($_GET['airport'] == $value['name']) ? 'selected' : '' ?>><?= $value['name'] ?></option>
                  <?php } ?>
                </select>
              </div>

              <div class="form-group ml-2">
                <label for="exampleInputEmail1">Due Date</label>

                <br />
                <input type="text" class="form-control"  name="due_date" id="due_date" autocomplete="off" value="<?= !empty($_GET['due_date']) ? $_GET['due_date'] : '' ?>"/>
              </div>

              <div class="form-group ml-2">
                <label for="exampleInputEmail1">Schedule Time</label>

                <br />
                <input type="text" class="form-control"  name="schedule_time" id="schedule_time" autocomplete="off" value="<?= !empty($_GET['schedule_time']) ? $_GET['schedule_time'] : '' ?>"/>
              </div>
              
              <div class="form-group ml-2">
                <button class="btn btn-success">Cari</button>
                <a href="<?= base_url('admin/delay_check') ?>" class="btn btn-danger">Hapus Filter</a>

              </div>

            </div>
            <!-- /.box-body -->
          </form>
        </div>
        <!-- /.box -->
      </div>

      <div class="col-sm-8">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title"></h3>
          </div>
          <!-- /.box-header -->

            <div class="box-body">
                  <table >
                    <thead>
                      <tr>
                       <!--  <th>Airlines</th>
                        <th>Flight No</th>
                        <th>Schedule Time</th>
                        <th>Airport</th>
                        <th>Type</th>
                        <th>Date</th> -->
                        <th>Delay ?</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                    foreach ($dt_users as $dt)
                    {
                      echo '<tr>' .PHP_EOL;
                        // echo '<td>'.$dt['airlines'].'</td>' .PHP_EOL;
                        // echo '<td>'.$dt['flight_no'].'</td>' .PHP_EOL;
                        // echo '<td>'.date("H:i", strtotime($dt['schedule_time'])).'</td>' .PHP_EOL;
                        // echo '<td>'.$dt['airport'].'</td>' .PHP_EOL;
                        // echo '<td>'.$dt['type'].'</td>' .PHP_EOL;
                        // echo '<td>'.$dt['tanggal'].'</td>' .PHP_EOL;
                        echo '<td>'.$dt['status'].'</td>' .PHP_EOL;
                      echo '</tr>' .PHP_EOL;
                    }
                     ?>                      
                    </tbody>
                    <!-- <tfoot> -->
                      <!-- <tr> -->
                        <!-- <th>Airlines</th>
                        <th>Flight No</th>
                        <th>Schedule Time</th>
                        <th>Airport</th>
                        <th>Type</th>
                        <th>Date</th> -->
                      <!--   <th>Delay</th>
                      </tr> -->
                    <!-- </tfoot> -->
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
<script type="text/javascript">
  
  $("#due_date").datetimepicker({format: 'yyyy-mm-dd', forceParse: true, autoclose: true});
  $("#schedule_time").datetimepicker({format: 'hh:i', forceParse: true, autoclose: true});
</script>