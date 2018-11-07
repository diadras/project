<?php
include "./core/database.php";
include "./core/loggedin.php";
$userinfo = $_SESSION['logged'];
$target_dir = "./data/" . $userinfo . "/";
$target_file = $target_dir. basename($_FILES["fileToUpload"]["name"]);
$filename = basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$text = $text2 = "";

// Check if image file is a actual image or fake image
if(isset($_POST["upload"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $text2 .= "File is an image - " . $check["mime"] . "."."<br>";
        $uploadOk = 1;
    } else {
        $text .= "File is not an image."."<br>";
        $uploadOk = 0;
    }

    //check if folder exist else make one
    if (!file_exists($target_dir)){
        if(mkdir($target_dir)){
            $text2 .= "dir has been created"."<br>";
        }
        else{
            $text .= "failed to create dir"."<br>";
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        $text .= "Sorry, file already exists."."<br>";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        $text .= "Sorry, your file is too large. The maximum size is 5MB."."<br>";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        $text .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed."."<br>";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $text .= "Sorry, your file was not uploaded."."<br>";
        $_SESSION['txt'] = $text;
        header("location: "."./post.php");
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $text2 .= "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded."."<br>";
            $title = $_POST["title"];
            $recipe = $_POST["recipe"];
            $_SESSION['txt'] = $text2;

            $query = "SELECT id FROM users WHERE username = '$userinfo';";
            $array = mysqli_query($db, $query) or die (mysqli_error($db));
            $id = mysqli_fetch_assoc($array);
            $query1 = "INSERT INTO posts (photodata, title, recipe, users_id) VALUES('$target_file', '$title', '$recipe',".$id['id'].");";

            mysqli_query($db, $query1) or die("Error!" . mysqli_error($db));
            mysqli_close($db);
            header("location: "."./post.php");
        } else {
            echo "Sorry, there was an error uploading your file."."<br>";
        }
    }
}
?>
