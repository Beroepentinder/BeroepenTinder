<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="style.css"></link>
	<link rel="icon" href="faviconvlamtr.gif" type="image/gif" >
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
 
<IMG id="Achtergrond_docenten" SRC="http://www.beroepentinder.fiorettileerling.nl/websiteLeraren/Achtergrond_docenten.png">
  <p id="rectangle"></p>
  
    <h1 id= "titel" STYLE="font-size: 40pt;">Beroepen Tinder</h1>
  <p id= "ondertitel" STYLE="font-size: 25pt;">Fioretti college</p>
  <a href="http://www.beroepentinder.fiorettileerling.nl/websiteLeraren/inloggen_beheerder.php"><p id= "inlogtekst_beheerder" STYLE="font-size: 14pt;">Klik hier om als beheerder in te loggen</p></a>
  <p id= "inlogtekst_docent" STYLE="font-size: 20pt;">Docent</p>
  
  <div id="Foutmelding_inloggen" >
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
					header('Refresh: 0; url=resultaten.php');
					
				}
				// Als gebruikersnaam en wachtwoord niet goed zijn
				else
				{
					//Foutmelding geven
					echo 'Deze combinatie van gebruikersnaam en wachtwoord is niet juist!';
				}
			}
			
			// Hier wordt de connectie met de database weer verbroken
			mysqli_close($mysql) or die("Het verbreken van de verbinding met de MySQL-server is mislukt!");
     ?>
	
</div>








	
	<div id="Inlogsysteem" >
    <form action="inloggen.php" method="post">
      <p>Leraarafkorting: &nbsp;&nbsp;<input type="text" name="lernaam" value="" autocorrect=off></p>
      <p>&nbsp;&nbsp;&nbsp;&nbsp;Wachtwoord: &nbsp;&nbsp;<input name="lerww" value="" autocorrect=off type="password" ></p> <!--&nbsp; is een spatie-->
      


	  </br>
      <input type="submit" value="Inloggen">  <!-- Ik verander deze later in een afbeelding, dat is mooier-->
    </form>	
	</div>
	
  </div>
  </main>
</html>