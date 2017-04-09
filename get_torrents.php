	<div class="container dont-break-out">
	<form class="" id="add" action="save_torrents.php" method="post">
<?php
	include 'functions.php';

	$counter_new = 0;
	
	$eztv = convert('https://eztv.ag/ezrss.xml');
	// https://extratorrent.unblockall.xyz/download/5267829/Jason.Bourne.2016.720p.WEBRip.x264.AAC-ETRG.torrent
	$et_tv = convert('https://extratorrent.one/rss.xml?type=popular&cid=8');
	$et_movies = convert('https://extratorrent.one/rss.xml?type=hot&cat=H264+X264');
	$et_movies_divx = convert('http://extratorrent.cc/rss.xml?type=hot&cat=XVID+DIVX');
	$yify = convert('https://yts.ag/rss');
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
				print '<input type="checkbox" name="torrent[]" value="' . $eztv_item['enclosure']['@attributes']['url'] .'">';
				if($new == true) {
					print '<span class="glyphicon glyphicon-star-empty"></span> ';
					$counter_new++;
				} 
				print $eztv_item['title'];
				print '</label></div>';
				// print $eztv_item['title'];
				// print $eztv_item['enclosure']['@attributes']['url'];
				print '</li>';
			}
		print '</ul>';
	}

	// print '<pre>'; 
	// print_r($et_tv);
	// print '</pre>';

	print '<h2>ExtraTorrent TV</h2>';
	if($et_tv == $error){
		echo 'ExtraTorrent is being stingy right now!';
	} else {
		print '<ul class="list-unstyled">';
		$new = true;
			foreach($et_tv['channel']['item'] as $et_tv_item){
				if($seen['et_tv'] === $et_tv_item['enclosure']['@attributes']['url']) {
					$new = false;
				}
				print '<li>';
				print '<div class="checkbox"><label>';
				print '<input type="checkbox" name="torrent[]" value="' . fix_et_link($et_tv_item['enclosure']['@attributes']['url']) .'">';
				if($new == true) {
					print '<span class="glyphicon glyphicon-star-empty"></span> ';
					$counter_new++;
				} 
				print clean($et_tv_item['link'], 1);
				print '</label></div>';
				// print $eztv_item['title'];
				// print $eztv_item['enclosure']['@attributes']['url'];
				print '</li>';
			}
		print '</ul>';
	}

	// print '<pre>'; 
	// print_r($yify);
	// print '</pre>';

	print '<h2>Yify</h2>';
	if($yify == $error){
		echo 'YIFY is being stingy right now!';
	} else {
		print '<ul class="list-unstyled">';
		$new = true;
			foreach($yify['channel']['item'] as $yify_item){
				if($seen['yify'] === $yify_item['enclosure']['@attributes']['url']) {
					$new = false;
				}
				print '<li>';
				print '<div class="checkbox"><label>';
				print '<input type="checkbox" name="torrent[]" value="' . $yify_item['enclosure']['@attributes']['url'] .'">';
				if($new == true) {
					print '<span class="glyphicon glyphicon-star-empty"></span> ';
					$counter_new++;
				} 
				print '<a href="' . omdb_split(clean($yify_item['guid'], 0)) . '" data-remote="false" data-toggle="modal" data-target="#myModal" class="btn btn-warning">Info</a>';
				// print '<a href="' . 'http://www.imdb.com/find?ref_=nv_sr_fn&q=' . clean(str_replace(array("720p","1080p"), "", clean($yify_item['guid'], 0)), 0) . '" class="btn btn-warning" target="_blank">IMDB</a>';
				print clean($yify_item['guid'], 0);
				// print $eztv_item['title'];
				// print $eztv_item['enclosure']['@attributes']['url'];
				print '</label></div>';
				print '</li>';
			}
		print '</ul>';
	}

	// print '<pre>'; 
	// print_r($et_movies);
	// print '</pre>';

	print '<h2>ExtraTorrent Movies H264</h2>';
	if($et_movies == $error){
		echo 'ExtraTorrent is being stingy right now!';
	} else {
		print '<ul class="list-unstyled">';
		$new = true;
			foreach($et_movies['channel']['item'] as $et_movie){
				if($seen['et_movies'] === $et_movie['enclosure']['@attributes']['url']) {
					$new = false;
				}
				print '<li>';
				print '<div class="checkbox"><label>';
				print '<input type="checkbox" name="torrent[]" value="' . fix_et_link($et_movie['enclosure']['@attributes']['url']) .'">';
				if($new == true) {
					print '<span class="glyphicon glyphicon-star-empty"></span> ';
					$counter_new++;
				}
				// print '<a href="' . 'http://www.imdb.com/find?ref_=nv_sr_fn&q=' . clean(str_replace(array("720p","1080p"), "", clean($et_movie['guid'], 1)), 0) . '" class="btn btn-warning" target="_blank">IMDB</a>';
				print '<a href="' . omdb_split(clean($et_movie['guid'], 1)) . '" data-remote="false" data-toggle="modal" data-target="#myModal" class="btn btn-warning">Info</a>';

				print clean($et_movie['guid'], 1);
				// print $eztv_item['title'];
				// print $eztv_item['enclosure']['@attributes']['url'];
				print '</label></div>';
				print '</li>';
			}
		print '</ul>';
	}

	print '<h2>ExtraTorrent Movies DIVX</h2>';
	if($et_movies_divx == $error){
		echo 'ExtraTorrent is being stingy right now!';
	} else {
		print '<ul class="list-unstyled">';
		$new = true;
			foreach($et_movies_divx['channel']['item'] as $et_movie){
				if($seen['et_movies_divx'] === $et_movie['enclosure']['@attributes']['url']) {
					$new = false;
				}
				print '<li>';
				print '<div class="checkbox"><label>';
				print '<input type="checkbox" name="torrent[]" value="' . fix_et_link($et_movie['enclosure']['@attributes']['url']) .'">';
				if($new == true) {
					print '<span class="glyphicon glyphicon-star-empty"></span> ';
					$counter_new++;
				}
				// print '<a href="' . 'http://www.imdb.com/find?ref_=nv_sr_fn&q=' . clean(str_replace(array("720p","1080p"), "", clean($et_movie['guid'], 1)), 0) . '" class="btn btn-warning" target="_blank">IMDB</a>';
				print '<a href="' . omdb_split(clean($et_movie['guid'], 1)) . '" data-remote="false" data-toggle="modal" data-target="#myModal" class="btn btn-warning">Info</a>';

				print clean($et_movie['guid'], 1);
				// print $eztv_item['title'];
				// print $eztv_item['enclosure']['@attributes']['url'];
				print '</label></div>';
				print '</li>';
			}
		print '</ul>';
	}

	// show yify + EZTV + ettv search results here
	print '<div class="yify"></div>';
	print '<div class="eztv"></div>';
	print '<div class="ettv"></div>';
	print '<div class="tpb"></div>';
	print '<div class="counter-new">' . $counter_new . '</div>';

// file_put_contents("torrents/" . date('Ymd') . ".torrent", fopen("https://zoink.ch/torrent/Ancient.Aliens.S11E14.The.Returned.720p.HDTV.x264-DHD[eztv].mkv.torrent", 'r'));

?>
<button type="submit" class="btn btn-lg btn-success" id="cmdSubmit" name="cmdSubmit" value="Add Torrents" data-loading-text="Adding..." autocomplete="off">Add Torrents</button>
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
	if($et_movies !== $error && $et_movies_divx !== $error && $yify !== $error && $et_tv !== $error && $eztv !== $error) {

		$now_seen = array(
					'et_movies' => $et_movies['channel']['item'][0]['enclosure']['@attributes']['url'], 
					'et_movies_divx' => $et_movies_divx['channel']['item'][0]['enclosure']['@attributes']['url'], 
					'yify' => $yify['channel']['item'][0]['enclosure']['@attributes']['url'],
					'et_tv' => $et_tv['channel']['item'][0]['enclosure']['@attributes']['url'],
					'eztv' => $eztv['channel']['item'][0]['enclosure']['@attributes']['url']
					); 
		// print_r($now_seen);
		file_put_contents('seen.txt', json_encode($now_seen));
	}
?>