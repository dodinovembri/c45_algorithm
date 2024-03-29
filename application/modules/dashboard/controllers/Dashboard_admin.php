<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_admin extends Admin_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('template');
        // $this->load->model(array('home_model', 'products_model'));
        $this->load->helper('adminlte_helper');

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
        $data['page_title'] = 'Home';
        $data['page_description'] = '';

        // $infobox = array (
        //     'ib_class' => '',
        //     'ib_icon' => 'fa-image',
        //     'ib_content' => array(
        //         'info_box_text' => 'Banner',
        //         'info_box_number' => $this->home_model->_banner_count(),
        //     ),
        //     'ib_background' => array(
        //         'location' => 'half',
        //         'color' => 'bg-aqua',
        //     ),
        // );
        // $infobox2 = array (
        //     'ib_class' => '',
        //     'ib_icon' => 'fa-shopping-cart',
        //     'ib_content' => array(
        //         'info_box_text' => 'Product',
        //         'info_box_number' => $this->products_model->_banner_count(),
        //     ),
        //     'ib_background' => array(
        //         'location' => 'half',
        //         'color' => 'bg-aqua',
        //     ),
        // );

        // $data[] = $this->data;

        // $data['infobox_one'] = _info_box($infobox);
        // $data['infobox_two'] = _info_box($infobox2);
        
        $this->template->_render_admin('dashboard_admin', $data, FALSE);  
    }

    public function tes()
    {
        echo print_r($this->template->_nav_menu('sidebar_admin_menu'));
    }

    
}
