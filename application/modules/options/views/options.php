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
<div class="row">
  <div class="col-md-6">
    <?php echo $this->session->flashdata('message') ?>
    <div class="text-danger" style="display: inline;">
      <?php echo form_error('name') ?>
    </div>
    <div class="panel panel-flat">
      <form action="<?php echo base_url('option/update') ?>" method="post" enctype="multipart/form-data">
        <div class="panel panel-body">
          <?php foreach ($getAllDataOption as $i) : ?>
            <div class="col-md-12">
              <div class="form-group has-feedback has-feedback-left">
                <input type="text" class="form-control" placeholder="Nama Toko" name="name" value="<?php echo $i['name'] ?>">
                <div class="form-control-feedback">
                  <i class="icon-user text-muted"></i>
                </div>
                <small class="text-danger text-italic"><?php echo form_error('name') ?></small>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group has-feedback has-feedback-left">
                <input type="number" class="form-control" placeholder="No Telepon" name="phone" autocomplete="off" value="<?php echo $i['phone'] ?>">
                <div class="form-control-feedback">
                  <i class="fa fa-phone text-muted"></i>
                </div>
                <small class="text-danger text-italic"><?php echo form_error('phone') ?></small>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group has-feedback has-feedback-left">
                <input type="text" class="form-control" placeholder="Alamat" name="address" autocomplete="off" value="<?php echo $i['address'] ?>">
                <div class="form-control-feedback">
                  <i class="icon-lock2 text-muted"></i>
                </div>
                <small class="text-danger text-italic"><?php echo form_error('address') ?></small>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group has-feedback has-feedback-left">
                <input type="file" class="form-control" placeholder="Logo" name="photo">
                <small class="text-danger text-italic"><?php echo form_error('photo') ?></small>
              </div>
            </div>
          <?php endforeach; ?>

          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Simpan <i class="fa fa-save"></i></button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- <div class="col-md-6">
      <div class="panel panel-flat">
        <div class="panel panel-body">
          <div class="text-center">
            <div class="icon-object border-slate-300 text-slate-300"><img src="<?php echo base_url() ?>/assets/images/favicon.png" alt=""></div>
            <small class="display-block text-muted">Logo Saat Ini </small>
          </div>
        </div>
      </div>
    </div> -->
</div>