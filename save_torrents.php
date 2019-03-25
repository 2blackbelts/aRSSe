<?php require 'includes/settings.php'; ?>

<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>aRSSe | Torrents Saved</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>
	<div class="container">
		<h1>Success!</h1>

		<?php
			if (isset($_POST['cmdSubmit'])) {
				// print_r($_POST);
				
				$torrents = $_POST['torrent'];
				// Loop through torrents and run ssh command to transmission
				foreach ($torrents as $torrent) {
					$command = 'transmission-remote -a ' . $torrent;
					$stream = ssh2_exec($connection, $command);
					stream_set_blocking($stream, true);
					$stream_out = ssh2_fetch_stream($stream, SSH2_STREAM_STDIO);
					echo '<br>' . $torrent . '<br>';
					echo '<strong>' . stream_get_contents($stream_out) . '</strong>';

					// print '<p>Added: ' . $torrent . ' </p>';
					// file_put_contents("torrents/" . time() . ' - ' . mt_rand(1,1000) . ".torrent", fopen($torrent, 'r'));
					// sleep(1);
				}
				ssh2_exec($connection, 'logout');
			}
		?>

		<br>
		<a class="btn btn-default" href="index.php">Back to home</a>
		<br>
		<br>
		<p>
			<?php print '<img class="img-responsive" src="img/success_' . rand(1,20) . '.jpeg">'; ?>
		</p>
	</div>
</body>
</html>
