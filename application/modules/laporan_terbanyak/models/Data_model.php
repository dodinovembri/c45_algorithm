<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_model extends CI_Model
{

    // get jam terbanyak data survey
    public function _getJam($kondisi_attribute = ''){
        $this->db->select('schedule_time, COUNT(*) as jumlah');  
        $this->db->from('data_survey');  
        $this->db->where('status = "Ya"', NULL, FALSE);
        $this->db->group_by('schedule_time');
        $this->db->order_by('jumlah', 'desc');
        $query=$this->db->get();  
        return $query->row();
    }

    // get maskapai terbanyak data survey
    public function _getMaskapai($kondisi_attribute = ''){
        $this->db->select('airlines, COUNT(*) as jumlah');  
        $this->db->from('data_survey');  
        $this->db->where('status = "Ya"', NULL, FALSE);
        $this->db->group_by('airlines');
        $this->db->order_by('jumlah', 'desc');
        $query=$this->db->get();  
        return $query->row();
    }


}