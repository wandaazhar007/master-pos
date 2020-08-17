<!-- /core JS files -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
<!-- Theme JS files -->
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/tables/datatables/extensions/pdfmake/pdfmake.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/tables/datatables/extensions/pdfmake/vfs_fonts.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/tables/datatables/extensions/buttons.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/tables/datatables/extensions/responsive.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>

<script type="text/javascript" src="<?php echo base_url() ?>assets/js/core/app.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/pages/ecommerce_customers.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/pages/datatables_responsive.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/pages/form_select2.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/notifications/pnotify.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/pages/components_notifications_pnotify.js"></script>
<!-- /theme JS files -->

<!-- Main content -->
<div class="content-wrapper">
  <?php echo $this->session->flashdata('message') ?>
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

    <table class="table table-striped text-nowrap table-customers">
      <thead>
        <tr>
          <th>Nama Pengguna</th>
          <th>Tanggal Registrasi</th>
          <th>Email</th>
          <th>No Handphone</th>
          <th>Login history</th>
          <th>Hak Akses</th>
          <th>Aksi</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($getAll as $i) : ?>
          <tr>
            <td>
              <div class="media">
                <a href="user_pages_profile_tabbed.html" class="media-left">
                  <img src="<?php echo base_url() ?>/assets/images/placeholder.jpg" width="40" height="40" class="img-circle img-md" alt="">
                </a>

                <div class="media-body media-middle">
                  <a href="user_pages_profile_tabbed.html" class="text-semibold"><?= $i['name']; ?></a>
                  <div class="text-muted text-size-small">
                    Latest order: 2016.12.30
                  </div>
                </div>
              </div>
            </td>
            <td><?= $i['created']; ?></td>
            <td><a href="#"><?= $i['email']; ?></a></td>
            <td><?= $i['phone']; ?></td>
            <td>
              <ul class="list list-unstyled no-margin">
                <li class="no-margin">
                  <i class="icon-infinite text-size-base text-warning position-left"></i>
                  Pending:
                  <a href="#">25 orders</a>
                </li>

                <li class="no-margin">
                  <i class="icon-checkmark3 text-size-base text-success position-left"></i>
                  Processed:
                  <a href="#">34 orders</a>
                </li>
              </ul>
            </td>
            <td>
              <?= $i['group_name']; ?>
            </td>
            <td class="text-right">
              <ul class="icons-list">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-menu7"></i>
                    <span class="caret"></span>
                  </a>

                  <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#"><i class="icon-file-pdf"></i> Edit</a></li>
                    <li><a href="#"><i class="icon-cube2"></i> Detail</a></li>
                    <li class="divider"></li>
                    <li><a href="#" style="color: red;"><i class="fa fa-trash"></i> Hapus</a></li>
                  </ul>
                </li>
              </ul>
            </td>
            <td class="no-padding-left"></td>
          </tr>
        <?php endforeach; ?>

      </tbody>
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

      <form action="<?php echo base_url('user/save') ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <div class="row">
              <div class="col-sm-6" style="margin-bottom: 10px;">
                <label>Nama Pengguna</label>
                <input type="text" name="name" placeholder="" class="form-control">
                <small class="text-danger"><?php echo form_error('name') ?></small>
              </div>

              <div class="col-sm-6" style="margin-bottom: 10px;">
                <label>No Handphone</label>
                <input type="text" name="phone" placeholder="08XX" class="form-control">
                <small class="text-danger"><?php echo form_error('phone') ?></small>
              </div>

              <div class="col-sm-6" style="margin-bottom: 10px;">
                <label>Email</label>
                <input type="email" name="email" placeholder="contoh@gmail.com" class="form-control">
                <small class="text-danger"><?php echo form_error('email') ?></small>
              </div>

              <div class="col-sm-6" style="margin-bottom: 10px;">
                <label>Username</label>
                <input type="text" name="username" placeholder="" class="form-control">
                <small class="text-danger"><?php echo form_error('username') ?></small>
              </div>

              <div class="col-sm-6" style="margin-bottom: 10px;">
                <label>Password</label>
                <input type="password1" name="password1" placeholder="******" class="form-control">
                <small class="text-danger"><?php echo form_error('password1') ?></small>
              </div>

              <div class="col-sm-6" style="margin-bottom: 10px;">
                <label>Ulangi Password</label>
                <input type="password2" name="password2" placeholder="******" class="form-control">
                <small class="text-danger"><?php echo form_error('password2') ?></small>
              </div>

              <div class="col-sm-6" style="margin-bottom: 10px;">
                <label>Hak Akses</label>
                <select data-placeholder="Pilih hak akses pengguna..." class="select select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="group_name">
                  <option></option>
                  <optgroup label="Pilih hak akses pengguna ">
                    <option value="1">Administrator</option>
                    <option value="2">Kasir</option>
                  </optgroup>
                </select>
              </div>

              <div class="col-sm-6">
                <label>Upload Foto</label>
                <input type="file" name="foto" placeholder="Upload Foto" class="form-control">
                <small class="text-danger"><?php echo form_error('foto') ?></small>
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