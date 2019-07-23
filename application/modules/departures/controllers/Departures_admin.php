<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departures_admin extends Admin_Controller 
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
        if(!$this->ion_auth->logged_in() or !$this->ion_auth->is_admin() and !$this->ion_auth->in_group(['2']))
        {
             redirect('auth', 'refresh');
        }
    }

    public function index()
	{   
        $this->load->library('datatables');
        $data['page_title'] = 'Departures';
        $data['page_description'] = 'Departure List';
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
                'type'  => 'Departure',
                'status' => $this->input->post('status'),
            );
            $this->data_model->_create($additional_data);
                        $this->session->set_flashdata('message', 'Sukses menambahkan data departure');
            redirect('admin'. DIRECTORY_SEPARATOR .'departures', 'refresh');


        }
        else
        {
            $data['page_title'] = 'Add Departure';
            $data['page_description'] = '';
            
            $this->template->_render_admin('add_user_admin', $data);
        }    
    }

    public function import()
    {
        $tables = $this->config->item('tables', 'ion_auth');
        $identity_column = $this->config->item('identity', 'ion_auth');
        $data['form']['identity_column'] = $identity_column;
        if($_FILES){
            // config upload
            $config['upload_path'] = './assets/public/uploads/';
            $config['allowed_types'] = 'xls';
            $config['max_size'] = '10000';

            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('userfile')) {
                // jika validasi file gagal, kirim parameter error ke index
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('message', 'You have no upload any file');
                redirect(site_url('admin/departures'));
            } else {
              // jika berhasil upload ambil data dan masukkan ke database
              $upload_data = $this->upload->data();
              // load library Excell_Reader
              $this->load->library('Excel_reader');
              //tentukan file
              $this->excel_reader->setOutputEncoding('230787');
              $file = $upload_data['full_path'];
              $this->excel_reader->read($file);
              error_reporting(E_ALL ^ E_NOTICE);
              // array data
              $data = $this->excel_reader->sheets[0];
              $dataexcel = Array();
              for ($i = 2; $i <= $data['numRows']; $i++) {
                   if ($data['cells'][$i][1] == '')
                       break;

                   $dataexcel[$i - 1]['airlines'] = $data['cells'][$i][1];
                   $dataexcel[$i - 1]['flight_no'] = $data['cells'][$i][2];
                   $dataexcel[$i - 1]['schedule_time'] = $data['cells'][$i][3];
                   $dataexcel[$i - 1]['airport'] = $data['cells'][$i][4];
                   $dataexcel[$i - 1]['type'] = $data['cells'][$i][5];
                   $dataexcel[$i - 1]['date'] = $data['cells'][$i][6];
                   $dataexcel[$i - 1]['status'] = $data['cells'][$i][7];
              }

              //load model
              $this->load->model('Departures_model');
              $this->Departures_model->loaddata($dataexcel);
              //delete file
              $file = $upload_data['file_name'];
              $path = './assets/public/uploads/' . $file;
              @unlink($path);

              //redirect ke halaman awal
              $this->session->set_flashdata('message', 'Sukses import Data Survey');
              redirect(site_url('admin/departures'));
            }
        }
   
        // display the create user form
        // set the flash data error message if there is one
        $data['page_title'] = 'Impor Departures';
        $data['page_description'] = 'Form Impor Departures';
        
        $this->template->_render_admin('add_import_departures', $data);
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
