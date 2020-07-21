<?php 

class Admin extends CI_Controller {

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

 		/*
 		 *You cant access this class unless you are an admin
		*/

		if ( empty($this->session->userdata('admin')) AND empty($this->session->userdata('admin_super')) ) {
			redirect( base_url('client') );
			exit();
		}

	}
	public function index()
	{
		redirect(base_url('admin/series_manager/'));
	}
	
	public function series_manager($current_page = 1)
	{
		$data['theme'] = $this->User_model->getTheme();
 		$data['fansub_preferences'] = $this->Client_model->getFansubPreferences();
 		$data['five_recent_comments'] = $this->Client_model->getFiveRecentComments(); // 5 recnt comment to put into navbar
 		

		$data['page'] 		= "series_manager";
		$data['page_title'] = "Admin Series Manager";

 		$total_anime = $this->Client_model->countAllAnime();
		$data['anime'] 	= $this->Client_model->getAllAnime();
		$data['link'] = base_url('admin/series_manager/'); // produces http://localhost/client/series/

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('tools/admin/series_manager', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('additions/after_footer/series_manager');

	}
	
	public function link_rusak()
	{
		$data['theme'] = $this->User_model->getTheme();
 		$data['fansub_preferences'] = $this->Client_model->getFansubPreferences();
 		$data['five_recent_comments'] = $this->Client_model->getFiveRecentComments(); // 5 recnt comment to put into navbar
 		

		$data['page'] 		= "link_rusak";
		$data['page_title'] = "Link Rusak";

		$data['episodes'] 	= $this->Admin_model->getEpisodesWithBrokenLinks();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('tools/admin/link_rusak', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('additions/after_footer/link_rusak');

	}
	
	public function series_manager_detail($id = 0)
	{
		if ( $id == 0 ) {
			redirect( base_url('admin/series_manager.asp') );
		}
		/* 
		* Functions untuk operasi data
		*/
		$this->Admin_model->ubahAnime();
		/* 
		* ./Functions untuk operasi data
		*/

		$data['theme'] = $this->User_model->getTheme();
 		$data['fansub_preferences'] = $this->Client_model->getFansubPreferences();
 		$data['five_recent_comments'] = $this->Client_model->getFiveRecentComments(); // 5 recnt comment to put into navbar
 		

 		$total_anime = $this->Client_model->countAllAnime();

		$data['id'] = $id;
		$anime_temp = $this->Client_model->getAnimeById($id);
		
		$data['anime'] = $anime_temp[0]; // To remove the zero index
		$data['page'] = "series_manager_detail";
		$data['page_title'] = 'Sedang mengedit "' . $data['anime']['title'].'"';

		// //Data from kitsuAPI is called to get 'reset default' work out
		// $kitsu_search = $data['anime']['title'];

		// // Karakter yang ngerusak link diganti, difilter
		// $explode = explode("(", $kitsu_search); // dipecah lalu,
		// $kitsu_search = $explode[0];// diambil bagian judul jepang doang

		// $kitsu_search = str_replace(' ', '%20', $kitsu_search); //replacing space characters
		// $kitsu_search = str_replace(':', '%20', $kitsu_search); //replacing idont know characters
		// $kitsu_search = str_replace('(', '%20', $kitsu_search); //replacing bracket characters
		// $kitsu_search = str_replace(')', '%20', $kitsu_search); //replacing bracket characters
		// $kitsu_search = str_replace('/', '%20', $kitsu_search); //replacing slash
		// $kitsu_search = str_replace('!', '%20', $kitsu_search); //replacing exclamation
		// $kitsu_search = str_replace('?', '%20', $kitsu_search); //replacing question mark
		// $kitsu_search = str_replace("'", '%20', $kitsu_search); //replacing single quote mark
		// $kitsu_search = htmlspecialchars($kitsu_search);

		// $data2 = $this->Admin_model->kitsuAPI_single($kitsu_search);
		$this->load->view('templates/header', $data);
		$this->load->view('additions/after_header/series_manager_detail');
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		// WIDIBAKA! DI sini meragukan! Aku khawatir, tolong check lagi data yang dikirim ke bawah ini.
		$this->load->view('tools/admin/series_manager_detail',$data); // <-- 
		// Data yg pertama gak dikirim tapi gak error lho. Kok bisa? Harusnya kan 2 data yg dikirim...
		$this->load->view('templates/footer', $data);
		$this->load->view('additions/after_footer/series_manager_detail');
	}
	
	public function episode_manager($id = 0)
	{
		if ( $id == 0 ) {
			redirect( base_url('admin/series_manager.asp') );
		}

		$data['theme'] = $this->User_model->getTheme();
 		$data['fansub_preferences'] = $this->Client_model->getFansubPreferences();
 		$data['five_recent_comments'] = $this->Client_model->getFiveRecentComments(); // 5 recnt comment to put into navbar
 		

		$data['id'] = $id;
		$anime_temp = $this->Client_model->getAnimeById($id);
		
		$data['anime'] = $anime_temp[0]; // To remove the zero index
		$data['episodes'] = $this->Client_model->getEpisodesById($id,'file_name','ASC'); // You need to pass ('Row id: anime_parent_id', 'table order_by: file_name', 'ordering: ASC/DESC')
		$data['page'] = "episode_manager";
		$data['page_title'] = 'Sedang mengedit episode dari ' . $data['anime']['title'];

		/* 
		* Functions untuk operasi data
		*/
		// Untuk satu episode
		if ( $this->input->post('is_add_episode') == 'yes' ) {
			// Add episode
			$anime_parent_id = $this->input->post('anime_parent_id',true); 
			$file_name = $this->input->post('file_name',true); 
			$links = $this->input->post('links',true);
			$website = $this->input->post('website',true);
			#Maaf, fitur masih dalam pengembangan
			$this->Admin_model->addEpisode( $anime_parent_id, $file_name, $links, $website );
			// Send notification email
			$current_eps = $data['anime']['progress'] + 1;
			// $this->Admin_model->sendEmailSubscription_episode( $data['anime']['title'], $current_eps );
			#Maaf, fitur masih dalam pengembangan
			
		}
		// Untuk multiple episode
		if ( $this->input->post('is_multiple_episode') == 'yes' ) {
			// Add multiple_episodes
			$this->Admin_model->addMultipleEpisode( $this->input->post('multiple_episodes') );// Data hasil submit multiple episode akan ditampung di sini
			// Send notification email
			#Maaf, fitur masih dalam pengembangan
			// $this->Admin_model->sendEmailSubscription_episode( $data['anime']['title'], 'beberapa' );
			#Maaf, fitur masih dalam pengembangan
		}
		// Untuk edit episode
		if ( $this->input->post('is_edit_episode') == 'yes' ) {
			
			$anime_child_id = $this->input->post('anime_child_id'); 
			$file_name = $this->input->post('file_name'); 
			$links = $this->input->post('links');
			$website = $this->input->post('website');

			$this->Admin_model->editEpisode( $anime_child_id, $file_name, $links, $website );
			// Refresh menggunakan javascript
			redirect(base_url('admin/episode_manager/') . $id);
		}

		if ( $this->input->post('is_reset_link_status') == 'yes' ) {
			$this->Admin_model->resetLinkRusak( $this->input->post('anime_child_id') );
			redirect('admin/episode_manager/'.$id);
		}

		if ( $this->input->post('is_delete_episode') == 'yes' ) {
			$this->Admin_model->deleteEpisode( $this->input->post('anime_child_id') );
		}
		
		/* 
		* /.Functions untuk operasi data
		*/
		
		$this->Admin_model->updateProgress($id);// submit Progress

		$this->load->view('templates/header', $data);
		$this->load->view('additions/after_header/episode_manager');
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('tools/admin/episode_manager', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('additions/after_footer/episode_manager');
	}
	
	public function add_new_anime_series()
	{
		$kitsu_search = $this->input->get('kitsu_search');
		if (!empty($kitsu_search)) {
			$kitsu_search = str_replace(' ', '%20', $kitsu_search); //replacing space characters
			$kitsu_search = str_replace('/', '%20', $kitsu_search); //replacing slash
			$kitsu_search = str_replace('!', '%20', $kitsu_search); //replacing exclamation
			$kitsu_search = str_replace('?', '%20', $kitsu_search); //replacing question mark
			$kitsu_search = str_replace("'", '%20', $kitsu_search); //replacing quote mark
			$kitsu_search = str_replace("&", '%20', $kitsu_search); //replacing & symbol
			$kitsu_search = htmlspecialchars($kitsu_search);
			$data['kitsu_anime'] = $this->Admin_model->kitsuAPI_search($kitsu_search, 5);
		}
		$data['theme'] = $this->User_model->getTheme();
 		$data['fansub_preferences'] = $this->Client_model->getFansubPreferences();
 		$data['five_recent_comments'] = $this->Client_model->getFiveRecentComments(); // 5 recnt comment to put into navbar
 		
 
		$data['page'] = "add_new_anime_series";
		$data['page_title'] = 'Add New Series';

		$this->load->view('templates/header', $data);
		$this->load->view('additions/after_header/series_manager_detail');
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('tools/admin/add_new_anime_series', $data);
		$this->load->view('templates/footer', $data);
	}
	
	public function add_new_anime_series_step2($kitsu_search)
	{
		if (!empty($kitsu_search) AND $kitsu_search !== '===custom_rilis===') {
			$data = $this->Admin_model->kitsuAPI_single($kitsu_search);
		}
		else {
			// kalau custom rilis
			$kitsu_anime = file_get_contents( base_url('assets/anime_kosong.json') ); // ambil data anime kosong
			$kitsu_anime = json_decode($kitsu_anime, true);
			$kitsu_anime = $kitsu_anime["data"][0];
			$data['kitsu_anime'] = $kitsu_anime;
			$data['kitsu_categories'] = "";
			$data['poster_tiny'] = "";
			$data['poster_medium'] = "";
			$data['season'] = "";
			$data['year'] = "";
			$data['kitsu_info'] = "";
		}
		// var_dump($data);
		// die();

		$this->Admin_model->addAnimeSeries();// Data hasil submit akan ditampung di sini

		if ( !empty($this->input->post('title')) ) { // Send an email pemberitahuan
			
			#Maaf, fitur masih dalam pengembangan
			// $this->Admin_model->sendEmailSubscription_series( $this->input->post('title') );
		}
		
		$data['theme'] = $this->User_model->getTheme();
 		$data['fansub_preferences'] = $this->Client_model->getFansubPreferences();
 		$data['five_recent_comments'] = $this->Client_model->getFiveRecentComments(); // 5 recnt comment to put into navbar
 		
 
		$data['page'] = "add_new_anime_series_step2";
		$data['page_title'] = 'Add New Series Step 2';

		$this->load->view('templates/header', $data);
		$this->load->view('additions/after_header/add_new_anime_series_step2');
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('tools/admin/add_new_anime_series_step2', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('additions/after_footer/add_new_anime_series_step2');
	}
	
	public function delete_series($page,$id)
	{
		// delete series and then redirect to the page where the series was deleted
		$this->Admin_model->deleteSeriesById($id);
		redirect( base_url('client/series/' . $page . '.asp') );
	}
	
	public function delete_all_episode($id)
	{
		// delete series and then redirect to the page where the series was deleted
		$this->Admin_model->deleteAllEpisode($id);
		redirect( base_url('admin/episode_manager/' . $id . '.asp') );
	}
	
	public function statistics($current_page = 1)
	{
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

		$data['theme'] = $this->User_model->getTheme();
 		$data['fansub_preferences'] = $this->Client_model->getFansubPreferences();
 		$data['five_recent_comments'] = $this->Client_model->getFiveRecentComments(); // 5 recnt comment to put into navbar
 		

		$data['page'] 		= "statistics";
		$data['page_title'] = "Statistik";

 		$total_anime = $this->Client_model->countAllAnime();
		$data['anime'] 	= $this->Client_model->getAllAnime();
		$data['total_views'] 	= $this->Admin_model->getAllViews();
		$data['total_downloads'] 	= $this->Admin_model->getAllDownloads();

		// Count all row of statistics
		$query = $this->db->get('stat');
		$row_count = count( $query->result_array() );

 		/*
 		 *Pagination
		*/
		$data['current_page'] = $current_page;
		//Passing (current_page, total_rows, rows_perpage)
		$data['stat'] 	= $this->Admin_model->getStatPerPage($current_page,$row_count,6); // passing 6 because per 6 months
		$data['pagination'] 	= $this->Client_model->generatePagination($current_page,$row_count,6); 
		//We should set the link for the pagination, do it by set the link just like this:
		$data['link'] = base_url('admin/statistics/'); // produces http://localhost/client/series/
 		/*
 		 *End of Pagination
		*/

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('tools/admin/statistics', $data);
		$this->load->view('tools/pagination', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('additions/after_footer/statistics');

	}
	public function website_preferences()
	{

		$data['theme'] = $this->User_model->getTheme();
 		$data['fansub_preferences'] = $this->Client_model->getFansubPreferences();
 		$data['five_recent_comments'] = $this->Client_model->getFiveRecentComments(); // 5 recnt comment to put into navbar
 		
		$this->Admin_model->ubahFansubPreferences();

		$data['themes_collection'] = $this->User_model->getAllThemesCollection('name'); // lihat di User_model utk lebih jelasnya
		
		$data['page'] 		= "website_preferences";
		$data['page_title'] = "Website Preferences";
		$this->load->view('templates/header', $data);
		$this->load->view('additions/after_header/website_preferences');
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('tools/admin_super/website_preferences', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('additions/after_footer/website_preferences');
	}
	public function admin_manager()
	{

		$data['theme'] = $this->User_model->getTheme();
 		$data['fansub_preferences'] = $this->Client_model->getFansubPreferences();
 		$data['five_recent_comments'] = $this->Client_model->getFiveRecentComments(); // 5 recnt comment to put into navbar
 		
		$data['all_admin'] = $this->Admin_model->getAllAdminUsers();

 		// To catch the id parameter
 		if ( !empty( $this->input->get('id') ) ) {
 			$this->Admin_model->removeAdminById( $this->input->get('id') );
			redirect( base_url('admin/admin_manager.asp') );
 		}


		$data['page'] 		= "admin_manager";
		$data['page_title'] = "Admin(s) Manager";
		$this->load->view('templates/header', $data);
		// $this->load->view('additions/after_header/website_preferences');
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('tools/admin_super/admin_manager', $data);
		$this->load->view('templates/footer', $data);
		// $this->load->view('additions/after_footer/website_preferences');
	}
	public function all_member()
	{

		$data['theme'] = $this->User_model->getTheme();
 		$data['fansub_preferences'] = $this->Client_model->getFansubPreferences();
 		$data['five_recent_comments'] = $this->Client_model->getFiveRecentComments(); // 5 recnt comment to put into navbar
 		
		$data['all_member'] = $this->Admin_model->getAllMembers();

 		// To catch the id parameter
 		if ( !empty( $this->input->get('id') ) ) {
 			$this->Admin_model->addAdminById( $this->input->get('id') );
			redirect( base_url('admin/all_member.asp') );
 		}

		$data['page'] 		= "all_member";
		$data['page_title'] = "All Member";
		$this->load->view('templates/header', $data);
		// $this->load->view('additions/after_header/website_preferences');
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('tools/admin_super/all_member', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('additions/after_footer/all_member');
	}
	public function generate_episode_script($anime_parent_id)
	{

		// echo $anime_parent_id;

		$this->db->order_by('file_name', 'ASC');
		$query = $this->db->get_where( 'episodes',['anime_parent_id' => $anime_parent_id] );  // Produces: SELECT * FROM mytable
		$episodes = $query->result_array();
		foreach ($episodes as $i => $eps) {
		// Breaking links down then convert it, and Adding the 'converted links' using foreach.
			$data = explode( '@', $episodes[$i]['links'] );
			$episodes[$i]['converted_links'] = $data;
		}

		// var_dump($episodes) ;

		foreach ($episodes as $key => $value) {
			echo $value['file_name'] . '<br>' . 
			$value['links'] . '<br>' . 
			$value['website'] . '<br>' . '<br>';
		}
	}
	public function custom_menu()
	{

		$data['theme'] = $this->User_model->getTheme();
 		$data['fansub_preferences'] = $this->Client_model->getFansubPreferences();
 		$data['five_recent_comments'] = $this->Client_model->getFiveRecentComments(); // 5 recnt comment to put into navbar
		

		$data['page'] 		= "custom_menu";
		$data['page_title'] = "Custom Menu";

		if ( $this->input->post('is_form_custom_menu') == "yes" ) {
			$this->Admin_model->ubahCustomMenu();
		}

		$this->load->view('templates/header', $data);
		// $this->load->view('additions/after_header/website_preferences');
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('tools/admin_super/custom_menu', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('additions/after_footer/custom_menu');
	}
}