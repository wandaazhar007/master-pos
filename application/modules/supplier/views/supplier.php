<!-- /core JS files -->

<!-- Theme JS files -->
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/tables/datatables/extensions/responsive.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>

<script type="text/javascript" src="<?php echo base_url() ?>assets/js/core/app.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/pages/datatables_responsive.js"></script>
<!-- /theme JS files -->

<!-- Main content -->
<div class="content-wrapper">
  <?php echo $this->session->flashdata('message') ?>
  <div class="text-danger" style="display: inline;">
    <?php echo form_error('name') ?>
    <?php echo form_error('phone') ?>
    <?php echo form_error('address') ?></div>
  <div class="panel panel-flat">
    <div class="panel-heading" style="text-decoration: none;">
      <button class="tombol-tambah" data-toggle="modal" data-target="#modal_form_vertical"><i class="fa fa-plus"></i> &nbsp;Tambah Supplier</button>
      <div class="heading-elements">
        <ul class="icons-list">
          <li><a data-action="collapse"></a></li>
          <li><a data-action="reload"></a></li>
          <li><a data-action="close"></a></li>
        </ul>
      </div>
    </div>
    <table class="table datatable-responsive" id="tableSupplier">
      <thead>
        <tr>
          <th style="width: 10px;">No</th>
          <th style="width: 10px;">Nama Supplier</th>
          <th style="width: 10px;">No Handphone</th>
          <th style="width: 10px;">Email</th>
          <th style="width: 10px;">Alamat</th>
          <th class="text-center" style="width: 500px;">Aksi</th>
        </tr>
      </thead>
    </table>
  </div>
</div>


<!-- Note: Modal Form Input Supplier | Author: wandaazhar@gmail.com -->
<div id="modal_form_vertical" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Input Data Supplier</h5>
      </div>
      <hr>

      <form action="<?php echo base_url('supplier/save') ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <div class="row">
              <div class="col-sm-6">
                <label>Nama Supplier</label>
                <input type="text" name="name_supplier" placeholder="Masukan Nama Supplier" class="form-control" required>
                <small class="text-danger"><?php echo form_error('name_supplier') ?></small>
              </div>

              <div class="col-sm-6">
                <label>No Handphone</label>
                <input type="text" name="phone" placeholder="Masukan No Handphone Supplier" class="form-control" required>
                <small class="text-danger"><?php echo form_error('phone') ?></small>
              </div>

              <div class="col-sm-6">
                <label>Email</label>
                <input type="text" name="email" placeholder="Masukan Email Supplier" class="form-control" required>
                <small class="text-danger"><?php echo form_error('email') ?></small>
              </div>

              <div class="col-sm-12">
                <label>Deskripsi</label>
                <textarea name="description" class="form-control" id="" cols="5" rows="5" placeholder="Isi deskripsi supplier (jika diperlukan)"></textarea>
                <small class="text-danger"><?php echo form_error('description') ?></small>
              </div>

              <div class="col-sm-12">
                <label>Alamat</label>
                <textarea name="address" class="form-control" id="" cols="5" rows="5" placeholder="Ketikan Alamat kantor supplier"></textarea>
                <small class="text-danger"><?php echo form_error('address') ?></small>
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


<!-- Note: Modal Form Edit Supplier | Author: wandaazhar@gmail.com -->
<div class="modal fade" id="modal_supplier">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Edit Supplier</h5>
      </div>
      <div class="modal-body">
        <div id="supplier_result"></div>
      </div>
    </div>
  </div>
</div>

<!-- Note: Modal Form Edit Supplier | Author: wandaazhar@gmail.com -->
<div class="modal fade" id="modal_delete_supplier">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <!-- <h5 class="modal-title">Apakah Anda yakin ?</h5> -->
      </div>
      <div class="modal-body">
        <div id="delete_supplier_result"></div>
      </div>
    </div>
  </div>
</div>