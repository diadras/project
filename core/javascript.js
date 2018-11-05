
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
        }
        else {
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