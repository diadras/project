<!DOCTYPE html>
<html>
<head>
	<?php
	  include "./core/functions.php";
    include "./core/database.php";
    loggedin();
	  error_reporting(-1);
  	ini_set('display_errors', 'On');
	?>
	<link href="./style/style.css" rel="stylesheet" type="text/css" media="all"/>
	<title>Insta-Food</title>
</head>
<body>
  <div class = "header">
    <a href = "./instafood.php">
		  <img src="./img/Logo.png" style=" height: 40px" title="Instafood"/>
    </a>
    <div class="buttons">
      <button name="logout" onclick="<?php signout(); ?>"> logout </button>
      <button name="post" onclick="window.location.href='./post.php'"> post </button>
    </div>
  </div>
   <br><br><br><br>
  <div class="account">
  <form method="post">
     Edit account information
    <table>
  	<tr><td>New username:</td><td> <input type="text" name="gebruikersnaam"></td></tr><br>
  	<tr><td>New password:</td><td> <input type="password" name="wachtwoord"></td></tr><br>
    <tr><td>Repeat password:</td><td> <input type="password" name="wachtwoord2"></td></tr><br>
  	<tr><td>New e-mail:</td><td> <input type="text" name="email"></td></tr><br>
  </table><br>
  <input type="submit" name="submit" value="Edit information"><br>
  </form>


  <?php

    if (isset($_POST["submit"])){

      $error_msg ="";
      $curuser = $_SESSION['logged'];
      $username = test_input($_POST["gebruikersnaam"]);
      $password = test_input($_POST["wachtwoord"]);
      $password2 = test_input($_POST["wachtwoord2"]);
      $email = test_input($_POST["email"]);

      if(!empty($username)){
        if (strlen($username)<2){
          $error_msg .= "<li> Vul een gebruikersnaam in. </li>";
        } else{
          $queryuser = "UPDATE users SET username = '$username' WHERE username = '$curuser'";
          mysqli_query($db,$queryuser) or die (mysqli_error($db));
        }
      }

      if (!empty($password || $password2)){
        //zijn de wachtwoorden het zelfde
        if ($password != $password){
          $error_msg .= "<li> Wacthwoorden zijn niet het zelfde. </li>";
        }
        //bstaat het wachtwoordt uit meer dan 4 karakters
        elseif (strlen($password)<4){
          $error_msg .= "<li> Het wachtwoord moet uit minstens 4 tekens bestaan! </li>";
        } else{
          $querypass = "UPDATE users SET password = '$password' WHERE username = '$curuser'";
          mysqli_query($db,$querypass) or die (mysqli_error($db));
        }
      }


      if(!empty($email)){
        //geldig email
        if(!preg_match("/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,4})$/",$email)) {
          $error_msg.="<li> Vul een geldig e-mailadres in. </li>";
        }else{
          $querypass = "UPDATE users SET email = '$email' WHERE username = '$curuser'";
          mysqli_query($db,$querypass) or die (mysqli_error($db));
        }
      }
      else
      if (strlen($error_msg) > 0){
        echo("<span class=\"error\">" . $error_msg . "</span>");
      } else{
        $_SESSION['logged'] = $username;
        header("location: " . "./instafood.php");
      }
    }

    mysqli_close($db);
	?>
  </div>
</body>
</html>
