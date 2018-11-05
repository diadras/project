<!DOCTYPE html>
<html>
    <head>
        <?php 
            include "./core/database.php"; 
            include "./core/functions.php";
        ?>
        <title> Upload page </title>
        <link href="./style/style.css" rel="stylesheet" type="text/css" media="all"/> 
    </head>
    <body>
        <div class="upload">
            <form action="./post.php" method="POST" enctype="multipart/form-data" >
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
            $userinfo = "HarryHoland";
            $target_dir = "./img/" . $userinfo . "/";
            $target_file = $target_dir. basename($_FILES["fileToUpload"]["name"]);
            $filename = basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            
            // Check if image file is a actual image or fake image
            if(isset($_POST["upload"])) {
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($check !== false) {
                    echo "File is an image - " . $check["mime"] . "."."<br>";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image."."<br>";
                    $uploadOk = 0;
                }
            
                //check if folder exist else make one
                if (!file_exists($target_dir)){
                    if(mkdir($target_dir)){
                        echo("dir has been created"."<br>");
                    }
                    else{
                        echo("failed to create dir"."<br>");
                    }
                }
                // Check if file already exists
                if (file_exists($target_file)) {
                    echo "Sorry, file already exists."."<br>";
                    $uploadOk = 0;
                }
                // Check file size
                if ($_FILES["fileToUpload"]["size"] > 500000) {
                    echo "Sorry, your file is too large."."<br>";
                    $uploadOk = 0;
                }
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed."."<br>";
                    $uploadOk = 0;
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded."."<br>";
                // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded."."<br>";
                        $title = $_POST["title"];
                        $recipe = $_POST["recipe"];

                        $query = "SELECT id FROM users WHERE username = '$userinfo';";
                        $array = mysqli_query($db, $query) or die (mysqli_error($db));
                        $id = mysqli_fetch_assoc($array);
                        $query1 = "INSERT INTO posts (photodata, recipe, users_id) VALUES('$target_dir','$recipe',".$id['id'].");";
    
                        mysqli_query($db, $query1) or die("Error!" . mysqli_error($db));
                    } else {
                        echo "Sorry, there was an error uploading your file."."<br>";
                    }
                }
            }
        ?>
        <?php
        /*
            $filename = "<script>document.write(a)</script>";
            //$userinfo = $_SESSSION['logged'];
            $userinfo = "HarryHoland";
            $curdir = getcwd();
            if(empty($inlog)){
                header("location: "."./index.php");
            }
            if(isset($_POST['upload'])){
                if (!file_exists($curdir . "/img/" . $userinfo)){
                    if(mkdir($curdir . "/img/" . $userinfo)){
                        echo("dir has been created");
                    }
                    else{
                        echo("failed to create dir");
                    }
                }
                else{
                    $postdata = $curdir . "/img/" . $userinfo . "/" . $filename ;
                    $title = $_POST["title"];
                    $recipe = $_POST["recipe"];

                    $query = "SELECT id FROM users WHERE username = '$userinfo';";
                    $array = mysqli_query($db, $query) or die (mysqli_error($db));
                    $id = mysqli_fetch_assoc($array);
                    $query1 = "INSERT INTO posts (photodata, recipe, users_id) VALUES('$postdata','$recipe',".$id['id'].");";
    
                    mysqli_query($db, $query1) or die("Error!" . mysqli_error($db));
                    // location where the image iss stored
                    $source = $curdir . "/img/" . $userinfo;
                    // the image file
                    $image = $_POST["fileToUpload"];
                    // saves the image in the assigned file
                    file_put_contents($source,$image, FILE_APPEND);
                }
            }
            */
        ?>
        </div>
    </body>
</html>