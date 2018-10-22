<?php

function randstring($length = 10) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}
function genusers($amount = 5) {
  include "database.php";
  for ($i=0; $i < $amount; $i++) {
    $username = randstring(5);
    $password = randstring(5);
    $email = randstring(5)."@".randstring(3).".com";
    $query4 = "INSERT INTO users (username,password,email,level) VALUES ('$username','$password','$email',1);";
    mysqli_query($db,$query4) or die (mysqli_error($db));
  }
}
function genposts($amount = 2) {
  include "database.php";
  for ($i=0; $i < $amount; $i++) {
    $array2 = mysqli_query($db,"SELECT * FROM users;") or die (mysqli_error($db));
    while ($row = mysqli_fetch_assoc($array2)) {
      $z = rand(1,100);
      $id = $row["id"];
      $query3 = "INSERT INTO posts (photodata,recipe,users_id) VALUES ('./data/testuser/img/600x500.png','Recept nummer $z',$id);";
      mysqli_query($db,$query3) or die (mysqli_error($db));
    }
  }
}
function gencontent($amount = 1) {
  for ($i=0; $i < $amount; $i++) {
    genusers();
    genposts();
  }
}
?>
