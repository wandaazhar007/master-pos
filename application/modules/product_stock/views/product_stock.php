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
  </div>
  <div class="panel panel-flat">
    <div class="panel-heading" style="text-decoration: none;">
      <button class="tombol-tambah" data-toggle="modal" data-target="#modal_form_product_stock"><i class="fa fa-plus"></i> &nbsp;Tambah Stok Produk</button>
      <div class="heading-elements">
        <ul class="icons-list">
          <li><a data-action="collapse"></a></li>
          <li><a data-action="reload"></a></li>
          <li><a data-action="close"></a></li>
        </ul>
      </div>
    </div>
    <table class="table datatable-responsive" id="tableProductStockMasuk">
      <thead>
        <tr>
          <th>No</th>
          <th>Tanggal</th>
          <th>Kode Barcode</th>
          <th>Nama Produk</th>
          <th>Keterangan</th>
          <th>Nama Supplier</th>
          <th>Stock</th>
          <th class="text-center">Aksi</th>
        </tr>
      </thead>
    </table>
  </div>
</div>

<!-- Note: Modal Form Input Stok Produk | Author: wandaazhar@gmail.com -->
<div id="modal_form_product_stock" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Input Stok Masuk</h5>
      </div>
      <hr>

      <form action="<?php echo base_url('product_stock/save') ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <div class="row">
              <div class="col-sm-6" style="margin-bottom: 10px;">
                <div class="form-group">
                  <label>Nama Produk</label>
                  <select class="select-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="name">
                    <optgroup label="Pilih Nama Produk">
                      <?php foreach ($getProduct as $i) : ?>
                        <option value=""></option>
                        <option value="<?php echo $i['name'] ?>"><?= $i['name']; ?></option>
                      <?php endforeach; ?>
                    </optgroup>
                  </select>
                </div>
              </div>


              <div class="col-sm-6" style="margin-bottom: 10px;">
                <div class="form-group">
                  <label>Detail</label>
                  <select class="select-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="name">
                    <optgroup label="Pilih jenis stok">
                      <option value="">Penambahan Stok</option>
                      <option value="">Lain-Lain</option>
                    </optgroup>
                  </select>
                </div>
              </div>

              <div class="col-sm-6" style="margin-bottom: 10px;">
                <div class="form-group">
                  <label>Supplier</label>
                  <select class="select-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="supplier">
                    <optgroup label="Pilih Nama Supplier">
                      <?php foreach ($getSupplier as $i) : ?>
                        <option value=""></option>
                        <option value="<?php echo $i['idsupplier'] ?>"><?= $i['name']; ?></option>
                      <?php endforeach; ?>
                    </optgroup>
                  </select>
                </div>
              </div>

              <div class="col-sm-3" style="margin-bottom: 10px;">
                <label>Jumlah</label>
                <input type="number" name="jumlah" placeholder="0" class="form-control">
                <small class="text-danger"><?php echo form_error('price_selling') ?></small>
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
<div class="modal fade" id="modal_product_stock">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Edit Stok Produk</h5>
      </div>
      <div class="modal-body">
        <div id="product_stock_result"></div>
      </div>
    </div>
  </div>
</div>

<!-- Note: Modal Form Edit Customer | Author: wandaazhar@gmail.com -->
<div class="modal fade" id="modal_delete_product_stock">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <!-- <h5 class="modal-title">Apakah Anda yakin ?</h5> -->
      </div>
      <div class="modal-body">
        <div id="delete_product_stock_result"></div>
      </div>
    </div>
  </div>
</div>