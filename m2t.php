<?php
	// magnet to torrent
$url = 'http://magnet-to-torrent.com/';
$fields = array(
            //post parameters to be sent to the other website
            'input_box'=>urlencode($_POST['magnet:?xt=urn:btih:dcd8af6c14c2405154a61730b00534e2bf025241&dn=Bobs.Burgers.S07E01.720p.HEVC.x265-MeGusta&tr=udp%3A%2F%2Ftracker.leechers-paradise.org%3A6969&tr=udp%3A%2F%2Fzer0day.ch%3A1337&tr=udp%3A%2F%2Fopen.demonii.com%3A1337&tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969&tr=udp%3A%2F%2Fexodus.desync.com%3A6969']), //the post request you send to this  script from your domain.
        );

//url-ify the data for the POST
foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string,'&');

//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_POST,count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);

//execute post
$result = curl_exec($ch);
print "<pre>";
print_r($result);
print "</pre>";
//close connection
curl_close($ch);
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script type="text/javascript">

	// $(document).ready(function(){
	// 	// $('#input_box').focusin(function(){
	// 	// 	$(this).val('');
	// 	// });
	// 	// $(document).on('input', '#input_box', function (e) {
			
	// 		var magneturl = "magnet:?xt=urn:btih:dcd8af6c14c2405154a61730b00534e2bf025241&dn=Bobs.Burgers.S07E01.720p.HEVC.x265-MeGusta&tr=udp%3A%2F%2Ftracker.leechers-paradise.org%3A6969&tr=udp%3A%2F%2Fzer0day.ch%3A1337&tr=udp%3A%2F%2Fopen.demonii.com%3A1337&tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969&tr=udp%3A%2F%2Fexodus.desync.com%3A6969";
	// 		$.get("http://magnet-to-torrent.com/magnet2torrent.php", { 
	// 			magnet: encodeURIComponent(magneturl),
	// 			dataType: 'jsonp', 

	// 		},function(data){
	// 			var result = $('#result');
	// 			// $('.spinner').remove();
	// 			// $('#wrap').fadeTo('slow', 1);
	// 			var obj = JSON.parse(data);
	// 			var strhtml = obj.result? 'The url ' + magneturl + ' is valid! ' : 'The url ' + magneturl + ' is invalid! ';
	// 			if (obj.result) {
	// 				strhtml = 'Download <a href="' + obj.url + '">'+obj.url+'</br>';
	// 			}
	// 			result.html('<div class="alert">' + strhtml + '</div>');
	// 		});
	// 	// });
	// });

</script>