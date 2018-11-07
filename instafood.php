<!DOCTYPE html>
<html>
 <head>
   <?php
      include "./core/functions.php";
      include "./core/database.php";
      include "./core/loggedin.php";
    ?>
    <link href="./style/style.css" rel="stylesheet" type="text/css" media="all"/>
    <title>Insta-Food</title>
 </head>
 <body>
    <div class = "header">
        <a href = "./instafood.php">
		    <img src="./img/Logo.png" style=" height: 100px" title="Instafood"/>
        </a>
        <div class="buttons">
            <button name="post" onclick="window.location.href='./post.php'"> post </button>
            <br><br>
            <button name="changeaccount" onclick="window.location.href='./accountaanpassen.php'"> change account </button>
            <br><br>
            <button name="logout"  onclick="window.location.href='./logout.php'"> logout </button>
        </div>
    </div>
    <br><br><br><br><br>
      <?php
        echo($_SESSION['logged']);
  	    $query = "SELECT p.id, p.photodata, p.title, p.recipe, u.id, u.username FROM posts p JOIN users u ON p.users_id = u.id ORDER BY p.id DESC;";
	    $array = mysqli_query($db,$query) or die (mysqli_error($db));

	    while ($row = mysqli_fetch_assoc($array)) {
            echo ("<div class=\"post\">");
            echo ("<h2>".$row['title']."</h2><p>");
            echo ("<img class=\"postimg\" style=\"width: 600px; height: auto;\" src=\"".$row["photodata"]."\"/><p>");
		    echo ("Recept: ".$row["recipe"]."<p>");
		    // ucfirst() zorgt voor uppercase i.v.m. naam van user
		    echo ("Eigenaar: ".ucfirst($row["username"])."<p>");
		    echo ("</div>");
	    }

        mysqli_close($db);
      ?>
    </body>
</html>
