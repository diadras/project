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
		        <img src="./img/Logo.jpeg" style="height: 100px" title="Instafood"/>
            </a>
            <div class="buttons">
			    <button name="login"style="color: black;" onclick="window.location.href='/project/inlog.php'"> login </button> 
		    </div>
        </div>
        <?php 
            $nameErr = $emailErr = "";
            
            if (isset($_POST["mail"])){
                //check of er een email of username is ingevuld
                if (empty($_POST["username"])){
                    $nameErr = "Please enter username";
                }
                if (empty($_POST["email"])){
                    $emailErr = "Please enter email";
                }
                
                $username = test_input($_POST["username"]);
                $email = test_input($_POST["email"]);
                //check of een row te vinden is die zowel de username als email heeft
                $query = "SELECT `username`,`email` FROM `users` WHERE `username` = '$username' AND `email` = '$email'";
                $query2 = "SELECT `password` FROM `users` WHERE `username` = '$username' AND `email` = '$email'";
                $result = mysqli_query($db,$query);
                $result2 = mysqli_query($db,$query2);
                //mailt het wachtwoord
                if(mysqli_num_rows($result) == 1){
                    // kan niet het wachtwoord uit de db halen
                    $curpass = mysqli_fetch_assoc($result2);
                    $msg = "Your password is: " . $curpass;
                    mail($email,"Forgot password",$msg);
                 
                }
                mysqli_close($db);
            }
        ?>
    
        <div class="inlog">
        <form method="POST">
            <p>Username: <input type="text" name="username"><br>
            <p>E-mail: <input type="text" name="email"><br>
            <p><input type="submit" value="Mail me" name="mail">
            <a href="./inlog.php">go back</a></p>
            <span class="error"><?php echo $nameErr;?></span><br>
            <span class="error"><?php echo $emailErr;?></span>
        </form>
        </div>
    </body>
</html>