<!DOCTYPE html>
<html lang="en">

<?php $this->load->view('templates/header') ?>

<body>

  <!-- Main navbar -->
  <?php $this->load->view('templates/navbar') ?>
  <!-- /main navbar -->


  <!-- navbar menu -->
  <?php $this->load->view('templates/menu') ?>
  <!-- /navbar menu -->


  <!-- Page header -->
  <?php //$this->load->view('templates/page_header') 
  ?>
  <!-- /page header -->


  <!-- Page container -->
  <div class="page-container">

    <!-- Page content -->
    <div class="page-content">

      <!-- Main content -->
      <?php $this->load->view($contents) ?>
      <!-- /main content -->

    </div>
    <!-- /page content -->

  </div>
  <!-- /page container -->


  <!-- Footer -->
  <?php $this->load->view('templates/footer') ?>
  <!-- /footer -->

</body>

</html>