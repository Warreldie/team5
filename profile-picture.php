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

    $userId = 4; // Test value
    $st = $conn->prepare("SELECT * FROM users WHERE id = :id");
    $st->bindValue(":id", $userId);
    $st->execute();
    $user = $st->fetch();
    $profilePicture = $user["profile_picture"];

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload profile picture</title>
</head>
<body>
    <?php if(empty($profilePicture)): ?>
        <img src="profile-pictures/default-profile-picture.jpg" alt="Profile picture" style="height: 200px; width: 200px">
    <?php else: ?>
        <img src="<?php echo $profilePicture ?>" alt="Profile picture" style="height: 200px; width: 200px">
    <?php endif; ?>

    <form action="upload-profile-picture.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="profile-picture" id="profile-picture"/>
        <button type="submit" name="submit">Upload</button>
    </form>

</body>
</html>