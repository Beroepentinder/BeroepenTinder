<!DOCTYPE html>
<html>
<head>
	<!-- mainloggedin.php -->
	<link rel="stylesheet" type="text/css" href="style.css"></link>
	<link rel="icon" href="faviconvlamtr.gif" type="image/gif" >

	<title>BeroepenTinder</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
	<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	<script src="https://npmcdn.com/imagesloaded@4.1/imagesloaded.pkgd.min.js"></script>

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

		if (!isset($_SESSION['logged_in'])) {
			header('Location: main.php ');
			die();
		}
	?>
</head>
<body>

<div data-role="page">

	<div data-role="header" data-position="fixed">
		<h1>Welkom</h1>
	</div>

	<div role="main" class="ui-content">

		<?php
			$mysql = mysqli_connect($server,$user,$pass,$db) or die("Fout: Er is geen verbinding met de MySQL-server tot stand gebracht!");

			$sLeerlingnummer = $_SESSION['sLeerlingnummer'];

			$sValidatieCheck = mysqli_query($mysql, "SELECT * FROM Leerlingen WHERE LLnr='$sLeerlingnummer' AND gevalideerd=1 ") or die("De selectquery op de database is mislukt!");
			$sCount = mysqli_num_rows($sValidatieCheck);
			if (isset($_SESSION['validated'])) {
				echo "<form action=\"index.php\">
					<input type=\"submit\" value=\"Doe de Test hier!\"/>
					</form>";
			}

			else {
				echo "<form action=\"index.php\">
					<input type=\"submit\" value=\"Doe de Test hier!\" disabled />
					</form>";

				echo"Je moet je email-adres nog valideren. \n Dit kun je doen op <a href=\"webmail.fiorettileerling.nl\" ";
			}

			mysqli_close($mysql) or die("Het verbreken van de verbinding met de MySQL-server is mislukt!");


		?>


		<form action="logout.php">
		<input type="submit" value="Uitloggen" />
		</form>

	</div>

	<div data-role="footer">
		<h4>BeroepenTinder Fioretti College</h4>
	</div><!-- /footer -->
</div><!-- /page -->

</body>
</html>
