<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aanmelden</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1>Aanmelden</h1>
        <form id="register" method="POST">
            <div class="mb-3">
                <label for="InputUsername" class="form-label">Username</label>
                <input type="text" class="form-control" placeholder="Username" id="InputUsername">
            </div>
            <div class="mb-3">
                <label for="InputPassword" class="form-label">Password</label>
                <input type="password" class="form-control" placeholder="Password" id="InputPassword">
            </div>
            <div class="mb-3">
                <label for="InputConfirmPassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" placeholder="Confirm Password" id="InputConfirmPassword">
            </div>
            <div class="mb-3">
                <label for="InputDate" class="form-label">Wanneer ben je geboren</label>
                <input type="date" class="form-control" id="InputDate">
            </div>
            <div class="mb-3">
                <label for="InputEmail" class="form-label">Email address</label>
                <input type="email" class="form-control" placeholder="Email" id="InputEmail">
            </div>
            <div class="mb-3 d-grid gap-2">
                <button type="submit" class="btn btn-danger">Aanmelden</button>
            </div>
        </form>
    </div>
    <script src="app.js"></script>
</body>

</html>