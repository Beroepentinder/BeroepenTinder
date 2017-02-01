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
			header('Location: mainloggedin.php ');
			die();
		}
		else {

		}
	?>

</head>
<body>

<div data-role="page">

	<div data-role="header" data-position="fixed">
		<h1>Welkom</h1>
	</div>

	<div role="main" class="ui-content">

		<form action="login.php">
		<input type="submit" value="Klik hier om in te loggen" />
		</form>

		<form action="RegistrerenLeerlingen.php">
		<input type="submit" value="Registreer jezelf!" />
		</form>
	</div>

	<div data-role="footer" data-position="fixed">
		<h4>BeroepenTinder Fioretti College</h4>
	</div><!-- /footer -->
</div><!-- /page -->

</body>
</html>
