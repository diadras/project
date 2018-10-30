<!DOCTYPE html>
<html>
    <head>
        <?php
		    include "./core/functions.php";
            include "./core/database.php";
	    ?>
        <title> Instafood </title>
        <link/>
        <style>
            div{
                text-align: center;
                border: solid black 3px;
                display: block;
                background-color: green;
                width: 500px;
                margin: 10px;
	            margin-left: auto;
	            margin-right: auto;
	            padding: 5px;
            }
            div.error{
                text-align: center;
            }
            img{
                width: 500px;
                height: 500px;
            }
            p{
                font-family: "Times New Roman", Times, serif;   
                font-size: 18px;
            }
            h1{
                text-align: center;
                color: red;
            }

        </style>
    </head>
    
    <body>
        <div>
        <img src="./img/profile.png" />
        <form method="POST">
            <p>Username: <input type="text" name="username">
            <p>Password: <input type="password"  name="password"> 
            <p><input type="submit" value="Submit" name="logindata">
        </form>
        </div>
        <?php 
            //check of er iets is ingevuld
            if (isset($_POST["logindata"])){
                if (empty($_POST["username"])){
                    echo("<h1>Please enter username");
                }
                if (empty($_POST["password"])){
                    echo("<h1>Please enter password");
                } 
            }
            //check of een row te vinden is die zowel de username als password heeft
            if (isset($_POST["logindata"])){
                $username = $_POST["username"];
                $password = $_POST["password"];

                $query = "SELECT `username`,`password` FROM `users` WHERE `username` = '$username' AND `password` = '$password'";
                $result = mysqli_query($db,$query);
                
                
                if(mysqli_num_rows($result) == 1){
                    header('Location: '. "instafood.php");
                }  
                else{
                    echo("<h1>Incorect password or username");
                }
            }
            
            
        ?>
    </body>
</html>