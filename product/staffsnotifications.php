<?php
//include auth.php file on all secure pages
include("auth.php");
$_SESSION['Usernames'];
$_SESSION['UserID'];
?>
<?php
// including the database connection file
include_once("db.php");
 //$UserID = $_GET['UserID'];
if(isset($_POST['Submit'])) { 
//FullName,Telphone,Email,Status, User_Type,Usernames,Passwords   
    $Message = $_POST['message'];
    $UserID = $_POST['UserID'];
	$Dates = $_POST['Dates'];
	
    if(empty($Message) || empty($UserID)|| empty($Dates)) {                
        
        if(empty($Message)) {
            echo "<font color='red'>Message field is empty.</font><br/>";
        }
        
        if(empty($UserID)) {
            echo "<font color='red'>UserID field is empty.</font><br/>";
        }
		 if(empty($Dates)) {
            echo "<font color='red'>Dates field is empty.</font><br/>";
        }
        
        //link to the previous page
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    } else {
	//U.UserID=L.UserID and L.Description != 'annual leave' and (YEAR(L.Startdate) = YEAR(CURDATE()) OR YEAR(L.Enddate) = YEAR(CURDATE()))
	$query = "SELECT * FROM `Leaveapplications` WHERE UserID='$UserID' and Description='annual leave' AND (YEAR(Enddate) = YEAR(CURDATE()) and YEAR(Startdate) = YEAR(CURDATE()))";
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
 /*echo '<script language="javascript">';
echo 'alert("This staff had attended his annual leave select another to send notification!!!.")';
echo '</script>';
echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
//header("Location: sendstaffnotifications.php");*/
echo "<script type='text/javascript'>alert('This staff had attended his annual leave select another to send notification!!!');
window.location='sendstaffnotifications.php';
</script>";
 }
 else
 {
 /*echo '<script type="text/javascript">alert("staff leave notification submitted succesfully!!!");</script>';*/
  //**mysql_query("insert into patients(Names,PatientID,Email,Telphone,Diagnosis) values('$Names','$PatientID','$Email','$Telphone','$Diagnosis')");
  
  //header("refresh:2;url=Location :login.php"); // really should be a fully qualified URI
  $result = mysqli_query($con, "INSERT INTO leavenotifications(Dates,Message,UserID) VALUES('$Dates','$Message',$UserID)");
//header("Location: sendstaffnotifications.php");
echo "<script type='text/javascript'>alert('The staff leave notification submitted succesfully!!!!!');
window.location='sendstaffnotifications.php';
</script>";
 
 }	
    }
}
?>
<?php
//getting id from url
$UserID = $_GET['UserID'];
//selecting data associated with this particular id
$result = mysqli_query($con, "SELECT * from users  WHERE UserID=$UserID ");
 
while($res = mysqli_fetch_array($result))
{
/*Description,Startdate,Enddate,ApprovalStatus, Expirelystatus,Comments,Fullname,UserID,LeaveBalance*/
    //$Fullname = $res['FullName'];
    $UserID = $res['UserID'];
}
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
  <li><a href="managers.php">HOME</a></li>
  <li><a href="logout.php">Logout</a></li>
</ul>
<div>




<h1 align="center">EMPLOYEES LEAVE  MANAGEMENT SYSTEM</h1>
<h2 align="center">Send notification message to staff </h2>
<div id="form" style="padding-left:350px">
<form action="staffsnotifications.php" method="post" name="form1">
        <table width="99%" border="0">
		
            <tr> 
                <td width="19%">User ID:</td>
                <td width="29%"><input type="text"  value="<?php echo $UserID;?>" name="UserID" required/></td>
            </tr>
			<tr> 
                <td>Date:</td>
                <td><input type="date" name="Dates" Required/></td>
          </tr>
           
           <tr> 
                <td>Message:</td>
                <td><textarea name="message" cols="31" rows="4"></textarea></td>
          </tr>
			<tr> 
            <td><input type="submit" name="Submit" value="SEND NOTIFICATION">&nbsp;</td>
                <td><input type="hidden" value=<?php echo $_GET['UserID'];?> name="UID" ></td>    
            </tr>
    </table>
  </form>
  </div>

</div>
</body>
</html>