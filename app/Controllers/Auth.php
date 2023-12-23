<?php

namespace App\Controllers;

use App\Models\Model_auth;

class Auth extends BaseController
{
    protected $Model_auth;
    public function __construct()
    {
        helper('form');
        $this->Model_auth = new Model_auth();
    }

    # view login
    public function index()
    {
        // echo password_hash("1234", PASSWORD_DEFAULT);
        $data = [
            'title' => 'Login',
        ];
        return view('v_login', $data);
    }

    # Login authentikasi
    public function login()
    {
        if ($this->validate([
            'email' => [
                'label' => 'Email',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required'
                ],
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required'
                ],
            ]
        ])) {

            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');
            $check = $this->Model_auth->logins($email);

            if ($check) {
                if ($check['status'] == (int)1) {
                    if (password_verify($password, $check['password'])) {
                        $newdata = [
                            'log' => true,
                            'id_user'  => $check['id_user'],
                            'nama_user'  => $check['nama_user'],
                            'email'     => $check['email'],
                            'level'     => $check['level'],
                            'created_at' => $check['created_at'],
                            'avatar'     => $check['avatar'],

                            'id_dep'     => $check['id_dep'],
                            'nama_dep'     => $check['nama_dep'],
                            'id_sub_dep'     => $check['id_sub_dep'],
                            'nama_sub_dep'     => $check['nama_sub_dep'],
                        ];
                        session()->set($newdata);
                        return redirect()->to(base_url('home'));
                    } else {
                        session()->setFlashdata('pesan', 'Login gagal, Pasword anda salah');
                        return redirect()->to(base_url('/'));
                    }
                } else {
                    session()->setFlashdata('pesan', 'Login gagal, Akun anda dinonaktifkan');
                    return redirect()->to(base_url('/'));
                }
            } else {
                session()->setFlashdata('pesan', 'Login gagal, Email anda salah');
                return redirect()->to(base_url('/'));
            }
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('/'));
        }
    }
    # ./ Login /entikasi

    # logout
    public function logout()
    {
        session()->remove('log');
        session()->remove('nama_user');
        session()->remove('email');
        session()->remove('level');
        session()->remove('avatar');
        session()->setFlashdata('pesan', 'Logout');
        return redirect()->to(base_url('/'));
    }

    # view lupa password
    public function forgot_password()
    {
        $data = [
            'title' => 'Lupa Password',
        ];
        return view('v_login_forgot_password', $data);
    }
}