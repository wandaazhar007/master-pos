<!-- Theme JS files -->
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/tables/datatables/extensions/responsive.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/core/app.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/pages/datatables_responsive.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/pages/form_select2.js"></script>
<!-- /theme JS files -->
<style>
  .notif .col-md-12 {
    /* background-color: #eaeaea; */
    /* margin-left: 400px; */
    margin-bottom: 60px;
    padding-bottom: 30px;
    float: none;
    margin: 0 auto;
  }

  .panel-flat {
    float: none;
    margin: 0 auto;
  }
</style>

<!-- Main content -->
<div class="content-wrapper">
  <?php echo $this->session->flashdata('message') ?>
  <div class="notif">
    <div class="text-danger text-center col-md-12" style="display: inline-block;">
      <?php echo form_error('name') ?>
      <?php echo form_error('phone') ?>
      <?php echo form_error('email') ?>
      <?php echo form_error('username') ?>
      <?php echo form_error('name_access') ?>
      <?php echo form_error('password1') ?>
      <?php echo form_error('password2') ?>
    </div>
  </div>
  <!-- <button type="button" class="btn btn-default btn-sm" id="pnotify-solid-styled-right">Launch</button> -->
  <!-- <a href="#" id="pnotify-solid-styled-right">test</a> -->
  <div class="panel panel-flat">
    <div class="panel-heading" style="text-decoration: none;">
      <button class="tombol-tambah" data-toggle="modal" data-target="#modal_form_vertical"><i class="fa fa-plus"></i> &nbsp;Tambah Pengguna</button>
      <div class="heading-elements">
        <ul class="icons-list">
          <li><a data-action="collapse"></a></li>
          <li><a data-action="reload"></a></li>
          <li><a data-action="close"></a></li>
        </ul>
      </div>
    </div>
    <table class="table datatable-responsive" id="tableUser">
      <thead>
        <tr>
          <th style="width: 10px;">No</th>
          <th>Nama Pengguna</th>
          <th>Username</th>
          <th>Email</th>
          <th>No Handphone</th>
          <th>Hak Akses</th>
          <th class="text-center" style="width: 200px;">Aksi</th>
        </tr>
      </thead>
    </table>
  </div>
</div>


<!-- Note: Modal Form Input Pengguna | Author: wandaazhar@gmail.com -->
<div id="modal_form_vertical" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Input Data Pengguna</h5>
      </div>
      <hr>

      <form action="<?php echo base_url('user/save') ?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <div class="row">
              <div class="col-sm-6" style="margin-bottom: 10px;">
                <label>Nama Pengguna</label>
                <input type="text" name="name" placeholder="" class="form-control" value="<?php echo set_value('name') ?>">
                <small class="text-danger"><?php echo form_error('name') ?></small>
              </div>

              <div class="col-sm-6" style="margin-bottom: 10px;">
                <label>No Handphone</label>
                <input type="text" name="phone" placeholder="08XX" class="form-control" value="<?php echo set_value('phone') ?>">
                <small class="text-danger"><?php echo form_error('phone') ?></small>
              </div>

              <div class="col-sm-6" style="margin-bottom: 10px;">
                <label>Email</label>
                <input type="email" name="email" placeholder="contoh@gmail.com" class="form-control" value="<?php echo set_value('email') ?>">
                <small class="text-danger"><?php echo form_error('email') ?></small>
              </div>

              <div class="col-sm-6" style="margin-bottom: 10px;">
                <label>Username</label>
                <input type="text" name="username" placeholder="" class="form-control" value="<?php echo set_value('username') ?>">
                <small class="text-danger"><?php echo form_error('username') ?></small>
              </div>

              <div class="col-sm-6" style="margin-bottom: 10px;">
                <label>Password</label>
                <input type="password" name="password1" placeholder="******" class="form-control">
                <small class="text-danger"><?php echo form_error('password1') ?></small>
              </div>

              <div class="col-sm-6" style="margin-bottom: 10px;">
                <label>Ulangi Password</label>
                <input type="password" name="password2" placeholder="******" class="form-control">
                <small class="text-danger"><?php echo form_error('password2') ?></small>
              </div>

              <div class="col-sm-6" style="margin-bottom: 10px;">
                <label>Hak Akses</label>
                <select data-placeholder="Pilih hak akses pengguna..." class="select select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="iduser_access">
                  <option></option>
                  <optgroup label="Pilih hak akses pengguna ">
                    <?php echo $this->wandalibs->getAllUserAccessArray() ?>
                  </optgroup>
                </select>
              </div>

              <div class="col-sm-6">
                <label>Upload Foto</label>
                <input type="file" name="photo" placeholder="Upload Foto" class="form-control">
                <small class="text-danger"><?php echo form_error('photo') ?></small>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="tombol-modal-hapus" data-dismiss="modal">Close</button>
          <button type="submit" class="tombol-tambah"><i class="fa fa-save"></i>&nbsp; Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Note: Modal Form Edit pengguna | Author: wandaazhar@gmail.com -->
<div class="modal fade" id="modal_user">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Edit pengguna</h5>
      </div>
      <div class="modal-body">
        <div id="user_result"></div>
      </div>
    </div>
  </div>
</div>

<!-- Note: Modal Form Edit Pengguna | Author: wandaazhar@gmail.com -->
<div class="modal fade" id="modal_delete_user">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <!-- <h5 class="modal-title">Apakah Anda yakin ?</h5> -->
      </div>
      <div class="modal-body">
        <div id="delete_user_result"></div>
      </div>
    </div>
  </div>
</div>