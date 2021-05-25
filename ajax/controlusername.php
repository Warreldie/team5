<?php
if (!empty($_POST)) {
    //get all usernames
    include_once(__DIR__ . "/../classes/User.php");
    $allUsers = User::getAllUsernames();
    //Get input text
    $input = $_POST["text"];
    //Compare whether input text is in an array of usernames
    $InsideArray = in_array($input, $allUsers);
    if ($InsideArray) {
        $response = [
            "status" => "succes",
            "message" => "This username is already in use."
        ];
        header("Content-Type: application/json");
        echo json_encode($response);
    } else {
        $error = "Username not in database";
    }
    //Return succes
}
