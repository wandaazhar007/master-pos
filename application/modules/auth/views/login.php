<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $title ?></title>

  <!-- Global stylesheets -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url() ?>assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url() ?>assets/css/bootstrap.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url() ?>assets/css/core.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url() ?>assets/css/components.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url() ?>assets/css/colors.css" rel="stylesheet" type="text/css">
  <!-- /global stylesheets -->

  <!-- Core JS files -->
  <script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/loaders/pace.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url() ?>assets/js/core/libraries/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url() ?>assets/js/core/libraries/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/loaders/blockui.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/ui/nicescroll.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/ui/drilldown.js"></script>
  <!-- /core JS files -->


  <!-- Theme JS files -->
  <script type="text/javascript" src="<?php echo base_url() ?>assets/js/core/app.js"></script>
  <!-- /theme JS files -->

</head>

<body class="login-container">
  <!-- Page container -->
  <div class="page-container">

    <!-- Page content -->
    <div class="page-content">

      <!-- Main content -->
      <div class="content-wrapper">

        <!-- Simple login form -->
        <form action="<?php echo base_url('auth/login') ?>" method="post">
          <div class="panel panel-body login-form">
            <div class="text-center">
              <div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
              <h5 class="content-group">Login to your account <small class="display-block">Enter your credentials below</small></h5>
              <?php echo $this->session->flashdata('message') ?>
            </div>

            <div class="form-group has-feedback has-feedback-left">
              <input type="text" class="form-control" placeholder="Email" name="email" autocomplete="off">
              <div class="form-control-feedback">
                <i class="icon-user text-muted"></i>
              </div>
              <small class="text-danger text-italic"><?php echo form_error('email') ?></small>
            </div>

            <div class="form-group has-feedback has-feedback-left">
              <input type="password" class="form-control" placeholder="Password" name="password" autocomplete="off">
              <div class="form-control-feedback">
                <i class="icon-lock2 text-muted"></i>
              </div>
              <small class="text-danger text-italic"><?php echo form_error('password') ?></small>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block">Sign in <i class="icon-circle-right2"></i></button>
            </div>
          </div>
        </form>
        <!-- /simple login form -->

      </div>
      <!-- /main content -->

    </div>
    <!-- /page content -->

  </div>
  <!-- /page container -->


  <!-- Footer -->
  <div class="footer text-muted text-center">
    &copy; 2020. <a href="#">Wanda Azhar</a> by <a href="https://instagram.com/wanda_azharr/" target="_blank">natrium-tech</a>
  </div>
  <!-- /footer -->

</body>

</html>