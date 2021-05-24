<?php
//session start with username in it
session_start();

if (isset($_SESSION['user'])) {
    //include_once(__DIR__ . "/helpers/Security.php"); 
    include_once(__DIR__ . "/classes/User.php");
    $user = new User();
    //Posts looping
    include_once(__DIR__ . "/classes/Post.php");
    $post = new Post();
    $results = $post->getPosts();

    //Comments looping
    include_once(__DIR__ . "/classes/Comment.php");
    $comment = new Comment();
    //test postId = 3
    $timeAgo = $comment->getTimeStamp();
    // time to time ago

    $now = new DateTime();
    $past = new DateTime($timeAgo['timestamp']);

    $interval = $now->diff($past);

    $elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
} else {
    //user not logged in -> redirect
    header("Location: login.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <title>IMDtok - Feed</title>
</head>

<body class="feed bg-dark text-white">
    <!-- navbar top ==> fixed-top class -->
    <div class="navbar fixed-top  bg-dark justify-content-center">
        <div class="container-fluid">
            <a class="nav-link text-white" href="#">Following</a>
            <a class="nav-link text-white" href="#">For You</a>
            <a class="nav-link text-white" href="logout.php">Logout</a>
        </div>
    </div>

    <!-- post -->
    <?php foreach ($results as $result) : $comment->setPostId($result["id"]) ?>
        <div class="mb-3 row justify-content-center" id="post">
            <div class="mb-3 col-3">
            <?php $username = $user->getUsernameFromId($result["user_id"]); ?>
            <a href="detail.php" class="row justify-content-center text-reset text-decoration-none fw-bold">@<?php echo $username["username"]; ?></a>
            </div>
            <!-- post image -->
            <img src="./content/<?php echo $result['post_image'] ?>" class="img-fluid" alt="IMDTok-video">
            <p class="likes">
                <a href="#">Like</a>
                <span id="likes__counter">2</span> people like this
            </p>
            <!-- post comments -->
            <ul class="mb-3 post__comments__list list-group list-group-numbered">
                <?php $allComments = Comment::getAllFromId($result["id"]); ?>
                <?php foreach ($allComments as $c) : ?>
                    <li class="mb-1 list-group-item justify-content-between rounded">
                        <div class="row ms-2 me-auto text-dark">
                            <div class="col-2">
                                <img src="./images/images.png" class="mb-3 w-100 p3 rounded" alt="IMDTok-video">
                            </div>
                            <div class="col-5">
                                <div class="">username</div>
                                <div class="fw-bold"><?php echo htmlspecialchars($c['text']) . "<br>"; ?></div>
                                <?php echo $elapsed; ?>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
            <!-- post comment form-->
            <div class="mb-3 post__comments">
                <div class="post__comments__form">
                    <form method="post" class="row justify-content-between" action="">
                        <div class="col">
                            <input type="text" class="form-control" id="commentText" name="commentText" placeholder="What's on your mind">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-danger" id="btnAddComment" data-postid="<?php echo $result["id"] ?>">Add comment</button>
                            <!-- need to print primary key from database into data-postid -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <!-- navbar bottom -->
    <nav class="navbar fixed-bottom bg-dark">
        <a class="nav-link text-white" href="#">Home</a>
        <a class="nav-link text-white" href="#">Discover</a>
        <a class="nav-link text-white" href="upload.php">New</a>
        <a class="nav-link text-white" href="#">Inbox</a>
        <a class="nav-link text-white" href="profile.php">Me</a>
    </nav>

    <script src="comment.js"></script>

</body>

</html>