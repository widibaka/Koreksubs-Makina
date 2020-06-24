<?php 

class User_model extends CI_Model
{
	public function registerANewUser() {
		if ( !empty($this->input->post('username')) AND !empty($this->input->post('email')) AND !empty($this->input->post('password')) AND !empty($this->input->post('password_verify')) ) {

			// Send an email
			$email_address_from = 'widibaka_noreply@koreksubs.online';
			$sender_name = 'Widi Baka';
			$email_address_to = $this->input->post('email');
			$subject = 'Terima kasih dari koreksubs';
			$message = 'Terima kasih sudah melakukan registrasi Akun koreksubs!';

			$this->Client_model->send_email( $email_address_from, $sender_name, $email_address_to, $subject, $message );

			// set the default sidebar_bg
			$sidebar_bg = base_url('assets/img/theme/maid_saber.png');
			$waktu_saat_ini = date("Y-m-d H:i:s");
			$data = array(
			        'username' => $this->input->post('username'),
			        'email' => $this->input->post('email'),
			        'password' => $this->input->post('password'),
			        'skills' => $this->input->post('skills'),
			        'message_read' => 0,
			        'admin' => 0,
			        'kota_asal' => $this->input->post('kota_asal'),
			        'subscription' => 1,

					// using default color and theme set
					'navbar_skin' => 'navbar-dark',
					'navbar_varian' => 'navbar-gray-dark',
					'brand_color' => 'warning',
					'sidebar_color' => 'sidebar-light-warning',
					'accent_color' => 'warning',
					'theme' => 'Maid_Saber',
					'sidebar_bg' => $sidebar_bg,
					'timestamp' => $waktu_saat_ini,
			);
			$this->db->insert('users',$data);

			// Beri pesan selamat datang secara otomatis untuk anggota baru
			$pesan = '<p>Halo '.$this->input->post('username').'! Aku widibaka!</p>Selamat datang di <u>Koreksubs Makina</u>!<br>Kamu bisa mengganti tema akun kamu ini dengan cara membuka menu <b>settings </b>--&gt; <b>customization</b> --&gt; lalu pilih theme yang kamu suka. Lalu kamu pun bebas untuk mengubah warna dan background sidebar akun kamu sesuai yang kamu mau.<p xss=removed>Jangan sungkan untuk menghubungi admin untuk sekedar ngasih tahu atau memberi masukan.</p>';

			$data1 = array(
					// Di bawah ini bisa diganti jadi nama orang lain, kalau ada yang pakai software ini selain gue.
			        'from' => 'widibaka',
			        'to' => $this->input->post('username'),
			        'text' => $pesan,
					'timestamp' => $waktu_saat_ini,
			);
			$this->db->insert('pesan', $data1);
		}
		
	}

	public function registerANewUser_ByGoogle($username,$email) {
		// set the default sidebar_bg
		$sidebar_bg = base_url('assets/img/theme/maid_saber.png');
		$waktu_saat_ini = date("Y-m-d H:i:s");
		$data = array(
		        'username' => $username,
		        'email' => $email,
		        'password' => 'reg.with.google',
			    'subscription' => 1,

				// using default color and theme set
				'navbar_skin' => 'navbar-dark',
				'navbar_varian' => 'navbar-gray-dark',
				'brand_color' => 'warning',
				'sidebar_color' => 'sidebar-light-warning',
				'accent_color' => 'warning',
				'theme' => 'Maid_Saber',
				'sidebar_bg' => $sidebar_bg,
				'timestamp' => $waktu_saat_ini,
		);
		$this->db->insert('users',$data);

		// Beri pesan selamat datang secara otomatis untuk anggota baru
		$pesan = '<p>Halo '.$username.'! Aku widibaka!</p>Selamat datang di <u>Koreksubs Makina</u>!<br>Kamu bisa mengganti tema akun kamu ini dengan cara membuka menu <b>settings </b>--&gt; <b>customization</b> --&gt; lalu pilih theme yang kamu suka. Lalu kamu pun bebas untuk mengubah warna dan background sidebar akun kamu sesuai yang kamu mau.<p xss=removed>Jangan sungkan untuk menghubungi admin untuk sekedar ngasih tahu atau memberi masukan.</p>';

		$data1 = array(
				// Di bawah ini bisa diganti jadi nama orang lain, kalau ada yang pakai software ini selain gue.
		        'from' => 'widibaka',
		        'to' => $username,
		        'text' => $pesan,
		        'timestamp' => $waktu_saat_ini,
		);
		$this->db->insert('pesan', $data1);
		
	}

	public function getUserData()
	{
		$username = $this->input->post('username');
		if ( isset($username) ) {
			$query = $this->db->get_where( 'users',['username' => $username] ); // Produces: WHERE name = 'Joe'
			// var_dump($username);
			return $query->result_array();
		}
		else
		{
			return 0;
		}
		
	}
	public function getUserDataById($user_id)
	{
		$query = $this->db->get_where( 'users',['user_id' => $user_id] ); // Produces: WHERE name = 'Joe'
		return $query->result_array();
		
	}
	public function getUserDataByEmail($email)
	{
		$query = $this->db->get_where( 'users',['email' => $email] );
		return $query->result_array();
		
	}

	public function loginWithGoogle($email)
	{
		$try = $this->User_model->getUserDataByEmail($email);
		
		if ( !empty($try) ) {
			$data['userdata'] = $this->User_model->getUserDataByEmail($email)[0];
			// Set session with User's data(s), user_id and username
	 		$this->session->set_userdata( 'username', $data['userdata']['username'] );
	 		$this->session->set_userdata( 'user_id', $data['userdata']['user_id'] );
	 		if ( $data['userdata']['admin'] == 1 ) {
	 			$this->session->set_userdata( 'admin', 'yes' );
	 		}
	 		if ( $data['userdata']['admin'] == 2 ) {
	 			$this->session->set_userdata( 'admin_super', 'yes' );
	 		}
	 		return 1;
		}else{
			// If there is no data yet in database, return 0 as an indicator
			return 0;
		}
	}

	public function logout()
	{
		$var_userdata = array( 'user_id', 'username', 'admin', 'admin_super' );

		if ( $this->session->userdata( 'username' ) ) {
			$this->session->unset_userdata( $var_userdata );
		}

		// Hapus cookie dengan cara mundurkan waktu berlaku sebanyak minus 7 hari.
		$this->load->helper('cookie');
		delete_cookie('token');
	}

	public function editProfile()
	{
		if ( !empty($this->input->post('kota_asal')) ) {
			$kota_asal =  $this->input->post('kota_asal', true);
			$data1 = array(
			        'kota_asal' => $kota_asal,
			);
			$user_id = $this->session->userdata('user_id');

			$this->db->where('user_id', $user_id);
			$this->db->update('users', $data1);
		}
		if ( !empty($this->input->post('skills')) ) {
			$skills =  $this->input->post('skills', true);
			$data1 = array(
			        'skills' => $skills,
			);
			$user_id = $this->session->userdata('user_id');

			$this->db->where('user_id', $user_id);
			$this->db->update('users', $data1);
		}

	}

	public function getTheme()
	{
		if (!empty($this->session->userdata('user_id'))) {
			$user_id = $this->session->userdata('user_id');
			$user_preferences = $this->User_model->getUserDataById($user_id)[0];
			$theme = $user_preferences;
			return $theme;
		} else {
			// if no session userdata, set color to default
			$theme['navbar_skin'] = 'navbar-dark';
			$theme['navbar_varian'] = 'navbar-navy';
			$theme['brand_color'] = 'primary';
			$theme['sidebar_color'] = 'sidebar-dark-primary';
			$theme['accent_color'] = 'primary';
			$theme['theme'] = 'Yato';
			$theme['sidebar_bg'] = base_url('assets/img/theme/yato.jpg');
			return $theme;
		}
		
	}

	public function setNavbarColor()
	{
		if ( !empty($this->input->post('input_navbar_skin')) AND !empty($this->input->post('input_navbar_varian')) ) {
			$navbar_skin =  $this->input->post('input_navbar_skin', true);
			$navbar_varian =  $this->input->post('input_navbar_varian', true);
			$data1 = array(
			        'navbar_skin' => $navbar_skin,
			        'navbar_varian' => $navbar_varian
			);
			$user_id = $this->session->userdata('user_id');

			$this->db->where('user_id', $user_id);
			$this->db->update('users', $data1);
		}

	}

	public function setBrandColor()
	{
		if ( !empty($this->input->post('input_brand_color')) ) {
			$value =  $this->input->post('input_brand_color', true);
			$data1 = array(
			        'brand_color' => $value
			);
			$user_id = $this->session->userdata('user_id');

			$this->db->where('user_id', $user_id);
			$this->db->update('users', $data1);
		}

	}

	public function setSidebarColor()
	{
		if ( !empty($this->input->post('input_sidebar_color')) ) {
			$value =  $this->input->post('input_sidebar_color', true);
			$data1 = array(
			        'sidebar_color' => $value,
			);
			$user_id = $this->session->userdata('user_id');

			$this->db->where('user_id', $user_id);
			$this->db->update('users', $data1);
		}

	}

	public function setAccentColor()
	{
		if ( !empty($this->input->post('input_accent_color')) ) {
			$value =  $this->input->post('input_accent_color', true);
			$data1 = array(
			        'accent_color' => $value,
			);
			$user_id = $this->session->userdata('user_id');

			$this->db->where('user_id', $user_id);
			$this->db->update('users', $data1);
		}

	}

	public function saveTheme()
	{
		if ( isset($_POST['save_theme']) ) {
			$name =  $this->input->post('input_theme_name', true);
			// $image =  $this->input->post('input_theme_image', true);
			$navbar_skin =  $this->input->post('input_theme_navbar_skin', true);
			$navbar_varian =  $this->input->post('input_theme_navbar_varian', true);
			$brand_color =  $this->input->post('input_theme_brand_color', true);
			$sidebar_color =  $this->input->post('input_theme_sidebar_color', true);
			$accent_color =  $this->input->post('input_theme_accent_color', true);
			$data1 = array(
			        // 'name' => $name,
			        // 'image' => $image,
			        'navbar_skin' => $navbar_skin,
			        'navbar_varian' => $navbar_varian,
			        'brand_color' => $brand_color,
			        'sidebar_color' => $sidebar_color,
			        'accent_color' => $accent_color,
			);

			$this->db->where('name', $name);
			$this->db->update('themes_collection', $data1);
		}

	}

	public function applyTheme()
	{
		if ( isset($_POST['apply_theme']) ) {
			$name =  $this->input->post('input_theme_name', true);
			$image =  $this->input->post('input_theme_image', true);
			$navbar_skin =  $this->input->post('input_theme_navbar_skin', true);
			$navbar_varian =  $this->input->post('input_theme_navbar_varian', true);
			$brand_color =  $this->input->post('input_theme_brand_color', true);
			$sidebar_color =  $this->input->post('input_theme_sidebar_color', true);
			$accent_color =  $this->input->post('input_theme_accent_color', true);
			$data1 = array(
			        'theme' => $name,
			        'sidebar_bg' => $image,
			        'navbar_skin' => $navbar_skin,
			        'navbar_varian' => $navbar_varian,
			        'brand_color' => $brand_color,
			        'sidebar_color' => $sidebar_color,
			        'accent_color' => $accent_color,
			);
			$user_id = $this->session->userdata('user_id');

			$this->db->where('user_id', $user_id);
			$this->db->update('users', $data1);
		}

	}

	public function setImage()
	{
		if ( isset($_POST['input_image']) ) {
			$value =  $this->input->post('input_image', true);
			$data1 = array(
			        'sidebar_bg' => $value,
			        'theme' => 'Buatan sendiri',
			);
			$user_id = $this->session->userdata('user_id');

			$this->db->where('user_id', $user_id);
			$this->db->update('users', $data1);
		}

	}

	public function getThemesCollection()
	{
		$query = $this->db->get( 'themes_collection' );
		return $query->result_array();

	}

	public function getInboxMessages()
	{
		// ordered where the latest one is top
		$this->db->order_by('timestamp', 'DESC');
		$this->db->where( 'to', $this->session->userdata('username') );
		$query = $this->db->get( 'pesan' );
		return $query->result_array();

	}

	public function getSentMessages()
	{
		// ordered where the latest one is top
		$this->db->order_by('timestamp', 'DESC');
		$this->db->where( 'from', $this->session->userdata('username') );
		$query = $this->db->get( 'pesan' );
		return $query->result_array();

	}

	public function getMessageById($id)
	{
		$this->db->where( 'id', $id );
		$query = $this->db->get( 'pesan' );
		return $query->result_array()[0];

	}

	public function getAllUsername()
	{
		$this->db->where( 'username !=', $this->session->userdata('username') );
		$this->db->select( 'username' );
		$query = $this->db->get( 'users' );
		return $query->result_array();

	}

	public function sendMessage()
	{
		if ( isset($_POST['input_message']) ) {
			$input_to =  $this->input->post('input_to', true);
			$input_message =  $this->input->post('input_message', true);
			$waktu_saat_ini = date("Y-m-d H:i:s");
			$data1 = array(
			        'from' => $this->session->userdata('username'),
			        'to' => $input_to,
			        'text' => htmlspecialchars($input_message),
					'timestamp' => $waktu_saat_ini,
			);
			$user_id = $this->session->userdata('user_id');
			$this->db->insert('pesan', $data1);
		}

	}

	# Untuk fitur pesan

	public function getMessageUnreadYet() {
		$this->db->select('message_read');
		$query = $this->db->get_where( 'users',['user_id' => $this->session->userdata('user_id')] );
		$try_result = $query->result_array(); // try to call if any message exists

		if (!empty($try_result)) { // if there is any message
			$message_read = $query->result_array()[0]['message_read']; // calling previous number
			$this->db->select('to');
			$query = $this->db->where( 'to', $this->session->userdata('username') );
			$this->db->from('pesan');
			$message_count = $query->count_all_results(); // counting all messages sent to THIS user

			$message_unread = $message_count - $message_read; // update the number

			return $message_unread;
		}
		else {
			 // if no message, then just return 0 to avoid error or offset
			return 0;
		}
	}
	

	public function updateMessageHasRead() {
		$this->db->select('message_read');
		$query = $this->db->get_where( 'users',['user_id' => $this->session->userdata('user_id')] );
		$try_result = $query->result_array(); // try to call if any message exists

		if (!empty($try_result)) { // if there is any message
			$message_read = $query->result_array()[0]['message_read']; // calling previous number

			$this->db->select('to');
			$query = $this->db->where( 'to', $this->session->userdata('username') );
			$this->db->from('pesan');
			$message_count = $query->count_all_results(); // counting all messages sent to THIS user

			$message_read = $message_count; // update the number

			$data = array(
			        'message_read' => $message_read
					);
			$this->db->where( 'user_id', $this->session->userdata('user_id') ); // change the number to the new one
			$this->db->update('users', $data);
		}
	}
	

	public function deleteMessagesRegularly() {

		$this->db->select('to');
		$this->db->from('pesan');
		$query = $this->db->where( 'to', $this->session->userdata('username') );
		$message_count = $query->count_all_results(); // counting all messages sent to THIS user


		//Kalau jumlah pesan lebih dari 100, reset menjadi $message_count - 10, biar databasenya gak penuh.
		if($message_count > 100) {
		  $this->db->limit(10);
		  $this->db->order_by('timestamp', 'ASC');
		  $this->db->where( 'to', $this->session->userdata('username') );
		  $this->db->delete('pesan');
		}
	}

	# /.Untuk fitur pesan

	public function getUserCommentCountById($id)
	{
		$this->db->from('comments');
		$query = $this->db->where( 'user_id', $id );
		return $query->count_all_results();

	}

	public function getUserLinkReportmentCountByUsername($username)
	{
		$this->db->select('link_status');
		$this->db->from('episodes');
		$query = $this->db->or_like( 'link_status', $username );
		return $query->count_all_results();

	}

	public function getAllUserCommentsById($id)
	{
		$this->db->limit(200);
		$this->db->select('user_id, anime_parent_id, timestamp');
		$this->db->where( 'user_id', $id );
		$this->db->order_by('id','DESC');
		$query = $this->db->get('comments');
		return $query->result_array();

	}
	
	public function deleteCommentById() {
		if (!empty($this->input->get('delete_comment'))) {
			$id = $this->input->get('delete_comment');
			$this->db->where( 'id', $id );
			$data = array(
			        'comment' => '', // dikosongkan, tapi row-nya biarin aja
					);
			$this->db->update('comments', $data);
		}
		
	}

	public function deleteAccountById($user_id) {
		if (!empty($user_id)) {
			$this->db->where( 'user_id', $user_id );
			$this->db->delete('users');
		}
		
	}

	public function setSubscriptionStatus()
	{
			$value =  $this->input->post('status', true);
			$data1 = array(
			        'subscription' => $value
			);
			$user_id = $this->session->userdata('user_id');

			$this->db->where('user_id', $user_id);
			$this->db->update('users', $data1);

	}
}