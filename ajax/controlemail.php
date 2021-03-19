<?php
if (!empty($_POST)) {
    //get all usernames
    include_once(__DIR__ . "/../classes/User.php");
    $allUsers = User::getAllEmails();
    
    //Get input text
    $input = $_POST["text"];

    //Vergelijk of input text in array van usernames zit

    $InsideArray = in_array($input, $allUsers);
    if($InsideArray){
        $response = [
            "status" => "succes",
            "message" => "Dit email is al in gebruik."
        ];

        header("Content-Type: application/json");
        echo json_encode($response);
    }else{
        $error = "Email not in database";
    }
    //succes teruggeven
}