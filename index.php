<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">

	<title>aRSSe</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="/manifest.json">
	<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="theme-color" content="#ffffff">
	<?php print '
		<style type="text/css">
			.se-pre-con {
			position: fixed;
			left: 0px;
			top: 0px;
			width: 100%;
			height: 100%;
			z-index: 9999;
			background: url(css/images/loader-128x/Preloader_' . rand(1,13) . '.gif) center no-repeat #fff;
		}'; 
	?>
	</style>
</head>
<body>
	
	<div class="counter-tick">0</div>

	<div class="se-pre-con"></div>

	<div class="result"></div>

<div class="realm">
	<div class="container">
		<div class="alert alert-info" role="alert">
		  Please click the search buttons. Don't use ENTER.
		</div>
		<!-- EZTV Search -->
		<div class="col-lg-12">
			<div class="eztv-search">
				<form id="eztv-search" class="form-inline">
					<div class="input-group">
						<input type="text" id="eztv-term" class="form-control" placeholder="Search EZTV">
						<span class="input-group-btn">
						<a href="#" id="eztv-go" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> EZTV Search</a>
						</span>
					</div>
				</form>
			</div>
		</div>
		
		<!-- Yify search -->
		<div class="col-lg-12">
			<div class="yify-search">
				<form id="yify-search" class="form-inline">
					<div class="input-group">
						<input type="text" id="yify-term" class="form-control" placeholder="Search Yify" autofocus>
						<span class="input-group-btn">
						<a href="#" id="yify-go" class="btn btn-warning"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> YIFY Search</a>
						</span>
					</div>
				</form>
			</div>
		</div>
		
	</div>
</div>
	<script type="text/javascript">
		$.get( "get_torrents.php", function( data ) {
		  $( ".result" ).html( data );
		  // alert( "Load was performed." );
		  $(".se-pre-con").hide();
		  document.getElementById('bgmusic').play();
		})
		.fail(function() {
		    alert( "Failed to load. Please try again." );
		    $(".se-pre-con").hide();
		});

	</script>

	<script type="text/javascript">

		$("#yify-go").click(function(e){
			e.preventDefault();
			$("#yify-go").addClass('disabled');
			$("#yify-go").text('Searching...');
		var term = $("#yify-term").val();
			$.get( 'yify.php?searched=' + term, function( data ) {
			  $( ".yify" ).html( data ).fadeIn();
			  $("#yify-go").removeClass('disabled');
  			  $("#yify-go").html('<span class="glyphicon glyphicon-search" aria-hidden="true"></span> YIFY Search');

			  // alert( "Load was performed." );
			  // $(".se-pre-con").hide();
			})
			.fail(function() {
			    alert( "Failed to run Yify. Please try again." );
			    // $(".se-pre-con").hide();
			});
		});

		$("#eztv-go").click(function(e){
			e.preventDefault();
			$("#eztv-go").addClass('disabled');
			$("#eztv-go").text('Searching...');
			var ezterm = $("#eztv-term").val();
			$.get( 'eztv.php?searched=' + ezterm, function( data ) {
			  $( ".eztv" ).html( data ).fadeIn();
			  $("#eztv-go").removeClass('disabled');
  			  $("#eztv-go").html('<span class="glyphicon glyphicon-search" aria-hidden="true"></span> EZTV Search');

			  // alert( "Load was performed." );
			  // $(".se-pre-con").hide();
			})
			.fail(function() {
			    alert( "Failed to run EZTV. Please try again." );
			    // $(".se-pre-con").hide();
			});
		});

	</script>

	<script type="text/javascript">
			$('body').click(function(){
				var n = $('input[name="torrent[]"]:checked').length;
				console.log(n);
				$('.counter-tick').text(n);
				var n = Math.floor(Math.random() * 14) + 1  
				document.getElementById('fart' + n).play();
			});	 

			$( "input[type='text']" ).keydown(function() {
			  	var n = Math.floor(Math.random() * 9) + 1  
				document.getElementById('short' + n).play();
			});
			

	</script>

	<audio id="bgmusic" controls>
	  <source src="audio/GirlFromIpanema.mp3" type="audio/mpeg">
	  Your browser does not support the audio element.
	</audio>

<?php
	$farts = scandir('sfx/long');
	$fart_count = 1;
	foreach ($farts as $fart) {
		print '<audio id="fart' . $fart_count . '">';
		print '<source src="sfx/long/' . $fart . '" type="audio/mpeg">';
		print '</audio>';
		$fart_count ++;
	}
	$short_farts = scandir('sfx/short');
	$short_count = 1;
	foreach ($short_farts as $short_fart) {
		print '<audio id="short' . $short_count . '">';
		print '<source src="sfx/short/' . $short_fart . '" type="audio/wav">';
		print '</audio>';
		$short_count ++;
	}
	
?>

<!-- Default bootstrap modal example -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">OMDB Lookup</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

</body>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
	// Fill modal with content from link href
	$("#myModal").on("show.bs.modal", function(e) {
	    var link = $(e.relatedTarget);
	    $(this).find(".modal-body").load(link.attr("href"));
	});
</script>
</html>