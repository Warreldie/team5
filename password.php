<?php

include_once(__DIR__ . "/helpers/Security.php");


    if (!empty($_POST)){

        try {
          
            include_once(__DIR__ . "/classes/User.php");
            $user = new User();
            $user->setPassword($_POST["password"]);
            
            //checks if password matches password from databank
            if($user->checkPassword()){
                
                // checks if new password = confirm password
                if (($_POST["password_new"])===($_POST["password_conf"])){

                    //sets new password
                    $user->setPassword_new($_POST["password_new"]);

                    // saves  new password by executing a query in the database
                    $user->savePassword();
                    $success = "Password changed";

                }else{
                    $failure = "New password and confirm password don't match";
                }
            }else{
                $failure = "Current password doesn't match";
            }

        } catch (Throwable $th) {

        }
    }



?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change password</title>
</head>
<body>
<a href="profile_settings.php"> <- back </a>

        <?php if(isset($success)): ?>
            <div class="success"> <?php echo $success;?> </div>
        <?php endif; ?>

        <?php if(isset($failure)): ?>
            <div class="failure"> <?php echo $failure;?> </div>
        <?php endif; ?>

<form method="post" action>

    <label>Current Password</label>
    <div><input name="password" placeholder="Current password" type="password" required /></div>

    <label>New Password</label>
    <div><input name="password_new" placeholder="New password" type="password" required /></div>

    <label>Confirm Password</label>
    <div><input name="password_conf" placeholder="Confirm password" type="password" required /></div>


    <button type="submit">Save</button>

</form>


			
</body>
</html>