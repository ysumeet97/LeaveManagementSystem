<?php
//include auth.php file on all secure pages
include("auth.php");
?>
<!DOCTYPE html>
<html>
<head>
<link href="style.css" rel="stylesheet">
<style>
body
{
background-color:#FFFFCC;
}
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333333;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 16px;
  text-decoration: none;
}

li a:hover {
  background-color: #111111;
}
</style>
<meta charset="utf-8">
<title>Registration</title>
</head>
<body>
<p align="left">Welcome <?php echo $_SESSION['Usernames']; ?>!||USER ID:<?php echo $_SESSION['UserID']; ?></p>
<ul>
  <li><a href="Registerstaffs.php">Create Accounts</a></li>
 <li><a href="holidays.php">Add Holidays</a></li>
 <li><a href="managers.php">Manager Account</a></li>
  <li><a href="logout.php">Logout</a></li>
 
</ul>
<div >
<h1 align="center">EMPLOYEES LEAVE  MANAGEMENT SYSTEM</h1>
</div>
</body>
</html>