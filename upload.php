<?php
include_once(__DIR__ . "../../team5/helpers/Security.php");
include_once(__DIR__ . "/classes/Post.php");
//If you click on submi we will readout the picture
if (isset($_POST["submit"])) {
    //Create a new post
    $post = new Post();

    $post->setFile($_FILES["file"]);
    
    $post->setFilename($_FILES["file"]["name"]);
    $post->setFiletmpname($_FILES["file"]["tmp_name"]);
    $post->setFilesize($_FILES["file"]["size"]);
    $post->setFileerror($_FILES["file"]["error"]);

    //We use the explode in the name to know the kind of document
    //Explode happens now in post I have to do also the array and make a kind of function for the file if it is allowed?
    $post->setFiletype($post->getFilename());
    echo $post->getFilename();

    $allowed = array("jpg", "jpeg", "png", "pdf");

    //Looking of the type of document is allowed, if there was an error and if the filesize is not to big
    if (in_array($post->getFilename(), $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 500000) {
                //Placing the image in content map with unique id then you can find all the content at the project under team5/content => http://localhost/phples/team5/content/ 
                $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                $fileDestination = "content/" . $fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);

                //Set the fileName 
                $post->setFilename($fileNameNew);

                //Save the filename into post_image tabel in the databank
                $post->save();

                //Zet ook nog een succes-boodschap op één of andere manier
                header("location: index.php?uploadsucces");
            } else {
                $error = "Your file was to big!";
            }
        } else {
            $error = "There was an error uploading your file!";
        }
    } else {
        $error = "You can't upload files of this type!";
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
            <?php if(isset($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
            <?php endif; ?>
            <div class="mb-3">
                <textarea class="form-control" placeholder="Description" required></textarea>
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