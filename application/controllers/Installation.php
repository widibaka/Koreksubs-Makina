<?php 
/**
 * For The Installation
 */
class Installation extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct(); // Aturan saklek CI, ini harus ada

		$this->load->model('Installation_model');

		
		if ( file_exists('config/config.php') ) {
			//include the configuration
			include( 'config/config.php' );
			//Checking if variable config exists AND database is exists, if yes, go to homepage
			if ( !empty($config['hostname']) AND !empty($config['username']) AND !empty($config['database']) ) {
				redirect( base_url() );
				exit();				
			}
		}
	}

	public function index() {
		$this->load->view('installation/index');
	}

	public function configuration() {
		// Getting status from function set_configuration, whether it returns 'error' or 'success'
		$status = $this->Installation_model->set_configuration();
		if ($status == 'error') {
			$this->session->set_flashdata('flash', 'error');
			$this->session->set_flashdata('title', 'Installation has failed! Please try again.');
		} elseif ($status == 'success') {
			$this->Installation_model->install_sql_database();
			$this->session->set_flashdata('flash', 'success');
			$this->session->set_flashdata('title', 'Successfully installed!');
		}
		
		$this->load->view('installation/config_form');

	}
}