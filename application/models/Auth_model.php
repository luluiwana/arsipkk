<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
                        
class Auth_model extends CI_Model {
                        
public function register($data){
    
    $this->db->insert('user', $data);
                                  
}
public function telp_check($telp)
{
    $this->db->select('count(*) as c');
    $this->db->where('telp',$telp);
    $row = $this->db->get('user')->row();
    if ($row->c==1) {
        return TRUE;
    }else {
        return FALSE;
    }
}
public function password_check($telp)
{
    $this->db->where('telp',$telp);
    $row=$this->db->get('user')->row();
    return $row->password;
}
public function getUserByTelp($telp)
{
    $this->db->where('telp',$telp);
    return $this->db->get('user')->row();
}
  public function getPassword()
{
    $this->db->where('id_user',$this->session->userdata('id_user'));
    $row = $this->db->get('user')->row();
    return $row->password;
}
public function updatePassword($data)
{
    $this->db->where('id_user', $this->session->userdata('id_user'));
    $this->db->update('user',$data);
}
                        
                            
                        
}
                        
/* End of file Auth.php */
    
                        