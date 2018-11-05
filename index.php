<!DOCTYPE html>
<html>
<head>
	<?php
		include "./core/functions.php";
		include "./core/database.php";
		session_start();
		if(!empty($_SESSION['logged'])){
			header("location: " . "./instafood.php");
		}
	?>
	<link href="./style/style.css" rel="stylesheet" type="text/css" media="all"/>
	<title>Insta-Food</title>
</head>
<body>
	<div class = "header">
		<a href = "./index.php">
			<img src="./img/Logo.jpeg" style="width: 260px; height: 150px" title="Instafood"/>
		</a>
		<div class="buttons">
			<form method="POST">
			  <button name="login"style="color: black;"> login </button>
      </form>
      <?php
        if(isset($_POST['login'])){
          header("location: "."inlog.php");
        }
      ?> 
		</div>
	</div>
	<h3>Testdata</h3>
	<?php
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
######## Functies om data te genereren #######
##############################################
Het is mogelijk om content te genereren met 3 functies
	genuser() is voor het genereren van users, deze kan je een integer meegeven
voor een aantal maar dat hoeft niet (default=5)
	genposts() genereert posts voor elke bestaande user, deze kan je een integer
meegeven voor een aantal post per user maar dat hoeft niet (default=2)
	gencontent() genereert users (default=5) en posts per user (default=2) keer
het aantal dat je meegeeft. dus bijv gencontent(2) = 10 users en 4 posts per user

Alle 3 de functies geven output over wat ze hebben gegenereerd, het beste
is dan ook om ze aan te roepen in een echo()
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
-->
