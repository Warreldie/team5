<?php
include_once(__DIR__ . "/../classes/Follow.php");
include_once(__DIR__ . "/../classes/User.php");
session_start();
if (!empty($_POST)) {
    //new following
    $following = new Follow();
    $following->setFollow($_POST["following_id"]);
    //$countfollowing = $following->CountFollowing();
    //get Follower
    $user = new User();
    $userid = $user->getUserId($_SESSION["user"]);
    $following->setFollower($userid[0]["id"]);
    //if following and follower isn't active
    $active = $following->active();
    if ($active) {
        $following->UnFollow();
        $response = [
            'status' => 'succes',
            'body' => 'Follow',
            'message' => "Already Following"
        ];
    } else {
        //save
        $exist = $following->exist();
        if (!($exist)) {
            $following->save();
        } else {
            $following->Following();
        }
        //succes teruggeven
        $response = [
            'status' => 'succes',
            'body' => 'UnFollow',
            'message' => "Follow saved"
        ];
    }
    header('Content-type: application/json');
    echo json_encode($response);
}
