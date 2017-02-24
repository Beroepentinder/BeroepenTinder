<?php
	session_start();
	$server = "localhost";
	$user = "beroepentinder"; //vul hier jouw gebruikersnaam in (leerlingnummer)
	$pass = "Beroepen123Tinder"; //vul hier jouw wachtwoord in (database1)
	$db = "beroepentinder"; //vul hier de naam van jouw database in (leerlingnummer)

	// Hier wordt connectie gemaakt met de database
	$mysql = mysqli_connect($server,$user,$pass,$db) or die("Fout: Er is geen verbinding met de MySQL-server tot stand gebracht!");


	// Hier wordt de connectie met de database weer verbroken
	mysqli_close($mysql) or die("Het verbreken van de verbinding met de MySQL-server is mislukt!");

	if(!isset($_SESSION['logged_in'])) {
		header('Location: main.php ');
		die();
	}

	$dirname = "Images/";
	$images = glob($dirname."*");
	//aantal plaatjes wordt geteld
	$filecount = 0;
	if ($images) {
		$filecount = count($images);
	}
?>

<!DOCTYPE html>
<html>
	<head>
	    <!-- index.php -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
		<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
		<link rel="stylesheet" href="css/c.css"/>
		<script src="https://npmcdn.com/imagesloaded@4.1/imagesloaded.pkgd.min.js"></script>
		<link rel="icon" href="faviconvlamtr.gif" type="image/gif">
	</head>

	<body>
		<div data-role="page" id="pageone" data-position="fixed">
		<!-- index.php -->
		<script>
			 $("#pageone").on("pageshow", function(event, ui) {
					$("img").imagesLoaded( function() {
						$(".tinderimg").each(function () {
							jQuery(this)
								.css("width", "95%")
								.css("height", "350px")
								.css("position", "absolute")
								.css("display", "block")
								.css("background-color", "white")
								.css("left", "2.5%")
								.css("object-fit", "contain");
						});

						var AcceptedArray = new Array();
						var imagecount = <?php echo json_encode("$filecount"); ?>;

						<!--Rechter met animatie, dus wel gekozen-->
						$("img").on("swiperight",function() {
							imagecount--;

							src = $(this).attr('src'); // "static/images/banner/blue.jpg"
							tarr = src.split('/');      // ["static","images","banner","blue.jpg"]
							file = tarr[tarr.length-1]; // "blue.jpg"
							data = file.split('.')[0];  // "blue"

							AcceptedArray.push(data);

							$(this).animate(
								{
								left: "500px",
								display: "none"
								}
							);
							$(this).fadeOut();

							if (imagecount == 0) {
								setTimeout(function(){window.location.href = "verstuurd.php?gegevens=" + AcceptedArray;} , 1000);
							}
						});

						<!--Linkerswipe met animatie, dus niet gekozen-->
						$("img").on("swipeleft",function() {
							imagecount--;

							$(this).animate(
								{
									left: "-500px",
									display: "none"

								}
							);
							$(this).fadeOut();

							if (imagecount == 0) {
								setTimeout(function(){window.location.href = "verstuurd.php?gegevens=" + AcceptedArray;} , 1000);
							}
						});
					});
			});
		</script>
			<div data-role="header">
				<h1>Test 1</h1>
			</div>

			<div data-role="main" class="ui-content">
				<div id="tekst">
					<p>Swipe links voor niet, rechts voor wel!</p>
				</div>
				<div id="images">
					<?php
						//plaatjes worden ingeladen
						//shuffle($images);
						$index = 0;
						foreach($images as $image) {
							echo "<img class=\"tinderimg\" src=\"$image\" style=\"z-index: $index\">\n";
							$index++;
						}
					?>
				</div>
			</div>
			<div data-role="footer" data-position="fixed">
				<h4>BeroepenTinder Fioretti College</h4>
			</div> <!-- /footer -->
		</div>
	</body>
</html>
