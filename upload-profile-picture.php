<?php
    session_start();
    include_once("classes/Db.php");
    $conn = Db::getInstance();

    // Check login
    $loggedin = true;
    if(!$loggedin) {
        header("Location: login.php");
        die();
    }

    if(isset($_POST["submit"])) { // On submit
        $file = $_FILES["profile-picture"];

        $fileName = $file["name"];
        $fileTmpName = $file["tmp_name"];
        $fileSize = $file["size"];
        $fileError = $file["error"];
        $fileType = $file["type"];

        $fileExt = explode(".", $fileName); // Take apart String after the dot
        $fileActualExt = strtolower(end($fileExt)); // Get last element of array, in this case the file extension

        $allowed = [ // Allowed upload file formats
            "jpg",
            "jpeg",
            "png"
        ];

        if(in_array($fileActualExt, $allowed)) {
            if($fileError === 0) {
                if($fileSize < 2500000) { // File size cannot be larger than 2.5 MB
                    $fileNameNew = uniqid("", true) . "." . $fileActualExt; // Set a new unique name, so there won't be conflicts when uploading a file with the same name.
                    $fileDestination = "profile-pictures/" . $fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination); // Move file from temporary location to uploads folder.

                    echo "File destination: " . $fileDestination;

                    $userId = 4; // Test value
                    $st = $conn->prepare("UPDATE users SET profile_picture = :profile_picture WHERE id = :id");
                    $st->bindValue(":profile_picture", $fileDestination);
                    $st->bindValue(":id", $userId);
                    $res = $st->execute();
                    var_dump($res);

                    header("Location: profile_settings.php?upload-success"); // Redirect and let know upload was succesful.
                } else {
                    echo "Your image is too large to upload.";
                }
            } else {
                echo "There was an error uploading your image.";
            }
        } else {
            echo "You cannot upload files of this type.";
        }

    }