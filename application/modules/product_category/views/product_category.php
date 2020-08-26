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
    <?php echo form_error('name_category') ?>
  </div>
  <div class="panel panel-flat">
    <div class="panel-heading" style="text-decoration: none;">
      <button class="tombol-tambah" data-toggle="modal" data-target="#modal_form_pelanggan"><i class="fa fa-plus"></i> &nbsp;Tambah Kategori</button>
      <div class="heading-elements">
        <ul class="icons-list">
          <li><a data-action="collapse"></a></li>
          <li><a data-action="reload"></a></li>
          <li><a data-action="close"></a></li>
        </ul>
      </div>
    </div>
    <table class="table datatable-responsive" id="tableProductCategory">
      <thead>
        <tr>
          <th style="width: 10px;">No</th>
          <th>Kategori Produk</th>
          <th style="text-align: center; width: 200px">Tanggal</th>
          <th style="text-align: center; width: 200px">Aksi</th>
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
        <h5 class="modal-title">Input Kategori</h5>
      </div>
      <hr>

      <form action="<?php echo base_url('product_category/save') ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <div class="row">
              <div class="col-sm-12" style="margin-bottom: 10px;">
                <label>Nama Kategori</label>
                <input type="text" name="name_category" placeholder="Masukan Nama Kategori Produk" class="form-control" required>
                <small class="text-danger"><?php echo form_error('name_category') ?></small>
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
<div class="modal fade" id="modal_product_category">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Edit Kategori Produk</h5>
      </div>
      <div class="modal-body">
        <div id="product_category_result"></div>
      </div>
    </div>
  </div>
</div>

<!-- Note: Modal Form Edit Customer | Author: wandaazhar@gmail.com -->
<div class="modal fade" id="modal_delete_product_category">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <!-- <h5 class="modal-title">Apakah Anda yakin ?</h5> -->
      </div>
      <div class="modal-body">
        <div id="delete_product_category_result"></div>
      </div>
    </div>
  </div>
</div>