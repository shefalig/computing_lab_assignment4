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
<form name="input" action="check.php" method="post">
<p><label>date(yyyy-mm-dd)</label>
<input type="text" name="new_date"/></p>
<p><label>time</label>
<select name="new_time">
<option>8:00</option>
<option>9:00</option>
<option>10:00</option>
<option>11:00</option>
<option>12:00</option>
<option>13:00</option>
<option>14:00</option>
<option>15:00</option>
<option>16:00</option>
<option>17:00</option>
<option>18:00</option>
<option>19:00</option>
<option>20:00</option>
</select></p>
<p><label>event</label>
 <input type="text" name="new_event"/></p>
<p><label> room no</label>
<select name="new_room">
<option>cs101</option>
<option>cs102</option>
</select></p>
<p><label><input type="submit" value="Book" /></label></p>
</form></br>
<p><label><a href="portal_login.php"><i>Back to home page</i></a></label></p>
</div>
</div>
</body>
</html>