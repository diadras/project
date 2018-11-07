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
			    <button name="login"style="color: black;" onclick="window.location.href='./inlog.php'"> login </button>
		    </div>
        </div>
        <br><br><br><br><br><br><br>
        <?php
            $emailErr = $succes = "";
            session_start();
            if (isset($_POST["mail"])){
                
                $email = test_input($_POST["email"]);

                //check of er een email is ingevuld
                if (empty($_POST["email"])){
                    $emailErr .= "Please enter email";
                }   //valide email
                elseif(!preg_match("/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,4})$/",$email)) {
                    $emailErr .="<li class=\"formerror\">Vul een geldig e-mailadres in. </li>";
                }

                //check of een row te vinden is die het email heeft 
                $query = "SELECT * FROM users WHERE email='$email' limit 1";
                $result = mysqli_query($db,$query);
                
                //mailt het nieuwe wachtwoord
                if(mysqli_num_rows($result) == 1){
                    $nieuwpass = genpassword();
                    
                    $query2 = "UPDATE users SET password = '$nieuwpass' WHERE username='$email'";
                    $result2 = mysqli_query($db,$query2);
                    //mail het nieuwe wachtwoord
                    $msg = "Your password new is: " . $nieuwpass;
                    mail($email,"Forgot password",$msg);
                    $succes = ("Your password has been send");
                }
                mysqli_close($db);
            }
        ?>

        <div class="inlog">
        <form method="POST">
            <p>E-mail: <input type="text" name="email"><br>
            <p><input type="submit" value="Mail me" name="mail">
            <a href="./inlog.php">go back</a></p>
            <span class="error"><?php echo $emailErr;?></span><br>
            <span><?php echo $succes;?></span>
        </form>
        </div>
    </body>
</html>
