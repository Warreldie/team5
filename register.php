<?php
if (!empty($_POST)) {
    try {
        include_once(__DIR__ . "/classes/User.php");

        // create a new user object
        $user = new User();

        // use setters to fill in data for this user All this data have to be set otherwise the user
        // will not get into the database
        $user->setUsername($_POST["username"]);
        $user->setPassword(($_POST['password']));
        $user->setDate_of_birth(($_POST['date_of_birth']));
        $user->setEmail($_POST['email']);

        // register the user by executing a query in the database
        $user->register();

        // start a session and redirect the user to index.php
        session_start();
        $_SESSION['user'] = $user->getUsername();
        header("Location: index.php");
    } catch (Throwable $error) {
        // if any errors are thrown in the class, they can be caught here
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
    <title>Aanmelden</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <main class="register container">
        <h1>Register</h1>
        <form id="register" method="POST" action="">
            <?php if (isset($error)) : ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <div class="mb-3">
                <label for="InputUsername" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Username" id="InputUsername" required>
            </div>
            <div class="mb-3">
                <label for="InputPassword" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password" id="InputPassword" required>
            </div>
            <div class="mb-3">
                <label for="InputConfirmPassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" placeholder="Confirm Password" id="InputConfirmPassword" required>
            </div>
            <div class="mb-3">
                <label for="InputDate" class="form-label">Date of birth</label>
                <input type="date" name="date_of_birth" class="form-control" id="InputDate" required>
            </div>
            <div class="mb-3">
                <label for="InputEmail" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" placeholder="Email" id="InputEmail" required>
            </div>
            <div class="mb-3 d-grid gap-2">
                <button type="submit" class="btn btn-danger">Register</button>
            </div>
        </form>
    </main>
    <script src="app.js"></script>
</body>

</html>