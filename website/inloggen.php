<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="style.css">

    <?php
      session_start();
      $server = "localhost";
      $user = "beroepentinder"; //vul hier jouw gebruikersnaam in (leerlingnummer)
      $pass = "Beroepen123Tinder"; //vul hier jouw wachtwoord in (database1)
      $db = "beroepentinder"; //vul hier de naam van jouw database in (leerlingnummer)

      // Hier wordt connectie gemaakt met de database
      $mysql = mysqli_connect($server,$user,$pass,$db) or die("Fout 1: Er is geen verbinding met de MySQL-server tot stand gebracht!");

      // Hier wordt de connectie met de database weer verbroken
      mysqli_close($mysql) or die("Het verbreken van de verbinding met de MySQL-server is mislukt!");



    ?>

  </head>
  <main>
  <div id="inlogsysteem">

    <?php
    // connectie maken met de server
			$mysql = mysqli_connect($server,$user,$pass,$db) or die("Fout 2: Er is geen verbinding met de MySQL-server tot stand gebracht!");

			if(isset($_POST['lernaam'], $_POST['lerww']))
			{
				// Beveiligen
				$sLernaam = mysqli_real_escape_string($mysql, $_POST['lernaam']);
				$sLerww = mysqli_real_escape_string($mysql, $_POST['lerww']);
				// Checken of wachtwoord klopt met gebruikersnaam
				$sWachtwoordControle = mysqli_query($mysql, "SELECT * FROM Leraargegevens WHERE lernaam='$sLernaam' AND lerww='$sLerww' ") or die("De selectquery op de database is mislukt!");
				$count=mysqli_num_rows($sWachtwoordControle);

				if($count == 1)
				{
					// Wachtwoord en gebruikersnaam zijn juist, dus status updaten
					$_SESSION['logged_in'] = true;
					$_SESSION['sLernaam'] = $sLernaam;

					// Klant doorsturen naar de hoofdpagina
					header('Refresh: 1; url=resultaten.php');
					echo "U bent succesvol ingelogd!";

				}
				// Als gebruikersnaam en wachtwoord niet goed zijn
				else
				{
					//Foutmelding geven
					echo 'Deze combinatie van gebruikersnaam en wachtwoord is niet juist!';
				}
			}
			else
			{
			  echo 'Vul je gegevens in om in te loggen.';
			}

			// Hier wordt de connectie met de database weer verbroken
			mysqli_close($mysql) or die("Het verbreken van de verbinding met de MySQL-server is mislukt!");

     ?>
    <form action="inloggen.php" method="post">
      <p>Uw leraarafkorting</p>
      <input type="text" name="lernaam" value="3 letterige code">

      <p>Uw wachtwoord</p>
      <input type="text" name="lerww" value="Wachtwoord">
      <br><br>
      <input type="submit" value="Inloggen">
    </form>
  </div>
  </main>
</html>
