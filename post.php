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
    <body onload="myFunction()">
        <div class="upload">
            <input type="file" id="myImage" multiple size="50" onchange="myFunction()">
            <p id="post"></p>
    
            <script>
                function myFunction(){
                    var x = document.getElementById("myImage");
                    var txt = "";
                    if ('files' in x) {
                        if (x.files.length == 0) {
                            txt = "Select a image.";
                        } else {
                            for (var i = 0; i < x.files.length; i++) {
                                txt += "<br><strong>" + (i+1) + ". file</strong><br>";
                                var file = x.files[i];
                                if ('name' in file) {
                                    txt += "name: " + file.name + "<br>";
                                    var a = file.name;
                                }
                                if ('size' in file) {
                                    txt += "size: " + file.size + " bytes <br>";
                                }
                            }
                        }
                    } 
                    else {
                        if (x.value == "") {
                            txt += "Select a image.";
                        } else {
                            txt += "The files property is not supported by your browser!";
                            txt  += "<br>The path of the selected file: " + x.value; 
                            // If the browser does not support the files property, it will return the path of the selected file instead. 
                        }
                    }
                    document.getElementById("post").innerHTML = txt;
                }
                function uploadFile() {
                    var blobFile = $('#myImage').files[0];
                    var formData = new FormData();
                    formData.append("fileToUpload", blobFile);

                    $.ajax({
                        url: "./post.php",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                        alert("Upload is a succes");
                        },
                        error: function(jqXHR, textStatus, errorMessage) {
                            console.log(errorMessage); // Optional
                        }
                    });
                }
            </script>
        </div>
        <div class="upload">
            <form method="POST"> 
                <p>Title: </p>
                <input type="text" name= "title" value="Title" onfocus="this.value=''"><br>
                <p> Recipe: </p>
                <textarea name= "recipe" rows="5" cols="40"></textarea><br>
                <input type="submit" name="upload" value="Post" /> 
            </form>
            <p></p>
            <p></p>

        <?php
            $filename = "<script>document.write(a)</script>";
            //$userinfo = $_SESSSION['logged'];
            $userinfo = "HarryHoland";
            $curdir = getcwd();
            /*if(empty($inlog)){
                header("location: "."./index.php");
            }*/
            if(isset($_POST['upload'])){
                if (!file_exists($curdir . "/img/" . $userinfo)){
                    if(mkdir($curdir . "/img/" . $userinfo)){
                        ehco("dir has been created");
                    }
                    else{
                        echo("failed to create dir");
                    }
                }
                else{
                    $postdata = $curdir . "/img/" . $userinfo . "/" . $filename ;
                    $title = $_POST["title"];
                    $recipe = $_POST["recipe"];
                    $query = "INSERT INTO posts (photodata, title, recipe) VALUES('$postdata','$title','$recipe' JOIN users USING (users_id) WHERE username = '$userinfo')";
    
                    mysqli_query($db, $query) or die("Error!" . mysqli_error($db));
                    // location where the image iss stored
                    $source = $curdir . "/img/" . $userinfo;
                    // the image file
                    $image = $_POST["fileToUpload"];
                    // saves the image in the assigned file
                    file_put_contents($source,$image, FILE_APPEND);
    
    
                }
            }
        ?>
        </div>
    </body>
</html>    