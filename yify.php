<h2>Yify Search</h2>

<?php
	$term = $_GET['searched'];
	// echo $say;
	$url = file_get_contents('http://yify.is/api/v2/list_movies.json?query_term=' . $term);
	$result = json_decode($url);

	echo $result->data->movie_count . " results found";

	print '<ul class="list-unstyled">';

	foreach ($result->data->movies as $movie) {

		// check for quality
		$hq = 0;
		$lq = 0;
		foreach ($movie->torrents as $torrent) {
			if($torrent->quality == '1080p')
			{
				$hq = $torrent->url;
			}
			if($torrent->quality == '720p')
			{
				$lq = $torrent->url;
			}
		}

		if($hq === 0){
			$best = $lq;
		} else {
			$best = $hq;
		}

		
		print '<li>';
			print '<div class="checkbox"><label>';
			print '<input type="checkbox" name="torrent[]" value="' . $best .'">';
			
			print '<span class="glyphicon glyphicon-search"></span> ';
			
			print $movie->title . " " . $movie->year;
			print '</label></div>';
			
		print '</li>';
		}

	print '</ul>';
		// echo "<a href='" . $best . "'>" . $movie->title . " " . $movie->year . "</a><br>";

		// echo "hq: " . $hq . "<br>";
		// echo "lq: " . $lq . "<br>";

	


?>

