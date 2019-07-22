<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h1>
        <?php echo $page_title ?>
        <small><?php echo $page_description ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Profile</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#settings" data-toggle="tab" aria-expanded="false">Info</a></li>
              <li class=""><a href="#change_pass" data-toggle="tab" aria-expanded="false">Ganti Password</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="settings">
                <?php echo form_open_multipart('admin/profile/update_info', array('class' => 'form-horizontal')); ?>
                  <?php if(!empty($message))
                  {
                  ?> 
                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Alert!</h4> 
                    <?php echo $message; ?>
                  </div>
                  <?php } ?>

                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">E-mail</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="email" id="email" placeholder="E-mail" readonly="" value="<?php echo $session_data['email']; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">NIP (Nomor Induk Pegawai)</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nip" id="nip" placeholder="NIP" readonly="" value="<?php echo $session_data['nip']; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nama</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" readonly="" value="<?php echo $session_data['first_name'] . ' ' . $session_data['last_name']; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <a href="#" onclick="enableEditSetting();" class="btn btn-info">Edit</a>
                      <button type="submit" id="btn-save" class="btn btn-success" style="display:none">Save Changes</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="change_pass">
                <?php echo form_open_multipart('admin/profile/update_password', array('class' => 'form-horizontal')); ?>
                  <?php if(!empty($message))
                  {
                  ?> 
                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Alert!</h4> 
                    <?php echo $message; ?>
                  </div>
                  <?php } ?>

                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">New Password</label>

                    <div class="col-sm-10">
                      <input type="password" class="form-control" name="new_password" id="new_password" placeholder="New Password" readonly="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Confirm Password</label>

                    <div class="col-sm-10">
                      <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password" readonly="">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <a href="#" onclick="enableEditPassword();" class="btn btn-info">Edit</a>
                      <button type="submit" id="btn-save" class="btn btn-success" style="display:none">Save Changes</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->

            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    <!-- /.content -->
  </div>

<script type="text/javascript">

function enableEditSetting()
{
  $('#settings').find('#email').removeAttr('readonly');
  $('#settings').find('#nip').removeAttr('readonly');
  $('#settings').find('#nama').removeAttr('readonly');
  $('#settings').find('#btn-save').show();
}  

function enableEditPassword()
{
  $('#change_pass').find('#new_password').removeAttr('readonly');
  $('#change_pass').find('#confirm_password').removeAttr('readonly');
  $('#change_pass').find('#btn-save').show();
}  

</script>