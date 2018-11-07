<html>

<form action='zoekfunctie.php' method='POST'>
<fieldset>
Search: <input type='text' name='sqry' size='40' placeholder='Tags, Hashtags, Posts, Users' />
<input type='submit' name='submit' value="search" />
</fieldset>

</form>

</html>

<?php
include './core/database.php';


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
