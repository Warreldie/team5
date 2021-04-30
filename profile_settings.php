<?php
    include_once(__DIR__ . "/classes/User.php");
    
    if (!empty($_POST)){
       
        $user = new User();

        $user->setBio($_POST['bio']);

       // saves bio by executing a query in the database
        $user->saveBio();
        $success = "Bio changed";
    }else{
        $failure = "Bio wasn't changed";
    }


    $user = User::getAllBio();

    $user = User::getAllEmail();

    $user = User::getAllName();

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change profile</title>
</head>
<body>
    <a href="profile.php"> <- back </a>
    
    <button type="button"><a href="profile-picture.php">Upload profile picture</a></button>
    
    <img><p>profile_image</p>

    <h3>Username</h3>
        <?php foreach($user as $u): ?>
            <p><?php echo $u["username"]; ?></p>
        <?php endforeach; ?>

    <h3>Email</h3>
         <?php foreach($user as $u): ?>
            <p><?php echo $u["email"]; ?></p>
        <?php endforeach; ?>

    <button type="button"><a href="email.php"> Change email </a></button>

    <h3>Bio</h3>
        <?php foreach($user as $u): ?>
            <p><?php echo $u["bio"]; ?></p>
        <?php endforeach; ?>

    <form method="post" action>
        <label>Change Bio</label>
        <div><input name="bio" placeholder="Write your bio here" type="text" size="30"/></div>
        <button type="submit">Save</button>
    </form>
    

    <h3>Password</h3>
    <div><button type="button"><a href="password.php"> Change password </a></button></div>