<?php 

class User extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct(); // Aturan saklek CI, ini harus ada
		$this->load->model('Client_model');

		$this->load->model('User_model');

		$this->load->model('Directory_model');

		/* 
		* All controllers have to have this block in order to connect database
		*/
		//include the configuration
		include( 'config/config.php' );
		//initiate database with custom config
		$this->load->database($config);
		/* 
		* End
		*/
	}

	public function login()
	{ 	

 		//**
 		// Login with Google
 		//**
 		require ("assets/plugins/google-api-php-client-2.4.0/vendor/autoload.php");
 		//Step 1: Enter you google account credentials

 		$g_client = new Google_Client();

 		$g_client->setClientId("91581392252-8967kib5tsjpks14vsd0scoqno5v0477.apps.googleusercontent.com");
 		$g_client->setClientSecret("HrC_h2qr6BsuLFwYOGXkeXqH");
 		$g_client->setRedirectUri( base_url('user/login/') );
 		$g_client->setScopes("email");

 		//Step 2 : Create the url
 		$auth_url = $g_client->createAuthUrl();
 		$data['auth_url'] = $auth_url;

 		//Step 3 : Get the authorization  code
 		$code = isset($_GET['code']) ? $_GET['code'] : NULL;

 		//Step 4: Get access token
 		if(isset($code)) {

 		    try {

 		        $token = $g_client->fetchAccessTokenWithAuthCode($code);
 		        $g_client->setAccessToken($token);

 		    }catch (Exception $e){
 		        $e->getMessage();
 		    }




 		    try {
 		        $pay_load = $g_client->verifyIdToken();


 		    }catch (Exception $e) {
 		        $e->getMessage();
 		    }

 		} else{
 		    $pay_load = null;
 		}

 		if(isset($pay_load)){

 			$exploded = explode( '@', $pay_load['email'] );
 		    $username = $exploded[0];
 		    $email = $pay_load['email'];

 		    $login = $this->User_model->loginWithGoogle($email);

 		    // If login failed because no such account, then register a new one
 		    if ($login == 0) {
 		    	$this->User_model->registerANewUser_ByGoogle($username,$email);
 		    	// then try to login again
 		    	$this->session->set_flashdata('register', 'success');
 		    	$this->User_model->loginWithGoogle($email);
		 		//Redirect to dashboard
		 		redirect( base_url() );
		 		exit;
 		    }else{
	 			// preparing to set cookie when arrive to dashboard, even 'remember me' wasnt checked
				$this->session->set_flashdata('is_cookie_true', 'yes');
 		    	//Redirect to dashboard
		 		redirect( base_url('client/') );
 		    }

 		}
 		//**
 		// /.Login with Google
 		//**


 		$data['fansub_preferences'] = $this->Client_model->getFansubPreferences();
		$data['page'] = "login";
		$data['page_title'] = 'login';

 		$this->load->helper(array('form'));

 		$this->load->library('form_validation');

 		$this->form_validation->set_rules('username', 'Username', 'required');
 		$this->form_validation->set_rules('password', 'Password', 'required');

 		//Get username and password input
 		$username = $this->input->post('username');
 		$password = $this->input->post('password');
 		

 		// 4 . Prevent user who has logged in, but want to go to login page again
 		if ( !is_null($this->session->userdata('username')) ) {
 			redirect( base_url() );
 		}

 		// 3 . When user has logged in
 		elseif ( !empty( $this->User_model->getUserData() ) AND isset($username) AND isset($password) ) {

	 		if ($this->form_validation->run() == FALSE)
	 		{
	 			$this->session->set_flashdata( 'login', 'error' );
	 		    $this->load->view('user/login', $data);
	 		}
	 		else {
		 		// suffix[0] is to remove index 0 that we dont need it cause we only call 1 row, and that's it.
		 		$data['userdata'] = $this->User_model->getUserData()[0];

				// Mencocokkan username dan password / matching
	 			if ( $username==$data['userdata']['username'] AND  $password==$data['userdata']['password'] ) {
	 				// Set session with User's data(s), user_id and username
	 				$this->session->set_userdata( 'user_id', $data['userdata']['user_id'] );
	 				$this->session->set_userdata( 'username', $data['userdata']['username'] );
	 				if ( $data['userdata']['admin'] == 1 ) {
	 					$this->session->set_userdata( 'admin', 'yes' );
	 				}
	 				if ( $data['userdata']['admin'] == 2 ) {
	 					$this->session->set_userdata( 'admin_super', 'yes' );
	 				}
	 				// preparing to set cookie when arrived to dashboard
					if(isset($_POST['remember'])){
						$this->session->set_flashdata('is_cookie_true', 'yes');
					}
	 				//Redirect to dashboard
	 				redirect( base_url() );
	 			} else {
	 				// 2 . When user has logged in, but failed
	 				$this->session->set_flashdata( 'login', 'error' );
	 				redirect( base_url('user/login/') );
	 			}
	 			
	 		}
		 }
		elseif ( empty( $this->User_model->getUserData() ) AND isset($username) AND isset($password) ) {
			// 2 . When user has logged in, but failed
			$this->session->set_flashdata( 'login', 'error' );
			redirect( base_url('user/login/') );
		}
	 	// 1 . When user has not login yet
 		else {
	 		$this->load->view('user/login', $data);
 		}
	}

	public function register()
	{ 	
 		$data['fansub_preferences'] = $this->Client_model->getFansubPreferences();
		$data['page'] = "register";
		$data['page_title'] = 'registrasi';

 		$this->load->helper(array('form'));

 		$this->load->library('form_validation');

 		$this->form_validation->set_rules('email', 'email', 'required');
 		$this->form_validation->set_rules('username', 'Username', 'required');
 		$this->form_validation->set_rules('password', 'Password', 'required');
 		$this->form_validation->set_rules('password_verify', 'Password verify', 'required|matches[password]');

 		//Get username and password input
 		$email = $this->input->post('email');
 		$username = $this->input->post('username');
 		$password = $this->input->post('password');
 		$password_verify = $this->input->post('password_verify');

 		if ( !is_null($this->session->userdata('username')) ) {
 			redirect( base_url() );
 		}

 		// 3 . When user has inputted his/her account form
 		elseif ( isset($email) AND isset($username) AND isset($password) AND isset($password_verify) ) {

	 		if ($this->form_validation->run() == FALSE)
	 		{
	 			$this->session->set_flashdata( 'register', 'error' );
	 		    $this->load->view('user/register', $data);
	 		}
	 		else {
				// Mencocokkan username, jika ada bilang kalau username sudah terpakai
				// Matching with existing accounts, whether the username inputted is in the list or not
	 			if ( !empty($this->User_model->getUserData()[0]) ) {
	 				// When username has already taken
	 				$this->session->set_flashdata( 'register', 'username_taken' );
	 				redirect( base_url('user/register/') );
	 			}
	 			elseif ( strlen($username)<5 ) {
	 				// When username has already taken
	 				$this->session->set_flashdata( 'register', 'username_tooshort' );
	 				redirect( base_url('user/register/') );
	 			} else {
	 				//Add to database a new user
	 				$this->User_model->registerANewUser();

	 				$this->session->set_flashdata( 'register', 'success' );
	 				//Redirect to dashboard
	 				redirect( base_url('user/login/') );
	 			}
	 			
	 		}
		}
		elseif ( !empty( $this->User_model->getUserData() ) AND isset($username) AND isset($password) ) {
			// 2 . When user has logged in, but failed
			$this->session->set_flashdata( 'register', 'error' );
			redirect( base_url('user/register/') );
		}
	 	// 1 . When user has not login yet
 		else {
	 		$this->load->view('user/register', $data);
 		}

	}

	public function forgot_password()
	{ 	
 		$data['fansub_preferences'] = $this->Client_model->getFansubPreferences();
		$data['page'] = "forgot_password";
		$data['page_title'] = 'Lupa Password';

 		$this->load->helper(array('form'));

 		$this->load->library('form_validation');

 		$this->form_validation->set_rules('email', 'email', 'required');

 		//Get username and password input
 		$email = $this->input->post('email');


 		if ($this->form_validation->run() == FALSE AND isset($email))
 		{
 			$this->session->set_flashdata( 'email_send', 'error' );
 			$this->load->view('user/forgot_password', $data);
 			
 		}

 		elseif ( !empty( $email ) ) {
 			
 			$try = $this->User_model->getUserDataByEmail( $email );

 			if ( !empty($try) ) {
 				$username = $this->User_model->getUserDataByEmail( $email )[0]['username'];
 				$password = $this->User_model->getUserDataByEmail( $email )[0]['password'];
 				if ($password == 'reg.with.google') {
 					$password = '(Maaf, Anda registrasi menggunakan akun Google, jadi tidak ada Passwordnya. :D)';
 				}
 				// Send an email
 				$email_address_from = 'widibaka_noreply@koreksubs.online';
 				$sender_name = 'Widi Baka';
 				$email_address_to = $email;
 				$subject = 'Email pemberitahuan Password';
 				$message = 'Password untuk akun koreksubs <'.$username.'> adalah <' . $password.'>';

 				$this->Client_model->send_email( $email_address_from, $sender_name, $email_address_to, $subject, $message );
 				$this->session->set_flashdata( 'email_send', 'success' );
 				$this->load->view('user/forgot_password', $data);

 			}
 		}
 		else{
 			$this->load->view('user/forgot_password', $data);
 		}
	}

	public function logout()
	{
		$this->User_model->logout();
		redirect(base_url());
	}

	public function delete_account($id)
	{
		$this->User_model->deleteAccountById($id);

		$this->load->helper('file');
		unlink( 'assets/img/'.$id.'.jpg' ); // delete the photo profile

		$this->User_model->logout();
		redirect(base_url());
	}
}