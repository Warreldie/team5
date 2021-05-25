<?php
include_once(__DIR__ . "/../classes/Db.php");
include_once(__DIR__ . "/../classes/Comment.php");
if (!empty($_POST)) {
    //New comment
    $c = new Comment();
    $c->setPostId($_POST['postId']); //Test, use data from $_SESSION
    $c->setText($_POST['text']);
    $c->setUserId(20); //Test, use data from $_SESSION
    //Save()
    $c->save();
    //Success message
    $response = [
        'status' => 'success',
        'body' => htmlspecialchars($c->getText()), //Avoiding injection with special scripts
        'message' => 'Comment saved'
    ];
    header('Content-Type: application/json');
    echo json_encode($response); //Giving back json data by encoding the php array
}
