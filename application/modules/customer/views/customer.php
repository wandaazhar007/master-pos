<!-- Theme JS files -->
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/tables/datatables/extensions/responsive.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>

<script type="text/javascript" src="<?php echo base_url() ?>assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/core/app.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/pages/datatables_responsive.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/pages/form_select2.js"></script>
<!-- /theme JS files -->

<!-- Main content -->
<div class="content-wrapper">
  <?php echo $this->session->flashdata('message') ?>
  <div class="text-danger" style="display: inline;">
    <?php echo form_error('name') ?>
    <?php echo form_error('phone') ?>
    <?php echo form_error('address') ?>
    <?php echo form_error('gender') ?>
    <?php echo form_error('email') ?>
  </div>
  <div class="panel panel-flat">
    <div class="panel-heading" style="text-decoration: none;">
      <button class="tombol-tambah" data-toggle="modal" data-target="#modal_form_pelanggan"><i class="fa fa-plus"></i> &nbsp;Tambah Pelanggan</button>
      <div class="heading-elements">
        <ul class="icons-list">
          <li><a data-action="collapse"></a></li>
          <li><a data-action="reload"></a></li>
          <li><a data-action="close"></a></li>
        </ul>
      </div>
    </div>
    <table class="table datatable-responsive" id="tableCustomer">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Pelanggan</th>
          <th>No Handphone</th>
          <th>Alamat</th>
          <th class="text-center">Aksi</th>
        </tr>
      </thead>
    </table>
  </div>
</div>


<!-- Note: Modal Form Input Customer | Author: wandaazhar@gmail.com -->
<div id="modal_form_pelanggan" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Input Data Pelanggan</h5>
      </div>
      <hr>

      <form action="<?php echo base_url('customer/save') ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <div class="row">
              <div class="col-sm-6" style="margin-bottom: 10px;">
                <label>Nama Pelanggan</label>
                <input type="text" name="name" placeholder="Masukan Nama Pelanggan" class="form-control" required>
                <small class="text-danger"><?php echo form_error('name') ?></small>
              </div>

              <div class="col-sm-6" style="margin-bottom: 10px;">
                <label>No Handphone</label>
                <input type="text" name="phone" placeholder="Masukan No Handphone Pelanggan" class="form-control" required>
                <small class="text-danger"><?php echo form_error('phone') ?></small>
              </div>

              <div class="col-sm-6" style="margin-bottom: 10px;">
                <label>Alamat Email</label>
                <input type="text" name="email" placeholder="Masukan Email Pelanggan" class="form-control" required>
                <small class="text-danger"><?php echo form_error('email') ?></small>
              </div>

              <div class="col-sm-6" style="margin-bottom: 10px;">
                <label>Jenis Kelamin</label>
                <select data-placeholder="Pilih jenis kelamin..." class="select select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="gender">
                  <option></option>
                  <optgroup label="Pilih jenis kelamin">
                    <option value="laki-laki">Laki-Laki</option>
                    <option value="perempuan">Perempuan</option>
                  </optgroup>
                </select>
              </div>

              <div class="col-sm-12">
                <label>Alamat</label>
                <textarea name="address" class="form-control" id="" cols="5" rows="5" placeholder="Masukan alamat pelanggan"></textarea>
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


<!-- Note: Modal Form Edit Customer | Author: wandaazhar@gmail.com -->
<div class="modal fade" id="modal_customer">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Edit Pelanggan</h5>
      </div>
      <div class="modal-body">
        <div id="customer_result"></div>
      </div>
    </div>
  </div>
</div>

<!-- Note: Modal Form Edit Customer | Author: wandaazhar@gmail.com -->
<div class="modal fade" id="modal_delete_customer">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <!-- <h5 class="modal-title">Apakah Anda yakin ?</h5> -->
      </div>
      <div class="modal-body">
        <div id="delete_customer_result"></div>
      </div>
    </div>
  </div>
</div>