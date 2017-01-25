<!DOCTYPE html>
<html>
<head> 
	<title>Page Title</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
	<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	
	<?php
		session_start();
		$server = "localhost";
		$user = "beroepentinder"; //vul hier jouw gebruikersnaam in (leerlingnummer)
		$pass = "Beroepen123Tinder"; //vul hier jouw wachtwoord in (database1)
		$db = "beroepentinder"; //vul hier de naam van jouw database in (leerlingnummer)

		// Hier wordt connectie gemaakt met de database
		$mysql = mysqli_connect($server,$user,$pass,$db) or die("Fout: Er is geen verbinding met de MySQL-server tot stand gebracht!");
			
		if (isset($_GET["gegevens"])) {
			$gegevens = $_GET["gegevens"];
		}
		
		// Gegevens van producten opvragen uit de database 
		$imageId = mysqli_query($mysql,"SELECT * FROM Afbeeldinggegevens") or die("De selectquery op de database is mislukt!");
	
		// Hier wordt de connectie met de database weer verbroken
		mysqli_close($mysql) or die("Het verbreken van de verbinding met de MySQL-server is mislukt!");
	?>
</head>
<body>

<div data-role="page">

	<div data-role="header" data-position="fixed">
		<h1>Page Title</h1>
	</div><!-- /header -->

	<div role="main" class="ui-content">
		<h1>Je sector is ... !</h1>
		<p>Nummers van plaatjes die je hebt aangevinkt</p>
		<?php
		$arrayGegevens = explode(",",$gegevens);
		
		$gegevens = array($gegevens);
		foreach($gegevens as $d){
			echo $d;
		}
		?>
	</div>

	<div data-role="footer" data-position="fixed">
		<h4>Page Footer</h4>
	</div><!-- /footer -->
</div><!-- /page -->

</body>
</html>