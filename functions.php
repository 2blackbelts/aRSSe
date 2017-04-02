<?php

function convert($url) {
		$feed = implode(file($url));
		$xml = simplexml_load_string($feed);
		$json = json_encode($xml);
		$array = json_decode($json,TRUE);
		return $array;
	}

	function clean($string, $cut) {
		// list of ugly torrent names to hide
		$ugly = array(
			"http://extratorrent.cc/torrent",
			"https://extra.to/torrent",
			"https://eztv.ag/movie",
			"https://yts.ag/movie", 
			"+", 
			"-", 
			"%", 
			"/", 
			"#", 
			".html", 
			".", 
			"BRRip", 
			"XViD",
			"XviD", 
			"UNRATED", 
			"HDRip", 
			"ETRG", 
			"EVO", 
			"AC3", 
			"AAC", 
			"HC", 
			"x264", 
			"DTS", 
			"BluRay", 
			"WEBRip");
		$pretty = str_replace($ugly, " ", $string);
		if($cut == TRUE) {
			$pretty = cut_front($pretty);
		}
		return $pretty;
	}

	function cut_front($string) {
		// cut first word or numbers off string
		$string = ltrim($string);
		$clean = strstr($string," ");
		return $clean;
	}

	function fix_et_link($url_to_fix) {
		$old_url = 'http://extratorrent.cc';
		$new_url = 'https://extratorrent.one';
		$fixed = str_replace($old_url, $new_url, $url_to_fix);
		return $fixed;
	}

?>