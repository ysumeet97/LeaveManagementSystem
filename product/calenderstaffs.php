<?php
//include auth.php file on all secure pages
include("auth.php");
$_SESSION['Usernames'];
$_SESSION['UserID'];
?>
<?php
//including the database connection file
include_once("db.php");
 
//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
$result1 = mysqli_query($con, "SELECT * FROM publicholidays ORDER BY HolidayID DESC"); // using mysqli_query instead
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
<p align="left">Welcome <?php echo $_SESSION['Usernames']; ?>!||USER ID:<?php echo $_SESSION['UserID']; ?>||Your Leave balance is:<?php echo $_SESSION['LeaveBalance']; ?></p>
<ul>
  <li><a href="staffs.php">HOME</a></li>
  <li><a href="logout.php">Logout</a></li>
</ul>
<div>




<h1 align="center">EMPLOYEES LEAVE  MANAGEMENT SYSTEM</h1>
<div id="form" style="padding-left:350px">
<h2 align="center">THE CALENDER DAYS AND HOLIDAYS </h2>
        <table width='89%' border=2>
        <tr bgcolor='#CCCCCC'>
            <td width="9%">Day Name</td>
            <td width="6%">Dates</td>
		  </tr>
        <?php 
        //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array 
        while($res = mysqli_fetch_array($result1)) {         
            echo "<tr>";
            echo "<td>".$res['HolidayName']."</td>";
            echo "<td>".$res['Dates']."</td>";    
        	echo "</tr>";
        }
        ?>
  </table>
  </div>

</div>
</body>
</html>