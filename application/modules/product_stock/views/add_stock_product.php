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
  .tengah .col-md-6 {
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
  <div class="text-danger" style="display: inline;">
    <?php echo form_error('name') ?>
  </div>
  <div class="panel panel-flat col-md-6">
    <div class="panel-heading" style="text-decoration: none;">
      <div class="heading-elements">
        <ul class="icons-list">
          <li><a data-action="collapse"></a></li>
          <li><a data-action="reload"></a></li>
        </ul>
      </div>
    </div>
    <div class="row">
      <div class="tengah">
        <div class="col-md-6">
          <form action="<?php echo base_url('product_stock/addStockProduct') ?>" method="post">
            <div class="modal-body">
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-12" style="margin-bottom: 10px;">
                    <?php foreach ($getProductById as $i) : ?>
                      <h6 align="center" style="margin-bottom: -25px;"><?= $i['code_product']; ?></h6>
                      <h3 align="center" style="margin-bottom: 10px;"><?= $i['name']; ?></h3>
                      <?php
                      if ($i['stock_now'] <= 10) {
                        echo '<p class="text-center text-danger" style="margin-top: -10px;"> Jumlah stok saat ini ada ' . $i['stock_now'] . '&nbsp;' . $i['name_unit'] . '</p>';
                      } else {
                        echo '<p class="text-center" style="margin-top: -10px;"> Jumlah stok saat ini ada ' . $i['stock_now'] . '&nbsp;' . $i['name_unit'] . '</p>';
                      }
                      ?>

                      <div class="form-group">
                        <input type="hidden" name="idproduct" value="<?php echo $i['idproduct'] ?>" class="form-control" readonly>
                        <input type="hidden" name="code_product" value="<?php echo $i['code_product'] ?>" class="form-control" readonly>
                        <input type="number" name="total" class="form-control" placeholder="Masukan jumlah stok disini" required>
                      </div>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer" style="text-align: center;">
              <a href="<?php echo base_url('product/dataProduct') ?>"><button type="button" class="tombol-modal-hapus"><i class="fa fa-arrow-circle-left"></i>&nbsp; Cancel</button></a>
              <button type="submit" class="tombol-tambah"><i class="fa fa-save"></i>&nbsp; Tambah Stok</button>
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