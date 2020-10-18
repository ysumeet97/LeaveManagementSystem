<?php
//include auth.php file on all secure pages
include("auth.php");
?>
<?php
//including the database connection file
include_once("db.php");
 
if(isset($_POST['Submit'])) { 
//FullName,Telphone,Email,Status, User_Type,Usernames,Passwords   
    $FullName = $_POST['FullName'];
    $Telphone = $_POST['Telphone'];
    $Email = $_POST['Email'];
	$Status = $_POST['Status'];
    $User_Type = $_POST['User_Type'];
    $Usernames = $_POST['Usernames'];
	$Passwords = $_POST['Passwords'];
    if(empty($FullName) || empty($Telphone) || empty($Email)||empty($Status) || empty($User_Type) || empty($Usernames)|| empty($Passwords)) {                
        if(empty($FullName)) {
            echo "<font color='red'>FullName field is empty.</font><br/>";
        }
        
        if(empty($Telphone)) {
            echo "<font color='red'>Telphone field is empty.</font><br/>";
        }
        
        if(empty($Email)) {
            echo "<font color='red'>Email field is empty.</font><br/>";
        }
        if(empty($Status)) {
            echo "<font color='red'>Status field is empty.</font><br/>";
        }
        
        if(empty($User_Type)) {
            echo "<font color='red'>User_Type field is empty.</font><br/>";
        }
        
        if(empty($Usernames)) {
            echo "<font color='red'>Usernames field is empty.</font><br/>";
        }
        
		 if(empty($Passwords)) {
            echo "<font color='red'>Passwords field is empty.</font><br/>";
        }
        //link to the previous page
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    } else {
	$query = "SELECT * FROM `USERS` WHERE Usernames='$Usernames' and Passwords='$Passwords'";
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
echo 'alert(" User Registration Details Are Already Submitted with same username or password please check and register again!!!.")';
echo '</script>';
 }
 else
 {
 echo '<script type="text/javascript">alert("User Registration Details submitted succesfully!");</script>';
  //**mysql_query("insert into patients(Names,PatientID,Email,Telphone,Diagnosis) values('$Names','$PatientID','$Email','$Telphone','$Diagnosis')");
  
  //header("refresh:2;url=Location :login.php"); // really should be a fully qualified URI
  $result = mysqli_query($con, "INSERT INTO users(FullName,Telphone,Email,Status,User_Type,Usernames,Passwords) VALUES('$FullName','$Telphone','$Email','$Status','$User_Type','$Usernames','$Passwords')");
header("Location: Registerstaffs.php");
 
 }	
    }
}
?>
<?php
//including the database connection file
include_once("db.php");
 
//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
$result = mysqli_query($con, "SELECT * FROM users ORDER BY UserID DESC"); // using mysqli_query instead
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
<p align="left">Welcome <?php echo $_SESSION['Usernames']; ?>!</p>
<ul>
  <li><a href="managers.php">HOME</a></li>
  <li><a href="approveleave.php">STAFFS LEAVE REQUESTS</a></li>
  <li><a href="logout.php">Logout</a></li>   
</ul>
<div>




<h1 align="center">EMPLOYEES LEAVE  MANAGEMENT SYSTEM</h1>
<h2 align="center">Register new staffs</h2>
<div id="form" style="padding-left:200px">
		<h2 align="center">LIST OF REGISTERED STAFFS</h2>
<table width='82%' border=2>
        <tr bgcolor='#CCCCCC'>
            <td width="7%">FullName</td>
            <td width="5%">Telphone</td>
            <td width="3%">Email</td>
			<td width="3%">Status</td>
			<td width="5%">User_Type</td>
        </tr>
        <?php 
        //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array 
        while($res = mysqli_fetch_array($result)) {         
            echo "<tr>";
            echo "<td>".$res['FullName']."</td>";
            echo "<td>".$res['Telphone']."</td>";
            echo "<td>".$res['Email']."</td>";    
			echo "<td>".$res['Status']."</td>";
            echo "<td>".$res['User_Type']."</td>";        
        }
        ?>
  </table>
  </div>

</div>
</body>
</html>