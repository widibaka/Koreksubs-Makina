<?php 
 
class Admin_model extends CI_Model
{
	public function kitsuAPI_search($anime_name, $limit)
	{
		$kitsu_anime = file_get_contents('https://kitsu.io/api/edge/anime?filter[text]='. $anime_name .'&page[limit]='. $limit);
		$kitsu_anime = json_decode($kitsu_anime, true)['data'];
		
		return $kitsu_anime;
	}

	public function kitsuAPI_single($anime_name)
	{
		$kitsu_anime = file_get_contents('https://kitsu.io/api/edge/anime?filter[text]='. $anime_name .'&page[limit]=1');
		if ( empty($kitsu_anime) ) {
			echo "<script>alert('ERROR API! Tampaknya ada yang salah dengan Kitsu API.')</script>";
			exit();
		}
		$kitsu_anime = json_decode($kitsu_anime, true);
		$kitsu_anime = $kitsu_anime["data"][0];
		$data['kitsu_anime'] = $kitsu_anime;

		$kitsu_categories = file_get_contents('https://kitsu.io/api/edge/anime/'.$kitsu_anime["id"].'/categories');
		$kitsu_categories = json_decode($kitsu_categories, true);
		$data['kitsu_categories'] = $kitsu_categories;
		// Sintaks untuk menyusun value musim
		$startDate = $kitsu_anime["attributes"]["startDate"];
		$pecah_startDate_tahun = substr($startDate, 0, 4);
		$pecah_startDate_bulan = substr($startDate, 5, 2);

		// Poster image
		$data['poster_tiny'] = $kitsu_anime["attributes"]["posterImage"]["tiny"];
		$data['poster_medium'] = $kitsu_anime["attributes"]["posterImage"]["medium"];
		// Month 12 to 2 is winter, 3 - 5 is spring, 6 - 8 is summer, 9 - 11 is fall.
		if ($pecah_startDate_bulan <= "2") {
		    $musim = "Winter";
		} elseif ($pecah_startDate_bulan <= "5") {
		    $musim = "Spring";
		} elseif ($pecah_startDate_bulan <= "8") {
		    $musim = "Summer";
		} elseif ($pecah_startDate_bulan <= "11") {
		    $musim ="Fall";
		} else {
			//else, back to winter again
		    $musim = "Winter";
		}
		$data['season'] = $musim;
		$data['year'] = $pecah_startDate_tahun;
		$data['kitsu_info'] = 'https://kitsu.io/' . $kitsu_anime['id'];
		
		return $data;
	}

	public function addEpisode( $anime_parent_id, $file_name, $links, $website )
	{
			$waktu_saat_ini = date("Y-m-d H:i:s");
			$data = array(
			        'anime_parent_id' => $anime_parent_id,
			        'file_name' => $file_name,
			        'links' => $links,
			        'website' => $website,
			        'link_status' => "0,0",
			        'timestamp' => $waktu_saat_ini,
			);
			$this->db->insert('episodes', $data);
			// Produces: INSERT INTO mytable (title, name, date) VALUES ('My title', 'My name', 'My date')
		
	}

	public function editEpisode( $anime_child_id, $file_name, $links, $website )
	{
			$waktu_saat_ini = date("Y-m-d H:i:s");
			$data = array(
			        'file_name' => $file_name,
			        'links' => $links,
			        'website' => $website,
			        'timestamp' => $waktu_saat_ini,
			);
			$this->db->where('anime_child_id', $anime_child_id);
			$this->db->update('episodes', $data);
			// Produces: INSERT INTO mytable (title, name, date) VALUES ('My title', 'My name', 'My date')
		
	}

	public function addMultipleEpisode($episode_script)
	{
			$waktu_saat_ini = date("Y-m-d H:i:s");
			$splitted_script = preg_split("/[\n,]+/", $episode_script, -1, PREG_SPLIT_NO_EMPTY);

			// Removing empty elements
			$splitted_script2 = array();
			foreach ($splitted_script as $key => $value) {
				if( strlen($value) > 1 ) {
					array_push($splitted_script2, $value);
				}
			}

			// inserting.., it's lil bit complicated, but I hope you understand this math
			$script_count = count($splitted_script2);
			for ($i=0; $i < $script_count; $i=$i+3) { 
				$data = array(
			        'anime_parent_id' => $this->input->post('anime_parent_id', true),
			        'file_name' => $splitted_script2[$i],
			        'links' => $splitted_script2[$i+1],
			        'website' => $splitted_script2[$i+2],
			        'link_status' => "0,0",
			        'timestamp' => $waktu_saat_ini,
				);
				$this->db->insert('episodes', $data);
			}
	}

	public function updateProgress($anime_parent_id)
	{
		if ( !empty($this->input->post('progress')) ) {
			$data = array(
			        'progress' => $this->input->post('progress', true),
			);
			$this->db->where('anime_parent_id', $anime_parent_id);
			$this->db->update('anime', $data);

		}
	}

	public function deleteEpisode($anime_child_id)
	{
			$this->db->delete('episodes', array('anime_child_id' => $anime_child_id));  // Produces: // DELETE FROM mytable  // WHERE id = $id
	}

	public function resetLinkRusak($anime_child_id)
	{
			$this->db->where( 'anime_child_id', $anime_child_id );
			$this->db->update('episodes', ['link_status' => '0,0']);
	}

	public function ubahAnime()
	{
		
		if ( !empty($this->input->post('anime_parent_id')) AND !empty($this->input->post('season')) AND !empty($this->input->post('year')) ) {
			$sinopsis =  $this->input->post('sinopsis', true);
			$title =  $this->input->post('title', true);
			$trailer =  $this->input->post('trailer', true);
			$poster_url_small =  $this->input->post('poster_url_small', true);
			$poster_url_medium =  $this->input->post('poster_url_medium', true);
			$categories =  $this->input->post('categories', true);
			$season =  $this->input->post('season', true);
			$year =  $this->input->post('year', true);
			$credits =  $this->input->post('credits', true);
			$ket =  $this->input->post('ket', true);
			$kitsu_info =  $this->input->post('kitsu_info', true);
			$waktu_saat_ini = date("Y-m-d H:i:s");

			$data1 = array(
			        'sinopsis' => $sinopsis,
			        'title' => $title,
			        'trailer' => $trailer,
			        'poster_url_small' => $poster_url_small,
			        'poster_url_medium' => $poster_url_medium,
			        'categories' => $categories,
			        'season' => $season,
			        'year' => $year,
			        'credits' => $credits,
			        'ket' => $ket,
			        'kitsu_info' => $kitsu_info,
			        'timestamp' => $waktu_saat_ini,
			);
			$anime_parent_id = $this->input->post('anime_parent_id');
			$this->db->where('anime_parent_id', $anime_parent_id);
			$this->db->update('anime', $data1);
		}
		// Produces:
		//
		//      UPDATE mytable
		//      SET title = '{$title}', name = '{$name}', date = '{$date}'
		//      WHERE id = $id
	}

	public function addAnimeSeries()
	{	$waktu_saat_ini = date("Y-m-d H:i:s");
		if ( !empty($this->input->post('title')) AND !empty($this->input->post('poster_url_medium')) AND !empty($this->input->post('poster_url_small')) ) {
			$data = array(
			        'title' => $this->input->post('title', true),
			        'poster_url_medium' => $this->input->post('poster_url_medium', true),
			        'poster_url_small' => $this->input->post('poster_url_small', true),
			        'full_episode' => $this->input->post('full_episode', true),
			        'categories' => $this->input->post('categories', true),
			        'season' => $this->input->post('season', true),
			        'year' => $this->input->post('year', true),
			        'sinopsis' => $this->input->post('sinopsis', true),
			        'credits' => $this->input->post('credits', true),
			        'rating' => $this->input->post('rating', true),
			        'trailer' => $this->input->post('trailer', true),
			        'ket' => $this->input->post('ket', true),
			        'author' => $this->input->post('author', true),
			        'kitsu_info' => $this->input->post('kitsu_info', true),
			        'timestamp' => $waktu_saat_ini,
			);
			$this->db->insert('anime', $data);
			// Produces: INSERT INTO mytable (title, name, date) VALUES ('My title', 'My name', 'My date')
		}
	}

	public function deleteSeriesById($id)
	{
		$this->db->delete('anime', array('anime_parent_id' => $id));  // Produces: // DELETE FROM mytable  // WHERE id = $id
	}

	public function deleteAllEpisode($id)
	{
		$this->db->delete('episodes', array('anime_parent_id' => $id));  // Produces: // DELETE FROM mytable  // WHERE id = $id
	}
	public function getAllViews()
	{
		$this->db->select('view');
		$this->db->limit(1);
		$query = $this->db->get('stat_num');
		$total_view_count = $query->result_array()[0]['view'];
		if (!$total_view_count) {
			return 0;
		}else{
			return $total_view_count;
		}

	}
	public function getAllDownloads()
	{
		$this->db->select('download');
		$this->db->limit(1);
		$query = $this->db->get('stat_num');
		$total_view_download = $query->result_array()[0]['download'];
		if (!$total_view_download) {
			return 0;
		}else{
			return $total_view_download;
		}

	}
	public function getStatPerPage($current_page,$total_rows,$per_page)
	{
		// If $current_page is 1, then $start_index is set to 0
		$start_index = ($current_page == 1) ? 0 : ($current_page * $per_page) - $per_page;

		$this->db->order_by('id','DESC');
		$this->db->limit( $per_page,$start_index );
		// Misalkan, tampilkan 2 row mulai dari index ke-3
		$query = $this->db->get('stat'); 
		$stat = $query->result_array();
		return $stat;

	}
	public function getEpisodesWithBrokenLinks()
	{
		$this->db->or_like('link_status',"2");
		$this->db->or_like('link_status',"1");
		$query = $this->db->get('episodes'); // Produces: SELECT SUM(age) as age FROM members
		$result = $query->result_array();
		if (!$result) {
			return 0;
		}else{
			return $result;
		}

	}

	public function ubahFansubPreferences()
	{
		if ( !empty($this->input->post('fansub_name', true)) AND !empty($this->input->post('rows_perpage_tile', true)) ) {

			$data1 = array(
			        'fansub_name' => $this->input->post('fansub_name', true),
			        'rows_perpage_tile' => $this->input->post('rows_perpage_tile', true),
			        'rows_perpage_list' => $this->input->post('rows_perpage_list', true),
			        'about_text' => $this->input->post('about_text', true),
			);
			$this->db->where('id', 1);
			$this->db->update('fansub_preferences', $data1);
		}
	}

	public function ubahCustomMenu()
	{
		$data1 = array(
		        'custom_menu_name' => $this->input->post('custom_menu_name', true),
		        'status_custom_menu' => $this->input->post('status_custom_menu', true),
		        'link_custom_menu' => $this->input->post('link_custom_menu', true),
		);
		$this->db->where('id', 1);
		$this->db->update('fansub_preferences', $data1);
	}
	public function getAllAdminUsers()
	{
		$this->db->where('admin', 1);
		$query = $this->db->get('users');
		$result = $query->result_array();
		return $result;

	}
	public function removeAdminById($id)
	{
		$this->db->where('user_id', $id);
		$data1 = array(
		        'admin' => 0,
		);
		$this->db->update('users', $data1);
	}
	public function getAllMembers()
	{
		$this->db->where( 'user_id !=', $this->session->userdata('user_id') );
		$this->db->where( 'admin !=', 1 );
		$query = $this->db->get('users');
		$result = $query->result_array();
		return $result;

	}
	public function getAllMembers_allOfIt_Seriously()
	{
		$query = $this->db->get('users');
		$result = $query->result_array();
		return $result;
	}
	public function addAdminById($id)
	{
		$this->db->where('user_id', $id);
		$data1 = array(
		        'admin' => 1,
		);
		$this->db->update('users', $data1);
	}
	public function countAuthoring($username)
	{
		$this->db->where('author', $username);
		return $this->db->count_all_results('anime');
	}

	public function sendEmailSubscription_series($series)
	{
			$users = $this->Admin_model->getAllMembers_allOfIt_Seriously();
			foreach ($users as $key => $value) {
				if ( $value['subscription'] == 1 ) {
					// Send an email
					$email_address_from = 'widibaka_noreply@koreksubs.online';
					$sender_name = 'Widi Baka';
					$email_address_to = $value['email'];
					$subject = 'Pemberitahuan Koreksubs';
					$message = 'Koreksubs menambahkan ' . $series . ' ke dalam koleksi. (Anda dapat mematikan notifikasi ini melalui Settings -> Preferences)';

					$this->Client_model->send_email( $email_address_from, $sender_name, $email_address_to, $subject, $message );
				}
			}
	}

	public function sendEmailSubscription_episode($series, $episode)
	{
			$users = $this->Admin_model->getAllMembers_allOfIt_Seriously();
			foreach ($users as $key => $value) {
				if ( $value['subscription'] == 1 ) {
					// Send an email
					$email_address_from = 'widibaka_noreply@koreksubs.online';
					$sender_name = 'Widi Baka';
					$email_address_to = $value['email'];
					$subject = 'Koreksubs: ' . $series . ' - ' . $episode;
					$message = 'Koreksubs menambahkan episode '.$episode.' di ' . $series . '. (Anda dapat mematikan notifikasi ini melalui Settings -> Preferences)';

					$this->Client_model->send_email( $email_address_from, $sender_name, $email_address_to, $subject, $message );
				}
			}
	}
}