<!DOCTYPE html>
<html>
<head>
    <?php
        include './core/database.php';
        include './core/functions.php';
    ?>
    <link href="./style/style.css" rel="stylesheet" type="text/css" media="all"/>
    <title>Register</title>
</head>
<body>
    <div class = "header">
		<a href = "./index.php">
			<img src="./img/Logo.png" style="height: 40px" title="Instafood"/>
		</a>
		<div class="buttons">
			<button name="login"style="color: black;" onclick="window.location.href='./inlog.php'"> login </button>
		</div>
	</div>   <br><br><br><br>
<fieldset class="aanmelden" style="width: 0px;">
<h1>Create an account:</h1>

<table>
    <form method="post">
        <tr><td><h3>Username: </h3></td><td><input name="username" type="text"/></td></tr>
        <tr><td><h3>Password: </h3></td><td><input name="password" type="password"/></td></tr>
        <tr><td><h3>E-mail: </h3></td><td><input name="email" type="text"/></td></tr>
</table>

<input type="reset" name="reset" value="Clear">
<input type="submit" name="submit" value="Create Account">

<?php

if (isset($_POST['submit'])){
        $error_msg ="";
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
        $email = mysqli_real_escape_string($db, $_POST['email']);

echo "<br /> <br />";

//Is er een gebruikersnaam ingevuld
    if(strlen($username)<2){
        $error_msg.="<li >Vul een gebruikersnaam in. </li>";
    }
//Wachtwoord langer dan 4 tekens
    if(empty($password)){
        $error_msg.="<li>Vul een wachtwoord in. </li>";
    }elseif(strlen($password)<4){
        $error_msg.="<li >Het wachtwoord moet uit minstens 4 tekens bestaan! </li>";
    }
//Valid email
    if(empty($email)){
        $error_msg.="<li class=\"formerror\">Vul een e-mailadres in. </li>";
    }
    elseif(!preg_match("/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,4})$/",$email)) {
        $error_msg.="<li class=\"formerror\">Vul een geldig e-mailadres in. </li>";
    }
//Bestaat de email al?
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($db, $query) or die ("FOUT: " . mysqli_error());
    if(mysqli_num_rows($result) > 0){
        $error_msg.="<li class=\"formerror\">De email is al in gebruik. </li>";
    }
//Bestaat de gebruikersnaam al?
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($db, $query) or die ("FOUT: " . mysqli_error());
    if(mysqli_num_rows($result) > 0){
        $error_msg.="<li class=\"formerror\">De gebruikersnaam is al in gebruik. </li>";
    }
//Niks ingevuld
    if(strlen($error_msg)>0){
        echo ("Error:" . $error_msg);
    }
    else {
            $query = "INSERT INTO users (username, password, email, level) VALUES('$username','$password','$email', '0')";

            mysqli_query($db, $query) or die("Error!" . mysqli_error($db));

            // maakt gelijk een sessie aan zodat je ingelogd bent
            session_start();
            $userinfo = $username;
            $_SESSION['logged'] = $userinfo;
            header('Location: '. "instafood.php");
        }
}
?>
</form>
</fieldset>
</body>
</html>
