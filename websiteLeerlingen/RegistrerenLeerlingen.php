<!DOCTYPE html>
<html>
	<head>
		<?php
			session_start();
			$server = "localhost";
			$user = "beroepentinder"; //vul hier jouw gebruikersnaam in (leerlingnummer)
			$pass = "Beroepen123Tinder"; //vul hier jouw wachtwoord in (database1)
			$db = "beroepentinder"; //vul hier de naam van jouw database in (leerlingnummer)
		?>

		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
		<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	</head>

	<body>
		<div data-role="header" class="ui-content">
		</div>

		<div data-role="main" class="ui-content" >
			<div data-role="fieldcontain">
			<form data-ajax="false" action="RegistrerenLeerlingen.php" method="POST">
				<table border='0' align='center' data-role="table" class="ui-responsive">
					<tr>
						<center>
						<h1>Registreer jezelf!</h1>
						<p style="color: red;"><sup style="color: red;">*</sup> Vereist</p>
					</tr>
					<tr>
						<td align='center'><label for="leerlingnummer"><sup style="color: red;">*</sup> Leerlingnummer:</label></td>
						<td><input type='number' id="leerlingnummer" name="leerlingnummer" min="000000" max="999999" required></td>
					</tr>
					<tr>
					<tr>
						<td align='center'><label for="mentor" class="select"><sup style="color: red;">*</sup> Mentor:</label></td>
						<td>
							<select name="mentor" id="select-choice-min" required>
									<?php
									$mysql = mysqli_connect($server,$user,$pass,$db) or die("Fout: Er is geen verbinding met de MySQL-server tot stand gebracht!");
										$lerarenAfkortingen = mysqli_query($mysql,"SELECT lernaam FROM Leraargegevens");

											while ($row = mysqli_fetch_assoc($lerarenAfkortingen)) {

												foreach($row as $field) {
													echo "<option value=\"$field\">$field</option>";
												}
											}
									mysqli_close($mysql) or die("Het verbreken van de verbinding met de MySQL-server is mislukt!");
								?>

							</select>
						</td>
					</tr>
						<td align='center'><label for="voornaam"><sup style="color: red;">*</sup> Voornaam:</label></td>
						<td><input type='text' id="voornaam" name="voornaam" required></td>
					</tr>
					<tr>
						<td align='center'><label for ="tussenvoegsel">Tussenvoegsel:</label></td>
						<td><input type='text' id="tussenvoegsel" name="tussenvoegsel"></td>
					</tr>
					<tr>
						<td align='center'><label for ="achternaam"><sup style="color: red;">*</sup> Achternaam:</label></td>
						<td><input type='text' id="achternaam" name="achternaam" required></td>
						<td>
					</tr>
					<tr>
						<td align='center'><label for="wachtwoord"><sup style="color: red;">*</sup> Wachtwoord:</label></td>
						<td><input type='password' id="wachtwoord" name="wachtwoord" required></td>
					</tr>
					<tr>
						<td align='center'><label for ="wachtwoordCheck"><sup style="color: red;">*</sup> Herhaal Wachtwoord:</label></td>
						<td><input type='password' id="wachtwoordCheck" name ="wachtwoordCheck" onChange="checkPasswordMatch();" required></td>
						<td>
						<div class="registrationFormAlert" id="divCheckPasswordMatch">
						</div>

						<script>
							function checkPasswordMatch() {
								var password = $("#wachtwoord").val();
								var confirmPassword = $("#wachtwoordCheck").val();
								if (password != confirmPassword){
									$("#divCheckPasswordMatch").html("Wachtwoorden zijn niet hetzelfde!");
									document.getElementById("divCheckPasswordMatch").style.color = "red";
								}

								else {
									$("#divCheckPasswordMatch").html("Wachtwoorden zijn hetzelfde.");
									document.getElementById("divCheckPasswordMatch").style.color = "green";
								}
							}
								$(document).ready(function () {
								$("#wachtwoordCheck").keyup(checkPasswordMatch);
								});
						</script>
						</td>
					</tr>
				</table>
				<input type='submit' name='REGISTER' value="Registreer"></td>
			</form>

			<?php 	// Hier wordt eerst gecheckt of alle variablenen zijn ingevuld voor de zekerheid
					// Daarna worden alle variabelen geescaped voor beveiliging. Dan wordt gekeken of
					// het wachtwoord wel hetzelfde is als het check-wachtwoord, zo niet, dan krijgt de gebruiker een notificatie
					//Is de registratie succesvol, dan wordt de gebruiker doorgestuurd naar de loginpagina.
				if ((isset($_POST["leerlingnummer"])) && (isset($_POST["voornaam"])) && (isset($_POST["achternaam"])) && (isset($_POST["mentor"])) && (isset($_POST["wachtwoord"])) && (isset($_POST["wachtwoordCheck"])))
				{
					$mysql = mysqli_connect($server,$user,$pass,$db) or die("Fout: Er is geen verbinding met de MySQL-server tot stand gebracht!");

					$leerlingnummer = mysqli_real_escape_string($mysql, $_POST["leerlingnummer"]);
					$voornaam = mysqli_real_escape_string($mysql, $_POST["voornaam"]);
					$achternaam = mysqli_real_escape_string($mysql, $_POST["achternaam"]);
					$wachtwoord = mysqli_real_escape_string($mysql, $_POST["wachtwoord"]);
					$wachtwoordCheck = mysqli_real_escape_string($mysql, $_POST["wachtwoordCheck"]);
					$mentor = mysqli_real_escape_string($mysql, $_POST["mentor"]);

					if (isset($_POST["tussenvoegsel"])) {
						$tussenvoegsel = mysqli_real_escape_string($mysql, $_POST["tussenvoegsel"]);
					}
					else {
						$tussenvoegsel = null;
					}

					if ($wachtwoord == $wachtwoordCheck) {

						mysqli_query($mysql,"INSERT INTO `Leerlingen`(`LLnr`, `Wachtwoord`, `Voornaam`, `Tussenvoegsel`, `Achternaam`, `Mentor_afkorting`) VALUES ('$leerlingnummer', '$wachtwoord', '$voornaam', '$tussenvoegsel', '$achternaam', '$mentor')");
						header('Refresh:3; url=index.php');
						echo "U bent succesvol geregistreerd!";
					}

					else {
						echo "Uw wachtwoord is niet hetzelfde als de wachtwoordcheck!";
					}
					mysqli_close($mysql) or die("Het verbreken van de verbinding met de MySQL-server is mislukt!");
				}
		?>
		</div>
		</div>

		<div data-role="footer" class="ui-content">
		</div>
	</body>
</html>
