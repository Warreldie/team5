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
<input name="password" placeholder="Current password" type="password" required />
<input name="password_new" placeholder="New password" type="password" required />
<input name="password_conf" placeholder="Confirm password" type="password" required />
				

</form>

<button type="button"><a href="profile_settings.php"> Save </a></button>
			
</body>
</html>