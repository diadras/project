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
?>
