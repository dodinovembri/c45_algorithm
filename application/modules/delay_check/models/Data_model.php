<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_model extends CI_Model
{
    public function _datatable_index()
    {
        return $this->db->get('data_survey')->result_array();
    }

    public function _read($condition, $table = 'data_survey')
    {
    	unset($condition['due_date']);
        return $this->db->get_where($table, $condition)->result_array();
    }
    

}