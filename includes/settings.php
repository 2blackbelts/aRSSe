<?php
// Define credentials

$OMDB_API_KEY = '';

// Your web server will need PHP's SSH2 extention
// Installation details: http://php.net/manual/en/ssh2.installation.php

// SSH login details
$SSH_USERNAME = 'saim';
$SSH_PASSWORD = 'unity786';
$SSH_PORT = 22; //default 22
$SSH_IP = '192.168.2.15';  //192.168.1.20

// Attempt connection
try {

	$connection = ssh2_connect($SSH_IP, $SSH_PORT);
	ssh2_auth_password($connection, $SSH_USERNAME, $SSH_PASSWORD);

} catch (Exception $e) {

	echo 'Cannot connect to SSH';

}



