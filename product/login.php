<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link rel="stylesheet" href="style.css" />
</head>
<body style="background-color:#FFFFCC;">
<?php
//Usernamess,Passwordss
require('db.php');
session_start();
// If form submitted, insert values into the database.
if (isset($_POST['Usernames'])){
        // removes backslashes
	//$FirstName = stripslashes($_REQUEST['FirstName']);
        //escapes special characters in a string
	//$FirstName = mysqli_real_escape_string($con,$FirstName);
	$Usernames = stripslashes($_REQUEST['Usernames']);
        //escapes special characters in a string
	$Usernames = mysqli_real_escape_string($con,$Usernames);
	
	$Passwords = stripslashes($_REQUEST['Passwords']);
	$Passwords = mysqli_real_escape_string($con,$Passwords);
	//Checking is user existing in the database or not
        $query = "SELECT * FROM `USERS` WHERE Usernames='$Usernames'
and Passwords='$Passwords'";
	$result = mysqli_query($con,$query) or die(mysql_error());
	$rows = mysqli_num_rows($result);
	$res = mysqli_fetch_array($result);
	$User_Type = $res['User_Type'];
	$Status = $res['Status'];
	$LeaveBalance = $res['LeaveBalance'];
	$UserID = $res['UserID'];
        if($rows==1){
	if($User_Type=="admin"&&$Status=="active"){	
	    $_SESSION['Usernames'] = $Usernames;
		$_SESSION['UserID'] = $UserID;
		//$_SESSION['LeaveBalance']=$LeaveBalance;
            // Redirect user to index.php
	    //header("Location: index.php");
		header("Location: index.php");
         }
		 else if($User_Type=="staff"&&$Status=="active")
		 {
		 $_SESSION['Usernames'] = $Usernames;
		 $_SESSION['UserID'] = $UserID;
		 $_SESSION['LeaveBalance']=$LeaveBalance;
            // Redirect user to index.php
	    //header("Location: index.php");
		header("Location: staffs.php");
		 }
		 else if($User_Type=="manager"&&$Status=="active")
		 {
		 $_SESSION['Usernames'] = $Usernames;
		 $_SESSION['UserID'] = $UserID;
            // Redirect user to index.php
	    //header("Location: index.php");
		header("Location: managers.php");
		 }
		 }
		 else{

	echo "<script type='text/javascript'>alert('Usernames/Passwords is incorrect.');
	window.location.href='login.php';
	</script>";


	}
    }else{
?>
<ul>
</ul>
<h1 align="center">EMPLOYEES LEAVE  MANAGEMENT SYSTEM</h1>
<div>
<h2 align="center">LOG IN</h2>
<div id="form" class="align-center">


<form action="" method="post" name="login">
<table>
<tr>
<td width="208">
<input type="text" name="Usernames" placeholder="Username" required />
</td>
</tr>
<tr>
<td>
<input type="Password" name="Passwords" placeholder="Password"  required />
</td>
</tr>
<tr>
<td>
<input name="submit" type="submit" value="Login" />
</td>
</tr>
</table>
</form>

</div>
</div>
<?php } ?>
</body>
</html>