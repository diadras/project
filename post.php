<!DOCTYPE html>
<html>
    <head>
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




        ?>
        </div>
    </body>
</html>    