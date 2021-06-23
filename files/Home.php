<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Home extends CI_Controller
{
    public function __construct()
    {
        // parent::__construct();
        parent::__construct();
        if (!$this->session->userdata('level')) {
            redirect('auth/login');
        } elseif ($this->session->userdata('level') == 'admin') {
            $this->load->model('M_data');
            $username = $this->session->userdata('username');
            $nama = $this->session->userdata('nama');
        } else {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data['sm']  = $this->db->count_all('surat_masuk');
        $data['sk'] = $this->db->count_all('surat_keluar');
        $data['ret'] = $this->db->count_all('retensi');
        $data['ar'] = $this->db->count_all('pinjam');
        $data['title'] = 'Dashboard';
        $this->load->view('templates/header', $data);
        $this->load->view('home/sidebar');
        $this->load->view('home/index');
        $this->load->view('templates/footer');
    }

    public function dashboard()
    {
        $data['title'] = 'bg';
        $this->load->view('templates/header', $data);
        $this->load->view('home/sidebar');
        $this->load->view('home/index');
        $this->load->view('templates/footer');
    }

    public function laporan_suratmasuk()
    {
        $data['title'] = 'Surat Masuk';
        $data['surat_masuk'] = $this->M_data->getSuratMasuk();
        // print_r($data['surat_masuk']);die;
        $this->load->view('templates/header', $data);
        $this->load->view('home/sidebar');
        $this->load->view('home/laporan_suratmasuk');
        $this->load->view('templates/footer');
    }
    public function rapat_pimpinan()
    {
        $data['title'] = 'Buku Agenda Rapat';
        $data['surat_masuk'] = $this->M_data->getRapat();
        $this->load->view('templates/header', $data);
        $this->load->view('home/sidebar');

        $this->load->view('home/laporan_rapat');
        $this->load->view('templates/footer');
    }
    public function rapat_exp($time)
    {
        $data['title'] = 'Ekspor Buku Agenda Rapat';
        $data['surat_masuk'] = $this->M_data->getRapatBy($time);
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "Jadwal Rapat " . $time . ".pdf";
        //	$this->pdf->stream('laporan-data-siswa.pdf', array('Attachment' => 0));
        $this->pdf->load_view('home/export_rapat', $data);
        // $this->load->view("home/export_disposisi/temp_export");
        # code...
    }

    public function laporan_suratkeluar()
    {
        $data['title'] = 'Surat Keluar';
        $data['surat_keluar'] = $this->M_data->getSuratKeluar();
        $this->load->view('templates/header', $data);
        $this->load->view('home/sidebar');

        $this->load->view('home/laporan_suratkeluar');
        $this->load->view('templates/footer');
    }

    public function form_penyusutan()
    {
        $data['title'] = 'Tambah Penyusutan';
        $data['penyusutan'] = $this->M_data->getpenyusutan();
        $this->load->view('templates/header', $data);
        $this->load->view('home/sidebar');

        $this->load->view('home/form_penyusutan');
        $this->load->view('templates/footer');
    }

    public function form_jadwalretensi($id, $type)
    {
        if ($type == 1) {
            $data['surat'] = $this->M_data->getSuratMasukId($id);
        } elseif ($type == 2) {
            $data['surat'] = $this->M_data->getSuratKeluarId($id);
        }
        $data['title'] = 'Tambah Retensi Arsip';
        $data['jenis'] = $type;
        $data['penyusutan'] = $this->M_data->getpenyusutan();
        $data['retensi'] = $this->M_data->getretensi();
        $data['datakategoripinjam'] = $this->M_data->getpinjam();
        $data['datakategoripinjam_2'] = $this->M_data->getpinjam_k();
        $this->load->view('templates/header', $data);
        $this->load->view('home/sidebar');

        $this->load->view('home/form_jadwalretensi');
        $this->load->view('templates/footer');
    }
    public function update_jadwalretensi($id, $type, $no_urut)
    {
        if ($type == 1) {
            $data['surat'] = $this->M_data->getSuratMasukId($id);
        } elseif ($type == 2) {
            $data['surat'] = $this->M_data->getSuratKeluarId($id);
        }
        $data['dataretensi'] = $this->M_data->getRetensiId($no_urut);

        $data['jenis'] = $type;
        $data['title'] = 'Tambah Retensi Arsip';
        $data['penyusutan'] = $this->M_data->getpenyusutan();
        $data['retensi'] = $this->M_data->getretensi();
        $data['datakategoripinjam'] = $this->M_data->getpinjam();
        $data['datakategoripinjam_2'] = $this->M_data->getpinjam_k();
        $this->load->view('templates/header', $data);
        $this->load->view('home/sidebar');

        $this->load->view('home/update_retensi');
        $this->load->view('templates/footer');
    }

    public function form_suratmasuk()
    {
        $data['title'] = 'Tambah Surat Masuk';
        $data['surat_masuk'] = $this->M_data->Laporan_SuratMasuk();
        $data['masalah'] = $this->M_data->getMasalah();
        $this->load->view('templates/header', $data);
        $this->load->view('home/sidebar');

        $this->load->view('home/form_suratmasuk');
        $this->load->view('templates/footer');
    }

    public function form_suratkeluar()
    {
        $data['title'] = 'Tambah Surat Keluar';
        $data['surat_masuk'] = $this->M_data->Laporan_SuratKeluar();
        $data['masalah'] = $this->M_data->getMasalah();
        $this->load->view('templates/header', $data);
        $this->load->view('home/sidebar');

        $this->load->view('home/form_suratkeluar');
        $this->load->view('templates/footer');
    }

    public function jadwal_retensi()
    {
        $data['title'] = 'Jadwal Retensi Arsip';
        $data['retensi'] = $this->M_data->Laporan_dataretensi();
        $this->load->view('templates/header', $data);
        $this->load->view('home/sidebar');

        $this->load->view('home/jadwal_retensi');
        $this->load->view('templates/footer');
    }

    public function getCustomRapat()
    {
        $data['instansi'] = $this->M_data->get_instansi();
        $data['surat_masuk'] = $this->M_data->getCustomRapat();
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "Jadwal Rapat " . $this->input->post('date_a') . " - " . $this->input->post('date_b') . ".pdf";
        //	$this->pdf->stream('laporan-data-siswa.pdf', array('Attachment' => 0));
        $this->pdf->load_view('home/export_rapat', $data);
        // $this->load->view("home/export_disposisi/temp_export");
        # code...
    }
    public function getCustomAgenda()
    {
        $data['instansi'] = $this->M_data->get_instansi();
        $data['agenda'] = $this->M_data->getCustomAgenda();
        // $this->load->view('home/export_agenda', $data);

        $this->load->library('pdf');
        $contxt = stream_context_create([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ]);
        $this->pdf->setHttpContext($contxt);
        $this->pdf->set_option('isRemoteEnabled', true);
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "Buku Agenda " . $this->input->post('date_a') . " - " . $this->input->post('date_b') . ".pdf";
        $this->pdf->load_view('home/export_agenda', $data);

        //	$this->pdf->stream('laporan-data-siswa.pdf', array('Attachment' => 0));
        // $this->load->view("home/export_disposisi/temp_export");
        # code...
    }

    public function penyusutan()
    {
        $data['title'] = 'Penyusutan';
        $data['penyusutan'] = $this->M_data->Laporan_penyusutan();
        $this->load->view('templates/header', $data);
        $this->load->view('home/sidebar');

        $this->load->view('home/penyusutan');
        $this->load->view('templates/footer');
    }

    public function disposisi($id)
    {
        $data['id'] = $id;
        $data['title'] = '';
        $this->load->view('templates/header', $data);
        $this->load->view('home/sidebar');

        $this->load->view('home/disposisi', $data);
        $this->load->view('templates/footer');
    }

    public function pinjam()
    {
        $data['title'] = 'Rekap Surat Dipinjam';
        $data['pinjam'] = $this->M_data->suratdipinjam();
        $this->load->view('templates/header', $data);
        $this->load->view('home/sidebar');

        $this->load->view('templates/pinjam');
        $this->load->view('templates/footer');
    }

    public function proses_tambahpenyusutan()
    {
        $this->M_data->proses_tambahpenyusutan();
        redirect('home/penyusutan');
    }

    public function proses_tambahdataretensi()
    {
        $this->M_data->proses_tambahdataretensi();
        redirect('home/jadwal_retensi');
    }

    public function proses_tambahdatamasuk()
    {
        $temp = explode(".", $_FILES["file_dokumen"]["name"]);
        $newfilename = round(microtime(true)) . '.' . $temp[1];

        $config['file_name']            = $newfilename;
        $config['upload_path']          = "lampiran/";
        $config['allowed_types']        = '*';
        $config['max_size']             = 10000;
        $config['max_width']            = 10000;
        $config['max_height']           = 10000;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('file_dokumen')) {
            $this->session->set_flashdata('error_msg', $this->upload->display_errors());
            redirect('home/form_suratmasuk');
        } else {
            $id = $this->M_data->proses_tambahdatamasuk($newfilename);
            $this->session->set_flashdata('success', 'Berhasil Tambah Data');
            $inp = $this->input->post('btn_1');
            if ($inp == "SIMPAN") {
                if ($this->input->post('rapat') == 0) {
                    redirect('home/laporan_suratmasuk');
                } else {
                    redirect('home/rapat_pimpinan');
                }
            } else {
                redirect('home/disposisi/' . $id);
            }
        }
    }



    public function proses_tambahdatakeluar()
    {
        $temp = explode(".", $_FILES["file_dokumen"]["name"]);
        $newfilename = round(microtime(true)) . '.' . $temp[1];

        $config['file_name']            = $newfilename;
        $config['upload_path']          = "lampiran/";
        $config['allowed_types']        = '*';
        $config['max_size']             = 10000;
        $config['max_width']            = 10000;
        $config['max_height']           = 10000;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('file_dokumen')) {
            $this->session->set_flashdata('error_msg', $this->upload->display_errors());
            redirect('home/form_suratkeluar');
        } else {
            $this->M_data->proses_tambahdatakeluar($newfilename);
            $this->session->set_flashdata('success', 'Berhasil Tambah Data');
            redirect('home/laporan_suratkeluar');
        }
    }

    public function form_pinjamarsip($id, $type)
    {
        $data['title'] = 'Form Pinjam Arsip';

        if ($type == 1) {
            $data['surat'] = $this->M_data->getSuratMasukId($id);
        } elseif ($type == 2) {
            $data['surat'] = $this->M_data->getSuratKeluarId($id);
        }

        $data['datakategoripinjam'] = $this->M_data->getpinjam();
        $data['datakategoripinjam_2'] = $this->M_data->getpinjam_k();
        $data['unit'] = $this->M_data->getUnit();
        $this->load->view('templates/header', $data);
        $this->load->view('home/sidebar');

        $this->load->view('home/form_pinjamarsip', $data);
        $this->load->view('templates/footer');
    }

    public function proses_tambahpinjamdata()
    {
        $data = [
            "nomor_peminjam" => $this->input->post('nomor_peminjam'),
            "tanggal_pinjam" => $this->input->post('tanggal_pinjam'),
            "nip" => $this->input->post('nip'),
            "nama_peminjam" => $this->input->post('nama_peminjam'),
            "unit_kerja" => $this->input->post('unit_kerja'),
            "tanggal_kembali" => $this->input->post('tanggal_kembali'),
            "dokumen_dipinjam" => $this->input->post('selek'),
            'id_user' => $this->session->userdata('id'),
            'status' => 'Belum Dikembalikan'
        ];

        $this->db->insert('pinjam', $data);

        $data2 = [

            "tanggal_pinjam" => $this->input->post('tanggal_pinjam'),
            "nomor_peminjam" => $this->input->post('nomor_peminjam'),
            "nama_peminjam" => $this->input->post('nama_peminjam'),
            "unit_kerja" => $this->input->post('unit_kerja_2'),
            "tanggal_kembali" => $this->input->post('tanggal_kembali'),
            "dokumen_dipinjam" => $this->input->post('selek'),
            "owner" => $this->input->post('owner'),
            "tanggal_awal" => $this->input->post('tanggal_awal'),
            "alamat" => $this->input->post('alamat'),

        ];
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "Bukti Peminjaman.pdf";
        //	$this->pdf->stream('laporan-data-siswa.pdf', array('Attachment' => 0));
        $this->pdf->load_view('home/export_pinjam', $data2);
        // redirect('home/pinjam');
        redirect('home/pinjam');
    }

    public function hapus_penyusutan($no_urut)
    {
        $this->M_data->hapus_penyusutan($no_urut);
        redirect('home/penyusutan');
    }

    public function hapus_dataretensi($urut_surat, $type, $no_urut)
    {
        $this->M_data->hapus_dataretensi($no_urut);
        if ($type == 1) :
            $this->M_data->hapus_datamasuk($urut_surat); elseif ($type == 2) :
            $this->M_data->hapus_datakeluar($urut_surat);
        endif;
        redirect('home/jadwal_retensi');
    }

    public function hapus_datamasuk($no_urut)
    {
        $this->M_data->hapus_datamasuk($no_urut);
        redirect('home/laporan_suratmasuk');
    }

    public function hapus_datakeluar($no_urut)
    {
        $this->M_data->hapus_datakeluar($no_urut);
        redirect('home/laporan_suratkeluar');
    }

    public function update_penyusutan($no_urut)
    {
        $data['title'] = 'Edit Penyusutan';
        $data['penyusutan'] = $this->M_data->Laporan_penyusutan($no_urut);
        $this->load->view('templates/header', $data);
        $this->load->view('home/sidebar');

        $this->load->view('home/penyusutan', $data);
        $this->load->view('templates/footer');
    }

    public function proses_penyusutan($no_urut)
    {
        $this->M_data->proses_updatepenyusutan($no_urut);
        redirect('home/penyusutan');
    }

    // public function update_dataretensi($no_urut)
    // {
    //     $data['title'] = 'Edit Retensi Arsip';
    //     $data['retensi'] = $this->M_data->Laporan_dataretensi($no_urut);
    //     $this->load->view('templates/header', $data);
    //     $this->load->view('home/sidebar');

    //     $this->load->view('home/update_retensi', $data);
    //     $this->load->view('templates/footer');
    // }

    public function proses_updatedataretensi($no_urut)
    {
        $this->M_data->proses_updatedataretensi($no_urut);
        redirect('home/jadwal_retensi');
    }

    public function update_datamasuk($no_urut)
    {
        $data['title'] = 'Edit Surat Masuk';
        $data['surat_masuk'] = $this->M_data->update_datamasuk($no_urut);
        $data['text'] = $this->M_data->update_datamasuk($no_urut);
        $data['masalah'] = $this->M_data->getMasalah();
        $this->load->view('templates/header', $data);
        $this->load->view('home/sidebar');

        $this->load->view('home/update_suratmasuk', $data);
        $this->load->view('templates/footer', $data);
    }

    public function proses_updatedatamasuk($no_urut)
    {
        $code = $this->input->post('save');

        if ($code == 'upload') {
            $temp = explode(".", $_FILES["file_dokumen"]["name"]);
            $newfilename = round(microtime(true)) . '.' . $temp[1];

            $config['file_name']            = $newfilename;
            $config['upload_path']          = "lampiran/";
            $config['allowed_types']        = '*';
            $config['max_size']             = 10000;
            $config['max_width']            = 10000;
            $config['max_height']           = 10000;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('file_dokumen')) {
                $this->session->set_flashdata('error_msg', $this->upload->display_errors());
                redirect('home/update_datamasuk/' . $no_urut);
            } else {
                $data = [
                    "berkas" => $newfilename,
                ];
                $this->M_data->upd_datamasuk($no_urut, $data);
                $this->session->set_flashdata('success', 'Berhasil Upload Dokumen Baru');
                redirect('home/update_datamasuk/' . $no_urut);
            }
            redirect('home/laporan_suratmasuk');
        } elseif ($code == 'save') {
            $data = [
                "dari" => $this->input->post('dari'),
                "kepada" => "",
                "alamat" => $this->input->post('alamat'),
                "kota" => $this->input->post('kota'),
                "indeks" => $this->input->post('indeks'),
                "no_surat" => $this->input->post('no_surat'),
                "tanggal_surat" => $this->input->post('tanggal_surat'),
                "lampiran" => $this->input->post('lampiran'),
                "perihal" => $this->input->post('perihal'),
                "tanggal_simpan" => $this->input->post('tanggal_simpan'),
                "kategori" => $this->input->post('kategori'),
                "surat_rapat" => $this->input->post('rapat'),
                "kode_simpan" => $this->input->post('kode_simpan'),
                "pokok_soal" => $this->input->post('pokok_soal'),
                "isi_ringkasan" => $this->input->post('editordata'),
                'kode_1' => $this->input->post('input_1'),
                'kode_2' => $this->input->post('input_2'),
                'kode_3' => $this->input->post('input_3'),
                'kode_4' => $this->input->post('input_4'),
                'kode_5' => $this->input->post('input_5'),
                'tgl_rapat' => $this->input->post('tgl_rapat'),
                'waktu_rapat' => $this->input->post('waktu_rapat'),
                'tempat_rapat' => $this->input->post('tempat_rapat'),
                'laci' => "",
                'guide' => "",
                'map' => '',
                'nomor_berkas' => ''

            ];
            $this->M_data->upd_datamasuk($no_urut, $data);
            $this->session->set_flashdata('success', 'Berhasil Update Data');

            if ($this->input->post('rapat') == 0) {
                redirect('home/laporan_suratmasuk');
            } else {
                redirect('home/rapat_pimpinan');
            }
        }
    }

    public function update_datakeluar($no_urut)
    {
        $data['title'] = 'Edit Surat Keluar';
        $data['surat_masuk'] = $this->M_data->update_datakeluar($no_urut);
        $data['text'] = $this->M_data->update_datakeluar($no_urut);
        $data['masalah'] = $this->M_data->getMasalah();
        $this->load->view('templates/header', $data);
        $this->load->view('home/sidebar');

        $this->load->view('home/update_suratkeluar', $data);
        $this->load->view('templates/footer', $data);
    }

    public function proses_updatedatakeluar($no_urut)
    {
        $code = $this->input->post('save');

        if ($code == 'upload') {
            $temp = explode(".", $_FILES["file_dokumen"]["name"]);
            $newfilename = round(microtime(true)) . '.' . $temp[1];

            $config['file_name']            = $newfilename;
            $config['upload_path']          = "lampiran/";
            $config['allowed_types']        = '*';
            $config['max_size']             = 10000;
            $config['max_width']            = 10000;
            $config['max_height']           = 10000;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('file_dokumen')) {
                $this->session->set_flashdata('error_msg', $this->upload->display_errors());
                redirect('home/update_datakeluar/' . $no_urut);
            } else {
                $data = [
                    // "dari" => $this->input->post('dari'),
                    "berkas" => $newfilename,
                ];
                $this->M_data->upd_datakeluar($no_urut, $data);
                $this->session->set_flashdata('success', 'Berhasil Upload Dokumen Baru');
                redirect('home/update_datakeluar/' . $no_urut);
            }
            redirect('home/update_datakeluar/' . $no_urut);
        } elseif ($code == 'save') {
            $data = [
                // "dari" => $this->input->post('dari'),
                "kepada" => $this->input->post('dari'),
                "alamat" => $this->input->post('alamat'),
                "kota" => $this->input->post('kota'),
                "indeks" => $this->input->post('indeks'),
                "no_surat" => $this->input->post('no_surat'),
                "tanggal_surat" => $this->input->post('tanggal_surat'),
                "lampiran" => $this->input->post('lampiran'),
                "perihal" => $this->input->post('perihal'),
                "tanggal_simpan" => $this->input->post('tanggal_simpan'),
                "kategori" => $this->input->post('kategori'),
                "kode_simpan" => $this->input->post('kode_simpan'),
                "pokok_soal" => $this->input->post('pokok_soal'),
                "isi_ringkasan" => $this->input->post('editordata'),
                'kode_1' => $this->input->post('input_1'),
                'kode_2' => $this->input->post('input_2'),
                'kode_3' => $this->input->post('input_3'),
                'kode_4' => $this->input->post('input_4'),
                'kode_5' => $this->input->post('input_5'),
                'surat_rapat' => $this->input->post('surat_rapat'),
                'tgl_rapat' => $this->input->post('tgl_rapat'),
                'waktu_rapat' => $this->input->post('waktu_rapat'),
                'tempat_rapat' => $this->input->post('tempat_rapat'),
                'laci' => "",
                'guide' => "",
                'map' => '',
                'nomor_berkas' => ''

            ];
            $this->M_data->upd_datakeluar($no_urut, $data);
            $this->session->set_flashdata('success', 'Berhasil Update Data');
            if ($this->input->post('surat_rapat') == 0) {
                redirect('home/laporan_suratkeluar');
            } else {
                redirect('home/rapat_pimpinan');
            }
        }
    }

    //format export file

    public function export_disposisi()
    {
        $data = [
            "indeks" => $this->input->post('nomor_peminjam'),
            "kategori" => $this->input->post('kategori'),
            "rahasia" => $this->input->post('rahasia'),
            "biasa" => $this->input->post('biasa'),
            "penting" => $this->input->post('penting'),
            "kode_surat" => $this->input->post('kode_surat'),
            'tanggal_penyelesaian' => $this->input->post('tanggal_penyelesaian'),
            'no_tgl' => $this->input->post('no-tgl'),
            'asal' => $this->input->post('nama_peminjam'),
            'ringkasan' => $this->input->post('ringkasan'),
            'instruksi' => $this->input->post('instruksi'),
            'diteruskan' => $this->input->post('diteruskan'),
            'kepada' => $this->input->post('kepada'),
            'tgl_kembali' => $this->input->post('tgl_kembali'),
            'tgl_surat' => $this->input->post('tgl-surat'),
            'nomor' => $this->input->post('nomor'),
            'tgl-terima' => $this->input->post('instruksi'),
            'code' => $this->input->post('code'),
            'no_disposisi' => $this->input->post('no_disposisi'),
            'dari' => $this->input->post('dari'),
        ];
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "surat disposisi.pdf";
        //	$this->pdf->stream('laporan-data-siswa.pdf', array('Attachment' => 0));
        $this->pdf->load_view('home/export_disposisi/temp_export', $data);
        // $this->load->view("home/export_disposisi/temp_export");
        # code...
    }

    //pengaturan instansi
    public function pengaturan_instansi()
    {
        $data['instansi'] = $this->M_data->get_instansi();
        $data['pokok_masalah'] = $this->M_data->getMasalah();
        $data['unit'] = $this->M_data->getUnit();
        $data['title'] = 'Pengaturan Instansi';
        $this->load->view('templates/header', $data);
        $this->load->view('home/sidebar');

        $this->load->view('home/set_instansi', $data);
        $this->load->view('templates/footer');
    }

    //update instansi
    public function update_instansi()
    {
        $temp = explode(".", $_FILES["logo"]["name"]);
        $newfilename = round(microtime(true)) . '.' . $temp[1];

        $config['file_name']            = $newfilename;
        $config['upload_path']          = "files/img/";
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 10000;
        $config['max_width']            = 10000;
        $config['max_height']           = 10000;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('logo')) {
            $this->session->set_flashdata('error_msg', $this->upload->display_errors());
            redirect('home/pengaturan_instansi');
        } else {
            $data = [
                "header_1" => $this->input->post("h1"),
                "header_2" => $this->input->post("h2"),
                "header_3" => $this->input->post("h3"),
                "header_4" => $this->input->post("h4"),
                "header_5" => $this->input->post("h5"),
                "header_6" => $this->input->post("h6"),
                "logo" => $newfilename,
            ];
            $this->db->update('instansi', $data);
            $this->session->set_flashdata('success', 'Berhasil Tambah Data');
            redirect('home/pengaturan_instansi');
        }
    }

    //buku agenda

    public function buku_agenda()
    {
        $data['title'] = 'Buku Agenda';
        $data['surat_masuk'] = $this->M_data->getSuratMasuk();
        $data['surat_keluar'] = $this->M_data->getSuratKeluar();
        $data['instansi'] = $this->M_data->get_instansi();
        $this->load->view('templates/header', $data);
        $this->load->view('home/sidebar');

        $this->load->view('home/buku_agenda', $data);
        $this->load->view('templates/footer');
    }

    // edit lokasi map

    public function edit_lokasi($id)
    {
        $data['title'] = 'Edit Lokasi';
        $data['val'] = $this->M_data->update_datamasuk($id);
        $data['value'] = $id;
        $this->load->view('templates/header', $data);
        $this->load->view('home/sidebar');

        $this->load->view('home/edit_map', $data);
        $this->load->view('templates/footer');
        # code...
    }
    public function edit_lokasi_sk($id)
    {
        $data['title'] = 'Edit Lokasi Surat Keluar';
        $data['value'] = $id;
        $data['val'] = $this->M_data->update_datakeluar($id);
        $this->load->view('templates/header', $data);
        $this->load->view('home/sidebar');

        $this->load->view('home/edit_map_sk', $data);
        $this->load->view('templates/footer');
        # code...
    }

    public function ubah_lokasi($id)
    {
        $this->M_data->update_lokasi_sm($id);
        redirect("home/buku_agenda");
        # code...
    }
    public function ubah_lokasi_sk($id)
    {
        $this->M_data->update_lokasi_sk($id);
        redirect("home/buku_agenda");
        # code...
    }

    public function password($pw)
    {
        $username=
        $this->session->userdata('username');
        $result = $this->db->get_where('user', ['username' => $username])->row_array();
        $password=md5($pw);

        if ($result) {
            $this->db->where("username", $username);
            $this->db->where("password", $password);
            $query = $this->db->get('user');
            if ($query->num_rows() > 0) {
                return true;
            } else {
                // print_r($password);die;
                $this->form_validation->set_message('password', 'Password salah');
                return false;
            }
        }
    }

    public function edit_profil()
    {
        $data['title'] = "Edit Profil";
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[3]|matches[password3]', [
            'matches' => 'Password tidak sesuai',
            'min_length' => 'Password terlalu pendek'
        ]);
        $this->form_validation->set_rules('password3', 'Password', 'required|trim|matches[password2]');
        $username=
        $this->session->userdata('username');
        $password=$this->input->post('password1');
        $password2=$this->input->post('password2');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|callback_password');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('home/sidebar');
            $this->load->view('home/sunting');
            $this->load->view('templates/footer');
        } else {
            $this->db->set('password', md5($password2));
            $this->db->where('username', $username);
            $this->db->update('user');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
					Sukses Ubah Password
					</div>');
            redirect('home/edit_profil', 'refresh');
        }
    }

    public function update_pinjam($no_urut)
    {
        $this->db->where('no_urut', $no_urut);
        $this->db->update('pinjam', array('status' => 'Sudah Dikembalikan'));
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
					Sukses Update Data
					</div>');
        redirect('home/pinjam');

        # code...
    }

    public function fetch()
    {
        $output = '';
        $query = $this->input->post('query');

        $data = $this->M_data->cariSm($query);
        $total = $data->num_rows();

        if ($data->num_rows() > 0  && !empty($query)) {
            $output .= '
				<div class="col-lg-12 mb-2 p-0">
				<div class="card bg-info text-white shadow">
				<div class="card-body">
				<div class="row">
				<div class="col-8">
				  Pencarian di Surat Masuk
				  <div class="text-white-50 medium">Telah Ditemukan ' . $total . ' Data Terkait</div>
				  </div>
				  <div class="col-4">
				  <a href="' . base_url('home/laporan_suratmasuk') . '" class="btn float-right btn-sm btn-dark ">
				  <span class="icon text-white-50">
					<i class="mdi mdi-arrow-right"></i>
				  </span>	
				</a>
				  </div>
				  </div>
				</div>
			  </div>
			  </div>
    ';
        } else {
            $output .= '<div class="col-lg-12 mb-2 p-0">
			<div class="card bg-info text-white shadow">
			  <div class="card-body">
			  <div class="row">
			  <div class="col-6">
				Pencarian di Surat Masuk
				<div class="text-white-50 medium">Telah Ditemukan 0 Data</div>
				</div>
				
				</div>
			  </div>
			</div>
		  </div>
      ';
        }

        echo $output;
        $this->session->set_flashdata('cari', $query);


        # code...
    }
    public function fetch_1()
    {
        $output = '';
        $query = $this->input->post('query');

        $data = $this->M_data->cariSk($query);
        $total = $data->num_rows();

        if ($data->num_rows() > 0  && !empty($query)) {
            $output .= '
			<div class="col-lg-12 mb-2 p-0">
			<div class="card bg-info text-white shadow">
			<div class="card-body">
			<div class="row">
			<div class="col-8">
			  Pencarian di Surat Keluar
			  <div class="text-white-50 medium">Telah Ditemukan ' . $total . ' Data Terkait</div>
			  </div>
			  <div class="col-4">
			  <a href="' . base_url('home/laporan_suratkeluar') . '" class="btn float-right btn-sm btn-dark ">
				  <span class="icon text-white-50">
					<i class="mdi mdi-arrow-right"></i>
				  </span>	
			</a>
			  </div>
			  </div>
			</div>
		  </div>
		  </div>
    ';
        } else {
            $output .= '<div class="col-lg-12 mb-2 p-0">
			<div class="card bg-info text-white shadow">
			  <div class="card-body">
				Pencarian di Surat Keluar
				<div class="text-white-50 medium">Telah Ditemukan 0 Data</div>
			  </div>
			</div>
		  </div>
      ';
        }

        echo $output;

        $this->session->set_flashdata('cari', $query);

        # code...
    }
    public function fetch_3()
    {
        $output = '';
        $query = $this->input->post('query');

        $data = $this->M_data->cariRet($query);
        $total = $data->num_rows();

        if ($data->num_rows() > 0  && !empty($query)) {
            $output .= '
			<div class="col-lg-12 mb-2 p-0">
			<div class="card bg-info text-white shadow">
			<div class="card-body">
			<div class="row">
			<div class="col-8">
			  Pencarian di Jadwal Retensi
			  <div class="text-white-50 medium">Telah Ditemukan ' . $total . ' Data Terkait</div>
			  </div>
			  <div class="col-4">
			  <a href="' . base_url('home/jadwal_retensi') . '" class="btn float-right btn-sm btn-dark ">
				  <span class="icon text-white-50">
					<i class="mdi mdi-arrow-right"></i>
				  </span>	
			</a>
			  </div>
			  </div>
			</div>
		  </div>
		  </div>
    ';
        } else {
            $output .= '<div class="col-lg-12 mb-2 p-0">
			<div class="card bg-info text-white shadow">
			  <div class="card-body">
				Pencarian di Jadwal Retensi
				<div class="text-white-50 medium">Telah Ditemukan 0 Data</div>
			  </div>
			</div>
		  </div>
      ';
        }

        echo $output;
        $this->session->set_flashdata('cari', $query);
        # code...
    }
    public function fetch_4()
    {
        $output = '';
        $query = $this->input->post('query');

        $data = $this->M_data->cariPinjam($query);
        $total = $data->num_rows();

        if ($data->num_rows() > 0  && !empty($query)) {
            $output .= '
			<div class="col-lg-12 mb-2 p-0">
			<div class="card bg-info text-white shadow">
			<div class="card-body">
			<div class="row">
			<div class="col-8">
			  Pencarian di Surat Dipinjam
			  <div class="text-white-50 medium">Telah Ditemukan ' . $total . ' Data Terkait</div>
			  </div>
			  <div class="col-4">
			  <a href="' . base_url('home/pinjam') . '" class="btn float-right btn-sm btn-dark ">
				  <span class="icon text-white-50">
					<i class="mdi mdi-arrow-right"></i>
				  </span>	
			</a>
			  </div>
			  </div>
			</div>
		  </div>
		  </div>
    ';
        } else {
            $output .= '<div class="col-lg-12 mb-2 p-0">
			<div class="card bg-info text-white shadow">
			  <div class="card-body">
				Pencarian di Surat Dipinjam
				<div class="text-white-50 medium">Telah Ditemukan 0 Data</div>
			  </div>
			</div>
		  </div>
      ';
        }

        $this->session->set_flashdata('cari', $query);
        echo $output;
        # code...
    }

    public function addUnit()
    {
        $data = [
            'unit' => $this->input->post('pokok')
        ];
        $status =  $this->M_data->addUnit($data);
        if ($status == 1) {
            $this->session->set_flashdata('unit', 'Berhasil Tambah Data');
            redirect('home/pengaturan_instansi');
        } else {
            $this->session->set_flashdata('unit', 'Gagal Tambah Data');
            redirect('home/pengaturan_instansi');
        }
    }

    public function addMasalah()
    {
        $data = [
            'masalah' => $this->input->post('masalah')
        ];
        $status =  $this->M_data->addMasalah($data);
        if ($status == 1) {
            $this->session->set_flashdata('unit', 'Berhasil Tambah Data');
            redirect('home/pengaturan_instansi');
        } else {
            $this->session->set_flashdata('unit', 'Gagal Tambah Data');
            redirect('home/pengaturan_instansi');
        }
    }

    public function editUnit()
    {
        $data = [
            'unit' => $this->input->post('pokok_2'),
            'id' => $this->input->post('id_unit')
        ];
        $status =  $this->M_data->editUnit($data);
        if ($status == 1) {
            $this->session->set_flashdata('unit', 'Berhasil Tambah Data');
            redirect('home/pengaturan_instansi');
        } else {
            echo 1;

            redirect('home/pengaturan_instansi');
        }
        # code...
    }
    public function editMasalah()
    {
        $data = [
            'masalah' => $this->input->post('masalah_2'),
            'id' => $this->input->post('id_masalah')
        ];
        $status =  $this->M_data->editMasalah($data);
        if ($status == 1) {
            $this->session->set_flashdata('unit', 'Berhasil Tambah Data');
            redirect('home/pengaturan_instansi');
        } else {
            $this->session->set_flashdata('unit', 'Gagal Tambah Data');
            redirect('home/pengaturan_instansi');
        }
        # code...
    }

    public function deleteUnit($id)
    {
        $status =  $this->M_data->deleteUnit($id);
        if ($status == 1) {
            $this->session->set_flashdata('unit', 'Berhasil Tambah Data');
            redirect('home/pengaturan_instansi');
        } else {
            $this->session->set_flashdata('unit', 'Gagal Tambah Data');
            redirect('home/pengaturan_instansi');
        }
        # code...
    }
    public function deleteMasalah($id)
    {
        $status =  $this->M_data->deleteMasalah($id);
        if ($status == 1) {
            $this->session->set_flashdata('unit', 'Berhasil Tambah Data');
            redirect('home/pengaturan_instansi');
        } else {
            $this->session->set_flashdata('unit', 'Gagal Tambah Data');
            redirect('home/pengaturan_instansi');
        }
        # code...
    }

    public function edit_klasisfikasi_sm($id)
    {
        $data['title'] = 'Edit Klasifikasi Surat Masuk';
        $data['value'] = $id;
        $data['val'] = $this->M_data->update_datamasuk($id);
        $this->load->view('templates/header', $data);
        $this->load->view('home/sidebar');

        $this->load->view('home/klasifikasi_sm', $data);
        $this->load->view('templates/footer');
        # code...
    }
    public function edit_klasisfikasi_sk($id)
    {
        $data['title'] = 'Edit Klasifikasi Surat Keluar';
        $data['value'] = $id;
        $data['val'] = $this->M_data->update_datakeluar($id);
        $this->load->view('templates/header', $data);
        $this->load->view('home/sidebar');

        $this->load->view('home/klasifikasi_sk', $data);
        $this->load->view('templates/footer');
        # code...
    }

    public function upd_klasifikasi_sm($id)
    {
        $data = [
            'kode_1' => $this->input->post('h1'),
            'kode_2' => $this->input->post('h2'),
            'kode_3' => $this->input->post('h3'),
            'kode_4' => $this->input->post('h4'),
            'kode_5' => $this->input->post('h5'),
        ];
        $this->db->where('no_urut', $id);
        $this->db->update('surat_masuk', $data);
        redirect("home/buku_agenda");
        # code...
    }
    public function upd_klasifikasi_sk($id)
    {
        $data = [
            'kode_1' => $this->input->post('h1'),
            'kode_2' => $this->input->post('h2'),
            'kode_3' => $this->input->post('h3'),
            'kode_4' => $this->input->post('h4'),
            'kode_5' => $this->input->post('h5'),

        ];
        $this->db->where('no_urut', $id);
        $this->db->update('surat_keluar', $data);
        redirect("home/buku_agenda");
        # code...
    }
    public function add_kelas()
    {
        $data = [
            'nama_kelas' => $this->input->post('nama_kelas'),
            'id_guru'=> $this->session->userdata('id')
        ];
        
        $this->form_validation->set_rules('nama_kelas', 'nama_kelas', 'is_unique[kelas.nama_kelas]', array('is_unique'=>'Nama kelas sudah pernah terdaftar, silahkan gunakan nama lain (contoh: ADP 2018 - UM)'));
        
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Kelas';
            $data['kelas'] = $this->M_data->getKelas();
            
            
            $this->load->view('templates/header', $data);
            $this->load->view('home/sidebar');
            $this->load->view('home/kelas');
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('kelas', $data);
            redirect('home/kelas');
        }
    }
    public function update_kelas($id)
    {
        $data = [
            'nama_kelas' => $this->input->post('nama_kelas')
        ];
        $this->db->where('id_kelas', $id);
        $this->db->update('kelas', $data);
        redirect('home/kelas');
    }
    public function delete_kelas($id)
    {
        $this->db->where('id_kelas', $id);
        $this->db->delete('kelas');
        redirect('home/kelas');
    }
    public function kelas()
    {   // if ada tugas:tampilkan tugas, else: buat tugas baru
        $data['title'] = 'Kelas';
        $data['kelas'] = $this->M_data->getKelas();
        $this->load->view('templates/header', $data);
        $this->load->view('home/sidebar');
        $this->load->view('home/kelas');
        $this->load->view('templates/footer');
    }
    public function akses_kelas($id)
    {
        $data['title'] = $this->M_data->getNamaKelasById($id);
        $data['mhs'] = $this->M_data->getMhsByKelas($id);
        $data['id_kelas'] = $id;
        $data['tugas'] = $this->M_data->getTugas($id);
        $this->load->view('templates/header', $data);
        $this->load->view('home/sidebar');
        $this->load->view('home/akses_kelas');
        $this->load->view('templates/footer');
    }
    public function tambah_tugas($id_kelas)
    {
        $data['title'] = "Tambah Tugas";
        $data['id_kelas'] = $id_kelas;
        $this->load->view('templates/header', $data);
        $this->load->view('home/sidebar');
        $this->load->view('home/tambah_tugas');
        $this->load->view('templates/footer');
    }
    public function tambahTugas($id_kelas)
    {
        $config['upload_path'] = './files/tugas/';
        $config['allowed_types'] = '*';
        $config['file_name'] = 'tugas' . $id_kelas . $this->M_data->lastTugas();
        $config['overwrite'] = true;
        // $config['max_size'] = 20000;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('lampiran')) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('home/tugas', $error);
        } else {
            $data = array('image_metadata' => $this->upload->data());
            $ext = $this->upload->data('file_ext');
            $lampiran = [
                'judul_tugas' => $this->input->post('judul_tugas'),
                'deskripsi_tugas' => $this->input->post('deskripsi_tugas'),
                'dateline' => $this->input->post('dateline'),
                'lampiran' => 'tugas' . $id_kelas . $this->M_data->lastTugas() . $ext,
                'id_kelas' => $id_kelas
            ];
            $this->M_data->addTugas($lampiran);
            redirect('home/akses_kelas/' . $id_kelas);
        }
    }

    public function editTugas($id)
    {
        $data['title'] = 'Edit Tugas';
        $data['getTugas'] = $this->M_data->getTugasById($id);
        $this->load->view('templates/header', $data);
        $this->load->view('home/sidebar');
        $this->load->view('home/edittugas');
        $this->load->view('templates/footer');
    }
    public function edit_Tugas($id)
    {
        $config['upload_path'] = './files/tugas/';
        $config['allowed_types'] = '*';
        $config['file_name'] = 'tugas' . $this->M_data->getKelasByTugas($id) . $id;
        $config['overwrite'] = true;
        // $config['max_size'] = 20000;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('lampiran')) {
            $lampiran = [
                'judul_tugas' => $this->input->post('judul_tugas'),
                'dateline' => $this->input->post('dateline'),
                'deskripsi_tugas' => $this->input->post('deskripsi_tugas')
            ];
            $this->M_data->UpdateTugas($lampiran, $id);
            redirect('home/lihat_tugas/' . $id);
        } else {
            $data = array('image_metadata' => $this->upload->data());
            $ext = $this->upload->data('file_ext');
            $lampiran = [
                'judul_tugas' => $this->input->post('judul_tugas'),
                'dateline' => $this->input->post('dateline'),
                'deskripsi_tugas' => $this->input->post('deskripsi_tugas'),
                'lampiran' => 'tugas' . $this->M_data->getKelasByTugas($id) . $id . $ext
            ];
            $this->M_data->UpdateTugas($lampiran, $id);
            redirect('home/lihat_tugas/' . $id);
        }
    }
    public function delete_tugas($id)
    {
        $id_kelas = $this->M_data->getKelasByTugas($id);
        $this->db->where('id_tugas', $id);
        $this->db->delete('tugas');
        redirect('home/akses_kelas/' . $id_kelas);
    }
    public function lihat_tugas($id_tugas)
    {
        $data['title'] = "Lihat Tugas";
        $data['tugas'] = $this->M_data->getTugasById($id_tugas);
        $data['kelas'] = $this->M_data->getKelasByTugas($id_tugas);
        $data['mhs'] = $this->M_data->getMhsByTugas($id_tugas);
        $this->load->view('templates/header', $data);
        $this->load->view('home/sidebar');
        $this->load->view('home/lihat_tugas');
        $this->load->view('templates/footer');
    }
    public function hasil_tugas($id, $id_tugas)
    {
        $data['id_tugas'] = $id_tugas;
        $data['title'] = "Hasil Tugas";
        $data['surat_masuk'] = $this->M_data->getSuratMasukById($id);
        $data['surat_keluar'] = $this->M_data->getSuratKeluarById($id);
        $data['surat_pinjam'] = $this->M_data->getSuratPinjamById($id);
        $data['surat_rapat'] = $this->M_data->getRapatById($id);
        $data['retensi'] = $this->M_data->getRetensiById($id);
        $data['penyusutan'] = $this->M_data->getPenyusutanById($id);
        $data['mhs'] = $this->M_data->getMhsById($id, $id_tugas);
        // print_r($data['mhs']);die;
        $this->load->view('templates/header', $data);
        $this->load->view('home/sidebar');
        $this->load->view('home/hasil_tugas');
        $this->load->view('templates/footer');
    }
    public function update_nilai($id, $id_tugas)
    {
        $data = [
            'nilai' => $this->input->post('nilai'),
            'komentar' => $this->input->post('komentar')
        ];
        $this->M_data->updateNilai($data, $id, $id_tugas);
        redirect('home/lihat_tugas/' . $id_tugas);
    }
    public function tambah_nilai()
    {
        date_default_timezone_set('Asia/Jakarta');
        $data = [
            'id_user' => $this->input->post('id_user'),
            'id_tugas' => $this->input->post('id_tugas'),
            'nilai' => $this->input->post('nilai'),
            'komentar' => $this->input->post('komentar'),
            'status' => "Selesai",
            'tgl_selesai' => date('Y-m-d H:i:s')
        ];
        $this->M_data->addNilai($data);
        redirect('home/lihat_tugas/' . $data['id_tugas']);
    }
    public function download_tugas($id_tugas)
    {
        $this->load->helper('download');
        $filename = $this->M_data->file_tugas($id_tugas);
        $path = file_get_contents(base_url() . "files/tugas/" . $filename); // get file name
        force_download($filename, $path); // start download`
    }
    public function get_data_user()
    {
        $list = $this->Serverside->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $field->no_urut;
            $row[] = $field->nama;
            $row[] = $field->dari;
            $row[] = $field->alamat;
            $row[] = $field->no_surat;
            $row[] = $field->lampiran;
            $row[] = $field->tanggal_surat;
            $row[] = $field->perihal;
            $row[] = $field->tanggal_simpan;
            $row[] = $field->kategori;
            $row[] = $field->isi_ringkasan;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->User_model->count_all(),
            "recordsFiltered" => $this->User_model->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
}
