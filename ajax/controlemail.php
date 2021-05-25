<?php
if (!empty($_POST)) {
    //Get all emails
    include_once(__DIR__ . "/../classes/User.php");
    $allUsers = User::getAllEmails();
    //Get input text
    $input = $_POST["text"];
    //Compare whether input text is in an array of emails
    $InsideArray = in_array($input, $allUsers);
    if ($InsideArray) {
        $response = [
            "status" => "succes",
            "message" => "This email is already in use."
        ];
        header("Content-Type: application/json");
        echo json_encode($response);
    } else {
        $error = "Email not in database";
    }
    //Return succes
}
