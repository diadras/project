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
		// Omdat er een fout is in het database werkt onderstaande query en echo niet
		//$query = "SELECT username, photodata, recipe FROM project.posts JOIN users USING (gebruikers_id);";
		$query = "SELECT * FROM project.posts;";
		$array = mysqli_query($db,$query) or die("error");

    while ($row = mysqli_fetch_assoc($array)) {
			echo ("gebruiker: ".$row["gebruikers_id"]);
      echo ("<img src=\"".$row["photodata"]."\"/><p>");
			echo ("Recept: ".$row["recipe"]."<p>");
			//echo ("Gemaakt door gebruikers: ".$row["username"]."<p>");
    }

		// Je kan beter foto opslaan op de schijf zelf en een pointer in "postdata" zetten.
		// Fotos opslaan in Base64 in een database KAN, maar is niet praktisch
		$base64data = file_get_contents("./data/testuser/base64/image1");
		// Wanneer ik de onderste query met backtics `` invoer krijg ik een kolomfout
		// Als ik daarna deze vervang met enkele quotes '' gaat alles goed
		$query2 = " INSERT INTO posts (photodata,recipe,gebruikers_id) VALUES ('./data/testuser/img/600x500.png','Nog geen recept','1');
		INSERT INTO users (username,password,email,level) VALUES ('testuser','testpass','test@gmail.com',1);
		INSERT INTO users (username,password,email,level) VALUES ('barrie','badslipper','barrie@badslipper.nl',9001);";
		//mysqli_query($db,$query2) or die("error");

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
