<?php
    session_start();
    include_once(__DIR__ . "/User.php");

    //checks login
    $loggedin = true;
        if(!$loggedin){
            header("Location: login.php");
        }
    
    //checks if password is the same as password in the database
   /* if (!empty($_POST['password'])){
        try{
            $user = new User();
            $password = $_POST['password'];
        
        }catch (Throwable $th) {
            $error = $th->getMessage();
        }

    }
    */

    if (!empty($_POST)){

        try {
            $user = new User();
            $user->setPassword_new($_POST["password_new"]);
            $user->setPassword_conf($_POST["password_conf"]);
       

            if($password_new === $password_conf){
                $user->save_password();
                $success = "Password changed";

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
        <?php if (isset($error)): ?>
            <div class="error"> <?php echo $error;?> </div>
        <?php endif; ?>

        <?php if (isset($success)): ?>
            <div class="success"> <?php echo $success;?> </div>
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