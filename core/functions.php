<?php
function randstring($length = 10) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $characterslength = strlen($characters);
  $randomstring = '';
  for ($i = 0; $i < $length; $i++) {
      $randomstring .= $characters[rand(0, $characterslength - 1)];
  }
  return $randomstring;
}
function genusers($amount = 5) {
  include "database.php";
  $result = ("Generating users:</br>");
  for ($i=0; $i < $amount; $i++) {
    $username = randstring(5);
    $password = randstring(5);
    $email = randstring(5)."@".randstring(3).".com";
    $query4 = "INSERT INTO users (username,password,email,level) VALUES ('$username','$password','$email',1);";
    mysqli_query($db,$query4) or die (mysqli_error($db));
    $result .= ("Username: $username</br>");
  }
  return $result;
}
function genposts($amount = 2) {
  include "database.php";
  $result = ("Generating posts:</br>");
  for ($i=0; $i < $amount; $i++) {
    $array2 = mysqli_query($db,"SELECT * FROM users;") or die (mysqli_error($db));
    while ($row = mysqli_fetch_assoc($array2)) {
      $z = rand(1,100);
      $id = $row["id"];
      $username = $row["username"];
      $query3 = "INSERT INTO posts (photodata,recipe,users_id) VALUES ('./data/testuser/img/600x500.png','Recept nummer $z',$id);";
      mysqli_query($db,$query3) or die (mysqli_error($db));
      $result .= ("Username: $username Recipe: $z</br>");
    }
  }
  return $result;
}
function gencontent($amount = 1) {
  $result = "";
  for ($i=0; $i < $amount; $i++) {

    genposts();
    $result .= genusers();
    $result .= genposts();
  }
  return $result;
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data = str_replace("'","",$data); // houdt sql injecties tegen
  return $data;
}
function genpassword(){
  $wachtwoord = array();

		for ($i=0; $i < 2; $i++) {
			$special = mt_rand(33,47);
			array_push($wachtwoord, chr($special));
		}

		for ($i=0; $i < 5; $i++) {
			$klein = mt_rand(97,122);
			array_push($wachtwoord, chr($klein));
		}
		for ($i=0; $i < 3; $i++) {
			$cijfer = mt_rand(48,57);
			array_push($wachtwoord, chr($cijfer));
		}

		$hoofd = mt_rand(65,90);
		array_push($wachtwoord, chr($hoofd));

		shuffle($wachtwoord);
		$wachtwoord = implode("",$wachtwoord);
		return $wachtwoord;
}
function loggedin(){
  session_start();
    if (empty($_SESSION['logged']) && $_SERVER['PHP_SELF'] != '/project/index.php' ){
        header("location: "."./index.php");
    }
    elseif(!empty($_SESSION['logged']) && $_SERVER['PHP_SELF'] != '/project/instafood.php'){
			header("location: " . "./instafood.php");
		}
}
function signout(){
  session_start();
   if(session_destroy()) {
      header("Location:" . "./index.php");
   }
}
function isadmin();
$username = $_SESSION['logged'];
$query = "SELECT `username`,`level` FROM `users` WHERE `username` = '$username' AND `level` = 1";
$result = mysqli_query($db,$query);
if (mysqli_num_rows($result) == 1){
  echo("welcome Admin " . $username);
} else {
  header("location: " . "./index.php");
}
?>
