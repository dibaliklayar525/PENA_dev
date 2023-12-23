<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUser extends Model
{
    protected $table = 'tbl_user';
    protected $primaryKey = 'id_user';

    # menampilkan semua data kategori
    public function all_data()
    {
        return $this->db->table('tbl_user')
            ->join('tbl_dep', 'tbl_dep.id_dep = tbl_user.id_dep', 'left')->join('tbl_level', 'tbl_level.id_level = tbl_user.level', 'left')
            ->join('tbl_sub_dep', 'tbl_sub_dep.id_sub_dep = tbl_user.id_sub_dep', 'left')
            ->orderBy('id_user', 'desc')->get()->getResultArray();
    }
    public function all_dataa()
    {
        return $this->db->table('tbl_sub_dep')->get()->getResult();
    }
    # add kategori
    public function add($data)
    {
        return $this->db->table('tbl_user')->insert($data);
    }
    # edit kategori
    public function edit($data)
    {
        return $this->db->table('tbl_user')->where('id_user', $data['id_user'])->update($data);
    }
    # search kategori
    public function search($keyword)
    {
        return $this->table('tbl_user')->like('nama_kategori', $keyword)->orLike('tahun', $keyword);
    }

    # tbl Level
    public function tbl_level()
    {
        return $this->db->table('tbl_level')->orderBy('id_level', 'desc')->get()->getResultArray();
    }
}