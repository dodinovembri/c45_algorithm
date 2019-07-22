<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_model extends CI_Model
{
    public function _datatable_index()
    {
        return $this->db->get('data_survey')->result_array();
    }
}