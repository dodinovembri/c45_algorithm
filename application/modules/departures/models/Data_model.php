<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_model extends CI_Model
{
    public function _create($data = array(), $table = 'data_survey')
    {
        $this->db->insert($table, $data);
    }
    

    public function _datatable_index()
    {
        return $this->db->get_where('data_survey', array('type' => 'Departure'))->result_array();
    }
}