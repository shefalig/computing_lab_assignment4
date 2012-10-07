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
<title>event management website</title>
<body>
<div class="container">
<div class="head">
<img src="iitk-logo.png" align="left">
<h1>Department of computer science and engineering
</br>IIT Kanpur
</h1>
<h2>Welcome to the event management portal of the department!</h2>
</br></br>
</div>
<div class="menu">
<h2 class="a"><a href="portal_book.php">Book room for an event</a></h2>
<h2 class="a"><a href="portal_pwdchange.php">Change Password</a></h2>
<h2 class="a"><a href="portal_logout.php?logout=true">Logout</a></h2>
</div>
<div class="para">
<h2>This week's events</h2>
<?php
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("test", $con);
echo "<table border=1 width=650 align=center cellpadding=4 cellspacing=0>"; 
echo "<tr>"; 
echo "<td width=35%>DATE</td>"; 
echo "<td width=20%>TIME</td>"; 
echo "<td width=20%>ROOM</td>"; 
echo "<td width=20%>EVENT</td>"; 
echo "</tr>";
for ($i=0; $i<7; $i++)
{
$result = mysql_query("SELECT * FROM events WHERE date=CURDATE()+$i ORDER BY time");
if (!$result) {
die("Query to show fields from table failed");
}
$fields_num = mysql_num_fields($result);
while($row = mysql_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['date'] . "</td>";
$parts = explode(':', $row['time']);
$hours = (int) $parts[0];
$minutes = (int) $parts[1];
echo "<td>" .$hours . ":" . $minutes . "0"."</td>";
echo "<td>" .$row['event'] . "</td> " ;
echo "<td>" .$row['room'] . "</td>"; 
echo "<tr />";
echo "</tr>\n";
}
}
mysql_close($con);
?>
</div>
</div>
</body>
</html>