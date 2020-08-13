<div class="content-wrapper">
  <?php echo $this->session->flashdata('message') ?>
  <!-- Basic responsive configuration -->
  <div class="panel panel-flat">
    <div class="panel-heading">
      <!-- <h5 class="panel-title">Daftar Supplier</h5> -->
      <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal_form_vertical"><i class="fa fa-plus"></i>Tambah Supplier</button>
      <div class="heading-elements">
        <ul class="icons-list">
          <li><a data-action="collapse"></a></li>
          <li><a data-action="reload"></a></li>
          <li><a data-action="close"></a></li>
        </ul>
      </div>
    </div>
    <table class="table datatable-responsive" id="tableSupplier">
      <?php echo date('Y-m-d h:i:s'); ?>
      <thead>
        <tr>
          <th>Nama Supplier</th>
          <th>Alamat</th>
          <th>No Telepon</th>
          <th>Keterangan</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>PT. indofarma</td>
          <td><a href="#">Jl. Suka bakti 1</a></td>
          <td>081288342016</td>
          <td>-</td>
          <td>
            <a href="#"><i class="icon-file-pdf"></i></a>
            <a href="#"><i class="icon-file-excel"></i></a>
          </td>
        </tr>
      </tbody>
    </table>

    <table class="table datatable-responsive">
      <thead>
        <tr>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Job Title</th>
          <th>DOB</th>
          <th>Status</th>
          <th class="text-center">Actions</th>
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
            <ul class="icons-list">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="icon-menu9"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                  <li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
                  <li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
                  <li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
                </ul>
              </li>
            </ul>
          </td>
        </tr>
        <tr>
          <td>Jackelyn</td>
          <td>Weible</td>
          <td><a href="#">Airline Transport Pilot</a></td>
          <td>3 Oct 1981</td>
          <td><span class="label label-default">Inactive</span></td>
          <td class="text-center">
            <ul class="icons-list">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="icon-menu9"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                  <li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
                  <li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
                  <li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
                </ul>
              </li>
            </ul>
          </td>
        </tr>
        <tr>
          <td>Aura</td>
          <td>Hard</td>
          <td>Business Services Sales Representative</td>
          <td>19 Apr 1969</td>
          <td><span class="label label-danger">Suspended</span></td>
          <td class="text-center">
            <ul class="icons-list">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="icon-menu9"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                  <li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
                  <li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
                  <li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
                </ul>
              </li>
            </ul>
          </td>
        </tr>
        <tr>
          <td>Nathalie</td>
          <td><a href="#">Pretty</a></td>
          <td>Drywall Stripper</td>
          <td>13 Dec 1977</td>
          <td><span class="label label-info">Pending</span></td>
          <td class="text-center">
            <ul class="icons-list">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="icon-menu9"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                  <li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
                  <li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
                  <li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
                </ul>
              </li>
            </ul>
          </td>
        </tr>
        <tr>
          <td>Sharan</td>
          <td>Leland</td>
          <td>Aviation Tactical Readiness Officer</td>
          <td>30 Dec 1991</td>
          <td><span class="label label-default">Inactive</span></td>
          <td class="text-center">
            <ul class="icons-list">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="icon-menu9"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                  <li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
                  <li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
                  <li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
                </ul>
              </li>
            </ul>
          </td>
        </tr>
        <tr>
          <td>Maxine</td>
          <td><a href="#">Woldt</a></td>
          <td><a href="#">Business Services Sales Representative</a></td>
          <td>17 Oct 1987</td>
          <td><span class="label label-info">Pending</span></td>
          <td class="text-center">
            <ul class="icons-list">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="icon-menu9"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                  <li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
                  <li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
                  <li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
                </ul>
              </li>
            </ul>
          </td>
        </tr>
        <tr>
          <td>Sylvia</td>
          <td><a href="#">Mcgaughy</a></td>
          <td>Hemodialysis Technician</td>
          <td>11 Nov 1983</td>
          <td><span class="label label-danger">Suspended</span></td>
          <td class="text-center">
            <ul class="icons-list">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="icon-menu9"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                  <li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
                  <li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
                  <li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
                </ul>
              </li>
            </ul>
          </td>
        </tr>
        <tr>
          <td>Lizzee</td>
          <td><a href="#">Goodlow</a></td>
          <td>Technical Services Librarian</td>
          <td>1 Nov 1961</td>
          <td><span class="label label-danger">Suspended</span></td>
          <td class="text-center">
            <ul class="icons-list">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="icon-menu9"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                  <li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
                  <li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
                  <li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
                </ul>
              </li>
            </ul>
          </td>
        </tr>
        <tr>
          <td>Kennedy</td>
          <td>Haley</td>
          <td>Senior Marketing Designer</td>
          <td>18 Dec 1960</td>
          <td><span class="label label-success">Active</span></td>
          <td class="text-center">
            <ul class="icons-list">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="icon-menu9"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                  <li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
                  <li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
                  <li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
                </ul>
              </li>
            </ul>
          </td>
        </tr>
        <tr>
          <td>Chantal</td>
          <td><a href="#">Nailor</a></td>
          <td>Technical Services Librarian</td>
          <td>10 Jan 1980</td>
          <td><span class="label label-default">Inactive</span></td>
          <td class="text-center">
            <ul class="icons-list">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="icon-menu9"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                  <li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
                  <li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
                  <li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
                </ul>
              </li>
            </ul>
          </td>
        </tr>
        <tr>
          <td>Delma</td>
          <td>Bonds</td>
          <td>Lead Brand Manager</td>
          <td>21 Dec 1968</td>
          <td><span class="label label-info">Pending</span></td>
          <td class="text-center">
            <ul class="icons-list">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="icon-menu9"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                  <li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
                  <li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
                  <li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
                </ul>
              </li>
            </ul>
          </td>
        </tr>
        <tr>
          <td>Roland</td>
          <td>Salmos</td>
          <td><a href="#">Senior Program Developer</a></td>
          <td>5 Jun 1986</td>
          <td><span class="label label-default">Inactive</span></td>
          <td class="text-center">
            <ul class="icons-list">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="icon-menu9"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                  <li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
                  <li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
                  <li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
                </ul>
              </li>
            </ul>
          </td>
        </tr>
        <tr>
          <td>Coy</td>
          <td>Wollard</td>
          <td>Customer Service Operator</td>
          <td>12 Oct 1982</td>
          <td><span class="label label-success">Active</span></td>
          <td class="text-center">
            <ul class="icons-list">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="icon-menu9"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                  <li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
                  <li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
                  <li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
                </ul>
              </li>
            </ul>
          </td>
        </tr>
        <tr>
          <td>Maxwell</td>
          <td>Maben</td>
          <td>Regional Representative</td>
          <td>25 Feb 1988</td>
          <td><span class="label label-danger">Suspended</span></td>
          <td class="text-center">
            <ul class="icons-list">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="icon-menu9"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                  <li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
                  <li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
                  <li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
                </ul>
              </li>
            </ul>
          </td>
        </tr>
        <tr>
          <td>Cicely</td>
          <td>Sigler</td>
          <td><a href="#">Senior Research Officer</a></td>
          <td>15 Mar 1960</td>
          <td><span class="label label-info">Pending</span></td>
          <td class="text-center">
            <ul class="icons-list">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="icon-menu9"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                  <li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
                  <li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
                  <li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
                </ul>
              </li>
            </ul>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

</div>




<!-- Modal Form Input Supplier -->
<div id="modal_form_vertical" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Vertical form</h5>
      </div>

      <form action="<?php echo base_url('supplier/save') ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <div class="row">
              <div class="col-sm-6">
                <label>Nama Supplier</label>
                <input type="text" name="name" placeholder="Masukan Nama Supplier" class="form-control" required>
              </div>

              <div class="col-sm-6">
                <label>No Handphone</label>
                <input type="text" name="phone" placeholder="Masukan No Handphone Supplier" class="form-control" required>
              </div>

              <div class="col-sm-12">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" id="" cols="5" rows="5" placeholder="Ketikan Alamat kantor supplier"></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>