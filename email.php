<?php
include_once(__DIR__ . "/helpers/Security.php");
session_start();

if (!empty($_POST)){

    try {
        include_once(__DIR__ . "/classes/User.php");
        $user=new User();
        $user->setEmail($_POST["email"]);
        


        //checks if email matches email from databank
        if($user->checkEmail()){
                
           // checks if new email = confirm email
           if (($_POST["email_new"])===($_POST["email_conf"])){
                
                //sets new email
                $user->setEmail_new($_POST["email_new"]);

                // saves new email by executing a query in the database
                $user->saveEmail();
                $success = "Email changed";

            }else{
                $failure = "New email and confirm email don't match";
            }

        }else{
            $failure = "Current mail doesn't match";
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
    <title>Change email</title>
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
        
    <label>Current Email</label>
    <div><input name="email" placeholder="Current email" type="email" required /></div>
    
    <label>New Email</label>
    <div><input name="email_new" placeholder="New email" type="email" required /></div>

    <label>Confirm Email</label>
    <div><input name="email_conf" placeholder="Confirm email" type="email" required /></div>

    <button type="submit">Save</button>

</form>


			
</body>
</html>