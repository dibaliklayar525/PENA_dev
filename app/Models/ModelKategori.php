<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKategori extends Model
{
    protected $table = 'tbl_kategori';
    protected $primaryKey = 'id_kategori';

    # search kategori
    public function search($keyword)
    {
        return $this->table('tbl_kategori')->like('nama_kategori', $keyword)->orLike('tahun', $keyword);
    }

    # menampilkan semua data kategori
    public function all_data()
    {
        return $this->db->table('tbl_kategori')->join('tbl_kategori_sub', 'tbl_kategori_sub.id=tbl_kategori.id_kategori_sub', 'left')->orderBy('id_kategori', 'desc')->get()->getResultArray();
    }

    # add kategori
    public function add($data)
    {
        return $this->db->table('tbl_kategori')->insert($data);
    }

    # edit kategori
    public function edit($data)
    {
        return $this->db->table('tbl_kategori')->where('id_kategori', $data['id_kategori'])->update($data);
    }

    # by id
    public function byId($id)
    {
        return $this->db->table('tbl_kategori')->getWhere(['id_kategori' => $id])->getResult();
    }


    // Tabel Sub Kategori Untuk Surat Ketua Atau Sekretaris
    public function subKategori()
    {
        return $this->db->table('tbl_kategori_sub')->get()->getResultArray();
    }
}
