<h2>TPB Search</h2>
<?php
	include_once('simplehtmldom_1_5/simple_html_dom.php');

		$term = $_GET['searched'];
		// $term = preg_replace("/[\s_]/", "-", $term);
		$base = 'https://thepiratebay.org/search/' . $term;

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
		// // title
		// print_r($html_base->find("table[id='searchResult']")[0]->children(1)->children(1)->children(0)->plaintext);
		// print_r($html_base->find("table[id='searchResult']")[0]->children(1)->children(1)->children(1)->attr['href']);
		// echo "</pre>";
		print '<ul class="list-unstyled">';
		foreach ($html_base->find("table[id='searchResult'] tbody tr") as $element) {
			print '<li>';
			print '<div class="checkbox disabled"><label>';
			// print '<input type="checkbox" name="torrent[]" value="">';
			
			print '<span class="glyphicon glyphicon-search"></span> ';
			print "<a href='";
			print $element->find('a[title="Download this torrent using magnet"]')[0]->attr['href'];
			print "'><span class='glyphicon glyphicon-magnet'></span></a> ";
			print $element->find('.detName',0)->children[0]->plaintext;
			print '</label></div>';
			
			print '</li>';
			// echo "<pre>";
			// print ($element->find('.detName',0)->children[0]->plaintext);
			// print ($element->find('a[title="Download this torrent using magnet"]')[0]->attr['href']);
			// echo "</pre>";
		}
		print '</ul>';

		$html_base->clear(); 
		unset($html_base);

?>