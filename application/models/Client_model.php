<?php 

class Client_model extends CI_Model
{
	public function getAllEpisodes()
	{
		$this->db->order_by('anime_child_id', 'DESC');
		$query = $this->db->get('episodes');  // Produces: SELECT * FROM mytable
		$episodes = $query->result_array();
		foreach ($episodes as $i => $eps) {
		// Adding the 'converted links' using foreach
			$data = explode( '@', $episodes[$i]['links'] );
			$episodes[$i]['converted_links'] = $data;
		}

		return $episodes;
	}

	public function getAllLatestEpisodes()
	{
		$this->db->order_by('anime_child_id', 'DESC');
		$this->db->limit(40); // limited until 70th to avoid lagging
		$query = $this->db->get('episodes');  // Produces: SELECT * FROM mytable
		$episodes = $query->result_array();
		foreach ($episodes as $i => $eps) {
		// Adding the 'converted links' using foreach
			$data = explode( '@', $episodes[$i]['links'] );
			$episodes[$i]['converted_links'] = $data;
		}

		return $episodes;

	}

	public function getEpisodesById($id,$order_by,$ordering)
	{
		$this->db->order_by($order_by, $ordering);
		$query = $this->db->get_where( 'episodes',['anime_parent_id' => $id] );  // Produces: SELECT * FROM mytable
		$episodes = $query->result_array();
		foreach ($episodes as $i => $eps) {
		// Breaking links down then convert it, and Adding the 'converted links' using foreach.
			$data = explode( '@', $episodes[$i]['links'] );
			$episodes[$i]['converted_links'] = $data;
		}

		return $episodes;

	}

	public function getEpisodesByChildId($anime_child_id)
	{
		$query = $this->db->get_where( 'episodes',['anime_child_id' => $anime_child_id] );  // Produces: SELECT * FROM mytable
		$episodes = $query->result_array();
		if ( !$episodes ) {
			$var[0] = "";
			return $var;
		}else{
			return $episodes;
		}
	}
	public function getAnimeById($id)
	{
		$query = $this->db->get_where( 'anime',['anime_parent_id' => $id] );
		$anime = $query->result_array();
		return $anime;

	}
	public function getAnimeNameById($id)
	{
		$this->db->select('title');
		$query = $this->db->get_where( 'anime',['anime_parent_id' => $id] );
		
		if ( $query->result_array() ) {
			return $query->result_array()[0]['title'];
		}
		else{
			return false;
		}
		

	}
	public function getAllAnime()
	{
		$this->db->order_by('anime_parent_id', 'DESC');
		$query = $this->db->get( 'anime' );
		$anime = $query->result_array();
		return $anime;

	}
	public function getAllAnimeTitle()
	{
		$this->db->select('anime_parent_id,title');
		$this->db->order_by('title', 'ASC');
		$query = $this->db->get( 'anime' );
		$anime = $query->result_array();
		return $anime;

	}

	public function countAllAnime()
	{
		return $this->db->count_all_results('anime'); // Produces an integer, like 17
	}

	public function getFansubPreferences()
	{
		$query = $this->db->get('fansub_preferences');
		$fansub_preferences = $query->result_array();
		return $fansub_preferences[0];

	}

	public function getAnimePerPage($current_page,$total_rows,$per_page)
	{
		// If $current_page is 1, then $start_index is set to 0
		$start_index = ($current_page == 1) ? 0 : ($current_page * $per_page) - $per_page;

		$this->db->order_by('anime_parent_id', 'DESC');
		$this->db->limit( $per_page,$start_index );
		// Misalkan, tampilkan 2 row mulai dari index ke-3
		$query = $this->db->get('anime');
		$anime = $query->result_array();
		return $anime;
	}

	public function generatePagination($current_page,$total_rows,$per_page)
	# Function ini adalah mahakarya selama hidup saya Wkwkwkwk
	{
		$total_page = ceil( $total_rows/$per_page );
		$pages = array();
		if ($total_page > 12) {
			//---------------------------------------------------------
			if ( $current_page > $total_page-3 ) {
				array_push($pages, 'Prev');
				array_push($pages, 1);
				for ($i=$current_page+3 ; $i <= $current_page+5 ; $i++) { 
					array_push($pages, '.');
				}
				if ($total_page-$current_page == 2) {
					
					for ($i=$current_page-2 ; $i <= $current_page+1 ; $i++) { 
						array_push($pages, $i);
					}
				}
				if ($total_page-$current_page == 1) {
					
					for ($i=$current_page-2 ; $i <= $current_page ; $i++) { 
						array_push($pages, $i);
					}
				}
				if ($total_page == $current_page) {
					
					for ($i=$current_page-2 ; $i <= $current_page ; $i++) { 
						array_push($pages, $i);
					}
				}
				if ($current_page != $total_page) {
					array_push($pages, $total_page);
					array_push($pages, 'Next');
				}
			}
			//---------------------------------------------------------
			elseif ( $current_page > 4 ) {
				array_push($pages,'Prev');
				array_push($pages, 1);
				for ($i=2 ; $i <= 4 ; $i++) { 
					array_push($pages, '.');
				}
				for ($i=$current_page-2 ; $i <= $current_page+2 ; $i++) { 
					array_push($pages, $i);
				}
				for ($i=$current_page+3 ; $i <= $current_page+5 ; $i++) { 
					array_push($pages, '.');
				}
				array_push($pages,$total_page);
				array_push($pages, 'Next');
			}
			//---------------------------------------------------------
			elseif ( $current_page > 0 ) {
				if ($current_page > 1) {
					array_push($pages, 'Prev');
				}
				for ($i=1 ; $i <= $current_page+2 ; $i++) { 
					array_push($pages, $i);
				}
				for ($i=$current_page+3 ; $i <= $current_page+5 ; $i++) { 
					array_push($pages, '.');
				}
				array_push($pages,$total_page);
				array_push($pages, 'Next');
			}

		}
		else {

			if ($current_page > 1) {
				array_push($pages, 'Prev');
			}
			for ($i=1 ; $i < $total_page ; $i++) { 
				array_push($pages, $i);
			}
			if ($current_page == $total_page) {
				array_push($pages, $total_page);
			}
			if ($current_page != $total_page) {
				array_push($pages, $total_page);
				array_push($pages, 'Next');
			}
		}
		return $pages;
	}
	public function countSearchedAnime()
	{
		// /.Conditions
		$nama_anime = explode( ' ', $this->input->get('nama_anime', true) );
		$nama_anime2 = array();
		$rating_from = $this->input->get('rating_from', true);
		$rating_to = $this->input->get('rating_to', true);
		$season = $this->input->get('season', true);
		$year = $this->input->get('year', true);
		foreach ($nama_anime as $i => $anm) {
			// The search screwed, i mean showing the all data, when it's sending empty variable to function ... ->like('title', ''). 
			// it is a problem because the index [1] of $nama_anime is clearly empty. So, i wrapped it into 'if'
			if ( !empty($anm) ) {
				array_push($nama_anime2, $anm);
			}
		}
		foreach ($nama_anime2 as $key => $value) {
			$this->db->like('title', $nama_anime2[$key]);
			// WHERE `title` LIKE '%match%' ESCAPE '!' OR  `body` LIKE '%match%' ESCAPE '!'	
		}
		
		// Entah kenapa, operator 'more then' dan 'less then' nimbulin error ketika mereka tuh gak punya value
		// Operators '>=' and '<=' produce erorr when they have no value, so I wrap them within 'if' 
		if ( !empty($rating_from) ) {
			$this->db->where('rating >=', $rating_from);
		}
		if ( !empty($rating_to) ) {
			$this->db->where('rating <=', $rating_to);
		}
		if ($season != '-All-') {
			$this->db->like('season', $season);
		}
		$this->db->like('year', $year);	
		// /.Conditions
		$this->db->from('anime');
		return $this->db->count_all_results();
	}

	public function AdvancedSearchAnime($current_page,$total_rows,$per_page)
	{
		// If $current_page is 1, then $start_index is set to 0
		$start_index = ($current_page == 1) ? 0 : ($current_page * $per_page) - $per_page;

		#Simply copy from condition above
		$this->db->order_by('title', 'ASC');
		// /.Conditions
		$nama_anime = explode( ' ', $this->input->get('nama_anime', true) );
		$nama_anime2 = array();
		$rating_from = $this->input->get('rating_from', true);
		$rating_to = $this->input->get('rating_to', true);
		$season = $this->input->get('season', true);
		$year = $this->input->get('year', true);
		foreach ($nama_anime as $i => $anm) {
			// The search screwed, i mean showing the all data, when it's sending empty variable to function ... ->like('title', ''). 
			// it is a problem because the index [1] of $nama_anime is clearly empty. So, i wrapped it into 'if'
			if ( !empty($anm) ) {
				array_push($nama_anime2, $anm);
			}
		}
		foreach ($nama_anime2 as $key => $value) {
			$this->db->like('title', $nama_anime2[$key]);
			// WHERE `title` LIKE '%match%' ESCAPE '!' OR  `body` LIKE '%match%' ESCAPE '!'	
		}
		
		// Entah kenapa, operator 'more then' dan 'less then' nimbulin error ketika mereka tuh gak punya value
		// Operators '>=' and '<=' produce erorr when they have no value, so I wrap them within 'if' 
		if ( !empty($rating_from) ) {
			$this->db->where('rating >=', $rating_from);
		}
		if ( !empty($rating_to) ) {
			$this->db->where('rating <=', $rating_to);
		}
		if ($season != '-All-') {
			$this->db->like('season', $season);
		}
		$this->db->like('year', $year);	
		// /.Conditions

		$this->db->limit( $per_page,$start_index );
		// Misalkan, tampilkan 2 row mulai dari index ke-3
		$query = $this->db->get('anime');  // Produces: SELECT * FROM mytable
		return $query->result_array();
	}



	//Fungsi utk bikin waktu mundur buat chat dan lain-lain
	public function get_time_ago( $tgl )
	{
		$tgl = strtotime($tgl);
	    $time_difference = time() - $tgl;
	    
	    if( $time_difference < 1 ) { return '1 detik lalu'; }
	    
	    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'tahun',
	                30 * 24 * 60 * 60       =>  'bulan',
	                24 * 60 * 60            =>  'hari',
	                60 * 60                 =>  'jam',
	                60                      =>  'menit',
	                1                       =>  'detik'
	    );
	    
	    foreach( $condition as $secs => $str )
	    {
	        $d = $time_difference / $secs;

	        if( $d >= 1 )
	        {
	            $t = round( $d );
	            return $t . ' ' . $str . ' yang lalu';
	        }
	    }
	}



	//Fungsi utk bikin waktu mundur buat chat dan lain-lain
	public function convertTimeFormat( $tgl )
	{
		$tgl = explode(' ', $tgl);
		$tgl_depan = explode('-', $tgl[0]);
		$tgl_belakang = substr($tgl[1], 0, 5);

		$tahun = $tgl_depan[0];
		$bulan = $tgl_depan[1];
		$tanggal = $tgl_depan[2];

		switch ($bulan) {
			case '01':
				$bulan = 'Januari';
				break;
			case '02':
				$bulan = 'Februari';
				break;			
			case '03':
				$bulan = 'Maret';
				break;			
			case '04':
				$bulan = 'April';
				break;			
			case '05':
				$bulan = 'Mei';
				break;			
			case '06':
				$bulan = 'Juni';
				break;			
			case '07':
				$bulan = 'Juli';
				break;			
			case '08':
				$bulan = 'Agustus';
				break;			
			case '09':
				$bulan = 'September';
				break;			
			case '10':
				$bulan = 'Oktober';
				break;			
			case '11':
				$bulan = 'November';
				break;			
			case '12':
				$bulan = 'Desember';
				break;			
			default:
				$bulan = 'error';
				break;
		}

		return $tanggal.' '.$bulan.' '.$tahun.', '.$tgl_belakang;
	}

	public function setDownloadCount($anime_parent_id)
	{
		$this->db->select('download_count');
		$query = $this->db->get_where( 'anime',['anime_parent_id' => $anime_parent_id] );
		$download_count = $query->result_array()[0]['download_count']; // calling previous number

		$download_count = $download_count + 1; // plus one means download is increased 1.

		$data = array(
		        'download_count' => $download_count
				);
		$this->db->where('anime_parent_id', $anime_parent_id); // change the number to the new one
		$this->db->update('anime', $data);
			
	}

	public function setViewCount($anime_parent_id)
	{
		$this->db->select('view_count');
		$query = $this->db->get_where( 'anime',['anime_parent_id' => $anime_parent_id] );

		$try = $query->result_array();
		if ( !$try ) { // dicoba dulu biar gak offset nantinya
			echo "Maaf, halaman ini tidak ditemukan.";
 			exit;
		}

		$view_count = $query->result_array()[0]['view_count']; // Nah, baru kalau $try == true, maka calling previous number

		$view_count = $view_count + 1; // plus one means view is increased by 1.

		$data = array(
		        'view_count' => $view_count
				);
		$this->db->where('anime_parent_id', $anime_parent_id); // change the number to the new one
		$this->db->update('anime', $data);
			
	}

	public function setStatView()
	{
		$this->db->select('view');
		$this->db->limit(1);
		$query = $this->db->get('stat_num');

		$try = $query->result_array();
		if ( !$try ) { // dicoba dulu biar gak offset nantinya
			echo "Error! Field view berisi (null) sehingga tidak dapat diolah";
			exit;
		}

		$view_count = $query->result_array()[0]['view']; // Nah, baru kalau $try == true, maka calling previous number

		$view_count = $view_count + 1; // plus one means view is increased by 1.

		$data = array(
		        'view' => $view_count
				);
		// change the number to the new one
		$this->db->update('stat_num', $data);
			
	}

	public function setStatDwonload()
	{
		$this->db->select('download');
		$this->db->limit(1);
		$query = $this->db->get('stat_num');

		$try = $query->result_array();
		if ( !$try ) { // dicoba dulu biar gak offset nantinya
			echo "Error! Field download berisi (null) sehingga tidak dapat diolah";
			exit;
		}

		$view_count = $query->result_array()[0]['download']; // Nah, baru kalau $try == true, maka calling previous number

		$view_count = $view_count + 1; // plus one means view is increased by 1.

		$data = array(
		        'download' => $view_count
				);
		// change the number to the new one
		$this->db->update('stat_num', $data);
			
	}

	public function laporkanLinkRusak($anime_child_id, $jenis_kerusakan, $username)
	{
		$data = array(
		        'link_status' => implode(",", array($jenis_kerusakan,$username)	)			);
		$this->db->where('anime_child_id', $anime_child_id); // change the number to the new one
		$this->db->update('episodes', $data);
			
	}

	public function getCommentsOfAnime($anime_parent_id, $limit)
	{
		$this->db->limit( $limit );
		$this->db->order_by('id','DESC');
		$query = $this->db->get_where( 'comments',['anime_parent_id' => $anime_parent_id] );
		$comment = $query->result_array(); 
		if ( empty($comment) ) {
			return 'Tidak ada komentar';
		}
		else{
			return $comment;
		}

	}

	public function sendComment()
	{
		if ($this->input->post('comment')) {
		$waktu_saat_ini = date("Y-m-d H:i:s");
		$data = array(
		        'user_id' => $this->input->post('user_id', true),
		        'anime_parent_id' => $this->input->post('anime_parent_id', true),
		        'comment' => htmlspecialchars( $this->input->post('comment', true) ),
			    'timestamp' => $waktu_saat_ini,
				);
		$this->db->insert('comments', $data);		
		}
	}

	public function getFiveRecentComments() {
		$this->db->limit(5);
		$this->db->order_by('id','DESC');
		$query = $this->db->get('comments');
		return $result = $query->result_array();
	}

	// Good stuff

	public function send_email( $email_address_from, $sender_name, $email_address_to, $subject, $message ) {
		$this->load->library('email');

		$this->email->from($email_address_from, $sender_name);
		$this->email->to( $email_address_to );

		$this->email->subject( $subject );
		$this->email->message( $message );

		$this->email->send();
	}


}