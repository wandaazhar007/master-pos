<div class="navbar navbar-inverse">
  <div class="navbar-header">
    <a class="navbar-brand" href="<?php echo base_url() ?>"><img src="assets/images/logo_icon_light.png" alt="" style="display: inline;"><span style="margin-left: 10px;">Wanda Azhar</span></a>

    <ul class="nav navbar-nav pull-right visible-xs-block">
      <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
    </ul>
  </div>

  <div class="navbar-collapse collapse" id="navbar-mobile">
    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown dropdown-user">
        <a class="dropdown-toggle" data-toggle="dropdown">
          <img src="<?php echo base_url('assets/images/profile/') . $this->session->userdata('photo') ?>" alt="">
          <span><?php echo $this->session->userdata('name') ?></span>
          <i class="caret"></i>
        </a>

        <ul class="dropdown-menu dropdown-menu-right">
          <li><a href="<?php echo base_url('profile/myProfile/') . $this->session->userdata('iduser_admin') ?>"><i class="icon-user-plus"></i> My profile</a></li>
          <li><a href="<?php echo base_url('logout/logoutUser'); ?>"><i class="icon-switch2"></i> Logout</a></li>
        </ul>
      </li>
    </ul>
  </div>
</div>