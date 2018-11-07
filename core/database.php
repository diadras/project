<?php
  $db = mysqli_connect("localhost", "root", "", "project");
  // Test of de verbinding werkt
  if (mysqli_connect_errno()) {
  die("De verbinding met de database is mislukt: " .
  mysqli_connect_error() . " (" .
  mysqli_connect_errno() . ")" );
}
?>
