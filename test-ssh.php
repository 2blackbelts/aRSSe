<?php

require 'includes/settings.php';

// run SSH command check - should print username
// visit aRSSe/test-ssh.php

	$command = 'whoami';
	$stream = ssh2_exec($connection, $command);
	stream_set_blocking($stream, true);
	$stream_out = ssh2_fetch_stream($stream, SSH2_STREAM_STDIO);
	echo stream_get_contents($stream_out);

ssh2_exec($connection, 'logout');