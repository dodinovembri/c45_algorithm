<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Flight_model extends CI_Model
{
    public function _list()
    {
        return $this->db->get('flight_no')->result_array();
    }

}