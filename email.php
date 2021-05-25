<?php
include_once(__DIR__ . "/helpers/Security.php");
session_start();

if (!empty($_POST)) {
    try {
        include_once(__DIR__ . "/classes/User.php");
        $user = new User();
        $user->setEmail($_POST["email"]);
        //Checks if email matches email from databank
        if ($user->checkEmail()) {
            //Checks if new email = confirm email
            if (($_POST["email_new"]) === ($_POST["email_conf"])) {
                //Sets new email
                $user->setEmailNew($_POST["email_new"]);
                //Saves new email by executing a query in the database
                $user->saveEmail();
                $success = "Email changed";
            } else {
                $failure = "New email and confirm email don't match";
            }
        } else {
            $failure = "Current mail doesn't match";
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
    <title>Change email</title>
</head>

<body>
    <a class="mb-3 page-link" href="profile_settings.php" aria-label="Previous">
        <span aria-hidden="true">&larr;</span>
    </a>

    <form method="post" action>
        <div class="email container">
            <?php if (isset($success)) : ?>
                <div class="success alert alert-success"> <?php echo $success; ?> </div>
            <?php endif; ?>

            <?php if (isset($failure)) : ?>
                <div class="failure alert alert-danger"> <?php echo $failure; ?> </div>
            <?php endif; ?>
            <h1>Change Email</h1>
            <div class="mb-3">
                <label for="InputEmail" class="form-label">Current Email</label>
                <input type="email" name="email" class="form-control" placeholder="Current Email" id="CurrentEmail" required>
            </div>
            <div class="mb-3">
                <label for="InputEmail" class="form-label">New Email</label>
                <input type="email" name="email_new" class="form-control" placeholder="New Email" id="NewEmail" required>
            </div>
            <div class="mb-3">
                <label for="InputEmail" class="form-label">Confirm Email</label>
                <input type="email" name="email_conf" class="form-control" placeholder="Confirm Email" id="ConfirmEmail" required>
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