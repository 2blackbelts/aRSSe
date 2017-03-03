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
				foreach ($torrents as $torrent) {
					print '<p>Added: ' . $torrent . ' </p>';
					file_put_contents("torrents/" . time() . ' - ' . mt_rand(1,1000) . ".torrent", fopen($torrent, 'r'));
					// sleep(1);
				}
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
