<?php
//include auth.php file on all secure pages
include("auth.php");
$_SESSION['Usernames'];
$_SESSION['UserID'];
?>
<?php
//including the database connection file
include_once("db.php");
 
if(isset($_POST['Submit'])) { 
//Description,Startdate,Enddate,ApprovalStatus, Expirelystatus,Comments,Fullname
//LeaveID,Description,Startdate,Enddate,ApprovalStatus,Expirelystatus,Comments,Fullname,UserID   
    $Description = $_POST['Description'];
    $Startdate = $_POST['Startdate'];
    $Enddate = $_POST['Enddate'];
	$ApprovalStatus = "PENDING";
    $Expirelystatus = "PENDING";
    $Comments = "NONE";
	$Fullname = $_POST['Fullname'];
	$UserID = $_POST['UserID'];
    if(empty($Description) || empty($Startdate) || empty($Enddate)|| empty($Fullname)|| empty($UserID)) {                
        if(empty($Description)) {
            echo "<font color='red'>Description field is empty.</font><br/>";
        }
        
        if(empty($Startdate)) {
            echo "<font color='red'>Startdate field is empty.</font><br/>";
        }
        
        if(empty($Enddate)) {
            echo "<font color='red'>Enddate field is empty.</font><br/>";
        }
		 if(empty($Fullname)) {
            echo "<font color='red'>Fullname field is empty.</font><br/>";
        }
		if(empty($UserID)) {
            echo "<font color='red'>UserID field is empty.</font><br/>";
        }
        //link to the previous page
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    } else {
	$query = "SELECT * FROM `LEAVEAPPLICATIONS` WHERE Startdate='$Startdate' and Enddate='$Enddate'";
	$result = mysqli_query($con,$query) or die(mysql_error());
	$rows = mysqli_num_rows($result); 
        // if all the fields are filled (not empty)             
        //insert data to database
        //**$result = mysqli_query($mysqli, "INSERT INTO users(Description,Startdate,Enddate,ApprovalStatus,Expirelystatus,Comments,Fullname) VALUES('$Description','$Startdate','$Enddate','$ApprovalStatus','$Expirelystatus','$Comments','$Fullname')");
        
        //display success message
        //**echo "<font color='green'>system user added successfully.";
        //echo "<br/><a href='index.php'>View Result</a>";
		
		if($rows>0)
 {
  //echo "Registration Details Are Already Submitted with same unique id";
 echo '<script language="javascript">';
echo 'alert(" There is another staff who had booked leave on same dates kindly change and try again!!!!!.")';
echo '</script>';
 }
 else
 {
 echo '<script type="text/javascript">alert("Leave application Details submitted succesfully!!!!");</script>';
  //**mysql_query("insert into patients(Names,PatientID,Enddate,Startdate,Diagnosis) values('$Names','$PatientID','$Enddate','$Startdate','$Diagnosis')");
  
  //header("refresh:2;url=Location :login.php"); // really should be a fully qualified URI
  $result = mysqli_query($con, "INSERT INTO LEAVEAPPLICATIONS(Description,Startdate,Enddate,ApprovalStatus,Expirelystatus,Comments,Fullname,UserID) VALUES('$Description','$Startdate','$Enddate','$ApprovalStatus','$Expirelystatus','$Comments','$Fullname','$UserID')");
header("Location: applyforleave.php");
 
 }	
    }
}
?>
<?php
//including the database connection file
include_once("db.php");
$UserID=$_SESSION['UserID'];
//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
$result = mysqli_query($con, "SELECT * FROM LEAVEAPPLICATIONS where UserID='$UserID' ORDER BY LeaveID DESC"); // using mysqli_query instead
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
<p align="left">Welcome <?php echo $_SESSION['Usernames']; ?>!||USER ID:<?php echo $_SESSION['UserID']; ?>||Your Leave balance is:<?php echo $_SESSION['LeaveBalance']; ?></p>
<ul>
  <li><a href="staffs.php">HOME</a></li>
  <li><a href="logout.php">Logout</a></li>
</ul>
<div>




<h1 align="center">EMPLOYEES LEAVE  MANAGEMENT SYSTEM</h1>
<h2 align="center">Put Leave Request Here Below  </h2>
<div id="form" style="padding-left:350px">
<form action="applyforleave.php" method="post" name="form1">
        <table width="80%" border="0">
		
            <tr> 
                <td width="26%">Type of Leave :</td>
              <td width="37%">
			  <select name="Description">
				<option value="annual leave">Annual leave</option>
				<option value="carer’s leave">Carer’s leave</option>
				<option value="Blood donor">Blood donor</option>
				<option value="sick leave with certificate">Sick leave with certificate</option>
				<option value="sick leave without a medical certificate">Sick leave without a medical certificate</option>
				<option value="parental leave">Parental leave</option>
				<option value="unpaid leave">Unpaid leave</option>
			  </select>
			  </td>
				                <td width="2%"></td>
              <td width="35%"><input type="hidden" value="<?php echo $_SESSION['Usernames']; ?>" name="Fullname" required/></td>
            </tr>
            <tr> 
                <td>Start date:</td>
                <td><input type="text" name="Startdate" required></td>
				<td></td>
                <td><input type="hidden" value="<?php echo $_SESSION['UserID']; ?>" name="UserID" required/></td>
            </tr>
            <tr> 
                <td>End date:</td>
                <td><input type="text" name="Enddate" required/></td>
		                <td></td>
                <td><input type="submit" name="Submit" value="APPLY FOR LEAVE"></td>		
            </tr>
			<tr> 
            <td></td>
                <td></td>    
				 <td></td>
                <td></td>
            </tr>
			
    </table>
  </form>
		<h2 align="center">Leave Request History </h2>
        <table width='91%' border=2>
        <tr bgcolor='#CCCCCC'>
            <td width="5%">Description</td>
            <td width="5%">Startdate</td>
            <td width="4%">Enddate</td>
			<td width="6%">ApprovalStatus</td>
			<td width="6%">Expirelystatus</td>
			<td width="5%">Comments</td>
			<td width="4%">Fullname</td>
			<td width="65%">Update</td>
        </tr>
        <?php 
        //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array 
        while($res = mysqli_fetch_array($result)) {         
            echo "<tr>";
            echo "<td>".$res['Description']."</td>";
            echo "<td>".$res['Startdate']."</td>";
            echo "<td>".$res['Enddate']."</td>";    
			echo "<td>".$res['ApprovalStatus']."</td>";
            echo "<td>".$res['Expirelystatus']."</td>";
            echo "<td>".$res['Comments']."</td>";
			 echo "<td>".$res['Fullname']."</td>";
            echo "<td><a href=\"deleteleave.php?LeaveID=$res[LeaveID]\" onClick=\"return confirm('Are you sure you want to delete leave application?')\">Cancel</a></td>";        
        }
        ?>
  </table>
  </div>

</div>
</body>
</html>