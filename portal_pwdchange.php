<?php
session_start();
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private");
if(@$_SESSION['uname']== false){
header("location: portal_login.php");
exit();
}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="my_style.css"/>
</head>
<body>
<div class="container">
<div class="head">
<img src="iitk-logo.png" align="left">
<h1>Department of computer science and engineering
</br>IIT Kanpur</h1>
<h2>Event Management Portal</h2>
</div>
<div class="book">
<form name="input" action="change_pwd.php" method="post">
<p><label>Username:</label>
<input tupe="text" name="username"></p>
<p><label>CurrentPassword:</label>
<input type="password" name="pwd"></p>
<p><label>New password:</p>
<input type="password" name="pwd2"></p>
<p><label><input type="submit" value="Change Password" /></label></p>
</form>
</div>
</div>
</body>
</html>