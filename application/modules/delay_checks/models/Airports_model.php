<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Airports_model extends CI_Model
{
    public function _list()
    {
        return $this->db->get('airports')->result_array();
    }

}