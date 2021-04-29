<?php
session_start();
include_once(__DIR__ . "/User.php");

if (!empty($_POST)){

    try {
        include_once(__DIR__ . "/User.php");

        $user=new User();
        
        $user->setEmail($_POST["email"]);
        $user->setEmail_new($_POST["email_new"]);
        $user->setEmail_conf($_POST["email_conf"]);


        //checks if email matches email from databank
        if($user->check_email($email)){
                
            // checks if new email = confirm email
            if($email_new === $email_conf){
                
                // saves new email by executing a query in the database
                $user->save_email();
                $success = "Email changed";

            }else{
                $failure = "New email and confirm email don't match";
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
    <title>Change email</title>
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

    <label>Current Email</label>
    <div><input name="email" placeholder="Current email" type="email" required /></div>
    
    <label>New Email</label>
    <div><input name="email_new" placeholder="New email" type="email" required /></div>

    <label>Confirm Email</label>
    <div><input name="email_conf" placeholder="Confirm email" type="email" required /></div>

</form>

<button type="submit">Save</button>
			
</body>
</html>