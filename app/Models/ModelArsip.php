<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelArsip extends Model
{
    protected $table = 'tbl_arsip';
    protected $primaryKey = 'id_arsip';
    protected $allowedFields = ['id_kategori', 'no_arsip', 'nama_file', 'deskripsi', 'tgl_surat', 'file_arsip', 'id_dep', 'id_sub_dep', 'id_user', 'tahun'];
    protected $column_orderUmum = array('id_arsip', 'id_kategori', 'no_arsip', 'nama_file', 'deskripsi', 'tgl_surat', 'tgl_upload', 'tgl_updated', 'file_arsip', 'status', 'id_dep', 'id_sub_dep', 'id_user', 'tahun'); //Sesuaikan dengan jumlah foeld, jika filed tidak ditampilkan buat null
    protected $column_searchUmum = array('no_arsip', 'nama_file', 'deskripsi', 'tgl_upload', 'tgl_surat'); //field yang diizin untuk pencarian 
    protected $orderUmum = array('id_arsip' => 'desc'); // default order 

    # menampilkan semua data kategori
    public function all_data()
    {
        return $this->db->table('tbl_arsip')
            ->join('tbl_dep', 'tbl_dep.id_dep = tbl_arsip.id_dep', 'left')
            ->join('tbl_sub_dep', 'tbl_sub_dep.id_sub_dep = tbl_arsip.id_sub_dep', 'left')
            ->join('tbl_user', 'tbl_user.id_user = tbl_arsip.id_user', 'left')
            ->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_arsip.id_kategori', 'left')
            ->orderBy('id_arsip', 'desc')->get()->getResultArray();
    }

    public function tblArsip($querySelect, $row)
    {
        return $this->db->query('' . $querySelect . ' ' . $row . ' FROM tbl_arsip')->getResult();
    }

    public function detail_data($id_arsip)
    {
        return $this->db->table('tbl_arsip')
            ->join('tbl_dep', 'tbl_dep.id_dep = tbl_arsip.id_dep', 'left')
            ->join('tbl_sub_dep', 'tbl_sub_dep.id_dep = tbl_dep.id_dep', 'left')
            ->join('tbl_user', 'tbl_user.id_user = tbl_arsip.id_user', 'left')
            ->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_arsip.id_kategori', 'left')
            ->join('tbl_kategori_sub', 'tbl_kategori_sub.id = tbl_kategori.id_kategori_sub', 'left')
            ->where('id_arsip', $id_arsip)->get()->getRowArray();
    }

    # add kategori
    public function add($data)
    {
        return $this->db->table('tbl_arsip')->insert($data);
    }

    # edit kategori
    public function edit($data)
    {
        return $this->db->table('tbl_arsip')->where('id_user', $data['id_user'])->update($data);
    }

    # search kategori
    public function search($keyword)
    {
        return $this->table('tbl_arsip')->like('nama_kategori', $keyword)->orLike('tahun', $keyword);
    }

    # tbl Level
    public function tbl_level()
    {
        return $this->db->table('tbl_level')->orderBy('id_level', 'desc')->get()->getResultArray();
    }

    # by id
    public function byId($id)
    {
        return $this->db->table('tbl_arsip')->getWhere(['id_arsip' => $id]);
    }
    public function getById($id)
    {
        return $this->db->table('tbl_arsip')->where(['id_arsip' => $id])->get()->getRowArray();
    }

    function filterData($row, $isi)
    {
        $this->db->table('tbl_arsip');
        $this->where([$row => $isi]);
    }

    /* Data tables Server Side */
    private function dataTables($tahunArsip, $kategori)
    {
        if ($tahunArsip) {
            $this->filterData('tahun', $tahunArsip);
        }
        if ($kategori) {
            $this->filterData('id_kategori', $kategori);
        }

        /* search */
        $i = 0;
        foreach ($this->column_searchUmum as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->groupStart();
                    $this->like($item, $_POST['search']['value']);
                } else {
                    $this->orLike($item, $_POST['search']['value']);
                }
                if (count($this->column_searchUmum) - 1 == $i)
                    $this->groupEnd();
            }
            $i++;
        }

        /* order */
        if (@isset($_POST['order'])) {
            $this->orderBy($this->column_orderUmum[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (@isset($this->orderUmum)) {
            $order = $this->orderUmum;
            $this->orderBy(key($order), $order[key($order)]);
        }
    }

    function getDataTables($tahunArsip, $kategori)
    {
        $this->dataTables($tahunArsip, $kategori);

        if (@$_POST['length'] != -1)
            $this->limit($_POST['length'], $_POST['start']);
        $query = $this->get();
        return $query->getResult(); // return JSON Response
    }
    // recordsTotal
    public function count_allUmum()
    {
        return $this->db->table($this->table)->countAllResults();
    }
    // recordsFiltered
    function count_filteredUmum($tahunArsip, $kategori)
    {
        $this->dataTables($tahunArsip, $kategori);
        return  $this->countAllResults();
    }
    /* ./ Data tables Server Side */
}
