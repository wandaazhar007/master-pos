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

<div class="row">
  <div class="col-lg-8">
    <div class="panel panel-flat">
      <div class="panel-heading">
        <div class="heading-elements">
          <ul class="icons-list">
            <li><a data-action="collapse"></a></li>
            <li><a data-action="reload"></a></li>
          </ul>
        </div>
      </div>

      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <form action="<?php echo base_url('transaction/tambah') ?>" method="post">
              <div class="modal-body">
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-6" id="form-tambah">
                      <div class="form-group">
                        <label>Nama Produk</label>
                        <select class="select-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="idproduct" onchange="addProduct()">
                          <optgroup label="Pilih Nama Produk">
                            <option value=""></option>
                            <?php foreach ($getProduct as $i) : ?>
                              <option value="<?php echo $i['idproduct'] ?>" value_harga="<?php echo $i['selling_price'] ?>" class="option_harga"><?= $i['name']; ?></option>
                            <?php endforeach; ?>
                          </optgroup>
                        </select>
                        <small class="text-danger"><?php echo form_error('name') ?></small>
                      </div>
                    </div>

                    <div id="selling_price"></div>

                    <div class="col-sm-2">
                      <label>Jumlah</label>
                      <input type="number" name="qty" id="qty" placeholder="0" class="form-control" min="1" value="1">
                      <small class="text-danger"><?php echo form_error('qty') ?></small>
                    </div>
                    <div class="col-sm-4" style="margin-top: 25px;">
                      <button type="submit" class="tombol-tambah"><i class="fa fa-plus"></i>&nbsp; Tambah</button>
                      <a href="<?php echo base_url('transaction/bayar') ?>"><button type="button" class="tombol-tambah"><i class="fa fa-money"></i>&nbsp; Bayar</button></a>
                      <button type="button" class="tombol-modal-hapus" data-dismiss="modal"><i class="fa fa-refresh"></i>&nbsp;Reset</button>
                    </div>

                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="panel panel-flat">
      <div class="panel-heading">
        <div class="heading-elements">
          <ul class="icons-list">
            <li><a data-action="collapse"></a></li>
            <li><a data-action="reload"></a></li>
          </ul>
        </div>
        <table style="padding: 10px;">
          <tr>
            <td style="padding: 10px;">No Nota</td>
            <td style="padding: 10px;">:</td>
            <td style="padding: 10px;"><?php echo $this->wandalibs->getCodeTransaction(date('dmyhi')) ?></td>

          </tr>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <?php echo $this->session->flashdata('message') ?>
  <div class="col-lg-12">
    <div class="panel panel-flat">
      <table class="table datatable-responsive" id="list-transaction">
        <thead>
          <tr>
            <th style="width: 5px;">No</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Qty</th>
            <th>Diskon</th>
            <th>Total</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($getAddProduct as $i) : ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><a href="#"><?= $i['name']; ?></a></td>
              <td><?php echo $i['selling_price'] ?></td>
              <td><?= $i['qty']; ?></td>
              <td><?= $i['discount']; ?></td>
              <td></td>
              <td>
                <a href="#">
                  <button class="tombol-hapus view_hapus pull-right" id="<?= $i['idtemp_transaction']; ?>"><i class="fa fa-trash"></i>&nbsp;hapus</button>
                </a>
                <a href="#">
                  <button style="margin-right: 5px;" class="tombol-edit view_edit_transaction pull-right" id="<?= $i['idtemp_transaction']; ?>"><i class="fa fa-pencil"></i>&nbsp;edit</button>
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Note: Modal Form Edit transaksi | Author: wandaazhar@gmail.com -->
<div class="modal fade" id="modal_edit_transaction">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Edit pengguna</h5>
      </div>
      <div class="modal-body">
        <div id="edit_transaction_result"></div>
      </div>
    </div>
  </div>
</div>


<!-- Note: Modal Delete list transaksi | Author: wandaazhar@gmail.com -->
<div class="modal fade" id="modal_delete_list_transaction">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <!-- <h5 class="modal-title">Apakah Anda yakin ?</h5> -->
      </div>
      <div class="modal-body">
        <div id="delete_list_transaction_result"></div>
      </div>
    </div>
  </div>
</div>

<script>
  const selling_price = document.getElementById('selling_price');
  // const idproduct = document.getElementById('idproduct');

  // function ambilHarga() {
  //   console.log('test');
  // }

  // idproduct.addEventListener('change', tambah());
  qty.addEventListener("change", function() {
    // result_qty.innerHTML = qty.value;
    console.log('tester qty');
  });

  function addProduct() {
    const option_harga = document.querySelectorAll('.option_harga')
    const tagHarga = document.createElement('input');
    tagHarga.setAttribute('class', 'form-control');
    const harga = option_harga.getAttribute('value');
    tagHarga.setAttribute('value', harga);
    // const attributeTagHarga = document.createTextNode('Harga Product');
    // tagHarga.appendChild(attributeTagHarga);

    const formTambah = document.getElementById('form-tambah');
    formTambah.appendChild(tagHarga);

    // selling_price.createElement('h1');
    // selling_price.innerHTML = 'test';
  }

  function ambilHarga() {
    // tagHarga.setAttribute = option_harga.getAttribute("value_harga");
    // tagHarga.setAttribute = option_harga.setAttribute("value", "value_harga");
  }
</script>