<?php
$urls = array(
	'eztv' => 'https://eztv.ag',
	'ettv' => 'https://extratorrent.one',
	'yify' => 'https://yts.ag'
	);

foreach ($urls as $provider => $url) {
	echo $provider . ': <br>'; 
	echo get_headers($url)[0] . '<br>';
}
