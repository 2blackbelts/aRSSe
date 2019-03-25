<?php

$url = $_GET['url'];

// only one torrent saved on server at any given time
$filename = 'bunnyhop.torrent';

// pull file from desired location
$file = file_get_contents($url);
file_put_contents($filename, $file);

// serve most recent torrent file
header('Content-Type: application/download');
header('Content-Disposition: attachment; filename=' . $filename);
header("Content-Length: " . filesize('bunnyhop.torrent'));

$fp = fopen($filename, "r");
fpassthru($fp);
fclose($fp);