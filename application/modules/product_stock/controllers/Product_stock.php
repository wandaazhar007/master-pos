<?php defined('BASEPATH') or exit('No direct script access allowed');

class Product_stock extends MX_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->wandalibs->_checkLoginSession();
    $this->load->library('datatables');
    $this->load->model('m_product_stock', 'model');
  }

  function index()
  {
    $data['title']          = 'Stok Produk Master POS';
    $data['contents']       = 'product_stock';
    $data['getAllProduct']  = $this->wandalibs->getAllProduct();
    $data['getAllSupplier'] = $this->wandalibs->getAllSupplier();

    $this->load->view('templates/core', $data);
  }

  function getAllTable()
  {

    $list = $this->model->datatables_getAllTable();
    $data = array();
    $no = 1;
    foreach ($list as $value) {
      $queryAction = '
        <a href="#">
          <button class="tombol-hapus view_hapus pull-right" id="' . $value['idstock'] . '"><i class="fa fa-trash"></i>&nbsp;hapus</button>
        </a>
        <a href="#">
          <button style="margin-right: 5px;" class="tombol-edit view_product_stock pull-right" id="' . $value['idstock'] . '"><i class="fa fa-search"></i>&nbsp;History</button>
        </a>
        ';
      $a = strtotime($value['date_created']);
      $tgl = date('d F Y | h:i', $a);

      $queryStock     = $this->db->get_where('stock', ['idproduct' => $value['idproduct']])->row_array();

      if ($queryStock['total'] == NULL) {
        $stock = '<span class="badge badge-danger">Kosong</span> <span class="badge badge-success"><i class="fa fa-plus"></i></span>';
      } else {
        if ($queryStock['total'] <= 10) {
          $stock = '<span class="badge badge-warning">' . $queryStock['total'] . '</span> <span class="badge badge-success"><i class="fa fa-plus"></i></span>';
        } else {
          $stock = '<span class="badge badge-success">' . $queryStock['total'] . '</span> <span class="badge badge-success"><i class="fa fa-plus"></i></span>';
        }
      }

      $row = array();

      $row[] = $no++;
      $row[] = $tgl;
      $row[] = $value['code_product'];
      $row[] = $value['name'];
      $row[] = $value['type'];
      // $row[] = $value['name_supplier'];
      $row[] = $value['total'] . '&nbsp;' . $value['name_unit'] . '&nbsp;' . $value['description'];
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
    $this->form_validation->set_rules('idproduct', 'Nama Produk', 'required', [
      'required'  => 'Nama produk belum diisi!'
    ]);
    $this->form_validation->set_rules('total', 'Jumlah', 'required|trim', [
      'required'  => 'Jumlah stock belum diisi'
    ]);

    if ($this->form_validation->run() == true) {
      $idproduct        = htmlspecialchars($this->input->post('idproduct', true));
      $idsupplier       = htmlspecialchars($this->input->post('idsupplier', true));
      $total            = htmlspecialchars($this->input->post('total', true));

      $query = $this->db->get_where('product', ['idproduct' => $idproduct])->row_array();
      $namaProduk = $query['name'];
      $data = [
        'idproduct'         => $idproduct,
        'idsupplier'        => $idsupplier,
        'total'             => $total,
        'created_by'         => $this->session->userdata('name'),
        'stock_date'        => date('Y-m-d h:i:s')
      ];

      $this->db->insert('product_stock', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
      <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
        <span class="text-semibold">Yeay!</span> Stok Produk ' . $namaProduk . ' berhasil ditambah .
      </div>');
      redirect('product_stock');
    } else {
      $data['title']          = 'Stok Produk Master POS';
      $data['contents']       = 'product_stock';
      $data['getAllProduct']  = $this->wandalibs->getAllProduct();
      $data['getAllSupplier'] = $this->wandalibs->getAllSupplier();

      $this->load->view('templates/core', $data);
    }
  }

  function showFormUpdate()
  {
    $idproduct_stock = $this->input->post('idproduct_stock');
    if (isset($idproduct_stock) and !empty($idproduct_stock)) {
      $query = $this->model->getDetailById($idproduct_stock);
      $output = '';
      foreach ($query as $i) :
        $output .= '
      
    <form action="' . base_url('product_stock/update') . '" method="post">
      <div class="form-group">
        <div class="row">
          <div class="col-sm-12">
            <label>Nama Kategori Produk</label>
            <input type="hidden" name="idproduct_stock" value="' . $i['idproduct_stock'] . '" class="form-control" required>
            <input type="text" name="name" value="' . $i['name'] . '" class="form-control" required>
          </div>
          <div class="col-sm-12" style="margin-top: 10px;">
          <button type="submit" class="tombol-tambah pull-right"><i class="fa fa-save"></i>&nbsp;Update</button>
          </div>
        </div>
      </div>
    </form>
                ';

      endforeach;
      echo $output;
    } else {
      echo 'not founds';
    }
  }


  function update()
  {
    $idproduct_stock = htmlspecialchars($this->input->post('idproduct_stock', true));
    $name       = htmlspecialchars($this->input->post('name', true));

    $data = [
      'name'      => $name,
      'createdby' => $this->session->userdata('name'),
      'created'   => date('Y-m-d h:i:s')
    ];

    $this->db->where('idproduct_stock', $idproduct_stock);
    $this->db->update('product_stock', $data);
    $this->session->set_flashdata('message', '<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
    <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
    <span class="text-semibold">Yeay!</span> Kategori ' . $name . ' berhasil diupdate.
  </div>');
    redirect('product_stock');
  }

  function showModalDelete()
  {
    $idstock = $this->input->post('idstock');
    if (isset($idstock) and !empty($idstock)) {
      $query = $this->model->getDetailById($idstock);
      $output = '';
      foreach ($query as $i) :
        $output .= '
          <div class="row">
          <div class="col-sm-12 text-center">
            <p>Apakah Anda yakin akan menghapus riwayat stok</p>
            <h6 class="text-bold" style="margin-top: -10px;">' . $i['name'] . ' ?</h6>
          </div>
            <div class="col-sm-12 text-center">
              <a href="' . base_url('product_stock/delete/') . $i['idstock'] . '">
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

  function delete($idstock)
  {
    // $query = $this->db->get_where('product', ['idstock' => $idstock])->row_array();
    // if ($query['idstock'] == $idstock) {
    //   $this->session->set_flashdata('message', '<div class="alert alert-danger alert-styled-left alert-arrow-left alert-bordered">
    //   <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
    //   <span class="text-semibold">Ups!</span> produk <b><i>' . $query['name'] . '</i></b> sudah pernah digunakan!.
    // </div>');
    //   redirect('product_stock');
    // } else {
    $this->db->where('idstock', $idstock);
    $this->db->delete('stock');
    $this->session->set_flashdata('message', '<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
      <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
      <span class="text-semibold">Yeay!</span> riwayat stok produk berhasil dihapus!.
    </div>');
    redirect('product_stock');
    // }
  }

  function addStockProduct($code_product)
  {

    $this->load->library('form_validation');
    $this->form_validation->set_rules('idproduct', 'Nama Produk', 'required', [
      'required' => 'Nama produk belum diisi'
    ]);
    $this->form_validation->set_rules('total', 'Jumlah', 'required|trim', [
      'required'  => 'Jumlah stock belum diisi'
    ]);

    $idproduct        = htmlspecialchars($this->input->post('idproduct', true));
    $query2 = $this->db->get_where('product', ['code_product' => $code_product])->row_array();
    // var_dump($query2['idproduct']);
    // die;

    if ($this->form_validation->run() == true) {
      $idproduct        = htmlspecialchars($this->input->post('idproduct', true));
      $total            = htmlspecialchars($this->input->post('total', true));
      $description      = htmlspecialchars($this->input->post('description', true));
      $type             = htmlspecialchars($this->input->post('type', true));

      $query = $this->db->get_where('product', ['idproduct' => $idproduct])->row_array();
      $namaProduk = $query['name'];
      $stockNow = $query['stock_now'] + $total;

      $dataStock = [
        'idproduct'         => $idproduct,
        'total'             => $total,
        'description'       => $description,
        'type'              => $type,
        'created_by'        => $this->session->userdata('name'),
        'date_created'      => date('Y-m-d h:i:s')
      ];

      $this->db->insert('stock', $dataStock);
      $lastIdStock = $this->db->insert_id();

      $data = [
        'idstock'           => $lastIdStock,
        'stock_now'         => $stockNow,
        'created_by'        => $this->session->userdata('name'),
        'date_created'      => date('Y-m-d h:i:s')
      ];
      $this->db->where('idproduct', $idproduct);
      $this->db->update('product', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
          <span class="text-semibold">Yeay!</span> Stok Produk ' . $namaProduk . ' berhasil ditambah .
        </div>');
      redirect('product/dataProduct/');
    } else {
      // $barcode = $this->input->post('barcode');
      // redirect('product_stock/addFromProduct/' . $barcode);
      $data['title']          = 'Stok Produk Master POS';
      $data['contents']       = 'add_stock_product';
      $data['getAllProduct']  = $this->wandalibs->getAllProduct();
      $data['getAllSupplier'] = $this->wandalibs->getAllSupplier();
      $data['getProductById'] = $this->wandalibs->getProductById($code_product);
      $this->load->view('templates/core', $data);
    }
  }


  function updateStockProduct($code_product)
  {

    $this->load->library('form_validation');
    $this->form_validation->set_rules('total', 'Jumlah', 'required|trim', [
      'required'  => 'Jumlah stock belum diisi'
    ]);

    if ($this->form_validation->run() == true) {
      $idproduct        = htmlspecialchars($this->input->post('idproduct', true));
      $total            = htmlspecialchars($this->input->post('total', true));
      $description      = htmlspecialchars($this->input->post('description', true));
      $type             = htmlspecialchars($this->input->post('type', true));

      $query = $this->db->get_where('product', ['idproduct' => $idproduct])->row_array();
      $namaProduk = $query['name'];
      $stockNow = $query['stock_now'] + $total;

      $dataStock = [
        'idproduct'         => $idproduct,
        'total'             => $total,
        'description'       => $description,
        'type'              => $type,
        'updated_by'        => $this->session->userdata('name'),
        'updated'           => date('Y-m-d h:i:s')
      ];

      $this->db->insert('stock', $dataStock);
      $lastIdStock = $this->db->insert_id();

      $data = [
        'idstock'           => $lastIdStock,
        'stock_now'         => $stockNow,
        'updated_by'        => $this->session->userdata('name'),
        'created'           => date('Y-m-d h:i:s')
      ];
      $this->db->where('idproduct', $idproduct);
      $this->db->update('product', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
          <span class="text-semibold">Yeay!</span> Stok Produk ' . $namaProduk . ' berhasil ditambah .
        </div>');
      redirect('product/dataProduct/');
    } else {
      // $barcode = $this->input->post('barcode');
      // redirect('product_stock/addFromProduct/' . $barcode);
      $data['title']          = 'Stok Produk Master POS';
      $data['contents']       = 'add_stock_product';
      $data['getAllProduct']  = $this->wandalibs->getAllProduct();
      $data['getAllSupplier'] = $this->wandalibs->getAllSupplier();
      $data['getProductById'] = $this->wandalibs->getProductById($code_product);
      $this->load->view('templates/core', $data);
    }
  }

  function minStockProduct($code_product)
  {

    $this->load->library('form_validation');
    $this->form_validation->set_rules('idproduct', 'Nama Produk', 'required', [
      'required' => 'Nama produk belum diisi'
    ]);
    $this->form_validation->set_rules('total', 'Jumlah', 'required|trim', [
      'required'  => 'Jumlah stock belum diisi'
    ]);

    $idproduct        = htmlspecialchars($this->input->post('idproduct', true));
    $query2 = $this->db->get_where('product', ['code_product' => $code_product])->row_array();
    // var_dump($query2['idproduct']);
    // die;
    if ($this->form_validation->run() == true) {
      $idproduct        = htmlspecialchars($this->input->post('idproduct', true));
      $total            = htmlspecialchars($this->input->post('total', true));
      $description      = htmlspecialchars($this->input->post('description', true));
      $type             = htmlspecialchars($this->input->post('type', true));

      $query = $this->db->get_where('product', ['idproduct' => $idproduct])->row_array();
      $namaProduk = $query['name'];
      $stockNow = $query['stock_now'] - $total;

      if ($stockNow < 0) {
        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-styled-left alert-arrow-left alert-bordered">
        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
          <span class="text-semibold">Ups!</span> Stok Produk ' . $namaProduk . ' minus!.
        </div>');
        redirect('product/dataProduct/');
      }

      $dataStock = [
        'idproduct'         => $idproduct,
        'total'             => $total,
        'description'       => $description,
        'type'              => $type,
        'created_by'        => $this->session->userdata('name'),
        'date_created'      => date('Y-m-d h:i:s')
      ];

      $this->db->insert('stock', $dataStock);
      $lastIdStock = $this->db->insert_id();

      $data = [
        'idstock'           => $lastIdStock,
        'stock_now'         => $stockNow,
        'created_by'        => $this->session->userdata('name'),
        'date_created'      => date('Y-m-d h:i:s')
      ];
      $this->db->where('idproduct', $idproduct);
      $this->db->update('product', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
          <span class="text-semibold">Yeay!</span> Stok Produk ' . $namaProduk . ' berhasil dikurangi .
        </div>');
      redirect('product/dataProduct/');
    } else {
      // $barcode = $this->input->post('barcode');
      // redirect('product_stock/addFromProduct/' . $barcode);
      $data['title']          = 'Stok Produk Master POS';
      $data['contents']       = 'min_stock_product';
      $data['getAllProduct']  = $this->wandalibs->getAllProduct();
      $data['getAllSupplier'] = $this->wandalibs->getAllSupplier();
      $data['getProductById'] = $this->wandalibs->getProductById($code_product);
      $this->load->view('templates/core', $data);
    }
  }
}
