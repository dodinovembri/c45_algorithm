<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Airlines_model extends CI_Model
{
    public function _list()
    {
        return $this->db->get('airlines')->result_array();
    }

}