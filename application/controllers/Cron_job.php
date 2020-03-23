<?php 
class Cron_job extends CI_Controller
{
	public function __construct()
	{
		parent::__construct(); // Aturan saklek CI, ini harus ada

		$this->load->model('Client_model');

		$this->load->model('Directory_model');

		$this->load->model('Admin_model');

		$this->load->model('User_model');

		//include the configuration
		include( 'config/config.php' );
		//initiate database with custom config
		$this->load->database($config);
	}

	public function update_statistics()
	{

		# Cron Job ini bisa diakses melalui url: "base_url ... /cron_job/update_statistics.asp"
		# This Cron Job could be accessed via url: "base_url ... /cron_job/update_statistics.asp"

		/*This job is to update statistic of downlaod and view count*/

		// Get current month and year
		$current_month = ( getdate()['month'] );
		$current_year = ( getdate()['year'] );


		// Get the last row
		$this->db->limit(1);
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get('stat');
		$try = $query->result_array();
		// mencegah error offset
		if ( !$try ) {
			$this_month_stat = 0;
		}else{
			$this_month_stat = $query->result_array()[0];
		}
		
		// get the latest count of download and view
		$this->db->select_sum('download_count');
		$query = $this->db->get('stat');
		$last_sum_download_count = $query->result_array()[0]['download_count'];

		$this->db->select_sum('view_count');
		$query = $this->db->get('stat');
		$last_sum_view_count = $query->result_array()[0]['view_count'];

		// get the latest count of download and view
		$current_total_downloads 	= $this->Admin_model->getAllDownloads();
		$current_total_views 	= $this->Admin_model->getAllViews();


		// calculate number to add// selisih difference between current total count and last total count
		$download_count_to_add = $current_total_downloads - $last_sum_download_count;
		$view_count_to_add 	   = $current_total_views     - $last_sum_view_count;


		// Matching current month and year with the last row
		$last_stat_month = $this_month_stat['bulan'];
		$last_stat_year = $this_month_stat['tahun'];
		$last_stat_download_count = $this_month_stat['download_count'];
		$last_stat_view_count = $this_month_stat['view_count'];

		if ( $current_month == $last_stat_month AND $current_year == $last_stat_year ) {

			// Update the row, because it's still at the same month and year
			$data = array(
				'download_count' => $last_stat_download_count+$download_count_to_add,
				'view_count' => $last_stat_view_count+$view_count_to_add,
				 );
			$this->db->where('id', $this_month_stat['id']);
			$this->db->update('stat', $data);
			
		}else {
			// Insert new row
			$data = array(
				'bulan' => $current_month,
				'tahun' => $current_year,
				'download_count' => 0+$download_count_to_add,
				'view_count' => 0+$view_count_to_add,
				 );
			$this->db->insert('stat', $data);
		}

		/*
		** Dengan cara ini mungkin pendataannya kurang presisi, di nilai hitung setiap bulan, tapi ini efisien dalam penggunaan database.
		Daripada harus mendata setiap view atau tiap download 1 row. Bikin penuh database
		*/
	}
}