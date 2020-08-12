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
        <a href="<?php echo base_url('supplier') ?>">Supplier</a>
      </li>

      <li class="dropdown mega-menu mega-menu-wide">
        <a href="<?php echo base_url('pelanggan') ?>">Pelanggan</a>
      </li>

      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="icon-make-group position-left"></i>Produk <span class="caret"></span>
        </a>
        <ul class="dropdown-menu width-250">
          <li><a href="<?php echo base_url('produk/dataProduk') ?>"><i class="icon-align-center-horizontal"></i>Data Produk</a></li>
          <li><a href="<?php echo base_url('produk/kategoriProduk') ?>"><i class="icon-align-center-horizontal"></i>Kategori Produk</a></li>
          <li><a href="<?php echo base_url('produk/satuanProduk') ?>"><i class="icon-flip-vertical3"></i>Satuan Produk</a></li>
        </ul>
      </li>

      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="icon-make-group position-left"></i>Stok <span class="caret"></span>
        </a>
        <ul class="dropdown-menu width-250">
          <li><a href="<?php echo base_url('stok/stokMasuk') ?>"><i class="icon-align-center-horizontal"></i>Stok Masuk</a></li>
          <li><a href="<?php echo base_url('stok/stokKeluar') ?>"><i class="icon-align-center-horizontal"></i>Stok Keluar</a></li>
        </ul>
      </li>

      <li class="active">
        <a href="<?php echo base_url('transaksi') ?>">Transaksi</a>
      </li>

      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="icon-strategy position-left"></i>Laporan<span class="caret"></span>
        </a>

        <ul class="dropdown-menu width-200">
          <li class="dropdown-header">Laporan Penjualan</li>
          <li><a href="<?php echo base_url('laporan/penjualan') ?>"><i class="icon-align-center-horizontal"></i>Laporan Penjualan</a></li>
          <li><a href="<?php echo base_url('laporan/labaRugi') ?>"><i class="icon-align-center-horizontal"></i>Laporan Laba Rugi</a></li>
          <li class="dropdown-header">Laporan Stok</li>
          <li><a href="<?php echo base_url('laporan/stokMasuk') ?>"><i class="icon-align-center-horizontal"></i>Stok Masuk</a></li>
          <li><a href="<?php echo base_url('laporan/stokKeluar') ?>"><i class="icon-align-center-horizontal"></i>Stok Keluar</a></li>
        </ul>
      </li>
    </ul>

    <ul class="nav navbar-nav navbar-right">
      <li>
        <a href="changelog.html">
          <i class="icon-history position-left"></i>
          Changelog
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
          <li><a href="#"><i class="icon-user-lock"></i> Account security</a></li>
          <li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>
          <li><a href="#"><i class="icon-accessibility"></i> Accessibility</a></li>
          <li class="divider"></li>
          <li><a href="#"><i class="icon-gear"></i> All settings</a></li>
        </ul>
      </li>
    </ul>
  </div>
</div>