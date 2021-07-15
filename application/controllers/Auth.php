<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
    }
    public function index()
    {
        if ($this->session->has_userdata('id_user')) {
            redirect('home', 'refresh');
        } else {
            $telp = $this->input->post('telp');
            $this->form_validation->set_rules('telp', 'No Telepon', 'required|numeric', array('numeric'=>'Nomor telepon harus berupa angka'));
            $this->form_validation->set_rules('password', 'Kata Sandi', 'required|callback_password_check['.$telp.']');
        
            if ($this->form_validation->run() == false) {
                $this->load->view('login');
            } else {
                $data=$this->Auth_model->getUserByTelp($telp);
                $userdata = array(
                'id_user'  => $data->id_user,
                'nama'     => $data->nama
            );
                $this->session->set_userdata($userdata);
                redirect('home', 'refresh');
            }
        }
    }
 
    public function password_check($password, $telp)
    {
        $cek_telp = $this->Auth_model->telp_check($telp);
        if ($cek_telp==true) {
            $password_hash = $this->Auth_model->password_check($telp);
            if (password_verify($password, $password_hash)) {
                return true;
            } else {
                $this->form_validation->set_message('password_check', 'Kata sandi salah');
                return false;
            }
        } else {
            $this->form_validation->set_message('password_check', 'Nomor tel tidak terdaftar');
            return false;
        }
    }

    public function daftar()
    {
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules(
            'telp',
            'No Telepon',
            'required|numeric|is_unique[user.telp]',
            array('numeric'=>'Nomor Telepon harus berupa angka',
            'is_unique'=>"Nomor Telepon sudah terdaftar")
        );
        
        $this->form_validation->set_rules(
            'passconf',
            'Konfirmasi Kata Sandi',
            'matches[password]',
            array(
            'matches'=> 'Kata Sandi tidak sesuai',
        )
        );
        if ($this->form_validation->run() == false) {
            $this->load->view('daftar');
        } else {
            $data = array(
                'nama'=>$this->input->post('nama'),
                'telp'=>$this->input->post('telp'),
                'alamat'=>$this->input->post('alamat'),
                'password'=>password_hash($this->input->post('password'), PASSWORD_BCRYPT),
            );
            $this->Auth_model->register($data);
            redirect('auth', 'refresh');
        }
    }
    public function logout()
    {
        $userdata = array('id_user','nama');
        $this->session->unset_userdata($userdata);
        
        redirect('auth', 'refresh');
    }
}
