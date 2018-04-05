<?php

// set to 0 for magnet links to show as icons (manual download) [default 0 for live site]
$ssh_is_true = 0;

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
			"https://yts.am/movie",
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

	function omdb_split($torrent_name, $popcorn_offset) {
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
		if($popcorn_offset == 1)
		{
			// year of movie is last array item less 1
			$year = $pieces[$number -1];
		} 
		else {
			// year of movie is last array item
			$year = $pieces[$number];
		}
		
		// build local omdb url for omdb.php
		$omdb_base = "omdb.php?";
		$omdb_url = $omdb_base . 'title=' . $title .'&year=' . $year;
		return $omdb_url;
	}

	function omdb_clean_tv($filename) {
		// split TV show name before and after episode details - take first part
		$find_show = preg_split('/([S]\d\d[E]\d\d)+/', $filename);
		// if show is not split as S01E13 is actually written 1x13
		if(count($find_show)==1) {
			$find_show = preg_split('/(\d[x]\d\d)+/', $filename);
		}
		$show_plus = preg_replace('/(\s)+/', '+', trim($find_show[0]));
		$omdb_base = "omdb.php?";
		$omdb_url = $omdb_base . 'title=' . $show_plus . '&year=';
		return $omdb_url;
}

	function create_link_or_icon($ssh_is_true, $link, $type){
		if($ssh_is_true == 1){
			print '<input type="checkbox" name="torrent[]" value="' . $link .'">';
		} else {
			if($type == 'magnet'){
				$icon = 'icon_magnet.png';
			} else {
				$icon = 'icon_download.gif';
			}
			print '<a href="' . $link . '"><img src="img/' . $icon . '"></a> ';
		}
	}

?>