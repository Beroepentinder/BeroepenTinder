<!DOCTYPE html>
<?php
session_start();
if ($_SESSION['logged_in_beheerder'] = "true") {

}
else {
  header('Refresh: 0; url=index.php');
}
 ?>

<html>
  <head>
    <link rel="stylesheet" type="text/css" href="style.css"></link>
	<link rel="icon" href="faviconvlamtr.gif" type="image/gif" >
	
	
  </head>
 
  <main>
  
  <div id="Foutmelding_beheerder">
  <?php
      
      $server = "localhost";
      $user = "beroepentinder";
      $pass = "Beroepen123Tinder";
      $db = "beroepentinder";

      // Hier wordt connectie gemaakt met de database
      $mysql = mysqli_connect($server,$user,$pass,$db) or die("Fout 1: Er is geen verbinding met de MySQL-server tot stand gebracht!");
	  //$beheernaam = $_SESSION['sBeheernaam']; weghalen
      

	  
	  if(isset($_POST['lernaam_nieuw'], $_POST['lerww_nieuw'])) {
		  
		// Beveiligen
				$sLernaam_nieuw = mysqli_real_escape_string($mysql, $_POST['lernaam_nieuw']);
				$sLerww_nieuw = mysqli_real_escape_string($mysql, $_POST['lerww_nieuw']);  
	  //controleren of leraar al bestaat
	  $LeraarControle = mysqli_query($mysql, "SELECT * FROM Leraargegevens WHERE Mentor_afkorting='$sLernaam_nieuw'") or die("De selectquery op de database is mislukt!");
	  $count=mysqli_num_rows($LeraarControle);
				if($count >= 1)
				{
	 echo 'Deze docent staat al in de database!'; //de docent bestaat al
	 }
	 else{
	$query = "INSERT INTO Leraargegevens (Mentor_afkorting, lerww) VALUES ('$sLernaam_nieuw', '$sLerww_nieuw')";	 
	mysqli_query($mysql,$query);	 
	  }}
	  
	  $resultaten = mysqli_query($mysql,"SELECT * FROM Leraargegevens") or die("De selectquery op de database is mislukt!");
	  
      // Hier wordt de connectie met de database weer verbroken
      mysqli_close($mysql) or die("Het verbreken van de verbinding met de MySQL-server is mislukt!");
    ?>
	</div>
	
  <p id="Beheerder_titel" STYLE="font-size: 35pt;">Beheerder</p>
  <IMG id="Achtergrond_docenten" SRC="http://www.beroepentinder.fiorettileerling.nl/websiteLeraren/Achtergrond_docenten.png">
  <a href="http://www.beroepentinder.fiorettileerling.nl/websiteLeraren/inloggen_beheerder.php"><IMG id="Uitlogknop" SRC="http://www.beroepentinder.fiorettileerling.nl/websiteLeraren/Uitloggen.png"></a>
  <p id="Uitlogknop_titel" STYLE="font-size: 20pt;"><b>Uitloggen</b></p>
  <p id="rectangle" style="border:7px solid #000;"></p>
  
    <div id="Beheerder_tabel_titel" STYLE="font-size: 15pt;"><b>Geregistreerde docenten</b></div>
	<table id="tabel_beheerder">
	
	
  <tr>
    <th>Leraarafkorting</th>
	<th>Wachtwoord</th>
  </tr>
  <?php
				  //resultaten laden voor beheerder
				  while(list($leraarafkorting, $Wachtwoord) = mysqli_fetch_row($resultaten))
				  {
					echo"<tr><td>$leraarafkorting</td><td>$Wachtwoord</td></tr>\n";
				  }
				?>
				</table>
				
	</br>			
	
	<div id="aanmaaksysteem_beheerder">
	<form action="Beheerder.php" method="post">
		
		<p STYLE="font-size: 15pt;"><b>Voeg nieuwe docent toe</b></p>
      <p>Leraarafkorting: &nbsp;&nbsp;<input type="text" name="lernaam_nieuw" value="" autocorrect=off></p>
      <p>&nbsp;&nbsp;&nbsp;&nbsp;Wachtwoord: &nbsp;&nbsp;<input name="lerww_nieuw" value="" autocorrect=off></p> 
	  
	  </br>
	  
	  <input type="submit" value="Voeg toe">
	  </form>
	  </div>
	  <div id="structuur_beheerder">
	  </div>
	  
	  

  </main>
</html>
