<?php
include_once(__DIR__ . "/classes/Follow.php");
include_once(__DIR__ . "/classes/User.php");
//Session start with username in it
session_start();
//New following
$following = new Follow();
//Number 11 has to be replaced with a nuber from the url
$following->setFollow(11);

//Get Follower
$user = new User();
$user->setUserId($_SESSION["user"]);
$userid = $user->getUserId();

//Get id number from url
$id = $_GET["id"];
$username = $user->getUsernameFromId($id);
$posts = $user->getPostId($id);

$following->setFollower($userid[0]["id"]);

//if following and follower isn't active
$active = $following->active();

if ($active) {
    $text = "UnFollow";
} else {
    $text = "Follow";
}
$countfollowing = $following->CountFollowing();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <title>DetailPage</title>
</head>

<body>
    <div class="container">
        <div class="mb-3 row justify-content-center">
            <h1 class="mb-3 col-3"><?php echo $username["username"]; ?></h1>
        </div>
        <div class="mb-3 row justify-content-center">
            <img src="./images/images.png" class="mb-3 w-25 p3 rounded" alt="IMDTok-video">
        </div>
        <div class="mb-3 row justify-content-center">
            <p class="mb-3 col-2">@<?php echo $username["username"]; ?></p>
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
                <?php foreach ($posts as $post) : ?>
                    <div class="col">
                        <img src="./content/<?php echo $post['post_image']; ?>" class="mb-3 img-fluid" alt="IMDTok-video">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- navbar bottom -->
    <?php include_once(__DIR__ . "/partials/nav.bottom.white.inc.php"); ?>

    <script src="js/follow.js"></script>
</body>

</html>