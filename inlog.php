<!DOCTYPE html>
<html>
    <head>
        <?php
		    include "./core/functions.php";
            include "./core/database.php";
        ?>
        <title> Instafood </title>
        <link href="./style/style.css" rel="stylesheet" type="text/css" media="all"/>
    </head>
    <body>
        <div class = "header">
            <a href = "./index.php">
		        <img src="./img/Logo.png" style="height: 100px" title="Instafood"/>
            </a>
        </div>
         <?php 
            $nameErr = $passErr = $wrongErr = "";
            
            if (isset($_POST["logindata"])){
                //check of er een wachtwoord of username is ingevuld
                if (empty($_POST["username"])){
                    $nameErr = "Please enter username";
                }
                if (empty($_POST["password"])){
                    $passErr = "Please enter password";
                }
                //check of een row te vinden is die zowel de username als password heeft
                $username = test_input($_POST["username"]);
                $password = test_input($_POST["password"]);

                $query = "SELECT `username`,`password` FROM `users` WHERE `username` = '$username' AND `password` = '$password'";
                $result = mysqli_query($db,$query);
                
                //als er een result is dan wordt je door gestuurt naar de hoofdpagina waar je dan ingelogd bent
                if(mysqli_num_rows($result) == 1){
                    session_start();
                    $userinfo = $username;
                    $_SESSION['logged'] = $userinfo;
                 
                    mysqli_close($db);
                    header("Location: " . "instafood.php");
                }
                elseif(!empty($_POST["username"])){
                    if(!empty($_POST["password"])){
                        $wrongErr = "Wrong password or username";
                    }
                }
            }
        ?>
    
        <div class="inlog">
        <img src="./img/profile.png" weidth="250" height="250"/>
        <form method="POST">
            <p>Username: <input type="text" name="username"><br>
            <p>Password: <input type="password"  name="password"><br>
            <p><input type="submit" value="Login" name="logindata"></p>
            <p>|<a href="./aanmelden.php">register here</a> |
            <a href="./inlog.php">forgot password</a>|</p>
            <span class="error"><?php echo $wrongErr;?></span><br>
            <span class="error"><?php echo $nameErr;?></span><br>
            <span class="error"><?php echo $passErr;?></span>
        </form>
        </div>
    </body>
</html>