<?php 
        
defined('BASEPATH') OR exit('No direct script access allowed');
        
class Home extends CI_Controller {

public function index()
{
    $this->load->view('template/header');
    $this->load->view('dashboard');
    $this->load->view('template/footer');           
}
public function tambah()
{
     $this->load->view('template/header');
    $this->load->view('tambah');
    $this->load->view('template/footer');
}
public function galeri()
{
    $this->load->view('template/header');
    $this->load->view('galeri');
    $this->load->view('template/footer');
}

        
}
        
    /* End of file  Home.php */
        
                            