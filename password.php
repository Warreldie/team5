<?php
    session_start();

    if (!empty($_POST)){

        try {
            include_once(__DIR__ . "/classes/User.php");

            $user = new User();
            
            $user->setPassword($_POST["password"]);
            $user->setPassword_new($_POST["password_new"]);
            $user->setPassword_conf($_POST["password_conf"]);
       
            //checks if password matches password from databank
            if($user->check_password($password)){
                
                // checks if new password = confirm password
                if($password_new === $password_conf){
                    
                    // saves  new password by executing a query in the database
                    $user->save_password();
                    $success = "Password changed";

                }else{
                    $failure = "New password and confirm password don't match";
                }
            }

        } catch (Throwable $th) {
            $error = $th->getMessage();
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

<form method="post" action>
        <?php if(isset($error)): ?>
            <div class="error"> <?php echo $error;?> </div>
        <?php endif; ?>

        <?php if(isset($success)): ?>
            <div class="success"> <?php echo $success;?> </div>
        <?php endif; ?>

        <?php if(isset($failure)): ?>
            <div class="failure"> <?php echo $failure;?> </div>
        <?php endif; ?>
    
    <label>Current Password</label>
    <div><input name="password" placeholder="Current password" type="password" required /></div>

    <label>New Password</label>
    <div><input name="password_new" placeholder="New password" type="password" required /></div>

    <label>Confirm Password</label>
    <div><input name="password_conf" placeholder="Confirm password" type="password" required /></div>

</form>

<button type="submit">Save</button>
			
</body>
</html>