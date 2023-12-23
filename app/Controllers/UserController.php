<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelUser;
use App\Models\ModelDepartemen;

class UserController extends BaseController
{
    protected $ModelUser;
    protected $ModelDepartemen;
    public function __construct()
    {
        helper('form', 'url', 'file');

        $this->ModelUser = new ModelUser();
        $this->ModelDepartemen = new ModelDepartemen();
    }

    public function index()
    {
        $data = [
            'title' => 'User',
            'user' => $this->ModelUser->all_data(),
        ];
        return view('user/v_index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Tambah User',
            'level' => $this->ModelUser->tbl_level(),
            'departemen' => $this->ModelDepartemen->all_data(),
        ];
        return view('user/v_add', $data);
    }

    public function tbl_dep()
    {
        $get    =  $this->ModelDepartemen->all_data();
        $output = '<option value="">--Pilih Departemen--</option>';
        foreach ($get as $k) {
            $output .= '<option value="' . $k['id_dep'] . '" id_dep="' . $k['id_dep'] . '">' . $k['nama_dep'] . '</option>';
        }
        echo json_encode($output, 200);
    }

    function tbl_sub_dep()
    {
        $id = $this->request->getVar('idd');
        $data = $this->ModelDepartemen->sub_dep_byId($id);
        $output = '<option value="">--Pilih Sub Departemen--</option>';

        foreach ($data as $k) {
            $output .= '<option value="' . $k->id_sub_dep . '">' . $k->nama_sub_dep . '</option>';
        }
        echo json_encode($output, 200);
    }

    public function insert()
    {
        if ($this->validate([
            'nama_user' => [
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required'
                ],
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|is_unique[tbl_user.email]',
                'errors' => [
                    'required' => '{field} required',
                    'is_unique' => '{field} sudah ada'
                ],
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required'
                ],
            ],
            'retype_password' => [
                'label' => 'Retype Password',
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => '{field} required',
                    'matches' => '{field} tidak sama'
                ],
            ],
            'level' => [
                'label' => 'Level',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required'
                ],
            ],
            'id_dep' => [
                'label' => 'Departemen',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required'
                ],
            ],
            'id_sub' => [
                'label' => 'Sub Departemen',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required'
                ],
            ],
            'avatar' => [
                'label' => 'avatar',
                'rules' => 'uploaded[avatar]'
                    . '|is_image[avatar]'
                    . '|mime_in[avatar,image/jpg,image/jpeg,image/png]'
                    . '|max_size[avatar,1024]',
                'errors' => [
                    'uploaded' => '{field} required',
                    'max_size' => '{field} 1024kb',
                    'mime_in' => '{field} png/jpg',
                ],
            ],
        ])) {

            $nama_user = $this->request->getVar('nama_user');

            # upload
            $avatar = $this->request->getFile('avatar');
            $file_name = $avatar->getRandomName();

            $data = [
                'nama_user' => $nama_user,
                'avatar' => $file_name,
                'email' => $this->request->getPost('email'),
                'username' => trim(substr($nama_user, 0, 10) . '_' . time()),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'status' => (int)1,
                'level' => $this->request->getPost('level'),
                'id_dep' => $this->request->getPost('id_dep'),
                'id_sub_dep' => $this->request->getPost('id_sub'),
            ];

            $avatar->move('img/avatar/', $file_name);

            if ($this->ModelUser->add($data)) {
                session()->setFlashdata('pesan', 'User ' . '<b>' . $nama_user . '</b>' . ' Berhasil ditambahkan');
                return redirect()->to(base_url('user/add'));
            } else {
            }
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('user/add'));
        }
    }

    # edit
    public function edit($id_user)
    {
        $data = [
            'title' => 'Edit User',
            'user' => $this->ModelUser->all_data(),
        ];
        var_dump(decrypt_url($id_user));
        return view('user/v_edit', $data);
    }

    # hapus
    public function delete()
    {
        $del_id = $this->request->getVar('del_id');
        $user = $this->ModelUser->delete($del_id);

        if ($user) {
            // 12 E-Arsip Codeigniter 4 - CRUD User Part 5 delete foto di folder blm bisa
            if ($user['avatar'] !== "") {
                unlink('img/avatar/' . $user['avatar'] . '');
            }
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