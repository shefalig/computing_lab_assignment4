<html>
<head>
<script>
function function1()
{
alert("sorry!,username already exists");
}
function function2()
{
alert("Passwords donot match");
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
$escapedName = mysql_real_escape_string($_POST['username']); # use whatever escaping function your db requires this is very important.
$escapedPW = mysql_real_escape_string($_POST['pwd']);
$escapedPW2 = mysql_real_escape_string($_POST['pwd2']);
$result = mysql_query("SELECT * FROM logs WHERE name = '$escapedName' ");
if(mysql_num_rows($result) > 0) 
echo "<script>function1();window.location.href='portal_register.php';</script>";
else if($escapedPW !=$escapedPW2)
echo "<script>function2();window.location.href='portal_register.php';</script>";
else
{
$salt = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
$saltedPW =  $escapedPW . $salt;
$hashedPW = hash('sha256', $saltedPW);
mysql_query("INSERT INTO `test`.`logs` (`name`, `password`, `salt`) VALUES ('$escapedName', '$hashedPW', '$salt')");
header("Location:portal_login.php");
exit;
}
mysql_close($con);
?>
</body>
</html>