<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelArsip;
use App\Models\ModelKategori;
use App\Config\Services;

class ArsipController extends BaseController
{
    protected $ModelArsip;
    protected $ModelKategori;

    public function __construct()
    {
        helper('form', 'url', 'file');
        $this->ModelKategori = new ModelKategori();
        $this->ModelArsip = new ModelArsip();
    }

    public function index()
    {
        $data = [
            'title' => 'Arsip',
            'tahun' => $this->ModelArsip->tblArsip('SELECT DISTINCT', 'tahun'),
            'kategori' => $this->ModelKategori->all_data(),
        ];
        return view('arsip/v_index', $data);
    }

    // data tables server side
    public function serverSide()
    {
        $tahunArsip = $this->request->getPost('tahun');
        $kategori = $this->request->getPost('id_kategori');

        $arsip = $this->ModelArsip->getDataTables($tahunArsip, $kategori);
        $data = array();
        $no   = @$_POST['start'];
        foreach ($arsip as $n) {
            $no++;
            $row    = array();
            $row[]  = $no;
            $row[]  = '
            <a href="arsip/view/' . encrypt_url($n->id_arsip) . '" target="_blank" title="lihat" class="btn btn-xs bg-maroon"><i class="fa fa-eye"></i></a>
<a href="' . base_url('file') . '/' . $n->file_arsip . '" target="_blank" download="file" title="unduh"
    class="btn btn-xs bg-green"><i class="fa fa-download"></i></a>
';
            $row[] = $n->no_arsip;
            $row[] = $n->nama_file;
            $row[] = tglIndo($n->tgl_upload);
            $row[] = $n->tgl_surat;
            $row[] = $n->tahun;
            $row[] = '
<a class="btn btn-warning btn-xs" id="edit" title="Edit" editByid="' . $n->id_arsip . '"><i class="fa fa-edit"></i></a>
<a class="btn btn-default btn-xs pull-right" id="btn-del" title="Hapus" deletedById="' . $n->id_arsip . '"><i
        class="fa fa-trash"></i></a>
';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->ModelArsip->count_allUmum(),
            "recordsFiltered" => $this->ModelArsip->count_filteredUmum($tahunArsip, $kategori),
            "data" => $data,
        );
        return $this->response->setJSON($output);
    }

    public function viewPdf($id_arsip)
    {
        $detail = $this->ModelArsip->detail_data(decrypt_url($id_arsip));
        $data = [
            'title' => '' . $detail['nama_file'] . '',
            'detail' => $detail,
        ];
        // var_dump(decrypt_url($id_arsip));
        return view('arsip/v_detail', $data);
    }

    // print pdf by id
    // public function printbyId($id)
    // {
    // require '../vendor/autoload.php';
    // $mpdf = new \Mpdf\Mpdf();

    // $view = decrypt_url($id);
    // $data = $this->ModelArsip->byId($view)->getResultArray();

    // $html = view('arsip/mpdf/printbyId', ['data' => $data]);
    // $mpdf->WriteHTML($html);

    // # INLINE PREVIEW
    // $mpdf->Output('sdfsdfs' . '.pdf', \Mpdf\Output\Destination::INLINE);
    // }

    # add
    public function add()
    {
        if ($this->request->isAJAX()) {

            $validation = \config\Services::validation();

            $valid = $this->validate([
                'nama_file' => [
                    'label' => 'Nama',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ],
                ],
                'no_arsip' => [
                    'label' => 'Nomor Surat',
                    'rules' => 'required|trim|is_unique[tbl_arsip.no_arsip]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} sudah pernah di input sebelumnya'
                    ],
                ],
                'deskripsi' => [
                    'label' => 'Deskripsi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ],
                ],
                'level' => [
                    'label' => 'Kategori',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ],
                ],
                'tgl_surat' => [
                    'label' => 'Tanggal Surat',
                    'rules' => 'required|trim',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ],
                ],
                'tahun' => [
                    'label' => 'Tahun ',
                    'rules' => 'required|trim',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ],
                ],
                'id_dep' => [
                    'label' => 'Kesalahan! ID Departemen',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak ditemukan.'
                    ],
                ],
                'id_sub_dep' => [
                    'label' => 'Kesalahan! ID Sub - Departemen',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak ditemukan'
                    ],
                ],
                'id_user' => [
                    'label' => 'Kesalahan! ID User',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak ditemukan'
                    ],
                ],
                'file_arsip' => [
                    'label' => 'Unggah file',
                    'rules' => 'uploaded[file_arsip]'
                        . '|mime_in[file_arsip,image/jpg,image/jpeg,image/png,application/pdf]'
                        . '|max_size[file_arsip,4024]',
                    'errors' => [
                        'uploaded' => '{field} wajib diisi',
                        'max_size' => '{field} maksimal 4024kb',
                        'mime_in' => '{field} format png/jpg/pdf',
                    ],
                ],
            ]);

            if (!$valid) {
                $data = [
                    'error' => [
                        'nama_file' => $validation->getErrors('nama_file'),
                        'no_arsip' => $validation->getErrors('no_arsip'),
                        'deskripsi' => $validation->getErrors('deskripsi'),
                        'level' => $validation->getErrors('level'),
                        'tgl_surat' => $validation->getErrors('tgl_surat'),
                        'tahun' => $validation->getErrors('tahun'),
                        'id_dep' => $validation->getErrors('id_dep'),
                        'id_sub_dep' => $validation->getErrors('id_sub_dep'),
                        'id_user' => $validation->getErrors('id_user'),
                        'file_arsip' => $validation->getErrors('file_arsip'),
                    ],
                ];
            } else {
                $no_arsip = $this->request->getVar('no_arsip');
                # upload
                $file_arsip = $this->request->getFile('file_arsip');
                $file_name = $file_arsip->getRandomName();

                $data = [
                    'id_kategori' => $this->request->getVar('level'),
                    'no_arsip' => $no_arsip,
                    'nama_file' => $this->request->getVar('nama_file'),
                    'deskripsi' => $this->request->getVar('deskripsi'),
                    'tgl_surat' => $this->request->getVar('tgl_surat'),
                    'file_arsip' => $file_name,
                    'status' => (int)0,
                    'id_dep' => $this->request->getVar('id_dep'),
                    'id_sub_dep' => $this->request->getVar('id_sub_dep'),
                    'id_user' => $this->request->getVar('id_user'),
                    'tahun' => $this->request->getVar('tahun'),
                ];

                $file_arsip->move('file', $file_name);

                if ($this->ModelArsip->add($data)) {
                    $data = array(
                        'responsez' => 'success',
                        'message' => 'data arsip berhasil disimpan.'
                    );
                } else {
                    $data = array(
                        'responsez' => 'error',
                        'message' => 'gagal menghapus data'
                    );
                }
            }
            echo json_encode($data);
        } else {
            exit;
        }
    }

    # delete
    public function delete()
    {
        if ($this->request->isAJAX()) {
            $del_id = $this->request->getVar('del_id');
            if ($del_id) {

                // menghapus file lama
                $arsip = $this->ModelArsip->getById($del_id);
                if ($arsip['file_arsip'] !== "") {
                    unlink('file/' . $arsip['file_arsip']);
                }
                $this->ModelArsip->delete($del_id);
                $data = array(
                    'response' => 'success',
                    'message' => 'data berhasil dihapus.'
                );
            }
            echo json_encode($data);
        } else {
            exit;
        }
    }

    // edit
    public function edit()
    {
        if ($this->request->isAJAX()) {
            $editByid = $this->request->getVar('editByid');
        } else {
            exit;
        }
    }
}
