<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelDepartemen;

class DepartemenController extends BaseController
{
    protected $ModelDepartemen;

    public function __construct()
    {
        helper('form', 'url', 'file');
        $this->ModelDepartemen = new ModelDepartemen();
    }

    public function index()
    {

        // pagination
        $limit = 5;
        $current_page = $this->request->getVar('page_tbl_dep') ? $this->request->getVar('page_tbl_dep') : 1;

        // search
        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $departemen = $this->ModelDepartemen->search($keyword);
        } else {
            $departemen = $this->ModelDepartemen;
        }

        $data = [
            'title' => 'Departemen',
            'tbl_dep' => $departemen->paginate($limit, 'tbl_dep'),
            'pager' => $this->ModelDepartemen->pager,
            'limit' => $limit,
            'current_page' => $current_page
        ];

        return view('v_departemen', $data);
    }

    # add departemen
    public function add()
    {
        $data = array(
            'nama_dep' => $this->request->getPost('nama_dep'),
        );

        if ($this->ModelDepartemen->add($data)) {
            session()->setFlashdata('pesan', 'Berhasil ditambahkan');
            return redirect()->to(base_url('departemen'));
        } else {
        }
    }

    # edit kategori
    public function edit($id_dep)
    {
        $data = array(
            'id_dep' => $id_dep,
            'nama_dep' => $this->request->getPost('nama_dep'),
        );

        if ($this->ModelDepartemen->edit($data)) {
            session()->setFlashdata('pesan', 'Berhasil edit');
            return redirect()->to(base_url('departemen'));
        } else {
        }
    }

    # hapus kategori
    public function delete()
    {
        $del_id = $this->request->getVar('del_id');

        if ($this->ModelDepartemen->delete($del_id)) {
            $data = array(
                'response'  => 'success',
                'message'   => 'data berhasil dihapus.'
            );
        } else {
            $data = array(
                'response'  => 'error',
                'message'   => 'gagal menghapus data Kategori'
            );
        }
        return $this->response->setJSON($data);
    }
}