<h2>ExtraTorrent Search</h2>

<?php
	// include_once('simplehtmldom_1_5/simple_html_dom.php');

		// get search term and merge with RSS url
		$term = $_GET['searched'];
		$term = preg_replace("/[\s_]/", "-", $term);
		// $url = "https://extratorrent.one/search/?search=" . $term; was used to crawl page
		$url = "https://extratorrent.one/rss.xml?type=search&search=" . $term;
		// echo $url;

		function convert($url) {
			$feed = implode(file($url));
			$xml = simplexml_load_string($feed);
			$json = json_encode($xml);
			$array = json_decode($json,TRUE);
			return $array;
		}

		function fix_et_link($url_to_fix) {
			$old_url = 'http://extratorrent.cc';
			$new_url = 'https://extratorrent.one';
			$fixed = str_replace($old_url, $new_url, $url_to_fix);
			return $fixed;
		}

		function clean($string) {
			$ugly = array("http://extratorrent.cc/torrent","https://extra.to/torrent","https://eztv.ag/movie","https://yts.ag/movie", "+", "-", "%", "/", "#");
			$pretty = str_replace($ugly, " ", $string);
			return $pretty;
		}

		$et_tv = convert($url);

		// // Dump all data to check
		// echo '<pre>';
		// var_dump($et_tv);
		// echo '</pre>';

		print '<ul class="list-unstyled">';
		foreach($et_tv['channel']['item'] as $et_tv_item){
			
			print '<li>';
			print '<div class="checkbox"><label>';
			print '<input type="checkbox" name="torrent[]" value="' . fix_et_link($et_tv_item['enclosure']['@attributes']['url']) .'">';
			print clean($et_tv_item['link']);
			print '</label></div>';
			print '</li>';
		}
	print '</ul>';

?>
