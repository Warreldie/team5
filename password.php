<?php
include_once(__DIR__ . "/helpers/Security.php");
session_start();

if (!empty($_POST)) {
    try {
        include_once(__DIR__ . "/classes/User.php");
        $user = new User();
        $user->setPassword($_POST["password"]);
        //Checks if password matches password from databank
        if ($user->checkPassword()) {
            //Checks if new password = confirm password
            if (($_POST["password_new"]) === ($_POST["password_conf"])) {
                //Sets new password
                $user->setPasswordNew($_POST["password_new"]);
                //Saves new password by executing a query in the database
                $user->savePassword();
                $success = "Password changed";
            } else {
                $failure = "New password and confirm password don't match";
            }
        } else {
            $failure = "Current password doesn't match";
        }
    } catch (Throwable $th) {
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
    <title>Change password</title>
</head>

<body>
    <a class="mb-3 page-link" href="profile_settings.php" aria-label="Previous">
        <span aria-hidden="true">&larr;</span>
    </a>

    <form method="post" action>
        <div class="password container">
            <?php if (isset($success)) : ?>
                <div class="success alert alert-success"> <?php echo $success; ?> </div>
            <?php endif; ?>

            <?php if (isset($failure)) : ?>
                <div class="failure alert alert-danger"> <?php echo $failure; ?> </div>
            <?php endif; ?>
            <h1>Change Password</h1>
            <div class="mb-3">
                <label for="CurrentPassword" class="form-label">Current Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password" id="CurrentPassword" required>
            </div>
            <div class="mb-3">
                <label for="NewPassword" class="form-label">New Password</label>
                <input type="password" name="password_new" class="form-control" placeholder="New Password" id="NewPassword" required>
            </div>
            <div class="mb-3">
                <label for="ConfirmPassword" class="form-label">Confirm Password</label>
                <input type="password" name="password_conf" class="form-control" placeholder="Confirm Password" id="ConfirmPassword" required>
            </div>
            <div class="mb-3 d-grid gap-2">
                <button type="submit" class="btn btn-outline-dark">Save</button>
            </div>
        </div>
    </form>
    <!-- navbar bottom -->
    <?php include_once(__DIR__ . "/partials/nav.bottom.white.inc.php"); ?>
</body>

</html>