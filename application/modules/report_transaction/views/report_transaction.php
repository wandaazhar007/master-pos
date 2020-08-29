	<!-- Core JS files -->
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/loaders/blockui.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/ui/nicescroll.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/ui/drilldown.js"></script>
	<!-- /core JS files -->
	<!-- Theme JS files -->
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/notifications/jgrowl.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/ui/moment/moment.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/pickers/daterangepicker.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/pickers/anytime.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/pickers/pickadate/picker.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/pickers/pickadate/picker.date.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/pickers/pickadate/picker.time.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/pickers/pickadate/legacy.js"></script>

	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/core/app.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/pages/picker_date.js"></script>
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
	            <form action="<?php echo base_url('report_transaction/getAllDataTransaction') ?>" method="post">
	              <div class="form-group">
	                <div class="row">
	                  <div class="col-sm-4" id="form-tambah">
	                    <div class="form-group">
	                      <input type="text" name="start_date" class="form-control pickadate-accessibility" placeholder="Pilih Tanggal Awal">
	                    </div>
	                  </div>
	                  <div class="col-sm-4" id="form-tambah">
	                    <div class="form-group">
	                      <input type="text" name="end_date" class="form-control pickadate-accessibility" placeholder="Pilih Tanggal Akhir">
	                    </div>
	                  </div>
	                  <div class="col-sm-4" id="form-tambah">
	                    <div class="form-group">
	                      <button type="submit" class="btn btn-tosca"> <i class="fa fa-search"></i> Cari</button>
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
	          <tr>
	            <td></td>
	            <td></td>
	            <td></td>
	            <td></td>
	            <td></td>
	            <td></td>
	            <td></td>
	          </tr>
	        </tbody>
	      </table>
	    </div>
	  </div>
	</div>