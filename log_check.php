<html>
<head>
<script>
function function1()
{
alert("Incorrect password");
}
function function2()
{
alert("Username does not exists");
}
</script>
</head>
<body>
<?php
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private");
session_start();
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("test", $con);
$escapedName = mysql_real_escape_string($_POST['username']);
$escapedPW = mysql_real_escape_string($_POST['pwd']);
$result = mysql_query("SELECT salt FROM logs WHERE name = '$escapedName'");
if(mysql_num_rows($result) <= 0)
{
 echo "<script>function2();window.location.href='portal_login.php';</script>";
}
$row = mysql_fetch_assoc($result);
$salt = $row['salt'];

$saltedPW =  $escapedPW . $salt;

$hashedPW = hash('sha256', $saltedPW);

//$query = "select * from user where name = '$escapedName' and password = '$hashedPW'; ";
$result2 = mysql_query("SELECT * FROM logs WHERE name = '$escapedName' AND password = '$hashedPW'");
if(mysql_num_rows($result2) > 0) 
{
$_SESSION['uname']=$escapedName;
header("Location: portal_menu.php");
exit();
}
else
echo "<script>function1();window.location.href='portal_login.php';</script>";

mysql_close($con);
?>

</body>
</html>