<?php
    //session start with username in it
    session_start();

    if(isset ($_SESSION['user'])){
        //user is logged in
        //echo "Welcome " . $_SESSION['user'];
    

        //include_once(__DIR__ . "/helpers/Security.php"); 
        include_once(__DIR__ . "/classes/Post.php");
            $post = new Post();
            $results = $post->getPosts();

        include_once(__DIR__ . "/classes/Comment.php");
        
            $comment = new Comment();
            //test postId = 3
        
            
            $timeAgo = $comment->getTimeStamp();
            
                // time to time ago
                $now = new DateTime();
                $past = new DateTime($timeAgo['timestamp']); 

                    $interval = $now->diff($past);
                    

                    $elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');

            
                   

    }else{
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

    <?php foreach($results as $result): 
        
        var_dump($result);
        ?>

        <div class="post">
                
                        <img src="./content/<?php echo $result['post_image'] ?>" class="img-fluid" alt="IMDTok-video">

                
                    
            <p class="likes">
                <a href="#">Like</a>
                <span id="likes__counter">2</span> people like this
            </p>
        
            <div class="post__comments">
                <div class="post__comments__form">

                    <form method="post" action>
                    <input type="text" id="commentText" name="commentText" placeholder="What's on your mind">
                     

                    <button type="submit" class="btnAddCom" id="btnAddComment" data-postid="<?php echo $result["id"] ?>">Add comment</button>
                    <!-- need to print primary key from database into data-postid -->

                    </form>
                </div>  
            </div>
            
            <ul class="post__comments__list">

           <?php $allComments = Comment::getAllFromId($result["id"]); ?>
                <?php foreach($allComments as $c): ?>
                    
                    <li>
                        <?php echo htmlspecialchars($c['text']). "<br>";?>  <!-- preventing XSS attack  -->
                        <?php //echo $elapsed; ?>
                   </li>  
                   
            <?php endforeach; ?>
            </ul>
         
        </div>
    <?php endforeach; ?>    
        
        <ul class="navbar navbar-fixed-bottom navbar-inverse">
            <a class="nav-link text-white" href="#">Home</a>
            <a class="nav-link text-white" href="#">Discover</a>
            <a class="nav-link text-white" href="upload.php">New</a>
            <a class="nav-link text-white" href="#">Inbox</a>
            <a class="nav-link text-white" href="profile.php">Me</a>
        </ul>

       <script src="comment.js"></script>

    </body>

</html>