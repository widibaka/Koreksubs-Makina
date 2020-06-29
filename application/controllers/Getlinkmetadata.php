<?php 
class Getlinkmetadata extends CI_Controller
{
	public function index($URL){
		$URL = base64_decode($URL);
		// echo $URL;
		// die();
		$html = file_get_contents( $URL );
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
	    $page = file_get_contents($url);
	    $title = preg_match('/<title[^>]*>(.*?)<\/title>/ims', $page, $match) ? $match[1] : null;
	    return $title;
	}
}