<?php
include_once(__DIR__ . "/../classes/Follow.php");
include_once(__DIR__ . "/../classes/User.php");
session_start();
if (!empty($_POST)) {
    //New following
    $following = new Follow();
    $following->setFollow($_POST["following_id"]);
    //$countfollowing = $following->CountFollowing();
    //Get Follower
    $user = new User();
    $userid = $user->getUserId($_SESSION["user"]);
    $following->setFollower($userid[0]["id"]);
    //If following and follower isn't active
    $active = $following->active();
    if ($active) {
        $following->UnFollow();
        $response = [
            'status' => 'succes',
            'body' => 'Follow',
            'message' => "Already Following"
        ];
    } else {
        //Save
        $exist = $following->exist();
        if (!($exist)) {
            $following->save();
        } else {
            $following->Following();
        }
        //Return succes
        $response = [
            'status' => 'succes',
            'body' => 'UnFollow',
            'message' => "Follow saved"
        ];
    }
    header('Content-type: application/json');
    echo json_encode($response);
}
