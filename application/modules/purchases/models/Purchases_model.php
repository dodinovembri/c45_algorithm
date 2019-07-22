<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchases_model extends CI_Model
{
    public function _create($data = array(), $table = 'purchase')
    {
        $this->db->insert($table, $data);
    }
    
    public function _read($id, $table = 'purchase')
    {
        return $this->db->get_where($table, array('id' => $id))->row();
    }
    
    public function _update($id, $data = array(), $table = 'purchase')
    {
        if(!empty($id) and !empty($data))
        {
            $this->db->where('id', $id);
            $this->db->update($table, $data);    
        }  
    }

    public function _delete($id, $table = 'purchase')
    {
        if(!empty($id))
        {
            $this->db->where('id', $id);
            $this->db->delete($table);
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function _datatable_index()
    {
        return $this->db->get('purchase')->result_array();
    }
}