<?php

function convert($url) {
		$feed = @implode(file($url));
		if($feed !== null){
			$xml = simplexml_load_string($feed);
			$json = json_encode($xml);
			$array = json_decode($json,TRUE);
			return $array;
		} else {
			return 'Error!';
		}
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
			"WEBRip",
			"WEB",
			"DL",
			"X264",
			"5D",
			"5BEtHD",
			"FGT",
			"DD5",
			"H264",
			"480p",
			"BDRip");
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

	function p_filter($string) {
		// remove 720p and 1080p from string
		$result = str_replace(['720p', '1080p'], "", $string);
		return $result;
	}

	function omdb_split($torrent_name) {
		$torrent_name = p_filter($torrent_name);
		$name = preg_replace('/\s+/', ' ',$torrent_name);
		$pieces = explode(" ", $name);
		$pieces = array_filter($pieces);
		$number = count($pieces);
		$pieces_start = key($pieces);
		$pieces_end = @end(array_keys($pieces));
		// var_dump($pieces);
		$title = "";
		for ($i= $pieces_start; $i < $pieces_end; $i++) { 
			if($i == $pieces_start){
				$title = $title . $pieces[$i];
			} else {
				$title = $title . '+' . $pieces[$i];
			}	
		}
		$year = $pieces[$number];
		// build local omdb url for omdb.php
		$omdb_base = "omdb.php?";
		$omdb_url = $omdb_base . 'title=' . $title .'&year=' . $year;
		return $omdb_url;
	}

?>