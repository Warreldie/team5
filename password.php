<?php
    session_start();
    
    include_once(__DIR__ . "/User.php");


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change password</title>
</head>
<body>
<a href="profile_sett.php"> <- back </a>
<form method="post" action>
			<input name="current password" placeholder="current password" type="password" required/>
			<input name="new password" placeholder="new password" type="password" required/>
            <input name="confirm password" placeholder="confirm password" type="password" required/>
</form>

<button type="button"><a href="profile_sett.php"> Save </a></button>
			
</body>
</html>