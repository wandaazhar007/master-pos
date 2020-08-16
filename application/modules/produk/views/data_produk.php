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
    <?php echo form_error('idproduct_category') ?>
    <?php echo form_error('idproduct_unit') ?>
    <?php echo form_error('price') ?>
    <?php echo form_error('persentase') ?>
    <?php echo form_error('price_selling') ?>
  </div>
  <div class="panel panel-flat">
    <div class="panel-heading" style="text-decoration: none;">
      <button class="tombol-tambah" data-toggle="modal" data-target="#modal_form_data_produk"><i class="fa fa-plus"></i> &nbsp;Tambah Produk</button>
      <div class="heading-elements">
        <ul class="icons-list">
          <li><a data-action="collapse"></a></li>
          <li><a data-action="reload"></a></li>
          <li><a data-action="close"></a></li>
        </ul>
      </div>
    </div>
    <table class="table datatable-responsive" id="tableDataProduk">
      <thead>
        <tr>
          <th>No</th>
          <th>Kode Barcode</th>
          <th>Nama Produk</th>
          <th>Harga Asli</th>
          <th>Persentase</th>
          <th>Harga Jual</th>
          <th>Kategori</th>
          <th>Satuan</th>
          <th>Deskripsi</th>
          <th class="text-center">Aksi</th>
        </tr>
      </thead>
    </table>
  </div>
</div>


<!-- Note: Modal Form Input Customer | Author: wandaazhar@gmail.com -->
<div id="modal_form_data_produk" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Input Data Produk</h5>
      </div>
      <hr>

      <form action="<?php echo base_url('produk/save') ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <div class="row">
              <div class="col-sm-6" style="margin-bottom: 10px;">
                <label>Nama Produk</label>
                <input type="text" name="name" placeholder="Masukan Nama Produk" class="form-control" required>
                <small class="text-danger"><?php echo form_error('name') ?></small>
              </div>

              <div class="col-sm-3" style="margin-bottom: 10px;">
                <label>Kode Barcode</label>
                <input type="text" name="barcode" class="form-control" value="<?php echo 'AZ-' . $getBarcode ?>" required readonly>
                <small class="text-danger"><?php echo form_error('barcode') ?></small>
              </div>

              <div class="col-sm-3">
                <label>Persentase</label>
                <input type="number" name="barcode" class="form-control" placeholder="0%" required>
                <small class="text-danger"><?php echo form_error('barcode') ?></small>
              </div>


              <div class="col-sm-6" style="margin-bottom: 10px;">
                <label>Harga Asli</label>
                <input type="text" name="price" placeholder="Rp. ..." class="form-control" required>
                <small class="text-danger"><?php echo form_error('price') ?></small>
              </div>

              <div class="col-sm-6" style="margin-bottom: 10px;">
                <label>Harga Jual</label>
                <input type="text" name="price" placeholder="Rp. ..." class="form-control" required readonly>
                <small class="text-danger"><?php echo form_error('price_selling') ?></small>
              </div>

              <div class="col-sm-6" style="margin-bottom: 10px;">
                <label>Kategori Produk</label>
                <select data-placeholder="Pilih Kategori Produk..." class="select select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="gender">
                  <option></option>
                  <optgroup label="Pilih Kategori Produk">
                    <option value="laki-laki">Laki-Laki</option>
                  </optgroup>
                </select>
              </div>

              <div class="col-sm-6" style="margin-bottom: 10px;">
                <label>Kategori Produk</label>
                <select data-placeholder="Pilih Kategori Produk..." class="select select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="gender">
                  <option></option>
                  <optgroup label="Pilih Kategori Produk">
                    <option value="laki-laki">Laki-Laki</option>
                  </optgroup>
                </select>
              </div>

              <div class="col-sm-12">
                <label>Keterangan</label>
                <textarea name="address" class="form-control" id="" cols="5" rows="5" placeholder="Masukan keterangan produk"></textarea>
                <small class="text-danger"><?php echo form_error('description') ?></small>
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
        <h5 class="modal-title">Edit Data Produk</h5>
      </div>
      <div class="modal-body">
        <div id="data_produk_result"></div>
      </div>
    </div>
  </div>
</div>

<!-- Note: Modal Form Edit Customer | Author: wandaazhar@gmail.com -->
<div class="modal fade" id="modal_delete_data_produk">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <!-- <h5 class="modal-title">Apakah Anda yakin ?</h5> -->
      </div>
      <div class="modal-body">
        <div id="delete_data_produk_result"></div>
      </div>
    </div>
  </div>
</div>