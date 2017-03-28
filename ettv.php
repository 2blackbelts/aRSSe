<h2>ExtraTorrent Search</h2>

<?php
	include_once('simplehtmldom_1_5/simple_html_dom.php');

		$term = $_GET['searched'];
		$term = preg_replace("/[\s_]/", "-", $term);
		$url = "https://extratorrent.one/search/?search=" . $term;
		// echo $url;

		// $html = file_get_html($url);
		$html = new simple_html_dom();
		$html->load_file($url);
		$ettv_root = "https://extratorrent.one";

		// TODO: find table rows with class 'tlr' to get links
		print '<pre>';
		$all = $html->find('tr[class="tlr"]');
		print_r($all);
		print '</pre>';

		print '<ul class="list-unstyled">';

		foreach ($html->find("tr[class='tlr']") as $element) {
			// print '<pre>' . print_r($element) . '</pre>';
			print '<li>';
			print '<div class="checkbox"><label>';
			$torrent_link = $element->children(0)->children(0)->attr['href'];
			$torrent_link = str_replace('/torrent_download/', "", $torrent_link);
			$torrent_link = $ettv_root . $torrent_link;
			print '<input type="checkbox" name="torrent[]" value="' . $torrent_link .'">';

			print '<span class="glyphicon glyphicon-search"></span> ';

			// remove the word Torrent and Download from title
			$title = $element->children(0)->children(0)->attr['title'];
			$title = str_replace(array('Download ','torrent'), " ", $title);
			print $title;
			print '</label></div>';

			print '</li>';
		}

		print '</ul>';
		// echo "<pre>";

		// print_r($html->find("tr[class='tlr']",0)->children(0)->children(0)->attr['href']);
		// echo "</pre>";

		// foreach($html->find("td[class='sy']") as $element) {
		//     echo "<pre>";
		//     print_r( $element );
		//     // $titles[] = $element->title;
		//     echo "</pre>";
		// }

		// foreach($html_base->find("a[class='magnet']") as $element) {
		//     // echo "<pre>";
		//     // print_r( $element->href );
		//     $torrents[] = $element->href;
		//     // echo "</pre>";
		// }

		// $results = array_combine($titles, $torrents);
		// // echo "<pre>";
		// // print_r($results);
		// // echo "</pre>";

		// foreach ($results as $key => $value) {
		// 	echo $key . ' :: ' . $value . '<br><br>';
		// }

		// $html_base->clear();
		// unset($html_base);

		// get unit title
		// $title = $html->find('h2', 0);
		// $title = strip_tags($title);


			// echo '<h2>' . $title . '</h2>';

			// // Check if unit is current or not
			// $version = $html->find('div[class="display-field"]',0)->plaintext;
			// $version = str_replace(' ', '', $version);
			// if($version === 'Current') {
			// 	// get 2nd table in array and skip first 4 rows in table
			// 	$tblnum = 1;
			// 	$tblrow = 4;
			// 	echo '<p><span class="label label-success">' . $version . '</span></p>';
			// } else {
			// 	// get 3rd table in array and skip 0 rows in table
			// 	$tblnum = 2;
			// 	$tblrow = 0;
			// 	echo '<p><span class="label label-danger">' . $version . '</span></p>';
			// }

			// Find second ait-table in array
			// $element = $html->find('a[class="epinfo"]');

			// print_r($element);


			// loop through form with any p tags
			// echo '<table style="border:1px solid #111;border-collapse:collapse;">';
			// $count = 0;
			// foreach($element->find('p') as $p) {
			// 	$count = $count + 1;
			// 	if ($count > $tblrow) {
			// 		echo '<tr style=""><td style="border:1px solid;border-collapse:collapse;">';
			// 		echo $p->plaintext . '<br>';
			// 		echo '</td></tr>';



			// echo '</table>';

?>
