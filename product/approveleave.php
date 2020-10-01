<?php
//include auth.php file on all secure pages
include("auth.php");
$_SESSION['Usernames'];
$_SESSION['UserID'];
?>
<?php
//including the database connection file
include_once("db.php");
 $UserID=$_SESSION['UserID'];
//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
$result = mysqli_query($con, "SELECT * FROM LEAVEAPPLICATIONS ORDER BY LeaveID DESC"); // using mysqli_query instead
?>
<!DOCTYPE html>
<html>
<head>
<link href="style.css" rel="stylesheet">
<style>
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
<body style="background-color:#99FFCC;">
<p align="left">Welcome <?php echo $_SESSION['Usernames']; ?>!||USER ID:<?php echo $_SESSION['UserID']; ?></p>
<ul>
  <li><a href="managers.php">HOME</a></li>
  <li><a href="logout.php">Logout</a></li>
</ul>
<div>
<h1 align="center">EMPLOYEES LEAVE  MANAGEMENT SYSTEM</h1>
<h2 align="center">Approve the applied leave </h2>
<div id="form" style="padding-left:50px">
        <table width='99%' border=2>
        <tr bgcolor='#CCCCCC'>
            <td width="14%">Description</td>
            <td width="11%">Start Date</td>
            <td width="13%">End Date</td>
			<td width="16%">Approval Status</td>
			<td width="16%">Expirely Status</td>
			<td width="12%">Comments</td>
			<td width="10%">Fullname</td>
			<td width="8%">Update</td>
        </tr>
        <?php 
        //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array 
        while($res = mysqli_fetch_array($result)) { 
		if( $res['ApprovalStatus']=="accepted")
		{  
		$color="background-color: green; color: White;";    
            echo "<tr>";
            echo "<td>".$res['Description']."</td>";
            echo "<td>".$res['Startdate']."</td>";
            echo "<td>".$res['Enddate']."</td>";    
			echo "<td style='$color'>".$res['ApprovalStatus']."</td>";
            echo "<td>".$res['Expirelystatus']."</td>";
            echo "<td>".$res['Comments']."</td>";
			 echo "<td>".$res['Fullname']."</td>";
            echo "<td><a href=\"approvingleave.php?LeaveID=$res[LeaveID]\" onClick=\"return confirm('Are you sure you want to Approve?')\">Approve</a></td>";
			}
			else if( $res['ApprovalStatus']=="Rejected")
		{ 
		$color="background-color: Red; color: White;";    
            echo "<tr>";
            echo "<td>".$res['Description']."</td>";
            echo "<td>".$res['Startdate']."</td>";
            echo "<td>".$res['Enddate']."</td>";    
			echo "<td style='$color'>".$res['ApprovalStatus']."</td>";
            echo "<td>".$res['Expirelystatus']."</td>";
            echo "<td>".$res['Comments']."</td>";
			 echo "<td>".$res['Fullname']."</td>";
            echo "<td><a href=\"approvingleave.php?LeaveID=$res[LeaveID]\" onClick=\"return confirm('Are you sure you want to Approve?')\">Approve</a></td>";
		}
		else if( $res['ApprovalStatus']=="pending")
		{ 
		$color="background-color: Yellow; color: Blue;";    
            echo "<tr>";
            echo "<td>".$res['Description']."</td>";
            echo "<td>".$res['Startdate']."</td>";
            echo "<td>".$res['Enddate']."</td>";    
			echo "<td style='$color'>".$res['ApprovalStatus']."</td>";
            echo "<td>".$res['Expirelystatus']."</td>";
            echo "<td>".$res['Comments']."</td>";
			 echo "<td>".$res['Fullname']."</td>";
            echo "<td><a href=\"approvingleave.php?LeaveID=$res[LeaveID]\" onClick=\"return confirm('Are you sure you want to Approve?')\">Approve</a></td>";
		}
		else
		{
		$color="color: pink";    
            echo "<tr>";
            echo "<td>".$res['Description']."</td>";
            echo "<td>".$res['Startdate']."</td>";
            echo "<td>".$res['Enddate']."</td>";    
			echo "<td style='$color'>".$res['ApprovalStatus']."</td>";
            echo "<td>".$res['Expirelystatus']."</td>";
            echo "<td>".$res['Comments']."</td>";
			 echo "<td>".$res['Fullname']."</td>";
            echo "<td><a href=\"approvingleave.php?LeaveID=$res[LeaveID]\" onClick=\"return confirm('Are you sure you want to Approve?')\">Approve</a></td>";
		}
			       
        }
        ?>
  </table>
  </div>

</div>
</body>
</html>