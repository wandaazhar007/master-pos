<!-- Theme JS files -->
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/tables/datatables/extensions/responsive.min.js"></script>
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
    <!-- <div id="hj"></div> -->

    <table class="table datatable-responsive" id="tableDataProduk">
      <thead>
        <tr>
          <th>No</th>
          <th>Barcode</th>
          <th>Nama Produk</th>
          <th>Harga Asli</th>
          <th>Margin</th>
          <th>Harga Jual</th>
          <th>Kategori</th>
          <th>Satuan</th>
          <th>Stok</th>
          <th class="text-center">Aksi</th>
        </tr>
      </thead>
    </table>
  </div>
</div>




<!-- Note: Modal Form Input product | Author: wandaazhar@gmail.com -->
<div id="modal_form_data_produk" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Input Data Produk</h5>
      </div>
      <hr>

      <form action="<?php echo base_url('product/save') ?>" method="post">
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
                <input type="text" name="code_product" class="form-control" value="<?php echo 'AZ-' . $this->wandalibs->getBarcode() ?>" required readonly>
                <small class="text-danger"><?php echo form_error('code_product') ?></small>
              </div>

              <div class="col-sm-3">
                <label>Persentase</label>
                <input type="number" name="persentase" id="persentase" class="form-control" placeholder="0%" required>
                <small class="text-danger"><?php echo form_error('persentase') ?></small>
              </div>


              <div class="col-sm-6" style="margin-bottom: 10px;">
                <label>Harga Asli</label>
                <input type="text" name="buying_price" id="buying_price" placeholder="Rp. ..." class="form-control" required>
                <small class="text-danger"><?php echo form_error('buying_price') ?></small>
              </div>

              <div class="col-sm-6" style="margin-bottom: 10px;">
                <label>Harga Jual</label>
                <input type="text" name="selling_price" id="selling_price" placeholder="Rp. ..." class="form-control" readonly>
                <small class="text-danger"><?php echo form_error('selling_price') ?></small>
              </div>

              <div class="col-sm-6" style="margin-bottom: 10px;">
                <div class="form-group">
                  <label>Kategori Produk</label>
                  <select class="select-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="idcategory">
                    <optgroup label="Pilih Kategory Produk">
                      <option value=""></option>
                      <?php foreach ($getCategoryProduct as $i) : ?>
                        <option value="<?php echo $i['idcategory'] ?>"><?= $i['name_category']; ?></option>
                      <?php endforeach; ?>
                    </optgroup>
                  </select>
                </div>
              </div>

              <div class="col-sm-6" style="margin-bottom: 10px;">
                <div class="form-group">
                  <label>Satuan Produk</label>
                  <select class="select-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="idunit">
                    <optgroup label="Pilih Satuan Produk">
                      <option value=""></option>
                      <?php foreach ($getUnitProduct as $i) : ?>
                        <option value="<?php echo $i['idunit'] ?>"><?= $i['name_unit']; ?></option>
                      <?php endforeach; ?>
                    </optgroup>
                  </select>
                </div>
              </div>

              <div class="col-sm-12">
                <label>Keterangan</label>
                <textarea name="description" class="form-control" id="" cols="5" rows="5" placeholder="Masukan keterangan produk (Jika diperlukan)"></textarea>
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


<!-- Note: Modal Form Edit Data Produk | Author: wandaazhar@gmail.com -->
<div class="modal fade" id="modal_product">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Edit Data Produk</h5>
      </div>
      <div class="modal-body">
        <div id="product_result"></div>
      </div>
    </div>
  </div>
</div>

<!-- Note: Modal Form Edit Produk | Author: wandaazhar@gmail.com -->
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

<script>
  document.getElementById('buying_price').addEventListener('keyup', function() {
    const buying_price = parseInt(document.getElementById('buying_price').value);
    const persentase = parseInt(document.getElementById('persentase').value);
    const selling_price = document.getElementById('selling_price');

    const result1 = (buying_price * persentase) / 100;
    const result2 = result1 + buying_price;
    const result3 = Math.round(result2);

    selling_price.setAttribute('value', result3);
    // hj.innerHTML = result2;
    // const inputHargaJual = document.createElement('input');
    // const teks = document.createTextNode('coba create element');
    // inputHargaJual.appendChild(teks);
    // const posisi = document.getElementById('hj');
    // posisi.appendChild(inputHargaJual);
    // console.log(inputHargaJual);

  })

  document.getElementById('persentase').addEventListener('keyup', function() {
    const buying_price = parseInt(document.getElementById('buying_price').value);
    const persentase = parseInt(document.getElementById('persentase').value);
    const selling_price = document.getElementById('selling_price');

    const result1 = (buying_price * persentase) / 100;
    const result2 = result1 + buying_price;
    const result3 = Math.round(result2);

    selling_price.setAttribute('value', result3);
    // hj.innerHTML = result2;
    // const inputHargaJual = document.createElement('input');
    // const teks = document.createTextNode('coba create element');
    // inputHargaJual.appendChild(teks);
    // const posisi = document.getElementById('hj');
    // posisi.appendChild(inputHargaJual);
    // console.log(inputHargaJual);
  })
</script>