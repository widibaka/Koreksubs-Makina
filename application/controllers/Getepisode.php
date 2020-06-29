<?php 
class Getepisode extends CI_Controller
{
	public function __construct()
	{
		parent::__construct(); // Aturan saklek CI, ini harus ada

		$this->load->model('Client_model');

		//include the configuration
		include( 'config/config.php' );
		//initiate database with custom config
		$this->load->database($config);


	}
	public function index($anime_child_id){
		$data = $this->Client_model->getEpisodesByChildId($anime_child_id)[0];
		$data['converted_links'] = explode("@", $data['links']);
		echo json_encode($data);
	}
}