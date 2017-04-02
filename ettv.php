<h2>ExtraTorrent Search</h2>

<?php
	include 'functions.php';

		// get search term and merge with RSS url
		$term = $_GET['searched'];
		$term = preg_replace("/[\s_]/", "-", $term);
		// $url = "https://extratorrent.one/search/?search=" . $term; was used to crawl page
		$url = "https://extratorrent.one/rss.xml?type=search&search=" . $term;
		// echo $url;

		$et_tv = convert($url);

		// // Dump all data to check
		// echo '<pre>';
		// var_dump($et_tv);
		// echo '</pre>';

		print '<ul class="list-unstyled">';

		if(!isset($et_tv['channel']['item'])) {
			// No search results
			print 'Nothing found for ' . $term;

		} else {
			// Show search results
			foreach($et_tv['channel']['item'] as $et_tv_item){
				print '<li>';
				print '<div class="checkbox"><label>';
				print '<input type="checkbox" name="torrent[]" value="' . fix_et_link($et_tv_item['enclosure']['@attributes']['url']) .'">';
				print clean($et_tv_item['link'], TRUE);
				print '</label></div>';
				print '</li>';
			}
		}
		print '</ul>';
		

?>
