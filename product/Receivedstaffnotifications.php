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
	$leavebalance = $_POST['leavebalance'];
    if(empty($FullName) || empty($Telphone) || empty($Email)||empty($Status) || empty($User_Type) || empty($Usernames)|| empty($Passwords)|| empty($leavebalance)) {                
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
				 if(empty($leavebalance)) {
            echo "<font color='red'>Leave balance field is empty.</font><br/>";
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
  $result = mysqli_query($con, "INSERT INTO users(FullName,Telphone,Email,Status,User_Type,Usernames,Passwords,leavebalance) VALUES('$FullName','$Telphone','$Email','$Status','$User_Type','$Usernames','$Passwords','$leavebalance')");
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
//UserID,FullName,Telphone,Email,User_Type,LeaveBalance
$result = mysqli_query($con, "SELECT U.UserID,U.FullName,U.Telphone,U.Email,U.User_Type,U.LeaveBalance FROM users U where U.User_Type='staff' ORDER BY U.UserID DESC"); // resultnoteusing mysqli_query instead
?>
<?php
//including the database connection file
include_once("db.php");
$UserID=$_SESSION['UserID'];
//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
//UserID,FullName,Telphone,Email,User_Type,LeaveBalance
$resultnote = mysqli_query($con, "SELECT * FROM leavenotifications where UserID=$UserID ORDER BY NoteID  DESC"); // resultnoteusing mysqli_query instead
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
<p align="left">Welcome <?php echo $_SESSION['Usernames']; ?>!||USER ID:<?php echo $_SESSION['UserID']; ?>||Your Leave balance is:<?php echo $_SESSION['LeaveBalance']; ?></p>
<ul>
  <li><a href="staffs.php">HOME</a></li>
  <li><a href="logout.php">Logout</a></li>
</ul>
<div>




<h1 align="center">EMPLOYEES LEAVE  MANAGEMENT SYSTEM</h1>
<h2 align="center">ANUAL LEAVE NOTIFICATIONS </h2>
<div id="form" style="padding-left:100px">
  <h2 align="center">RECEIVED NOTIFICATIONS </h2>
        <table width='89%' border=2>
        <tr bgcolor='#CCCCCC'>
            <td width="9%">NoteID</td>
            
            <td width="6%">Date</td>
			
			<td width="10%">Notification Message</td>
        </tr>
        <?php 
        //NoteID,Message,Fullname,UserID while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array 
        while($res = mysqli_fetch_array($resultnote)) {         
            echo "<tr>";
            echo "<td>".$res['NoteID']."</td>";
            echo "<td>".$res['Dates']."</td>";    
			
            echo "<td>".$res['Message']."</td>";       
        }
        ?>
  </table>
  </div>
<script>
var myInput = document.getElementById("Passwords");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}
</script>
</div>
</body>
</html>