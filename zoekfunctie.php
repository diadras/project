<html>
<head>
    <?php
        include './core/database.php';
        include './core/functions.php';
        include './core/loggedin.php';
    ?>
    <title> Search page </title>
    <link href="./style/style.css" rel="stylesheet" type="text/css" media="all"/>
</head>
<body>
<div class = "header">
	<a href = "./index.php">
		<img src="./img/Logo.png" style="height: 40px" title="Instafood"/>
	</a>
	<div class="buttons">
		<button name="login" onclick="window.location.href='./inlog.php'"> login </button>
	</div>
</div>
<br><br><br><br>
<form action='zoekfunctie.php' method='POST'>
<fieldset>
Search: <input type='text' name='sqry' size='40' placeholder='Tags, Hashtags, Posts, Users' />
<input type='submit' name='submit' value="search" />
</fieldset>
<?php

if(isset($_POST['submit'])) {

    $searchRequest = $_POST['sqry'];

    $searchResults = array();
    $resultCount = 0;


    $usernameQuery = "SELECT * FROM users WHERE username LIKE '%$searchRequest%'";
    if($result = mysqli_query($db, $usernameQuery)) {
        while($row = mysqli_fetch_assoc($result)) {
            //fotodata
            $searchResults[$resultCount++] = $row['title'];
            $searchResults[$resultCount++] = $row['recipe'];
            $searchResults[$resultCount++] = $row['username'];
        }

         mysqli_free_result($result);
    }

    $recipeQuery = "SELECT * FROM posts WHERE recipe LIKE '%$searchRequest%'";
    if($result = mysqli_query($db, $recipeQuery)) {
        while($row = mysqli_fetch_assoc($result)) {
            //fotodata
            $searchResults[$resultCount++] = $row['title'];
            $searchResults[$resultCount++] = $row['recipe'];
            $searchResults[$resultCount++] = $row['username'];
        }

         mysqli_free_result($result);
    }

  $titleQuery = "SELECT * FROM posts WHERE title LIKE '%$searchRequest%'";
    if($result = mysqli_query($db, $titleQuery)) {
        while($row = mysqli_fetch_assoc($result)) {
            //fotodata
            $searchResults[$resultCount++] = $row['title'];
            $searchResults[$resultCount++] = $row['recipe'];
            $searchResults[$resultCount++] = $row['username'];
        }

         mysqli_free_result($result);
    }

    for ($i=0; $i < sizeof($searchResults); $i++) {
        echo "<h4>" .$searchResults[$i] . "</h4>";
    }


}


mysqli_close($db);


//dit hele bestand werkt niet
?>

</form>
</body>
</html>
