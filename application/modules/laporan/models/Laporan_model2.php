<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model
{
    public function _create($data = array(), $table = 'about')
    {
        $this->db->insert($table, $data);
    }
    
    public function _read($id, $table = 'about')
    {
        return $this->db->get_where($table, array('id' => $id))->row();
    }
    
    public function _update($id, $data = array(), $table = 'about')
    {
        if(!empty($id) and !empty($data))
        {
            $this->db->where('id', $id);
            $this->db->update($table, $data);    
        }  
    }

    public function _delete($id, $table = 'about')
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

    public function insert_pohon($data = array(), $table = 'pohon_keputusan_c45')
    {
        $this->db->insert($table, $data);
    }

    public function insert_mining_c45($data = array(), $table = 'mining_c45')
    {
        $this->db->insert($table, $data);
    }

    // get total data survey
    public function getTotalData($kondisi_attribute = ''){
        $this->db->select('COUNT(*) as jumlah_total');  
        $this->db->from('data_survey');  
        $this->db->where('status is NOT NULL', NULL, FALSE);
        if(!empty($kondisi_attribute)){
            $this->db->where("$kondisi_attribute", NULL, FALSE);
        }
        $query=$this->db->get();  
        return $query->row();
    }

    // get total delay
    public function getTotalDelay($kondisi_attribute = ''){
        $this->db->select('COUNT(*) as jumlah_delay');  
        $this->db->from('data_survey');  
        $this->db->where('status = "Ya"', NULL, FALSE);
        $this->db->where('status is NOT NULL', NULL, FALSE);
        if(!empty($kondisi_attribute)){
            $this->db->where("$kondisi_attribute", NULL, FALSE);
        }
        $query=$this->db->get();  
        return $query->row();
    }


    // get total on schedule
    public function getTotalOnSchedule($kondisi_attribute = ''){
        $this->db->select('COUNT(*) as jumlah_tidak_delay');  
        $this->db->from('data_survey');  
        $this->db->where('status = "Tidak"', NULL, FALSE);
        $this->db->where('status is NOT NULL', NULL, FALSE);
        if(!empty($kondisi_attribute)){
            $this->db->where("$kondisi_attribute", NULL, FALSE);
        }
        $query=$this->db->get();  
        return $query->row();
    }

    // 
    public function select_attribute_from_attr(){
        $this->db->select('DISTINCT(attribute), nilai_attribute');  
        $this->db->from('attribute');  
        $query=$this->db->get();  
        return $query->result_array();
    }

    // model get nilai attribute
    public function getNilaiAttribute($attribute){
        $this->db->select('nilai_attribute');  
        $this->db->from('attribute');  
        $this->db->where('attribute', $attribute);
        $query=$this->db->get();  
        return $query->result_array();
    }

    // model select attribute condition
    public function select_attribute($attribute, $nilai_attribute){
        return $this->db->get_where('pohon_keputusan_c45', array('atribut'=> $attribute, 'nilai_atribut' => $nilai_attribute))
        ->row();
    }

    // select entropy
    public function select_entropy()
    {
        $this->db->select('id, jml_kasus_total, jml_delay, jml_tdk_delay');  
        $this->db->from('mining_c45');  
        $query=$this->db->get();  
        return $query->result_array();
    }


    // update hitung entropy
    
    public function update_entropy($id, $data = array(), $table = 'mining_c45')
    {
        if(!empty($id) and !empty($data))
        {
            $this->db->where('id', $id);
            $this->db->update($table, $data);    
        }  
    }

    // get INf Gain
    public function getInfGain()
    {
        $this->db->select('jml_kasus_total, entropy');  
        $this->db->from('mining_c45'); 
        $this->db->where('atribut', 'status');
        $query=$this->db->get();  
        return $query->result_array();        
    }

    // update inf gain
    public function updateInfGain($idEntropy, $data = array(), $table = 'mining_c45')
    {
        if(!empty($idEntropy) and !empty($data))
        {
            $this->db->where('id', $idEntropy);
            $this->db->update($table, $data);    
        }  
    }

    public function sum_inf_gain_temp($getAttribute)
    {
        $this->db->select('SUM(inf_gain_temp) as inf_gain');  
        $this->db->from('mining_c45');  
        $this->db->where('atribut', $getAttribute);
        $query=$this->db->get();  
        return $query->result_array();        
    }


    public function update_inf_gain($getAttribute, $data = array(), $table = 'mining_c45')
    {
        $this->db->where('atribut', $getAttribute);
        $this->db->update($table, $data);    

    }


    public function update_split_info_temp($idEntropy, $data = array(), $table = 'mining_c45')
    {
        if(!empty($idEntropy) and !empty($data))
        {
            $this->db->where('id', $idEntropy);
            $this->db->update($table, $data);    
        }  
    }

    public function sum_split_info_temp($getAttribute)
    {

        $this->db->select('SUM(split_info_temp) as split_info ');  
        $this->db->from('mining_c45');  
        $this->db->where('atribut', $getAttribute);
        $query=$this->db->get();  
        return $query->result_array();    
    }

    public function update_split_info($getAttribute, $data = array(), $table = 'mining_c45')
    {
        if(!empty($getAttribute) and !empty($data))
        {
            $this->db->where('atribut', $getAttribute);
            $this->db->update($table, $data);    
        }  
    }

    public function hitung_gain_ratio()
    {
        $this->db->select('id, inf_gain, split_info');  
        $this->db->from('mining_c45');  
        $query=$this->db->get();  
        return $query->result_array();         
    }

    public function update_gain_ratio($idGainRatio, $data = array(), $table = 'mining_c45')
    {
        if(!empty($idGainRatio) and !empty($data))
        {
            $this->db->where('id', $idGainRatio);
            $this->db->update($table, $data);    
        }  
    }

    public function get_max_inf_gain(){
        $query = "SELECT distinct atribut, gain_ratio FROM mining_c45 WHERE gain_ratio is Not Null GROUP BY atribut";

        $result = $this->db->query($query)->result_array();
        return $result;
    }


    public function select_from_pohon_keputusan()
    {
        $this->db->select('id, nilai_atribut');  
        $this->db->from('pohon_keputusan_c45');  
        $query=$this->db->get();  
        return $query->result_array();           
    }


    public function select_from_pohon_keputusan_where($id_parent='')
    {
        $this->db->select('*');  
        $this->db->from('pohon_keputusan_c45');  
        if(!empty($id_parent)){
            $this->db->where('id_parent', $id_parent);
            $this->db->where('looping_kondisi', 'Belum');
        }
        $query=$this->db->get();  
        return $query->result_array();           
    }


    public function update_looping_attribute($id, $data = array(), $table = 'pohon_keputusan_c45')
    {
        if(!empty($id) and !empty($data))
        {
            $this->db->where('id', $id);
            $this->db->update($table, $data);    
        }  
    }


    public function sqlInfGainMaxIterasi(){
        $query = "SELECT distinct atribut, gain_ratio FROM mining_c45 WHERE gain_ratio in (SELECT min(gain_ratio) FROM `mining_c45`) LIMIT 1";

        $result = $this->db->query($query, array(1))->result();
        return $result;
    }

    public function select_mining(){
        $query = "SELECT * FROM mining_c45";

        $result = $this->db->query($query)->result_array();
        return $result;
    }

    public function insert_iterasi($data = array(), $table = 'iterasi_c45')
    {
        $this->db->insert($table, $data);
    }

    // model pohon keputusan
    public function pohon_keputusan($id_parent=''){
        if(!empty($id_parent)){
            return $this->db->get_where('pohon_keputusan_c45', array('id_parent', $id_parent))->result_array();
        }    
    }

    public function sqlInfGainMaxAtribut(){
        $query = "SELECT distinct atribut FROM mining_c45 WHERE gain_ratio in (SELECT max(gain_ratio) FROM `mining_c45`) LIMIT 1";

        $result = $this->db->query($query, array(1))->result_array();
    }


    public function update_keputusan_diproses($nilai_atribut, $data = array(), $table = 'pohon_keputusan_c45'){
        $this->db->where('nilai_atribut', $nilai_atribut);
        $this->db->update($table, $data);  
    }

    public function sqlBelumAdaKeputusanLagi($atribut)
    {
        if(!empty($atribut)){
            $query = "SELECT * FROM pohon_keputusan_c45 WHERE keputusan = '?' and diproses = 'Belum' AND atribut = '$atribut'";

            $result = $this->db->query($query, array(1))->result_array();

            
        }
    }

    public function turncate_mining_c45(){
        $query = "TRUNCATE mining_c45";
        $result = $this->db->query($query);
    }

    public function delete_attribute($atribut){

        if(!empty($atribut))
        {
            $this->db->where('atribut', $atribut);
            $this->db->delete('atribut');
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function sqlReplaceNull(){
        $query = "SELECT id, id_parent FROM pohon_keputusan_c45 WHERE keputusan = 'Null'";

        $result = $this->db->query($query, array(1))->result_array();
    }


    public function getCountFromKeputusan($id_parent)
    {
        $this->db->select('jml_delay, jml_tdk_delay, keputusan');  
        $this->db->from('pohon_keputusan_c45');  
        if(!empty($id_parent)){
            $this->db->where('id', $id_parent);
        }
        $query=$this->db->get();  
        return $query->result();       
    }

    public function _update_pohon_keputusan($id, $data = array(), $table = 'pohon_keputusan_c45')
    {
        if(!empty($id) and !empty($data))
        {
            $this->db->where('id', $id);
            $this->db->update($table, $data);    
        }  
    }

    public function populateDB()
    {
        $query = "TRUNCATE mining_c45";
        $result = $this->db->query($query);     
        
        $query = "TRUNCATE iterasi_c45";
        $result = $this->db->query($query);  

        $query = "TRUNCATE pohon_keputusan_c45";
        $result = $this->db->query($query);     

        $query = "TRUNCATE attribute";
        $result = $this->db->query($query);    

        $query = "INSERT INTO `attribute` (`attribute`, `nilai_attribute`) VALUES
                ('total', 'total'),
                ('delay', 'Ya'),
                ('delay', 'Tidak'),
                ('airlines', 'GARUDA'),
                ('airlines', 'BATIK AIR'),
                ('airlines', 'LION AIR'),
                ('airlines', 'NAM AIR'),
                ('airlines', 'SRIWIJAYA AIR'),
                ('airlines', 'EXPRESS AIR'),
                ('airlines', 'CITILINK'),
                ('airlines', 'AIRASIA'),
                ('airlines', 'SILKAIR');";
        $result = $this->db->query($query);    

    }

    public function sqlInfGainMax($atribut)
    {
        $this->db->select('*');  
        $this->db->from('mining_c45');  
        $this->db->where('atribut', $atribut);
        $query=$this->db->get();  
        return $query->result_array();   

    }

    public function sqlIdParent($atribut, $nilai_atribut)
    {
        $query = 'SELECT id, atribut, nilai_atribut, jml_delay, jml_tdk_delay FROM pohon_keputusan_c45 WHERE atribut = "$atribut" AND nilai_atribut = "$nilai_atribut" order by id DESC LIMIT 1';

        $result = $this->db->query($query)->result_array();
        return $result;
    }

    public function hapus_child($parent_id)
    {
        $this->db->where('id_parent', $parent_id);
        $this->db->delete('pohon_keputusan_c45');
    }

    public function update_keputusan($parent_id, $data = array())
    {
        $this->db->where('id', $parent_id);
        $this->db->update('pohon_keputusan_c45', $data);
    }

    public function getAllPerhitungan()
    {
        $this->db->select('*');  
        $this->db->from('iterasi_c45');  
        $this->db->group_by('iterasi');  
        $query=$this->db->get();  
        return $query->result_array();           
    }


    public function getKeputusan(){
        $this->db->select('*');  
        $this->db->from('pohon_keputusan_c45');  
        $this->db->group_by('atribut, nilai_atribut, id_parent, keputusan');  
        $this->db->order_by('id', 'asc');  
        $query=$this->db->get();  
        return $query->result();             
    }

    public function _datatable_index()
    {
        return $this->db->get('about')->result_array();
    }
}