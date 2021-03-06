<?php
//Session start with username in it
session_start();

// test value
$userId = 20;
include_once(__DIR__ . "/classes/Like.php");

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

    //Timestamps looping
    include_once(__DIR__ . "/classes/Time.php");
    $time= new Time();
        
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

<body class="feed bg-dark text-white mt-5 mb-5">
    <!-- navbar top ==> fixed-top class -->
    <?php include_once(__DIR__ . "/partials/nav.top.black.inc.php"); ?>

    <!-- post -->
    <?php foreach ($results as $result) : $comment->setPostId($result["id"]) ?>
        <div class="mb-3 row justify-content-center" id="post">
            <div class="mb-3 col-3">
                <!-- Add username from the person who posted it -->
                <?php $username = $user->getUsernameFromId($result["user_id"]); ?>
                <a href="detail.php?id=<?php echo $result["user_id"] ?>" class="row justify-content-center text-reset text-decoration-none fw-bold">@<?php echo $username["username"]; ?></a>
            </div>
            <!-- post image -->
            <img src="./content/<?php echo $result['post_image'] ?>" class="img-fluid" alt="IMDTok-video">

            <!-- convert and post timestamp -->
            <?php date_default_timezone_set('Europe/Brussels'); ?>
            <?php $currenttime = $result['timestamp'];?> 
            <?php $timeAgo = strtotime($currenttime);?> 
            <div class = "date date_post"><?php echo $time->timeAgo($timeAgo)?> </div> 

        
            <p class="likes mt-3">
                <?php
                    $like = new Like();
                    $like->setUserId($userId);
                    $like->setPostId($result["id"]);
                    $like->loadLike();

                    $likeStatus = $like->getStatus();
                ?>

                <?php if($likeStatus === "0"): ?>
                <button class="btn btn-outline-light" data-liked="false" data-postid="<?php echo $result["id"]; ?>">Like</button>
                <?php elseif($likeStatus === NULL): ?>
                <button class="btn btn-outline-light" data-liked="null" data-postid="<?php echo $result["id"]; ?>">Like</button>
                <?php elseif($likeStatus === "1"): ?>
                <button class="btn btn-light" data-liked="true" data-postid="<?php echo $result["id"]; ?>">Liked</button>
                <?php endif; ?>

                <?php
                    $likes = Like::getNumberOfLikes($result["id"]);
                    if($likes === "1"):
                ?>
                <span id="likes__counter"><?php echo $likes; ?></span> <span class="like__text">person likes this</span>
                <?php else: ?>
                <span id="likes__counter"><?php echo $likes; ?></span> <span class="like__text">people like this</span>
                <?php endif; ?>
            </p>
            <!-- post comments -->
            <ul class="feed mb-3 post__comments__list list-group list-group-numbered">
                <?php $allComments = Comment::getAllFromId($result["id"]); ?>
                <?php date_default_timezone_set('Europe/Brussels'); ?>
                <?php foreach ($allComments as $c) :  ?>
                    <li class="mb-1 list-group-item justify-content-between rounded">
                        <div class="row ms-2 me-auto text-dark">
                            <div class="col-2">
                                <img src="./images/images.png" class="mb-3 w-100 p3 rounded" alt="IMDTok-video">
                            </div>
                            <div class="col-5">
                                <div class="">username</div>
                                <div class="fw-bold"><?php echo htmlspecialchars($c['text']) . "<br>"; ?></div>
                            
                                <!-- convert and post timestamp -->
                                <?php $currenttime = $c['timestamp'];?> 
                                <?php $timeAgo = strtotime($currenttime);?> 
                                <div class = "date date_comment"><?php echo $time->timeAgo($timeAgo)?> </div> 
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
            <!-- post comment form -->
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
    <?php include_once(__DIR__ . "/partials/nav.bottom.black.inc.php"); ?>

    <script src="js/comment.js"></script>
    <script src="js/like.js"></script>

</body>

</html>