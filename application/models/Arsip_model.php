<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
                        
class Arsip_model extends CI_Model {
                        
public function getArsipByKategori($kategori){
    $this->db->where('id_user',$this->session->userdata('id_user'));
    $this->db->where('kategori',$kategori);
    return $this->db->get('arsip')->result();                           
}
public function countByKategori($kategori)
{
    // SELECT count(*) as c FROM `arsip` WHERE kategori='keuangan'
    $this->db->select('count(*) as c');
    $this->db->where('id_user',$this->session->userdata('id_user'));
    $this->db->where('kategori',$kategori);
    $row=$this->db->get('arsip')->row();
    return $row->c;
}
public function getArsipRow($id,$field)
{
    $this->db->where('id_arsip',$id);
    $this->db->where('id_user',$this->session->userdata('id_user'));
    $row = $this->db->get('arsip')->row();
    return $row->$field;
}
public function getArsipById($id)
{
    $this->db->where('id_arsip', $id);
    $this->db->where('id_user', $this->session->userdata('id_user'));
    return $this->db->get('arsip')->row();

}
public function updateArsip($id,$data)
{
    $this->db->where('id_arsip', $id);
    $this->db->where('id_user', $this->session->userdata('id_user'));
    $this->db->update('arsip', $data);
    
}
                        
                            
                        
}
                        
/* End of file Arsip_model.php */
    
                        