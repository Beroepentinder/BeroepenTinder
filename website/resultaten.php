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
  </head>

  <main>
    <p>Resultaten van je leerlingen!</p>
  </main>
</html>
