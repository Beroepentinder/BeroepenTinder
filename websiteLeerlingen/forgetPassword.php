<!DOCTYPE html>
	<head>
	<link rel="stylesheet" type="text/css" href="style.css"></link>
	<link rel="icon" href="faviconvlamtr.gif" type="image/gif" >

	<title>BeroepenTinder</title>

		<?php
			session_start();
			$server = "localhost";
			$user = "beroepentinder"; //vul hier jouw gebruikersnaam in (leerlingnummer)
			$pass = "Beroepen123Tinder"; //vul hier jouw wachtwoord in (database1)
			$db = "beroepentinder"; //vul hier de naam van jouw database in (leerlingnummer)
		?>
<html>

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
			<form data-ajax="false" action="forgetPassword.php" method="POST">
				<table border='0' align='center' data-role="table" class="ui-responsive">
					<tr>
						<center>
						<h1>Wachtwoord vergeten</h1>
						<p style="color: red;"><sup style="color: red;">*</sup> Vereist</p>
					</tr>
					<tr>
						<td align='center'><label for="leerlingnummer"><sup style="color: red;">*</sup> Leerlingnummer:</label></td>
						<td><input type='number' id="leerlingnummer" name="leerlingnummer" min="245000" max="400000" required></td>
					</tr>
					<tr>

				</table>
				<input type='submit' name='REGISTER' value="Wachtwoord resetten"></td>
			</form>

			<?php 	// Hier wordt eerst gecheckt of alle variablenen zijn ingevuld voor de zekerheid
					// Daarna worden alle variabelen geescaped voor beveiliging. Dan wordt gekeken of
					// het wachtwoord wel hetzelfde is als het check-wachtwoord, zo niet, dan krijgt de gebruiker een notificatie
					//Is de registratie succesvol, dan wordt de gebruiker doorgestuurd naar de loginpagina.
				if (isset($_POST["leerlingnummer"]))
				{
					$mysql = mysqli_connect($server,$user,$pass,$db) or die("Fout: Er is geen verbinding met de MySQL-server tot stand gebracht!");

					$leerlingnummer = mysqli_real_escape_string($mysql, $_POST["leerlingnummer"]);

						$qLLnrCheck = mysqli_query($mysql, "SELECT * FROM Leerlingen WHERE LLnr='$leerlingnummer' ") or die("De selectquery op de database is mislukt!");
						$count=mysqli_num_rows($qLLnrCheck);
						if($count == 1) {


							//mailtje sturen

							//mailsysteem
						$leerlingcode = base64_encode($leerlingnummer);
							//maak-file-aan-systeem

						$myfile = fopen("$leerlingcode.php", "w") or die("Unable to open file!");
						$txt = '<!DOCTYPE html>
								<html>
									<head>
										<?php
											session_start();
											$server = "localhost";
											$user = "beroepentinder"; //vul hier jouw gebruikersnaam in (leerlingnummer)
											$pass = "Beroepen123Tinder"; //vul hier jouw wachtwoord in (database1)
											$db = "beroepentinder"; //vul hier de naam van jouw database in (leerlingnummer)

											$mysql = mysqli_connect($server,$user,$pass,$db) or die("Fout: Er is geen verbinding met de MySQL-server tot stand gebracht!");

											$leerlingnummer = base64_decode(basename(__FILE__, \'.php\'));

											mysqli_query($mysql, "UPDATE `Leerlingen` SET `gevalideerd`=1 WHERE `LLnr` = $leerlingnummer");




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
											<p>Registratie voltooit, je hoeft alleen nog je account te verifiëren!</p>
											<form method="post" action="<?php echo (basename(__FILE__)); ?>">
												<label for="wachtwoord"><sup style="color: red;">*</sup> Wachtwoord:</label>
												<input type="password" id="wachtwoord" name="wachtwoord" required>

												<label for ="wachtwoordCheck"><sup style="color: red;">*</sup> Herhaal Wachtwoord:</label>
												<input type="password" id="wachtwoordCheck" name ="wachtwoordCheck" onChange="checkPasswordMatch();" required>

												<div class="registrationFormAlert" id="divCheckPasswordMatch"></div>
												<input type="submit" name="REGISTER" value="Registreer"></td>
											</form>

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

											<?php



												if ( (isset($_POST["wachtwoord"])) && (isset($_POST["wachtwoordCheck"])) ) {
													$wachtwoord = $_POST["wachtwoord"];
													$wachtwoordCheck = $_POST["wachtwoordCheck"];

													if ($wachtwoord == $wachtwoordCheck) {

													mysqli_query($mysql, "UPDATE `Leerlingen` SET `Wachtwoord`=\'$wachtwoord\' WHERE `LLnr` = $leerlingnummer");

													unlink(__FILE__);

													header("Location: login.php ");
													}
													else {
														$foutje = true;
													}
													mysqli_close($mysql) or die("Het verbreken van de verbinding met de MySQL-server is mislukt!");
												}

												if (isset($foutje)) {
													echo "Je hebt helaas de wachtwoordcheck niet gehaald. Probeer het opnieuw";
												}
											?>
										</div>

										<div data-role="footer" class="ui-content">
										</div>
									</body>
								</html>';

						fwrite($myfile, $txt);


						fclose($myfile);


						/**
						 * This example shows settings to use when sending via Google's Gmail servers.
						 */
						//SMTP needs accurate times, and the PHP time zone MUST be set
						//This should be done in your php.ini, but this is how to do it if you don't have access to that
						date_default_timezone_set('Etc/UTC');
						require 'PHPmailer/PHPMailerAutoload.php';
						//Create a new PHPMailer instance
						$mail = new PHPMailer;
						//Tell PHPMailer to use SMTP
						$mail->isSMTP();
						//Enable SMTP debugging
						// 0 = off (for production use)
						// 1 = client messages
						// 2 = client and server messages
						$mail->SMTPDebug = 0;
						//Ask for HTML-friendly debug output
						$mail->Debugoutput = 'html';
						//Set the hostname of the mail server
						$mail->Host = 'smtp.gmail.com';
						// use
						// $mail->Host = gethostbyname('smtp.gmail.com');
						// if your network does not support SMTP over IPv6
						//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
						$mail->Port = 587;
						//Set the encryption system to use - ssl (deprecated) or tls
						$mail->SMTPSecure = 'tls';
						//Whether to use SMTP authentication
						$mail->SMTPAuth = true;
						//Username to use for SMTP authentication - use full email address for gmail
						$mail->Username = "beroepentinder@gmail.com";
						//Password to use for SMTP authentication
						$mail->Password = "BeroepenTinder2016";
						//Set who the message is to be sent from
						$mail->setFrom('Beroepentinder', 'BeroepenTinder');
						//Set an alternative reply-to address
						$mail->addReplyTo('beroepentinder@gmail.com', 'Beroepentinder');
						//Set who the message is to be sent to
						$mail->addAddress("$leerlingnummer@Fiorettileerling.nl", "$leerlingnummer");
						//Set the subject line
						$mail->Subject = 'PHPMailer GMail SMTP test';
						//Read an HTML message body from an external file, convert referenced images to embedded,
						//convert HTML into a basic plain-text alternative body
						$mail->Body = "Beste leerling, <br>
										Je hebt aangegeven dat je je wachtwoord vergeten bent. <br>
										Gebruik deze site om je wachtwoord te wijzigen:<br><br>
										www.beroepentinder.fiorettileerling.nl/websiteLeerlingen/$leerlingcode.php <br><br>
										Kopieer deze link naar je URL-balk in een nieuw tabblad.<br>
										Na het wijzigen word je gelijk doorgestuurd naar de inlogsite.<br>
										Vriendelijke groet";
						//Replace the plain text body with one created manually
						$mail->AltBody = 'This is a plain-text message body';
						//Attach an image file
						//$mail->addAttachment('images/phpfmailer_mini.png');
						//send the message, check for errors

						if (!$mail->send()) {
						echo "Mailer Error: " . $mail->ErrorInfo;
						}
						else {
							echo "Mailtje verzonden!";
						}


						echo "<script>$( \"#myPopupDiv\" ).popup( \"open\" )</script>";

						mysqli_close($mysql) or die("Het verbreken van de verbinding met de MySQL-server is mislukt!");
						$_SESSION["emailed"] = true;

						//header('Location: main.php ');



						}
						else {
							echo '<script type="text/javascript">alert("Op dit leerlingnummer bestaat geen een account!");</script>';
						}
				}









		?>

		<form action="login.php">
		<input type="submit" id="login" value="Terug naar inloggen" />
		</form>

		</div>
		</div>

		<div data-role="footer">
			<h4>BeroepenTinder Fioretti College</h4>
		</div><!-- /footer -->
	</body>
</html>
