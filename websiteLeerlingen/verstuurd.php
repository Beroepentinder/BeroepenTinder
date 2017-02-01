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
		if(isset($_SESSION['logged_in'])) {
			$leerlingnummer = $_SESSION['sLeerlingnummer'];
		}
		else {
			header('Location: main.php ');
			die();
		}
	?>
</head>
<body>

<div data-role="page">

	<div data-role="header" data-position="fixed">

	</div>

	<div role="main" class="ui-content">


		<table>
			<tr>
				<?php
				session_start();
				$server = "localhost";
				$user = "beroepentinder"; 		//vul hier jouw gebruikersnaam in (leerlingnummer)
				$pass = "Beroepen123Tinder"; 	//vul hier jouw wachtwoord in (database1)
				$db = "beroepentinder"; 		//vul hier de naam van jouw database in (leerlingnummer)

				// Hier wordt connectie gemaakt met de database
				$mysql = mysqli_connect($server,$user,$pass,$db) or die("Fout: Er is geen verbinding met de MySQL-server tot stand gebracht!");

				if (isset($_GET["gegevens"])) {
					$gegevens = $_GET["gegevens"];
				}



				$arrayGegevens = explode(",",$gegevens);
				foreach($arrayGegevens as $d){
					$d = intval($d);
					$sectorId = mysqli_query($mysql, "SELECT sectorId FROM Afbeeldinggegevens WHERE imagesId=$d");
					list($temp) = mysqli_fetch_row($sectorId);
					$stack[] = $temp;
				}
				$x = $stack;
				$ar = array_replace($x,array_fill_keys(array_keys($x, null),''));

				$counts = array_count_values($ar);
				arsort($counts);

				$top_with_count = array_slice($counts, 0, 3, true);
				$top = array_keys($top_with_count);

				echo '<ol data-role="listview">';
				echo '<li data-role="list-divider">Jouw top 3 sectoren zijn:</li>';

				$temp = 1

				foreach ($top as $e){
					if ($temp == 1){
						$temp = 0;
						mysqli_query($mysql, "UPDATE `Leerlingen` SET `Sector`= $e  WHERE `LLnr`= $leerlingnummer")
					}
					$sectorNameArray = mysqli_query($mysql, "SELECT SectorNaam FROM Sectoren WHERE SectorID=$e");
					list($sectorNameString) = mysqli_fetch_row($sectorNameArray);
					echo "<li><a href=\"#\">$sectorNameString</li>";
				}
				echo '</ol>';
				// Hier wordt de connectie met de database weer verbroken
				mysqli_close($mysql) or die("Het verbreken van de verbinding met de MySQL-server is mislukt!");
				?>
			</tr>
			<br>
			<tr>
				<form action="logout.php">					<!--klik hier om uit te loggen-->
				<input type="submit" value="Uitloggen" />
				</form>
			</tr>
		</table>
	</div>

	<div data-role="footer" data-position="fixed">
		<h4>BeroepenTinder Fioretti College</h4>
	</div><!-- /footer -->
</div><!-- /page -->

</body>
</html>
