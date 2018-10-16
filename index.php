<!DOCTYPE html>
<html>
<head>
	<link href="style/style.css" rel="stylesheet" type="text/css" media="all"/>
	<title>Insta-Food</title>
</head>
<body>
  <h3>Testdata</h3>
  <?php
    include "core/database.php";

		$query = 'SELECT * FROM project.users;';
    $array = mysqli_query($db,$query) or die("error");

    while ($row = mysqli_fetch_assoc($array)) {
      echo ("<img src=");
    }
   ?>
</body>
</html>

<!--
##############################################
## Data die aan het database is toegevoegd: ##
##############################################
  users:
INSERT INTO users (username,password,email,level) VALUES ('testuser','testpass','test@gmail.com',1);
INSERT INTO users (ID,username,password,email,level) VALUES (1,'barrie','badslipper','barrie@badslipper.nl',9001);

  posts
[SQL querie]

  category
[SQL querie]

  hashtags
[SQL querie]

  message
[SQL querie]

##############################################
###### PHP voor printen userdata in body #####
##############################################
$query = 'SELECT * FROM project.users;';
$array = mysqli_query($db,$query) or die("error");

while ($row = mysqli_fetch_assoc($array)) {
  echo ("<h3>Gebruiker ".$row["id"]."</h3>");
  echo ("ID = ".$row["id"]."<p>");
  echo ("Username = ".$row["username"]."<p>");
  echo ("Password = ".$row["password"]."<p>");
  echo ("Email = ".$row["email"]."<p>");
  echo ("Level = ".$row["level"]."<p>");
}

-->
