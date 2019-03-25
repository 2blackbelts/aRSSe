<h2>ShowRSS Search</h2>

<?php
	include 'functions.php';

	$id = $_GET['id'];
	$showRSS = convert('https://showrss.info/show/' . $id . '.rss');

	// print '<pre>';
	// var_dump($showRSS);
	// print '</pre>';

	print '<ul class="list-unstyled">';
		
			foreach($showRSS['channel']['item'] as $showRSS_item){
				
				print '<li>';
				print '<div class="checkbox"><label>';

				create_link_or_icon(
					$ssh_is_true, 
					$showRSS_item['enclosure']['@attributes']['url'], 
					'magnet',
					0
				);
				
				// print clean($showRSS_item['title'], 0);
				create_link_or_label(
					$ssh_is_true,
					clean($showRSS_item['title'], 0),
					$showRSS_item['enclosure']['@attributes']['url'],
					0
				);
			
				print '</label></div>';
				print '</li>';
			}
		print '</ul>';


	


?>

