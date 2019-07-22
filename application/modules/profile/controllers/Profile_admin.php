<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_admin extends Admin_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('profile_model'));
        $this->load->library('template');
        $this->load->helper(array('adminlte_helper','language','url', 'form'));

        // load ion auth
        $this->load->add_package_path(APPPATH.'third_party/ion_auth/');
        $this->load->library('ion_auth');
        if(!$this->ion_auth->logged_in())
        {
             redirect('auth', 'refresh');
        }
    }

    public function index()
	{
        $data = array();
        $data['page_title'] = 'User Profile';
        $data['page_description'] = '';
        
        $this->template->_render_admin('profile_index', $data);   
    }

    public function edit()
    {

    }

    public function update_info()
    {
        $user = $this->ion_auth->user()->row();

        $data = array('email' => $_POST['email'], 'nip' => $_POST['nip'], 'first_name' => explode(" ", $_POST['nama'])[0], 'last_name' => explode(" ",  $_POST['nama'])[1]);
        $this->profile_model->_update($user->id, $data);
        $this->session->set_flashdata('message', 'Sukses merubah data profil');
        redirect('admin'. DIRECTORY_SEPARATOR .'profile', 'refresh');

    }

    public function update_password()
    {
        $user = $this->ion_auth->user()->row();

        if($_POST['new_password'] != $_POST['confirm_password']){
            $this->session->set_flashdata('message', 'Password baru tidak sama dengan konfirmasi password');
            redirect('admin'. DIRECTORY_SEPARATOR .'profile', 'refresh');
        }else if($_POST['new_password'] == '' || $_POST['confirm_password'] == '' || ($_POST['new_password'] == '' && $_POST['confirm_password'] == '')){
            $this->session->set_flashdata('message', 'Password tidak boleh kosong');
            redirect('admin'. DIRECTORY_SEPARATOR .'profile', 'refresh');
        }else{

            $pass = $this->ion_auth_model->hash_password($_POST['new_password'],FALSE,FALSE);
            $data = array('password' => $pass);
            $this->profile_model->_update($user->id, $data);
            $this->session->set_flashdata('message', 'Sukses merubah data password');
            redirect('admin'. DIRECTORY_SEPARATOR .'profile', 'refresh');

        }
    }


    public function image_upload()
    {
        
    }
}