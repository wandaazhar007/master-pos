<?php defined('BASEPATH') or exit('No direct script access allowed');

class Product extends MX_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->wandalibs->_checkLoginSession();
    $this->load->library('datatables');
    $this->load->model('m_data_product', 'model');
  }

  function dataProduct()
  {
    $data['title']      = 'Data Produk Master POS';
    $data['contents']   = 'data_product';
    // $data['getBarcode'] = $this->wandalibs->getBarcode();
    $data['getCategoryProduct'] = $this->wandalibs->getCategoryProduct();
    $data['getUnitProduct'] = $this->wandalibs->getUnitProduct();
    $data['getAllSupplier'] = $this->wandalibs->getAllSupplier();

    $this->load->view('templates/core', $data);
  }

  function getAllTable()
  {
    $list = $this->model->datatables_getAllTableDataProduct();
    $data = array();
    $no = 1;
    foreach ($list as $value) {
      $queryAction = '
        <a href="#">
          <button class="tombol-hapus view_hapus pull-right" id="' . $value['idproduct'] . '"><i class="fa fa-trash"></i>&nbsp;hapus</button>
        </a>
        <a href="#">
          <button style="margin-right: 5px;" class="tombol-edit view_data_produk pull-right" id="' . $value['idproduct'] . '"><i class="fa fa-pencil"></i>&nbsp;edit</button>
        </a>
        ';

      if ($value['stock_now'] == NULL) {
        $buttonAddStock = '
        <span class="badge badge-danger">Kosong</span> <a href="' . base_url('product_stock/addStockProduct/') . $value['code_product'] . '"><span class="badge badge-success"><i class="fa fa-plus"></i></span></a>
        ';
      } else {
        $buttonAddStock = '
        <span class="badge badge-success">' . $value['stock_now'] . '</span> <a href="' . base_url('product_stock/updateStockProduct/') . $value['code_product'] . '"><span class="badge badge-success"><i class="fa fa-plus"></i></span></a>
        <a href="' . base_url('product_stock/MinStockProduct/') . $value['code_product'] . '"><span class="badge badge-danger"><i class="fa fa-minus"></i></span></a>
        ';
      }
      // <button class="tombol-hapus view_delete_customer" id="tombol-delete-customer"><i class="fa fa-trash"></i>&nbsp;hapus</button>
      // $queryCategory  = $this->db->get_where('category', ['idproduct_category' => $value['idproduct_category']])->row_array();
      // $queryUnit      = $this->db->get_where('product_unit', ['idproduct_unit' => $value['idproduct_unit']])->row_array();
      // $category = $queryCategory['name'];
      // $unit = $queryUnit['name'];
      // $queryStock     = $this->db->get_where('product_stock', ['idproduct' => $value['idproduct']])->row_array();

      // if ($queryStock['total'] == NULL) {
      //   $stock = '<span class="badge badge-danger">Kosong</span> <a href="' . base_url('product_stock/addFromProduct/') . $value['barcode'] . '"><span class="badge badge-success"><i class="fa fa-plus"></i></span></a>';
      // } else {
      //   if ($queryStock['total'] <= 10) {
      //     $stock = '<span class="badge badge-warning">' . $queryStock['total'] . '</span> <a href="' . base_url('product_stock/addFromProduct/') . $value['barcode'] . '"><span class="badge badge-success"><i class="fa fa-plus"></i></span></a>';
      //   } else {
      //     $stock = '<span class="badge badge-success">' . $queryStock['total'] . '</span> <a href="' . base_url('product_stock/addFromProduct/') . $value['barcode'] . '"><span class="badge badge-success"><i class="fa fa-plus"></i></span></a>';
      //   }
      // }

      $row = array();
      $row[] = $no++;
      $row[] = $value['code_product'];
      $row[] = $value['name'];
      $row[] = $this->wandalibs->rupiah($value['buying_price']);
      $row[] = $value['persentase'] . '%';
      $row[] = $this->wandalibs->rupiah($value['selling_price']);
      $row[] = $value['name_category'];
      $row[] = $value['name_unit'];
      $row[] = $buttonAddStock;
      $row[] = $queryAction;
      $data[] = $row;
    }
    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->model->countAll(),
      "recordsFiltered" => $this->model->countFiltered(),
      "data" => $data
    );
    echo json_encode($output);
  }

  function save()
  {
    $this->load->library('form_validation');
    $this->form_validation->set_rules('name', 'Nama Produk', 'required', [
      'required'  => 'Nama produk belum diisi!'
    ]);
    $this->form_validation->set_rules('idunit', 'Unit Produk', 'required', [
      'required'  => 'Satuan produk belum diisi!'
    ]);
    $this->form_validation->set_rules('idcategory', 'Kategori Produk', 'required', [
      'required'  => 'Kategori produk belum diisi!'
    ]);
    $this->form_validation->set_rules('code_product', 'Kode Barcode', 'required|trim', [
      'required'  => 'Kode barcode belum terisi'
    ]);
    $this->form_validation->set_rules('buying_price', 'Harga Beli Produk', 'required|trim', [
      'required'  => 'Harga belum dipilih'
    ]);
    $this->form_validation->set_rules('persentase', 'Persentase', 'required|trim', [
      'required'  => 'Persentase belum ditentukan'
    ]);
    $this->form_validation->set_rules('selling_price', 'Harga Beli Produk', 'required|trim', [
      'required'  => 'Harga Jual belum terisi'
    ]);

    if ($this->form_validation->run() == true) {
      $name               = htmlspecialchars($this->input->post('name', true));
      $code_product       = htmlspecialchars($this->input->post('code_product', true));
      $idcategory         = htmlspecialchars($this->input->post('idcategory', true));
      $idunit             = htmlspecialchars($this->input->post('idunit', true));
      $persentase         = htmlspecialchars($this->input->post('persentase', true));
      $buying_price       = htmlspecialchars($this->input->post('buying_price', true));
      $selling_price      = htmlspecialchars($this->input->post('selling_price', true));

      $dataProduct = [
        'name'              => $name,
        'code_product'      => $code_product,
        'idcategory'        => $idcategory,
        'idunit'            => $idunit,
        'buying_price'      => $buying_price,
        'persentase'        => $persentase,
        'selling_price'     => $selling_price,
        'date_created'      => date('Y-m-d h:i:s'),
        'created_by'        => $this->session->userdata('nama')
      ];

      $this->db->insert('product', $dataProduct);
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
    <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
      <span class="text-semibold">Yeay!</span> Data produk ' . $name . ' berhasil ditambahkan. Silahkan isi stok produk <a href="' . base_url('product_stock/addFromProduct/') . $code_product . '">disini</a>
    </div>');
      redirect('product/dataProduct');
    } else {
      $data['title']              = 'Data Produk Master POS';
      $data['contents']           = 'data_product';
      // $data['getcodeProduct']         = $this->model->getcodeProduct();
      $data['getCategoryProduct'] = $this->wandalibs->getCategoryProduct();
      $data['getUnitProduct']     = $this->wandalibs->getUnitProduct();

      $this->load->view('templates/core', $data);
    }
  }

  function showFormUpdate()
  {
    $idproduct = $this->input->post('idproduct');
    $category = $this->wandalibs->getAllCategoryProductArray();
    $unit = $this->wandalibs->getAllUnitProductArray();
    // $queryUnit = $this->wandalibs->getUnitProduct();
    // $queryCategory = $this->wandalibs->getCategoryProduct();
    // foreach ($queryCategory as $u) {
    //   return $u['name'];
    // }

    // var_dump($queryCategory);
    // die;
    if (isset($idproduct) and !empty($idproduct)) {
      $query = $this->model->getDetailById($idproduct);

      $output = '';
      foreach ($query as $i) :

        $output .= '
        <script type="text/javascript" src="' .  base_url() . 'assets/js/plugins/forms/selects/select2.min.js"></script>
        <script type="text/javascript" src="' .  base_url() . 'assets/js/pages/form_select2.js"></script>
        ';

        $output .= '
      
        <form action="' . base_url('product/update') . '" method="post">
        <div class="modal-body">
          <div class="form-group">
            <div class="row">
              <div class="col-sm-6" style="margin-bottom: 10px;">
                <label>Nama Produk</label>
                <input type="hidden" name="idproduct" value="' . $i['idproduct'] . '" placeholder="Masukan Nama Produk" class="form-control" required>
                <input type="text" name="name" value="' . $i['name'] . '" placeholder="Masukan Nama Produk" class="form-control" required>
                <small class="text-danger">' . form_error('name') . '</small>
              </div>

              <div class="col-sm-3" style="margin-bottom: 10px;">
                <label>Kode Barcode</label>
                <input type="text" name="code_product" value="' . $i['code_product'] . '" class="form-control" value="" required readonly>
                <small class="text-danger">' . form_error('code_product') . '</small>
              </div>

              <div class="col-sm-3">
                <label>Persentase</label>
                <input type="number" name="persentase" value="' . $i['persentase'] . '" id="persentase" class="form-control" placeholder="0%" min="0" required>
                <small class="text-danger">' . form_error('persentase') . '</small>
              </div>


              <div class="col-sm-6" style="margin-bottom: 10px;">
                <label>Harga Asli</label>
                <input type="number" name="buying_price" id="buying_price" value="' . $this->wandalibs->rupiah($i['buying_price']) . '" min="0" placeholder="Rp. ..." class="form-control" required>
                <small class="text-danger">' . form_error('price') . '</small>
              </div>

              <div class="col-sm-6" style="margin-bottom: 10px;">
                <label>Harga Jual</label>
                <input type="text" name="selling_price" value="' . $this->wandalibs->rupiah($i['selling_price']) . '" id="selling_price" placeholder="Rp. ..." class="form-control" required readonly>
                <small class="text-danger">' . form_error('price_selling') . '</small>
              </div>

              <div class="col-sm-6" style="margin-bottom: 10px;">
                <div class="form-group">
                  <label>Kategori Produk</label>
                  <select class="select-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="idcategory" required>
                    <optgroup label="Pilih Kategory Produk">
                        <option value="' .  $i['idcategory'] . '">' .  $i['name_category'] . '</option>
                        <option value="">' .  $category . '</option>
                    </optgroup>
                  </select>
                </div>
              </div>

              <div class="col-sm-6" style="margin-bottom: 10px;">
                <div class="form-group">
                  <label>Satuan Produk</label>
                  <select class="select-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="idunit" required>
                    <optgroup label="Pilih Satuan Produk">
                      <option value="' .  $i['idunit'] . '">' .  $i['name_unit'] . '</option>
                        <option value="">' .  $unit . '</option>
                    </optgroup>
                  </select>
                </div>
              </div>

              <div class="col-sm-12">
                <label>Keterangan</label>
                <textarea name="description" class="form-control" id="" cols="5" rows="5" placeholder="Masukan keterangan produk (Jika diperlukan)">' . $i['description'] . '</textarea>
                <small class="text-danger">' . form_error('description') . '</small>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="tombol-modal-hapus" data-dismiss="modal">Close</button>
          <button type="submit" class="tombol-tambah"><i class="fa fa-save"></i>&nbsp; Simpan</button>
        </div>
      </form>
                ';
      // $output .= '
      //       <script  type="text/javascript">
      //         document.getElementById("buying_price").addEventListener("keyup", function() {
      //           const buying_price = parseInt(document.getElementById("buying_price").value);
      //           const persentase = parseInt(document.getElementById("persentase").value);
      //           const selling_price = document.getElementById("selling_price");

      //           const result1 = (buying_price * persentase) / 100;
      //           const result2 = result1 + buying_price;
      //           const result3 = Math.round(result2);

      //           selling_price.setAttribute("value", result3);

      //         })

      //         document.getElementById("persentase").addEventListener("keyup", function() {
      //           const buying_price = parseInt(document.getElementById("buying_price").value);
      //           const persentase = parseInt(document.getElementById("persentase").value);
      //           const selling_price = document.getElementById("selling_price");

      //           const result1 = (buying_price * persentase) / 100;
      //           const result2 = result1 + buying_price;
      //           const result3 = Math.round(result2);

      //           selling_price.setAttribute("value", result3);
      //         })
      //       </script>
      //       ';
      endforeach;
      echo $output;
    } else {
      echo 'not founds';
    }
  }


  function update()
  {
    $idproduct          = htmlspecialchars($this->input->post('idproduct', true));
    $name               = htmlspecialchars($this->input->post('name', true));
    $code_product       = htmlspecialchars($this->input->post('code_product', true));
    $idunit             = htmlspecialchars($this->input->post('idunit', true));
    $idcategory         = htmlspecialchars($this->input->post('idcategory', true));
    $buying_price       = htmlspecialchars($this->input->post('buying_price', true));
    $persentase         = htmlspecialchars($this->input->post('persentase', true));
    $selling_price      = htmlspecialchars($this->input->post('selling_price', true));

    $data = [
      'name'              => $name,
      'code_product'      => $code_product,
      'idunit'            => $idunit,
      'idcategory'        => $idcategory,
      'buying_price'      => $buying_price,
      'persentase'        => $persentase,
      'selling_price'     => $selling_price,
      'updated_by'        => $this->session->userdata('nama'),
      'updated'           => date('Y-m-d h:i:s')

    ];

    $this->db->where('idproduct', $idproduct);
    $this->db->update('product', $data);
    $this->session->set_flashdata('message', '<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
    <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
    <span class="text-semibold">Yeay!</span> Data product ' . $name . ' berhasil diupdate.
  </div>');
    redirect('product/dataProduct');
  }

  function showModalDelete()
  {
    $idproduct = $this->input->post('idproduct');
    if (isset($idproduct) and !empty($idproduct)) {
      $query = $this->model->getDetailById($idproduct);
      $output = '';
      foreach ($query as $i) :
        $output .= '
          <div class="row">
          <div class="col-sm-12 text-center">
            <p>Apakah Anda yakin akan menghapus data produk</p>
            <h6 class="text-bold" style="margin-top: -10px;">' . $i['name'] . ' ?</h6>
          </div>
            <div class="col-sm-12 text-center">
              <a href="' . base_url('product/delete/') . $i['idproduct'] . '">
                <button type="submit" class="tombol-tambah"><i class="fa fa-check"></i>&nbsp;Ya, Hapus</button>
                <button type="button" class="tombol-modal-hapus" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;Tidak!</button>
                </a>
            </div>
          </div>
                ';

      endforeach;
      echo $output;
    } else {
      echo 'not founds';
    }
  }

  function delete($idproduct)
  {
    // var_dump($idproduct);
    // die;
    $queryproduct = $this->db->get_where('stock', ['idproduct' => $idproduct])->row_array();
    if ($queryproduct['idproduct'] == $idproduct) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger alert-styled-left alert-arrow-left alert-bordered">
      <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
      <span class="text-semibold">Ups!</span> Silakan hapus stock produck <b><i>' . $queryproduct['name'] . '</i></b> di menu stock masuk terlebih dahulu!.
    </div>');
      redirect('product/dataProduct');
    } else {
      $this->db->delete('product', ['idproduct' => $idproduct]);
      $this->db->delete('stock', ['idproduct' => $idproduct]);
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
      <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
      <span class="text-semibold">Yeay!</span> Data produk ' . $queryproduct['name'] . 'berhasil dihapus!.
    </div>');
      redirect('product/dataProduct');
    }
  }
}
