<h2>Popcorntime Movies 1080p</h2>

<?php
	$url = file_get_contents('https://tv-v2.api-fetch.website/movies/1?sort=last%20added');
	$result = json_decode($url);

	// var_dump($result);
	var_dump($result{0}->title);

	print '<ul class="list-unstyled">';

	// foreach ($result as $movie) {
	// 	// print $movie->title . '<br>';

		
	// 	print '<li>';
	// 		print '<div class="checkbox"><label>';
	// 		print '<input type="checkbox" name="torrent[]" value="' . $movie->torrents->en->{'1080p'}->url .'">';
			
	// 		print '<span class="glyphicon glyphicon-search"></span> ';
			
	// 		print $movie->title . " " . $movie->year;
	// 		print '</label></div>';
			
	// 	print '</li>';
	// 	}

	// print '</ul>';
		

	


?>

