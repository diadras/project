<!DOCTYPE html>
<html>
    <head>
        <?php
            include "./core/functions.php";
            include "./core/loggedin.php";
        ?>
        <title> Upload page </title>
        <link href="./style/style.css" rel="stylesheet" type="text/css" media="all"/>
    </head>
    <body>
        <div class = "header">
            <a href = "./instafood.php">
		        <img src="./img/Logo.png" style=" height: 40px" title="Instafood"/>
            </a>
            <div class="buttons">
                <button name="logout"  onclick="window.location.href='./logout.php'"> logout </button>
                <button name="changeaccount" onclick="window.location.href='./accountaanpassen.php'"> change account </button>
            </div>
        </div>   <br><br><br><br><br><br><br>
        <div class="upload">
            <form action="./upload.php" method="POST" enctype="multipart/form-data" >
                <p> Image: </p>
                <input type="file" id="fileToUpload" name="fileToUpload">
                <p>Title: </p>
                <input type="text" name= "title"><br>
                <p> Recipe: </p>
                <textarea name= "recipe" rows="5" cols="40"></textarea><br><br>
                <input type="submit" name="upload" value="Post"/>
            </form>
            <p></p>
            <p></p>
            <?php
                if (!empty($_SESSION['txt'])){
                    echo($_SESSION['txt']);
                    session_unset('txt');
                }
            ?>
        </div>
    </body>
</html>
