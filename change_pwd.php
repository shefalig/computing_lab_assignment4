<?php
session_start();
?>
<html>
<head>
<script>
function function1()
{
alert("Incorrect Password");
}
function function2()
{
alert("Password changed");
}
function function3()
{
alert("Username doesnot exists");
}
</script>
</head>
<body>
<?php
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("test", $con);
$escapedName = mysql_real_escape_string($_POST['username']);
$escapedPW = mysql_real_escape_string($_POST['pwd']);
$new_escapedPW = mysql_real_escape_string($_POST['pwd2']);
$result = mysql_query("SELECT salt FROM logs WHERE name = '$escapedName'");
$row = mysql_fetch_assoc($result);
$salt = $row['salt'];
$saltedPW =  $escapedPW . $salt;
$hashedPW = hash('sha256', $saltedPW);
$result3 = mysql_query("SELECT * FROM logs WHERE name = '$escapedName'");
if(mysql_num_rows($result3) <= 0) 
{
echo "<script> function3();window.location.href='portal_pwdchange.php';</script>";
}
$result2 = mysql_query("SELECT * FROM logs WHERE name = '$escapedName' AND password = '$hashedPW'");
if(mysql_num_rows($result2) > 0) 
{
$new_salt = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
$new_saltedPW =  $new_escapedPW . $new_salt;
$new_hashedPW = hash('sha256', $new_saltedPW);
mysql_query("UPDATE logs SET password='$new_hashedPW' ,salt='$new_salt' WHERE name='$escapedName' ");
echo "<script> function2();window.location.href='portal_menu.php';</script>";
}
else
{
echo "<script> function1();window.location.href='portal_pwdchange.php';</script>";
}
mysql_close($con);
?>
</body>
</html>