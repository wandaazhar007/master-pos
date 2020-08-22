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
    $data['getBarcode'] = $this->model->getBarcode();
    $data['getCategoryProduct'] = $this->wandalibs->getCategoryProduct();
    $data['getUnitProduct'] = $this->wandalibs->getUnitProduct();

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
      // <button class="tombol-hapus view_delete_customer" id="tombol-delete-customer"><i class="fa fa-trash"></i>&nbsp;hapus</button>
      $queryCategory  = $this->db->get_where('product_category', ['idproduct_category' => $value['idproduct_category']])->row_array();
      $queryUnit      = $this->db->get_where('product_unit', ['idproduct_unit' => $value['idproduct_unit']])->row_array();
      $category = $queryCategory['name'];
      $unit = $queryUnit['name'];
      $queryStock     = $this->db->get_where('product_stock', ['idproduct' => $value['idproduct']])->row_array();

      if ($queryStock['total'] == NULL) {
        $stock = '<span class="badge badge-danger">Kosong</span> <a href="' . base_url('product_stock/addFromProduct/') . $value['barcode'] . '"><span class="badge badge-success"><i class="fa fa-plus"></i></span></a>';
      } else {
        if ($queryStock['total'] <= 10) {
          $stock = '<span class="badge badge-warning">' . $queryStock['total'] . '</span> <a href="' . base_url('product_stock/addFromProduct/') . $value['barcode'] . '"><span class="badge badge-success"><i class="fa fa-plus"></i></span></a>';
        } else {
          $stock = '<span class="badge badge-success">' . $queryStock['total'] . '</span> <a href="' . base_url('product_stock/addFromProduct/') . $value['barcode'] . '"><span class="badge badge-success"><i class="fa fa-plus"></i></span></a>';
        }
      }

      $row = array();
      $row[] = $no++;
      $row[] = $value['barcode'];
      $row[] = $value['name'];
      $row[] = $this->wandalibs->rupiah($value['price']);
      $row[] = $value['persentase'] . '%';
      $row[] = $this->wandalibs->rupiah($value['price_selling']);
      $row[] = $category;
      $row[] = $unit;
      $row[] = $stock;
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
    $this->form_validation->set_rules('idproduct_unit', 'Unit Produk', 'required', [
      'required'  => 'Satuan produk belum diisi!'
    ]);
    $this->form_validation->set_rules('idproduct_category', 'Kategori Produk', 'required', [
      'required'  => 'Kategori produk belum diisi!'
    ]);
    $this->form_validation->set_rules('barcode', 'Kode Barcode', 'required|trim', [
      'required'  => 'Kode barcode belum terisi'
    ]);
    $this->form_validation->set_rules('price', 'Harga Beli Produk', 'required|trim', [
      'required'  => 'Harga belum dipilih'
    ]);
    $this->form_validation->set_rules('persentase', 'Persentase', 'required|trim', [
      'required'  => 'Persentase belum ditentukan'
    ]);
    $this->form_validation->set_rules('price_selling', 'Harga Beli Produk', 'required|trim', [
      'required'  => 'Harga Jual belum terisi'
    ]);

    if ($this->form_validation->run() == true) {
      $name               = htmlspecialchars($this->input->post('name', true));
      $barcode            = htmlspecialchars($this->input->post('barcode', true));
      $idproduct_unit     = htmlspecialchars($this->input->post('idproduct_unit', true));
      $idproduct_category = htmlspecialchars($this->input->post('idproduct_category', true));
      $price              = htmlspecialchars($this->input->post('price', true));
      $persentase         = htmlspecialchars($this->input->post('persentase', true));
      $price_selling      = htmlspecialchars($this->input->post('price_selling', true));

      $data = [
        'name'              => $name,
        'barcode'           => $barcode,
        'idproduct_unit'    => $idproduct_unit,
        'idproduct_category' => $idproduct_category,
        'price'             => $price,
        'persentase'        => $persentase,
        'price_selling'     => $price_selling,
        'createdby'         => $this->session->userdata('nama'),
        'created'           => date('Y-m-d h:i:s')
      ];

      $this->db->insert('product', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
    <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
      <span class="text-semibold">Yeay!</span> Data produk ' . $name . ' berhasil ditambahkan. Silahkan isi stok produk <a href="' . base_url('product_stock/addFromProduct/') . $barcode . '">disini</a>
    </div>');
      redirect('product/dataProduct');
    } else {
      $data['title']      = 'Data Produk Master POS';
      $data['contents']   = 'data_product';
      $data['getBarcode'] = $this->model->getBarcode();
      $data['getCategoryProduct'] = $this->wandalibs->getCategoryProduct();
      $data['getUnitProduct'] = $this->wandalibs->getUnitProduct();

      $this->load->view('templates/core', $data);
    }
  }

  function showFormUpdate()
  {
    $idproduct = $this->input->post('idproduct');
    $queryCategory['name'] = $this->wandalibs->getCategoryProductArray();
    $queryUnit = $this->wandalibs->getUnitProduct();

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
                <input type="text" name="name" value="' . $i['name'] . '" placeholder="Masukan Nama Produk" class="form-control" required>
                <small class="text-danger">' . form_error('name') . '</small>
              </div>

              <div class="col-sm-3" style="margin-bottom: 10px;">
                <label>Kode Barcode</label>
                <input type="text" name="barcode" value="' . $i['barcode'] . '" class="form-control" value="" required readonly>
                <small class="text-danger">' . form_error('barcode') . '</small>
              </div>

              <div class="col-sm-3">
                <label>Persentase</label>
                <input type="number" name="pesentase" value="' . $i['persentase'] . '" class="form-control" placeholder="0%" required>
                <small class="text-danger">' . form_error('persentase') . '</small>
              </div>


              <div class="col-sm-6" style="margin-bottom: 10px;">
                <label>Harga Asli</label>
                <input type="number" name="price" value="' . $this->wandalibs->rupiah($i['price']) . '" placeholder="Rp. ..." class="form-control" required>
                <small class="text-danger">' . form_error('price') . '</small>
              </div>

              <div class="col-sm-6" style="margin-bottom: 10px;">
                <label>Harga Jual</label>
                <input type="text" name="price_selling" value="' . $this->wandalibs->rupiah($i['price_selling']) . '" placeholder="Rp. ..." class="form-control" required readonly>
                <small class="text-danger">' . form_error('price_selling') . '</small>
              </div>

              <div class="col-sm-6" style="margin-bottom: 10px;">
                <div class="form-group">
                  <label>Kategori Produk</label>
                  <select class="select-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="idproduct_category">
                    <optgroup label="Pilih Kategory Produk">
                        <option value="">' . $queryCategory . '</option>
                    </optgroup>
                  </select>
                </div>
              </div>

              <div class="col-sm-6" style="margin-bottom: 10px;">
                <div class="form-group">
                  <label>Satuan Produk</label>
                  <select class="select-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="idproduct_unit">
                    <optgroup label="Pilih Satuan Produk">
                      <option value=""></option>
                      
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

      endforeach;;
      echo $output;
    } else {
      echo 'not founds';
    }
  }


  function update()
  {
    $idproduct          = htmlspecialchars($this->input->post('idproduct', true));
    $name               = htmlspecialchars($this->input->post('name', true));
    $barcode            = htmlspecialchars($this->input->post('barcode', true));
    $idproduct_unit     = htmlspecialchars($this->input->post('idproduct_unit', true));
    $idproduct_category = htmlspecialchars($this->input->post('idproduct_category', true));
    $price              = htmlspecialchars($this->input->post('price', true));
    $persentase         = htmlspecialchars($this->input->post('persentase', true));
    $price_selling      = htmlspecialchars($this->input->post('price_selling', true));

    $data = [
      'name'              => $name,
      'barcode'           => $barcode,
      'idproduct_unit'    => $idproduct_unit,
      'idproduct_category' => $idproduct_category,
      'price'             => $price,
      'persentase'        => $persentase,
      'price_selling'     => $price_selling,
      'createdby'         => $this->session->userdata('nama'),
      'created'           => date('Y-m-d h:i:s')

    ];

    $this->db->where('idproduct', $idproduct);
    $this->db->update('product', $data);
    $this->session->set_flashdata('message', '<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
    <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
    <span class="text-semibold">Yeay!</span> Data product ' . $name . ' berhasil diupdate.
  </div>');
    redirect('product');
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
    $query = $this->db->get_where('product_stock', ['idproduct' => $idproduct])->row_array();
    // var_dump($query['idproduct_unit']);
    // die;
    $queryproduct = $this->db->get_where('product', ['idproduct' => $idproduct])->row_array();
    if ($query['idproduct'] == $idproduct) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger alert-styled-left alert-arrow-left alert-bordered">
      <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
      <span class="text-semibold">Ups!</span> Anda tidak dapat menghapusnya. Data product <b><i>' . $queryproduct['name'] . '</i></b> sudah ada yang terjual!.
    </div>');
      redirect('product/dataProduct');
    } else {
      $this->db->where('idproduct', $idproduct);
      $this->db->delete('product');
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
      <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
      <span class="text-semibold">Yeay!</span> Data produk ' . $queryproduct['name'] . 'berhasil dihapus!.
    </div>');
      redirect('product/dataProduct');
    }
  }
}
