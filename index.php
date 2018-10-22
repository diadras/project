<!DOCTYPE html>
<html>
<head>
	<?php
		include "./core/functions.php";
    include "./core/database.php";
	?>
	<link href="./style/style.css" rel="stylesheet" type="text/css" media="all"/>
	<title>Insta-Food</title>
</head>
<body>
  <h3>Testdata</h3>
  <?php
		$db = mysqli_connect("localhost", "root", "root", "project");
		$query = "SELECT p.id, p.photodata, p.recipe, u.id, u.username FROM posts p JOIN users u ON p.users_id = u.id ORDER BY p.id;";
		$array = mysqli_query($db,$query) or die (mysqli_error($db));

		while ($row = mysqli_fetch_assoc($array)) {
			echo ("<div class=\"post\">");
      echo ("<img src=\"".$row["photodata"]."\"/><p>");
			echo ("Recept: ".$row["recipe"]."<p>");
			// ucfirst() zorgt voor uppercase i.v.m. naam van user
			echo ("Eigenaar: ".ucfirst($row["username"])."<p>");
			echo ("</div>");
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
INSERT INTO users (username,password,email,level) VALUES ('testuser','testpass','test@gmail.com',1),('barrie','badslipper','barrie@badslipper.nl',9001);

  posts
INSERT INTO posts (photodata,recipe,users_id) VALUES ('./data/testuser/img/600x500.png','Nog geen recept',1);

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
##############################################
######PHP voor genereren random posts#########
##############################################
############################
for ($i=0; $i < 25; $i++) {
	$z = $i * 5;
	$query2 = "INSERT INTO posts (photodata,recipe,users_id) VALUES ('./data/testuser/img/600x500.png','Recept nummer $z',3);";
	mysqli_query($db,$query2) or die (mysqli_error($db));
	echo ("post ".$z);
}
############################

for ($i=0;$i<25;$i++) {
	$getal = rand(1,2);
	if($getal==1){
		$z=rand(1,100);
		$query2 = "INSERT INTO posts (photodata,recipe,users_id) VALUES ('./data/testuser/img/600x500.png','Recept nummer $z',5);";
		mysqli_query($db,$query2) or die (mysqli_error($db));
		echo ("bliep-");
	} else {
		$z=rand(1,100);
		$query3 = "INSERT INTO posts (photodata,recipe,users_id) VALUES ('./data/testuser/img/600x500.png','Recept nummer $z',6);";
		mysqli_query($db,$query3) or die (mysqli_error($db));
		echo ("bloep-");
	}
}
#############################
for ($i=0; $i < 25; $i++) {
	$query2 = "SELECT * FROM users;";
	$array2 = mysqli_query($db,$query2) or die (mysqli_error($db));
	while ($row = mysqli_fetch_assoc($array2)) {
		$z = rand(1,100);
		$id = $row["id"];
		$query3 = "INSERT INTO posts (photodata,recipe,users_id) VALUES ('./data/testuser/img/600x500.png','Recept nummer $z',$id);";
		mysqli_query($db,$query3) or die (mysqli_error($db));
	}
}
#############################
-->
