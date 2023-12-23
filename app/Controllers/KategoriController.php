<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelKategori;

class KategoriController extends BaseController
{
    protected $ModelKategori;

    public function __construct()
    {
        helper('form', 'url', 'file');
        $this->ModelKategori = new ModelKategori();
    }

    public function index()
    {

        // pagination
        $limit = 5;
        $current_page = $this->request->getVar('page_tbl_kategori') ? $this->request->getVar('page_tbl_kategori') : 1;

        // search
        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $kategori = $this->ModelKategori->search($keyword);
        } else {
            $kategori = $this->ModelKategori;
        }

        $data = [
            'title' => 'Kategori',
            'subKategori' => $this->ModelKategori->subKategori(),
            'tbl_kategori' => $kategori->join('tbl_kategori_sub', 'tbl_kategori_sub.id=tbl_kategori.id_kategori_sub', 'left')->paginate($limit, 'tbl_kategori'),
            'pager' => $this->ModelKategori->pager,
            'limit' => $limit,
            'current_page' => $current_page
        ];

        return view('v_kategori', $data);
    }

    # add kategori
    public function add()
    {
        if ($this->request->isAJAX()) {

            $validation = \config\Services::validation();
            $valid = $this->validate([
                'nama_kategori' => [
                    'label' => 'Required',
                    'rules' => [
                        'required',
                    ],
                    'errors' => [
                        'required' => '{field} wajib diisi',
                    ],
                ],
                'id_kat_sub' => [
                    'label' => 'Required',
                    'rules' => [
                        'required',
                    ],
                    'errors' => [
                        'required' => '{field} wajib diisi',
                    ],
                ],
            ]);

            if (!$valid) {
                $data = [
                    'error'  => [
                        'nama_kategori' => $validation->getErrors('nama_kategori'),
                        'id_kat_sub' => $validation->getErrors('id_kat_sub'),
                    ],
                ];
            } else {
                $data_upd = [
                    'nama_kategori' => $this->request->getPost('nama_kategori'),
                    'id_kategori_sub' => $this->request->getPost('id_kat_sub'),
                ];

                if ($this->ModelKategori->add($data_upd)) {
                    $data = array(
                        'response'  => 'success',
                        'message'   => 'Berhasil.'
                    );
                } else {
                    $data = array(
                        'response'  => 'error',
                        'message'   => 'Gagal'
                    );
                }
            }

            echo json_encode($data);
        } else {
            print_r("error");
        }
    }

    # edit kategori
    public function edit($id_kategori)
    {
        $data = array(
            'id_kategori' => $id_kategori,
            'nama_kategori' => $this->request->getPost('nama_kategori'),
            'tahun' => $this->request->getPost('tahun')
        );

        if ($this->ModelKategori->edit($data)) {
            session()->setFlashdata('pesan', 'Berhasil edit');
            return redirect()->to(base_url('kategori'));
        } else {
        }
    }

    # hapus kategori
    public function delete()
    {
        $del_id = $this->request->getVar('del_id');

        if ($this->ModelKategori->delete($del_id)) {
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
