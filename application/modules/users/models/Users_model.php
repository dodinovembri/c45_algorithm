<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model
{
    public function _create($data = array(), $table = 'users')
    {
        $this->db->insert($table, $data);
    }
    
    public function _read($id, $table = 'users')
    {
        return $this->db->get_where($table, array('id' => $id))->row_array();
    }
    
    public function _update($id, $data = array(), $table = 'users')
    {
        if(!empty($id) and !empty($data))
        {
            $this->db->where('id', $id);
            $this->db->update($table, $data);    
        }  
    }

    public function _delete($id, $table = 'users')
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
        return $this->db->get('users')->result_array();
    }

    //ini untuk memasukkan kedalam tabel pegawai
    function loaddata($dataarray) {

        for ($i = 1; $i <= count($dataarray); $i++) {
            $data = array(
                'username' => $dataarray[$i]['username'],
                'password' => $this->ion_auth_model->hash_password($dataarray[$i]['password'],FALSE,FALSE),
                'email' => $dataarray[$i]['email'],
                'active' => 1,
                'first_name' => $dataarray[$i]['first_name'],
                'last_name' => $dataarray[$i]['last_name'],
                'nip' => $dataarray[$i]['nip'],
            );


            //ini untuk menambahkan apakah dalam tabel sudah ada data yang sama
            //apabila data sudah ada maka data di-skip
            $cek  = $this->db->get_where('users', array('username' =>$dataarray[$i]['username']))->row_array();
            if (!$cek) {
                $this->db->insert('users', $data);

                $user = $this->db->get_where('users', array('username' =>$dataarray[$i]['username']))->result();
                $data2 = array(
                    'user_id' => $user[0]->id,
                    'group_id' => 2,
                );

                $this->db->insert('users_groups', $data2);
            }

        }
    }

}