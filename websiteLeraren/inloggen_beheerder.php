<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="style.css"></link>
	<link rel="icon" href="faviconvlamtr.gif" type="image/gif" >
    <?php
      session_start();
	  
		
			  $_SESSION['logged_in_beheerder'] = "false";
			  
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
  <p id="rectangle" style="border:2px solid #000;"></p>
  
    <h1 id= "titel" STYLE="font-size: 40pt;">Beroepen Tinder</h1>
  <p id= "ondertitel" STYLE="font-size: 25pt;">Fioretti college</p>
<p id= "inlogtekst_docent" STYLE="font-size: 20pt;">Beheerder</p>
 <a href="http://www.beroepentinder.fiorettileerling.nl/websiteLeraren/inloggen.php"><p id= "inlogtekst_beheerder" STYLE="font-size: 14pt;">Terug naar docenten</p></a>
  
  <div id="Foutmelding_inloggen" >
    <?php
    // connectie maken met de server
			$mysql = mysqli_connect($server,$user,$pass,$db) or die("Fout 2: Er is geen verbinding met de MySQL-server tot stand gebracht!");
			if(isset($_POST['Beheernaam'], $_POST['BeheerWW']))
			{
				// Beveiligen
				$Beheernaam = mysqli_real_escape_string($mysql, $_POST['Beheernaam']);
				$BeheerWW = mysqli_real_escape_string($mysql, $_POST['BeheerWW']);
				// Checken of wachtwoord klopt met gebruikersnaam
				$sWachtwoordControle = mysqli_query($mysql, "SELECT * FROM Beheerders WHERE BeheerderAfkorting='$Beheernaam' AND BeheerderWachtwoord='$BeheerWW' ") or die("De selectquery op de database is mislukt!");
				$count=mysqli_num_rows($sWachtwoordControle);
				if($count == 1)
				{
					// Wachtwoord en gebruikersnaam zijn juist, dus status updaten
					$_SESSION['logged_in_beheerder'] = "true";
					$_SESSION['sBeheerdernaam'] = $Beheernaam;
					// Klant doorsturen naar de hoofdpagina
					header('Refresh: 0; url=Beheerder.php');
					
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
    <form action="inloggen_beheerder.php" method="post">
      <p>Leraarafkorting: &nbsp;&nbsp;<input type="text" name="Beheernaam" value="" autocorrect=off></p>
      <p>&nbsp;&nbsp;&nbsp;&nbsp;Wachtwoord: &nbsp;&nbsp;<input name="BeheerWW" value="" autocorrect=off type="password" ></p> <!--&nbsp; is een spatie-->
      


	  </br>
      <input type="submit" value="Inloggen"> 
    </form>	
	</div>
	
  </div>
  </main>
</html>
