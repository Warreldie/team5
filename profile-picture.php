<?php
session_start();
include_once("./classes/User.php");
include_once("./classes/Picture.php");

//Check login
$loggedin = true;
if (!$loggedin) {
    header("Location: login.php");
    die();
}

if (!empty($_POST)) { //On submit
    $file = $_FILES["profile-picture"];

    $profile_picture = new Picture();
    $profile_picture->setFile($file);
    $profile_picture->saveProfilePicture();
}

$userId = 20; //Test value
$user = new User();
$user->setId($userId);
$user->loadProfilePic();
$profilePicture = $user->getProfilePic();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <title>Upload profile picture</title>
</head>

<body>
    <div class="image container">
        <div class="mb-3">
            <?php if (empty($profilePicture)) : ?>
                <img src="profile-pictures/default-profile-picture.jpg" alt="Profile picture" style="height: 450px; width: 450px">
            <?php else : ?>
                <img src="<?php echo $profilePicture ?>" alt="Profile picture" style="height: 450px; width: 450px">
            <?php endif; ?>
        </div>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="input-group mb-3">
                <input type="file" name="profile-picture" class="form-control" id="profile-picture">
                <button type="submit" name="submit" class="input-group-text" for="inputGroupFile02">Upload</button>
            </div>
        </form>
    </div>
    <!-- navbar bottom -->
    <?php include_once(__DIR__ . "/partials/nav.bottom.white.inc.php"); ?>
</body>

</html>