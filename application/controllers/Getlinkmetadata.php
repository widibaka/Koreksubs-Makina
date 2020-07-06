<?php 
class Getlinkmetadata extends CI_Controller
{
	public function url_get_contents($url, $useragent='cURL', $headers=false, $follow_redirects=true, $debug=false) {

	    // initialise the CURL library
	    $ch = curl_init();

	    // specify the URL to be retrieved
	    curl_setopt($ch, CURLOPT_URL,$url);

	    // we want to get the contents of the URL and store it in a variable
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

	    // specify the useragent: this is a required courtesy to site owners
	    curl_setopt($ch, CURLOPT_USERAGENT, $useragent);

	    // ignore SSL errors
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

	    // return headers as requested
	    if ($headers==true){
	        curl_setopt($ch, CURLOPT_HEADER,1);
	    }

	    // only return headers
	    if ($headers=='headers only') {
	        curl_setopt($ch, CURLOPT_NOBODY ,1);
	    }

	    // follow redirects - note this is disabled by default in most PHP installs from 4.4.4 up
	    if ($follow_redirects==true) {
	        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
	    }

	    // if debugging, return an array with CURL's debug info and the URL contents
	    if ($debug==true) {
	        $result['contents']=curl_exec($ch);
	        $result['info']=curl_getinfo($ch);
	    }

	    // otherwise just return the contents as a variable
	    else $result=curl_exec($ch);

	    // free resources
	    curl_close($ch);

	    // send back the data
	    return $result;
	}
	public function index($URL){
		$URL = base64_decode($URL);
		// echo $URL;
		// die();
		$html = $this->url_get_contents( $URL );
		libxml_use_internal_errors(true); // Yeah if you are so worried about using @ with warnings
		$doc = new DomDocument();
		$doc->loadHTML($html);
		$xpath = new DOMXPath($doc);
		$query = '//*/meta[starts-with(@property, \'og:\')]';
		$metas = $xpath->query($query);
		$rmetas = array();
		foreach ($metas as $meta) {
		    $property = str_replace(":", "_", $meta->getAttribute('property')); // hilangkan "og:" biar objek json nya bisa diakses
		    $content = $meta->getAttribute('content');
		    $rmetas[$property] = $content;
		}

		// get web page title
		$rmetas['page_title'] = $this->getTitle( $URL );

		// get meta tags
		$meta_tags = get_meta_tags( $URL );
		$rmetas['meta_tags'] = $meta_tags;

		$json = json_encode($rmetas);
		echo $json;

		// var_dump($meta_tags);
		// Output:
		// Title: PHP 5 Tutorial
	}
	// function to get webpage title
	public function getTitle($url) {
	    $page = $this->url_get_contents($url);
	    $title = preg_match('/<title[^>]*>(.*?)<\/title>/ims', $page, $match) ? $match[1] : null;
	    return $title;
	}
}