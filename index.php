<!DOCTYPE html>
<html>
<head>
	<link href="./style/style.css" rel="stylesheet" type="text/css" media="all"/>
	<title>Insta-Food</title>
</head>
<body>
  <h3>Testdata</h3>
  <?php
    include "./core/database.php";
		$query = "SELECT photodata, recipe, username FROM posts JOIN users USING (id);";
		$array = mysqli_query($db,$query) or die("error");

    while ($row = mysqli_fetch_assoc($array)) {
      echo ("<img src=\"".$row["photodata"]."\"/><p>");
			echo ("Recept: ".$row["recipe"]."<p>");
			// ucfirst() zorgt voor uppercase i.v.m. naam van user
			echo ("Eigenaar: ".ucfirst($row["username"])."<p>");
    }
		mysqli_close($db);
	 ?>
</body>
</html>

<!--
##############################################
## Data die aan het database is toegevoegd: ##
##############################################
  users:
INSERT INTO users (username,password,email,level) VALUES ('testuser','testpass','test@gmail.com',1);
INSERT INTO users (username,password,email,level) VALUES ('barrie','badslipper','barrie@badslipper.nl',9001);

  posts
INSERT INTO posts (photodata,recipe,gebruikers_id) VALUES ('./data/testuser/img/600x500.png','Nog geen recept','1');

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
  echo ("<h3>gebruikers ".$row["id"]."</h3>");
  echo ("ID = ".$row["id"]."<p>");
  echo ("Username = ".$row["username"]."<p>");
  echo ("Password = ".$row["password"]."<p>");
  echo ("Email = ".$row["email"]."<p>");
  echo ("Level = ".$row["level"]."<p>");
}

-->
