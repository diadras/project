<!DOCTYPE html>
<html>
    <head>
        <?php 
            include "./core/database.php"; 
            include "./core/functions.php";
            include "./core/loggedin.php"
        ?>
        <title> Upload page </title>
        <link href="./style/style.css" rel="stylesheet" type="text/css" media="all"/> 
    </head>
    <body>
        <div class = "header">
            <a href = "./instafood.php">
		        <img src="./img/Logo.jpeg" style="width: 260px; height: 150px" title="Instafood"/>
            </a>    
            <div class="buttons">    
                <form method="POST">
                    <button name="logout"style="color: black;"> logout </button>
                </form>    
            </div> 
        </div>
        <div class="upload">
            <form action="./upload.php" method="POST" enctype="multipart/form-data" >
                <p> Image: </p> 
                <input type="file" id="fileToUpload" name="fileToUpload">
                <p>Title: </p>
                <input type="text" name= "title"><br>
                <p> Recipe: </p>
                <textarea name= "recipe" rows="5" cols="40"></textarea><br>
                <input type="submit" name="upload" value="Post"/> 
            </form>
            <p></p>
            <p></p>
            <?php
                if (!empty($_SESSION['txt'])){
                    echo($_SESSION['txt']);
                }
            ?>
        </div>
    </body>
</html>