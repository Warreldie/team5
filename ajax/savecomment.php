<?php

include_once(__DIR__ . "/../classes/Comment.php");
include_once(__DIR__ . "/../classes/Db.php");

   
    if(!empty($_POST)){
        //new comment
        $c = new Comment();
        $c->setPostId(3); // test, use data from $_SESSION
        $c->setText($_POST['text']);
        $c->setUserId(20); // test, use data from $_SESSION

    

        //save()
        $c->save();

        //success message
        $response = [
            'status' => 'success',
            'body' =>htmlspecialchars($c->getText()), //avoiding injection with special scripts
            'message' => 'Comment saved'

        ];

        header('Content-Type: application/json');
        echo json_encode($response); // giving back json data by encoding the php array

    }

?>