<?php

$tv_array = [
	'Game Shakers S03E02 720p HDTV x264-W4F',
	'Mobile Suit Gundam Iron-Blooded Orphans S02E18 DUBBED 720p HDTV x264-W4F',
	'Comic Book Men S07E08 WEB h264-TBS',
	'Call The Midwife 7x07 Episode 7 720p'
];

function omdb_clean_tv($filename) {
	// split TV show name before and after episode details - take first part
	$find_show = preg_split('/([S]\d\d[E]\d\d)+/', $filename);
	// if show is not split as S01E13 is actually written 1x13
	if(count($find_show)==1) {
		$find_show = preg_split('/(\d[x]\d\d)+/', $filename);
	}
	$show_plus = preg_replace('/(\s)+/', '+', trim($find_show[0]));
	$omdb_base = "omdb.php?";
	$omdb_url = $omdb_base . 'title=' . $show_plus;
	return $omdb_url;
}

foreach ($tv_array as $key => $show) {
	print $show . '<br>';
	print omdb_clean_tv($show) . '<br>';

	// print cleanFilename($show) . '<br>';
}



?>
