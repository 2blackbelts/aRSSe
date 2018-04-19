<h2>Yify Search</h2>

<?php
	include 'functions.php';

	$term = $_GET['searched'];
	$term = str_replace(" ", "%20", $term);
	// echo $say;
	$url = file_get_contents('https://yts.ag/api/v2/list_movies.json?query_term=' . $term);
	$result = json_decode($url);

	// echo '<pre>';
	// print_r($result);
	// echo '</pre>';

	echo $result->data->movie_count . " results found";

	print '<ul class="list-unstyled">';

	foreach ($result->data->movies as $movie) {

		// check for quality
		$hq = 0;
		$lq = 0;
		$hq_hash = 0;
		$lq_hash = 0;

		foreach ($movie->torrents as $torrent) {
			if($torrent->quality == '1080p')
			{
				$hq = $torrent->url;
				$hq_hash = $torrent->hash;
			}
			if($torrent->quality == '720p')
			{
				$lq = $torrent->url;
				$lq_hash = $torrent->hash;
			}
		}

		if($hq === 0){
			$best = $lq;
			$best_hash = $lq_hash;
		} else {
			$best = $hq;
			$best_hash = $hq_hash;
		}

		// build magnet link
		// magnet:?xt=urn:btih:TORRENT_HASH&dn=Url+Encoded+Movie+Name&tr=http://track.one:1234/announce&tr=udp://track.two:80

		$mag_base = 'magnet:?xt=urn:btih:';
		$TORRENT_HASH = $best_hash;
		$ENCODED_MOVIE_NAME = '&dn=' . urlencode($movie->title_long);
		$TRACKERS_ARRAY = array(
			'http://track.one:1234/announce', 
			'udp://track.two:80',
			'udp://open.demonii.com:1337',
			'udp://tracker.istole.it:80',
			'http://tracker.yify-torrents.com/announce',
			'udp://tracker.publicbt.com:80',
			'udp://tracker.openbittorrent.com:80',
			'udp://tracker.coppersurfer.tk:6969',
			'udp://exodus.desync.com:6969',
			'http://exodus.desync.com:6969/announce'
			);
		$TRACKERS_LIST = 0;

		foreach ($TRACKERS_ARRAY as $tr) {
			$TRACKERS_LIST .= '&tr=' . urlencode($tr);
		}

		$MAG_URL = $mag_base . $TORRENT_HASH . $ENCODED_MOVIE_NAME . $TRACKERS_LIST;


		
		print '<li>';
			print '<div class="checkbox"><label>';
			create_link_or_icon(
				$ssh_is_true, 
				$best, 
				'download', 
				1
			);

			create_link_or_icon(
				$ssh_is_true, 
				$MAG_URL, 
				'magnet', 
				0
			);

			// print $MAG_URL;
			// print '<input type="checkbox" name="torrent[]" value="' . $best .'">';
			
			print '<span class="glyphicon glyphicon-search"></span> ';
			
			// print $movie->title . " " . $movie->year;
			create_link_or_label(
				$ssh_is_true,
				$movie->title . " " . $movie->year,
				$best,
				1
			);
			
			print '</label></div>';
			
		print '</li>';
		}

	print '</ul>';
		// echo "<a href='" . $best . "'>" . $movie->title . " " . $movie->year . "</a><br>";

		// echo "hq: " . $hq . "<br>";
		// echo "lq: " . $lq . "<br>";

	


?>

