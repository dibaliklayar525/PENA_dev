<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_auth extends Model
{
    # Login
    public function logins($email)
    {
        return $this->db->table('tbl_user')
            ->join('tbl_dep', 'tbl_dep.id_dep = tbl_user.id_dep', 'left')
            ->join('tbl_sub_dep', 'tbl_sub_dep.id_sub_dep = tbl_user.id_sub_dep', 'left')
            ->where(
                [
                    'email' => $email,
                ]
            )->get()->getRowArray();
    }

    # Lupa Password
    public function lupa_password()
    {
    }
}