<?php
    //If you click on submi we will readout the picture
    if(isset($_POST["submit"])){
        $file = $_FILES["file"];

        $fileName = $_FILES["file"]["name"];
        $fileTmpName = $_FILES["file"]["tmp_name"];
        $fileSize = $_FILES["file"]["size"];
        $fileError = $_FILES["file"]["error"];
        $fileType = $_FILES["file"]["type"];

        //We use the explode in the name to know the kind of document
        $fileExt = explode(".", $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array("jpg", "jpeg", "png", "pdf");

        //Looking of the type of document is allowed, if there was an error and if the filesize is not to big
        if(in_array($fileActualExt, $allowed)){
            if($fileError === 0){
                if($fileSize < 500000){
                    //Placing the image in folder upload
                    $fileNameNew = uniqid('', true).".". $fileActualExt;
                    $fileDestination = "uploads/". $fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    header("location: index.php?uploadsucces");

                }else{
                    echo "Your file was to big!";
                    //To start uploading images in de databank https://www.youtube.com/watch?v=1NiJcZrPHvA
                    //Niet meer lokaal doen...
                }

            }else{
                echo "There was an error uploading your file!";
            }

        }else{
            echo "You can't upload files of this type!";
        }

    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1>Upload</h1>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="mb-3">
                <textarea class="form-control" placeholder="Description"></textarea>
            </div>
            <img src="./images/image.jpg" class="mb-3 img-fluid" alt="IMDTok-video">
            <div class="mb-3">
                <input type="file" name="file" class="mb-3 form-control">
            </div>
            <div class="mb-3 d-grid gap-2">
                <button type="submit" name="submit" class="btn btn-danger">Upload</button>
            </div>
        </form>
    </div>
</body>

</html>