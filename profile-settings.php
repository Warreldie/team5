<?php
include_once(__DIR__ . "/classes/User.php");

//Session start with username in it
session_start();

if (!empty($_POST)) {

    $user = new User();

    $user->setBio($_POST['bio']);
    //Saves bio by executing a query in the database
    $user->saveBio();
    $success = "Bio changed";
} else {
    $failure = "Bio wasn't changed";
}

if (!empty($_GET)) {
    if ($_GET["message"] === "upload-success") {
        $message = "Succesfully updated your profile picture!";
    }
}


$userId = 20; // Test value
$user = new User();
$user->setId($userId);
$user->loadProfilePic();
$profilePicture = $user->getProfilePic();


$user = User::getAllBio();

$user = User::getAllEmail();

$user = User::getAllName();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <title>Change profile</title>
</head>

<body>
    <a class="mb-3 page-link" href="profile.php" aria-label="Previous">
        <span aria-hidden="true">&larr;</span>
    </a>
    <div class="change container">
        <?php if (isset($message)) : ?>
            <div class="row mb-4 alert alert-success center-text" role="alert">
                <p class="text-center mb-0"><?php echo $message; ?></p>
            </div>
        <?php endif; ?>
        <div class="mb-3 row justify-content-center">
            <?php if (empty($profilePicture)) : ?>
                <img src="profile-pictures/default-profile-picture.jpg" alt="Profile picture" class="mb-3 w-25 p3 rounded">
            <?php else : ?>
                <img src="<?php echo $profilePicture ?>" alt="Profile picture" class="mb-3 w-25 p3 rounded">
            <?php endif; ?>
        </div>
        <div class="text-center mb-5">
            <button class="btn btn-secondary">
                <a href="profile-picture.php" class="text-reset text-decoration-none">Update profile picture</a>
            </button>
        </div>
        <div class="row mb-4">
            <label for="InputUsername" class="col justify-content-start form-label fw-bold">Username</label>
            <?php foreach ($user as $u) : ?>
                <p class="col justify-content-end fw-bold"><?php echo $u["username"]; ?></p>
            <?php endforeach; ?>
        </div>
        <div class="row mb-5">
            <label for="InputEmail" class="col justify-content-start form-label fw-bold">Email address</label>
            <?php foreach ($user as $u) : ?>
                <p class="col justify-content-end fw-bold"><?php echo $u["email"]; ?></p>
            <?php endforeach; ?>
            <button type="button" class="btn btn-outline-dark"><a href="email.php" class="text-reset text-decoration-none">Change email</a></button>
        </div>
        <div class="row mb-5">
            <label for="Bio" class="col justify-content-start form-label fw-bold">Bio</label>
            <?php foreach ($user as $u) : ?>
                <p class="col justify-content-end"><?php echo htmlspecialchars($u["bio"]); ?></p> <!-- preventing XSS attack  -->
            <?php endforeach; ?>

            <form method="post" action>
                <div class="row mb-4">
                    <label for="InputBio" class="col justify-content-start form-label fw-bold">Change Bio</label>
                    <textarea name="bio" class="form-control" placeholder="Write your bio here" type="text" size="30" rows="3"></textarea>
                    <button type="submit" class="mb-3 g-3 btn btn-outline-dark">Save</button>
                </div>
            </form>
        </div>
        <div class="row mb-4">
            <label for="InputPassword" class="col justify-content-start form-label fw-bold">Password</label>
            <button type="button" class="col justify-content-end btn btn-outline-dark"><a href="password.php" class="text-reset text-decoration-none">Change password</a></button>
        </div>
    </div>
    <!-- navbar bottom -->
    <?php include_once(__DIR__ . "/partials/nav.bottom.white.inc.php"); ?>
</body>

</html>