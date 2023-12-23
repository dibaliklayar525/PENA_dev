<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDepartemen extends Model
{
    protected $table            = 'tbl_dep';
    protected $primaryKey       = 'id_dep';

    # menampilkan semua data Departemen
    public function all_data()
    {
        return $this->db->table('tbl_dep')->orderBy('id_dep', 'desc')->get()->getResultArray();
    }
    # add Departemen
    public function add($data)
    {
        return $this->db->table('tbl_dep')->insert($data);
    }
    # edit Departemen
    public function edit($data)
    {
        return $this->db->table('tbl_dep')->where('id_dep', $data['id_dep'])->update($data);
    }
    # search Departemen
    public function search($keyword)
    {
        return $this->table('tbl_dep')->like('nama_dep', $keyword);
    }

    # sub departemen
    public function sub_dep_byId($id)
    {
        return $this->db->table('tbl_sub_dep')->getWhere(['id_dep' => $id])->getResult();
    }
}