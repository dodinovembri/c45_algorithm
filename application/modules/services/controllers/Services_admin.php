<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services_admin extends Admin_Controller 
{
    // this class using for administrator not user/public on admin
    // can access by admin
    public function __construct()
    {
        parent::__construct();
	
        $this->load->model(array('services_model'));
        $this->load->library(array('template', 'form_validation'));
        // $this->load->library('database');
        $this->load->helper(array('adminlte_helper','language','url', 'form'));

        // load ion auth
        $this->load->add_package_path(APPPATH.'third_party/ion_auth/');
        $this->load->library('ion_auth');
        $this->lang->load('auth');
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        // users can access by admin
        if(!$this->ion_auth->logged_in() or !$this->ion_auth->is_admin())
        {
             redirect('auth', 'refresh');
        }
    }

    public function index()
	{   
        $this->load->library('datatables');
        $data['page_title'] = 'Services';
        $data['page_description'] = 'Services List';
        $data['message'] = $this->session->flashdata('message');
        $data['dt_users'] = $this->services_model->_datatable_index();
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
        $tables = $this->config->item('tables', 'services');
        $identity_column = $this->config->item('identity', 'services');
        $data['form']['identity_column'] = $identity_column;

        // validate form input
        $this->form_validation->set_rules('nama_service', 'Nama Service', 'trim|required');
        $this->form_validation->set_rules('ket', 'Keterangan', 'trim|required');

        if ($this->form_validation->run() === TRUE)
        {

            $additional_data = array(
                'icon_service' => $this->input->post('icon_service'),
                'nama_service' => $this->input->post('nama_service'),
                'ket' => $this->input->post('ket'),
            );
            $this->services_model->_create($additional_data);
                        $this->session->set_flashdata('message', 'Sukses menambahkan service');
            redirect('admin'. DIRECTORY_SEPARATOR .'services', 'refresh');


        }
        else
        {
            // display the create user form
            // set the flash data error message if there is one
            $data['message'] = (validation_errors() ? validation_errors() : ( $this->session->flashdata('message')));

            $data['form']['nama_service'] = array(
                'name' => 'nama_service',
                'id' => 'nama_service',
                'class' => 'form-control',
                'type' => 'text',
                'placeholder' => 'Nama Service',
                'value' => $this->form_validation->set_value('nama_service'),
            );
            $data['form']['ket'] = array(
                'name' => 'ket',
                'id' => 'ket',
                'class' => 'form-control',
                'type' => 'text',
                'placeholder' => 'Keterangan',
                'value' => $this->form_validation->set_value('ket'),
            );
            $data['form']['icon_service'] = array(
                'name' => 'icon_service',
                'id' => 'icon_service',
                'class' => 'form-control',
                'type' => 'text',
                'placeholder' => 'Icon Service',
                'value' => $this->form_validation->set_value('icon_service'),
            );
            $data['page_title'] = 'Add Service';
            $data['page_description'] = 'Form Add Service';
            
            $this->template->_render_admin('add_user_admin', $data);
        }    
    }

    public function view($id)
    {
        $data['page_title'] = 'View Service';
        $data['page_description'] = '';
        $data['dt_users'] = $this->services_model->_read($id);
        $this->template->_render_admin('view_user_admin', $data);
    }

    public function edit($id)
    {
		if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id)))
		{
			redirect('auth', 'refresh');
		}

        $product = $this->services_model->_read($id);
		$user = $this->ion_auth->user($id)->row();
		$groups = $this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups($id)->result();

		// validate form input
        $this->form_validation->set_rules('ket', 'Keterangan', 'trim|required');
        $this->form_validation->set_rules('nama_service', 'Nama Service', 'trim|required');

        $identity_column = $this->config->item('identity', 'services');
        $data['form']['identity_column'] = $identity_column;
        
		if (isset($_POST) && !empty($_POST))
		{
			// do we have a valid request?
			if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
			{
				show_error('This form post did not pass our security checks.'); // $this->lang->line('error_csrf')
			}

			if ($this->form_validation->run() === TRUE)
			{

                $additional_data = array(
                    'icon_service' => $this->input->post('icon_service'),
                    'nama_service' => $this->input->post('nama_service'),
                    'ket' => $this->input->post('ket'),
                );
                $this->services_model->_update($id, $additional_data);
                            $this->session->set_flashdata('message', 'Sukses merubah service');
                redirect('admin'. DIRECTORY_SEPARATOR .'services', 'refresh');
			}
		}
        
		// display the edit user form
		$data['form']['csrf'] = $this->_get_csrf_nonce();

		// set the flash data error message if there is one
		$data['message'] = (validation_errors() ? validation_errors() : ($this->session->flashdata('message')));

        $data['form']['id'] = array(
            'name' => 'id',
            'id' => 'input-id',
            'class' => 'form-control',
            'type' => 'text',
            'placeholder' => 'Id',
            'value' => $this->form_validation->set_value('id', $product->id),
        );
            $data['form']['nama_service'] = array(
                'name' => 'nama_service',
                'id' => 'nama_service',
                'class' => 'form-control',
                'type' => 'text',
                'placeholder' => 'Nama Service',
                'value' => $this->form_validation->set_value('nama_service'),
            );
            $data['form']['ket'] = array(
                'name' => 'ket',
                'id' => 'ket',
                'class' => 'form-control',
                'type' => 'text',
                'placeholder' => 'Keterangan',
                'value' => $this->form_validation->set_value('ket'),
            );
            $data['form']['icon_service'] = array(
                'name' => 'icon_service',
                'id' => 'icon_service',
                'class' => 'form-control',
                'type' => 'text',
                'placeholder' => 'Icon Service',
                'value' => $this->form_validation->set_value('icon_service'),
            );

		// $this->_render_page('authx' . DIRECTORY_SEPARATOR . 'edit_user', $this->data);
        
        $data['page_title'] = 'Edit Service';
        $data['page_description'] = 'Form Edit Service';
        $data['dt_users'] = $this->services_model->_read($id);
        $this->template->_render_admin('edit_user_admin', $data);
    }

    public function delete($id)
    {    

        if($this->services_model->_delete($id))
        {
            $this->session->set_flashdata('message', 'Delete service success!');
        }
        else
        {
            $this->session->set_flashdata('message', 'Something error!');
        }
        redirect('admin'. DIRECTORY_SEPARATOR .'services', 'refresh');
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
