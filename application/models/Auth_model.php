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
                        
                            
                        
}
                        
/* End of file Auth.php */
    
                        