<?php
session_start();
$server = "localhost";
$user = "beroepentinder"; //vul hier jouw gebruikersnaam in (leerlingnummer)
$pass = "Beroepen123Tinder"; //vul hier jouw wachtwoord in (database1)
$db = "beroepentinder"; //vul hier de naam van jouw database in (leerlingnummer)

// Hier wordt connectie gemaakt met de database
$mysql = mysqli_connect($server,$user,$pass,$db) or die("Fout: Er is geen verbinding met de MySQL-server tot stand gebracht!");
	


// Hier wordt de connectie met de database weer verbroken
mysqli_close($mysql) or die("Het verbreken van de verbinding met de MySQL-server is mislukt!");

if (isset($_SESSION['logged_in'])) {
	
}
else {
	header("Location: main.php");
}

$dirname = "Images/";
			$images = glob($dirname."*");
			//aantal plaatjes wordt geteld
			$filecount = 0;
			if ($images){
			 $filecount = count($images);
			}
?>


<!DOCTYPE html>
<html>
<head>
	<style>
		p {
			padding: 30px;
		}
		
		
		img {
			width: 100%;
			height: 350px;
			position: absolute;
			display: block;
			margin: auto;
			left: 0; 
			z-index:100;
		} 
	</style>
	
	
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
	<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
		
	
		
		 
	<script>	
	
	$(document).on("pagecreate","#pageone",function(){
	  var AcceptedArray = new Array();
	  var imagecount = <?php echo json_encode("$filecount"); ?>;
	  
	  <!--Rechter met animatie, dus wel gekozen-->
	  $("img").on("swiperight",function(){
		imagecount--;
		
	    src = $(this).attr('src'); // "static/images/banner/blue.jpg"
	    tarr = src.split('/');      // ["static","images","banner","blue.jpg"]
	    file = tarr[tarr.length-1]; // "blue.jpg"
	    data = file.split('.')[0];  // "blue"	
		
		AcceptedArray.push(data);
		
		$(this).animate(
			{
				left: "500px",
				display: "none"
				
			}
		);
		$(this).fadeOut(); 
		
		if (imagecount == 0) {
			
			setTimeout(function(){window.location.href = "verstuurd.php?gegevens=" + AcceptedArray;} , 1000); 
		}
		
	  });
	  
	  <!--Linkerswipe met animatie, dus niet gekozen-->
	  $("img").on("swipeleft",function(){
		
		imagecount--;
		
		$(this).animate(
			{
				left: "-500px",
				display: "none"
				
			}
		);
		$(this).fadeOut();
		
		if (imagecount == 0) {
			setTimeout(function(){window.location.href = "verstuurd.php?gegevens=" + AcceptedArray;} , 1000); 
	    }
		
	  });
	});
	
	</script>
</head>
<body>

<div data-role="page" id="pageone" data-position="fixed">
  <div data-role="header">
    <h1>Test 1</h1>
  </div>

  <div data-role="main" class="ui-content">
    
	<div id="tekst">
		<p>Swipe links voor niet, rechts voor wel!</p>
	</div>
	
	<div id="images">
		<?php
			//plaatjes worden ingeladen
			shuffle($images);
			foreach($images as $image) {
				echo '<img src="'.$image.'">';
			}	
		?>
		
	</div>
  
	<div>
	
	</div>
  </div>

  <div data-role="footer" data-position="fixed">
  </div>
</div> 

</body>
</html>