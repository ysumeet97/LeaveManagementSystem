<?php
//include auth.php file on all secure pages
include("auth.php");
?>
<?php
//including the database connection file
include_once("db.php");
 
if(isset($_POST['Submit'])) { 
//FullName,Telphone,Email,Status, User_Type,Usernames,Passwords   
    $Dates = $_POST['Dates'];
    $HolidayName = $_POST['HolidayName'];
    if(empty($Dates) || empty($HolidayName)) {                
        if(empty($HolidayName)) {
            echo "<font color='red'>HolidayName field is empty.</font><br/>";
        }
        
        if(empty($Dates)) {
            echo "<font color='red'>Dates field is empty.</font><br/>";
        }

        //link to the previous page
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    } else {
	$query = "SELECT * FROM `publicholidays` WHERE Dates='$Dates' and HolidayName='$HolidayName'";
	$result = mysqli_query($con,$query) or die(mysql_error());
	$rows = mysqli_num_rows($result); 
        // if all the fields are filled (not empty)             
        //insert data to database
        //**$result = mysqli_query($mysqli, "INSERT INTO users(FullName,Telphone,Email,Status,User_Type,Usernames,Passwords) VALUES('$FullName','$Telphone','$Email','$Status','$User_Type','$Usernames','$Passwords')");
        
        //display success message
        //**echo "<font color='green'>system user added successfully.";
        //echo "<br/><a href='index.php'>View Result</a>";
		
		if($rows>0)
 {
  //echo "Registration Details Are Already Submitted with same unique id";
 echo '<script language="javascript">';
echo 'alert(" Public holiday Details Are Already Submitted with same date please check and register again!!!.")';
echo '</script>';
 }
 else
 {
 echo '<script type="text/javascript">alert("Public holiday registered succesfully!!!");</script>';
  //**mysql_query("insert into patients(Names,PatientID,Email,Telphone,Diagnosis) values('$Names','$PatientID','$Email','$Telphone','$Diagnosis')");
  
  //header("refresh:2;url=Location :login.php"); // really should be a fully qualified URI
  $result = mysqli_query($con, "INSERT INTO publicholidays(HolidayName,Dates) VALUES('$HolidayName','$Dates')");
header("Location: holidays.php");
 
 }	
    }
}
?>
<?php
//including the database connection file
include_once("db.php");
 
//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
$result = mysqli_query($con, "SELECT * FROM publicholidays ORDER BY HolidayID DESC"); // using mysqli_query instead
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
<style>
/* Style all input fields */
input {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
}

/* Style the submit button */
input[type=submit] {
  background-color: #4CAF50;
  color: white;
  width:205px;
}

/* Style the container for inputs */
.container {
  background-color: #f1f1f1;
  padding: 20px;
}

/* The message box is shown when the user clicks on the password field */
#message {
  display:none;
  background: #f1f1f1;
  color: #000;
  position: relative;
  padding: 20px;
  margin-top: 10px;
}

#message p {
  padding: 10px 35px;
  font-size: 18px;
}

/* Add a green text color and a checkmark when the requirements are right */
.valid {
  color: green;
}

.valid:before {
  position: relative;
  left: -35px;
  content: "✔";
}

/* Add a red text color and an "x" when the requirements are wrong */
.invalid {
  color: red;
}

.invalid:before {
  position: relative;
  left: -35px;
  content: "✖";
}
</style>
<meta charset="utf-8">
<title>Registration</title>
</head>
<body>
<p align="left">Welcome <?php echo $_SESSION['Usernames']; ?>!||User ID:<?php echo $_SESSION['UserID']; ?>!</p>
<ul>
  <li><a href="index.php">HOME</a></li>
  <li><a href="logout.php">Logout</a></li>
</ul>
<div>




<h1 align="center">EMPLOYEES LEAVE  MANAGEMENT SYSTEM</h1>
<h2 align="center">Calender For Public Holidays </h2>
<div id="form" style="padding-left:100px">
<form action="holidays.php" method="post" name="form1">
        <table width="95%" border="0" style="padding-left:-100px;">
		
            <tr> 
                <td width="12%">Holiday Name:</td>
              <td width="19%"><input type="text" name="HolidayName" required/></td>
				                <td width="15%">Date:</td>
              <td width="32%">
			  <input type="date" id="birthday" name="Dates" required/>
			  </td>
			  <td width="22%"><input type="submit" name="Submit" value="SAVE HOLIDAYS"></td>
            </tr>
    </table>
  </form>
		<h2 align="center">PUBLIC HOLIDAYS </h2>
        <table width='89%' border=2>
        <tr bgcolor='#CCCCCC'>
            <td width="9%">Holiday ID</td>
            <td width="9%">Holiday Name</td>
            <td width="6%">Dates</td>
		  </tr>
        <?php 
        //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array 
        while($res = mysqli_fetch_array($result)) {         
            echo "<tr>";
            echo "<td>".$res['HolidayID']."</td>";
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