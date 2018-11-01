<html>
<div align="center">
<fieldset style="width: 0px">


<title>Register</title>
<h1>Create an account:</h1>

<table>
    <form method="post" action="ProjectAanmelden.php">
        <tr><td><h3>Username: </h3></td><td><input name="username" type="text"</td></tr>
        <tr><td><h3>Password: </h3></td><td><input name="password" type="password"</td></tr>
        <tr><td><h3>E-mail: </h3></td><td><input name="email" type="text"</td></tr>
</table>  

<input type="submit" name="submit" value="Create Account">
<input type="reset" name="reset" value="Clear">

<?php 
include 'DBCon.php';

if (isset($_POST['submit'])){
        $error_msg ="";
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);

echo "<br /> <br />";

//Is er een gebruikersnaam ingevuld
    if(strlen($username)<2){
        $error_msg.="<li >Vul een gebruikersnaam in. </li>";
    }
//Wachtwoord langer dan 4 tekens
    if(strlen($password)<4){
        $error_msg.="<li >Het wachtwoord moet uit minstens 4 tekens bestaan! </li>";
    }
//Valid email
    if(!preg_match("/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,4})$/",$email)) {
        $error_msg.="<li class=\"formerror\">Vul een geldig e-mailadres in. </li>";
    }
//Bestaat de gebruikersnaam al?
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query) or die ("FOUT: " . mysqli_error());
    if(mysqli_num_rows($result) > 0){
        $error_msg.="<li class=\"formerror\">De gebruikersnaam is al in gebruik. </li>";
    }
//Niks ingevuld
    if(strlen($error_msg)>0){
        echo ("Error:" . $error_msg);
    }
    else {
            $query = "INSERT INTO users (username, password, email, level) VALUES('$username','$password','$email', '0')";

            mysqli_query($conn, $query) or die("Error!" . mysqli_error($conn));
            header('Location: '. "instafood.php");
        }
}
?>


</form>
</fieldset>
</div>
</html>