<?php
/*
//checks to see if input is emty
if (!empty($_POST)) {
    try {
        include_once(__DIR__ . "/classes/User.php");
        $user = new User;
        $user->setEmail($_POST["email"]);
        $user->setPassword($_POST["password"]);


        if ($user->canLogin($email, $password)) {
            //session start with username in it
            session_start();
            $_SESSION['user'] = $user->getEmail();
            //go to index.php
            echo "You are in!";
            header("Location: index.php");
        }
        
    } catch (Throwable $error) {
        $error = $error->getMessage();
        }


}
*/


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Log yourself back in..</h1>
    <form id="login" method="POST" action="">
            <?php if(isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
    
            <input name="email" placeholder="Email" type="email" required />
            <input name="password" placeholder="Password" type="password" required />
    
            
            <input name="login" type="submit" value="Log in" />
    
    </form>


</body>
</html>