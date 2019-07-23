<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departures_model extends CI_Model
{
    //ini untuk memasukkan kedalam tabel pegawai
    function loaddata($dataarray) {

        for ($i = 1; $i <= count($dataarray); $i++) {
            $data = array(
                'airlines' => $dataarray[$i]['airlines'],                
                'flight_no' => $dataarray[$i]['flight_no'],                
                'schedule_time' => $dataarray[$i]['schedule_time'],
                'airport' => $dataarray[$i]['airport'],
                'type' => $dataarray[$i]['type'],
                'tanggal' => $dataarray[$i]['date'],
                'status' => $dataarray[$i]['status']
            );


            $this->db->insert('data_survey', $data);

            

        }

    }
}