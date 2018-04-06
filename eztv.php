<h2>EZTV Search</h2>
<?php
	include_once('simplehtmldom_1_5/simple_html_dom.php');
	include 'functions.php';

		$term = $_GET['searched'];
		// $term = preg_replace("/[\s_]/", "-", $term);
		$base = 'https://eztv.ag/search/' . $term;

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($curl, CURLOPT_URL, $base);
		curl_setopt($curl, CURLOPT_REFERER, $base);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		$str = curl_exec($curl);
		curl_close($curl);

		// Create a DOM object
		$html_base = new simple_html_dom();
		// Load HTML from a string
		$html_base->load($str);
		// echo "<pre>";
		// print_r($html_base->find("tr[class='forum_header_border']")[0]->children(1)->children(0)->attr['title']);
		// print_r($html_base->find("tr[class='forum_header_border']")[0]->children(2)->children(1)->attr['href']);
		// echo "</pre>";

		//get all category links
		// $titles = array();
		// $torrents = array();
		// foreach($html_base->find("a[class='epinfo']") as $element) {
		//     // echo "<pre>";
		//     // print_r( $element->title );
		//     $titles[] = $element->title;
		//     // echo "</pre>";
		// }

		// foreach($html_base->find("a[class='magnet']") as $element) {
		//     // echo "<pre>";
		//     // print_r( $element->href );
		//     $torrents[] = $element->href;
		//     // echo "</pre>";
		// }

		// $results = array_combine($titles, $torrents);
		// echo "<pre>";
		// print_r($results);
		// echo "</pre>";

		print '<ul class="list-unstyled">';


		foreach ($html_base->find("tr[class='forum_header_border']") as $element) {
			print '<li>';
			print '<div class="checkbox"><label>';

			create_link_or_icon($ssh_is_true, $element->children(2)->children(0)->attr['href'], 'magnet');

			// print '<input type="checkbox" name="torrent[]" value="' . $element->children(2)->children(0)->attr['href'] .'">';
			
			print '<span class="glyphicon glyphicon-search"></span> ';
			
			create_link_or_label(
				$ssh_is_true,
				$element->children(1)->children(0)->attr['title'],
				$element->children(2)->children(0)->attr['href']
				);
			// print $element->children(1)->children(0)->attr['title'];
			print '</label></div>';
			
			print '</li>';
		}

		print '</ul>';


		$html_base->clear(); 
		unset($html_base);
		
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
       