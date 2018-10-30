<!DOCTYPE html>
<html>
<head>
	<?php
	include "./core/functions.php";
    include "./core/database.php";
	error_reporting(-1);
  	ini_set('display_errors', 'On');
  

	?>
	<link href="./style/style.css" rel="stylesheet" type="text/css" media="all"/>
	<title>Insta-Food</title>
</head>
<body>
  
  <h3>Account informatie aanpassen</h3>
  <form action="accountaanpassen.php" method="post">
  	Gebruikersnaam: <input type="text" name="gebruikersnaam"><br>
  	Wachtwoord: <input type="text" name="wachtwoord"><br>
  	E-mailadres: <input type="text" name="email"><br>
    <input type="submit" name="submit" value="Gegevens wijzigen"><br>
  </form>


  <?php
 
  if (isset($_POST["submit"])){
    $username = $_POST["gebruikersnaam"];
    $password = $_POST["wachtwoord"];
    $email = $_POST["email"];
    $query = "UPDATE users SET username = '$username', password = '$password', email = '$email'";
    mysqli_query($db,$query);
    echo ($username . " " . $password . " " . $email);
  }
	
		mysqli_close($db);
	 ?>
</body>
</html>