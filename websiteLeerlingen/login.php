<!DOCTYPE html>
<html>
<head>

	<link rel="stylesheet" type="text/css" href="style.css"></link>
	<link rel="icon" href="faviconvlamtr.gif" type="image/gif" >

	<title>BeroepenTinder</title>

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

		// Hier wordt de connectie met de database weer verbroken
		mysqli_close($mysql) or die("Het verbreken van de verbinding met de MySQL-server is mislukt!");

	?>
</head>
<body>

<div data-role="page">

	<div data-role="header" data-position="fixed">
		<h1>Log in</h1>
	</div>

	<div role="main" class="ui-content">
		<form action="login.php" method="post">
			<label for="leerlingnummer">Leerlingnummer:</label>
			<input type="text" name="leerlingnummer" id="leerlinglingnummer" required>

			<label for "wachtwoord">Wachtwoord:</label>
			<input type="password" name="wachtwoord" id="wachtwoord" required>

			<input type="submit" value="Inloggen" data-inline="true">
		</form>
		<?php
			if ((isset($_POST["leerlingnummer"])) && (isset($_POST["wachtwoord"]))) {
				$mysql = mysqli_connect($server,$user,$pass,$db) or die("Fout: Er is geen verbinding met de MySQL-server tot stand gebracht!");

				$sLeerlingnummer = mysqli_real_escape_string($mysql, $_POST["leerlingnummer"]);
				$sWachtwoord = mysqli_real_escape_string($mysql, $_POST["wachtwoord"]);

				$sWachtwoordControle = mysqli_query($mysql, "SELECT * FROM Leerlingen WHERE LLnr='$sLeerlingnummer' AND Wachtwoord='$sWachtwoord' ") or die("De selectquery op de database is mislukt!");
				$count=mysqli_num_rows($sWachtwoordControle);
				if($count == 1)
				{

					$sValidatieCheck = mysqli_query($mysql, "SELECT * FROM Leerlingen WHERE LLnr='$sLeerlingnummer' AND gevalideerd=1 ") or die("De selectquery op de database is mislukt!");
					$sCount = mysqli_num_rows($sValidatieCheck);
					if($sCount == 1) {
						$_SESSION['validated'] = true;
					}

					// Wachtwoord en gebruikersnaam zijn juist, dus status updaten
					$_SESSION['logged_in'] = true;
					$_SESSION['sLeerlingnummer'] = $sLeerlingnummer;
					// Leerling doorsturen naar de hoofdpagina
					header("Location: mainloggedin.php");
				}
				// Als gebruikersnaam en wachtwoord niet goed zijn
				else
				{
					//Foutmelding geven
					//echo '<script type="text/javascript">alert("Deze combinatie leerlingnummer met wachtwoord is niet bij ons bekend.");</script>';
					echo "dat is helaas fout kerel";
				}
				mysqli_close($mysql) or die("Het verbreken van de verbinding met de MySQL-server is mislukt!");

			}
		?>
	</div>

	<div data-role="footer" data-position="fixed">
		<h4>BeroepenTinder Fioretti College</h4>
	</div><!-- /footer -->
</div><!-- /page -->

</body>
</html>
