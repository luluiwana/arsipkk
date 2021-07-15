<?php

defined('BASEPATH') or exit('No direct script access allowed');
                        
class Arsip_model extends CI_Model
{
    public function getArsipByKategori($kategori)
    {
        $this->db->where('id_user', $this->session->userdata('id_user'));
        $this->db->where('kategori', $kategori);
        return $this->db->get('arsip')->result();
    }
    public function countByKategori($kategori)
    {
        // SELECT count(*) as c FROM `arsip` WHERE kategori='keuangan'
        $this->db->select('count(*) as c');
        $this->db->where('id_user', $this->session->userdata('id_user'));
        $this->db->where('kategori', $kategori);
        $row=$this->db->get('arsip')->row();
        return $row->c;
    }
    public function getArsipRow($id, $field)
    {
        $this->db->where('id_arsip', $id);
        $this->db->where('id_user', $this->session->userdata('id_user'));
        $row = $this->db->get('arsip')->row();
        return $row->$field;
    }
    public function getArsipById($id)
    {
        $this->db->where('id_arsip', $id);
        $this->db->where('id_user', $this->session->userdata('id_user'));
        return $this->db->get('arsip')->row();
    }
    public function updateArsip($id, $data)
    {
        $this->db->where('id_arsip', $id);
        $this->db->where('id_user', $this->session->userdata('id_user'));
        $this->db->update('arsip', $data);
    }
    public function getProfil()
    {
        $this->db->where('id_user', $this->session->userdata('id_user'));
        $row = $this->db->get('user')->row();
        return $row;
    }
    public function updateProfil($data)
    {
        $this->db->where('id_user', $this->session->userdata('id_user'));
        $this->db->update('user', $data);
    }
    public function uniqueTelp($telp)
    {
        // SELECT * FROM `user` WHERE telp=111 AND id_user!=8
        $this->db->select('count(*) as c');
        $this->db->where('id_user !=', $this->session->userdata('id_user'));
        $this->db->where('telp', $telp);
        $row = $this->db->get('user')->row();
        return $row->c;
    }
    public function deleteArsip($id)
    {
        $this->db->where('id_user', $this->session->userdata('id_user'));
        $this->db->where('id_arsip', $id);
    
        $this->db->delete('arsip');
    }
    public function cari($kategori, $kata)
    {
        # SELECT * FROM `arsip` WHERE id_user=1 AND nama_arsip LIKE '%sip p%'
        $this->db->where('id_user', $this->session->userdata('id_user'));
        $this->db->like('nama_arsip', $kata);
        if ($kategori!='semua') {
            $this->db->where('kategori', $kategori);
        }
        return $this->db->get('arsip')->result();
    }
    public function countCari($kategori, $kata)
    {
        # SELECT * FROM `arsip` WHERE id_user=1 AND nama_arsip LIKE '%sip p%'
        $this->db->select('count(*) as c');
        $this->db->where('id_user', $this->session->userdata('id_user'));
        $this->db->like('nama_arsip', $kata);

        if ($kategori!='semua') {
            $this->db->where('kategori', $kategori);
        }
        $row = $this->db->get('arsip')->row();
        return $row->c;
    }
}
                        
/* End of file Arsip_model.php */
