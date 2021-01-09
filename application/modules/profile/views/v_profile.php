<div class="sidebar sidebar-main sidebar-default sidebar-separate">
  <div class="sidebar-content">

    <!-- User details -->
    <div class="content-group">
      <?php foreach ($getUser as $i) : ?>
        <div class="panel-body bg-indigo-400 border-radius-top text-center" style="background-image: url(<?php echo base_url() ?>assets/images/profile/<?php echo $i['photo'] ?>); background-size: contain;">
          <div class="content-group-sm">
            <h6 class="text-semibold no-margin-bottom">
              <?php echo $i['name'] ?>
            </h6>

            <span class="display-block"><?php echo $i['email'] ?></span>
          </div>

          <a href="#" class="display-inline-block content-group-sm">
            <img src="<?php echo base_url() ?>assets/images/profile/<?php echo $i['photo'] ?>" class="img-circle img-responsive" alt="" style="width: 110px; height: 110px;">
          </a>

          <ul class="list-inline list-inline-condensed no-margin-bottom">
            <li><a href="#" class="btn bg-indigo btn-rounded btn-icon"><i class="icon-google-drive"></i></a></li>
            <li><a href="#" class="btn bg-indigo btn-rounded btn-icon"><i class="icon-twitter"></i></a></li>
            <li><a href="#" class="btn bg-indigo btn-rounded btn-icon"><i class="icon-github"></i></a></li>
          </ul>
        </div>
      <?php endforeach; ?>

      <div class="panel no-border-top no-border-radius-top">
        <ul class="navigation">
          <li class="navigation-header">Navigation</li>
          <li class="active"><a href="#profile" data-toggle="tab"><i class="icon-files-empty"></i> Profile</a></li>
          <li><a href="#schedule" data-toggle="tab"><i class="icon-files-empty"></i> Schedule</a></li>
          <li><a href="#messages" data-toggle="tab"><i class="icon-files-empty"></i> Inbox <span class="badge bg-warning-400">23</span></a></li>
          <li><a href="#orders" data-toggle="tab"><i class="icon-files-empty"></i> Orders</a></li>
          <li class="navigation-divider"></li>
          <li><a href="login_advanced.html"><i class="icon-switch2"></i> Log out</a></li>
        </ul>
      </div>
    </div>
    <!-- /user details -->


    <!-- Online users -->
    <div class="sidebar-category">
      <div class="category-title">
        <span>Online users</span>
        <ul class="icons-list">
          <li><a href="#" data-action="collapse"></a></li>
        </ul>
      </div>

      <div class="category-content">
        <ul class="media-list">
          <li class="media">
            <a href="#" class="media-left"><img src="assets/images/placeholder.jpg" class="img-sm img-circle" alt=""></a>
            <div class="media-body">
              <a href="#" class="media-heading text-semibold">James Alexander</a>
              <span class="text-size-mini text-muted display-block">Santa Ana, CA.</span>
            </div>
            <div class="media-right media-middle">
              <span class="status-mark border-success"></span>
            </div>
          </li>

          <li class="media">
            <a href="#" class="media-left"><img src="assets/images/placeholder.jpg" class="img-sm img-circle" alt=""></a>
            <div class="media-body">
              <a href="#" class="media-heading text-semibold">Jeremy Victorino</a>
              <span class="text-size-mini text-muted display-block">Dowagiac, MI.</span>
            </div>
            <div class="media-right media-middle">
              <span class="status-mark border-danger"></span>
            </div>
          </li>

          <li class="media">
            <a href="#" class="media-left"><img src="assets/images/placeholder.jpg" class="img-sm img-circle" alt=""></a>
            <div class="media-body">
              <a href="#" class="media-heading text-semibold">Margo Baker</a>
              <span class="text-size-mini text-muted display-block">Kasaan, AK.</span>
            </div>
            <div class="media-right media-middle">
              <span class="status-mark border-success"></span>
            </div>
          </li>

          <li class="media">
            <a href="#" class="media-left"><img src="assets/images/placeholder.jpg" class="img-sm img-circle" alt=""></a>
            <div class="media-body">
              <a href="#" class="media-heading text-semibold">Beatrix Diaz</a>
              <span class="text-size-mini text-muted display-block">Neenah, WI.</span>
            </div>
            <div class="media-right media-middle">
              <span class="status-mark border-warning"></span>
            </div>
          </li>

          <li class="media">
            <a href="#" class="media-left"><img src="assets/images/placeholder.jpg" class="img-sm img-circle" alt=""></a>
            <div class="media-body">
              <a href="#" class="media-heading text-semibold">Richard Vango</a>
              <span class="text-size-mini text-muted display-block">Grapevine, TX.</span>
            </div>
            <div class="media-right media-middle">
              <span class="status-mark border-grey-400"></span>
            </div>
          </li>
        </ul>
      </div>
    </div>
    <!-- /online-users -->


    <!-- Latest updates -->
    <div class="sidebar-category">
      <div class="category-title">
        <span>Latest updates</span>
        <ul class="icons-list">
          <li><a href="#" data-action="collapse"></a></li>
        </ul>
      </div>

      <div class="category-content">
        <ul class="media-list">
          <li class="media">
            <div class="media-left">
              <a href="#" class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-pull-request"></i></a>
            </div>

            <div class="media-body">
              Drop the IE <a href="#">specific hacks</a> for temporal inputs
              <div class="media-annotation">4 minutes ago</div>
            </div>
          </li>

          <li class="media">
            <div class="media-left">
              <a href="#" class="btn border-warning text-warning btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-commit"></i></a>
            </div>

            <div class="media-body">
              Add full font overrides for popovers and tooltips
              <div class="media-annotation">36 minutes ago</div>
            </div>
          </li>

          <li class="media">
            <div class="media-left">
              <a href="#" class="btn border-info text-info btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-branch"></i></a>
            </div>

            <div class="media-body">
              <a href="#">Chris Arney</a> created a new <span class="text-semibold">Design</span> branch
              <div class="media-annotation">2 hours ago</div>
            </div>
          </li>

          <li class="media">
            <div class="media-left">
              <a href="#" class="btn border-success text-success btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-merge"></i></a>
            </div>

            <div class="media-body">
              <a href="#">Eugene Kopyov</a> merged <span class="text-semibold">Master</span> and <span class="text-semibold">Dev</span> branches
              <div class="media-annotation">Dec 18, 18:36</div>
            </div>
          </li>

          <li class="media">
            <div class="media-left">
              <a href="#" class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-pull-request"></i></a>
            </div>

            <div class="media-body">
              Have Carousel ignore keyboard events
              <div class="media-annotation">Dec 12, 05:46</div>
            </div>
          </li>
        </ul>
      </div>
    </div>
    <!-- /latest updates -->

  </div>
</div>


<div class="content-wrapper">

  <!-- Tab content -->
  <div class="tab-content">
    <div class="tab-pane fade in active" id="profile">
      <!-- Account settings -->
      <div class="panel panel-flat">
        <div class="panel-heading">
          <h6 class="panel-title">Account settings</h6>
          <div class="heading-elements">
            <ul class="icons-list">
              <li><a data-action="collapse"></a></li>
              <li><a data-action="reload"></a></li>
              <li><a data-action="close"></a></li>
            </ul>
          </div>
        </div>

        <div class="panel-body">
          <?php foreach ($getUser as $i) : ?>
            <form action="#">
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" value="<?php echo $i['name'] ?>" readonly="readonly" class="form-control">
                  </div>

                  <div class="col-md-6">
                    <label>Username</label>
                    <input type="text" name="username" value="<?php echo $i['username'] ?>" readonly="readonly" class="form-control">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label>Email</label>
                    <input type="text" name="email" value="<?php echo $i['email'] ?>" readonly="readonly" class="form-control">
                  </div>

                  <div class="col-md-6">
                    <label>No HP</label>
                    <input type="text" name="phone" value="<?php echo $i['phone'] ?>" readonly="readonly" class="form-control">
                  </div>
                </div>
              </div>

              <!-- <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label>Profile visibility</label>

                    <div class="radio">
                      <label>
                        <input type="radio" name="visibility" class="styled" checked="checked">
                        Visible to everyone
                      </label>
                    </div>

                    <div class="radio">
                      <label>
                        <input type="radio" name="visibility" class="styled">
                        Visible to friends only
                      </label>
                    </div>

                    <div class="radio">
                      <label>
                        <input type="radio" name="visibility" class="styled">
                        Visible to my connections only
                      </label>
                    </div>

                    <div class="radio">
                      <label>
                        <input type="radio" name="visibility" class="styled">
                        Visible to my colleagues only
                      </label>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <label>Notifications</label>

                    <div class="checkbox">
                      <label>
                        <input type="checkbox" class="styled" checked="checked">
                        Password expiration notification
                      </label>
                    </div>

                    <div class="checkbox">
                      <label>
                        <input type="checkbox" class="styled" checked="checked">
                        New message notification
                      </label>
                    </div>

                    <div class="checkbox">
                      <label>
                        <input type="checkbox" class="styled" checked="checked">
                        New task notification
                      </label>
                    </div>

                    <div class="checkbox">
                      <label>
                        <input type="checkbox" class="styled">
                        New contact request notification
                      </label>
                    </div>
                  </div>
                </div>
              </div> -->

              <div class="text-right">
                <button type="submit" class="tombol-tambah">Update <i class="icon-arrow-right14 position-right"></i></button>
              </div>
            </form>
          <?php endforeach; ?>
        </div>
      </div>
      <!-- /account settings -->

    </div>


  </div>
  <!-- /tab content -->

</div>