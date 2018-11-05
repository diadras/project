<!DOCTYPE html>
<html>
<head>
	<?php
	  include "./core/functions.php";
    include "./core/database.php";
    include "./core/loggedin.php";
	  error_reporting(-1);
  	ini_set('display_errors', 'On');


	?>
	<link href="./style/style.css" rel="stylesheet" type="text/css" media="all"/>
	<title>Insta-Food</title>
</head>
<body>

  
  <form action="accountaanpassen.php" method="post">
    <table>
      <th>Account informatie aanpassen</th>
  	<tr><td>Gebruikersnaam:</td><td> <input type="text" name="gebruikersnaam"></td></tr><br>
  	<tr><td>Wachtwoord:</td><td> <input type="password" name="wachtwoord"></td></tr><br>
  	<tr><td>E-mailadres:</td><td> <input type="text" name="email"></td></tr><br>
  </table>
  <input type="submit" name="submit" value="Gegevens wijzigen"><br>
  </form>


  <?php
 
  if (isset($_POST["submit"])){
    $error_msg ="";
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