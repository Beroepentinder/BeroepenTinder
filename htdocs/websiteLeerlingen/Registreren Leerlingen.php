<!DOCTYPE html>
<html>
<head></head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
	<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>

<body>

<table border='0' width='480px' cellpadding='0' cellspacing='0' align='center'>
	<center><tr>
	   <td><h3>Registreer je voor de Beroepentinder</h3></td>
	</tr>

	<table border='0' width='480px' cellpadding='0' cellspacing='0' align='center'>
		<tr>
		<center>
		<p>* is een verplicht vak</p>
		<tr>
			<td align='center'>Leerlingnummer*:</td>
			<td><input type='text' id="Leerlingnummer" required></td>
		</tr>
		<tr>
			<td align='center'>Voornaam*:</td>
			<td><input type='text' required></td>
		</tr>
		<tr>
			<td align='center'>Tussenvoegsel:</td>
			<td><input type='text' required></td>
		</tr>
		<tr>
			<td align='center'>Achternaam*:</td>
			<td><input type='text' required></td>
			<td>
		</tr>
		<tr>
			<td align='center'>Wachtwoord*:</td>
			<td><input type='password' id="txtNewPassword" required></td>
		</tr>
		<tr>
			<td align='center'>Herhaal Wachtwoord*:</td>
			<td><input type='password' id="txtConfirmPassword" onChange="checkPasswordMatch();" required></td>
			<td>
			</div>
			<div class="registrationFormAlert" id="divCheckPasswordMatch">
			</div>
			<script>
				function checkPasswordMatch() {
				var password = $("#txtNewPassword").val();
				var confirmPassword = $("#txtConfirmPassword").val();
				if (password != confirmPassword){
				$("#divCheckPasswordMatch").html("Wachtwoorden zijn niet hetzelfde!");}

					else {
					$("#divCheckPasswordMatch").html("Wachtwoorden zijn hetzelfde.");}
					}

					$(document).ready(function () {
					$("#txtConfirmPassword").keyup(checkPasswordMatch);
					});
			</script>
			</td>
		</tr>
			<table border='0' cellpadding='0' cellspacing='0' width='480px' align='center'>

				<tr>
					<td align='center'><input type='submit' name='REGISTER' value="Registreer"></td>
				</tr>
				<center>

			</table>

	</table>

</table>
</body>
</html>
