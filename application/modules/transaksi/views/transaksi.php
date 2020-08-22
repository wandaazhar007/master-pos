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

<!-- Main charts -->
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
            <form action="<?php echo base_url('transaksi/tambah') ?>" method="post">
              <div class="modal-body">
                <div class="form-group">
                  <div class="row">

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Nama Produk</label>
                        <select class="select-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="idproduct">
                          <optgroup label="Pilih Nama Produk">
                            <?php foreach ($getProduct as $i) : ?>
                              <option value=""></option>
                              <option value="<?php echo $i['idproduct'] ?>"><?= $i['name']; ?></option>
                            <?php endforeach; ?>
                          </optgroup>
                        </select>
                        <small class="text-danger"><?php echo form_error('name') ?></small>
                      </div>
                    </div>

                    <div class="col-sm-2">
                      <label>Jumlah</label>
                      <input type="number" name="qty" placeholder="0" class="form-control">
                      <input type="text" name="idtransaction_group" value="<?php echo $getIdTransactionGroup['id_trans'] + 1 ?>" readonly placeholder="0" class="form-control">
                      <small class="text-danger"><?php echo form_error('qty') ?></small>
                    </div>
                    <div class="col-sm-4" style="margin-top: 25px;">
                      <button type="submit" class="tombol-tambah"><i class="fa fa-plus"></i>&nbsp; Tambah</button>
                      <a href="<?php echo base_url('transaksi/bayar') ?>"><button type="button" class="tombol-tambah"><i class="fa fa-money"></i>&nbsp; Bayar</button></a>
                      <button type="button" class="tombol-modal-hapus" data-dismiss="modal"><i class="fa fa-refresh"></i>&nbsp;Reset</button>
                    </div>

                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <!-- <button type="button" class="tombol-modal-hapus" data-dismiss="modal">Close</button>
                <button type="submit" class="tombol-tambah"><i class="fa fa-save"></i>&nbsp; Simpan</button> -->
              </div>
            </form>
          </div>

        </div>
      </div>

      <div class="position-relative" id="traffic-sources"></div>
    </div>
    <!-- /traffic sources -->

  </div>

  <div class="col-lg-4">
    <div class="panel panel-flat">
      <div class="panel-heading">
        <!-- <h5 class="panel-title">List Produk</h5> -->
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
            <td style="padding: 10px;">AZ-<?php echo $getIdTransactionGroup['id_trans'] ?></td>
          </tr>
        </table>
      </div>

      <!-- <table class="table datatable-responsive">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Qty</th>
            <th>Diskon</th>
            <th>Total</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Marth</td>
            <td><a href="#">Enright</a></td>
            <td>Traffic Court Referee</td>
            <td>22 Jun 1972</td>
            <td><span class="label label-success">Active</span></td>
            <td class="text-center">
              <span class="label label-success">Active</span>
            </td>
            <td class="text-center">
              <span class="label label-success">Active</span>
            </td>
          </tr>

        </tbody>
      </table> -->
    </div>

  </div>
</div>



<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-flat">
      <div class="panel-heading">
        <!-- <h5 class="panel-title">List Produk</h5> -->
        <div class="heading-elements">
          <ul class="icons-list">
            <li><a data-action="collapse"></a></li>
            <li><a data-action="reload"></a></li>
          </ul>
        </div>
      </div>

      <table class="table datatable-responsive">
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
              <td></td>
              <td>22 Jun 1972</td>
              <td><span class="label label-success">Active</span></td>
              <td class="text-center">
                <span class="label label-success">Active</span>
              </td>
              <td class="text-center">
                <span class="label label-success">Active</span>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

  </div>
</div>