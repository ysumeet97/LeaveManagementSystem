<?php
//include auth.php file on all secure pages
include("auth.php");
?>
<?php
// including the database connection file
include_once("db.php");
 //$UserID = $_GET['UserID'];
if(isset($_POST['update']))
{   $FullName = $_POST['FullName'];
    $Telphone = $_POST['Telphone'];
    $Email = $_POST['Email'];
	$Status = $_POST['Status'];
    $User_Type = $_POST['User_Type'];
    $Usernames = $_POST['Usernames'];
	$Passwords = $_POST['Passwords'];
	$LeaveBalance = $_POST['LeaveBalance'];
	$UserID = $_POST['UserID'];
    if(empty($FullName) || empty($Telphone) || empty($Email)||empty($Status) || empty($User_Type) || empty($Usernames)|| empty($Passwords)|| empty($LeaveBalance)) {                
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
		if(empty($LeaveBalance)) {
            echo "<font color='red'>Leave Balance field is empty.</font><br/>";
        }
        //link to the previous page
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    } 
	else {    
        //updating the table
        $result = mysqli_query($con, "UPDATE users SET FullName='$FullName',Telphone='$Telphone',Email='$Email',Status='$Status',User_Type='$User_Type',
		Usernames='$Usernames',Passwords='$Passwords',LeaveBalance='$LeaveBalance' WHERE UserID=$UserID");
        
        //redirectig to the display page. In our case, it is index.php
        header("Location:Registerstaffs.php");
    }
}
?>
<?php
//getting id from url
$UserID = $_GET['UserID'];
 
//selecting data associated with this particular id
$result = mysqli_query($con, "SELECT * FROM users WHERE UserID=$UserID");
 
while($res = mysqli_fetch_array($result))
{
/*FullName,Telphone,Email,Status, User_Type,Usernames,Passwords*/
    $FullName = $res['FullName'];
    $Telphone = $res['Telphone'];
    $Email = $res['Email'];
	$Status = $res['Status'];
    $User_Type = $res['User_Type'];
    $Usernames = $res['Usernames'];
	 $Passwords = $res['Passwords'];
	 $LeaveBalance = $res['LeaveBalance'];
	 
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
<p align="left">Welcome <?php echo $_SESSION['Usernames']; ?>!</p>
<ul>
  <li><a href="index.php">HOME</a></li>
  <li><a href="approveleave.php">APPROVE LEAVE </a></li>
  <li><a href="logout.php">Logout</a></li>
</ul>
<div>




<h1 align="center">EMPLOYEES LEAVE  MANAGEMENT SYSTEM</h1>
<h2 align="center">Update the staff details</h2>
<div id="form" style="padding-left:350px">
<form action="updatestaffs.php" method="post" name="form1">
        <table width="99%" border="0" align="left">
		
            <tr> 
                <td width="12%">Full Name:</td>
              <td width="14%"><input type="text" name="FullName" value="<?php echo $FullName;?>" required/></td>
				                <td width="5%">Status(active/inactive):</td>
              <td width="69%">			  
			  <select name="Status">
				<option value="<?php echo $Status;?>"><?php echo $Status;?></option>
				<option value="active">Active</option>
				<option value="inactive">In-active</option>
			  </select></td>
            </tr>
            <tr> 
                <td>Email:</td>
                <td><input type="text" name="Email" value="<?php echo $Email;?>" required/></td>
				<td>UserName:</td>
                <td><input type="text" name="Usernames"  value="<?php echo $Usernames;?>" required/></td>
            </tr>
            <tr> 
                <td>Telphone:</td>
                <td><input type="text" name="Telphone" value="<?php echo $Telphone;?>" required></td>
		                <td>Password:</td>
                <td><input type="text" name="Passwords" value="<?php echo $Passwords;?>" required/></td>		
            </tr>
			<tr> 
            <td>User Type:</td>
                <td>
				<select name="User_Type">
				<option value="<?php echo $User_Type;?>"><?php echo $User_Type;?></option>
				<option value="admin">Admin</option>
				<option value="staff">Staff</option>
				<option value="manager">Manager</option>
			  </select>
			  
				</td>    
				 <td>Leave Balance:</td>
                <td><input type="text" name="LeaveBalance" value="<?php echo $LeaveBalance;?>" required/></td>
            </tr>
			
			<tr> 
            <td><input type="submit" name="update" width="60%" value="UPDATE STAFFS"></td>
                <td><input type="hidden" name="UserID" value=<?php echo $_GET['UserID'];?>></td>    
				 <td></td>
                 <td></td>
			</tr>
    </table>
  </form>
  </div>

</div>
</body>
</html>