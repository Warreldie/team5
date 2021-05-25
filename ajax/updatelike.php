<?php

    include_once(__DIR__ . "/../classes/Db.php");
    include_once(__DIR__ . "/../classes/Like.php");

    if(!empty($_POST)) {

        $userId = 16; // Test value
        $postId = $_POST["postId"];
        $status = $_POST["status"];

        $like = new Like();
        $like->setUserId($userId);
        $like->setPostId($postId);
        $like->setStatus($status);

        if(($status === "true") || ($status === "false")) {
            $like->updateStatus();
        } else if($status === "null") {
            $like->saveLike();
        }

        $response = [
            "status" => "success",
            "message" => "Updated like."
        ];

        header("Content-Type: application/json");
        echo json_encode($response);

    }