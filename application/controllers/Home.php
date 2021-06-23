<?php
        
defined('BASEPATH') or exit('No direct script access allowed');
        
class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->has_userdata('id_user')) {
            redirect('auth', 'refresh');
        }
        $this->load->model('Arsip_model');
        $this->load->library('encryption');
    }
    public function index()
    {
        $data = array(
        'title'=>'Beranda',
        'pendidikan'=>$this->Arsip_model->countByKategori('pendidikan'),
        'keuangan'=>$this->Arsip_model->countByKategori('keuangan'),
        'kesehatan'=>$this->Arsip_model->countByKategori('kesehatan'),
        'kepemilikan'=>$this->Arsip_model->countByKategori('kepemilikan'),
        'datadiri'=>$this->Arsip_model->countByKategori('datadiri'),
    );
        $this->load->view('template/header', $data);
        $this->load->view('dashboard');
        $this->load->view('template/footer');
    }
    public function tambah()
    {
        $data = array(
        'title'=>'Tambah Arsip'
    );
        $this->load->view('template/header', $data);
        $this->load->view('tambah');
        $this->load->view('template/footer');
    }
    public function tambah__()
    {
        $config['upload_path']          = './files/';
        $config['allowed_types']        = '*';
        $this->load->library('upload', $config);

        if (! $this->upload->do_upload('file')) {
            redirect('tambah', 'refresh');
        } else {
            $data=array(
                'kategori'=>$this->input->post('kategori'),
                'nama_arsip'=>$this->input->post('nama_arsip'),
                'file'=>$this->upload->data('file_name'),
                'ext'=>$this->upload->data('file_ext'),
                'id_user'=> $this->session->userdata('id_user')
                
            );
            $this->db->insert('arsip', $data);
            
            redirect($data['kategori'], 'refresh');
        }
    }
    public function edit($id)
    {
        $data = array(
        'title'=>'Edit Arsip',
        'arsip'=>$this->Arsip_model->getArsipById($id)
    );
        $this->load->view('template/header', $data);
        $this->load->view('edit');
        $this->load->view('template/footer');
    }
    public function edit__()
    {
        $config['upload_path']          = './files/';
        $config['allowed_types']        = '*';
        $this->load->library('upload', $config);
        $id_arsip=$this->input->post('id');

        if (! $this->upload->do_upload('file')) {
            //jika user tidak upload file
            $data=array(
                'kategori'=>$this->input->post('kategori'),
                'nama_arsip'=>$this->input->post('nama_arsip'),
            );

            $this->Arsip_model->updateArsip($id_arsip, $data);
            redirect($data['kategori'], 'refresh');
        } else {
            //jika user upload file
             //hapus file lama
            $old_file = $this->Arsip_model->getArsipRow($id_arsip,'file');
            unlink('./files/'.$old_file);
            //update
            $data=array(
                'kategori'=>$this->input->post('kategori'),
                'nama_arsip'=>$this->input->post('nama_arsip'),
                'file'=>$this->upload->data('file_name'),
                'ext'=>$this->upload->data('file_ext'),
            );
           
            $this->Arsip_model->updateArsip($id_arsip, $data);
            
            redirect($data['kategori'], 'refresh');
        }
    }
    public function arsip($kategori)
    {
        $title=$kategori;
        if ($kategori=='datadiri') {
            $title="Data Diri";
        }
        $data = array(
        'title'=>'Arsip '.$title,
        'arsip'=>$this->Arsip_model->getArsipByKategori($kategori),
        );
        
        $this->load->view('template/header', $data);
        $this->load->view('arsip');
        $this->load->view('template/footer');
    }
    public function download($id)
    {
        $filename=$this->Arsip_model->getArsipRow($id, 'file');
        force_download('./files/'.$filename, null);
    }
    public function lihat($id)
    {
        $data=array(
          'title'=>$this->Arsip_model->getArsipRow($id, 'nama_arsip'),
          'file'=>$this->Arsip_model->getArsipRow($id, 'file'),
          'back'=>base_url().$this->Arsip_model->getArsipRow($id, 'kategori')
      );
        $this->load->view('template/header', $data);
        $this->load->view('lihat');
        $this->load->view('template/footer');
    }
}
        
    /* End of file  Home.php */
