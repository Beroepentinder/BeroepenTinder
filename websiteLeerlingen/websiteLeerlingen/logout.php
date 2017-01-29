<!DOCTYPE html>
<html>
<head> 
	<title>Page Title</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
	<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	
	<?php
		session_start();
		session_destroy(); 
	?>
</head>
<body>

<div data-role="page">

	<div data-role="header" data-position="fixed">
		<h1>Welkom</h1>
	</div>

	<div role="main" class="ui-content">
		
	</div>

	<div data-role="footer" data-position="fixed">
		<h4>Page Footer</h4>
	</div><!-- /footer -->
</div><!-- /page -->

</body>
</html>