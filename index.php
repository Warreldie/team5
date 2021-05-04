<?php
    include_once(__DIR__ . "../../team5/helpers/Security.php");
    include_once(__DIR__ . "/classes/Post.php");
    $post = new Post();
    $results = $post->getPosts();


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

    <body class="bg-dark text-white">
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link text-white" href="#">Following</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="#">For You</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="logout.php">Logout</a>
            </li>
        </ul>


        <div class="post">
                <?php foreach($results as $result): ?>
                        <img src="./content/<?php echo $result['post_image'] ?>" class="img-fluid" alt="IMDTok-video">
                <?php endforeach; ?>

            <p class="likes">
                <a href="#">Like</a>
                <span id="likes__counter">2</span> people like this
            </p>
        
            <div class="post__comments">
                <div class="post__comments__form">
                    <input type="text" id="commentText" placeholder="What's on your mind">
                    <a href="#" class="btnAddCom" id="btnAddComment" data-postid="3">Add comment</a>
            </div>  
            
            <ul class="post__comments__list">
                <li>This is a first comment</li>  
            </ul>
        </div>


        <ul class="navbar navbar-fixed-bottom navbar-inverse">
            <a class="nav-link text-white" href="#">Home</a>
            <a class="nav-link text-white" href="#">Discover</a>
            <a class="nav-link text-white" href="upload.php">New</a>
            <a class="nav-link text-white" href="#">Inbox</a>
            <a class="nav-link text-white" href="#">Me</a>
        </ul>

        <script src="comment.js"></script>

    </body>

</html>