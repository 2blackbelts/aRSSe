	<div class="container dont-break-out">
	<form class="" id="add" action="save_torrents.php" method="post">
<?php
	include 'functions.php';

	$counter_new = 0;

	$eztv = convert('https://eztv.ag/ezrss.xml');
	$yifyAPI = api('https://yts.mx/api/v2/list_movies.json?sort_by=date_added');
	$showRSS = convert('https://showrss.info/other/all.rss');
	$seen = json_decode(file_get_contents('seen.txt'), TRUE);
	$error = 'Error!';
	// print '<pre>'; 
	// print_r($eztv);
	// print '</pre>';

	print '<h2 class="jquerytest">EZTV</h2>';
	if($eztv == $error){
		echo 'EZTV is being stingy right now!';
	} else {
		print '<ul class="list-unstyled">';
		$new = true;
			foreach($eztv['channel']['item'] as $eztv_item){			
				if($seen['eztv'] === $eztv_item['enclosure']['@attributes']['url']) {
					$new = false;
				}
				print '<li>';
				print '<div class="checkbox"><label>';

				create_link_or_icon(
					$ssh_is_true, 
					$eztv_item['enclosure']['@attributes']['url'], 
					'download', 
					0
				);
				
				
				if($new == true) {
					print '<span class="glyphicon glyphicon-star-empty"></span> ';
					$counter_new++;
				} 

				print '<a href="' . omdb_clean_tv($eztv_item['title']) . '" data-remote="false" data-toggle="modal" data-target="#myModal" class="btn btn-success">Info</a> ';

				create_link_or_label(
					$ssh_is_true, 
					$eztv_item['title'], 
					$eztv_item['enclosure']['@attributes']['url'],
					0
				);
				
				// print $eztv_item['title'];
				print '</label></div>';
				// print $eztv_item['title'];
				// print $eztv_item['enclosure']['@attributes']['url'];
				print '</li>';
			}
		print '</ul>';
	}	

	// print '<pre>'; 
	// print_r($yifyAPI);
	// print '</pre>';

	print '<h2>Yify API</h2>';
	// Check status of API response
	if($yifyAPI->status !== "ok"){
		echo 'YIFY API is being stingy right now!';
	} else {
	// Continue with loop if ok
		print '<ul class="list-unstyled">';
		$new = true;

		$yify_movies = $yifyAPI->data->movies;
		foreach ($yify_movies as $yify_movie) {
			foreach ($yify_movie->torrents as $torrent) {

				if($seen['yify'] === $torrent->url) {
					$new = false;
				}
				print '<li>';
				print '<div class="checkbox"><label>';

				create_link_or_icon(
					$ssh_is_true, 
					yify_make_magnet($torrent->hash, $yify_movie->title_long), 
					'magnet', 
					0
				);

				if($new == true) {
					print '<span class="glyphicon glyphicon-star-empty"></span> ';
					$counter_new++;
				} 
				print '<a href="omdb.php?title=' . urlencode($yify_movie->title) .'&year=' . $yify_movie->year .'" data-remote="false" data-toggle="modal" data-target="#myModal" class="btn btn-warning">Info</a>';

				// concat long title and quality to show user
				$yify_displayed_title = " " . $yify_movie->title_long . " " . $torrent->quality;

				create_link_or_label(
					$ssh_is_true, 
					$yify_displayed_title,
					$torrent->url,
					0
				);  
				print '</label></div>';
				print '</li>';
			} // end foreach torrent loop
		
		} // end foreach movie listing
	print '</ul>';
	} // end YifyAPI

	// print '<pre>'; 
	// print_r($showRSS);
	// print '</pre>';

	print '<h2>Show RSS</h2>';
	if($showRSS == $error){
		echo 'ShowRSS is being stingy right now!';
	} else {
		print '<ul class="list-unstyled">';
		$new = true;
			foreach($showRSS['channel']['item'] as $showRSS_item){
				if($seen['showRSS'] === $showRSS_item['enclosure']['@attributes']['url']) {
					$new = false;
				}
				print '<li>';
				print '<div class="checkbox"><label>';

				create_link_or_icon(
					$ssh_is_true, 
					$showRSS_item['enclosure']['@attributes']['url'], 
					'magnet', 
					0
				);

				if($new == true) {
					print '<span class="glyphicon glyphicon-star-empty"></span> ';
					$counter_new++;
				} 
				print '<a href="' . omdb_clean_tv(clean($showRSS_item['title'], 0)) . '" data-remote="false" data-toggle="modal" data-target="#myModal" class="btn btn-danger">Info</a> ';
				// print '<a href="' . 'http://www.imdb.com/find?ref_=nv_sr_fn&q=' . clean(str_replace(array("720p","1080p"), "", clean($yify_item['guid'], 0)), 0) . '" class="btn btn-warning" target="_blank">IMDB</a>';
				create_link_or_label(
					$ssh_is_true,
					clean($showRSS_item['title'], 0),
					$showRSS_item['enclosure']['@attributes']['url'],
					0
				 );
				// print clean($showRSS_item['title'], 0);
				// print $eztv_item['title'];
				// print $eztv_item['enclosure']['@attributes']['url'];
				print '</label></div>';
				print '</li>';
			}
		print '</ul>';
	}

	print '<h2>Torrent Galaxy (24hrs)</h2>';
	try {
		$tg_dump_file = file_get_contents("torrent-galaxy/clean.json");
		$torrent_galaxy = json_decode($tg_dump_file, true);

		// var_dump($torrent_galaxy);

		print '<ul class="list-unstyled">';

		$new = true;
		foreach ($torrent_galaxy as $tg_item) {
			if($seen['tg'] === $tg_item['magnet']) {
					$new = false;
				}
			// print $movie->title . '<br>';
			
			print '<li>';
				print '<div class="checkbox"><label>';

				create_link_or_icon(
					$ssh_is_true, 
					$tg_item['magnet'], 
					'magnet', 
					0
					);

				if($new == true) {
					print '<span class="glyphicon glyphicon-star-empty"></span> ';
					$counter_new++;
				} 	
				if($tg_item['type'] == "TV") {
					print '<a href="' . omdb_clean_tv(clean($tg_item['name'], 0)) . '" data-remote="false" data-toggle="modal" data-target="#myModal" class="btn btn-success">Info</a> ';

				} else {
					print '<a href="' . omdb_split(clean($tg_item['name'] . " 1080p", 0), 1) . '" data-remote="false" data-toggle="modal" data-target="#myModal" class="btn btn-success"><i class="glyphicon glyphicon-film"></i> Info</a> ';
				}
				

				create_link_or_label(
					$ssh_is_true, 
					clean($tg_item['name'],0),
					$tg_item['magnet'],
					0
					);
				// print $movie->title . " " . $movie->year;
				print '</label></div>';
				
			print '</li>';
			}

		print '</ul>';
	} catch (Exception $e) {
		print 'Torrent Galaxy Failed.';
	}

	// show yify + EZTV + showRSS search results here
	print '<div class="eztv"></div>';
	print '<div class="yify"></div>';
	print '<div class="showrss"></div>';
	print '<div class="counter-new">' . $counter_new . '</div>';

// show Add Torrent button only if SSH is active
if($ssh_is_true == 1){
	print '<button type="submit" class="btn btn-lg btn-success" id="cmdSubmit" name="cmdSubmit" value="Add Torrents" data-loading-text="Adding..." autocomplete="off">Add Torrents</button>';
} 

?>


</form>
</div>

<script>
  $('#cmdSubmit').on('click', function () {
    var $btn = $(this).button('loading');
    // business logic...
    // $btn.button('reset')
  });
</script>
<?php 
	// store seen in array if no errors occurred in loading torrents
	// if($yify !== $error && $eztv !== $error) {

		$now_seen = array(
					'yify' => $yifyAPI->data->movies[0]->torrents[0]->url,
					'eztv' => $eztv['channel']['item'][0]['enclosure']['@attributes']['url'],
					'showRSS' => $showRSS['channel']['item'][0]['enclosure']['@attributes']['url'],
					'tg' => $torrent_galaxy[0]['magnet']
					); 
		// print_r($now_seen);
		file_put_contents('seen.txt', json_encode($now_seen));
	// }

?>