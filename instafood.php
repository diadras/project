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
    <div class="header">
        <a href = "./instafood.php">
		    <img src="./img/Logo.jpeg" style="width: 260px; height: 150px" title="Instafood"/>
        </a>
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