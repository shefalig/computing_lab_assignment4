<?php
session_start();
?>
<html>
<head>
<script>
function function1()
{
alert("Sorry!,Room cant be booked for given date and time.It has been already booked");
}
function function2()
{
alert("Your event is booked");
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
$ndate=$_POST["new_date"];
$ntime=$_POST["new_time"];
$nroom=$_POST["new_room"];
$nevent=$_POST["new_event"];
$result = mysql_query("SELECT * FROM cs_events WHERE room='$nroom' AND event_date='$ndate' AND start_time='$ntime'");
if(mysql_num_rows($result) > 0)
{
echo "<script>function1();window.location.href='portal_book.php';</script>";
}
else
{
mysql_query("INSERT INTO `test`.`events` (`date`, `time`, `event`, `room`) VALUES ('$ndate', '$ntime', '$nevent', '$nroom')");
echo "<script> function2();window.location.href='portal_menu.php';</script>";
}
mysql_close($con);
?>
</body>
</html>