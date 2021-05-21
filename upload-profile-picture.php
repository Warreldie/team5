<?php
    session_start();
    include_once("classes/Db.php");
    include_once("classes/Picture.php");

    $conn = Db::getInstance();

    // Check login
    $loggedin = true;
    if(!$loggedin) {
        header("Location: login.php");
        die();
    }

    if(!empty($_POST)) { // On submit
        $file = $_FILES["profile-picture"];

        $profile_picture = new Picture();
        $profile_picture->setFile($file);
        $profile_picture->saveProfilePicture();
    }