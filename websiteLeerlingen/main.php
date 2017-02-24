<!DOCTYPE html>
<html>
<head>
    <!-- main.php -->
	<link rel="stylesheet" type="text/css" href="style.css"></link>
	<link rel="icon" href="faviconvlamtr.gif" type="image/gif" >

	<link rel="stylesheet" href="css/themes/mytheme.css" />
	<link rel="stylesheet" href="css/themes/jquery.mobile.icons.min.css" />

	<title>BeroepenTinder</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
	<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	<script src="https://npmcdn.com/imagesloaded@4.1/imagesloaded.pkgd.min.js"></script>

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
		<input type="submit" id="login" value="Klik hier om in te loggen" />
		</form>

		<form action="RegistrerenLeerlingen.php">
		<input type="submit" value="Registreer jezelf!" />
		</form>

		<?php
		//	if (isset($_SESSION["emailed"])) {
		//		echo "<script>alert(\"Check je schoolmail om je wachtwoord in te stellen!</script>\");"
		//		unset($_SESSION["emailed"]);
		//	}
		//	else



		?>

	</div>

	<div data-role="footer" data-position="fixed">
		<h4>BeroepenTinder Fioretti College</h4>
	</div><!-- /footer -->
</div><!-- /page -->

</body>
</html>
