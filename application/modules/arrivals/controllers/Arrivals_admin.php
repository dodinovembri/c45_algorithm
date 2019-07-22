<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Arrivals_admin extends Admin_Controller 
{
    // this class using for administrator not user/public on admin
    // can access by admin
    public function __construct()
    {
        parent::__construct();
	
        $this->load->model(array('data_model', 'airlines_model', 'airports_model', 'flight_model'));
        $this->load->library(array('template', 'form_validation'));
        // $this->load->library('database');
        $this->load->helper(array('adminlte_helper','language','url', 'form'));

        // load ion auth
        $this->load->add_package_path(APPPATH.'third_party/ion_auth/');
        $this->load->library('ion_auth');
        $this->lang->load('auth');
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        // users can access by admin
        if(!$this->ion_auth->logged_in() or !$this->ion_auth->is_admin() and !$this->ion_auth->in_group(['2', '3']))
        {
             redirect('auth', 'refresh');
        }
    }

    public function index()
	{   
        $this->load->library('datatables');
        $data['page_title'] = 'Arrivals';
        $data['page_description'] = 'Arrival List';
        $data['message'] = $this->session->flashdata('message');
        $data['dt_users'] = $this->data_model->_datatable_index();
        $this->template->_set_css('admin','dataTables.bootstrap.min.css','adminlte/bower_components/datatables.net-bs/css')
                    ->_set_js('admin','footer','jquery.dataTables.min.js','adminlte/bower_components/datatables.net/js')
                    ->_set_js('admin','footer','dataTables.bootstrap.min.js','adminlte/bower_components/datatables.net-bs/js')
                    // ->_set_js('admin','footer','serverside.dataTables.js','adminlte/script')
                    ->_set_js('admin','footer','htmldom.dataTables.js','adminlte/script')
                    ->_set_js('admin','footer','dataTables.buttons.min.js','https://cdn.datatables.net/buttons/1.5.2/js', TRUE)
                    ->_set_js('admin','footer','buttons.flash.min.js','https://cdn.datatables.net/buttons/1.5.2/js', TRUE)
                    ->_set_js('admin','footer','jszip.min.js','https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3', TRUE)
                    ->_set_js('admin','fopdfmake.min.js','https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36', TRUE)
                    ->_set_js('admin','footer','vfs_fonts.js','https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36', TRUE)
                    ->_set_js('admin','footer','buttons.html5.min.js','https://cdn.datatables.net/buttons/1.5.2/js', TRUE)
                    ->_set_js('admin','footer','buttons.print.min.js','https://cdn.datatables.net/buttons/1.5.2/js', TRUE)
                    ->_render_admin('index_user_admin', $data);
    }

    public function add()
    { 
        $tables = $this->config->item('tables', 'products');
        $identity_column = $this->config->item('identity', 'products');
        $data['form']['identity_column'] = $identity_column;
        $data['airlines'] = $this->airlines_model->_list();
        $data['airports'] = $this->airports_model->_list();
        $data['flights'] = $this->flight_model->_list();
        // validate form input
        $this->form_validation->set_rules('airlines', 'Airlines Name', 'trim|required');
        $this->form_validation->set_rules('flight_no', 'Flight No.', 'trim|required');
        $this->form_validation->set_rules('airport', 'Airport', 'trim|required');
        $this->form_validation->set_rules('schedule_time', 'Schedule Time', 'trim|required');
        $this->form_validation->set_rules('tanggal', 'Schedule Date', 'trim|required');

        if ($this->form_validation->run() === TRUE)
        {
            $time= !empty($this->input->post('schedule_time')) ? date('H:i:s', strtotime($this->input->post('schedule_time'))) : '';
            $date = !empty($this->input->post('tanggal')) ? date('Y-m-d H:i:s', strtotime($this->input->post('tanggal'))) : '';
            $additional_data = array(
                'airlines' => $this->input->post('airlines'),
                'flight_no' => $this->input->post('flight_no'),
                'airport' => $this->input->post('airport'),
                'schedule_time' => $time,
                'tanggal' => $date,
                'type'  => 'Arrival',
                'status' => $this->input->post('status'),
            );
            $this->data_model->_create($additional_data);
                        $this->session->set_flashdata('message', 'Sukses menambahkan data arrival');
            redirect('admin'. DIRECTORY_SEPARATOR .'arrivals', 'refresh');


        }
        else
        {
            $data['page_title'] = 'Add Arrival';
            $data['page_description'] = '';
            
            $this->template->_render_admin('add_user_admin', $data);
        }    
    }

    /**
	 * @return array A CSRF key-value pair
	 */
	public function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
    }
    
    /**
	 * @return bool Whether the posted CSRF token matches
	 */
	public function _valid_csrf_nonce(){
		$csrfkey = $this->input->post($this->session->flashdata('csrfkey'));
		if ($csrfkey && $csrfkey === $this->session->flashdata('csrfvalue')){
			return TRUE;
		}
			return FALSE;
	}

    // public function json_users()
    // {
    //     $this->load->library('datatables');
    //     return print_r($this->datatables->select('username, email, last_login')
    //                         ->from('users')
    //                         ->generate());
    //     // echo var_dump($this->datatables->_get_table('users'));
    // }
}
