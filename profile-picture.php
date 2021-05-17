<?php
session_start();
include_once("classes/Db.php");
$conn = Db::getInstance();

// Check login
$loggedin = true;
if (!$loggedin) {
    header("Location: login.php");
    die();
}

$userId = 4; // Test value
$st = $conn->prepare("SELECT * FROM users WHERE id = :id");
$st->bindValue(":id", $userId);
$st->execute();
$user = $st->fetch();
$profilePicture = $user["profile_picture"];

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
        <form action="upload-profile-picture.php" method="POST" enctype="multipart/form-data">
            <div class="input-group mb-3">
                <input type="file" name="profile-picture" class="form-control" id="profile-picture">
                <button type="submit" name="submit" class="input-group-text" for="inputGroupFile02">Upload</button>
            </div>
        </form>
    </div>
</body>

</html>