<?php 

class Installation_model extends CI_Model{

	public function set_configuration() {
		$db_host = $this->input->get('db_host', true);
		$db_username = $this->input->get('db_username', true);
		$db_password = $this->input->get('db_password', true);
		$db_name = $this->input->get('db_name', true);
		if ( isset($db_host) AND  isset($db_username) AND isset($db_password) AND isset($db_name) ) {
			if ( empty($db_host) or  empty($db_username) or empty($db_name) ) {
				/* I didn't put password if empty in the condition 
				because some people may use this app using XAMPP or other localserver.*/
				$status = 'error';

			}
			else{

				// Retrieving file content of configuration template

				$config = file_get_contents( 'config/config.tmp' );

				$custom_config = [
					//Ubah bagian sini pakai $this->input->get('') Understood?
					'DB_HOST' 		=> $db_host,
					'DB_USER' 		=> $db_username,
					'DB_PASS' 		=> $db_password,
					'DB_NAME' 		=> $db_name,
				];

				foreach ($custom_config as $key => $value){
					$config = str_replace('%%' . $key . '%%', addslashes($value), $config);
				}

				file_put_contents( 'config/config.php', $config );
				$status = 'success';
			}
			return $status;
		}
	}
	public function install_sql_database() {
		$db_link = null;
		include( 'config/config.php' );

		try
		{
			$db_link = new PDO('mysql:host=' . $config['hostname'] . ';dbname=' . $config['database'], $config['username'], $config['password']);
		}
		catch (PDOException $e) {
			echo('Informasi Database ERROR! : ' . $e->getMessage());
		}
		$query = file_get_contents('config/install.sql');

		$db_link->query($query);
	}
}