<?php 
class Client extends CI_Controller {
	public function __construct()
	{
		parent::__construct(); // Aturan saklek CI, ini harus ada

		$this->load->model('Client_model');

		$this->load->model('User_model');

		$this->load->model('Directory_model'); //Used in sidebar to load profile picture

		if ( file_exists('config/config.php') ) {
			include( 'config/config.php' );

			//Checking if variable config->hostname exists, if yes, let go to dashboard
			if ( !empty($config['hostname']) AND $config['hostname']!='%%DB_HOST%%' ) {

				$this->load->database($config);

			}
			else {
				redirect( base_url('installation') );
				exit;
			}

		}
		else {
			redirect( base_url('installation') );
			exit;
		}

	}
	public function index()
	{	
		$this->load->helper('cookie');
		// Set cookies if remember me was checked, back in the login page
		if( $this->session->flashdata('is_cookie_true') == 'yes' ){
			set_cookie('token', base64_encode($this->session->userdata('user_id')), time()+3600*24*7); // Token cookie diisi pake base64-nya user_id
		}
		// if cookie is still set, then override sessions
		if( !empty( get_cookie('token') ) ) {

			$user_id = base64_decode(get_cookie('token')); // user_id didapat dari token yang didecode dengan base64

			$userdata_cookie = $this->User_model->getUserDataById( $user_id )[0];

	 		// Set session with User's data(s), user_id and username
	 		$this->session->set_userdata( 'user_id', $userdata_cookie['user_id'] );
	 		$this->session->set_userdata( 'username', $userdata_cookie['username'] );
	 		if ( $userdata_cookie['admin'] == 1 ) {
	 			$this->session->set_userdata( 'admin', 'yes' );
	 		}
	 		if ( $userdata_cookie['admin'] == 2 ) {
	 			$this->session->set_userdata( 'admin_super', 'yes' );
	 		}
		}
		redirect( base_url() . "client/home.asp" );
	}
	public function Home()
	{
		$limit = 100;

		$data['theme'] = $this->User_model->getTheme();
 		$data['fansub_preferences'] = $this->Client_model->getFansubPreferences();
 		$data['five_recent_comments'] = $this->Client_model->getFiveRecentComments(); // 5 recnt comment to put into navbar
 		
		$data['episodes'] 	= $this->Client_model->getAllLatestEpisodes( 100 );// limited to avoid lagging . in the bracket is the limit number      
		$data['page'] 		= "home";        

		$data['page_title'] = "Home";
		$data['download_title'] = 'Update Terbaru ('.$limit.' file terbaru)'; // set anime title to something other than title, to avoid error
		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('tools/episodes', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('additions/after_footer/home');
	}
	public function series($current_page = 1)
	{ 	
		$this->load->helper("cookie");
		$data['theme'] = $this->User_model->getTheme();
 		$data['fansub_preferences'] = $this->Client_model->getFansubPreferences();
 		$data['five_recent_comments'] = $this->Client_model->getFiveRecentComments(); // 5 recnt comment to put into navbar

 		
		$data['page'] 		= "series";        
		$data['page_title'] = "Series";

 		$total_anime = $this->Client_model->countAllAnime();
 		/*
 		 *Pagination
		*/
		$data['current_page'] = $current_page;
		// Jumlah konten di tampilan list dan tile dibedakan
		if ( get_cookie("tampilan") == "list" ) {
			$anime_perpage = $data['fansub_preferences']['rows_perpage_list'];
		}
		else{
			$anime_perpage = $data['fansub_preferences']['rows_perpage_tile'];
		}
		//Passing (current_page, total_rows, rows_perpage)
		$data['anime'] 	= $this->Client_model->getAnimePerPage($current_page,$total_anime,$anime_perpage);        
		$data['pagination'] 	= $this->Client_model->generatePagination($current_page,$total_anime,$anime_perpage);
		//We should set the link for the pagination, do it by set the link just like this:
		$data['link'] = base_url('client/series/'); // produces http://localhost/client/series/
 		/*
 		 *End of Pagination
		*/
 		$this->load->view('templates/header', $data);
 		$this->load->view('templates/navbar', $data);
 		$this->load->view('templates/sidebar', $data);
 		$this->load->view('tools/pagination', $data);
		// Menampilkan list atau tile
		if ( get_cookie("tampilan") == "list" ) {
			$this->load->view('tools/series_in_list', $data);
		}
		else{
			$this->load->view('tools/series', $data);
		}
		$this->load->view('tools/pagination', $data);
		$this->load->view('templates/footer', $data);

	}

	public function anime($id)
	{
		$this->User_model->deleteCommentById();
		$data['theme'] = $this->User_model->getTheme();
 		$data['fansub_preferences'] = $this->Client_model->getFansubPreferences();
 		$data['five_recent_comments'] = $this->Client_model->getFiveRecentComments(); // 5 recnt comment to put into navbar
 		$data['comments'] = $this->Client_model->getCommentsOfAnime($id, 100);
 		
 		$this->Client_model->setStatView();
 		$this->Client_model->setViewCount($id);
 		$this->Client_model->sendComment(); // to catch the submitted comment
 		
 		$anime_perpage = 1; // showing only a single anime
 		$total_anime = $this->Client_model->countAllAnime();

		$data['id'] = $id;
		$anime_temp = $this->Client_model->getAnimeById($id);
		
		$data['anime'] = $anime_temp[0]; // To remove the zero index
		$data['episodes'] = $this->Client_model->getEpisodesById($id,'file_name','ASC'); // You need to pass ('Row id: anime_parent_id', 'table order_by: file_name', 'ordering: ASC/DESC')
		$data['available_episodes'] = count($data['episodes']);        
		$data['page'] = "anime_detail";        
		$data['page_title'] = $data['anime']['title'];
		$this->load->view('templates/header', $data);
		$this->load->view('additions/after_header/anime');
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('tools/anime_detail', $data);
		$this->load->view('tools/episodes', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('additions/after_footer/anime');
	}
	
	public function collection()
	{
		$data['theme'] = $this->User_model->getTheme();
 		$data['fansub_preferences'] = $this->Client_model->getFansubPreferences();
 		$data['five_recent_comments'] = $this->Client_model->getFiveRecentComments(); // 5 recnt comment to put into navbar
 		
 		$data['anime_count'] = $this->Client_model->countAllAnime();
 		
 		$data['anime'] = $this->Client_model->getAllAnimeTitle();
         
		$data['page'] 		= "collection";        
		$data['page_title'] = "Collection";
		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('tools/collection', $data);
		$this->load->view('templates/footer', $data);
	}
	public function advanced_search($current_page = 1)
	{
		$this->load->helper("cookie");
		$data['theme'] = $this->User_model->getTheme();
 		$data['fansub_preferences'] = $this->Client_model->getFansubPreferences();
 		$data['five_recent_comments'] = $this->Client_model->getFiveRecentComments(); // 5 recnt comment to put into navbar
        
		$data['page'] 		= "advanced_search";        
		$data['page_title'] = "Advanced Search";

 		/*
 		 *This will be used in filling up the input values
		*/
		$data['nama_anime'] = $this->input->get('nama_anime',true);
		$data['rating_from'] = $this->input->get('rating_from',true);
		$data['rating_to'] = $this->input->get('rating_to',true);
		$data['season'] = $this->input->get('season',true);
		$data['year'] = $this->input->get('year',true);

		//$data['theme'] = $this->User_model->getTheme();
 		//$data['fansub_preferences'] = $this->Client_model->getFansubPreferences();

 		/*
 		 *Pagination
		*/
 		$total_anime = $this->Client_model->countSearchedAnime();
		// Jumlah konten di tampilan list dan tile dibedakan
		if ( get_cookie("tampilan") == "list" ) {
			$anime_perpage = $data['fansub_preferences']['rows_perpage_list'];
		}
		else{
			$anime_perpage = $data['fansub_preferences']['rows_perpage_tile'];
		}
		$data['current_page'] = $current_page;
		//Passing (current_page, total_rows, rows_perpage)
		$data['anime'] = $this->Client_model->AdvancedSearchAnime($current_page,$total_anime,$anime_perpage);        
		$data['pagination'] = $this->Client_model->generatePagination($current_page,$total_anime,$anime_perpage);
		//We should set the link of the pagination, do it by set the link just like this:
		$data['link'] = base_url('client/advanced_search/'); // produces http://localhost/client/series/
 		/*
 		 *End of Pagination
		*/

		$data['total_anime'] = $total_anime;

		$this->load->view('templates/header', $data);
		$this->load->view('additions/after_header/advanced_search');
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('tools/advanced_search', $data);// Menampilkan list atau tile
		if ( get_cookie("tampilan") == "list" ) {
			$this->load->view('tools/series_in_list', $data);
		}
		else{
			$this->load->view('tools/series', $data);
		}
		$this->load->view('tools/pagination', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('additions/after_footer/advanced_search');

	}
	public function search($current_page = 1)
	{
		$this->load->helper("cookie");
		$data['theme'] = $this->User_model->getTheme();
 		$data['fansub_preferences'] = $this->Client_model->getFansubPreferences();
 		$data['five_recent_comments'] = $this->Client_model->getFiveRecentComments(); // 5 recnt comment to put into navbar
        
		$data['page'] 		= "series";        
		$data['page_title'] = "Search By name";

 		/*
 		 *This will be used in filling up the input values
		*/
		$data['nama_anime'] = $this->input->get('nama_anime',true);

		//$data['theme'] = $this->User_model->getTheme();
 		//$data['fansub_preferences'] = $this->Client_model->getFansubPreferences();

 		/*
 		 *Pagination
		*/
 		$total_anime = $this->Client_model->countSearchedAnime();
		// Jumlah konten di tampilan list dan tile dibedakan
		if ( get_cookie("tampilan") == "list" ) {
			$anime_perpage = $data['fansub_preferences']['rows_perpage_list'];
		}
		else{
			$anime_perpage = $data['fansub_preferences']['rows_perpage_tile'];
		}
		$data['current_page'] = $current_page;
		//Passing (current_page, total_rows, rows_perpage)
		$data['anime'] = $this->Client_model->AdvancedSearchAnime($current_page,$total_anime,$anime_perpage);        
		$data['pagination'] = $this->Client_model->generatePagination($current_page,$total_anime,$anime_perpage);
		//We should set the link of the pagination, do it by set the link just like this:
		$data['link'] = base_url('client/search/'); // produces http://localhost/client/series/
 		/*
 		 *End of Pagination
		*/

		$data['total_anime'] = $total_anime;

		$this->load->view('templates/header', $data);
		$this->load->view('additions/after_header/advanced_search');
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('tools/search', $data);
		// Menampilkan list atau tile
		if ( get_cookie("tampilan") == "list" ) {
			$this->load->view('tools/series_in_list', $data);
		}
		else{
			$this->load->view('tools/series', $data);
		}
		$this->load->view('tools/pagination', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('additions/after_footer/advanced_search');

	}
	public function settings()
	{
		redirect( base_url() . "client/profile.asp" );
	}

	public function profile_publicly($id)
	{
		$this->load->model('User_model');

		$data['theme'] = $this->User_model->getTheme();
 		$data['fansub_preferences'] = $this->Client_model->getFansubPreferences();
 		$data['five_recent_comments'] = $this->Client_model->getFiveRecentComments(); // 5 recnt comment to put into navbar
 		$data['comment_count'] = $this->User_model->getUserCommentCountById($id);
 		$data['user_comments'] = $this->User_model->getAllUserCommentsById($id);

 		// Trying to check whether user with that id does exist
 		$user_id = $id;
 		$try = $this->User_model->getUserDataById($user_id);

 		if ( empty($try) ){
 			echo 'Sayang sekali, akun ini sudah dihapus oleh yang bersangkutan.<br> <br> Unfortunately, this account has been deleted by the user him/herself.'; 
 			exit; 
 		}

 		// Retrieving user data
 		$data['userdata'] = $this->User_model->getUserDataById($user_id)[0];
 		
 		$data['link_report_count'] = $this->User_model->getUserLinkReportmentCountByUsername($data['userdata']['username']);
         
		$data['page'] 		= "";        
		$data['page_title'] = $data['userdata']['username'] . "'s profile";
		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('tools/profile_publicly', $data);
		$this->load->view('templates/footer', $data);
	}

	// Halaman-halaman di dalam Settings
	public function profile()
	{

		if ( empty($this->session->userdata('user_id')) ) {
			redirect( base_url('user/login') );
		}
		$this->load->model('User_model');

		$data['theme'] = $this->User_model->getTheme();
 		$data['fansub_preferences'] = $this->Client_model->getFansubPreferences();
 		$data['five_recent_comments'] = $this->Client_model->getFiveRecentComments(); // 5 recnt comment to put into navbar
 		$data['comment_count'] = $this->User_model->getUserCommentCountById($this->session->userdata('user_id'));
 		$data['user_comments'] = $this->User_model->getAllUserCommentsById($this->session->userdata('user_id'));
 		$data['link_report_count'] = $this->User_model->getUserLinkReportmentCountByUsername($this->session->userdata('username'));

 		// Getting user data
 		$user_id = $this->session->userdata('user_id');
 		$data['userdata'] = $this->User_model->getUserDataById($user_id)[0];
         
		$data['page'] 		= "profile";        
		$data['page_title'] = "Profile";
		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('tools/profile', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('additions/after_footer/profile', $data);
	}
	public function edit_profile()
	{

		if ( empty($this->session->userdata('user_id')) ) {
			redirect( base_url('user/login') );
		}
		$this->load->model('User_model');

		$data['theme'] = $this->User_model->getTheme();
 		$data['fansub_preferences'] = $this->Client_model->getFansubPreferences();
 		$data['five_recent_comments'] = $this->Client_model->getFiveRecentComments(); // 5 recnt comment to put into navbar

 		// Getting user data
 		$user_id = $this->session->userdata('user_id');
 		$data['userdata'] = $this->User_model->getUserDataById($user_id)[0];
         
		$data['page'] 		= "profile";        
		$data['page_title'] = "Profile Editing";
		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('tools/edit_profile', $data);
		$this->load->view('templates/footer', $data);
	}
	public function preferences()
	{

		if ( empty($this->session->userdata('user_id')) ) {
			redirect( base_url('user/login') );
		}

		if (null !== $this->input->post('status')) {
			$this->User_model->setSubscriptionStatus();
		}

		$data['theme'] = $this->User_model->getTheme();
 		$data['fansub_preferences'] = $this->Client_model->getFansubPreferences();
 		$data['five_recent_comments'] = $this->Client_model->getFiveRecentComments(); // 5 recnt comment to put into navbar

 		$data['userdata'] = $this->User_model->getUserDataById( $this->session->userdata['user_id'] )[0];
		        
		$data['page'] 		= "preferences";        
		$data['page_title'] = "Preferences";
		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('tools/preferences', $data);
		$this->load->view('templates/footer', $data);
	}
	public function customization()
	{

		if ( empty($this->session->userdata('user_id')) ) {
			redirect( base_url('user/login') );
		}
		// untuk menampung submit navbar
		$this->User_model->setNavbarColor();
		$this->User_model->setBrandColor();
		$this->User_model->setSidebarColor();
		$this->User_model->setAccentColor();
		$this->User_model->saveTheme();
		$this->User_model->applyTheme();
		$this->User_model->setImage();
		
		$data['theme'] = $this->User_model->getTheme();
 		$data['fansub_preferences'] = $this->Client_model->getFansubPreferences();
 		$data['five_recent_comments'] = $this->Client_model->getFiveRecentComments(); // 5 recnt comment to put into navbar
 		$data['themes_collection'] = $this->User_model->getThemesCollection();

 		$data['brand_colors'] =    [
								    'primary',
								    'warning',
								    'info',
								    'danger',
								    'success',
								    'indigo',
								    'lightblue',
								    'navy',
								    'purple',
								    'fuchsia',
								    'pink',
								    'maroon',
								    'orange',
								    'lime',
								    'teal',
								    'light',
								    'dark',
								    'olive'
								  ];
		$data['navbar_colors']['light'] = [
										    'navbar-warning',
										    'navbar-white',
										    'navbar-orange',
										  ];
		$data['navbar_colors']['dark'] = [
										    'navbar-primary',
										    'navbar-secondary',
										    'navbar-info',
										    'navbar-success',
										    'navbar-danger',
										    'navbar-indigo',
										    'navbar-purple',
										    'navbar-pink',
										    'navbar-navy',
										    'navbar-lightblue',
										    'navbar-teal',
										    'navbar-cyan',
										    'navbar-gray-dark',
										    'navbar-gray',
										  ];
		
		  $data['sidebar_colors'] = [
									    'sidebar-dark-primary',
									    'sidebar-dark-warning',
									    'sidebar-dark-info',
									    'sidebar-dark-danger',
									    'sidebar-dark-success',
									    'sidebar-dark-indigo',
									    'sidebar-dark-lightblue',
									    'sidebar-dark-navy',
									    'sidebar-dark-purple',
									    'sidebar-dark-fuchsia',
									    'sidebar-dark-pink',
									    'sidebar-dark-maroon',
									    'sidebar-dark-orange',
									    'sidebar-dark-lime',
									    'sidebar-dark-teal',
									    'sidebar-dark-olive',
									    'sidebar-dark-gray',
									    'sidebar-light-primary',
									    'sidebar-light-warning',
									    'sidebar-light-info',
									    'sidebar-light-danger',
									    'sidebar-light-success',
									    'sidebar-light-indigo',
									    'sidebar-light-lightblue',
									    'sidebar-light-navy',
									    'sidebar-light-purple',
									    'sidebar-light-fuchsia',
									    'sidebar-light-pink',
									    'sidebar-light-maroon',
									    'sidebar-light-orange',
									    'sidebar-light-lime',
									    'sidebar-light-teal',
									    'sidebar-light-olive'
									  ];

		$data['accent_colors'] = [
								    'primary',
								    'warning',
								    'info',
								    'danger',
								    'success',
								    'indigo',
								    'lightblue',
								    'navy',
								    'purple',
								    'fuchsia',
								    'pink',
								    'maroon',
								    'orange',
								    'lime',
								    'teal',
								    'olive'
								  ];        
		$data['page'] 		= "customization";        
		$data['page_title'] = "Customization";
		$this->load->view('templates/header', $data);
		$this->load->view('additions/after_header/customization');
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('tools/customization', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('additions/after_footer/customization');
	}
	// ./Halaman-halaman di dalam Settings

	public function ready_to_download($anime_parent_id, $link)
	{
		$this->Client_model->setDownloadCount($anime_parent_id);
		$this->Client_model->setStatDwonload();
		
        $link = str_replace('_pagar_','#', $link);
		$link = str_replace('-_-_-_-_-_', '/', $link);
		$link = str_replace('_moe_moe_kyun','.', $link);

		$data['link'] = 'https://'.$link;
		
		$this->load->view('tools/shortlink', $data);

	}

	public function message()
	{
		if ( empty($this->session->userdata('user_id')) ) {
			redirect( base_url('user/login') );
		}

		// To prevent database full, soale saya pake hosting murah hahaha
		$this->User_model->deleteMessagesRegularly();

		$data['theme'] = $this->User_model->getTheme();
 		$data['fansub_preferences'] = $this->Client_model->getFansubPreferences();
 		$data['five_recent_comments'] = $this->Client_model->getFiveRecentComments(); // 5 recnt comment to put into navbar
 
		$data['messages'] 	= $this->User_model->getInboxMessages();
		// var_dump($data['message']);
        
		$data['page'] 		= "message";
		$data['page_title'] = "Pesan Masuk";
		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('tools/message', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('additions/after_footer/message');
	}

	public function message_detail($id = 0)
	{
		if ( empty($this->session->userdata('user_id')) ) {
			redirect( base_url('user/login') );
		}

		if ( $id == 0 ) {
			redirect( base_url('client/message.asp') );
		}
		$data['theme'] = $this->User_model->getTheme();
 		$data['fansub_preferences'] = $this->Client_model->getFansubPreferences();
 		$data['five_recent_comments'] = $this->Client_model->getFiveRecentComments(); // 5 recnt comment to put into navbar


		$data['message'] = $this->User_model->getMessageById($id);
        
		$data['page'] 		= "message";
		$data['page_title'] = "Membaca Pesan";
		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('tools/message_detail', $data);
		$this->load->view('templates/footer', $data);

	}

	public function sent_message()
	{
		if ( empty($this->session->userdata('user_id')) ) {
			redirect( base_url('user/login') );
		}

		$data['theme'] = $this->User_model->getTheme();
 		$data['fansub_preferences'] = $this->Client_model->getFansubPreferences();
 		$data['five_recent_comments'] = $this->Client_model->getFiveRecentComments(); // 5 recnt comment to put into navbar
 
		$data['messages'] 	= $this->User_model->getSentMessages();
        
		$data['page'] 		= "message";
		$data['page_title'] = "Pesan Terkirim";
		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('tools/message', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('additions/after_footer/message');
	}

	public function message_compose()
	{

		if ( empty($this->session->userdata('user_id')) ) {
			redirect( base_url('user/login') );
		}

		// Catching something from parameter. Just a little trick
		$data['reply_to'] = $this->input->get('reply_to');
		$this->User_model->sendMessage();

		$data['theme'] = $this->User_model->getTheme();
 		$data['fansub_preferences'] = $this->Client_model->getFansubPreferences();
 		$data['five_recent_comments'] = $this->Client_model->getFiveRecentComments(); // 5 recnt comment to put into navbar
 
		$data['messages'] 	= $this->User_model->getSentMessages();
		$data['all_username'] 	= $this->User_model->getAllUsername();		// var_dump($data['all_username']);
        
		$data['page'] 		= "message";
		$data['page_title'] = "Menyusun Pesan";
		$this->load->view('templates/header', $data);
		$this->load->view('additions/after_header/message_compose');
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('tools/message_compose', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('additions/after_footer/message_compose');
	}

	// Untuk upload gambar profil dan update profil
	public function upload()
	{
		$this->load->helper(array('form'));
		if ( empty($error) ) {
			$error = '';
		}
		$this->load->view('tools/upload_form', array('error' => $error ));

		$config['upload_path']          = 'assets/img/tmp/';
		$config['allowed_types']        = 'jpg|jpeg|png';
		$config['max_size']             = 2000;
		$config['max_width']            = 5000;
		$config['max_height']           = 5000;

		$this->load->library('upload', $config);

		if ( empty($_FILES['profile_pic']["error"]) ) { // kalau ada error, misal krn tidak diisi, maka ignore aja
			if ( ! $this->upload->do_upload('profile_pic'))
			{
			        $error = $this->upload->display_errors() ;
			        $this->session->set_flashdata('error',$error);
			        var_dump($error);
			        die();
			}
			else
			{
			        $upload_data = $this->upload->data();
			        // var_dump($upload_data);

			        // Compress uploaded file
			        $user_id = $this->session->userdata('user_id');
			        $this->load->model('ResizeImage');
			        $this->ResizeImage->dir( $upload_data['full_path'] );
			        $this->ResizeImage->resizeTo(250, 250, 'maxHeight');
			        $this->ResizeImage->saveImage('assets/img/' . $user_id . '.jpg');

			        $this->load->helper('file');
			        unlink( $upload_data['full_path'] ); // delete temporary file
			}
		}

		$this->User_model->editProfile();
		redirect( base_url('client/profile.asp') );

	}

	public function set_tampilan ($tampilan, $url_back){

		$this->load->helper("cookie");
		$url_back_decoded = base64_decode($url_back);
		// Menentukan tampilan list atau tile
		if ( $tampilan == "list" ) {
			set_cookie('tampilan', "list", time()+3600*24*7);
			echo "<script>window.location.href='".$url_back_decoded."'</script>";
		}
		else{
			set_cookie('tampilan', "tile", time()+3600*24*7);
			echo "<script>window.location.href='".$url_back_decoded."'</script>";
		}
	}

	public function lapor_link_rusak ($anime_child_id = null){
		// Kalau yang buka Guest, mental supaya login dulu
		if ( empty($this->session->userdata('user_id')) ) {
			redirect( base_url('user/login') );
		}

		if ( $this->input->post('lapor_link_rusak') == "yes" ) {
			$jenis_kerusakan = $this->input->post('jenis_kerusakan');
			$username = $this->input->post('username');
			$this->Client_model->laporkanLinkRusak($anime_child_id, $jenis_kerusakan, $username);
			$this->session->set_flashdata("success", "yes");
		}

		// Kalau kosong karena diedit oleh user
		if ( empty( $anime_child_id ) ) {
			$data['theme'] = $this->User_model->getTheme();
	 		$data['fansub_preferences'] = $this->Client_model->getFansubPreferences();
	 		$data['five_recent_comments'] = $this->Client_model->getFiveRecentComments(); // 5 recnt comment to put into navbar
			$data['page'] 		= "link_reportment";
			$data['page_title'] = "Kamu ngapain sih? :v";
			$this->load->view('templates/header', $data);
			$this->load->view('templates/navbar', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('tools/link_rusak', $data);
			$this->load->view('templates/footer', $data);
		}
		// Kalau child id ada karena dibuka lewat sistem
		else{
			
			$data['theme'] = $this->User_model->getTheme();
	 		$data['fansub_preferences'] = $this->Client_model->getFansubPreferences();
	 		$data['five_recent_comments'] = $this->Client_model->getFiveRecentComments(); // 5 recnt comment to put into navbar
			$data['episode'] = $this->Client_model->getEpisodesByChildId($anime_child_id)[0];
	        
			$data['page'] 		= "link_reportment";
			$data['page_title'] = "Laporkan Link Rusak";
			$this->load->view('templates/header', $data);
			$this->load->view('templates/navbar', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('tools/lapor_link_rusak', $data);
			$this->load->view('templates/footer', $data);
			$this->load->view('additions/after_footer/lapor_link_rusak');
		}
	}
}
