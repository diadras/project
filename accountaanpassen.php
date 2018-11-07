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
  <div class = "header">
    <a href = "./instafood.php">
		  <img src="./img/Logo.jpeg" style=" height: 100px" title="Instafood"/>
    </a>    
    <div class="buttons">    
      <form method="POST">
        <button name="post" style="color: black;"> post </button>
          <br>
        <button name="logout" style="color: black;"> logout </button>
      </form>    
    </div> 
  </div>

  <div class="account">
  <form method="post">
    <table>
      <th>Account informatie aanpassen</th>
  	<tr><td>Nieuwe Gebruikersnaam:</td><td> <input type="text" name="gebruikersnaam"></td></tr><br>
  	<tr><td>Nieuwe Wachtwoord:</td><td> <input type="password" name="wachtwoord"></td></tr><br>
    <tr><td>Herhaal Wachtwoord:</td><td> <input type="password" name="wachtwoord2"></td></tr><br>
  	<tr><td>Nieuwe E-mailadres:</td><td> <input type="text" name="email"></td></tr><br>
  </table>
  <input type="submit" name="submit" value="Gegevens wijzigen"><br>
  </form>


  <?php
     
    if (isset($_POST["submit"])){
      
      $error_msg ="";
      $curuser = $_SESSION['logged'];
      $username = $_POST["gebruikersnaam"];
      $password = $_POST["wachtwoord"];
      $password2 = $_POST["wachtwoord2"];
      $email = $_POST["email"];
      
      if(strlen($username)<2){
        $error_msg.="<li >Vul een gebruikersnaam in. </li>";
      }

      if(empty($password || $password2)){
        $error_msg.="<li>Vul een wachtwoord in. </li>";
      }elseif(strlen($password)<4){
        $error_msg.="<li >Het wachtwoord moet uit minstens 4 tekens bestaan! </li>";
      }

      if ($password != $password){
        $error_msg .= "Wacthwoorden zijn niet het zelfde."."<br>";
      }

      if(empty($email)){
        $error_msg.="<li class=\"formerror\">Vul een e-mailadres in. </li>";
      }
      elseif(!preg_match("/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,4})$/",$email)) {
        $error_msg.="<li class=\"formerror\">Vul een geldig e-mailadres in. </li>";
      }
      if (strlen($error_msg) > 0){
        echo("<span class=\"error\">" . $error_msg . "</span>");
      }
      else{
        $query = "UPDATE users SET username = '$username', password = '$password', email = '$email' WHERE username = '$curuser' ";
        mysqli_query($db,$query) or die (mysqli_error($db));
        
        $_SESSION['logged'] = $username;
        header("location: " . "./instafood.php");
      }
    }
    
    mysqli_close($db);
  
    if(isset($_POST['post'])){
      header("location: "."./post.php");
    }
    if(isset($_POST['logout'])){
      header("location: "."./logout.php");
    }  
	?>
  </div>
</body>
</html>