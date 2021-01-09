<!-- Theme JS files -->
<script type="text/javascript" src="<?php echo base_url() ?>assets/select2/css/select2.min.css"></script>

<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/tables/datatables/extensions/responsive.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/select2/js/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/core/app.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/pages/datatables_responsive.js"></script>
<style>

</style>
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
                    <input type="hidden" name="id_transaction" value="<?php echo $this->wandalibs->getIdTransaction() ?>">
                    <input type="hidden" name="code_transaction" value="<?php echo $this->wandalibs->getCodeTransaction(date('dmyhi')) ?>">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Nama Produk</label>
                        <select class="select2 form-control" name="idproduct" required></select>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <div id="div_selling_price"></div>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <label>Jumlah</label>
                      <input type="number" name="qty" id="qty" placeholder="0" class="form-control" min="1" value="1">
                    </div>
                    <div class="col-md-4" style="margin-top: 25px;">
                      <button type="submit" class="tombol-tambah"><i class="fa fa-plus"></i>&nbsp; Tambah</button>
                      <a href="<?php echo base_url('transaction/bayar') ?>"><button type="button" class="tombol-tambah"><i class="fa fa-money"></i>&nbsp; Bayar</button></a>
                      <a href="<?php echo base_url('transaction/resetTransaction') ?>"><button type="button" class="tombol-modal-hapus" data-dismiss="modal"><i class="fa fa-refresh"></i>&nbsp;Reset</button></a>
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
  $(function() {
    $('.select2').select2({
      // multiple: true,
      selectOnClose: true,
      minimumInputLength: 3,
      allowClear: true,
      placeholder: "masukkan nama produk",
      ajax: {
        dataType: "json",
        url: "<?php echo base_url() ?>/transaction/getProduct",
        delay: 250,
        data: function(params) {
          return {
            search: params.term
          }
        },
        processResults: function(data) {
          return {
            results: data,
          };
        },
        templateSelection: function(data, container) {
          // Add custom attributes to the <option> tag for the selected option
          $(data.element).attr('data-custom-attribute', data.customValue);
          return data.text;
        },
      }
    }).on('select2:select', function(evt) {
      var data = $(".select2 option:selected").text();
      // var harga = $(".select2 option:selected").val();
      var harga = $(".select2 option:selected").val();
      // $("#div_selling_price").attr("name", "selling_price");
      $("#div_selling_price").append("<input class='form-control' name='selling_price' value=" + harga + ">");

      console.log(data);
      // alert("Produk yang dipilih adalah " + data);
    });

    $('#mySelect2').find(':selected').data('harga');

  });
</script>

<script type="text/javascript">
  // var product = document.getElementById('product');
  // var harga = document.getElementById('harga');

  // function getSelectedOptionProduct(harga) {
  //   var opt;
  //   for (var i = 0, len = harga.options.length; i < len; i++) {
  //     opt = harga.options[i];
  //     if (opt.selected === true) {
  //       break;
  //     }
  //   }
  //   return opt;
  // }

  // product.addEventListener('change', function() {
  //   console.log('test');
  //   harga.value = product.value;
  // })


  // const div_selling_price = document.getElementById('div_selling_price');
  // const qty = document.getElementById('qty');
  // // const select_product = document.getElementById('select_product').value;


  // function addProduct() {
  //   const select_product = document.getElementById('select_product');
  //   const tagHarga = document.createElement('input');
  //   // const harga = document.getAttribute('value');
  //   tagHarga.setAttribute('class', 'form-control');
  //   tagHarga.setAttribute('readonly', '');
  //   tagHarga.setAttribute('readonly', '');
  //   tagHarga.setAttribute('value', );
  //   // const harga = select_product.getAttribute('value');
  //   console.log(tagHarga);

  //   const formTambah = document.getElementById('form-tambah');
  //   formTambah.appendChild(tagHarga);
  // }
</script>