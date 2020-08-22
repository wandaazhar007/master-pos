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
<style>
  .tengah .col-md-3 {
    background-color: #eaeaea;
    margin-left: 400px;
    margin-bottom: 40px;
  }
</style>
<!-- Main content -->
<div class="content-wrapper">
  <?php echo $this->session->flashdata('message') ?>
  <div class="text-danger" style="display: inline;">
    <?php echo form_error('name') ?>
  </div>
  <div class="panel panel-flat">
    <div class="panel-heading" style="text-decoration: none;">
      <div class="heading-elements">
        <ul class="icons-list">
          <li><a data-action="collapse"></a></li>
          <li><a data-action="reload"></a></li>
          <li><a data-action="close"></a></li>
        </ul>
      </div>
    </div>
    <div class="row">
      <div class="tengah">
        <div class="col-md-3">
          <form action="<?php echo base_url('product_stock/save') ?>" method="post">
            <div class="modal-body">
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-12" style="margin-bottom: 10px;">
                    <?php foreach ($getProductById as $i) : ?>
                      <h6 align="center" style="margin-bottom: -25px;"><?= $i['barcode']; ?></h6>
                      <h3 align="center" style="margin-bottom: 10px;"><?= $i['name']; ?></h3>
                      <div class="form-group">
                        <input type="hidden" name="idproduct" value="<?php echo $i['idproduct'] ?>" class="form-control" readonly>
                        <input type="number" name="total" class="form-control" placeholder="Masukan jumlah stok disini" required>
                      </div>

                      <div class="form-group">
                        <select class="select-search select2-hidden-accessible" data-placeholder="Pilih Supplier" tabindex="-1" aria-hidden="true" name="idsupplier">
                          <optgroup label="Pilih Kategory Produk">
                            <option value=""></option>
                            <?php foreach ($getAllSupplier as $i) : ?>
                              <option value="<?php echo $i['idsupplier'] ?>"><?= $i['name']; ?></option>
                            <?php endforeach; ?>
                          </optgroup>
                        </select>
                      </div>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer" style="text-align: center;">
              <a href="<?php echo base_url('product/dataProduct') ?>"><button type="button" class="tombol-modal-hapus"><i class="fa fa-arrow-circle-left"></i>&nbsp; Cancel</button></a>
              <button type="submit" class="tombol-tambah"><i class="fa fa-save"></i>&nbsp; Simpan</button>
            </div>
          </form>
        </div>
      </div>

      <!-- <div class="col-md-6">
        <table class="table datatable-responsive" id="tableProductStockMasuk">
          <thead>
            <tr>
              <th style="width: 10px;">No</th>
              <th>Tanggal</th>
              <th>Kode Barcode</th>
              <th>Nama Produk</th>
              <th>Nama Supplier</th>
              <th>Stock</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
        </table>
      </div> -->

    </div>
  </div>
</div>