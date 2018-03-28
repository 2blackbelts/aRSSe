<?php

	$debug_mode = False;
	// exampe url: omdb.php?title=the matrix&year=1999
	// urlencode to remove spaces - they break the omdbapi request
	$title = urlencode($_GET['title']);
	$year = urlencode($_GET['year']);

	if(empty($year)){
		$json = file_get_contents("http://www.omdbapi.com/?t=$title&apikey=86c17b6f");
	}
	$json = file_get_contents("http://www.omdbapi.com/?t=$title&y=$year&apikey=86c17b6f");
	$omdb = json_decode($json);
	
	if ($debug_mode === TRUE) {
		include('functions.php');
		var_dump(convert('https://extratorrent.one/rss.xml?type=hot&cat=H264+X264'));
		$name = '  teen titans the judas contract 2017 720p';
		echo omdb_split($name);
		echo ($title) . " " . $year;
		echo var_dump($omdb);
	}

	if($omdb->Response == "False") {
		echo $omdb->Error;
	} else {
		echo '<strong>Title: </strong>' . $omdb->Title;
		echo '<br>';
		echo '<strong>Year: </strong>' . $omdb->Year;
		echo '<br>';
		echo '<strong>Genre: </strong>' . $omdb->Genre;
		echo '<br>';
		echo '<strong>imdbRating: </strong>' . $omdb->imdbRating;
		echo '<br>';
		echo '<strong>imdbVotes: </strong>' . $omdb->imdbVotes;
		echo '<br>';
		if($omdb->imdbID){
			echo '<a target="_blank" href="http://www.imdb.com/title/' . $omdb->imdbID . '"><img src="img/imdb.png"></a><br>';
		}
		echo '<strong>Plot: </strong>' . $omdb->Plot;
		echo '<br>';
		echo '<img src="' . $omdb->Poster . '" class="img-responsive"><br>';
	}
