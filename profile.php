<?php
    session_start();
    //include_once(__DIR__ . "/User.php");


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile</title>
</head>
<body>
<a href="index.php"> <- back </a>
    <p>Lorem ipsum dolor sit amet, ut enim ad minim veniam.</p>

    <div class="container">
        <div class="mb-3 row justify-content-center">
            <h1 class="mb-3 col-10">John Doe</h1>
        </div>
        <div class="mb-3 row justify-content-center">
            <img src="./images/images.png" class="mb-3 w-25 p3 rounded" alt="IMDTok-video">
        </div>
        <div class="mb-3 row justify-content-center">
            <p class="mb-3 col-5">@ProfileYouWantToFollow</p>
        </div>
        <div class="mb-3 row justify-content-center">
            <div class="mb-3 col-3">
                <p class="row justify-content-center fw-bold" id="txtFollowing"><?php echo $countfollowing ?></p>
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
        <form id="follow" method="POST" action="">
            <div class="mb-3 d-grid gap-2">
                <!-- The data-userid has to come from the url -->
                <button type="submit" class="btn btn-danger" id="btnFollow" data-userid="11"><?php echo $text ?></button>
            </div>
        </form>
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
    <button type="button"><a href="profile_settings.php">Change profile</a></button>
</body>
</html>