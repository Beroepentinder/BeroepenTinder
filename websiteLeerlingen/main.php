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
	
	
</head>
<body>

<div data-role="page">

	<div data-role="header" data-position="fixed">
		<h1>Welkom</h1>
	</div>

	<div role="main" class="ui-content">
		<a href="RegistrerenLeerlingen.php">Nieuw hier?</a><br><br>
		<a href="index.php">De test doen?</a><br><br>
		<?php
		if (isset($_SESSION['logged_in'])) {
			echo "<a href=\"logout.php\">Uitloggen?</a>";
		}
		else {
			echo"<a href=\"login.php\">Inloggen?</a>";
		}
		?>
		
		<?php 
				//if (mail('LennardvanderPlas@Fiorettileerling.nl', 'Hello darknes my old friend!', 'if its 2017 my plan worked!') == true)
				//{
				//	echo "it workededed";
				//}
		?> 
	</div>

	<div data-role="footer" data-position="fixed">
		<h4>Page Footer</h4>
	</div><!-- /footer -->
</div><!-- /page -->

</body>
</html>
