<?php
//checks to see if input is empty
if (!empty($_POST)) {
    try {
        include_once(__DIR__ . "/classes/User.php");
        $user = new User;
        $email = $user->setEmail($_POST["email"]);
        $password = $user->setPassword($_POST["password"]);

        if ($user->canLogin($email, $password)) {
            //session start with username in it
            session_start();
            $_SESSION['user'] = $user->getEmail();
            //go to index.php
            echo "You are in!";
            header("Location: index.php");
        } else {
            $failure = "Email and/or password is wrong";
        }
    } catch (Throwable $error) {
        $error = $error->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <title>Login</title>
</head>

<body>
    <main class="sign-in container">
        <h1>Sign In</h1>
        <form id="login" method="POST" action="">
            <?php if (isset($error)) : ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>

            <?php if (isset($failure)) : ?>
                <div class="alert alert-danger"><?php echo $failure; ?></div>
            <?php endif; ?>
            <div class="mb-3">
                <label for="InputEmail" class="form-label">Email address</label>
                <input name="email" placeholder="Email" type="email" class="form-control" required />
            </div>
            <div class="mb-3">
                <label for="InputPassword" class="form-label">Password</label>
                <input name="password" placeholder="Password" type="password" class="form-control" required />
            </div>

            <div class="mb-3 d-grid gap-2">
                <button name="login" type="submit" class="btn btn-danger" value="Log in">Log In</button>
            </div>
        </form>
    </main>
</body>

</html>