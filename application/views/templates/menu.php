<div class="navbar navbar-default" id="navbar-second">
  <ul class="nav navbar-nav no-border visible-xs-block">
    <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-menu7"></i></a></li>
  </ul>

  <div class="navbar-collapse collapse" id="navbar-second-toggle">
    <ul class="nav navbar-nav">
      <li class="active">
        <a href="<?php echo base_url() ?>"><i class="icon-display4 position-left"></i> Dashboard</a>
      </li>

      <li class="dropdown mega-menu mega-menu-wide">
        <a href="<?php echo base_url('supplier') ?>"><i class="fa fa-car position-left"></i>Supplier</a>
      </li>

      <li class="dropdown mega-menu mega-menu-wide">
        <a href="<?php echo base_url('customer') ?>"><i class="fa fa-user position-left"></i>Pelanggan</a>
      </li>

      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-gift position-left"></i>Produk <span class="caret"></span>
        </a>
        <ul class="dropdown-menu width-250">
          <li><a href="<?php echo base_url('product/dataProduct') ?>"><i class="icon-align-center-horizontal"></i>Data Semua Produk</a></li>
          <li><a href="<?php echo base_url('product_category') ?>"><i class="icon-align-center-horizontal"></i>Kategori Produk</a></li>
          <li><a href="<?php echo base_url('product_unit') ?>"><i class="icon-flip-vertical3"></i>Satuan Produk</a></li>
        </ul>
      </li>



      <li class="active">
        <a href="<?php echo base_url('transaction') ?>"><i class="fa fa-money position-left"></i>Transaksi</a>
      </li>


      <li class="dropdown mega-menu mega-menu-wide">
        <a href="<?php echo base_url('product_stock') ?>"><i class="fa fa-history position-left"></i>Riwayat Stok</a>
      </li>

      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-file position-left"></i>Laporan<span class="caret"></span>
        </a>

        <ul class="dropdown-menu width-200">
          <li class="dropdown-header">Laporan Penjualan</li>
          <li><a href="<?php echo base_url('report_transaction') ?>">Laporan Penjualan</a></li>
          <li><a href="<?php echo base_url('laporan/labaRugi') ?>">Laporan Laba Rugi</a></li>
          <li class="dropdown-header">Laporan Stok</li>
          <li><a href="<?php echo base_url('report_stock_in') ?>">Stok Masuk</a></li>
          <li><a href="<?php echo base_url('report_stock_out') ?>">Stok Keluar</a></li>
        </ul>
      </li>
    </ul>

    <ul class="nav navbar-nav navbar-right">
      <li>
        <a href="#">
          <i class="icon-history position-left"></i>
          Log
          <span class="label label-inline position-right bg-success-400">1.6</span>
        </a>
      </li>

      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="icon-cog3"></i>
          <span class="visible-xs-inline-block position-right">Share</span>
          <span class="caret"></span>
        </a>

        <ul class="dropdown-menu dropdown-menu-right">
          <li><a href="<?= base_url('user'); ?>"><i class="icon-user"></i>Pengguna</a></li>
          <li><a href="<?= base_url('options'); ?>"><i class="icon-gear"></i>Options</a></li>
        </ul>
      </li>
    </ul>
  </div>
</div>