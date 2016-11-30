<!DOCTYPE html>
<?php
if ($_SESSION['logged_in'] = true) {

}
else {
  header('Refresh: 0; url=index.php');
}
 ?>

<html>
  <head>
    <link rel="stylesheet" type="text/css" href="style.css">

    <?php
      session_start();
      $server = "localhost";
      $user = "beroepentinder";
      $pass = "Beroepen123Tinder";
      $db = "beroepentinder";

      // Hier wordt connectie gemaakt met de database
      $mysql = mysqli_connect($server,$user,$pass,$db) or die("Fout 1: Er is geen verbinding met de MySQL-server tot stand gebracht!");
      $Lernaam = $_SESSION['sLernaam'];
      $resultaten = mysqli_query($mysql,"SELECT * FROM Leerlingen WHERE Mentor_afkorting = '$Lernaam' ") or die("De selectquery op de database is mislukt!");

      // Hier wordt de connectie met de database weer verbroken
      mysqli_close($mysql) or die("Het verbreken van de verbinding met de MySQL-server is mislukt!");
    ?>

  </head>

  <main>
    <p>Resultaten van je leerlingen!</p>

    <table>
  <tr>
    <th>Leerlingnummer</th>
    <th>Naam</th>
    <th>Sector</th>
    <th>Datum van test gedaan</th>
  </tr>
  <?php
				  //resultaten laden voor leraar
				  while(list($leerlingnummer, $leerlingvoornaam, $leerlingtussenvoegsel, $leerlingachernaam, $leerlingsector, $leerlingdatum) = mysqli_fetch_row($resultaten))
				  {
					$leerlinghelenaam = "$leerlingvoornaam $leerlingtussenvoegsel $leerlingachernaam";
					echo"<tr><td>$leerlingnummer</td><td>$leerlinghelenaam</td><td>$leerlingsector</td><td>$leerlingdatum</td></tr>\n";
				   }
				?>
    </table>
  </main>
</html>
