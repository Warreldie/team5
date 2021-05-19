<?php
session_start();

include_once(__DIR__ . "/classes/User.php");
    $user = new User();
    $user = User::getAllBio();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">

    <title>profile</title>
</head>

<body>
    <a class="mb-3 page-link" href="index.php" aria-label="Previous">
        <span aria-hidden="true">&larr;</span>
    </a>
    <div class="profile container">
        <div class="mb-3 row justify-content-center">
            <h1 class="mb-3 col-10 text-center">John Doe</h1>
        </div>
        <div class="mb-3 row justify-content-center">
            <img src="./images/images.png" class="mb-3 w-25 p3 rounded" alt="IMDTok-video">
        </div>
        <div class="mb-3 row justify-content-center">
            <p class="mb-3 col-5 text-center">@ProfileThatIsMine</p>
        </div>
        <div class="mb-3 row justify-content-center">
            <div class="mb-3 col-3">
                <p class="row justify-content-center fw-bold" id="txtFollowing">15M</p>
                <p class="row justify-content-center">Following</p>
            </div>
            <div class="mb-3 col-3">
                <p class="row justify-content-center fw-bold">1M</p>
                <p class="row justify-content-center">Followers</p>
            </div>
            <div class="mb-3 col-3">
                <p class="row justify-content-center fw-bold">50M</p>
                <p class="row justify-content-center">Likes</p>
            </div>
        </div>
        <div class="mb-3 d-grid gap-2">
            <button type="button" class="btn btn-outline-dark"><a href="profile_settings.php" class="text-reset text-decoration-none">Change profile</a></button>
        </div>
        <div class="mb-3 d-grid gap-2">
        <?php foreach ($user as $u) : ?>
            <p class="text-center"><?php echo htmlspecialchars($u["bio"]); ?></p>
        <?php endforeach; ?>
        </div>
        <div class="mb-3">
            <div class="row">
                <div class="col">
                    <img src="./images/image.jpg" class="mb-3 img-fluid" alt="IMDTok-video">
                </div>
                <div class="col">
                    <img src="./images/image.jpg" class="mb-3 img-fluid" alt="IMDTok-video">
                </div>
                <div class="col">
                    <img src="./images/image.jpg" class="mb-3 img-fluid" alt="IMDTok-video">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <img src="./images/image.jpg" class="mb-3 img-fluid" alt="IMDTok-video">
                </div>
                <div class="col">
                    <img src="./images/image.jpg" class="mb-3 img-fluid" alt="IMDTok-video">
                </div>
                <div class="col">
                    <img src="./images/image.jpg" class="mb-3 img-fluid" alt="IMDTok-video">
                </div>
            </div>
        </div>
    </div>
    <!-- navbar bottom -->
    <nav class="navbar fixed-bottom bg-light">
        <a class="nav-link text-dark" href="index.php">Home</a>
        <a class="nav-link text-dark" href="#">Discover</a>
        <a class="nav-link text-dark" href="upload.php">New</a>
        <a class="nav-link text-dark" href="#">Inbox</a>
        <a class="nav-link text-dark" href="profile.php">Me</a>
    </nav>
</body>

</html>